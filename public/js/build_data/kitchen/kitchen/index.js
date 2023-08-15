let dataTableKitchenEnable = [],
    dataTableKitchenDisable = [],
    thisChangeStatusKitChenData,
    checkChangeStatusKitchenData = 0, tabChangeKitchenData = 1;

$(async function () {
    if(getCookieShared('kitchen-data-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('kitchen-data-user-id-' + idSession));
        tabChangeKitchenData = dataCookie.tab
    }

    $('#nav-tabs-kitchen .nav-link').on('click', function () {
        tabChangeKitchenData  = $(this).data('id')
        updateCookieKitchenData()
    })
    if(!$('.select-branch').val()) {
        await updateSessionBrandNew($('.select-brand'));
    }else {
        loadData();
    }
    $('#nav-tabs-kitchen .nav-link[data-id="' + tabChangeKitchenData + '"]').click();

});

function updateCookieKitchenData(){
    saveCookieShared('kitchen-data-user-id-' + idSession, JSON.stringify({
        'tab' : tabChangeKitchenData,
    }))

}

async function loadData() {
    let method = 'get',
        url = 'kitchen-data.data',
        restaurant_brand_id = $('.select-brand').val(),
        branch_id = $('.select-branch').val(),
        params = {
            restaurant_brand_id: restaurant_brand_id,branch_id:branch_id
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#content-body-techres')]);
    dataTableKitchenData(res);
    dataTotalKitchenData(res.data[2]);
}

async function dataTableKitchenData(data) {
    let id_table_enable = $('#table-enable-kitchen-data'),
        id_table_disable = $('#table-disable-kitchen-data'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'type_text', name: 'type_text', className: 'text-left'},
            {data: 'description', name: 'description', className: 'text-left'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'}
        ],
        option =
                [{
                'title': 'Thêm mới',
                'icon': 'fa fa-plus text-primary',
                'class': '',
                'function': 'openModalCreateKitchenData',
                }],
        fixedLeft = null,
        fixedRight = null;
    dataTableKitchenEnable = await DatatableTemplateNew(id_table_enable, data.data[0].original.data, column, vh_of_table, fixedLeft, fixedRight,option);
    dataTableKitchenDisable = await DatatableTemplateNew(id_table_disable, data.data[1].original.data, column, vh_of_table, fixedLeft, fixedRight,option);
    $(document).on('input paste keyup','input[type="search"]', function (){
        $('#total-record-enable-kitchen-data').text(formatNumber(dataTableKitchenEnable.rows({'search': 'applied'}).count()))
        $('#total-record-disable-kitchen-data').text(formatNumber(dataTableKitchenDisable.rows({'search': 'applied'}).count()))
        searchUpdateIndexDataTable(dataTableKitchenEnable)
        searchUpdateIndexDataTable(dataTableKitchenDisable)
    })
}

function dataTotalKitchenData(data) {
    $('#total-record-enable-kitchen-data').text(data.total_enable_kitchen);
    $('#total-record-disable-kitchen-data').text(data.total_kitchen_kitchen);
}

function changeStatusKitchenData(r) {
    thisChangeStatusKitChenData = r;
    let id = r.data('id');
    let title = 'Đổi trạng thái thành Đang hoạt động ?';
    if(r.find('i').hasClass('fi-rr-cross')){
        title = 'Đổi trạng thái thành Tạm ngưng ?';
    }
    let content = '';
    let icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            if (checkChangeStatusKitchenData === 1) return false;
            checkChangeStatusKitchenData = 1;
            let method = 'post',
                url = 'kitchen-data.change-status',
                params = null,
                data = {id: id};
            let res = await axiosTemplate(method, url, params, data, [$('#content-body-techres')]);
            checkChangeStatusKitchenData = 0;
            let text = '';
            console.log('data',res)
            switch(res.data.status) {
                case 200:
                     text = $('#success-status-data-to-server').text();
                        SuccessNotify(text);
                        drawDataChangeStatus(res.data.data);
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
                    WarningNotify(text)
            }
        }
    })
}

async function drawDataChangeStatus(data) {
    switch (data.status) {
        case 1:
            $('#total-record-disable-kitchen-data').text(formatNumber(removeformatNumber($('#total-record-disable-kitchen-data').text()) - 1));
            $('#total-record-enable-kitchen-data').text(formatNumber(removeformatNumber($('#total-record-enable-kitchen-data').text()) + 1));
            removeRowDatatableTemplate(dataTableKitchenDisable, thisChangeStatusKitChenData, true);
            addRowDatatableTemplate(dataTableKitchenEnable, {
                'name': data.name,
                'type_text': data.type_text,
                'description': data.description,
                'action': data.action,
                'keysearch': data.keysearch,
            });
            break;

        case 0:
            $('#total-record-enable-kitchen-data').text(formatNumber(removeformatNumber($('#total-record-enable-kitchen-data').text()) - 1));
            $('#total-record-disable-kitchen-data').text(formatNumber(removeformatNumber($('#total-record-disable-kitchen-data').text()) + 1));
            removeRowDatatableTemplate(dataTableKitchenEnable, thisChangeStatusKitChenData, true);
            addRowDatatableTemplate(dataTableKitchenDisable, {
                'name': data.name,
                'type_text': data.type_text,
                'description': data.description,
                'action': data.action,
                'keysearch': data.keysearch,
            });
            break;
    }
}

