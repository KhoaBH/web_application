<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

<title>Prime Picks</title>

<!-- Bootstrap core CSS -->
<link href="{{URL::asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{URL::asset('assets/css/fontawesome.css') }}">
<link rel="stylesheet" href="{{URL::asset('assets/css/templatemo-sixteen.css') }}">
<link rel="stylesheet" href="{{URL::asset('assets/css/owl.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMINyW45fYntpHEv2n5vE7sF4Cf/2v8Idkxyiq" crossorigin="anonymous">
<style>
    /* Product Card */
    .product-card {
        cursor: pointer;
        background-color: #fff;
        border: 1px solid #ccc;
        margin-bottom: 24px;
        border-radius:15px;
        transition: box-shadow 0.1s ease; /* Thêm hiệu ứng chuyển tiếp */
    }

    .product-card:hover {
        box-shadow: 0 0 11px rgba(33,33,33,.2);
    }
    .product-card a{
        text-decoration: none;
    }
    .product-card .stock{
        position: absolute;
        color: #fff;
        border-radius: 4px;
        padding: 2px 12px;
        margin: 8px;
        font-size: 12px;
    }
    .product-card .product-card-img{
        max-height: 260px;
        overflow: hidden;
        border-bottom: 1px solid #ccc;
    }
    .product-card .product-card-img img{
        width: 100%;
    }
    .product-card .product-card-body{
        padding: 10px 10px;
    }
    .product-card .product-card-body .product-brand{
        font-size: 14px;
        font-weight: 400;
        margin-bottom: 4px;
        color: #937979;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }
    .product-card .product-card-body .product-name{
        font-size: 20px;
        font-weight: 600;
        color: #000;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }
    .product-card .product-card-body .selling-price{
        font-size: 22px;
        color: #000;
        font-weight: 600;
        margin-right: 8px;
    }
    .product-card .product-card-body .original-price{
        font-size: 18px;
        color: #937979;
        font-weight: 400;
        text-decoration: line-through;
    }
    .product-card .product-card-body .btn1{
        border: 1px solid;
        margin-right: 3px;
        border-radius: 0px;
        font-size: 12px;
        margin-top: 10px;
    }
    /* Product Card End */
    /* Product View */
    .product-view .product-name{
        font-size: 24px;
        color: #2874f0;
    }
    .product-view .product-name .label-stock{
        font-size: 13px;
        padding: 4px 13px;
        border-radius: 5px;
        color: #fff;
        box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 8%);
        float: right;
    }
    .product-view .product-path{
        font-size: 13px;
        font-weight: 500;
        color: #252525;
        margin-bottom: 16px;
    }
    .product-view .selling-price{
        font-size: 26px;
        color: #000;
        font-weight: 600;
        margin-right: 8px;
    }
    .product-view .original-price{
        font-size: 18px;
        color: #937979;
        font-weight: 400;
        text-decoration: line-through;
    }
    .product-view .btn1{
        border: 1px solid;
        margin-right: 3px;
        border-radius: 0px;
        font-size: 14px;
        margin-top: 10px;
    }
    .product-view .btn1:hover{
        background-color: #2874f0;
        color: #fff;
    }
    .product-view .input-quantity{
        border: 1px solid #000;
        margin-right: 3px;
        font-size: 12px;
        margin-top: 10px;
        width: 58px;
        outline: none;
        text-align: center;
    }
    /* Product View */
</style>
