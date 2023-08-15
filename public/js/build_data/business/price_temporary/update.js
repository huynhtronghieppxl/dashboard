let saveUpdatePriceTemporary = 0,
    foodDataUpdatePriceTemporary = null,
    tableListFoodPriceTemporary,
    originalFoodDataUpdatePriceTemporary = null;

$(function (){
    $('#price-temporary-food').parent().on('click', function (){
        if(tableListFoodPriceTemporary.rows().count() == 0){
            WarningNotify('Hãy chọn món ăn trước khi nhập giá!');
            return false;
        }
    })
    $('#percent-temporary-food').parent().on('click', function (){
        if(tableListFoodPriceTemporary.rows().count() == 0){
            WarningNotify('Hãy chọn món ăn trước khi nhập phần trăm!');
            return false;
        }
    })
    $(document).on('change','.radio-update-price-temporary input',function (){
        $('#price-temporary-food').val(0)
        if($(this).data('type') === 1){
            $('#select-update-price-temporary select').prop('disabled',false);
            $('#select-update-price-temporary').find('span').children().children().not('.select2-selection__rendered').removeClass('disabled');
            $('#percent-temporary-food').removeClass('d-none');
            calculateTotalPrice();
            if($('#select-format-update-temporary-price :selected').val()==='2'){
                calculateTotalPercent();
            }
            $('#price-temporary-food').attr('data-max',999999999)
        }else {
            $('#select-update-price-temporary select').val(1).trigger('change.select2');
            $('#select-update-price-temporary select').prop('disabled',true);
            $('#select-update-price-temporary').find('span').children().children().not('.select2-selection__rendered').addClass('disabled');
                    $('#price-temporary-food').parent().removeClass('d-none');
                    $('#percent-temporary-food').parent().parent().addClass('d-none');
                    removeErrorInput($('#percent-temporary-food'));
            if($('#select-format-update-temporary-price :selected').val()==='2'){
                 calculateTotalPercent();
            }
            calculateTotalPrice();
        }
    })

    $(document).on('input','#price-temporary-food',function (){
        calculateTotalPrice();
    })
    $(document).on('input','#percent-temporary-food',function (){
        calculateTotalPercent();
    })
    $(document).on('focus','#loading-create-payment-bill',function (){
        removeErrorInput($('#date-out-price-temporary'));
    })
    $(document).on('change','#select-format-update-temporary-price',function (){
        if($('#select-format-update-temporary-price').val()==1){
            $('#price-temporary-food').val(0)
            calculateTotalPrice()
        }
        else{
            $('#percent-temporary-food').val(0)
            calculateTotalPercent();
        }
    })
    $('#select-format-update-temporary-price').change(function () {
        if ($(this).val() === '1') {
            $('#price-temporary-food').parent().removeClass('d-none');
            $('#percent-temporary-food').parent().parent().addClass('d-none');
            removeErrorInput($('#percent-temporary-food'));
        } else {
            $('#price-temporary-food').parent().addClass('d-none');
            $('#percent-temporary-food').parent().parent().removeClass('d-none');
            removeErrorInput($('#price-temporary-food'));
        }
    })
    $('#select-food-update-price-temporary').on('select2:select', async function () {
        let check = 0;
        let id = $(this).val();
        await $('#table-food-update-price-temporary tr').each(function (i, v) {
            if (id === $(v).find('td:eq(2)').find('input').val()) {
                $('#select-food-update-price-temporary').val($('#select-food-update-price-temporary option:first').val()).trigger('change');
                WarningNotify(`Món [${$(v).find('td:eq(2)').find('label').text()}] đã được chọn !`);
                check = 1;
                return false;
            }
        });
        if (check === 0) {
            addRowDatatableTemplate(tableListFoodPriceTemporary, {
                'avatar' : '<img style="margin-right: 0 !important;" onerror="imageDefaultOnLoadError($(this))" src="' + $(this).find(':selected').data('avatar') + '" class="img-inline-name-data-table"/>',
                'name' : '<label>' + $(this).find(':selected').data('name') + '</label><input value="' + $(this).find(':selected').val() + '" data-select="' + $(this).find(':selected').data('select') + '" class="d-none "/>',
                'price_not_temporary' : '<label class="price">' + $(this).find(':selected').data('price-format') + '</label><input value="' + $(this).find(':selected').data('price') + '" class="d-none price-input"/>',
                'new_price' : '<label class="new_price" >0</label>',
                'action' : '<div class="btn-group-sm"><button data-placement="top" data-toggle="tooltip" data-original-title="Xóa" class="tabledit-delete-button btn seemt-red seemt-btn-hover-red  waves-effect waves-light" onclick="removeFoodUpdatePriceTemporary($(this))"><i class="fi-rr-trash"></i> </button></div>',
                'keysearch': removeVietnameseStringLowerCase($(this).find(':selected').data('name').toString())
            })
            tableListFoodPriceTemporary.draw(false)
            $('#select-food-update-price-temporary').find(':selected').remove();
            $('#select-food-update-price-temporary').val('').trigger('change.select2');
            calculateTotalPrice();
        }
        if(tableListFoodPriceTemporary.rows().count() > 0){
            $('#price-temporary-food').removeClass('disabled');
            $('#price-temporary-food').prop('disabled', false);
        }else{
            $('#price-temporary-food').addClass('disabled');
            $('#price-temporary-food').prop('disabled', true);
        }
    });

    $('#select-category-food-update-price-temporary').on('select2:selecting', function () {
        let select_val = $('#select-food-update-price-temporary').html();
        switch ($(this).val()) {
            case '-1':
                foodDataUpdatePriceTemporary.all = select_val;
                break;
            case '1':
                foodDataUpdatePriceTemporary.food_opt = select_val;
                break;
            case '2':
                foodDataUpdatePriceTemporary.drink_opt = select_val;
                break;
            case '3':
                foodDataUpdatePriceTemporary.other_opt = select_val;
                break;
            case '4':
                foodDataUpdatePriceTemporary.sea_food_opt = select_val;
                break;
            case '5':
                foodDataUpdatePriceTemporary.gift_opt = select_val;
                break;
        }
    });

    $('#select-category-food-update-price-temporary').on('select2:select', function () {
        switch ($(this).find('option:selected').val()) {
            case '-1':
                $('#select-food-update-price-temporary').html(foodDataUpdatePriceTemporary.all);
                break;
            case '1':
                $('#select-food-update-price-temporary').html(foodDataUpdatePriceTemporary.food_opt);
                break;
            case '2':
                $('#select-food-update-price-temporary').html(foodDataUpdatePriceTemporary.drink_opt);
                break;
            case '3':
                $('#select-food-update-price-temporary').html(foodDataUpdatePriceTemporary.other_opt);
                break;
            case '4':
                $('#select-food-update-price-temporary').html(foodDataUpdatePriceTemporary.sea_food_opt);
                break;
        }
    });

    $('#date-in-price-temporary, #date-out-price-temporary').on('dp.change', function () {
        removeErrorInput($('#date-out-price-temporary'));
    })
    $('#loading-create-payment-bill select').on('change', function () {
        $('#modal-update-price-temporary .btn-renew').removeClass('d-none')
    })
    $('#loading-create-payment-bill input').on('keyup', function () {
        $('#modal-update-price-temporary .btn-renew').removeClass('d-none')
    })
    $('#date-in-price-temporary').on('dp.change', function () {
        $('#modal-update-price-temporary .btn-renew').removeClass('d-none')
    })
    $('#date-out-price-temporary').on('dp.change', function () {
        $('#modal-update-price-temporary .btn-renew').removeClass('d-none')
    })
})
async function openModalUpdatePriceTemporary() {
    saveUpdatePriceTemporary = 0;
    $('#loading-create-payment-bill .btn-renew').addClass('d-none');
    $('#modal-update-price-temporary').modal('show');
    shortcut.add('F4', function () {
        saveModalUpdatePriceTemporary();
    });
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalUpdatePriceTemporary();
    });
    dateTimePickerNotWillFromToDate($('#date-in-price-temporary'), $('#date-out-price-temporary'));
    dateTimePickerHourMinuteTemplate($('#check-in-update-time-price-temporary'));
    dateTimePickerHourMinuteTemplate($('#check-out-update-time-price-temporary'));
    $('#select-category-food-update-price-temporary, #select-food-update-price-temporary,#select-format-update-temporary-price').select2({
        dropdownParent: $('#modal-update-price-temporary'),
    });

    $('#price-temporary-food').parent().removeClass('d-none');

    if (isStatus === 0) {
        $('#btn-off-table-price').prop('disabled', true);
        $('#btn-off-table-price').addClass('d-none');
        $('#status-price-temporary').html('<label class="label label-md label-danger mb-0">Không hoạt động</label>');
        $('#price-temporary-food').val();
    } else {
        $('#btn-off-table-price').prop('disabled', false);
        $('#btn-off-table-price').removeClass('d-none');
        $('#status-price-temporary').html('<label class="label label-md label-success mb-0">Đang hoạt động</label>');
    }
    tableFoodPriceTemporary([]);
    loadDataFood();
}

 async function calculateTotalPrice(){
     if ($('.radio-update-price-temporary input:checked').data('type') === 1) {
         let totalPrice = 0, new_price = 0;
         tableListFoodPriceTemporary.rows().every(function () {
             let x = $(this.node());
             new_price = removeformatNumber(x.find('td:eq(3)').text());
             totalPrice = removeformatNumber($('#price-temporary-food').val()) + new_price;
             x.find('td:eq(4)').text(formatNumber(totalPrice));
         })
     } else {
         Array.prototype.min = function() {
             return Math.min.apply(null, this);
         };
         let totalPrice = 0, new_price = 0, values = [];
         await tableListFoodPriceTemporary.rows().every(function () {
             let x = $(this.node());
             new_price = removeformatNumber(x.find('td:eq(3)').text());
             values.push(new_price);
             totalPrice = new_price - removeformatNumber($('#price-temporary-food').val()) ;
             x.find('td:eq(4)').text(formatNumber(totalPrice));
         })
         $('#price-temporary-food').attr('data-max', values.min())
     }
 }

 function calculateTotalPercent(){
     if ($('.radio-update-price-temporary input:checked').data('type') === 1) {
         let totalPercent = 0,new_price =0,percent_price = 0;
         tableListFoodPriceTemporary.rows().every(function () {
             let x = $(this.node());
             new_price = removeformatNumber(x.find('td:eq(3)').text());
             percent_price = new_price * removeformatNumber($('#percent-temporary-food').val())/100;
             totalPercent = percent_price + new_price;
             x.find('td:eq(4)').text(formatNumber(totalPercent));
         })
     } else {
         let totalPercent = 0,new_price =0;
         tableListFoodPriceTemporary.rows().every(function () {
             let x = $(this.node());
             new_price = removeformatNumber(x.find('td:eq(3)').text());
             totalPercent = (removeformatNumber($('#percent-temporary-food').val()) * new_price) - new_price;
             x.find('td:eq(4)').text(formatNumber(totalPercent));
         })
     }
 }

