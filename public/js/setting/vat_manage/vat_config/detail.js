function openModalDetailVatSetting(r){
    $('#modal-detail-food-vat-setting').modal('show');
    shortcut.remove("ESC");
    shortcut.add("ESC", function () {
        closeModalDetailVatSetting();
    });
    getDataDetailVatFoodSetting(r)
    $('#modal-detail-food-brand-manage').on('shown.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailFoodManage();
        });
    })

    $('#modal-detail-food-brand-manage').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailVatSetting();
        });
    })

}
async function getDataDetailVatFoodSetting (r){
    let method = 'get',
        url = 'vat-setting.detail-vat',
        restaurant_brand_id = $('.select-brand').val(),
        restaurant_vat_config_id = r.data('id'),
        params = {
            restaurant_brand_id : restaurant_brand_id,
            restaurant_vat_config_id : restaurant_vat_config_id,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-modal-detail-food-vat-setting'),
    ]);
    dataTableAdditionDetailVatSetting(res);
}

async function dataTableAdditionDetailVatSetting(data) {
    let idAdditionVatSetting = $('#table-addition-price-area-detail-food-branch-manage'),
        scroll_Y = "30vh",
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'avatar', name: 'avatar', class: 'text-left'},
            {data: 'category_type_name', name: 'category_type_name', className: 'text-left'},
            {data: 'unit_type', name: 'unit_type', className: 'text-left'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name:'keysearch',className:'d-none'}
        ],
        option = [];
    dataAddtionFoodBrandManage = await DatatableTemplateNew(idAdditionVatSetting, data.data[0].original.data, column, scroll_Y, fixed_left, fixed_right, option)
}

function closeModalDetailVatSetting (){
    $('#modal-detail-food-vat-setting').modal('hide');
    $('#table-price-area-detail-food-branch-manage').text('');
}
