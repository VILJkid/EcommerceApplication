{{-- View for Show Asset --}}

{{-- Extending the master template. --}}
@extends('AdminPanel.master')

{{-- Title of the document. --}}
@section('title')
    <title>Display Coupons</title>
@endsection

{{-- Header, consisting of a heading and breadcrumb. --}}
@section('header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Show Coupons</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/showCoupons">Show Coupons</a></li>
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
    @php
    // To calculate Last Updated time
    function time_Ago($time)
    {
        // Calculate difference between current
        // time and given timestamp in seconds
        $diff = time() - $time;

        // Time difference in seconds
        $sec = $diff;

        // Convert time difference in minutes
        $min = round($diff / 60);

        // Convert time difference in hours
        $hrs = round($diff / 3600);

        // Convert time difference in days
        $days = round($diff / 86400);

        // Convert time difference in weeks
        $weeks = round($diff / 604800);

        // Convert time difference in months
        $mnths = round($diff / 2600640);

        // Convert time difference in years
        $yrs = round($diff / 31207680);

        // Check for seconds
        if ($sec <= 60) {
            echo "$sec seconds ago";
        }

        // Check for minutes
        elseif ($min <= 60) {
            if ($min == 1) {
                echo 'One minute ago';
            } else {
                echo "$min minutes ago";
            }
        }

        // Check for hours
        elseif ($hrs <= 24) {
            if ($hrs == 1) {
                echo 'An hour ago';
            } else {
                echo "$hrs hours ago";
            }
        }

        // Check for days
        elseif ($days <= 7) {
            if ($days == 1) {
                echo 'Yesterday';
            } else {
                echo "$days days ago";
            }
        }

        // Check for weeks
        elseif ($weeks <= 4.3) {
            if ($weeks == 1) {
                echo 'A week ago';
            } else {
                echo "$weeks weeks ago";
            }
        }

        // Check for months
        elseif ($mnths <= 12) {
            if ($mnths == 1) {
                echo 'A month ago';
            } else {
                echo "$mnths months ago";
            }
        }

        // Check for years
        else {
            if ($yrs == 1) {
                echo 'One year ago';
            } else {
                echo "$yrs years ago";
            }
        }
    }
    @endphp
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Coupon Details</h3>
                            {{-- Pagination links --}}
                            <div class="card-tools">
                                @if (!empty($aData))
                                    {{-- {{ $atData->onEachSide(1)->links() }} --}}
                                    {{ $aData->links() }}
                                @endif
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            {{-- Table displaying Users --}}
                            <table id="example1" class="table table-bordered table-striped table-hover text-center">
                                <thead>
                                    <tr>
                                        <th class="align-middle">Coupon Name</th>
                                        <th class="align-middle">Coupon Code</th>
                                        <th class="align-middle">Coupon Value</th>
                                        <th class="align-middle">Coupon Quantity</th>
                                        <th class="align-middle">Last Updated</th>
                                        <th class="align-middle">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- If no records found --}}
                                    @if (empty($aData[0]->coupon_name))
                                        <tr>
                                            <td class="align-middle" colspan="6">Nothing
                                                here, only pain and sorrow.
                                            </td>
                                        </tr>
                                    @else
                                        {{-- If records found --}}
                                        @foreach ($aData as $adata)
                                            @php
                                                // Split the asset code into 4 parts
                                                $acode = str_split($adata->coupon_code, 4);
                                            @endphp
                                            <tr>
                                                {{-- Coupon Name --}}
                                                <td class="align-middle">
                                                    {{ $adata->coupon_name }}</td>

                                                {{-- Coupon Code --}}
                                                <td class="align-middle">
                                                    {{ $acode[0] }}-{{ $acode[1] }}-{{ $acode[2] }}-{{ $acode[3] }}
                                                </td>

                                                {{-- Coupon Value --}}
                                                <td class="align-middle">
                                                    &#36;{{ $adata->coupon_value }}</td>

                                                {{-- Coupon Quantity --}}
                                                <td class="align-middle">
                                                    {{ $adata->coupon_qty }}</td>

                                                {{-- Last Updated --}}
                                                <td class="align-middle">{{ time_Ago(strtotime($adata->updated_at)) }}
                                                </td>

                                                {{-- Action --}}
                                                <td class="align-middle">
                                                    {{-- Edit button --}}
                                                    <a href="javacsript:void(0)"
                                                        class="btn btn-success align-middle m-1 edit"
                                                        aid="{{ $adata->id }}" data-toggle="modal"
                                                        data-target="#editModal"><i class="fas fa-edit"></i>
                                                        Edit</a>
                                                    &nbsp;&nbsp;

                                                    {{-- Delete button --}}
                                                    <a href="javascript:void(0)" class="btn btn-danger align-middle m-1 del"
                                                        aid="{{ $adata->id }}" data-toggle="modal"
                                                        data-target="#delModal"><i class="fas fa-trash"></i>
                                                        Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <a href="/addCoupon" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add
                                Coupon</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- delModal -->
    <div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="delModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delModalLongTitle">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="confirmDel" data-dismiss="modal" class="btn btn-danger"><i
                            class="fas fa-trash"></i> Delete Anyway</button>
                </div>
            </div>
        </div>
    </div>

    <!-- imageModal -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">

                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">
                            </li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1" class="">
                            </li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2" class="">
                            </li>
                        </ol>
                        <div class="carousel-inner" id="innerCarousel">
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true">
                                {{-- <i class="fas fa-chevron-left"></i> --}}
                            </span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true">
                                {{-- <i class="fas fa-chevron-right"></i> --}}
                            </span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- editModal -->
    <!-- Modal HTML Markup -->
    <div id="editModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Coupon</h3>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Transform to Epic !</h3>
                        </div>
                        <div id="formResult"></div>
                        {{-- <div id="sentUnuccessfully"></div> --}}
                        <form id="editForm">
                            @csrf()
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="coupon_name">Coupon Name</label>
                                    <input type="text" class="form-control" id="coupon_name" placeholder="Coupon Name"
                                        name="coupon_name">
                                </div>

                                <div class="form-group">
                                    <label for="coupon_value">Coupon Value</label>
                                    <input type="number" class="form-control" id="coupon_value" placeholder="Coupon Value"
                                        name="coupon_value">
                                </div>

                                <div class="form-group">
                                    <label for="coupon_qty">Coupon Quantity</label>
                                    <input type="number" class="form-control" id="coupon_qty"
                                        placeholder="Coupon Quantity" name="coupon_qty">
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" id="confirmEdit" class="btn btn-primary"><i
                                        class="fas fa-edit"></i> Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    {{-- Succes message Toastr --}}
    <button type="button" id="toastrSuccessButton" class="invisible btn btn-success toastrDefaultSuccess">
        Launch Success Toast
    </button>

    {{-- Error message Toastr --}}
    <button type="button" id="toastrErrorButton" class="invisible btn btn-danger toastrDefaultError">
        Launch Error Toast
    </button>

