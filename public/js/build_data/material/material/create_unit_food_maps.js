let idMaterial, unitIDMaterialUnitFoodMaps, checkSaveCreateMaterialUnitFoodData = 0;
function openModalSellingUnit(r){
    $('#modal-unit-food-maps').modal('show');
    $('#select-brand-create-material-unit-food-maps').select2({
        dropdownParent: $('#modal-unit-food-maps'),
    });
    idMaterial = r.data('id')
    $('#specification').text(r.data('unit-full-name'))
    $('#specification-value').text(r.data('exchange-value'))
    $('#specification-name').text(r.data('exchange-name'))

    loadDataMaterialUnitFoodMaps()
}
function openModalCreateMaterialUnitFoodData(){
    $('#modal-create-material-unit-food-data').modal('show');
    $('#specifications-create-material-unit-food-data, #unit-create-material-unit-food-data').select2({
        dropdownParent: $('#modal-create-material-unit-food-data'),
    });
    dataUnitCreateMaterialUnitFoodData()
    $('#unit-create-material-unit-food-data').unbind('select2:select').on('select2:select', async function () {
        await dataSpecificationsCreateMaterialUnitFoodData();
    });
}
async function loadDataMaterialUnitFoodMaps(){
    let method = 'get',
        url = 'material-data.unit-food-maps',
        params = {
            restaurant_material_id: idMaterial,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    drawTableSellingUnit(res)
}
async function saveModalCreateMaterialUnitFoodData(){
    if(checkSaveCreateMaterialUnitFoodData !== 0) return false;
    let material_unit_specification_exchange_name_id = $('#specifications-create-material-unit-food-data').find('option:selected').data('unit-id'),
        unit = $('#unit-create-material-unit-food-data').val(),
        value_exchange = removeformatNumber($('#value-exchange-material-unit-food').val());
    if (!checkValidateSave($('#create-material-unit-food-data'))) return false;
    let brand = $('#select-brand-create-material-unit-food-maps').val();
    let url = 'material-unit-food-data.create',
        method = 'post',
        params = null,
        data = {
            id_material: idMaterial,
            brand: brand,
            unit: unit,
            unit_exchange: material_unit_specification_exchange_name_id,
            value_exchange: value_exchange
        };
    checkSaveCreateMaterialUnitFoodData = 1;
    let res = await axiosTemplate(method, url, params, data, [$('#create-unit-data')]);
    checkSaveCreateMaterialUnitFoodData = 0;
    switch(res.data.status) {
        case 200:
            SuccessNotify($('#success-create-data-to-server').text());
            closeModalCreateMaterialUnitFoodData();
            loadData();
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify(res.data.message);
    }
}

async function dataBrand() {
    let method = 'get',
        url = 'material-unit-food-data.unit',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#modal-create-material-unit-food-data')]);
    $('#unit-create-material-unit-food-data').html(res.data[0])
    $('#unit-exchange-create-material-unit-food-data').html(res.data[1])
}

async function dataUnitCreateMaterialUnitFoodData() {
    let method = 'get',
        url = 'material-unit-food-data.unit',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#modal-create-material-unit-food-data')]);
    $('#unit-create-material-unit-food-data').html(res.data[0])
    $('#unit-exchange-create-material-unit-food-data').html(res.data[1])
}

async function dataSpecificationsCreateMaterialUnitFoodData() {
    let method = 'get',
        url = 'material-data.specifications',
        unit = $('#unit-create-material-unit-food-data').val(),
        params = {unit: unit},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#specifications-create-material-data')]);
    $('#specifications-create-material-unit-food-data').html(res.data[0]);
}

function closeModalSellingUnit(){
    $('#modal-unit-food-maps').modal('hide');
}

function closeModalCreateMaterialUnitFoodData(){
    $('#modal-create-material-unit-food-data').modal('hide');
    resetModalCreateMaterialUnitFoodData();
}

function resetModalCreateMaterialUnitFoodData(){
    $('#unit-create-material-unit-food-data').find('option:first').prop('selected', true).trigger('change.select2');
    $('#unit-exchange-create-material-unit-food-data').find('option:first').prop('selected', true).trigger('change.select2');
    $('#value-exchange-material-unit-food').val('');
    $('#modal-create-material-unit-food-data .btn-renew').addClass('d-none');
}
