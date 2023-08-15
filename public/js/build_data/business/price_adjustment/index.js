let dataTablePriceAdjustmentWaiting,
    dataTablePriceAdjustmentApply,
    dataTablePriceAdjustmentCancel,
    tabChangePriceAdjustment = 1,
    thisApplyPriceAdjustmentData,
    checkApplyPriceAdjustment = 0;

$(function () {
    if(getCookieShared('price-adjustment-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('price-adjustment-user-id-' + idSession));
        tabChangePriceAdjustment = dataCookie.tab
    }
    $('.nav-link').on('click', function () {
        tabChangePriceAdjustment  = $(this).data('id')
        updateCookiePriceAdjustment()
    })
    $('.nav-link[data-id="' + tabChangePriceAdjustment + '"]').click();
    $('.card-block').keypress(function (event) {
        if (event.keyCode === 10 || event.keyCode === 13) {
            event.preventDefault();
        }
    });
    loadData();
});

async function loadData() {
    let method = 'get',
        url = 'price-adjustment-data.data',
        restaurant_brand_id = $('.select-brand-price-adjustment').val(),
        params = {restaurant_brand_id: restaurant_brand_id},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-waiting-price-adjustment-data'), $('#table-apply-price-adjustment-data'), $('#table-cancel-price-adjustment-data')]);
    dataTablePriceAdjustment(res);
    dataTotalPriceAdjustment(res.data[3]);
}

function updateCookiePriceAdjustment(){
    saveCookieShared('price-adjustment-user-id-' + idSession, JSON.stringify({
        'tab' : tabChangePriceAdjustment,
    }))
}

async function dataTablePriceAdjustment(data) {
    let id1 = $('#table-waiting-price-adjustment-data'),
        id2 = $('#table-apply-price-adjustment-data'),
        id3 = $('#table-cancel-price-adjustment-data'),
        column1 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'code', name: 'code', className: 'text-left'},
            {data: 'employee_create_name', name: 'employee_create', className: 'text-left'},
            {data: 'created_at', name: 'created_at', className: 'text-center'},
            {data: 'updated_at', name: 'updated_at', className: 'text-center'},
            {data: 'number_food', name: 'number_food', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '10%'},
            {data: 'keysearch', className: 'd-none'}
        ],
        column2 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'code', name: 'code', className: 'text-left'},
            {data: 'employee_create_name', name: 'employee_create_name', className: 'text-left'},
            {data: 'created_at', name: 'created_at', className: 'text-center'},
            {data: 'updated_at', name: 'updated_at', className: 'text-center'},
            {data: 'apply_time', name: 'apply_time', className: 'text-center'},
            {data: 'number_food', name: 'number_food', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '10%'},
            {data: 'keysearch', className: 'd-none'}
        ],
        option = [{
            'title': 'Thêm mới',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'openModalCreatePriceAdjustment',
        }],
        fixedLeft = 2,
        fixedRight = 1;
    dataTablePriceAdjustmentWaiting = await DatatableTemplateNew(id1, data.data[0].original.data, column1, vh_of_table, fixedLeft, fixedRight, option);
    dataTablePriceAdjustmentApply = await DatatableTemplateNew(id2, data.data[1].original.data, column2, vh_of_table, fixedLeft, fixedRight, option);
    dataTablePriceAdjustmentCancel = await DatatableTemplateNew(id3, data.data[2].original.data, column1, vh_of_table, fixedLeft, fixedRight, option)

    $(document).on('input paste keyup','input[type="search"]', async function (){
        $('#total-record-waiting').text(formatNumber(dataTablePriceAdjustmentWaiting.rows({'search':'applied'}).count()))
        $('#total-record-apply').text(formatNumber(dataTablePriceAdjustmentApply.rows({'search':'applied'}).count()))
        $('#total-record-cancel').text(formatNumber(dataTablePriceAdjustmentCancel.rows({'search':'applied'}).count()))

        searchUpdateIndexPriceAdjustment(dataTablePriceAdjustmentWaiting)
        searchUpdateIndexPriceAdjustment(dataTablePriceAdjustmentApply)
        searchUpdateIndexPriceAdjustment(dataTablePriceAdjustmentCancel)

    })
}

function searchUpdateIndexPriceAdjustment(datatable){
    let index = 1;
    datatable.rows({'search':'applied'}).every(function (){
        let row = $(this.node())
        row.find('td:eq(0)').text(index)
        index++;
    })
}

function dataTotalPriceAdjustment(data) {
    $('#total-record-waiting').text(data.total_record_waiting);
    $('#total-record-apply').text(data.total_record_apply);
    $('#total-record-cancel').text(data.total_record_cancel);
}

function applyPriceAdjustment(r) {
    if(checkApplyPriceAdjustment === 1) return false;
    thisApplyPriceAdjustmentData = r
    let title = 'Bạn có muốn áp dụng phiếu ?',
        content = '',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            checkApplyPriceAdjustment = 1;
            let method = 'post',
                url = 'price-adjustment-data.apply',
                params = null,
                data = {restaurant_brand_id: r.data('brand'), id: r.data('id')};
            let res = await axiosTemplate(method, url, params, data, [$('#table-waiting-price-adjustment-data')]);
            checkApplyPriceAdjustment = 0;
            let text = '';
            switch (res.data.status) {
                case 200:
                    text = $('#success-confirm-data-to-server').text();
                    SuccessNotify(text);
                    loadData();
                break;
                case 500:
                    text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                ErrorNotify(text);
                break;
                default:
                    text = $('#error-post-data-to-server').text();
                    if (res.message !== null) {
                        text = res.message;
                    }
                    WarningNotify($('#error-post-data-to-server').text())
            }
        }
    });
}

function drawApplyPriceAdjustmentData(data) {
    $('#total-record-waiting').text(formatNumber(removeformatNumber($('#total-record-waiting').text()) - 1));
    $('#total-record-apply').text(formatNumber(removeformatNumber($('#total-record-apply').text()) + 1));
    removeRowDatatableTemplate(dataTablePriceAdjustmentWaiting, thisApplyPriceAdjustmentData, true);
    addRowDatatableTemplate(dataTablePriceAdjustmentApply, {
        'code': data.code,
        'employee_create_name': data.employee_create_name,
        'created_at': data.created_at,
        'updated_at': data.updated_at,
        'number_food': data.number_food,
        'action': data.action,
        'keysearch': data.keysearch,
    });
}
