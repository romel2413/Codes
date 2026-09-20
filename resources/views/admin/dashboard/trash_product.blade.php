<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<head>
    @include('admin.css')

    <style type="text/css">
        .center {
            margin: auto;
            width: 90%;
            text-align: center;
            margin-top: 40px;
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

        th,
        td {
            padding: 1rem;
            /* Add padding here */
            text-align: left;
        }

        .font_size {
            font-size: 30px;
            padding-bottom: 40px;
            text-align: center;
        }

        .image_size {
            max-width: 150px;
            height: auto;
            margin: 0 auto;
            /* Center images horizontally */
        }

        .th_color {
            background: rgb(0, 6, 95);
            /* Change the background color here */
            color: rgb(255, 255, 255);
        }

        .th_deg {
            padding: 20px;
            border: 2px solid white;
            border-radius: 10px;
            /* Rounded corners for table headers */
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


        td {
            background-color: dark rgba(0, 0, 255, 0.411);
            /* Change the background color here */
            text-align: center;
            /* Center text within table cells */
            /* Rounded corners for table cells */
            padding: 10px;
            /* Adjust padding as needed */
        }

        .td_color {
            color: rgb(0, 0, 0);
        }

        @media (max-width: 768px) {
            .center {
                width: 100%;
            }

            .font_size {
                font-size: 25px;
                padding-bottom: 20px;
            }

            .th_deg {
                padding: 15px;
            }

            .image_size {
                max-width: 100px;
            }

        }

        .content-wrapper {
            background: #13d0ffa4;
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

        .table__header .input-group:hover {
            width: 45%;
            background-color: #fff8;
            box-shadow: 0 .1rem .4rem #0002;
        }

        .table__header .input-group img {
            width: 1.2rem;
            height: 1.2rem;
        }

        .table__header .input-group input {
            width: 100%;
            padding: 0 .5rem 0 .3rem;
            background-color: transparent;
            border: none;
            outline: none;
        }

        .table__header .input-group {
            width: 35%;
            height: 100%;
            background-color: #fff5;
            padding: 0 .8rem;
            border-radius: 2rem;

            display: flex;
            justify-content: center;
            align-items: center;

            transition: .2s;
        }

        main.table_main {
            width: 100%;
            height: 100%;
            background-color: #fff5;
            width: 100%;
            backdrop-filter: blur(7px);
            box-shadow: 0 .4rem .8rem #0005;
            border-radius: .8rem;

            overflow: hidden;
        }

        .table__body {
            width: 95%;
            max-height: calc(89% - 1.6rem);
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

        table,
        th,
        td {
            border-collapse: collapse;
            padding: 1rem;
            text-align: left;
        }

        table {
            width: 100%;
        }

        thead {
            display: table-header-group;
            vertical-align: middle;
            border-color: inherit;
            width: 100%;
        }

        thead th:hover {
            color: #6c00bd;
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

        tbody tr:nth-child(even) {
            background-color: #fdfdfdb6;
        }

        tbody tr {
            --delay: .1s;
            transition: .5s ease-in-out var(--delay), background-color 0s;
        }

        tbody tr.hide {
            opacity: 0;
            transform: translateX(100%);
        }

        tbody tr:hover {
            background-color: rgba(148, 147, 147, 0.363) !important;
        }

        tbody tr td,
        tbody tr td p,
        tbody tr td img {
            transition: .2s ease-in-out;
        }

        tbody tr.hide td,
        tbody tr.hide td p {
            padding: 4%;
            font: 0 / 0 sans-serif;
            transition: .2s ease-in-out .5s;
        }

        tbody tr.hide td img {
            width: 0;
            height: 0;
            transition: .2s ease-in-out .5s;
        }

        .content-wrapper {
            background: #13d0ffa4;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(255, 255, 255, 0.479);
        }

        .modal-content {
            background-color: #ffffffa4;
            margin: 10% auto;
            padding: 20px;

            border: 1px solid #888;
            max-width: 400px;
            /* Adjust the width as needed */
            border-radius: 10px;
        }

        .close {
            float: right;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            color: rgb(4, 0, 255);
            /* Change the text color to blue */
        }

        .close:hover {
            color: red;
        }

        .form-group:hover {
            color: rgb(255, 255, 255);
        }

        .form-group {
            color: rgb(255, 255, 255);
        }

        label {
            color: rgb(0, 0, 0);
            /* Change the label text color to blue */
        }

        .form-control {
            color: rgb(0, 0, 0);
        }

        .form-control:hover {
            color: rgb(255, 255, 255);
            /* Change the input text color on hover to blue */
            /* You can also add other hover styles here, such as background-color or border */
        }

        @media (min-width: 768px) {
            .modal-content {
                width: 60%;
                /* Adjust the width as needed */
            }

            .div_design {
                width: 50%;
                /* Adjust the width as needed */
                display: inline-block;
                margin-right: 20px;
                /* Add spacing between elements */
            }
        }

        /* Adjustments for smaller screens */
        @media (max-width: 767px) {
            .modal-content {
                width: 90%;
                /* Adjust the width as needed */
            }

            .div_design {
                width: 100%;
                /* Full width for smaller screens */
                display: block;
                margin-bottom: 10px;
                /* Add spacing between elements */
            }
        }

        .text_color {
            width: 100%;
            color: black;
        }
    </style>

</head>

<body>
    <div class="container-scroller">
        @include('admin.sidebar')
        <div class="container-fluid page-body-wrapper">
            @include('admin.navbar')
            <div class="main-panel">
                <div class="content-wrapper">
                    <main class="table_main">
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        <section class="table__header">
                            <h2 class="font_size">All Trash Products</h2>

                        </section>

                        <div class="center">
                            <div class="table-responsive">
                                <section class="table__body">
                                    <table>
                                        <thead>
                                            <tr class="th_color">
                                                <th id="idHeader">ID<span
                                                        class="icon-arrow">&UpArrow;&DownArrow;</span></th>
                                                <th id="nameHeader">Product Title <span
                                                        class="icon-arrow">&UpArrow;&DownArrow;</th>
                                                <th>Description </th>
                                                <th>Quantity </th>
                                                <th>Category </th>
                                                <th>Price </th>
                                                <th>Original Price </th>
                                                <th>Discounted </th>
                                                <th>Stock </th>
                                                <th>Image </th>
                                                <th>Delete Forever </th>
                                                <th>Restore</th>
                                            </tr>
                                        </thead>
                                        @forelse ($product as $productDB)
                                            <tbody>
                                                <tr class="td_color">
                                                    <td>{{ $productDB->id }}</td>
                                                    <td>{{ $productDB->title }}</td>
                                                    <td>{{ $productDB->description }}</td>
                                                    <td>{{ $productDB->quantity }}</td>
                                                    <td>{{ $productDB->category }}</td>
                                                    <td>{{ $productDB->price }}</td>
                                                    <td>{{ $productDB->original_price }}</td>
                                                    <td>{{ $productDB->discount_percentage }}%</td>
                                                    <td>
                                                        @if ($productDB->stock == 0)
                                                            Out of Stock
                                                        @else
                                                            {{ $productDB->stock }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <img class="image_size" src="/product/{{ $productDB->image }}">
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-outline-danger"
                                                        onclick="deleteTransaction({{ $productDB->id }})"
                                                            href="#">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('restore_product', $productDB->id) }}">
                                                            <i class="fas fa-undo"></i> Restore
                                                        </a>
                                                    </td>

                                                </tr>
                                            </tbody>
                                            @empty
                                                <tr>
                                                    <td style="color: black;" colspan="16">
                                                        EMPTY
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
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Add event listener to the "ID" column header
                var idHeader = document.getElementById("idHeader");
                idHeader.addEventListener("click", function() {
                    toggleSortDirection("idHeader");
                    sortTable("idHeader", getSortDirection("idHeader"));
                });

                // Add event listener to the "Name" column header
                var nameHeader = document.getElementById("nameHeader");
                nameHeader.addEventListener("click", function() {
                    toggleSortDirection("nameHeader");
                    sortTable("nameHeader", getSortDirection("nameHeader"));
                });
            });

            function toggleSortDirection(column) {
                var table = document.querySelector("table");
                var header = document.getElementById(column);
                var newOrder = getSortDirection(column);
                header.setAttribute("data-sort-order", newOrder);
            }

            function getSortDirection(column) {
                var header = document.getElementById(column);
                var currentOrder = header.getAttribute("data-sort-order");
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
                        x = rows[i].querySelector("td:nth-child(" + (column === "nameHeader" ? "2" : "1") + ")");
                        y = rows[i + 1].querySelector("td:nth-child(" + (column === "nameHeader" ? "2" : "1") + ")");

                        // Compare values based on the clicked column
                        if (order === 'asc') {
                            if (column === 'idHeader') {
                                if (Number(x.textContent) > Number(y.textContent)) {
                                    shouldSwitch = true;
                                    break;
                                }
                            } else if (column === 'nameHeader') {
                                if (x.textContent.toLowerCase() > y.textContent.toLowerCase()) {
                                    shouldSwitch = true;
                                    break;
                                }
                            }
                            // Add similar comparisons for other columns
                        } else if (order === 'desc') {
                            if (column === 'idHeader') {
                                if (Number(x.textContent) < Number(y.textContent)) {
                                    shouldSwitch = true;
                                    break;
                                }
                            } else if (column === 'nameHeader') {
                                if (x.textContent.toLowerCase() < y.textContent.toLowerCase()) {
                                    shouldSwitch = true;
                                    break;
                                }
                            }
                            // Add similar comparisons for other columns
                        }
                    }

                    if (shouldSwitch) {
                        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                        switching = true;
                    }
                }
            }
            var modal = document.getElementById("addCustomerModal");
            var addCustomerButton = document.getElementById("addCustomerButton");
            var closeButton = document.getElementsByClassName("close")[0];

            // Open the modal when the button is clicked
            addCustomerButton.onclick = function() {
                modal.style.display = "block";
            }

            // Close the modal when the close button is clicked
            closeButton.onclick = function() {
                modal.style.display = "none";
            }

            // Close the modal when clicking outside the modal
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

            // Submit the form (you can add AJAX to handle form submission)
            var customerForm = document.getElementById("customerForm");
            customerForm.onsubmit = function(event) {
                event.preventDefault(); // Prevent the form from actually submitting
                // Add your code to handle form submission here
                modal.style.display = "none"; // Close the modal after submission
            }
            function deleteTransaction(id)
        {
            if(confirm("Are you sure want to delete it?")){
                window.location.href='{{ url("/delete-product-perma") }}/'+id
            }
        }
        </script>
        @include('admin.js')
    </body>

    </html>
