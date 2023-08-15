let idUpdatePriceAdjustment,
    restaurantBrandUpdatePriceAdjustment,
    changeUpdatePriceAdjustment,
    saveUpdatePriceAdjustment,
    tableUpdatePriceAdjustment,
    thisUpdatePriceAdjustment,
    cancelChangePriceAdjustment,
    idEmployeeUpdatePriceAdjustment,
    dataPrevUpdatePriceAdjustment;
$(function (){
    $(document).on('input', '#table-update-price-adjustment input.adjustment', function () {
        if (removeformatNumber($(this).val()) < 0) {
            $(this).val(0);
            $(this).select();
            let text = 'Số tiền không được nhỏ hơn 0';
            ErrorNotify(text);
        }
        let adjustment = parseFloat(removeformatNumber($(this).val()));
        let price = parseFloat(removeformatNumber($(this).parents('tr').find('td:eq(1)').text()));
        $(this).data('value', adjustment);
        $(this).parents('tr').find('td:eq(2)').data('value', adjustment - price);
        $(this).parents('tr').find('td:eq(2)').text(formatNumber(adjustment - price));
    });
    $('#select-food-update-price-adjustment').on('select2:select', async function () {
        await selectFoodUpdatePriceAdjustment();
        $('#select-food-update-price-adjustment').find(':selected').remove();
        $('#select-food-update-price-adjustment').val('').trigger('change.select2');
    });
    $(document).on('click','#employee-update-price-adjustment', function (){
        openModalInfoEmployeeManage(idEmployeeUpdatePriceAdjustment);
    })
})
async function openModalUpdatePriceAdjustment(r) {
    thisUpdatePriceAdjustment = r;
    $('#modal-update-price-adjustment').modal('show');
    idUpdatePriceAdjustment = r.data('id');
    restaurantBrandUpdatePriceAdjustment = r.data('restaurant');
    changeUpdatePriceAdjustment = 0;
    saveUpdatePriceAdjustment = 0;
    cancelChangePriceAdjustment = 0;
    $('#select-food-update-price-adjustment').select2({
        dropdownParent: $('#modal-update-price-adjustment'),
    });

    shortcut.add('F4', function () {
        saveModalUpdatePriceAdjustment();
    });
    shortcut.add('ESC', function () {
        closeModalUpdatePriceAdjustment();
    });
    dataUpdatePriceAdjustment();
}

async function dataUpdatePriceAdjustment() {
    let method = 'get',
        url = 'price-adjustment-data.data-update',
        params = {id: idUpdatePriceAdjustment, restaurant_brand: restaurantBrandUpdatePriceAdjustment},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#select-food-update-price-adjustment'), $('#table-update-price-adjustment'), $('#info-update-price-adjustment')]);
    dataPrevUpdatePriceAdjustment = res.data[0]
    idEmployeeUpdatePriceAdjustment = res.data[0].employee_create.id
    $('#total-update-price-adjustment').text(res.data[0].number_food);
    $('#restaurant-branch-update-price-adjustment').text(res.data[0].restaurant_brand.name);
    $('#code-update-price-adjustment').text(res.data[0].code);
    $('#employee-update-price-adjustment').text(res.data[0].employee_create_name);
    $('#created-update-price-adjustment').text(res.data[0].created_at);
    $('#updated-update-price-adjustment').text(res.data[0].updated_at);
    $('#note-update-price-adjustment').val(res.data[0].note);
    $('#select-food-update-price-adjustment').html(res.data[2]);
    drawTableUpdatePriceAdjustment(res.data[1]);
}

async function drawTableUpdatePriceAdjustment(data) {
    let id = $('#table-update-price-adjustment'),
        column = [
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'original_price', name: 'original_price', className: 'text-right'},
            {data: 'difference', name: 'difference', className: 'text-right'},
            {data: 'price', name: 'price', className: 'text-center' , width: '15%'},
            {data: 'action', name: 'action', className: 'text-right', width: '5%'},
            {data: 'keysearch', name:'keysearch', className:'d-none'}
        ],
        scroll_Y = vh_of_table,
        fixedLeft = 0,
        fixedRight = 0;
    let option = [];
    tableUpdatePriceAdjustment = await DatatableTemplateNew(id, data.original.data, column, scroll_Y, fixedLeft, fixedRight,option);
}

