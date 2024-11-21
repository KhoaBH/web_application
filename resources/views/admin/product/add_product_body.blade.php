<div class="main-panel">
    <h1>Add Category</h1>
    <form style=" width:50%" action="{{ route('add_product.post') }}"  method = 'POST' enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Product name</label>
            <input class="form-control" aria-describedby="emailHelp" placeholder="Tên" style="color: whitesmoke" name="name">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" name="description" style="color: whitesmoke;height:60px"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Price</label>
            <input class="form-control"  placeholder="0.00$" style="color: whitesmoke" name="price">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Quantity</label>
            <input class="form-control"  placeholder="Mô tả" style="color: whitesmoke" name="quantity">
        </div>
        <div class="form-group">
            <label for="select_page">Category</label>
            <select id="select_page" style="width:200px;" class="operator" name="category">
                <option>Select Category</option>
            @foreach($category as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Image</label>
            <input class="form-control" type="file" name="image" style="color: whitesmoke">
        </div>
        <button type="submit" class="btn btn-primary mb-3" style="margin-top: 20px">Confirm</button>

    </form>
</div>
<script>
</script>

<script>
    $(document).ready(function () {
        $("select").select2();
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
