let tableEnableSurchargeData,
    tableDisableSurchargeData,
    tabChangeSurcharge = 1,
    dataListVatSurchargeData = '',
    changeStatusSurcharge;

$(function () {
    if(getCookieShared('surcharge-data-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('surcharge-data-user-id-' + idSession));
        tabChangeSurcharge = dataCookie.tab
    }
    $('.nav-link').on('click', function () {
        tabChangeSurcharge  = $(this).data('id')
        updateCookieSurchargeData()
    })
    loadData();
    $('.nav-link[data-id="' + tabChangeSurcharge + '"]').click();
    getVat();
});

async function loadData() {
    let method = 'get',
        url = 'surcharge-data.data',
        params = {
             brand: $('.select-brand-surcharge-data').val(),
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-enable-surcharge-data'), $('#table-disable-surcharge-data')]);
    dataTableSurchargeData(res);
    dataTotalSurchargeData(res.data[2]);
}
function updateCookieSurchargeData(){
    saveCookieShared('surcharge-data-user-id-' + idSession, JSON.stringify({
        'tab' : tabChangeSurcharge,
    }))
}

async function getVat(){
    let method = 'post',
        url = 'surcharge-data.get-vat',
        params = null,
        data = {};
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-create-surcharge-data')]);
    $('#select-option-vat-surcharge-data').html(res.data[0]);
    dataListVatSurchargeData = res.data[0];
}

async function dataTableSurchargeData(data) {
    let idEnable = $('#table-enable-surcharge-data'),
        idDisable = $('#table-disable-surcharge-data');
    let fixedLeft = 0,
        fixedRight = 2;
    let columns = [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
        {data: 'name', name: 'name', className: 'text-left'},
        {data: 'price', name: 'price', className: 'text-right'},
        {data: 'vat', name: 'vat', className: 'text-center'},
        {data: 'created_at', name: 'created_at', className: 'text-center'},
        {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        {data: 'keysearch', className: 'd-none'}
        ],
        option = [{
            'title' : 'Thêm mới',
            'icon' : 'fa fa-plus text-primary',
            'class' : '',
            'function':'openModalCreateSurchargeData'
        }];
    tableEnableSurchargeData = await DatatableTemplateNew(idEnable, data.data[0].original.data, columns, vh_of_table, fixedLeft, fixedRight, option);
    tableDisableSurchargeData = await DatatableTemplateNew(idDisable, data.data[1].original.data, columns, vh_of_table, fixedLeft, fixedRight, option);

    $(document).on('input paste keyup','input[type="search"]', async function (){
        $('#total-record-enable').text(formatNumber(tableEnableSurchargeData.rows({'search':'applied'}).count()))
        $('#total-record-disable').text(formatNumber(tableDisableSurchargeData.rows({'search':'applied'}).count()))
        searchUpdateIndexSurcharge(tableEnableSurchargeData)
        searchUpdateIndexSurcharge(tableEnableSurchargeData)
    })
}

function searchUpdateIndexSurcharge(datatable){
    let index = 1;
    datatable.rows({'search':'applied'}).every(function (){
        let row = $(this.node())
        row.find('td:eq(0)').text(index)
        index++;
    })
}

function dataTotalSurchargeData(data) {
    $('#total-record-enable').text(data.total_record_enable);
    $('#total-record-disable').text(data.total_record_disable);
}

function changeStatusSurchargeData(r) {
    if (changeStatusSurcharge === 1) return false;
    changeStatusSurcharge = 0;
    let title = 'Đổi trạng thái thành đang hoạt động ?';

    if(r.find('i').hasClass('fi-rr-cross')){
        title = 'Đổi trạng thái thành tạm ngưng ?'
    }
    let  content = '',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            changeStatusSurcharge = 1;
            let method = 'post',
                url = 'surcharge-data.change-status',
                params = null,
                data = {
                    id: r.data('id'),
                    brand: r.data('brand'),
                };
            let res = await axiosTemplate(method, url, params, data, [$('#table-enable-surcharge-data'), $('#table-disable-surcharge-data')]);
            changeStatusSurcharge = 0;
            let text = ''
            switch (res.data.status) {
                case 200:
                    text = $('#success-status-data-to-server').text();
                    SuccessNotify(text);
                    if (res.data.data.status === 1) {
                        addRowDatatableTemplate(tableEnableSurchargeData, {
                            'name': res.data.data.name,
                            'price': res.data.data.price,
                            'vat': res.data.data.vat,
                            'created_at': res.data.data.created_at,
                            'action': res.data.data.action,
                            'keysearch': res.data.data.keysearch,
                        });
                        removeRowDatatableTemplate(tableDisableSurchargeData, r, true);
                        $('#total-record-enable').text(removeformatNumber($('#total-record-enable').text()) + 1);
                        $('#total-record-disable').text(removeformatNumber($('#total-record-disable').text()) - 1);
                    } else {
                        addRowDatatableTemplate(tableDisableSurchargeData, {
                            'name': res.data.data.name,
                            'price': res.data.data.price,
                            'created_at': res.data.data.created_at,
                            'vat': res.data.data.vat,
                            'action': res.data.data.action,
                            'keysearch': res.data.data.keysearch,
                        });
                        removeRowDatatableTemplate(tableEnableSurchargeData, r, true);
                        $('#total-record-enable').text(removeformatNumber($('#total-record-enable').text()) - 1);
                        $('#total-record-disable').text(removeformatNumber($('#total-record-disable').text()) + 1);
                    }
                    break;
                case 500:
                    text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    ErrorNotify(text);
                    break;
                default:
                    WarningNotify($('#error-post-data-to-server').text())
            }
        }
    })
}
