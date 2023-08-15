let restaurant_brand_create_price_adjustment = $('#select-restaurant-brand-price-adjustment').val(),
    saveCreatePriceAdjustmentData = 0, tableCreatePriceAdjustment,
    thisRowCreatePriceAdjustment;
$(function (){
    $('#select-food-price-adjustment').on('select2:select', async function () {
        await selectFoodPriceAdjustment();
        $('#select-food-price-adjustment').find(':selected').remove();
        $('#select-food-price-adjustment').val('').trigger('change.select2');
    });
    $('#select-restaurant-brand-price-adjustment').on('select2:select', function () {
        if (tableCreatePriceAdjustment.rows().count() > 0) {
            let title = 'Đổi thương hiệu ?',
                content = 'Bạn đã chọn món ăn, đổi thương hiệu sẽ làm mới danh sách món ăn !',
                icon = 'question';
            sweetAlertComponent(title, content, icon).then((result) => {
                if (result.value) {
                    restaurant_brand_create_price_adjustment = $(this).val();
                    tableCreatePriceAdjustment.clear().draw(false);
                    $('#total-table-create').text('0');
                    dataFoodDetailPriceAdjustment()
                } else {
                    $(this).val(restaurant_brand_create_price_adjustment).trigger('change.select2')
                }
            });
        } else {
            restaurant_brand_create_price_adjustment = $(this).val();
            tableCreatePriceAdjustment.clear().draw(false);
            dataFoodDetailPriceAdjustment()
        }
    });
    $(document).on('click', '#modal-create-price-adjustment-data input', function () {
        $(this).select();
    });
    $(document).on('input paste', 'input.adjustment', function () {
        $(this).removeClass('border-danger');
        let adjustment = parseFloat(removeformatNumber($(this).val()));
        let price = parseFloat(removeformatNumber($(this).parents('tr').find('td:eq(1)').text()));
        $(this).data('value', adjustment);
        $(this).parents('tr').find('td:eq(2)').data('value', adjustment - price);
        $(this).parents('tr').find('td:eq(2)').text(formatNumber(adjustment - price));
    });
    $('#loading-modal-create-price-adjustment-data').on('change',function (){
        $('.btn-renew').removeClass('d-none');
    })
    $('#note-price-adjustment').on('input',function (){
        $('.btn-renew').removeClass('d-none');
    })

    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('F2', function () {
        openModalCreatePriceAdjustment();
    });
})
async function openModalCreatePriceAdjustment() {
    $('#modal-create-price-adjustment-data').modal('show');
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalCreatePriceAdjustment();
    });
    shortcut.add('F4', function () {
        saveModalCreatePriceAdjustment();
    });
    shortcut.add('F9', function () {
        if ($('#select-food-price-adjustment').select2('isOpen') === true) {
            $('#select-food-price-adjustment').select2('close');
        } else {
            $('#modal-table-price-adjustment .js-example-basic-single').select2('close');
            $('#select-food-price-adjustment').select2('open');
        }
    });
    $('#select-food-price-adjustment, #select-restaurant-brand-price-adjustment').select2({
        dropdownParent: $('#modal-create-price-adjustment-data'),
    });

    shortcut.add('ESC', closeModalCreatePriceAdjustment);
    shortcut.add('F4', saveModalCreatePriceAdjustment);
    shortcut.remove('F2');

    $('#select-restaurant-brand-price-adjustment').val($('.select-brand option:selected').val()).trigger('change.select2')
    drawTableCreatePriceAdjustment();
    dataFoodDetailPriceAdjustment();
}

async function dataFoodDetailPriceAdjustment() {
    let method = 'get',
        url = 'price-adjustment-data.food',
        restaurant_brand_id = $('#select-restaurant-brand-price-adjustment').val(),
        params = {
            restaurant_brand_id: restaurant_brand_id,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#select-food-price-adjustment')]);
    $('#select-food-price-adjustment').html(res.data[0]);
}

async function drawTableCreatePriceAdjustment() {
    let id = $('#modal-table-price-adjustment'),
        column = [
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'original_price', name: 'original_price', className: 'text-right'},
            {data: 'difference', name: 'difference', className: 'text-center'},
            {data: 'price', name: 'price', className: 'text-center', width: '15%'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name:'keysearch', className:'d-none'}
        ],
        scroll_Y = "40vh",
        fixedLeft = 0,
        fixedRight = 0;
    let option = [];
    tableCreatePriceAdjustment = await DatatableTemplateNew(id, [], column, scroll_Y, fixedLeft, fixedRight,option);
}