async function selectFoodUpdatePriceAdjustment() {
    let x = 0;
    await tableUpdatePriceAdjustment.rows().every(function () {
        let row = $(this.node());
        if (row.find('td:eq(4)').find('button').data('id') === parseInt($('#select-food-update-price-adjustment').val())) {
            x = 1;
        }
    });
    if (x === 0) {
        addRowDatatableTemplate(tableUpdatePriceAdjustment, {
            'name': $('#select-food-update-price-adjustment').find(':selected').data('name'),
            'original_price': formatNumber($('#select-food-update-price-adjustment').find(':selected').data('price')),
            'difference': '<label data-value="0">' + 0 + '</label>',
            'price':    '<div class="input-group border-group validate-table-validate">\n' +
                '  <input style="font-size: 14px !important;" class="form-control adjustment text-center border-radius-6-px border-0 w-100" data-max="999999999" data-money="1" data-value="' + $('#select-food-update-price-adjustment').find(':selected').data('price') + '" value="' + formatNumber($('#select-food-update-price-adjustment').find(':selected').data('price')) + '" >\n' +
                '</div>',
            'action':   '<div class="btn-group btn-group-sm">' +
                            '<button type="button" class="tabledit-edit-button btn seemt-red seemt-btn-hover-red waves-effect waves-light" data-id="' + $('#select-food-update-price-adjustment').val() + '" data-name="' + $('#select-food-update-price-adjustment').find(':selected').data('name') + '" data-price="' + $('#select-food-update-price-adjustment').find(':selected').data('price') + '" onclick="deleteRowUpdate($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Xóa"><i class="fi-rr-trash"></i></button>' +
                        '</div>',
            'keysearch': $('#select-food-update-price-adjustment :selected').data('keysearch')
        });
    }
}

function deleteRowUpdate(r) {
    $('#select-food-update-price-adjustment').append('<option value="' + r.data('id') + '" data-name="' + r.data('name') + '" data-price="' + r.data('price') + '" data-keysearch="' + removeVietnameseString(r.data('name').toString()) + '">' + r.data('name') + '</option>');
    tableUpdatePriceAdjustment.row(r.parents('tr')).remove().draw(false);
}

