<div class="main-panel">
    <h1>Thêm Danh mục</h1>
    <form style=" width:50%" action="{{ route('add_category.post') }}" method = 'POST'>
        @csrf

        <div class="form-group">
            <label for="exampleInputEmail1">Tên</label>
            <input class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Tên" style="color: whitesmoke" name="name">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Thêm mô tả</label>
            <input class="form-control"  placeholder="Mô tả" style="color: whitesmoke" name="description">
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <table class="table" style="color: white">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tên danh mục</th>
            <th scope="col">Mô tả</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $data)
            <tr>
                <th scope="row">{{$data->id}}</th>
                <td>{{$data->name}}</td>
                <td>{{$data->description}}</td>
                <td><a href="{{ url('delete_category', $data->id) }}" class="btn btn-danger">Xóa</a></td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>


