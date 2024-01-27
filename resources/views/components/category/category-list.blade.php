<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="row justify-content-between ">
                    <div class="align-items-center col">
                        <h4>Category</h4>
                    </div>
                    <div class="align-items-center col">
                        <button data-bs-toggle="modal" data-bs-target="#create-modal"
                            class="float-end btn m-0 bg-gradient-primary">Create</button>
                    </div>
                </div>
                <hr class="bg-secondary" />
                <div class="table-responsive">
                    <table class="table" id="tableData">
                        <thead>
                            <tr class="bg-light">
                                <th>No</th>
                                <th>Category</th>
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
</div>


<script>
    getList()
    async function getList() {
        showLoader();
        let res = await axios.get('/category-list');
        hideLoader();

        let tableData = $('#tableData')
        let tableList = $('#tableList')

        tableData.DataTable().destroy();
        tableList.empty();
        res.data.forEach(function(item, index) {
            let rows =
                `<tr>
                    <td>${index+1}</td>
                    <td>${item.name}</td>
                    <td class="d-flex gap-3">
                        <button data-id="${item.id}" class="btn btn-sm btn-outline-success">Edit</button>
                        <button data-id="${item.id}" class="btn btn-sm btn-outline-danger">Delete</button>
                    </td>
                </tr>`
            tableList.append(rows)
        });
        tableData.DataTable()
    }
</script>