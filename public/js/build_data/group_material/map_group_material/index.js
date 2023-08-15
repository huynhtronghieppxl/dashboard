let table_not_select_map_group_material = [], table_select_map_group_material = [];
$(function (){
    addLoading('map-group-material.dataCategory');
    addLoading('map-group-material.material-category');

    loadData();
});

async function loadData() {
    let branch_id = $('#change_branch').val();
    let method = 'get',
        url = 'map-group-material.dataCategory',
        params = {
            branch_id : branch_id
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
   $('#select-category-map-group-material-data').html(res.data[0]);
   $('#select-category-map-group-material-data').on('change', function (){
       material();
       materialCategory();
   })
    material();
    materialCategory();
}


async function materialCategory(){
    let branch_id = $('#change_branch').val();
    let method = 'get',
        url = 'map-group-material.material-category',
        params = {
            id : $('#select-category-map-group-material-data').val(),
            branch_id : branch_id
        },
        data = {};
    let res = await axiosTemplate(method, url, params, data);
    let id_table_select = $('#table-map-material-data'),
        column1 = [
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'system_last_quantity', name: 'system_last_quantity', className: 'text-center'},
        ],
        fixed_left = null,
        fixed_right = null;
    table_select_map_group_material = await  DatatableTemplate(id_table_select, res.data[0].original.data, column1, vh_of_table, fixed_left, fixed_right);
}


async function material(){
    let branch_id = $('#change_branch').val();
    let method = 'get',
        url = 'map-group-material.material',
        params = {
            branch_id : branch_id
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    dataTableGroupMapMaterialData(res);
}

async function dataTableGroupMapMaterialData(data) {
    let id_table_enable = $('#table-not-map-group-material-data'),
        column = [
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'system_last_quantity', name: 'system_last_quantity', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ],
        fixed_left = null,
        fixed_right = null;
    table_not_select_map_group_material = await DatatableTemplate(id_table_enable, data.data[0].original.data, column, vh_of_table, fixed_left, fixed_right);

}

async function  checkmaterialGroupData(r){
    let data = {
        'id' : r.parents('tr').find('td:eq(2)').find('i').data('id'),
        'name' : r.parents('tr').find('td:eq(0)').text(),
        'system_last_quantity' : r.parents('tr').find('td:eq(1)').text(),
        'action' : '<i class="fa fa-2x fa-arrow-circle-left btn-convert-left-to-right pointer" data-action="0" onclick="removeCheckmaterialGroupData($(this))" data-id="' + r.parents('tr').find('td:eq(2)').find('i').data('id') + '"></i>'
    }
    addRowDatatableTemplate(table_select_map_group_material , data);
    table_not_select_map_group_material.row(r.parents('tr')).remove().draw(false);
}

async function  removeCheckmaterialGroupData(r){
    let data = {
        'id' : r.parents('tr').find('td:eq(0)').find('i').data('id'),
        'name' : r.parents('tr').find('td:eq(1)').text(),
        'system_last_quantity' : r.parents('tr').find('td:eq(2)').text(),
        'action' : '<i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right pointer" data-action="0" onclick="checkmaterialGroupData($(this))" data-id="' + r.parents('tr').find('td:eq(0)').find('i').data('id') + '"></i>'
    }
    addRowDatatableTemplate(table_not_select_map_group_material , data);
    table_select_map_group_material.row(r.parents('tr')).remove().draw(false);
}

async function saveMapmaterialGroup() {
    let material = [];
    await table_select_map_group_material.rows().every(function (index, element) {
        let row = $(this.node());
        material.push(row.find('td:eq(0)').find('i').data('id'));
    });
    let method = 'POST',
        url = 'map-group-material.map-material',
        params = {
            id : $('#select-category-map-group-material-data').val()
        },
        data = {
            material : material
        };
    let res = await axiosTemplate(method, url, params, data);
    if (res.data.status === 200) {
        let text = $('#success-update-data-to-server').text();
        SuccessNotify(text);
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
    }
}
