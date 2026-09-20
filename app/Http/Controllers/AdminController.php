<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Cart;
use App\Models\Archive;
use App\Models\Transaction;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\UploadedFile;
use PDF;
use Notification;
use App\Notifications\SendEmailNotification;

class AdminController extends Controller
{

    // public function transactionChart()
    // {
    //     $trans = Transaction::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
    //                 ->whereYear('created_at',date('Y'))
    //                 ->groupBy('month')
    //                 ->orderBy('month')
    //                 ->get();

    //                 $monthLabels = [];
    //                 $salesData = [];
    //                 $colors = ['#36A2EB'];

    //                 // Loop through each month of the year
    //                 for ($month = 1; $month <= 12; $month++) {
    //                     // Retrieve the sales count for the current month
    //                     $salesCount = Transaction::whereYear('created_at', date('Y'))
    //                                       ->whereMonth('created_at', $month)
    //                                       ->count();

    //                     // Get the month name
    //                     $monthName = date("F", mktime(0, 0, 0, $month, 1));

    //                     // Add the month name to labels and sales count to data
    //                     array_push($monthLabels, $monthName);
    //                     array_push($salesData, $salesCount);
    //                 }

    //                 $datasets = [
    //                     [
    //                         'label' => 'Sales',
    //                         'data' => $salesData,
    //                         'backgroundColor' => $colors,
    //                     ]
    //                 ];

    //                 return view('admin.home', compact('datasets'));
    // }

    public function view_category()
    {
        $data = Category::all();
        return view('admin.dashboard.category', compact('data'));
    }

