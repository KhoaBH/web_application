<div class="main-panel">
    <h1>Add Category</h1>
    <form style=" width:50%" action="{{ route('add_category.post') }}" method = 'POST'>
        @csrf

        <div class="form-group">
            <label for="exampleInputEmail1">Tên</label>
            <input class="form-control" aria-describedby="emailHelp" placeholder="Tên" style="color: whitesmoke" name="name">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Thêm mô tả</label>
            <input class="form-control"  placeholder="Mô tả" style="color: whitesmoke" name="description">
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
    <form action="{{ route('admin.selected_category') }}" method = 'get' style="width:60%;; margin-top:30px">
        <div class="d-flex" >
            <input name='search' class="form-control mr-2" type="search" placeholder="Search" aria-label="Search" style="width:20%;color:white">
            <input type="submit" href="{{ url('selected_category') }}" class="btn btn-secondary d-flex align-items-center justify-content-center" value="Search">
        </div>
    </form>


    <table class="table " style="color: white; width:60%">
        <thead class="thead-light">
        <tr>
            <th scope="col" style="display: none">#</th>
            <th scope="col">Tên danh mục</th>
            <th scope="col">Mô tả</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $data)
            <tr>
                <th scope="row" style="display: none">{{$data->id}}</th>
                <td>{{$data->name}}</td>
                <td>{{$data->description}}</td>
                <td><a href="{{ url('edit_category', $data->id) }}" class="btn btn-success" onclick="edit_category(event,this)">Edit</a></td>
                <td><a href="{{ url('delete_category', $data->id) }}" class="btn btn-danger" onclick="delete_alert(event)">Delete</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<script>
    async function edit_category(event,element){
        event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
        const row = element.closest('tr');
        const id = row.children[0].textContent;       // Cột đầu tiên là name
        const name = row.children[1].textContent;
        const description = row.children[2].textContent; // Cột thứ hai là description

        const { value: formValues, isConfirmed } = await Swal.fire({
            title: "<h5 style='color:#151313; font-size: 35px'>Edit category</h5>",
            html: `
        <label style="color:black">Name</label>
        <input id="swal-input1" class="swal2-input" placeholder="${name}" value="${name}" style="background-color:white;color:black;">
        <label style="color:black">Description</label>
        <input id="swal-input2" class="swal2-input" placeholder="${description}" value="${description}" style="background-color:white;color:black;">
    `,
            focusConfirm: false,
            background: "white",
            showCancelButton: true,  // Hiển thị nút "Cancel"
            confirmButtonText: "Save",
            cancelButtonText: "Cancel",
            preConfirm: () => {
                return [
                    id,
                    document.getElementById("swal-input1").value,
                    document.getElementById("swal-input2").value
                ];

            }
        });

        if (isConfirmed && formValues) {
            const data = encodeURIComponent(JSON.stringify(formValues));
            const url = `{{ route('admin.edit_category', ['data' => ':data']) }}`.replace(':data', data);
            window.location.href = url;
        } else {
            // Xử lý khi người dùng nhấn "Cancel", nếu cần
            console.log("User cancelled the edit.");
        }
    }
    function delete_alert(ev){
        ev.preventDefault();
        var urlToDirect = ev.currentTarget.getAttribute('href');
        console.log(urlToDirect);
        Swal.fire({
            title: "<h5 style='color:#151313; font-size: 35px'>Are you sure?</h5>",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            color:"#000000",
            background:"white",
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Deleted!",
                    text: "Your category has been deleted.",
                    icon: "success",
                    color:"#000000",
                    background:"white",
                }).then((next_result) =>{
                    if(next_result.isConfirmed){
                        window.location.href=urlToDirect;
                    }
                });
            }
        });

    }
</script>
<style>
    .custom-title{
        color:white;
    }
</style>


