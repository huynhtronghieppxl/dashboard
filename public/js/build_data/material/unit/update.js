let checkSaveUpdateUnitData = 0, thisUpdateUnitData = null;
let loadDataUpdateSpecificationsDataUpdate = 0,tableUpdateSpecificationUnitData, tableUpdateSpecificationUnitDataSelected,
    idUnit, loadSpecificationsUpdateData;
$(function(){
    $('#name-create-specifications-data-update, #value-exchange-create-specifications-data-update').on('input paste', function (){
        $('#modal-update-unit-data .btn-renew').removeClass('d-none')
    });
    $('#value-name-create-specifications-data-update').on('change', function (){
        $('#modal-update-unit-data .btn-renew').removeClass('d-none')
    });
    $('#name-update-unit-data').on('change', function () {
        $('#code-update-unit-data').val(removeVietnameseStringLowerCase($(this).val()).toUpperCase())
    });
})
 async function openModalUpdateUnitData(r) {
    thisUpdateUnitData = r;
    idUnit = r.data('id');
    $('#modal-update-unit-data').modal('show');
    shortcut.remove("F2");
    shortcut.add('F4', function () {
         saveUpdateUnitData();
    });
    shortcut.add('ESC', function () {
         closeModalUpdateUnitData();
    });
    $('#select-specifications-update-unit-data').val(r.data('type')).trigger('change.select2');
    $('#select-specifications-update-unit-data,#value-name-create-specifications-data-update').select2({
        dropdownParent: $('#modal-update-unit-data'),
    });
    dataUpdateUnitData(idUnit);
    dataSpecificationsUnitData();
}

function openModalUpdateSpecificationsDataUpdate(){
    dataServerUpdateSpecificationsDataUpdate()
    $('#create-specifications-data-update').removeClass('d-none')
    $('.create-specifications-data-update').removeClass('d-none')
    $('#update-unit-data').addClass('d-none')
    $('.update-unit-data').addClass('d-none')
    $('#btn-prev-create-specifications-update').removeClass('d-none');
    $('#modal-update-unit-data').children('.modal-dialog').removeClass('modal-xl')
    $('#modal-update-unit-data').children('.modal-dialog').addClass('modal-md')
    $('#btn-update-specifications').addClass('d-none')


}

async function dataUpdateUnitData(id) {
    let url = 'unit-data.data-update',
        method = 'get',
        params = {
            id: id,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-update-unit-data-selected'), $('#table-update-unit-data')]);
    $('#name-update-unit-data').val(res.data[0].name);
    $('#code-update-unit-data').text(res.data[0].code);
    $('#description-update-unit-data').val(res.data[0].description);
    $('#status-update-unit-data').text(res.data[0].status);
    $('#select-specifications-update-unit-data').html(res.data[1]);
    let data1 = res.data[2].original.data.filter(function(element) {
        return !res.data[3].original.data.some(function(bElement) {
            return bElement.id === element.id;
        });
    });
    drawTableSpecificationsUpdateUnitData(data1, res.data[3].original.data, )
    countCharacterTextarea()
}
async function drawTableSpecificationsUpdateUnitData(data1, data2) {
    let id = $('#table-update-unit-data'),
        id_selected = $('#table-update-unit-data-selected'),
        fixed_left = 2,
        fixed_right = 2,
        column1 = [
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'check-box', name: 'check-box', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'text-center d-none', width: '5%'},
        ],
        column2 = [
            {data: 'check-box', name: 'check-box', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'keysearch', name: 'keysearch', className: 'text-center d-none', width: '5%'},
        ];

    tableUpdateSpecificationUnitData = await DatatableTemplateNew(id, data1, column1, '30vh', fixed_left, fixed_right);
    tableUpdateSpecificationUnitDataSelected = await DatatableTemplateNew(id_selected, data2, column2, '30vh', fixed_left, fixed_right);
}
async function checkSpecificationsUpdate(r) {
    let item = {
        'name': r.parents('tr').find('td:eq(0)').html(),
        'check-box': '<div class="btn-group btn-group-sm">\n' +
            '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light  btn-convert-left-to-left  pointer"  onclick="unCheckSpecificationsUpdate($(this))"  data-id="' + r.attr('data-id') + '" ><i class="fi-rr-arrow-small-left" ></i></button>\n' +
            '</div>',
        'keysearch': r.parents('tr').find('td:eq(2)').text(),
    };

    addRowDatatableTemplate(tableUpdateSpecificationUnitDataSelected, item);
    tableUpdateSpecificationUnitData.row(r.parents('tr')).remove().draw(false);
}

