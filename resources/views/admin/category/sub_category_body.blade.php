<div class="main-panel">
    <h1>Sub Category</h1>
    <div class="button-container" style="width: 60%">
        <a class="btn btn-info" onclick="add_subcategory(this)">+ Add Category</a>
    </div>
    <table class="table " style="color: white; width:60%;">
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
        @foreach($data as $item)
            <tr>
                <th scope="row" style="display: none">{{$item->id}}</th>
                <td>{{$item->name}}</td>
                <td>{{$item->description}}</td>
                <td data-id="{{ $item->category_id }}">{{ $categories[$item->category_id] }}</td>
                <td><a href="{{ url('edit_category', $item->id) }}" class="btn btn-success" onclick="edit_sub_category(event,this)">Edit</a></td>
                <td><a href="{{ url('sub_category_delete', $item->id) }}" class="btn btn-danger" onclick="delete_alert(event)">Delete</a></td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
<script>
    async function edit_sub_category(event,element){
        event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
        const row = element.closest('tr');
        const id = row.children[0].textContent;       // Cột đầu tiên là name
        const name = row.children[1].textContent;
        const description = row.children[2].textContent;
        const category_id = row.children[3].getAttribute("data-id");// Cột thứ hai là description
        console.log(category_id);
        const categories = @json($category); // Biến PHP chuyển thành JSON
        let optionsHtml = ``;
        categories.forEach(function(cat) {
            optionsHtml += `<option value="${cat.id}" ${cat.id == category_id ? 'selected' : ''}>${cat.name}</option>`;
        });
        const { value: formValues, isConfirmed } = await Swal.fire({
            title: "<h5 style='color:#151313; font-size: 35px'>Edit category</h5>",
            html: `
        <label style="color:black">Name</label>
        <input id="swal-input1" class="swal2-input" placeholder="${name}" value="${name}" style="background-color:white;color:black;">
        <label style="color:black">Description</label>
        <input id="swal-input2" class="swal2-input" placeholder="${description}" value="${description}" style="background-color:white;color:black;">
        <select id="select_page" style="width:200px;" class="operator" name="category"><br>
        <label for="select_page" style="color:black">Category</label>
                ${optionsHtml}
        </select><br><br>
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
                    document.getElementById("swal-input2").value,
                    document.getElementById("select_page").value
                ]
            },
            if (isConfirmed) {
                const updatedName = document.getElementById("swal-input1").value;
                const updatedDescription = document.getElementById("swal-input2").value;
                const updatedCategoryId = document.getElementById("select_page").value;

                // Xử lý dữ liệu và gọi API hoặc làm các thao tác sau khi lưu
                Swal.fire({
                    title: "Edit!",
                    text: "Your work has been saved",
                    icon: "success",
                    color: "#000000",
                    background: "white",
                }).then((next_result) => {
                    if (next_result.isConfirmed) {
                        const data = encodeURIComponent(JSON.stringify(formValues));
                        const url = `{{ route('admin.sub_category_edit', ['data' => ':data']) }}`.replace(':data', data);
                        window.location.href = url;
                    }
                });
            }



        });
            Swal.fire({
                title: "Edit!",
                text: "Your work has been saved",
                icon: "success",
                color:"#000000",
                background:"white",
            }).then((next_result) =>{
                if(next_result.isConfirmed){
                    if (isConfirmed && formValues) {
                        const data = encodeURIComponent(JSON.stringify(formValues));
                        const url = `{{ route('admin.sub_category_edit', ['data' => ':data']) }}`.replace(':data', data);
                        window.location.href = url;
                    } else {
                        // Xử lý khi người dùng nhấn "Cancel", nếu cần
                        console.log("User cancelled the edit.");
                    }
                }
            });
    }
    function delete_alert(event){
        event.preventDefault();
        var urlToDirect = event.currentTarget.getAttribute('href');
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
                    text: "Your sub category has been deleted.",
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
    async function add_subcategory(element) {
        const categories = @json($category);
        let optionsHtml = `<select id="select_page" class="swal2-input" style="background-color:white;color:black;">`;
        categories.forEach(cat => {
            optionsHtml += `<option value="${cat.id}">${cat.name}</option>`;
        });
        optionsHtml += `</select>`; // Đóng thẻ <select>

// Khởi tạo Swal
        const { value: formValues } = await Swal.fire({
            title: "<h5 style='color:#151313; font-size: 35px'>Add Sub Category</h5>",
            background: "white",
            html: `
        <label style="color:black">Name</label>
        <input id="swal-input1" class="swal2-input" placeholder="" style="background-color:white;color:black;">
        <label style="color:black">Description</label>
        <input id="swal-input2" class="swal2-input" placeholder="" style="background-color:white;color:black;">
        <label for="select_page" style="color:black">Category</label>
        ${optionsHtml}  <!-- Đây là phần select bạn cần thêm vào -->
        <br><br>
    `,
            focusConfirm: false,
            preConfirm: () => {
                return [
                    document.getElementById("swal-input1").value,  // Tên sub-category
                    document.getElementById("swal-input2").value,  // Mô tả
                    document.getElementById("select_page").value   // Category đã chọn
                ];
            }
        });
        if (formValues) {
            const encodedData = encodeURIComponent(JSON.stringify(formValues)); // Mã hóa JSON
            location.href = "add_sub_category/" + encodedData; // Điều hướng tới route
        }
    }
</script>
<style>
    input{
        background-color: white;
        color:black;
    }
    .main-panel {
        display: flex;
        flex-direction: column; /* Giữ các phần tử xếp theo chiều dọc */
        justify-content: flex-start; /* Căn phần tử về phía trên cùng theo trục ngang */
        margin: 0; /* Loại bỏ khoảng cách ngoài */
        padding: 0; /* Loại bỏ khoảng cách bên trong */
        height: 100vh; /* Đảm bảo chiều cao toàn màn hình nếu cần */
        padding-top:80px ;
    }
    .button-container {
        display: flex;
        justify-content: flex-end;  /* Căn button sang bên phải */
        align-items: flex-end;
        margin-bottom: 15px; /* Tạo khoảng cách với bảng */
    }

    .custom-title{
        color:white;
    }
</style>


