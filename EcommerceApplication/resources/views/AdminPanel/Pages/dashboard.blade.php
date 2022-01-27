{{-- View for Dashboard --}}

{{-- Extending the master template. --}}
@extends('AdminPanel.master')

{{-- Cat will welcome you. --}}
@section('cat')
    @include('AdminPanel.Include.preloader')
@endsection

{{-- Title of the document. --}}
@section('title')
    <title>Home</title>
@endsection

{{-- Header, consisting of a heading and breadcrumb. --}}
@section('header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Admin Reports</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection

{{-- The main content. --}}
@section('main')
    @csrf()
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <!-- PIE CHART -->
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Sales Report</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="pieChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-6">
                    <!-- BAR CHART -->
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Coupons</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="barChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-12">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Customers Registered</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body ">
                            <h5 class="card-title ">Currently, there are total no. of <strong><span
                                        class="text-primary" id="numCount"></span></strong> registered Customer(s).</h5>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection

@section('extrajs')
    <script>
        var categoryNames = [];
        var noOfProducts = [];
        var customersRegistered = 0;
        var couponNames = [];
        var remainingCoupons = [];
        var usedCoupons = [];
        var pieColor = [];

        $(document).ready(function() {
            // Generate random colors for pie chart everytime page reloads
            function generateRandomString(length) {

                var colorCode = "";
                var possible = "ABCDEF0123456789";

                for (var i = 0; i < length; i++) {
                    colorCode += possible.charAt(Math.floor(Math.random() * possible.length));
                }

                return colorCode;
            }

            // Fetch the Asset and Asset Type details
            function getDetails() {
                $.ajax({
                    url: "{{ url('/getstats') }}",
                    method: 'post',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);

                        response.data1.forEach(res => {
                            let resOne = res.category_name;
                            if (categoryNames.indexOf(resOne) == -1) {
                                categoryNames.push(resOne);
                            }
                        });

                        categoryNames.forEach(cn => {
                            let pcount = 0;
                            let flag1 = 0;
                            response.data2.forEach(res => {

                                res.get_order_products.forEach(pro => {
                                    let resTwo = pro
                                        .get_product
                                        .get_category
                                        .category_name;

                                    if (cn == resTwo) {
                                        flag1 = 1;
                                        pcount += pro.product_qty;
                                    }
                                });


                            });
                            if (flag1 == 1)
                                noOfProducts.push(pcount)
                            else
                                noOfProducts.push(0)
                            pieColor.push("#" + generateRandomString(6));
                        });

                        response.data3.forEach(coupon => {
                            couponNames.push(coupon.coupon_name);
                            remainingCoupons.push(coupon.coupon_qty);
                            usedCoupons.push(10 - coupon.coupon_qty);
                        });

                        customersRegistered = response.data4.length;


                        showPieChart();
                        showBarGraph();
                        showRegCus();
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }

            function showPieChart() {
                //-------------
                //- PIE CHART -
                //-------------
                // Get context with jQuery - using jQuery's .get() method.
                var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
                var pieData = {
                    labels: categoryNames,
                    datasets: [{
                        data: noOfProducts,
                        backgroundColor: pieColor,
                    }]
                }
                var pieOptions = {
                    maintainAspectRatio: false,
                    responsive: true,
                }
                //Create pie or douhnut chart
                // You can switch between pie and doughnut using the method below.
                new Chart(pieChartCanvas, {
                    type: 'doughnut',
                    data: pieData,
                    options: pieOptions
                })
            }

            function showBarGraph() {
                //-------------
                //- BAR CHART -
                //-------------
                var areaChartData = {
                    labels: couponNames,
                    datasets: [{
                            label: 'Remaining',
                            backgroundColor: 'rgba(60,141,188,0.9)',
                            borderColor: 'rgba(60,141,188,0.8)',
                            pointRadius: false,
                            pointColor: '#3b8bba',
                            pointStrokeColor: 'rgba(60,141,188,1)',
                            pointHighlightFill: '#fff',
                            pointHighlightStroke: 'rgba(60,141,188,1)',
                            data: remainingCoupons
                        },
                        {
                            label: 'Used',
                            backgroundColor: 'rgba(210, 214, 222, 1)',
                            borderColor: 'rgba(210, 214, 222, 1)',
                            pointRadius: false,
                            pointColor: 'rgba(210, 214, 222, 1)',
                            pointStrokeColor: '#c1c7d1',
                            pointHighlightFill: '#fff',
                            pointHighlightStroke: 'rgba(220,220,220,1)',
                            data: usedCoupons
                        },
                    ]
                }

                var barChartCanvas = $('#barChart').get(0).getContext('2d')
                var barChartData = $.extend(true, {}, areaChartData)
                var temp0 = areaChartData.datasets[0]
                var temp1 = areaChartData.datasets[1]
                barChartData.datasets[0] = temp1
                barChartData.datasets[1] = temp0

                var barChartOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    datasetFill: false
                }

                new Chart(barChartCanvas, {
                    type: 'bar',
                    data: barChartData,
                    options: barChartOptions
                })
            }

            function showRegCus() {
                $('#numCount').html(customersRegistered);
            }

            getDetails();
        });
    </script>

@endsection
