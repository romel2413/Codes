<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Transaction;
class HomeController extends Controller
{
    public function index()
    {
        $product = Product::paginate(3);
        return view('home.userpage', compact('product'));
    }
    public function products(){
        $product = Product::all();
        return view('home.all_product', compact('product'));
    }
    public function cartshow(){
        if(Auth::id())
        {
            $id=Auth::user()->id;
            $product = Product::all();
            $cart = Cart::where('user_id','=', $id)->get();
            return view('home.cartshow',compact('cart', 'product'));
        }
        else
        {
            return redirect('login');
        }
    }


    public function redirect()
    {
        $usertype=Auth::user()->usertype;

        if($usertype=='1' || $usertype=='2')
        {
            $total_product = Product::all()->count();

            $total_order = Order::all()->count();

            $total_user = User::where('usertype', '=', '0')->get()->count();

            $total_stock = Product::sum('stock');


            $order = Order::all();

            $total_transac = Transaction::sum('price');

            $total_revenue = 0;



            foreach($order as $order)
            {
                $total_revenue = $total_revenue + $order->price;
            }

            $total_delivered = Order::where('delivery_status','=' , 'Delivered')->get()->count();
            $total_pending = Order::where('delivery_status','=' , 'Pending')->get()->count();
            $total_processing = Order::where('delivery_status','=' , 'Processing')->get()->count();
            return view('admin.home', compact('total_product','total_order','total_user','total_revenue','total_delivered','total_processing','total_pending','total_stock', 'total_transac'));
        }
        // elseif($usertype=='2')
        // {
        //     $total_product = Product::all()->count();

        //     $total_order = Order::all()->count();

        //     $total_user = User::all()->count();

        //     $total_stock = Product::sum('stock');

        //     $order = Order::all();

        //     $total_revenue = 0;


        //     foreach($order as $order)
        //     {
        //         $total_revenue = $total_revenue + $order->price;
        //     }

        //     $total_delivered = Order::where('delivery_status','=' , 'Delivered')->get()->count();
        //     $total_processing = Order::where('delivery_status','=' , 'processing')->get()->count();
        //     return view('admin.home', compact('total_product','total_order','total_user','total_revenue','total_delivered','total_processing','total_stock'));
        // }
        else
        {
            $total_user = 0;
            $product = Product::paginate(3);
            return view('home.userpage',compact('product', 'total_user'));
        }

    }
    public function userChart()
    {
        $usertype=Auth::user()->usertype;

        if($usertype=='1' || $usertype=='2')
        {
            $total_product = Product::all()->count();

            $total_order = Order::all()->count();

            $total_user = User::where('usertype', '=', '0')->get()->count();

            $total_stock = Product::sum('stock');


            $order = Order::all();

            $total_transac = Transaction::sum('price');

            $total_revenue = 0;



            foreach($order as $order)
            {
                $total_revenue = $total_revenue + $order->price;
            }
                //


                        $sales = Transaction::selectRaw('MONTH(created_at) as month, SUM(price) as total_sales')
                            ->whereYear('created_at', date('Y'))
                            ->groupBy('month')
                            ->orderBy('month')
                            ->get();

                        $users = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                            ->whereYear('created_at', date('Y'))
                            ->groupBy('month')
                            ->orderBy('month')
                            ->get();

                        $labels = [];
                        $salesData = [];
                        $userData = [];
                        $color = ['#36A2EB', '#FF6384']; // Colors for sales and user data

                        for ($i = 1; $i <= 12; $i++) {
                            $month = date("F", mktime(0, 0, 0, $i, 1));
                            $total_sales = 0;
                            $user_count = 0;

                            foreach ($sales as $sale) {
                                if ($sale->month == $i) {
                                    $total_sales = $sale->total_sales;
                                    break;
                                }
                            }

                            foreach ($users as $user) {
                                if ($user->month == $i) {
                                    $user_count = $user->count;
                                    break;
                                }
                            }

                            array_push($labels, $month);
                            array_push($salesData, $total_sales);
                            array_push($userData, $user_count);
                        }

                        $datasets = [
                            [
                                'label' => 'Total Sales',
                                'data' => $salesData,
                                'backgroundColor' => $color[0],
                            ],
                            [
                                'label' => 'Users',
                                'data' => $userData,
                                'backgroundColor' => $color[1],
                            ],
                        ];
                        // $labels = [];
                        // $data = [];
                        // $color = ['#36A2EB'];
                        // // '#FF6384', '#36A2EB', '#e0d3d5', '#ff6108', '#ffdd69', '#36454f', '#FF6384', '#a7204c', '#cbe4ff', '#2b3019', '#b03966', '#b01983'
                        // for($i=1; $i <= 12; $i++)
                        // {
                        // $month = date("F", mktime(0,0,0,$i,1));
                        // $count = 0;

                        // foreach($users as $user)
                        // {
                        // if($user->month == $i){
                        //     $count = $user->count;
                        //     break;

                        // }
                        // }
                        // array_push($labels, $month);
                        // array_push($data, $count);
                        // }
                        // $datasets = [
                        // [
                        // 'label' => 'Users',
                        // 'data' => $data,
                        // 'backgroundColor' => $color
                        // ]
                        // ];

            $total_processing = Order::where('delivery_status','=' , 'Processing')->get()->count();
            $total_delivered = Order::where('delivery_status','=' , 'Delivered')->get()->count();
            $total_pending = Order::where('delivery_status','=' , 'Pending')->get()->count();
            return view('admin.home', compact('datasets', 'labels','total_product','total_order','total_processing','total_user','total_revenue','total_delivered','total_pending','total_stock', 'total_transac'));
        }

        else
        {
            $total_user = 0;
            $product = Product::paginate(3);
            return view('home.userpage',compact('product', 'total_user'));
        }


    }
    public function product_details($id)
    {
        $product = Product::find($id);
        return view('home.product_details',compact('product'));
    }
    public function add_cart(Request $request, $id)
{
    if (Auth::id()) {
        $user = Auth::user();
        $product = Product::find($id);

        // Check if the product is in stock
        if ($product->stock > 0) {
            // Check if the item already exists in the user's cart
            $existingCartItem = Cart::where('user_id', $user->id)
                ->where('product_id', $product->id)
                ->first();
            if ($existingCartItem) {
                // If it exists, update the quantity
                $existingCartItem->quantity += $request->quantity;
                $existingCartItem->price += ($product->price * $request->quantity);
                $existingCartItem->save();
            } else {
                // If it doesn't exist, create a new cart entry
                $cart = new Cart;
                // User details
                $cart->name = $user->name;
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
                $cart->user_id = $user->id;
                // Product details
                $cart->product_title = $product->title;
                $cart->price = $product->price * $request->quantity;
                $cart->image = $product->image;
                $cart->product_id = $product->id;
                $cart->stock = $product->stock;
                $cart->quantity = $request->quantity;
                $cart->save();

                // Decrement the product stock
                $product->save();
            }

            return redirect()->back()->with('message', 'Item added to cart successfully');
        } else {
            return redirect()->back()->with('error', 'Sorry, this product is out of stock.');
        }
    } else {
        return redirect('login');
    }
}
public function update_cart(Request $request, $id)
{
    $cart = Cart::find($id);
    $product = Product::find($cart->product_id);
    if (!$cart) {
        return redirect()->back()->with('error', 'Cart item not found');
    }

    // Validate the input
    $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    // Update the quantity
    $cart->quantity = $request->quantity;

    $cart->price = $product->price * $cart->quantity;


    $cart->save();
    $product->save();


    // You may also want to update the total price in the session or the database here
    return redirect()->back();
}