async function unCheckSpecificationsUpdate(r) {
    let item = {
        'name': r.parents('tr').find('td:eq(1)').html(),
        'check-box': '<div class="btn-group btn-group-sm">\n' +
            '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light  btn-convert-left-to-left  pointer"  onclick="checkSpecificationsUpdate($(this))"  data-id="' + r.attr('data-id') + '" ><i class="fi-rr-arrow-small-left" ></i></button>\n' +
            '</div>',
        'keysearch': r.parents('tr').find('td:eq(2)').text(),
    };

    addRowDatatableTemplate(tableUpdateSpecificationUnitData, item);
    tableUpdateSpecificationUnitDataSelected.row(r.parents('tr')).remove().draw(false);
}

async function checkAllSpecificationsUpdate() {
    addAllRowDatatableTemplate(tableUpdateSpecificationUnitData, tableUpdateSpecificationUnitDataSelected, itemSpecificationsSelectedUpdate);
}

async function unCheckAllSpecificationsUpdate() {
    addAllRowDatatableTemplate(tableUpdateSpecificationUnitDataSelected, tableUpdateSpecificationUnitData, itemSpecificationsUpdate);
}

function itemSpecificationsSelectedUpdate(r) {

    return {
        'name': r.find('td:eq(0)').text(),
        'check-box': '<div class="btn-group btn-group-sm">\n' +
            '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light  btn-convert-left-to-right  pointer"  onclick="unCheckSpecificationsUpdate($(this))"  data-id="' + r.find('td:eq(1) button').attr('data-id') + '" ><i class="fi-rr-arrow-small-left" ></i></button>\n' +
            '</div>',
        'keysearch': r.find('td:eq(2)').text(),
    };
}

function itemSpecificationsUpdate(r) {
    return {
        'name': r.find('td:eq(1)').text(),
        'check-box': '<div class="btn-group btn-group-sm">\n' +
            '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light  btn-convert-right-to-left  pointer"  onclick="checkSpecificationsUpdate($(this))"  data-id="' + r.find('td:eq(0) button').attr('data-id') + '" ><i class="fi-rr-arrow-small-right" ></i></button>\n' +
            '</div>',
        'keysearch': r.find('td:eq(2)').text(),
    };
}

async function dataSpecificationsUnitData() {
    if (loadDataSpecificationUnitData === 0) {
        let url = 'unit-data.specifications-of-change',
            method = 'get',
            params = null,
            data = null;
        let res = await axiosTemplate(method, url, params, data, [$('#select-specifications-create-unit-data')]);
        loadDataSpecificationUnitData = 1;
        $('#select-specifications-create-unit-data').html(res.data[0]);
        loadSpecificationsCreateData = res.data[0];
    }
}

async function dataServerUpdateSpecificationsDataUpdate() {
    if (loadDataUpdateSpecificationsDataUpdate === 0) {
        let url = 'specifications-data.data-server',
            method = 'get',
            params = null,
            data = null;
        let res = await axiosTemplate(method, url, params, data, [$('#value-name-create-specifications-data-update')]);
        loadDataUpdateSpecificationsDataUpdate = 1;
        $('#value-name-create-specifications-data-update').html(res.data[0]);
    }
}