    public function add_category(Request $request)
    {
        $data = new Category;

        $validator = Validator::make($request->all(), [
            'name_category' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data->category_name = $request->name_category;

        $data->save();

        return redirect()->back()->with('message','Category Added Successfully');
    }
    public function delete_category($id)
    {
        $data = Category::find($id);

        $data->delete();

        return redirect()->back()->with('message','Category Deleted Successfully');
    }
    public function view_product()
    {
        $category = Category::all();;
        return view('admin.dashboard.product',compact('category'));
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

    public function show_product()
    {
        $product = Product::all();
        $category = Category::all();
        $categorys = Category::all();
        return view('admin.dashboard.show_product', compact('product', 'category', 'categorys'));
    }
    public function trash_product()
    {
        $product = Product::onlyTrashed()->orderBy('id','DESC')->paginate();

        return view('admin.dashboard.trash_product', compact('product'));
    }

    public function restore_product($id)
    {
        $product = Product::withTrashed()->findOrFail($id);

        if(!empty($product))
        {
            $product->restore();
        }

        return redirect()->back()->with('success', 'Product Restored successfully');
    }

    public function ProductdeletePermanently($id)
    {
        $product = Product::withTrashed()->findOrFail($id);

        if(!empty($product))
        {
            $product->forceDelete();
        }

        return redirect()->back()->with('error', 'Prouct Deleted Forever');
    }


    public function delete_product($id)
    {
        $product = Product::find($id);

        $product->delete();

        return redirect()->back()->with('message', 'Product Deleted Successfully');


    }

    public function update_product($id)
    {
        $product = Product::find($id);
        $category = Category::all();
        return view('admin.dashboard.update_product', compact('product','category'));
    }

    public function update_product_confirm($id, Request $request)
{
    $product = Product::find($id);

    // Update product information
    $product->description = $request->description;
    $product->title = $request->title;
    $product->price = $request->price;
    $product->stock = $request->stock;
    $product->quantity = $request->quantity;
    $product->category = $request->category;

    // Handle file upload
    $image = $request->image;
    if ($image) {
        // Generate a unique image name based on the current timestamp
        $imagename = time() . '.' . $image->getClientOriginalExtension();

        // Move the uploaded image to the 'product' directory
        $request->image->move('product', $imagename);

        // Set the product's image attribute to the uploaded image's filename
        $product->image = $imagename;
    }

    // Save the updated product
    $product->save();

    // Redirect back to the previous page with a success message
    return redirect()->to('show_product')->with('message', 'Product updated successfully');
    // return redirect()->back()->with('message', 'Product updated successfully');
}

    public function order()
    {
        //$order = Order::all();

        $order = Order::orderBy('created_at', 'desc')->get();
        return view('admin.dashboard.order',compact('order'));
    }


    public function orderByDate()
    {
        $order = Order::orderBy('created_at', 'asc')->get();
        return view('admin.dashboard.order', compact('order'));
    }



    public function delete_selected_orders(Request $request)
{
    try {
        $orderIds = json_decode($request->input('order_ids'));

        if (is_array($orderIds) && count($orderIds) > 0) {
            Order::whereIn('id', $orderIds)->delete();
            return redirect()->back()->with('message', 'Selected orders deleted successfully');
        } else {
            return redirect()->back()->with('error', 'No valid orders selected for deletion');
        }
    } catch (\Throwable $e) {
        return redirect()->back()->with('error', 'Error while processing selected orders: ' . $e->getMessage());
    }
}

public function selected_transaction(Request $request)
{
    $ids = $request->ids;
    Transaction::whereIn('id',$ids)->delete();
    return response()->json(["success"=>"Transaction Deleted"]);
}
public function selected_order(Request $request){
    $ids = $request->ids;

    Order::whereIn('id',$ids)->delete();

    return response()->json(["success"=>"Order Deleted"]);
}

public function archive_order(Request $request, $id)
{
    $order = Order::find($id);

        $archive = new Transaction;
        $archive->name = $order->name;
        $archive->email = $order->email;
        $archive->phone = $order->phone;
        $archive->address = $order->address;
        $archive->product_title = $order->product_title;
        $archive->quantity = $order->quantity;
        $archive->product_id = $order->product_id;
        $archive->user_id = $order->user_id;
        $archive->image = $order->image;
        $archive->price = $order->price;
        $archive->payment_status = 'cash on delivery';
        // $transaction->delivery_status = 'Delivered';

        $archive->save();
        $order->save();
        return redirect()->back();

}




    // public function delivered($id)
    // {
    //     $order = Order::find($id);

    //     $order->delivery_status="Delivered";

    //     $transaction = new Transaction;
    //     $transaction->name = $order->name;
    //     $transaction->email = $order->email;
    //     $transaction->phone = $order->phone;
    //     $transaction->address = $order->address;
    //     $transaction->product_title = $order->product_title;
    //     $transaction->quantity = $order->quantity;
    //     $transaction->product_id = $order->product_id;
    //     $transaction->user_id = $order->user_id;
    //     $transaction->image = $order->image;
    //     $transaction->price = $order->price;
    //     $transaction->payment_status = 'cash on delivery';
    //     // $transaction->delivery_status = 'Delivered';

    //     $transaction->save();
    //     $order->save();
    //     return redirect()->back();
    // }

    public function delete_order($id)
    {
        $order = Order::find($id);

        $order->delete();

        return redirect()->back();
    }
    public function print_pdf($id)
    {

        $order = Order::find($id);

        $pdf = PDF::loadView('admin.dashboard.pdf', compact('order'));

        return $pdf->download('order_details.pdf');
    }

    public function print_pdf_transaction($id)
    {

        $transaction = Transaction::find($id);

        $pdftransac = PDF::loadView('admin.dashboard.pdf_transaction', compact('transaction'));

        return $pdftransac->download('transaction.pdf');
    }


    public function send_email($id)
    {

        $order = Order::find($id);


        return view('admin.dashboard.email_info', compact('order'));

    }

    public function send_user_email(Request $request, $id)
    {

        $order = Order::find($id);

        $details = [

            'greetings' => $request->greeting,
            'firstline' => $request->firstline,
            'body' => $request->body,
            'button' => $request->button,
            'url' => $request->url,
            'lastline' => $request->lastline,

        ];

        Notification::send($order, new SendEmailNotification($details));

        return redirect()->back();
    }

    public function search(Request $request)
    {
        $searchText = $request->search;
        $order = Order::where('name','LIKE',"%$searchText%")->orWhere('phone','LIKE',"%$searchText%");

        return view('admin.dashboard.order', compact('order'));
    }

//     public function pos()
//     {
//         $product = Product::all();
//         $user = User::all();


//         return view('admin.dashboard.pos', compact('product', 'user'));
//     }
//     public function pos_add_cart(Request $request, $id)
//     {
//     if (Auth::check()) {
//         $user = Auth::user();
//         $product = Product::find($id);
//         if($user->usertype === '0')
//         {
// // Check if the item already exists in the user's cart
//         $existingCartItem = Cart::where('user_id', $user->id)
//             ->where('product_id', $product->id)
//             ->first();
//         if ($existingCartItem) {
//             // If it exists, update the quantity
//             $existingCartItem->quantity += $request->quantity;
//             $existingCartItem->price += ($product->price * $request->quantity);
//             $existingCartItem->save();
//         } else {
//             // If it doesn't exist, create a new cart entry
//             $cart = new Cart;
//             // User details
//             $cart->name = $user->name;
//             $cart->email = $user->email;
//             $cart->phone = $user->phone;
//             $cart->address = $user->address;
//             $cart->user_id = $user->id;
//             // Product details
//             $cart->product_title = $product->title;
//             $cart->price = $product->price * $request->quantity;
//             $cart->image = $product->image;
//             $cart->product_id = $product->id;
//             $cart->quantity = $request->quantity;
//             $cart->save();
//         }

//         return redirect()->back()->with('message', 'Item added to cart successfully');
//     } else {
//         return redirect('login');
//     }
// }
//         }


    public function customers()
    {
        $user = User::all();
        $users = User::all();
        $userss = User::all();
        return view('admin.dashboard.customers', compact('user','users','userss'));
    }
    public function user_edit($id)
    {
        $user = User::find($id);
        return view('admin.dashboard.user_edit', compact('user'));
    }

    public function update_user($id, Request $request)
    {


        $user = User::find($id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->usertype=$request->usertype;
        $user->phone=$request->phone;
        $user->address=$request->address;
        $user->email_verified_at = now();
        $user->save();

        return redirect()->to('customers')->with('message', 'User updated successfully');
    }

    public function add_customer()
    {
        $user = new User();
        return view('admin.dashboard.add_customer', compact('user'));
    }
    public function adding_customer(Request $request)
    {
        $user = new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->usertype=$request->usertype;
        $user->phone=$request->phone;
        $user->address=$request->address;
        $user->password = bcrypt('88888888');
        $user->save();

        return redirect()->back()->with('message','User Added Successfully');

    }
    public function delivered_orders()
    {
        $order = Order::all();

        return view('admin.dashboard.delivered_order', compact('order'));
    }

    public function updateDeliveryStatus(Request $request, $id, $status)
{
    $order = Order::find($id);

    if (!$order) {
        return redirect()->back()->with('error', 'Order not found');
    }

    // Check if the provided status is valid
    if ($status === 'delivered' ){
        $order->delivery_status = ucfirst($status); // Capitalize the status
        $transaction = new Transaction;
        $transaction->name = $order->name;
        $transaction->email = $order->email;
        $transaction->phone = $order->phone;
        $transaction->address = $order->address;
        $transaction->product_title = $order->product_title;
        $transaction->quantity = $order->quantity;
        $transaction->product_id = $order->product_id;
        $transaction->user_id = $order->user_id;
        $transaction->image = $order->image;
        $transaction->price = $order->price;
        $transaction->payment_status = 'cash on delivery';
        $transaction->save();
       // $transaction->delivery_status = 'Delivered';
        $order->save();
        return redirect()->back()->with('success', 'Delivery status updated successfully');
    }elseif($status === 'processing' || $status === 'pending' || $status === 'cancelled') {
        $order->delivery_status = ucfirst($status);
        $order->save();
        return redirect()->back()->with('success', 'Delivery status updated successfully');
    } else {
        return redirect()->back()->with('error', 'Invalid delivery status');
    }
}
    public function show_transaction()
    {
        $transactions = Transaction::paginate(5);;

        return view('admin.dashboard.show_transaction', compact('transactions'));
    }
    public function trash_transaction()
    {
        $transaction = Transaction::onlyTrashed()->orderBy('id','DESC')->paginate();

        return view('admin.dashboard.trash_transaction', compact('transaction'));
    }

    public function restore($id)
    {
        $transaction = Transaction::withTrashed()->findOrFail($id);

        if(!empty($transaction))
        {
            $transaction->restore();
        }

        return redirect()->to('show_transaction')->with('success', 'Transaction Restored successfully');
    }
    public function deletePermanently($id)
    {
        $transaction = Transaction::withTrashed()->findOrFail($id);

        if(!empty($transaction))
        {
            $transaction->forceDelete();
        }

        return redirect()->to('show_transaction')->with('error', 'Transaction Deleted Forever');
    }

}


