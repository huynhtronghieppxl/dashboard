let datatableVATRestaurantSystem, datatableVATRestaurant, isSaveVATRestaurantSetting = 0;
$(function () {


    loadData();
})
async function loadData() {
    let method = 'get',
        url = 'vat-restaurant.data',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-vat-restaurant-setting-restaurant'), $('#table-vat-restaurant-setting-system')]);
    drawDataTableVATRestaurant(res.data);
    // $('#body-vat-restaurant-setting .toolbar-button-datatable').css({"transition" : "all .2s linear","opacity": "0.5", "pointer-events": "none"});
}

async function drawDataTableVATRestaurant(data) {
    let idRestaurant = $('#table-vat-restaurant-setting-restaurant'),
        idSystem = $('#table-vat-restaurant-setting-system'),
        fixed_left = 0,
        fixed_right = 0,
        columnRestaurant = [
            {data: 'action', name: 'action', className: 'text-left', width: '5%'},
            {data: 'vat_config_name', name: 'vat_config_name', className: 'text-left'},
            {data: 'vat_percent', name: 'vat_percent', className: 'text-center'},
            {data: 'keysearch', className:'d-none'},
        ],
        columnSystem = [
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'percent', name: 'percent', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className:'d-none'},
        ],
        option = [
            {
                'title': 'Cập nhật',
                'icon': 'fa fa-upload',
                'class': 'update-vat',
                'function': 'saveUpdateVATRestaurant',
            }
        ];
    datatableVATRestaurant = await DatatableTemplateNew(idRestaurant, data[1].original.data, columnRestaurant, vh_of_table, fixed_left, 2, option);
    datatableVATRestaurantSystem = await DatatableTemplateNew(idSystem, data[0].original.data, columnSystem, vh_of_table, 1, fixed_right);
     $('.toolbar-button-datatable').css({"transition" : "all .2s linear","opacity": "0.5", "pointer-events": "none"});

}

async function saveUpdateVATRestaurant(){
    if (isSaveVATRestaurantSetting !== 0) {
        return false;
    }
    isSaveVATRestaurantSetting = 1;
    let list_insert_ids = [],
        list_delete_ids = [];
    await datatableVATRestaurantSystem.rows().every(function () {
        let row = $(this.node());
        if (row.find('td:eq(2)').find('button').data('action') == 1) {
            list_delete_ids.push(row.find('td:eq(2)').find('button').data('id'));
        }
    });
    await datatableVATRestaurant.rows().every(function () {
        let row = $(this.node());
        if (row.find('td:eq(0)').find('button').data('action') == 0) {
            list_insert_ids.push(row.find('td:eq(0)').find('button').data('id'));
        }
    });
    let url = 'vat-restaurant.assign',
        data = {
            list_insert_ids: list_insert_ids,
            list_delete_ids: list_delete_ids
        };
    let res = await axiosTemplate('post', url, null, data, [$('#body-brand-supplier-material-data')]);
    isSaveVATRestaurantSetting = 0;
    switch (res.data.status) {
        case 200:
            SuccessNotify('Cập nhật thành công!');
            loadData();
            $('.toolbar-button-datatable').css({"transition" : "all .2s linear","opacity": "0.5", "pointer-events": "none"});
            break;
        case 500:
            ErrorNotify(res.data.message);
            break;
        default:
            WarningNotify(res.data.message);
    }
}

async function checkVATRestaurantSetting(r) {
    let item = {
        'vat_config_name': r.parents('tr').find('td:eq(0)').text(),
        'vat_percent' : r.parents('tr').find('td:eq(1)').text(),
        // 'action': '<i class="fa fa-2x fa-arrow-circle-left btn-convert-left-to-right" data-action="0" onclick="unCheckVATRestaurantSetting($(this))" data-id="' +  r.parents('tr').find('td:eq(2)').find('i').data('id') + '"></i>',
        'action': '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  data-action="0" onclick="unCheckVATRestaurantSetting($(this))" data-id="' +  r.parents('tr').find('td:eq(2)').find('button').data('id') + '"><i class="fi-rr-arrow-small-left"></i></button></div>',
        'keysearch':r.parents('tr').find('td:eq(3)').text(),
    };
    addRowDatatableTemplate(datatableVATRestaurant, item);
    datatableVATRestaurantSystem.row(r.parents('tr')).remove().draw(false);
    $('.toolbar-button-datatable').css({"transition" : "","opacity": "", "pointer-events": ""});
}

async function unCheckVATRestaurantSetting(r) {
    let item = {
        'name': r.parents('tr').find('td:eq(1)').text(),
        'percent' : r.parents('tr').find('td:eq(2)').text(),
        // 'action': '<i class="fa fa-2x fa-arrow-circle-right btn-convert-right-to-left" data-action="1" onclick="checkVATRestaurantSetting($(this))" data-id="' +  r.parents('tr').find('td:eq(0)').find('i').data('id') + '"></i>',
        'action': '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  data-action="1" onclick="checkVATRestaurantSetting($(this))" data-id="' +  r.parents('tr').find('td:eq(0)').find('button').data('id') + '"><i class="fi-rr-arrow-small-right"></i></button></div>',
        'keysearch':r.parents('tr').find('td:eq(3)').text(),
    };
    addRowDatatableTemplate(datatableVATRestaurantSystem, item);
    datatableVATRestaurant.row(r.parents('tr')).remove().draw(false);
    $('.toolbar-button-datatable').css({"transition" : "","opacity": "", "pointer-events": ""});
}
async function checkAllVATRestaurantSetting() {
    await addAllRowDatatableTemplate(datatableVATRestaurantSystem, datatableVATRestaurant, itemSystem);
    datatableVATRestaurant.page('last').draw(false);
    $(datatableVATRestaurant.table().node()).parent().scrollTop($(datatableVATRestaurant.table().node()).parent().get(0).scrollHeight);
    $('.toolbar-button-datatable').css({"transition" : "","opacity": "", "pointer-events": ""});

}

function itemSystem(r) {
    return {
        'vat_config_name': r.find('td:eq(0)').text(),
        'vat_percent' : r.find('td:eq(1)').text(),
        // 'action': '<i class="fa fa-2x fa-arrow-circle-left btn-convert-left-to-right" onclick="unCheckVATRestaurantSetting($(this))" data-action="0" data-id="' +  r.find('td:eq(2)').find('i').data('id') + '"></i>',
        'action': '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  data-action="0" onclick="unCheckVATRestaurantSetting($(this))" data-id="' +  r.find('td:eq(2)').find('button').data('id') + '"><i class="fi-rr-arrow-small-left"></i></button></div>',
        'keysearch':r.find('td:eq(3)').text(),
    };
}