async function saveUpdateUnitData(){
    if (checkSaveUpdateUnitData === 1) return false;
    let name = $('#name-update-unit-data').val(),
        code = $('#code-update-unit-data').text(),
        specifications = [],
        description = $('#description-update-unit-data').val();
    if(!checkValidateSave($('#update-unit-data'))) return false;
    if (tableUpdateSpecificationUnitDataSelected.rows().count() < 1) {
        WarningNotify('Vui lòng chọn quy cách ');
        return false;
    }
    await tableUpdateSpecificationUnitDataSelected.rows().every(function () {
        let x = $(this.node());
        specifications.push(x.find('td:eq(0) button').attr('data-id'))
    })
    checkSaveUpdateUnitData = 1;
    let url = 'unit-data.update',
        method = 'post',
        params = null,
        data = {
            id: idUnit,
            name: name,
            code: code,
            specifications: specifications,
            description: description,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#update-unit-data')]);
    checkSaveUpdateUnitData = 0;
    switch(res.data.status) {
        case 200:
            SuccessNotify($('#success-update-data-to-server').text());
            thisUpdateUnitData.parents('tr').find('td:eq(1)').html(res.data.data.name);
            thisUpdateUnitData.parents('tr').find('td:eq(2)').text(res.data.data.specifications);
            thisUpdateUnitData.parents('tr').find('td:eq(3)').html(res.data.data.action);
            closeModalUpdateUnitData();
            $('#select-specifications-update-unit-data').val('').trigger('change.select2');
            break;
        case 205:
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    popup : 'swal-size-50',
                    container: 'modal-create-note',
                    cancelButton: 'btn btn-grd-disabled btn-sweet-alert',
                },
                buttonsStyling: false,
                className: "f-12",
                allowOutsideClick: false,
            });
            swalWithBootstrapButtons.fire({
                title: 'Quy cách đang được sử dụng !',
                icon: 'warning',
                html: `<h5 class="text-justify font-weight-bold">${res.data.message}</h5>
                                    <div class="card-block px-0 seemt-main-content">
                                        <div class="table-responsive new-table">
                                            <table id="table-update-unit-data-order" class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">STT</th>
                                                        <th class="text-center">Tên nguyên liệu</th>
                                                        <th class="text-center"></th>
                                                        <th class="d-none"></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>`,
                showCloseButton: false,
                showCancelButton: true,
                allowOutsideClick: false,
                showConfirmButton: false,
                cancelButtonText: $('#button-btn-cancel-component').text(),
                reverseButtons: false,
                focusConfirm: false,
            }).then(async (result) => {
                if (result.value) {
                    let url = 'unit-data.update',
                        method = 'post',
                        params = null,
                        data = {
                            id: idUnit,
                            name: name,
                            code: code,
                            specifications: specifications,
                            description: description,
                        };
                    let res = await axiosTemplate(method, url, params, data, [$('#update-unit-data')]);
                    if (res.data.status === 200) {
                        let text = $('#success-status-data-to-server').text();
                        SuccessNotify(text);
                    }
                }
            })
            drawTableUpdateUnitData(res);
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify(res.data.message);
    }
}

async function drawTableUpdateUnitData(data) {
    let tableUpdateUnitData = $('#table-update-unit-data-order'),
        scroll_Y = '300px',
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '8%'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '10%'},
            {data: 'keysearch', className: 'd-none'},
        ];
    let dataTableMaterial = await DatatableTemplateNew(tableUpdateUnitData, data.data.data.original.data, column, scroll_Y, fixed_left, fixed_right, []);
    $(document).on('input paste','#table-update-unit-data_filter input', function (){
        let indexMaterial = 1;
        dataTableMaterial.rows({'search':'applied'}).every(function () {
            let row = $(this.node())
            row.find('td:eq(0)').text(indexMaterial)
            indexMaterial++;
        });
    })
}

