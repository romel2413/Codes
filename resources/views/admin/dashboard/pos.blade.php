<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/pos/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/pos/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/pos/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/pos/css/jquery-editable-select.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/pos/css/style.css') }}">
    <title>Point of sale</title>
</head>

<body>

    <!-- ============================== MAIN SECTION START ============================== -->
    <section style="width: 100%;" id="mainSection">
        @if (session()->has('success'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{ session()->get('success') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{ session()->get('error') }}
            </div>
        @endif
        <div class="row mx-0">
            <!-- ============================== CALCULATION AREA START ============================== -->
            <div class="col-xl-6 px-1">
                <div class="top-area-btns d-xl-none">
                    <div class="show-on-mob text-center">
                        <a href="#calculationArea" class="btn btn-green active-btn" type="button"><i
                                class="fa fa-shopping-cart"></i> Cart</a>
                        <a href="#productArea" class="btn btn-green" type="button"><i class="fa fa-shopping-bag"></i>
                            Product</a>
                    </div>
                    <div class="right-part">
                        <button class="btn btn-green" type="button" data-toggle="modal" data-target="#allSaleModal"><i
                                class="fa fa-history"></i> <span>Your all sales</span></button>
                        <button class="btn btn-green" type="button"><i class="fa fa-tachometer"></i>
                            <span>Dashboard</span></button>

                        <button class="btn btn-green" type="button"><i class="fa fa-sign-out"></i>
                            <span>Logout</span></button>
                    </div>
                </div>
                <div id="calculationArea" class="calculation-area">
                    <div class="cart-table">

                        <table class="table">
                            <thead class="">
                                <tr>
                                    <th scope="col">Item</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Qty/Amt</th>
                                    <th scope="col">Discount</th>
                                    <th scope="col">Original Price</th>
                                    <th scope="col">Delete/Update</th>
                                </tr>
                            </thead>
                            <tbody style="width: 100%;">

                                @foreach ($walkOrder as $walkOrder)
                                    <form action="{{ url('/update_quantity', $walkOrder->id) }}" method="POST">
                                        @csrf
                                        <tr class="table-row">
                                            <td>{{ $walkOrder->product_title }}</td>
                                            <td><span id="totalPrice{{ $walkOrder->id }}"
                                                    data-price="{{ $walkOrder->price }}">{{ $walkOrder->price }}</span>
                                            </td>
                                            <td class="inc-dec">
                                                <button class="btn value-button" id="decrease{{ $walkOrder->id }}"
                                                    onclick="decreaseValue({{ $walkOrder->id }})"
                                                    value="Decrease Value">-</button>

                                                <input style="width: 4cm;" class="form-control quantity-input"
                                                    type="number" name="quantity" min="1"
                                                    max="{{ $walkOrder->stock }}" id="number{{ $walkOrder->id }}"
                                                    value="{{ $walkOrder->quantity }}"
                                                    oninput="updateTotalPrice({{ $walkOrder->id }}); checkQuantity(this, {{ $walkOrder->stock }})" />

                                                <button class="btn value-button" id="increase{{ $walkOrder->id }}"
                                                    onclick="increaseValue({{ $walkOrder->id }})"
                                                    value="Increase Value">+</button>
                                                <div id="quantityMessage" style="color: red;"></div>
                                            </td>
                                            <td>{{ $walkOrder->discount_percentage }}</td>
                                            <td><span
                                                    id="totalPrice{{ $walkOrder->id }}">{{ $walkOrder->original_price }}</span>
                                            </td>
                                            <td>
                                                <a class="button button-danger "
                                                    href="{{ url('/remove_order_walkIn', $walkOrder->id) }}">
                                                    <button class="btn fa-btn">

                                                        <i class="fa fa-trash"></i>
                                                    </button></a>

                                                <button type="submit" class="btn fa-btn">
                                                    <i class="fa fa-upload"></i>
                                                </button>
                                            </td>

                                        </tr>
                                    </form>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                    <div class="final-calculation">
                        <table class="table">
                            <tbody>
                                <tr class="table-row">
                                    <td>
                                        <table class="table mini-table mb-0">
                                            <tbody>
                                                <tr class="table-row">
                                                    <td>Total Item: <span>{{ $item_walkOrderss }}</span></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>Over All Orignal Price</td>
                                    <td>₱ <span>{{ $total_original }}</span></td>
                                </tr>

                                <tr class="table-row">
                                    <td></td>
                                    <td>Total Quantity</td>
                                    <td><span>{{ $total_quantity }}</span></td>


                                </tr>


                                <tr class="table-row">
                                    <td></td>
                                    <td>Total Payable</td>
                                    <td>₱ <span>{{ $total_price }}</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="bottom-area-btns">
                    {{-- <button class="btn btn-1 calculator-btn" type="button"><i class="fa fa-calculator"></i>
                        Calculator</button>
                    <button class="btn btn-green" type="button" data-toggle="modal" data-target="#"><i
                            class="fa fa-keyboard-o"></i> Keyboard</button>
                    <button class="btn btn-3" type="button" data-toggle="modal" data-target="#holdSaleModal"><i
                            class="fa fa-folder-open"></i> Hold Sales</button>
                    <button class="btn btn-4" type="button" data-toggle="modal" data-target="#"><i
                            class="fa fa-times-circle"></i> Cancel</button> --}}
                    {{-- <button class="btn btn-yellow" type="button" data-toggle="modal" data-target="#holdBox"><i
                            class="fa fa-hand-rock-o"></i> Hold</button> --}}
                    <button class="btn btn-6" type="button" data-toggle="modal" data-target="#paymentModal"><i
                            class="fa fa-credit-card"></i> Payment</button>
                    {{-- <button class="btn btn-7" type="button" data-toggle="modal" data-target="#holdBox"><i
                            class="fa fa-hand-rock-o"></i> Hold</button> --}}
                </div>
            </div>
            <!-- ============================== PRODUCT AREA START ============================== -->
            <div id="productArea" class="col-xl-6 px-1">
                <div class="top-area-btns d-none d-xl-block">
                    <div class="right-part">
                        <button class="btn btn-green" type="button" data-toggle="modal"
                            data-target="#allSaleModal"><i class="fa fa-history"></i> <span>Your all
                                sales</span></button>
                        <button class="btn btn-green" type="button">
                            <a style="width: 100%;padding-right:2px; display:block; color:white;"
                                href="{{ url('/redirect') }}"> <i class="fa fa-tachometer"></i>
                                <span>Dashboard</span></a></button>

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button class="btn btn-green" type="submit"><i class="fa fa-sign-out"></i>
                                <span>{{ __('Log out') }}</span></button>
                        </form>



                    </div>
                </div>
                <div class="product-area">
                    <div style="" class="accesories">

                        <div class="item-area">
                            <div class="item-top-area top-area">

                                <div class="edit-icon">
                                    <button class="btn fa-btn" type="button" data-toggle="modal"
                                        data-target="#addItemBox"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="item-area-box row mx-0">

                                @foreach ($product as $productDB)
                                    <div class="col-6 col-md-3 px-1">

                                        <div class="item-box mt-0 text-center" data-toggle="modal"
                                            data-target="#productBox">
                                            <div class="txt-box">
                                                <span>{{ $productDB->price }}</span>
                                            </div>
                                            <div class="img-box">
                                                <img src="/product/{{ $productDB->image }}" class="img-fluid"
                                                    alt="">
                                            </div>
                                            <div class="txt-box item-name">
                                                <span>{{ $productDB->title }}</span>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!--==========================================================================-->
    <div class="modal fade" id="exampleModal" data-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modal title</h4>
                    <button type="button" class="btn close" data-dismiss="modal"><i
                            class="fa fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn">Add to cart</button>
                    <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <!-- ============================== EDIT MODAL ============================== -->
    <div class="modal fade" id="editModal" data-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modal title</h4>
                    <button type="button" class="btn close" data-dismiss="modal"><i
                            class="fa fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn">Save changes</button>
                    <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <!-- ============================== CUSTOMER MODAL ============================== -->
    <div class="modal fade" id="addCustomer" data-backdrop="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add customer</h4>
                    <button type="button" class="btn close" data-dismiss="modal"><i
                            class="fa fa-times"></i></button>
                </div>
                <form action="{{ url('walkinName') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Name:</label>
                                <input type="text" name="walkinName" class="form-control" placeholder="">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn">Save changes</button>
                        <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- ============================== EDIT CUSTOMER MODAL ============================== -->
    <div class="modal fade" id="editCustomer" data-backdrop="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit customer</h4>
                    <button type="button" class="btn close" data-dismiss="modal"><i
                            class="fa fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Name:</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Phone:</label>
                                <input type="number" class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Father's name:</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Email:</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Previous due:</label>
                                <input type="email" class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Date of birth:</label>
                                <input type="text" class="form-control datepicker" placeholder="DD-MM-YYYY">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Group:</label>
                                <select class="form-control" id="editable-select">
                                    <option selected>Aprilia</option>
                                    <option>Ktm</option>
                                    <option>MVagusta</option>
                                    <option>Ducati</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Delivery address:</label>
                                <input type="email" class="form-control" placeholder="">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn">Save changes</button>
                    <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <!-- ============================== PRODUCT ADD MODAL ============================== -->
    <div class="modal fade" id="productBox" data-backdrop="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">product name</h4>
                    <button type="button" class="btn close" data-dismiss="modal"><i
                            class="fa fa-times"></i></button>
                </div>
                <div class="modal-body">
                    @foreach ($product as $productDetails)
                        <form action="{{ url('walkInOrder', $productDetails->id) }}" method="POST">
                            @csrf
                            <div class="current-stock mb-4">
                                <p class="">Current Stock: <span>{{ $productDetails->stock }}</span></p>
                            </div>
                            <div class="current-stock mb-4">
                                <p class="">Product Name: <span>{{ $productDetails->title }}</span></p>
                            </div>
                            <div class="current-stock mb-4">
                                <p class="">Product Description: <span>{{ $productDetails->description }}</span>
                                </p>
                            </div>
                            <div class="current-stock mb-4">
                                <p class="">Product Price: <span>{{ $productDetails->price }}</span></p>
                            </div>
                            <div class="current-stock mb-4">
                                <p class="">Orginal Price: <span>{{ $productDetails->original_price }}</span>
                                </p>
                            </div>
                            <div class="current-stock mb-4">
                                <p class="">Discount: <span>{{ $productDetails->discount_percentage }}</span>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn">Add Cart</button>
                                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    @endforeach

                </div>

            </div>
        </div>
    </div>


    <!-- ============================== ALERT BOX MODAL ============================== -->
    <div class="modal fade text-center" id="alertBox" data-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Alert!</h4>
                </div>
                <div class="modal-body">
                    <span>Modal body text goes here.</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn mx-auto" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>


    <!-- ============================== TYPE A NOTe MODAL ============================== -->
    <div class="modal fade text-center" id="typeNoteBox" data-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Type a note!</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group mb-0">
                            <input type="text" class="form-control" placeholder="Write a note">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="btns mx-auto">
                        <button type="button" class="btn">OK</button>
                        <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- ============================== PAYMENT HOLD MODAL ============================== -->
    <div class="modal fade text-center" id="holdBox" data-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hold!</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group mb-0">
                            <input type="text" class="form-control" placeholder="Hold number">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="btns mx-auto">
                        <button type="button" class="btn">Submit</button>
                        <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- ============================== ADD ITEM MODAL ============================== -->
    <div class="modal fade" id="addItemBox" data-backdrop="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add item</h4>
                    <button type="button" class="btn close" data-dismiss="modal"><i
                            class="fa fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/add_product') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4 col-sm-6">
                                <label for="">Category:</label>
                                <select class="form-control" id="editable-select">
                                    @foreach ($category as $category)
                                        <option value="">{{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4 col-sm-6">
                                <label for="">Name:</label>
                                <input type="text" name="title" class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-4 col-sm-6">
                                <label for="">Product Description :</label>
                                <input class="form-control" type="text" name="description" id=""
                                    placeholder="Write a Description " required="">
                            </div>

                            <div class="form-group col-md-4 col-sm-6">
                                <label for="">Product Stock :</label>
                                <input class="form-control" type="number" min="0" name="stock"
                                    id="" placeholder="Write a Stock " required="">
                            </div>
                            <div class="form-group col-md-4 col-sm-6">
                                <label for="">Product Discount :</label>
                                <input class="form-control" type="number" min="1" name="discount_price"
                                    id="" placeholder="Write a Price " required="">
                            </div>

                            <div class="form-group col-md-4 col-sm-6">
                                <label for="">Product Price :</label>
                                <input class="form-control" type="number" min="1" name="price"
                                    id="" placeholder="Write a Price " required="">
                            </div>

                            <div class="form-group col-md-4 col-sm-6">
                                <label for="">Product Quantity :</label>
                                <input class="form-control" type="number" min="0" name="quantity"
                                    id="" placeholder="Write a Quantity " required="">
                            </div>
                            <div class="div_design">
                                <label for="">Product Image Here :</label>
                                <br>

                                <input type="file" name="image">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn">Add item</button>
                                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- ============================== PAYMENT MODAL ============================== -->
    <div class="modal fade" id="paymentModal" data-backdrop="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Complete payment</h4>
                    <button type="button" class="btn close" data-dismiss="modal"><i
                            class="fa fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <div class="part1">
                        <p>Over All Price <span>{{ $total_original }}</span></p>
                        <p>Orer Quantity <span>{{ $total_quantity }}</span></p>
                        <p>Total payable <span>{{ $total_price }}</span></p>
                    </div>
                    <hr>
                </div>


                <form method="POST" action="{{ url('delivery') }}"> <!-- Changed to a POST form -->
                    @csrf <!-- Add a CSRF token for security -->
                    <div class="form-row">
                        <div class="form-group col-6 col-lg-3">
                           <label for="">Name:</label>
                           <input type="text" name="name" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-6 col-lg-3">
                           <label for="">Email:</label>
                           <input type="text" name="email" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-6 col-lg-3">
                           <label for="">Address:</label>
                           <input type="text" name="address" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-6 col-lg-3">
                           <label for="">Phone:</label>
                           <input type="number" name="phone" class="form-control" placeholder="">
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="submit" class="btn">Purchase</button>
                        <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                     </div>
                </form>

            </div>
        </div>
    </div>


    <!-- ============================== HOLD SALE MODAL ============================== -->
    {{-- <div class="modal fade" id="holdSaleModal" data-backdrop="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hold sale</h4>
                    <button type="button" class="btn close" data-dismiss="modal"><i
                            class="fa fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-5 hold-sale-table">
                            <table class="table table01 mb-lg-0">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table-row" type="button">
                                        <td>1</td>
                                        <td>Walk-in customer</td>
                                        <td>31-12-2020</td>
                                    </tr>
                                    <tr class="table-row" type="button">
                                        <td>1</td>
                                        <td>Walk-in customer</td>
                                        <td>31-12-2020</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-7 hold-sale-details">
                            <h5 class="text-center">Sale details</h5>
                            <p class="my-3"><b>Customer:</b> Walk-in-customer</p>
                            <table class="table table02 mb-0">
                                <thead class="">
                                    <tr>
                                        <th scope="col">Item</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Qty/Amt</th>
                                        <th scope="col">Discount</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table-row">
                                        <td>AMD Ryzen 5 3600 Processor</td>
                                        <td>16,800 tk</td>
                                        <td>10 kg</td>
                                        <td>10%</td>
                                        <td>15,120</td>
                                    </tr>
                                    <tr class="table-row">
                                        <td>AMD Ryzen 5 3600 Processor</td>
                                        <td>16,800 tk</td>
                                        <td>10 kg</td>
                                        <td>10%</td>
                                        <td>15,120</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="sec-final-calculation">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr class="table-row">
                                            <td>Total Item: <span>0</span></td>
                                            <td>Sub Total</td>
                                            <td>tk <span>0.00</span></td>
                                        </tr>
                                        <tr class="table-row">
                                            <td></td>
                                            <td>Discount</td>
                                            <td>tk <span>0.00</span></td>
                                        </tr>
                                        <tr class="table-row">
                                            <td></td>
                                            <td>Total Discount</td>
                                            <td>tk <span>0.00</span></td>
                                        </tr>
                                        <tr class="table-row">
                                            <td></td>
                                            <td>Shipping/Other</td>
                                            <td>tk <span>0.00</span></td>
                                        </tr>
                                        <tr class="table-row">
                                            <td></td>
                                            <td>Total Payable</td>
                                            <td>tk <span>0.00</span></td>
                                        </tr>
                                        <tr class="table-row">
                                            <td></td>
                                            <td>Paid amount</td>
                                            <td>tk <span>0.00</span></td>
                                        </tr>
                                        <tr class="table-row">
                                            <td></td>
                                            <td>Due amount</td>
                                            <td>tk <span>0.00</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-lg-5 px-0 pr-lg-3 mb-3 mb-lg-0">
                            <button type="button" class="btn">Delete all hold sales</button>
                        </div>
                        <div class="col-lg-7 px-0 pl-lg-3">
                            <div class="bottom-area-btns text-center">
                                <button type="button" class="btn">Edit in cart</button>
                                <button type="button" class="btn">Delete</button>
                                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    <!-- ============================== YOUR ALL SALES MODAL ============================== -->
    <div class="modal fade" id="allSaleModal" data-backdrop="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Your all sales</h4>
                    <button type="button" class="btn close" data-dismiss="modal"><i
                            class="fa fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-5 hold-sale-table">
                            <table class="table table01 mb-lg-0">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($walkOrders as $walkOrder)
                                        <tr class="table-row" type="button">
                                            <td>{{ $walkOrder->id }}</td>
                                            <td>Walk-In</td>
                                            <td>{{ $walkOrder->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-7 hold-sale-details">

                            <h5 class="text-center">Sale details</h5>
                            <p class="mt-3"><b>Order no:</b> <span>000</span></p>
                            <p class="mb-3"><b>Customer:</b> <span>Walk-in-customer</span></p>
                            <table class="table table02 mb-0">
                                <thead class="">
                                    <tr>
                                        <th scope="col">Item</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Qty/Amt</th>
                                        <th scope="col">Discount</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($walkOrders as $walkOrder)
                                        <tr class="table-row">
                                            <td>{{ $walkOrder->product_title }}</td>
                                            <td>{{ $walkOrder->price }}</td>
                                            <td>{{ $walkOrder->quantity }}</td>
                                            <td>{{ $walkOrder->discount_percentage }}%</td>
                                            <td>{{ $walkOrder->total_price }}</td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-lg-5 px-0 pr-lg-3 mb-3 mb-lg-0">
                        </div>
                        {{-- <div class="col-lg-7 px-0 pl-lg-3">
                            <div class="bottom-area-btns">
                                <button type="button" class="btn">Print invoice</button>
                                <button type="button" class="btn">Delete</button>
                                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('admin/pos/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/pos/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/pos/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin/pos/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('admin/pos/js/jquery-editable-select.min.js') }}"></script>
    <script src="{{ asset('admin/pos/js/calculate.js') }}"></script>
    <script src="{{ asset('admin/pos/js/style.js') }}"></script>
    <script type="text/javascript">
        function increaseValue(id) {
            var quantityInput = document.getElementById('number' + id);
            var value = parseInt(quantityInput.value, 10);
            value = isNaN(value) ? 0 : value;
            value++;
            quantityInput.value = value;
            updateTotalPrice(id);
        }

        function decreaseValue(id) {
            var quantityInput = document.getElementById('number' + id);
            var value = parseInt(quantityInput.value, 10);
            value = isNaN(value) ? 0 : value;
            value < 1 ? value = 1 : '';
            value--;
            quantityInput.value = value;
            updateTotalPrice(id);
        }

        function checkQuantity(input, availableStock) {
            var enteredQuantity = parseInt(input.value);
            var quantityMessage = document.getElementById('quantityMessage');

            if (enteredQuantity > availableStock) {
                input.value = availableStock; // Limit the input to available stock
                quantityMessage.textContent = 'Quantity exceeds available stock';
            } else {
                quantityMessage.textContent = ''; // Clear the error message
            }
        }
        // function updateTotalPrice(id) {
        //     var quantityInput = document.getElementById('number' + id);
        //     var totalPriceElement = document.getElementById('totalPrice' + id);
        //     var pricePerItem = parseFloat(totalPriceElement.dataset.price); // Get the price per item from a data attribute

        //     var quantity = parseInt(quantityInput.value, 10);
        //     quantity = isNaN(quantity) ? 0 : quantity;

        //     var total = quantity * pricePerItem;
        //     totalPriceElement.textContent = total.toFixed(2); // Update the total price with 2 decimal places
        // }
    </script>

</body>

</html>
