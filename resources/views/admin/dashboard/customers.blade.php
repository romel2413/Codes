<!DOCTYPE html>
<html lang="en">


<head>

    @include('admin.css')
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
        }

        .title_deg {
            text-align: center;
            font-size: 25px;
            font-weight: bold;
            padding-bottom: 50px;
        }



        .th_deg {
            background-color: skyblue;
        }

        .img_size {
            width: 100px;
            height: 100px;
        }

        .buttonskie {
            text-align: right;
            padding-top: 20px;
        }


        .text-success {
            color: green;
        }

        .text-primary {
            color: blue;
        }

        @media (max-width: 768px) {
            .title_deg {
                font-size: 20px;
                padding-bottom: 30px;
            }

            .buttonskie {
                text-align: center;
                padding-top: 10px;
            }

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
            padding: 0 .8rem;
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

        .table__header .input-group img {
            width: 1.2rem;
            height: 1.2rem;
        }

        .table__header .input-group input {
            width: 100%;
            padding: 0 0.5rem 0 0.3rem;
            background-color: transparent;
            border: none;
            outline: none;
        }

        .title_deg {
            text-align: center;
            font-size: 25px;
            font-weight: bold;
            padding-bottom: 20px;
        }

        .center {
            margin: auto;
            width: 90%;
            text-align: center;
            margin-top: 40px;
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

        table {
            width: 100%;
            /* width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            opacity: 10px;
            border-radius: 10px;
            overflow: hidden; */
        }

        .td_color {
            color: rgb(0, 0, 0);
        }

        /* table {
            border-collapse: collapse;
            width: 100%;
            opacity: 10px;
            border-radius: 10px; */
        /* Rounded corners for the table */
        /* overflow: hidden; */
        /* Hide the overflowing borders */
        /* } */

        .th_color {
            background-color: #00065f;
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

        @media (max-width: 1000px) {
            td:not(:first-of-type) {
                min-width: 12.1rem;
            }
        }

        thead th:hover {
            color: #6c00bd;
        }

        thead th.active,
        tbody td.active {
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

        thead th {
            position: sticky;
            top: 0;
            left: 0;
            cursor: pointer;
            text-transform: capitalize;
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
            padding: .5rem 0;
            border-radius: 2rem;
        }

        .status.EmailVerified {
            /* background-color: #86e49d; */
            color: green;
        }

        .status.NotVerified {
            /* background-color: #6fcaea; */
            color: blue;
        }

        .content-wrapper {
            background: #13d0ffa4;
        }

        /* Modal styles */
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
    </style>

</head>

<body class="bodydes">
    <div class="container-scroller">
        @include('admin.sidebar')
        <div class="container-fluid page-body-wrapper">
            @include('admin.navbar')
            <div class="main-panel">
                <div class="content-wrapper">
                    <main class="main_table">
                        <section class="table__header">

                            @if (session()->has('message'))
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">x</button>
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            <h1 class="title_deg">All Users</h1>
                            <a id="addCustomerButton" class="btn btn-primary" href="#">
                                <i class="fas fa-user-plus"></i> Add Customers
                            </a>
                            <div id="addCustomerModal" class="modal">
                                <div class="modal-content">
                                    <span class="close">&times;</span>
                                    <h2>Add Customer</h2>
                                    <form action="{{ url('/adding_customer') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Name:</label>
                                            <input class="form-control" type="text" name="name" id="name"
                                                placeholder="Enter Name" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input class="form-control" type="text" name="email" id="email"
                                                placeholder="Enter Email" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="usertype">User Type:</label>
                                            <select class="form-control" name="usertype" id="usertype" required>
                                                <option value="0">User</option>
                                                <option value="1">Admin</option>
                                                <option value="2">Cashier</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="phone">Phone:</label>
                                            <input class="form-control" type="number" min="1" name="phone"
                                                id="phone" placeholder="Enter Phone" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="address">Address:</label>
                                            <input class="form-control" type="text" min="0" name="address"
                                                id="address" placeholder="Enter Address" required>
                                        </div>

                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-primary">Add User</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </section>
                        <div class="center">


                            <div class="table-responsive">

                                <section class="table__body">


                                    <table id="table1">
                                        <thead>
                                            <tr class="th_color">
                                                <th id="idHeader" style="padding: 10px;">ID<span
                                                        class="icon-arrow">&UpArrow;&DownArrow;</span></th>
                                                <th id="nameHeader" style="padding: 10px;">Name<span
                                                        class="icon-arrow">&UpArrow;&DownArrow;</span>
                                                </th>
                                                <th style="padding: 10px;">Email
                                                </th>
                                                <th style="padding: 10px;">Address
                                                </th>
                                                <th style="padding: 10px;">Phone
                                                </th>
                                                <th style="padding: 10px;">Verified</th>
                                                <th style="padding: 10px;">Role</th>
                                                <th style="padding: 10px;">Send Email</th>
                                                <th style="padding: 10px;">Function</th>
                                            </tr>
                                        </thead>
                                        @foreach ($user as $user)
                                            @if ($user->usertype == '0')
                                                <tbody>
                                                    <tr class="td_color">
                                                        <td data-user-id="{{ $user->id }}">{{ $user->id }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->address }}</td>
                                                        <td>{{ $user->phone }}</td>
                                                        <td
                                                            class="status {{ $user->email_verified_at ? 'EmailVerified' : 'NotVerified' }}">
                                                            {{ $user->email_verified_at == null ? 'Not Verified' : 'Email Verified' }}
                                                        </td>
                                                        <td>{{ $user->usertype == 0 ? 'User' : 'Admin' }}</td>
                                                        <td>
                                                            <a href="{{ url('send_email', $user->id) }}"
                                                                class="btn btn-outline-info">Send Email</a>
                                                        </td>
                                                        <td>
                                                            <a href="{{ url('user_edit', $user->id) }}"
                                                                class="btn btn-outline-primary"> Edit</a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            @endif
                                        @endforeach
                                    </table>
                                </section>
                            </div>

                            <div class="table-responsive">

                                <section class="table__body" style="margin-bottom: 1cm;">
                                    <table id="table2">
                                        <thead>
                                            <tr class="th_color">
                                                <th id="idHeader" style="padding: 10px;">ID<span
                                                        class="icon-arrow">&UpArrow;&DownArrow;</span></th>
                                                <th id="nameHeader" style="padding: 10px;">Name<span
                                                        class="icon-arrow">&UpArrow;&DownArrow;</span>
                                                </th>
                                                <th style="padding: 10px;">Email
                                                </th>
                                                <th style="padding: 10px;">Address
                                                </th>
                                                <th style="padding: 10px;">Phone
                                                </th>
                                                <th style="padding: 10px;">Verified </th>
                                                <th style="padding: 10px;">Role</th>
                                                <th style="padding: 10px;">Send Email</th>
                                                <th style="padding: 10px;">Function</th>
                                            </tr>
                                        </thead>
                                        @foreach ($users as $user)
                                            @if ($user->usertype == '2')
                                                <tbody>
                                                    <tr class="td_color">
                                                        <td>{{ $user->id }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->address }}</td>
                                                        <td>{{ $user->phone }}</td>
                                                        <td
                                                            class="status {{ $user->email_verified_at ? 'EmailVerified' : 'NotVerified' }}">
                                                            {{ $user->email_verified_at == null ? 'Not Verified' : 'Email Verified' }}
                                                        </td>
                                                        <td>{{ $user->usertype == '2' ? 'Cashier' : ($user->usertype == '1' ? 'Admin' : 'User') }}
                                                        </td>
                                                        <td>
                                                            <a href="{{ url('send_email', $user->id) }}"
                                                                class="btn btn-outline-info">Send Email</a>
                                                        </td>
                                                        <td>
                                                            <a href="{{ url('user_edit', $user->id) }}"
                                                                class="btn btn-outline-primary">Edit</a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            @endif
                                        @endforeach
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
            // Add event listener to the "ID" column header in table 1
            var idHeaderTable1 = document.getElementById("table1").querySelector("#idHeader");
            idHeaderTable1.addEventListener("click", function() {
                toggleSortDirection(idHeaderTable1);
                sortTable("table1", "idHeader", getSortDirection(idHeaderTable1));
            });

            // Add event listener to the "Name" column header in table 1
            var nameHeaderTable1 = document.getElementById("table1").querySelector("#nameHeader");
            nameHeaderTable1.addEventListener("click", function() {
                toggleSortDirection(nameHeaderTable1);
                sortTable("table1", "nameHeader", getSortDirection(nameHeaderTable1));
            });

            // Repeat similar code for table 2
            var idHeaderTable2 = document.getElementById("table2").querySelector("#idHeader");
            idHeaderTable2.addEventListener("click", function() {
                toggleSortDirection(idHeaderTable2);
                sortTable("table2", "idHeader", getSortDirection(idHeaderTable2));
            });

            var nameHeaderTable2 = document.getElementById("table2").querySelector("#nameHeader");
            nameHeaderTable2.addEventListener("click", function() {
                toggleSortDirection(nameHeaderTable2);
                sortTable("table2", "nameHeader", getSortDirection(nameHeaderTable2));
            });
        });

        function toggleSortDirection(header) {
            var newOrder = getSortDirection(header);
            header.setAttribute("data-sort-order", newOrder);
        }

        function getSortDirection(header) {
            var currentOrder = header.getAttribute("data-sort-order");
            return currentOrder === 'desc' ? 'asc' : 'desc';
        }

        function sortTable(tableId, column, order) {
            var table = document.getElementById(tableId);
            var rows = table.getElementsByTagName("tr");
            var switching = true;

            while (switching) {
                switching = false;

                for (var i = 1; i < rows.length - 1; i++) {
                    var shouldSwitch = false;
                    var x = rows[i].querySelector("td:nth-child(" + (column === "nameHeader" ? "2" : "1") + ")");
                    var y = rows[i + 1].querySelector("td:nth-child(" + (column === "nameHeader" ? "2" : "1") + ")");

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
    </script>
    @include('admin.js')
</body>

</html>
