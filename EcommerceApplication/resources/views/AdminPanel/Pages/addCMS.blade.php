{{-- View for Create Asset --}}

{{-- Extending the master template. --}}
@extends('AdminPanel.master')

{{-- Title of the document. --}}
@section('title')
    <title>Add CMS</title>
@endsection

{{-- Header, consisting of a heading and breadcrumb. --}}
@section('header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add CMS</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/addCMS">Add CMS</a></li>
                        <li class="breadcrumb-item active">Manage CMS</li>
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
                        <form action="/addCMS_check" method="post" enctype="multipart/form-data">
                            @csrf()
                            <div class="card-body">

                                {{-- Title. --}}
                                <div class="form-group">
                                    <label for="cms_title">Title</label>
                                    <input type="text" class="form-control" id="cms_title" placeholder="Title"
                                        name="cms_title" required>
                                    @if ($errors->has('brand'))
                                        <label for="cms_title"
                                            class="alert alert-danger">{{ $errors->first('cms_title') }}</label>
                                    @endif
                                </div>

                                {{-- Author. --}}
                                <div class="form-group">
                                    <label for="cms_author">Author</label>
                                    <input type="text" class="form-control" id="cms_author" placeholder="Author"
                                        name="cms_author" required>
                                    @if ($errors->has('cms_author'))
                                        <label for="cms_author"
                                            class="alert alert-danger">{{ $errors->first('cms_author') }}</label>
                                    @endif
                                </div>

                                {{-- Description. --}}
                                <div class="form-group">
                                    <label for="cms_desc">Description</label>
                                    <textarea name="cms_desc" id="cms_desc" class="form-control" cols="30" rows="10"
                                        placeholder="Description" style="resize: none;" required></textarea>
                                    @if ($errors->has('cms_desc'))
                                        <label for="cms_desc"
                                            class="alert alert-danger">{{ $errors->first('cms_desc') }}</label>
                                    @endif
                                </div>

                                {{-- Source URL. --}}
                                <div class="form-group">
                                    <label for="cms_url">Source URL</label>
                                    <input type="text" class="form-control" id="cms_url" placeholder="Source URL"
                                        name="cms_url" required>
                                    @if ($errors->has('cms_url'))
                                        <label for="cms_url"
                                            class="alert alert-danger">{{ $errors->first('cms_url') }}</label>
                                    @endif
                                </div>

                                {{-- Image. --}}
                                <div class="form-group">
                                    <label for="cms_image">Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="cms_image" id="cms_image"
                                                required>
                                            <label class="custom-file-label" for="cms_image">Choose Image</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                    @if ($errors->has('cms_image'))
                                        <label for="cms_image"
                                            class="alert alert-danger">{{ $errors->first('cms_image') }}</label>
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