function selectFoodPriceAdjustment() {
    addRowDatatableTemplate(tableCreatePriceAdjustment, {
        'name': $('#select-food-price-adjustment').find(':selected').data('name'),
        'original_price': formatNumber($('#select-food-price-adjustment').find(':selected').data('price')),
        'difference': '<label data-value="0">' + 0 + '</label>',
        'price':  '<div class="input-group border-group validate-table-validate">' +
            '  <input style="font-size: 14px !important;" class="form-control adjustment text-center border-radius-6-px border-0 w-100" data-max="999999999" data-money="1" data-value="' + $('#select-food-price-adjustment').find(':selected').data('price') + '" value="' + formatNumber($('#select-food-price-adjustment').find(':selected').data('price')) + '" >' +
            '</div>',
        'action': '<div class="btn-group btn-group-sm">' +
            '<button type="button" class="tabledit-edit-button btn seemt-red seemt-btn-hover-red waves-effect waves-light" data-id="' + $('#select-food-price-adjustment').val() + '" data-name="' + $('#select-food-price-adjustment').find(':selected').data('name') + '" data-price="' + $('#select-food-price-adjustment').find(':selected').data('price') + '" data-keysearch="' + $('#select-food-price-adjustment').find(':selected').data('keysearch') + '" onclick="deleteRow($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Xóa"><i class="fi-rr-trash"></i></button>' +
            '</div>',
        'keysearch':$('#select-food-price-adjustment').find(':selected').data('keysearch')

    });
}

function deleteRow(r) {
    thisRowCreatePriceAdjustment = r
    $('#select-food-price-adjustment').append('<option value="' + r.data('id') + '" data-name="' + r.data('name') + '" data-price="' + r.data('price') + '" data-keysearch="' + r.data('keysearch') + '">' + r.data('name') + '</option>');
    tableCreatePriceAdjustment.row(r.parents('tr')).remove().draw(false);
}

async function saveModalCreatePriceAdjustment() {
    if (saveCreatePriceAdjustmentData === 1) {
        return false;
    }
    if (!checkValidateSave($('#modal-create-price-adjustment-data'))) return false;
    let table = [];
    let checkChang = 0;
    await tableCreatePriceAdjustment.rows().every(function () {
        let row = $(this.node());
        if (removeformatNumber(row.find('td:eq(2)').text()) !== 0) {
            table.push({
                'food_id': row.find('td:eq(4)').find('button').data('id'),
                'food_name': row.find('td:eq(4)').find('button').data('name'),
                'old_price': row.find('td:eq(4)').find('button').data('price'),
                'new_price': row.find('td:eq(3)').find('input').data('value'),
                'price_difference': removeformatNumber(row.find('td:eq(2)').text()),
            });
        } else {
            checkChang++;
            row.find('td:eq(3)').find('input').addClass('border-danger');
        }
    });
    if(checkChang != 0){
        let text = 'Vui lòng thay đổi giá món cần đổi';
        WarningNotify(text);
        return false;
    }
    if (tableCreatePriceAdjustment.rows().count() === 0) {
        let text = 'Vui lòng chọn món ăn cần thay đổi giá';
        WarningNotify(text);
        return false;
    }
    saveCreatePriceAdjustmentData = 1;
    let note = $('#note-price-adjustment').val(),
        restaurant_brand_id = $('#select-restaurant-brand-price-adjustment').val(),
        method = 'post',
        url = 'price-adjustment-data.create',
        params = null,
        data = {
            details: table,
            restaurant_brand_id: restaurant_brand_id,
            note: note,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-create-price-adjustment-data')]);
    saveCreatePriceAdjustmentData = 0;
    let text = ''
    switch (res.data.status ) {
        case 200:
            text = $('#success-create-data-to-server').text();
            SuccessNotify(text);
            closeModalCreatePriceAdjustment();
            drawDataTablePriceAdjustment(res.data.data)
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            ErrorNotify(text);
            break;
        default:
            WarningNotify($('#error-post-data-to-server').text())
    }
}

function drawDataTablePriceAdjustment(data) {
    $('#total-record-waiting').text(formatNumber(removeformatNumber($('#total-record-waiting').text()) + 1));
    addRowDatatableTemplate(dataTablePriceAdjustmentWaiting, {
        'code': data.code,
        'employee_create_name': data.employee_create_name,
        'created_at': data.created_at,
        'updated_at': data.updated_at,
        'number_food': data.number_food,
        'action': data.action,
        'keysearch': data.keysearch,
    });
}

function closeModalCreatePriceAdjustment() {
    $('#modal-create-price-adjustment-data').modal('hide');
    resetModalCreatePriceAdjustment();
    countCharacterTextarea()

    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('F2', function () {
        openModalCreatePriceAdjustment();
    });
}

function resetModalCreatePriceAdjustment() {
    $('#note-price-adjustment').val('');
    $('#total-table-create').text('0');
    $('.btn-renew').addClass('d-none');
    $('.error').addClass('d-none');
    removeErrorInput($('#note-price-adjustment'));
    tableCreatePriceAdjustment.clear().draw(false);
    dataFoodDetailPriceAdjustment()
    $('#select-restaurant-brand-price-adjustment').val($('#select-restaurant-brand-price-adjustment :first').val()).trigger('change.select2');
}
