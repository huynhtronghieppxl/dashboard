let idUpdateSupplierMaterialData,
    statusUpdateSupplierMaterialData,
    thisDataUpdateSupplierMaterialData,
    checkSaveModalUpdateSupplierMaterial = 0;

async function openModalUpdateSupplierMaterial(r) {
    $('#modal-update-supplier-material-data').modal('show');
    $('#category-update-supplier-material-data').val(null).trigger('change.select2');
    $('#unit-update-supplier-material-data').val(null).trigger('change.select2');
    $('#specifications-update-supplier-material-data').val(null).trigger('change.select2');

    addLoading('supplier-material-data.get-data-update', '.page-body');
    let id = r.data('id');
    thisDataUpdateSupplierMaterialData = r;

    shortcut.add('F4', function () {
        saveModalUpdateSupplierMaterial();
    });
    shortcut.add('ESC', function () {
        closeModalUpdateSupplierMaterial();
    });

    $('#modal-update-supplier-material-data .js-example-basic-single').select2({
        dropdownParent: $('#modal-update-supplier-material-data')
    });

    $('#unit-update-supplier-material-data').unbind('select2:select').on('select2:select', async function () {
        await getUpdateSpecifications($(this).val());
    });

    await getDataUpdateSupplierMaterial(id);
    $('#cost-price-update-supplier-material-data').on('focusout',function (){
        $('#cost-price-update-supplier-material-data').parent('.form-validate-input').removeClass('validate-error');
    })
    $('#retail-price-update-supplier-material-data').on('focusout',function (){
        $('#retail-price-update-supplier-material-data').parent('.form-validate-input').removeClass('validate-error');
    })
    $('#wholesale-price-update-supplier-material-data').on('focusout',function (){
        $('#wholesale-price-update-supplier-material-data').parent('.form-validate-input').removeClass('validate-error');
    })
}

async function getDataUpdateSupplierMaterial(id){
    let url = 'supplier-material-data.get-data-update',
        params = {material_id: id};
    let res = await axiosTemplate('get', url, params, null, [$('#category-update-supplier-material-data'), $('#unit-update-supplier-material-data'), $('#specifications-update-supplier-material-data')]);
    idUpdateSupplierMaterialData = await res.data[0].id;
    statusUpdateSupplierMaterialData = await res.data[0].status;
    await $('#category-update-supplier-material-data').html(res.data[1].categories);
    await $('#unit-update-supplier-material-data').html(res.data[1].unit);
    await $('#specifications-update-supplier-material-data').html(res.data[1].pecifications);
    $('#name-update-supplier-material-data').val(res.data[0].name);
    $('#code-update-supplier-material-data').text(res.data[0].code);
    $('#cost-price-update-supplier-material-data').val(formatNumber(res.data[0].cost_price));
    $('#retail-price-update-supplier-material-data').val(formatNumber(res.data[0].retail_price));
    $('#wastage-rate-update-supplier-material-data').val(res.data[0].wastage_rate);
    $('#wholesale-price-update-supplier-material-data').val(formatNumber(res.data[0].wholesale_price));
    $('#wholesale-price-quantity-update-supplier-material-data').val(formatNumber(res.data[0].wholesale_price_quantity));
    $('#out-stock-quantity-update-supplier-material-data').val(formatNumber(res.data[0].out_stock_alert_quantity));
}

async function getUpdateSpecifications(material_unit_id) {
    let method = 'get',
        url = 'supplier-material-data.get-specifications-by-unit',
        params = {material_unit_id: material_unit_id},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#specifications-update-supplier-material-data')]);
    await $('#specifications-update-supplier-material-data').html(res.data[0]);
}

async function saveModalUpdateSupplierMaterial() {
    if(checkSaveModalUpdateSupplierMaterial === 1) return false;
    if(!checkValidateSave($('#modal-update-supplier-material-data'))) return false;
    let name = $('#name-update-supplier-material-data').val(),
        code = removeVietnameseStringLowerCase(name).toUpperCase()
        category = $('#category-update-supplier-material-data').val(),
        unit = $('#unit-update-supplier-material-data').val(),
        specifications = $('#specifications-update-supplier-material-data').val(),
        cost_price = $('#cost-price-update-supplier-material-data').val(),
        retail_price = $('#retail-price-update-supplier-material-data').val(),
        wholesale_price = $('#wholesale-price-update-supplier-material-data').val(),
        wastage_rate = $('#wastage-rate-update-supplier-material-data').val(),
        wholesale_price_quantity = $('#wholesale-price-quantity-update-supplier-material-data').val(),
        out_stock_quantity = $('#out-stock-quantity-update-supplier-material-data').val();
    checkSaveModalUpdateSupplierMaterial = 1;
    let method = 'post',
        url = 'supplier-material-data.update-Supplier-material',
        params = null,
        data = {
            id: idUpdateSupplierMaterialData,
            status: statusUpdateSupplierMaterialData,
            supplier_id: $('.supplier-material-supplier-data').val(),
            code: code,
            name: name,
            material_category_id: category,
            cost_price: removeformatNumber(cost_price),
            wholesale_price: removeformatNumber(wholesale_price),
            retail_price: removeformatNumber(retail_price),
            wastage_rate: removeformatNumber(wastage_rate),
            wholesale_price_quantity: removeformatNumber(wholesale_price_quantity),
            out_stock_alert_quantity: removeformatNumber(out_stock_quantity),
            material_unit_id: unit,
            material_unit_specification_id: specifications,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-update-supplier-material')]);
    checkSaveModalUpdateSupplierMaterial = 0;
    switch(res.data.status) {
        case 200:
            SuccessNotify($('#success-update-data-to-server').text());
            closeModalUpdateSupplierMaterial()
            loadData()
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify(res.data.message);
    }
}

function closeModalUpdateSupplierMaterial() {
    $('#modal-update-supplier-material-data').modal('hide');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    reloadModalUpdateSupplierMaterial();
}

function reloadModalUpdateSupplierMaterial(){
    removeAllValidate();
    $('#name-update-supplier-material-data').val('');
    $('#code-update-supplier-material-data').text('');
    $('#cost-price-update-supplier-material-data').val('');
    $('#wastage-rate-update-supplier-material-data').val(0);
    $('#retail-price-update-supplier-material-data').val('');
    $('#wholesale-price-update-supplier-material-data').val('');
    $('#wholesale-price-quantity-update-supplier-material-data').val('');
    $('#out-stock-quantity-update-supplier-material-data').val('');
}