@endsection

@section('extrajs')
    <script>
        $(document).ready(function() {
            // For CSV, PDF, and Copy buttons
            // $(function() {
            //     $("#example1").DataTable({
            //         "searching": false,
            //         "paging": false,
            //         "info": false,
            //         "ordering": false,
            //         "responsive": true,
            //         "lengthChange": false,
            //         "autoWidth": false,
            //         "buttons": ["copy", "csv", "pdf"]
            //     }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            // });

            //delete asset
            $('.del').click(function() {
                aid = $(this).attr('aid');

                $("#confirmDel").click(function() {
                    $.ajax({
                        url: "{{ url('/delCoupon') }}",
                        method: 'delete',
                        data: {
                            _token: '{{ csrf_token() }}',
                            aid: aid
                        },
                        success: function(response) {

                            // $("#example1").load(location.href + " #example1");
                            location.reload();
                        }
                    });
                });
            });


            //show images
            // $(".image").click(function() {
            //     aid = $(this).attr("aid");

            //     $.ajax({
            //         url: "{{ url('/showImages') }}",
            //         method: "post",
            //         data: {
            //             _token: '{{ csrf_token() }}',
            //             aid: aid
            //         },
            //         dataType: "json",
            //         success: function(response) {
            //             console.log(response);
            //             var html = '';
            //             var meowActive = '';
            //             $("#imageModalLongTitle").html(response.aData.product_name);
            //             if (response.iData) {
            //                 for (var count = 0; count < response.iData.length; count++) {
            //                     if (count == 0)
            //                         meowActive = 'active';
            //                     else
            //                         meowActive = '';
            //                     html +=
            //                         `<div class="carousel-item ${meowActive}"><img class="d-block w-100" src = "{{ asset('NeoStore/${response.iData[count].product_image}') }}" alt = "Slide ${response.iData[count].id}" ></div>`;

            //                 }

            //             } else {
            //                 html =
            //                     `<div class="alert alert-danger text-center">No images uploaded for this product.</div>`;
            //             }

            //             $('#innerCarousel').html(html);
            //         }

            //     });
            // });

            //change status
            // $(".as").click(function() {
            //     check = $(this).prop('checked') ? 1 : 0;
            //     aid = $(this).attr('aid');

            //     console.log(check);
            //     if (check == 1) {

            //         $("#toastrSuccessButton").click();
            //         $("#statusLabel" + aid).html("Active");


            //     } else {

            //         $("#toastrErrorButton").click();
            //         $("#statusLabel" + aid).html("Inactive");

            //     }

            //     $("#toastrButton").click();

            //     $.ajax({
            //         url: "{{ url('/changeUserStatus') }}",
            //         method: "post",
            //         data: {
            //             _token: '{{ csrf_token() }}',
            //             aid: aid,
            //             check: check,
            //         },
            //         dataType: "json",
            //         success: function(response) {
            //             console.log(response);
            //         }
            //     });
            // });

            // Toastr Success message
            $('.toastrDefaultSuccess').click(function() {
                toastr.success('User activated.')
            });

            // Toastr error message
            $('.toastrDefaultError').click(function() {
                toastr.error('User deactivated.')
            });

            // Edit Asset
            $('.edit').click(function() {
                aid = $(this).attr('aid');
                $.ajax({
                    url: "{{ url('/editCoupon') }}",
                    method: 'post',
                    data: {
                        _token: '{{ csrf_token() }}',
                        aid: aid
                    },
                    success: function(response) {
                        $("#coupon_name").attr('placeholder', response.coupon_name);
                        $("#coupon_value").attr('placeholder', response.coupon_value);
                        $("#coupon_qty").attr('placeholder', response.coupon_qty);

                        $("#confirmEdit").attr('aid', aid);
                        $("#coupon_name").val(response.coupon_name);
                        $("#coupon_value").val(response.coupon_value);
                        $("#coupon_qty").val(response.coupon_qty);

                        $("#confirmEdit").click(function() {

                            coupon_name = $("#coupon_name").val();
                            coupon_value = $("#coupon_value").val();
                            coupon_qty = $("#coupon_qty").val();

                        });
                    }
                });
            });

            // Update Button in Edit modal
            $("#editForm").on("submit", function(event) {
                event.preventDefault();
                aid = $("#confirmEdit").attr('aid');
                coupon_name = $("#coupon_name").val();
                coupon_value = $("#coupon_value").val();
                coupon_qty = $("#coupon_qty").val();

                $.ajax({
                    url: "{{ url('/editCoupon_check') }}",
                    method: 'post',
                    data: {
                        _token: '{{ csrf_token() }}',
                        aid: aid,
                        coupon_name: coupon_name,
                        coupon_value: coupon_value,
                        coupon_qty: coupon_qty,
                        // assetdesc: assetdesc
                    },
                    dataType: "json",
                    success: function(response) {
                        var html = '';
                        if (response.errors) {
                            html =
                                '<div class="alert alert-danger">';
                            for (var count =
                                    0; count <
                                response
                                .errors
                                .length; count++) {
                                html += '<p>' +
                                    response
                                    .errors[count] +
                                    '</p>';
                            }
                            html += '</div>';
                        }
                        if (response.success) {
                            html =
                                '<div class="alert alert-success">' +
                                response.success +
                                '</div>';
                            // $("#example1").load(
                            //     location.href +
                            //     " #example1");
                            location.reload();

                            // $("#firstname").attr(
                            //     'placeholder',
                            //     firstname);
                            // $("#lastname").attr(
                            //     'placeholder',
                            //     lastname);


                            // $("#assetdesc").attr(
                            //     'placeholder',
                            //     assetdesc);


                            // $("#confirmEdit").attr(
                            //     'aid', aid);
                            // $("#firstname").val(
                            //     firstname);
                            // $("#lastname").val(
                            //     lastname);


                            // $("#assetdesc").val(
                            //     assetdesc);
                        }
                        $('#formResult').html(html);
                        setTimeout(() => {
                            $('#formResult')
                                .html('');
                        }, 2000);
                    }
                });
            });
        });
    </script>
@endsection
