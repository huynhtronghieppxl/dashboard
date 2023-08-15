function openModalDetailSurchargeData(r){
    $('#modal-detail-surcharge-data').modal('show');
    dataDetailSurchargeData(r)
    shortcut.remove("ESC");
    shortcut.add('ESC', function () {
        closeModalDetailSurchargeData();
    });
}

async function dataDetailSurchargeData(r){
    let method = 'get',
        url = 'surcharge-data.detail',
        params = {id: r.data('id')},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-detail-surcharge-data')]);
    $('#name-detail-surcharge-data').text(res.data.data.name)
    $('#price-detail-surcharge-data').text(formatNumber(res.data.data.price))
    $('#create-at-detail-surcharge-data').text(res.data.data.created_at)
    $('#update-at-size-detail-surcharge-data').text(res.data.data.updated_at)
    $('#description-detail-surcharge-data').text(res.data.data.description === '' ? '---' : res.data.data.description)
    hideTextTooLong($('#description-detail-surcharge-data'))
    if(res.data.data.restaurant_vat_config_id === 0){
        $('#vat-detail-surcharge-data').text('---')
    }else{
        $('#vat-detail-surcharge-data').text(res.data.data.vat_percent + ' %')
    }
}

function closeModalDetailSurchargeData() {
    $('#modal-detail-surcharge-data').modal('hide');
    resetModalDetailSurchargeData()
}

function resetModalDetailSurchargeData() {
    $('#loading-modal-detail-surcharge-data h6').text('---')
}
