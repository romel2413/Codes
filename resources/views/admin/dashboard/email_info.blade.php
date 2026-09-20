<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <style type="text/css">
        .div_center {
            text-align: center;
            padding-top: 40px;
        }
        label
        {
            display: inline-block;
            width: 200px;
            font-size: 15px;
            font-weight: bold;
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

                    <h1 style="text-align:center; font-size:25px;">
                        Send Email {{ $order->email ?? 'No Email Available' }}
                    </h1>
                    <form action="{{ url('send_user_email', $order->id) }}" method="POST">
                        @csrf
                        <div class="div_center">
                            <label for="">Email Greetings:</label>
                            <input style="color: black;" type="text" name="greeting" id="">
                        </div>
                        <div class="div_center">
                            <label for="">Email Firstline:</label>
                            <input style="color: black;" type="text" name="firstline" id="">
                        </div>
                        <div class="div_center">
                            <label for="">Email Body:</label>
                            <input style="color: black;" type="text" name="body" id="">
                        </div>
                        <div class="div_center">
                            <label for="">Email Button:</label>
                            <input style="color: black;" type="text" name="button" id="">
                        </div>
                        <div class="div_center">
                            <label for="">Email Url:</label>
                            <input style="color: black;" type="text" name="url" id="">
                        </div>
                        <div class="div_center">
                            <label for="">Email Lastline:</label>
                            <input style="color: black;" type="text" name="lastline" id="">
                        </div>
                        <div class="div_center">
                            <input type="submit" value="Send Email" class="btn btn-primary">
                        </div>

                    </form>
                </div>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.footer')
    <!-- plugins:js -->
    @include('admin.js')
</body>

</html>
