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
    <link rel="shortcut icon" href="{{ asset('home/images/logo.png') }}" type="">
    <title>Energized</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.css') }}" />
    <!-- font awesome style -->
    <link href="{{ asset('home/css/font-awesome.min.css') }}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{ asset('home/css/style.css') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('home/css/responsive.css') }}" rel="stylesheet" />

    <style type="text/css">
        .div_center {
            text-align: center;
        }

        .table_center {
            margin: auto;
            width: 50%;
            border: 2px solid rgb(14, 13, 13);
            text-align: center;
            margin-top: 40px;
        }

        .th_color {
            background: skyblue;
            border: 2px solid rgb(0, 0, 0);
        }

        .th_deg {
            padding: 30px;
            border: 2px solid rgb(0, 0, 0);
        }
    </style>



</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')


    </div>
    <div class="div_center" style="margin-top:20%;">
        @if (session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{ session()->get('message') }}
            </div>
        @endif
        <table class="table_center">
            <tr class="th_deg">
                <th class="th_color">Product Title</th>
                <th class="th_color">Quantity</th>
                <th class="th_color">Price</th>
                <th class="th_color">Payment Status</th>
                <th class="th_color">Delivery Status</th>
                <th class="th_color">Image</th>
                <th class="th_color">Function</th>
            </tr>
            @foreach ($order as $order)
                <tr class="th_deg">
                    <td>{{ $order->product_title }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->price }}</td>
                    <td>{{ $order->payment_status }}</td>
                    <td>
                        @if ($order->delivery_status === 'Delivered')
                        <p style="color:blue">Delivered</p>
                        @elseif ($order->delivery_status === 'Processing')
                        <p style="color:green">Processing</p>
                        @elseif ($order->delivery_status === 'Cancelled')
                        <p style="color:red">Cancelled</p>
                        @elseif ($order->delivery_status === 'Pending')
                        <p style="color:rgba(224, 252, 70, 0.842)">Pending</p>
                        @endif
                    </td>
                    <td>

                        <img height="100" width="150" src="product/{{ $order->image }}" alt="">

                    </td>
                    <td>
                        @if ($order->delivery_status == 'processing')
                            <a onclick="return confirm('Are you sure to Cancel this Order?')"
                                class="btn btn-outline-danger" href="{{ url('cancel_order', $order->id) }}">Cancel
                                Order</a>
                        @else
                            <a onclick="return confirm('Do you want to delete it?')" class="btn btn-outline-primary"
                                href="{{ url('remove_order', $order->id) }}">Deleted</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    <!-- end header section -->
    {{-- <!-- why section -->
      @include('home.why')
      <!-- end why section -->

      <!-- arrival section -->
      @include('home.newArrival')
      <!-- end arrival section --> --}}

    <!-- subscribe section -->

    <!-- end subscribe section -->
    {{-- <!-- client section -->
      @include('home.client')
      <!-- end client section --> --}}
    <!-- footer start -->
    <!-- footer end -->

    <!-- jQery -->
    <script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
    <!-- popper js -->
    <script src="{{ asset('home/js/popper.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('home/js/bootstrap.js') }}"></script>
    <!-- custom js -->
    <script src="{{ asset('home/js/custom.js') }}"></script>
</body>

</html>
