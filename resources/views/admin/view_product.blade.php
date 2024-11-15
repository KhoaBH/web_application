<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
</head>
<body>
<div class="container-scroller">
    @include('admin.sidebar')
    @include('admin.header')
    @include('admin.view_product_body')
    <!-- container-scroller -->
    <!-- plugins:js -->
@include('admin.js')
</body>