async function tableFoodPriceTemporary(data){
    let id1 = $('#table-food-update-price-temporary'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'avatar', name: 'avatar', className: 'text-center'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'price_not_temporary', name: 'price_not_temporary', className: 'text-right'},
            {data: 'new_price', name: 'new_price', className: 'text-right'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},

        ],
        scroll_Y = vh_of_table,
        fixedLeft = 0,
        fixedRight = 0;
    tableListFoodPriceTemporary = await DatatableTemplateNew(id1, data, column, scroll_Y, fixedLeft, fixedRight);

    $(document).on('input paste keyup','#table-food-update-price-temporary_filter input', async function (){
        let index = 1;
        await tableListFoodPriceTemporary.rows({'search':'applied'}).every(function (){
            let row = $(this.node())
            row.find('td:eq(0)').text(index)
            index++;
        })
    })
}

async function removeFoodUpdatePriceTemporary(r) {
    let select_type = await $('#select-category-food-update-price-temporary').find('option:selected').val(),
        select = r.parents('.odd').find('input').data('select'),
        price_format = r.parents('.odd').find('td:eq(3) label').text(),
        price = r.parents('.odd').find('td:eq(3) input').val(),
        avatar = r.parents('.odd').find('img').attr('src'),
        name = r.parents('.odd').find('td:eq(2) label').text(),
        id = r.parents('.odd').find('td:eq(2) input').val();

    let opt = '<option value="' + id + '" data-avatar="' + avatar + '" data-name="' + name + '" data-price="' + price + '" data-price-format="' + price_format + '"  data-select="' + select + '">' + name + '</option>';
    if (select == select_type) {
        $('#select-food-update-price-temporary').append(opt);
    } else {
        switch (select) {
            case -1:
                foodDataUpdatePriceTemporary.all = foodDataUpdatePriceTemporary.all + opt;
                break;
            case 1:
                foodDataUpdatePriceTemporary.food_opt = foodDataUpdatePriceTemporary.food_opt + opt;
                break;
            case 2:
                foodDataUpdatePriceTemporary.drink_opt = foodDataUpdatePriceTemporary.drink_opt + opt;
                break;
            case 3:
                foodDataUpdatePriceTemporary.other_opt = foodDataUpdatePriceTemporary.other_opt + opt;
                break;
            case 4:
                foodDataUpdatePriceTemporary.sea_food_opt = foodDataUpdatePriceTemporary.sea_food_opt + opt;
                break;
            case 5:
                foodDataUpdatePriceTemporary.gift_opt = foodDataUpdatePriceTemporary.gift_opt + opt;
                break;
        }
    }
    removeRowDatatableTemplate(tableListFoodPriceTemporary, r , true);
}

