<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="{{ asset('home/images/favicon.png') }}" type="" />
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.css') }}" />
    <!-- font awesome style -->
    <link href="{{ asset('home/css/font-awesome.min.css') }}" rel="stylesheet" />
    <!-- Font Awesome CSS (Add this line) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('home/css/style.css') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('home/css/responsive.css') }}" rel="stylesheet" />

    <style type="text/css">
        .center {
            margin: auto;
            width: 80%;
            text-align: center;
            margin-top: 2%;
        }

        table {
            width: 80%;
            margin: 0;
        }

        th,
        td {
            border: 2px solid rgb(19, 17, 17);
            text-align: center;
            justify-content: center;
            padding-top: 100px;
            place-items: center;
        }

        .td_deg {
            font-size: 30px;
            padding: 5px;
            background: skyblue;
            justify-content: center;
            vertical-align: middle;
            /* Center text vertically */
            align-items: center;
            /* Center content horizontally */
        }

        thead th {
            border: 2px solid black;
            /* Set the border for thead */
            justify-content: center;
            text-align: center;
            vertical-align: middle;
            /* Center text vertically */
            align-items: center;
            /* Center content horizontally */
        }

        .img_deg {
            max-height: 200px;
            width: 100px;
            text-align: center;
            justify-content: center;
            vertical-align: middle;
            /* Center image vertically */
        }

        .total_deg {
            font-size: 20px;
            padding: 40px;
        }

        .hero_area {
            min-height: 10vh;
        }
    </style>
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
    </div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{ session()->get('message') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div id="quantityMessage" class="text-danger"></div>
    <div class="center">
        <div class="text-center">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="td_deg">Product Title</th>
                            <th class="td_deg">Product Quantity</th>
                            <th class="td_deg">Price</th>
                            <th class="td_deg">Image</th>
                            <th class="td_deg">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $totalprice = 0; ?>

                        @foreach ($cart as $carts)
                            <form action="{{ url('/update_cart', $carts->id) }}" method="POST">
                                @csrf
                                <tr>
                                    <td>{{ $carts->product_title }}</td>
                                    <td>
                                        <input type="number" name="quantity" min="1" max="{{ $carts->stock }}"
                                            oninput="checkQuantity(this, {{ $carts->stock }}, 'quantityMessage{{ $carts->id }}', 'cashOnDeliveryBtn')"
                                            id="quantityInput{{ $carts->id }}" value="{{ $carts->quantity }}"
                                            class="form-control">
                                        <div id="quantityMessage{{ $carts->id }}" class="text-danger"></div>
                                    </td>
                                    <td id="price{{ $carts->id }}">{{ $carts->price }}</td>
                                    <td><img class="img_deg" src="/product/{{ $carts->image }}"></td>
                                    <td>
                                        <a class="btn btn-outline-primary"
                                            onclick="return confirm('Are you to remove this product ')"
                                            href="{{ url('/remove_cart', $carts->id) }}">
                                            <i class="fas fa-trash "></i>
                                        </a>

                                        <button type="submit" class="btn btn-primary" required="">
                                            <i class="fas fa-sync-alt"></i> Update Product
                                        </button>
                                    </td>
                                </tr>
                                <?php $totalprice = $totalprice + $carts->price; ?>
                            </form>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div>
            <h1 class="total_deg">TOTAL PRICE: ₱{{ $totalprice }}</h1>
        </div>

        <div>
            <h1 style="font-size: 25px; padding-bottom: 15px">
                Proceed to Order
            </h1>

            <a href="{{ url('cash_order') }}" class="btn btn-danger" id="cashOnDeliveryBtn">Cash On Delivery</a>
            <a href="" class="btn btn-danger">Pay Using Card</a>
        </div>

    </div>

    <!-- jQuery -->
    <script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
    <!-- Popper.js -->
    <script src="{{ asset('home/js/popper.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('home/js/bootstrap.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ asset('home/js/custom.js') }}"></script>
    <script>
        function checkQuantity(input, availableStock, messageElementId, cashOnDeliveryBtnId) {
            var enteredQuantity = parseInt(input.value);
            var quantityMessage = document.getElementById(messageElementId);
            var cashOnDeliveryBtn = document.getElementById(cashOnDeliveryBtnId);

            if (enteredQuantity > availableStock) {
                input.value = availableStock; // Limit the input to available stock
                quantityMessage.textContent = 'Quantity exceeds available stock';
                cashOnDeliveryBtn.disabled = true; // Disable the "Cash On Delivery" button
            } else {
                quantityMessage.textContent = ''; // Clear the error message
                cashOnDeliveryBtn.disabled = false; // Enable the "Cash On Delivery" button
            }
        }
        
    </script>
</body>




