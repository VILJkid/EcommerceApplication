{{-- View for Create Asset --}}

{{-- Extending the master template. --}}
@extends('AdminPanel.master')

{{-- Title of the document. --}}
@section('title')
    <title>Add Category</title>
@endsection

{{-- Header, consisting of a heading and breadcrumb. --}}
@section('header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Category</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/addCategory">Add Category</a></li>
                        <li class="breadcrumb-item active">Manage Categories</li>
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
                        <form action="/addCategory_check" method="post" enctype="multipart/form-data">
                            @csrf()
                            <div class="card-body">

                                {{-- First name. --}}
                                <div class="form-group">
                                    <label for="category_name">Category Name</label>
                                    <input type="text" class="form-control" id="category_name" placeholder="Category Name"
                                        name="category_name" required>
                                    @if ($errors->has('category_name'))
                                        <label for="category_name"
                                            class="alert alert-danger">{{ $errors->first('category_name') }}</label>
                                    @endif
                                </div>

                                {{-- Last name. --}}
                                {{-- <div class="form-group">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" class="form-control" id="lastname" placeholder="Last Name"
                                        name="lastname" required>
                                    @if ($errors->has('lastname'))
                                        <label for="lastname"
                                            class="alert alert-danger">{{ $errors->first('lastname') }}</label>
                                    @endif
                                </div> --}}

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

                                {{-- Asset Image.
                                <div class="form-group">
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
