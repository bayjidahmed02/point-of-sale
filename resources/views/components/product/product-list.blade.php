<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="row justify-content-between ">
                    <div class="align-items-center col">
                        <h4>Product</h4>
                    </div>
                    <div class="align-items-center col">
                        <button data-bs-toggle="modal" data-bs-target="#create-modal"
                            class="float-end btn m-0  bg-gradient-primary">Create</button>
                    </div>
                </div>
                <hr class="bg-dark " />
                <table class="table" id="tableData">
                    <thead>
                        <tr class="bg-light">
                            <th>SL no</th>
                            <th>Image</th>
                            <th>Name</th>
                            {{-- <th>Category Name</th> --}}
                            <th>Price</th>
                            <th>Unit</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableList">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    getList();
    async function getList() {
        showLoader();
        let res = await axios.get('/product-list');
        hideLoader();

        let tableData = $('#tableData');
        let tableList = $('#tableList');

        tableData.DataTable().destroy();
        tableList.empty();

        res.data.forEach(function(item, index) {
            let rows =
                `<tr>
                    <td>${index+1}</td>
                    <td><img class="w-30 h-auto" src="${item.img_url}"/></td>
                    <td>${item.name}</td>
                    <td>${item.price}</td>
                    <td>${item.unit}</td>
                    <td>
                        <button data-id="${item.id}" class="addBtn btn btn-sm btn-success">Add</button>
                        <button data-path="${item.img_url}" data-id="${item.id}" class="editBtn btn btn-sm btn-outline-success">Edit</button>
                        <button data-path="${item.img_url}" data-id="${item.id}" class="deleteBtn btn btn-sm btn-outline-danger">Delete</button>
                    </td>
                </tr>`
            tableList.append(rows);
        });

        $('.editBtn').on('click', async function() {
            let id = $(this).data('id');
            let img_url = $(this).data('path')
            await FillupUpdateForm(id, img_url);
            $('#update-modal').modal('show');
        })

        $('.deleteBtn').on('click', function() {
            let id = $(this).data('id')
            let img_url = $(this).data('path')
            $('#delete-modal').modal('show');
            $('#deleteID').val(id)
            $('#deleteFilePath').val(img_url)
        })

        $('.addBtn').on('click', function() {
            let id = $(this).data('id');
            $('#addProductId').val(id);
            $('#add-quantity').modal('show');
        });

        tableData.DataTable({
            lengthMenu: [10, 20, 50]
        })
    }
</script>
