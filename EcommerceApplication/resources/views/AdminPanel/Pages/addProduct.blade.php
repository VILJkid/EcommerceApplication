{{-- View for Create Asset --}}

{{-- Extending the master template. --}}
@extends('AdminPanel.master')

{{-- Title of the document. --}}
@section('title')
    <title>Add Product</title>
@endsection

{{-- Header, consisting of a heading and breadcrumb. --}}
@section('header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/addProduct">Add Product</a></li>
                        <li class="breadcrumb-item active">Manage Products</li>
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
                        <form action="/addProduct_check" method="post" enctype="multipart/form-data">
                            @csrf()
                            <div class="card-body">

                                {{-- Product Brand. --}}
                                <div class="form-group">
                                    <label for="brand">Product Brand</label>
                                    <input type="text" class="form-control" id="brand" placeholder="Product Brand"
                                        name="brand" required>
                                    @if ($errors->has('brand'))
                                        <label for="brand"
                                            class="alert alert-danger">{{ $errors->first('brand') }}</label>
                                    @endif
                                </div>

                                {{-- Product name. --}}
                                <div class="form-group">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" class="form-control" id="product_name" placeholder="Product Name"
                                        name="product_name" required>
                                    @if ($errors->has('product_name'))
                                        <label for="product_name"
                                            class="alert alert-danger">{{ $errors->first('product_name') }}</label>
                                    @endif
                                </div>

                                {{-- Product description. --}}
                                <div class="form-group">
                                    <label for="product_desc">Product Description</label>
                                    <input type="text" class="form-control" id="product_desc"
                                        placeholder="Product Description" name="product_desc" required>
                                    @if ($errors->has('product_desc'))
                                        <label for="product_desc"
                                            class="alert alert-danger">{{ $errors->first('product_desc') }}</label>
                                    @endif
                                </div>

                                {{-- Product Category. --}}
                                <div class="form-group">
                                    <label for="category_id">Product Category</label>
                                    <select class="custom-select rounded-0" id="category_id" name="category_id" required>
                                        @if (empty($atData))
                                            <option hidden disabled selected>Create a Category first</option>
                                        @else
                                            <option hidden disabled selected>Product Category</option>
                                            @foreach ($atData as $atData)
                                                <option value="{{ $atData->id }}" name="category_id">
                                                    {{ $atData->category_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('category_id'))
                                        <label for="category_id"
                                            class="alert alert-danger">{{ $errors->first('category_id') }}</label>
                                    @endif
                                </div>

                                {{-- Product Condition. --}}
                                <div class="form-group">
                                    <label for="condition">Product Condition</label>
                                    <select class="custom-select rounded-0" id="condition" name="condition" required>
                                        <option hidden disabled selected>Product Condition</option>
                                        <option value="New" name="condition">
                                            New</option>
                                        <option value="Refurbished" name="condition">
                                            Refurbished</option>
                                    </select>
                                    @if ($errors->has('condition'))
                                        <label for="condition"
                                            class="alert alert-danger">{{ $errors->first('condition') }}</label>
                                    @endif
                                </div>

                                {{-- Product Price. --}}
                                <div class="form-group">
                                    <label for="product_price">Product Price</label>
                                    <input type="number" class="form-control" id="product_price"
                                        placeholder="Product Price" name="product_price" required min="1">
                                    @if ($errors->has('product_price'))
                                        <label for="product_price"
                                            class="alert alert-danger">{{ $errors->first('product_price') }}</label>
                                    @endif
                                </div>

                                {{-- Product Max Quantity. --}}
                                <div class="form-group">
                                    <label for="product_qty_max">Product Max Quantity</label>
                                    <input type="number" class="form-control" id="product_qty_max"
                                        placeholder="Product Max Quanity" name="product_qty_max" required min="1">
                                    @if ($errors->has('product_qty_max'))
                                        <label for="product_qty_max"
                                            class="alert alert-danger">{{ $errors->first('product_qty_max') }}</label>
                                    @endif
                                </div>

                                {{-- Product Banner Image. --}}
                                <div class="form-group">
                                    <label for="product_banner_image">Product Banner Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="product_banner_image"
                                                id="product_banner_image" required>
                                            <label class="custom-file-label" for="product_banner_image">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                    @if ($errors->has('product_banner_image'))
                                        <label for="product_banner_image"
                                            class="alert alert-danger">{{ $errors->first('product_banner_image') }}</label>
                                    @endif
                                </div>

                                {{-- Product Images. --}}
                                <div class="form-group">
                                    <label for="product_image">Product Images</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="product_image[]"
                                                id="product_image" multiple required>
                                            <label class="custom-file-label" for="product_image">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                    @if ($errors->has('product_image[]'))
                                        <label for="product_image"
                                            class="alert alert-danger">{{ $errors->first('product_image[]') }}</label>
                                    @endif
                                </div>

                                {{-- Email. --}}
                                {{-- <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Email" name="email"
                                        required>
                                    @if ($errors->has('email'))
                                        <label for="email"
                                            class="alert alert-danger">{{ $errors->first('email') }}</label>
                                    @endif
                                </div> --}}

                                {{-- Password. --}}
                                {{-- <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Password"
                                        name="password" required>
                                    @if ($errors->has('password'))
                                        <label for="password"
                                            class="alert alert-danger">{{ $errors->first('password') }}</label>
                                    @endif
                                </div> --}}

                                {{-- Confirm Password. --}}
                                {{-- <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        placeholder="Confirm Password" name="password_confirmation" required>
                                    @if ($errors->has('password_confirmation'))
                                        <label for="password_confirmation"
                                            class="alert alert-danger">{{ $errors->first('password_confirmation') }}</label>
                                    @endif
                                </div> --}}

                                {{-- User Role. --}}
                                {{-- <div class="form-group">
                                    <label for="userRole_id">User Role</label>
                                    <select class="custom-select rounded-0" id="userRole_id" name="userRole_id" required>
                                        @if (empty($atData))
                                            <option hidden disabled selected>Create an User Role first</option>
                                        @else
                                            <option hidden disabled selected>User Role</option>
                                            @foreach ($atData as $atData)
                                                <option value="{{ $atData->id }}" name="userRole_id">
                                                    {{ $atData->role_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('userRole_id'))
                                        <label for="userRole_id"
                                            class="alert alert-danger">{{ $errors->first('userRole_id') }}</label>
                                    @endif
                                </div> --}}

                                {{-- Asset Image. --}}
                                {{-- <div class="form-group">
                                    <label for="assetimage">Asset Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="assetimage[]" id="assetimage"
                                                multiple>
                                            <label class="custom-file-label" for="assetimage">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                    @if ($errors->has('assetimage[]'))
                                        <label for="assetimage"
                                            class="alert alert-danger">{{ $errors->first('assetimage[]') }}</label>
                                    @endif
                                </div> --}}

                                {{-- User Status. --}}
                                {{-- <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input type="hidden" name="userstatus" value="0">
                                    <input type="checkbox" class="custom-control-input" name="userstatus" id="userstatus"
                                        value="1" checked>
                                    <label class="custom-control-label" for="userstatus">Status</label>
                                    @if ($errors->has('userstatus'))
                                        <label for="userstatus"
                                            class="alert alert-danger">{{ $errors->first('userstatus') }}</label>
                                    @endif
                                </div> --}}
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