async function loadDataFood() {
    let method = 'get',
        url = 'price-temporary.data',
        restaurant_brand_id = $('#select-brand-price-temporary').val(),
        params = {restaurant_brand_id: restaurant_brand_id},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#select-category-food-update-price-temporary'), $('#select-food-update-price-temporary')]);
    if (res.data[4] !== '' || res.data[5] !== '') {
    }
    $('#price-temporary-food').val(res.data[6]);
    if (res.data[3] == '0') {
        $('#select-format-update-temporary-price').val('1').trigger('change.select2');
        $('#price-temporary-food').parent().parent().removeClass('d-none');
        $('#percent-temporary-food').parent().parent().addClass('d-none');
        $('#price-temporary-food').val(res.data[3]);
    } else {
        $('#select-format-update-temporary-price').val('2').trigger('change.select2');
        $('#price-temporary-food').parent().parent().addClass('d-none');
        $('#percent-temporary-food').parent().parent().removeClass('d-none');
        $('#percent-temporary-food').val(res.data[3]);
    }

    if (res.data[7] === 1) {
        $('#select-food-update-price-temporary').html(res.data[8]);
    } else {
        foodDataUpdatePriceTemporary = await res.data[8];
        originalFoodDataUpdatePriceTemporary = await res.data[1];
        switch ($('#select-category-food-update-price-temporary').val()) {
            case '-1':
                $('#select-food-update-price-temporary').html(res.data[8].all);
                break;
            case '1':
                $('#select-food-update-price-temporary').html(res.data[8].food_opt);
                break;
            case '2':
                $('#select-food-update-price-temporary').html(res.data[8].drink_opt);
                break;
            case '3':
                $('#select-food-update-price-temporary').html(res.data[8].food_opt);
                break;
            case '4':
                $('#select-food-update-price-temporary').html(res.data[8].sea_food_opt);
                break;
        }
    }
}

