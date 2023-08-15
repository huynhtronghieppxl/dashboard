let dataTableUnitEnable = [],
    dataTableUnitDisable = [],
    thisUnitChangeStatus, checkChangeStatusUnitData,
    tabUnitDataChange = 0,
    tableMaterialFood = [], checkConfirmUnitSpecifications = 0;

$(function () {
    if(getCookieShared('unit-data-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('unit-data-user-id-' + idSession));
        tabUnitDataChange = dataCookie.tabUnitDataChange;
    }
    loadData();
    checkChangeStatusUnitData = 0;
    $('#nav-unit-data .nav-link').on('click',function (){
        tabUnitDataChange = $(this).data('tab');
        updateCookieUnitData()
    })
    $('#nav-unit-data .nav-link[data-tab="' +tabUnitDataChange+ '"]').click();
    // Search -> STT thay đổi theo

    $(document).on('input paste keyup','input[type="search"]', async function (){
        $('#total-record-enable').text(formatNumber(dataTableUnitEnable.rows({'search':'applied'}).count()))
        $('#total-record-disable').text(formatNumber(dataTableUnitDisable.rows({'search':'applied'}).count()))
        searchUpdateIndexDatatable(dataTableUnitEnable)
        searchUpdateIndexDatatable(dataTableUnitDisable)
    })
});

function updateCookieUnitData(){
    saveCookieShared('unit-data-user-id-' + idSession, JSON.stringify({
        tabUnitDataChange: tabUnitDataChange
    }))
}

async function loadData() {
    let method = 'get',
        url = 'unit-data.data',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-enable-unit-data'), $('#table-disable-unit-data')]);
    $('#total-record-enable').text(res.data[2].total_record_enable);
    $('#total-record-disable').text(res.data[2].total_record_disable);
    dataTableUnitData(res);
}

async function dataTableUnitData(data) {
    let idEnable = $('#table-enable-unit-data'),
        idDisable = $('#table-disable-unit-data'),
        fixed_left = 2,
        fixed_right = 1,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', class: 'text-left', width: '30%'},
            {data: 'specifications', name: 'specifications', class: 'text-left', width: '30%'},
            {data: 'action', name: 'action', class: 'text-right', width: '7%'},
            {data : 'keysearch',name:'keysearch',className:'d-none'}
        ],
    option = [{
        'title': 'Thêm mới',
        'icon': 'fa fa-plus text-primary',
        'class': '',
        'function': 'openModalCreateUnitData',
    }];
    dataTableUnitEnable = await DatatableTemplateNew(idEnable, data.data[0].original.data, columns, vh_of_table, fixed_left, fixed_right, option);
    dataTableUnitDisable = await DatatableTemplateNew(idDisable, data.data[1].original.data, columns, vh_of_table, fixed_left, fixed_right, option);
}

async function dataSpecifications(id, select, exchang){
    let url = 'unit-data.specifications-of-change',
        method = 'get',
        params = {
            unit: id,
            exchang : exchang
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [select]);
    return res.data[0];
}


function changeStatusUnitData(r) {
    thisUnitChangeStatus = r;
    let id = r.data('id');
    let title = $('#msg-title-status-unit-data').text(),
        content = $('#msg-content-status-unit-data').text(),
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            if(checkChangeStatusUnitData === 1) return false;
            let method = 'post',
                url = 'unit-data.change-status',
                params = null,
                data = {id: id};
            let res = await axiosTemplate(method, url, params, data, [$('#table-enable-unit-data'), $('#table-disable-unit-data')]);
            checkChangeStatusUnitData = 0;
            switch(res.data[1].status) {
                case 200:
                    let text = r.data('status') ? 'Đổi trạng thái tạm ngưng cho đơn vị !' : 'Đổi trạng thái hoạt động công cho đơn vị !'
                    SuccessNotify(text);
                    drawChangeUnitStatus(res.data[1].data);
                    break;
                case 205:
                    $('#modal-notify-change-status-unit').modal('show')
                    $('.btn-change-unit-material').attr('data-id', id)
                    $('.btn-change-unit-material').attr('data-status', r.attr('data-status'))
                    dataTableChangeStatusUnitData(res);
                    break;
                case 500:
                    ErrorNotify($('#error-post-data-to-server').text());
                    break;
                default:
                    WarningNotify(res.data.message);
            }
        }
    })
}

