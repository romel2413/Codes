<style type="text/css">
    .content-wrapper {
        background: #13d0ffa4;
    }

    .card {
        background: #00065f;
        color: white;
    }

    .chartsUser {
        background: rgba(255, 255, 255, 0.329);
        height: 50%;
        width: 100%;
    }

    .charts {
        width: 50%
    }
    @media (max-width: 768px) {
        /* Styles for screens with a maximum width of 768px (typical for mobile devices) */
        .chartsUser {
            height: 300px; /* Adjust the height as needed for mobile layout */
            width: 100%; /* Full width for mobile */
        }
    }
</style>

<div class="main-panel">
    <div class="content-wrapper">
        @if (session('error'))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{ session('error') }}
            </div>
        @endif
        <div class="row">
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">{{ $total_product }}</h3>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-info">
                                    <a href="{{ url('/show_product') }}"><span
                                            class="mdi mdi-package-variant-closed"></span></a>

                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">Total Product</h6>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">

                                    <h3 class="mb-0">{{ $total_stock }}</h3>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-success">
                                    <span class="mdi mdi-package-variant-closed icon-item"></span>
                                </div>
                            </div>
                        </div>

                        <h6 class="text-muted font-weight-normal">Total Stock</h6>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">{{ $total_order }}</h3>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-primary">
                                    <a href="{{ url('/order') }}"><span class="mdi mdi-cart"></span></a>

                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">Total Orders</h6>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">

                                    <h3 class="mb-0">{{ $total_user }}</h3>

                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-success">
                                    <a href="{{ '/customers' }}"><span
                                            class="mdi mdi-account-multiple icon-item"></span></a>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">Total Customer</h6>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">{{ $total_transac }}</h3>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-success">
                                    <span class="mdi mdi-currency-usd icon-item"></span>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">Total Revenue</h6>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">{{ $total_delivered }}</h3>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-success">
                                    <span class="mdi mdi-truck icon-item"></span>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">Order Delivered</h6>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">{{ $total_pending }}</h3>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-success">
                                    <span class="mdi mdi-truck icon-item"></span>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">Order Pending</h6>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">{{ $total_processing }}</h3>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-success">
                                    <span class="mdi mdi-truck icon-item"></span>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">Order Processing</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="chartsUser">
            <canvas class="charts" id="chart">
            </canvas>

        </div>


    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <!-- partial -->
</div>
<script>
    var ctx = document.getElementById('chart').getContext('2d');
    var userChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($labels),
            datasets: @json($datasets)
        },
        options: {
            responsive: true, // Enable responsiveness
            maintainAspectRatio: false, // Disable aspect ratio constraint
            // ... other options
        }
    });





    //     options: {
    //     scales: {
    //         y: {
    //             beginAtZero: true, // starts the y-axis at zero
    //             suggestedMin: 0, // sets the minimum value for y-axis
    //             suggestedMax: 100, // sets the maximum value for y-axis
    //         }
    //     }
    // }

</script>
