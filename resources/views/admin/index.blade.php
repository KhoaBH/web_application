<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.layout.css')
</head>
<body>
<div class="container-scroller">
    @include('admin.layout.sidebar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.layout.header')

    </div>

</div>
<!-- container-scroller -->
<!-- plugins:js -->
@include('admin.layout.js')
</body>
