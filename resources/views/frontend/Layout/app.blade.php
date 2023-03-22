<!DOCTYPE html>
<html lang="en">

<head>
    <script src="cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"></script>
    <script src="cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"></script>
    @include('frontend.Layout.common-head')
</head>

<body class="g-sidenav-show  bg-gray-200">

    @include('frontend.Layout.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('frontend.Layout.header')
        @section('main-content')
        @show
        @include('frontend.Layout.footer')
    </main>

        @include('frontend.Layout.common-end')
        @stack('custom-scripts')
</body>

</html>
