let tableCostData, tableCostDataDisable, typeCostData = '', thisUpdateChangeStatus,  tabChangeCost = 1,checkChangeStatusCost = 0;
$(function () {
    if(getCookieShared('cost-data-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('cost-data-user-id-' + idSession));
        tabChangeCost = dataCookie.tab
    }
    $('.nav-link').on('click', function () {
        tabChangeCost  = $(this).data('id')
        updateCookieCostData()
    })
    $(document).on('input paste','#table-enable-cost-data_filter', function (){
        $('#total-record-enable').text(tableCostData.rows({'search':'applied'}).count());
        let index = 1;
        tableCostData.rows({'search':'applied'}).every(function (){
            let row = $(this.node())
            row.find('td:eq(0)').text(index)
            index++;
        })
    })

    $(document).on('input paste','#table-disable-cost-data_filter', function (){
        $('#total-record-disable').text(tableCostDataDisable.rows({'search':'applied'}).count());
        let index = 1;
        tableCostDataDisable.rows({'search':'applied'}).every(function (){
            let row = $(this.node())
            row.find('td:eq(0)').text(index)
            index++;
        })
    })
    $('.nav-link[data-id="' + tabChangeCost + '"]').click();
    loadData();
});

async function loadData() {
    let method = 'get',
        url = 'cost-data.data',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data,[$('#content-body-techres')]);
    dataTableCostData(res);
    $('#total-record-enable').text(res.data[2].recordEnable);
    $('#total-record-disable').text(res.data[2].recordDisable);
}
function updateCookieCostData(){
    saveCookieShared('cost-data-user-id-' + idSession, JSON.stringify({
        'tab' : tabChangeCost,
    }))
}

async function dataTableCostData(data) {
    let tableEnableCostData = $('#table-enable-cost-data'),
        tableDisableCostData = $('#table-disable-cost-data'),
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
        'function': 'openModalCreateCostData',
    }]
    tableCostData = await DatatableTemplateNew(tableEnableCostData, data.data[0].original.data, columns, vh_of_table, fixedLeft, fixedRight, option);
    tableCostDataDisable = await DatatableTemplateNew(tableDisableCostData, data.data[1].original.data, columns, vh_of_table, fixedLeft, fixedRight, option);
}

// async function dataTypeCostData() {
//     let method = 'get',
//         url = 'cost-data.cost-type',
//         params = null,
//         data = null;
//     let res = await axiosTemplate(method, url, params, data,[
//         $('#select-create-cost-data'),
//         $('#select-update-cost-data'),
//     ]);
//     typeCostData = res.data[0];
// }

function changeStatusCostData(r) {
    if (checkChangeStatusCost === 1) return false;
    thisUpdateChangeStatus = r;
    let id = r.data('id');
    let status = r.data('status');
    let title, content = '';
    // title = (status === 0) ? $('#notify-on-update-status-component').text() :$('#notify-off-update-status-component').text();
    title = (status === 1) ? 'Đổi trạng thái thành tạm ngưng ?' : 'Đổi trạng thái thành hoạt động ?';
    let icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            checkChangeStatusCost = 1;
            let method = 'post',
                url = 'cost-data.change-status',
                params = null,
                data = {id: id};
            let res = await axiosTemplate(method, url, params, data,[$('#content-body-techres')]);
            checkChangeStatusCost = 0;
            let text = $('#success-status-data-to-server').text();
            switch (res.data.status){
                case 300:
                    openModalNotifyCostData()
                    $('#title-change-status-cost-data').text(res.data.message)
                    drawTableChangeStatusCostData(res.data.data)
                    break;
                case 200:
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


async function saveNotifyChangeStatusCost() {
    if (checkChangeStatusCost === 1) return false;
    checkChangeStatusCost = 1;
    let method = 'post',
        url = 'cost-data.change-status',
        params = null,
        data = {id: thisUpdateChangeStatus.data('id'), confirmed: 1};
    let res = await axiosTemplate(method, url, params, data,[$('#table-change-status-cost-data')]);
    checkChangeStatusCost = 0;
    let text = $('#success-status-data-to-server').text();
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            closeModalNotifyCostData();
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


async function drawTableChangeStatusCostData(data) {
    let tableChangeStatusCost = $('#table-change-status-cost-data'),
        scroll_Y = '200px',
        fixed_left = 0,
        fixed_right = 0,
        columnCost = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-left', width: '5%'},
            {data: 'code', name: 'code', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-left', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ];
    let dataTableCost = await DatatableTemplateNew(tableChangeStatusCost, data.original.data, columnCost, scroll_Y, fixed_left, fixed_right, []);
    $(document).on('input paste', '#table-change-status-cost-data_filter input', function () {
        let indexFood = 1;
        dataTableCost.rows({'search': 'applied'}).every(function () {
            let row = $(this.node())
            row.find('td:eq(0)').text(indexFood)
            indexFood++;
        });
    })
}

async function drawDataChangeStatus(data){
    if(data.status === 1){
        $('#total-record-disable').text(formatNumber(removeformatNumber($('#total-record-disable').text()) - 1));
        $('#total-record-enable').text(formatNumber(removeformatNumber($('#total-record-enable').text()) + 1));
        removeRowDatatableTemplate(tableCostDataDisable, thisUpdateChangeStatus, true);
        addRowDatatableTemplate(tableCostData, {
            'name': data.name,
            'addition_fee_reason_type_name': data.addition_fee_reason_type_name,
            'action':  data.action ,
            'keysearch': data.keysearch,
        });
    }else {
        $('#total-record-enable').text(formatNumber(removeformatNumber($('#total-record-enable').text()) - 1));
        $('#total-record-disable').text(formatNumber(removeformatNumber($('#total-record-disable').text()) + 1));
        removeRowDatatableTemplate(tableCostData, thisUpdateChangeStatus, true);
        addRowDatatableTemplate(tableCostDataDisable, {
            'name': data.name,
            'addition_fee_reason_type_name': data.addition_fee_reason_type_name,
            'action':  data.action ,
            'keysearch': data.keysearch,
        });
    }
}
