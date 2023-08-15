let idUnitUpdateMaterial, materialNewId , specNewId , rateMaterial,
     thisUpdate, idSpecUpdateMaterial, idUnitUpdateMaterialNew, idUnitAfterSaveMaterialData, idSpeAfterSaveMaterialData;

$(function (){
    $(document).on('input paste', '#value-exchange-rate-material-data', function(){
        $('#value-exchange-rate-material-data').val($(this).val())
        $('#note-ratio-exchange-update-spe-material-data').text(formatNumber($(this).val()))
    })
})

async function openModalUpdateUnitMaterial(r, thisNew){
    $('#modal-update-unit-food-maps').modal('show');
    idUnitUpdateMaterial = r.data('unit');
    thisUpdate = r;
    idUnitUpdateMaterialNew = thisNew;
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalUpdateUnitMaterial();
    })
    $('#modal-update-unit-food-maps').on('hidden.bs.modal', function () {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalUpdateMaterialData()
        })
    })
    $('#name-unit-update-brand-manage').text(r.data('name'));
    $('#name-unit-specification-update-brand-manage').text(r.data('specification'));
    // $('#note-value-exchange-update-spe-material-data').text($('#value-exchange-rate-material-data').val() + ' ' + r.data('name') + ' = ');
    $('#note-value-exchange-update-spe-material-data').text('1 ' + r.data('name') + ' = ');
    if(catchValueExchangeUpdateUnitMaterialData.unit_current_id == catchValueExchangeUpdateUnitMaterialData.unit){
        $('#note-ratio-exchange-update-spe-material-data').text(catchValueExchangeUpdateUnitMaterialData.exchange_current_value);
        $('#value-exchange-rate-material-data').val(catchValueExchangeUpdateUnitMaterialData.exchange_current_value);
    }else{
        $('#note-ratio-exchange-update-spe-material-data').text(1);
        $('#value-exchange-rate-material-data').val(1);
    }
    if(rateMaterial != 1){
        $('#note-ratio-exchange-update-spe-material-data').text(rateMaterial);
        $('#value-exchange-rate-material-data').val(rateMaterial);
    }
    $('#new-unit-exchange-update-spe-material-data').text(' ' + thisNew.find('option:selected').text());
    $('#name-unit-new-update-brand-manage').text(thisNew.find('option:selected').text());
    $('#name-unit-new-update-brand-manage').attr('data-id', thisNew.find('option:selected').val());
    await dataSpecificationsFoodMapsMaterialData();
}

async function dataSpecificationsFoodMapsMaterialData() {
    let method = 'get',
        url = 'material-data.specifications',
        params = {unit: idUnitUpdateMaterialNew.val()},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#value-name-update-unit-specifications-foods-maps-material-data')]);
    $('#value-name-update-unit-specifications-foods-maps-material-data').html(res.data[0])
}

async function saveModalUpdateUnitFoodMapsMaterial(){
    if(!checkValidateSave($('#modal-update-unit-food-maps'))) return false;
    idUnitTxtUpdateMaterial = $('#value-name-update-unit-specifications-foods-maps-material-data').val();
    idUnitAfterSaveMaterialData = $('#unit-update-material-data').val();
    idSpeAfterSaveMaterialData = $('#specifications-update-material-data').val();
    rateMaterial = $('#value-exchange-rate-material-data').val();
    specNewId = $('#value-name-update-unit-specifications-foods-maps-material-data').val();
    materialNewId = $('#name-unit-new-update-brand-manage').attr('data-id');
    $('#price-update-material-data').val(formatNumber(checkDecimal(removeformatNumber($('#price-update-material-data').val()) / removeformatNumber($('#value-exchange-rate-material-data').val()) )))
    $('#modal-update-unit-food-maps').modal('hide');
    shortcut.remove('ESC');
    $('#btn-edit-unit-rate-material').removeClass('d-none');
    let method = 'get',
        url = 'material-data.specifications',
        params = {unit: idUnitUpdateMaterialNew.val()},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#value-name-update-unit-specifications-foods-maps-material-data')]);
    $('#specifications-update-material-data').html(res.data[0])
    $('#specifications-update-material-data').val(specNewId).trigger('change.select2')
}

async function closeModalUpdateUnitMaterial(){
    $('#btn-edit-unit-rate-material').addClass('d-none');
    $('#modal-update-unit-food-maps').modal('hide');
    shortcut.remove('ESC');
    if(idUnitAfterSaveMaterialData !== undefined){
        $('#unit-update-material-data').val(idUnitAfterSaveMaterialData).trigger('change.select2');
        await dataSpecificationsUpdateMaterialData();
        $('#specifications-update-material-data').val(idSpeAfterSaveMaterialData).trigger('change.select2');
        $('#btn-edit-unit-rate-material').removeClass('d-none');
    }else{
        $('#unit-update-material-data').val(idUnitUpdateMaterial).trigger('change.select2');
        await dataSpecificationsUpdateMaterialData();
        $('#specifications-update-material-data').val(idSpecUpdateMaterial).trigger('change.select2');
        if(unitCurrentIdMaterial != unitId ){
            $('#btn-edit-unit-rate-material').removeClass('d-none');
        }else {
            $('#btn-edit-unit-rate-material').addClass('d-none');
        }
    }

}
