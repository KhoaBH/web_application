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


