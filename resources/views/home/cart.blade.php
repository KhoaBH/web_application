<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>

<!-- ***** Preloader Start ***** -->
<div id="preloader">
    <div class="jumper">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
<!-- ***** Preloader End ***** -->

<!-- Header -->
@include('home.header')
@include('home.cart_detail')
<!-- Page Content -->

</body>
@include('home.js')
</html>
