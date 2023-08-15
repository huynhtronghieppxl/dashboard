let drawDataTableEnableTableData,
    drawDataTableDisableTableData, tabChangeTable = 1, selectArea,
    thisTableData;
let checkChangeStatusTableBuildData = 0;
$(async function () {
    if(getCookieShared('table-build-data-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('table-build-data-user-id-' + idSession));
        tabChangeTable = dataCookie.tab
        selectArea = dataCookie.select
    }
    $('.nav-link').on('click', function () {
        tabChangeTable  = $(this).data('id')
        updateCookieTableBuildData()
    })

    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function (){
        openModalCreateTableBuildData()
    })
    $('.nav-link[data-id="' + tabChangeTable + '"]').click()

    if(!$('.select-branch').val()) {
        await updateSessionBrandNew($('.select-brand'));
    }else {
        loadData();
    }
    $('.select-area-table-build-data').on('change', function () {
        $('.select-area-table-build-data').val($(this).val()).trigger('change.select2');
    });

    $(document).on('select2:select', '.select-area-table-build-data',function () {
        selectArea = $(this).val();
        updateCookieTableBuildData()
        loadTableData();
    })
});

async function loadData() {
    await dataAreaTableBuildData();
    loadTableData();
}
function updateCookieTableBuildData(){
    saveCookieShared('table-build-data-user-id-' + idSession, JSON.stringify({
        'tab' : tabChangeTable,
        'select' : selectArea,
    }))
}

async function loadTableData() {
    let branch_id = $('#change_branch').val(),
        area_id = $('.select-area-table-build-data').val(),
        method = 'get',
        url = 'table-data.data',
        params = {
            area_id: area_id,
            branch_id: branch_id
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-enable-table-build-data'), $('#table-disable-table-build-data')]);
    dataTableBuildData(res);
    dataTotalTableBuildData(res.data[2]);
}

async function dataTableBuildData(data) {
    let idEnable = $('#table-enable-table-build-data'),
        idDisable = $('#table-disable-table-build-data'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'slot_number', name: 'slot_number', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'}
        ],
        option = [{
            'title': 'Thêm mới (F2)',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'openModalCreateTableBuildData',
        }],
        scroll_Y = vh_of_table,
        fixedLeft = 0,
        fixedRight = 0;
    drawDataTableEnableTableData = await DatatableTemplateNew(idEnable, data.data[0].original.data, column, scroll_Y, fixedLeft, fixedRight, option);
    drawDataTableDisableTableData = await DatatableTemplateNew(idDisable, data.data[1].original.data, column, scroll_Y, fixedLeft, fixedRight, option);

    $(document).on('input paste keyup','input[type="search"]', async function (){
        $('#total-record-enable').text(formatNumber(drawDataTableEnableTableData.rows({'search':'applied'}).count()))
        $('#total-record-disable').text(formatNumber(drawDataTableDisableTableData.rows({'search':'applied'}).count()))
        searchUpdateIndexTable(drawDataTableEnableTableData)
        searchUpdateIndexTable(drawDataTableDisableTableData)

    })
}
async function searchUpdateIndexTable(datatable){
    let index = 1;
    await datatable.rows({'search':'applied'}).every(function (){
        let row = $(this.node())
        row.find('td:eq(0)').text(index)
        index++;
    })
}

function dataTotalTableBuildData(data) {
    $('#total-record-enable').text(data.total_record_enable);
    $('#total-record-disable').text(data.total_record_disable);
}

async function dataAreaTableBuildData() {
    let method = 'get',
        url = 'table-data.area',
        branch_id = $('.select-branch').val(),
        params = {
            branch_id: branch_id,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('.select-area-table-build-data')]);
    if (res.status == 200) {
        $('.select-area-table-build-data').html(res.data[0]);
        $('#select-area-create-table-build-data').html(res.data[0]);
        $('#select-area-update-table-build-data').html(res.data[0]);
        checkHasInSelect(selectArea, $('.select-area-table-build-data'))
    }

}

async function changeStatusTableBuildData(r) {
    if(checkChangeStatusTableBuildData === 1) return false;
    let title = 'Đổi trạng thái thành đang hoạt động';
    if(r.find('i').hasClass('fi-rr-cross')){
        title = 'Đổi trạng thái thành tạm ngưng';
    }
    thisTableData = r;
    let status = (r.data('status') == 0) ? 1 : 0,
        text = "",
        icon = 'question';
    sweetAlertComponent(title, text, icon).then(async (result) => {
        if (result.value) {
            checkChangeStatusTableBuildData = 1;
            let method = 'post',
                url = 'table-data.change-status',
                params = null,
                data = {
                    id: r.data('id'),
                    branch_id: r.data('branch'),
                    area_id: r.data('area-id'),
                    name: r.data('name'),
                    number: r.data('number'),
                    status: status
                };
            let res = await axiosTemplate(method, url, params, data, [$('#table-enable-table-build-data'), $('#table-disable-table-build-data')]);
            checkChangeStatusTableBuildData = 0;
            switch (res.data.status) {
                case 200:
                    SuccessNotify($('#success-status-data-to-server').text());
                    drawTableStatusTableData(res.data.data);
                    break;
                case 500:
                    ErrorNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
                    break;
                default:
                    let text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    WarningNotify(text);
            }
        }
    });
}

function drawTableStatusTableData(data) {
    switch (data.status) {
        case 0:
            $('#total-record-enable').text(formatNumber(removeformatNumber($('#total-record-enable').text()) - 1));
            $('#total-record-disable').text(formatNumber(removeformatNumber($('#total-record-disable').text()) + 1));
            removeRowDatatableTemplate(drawDataTableEnableTableData, thisTableData, true);
            addRowDatatableTemplate(drawDataTableDisableTableData, {
                'name': data.name,
                'slot_number': data.slot_number,
                'action': data.action,
                'keysearch': data.keysearch,
            });
            break;
        case 1:
            $('#tab-area-data-1').click();
            $('#total-record-enable').text(formatNumber(removeformatNumber($('#total-record-enable').text()) + 1));
            $('#total-record-disable').text(formatNumber(removeformatNumber($('#total-record-disable').text()) - 1));
            removeRowDatatableTemplate(drawDataTableDisableTableData, thisTableData, true);
            addRowDatatableTemplate(drawDataTableEnableTableData, {
                'name': data.name,
                'slot_number': data.slot_number,
                'action': data.action,
                'keysearch': data.keysearch,
            });
            break;
    }
}