    public function show_cart()
        {



            if(Auth::id())
            {
                $id=Auth::user()->id;
                $product = Product::all();
                $cart = Cart::where('user_id','=', $id)->get();
                return view('home.showcart',compact('cart', 'product'));
            }
            else
            {
                return redirect('login');
            }

        }
    public function remove_cart($id)
    {
        $cart = Cart::find($id);

        $cart->delete();

        return redirect()->back();
    }

    public function cash_order()
{
    $user = Auth::user();
    $userid = $user->id;

    $cartItems = Cart::where('user_id', $userid)->get();

    foreach ($cartItems as $cartItem) {

        $product = Product::find($cartItem->product_id);

        // Check if the cart item quantity is greater than the available stock
        if ($cartItem->quantity > $product->stock) {
            return redirect()->back()->with('error', 'Sorry, there is not enough stock for ' . $cartItem->product_title .  ' Stock Available ' . $cartItem->stock);
        }

        $existingOrder = Order::where('user_id', $userid)
            ->where('product_id', $cartItem->product_id)
            ->where('payment_status', 'cash on delivery')
            ->where('delivery_status', 'Pending')
            ->first();

        if ($existingOrder) {
            // If the same product is already in an order, update the quantity and price
            $existingOrder->quantity += $cartItem->quantity;
            $existingOrder->price += $cartItem->price;
            $existingOrder->save();

            // Reset the cart item's quantity to zero
            $cartItem->quantity = 0;
            $cartItem->save();
        } else {
            // If not, create a new order
            $order = new Order;
            $order->name = $cartItem->name;
            $order->email = $cartItem->email;
            $order->phone = $cartItem->phone;
            $order->address = $cartItem->address;
            $order->product_title = $cartItem->product_title;
            $order->quantity = $cartItem->quantity;
            $order->product_id = $cartItem->product_id;
            $order->user_id = $cartItem->user_id;
            $order->image = $cartItem->image;
            $order->price = $cartItem->price;
            $order->payment_status = 'cash on delivery';
            $order->delivery_status = 'Pending';
            $order->save();

            // Decrement the product stock
            $product = Product::find($cartItem->product_id);
            $product->stock -= $cartItem->quantity;
            $product->save();


        }
        // Delete the cart item
        $cartItem->delete();

    }

    return redirect()->back()->with('message', 'We have received your order.');
}


    public function show_order()
    {

        if(Auth::id())
        {
            $user = Auth::user();

            $userid = $user->id;

            $order = Order::where('user_id', '=', $userid)->get();
            return view('home.order', compact('order'));
        }
        else
        {
            return redirect('login');
        }
    }


    public function cancel_order($id)
    {
        $order = Order::find($id);

        // Check if the order exists
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        // Retrieve the product associated with the order using the product_id
        $product = Product::find($order->product_id);

        // Check if the product exists
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        // Add the quantity of the order back to the product's stock
        $product->stock += $order->quantity;

        // Update the delivery status of the order
        $order->delivery_status = 'Cancelled';

        // Save the changes to both the order and the product
        $order->save();
        $product->save();

        return redirect()->back()->with('success', 'Order has been cancelled, and stock has been updated.');
    }
    public function remove_order($id){


        $order = Order::find($id);

        $order->delete();

        return redirect()->back()->with('message', 'Order Deleted Successfully');
    }
}
