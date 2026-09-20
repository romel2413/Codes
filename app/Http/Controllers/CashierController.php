<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\OrderWalkIn;
use App\Models\WalkIn;
use Illuminate\Http\UploadedFile;
use PDF;
use Notification;
use App\Notifications\SendEmailNotification;
class CashierController extends Controller
{
    public function pos()
{
    $product = Product::all();
    $products = Product::all();
    $walkName = WalkIn::all();
    $walkOrder = OrderWalkIn::all();
    $walkOrders = OrderWalkIn::all();
    $item_walkOrderss = OrderWalkIn::count();
    $category = Category::all();
    $total_orderWalkIn = OrderWalkIn::sum('total_price');
    $total_quantity = OrderWalkIn::sum('quantity');
    $total_price = OrderWalkIn::sum('price');

    $total_original = OrderWalkIn::sum('original_price');

    return view('admin.dashboard.pos', compact('product','products', 'walkName', 'walkOrder','item_walkOrderss','total_orderWalkIn','total_original', 'total_quantity','total_price', 'category', 'walkOrders'));
}

public function add_product(Request $request)
{
    $product = new Product;

    $product->title = $request->title;
    $product->description = $request->description;
    $product->category = $request->category;
    $product->quantity = $request->quantity;

    $originalPrice = $request->price;
    $discountPercentage = $request->discount_price;

    // Calculate the discounted price based on the discount percentage
    $discountedPrice = $originalPrice - ($originalPrice * ($discountPercentage / 100));

    // Ensure the discounted price is not negative
    $discountedPrice = max($discountedPrice, 0);

    // Save both the original price and the discount percentage
    $product->original_price = $originalPrice;
    $product->discount_percentage = $discountPercentage;
    $product->price = $discountedPrice;

    $product->stock = $request->stock;

    $image = $request->image;

if ($image) {
    $imagename = time() . '.' . $image->getClientOriginalExtension();
    $image->move('product', $imagename);
    $product->image = $imagename;
}
    $product->save();

    return redirect()->back()->with('message', 'Product Added Successfully');
}
    public function walkinName(Request $request)
    {
        $walkName = new WalkIn;

        $walkName->name = $request->walkinName;

        $walkName->save();
        return redirect()->back()->with('message','Walk in Added Successfully');

    }
    public function walkInOrder(Request $request, $id)
{
    // Assuming you want to create an order for a specific product
    // You might need to pass the product ID as a parameter in your request
    $walkInName = WalkIn::find($id);
    // Retrieve the product by its ID, assuming you pass it through the request
    $product = Product::find($id);
    // Check if the product exists
    if (!$product) {
        return redirect()->back()->with('error', 'Product not found');
    }

    // Check if there is enough stock for the requested quantity
    if ($product->stock < $product->quantity) {
        return redirect()->back()->with('error', 'Insufficient stock for this product');
    }

    // Check if an order for the same product already exists
    $existingOrder = OrderWalkIn::where('product_id', $product->id)->first();

    if ($existingOrder) {
        // If an order exists, update the quantity and total price
        $existingOrder->quantity += $product->quantity;
        $existingOrder->total_price += ($product->price * $product->quantity);

        $existingOrder->save();
    } else {
        // If no order exists, create a new one
        $totalPrice = $product->price * $product->quantity;
        // Create a new OrderWalkIn instance and set its properties
        $walkOrder = new OrderWalkIn;
        $walkOrder->name = 'Walk-In';
        $walkOrder->product_title = $product->title;
        $walkOrder->price = $product->price;
        $walkOrder->quantity = $product->quantity;
        $walkOrder->discount_percentage = $product->discount_percentage;
        $walkOrder->stock = $product->stock - $request->quantity; // Decrease the stock
        $walkOrder->total_price = $totalPrice;
        $walkOrder->image = $product->image;
        $walkOrder->original_price = $product->original_price;
        $walkOrder->product_id = $product->id;

        // Save the order
        $walkOrder->save();
    }

    // Update the product's stock after the order is placed
    $product->stock -= $product->quantity;
    $product->save();

    return redirect()->back()->with('success', 'Order created successfully');
}

public function delivery(Request $request)
{
    // Retrieve all records from the OrderWalkIn table
    $walkOrders = OrderWalkIn::all();

    // Iterate through each record in OrderWalkIn and create a new record in Transaction
    foreach ($walkOrders as $walkOrder) {
        $transaction = new Transaction;
        $transaction->name = $request->name;
        $transaction->email = $request->email;
        $transaction->address = $request->address;
        $transaction->phone = $request->phone;
        $transaction->product_title = $walkOrder->product_title;
        $transaction->quantity = $walkOrder->quantity;
        $transaction->product_id = $walkOrder->product_id;
        $transaction->price = $walkOrder->price;
        $transaction->image = $walkOrder->image ;
        $transaction->payment_status = 'Walk-In';


        if($transaction->name == null || $transaction->email == null || $transaction->address == null || $transaction->phone == null){
            $transaction->name = 'Walk-In';
            $transaction->email = 'Walk-In@walkin.com';
            $transaction->address = 'Walk-in address';
            $transaction->phone = 'Walk-in phone';
        }

        $transaction->save();
    }

    OrderWalkIn::truncate();




    return redirect()->back()->with('success', 'Orders delivered successfully');
}


public function update_quantity(Request $request, $id)
{
    $walkOrder = OrderWalkIn::find($id);

    if (!$walkOrder) {
        return redirect()->back()->with('error', 'Cart item not found');
    }


    // Get the product associated with the order item
    $product = Product::find($walkOrder->product_id);
    if (!$product) {
        return redirect()->back()->with('error', 'Product not found');
    }
    // Validate the input
    $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);


    // Calculate the difference in quantity
    $quantityDifference = $request->quantity - $walkOrder->quantity;

    // Check if there is enough stock to decrease the quantity
    if ($product->stock >= $quantityDifference) {
        // Update the quantity
        $walkOrder->quantity = $request->quantity;

        // Update the price and original_price
        $walkOrder->price = $product->price * $walkOrder->quantity;
        $walkOrder->original_price = $product->original_price * $walkOrder->quantity;

        // Update the stock of the product
        $product->stock -= $quantityDifference;

        // Save the changes
        $walkOrder->save();
        $product->save();

        // You may also want to update the total price in the session or the database here
        return redirect()->back();
    } else {
        return redirect()->back()->with('error', 'Not enough stock available');
    }



}

public function remove_order_walkIn($id)
{
    // Find the order to be deleted
    $walkOrder = OrderWalkIn::find($id);

    if (!$walkOrder) {
        return redirect()->back()->with('error', 'Order not found');
    }

    // Find the associated product
    $product = Product::find($walkOrder->product_id);

    if (!$product) {
        return redirect()->back()->with('error', 'Product not found');
    }

    // Increase the stock of the product by the quantity of the deleted order
    $product->stock += $walkOrder->quantity;
    $product->save();

    // Delete the order
    $walkOrder->delete();

    return redirect()->back()->with('message', 'Order Deleted Successfully');
}







}
