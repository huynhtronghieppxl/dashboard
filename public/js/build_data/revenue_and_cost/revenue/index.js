let tableEnableRevenueData,
    tableDisableRevenueData,
    thisUpdateChangeStatus,
    tabChangeRevenue = 1,
    changeStatusRevData;
$(function () {
    if(getCookieShared('revenue-data-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('revenue-data-user-id-' + idSession));
        tabChangeRevenue = dataCookie.tab
    }
    $('.nav-link').on('click', function () {
        tabChangeRevenue  = $(this).data('id')
        updateCookieRevenueData()
    })
    $(document).on('input paste','#table-enable-revenue-data_filter', function (){
        $('#total-record-enable').text(tableEnableRevenueData.rows({'search':'applied'}).count());
        let index = 1;
        tableEnableRevenueData.rows({'search':'applied'}).every(function (){
            let row = $(this.node())
            row.find('td:eq(0)').text(index)
            index++;
        })
    })
    $(document).on('input paste','#table-disable-revenue-data_filter', function (){
        $('#total-record-disable').text(tableDisableRevenueData.rows({'search':'applied'}).count());
        let index = 1;
        tableDisableRevenueData.rows({'search':'applied'}).every(function (){
            let row = $(this.node())
            row.find('td:eq(0)').text(index)
            index++;
        })
    })
    $('.nav-link[data-id="' + tabChangeRevenue + '"]').click();
    loadData();
})

async function loadData() {
    let method = 'get',
        url = 'revenue-data.data',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#content-body-techres')]);
    dataTableRevenueData(res)
    $('#total-record-enable').text(res.data[2].recordEnable);
    $('#total-record-disable').text(res.data[2].recordDisable);
}
function updateCookieRevenueData(){
    saveCookieShared('revenue-data-user-id-' + idSession, JSON.stringify({
        'tab' : tabChangeRevenue,
    }))
}

async function dataTableRevenueData(data) {
    let tableEnableRevenue = $('#table-enable-revenue-data'),
        tableDisableRevenue = $('#table-disable-revenue-data'),
        fixedLeft = 0,
        fixedRight = 0,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-center'},
            // {data: 'addition_fee_reason_type_name', name: 'addition_fee_reason_type_name', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'}
        ],
        option = [{
            'title': 'Thêm mới',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'openModalCreateRevenueData',
        }]
    tableEnableRevenueData = await DatatableTemplateNew(tableEnableRevenue, data.data[0].original.data, columns, vh_of_table, fixedLeft, fixedRight, option);
    tableDisableRevenueData  = await DatatableTemplateNew(tableDisableRevenue, data.data[1].original.data, columns, vh_of_table, fixedLeft, fixedRight, option);
}

function changeStatusRevenueData(r) {
    if (changeStatusRevData === 1) return false;
    changeStatusRevData = 0;
    thisUpdateChangeStatus = r;
    let id = r.data('id');
    let status = r.data('status');
    let title, content;
    // title = (status === 0) ? $('#notify-on-update-status-component').text() : $('#notify-off-update-status-component').text();
    title = (status === 1) ? 'Đổi trạng thái thành tạm ngưng ?' : 'Đổi trạng thái thành hoạt động ?';
    let icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            changeStatusRevData = 1;
            let method = 'post',
                url = 'revenue-data.change-status',
                params = null,
                data = {id: id};
            let res = await axiosTemplate(method, url, params, data, [$('#content-body-techres')]);
            changeStatusRevData = 0;
            let text = $('#success-status-data-to-server').text();
            switch (res.data.status){
                case 200:
                    SuccessNotify(text);
                    SuccessNotify(text);
                    drawDataChangeStatus(res.data.data);
                    break;
                case 500:
                    text = $('#error-post-data-to-server').text();
                    ErrorNotify(text);
                    break;
                default :
                    text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    WarningNotify(text);
            }
        }
    })
}

async function drawDataChangeStatus(data){
    if(data.status === 1){
        $('#total-record-disable').text(formatNumber(removeformatNumber($('#total-record-disable').text()) - 1));
        $('#total-record-enable').text(formatNumber(removeformatNumber($('#total-record-enable').text()) + 1));
        removeRowDatatableTemplate(tableDisableRevenueData, thisUpdateChangeStatus, true);
        addRowDatatableTemplate(tableEnableRevenueData, {
            'name': data.name,
            // 'addition_fee_reason_type_name': data.addition_fee_reason_type_name,
            'action':  data.action ,
            'keysearch': data.keysearch,
        });
    }else {
        $('#total-record-enable').text(formatNumber(removeformatNumber($('#total-record-enable').text()) - 1));
        $('#total-record-disable').text(formatNumber(removeformatNumber($('#total-record-disable').text()) + 1));
        removeRowDatatableTemplate(tableEnableRevenueData, thisUpdateChangeStatus, true);
        addRowDatatableTemplate(tableDisableRevenueData, {
            'name': data.name,
            // 'addition_fee_reason_type_name': data.addition_fee_reason_type_name,
            'action':  data.action ,
            'keysearch': data.keysearch,
        });
    }
}
