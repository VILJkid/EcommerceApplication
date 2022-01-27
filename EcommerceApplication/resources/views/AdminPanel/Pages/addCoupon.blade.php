{{-- View for Create Asset --}}

{{-- Extending the master template. --}}
@extends('AdminPanel.master')

{{-- Title of the document. --}}
@section('title')
    <title>Add Coupon</title>
@endsection

{{-- Header, consisting of a heading and breadcrumb. --}}
@section('header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Coupon</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/addCoupon">Add Coupon</a></li>
                        <li class="breadcrumb-item active">Manage Coupons</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection

{{-- The main content. --}}
@section('main')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add something amazing !</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->


                        {{-- Error and success message. --}}
                        @if (Session::has('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger">{{ Session::get('error') }}</div>
                        @endif

                        {{-- Create User form. --}}
                        <form action="/addCoupon_check" method="post" enctype="multipart/form-data">
                            @csrf()
                            <div class="card-body">

                                {{-- Product Brand. --}}
                                <div class="form-group">
                                    <label for="coupon_name">Coupon Name</label>
                                    <input type="text" class="form-control" id="coupon_name" placeholder="Coupon Name"
                                        name="coupon_name" required>
                                    @if ($errors->has('coupon_name'))
                                        <label for="coupon_name"
                                            class="alert alert-danger">{{ $errors->first('coupon_name') }}</label>
                                    @endif
                                </div>

                                {{-- Coupon Value. --}}
                                <div class="form-group">
                                    <label for="coupon_value">Coupon Value</label>
                                    <input type="number" class="form-control" id="coupon_value" placeholder="Coupon Value"
                                        name="coupon_value" required min="1">
                                    @if ($errors->has('coupon_value'))
                                        <label for="coupon_value"
                                            class="alert alert-danger">{{ $errors->first('coupon_value') }}</label>
                                    @endif
                                </div>

                                {{-- Coupon Quantity. --}}
                                <div class="form-group">
                                    <label for="coupon_qty">Coupon Quantity</label>
                                    <input type="number" class="form-control" id="coupon_qty"
                                        placeholder="Coupon Quantity" name="coupon_qty" required min="1">
                                    @if ($errors->has('coupon_qty'))
                                        <label for="coupon_qty"
                                            class="alert alert-danger">{{ $errors->first('coupon_qty') }}</label>
                                    @endif
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


{{-- Scripts related to the specific page goes here. --}}
@section('extrajs')
    <script>
        $(document).ready(function() {
            // For uploading images
            $(function() {
                bsCustomFileInput.init();
            });
        });
    </script>
@endsection
