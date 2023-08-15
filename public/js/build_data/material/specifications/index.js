let dataTableSpecificationsEnable = [],
    dataTableSpecificationsDisable = [],
    checkChangeStatusSpecificationsData = 0,
    thisSpecificationChangeStatus,
    tabSpecificationDataChange = 0, datatableDisabledMaterialSpe, datatableDisabledUnitSpe;

$(function () {
    if(getCookieShared('specification-data-user-id-' + idSession)) {
        let dataCookie = JSON.parse(getCookieShared('specification-data-user-id-' + idSession));
        tabSpecificationDataChange = dataCookie.tabSpecificationDataChange;
    }
    $('#nav-specification-data .nav-link').on('click', function () {
        tabSpecificationDataChange = $(this).data('tab');
        updateCookieSpecificationsData();
    })
    $('#nav-specification-data .nav-link[data-tab="' + tabSpecificationDataChange + '"]').click();

    $(document).on('input paste keyup', 'input[type="search"]', async function () {
        $('#total-record-enable').text(formatNumber(dataTableSpecificationsEnable.rows({'search': 'applied'}).count()))
        $('#total-record-disable').text(formatNumber(dataTableSpecificationsDisable.rows({'search': 'applied'}).count()))
        searchUpdateIndexDatatable(dataTableSpecificationsEnable)
        searchUpdateIndexDatatable(dataTableSpecificationsDisable)
    });
    loadData();
});

function updateCookieSpecificationsData() {
    saveCookieShared('specification-data-user-id-' + idSession, JSON.stringify({
        tabSpecificationDataChange: tabSpecificationDataChange
    }))
}

async function loadData() {
    let method = 'get',
        url = 'specifications-data.data',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-enable-specifications-data'), $('#table-disable-specifications-data')]);
    dataTableSpecificationsData(res);
    dataTotalSpecificationsData(res.data[2]);
}

async function dataTableSpecificationsData(data) {
    let idEnableSpecifications = $('#table-enable-specifications-data'),
        idDisableSpecifications = $('#table-disable-specifications-data'),
        fixed_left = 0,
        fixed_right = 0,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'exchange_value', name: 'exchange_value', className: 'text-center'},
            {data: 'material_unit_specification_exchange_name', name: 'material_unit_specification_exchange_name', className: 'text-left'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ],
        option = [{
            'title': 'Thêm mới',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'openModalCreateSpecificationsData',
        }];
    dataTableSpecificationsEnable = await DatatableTemplateNew(idEnableSpecifications, data.data[0].original.data, columns, vh_of_table, fixed_left, fixed_right, option);
    dataTableSpecificationsDisable = await DatatableTemplateNew(idDisableSpecifications, data.data[1].original.data, columns, vh_of_table, fixed_left, fixed_right, option);
}

function dataTotalSpecificationsData(data) {
    $('#total-record-enable').text(data.total_record_enable);
    $('#total-record-disable').text(data.total_record_disable);
}

function changeStatusSpecificationsData(r) {
    thisSpecificationChangeStatus = r;
    if (checkChangeStatusSpecificationsData === 1) return false;
    let title = $('#msg-title-status-specifications-data').text(),
        content = $('#msg-content-status-specifications-data').text(),
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            checkChangeStatusSpecificationsData = 1;
            let method = 'post',
                url = 'specifications-data.change-status',
                params = null,
                data = {id: r.data('id')};
            let res = await axiosTemplate(method, url, params, data);
            checkChangeStatusSpecificationsData = 0;
            switch (res.data.status) {
                case 200:
                    SuccessNotify($('#success-status-data-to-server').text());
                    drawDataTableEnableTableData(res.data.data)
                    break;
                    // TẠM NGƯNG QUY CÁCH NHƯNG CÓ ĐƠN VỊ VÀ NGUYÊN LIỆU ĐANG SỬ DỤNG QUY CÁCH ĐÓ
                case 205:
                    openModalNotifySpecificationData()
                    $('#title-notify-change-status-unit').text('Quy cách ' + r.data('name') + ' đang được sử dụng !');
                    $('#message-notify-change-status-unit').text(res.data.message);
                    drawDatatableChangeStatusSpe(res);
                    break;
                case 500:
                    ErrorNotify($('#error-post-data-to-server').text());
                    break;
                default:
                    if (res.data.message !== null) {
                        WarningNotify(res.data.data.message);
                    }
            }
        }
    })
}

function drawDataTableEnableTableData(data) {
    console.log(data);
    switch (data.status) {
        case 0:
            $('#total-record-enable').text(formatNumber(removeformatNumber($('#total-record-enable').text()) - 1));
            $('#total-record-disable').text(formatNumber(removeformatNumber($('#total-record-disable').text()) + 1));
            removeRowDatatableTemplate(dataTableSpecificationsEnable, thisSpecificationChangeStatus, true);
            addRowDatatableTemplate(dataTableSpecificationsDisable, {
                'name': data.name,
                'exchange_value': data.exchange_value,
                'material_unit_specification_exchange_name': data.material_unit_specification_exchange_name,
                'action': data.action,
                'keysearch': data.keysearch,
            });
            break;
        case 1:
            $('#total-record-enable').text(formatNumber(removeformatNumber($('#total-record-enable').text()) - 1));
            $('#total-record-disable').text(formatNumber(removeformatNumber($('#total-record-disable').text()) + 1));
            removeRowDatatableTemplate(dataTableSpecificationsDisable, thisSpecificationChangeStatus, true);
            addRowDatatableTemplate(dataTableSpecificationsEnable, {
                'name': data.name,
                'exchange_value': data.exchange_value,
                'material_unit_specification_exchange_name': data.material_unit_specification_exchange_name,
                'action': data.action,
                'keysearch': data.keysearch,
            });
            break;
    }
}

async function drawDatatableChangeStatusSpe(data) {
    let id = $('#table-spe-disabled-material'),
        id2 = $('#table-spe-disabled-unit'),
        fixed_left = 0,
        fixed_right = 0,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ],
        columns2 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'material_unit_name', name: 'material_unit_name', className: 'text-center'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ],
        option = [];
    datatableDisabledMaterialSpe = await DatatableTemplateNew(id, data.data.data.table_material.original.data, columns, vh_of_table, fixed_left, fixed_right, option);
    datatableDisabledUnitSpe = await DatatableTemplateNew(id2, data.data.data.table_unit.original.data, columns2, vh_of_table, fixed_left, fixed_right, option);

    $('#total-record-disabled-material').text(data.data.data.total_material)
    $('#total-record-disabled-unit').text(data.data.data.total_unit)

    // search cap nhat cot stt va tinh lai total_record tab
    $(document).on('input paste keyup keydown','input[type="search"]', function (){
        $('#total-record-disabled-material').text(datatableDisabledMaterialSpe.rows({'search':'applied'}).count());
        $('#total-record-disabled-unit').text(datatableDisabledUnitSpe.rows({'search':'applied'}).count());
        searchUpdateIndexDatatable(datatableDisabledMaterialSpe)
        searchUpdateIndexDatatable(datatableDisabledUnitSpe)
    })
}
