let dataCategorySupplierMaterialData = null,
    dataUnitSupplierMaterialData = null,
    checkSaveModalCreateSupplierMaterial = 0;
function openModalCreateSupplierMaterial() {
    $('#modal-create-supplier-material-data').modal('show');
    shortcut.add('F4', function () {
        saveModalCreateSupplierMaterial();
    });
    shortcut.add('ESC', function () {
        closeModalCreateSupplierMaterial();
    });

    $('#category-create-supplier-material-data ,#unit-create-supplier-material-data ,#specifications-create-supplier-material-data').select2({
        dropdownParent: $('#modal-create-supplier-material-data'),
    });
    $('#name-create-supplier-material-data').on('keyup', function () {
        $('#code-create-supplier-material-data').val(removeVietnameseStringLowerCase($(this).val()).toUpperCase());
    });
    $('#code-create-supplier-material-data').on('input', function () {
        $(this).val(removeVietnameseStringLowerCase($(this).val()).toUpperCase());
    });

    $('#unit-create-supplier-material-data').unbind('select2:select').on('select2:select', async function () {
        await getSpecifications($(this).val());
    });
    $(document).on('select2:open', '#specifications-create-supplier-material-data', function () {
        if ($('#unit-create-supplier-material-data').val() == '' || $('#unit-create-supplier-material-data').val() == null) {
            $('#unit-create-supplier-material-data').parent().addClass('validate-error');
            $('#specifications-create-supplier-material-data').select2('close');
        }
    })

    if(dataCategorySupplierMaterialData === null || dataUnitSupplierMaterialData === null){
        getDataCreate();
    }
    $('#cost-price-create-supplier-material-data').on('focusout',function (){
        $('#cost-price-create-supplier-material-data').parent('.form-validate-input').removeClass('validate-error');
    })
    $('#retail-price-create-supplier-material-data').on('focusout',function (){
        $('#retail-price-create-supplier-material-data').parent('.form-validate-input').removeClass('validate-error');
    })
    $('#wholesale-price-create-supplier-material-data').on('focusout',function (){
        $('#wholesale-price-create-supplier-material-data').parent('.form-validate-input').removeClass('validate-error');
    })
    $('#modal-create-supplier-material-data input').on('input', function(){
        $('#modal-create-supplier-material-data .btn-renew').removeClass('d-none')
    })
    $('#modal-create-supplier-material-data select').on('change', function(){
        $('#modal-create-supplier-material-data .btn-renew').removeClass('d-none')
    })

}

async function getDataCreate() {
    let method = 'get',
        url = 'supplier-material-data.get-data-create',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#category-create-supplier-material-data'), $('#unit-create-supplier-material-data')]);
    dataCategorySupplierMaterialData = await $('#category-create-supplier-material-data').html(res.data[0]);
    dataUnitSupplierMaterialData =  await $('#unit-create-supplier-material-data').html(res.data[1]);
}

async function getSpecifications(material_unit_id) {
    let method = 'get',
        url = 'supplier-material-data.get-specifications-by-unit',
        params = {material_unit_id: material_unit_id},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#specifications-create-supplier-material-data')]);
    await $('#specifications-create-supplier-material-data').html(res.data[0]);
}

async function saveModalCreateSupplierMaterial() {
    if(checkSaveModalCreateSupplierMaterial === 1 ) return false;
    if(!checkValidateSave($('#modal-create-supplier-material-data'))) return false;
    let name = $('#name-create-supplier-material-data').val(),
        code = $('#code-create-supplier-material-data').val(),
        category = $('#category-create-supplier-material-data').val(),
        unit = $('#unit-create-supplier-material-data').val(),
        specifications = $('#specifications-create-supplier-material-data').val(),
        cost_price = $('#cost-price-create-supplier-material-data').val(),
        retail_price = $('#retail-price-create-supplier-material-data').val(),
        wholesale_price = $('#wholesale-price-create-supplier-material-data').val(),
        wholesale_price_quantity = $('#wholesale-price-quantity-create-supplier-material-data').val(),
        out_stock_quantity = $('#out-stock-quantity-create-supplier-material-data').val(),
        wastage_rate = $('#wastage-rate-create-supplier-material-data').val();

    checkSaveModalCreateSupplierMaterial = 1;
    let method = 'post',
        url = 'supplier-material-data.create-Supplier-material',
        params = null,
        data = {
            supplier_id: $('.supplier-material-supplier-data').val(),
            code: code,
            name: name,
            material_category_id: category,
            cost_price: removeformatNumber(cost_price),
            wholesale_price: removeformatNumber(wholesale_price),
            retail_price: removeformatNumber(retail_price),
            wholesale_price_quantity: removeformatNumber(wholesale_price_quantity),
            out_stock_alert_quantity: removeformatNumber(out_stock_quantity),
            wastage_rate : wastage_rate,
            material_unit_id: unit,
            material_unit_specification_id: specifications,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-create-supplier-material')]);
    checkSaveModalCreateSupplierMaterial = 0;
    switch(res.data.status) {
        case 200:
            SuccessNotify($('#success-create-data-to-server').text());
            closeModalCreateSupplierMaterial()
            loadData()
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify(res.data.message);
    }
}

function drawDataTableSupplierMaterial(data){
    addRowDatatableTemplate(dataTableSupplierMaterialEnable, {
        'name': data.name,
        'code': data.code,
        'material_category_name': data.material_category_name,
        'material_unit_name': data.material_unit_name,
        'cost_price':  data.cost_price ,
        'action':  data.action ,
        'keysearch' : data.keysearch
    });
    $('#total-record-enable').text(formatNumber(removeformatNumber(Number($('#total-record-enable').text()) + 1)));
}

function closeModalCreateSupplierMaterial() {
    removeAllValidate();
    $('#modal-create-supplier-material-data').modal('hide');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    resetModalCreateSupplierMaterial();
}

function resetModalCreateSupplierMaterial() {
    $('#name-create-supplier-material-data').val('');
    $('#code-create-supplier-material-data').val('');
    $('#cost-price-create-supplier-material-data').val(0);
    $('#retail-price-create-supplier-material-data').val(0);
    $('#wholesale-price-create-supplier-material-data').val(0);
    $('#wastage-rate-create-supplier-material-data').val(0);
    $('#wholesale-price-quantity-create-supplier-material-data').val(0);
    $('#out-stock-quantity-create-supplier-material-data').val(0);
    $('#unit-create-supplier-material-data').val('').trigger('change.select2');
    $('#category-create-supplier-material-data').val('').trigger('change.select2');
    $('#specifications-create-supplier-material-data').html('<option value="" selected disabled hidden>--- Chưa có dữ liệu ---</option>');
    $('#modal-create-supplier-material-data .btn-renew').addClass('d-none')
}
