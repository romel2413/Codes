<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')

    <style type="text/css">
        .title_deg {
            text-align: center;
            font-size: 25px;
            font-weight: bold;
            padding-bottom: 20px;
        }

        .table_deg {
            border: 2px solid white;
            width: 100%;
            margin: auto;
            padding-top: 20px;
            text-align: center;
        }

        .th_deg {
            background-color: skyblue;
        }

        .img_size {
            width: 100px;
            height: 100px;
        }

        /* Add responsive styles using media queries */
        @media (max-width: 768px) {
            .title_deg {
                font-size: 20px;
            }

            .img_size {
                width: 80px;
                height: 80px;
            }

            .table_deg {
                font-size: 14px;
            }

            .table_deg th,
            .table_deg td {
                padding: 5px;
            }
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('admin.navbar')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <h1 class="title_deg">All Delivered</h1>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tr class="th_deg">
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Product title</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Payment Status</th>
                                <th>Delivery Status</th>
                                <th>Image</th>
                                <th>Delivered</th>
                                <th>Function</th>
                                <th>Print PDF</th>
                                <th>Send Email</th>
                            </tr>

                            @forelse ($order as $order)
                            @if ($order->delivery_status == 'Delivered')
                            <tr>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ $order->product_title }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->price }}</td>
                                <td>{{ $order->payment_status }}</td>
                                <td>
                                    @if ($order->delivery_status=='Delivered')
                                    <p style="color:blue">Delivered</p>

                                    @endif

                                <td>
                                    <img class="img_size" src="/product/{{ $order->image }}" alt="">
                                </td>
                                <td>
                                    @if ($order->delivery_status=='processing')
                                    <a href="{{ url('delivered',$order->id) }}" onclick="return confirm('Are you sure this product was delivered?')" class="btn btn-outline-primary">Delivered</a>
                                    @else
                                    <p style="color:green">Delivered</p>
                                    @endif
                                </td>
                                <td><a onclick="return confirm('Are You Sure To Delete This?')" class="btn btn-outline-danger" href="{{ url('/delete_order', $order->id) }}">Delete</a></td>
                                <td><a href="{{ url('print_pdf', $order->id) }}" class="btn btn-outline-secondary">Print PDF</a></td>
                                <td><a href="{{ url('send_email',$order->id) }}" class="btn btn-outline-info"> Send Email</a></td>
                            </tr>

                            @endif

                            @empty
                            <tr>
                                <td colspan="16">
                                    No Data Found
                                </td>
                            </tr>
                            @endforelse
                        </table>

                        <h1 class="title_deg">All Processing</h1>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tr class="th_deg">
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Product title</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Payment Status</th>
                                    <th>Delivery Status</th>
                                    <th>Image</th>
                                    <th>Delivered</th>
                                    <th>Function</th>
                                    <th>Print PDF</th>
                                    <th>Send Email</th>
                                </tr>


                            </table>
                    </div>
                </div>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.js')
</body>

</html>
