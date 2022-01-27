{{-- Master template for all the views. --}}

<!DOCTYPE html>
<html lang="en">

<head>
    {{-- Include CSS files. --}}
    @include('AdminPanel.Include.head')

    {{-- Title of the document. --}}
    @yield('title')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        {{-- Navigation bar. --}}
        @include('AdminPanel.Include.nav')

        {{-- Sidebar. --}}
        @include('AdminPanel.Include.sidebar')

        {{-- Cat welcomes the user. --}}
        @yield('cat')
        <div class="content-wrapper">

            {{-- Header, consisting of a heading and breadcrumb. --}}
            @yield('header')

            {{-- The main content. --}}
            @yield('main')
        </div>

        {{-- The footer part of the page. --}}
        @include('AdminPanel.Include.footer')

        {{-- Experimental feature for Dark Mode. You can ignore this. --}}
        @include('AdminPanel.Include.control-sidebar')
    </div>
    {{-- All JS/jQuery scripts goes here. --}}
    @include('AdminPanel.Include.foot')

    {{-- Scripts related to the specific page goes here. --}}
    @yield('extrajs')
</body>

</html>
