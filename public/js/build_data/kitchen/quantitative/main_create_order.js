$(document).on('input','#material-quantity input',function () {
    var value=removeformatNumber($(this).val());
    if (value < 0 ) {
        $(this).val(0.1).trigger('input');
        $(this).select();
        alertify.notify('Tối thiểu bằng 0.1 !', 'error', 5);
    }
    if ($(this).val() === '' || $(this).val() === '00') {
        $(this).val(0.1).trigger('input');
        $(this).select();
        alertify.notify('Tối thiểu bằng 0.1 !', 'error', 5);
    }
    if (value > 1000000) {
        $(this).val(1000000).trigger('input');
        $(this).select();
        alertify.notify('Không được nhập lớn hơn '+formatNumber(1000000)+'!', 'error', 5);
    }
})

$(document).on('focus', '#material-quantity input', function () {
    $(this).select();
})
//reset value | find code: #btn-clear-table
$('#btn-clear-table').on('click', function () {
    if ($('#table-detail-material tbody tr:first').hasClass('table-empty') && $('#table-food-detail tbody tr:first').hasClass('table-empty')) {
        ErrorNotify('Chưa có dữ liệu trong bảng !');
        return false;
    }
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-primary btn-sweet-alert',
            cancelButton: 'btn btn-grd-disabled btn-sweet-alert'
        },
        buttonsStyling: false
    })
    swalWithBootstrapButtons.fire({
        title: 'Hủy nhập định lượng món ăn?',
        text: 'Tất cả dữ liệu trên bảng sẽ được xóa',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Đồng ý',
        cancelButtonText: 'Hủy',
        reverseButtons: true
    }).then(async (result) => {
        if (result.value) {
            SuccessNotify('Xóa dữ liệu thành công !')
            if ($('#table-food-detail tbody tr').hasClass('table-empty') == false) {
                let id_food = $('#table-food-detail tbody tr').find('#food-code').data('value');
                let code_food = $('#table-food-detail tbody tr').find('#food-code').text();
                let name_food = $('#table-food-detail tbody tr').find('#food-name').text();
                let original_price_food = removeformatNumber($('#table-food-detail tbody tr').find('#food-price').text());
                await $('#select-food').append(optionFoodAppend(id_food, code_food, original_price_food, name_food));
            }
            $('#table-food-detail tbody tr').remove();
            $('#table-detail-material tbody tr').remove();
            if ($('#table-detail-material tbody tr').hasClass('table-empty') == false){
                $('#table-detail-material tbody').append(tRowNull());
            }
            if ($('#table-food-detail tbody tr').hasClass('table-empty') == false){
                $('#table-food-detail tbody').append(tRowNull());
            }
            $('#total-price-quantitative-data').text(0).trigger('input');
            $('#count-material').text(0).trigger('input');

            $('#select-material').find('option:not(:first)').remove();
        }
    })
})
//end reset value

//add quantitative | find code: #btn-save-table
$('#btn-save-table').on('click', function () {
    if ($('#table-detail-material tbody tr').hasClass('table-empty')) {
        ErrorNotify('Vui lòng chọn nguyên liệu !');
        return false;
    }
    if ($('#table-detail-food tbody tr').hasClass('table-empty')) {
        ErrorNotify('Vui lòng chọn món ăn !');
        return false;
    }
    var array = [];
    var foodid = $('#food-code').data('value');
    var branchid = $('#change_branch').find('option:checked').val();
    var table = $('#table-detail-material tbody tr');
    table.each(function () {
        var item = {};
        item.material_id = $(this).find('#material-code').data('value');
        item.quantity = removeformatNumber($(this).find('#material-quantity input').val());
        array.push(item);
    })
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-primary btn-sweet-alert',
            cancelButton: 'btn btn-grd-disabled btn-sweet-alert'
        },
        buttonsStyling: false
    })
    if($('#table-food-detail tbody tr').length != 0){
        $(this).prop('disabled',true);
        $(this).addClass('disabled');
        axios({
            method:'post',
            url:'/quantitative-data.create',
            data:{
                id:foodid,
                branch_id:branchid,
                material:array
            }
        }).then(async res=>{
            if ($.trim(res.data.status) == 200) {
                SuccessNotify('Thêm mới thành công');
                if($('#table-detail-material tbody tr').hasClass('table-empty') == false) {

                    await $('#table-detail-material tbody tr').each(function () {
                        let id_matertial = $(this).find('#material-code').data('value');
                        let code_matertial = $(this).find('#material-code').text();
                        let name_matertial = $(this).find('#material-name').text();
                        let price_matertial = $(this).find('#material-price').text();
                        let material_unit_value_matertial = $(this).find('#material-quantity input').val();
                        let material_unit_name_matertial = $(this).find('#material-unit').text();
                        $('#select-material').append(optionMaterialAppend(id_matertial, code_matertial, price_matertial, material_unit_value_matertial, material_unit_name_matertial, name_matertial));
                    });
                }
                if ($('#table-food-detail tbody tr').hasClass('table-empty') == false) {
                    let id_food = $('#table-food-detail tbody tr').find('#food-code').data('value');
                    let code_food = $('#table-food-detail tbody tr').find('#food-code').text();
                    let name_food = $('#table-food-detail tbody tr').find('#food-name').text();
                    let original_price_food = removeformatNumber($('#table-food-detail tbody tr').find('#food-price').text());
                    await $('#select-food').append(optionFoodAppend(id_food, code_food, original_price_food, name_food));
                }
                $('#table-food-detail tbody tr').remove();
                $('#table-detail-material tbody tr').remove();
                if ($('#table-detail-material tbody tr').hasClass('table-empty') == false){
                    $('#table-detail-material tbody').append(tRowNull());
                }
                if ($('#table-food-detail tbody tr').hasClass('table-empty') == false){
                    $('#table-food-detail tbody').append(tRowNull());
                }
                $(this).prop('disabled',false);
                $(this).removeClass('disabled');
                $('#total-price-quantitative-data').text(0).trigger('input')
                $('#count-material').text(0).trigger('input')
                $('#select-material').find('option:not(:first)').remove();
            } else {
                $(this).prop('disabled',false);
                $(this).removeClass('disabled');
                ErrorNotify(res.data.message)
            }
        })
    }
})
//end quantitative
