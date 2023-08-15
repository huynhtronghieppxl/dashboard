let tableEnableAreaData,
    tableDisableAreaData,
    checkChangeStatusAreaData = 0,
    tabCurrentAreaData = 1,
    thisAreaChangeStatus;

$(async function () {
    if(getCookieShared('cookieAreaData')){
        let data = JSON.parse(getCookieShared('cookieAreaData'));
        tabCurrentAreaData = data.tab;
    }

    shortcut.add('F2', function () {
        openModalCreateAreaData();
    });

    $('#nav-tab-area-data .nav-link').on('click', function (){
        tabCurrentAreaData = $(this).attr('data-id')
        saveCookieShared('cookieAreaData', JSON.stringify({
            'tab' : tabCurrentAreaData,
        }))
    })

    if(!$('.select-branch').val()) {
        await updateSessionBrandNew($('.select-brand'));
    }else {
        loadData();
    }
    $('#nav-tab-area-data a[data-id="' + tabCurrentAreaData + '"]').click()
});

async function loadData() {
    let method = 'get',
        url = 'area-data.data',
        branch_id = $('.select-branch-area-data').val(),
        params = {branch_id: branch_id},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-enable-area-data'), $('#table-disable-area-data')]);
    dataTableAreaData(res);
    dataTotalAreaData(res.data[2]);
}

async function dataTableAreaData(data) {
    let idEnable = $('#table-enable-area-data'),
        idDisable = $('#table-disable-area-data');
    let fixed_left = 0,
        fixed_right = 0;
    let columns = [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
        {data: 'name', name: 'name', className: 'text-left'},
        {data: 'active_count', name: 'active_count', className: 'text-center'},
        {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        {data: 'keysearch', className: 'd-none'}
    ],
    option = [{
        'title' : 'Thêm mới',
        'icon' : 'fa fa-plus text-primary',
        'class' : '',
        'function' : 'openModalCreateAreaData'
    }];
    tableEnableAreaData = await DatatableTemplateNew(idEnable, data.data[0].original.data, columns, vh_of_table, fixed_left, fixed_right, option);
    tableDisableAreaData = await DatatableTemplateNew(idDisable, data.data[1].original.data, columns, vh_of_table, fixed_left, fixed_right, option);

    $(document).on('input paste keyup','input[type="search"]', async function (){
        $('#total-record-enable').text(formatNumber(tableEnableAreaData.rows({'search':'applied'}).count()))
        $('#total-record-disable').text(formatNumber(tableDisableAreaData.rows({'search':'applied'}).count()))
        searchUpdateIndexArea(tableEnableAreaData)
        searchUpdateIndexArea(tableDisableAreaData)

    })
}

async function searchUpdateIndexArea(datatable){
    let index = 1;
    await datatable.rows({'search':'applied'}).every(function (){
        let row = $(this.node())
        row.find('td:eq(0)').text(index)
        index++;
    })
}

function dataTotalAreaData(data) {
    $('#total-record-enable').text(data.total_record_enable);
    $('#total-record-disable').text(data.total_record_disable);
}

function changeStatusAreaData(button) {
    if(checkChangeStatusAreaData === 1) return false;
    let title = $('#msg-title-status-area').text(),
        content = $('#msg-content-status-area').text(),
        icon = 'question';
        // titleChangeStatusArea = `Những bàn sau hiện đang sử dụng khu vực ${button.data('name')}, nếu bạn đồng ý hệ thống sẽ tắt toàn bộ bàn của khu vực này!`;
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let id = button.attr('data-id'),
                name = button.attr('data-name'),
                status = button.attr('data-status'),
                branch_id = button.attr('data-branch');
            checkChangeStatusAreaData  = 1;
            let method = 'post',
                url = 'area-data.status',
                params = null,
                data = {
                    id: id,
                    name: name,
                    status: status,
                    branch_id: branch_id,
                    is_confirmed: 0
                };
            let res = await axiosTemplate(method, url, params, data, [$('#table-enable-area-data'), $('#table-disable-area-data')]);
            checkChangeStatusAreaData  = 0;
            switch (res.data.status) {
                case 200:
                    SuccessNotify($('#msg-success-status-area').text());
                    if (res.data.data.status === 1) {
                        addRowDatatableTemplate(tableEnableAreaData, {
                            'name': res.data.data.name,
                            'active_count': res.data.data.active_count,
                            'action': res.data.data.action,
                            'keysearch': res.data.data.keysearch,
                        });
                        removeRowDatatableTemplate(tableDisableAreaData, button, true);
                        $('#total-record-enable').text(Number($('#total-record-enable').text()) + 1);
                        $('#total-record-disable').text(Number($('#total-record-disable').text()) - 1);
                    } else {
                        addRowDatatableTemplate(tableDisableAreaData, {
                            'name': res.data.data.name,
                            'active_count': res.data.data.active_count,
                            'action': res.data.data.action,
                            'keysearch': res.data.data.keysearch,
                        });
                        removeRowDatatableTemplate(tableEnableAreaData, button, true);
                        $('#total-record-enable').text(Number($('#total-record-enable').text()) - 1);
                        $('#total-record-disable').text(Number($('#total-record-disable').text()) + 1);
                    }
                    break;
                case 300:
                    let data = {
                        id: id,
                        name: name,
                        status: status,
                        branch_id: branch_id,
                        is_confirmed: 1
                    };
                    openModalNotifyAreaData(res, data, button, 300);
                    break;
                case 205:
                    // $('#modal-notify-change-status-area').modal('show');
                    // shortcut.add("ESC",function(){
                    //     closeModalNotifyAreaData();
                    // });
                    // $('#modal-notify-change-status-area #title-change-area').text(titleChangeStatusArea);
                    // drawTableChangeStatusAreaData(res);
                    openModalNotifyAreaData(res, [], button, 205);
                    break;
                case 500:
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    ErrorNotify($('#error-post-data-to-server').text());
                    break;
                default:
                    let text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    WarningNotify(text);
            }
        }
    })
}

async function drawTableChangeStatusAreaData(data) {
    let tableChangeStatusAreaData = $('#table-change-status-area-data'),
        scroll_Y = '300px',
        fixed_left = 0,
        fixed_right = 0,
        columnArea = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '8%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'slot_number', name: 'slot_number', className: 'text-center'},
            {data: 'keysearch', className: 'd-none'},
        ];
    let dataTableArea = await DatatableTemplateNew(tableChangeStatusAreaData, data.data.data.original.data, columnArea, scroll_Y, fixed_left, fixed_right, []);
    $(document).on('input paste','#table-change-status-area-data_filter input', function (){
        let indexArea = 1;
        dataTableArea.rows({'search':'applied'}).every(function () {
            let row = $(this.node())
            row.find('td:eq(0)').text(indexArea)
            indexArea++;
        });
    })
}
