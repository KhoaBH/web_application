<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.layout.css')
</head>
<body>
<div class="container-scroller">
    @include('admin.layout.sidebar')
    @include('admin.layout.header')
    @include('admin.product.view_product_body')
    <!-- container-scroller -->
    <!-- plugins:js -->
@include('admin.layout.js')
</body>
