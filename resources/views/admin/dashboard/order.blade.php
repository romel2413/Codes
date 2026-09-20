<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <style type="text/css">
        * {
            margin: 0;
            padding: 0;

            box-sizing: border-box;
            font-family: sans-serif;
        }

        .content-wrapper {
            background: #13d0ffa4;
        }

        .center {
            margin: auto;
            width: 100%;
            text-align: center;
            margin-top: 10px;
        }


        table {
            width: 100%;
        }

        .title_deg {
            text-align: center;
            font-size: 25px;
            font-weight: bold;
            padding-bottom: 20px;
        }



        .th_color {
            background-color: #00065f;
        }

        .img_size {
            width: 100%;
            height: 100%;
            object-fit: cover;
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

            .center {
                width: 100%;
            }

            .table_deg th,
            .table_deg td {
                padding: 5px;
            }
        }

        main {
            display: block;
        }

        main.main_table {
            width: 100%;
            height: 100%;
            background-color: #fff5;

            backdrop-filter: blur(7px);
            box-shadow: 0 .4rem .8rem #0005;
            border-radius: .8rem;

            overflow: hidden;
        }

        .table__header {
            width: 100%;
            height: 10%;
            background-color: #fff4;
            padding: .8rem 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table__header .input-group {
            width: 35%;
            height: 100%;
            background-color: #fff5;
            padding: 0 0.8rem;
            border-radius: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: .2s;
        }

        .table__header .input-group:hover {
            width: 45%;
            background-color: #fff8;
            box-shadow: 0 .1rem .4rem #0002;
        }

        .table__header .input-group i {
            width: 1.2rem;
            height: 1.2rem;
        }

        .table__header .input-group input {
            width: 70%;
            padding: 0 0.5rem 0 0.3rem;
            background-color: transparent;
            border: none;
            outline: none;
        }

        .table__body {
            width: 95%;
            max-height: 700px;
            background-color: #fffb;
            margin: 0.8rem auto;
            border-radius: 0.6rem;
            overflow: auto;
            overflow: overlay;
        }

        .table__body::-webkit-scrollbar {
            width: 0.5rem;
            height: 0.5rem;
        }

        .table__body::-webkit-scrollbar-thumb {
            border-radius: .5rem;
            background-color: #0004;
            visibility: hidden;
        }

        .table__body:hover::-webkit-scrollbar-thumb {
            visibility: visible;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            opacity: 10px;
            border-radius: 10px;
            overflow: hidden;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            opacity: 10px;
            border-radius: 10px;
            /* Rounded corners for the table */
            overflow: hidden;
            /* Hide the overflowing borders */
        }

        body {
            min-height: 100vh;
            justify-content: center;
            align-items: center;
        }

        th,
        td {
            padding: 1rem;
            /* Add padding here */
            text-align: left;
        }

        .td_color {
            color: rgb(0, 0, 0);
        }

        thead th:hover {
            color: #6c00bd;
        }

        thead th.active,
        tbody td.active {
            color: #6c00bd;
        }

        thead th {
            position: sticky;
            top: 0;
            left: 0;
            cursor: pointer;
            text-transform: capitalize;
        }

        thead th span.icon-arrow {
            display: inline-block;
            width: 1.3rem;
            height: 2rem;
            border-radius: 50%;
            border: 1.4px solid transparent;

            text-align: center;
            font-size: 1rem;

            margin-left: .5rem;
            transition: .2s ease-in-out;
        }

        thead th:hover span.icon-arrow {
            border: 1.4px solid #6c00bd;
        }

        thead th.active span.icon-arrow {
            background-color: #6c00bd;
            color: #fff;
        }

        thead th.asc span.icon-arrow {
            transform: rotate(180deg);
        }

        .status {
            padding: .4rem 0;
            border-radius: 2rem;
            text-align: center;
        }

        .status.delivered {
            background-color: #6fcaea
        }

        .status.processing {
            background-color: #86e49d;
        }

        .status.cancelled {
            background-color: #d893a3;
        }

        .status.pending {
            background-color: rgba(255, 255, 0, 0.185);
        }

        .img_circle {
            width: 100px;
            /* Adjust the width and height as needed */
            height: 100px;
            border-radius: 50%;
            /* This makes the image circular */
            overflow: hidden;
        }

        .buttonss {
            margin: auto;
            padding-left: 55px;
            padding-top: 30px;
        }

        .dropdown-item:hover {
            background-color: #3a5eff;
            color: #ffffff;
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
                    <main class="main_table">
                        <section class="table__header">
                            <h1 class="title_deg">All Order</h1>

                            {{-- <div class="input-group">

                                <input type="search" name="search" placeholder="Search for something">
                                <form action="{{ url('search') }}" method="GET">
                                    @csrf
                                    <input type="submit" value=""  class="fas fa-outline-search"
                                        name="" id="">
                                </form>
                            </div> --}}



                            {{-- <input type="hidden" name="order_ids" id="order-ids-input">
                                <button type="submit" class="btn btn-danger">Delete Selected</button> --}}


                        </section>
                        <div class="buttonss">

                            <a href="#" style="
                            border-radius: 5rem;"
                                class="btn btn-outline-danger" id="deleteAllSelectedRecord"> <i
                                    class="fas fa-trash"></i>DELETE</a><br>
                            
                            {{-- <button onclick="sortTable('id', 'asc')">Sort by ID Ascending</button>
                            <br>
                            <button onclick="sortTable('id', 'desc')">Sort by ID Descending</button> --}}

                        </div>


                        <div class="center">

                            <div class="table-responsive">

                                <section class="table__body">

                                    <table>

                                        <thead>
                                            <tr class="th_color">
                                                <th>
                                                    <input type="checkbox" name="" id="select_all_ids">
                                                </th>
                                                <th data-sort-column="id" data-sort-order="asc"
                                                    onclick="toggleSortDirection('id')">ID<span
                                                        class="icon-arrow">&UpArrow;&DownArrow;</span>
                                                </th>

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
                                            </tr>

                                        </thead>
                                        @forelse ($order as $order)
                                            <tbody>

                                                <tr class="td_color" id="employee_ids{{ $order->id }}">

                                                    <td>
                                                        <input type="checkbox" name="ids" class="checkbox-ids"
                                                            value="{{ $order->id }}"
                                                            data-order-id="{{ $order->id }}">
                                                    </td>
                                                    <th>{{ $order->id }}</th>
                                                    <td>{{ $order->name }}</td>
                                                    <td>{{ $order->email }}</td>
                                                    <td>{{ $order->address }}</td>
                                                    <td>{{ $order->phone }}</td>
                                                    <td>{{ $order->product_title }}</td>
                                                    <td>{{ $order->quantity }}</td>
                                                    <td>{{ $order->price }}</td>
                                                    <td>{{ $order->payment_status }}</td>
                                                    <td>
                                                        @if ($order->delivery_status == 'Delivered')
                                                            <p class="status delivered" style="color:blue">Delivered</p>
                                                        @elseif ($order->delivery_status == 'Processing')
                                                            <p class="status processing" style="color:green">processing
                                                            </p>
                                                        @elseif ($order->delivery_status == 'Pending')
                                                            <p class="status pending" style="color: rgb(255, 255, 0)">
                                                                Pending
                                                            </p>
                                                        @else
                                                            <p class="status cancelled" style="color:red">Cancelled</p>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <div class="img_circle">
                                                            <img class="img_size" src="/product/{{ $order->image }}"
                                                                alt="">
                                                        </div>
                                                    </td>

                                                    <td>
                                                        @if ($order->delivery_status == 'Pending')
                                                            <div class="dropdown">
                                                                <button class="btn btn-outline-primary dropdown-toggle"
                                                                    type="button" id="statusDropdown"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    Change Status
                                                                </button>
                                                                <div class="dropdown-menu"
                                                                    aria-labelledby="statusDropdown">
                                                                    <a href="{{ url('update_delivery_status', ['id' => $order->id, 'status' => 'processing']) }}"
                                                                        class="dropdown-item"
                                                                        onclick="return confirm('Are you sure this product is processing?')">Processing</a>
                                                                    <a href="{{ url('update_delivery_status', ['id' => $order->id, 'status' => 'cancelled']) }}"
                                                                        class="dropdown-item"
                                                                        onclick="return confirm('Do you want to cancel the order?')">Cancel</a>
                                                                </div>
                                                            </div>
                                                        @elseif ($order->delivery_status == 'Delivered')
                                                            <p style="color: blue">Delivered</p>
                                                        @elseif ($order->delivery_status == 'Processing')
                                                            <div class="dropdown">
                                                                <button class="btn btn-outline-success dropdown-toggle"
                                                                    type="button" id="statusDropdown"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    Change Status
                                                                </button>
                                                                <div class="dropdown-menu"
                                                                    aria-labelledby="statusDropdown">
                                                                    <a href="{{ url('update_delivery_status', ['id' => $order->id, 'status' => 'delivered']) }}"
                                                                        class="dropdown-item"
                                                                        onclick="return confirm('Are you sure this product was delivered?')">Delivered</a>
                                                                    <a href="{{ url('update_delivery_status', ['id' => $order->id, 'status' => 'cancelled']) }}"
                                                                        class="dropdown-item"
                                                                        onclick="return confirm('Do you want to cancel the order?')">Cancel</a>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <p style="color: red">Cancel</p>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-outline-danger dropdown-toggle"
                                                                type="button" id="deleteDropdown"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                Actions
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="deleteDropdown">
                                                                <a class="dropdown-item"
                                                                    href="{{ url('/delete_order', $order->id) }}"
                                                                    onclick="return confirm('Are You Sure To Delete This?)'"><i
                                                                        class="fas fa-trash-alt"> </i> Delete</a>
                                                                <a class="dropdown-item"
                                                                    href="{{ url('print_pdf', $order->id) }}"><i
                                                                        class="fas fa-file-pdf"></i> Print PDF</a>
                                                                <a class="dropdown-item"
                                                                    href="{{ url('send_email', $order->id) }}"><i
                                                                        class="fas fa-envelope"></i> Send Email</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                            </tbody>
                                        @empty
                                            <tr>
                                                <td colspan="16">
                                                    No Data Found
                                                </td>
                                            </tr>
                                        @endforelse
                                    </table>
                                </section>

                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"></script>
    <!-- container-scroller -->
    <script>
        // Add event listeners to all "Delivered" buttons
        document.querySelectorAll('[id^="deliveredButton-"]').forEach(function(button) {
            button.addEventListener('click', function() {
                // Disable the button after clicking
                this.disabled = true;
            });
        });

        $(function(e) {
            $("#select_all_ids").click(function() {
                $('.checkbox-ids').prop('checked', $(this).prop('checked'));
            });

            $('#deleteAllSelectedRecord').click(function(e) {
                e.preventDefault();
                var confirmed = confirm('Are you sure you want to delete all selected records?');

                if (confirmed) { // Check if the user confirmed the deletion
                    var all_ids = [];
                    $('input:checkbox[name=ids]:checked').each(function() {
                        all_ids.push($(this).val());
                    });

                    $.ajax({
                        url: "{{ route('order.delete') }}",
                        type: "DELETE",
                        data: {
                            ids: all_ids,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $.each(all_ids, function(key, val) {
                                $('#employee_ids' + val).remove();
                            });

                            // Show the success message
                            $('#delete-message').fadeIn('fast').delay(3000).fadeOut('fast');
                        }
                    });
                }
            });
        });


        function toggleSortDirection(column) {
            var table = document.querySelector("table");
            var headerRow = table.querySelector("thead tr");
            var columnHeader = headerRow.querySelector('[data-sort-column="' + column + '"]');
            var newOrder = getSortDirection(column);
            columnHeader.setAttribute("data-sort-order", newOrder);
            sortTable(column, newOrder);
        }

        function getSortDirection(column) {
            var table = document.querySelector("table");
            var headerRow = table.querySelector("thead tr");
            var columnHeader = headerRow.querySelector('[data-sort-column="' + column + '"]');
            var currentOrder = columnHeader.getAttribute("data-sort-order");
            return currentOrder === 'desc' ? 'asc' : 'desc';
        }

        function sortTable(column, order) {
            var table, rows, switching, i, x, y, shouldSwitch;
            table = document.querySelector("table");
            switching = true;

            while (switching) {
                switching = false;
                rows = table.getElementsByTagName("tr");

                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].querySelector('[data-order-id]');
                    y = rows[i + 1].querySelector('[data-order-id]');

                    // Compare values and set the shouldSwitch flag
                    if (order === 'asc') {
                        if (Number(x.getAttribute('data-order-id')) > Number(y.getAttribute('data-order-id'))) {
                            shouldSwitch = true;
                            break;
                        }
                    } else if (order === 'desc') {
                        if (Number(x.getAttribute('data-order-id')) < Number(y.getAttribute('data-order-id'))) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }

                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                }
            }
        }
    </script>
    <!-- plugins:js -->
    @include('admin.js')
</body>

</html>