async function saveModalUpdatePriceTemporary() {
    if (saveUpdatePriceTemporary === 1) return false;
    if (!checkValidateSave($('#modal-update-price-temporary'))) return false;
    if (tableListFoodPriceTemporary.rows().count() === 0) {
        WarningNotify('Vui lòng chọn món ăn!');
        return false;
    }
    let percent = $('#percent-temporary-food').val(),
        price = 0,
        date_in = $('#date-in-price-temporary').val() + ' ' + $('#check-in-update-time-price-temporary').val(),
        date_out = $('#date-out-price-temporary').val() + ' ' + $('#check-out-update-time-price-temporary').val(),
        restaurant_brand_id = $('#select-brand-price-temporary').val(),
        TableData = [];
    if(new Date(date_in) > new Date(date_out)) {
        addErrorInput($('#check-out-update-time-price-temporary'), 'Ngày và giờ kết thúc phải lớn hơn ngày và giờ bắt đầu');
        return false;
    }
    if($('.radio-update-price-temporary input:checked').data('type') === 2){
        price = removeformatNumber('-' + '' +$('#price-temporary-food').val())
    }else {
        price = removeformatNumber($('#price-temporary-food').val())
    }
    tableListFoodPriceTemporary.rows().every(function (){
        let row = $(this.node());
        let temporary_price, temporary_percent;
        if ($('#select-format-update-temporary-price').val() === '2') {
            temporary_price = 0;
            temporary_percent = percent;
        } else {
            temporary_price = price;
            temporary_percent = 0;
        }
        TableData.push({
            "food_id": parseInt(row.find('td:eq(2)').find('input').val()),
            "temporary_price": temporary_price,
            "temporary_percent": temporary_percent,
        });
    })
    saveUpdatePriceTemporary = 1;
    let method = 'post',
        url = 'price-temporary.update',
        params = null,
        data = {
            date_in: date_in,
            date_out: date_out,
            restaurant_brand_id: restaurant_brand_id,
            status: 1,
            food: TableData,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-create-payment-bill')]);
    saveUpdatePriceTemporary = 0;
    let text = '';
    switch (res.data.status) {
        case 200:
            text = 'Cập nhật thành công !';
            SuccessNotify(text);
            loadData();
            closeModalUpdatePriceTemporary();
        break;
        case 500:
            ErrorNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
        break;
            default:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            WarningNotify(text);
    }
}

function closeModalUpdatePriceTemporary() {
    $('#modal-update-price-temporary').modal('hide');
    resetModalUpdatePriceTemporary();
}

function resetModalUpdatePriceTemporary() {
    tableListFoodPriceTemporary.clear().draw(false);
    $('#date-in-price-temporary').val(moment().format('DD/MM/YYYY'));
    $('#date-out-price-temporary').val(moment().format('DD/MM/YYYY'));
    $('#check-in-update-time-price-temporary').val(moment().format('HH:mm'));
    $('#check-out-update-time-price-temporary').val(moment().format('HH:mm'));
    $('#percent-temporary-food').val('1');
    $('#price-temporary-food').val('0');
    $('#select-category-food-update-price-temporary').val($('#select-category-food-update-price-temporary option:first').val()).trigger('change.select2');
    $('#select-format-update-temporary-price').val($('#select-format-update-temporary-price option:first').val()).trigger('change.select2');
    $('#price-temporary-food').parent().removeClass('d-none');
    $('#percent-temporary-food').parent().parent().addClass('d-none');
    removeAllValidate();
    $('input[type="search"]').val('');
    loadDataFood();
    $('#modal-update-price-temporary .btn-renew').addClass('d-none');
    $('#price-temporary-food').attr('data-max',999999999)
    $('.radio-update-price-temporary input[value="1"]').prop('checked', true)
    $('#select-update-price-temporary select').prop('disabled',false);
    $('#price-temporary-food').addClass('disabled')
    $('#price-temporary-food').prop('disabled', true)
}
