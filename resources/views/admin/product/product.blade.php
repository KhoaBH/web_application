<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.layout.css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
</head>
<body>
<div class="container-scroller">
    @include('admin.layout.sidebar')
    @include('admin.layout.header')
    @include('admin.product.add_product_body')
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.layout.js')
</div>

</body>