async function dataTableChangeStatusUnitData(data) {
    let tableChangeStatusSpecifications = $('#table-change-status-unit-data'),
        scroll_Y = '300px',
        fixed_left = 2,
        fixed_right = 2,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-left', width: '45%', },
            {data: 'list_unit', name: 'list_unit', className: 'text-center'},
            {data: 'list_specification', name: 'list_specification', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ];
    tableMaterialFood = await DatatableTemplateNew(tableChangeStatusSpecifications, data.data[0].original.data, column, scroll_Y, fixed_left, fixed_right, []);
    $('.select-unit-change-status, .select-specifications-change-status').select2({
        dropdownParent: $("#modal-notify-change-status-unit"),
    });
    $('.select-unit-change-status').on('change', async function () {
        $(this).find('option[value="'+ thisUnitChangeStatus.data('id') +'"]').remove();
        let a = await dataSpecifications($(this).val(), $(this).parents('tr').find('td:eq(3)').find('select'), $(this).find('option:selected').data('exchang'));
        $(this).parents('tr').find('td:eq(3)').find('select').html(a);
        $(this).parents('tr').find('td:eq(4)').find('button:first-child').removeClass('d-none');
        $(this).parents('tr').find('td:eq(3)').find('select option[value='+ $(this).parents('tr').find('td:eq(4)').find('button:first-child').data('specification') +']').trigger('select2.select');
    });
    $('.btn-change-unit-material').on('click' ,async function () {
                if(checkChangeStatusUnitData === 1) return false;
                let method = 'post',
                    url = 'unit-data.change-status',
                    params = null,
                    data = {id: $(this).attr('data-id')};
                checkChangeStatusUnitData = 1;
                let res = await axiosTemplate(method, url, params, data, [$('#table-enable-unit-data'), $('#table-disable-unit-data')]);
                checkChangeStatusUnitData = 0;
                switch (res.data[1].status){
                    case 200:
                        let text = $(this).attr('data-status') ? 'Tạm ngưng đơn vị thành công ' : 'Bật hoạt động đơn vị thành công'
                        SuccessNotify(text);
                        loadData();
                        drawChangeUnitStatus(res.data[1].data);
                        closeModalNotifyUnitData()
                        break;
                    case 500:
                        ErrorNotify($('#error-post-data-to-server').text());
                        break;
                    default:
                        WarningNotify(res.data[1].message);
                }
    })
}


async function confirmUnitSpecifications(r){
     if(checkConfirmUnitSpecifications !== 0) return false;
    checkConfirmUnitSpecifications = 1;
    if (r.parents('tr').find('td:eq(3)').find('select option:selected').val() == '-2' || r.parents('tr').find('td:eq(3)').find('select option:selected').val() == null || r.parents('tr').find('td:eq(3)').find('select option:selected').val() == ''){
        r.parents('tr').find('td:eq(3)').addClass('table-select-error');
        checkConfirmUnitSpecifications = 0;
        return false;
    }
    let category = r.data('category'),
        unit = r.parents('tr').find('td:eq(2)').find('select option:selected').val(),
        specifications = r.parents('tr').find('td:eq(3)').find('select option:selected').val(),
        material_category_type_id = r.data('material-category'),
        name = r.data('name'),
        code = r.data('code'),
        price = r.data('price'),
        min = r.data('out-stock'),
        lose = r.data('wastage-rate'),
        status = r.data('status'),
        exchange_current_value = r.parents('tr').find('td:eq(3)').find('select option:selected').data('exchange-value'),
        id = r.data('id'),
        des = r.data('res');
    let method = 'post',
        url = 'unit-data.confirm-unit',
        params = null,
        data = {
            price: price,
            name: name,
            code: code,
            material_unit_id: unit,
            material_unit_specification_id: specifications,
            material_category_id: material_category_type_id,
            out_stock_alert_quantity: min,
            wastage_rate: lose,
            description: des,
            status: status,
            material_category_type_id: category,
            id: id,
            material_unit_specification_current_id: specifications ,
            exchange_current_value: exchange_current_value
        };
    let res = await axiosTemplate(method, url, params, data, [$('#modal-body-update-material')]);
     checkConfirmUnitSpecifications = 0;
    switch(res.data.status) {
        case 200:
            let  text= ' Chỉnh sửa đơn vị nguyên liệu thành công !';
            SuccessNotify(text)
            r.addClass('d-none');
            r.data('specification', res.data.data.specifications);
            r.data('unit', res.data.data.unit_id);
            r.removeClass('border');
            r.removeClass('border-danger');
            if($('.select-unit-change-status').find('option:selected[value="'+ thisUnitChangeStatus.data('id') +'"]').length > 0 && !checkChangeUnit() ){
                $('.btn-change-unit-material').addClass('d-none');
            }else {
                $('.btn-change-unit-material').removeClass('d-none');
            }
            break;
        case 400:
            ErrorNotify(res.data.message);
    }
}
function checkChangeUnit() {
    let hasVisibleSeemtGreen = false;
    $('.btn-check-change-unit').each(function() {
        if (!$(this).hasClass('d-none')) {
            hasVisibleSeemtGreen = true;
            return false; // exit the loop early
        }
    });
    return hasVisibleSeemtGreen;
}
function drawChangeUnitStatus(data) {
    console.log({data})
    if (data.status === 1) {
        $('#total-record-disable').text(formatNumber(removeformatNumber($('#total-record-disable').text()) - 1));
        $('#total-record-enable').text(formatNumber(removeformatNumber($('#total-record-enable').text()) + 1));
        removeRowDatatableTemplate(dataTableUnitDisable, thisUnitChangeStatus, true);
        addRowDatatableTemplate(dataTableUnitEnable, {
            'name': data.name,
            'specifications': data.specifications,
            'action': data.action,
            'keysearch': data.keysearch,
        });
    } else {
        $('#total-record-enable').text(formatNumber(removeformatNumber($('#total-record-enable').text()) - 1));
        $('#total-record-disable').text(formatNumber(removeformatNumber($('#total-record-disable').text()) + 1));
        removeRowDatatableTemplate(dataTableUnitEnable, thisUnitChangeStatus, true);
        addRowDatatableTemplate(dataTableUnitDisable, {
            'name': data.name,
            'specifications': data.specifications,
            'action': data.action,
            'keysearch': data.keysearch,
        });
    }
}