async function saveUpdateSpecificationsDataUpdate(){
    if (checkSaveUpdateUnitData !== 0) return false;
    let id = $('#create-specifications-data-update')
    let name = $('#name-create-specifications-data-update').val(),
        value_ex = removeformatNumber($('#value-exchange-create-specifications-data-update').val()),
        name_ex = $('#value-name-create-specifications-data-update').val();
    if(!checkValidateSave(id)){
        return false
    }
    checkSaveUpdateUnitData = 1;
    let url = 'specifications-data.create',
        method = 'post',
        params = null,
        data = {
            name: name,
            name_ex: name_ex,
            value_ex: value_ex,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#create-specifications-data-update')]);
    checkSaveUpdateUnitData = 0;
    let text = '';
    switch(res.data.status) {
        case 200:
            text = $('#success-create-data-to-server').text();
            SuccessNotify(text);
            let item = {
                'name': `${res.data.data.name} (${res.data.data.exchange_value} ${res.data.data.material_unit_specification_exchange_name})`,
                'check-box': '<div class="btn-group btn-group-sm">\n' +
                    '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light  btn-convert-left-to-left  pointer"  onclick="unCheckSpecificationsUpdate($(this))"  data-id="' + res.data.data.id + '" ><i class="fi-rr-arrow-small-left" ></i></button>\n' +
                    '</div>',
                'keysearch': res.data.data.name,
            };
            addRowDatatableTemplate(tableUpdateSpecificationUnitDataSelected, item);
            $('#btn-update-specifications').removeClass('d-none')
            //xóa value input
            $('#name-create-specifications-data-update').val('');
            $('#value-exchange-create-specifications-data-update').val(1);
            $('#value-name-create-specifications-data-update').val('').trigger('change.select2');
            //xóa value input
            $('#create-specifications-data-update').addClass('d-none')
            $('.create-specifications-data-update').addClass('d-none')
            $('.update-unit-data').removeClass('d-none')
            $('#update-unit-data').removeClass('d-none')
            $('#btn-prev-create-specifications-update').addClass('d-none')
            $('#modal-update-unit-data').children('.modal-dialog').addClass('modal-xl')
            $('#modal-update-unit-data').children('.modal-dialog').removeClass('modal-md')
            $('.btn-renew').addClass('d-none');
            let html = '<option value="'+res.data.data.id + '" data-unit-id="' + res.data.data.material_unit_specification_exchange_name_id +'" selected>' + res.data.data.name + ' ' + '(' + res.data.data.exchange_value + res.data.data.material_unit_specification_exchange_name + ')' + '</option>';
            $('#select-specifications-update-unit-data').prepend(html);
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

async function saveModalUpdateUnitData() {
    if($('#create-specifications-data-update').hasClass('d-none')){
        saveUpdateUnitData()
    }else{
        saveUpdateSpecificationsDataUpdate()
    }
}

function prevUpdateSpecificationsUpdate() {
    $('#btn-prev-create-specifications-update').addClass('d-none')
    $('.update-unit-data').removeClass('d-none')
    $('.create-specifications-data-update').addClass('d-none')
    $('#btn-close-create-specifications-update').removeClass('d-none')
    $('#modal-update-unit-data .btn-renew').addClass('d-none');
    $('#modal-update-unit-data').children('.modal-dialog').addClass('modal-xl')
    $('#modal-update-unit-data').children('.modal-dialog').removeClass('modal-md')
    $('#btn-update-specifications').removeClass('d-none')
}

function closeModalUpdateUnitData() {
    $('#modal-update-unit-data').modal('hide');
    shortcut.remove('ESC');
    shortcut.add('F2', function () {
        openModalCreateUnitData();
    });
    reloadModalUpdateUnitData();
    resetModalUpdateUnitData()
    $('#modal-update-unit-data').children('.modal-dialog').addClass('modal-xl')
    $('#modal-update-unit-data').children('.modal-dialog').removeClass('modal-md')
    $('#btn-update-specifications').removeClass('d-none')
    tableUpdateSpecificationUnitData.clear().draw();
    tableUpdateSpecificationUnitDataSelected.clear().draw();
}

function reloadModalUpdateUnitData(){
    removeAllValidate();
    $('#modal-update-unit-data input').val('');
    $('#btn-prev-create-specifications-update').addClass('d-none');
    $('#create-specifications-data-update').addClass('d-none');
    $('#btn-close-update-specifications-update').removeClass('d-none');
    $('.create-specifications-data-update').addClass('d-none');
    $('.update-unit-data').removeClass('d-none');
}

function resetModalUpdateUnitData() {
    $('#name-create-specifications-data-update').val('');
    $('#value-exchange-create-specifications-data-update').val(1);
    $('#value-name-create-specifications-data-update').val(null).trigger('change');
    $('#modal-update-unit-data .btn-renew').addClass('d-none');
}
