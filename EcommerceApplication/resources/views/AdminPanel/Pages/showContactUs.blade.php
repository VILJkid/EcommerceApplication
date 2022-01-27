{{-- View for Show Asset --}}

{{-- Extending the master template. --}}
@extends('AdminPanel.master')

{{-- Title of the document. --}}
@section('title')
    <title>Display Orders</title>
@endsection

{{-- Header, consisting of a heading and breadcrumb. --}}
@section('header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Show Contact Us</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/showContactUs">Show Contact Us</a></li>
                        <li class="breadcrumb-item active">Manage Notifications</li>
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
                            <h3 class="card-title">Contact Us Details</h3>
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
                                        <th class="align-middle">Name</th>
                                        <th class="align-middle">Email</th>
                                        <th class="align-middle">Subject</th>
                                        <th class="align-middle">Message</th>
                                        <th class="align-middle">Contacted</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- If no records found --}}
                                    @if (empty($aData[0]->name))
                                        <tr>
                                            <td class="align-middle" colspan="5">Nothing
                                                here, only pain and sorrow.
                                            </td>
                                        </tr>
                                    @else
                                        {{-- If records found --}}
                                        @foreach ($aData as $adata)
                                            @php
                                                // Split the asset code into 4 parts
                                                // $acode = str_split($adata->assetcode, 4);
                                            @endphp
                                            <tr>

                                                {{-- Name --}}
                                                <td class="align-middle">
                                                    {{ $adata->name }}
                                                </td>

                                                {{-- Email --}}
                                                <td class="align-middle">
                                                    {{ $adata->email }}</td>

                                                {{-- Subject --}}
                                                <td class="align-middle">
                                                    {{ $adata->subject }}</td>

                                                {{-- Message --}}
                                                <td class="align-middle">
                                                    {{ $adata->message }}</td>

                                                {{-- Contacted --}}
                                                <td class="align-middle">{{ time_Ago(strtotime($adata->updated_at)) }}
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{-- <a href="/addProduct" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add
                                Product</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('extrajs')

@endsection
