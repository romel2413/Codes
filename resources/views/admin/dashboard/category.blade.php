<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')

    <style type="text/css">
        .content-wrapper {
            background: #13d0ffa4;
        }

        table {
            width: 100%;
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

        table,
        th,
        td {
            border-collapse: collapse;
            padding: 1rem;
            text-align: left;
        }

        thead {
            display: table-header-group;
            vertical-align: middle;
            border-color: inherit;
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

        .th_color {
            background: rgb(0, 6, 95);
            /* Change the background color here */
            color: rgb(255, 255, 255);
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

        .td_color {
            color: rgb(0, 0, 0);
        }

        .table__header .input-group {
            width: 80%;
            height: 100%;
            background-color: #fff5;
            padding: 0 .8rem;
            border-radius: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: .2s;
            text-align: center;
        }

        .table__header .input-group:hover {
            width: 100%;
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
    </style>
</head>

<body>
    <div class="container-scroller">
        @include('admin.sidebar')
        <div class="container-fluid page-body-wrapper">
            @include('admin.navbar')
            <div class="main-panel">
                <div class="content-wrapper">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <main class="table_main">


                        <section class="table__header">


                            <h2 class="h2_font">
                                Category
                            </h2>


                            <form action="{{ url('/add_category') }}" method="POST">
                                @csrf
                                <div class="input-group">
                                    <input class="form-control input_color" type="text" name="name_category"
                                        placeholder="Write Category Name">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">Add Category</button>
                                    </div>
                                </div>
                            </form>
                        </section>
                        <div class="center">
                            <section class="table__body">
                                <table>
                                    <thead>
                                        <tr class="th_color">
                                            <th>Category Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $data_category)
                                            <tr class="td_color">
                                                <td>{{ $data_category->category_name }}</td>
                                                <td><a onclick="return confirm('Are You Sure To Delete This?')"
                                                        class="btn btn-danger"
                                                        href="{{ url('/delete_category', $data_category->id) }}">Delete</a>
                                                </td>
                                            </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                            </section>

                        </div>

                    </main>
                </div>
            </div>
        </div>
    </div>
    @include('admin.js')
</body>

</html>
