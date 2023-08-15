
$(function (){
    addLoading('category-group-material.data');
    loadData();
})

async function loadData(){
    let method = 'get',
        url = 'category-group-material.data',
        branch_id = $('#change_branch').val(),
        params = {
            branch_id: branch_id,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    dataTableGroupMaterialData(res);
}


function dataTableGroupMaterialData(data) {
    let id_table_enable = $('#table-category-material-data'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'description', name: 'description', className: 'text-center'},
            {data: 'created_at', name: 'created_at', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'}
        ],
        scroll_Y = null,
        fixed_left = null,
        fixed_right = null;
    DatatableTemplate(id_table_enable, data.data[0].original.data, column, scroll_Y, fixed_left, fixed_right);
}

function delectCategoryMaterial(id, branch_id) {
    let title = 'Xác nhận?',
        content = 'Bạn có muốn xoá nhóm nguyên liệu này ?',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'category-group-material.delect',
                params = null,
                data = {branch: branch_id, id: id};
            let res = await axiosTemplate(method, url, params, data);
            if (res.data.status === 200) {
                let text = $('#success-delete-data-to-server').text();
                SuccessNotify(text);
                loadData();
            } else {
                let text = $('#error-post-data-to-server').text();
                if (res.data.message !== null) {
                    text = res.data.message;
                }
                ErrorNotify(text);
                return false;
            }
        }
    })
}
