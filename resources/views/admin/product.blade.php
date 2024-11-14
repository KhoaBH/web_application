<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
</head>
<body>
<div class="container-scroller">
    @include('admin.sidebar')
    @include('admin.header')
    @include('admin.add_product_body')
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.js')
</div>

</body>
