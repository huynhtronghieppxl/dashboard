let dataTableCardValueEnable = [],
    dataTableCardValueDisEnable = [],tabCurrentCardValueCustomer = 0, checkChangStatusCardValue = 0;

$(function () {
    if(checkChangStatusCardValue === 1) return false;
    if(getCookieShared('customer-card-value-' + idSession)){
        let data = JSON.parse(getCookieShared('customer-card-value-' + idSession));
        tabCurrentCardValueCustomer = data.tab;
    }
    $('a.nav-link').on('click',function (){
        tabCurrentCardValueCustomer = $(this).attr('data-type');
        updateCookie();
    })
    $('a.nav-link[data-type="' + tabCurrentCardValueCustomer + '"]').click();
    loadData();
});

async function loadData() {
    let method = 'get',
        url = 'card-value.data',
        branch = $('#change_branch').val(),
        params = {branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data,[
        $("#table-enable-card-value-customer"),
        $("#table-disable-card-value-customer"),
    ]);

    dataTableCardValue(res);
    dataTotalCardValue(res.data[2]);
}

function updateCookie(){
    saveCookieShared('customer-card-value-' + idSession, JSON.stringify({
        'tab' : tabCurrentCardValueCustomer,
    }))
}

async function dataTableCardValue(data) {
    let fixedLeft = 2,
        fixedRight = 1,
        idEnableCardValue = $('#table-enable-card-value-customer'),
        idDisableCardValue = $('#table-disable-card-value-customer'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'amount', name: 'amount', className: 'text-right'},
            {data: 'bonus_amount', name: 'bonus_amount', className: 'text-right'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ],
        option = [{
            'title': 'Thêm mới',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'openModalCreateCardValue',
        }]
    dataTableCardValueEnable = await DatatableTemplateNew(idEnableCardValue, data.data[0].original.data, column, vh_of_table, fixedLeft, fixedRight,option);
    dataTableCardValueDisEnable = await DatatableTemplateNew(idDisableCardValue, data.data[1].original.data, column, vh_of_table, fixedLeft, fixedRight,option);

    $(document).on('input paste keyup','input[type="search"]', async function (){
        $('#total-record-enable').text(formatNumber(dataTableCardValueEnable.rows({'search':'applied'}).count()))
        $('#total-record-disable').text(formatNumber(dataTableCardValueDisEnable.rows({'search':'applied'}).count()))
        searchUpdateIndexCardValue(dataTableCardValueEnable)
        searchUpdateIndexCardValue(dataTableCardValueDisEnable)

    })
}

async function searchUpdateIndexCardValue(datatable){
    let index = 1;
    await datatable.rows({'search':'applied'}).every(function (){
        let row = $(this.node())
        row.find('td:eq(0)').text(index)
        index++;
    })
}

function dataTotalCardValue(data) {
    $('#total-record-enable').text(data.total_record_enable);
    $('#total-record-disable').text(data.total_record_disable);
}

function changeStatusCardValue(r) {
    let title = '',
        content = '',
        icon = '';
    if(r.data('status') === 1){
         title = 'Đổi trạng thái thành tạm ngưng ? ';
            content = '';
            icon = 'warning';
    }else {
         title = 'Đổi trạng thái thành hoạt động ? ';
            content = '';
            icon = 'warning';
    }
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            checkChangStatusCardValue = 1;
            let method = 'post',
                url = 'card-value.change-status',
                params = null,
                data = {id: r.data('id')};
            let res = await axiosTemplate(method, url, params, data);
            checkChangStatusCardValue = 0;
            let text = '';
            switch (res.data.status) {
                case 200:
                    text = $('#success-status-data-to-server').text();
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
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    WarningNotify(text);
            }
        }
    })
}
