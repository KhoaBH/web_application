<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')
</head>

<body>

<!-- ***** Preloader Start ***** -->
<!-- ***** Preloader End ***** -->
<!-- Header -->
@include('home.header')
</body>

<div class="container" style="width:97%; justify-content: flex-start; padding-left:10px; padding-top: 100px;" >
    <form action="{{ route('seller_register.post') }}" method="POST">
        @csrf
        <a href="javascript:history.back()" class="btn btn-primary">
            <i class="fa fa-light fa-angle-left"></i> Back
        </a>

        <!-- Name and Email fields in the same line -->
        <div class="mb-3" style="display: flex; gap: 10px;">
            <!-- Business Name field -->
            <div style="flex: 1;">
                <label for="exampleInputName" class="form-label">Business Name</label>
                <input type="text" class="form-control" id="exampleInputName" name="name" required>
            </div>

            <!-- Business Email field -->
            <div style="flex: 1;">
                <label for="exampleInputEmail1" class="form-label">Business Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" required>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
        </div>
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <!-- Phone and Address fields in the same line -->
        <div class="mb-3" style="display: flex; gap: 10px;">
            <!-- Phone field -->
            <div style="flex: 1;">
                <label for="exampleInputPhone" class="form-label">Phone</label>
                <input type="tel" class="form-control" id="exampleInputPhone" name="phone" required>
            </div>

            <!-- Address field -->
            <div style="flex: 1;">
                <label for="exampleInputAddress" class="form-label">Address</label>
                <input type="text" class="form-control" id="exampleInputAddress" name="address" required>
            </div>
        </div>

        <!-- Description field -->
        <div class="mb-3">
            <label for="exampleInputDescription" class="form-label">Description</label>
            <textarea class="form-control" id="exampleInputDescription" name="description" rows="3" placeholder="Provide a brief description of your business, what you offer, and your target market." required></textarea>
        </div>
        <!-- Submit button -->
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>
</div>
<div class="best-features">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>About Prime Picks</h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="left-content" style="font-family: 'Montserrat', sans-serif;">
                    <h4>Looking for Quality Products?</h4>
                    <p><a rel="nofollow" href="https://templatemo.com/tm-546-sixteen-clothing" target="_parent">Prime Picks</a> is the place to find the finest products! <br>Let Prime Picks be your trusted shopping partner, offering the best products and excellent services!</p>
                    <ul class="featured-list">
                        <li><a href="#">Top Quality</a></li>
                        <li><a href="#">Variety</a></li>
                        <li><a href="#">Affordable Prices</a></li>
                        <li><a href="#">Customer Service Excellence</a></li>
                    </ul>
                    <a href="about.html" class="filled-button">Read More</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="right-image">
                    <img src="assets/images/feature-image.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</div>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="inner-content">
                    <p>Copyright &copy; 2024 Prime Picks Co., Ltd.
                        - Design: <a rel="nofollow noopener" href="https://templatemo.com" target="_blank">KHOADAUBU</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>

@include('home.js')
</html>