async function saveModalUpdatePriceAdjustment() {
    if(!checkValidateSave($('#modal-update-price-adjustment'))) return false
    if (saveUpdatePriceAdjustment === 1) {
        return false;
    }
    let table = [];
    let checkChang = 0;
    await tableUpdatePriceAdjustment.rows().every(function () {
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
    if (tableUpdatePriceAdjustment.rows().count() === 0){
        let text = 'Vui lòng chọn món ăn cần thay đổi giá';
        WarningNotify(text);
        return false;
    }
    saveUpdatePriceAdjustment = 1;
    let note = $('#note-update-price-adjustment').val(),
        method = 'post',
        url = 'price-adjustment-data.update',
        params = null,
        data = {
            id: idUpdatePriceAdjustment,
            details: table,
            restaurant_brand_id: restaurantBrandUpdatePriceAdjustment,
            note: note,
        };
    if(checkNotUpdate(data)) {
        changeUpdatePriceAdjustment = 0;
        saveUpdatePriceAdjustment = 0;
        SuccessNotify($('#success-update-data-to-server').text());
        closeModalUpdatePriceAdjustment();
        return
    }
    let res = await axiosTemplate(method, url, params, data, [$('#loading-update-price-adjustment')]);
    changeUpdatePriceAdjustment = 0;
    saveUpdatePriceAdjustment = 0;
    switch (res.data.status ) {
        case 200:
            SuccessNotify($('#success-update-data-to-server').text());
            closeModalUpdatePriceAdjustment();
            thisUpdatePriceAdjustment.parents('tr').find('td:eq(3)').text(res.data.data.created_at);
            thisUpdatePriceAdjustment.parents('tr').find('td:eq(4)').text(res.data.data.updated_at);
            thisUpdatePriceAdjustment.parents('tr').find('td:eq(5)').text(res.data.data.number_food);
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            shortcut.add('F4', function () {
                saveModalUpdatePriceAdjustment();
            });
            ErrorNotify(text);
            break;
        default:
            ErrorNotify($('#error-post-data-to-server').text());

    }
}

function checkNotUpdate(newData) {
    let detailsNew = JSON.stringify(newData.details.reduce((res, cur) => {
        res += cur.food_id;
        res += cur.new_price;
        return res;
    }, ""));
    let detailsOld = JSON.stringify(dataPrevUpdatePriceAdjustment.details.reduce((res, cur) => {
        res += cur.food.id;
        res += cur.new_price;
        return res;
    }, ""));

    if (detailsOld === detailsNew
        && newData.id === dataPrevUpdatePriceAdjustment.id
        && newData.note === dataPrevUpdatePriceAdjustment.note
        && newData.restaurant_brand_id === dataPrevUpdatePriceAdjustment.restaurant_brand.id) {
        return true;
    }

    return false;
}

function cancelPriceAdjustment() {
    let title = 'Hủy phiếu điều chỉnh giá món ?',
        content = 'Phiếu sau khi hủy sẽ không thể chỉnh sửa !',
        icon = 'question';
    sweetAlertInputComponent(title,'input-sweet-alert-confirm-disable-order', content, icon).then(async (result) => {
        if (result.value) {
            if (cancelChangePriceAdjustment === 1) return false;
            cancelChangePriceAdjustment = 1;
            let note = result.value,
                method = 'post',
                restaurant_brand = restaurantBrandUpdatePriceAdjustment,
                id = idUpdatePriceAdjustment,
                url = 'price-adjustment-data.cancel',
                params = null,
                data = {restaurant_branch: restaurant_brand, id: id, cancel_reason: note};
            let res = await axiosTemplate(method, url, params, data, [$('#loading-update-price-adjustment')]);
            cancelChangePriceAdjustment = 0;
            if (res.status === 200) {
                let text = $('#success-cancel-data-to-server').text();
                SuccessNotify(text);
                drawCancelPriceAdjustmentData(res.data.data)
                closeModalUpdatePriceAdjustment();
            }
        }
    });
}

function drawCancelPriceAdjustmentData(data) {
    $('#total-record-waiting').text(formatNumber(removeformatNumber($('#total-record-waiting').text()) - 1));
    $('#total-record-cancel').text(formatNumber(removeformatNumber($('#total-record-cancel').text()) + 1));
    removeRowDatatableTemplate(dataTablePriceAdjustmentWaiting, thisUpdatePriceAdjustment, true);
    addRowDatatableTemplate(dataTablePriceAdjustmentCancel, {
        'code': data.code,
        'employee_create_name': data.employee_create_name,
        'created_at': data.created_at,
        'updated_at': data.updated_at,
        'number_food': data.number_food,
        'action': data.action,
        'keysearch': data.keysearch,
    });
}


function closeModalUpdatePriceAdjustment() {
    $('#modal-update-price-adjustment').modal('hide');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    resetModalUpdatePriceAdjustment();
}
function resetModalUpdatePriceAdjustment(){
    tableUpdatePriceAdjustment.clear().draw(false);
    $('#restaurant-branch-update-price-adjustment').text('---');
    $('#code-update-price-adjustment').text('---');
    $('#employee-update-price-adjustment').text('---');
    $('#created-update-price-adjustment').val(moment().format('DD/MM/YYYY'));
    $('#updated-update-price-adjustment').val(moment().format('DD/MM/YYYY'));
    $('#note-update-price-adjustment').val('');
}
