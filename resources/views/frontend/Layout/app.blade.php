<!DOCTYPE html>
<html lang="en">

<head>
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