<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">   
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>   
    <script src="https://kit.fontawesome.com/a5f11d31b0.js" crossorigin="anonymous"></script>

    <title>Universidad</title>
</head>

<body class="g-sidenav-show  bg-gray-200">

    @include('frontend.Layout.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        {{-- @include('frontend.Layout.header') --}}
        @section('main-content')
        @show
        {{-- @include('frontend.Layout.footer') --}}
    </main>

    @include('frontend.Layout.common-end')
    @stack('custom-scripts')

    @yield('js')
</body>

</html>
