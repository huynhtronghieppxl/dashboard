let idUpdateFoodBranchManage,
    statusUpdateFoodBranchManage,
    dataAdditionFoodUpdateFoodBranchManage = '',
    category_id_food_branch_manage = 0,
    thisRowDataFaceFoodBranchManage,
    list_branch_kitchen_food_branch_manage,
    openTypeFoodBranchManage = 0;
let idSelectedFoodBranchManage = [], checkSaveCreateFoodBranchManage = 0,
    typeUpdateFoodBranchManage;


async function openModalUpdateFoodBranchManage(r) {
    thisRowDataFaceFoodBranchManage = r;
    $('#modal-update-food-branch-manage').modal('show');
    let id = r.data('id');
    shortcut.remove('F2');
    shortcut.remove('F3');
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalUpdateFoodBranchManage();
    });
    $('#modal-update-food-branch-manage .js-example-basic-single').select2({
        dropdownParent: $('#modal-update-food-branch-manage')
    });
    $('.kitchen-update-food-manage').select2({
        dropdownParent: $('#modal-update-food-branch-manage')
    });
    $('#price-update-food-branch-manage').on('input change', function () {
        $('#point-update-food-branch-manage').text(formatNumber(parseFloat(removeformatNumber($(this).val())) / parseFloat($('#point-ratio-food-server').val())))
    });
    $('#input-picture-update-food-branch-manage').on('change', async function () {
        url_image = URL.createObjectURL($(this).prop('files')[0]);
        $('#picture-update-food-branch-manage').attr('src', URL.createObjectURL($(this).prop('files')[0]));
        let data = await uploadMediaTemplate($(this).prop('files')[0], 0);
        $('#picture-update-food-branch-manage').attr('data-url-avt', data.data[0]);
        $('#picture-update-food-branch-manage').attr('data-url-thumb', data.data[1]);
        $(this).replaceWith($(this).val('').clone(true));
    });
    $('#additional-update-food-branch-manage').on('select2:open', function () {
        if (dataAdditionFoodUpdateFoodBranchManage === '' && openTypeFoodBranchManage == 0) {
            foodOptionAddition();
            $('#additional-update-food-branch-manage').html(dataAdditionFoodUpdateFoodBranchManage);
        }
        if (openTypeFoodBranchManage == 0) {
            openTypeFoodBranchManage = 1;
            $('#additional-update-food-branch-manage').html(dataAdditionFoodUpdateFoodBranchManage);
        }
        for (let i = 0; i < idSelectedFoodBranchManage.length; i++) {
            $('#additional-update-food-branch-manage option[value=' + idSelectedFoodBranchManage[i] + ']').attr('selected', 'selected');
        }
    })
    dataUpdateFoodBranchManage(id);
}

async function dataUpdateFoodBranchManage(id) {
    let method = 'get',
        url = 'food-branch-manage.data-update',
        params = {
            id: id,
            branch: $('#change_branch').val(),
            type_load: $('#tabs-food-branch-manage li a.nav-link.active').data('index')
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#box-list-update-food-branch-manage'),
    ]);
    if (res.data[0].is_combo == 1) {
        $('.class-combo-update-food-manage').removeClass('d-none');
        typeUpdateFoodBranchManage = 2;
    } else if (res.data[0].is_addition == 1) {
        $('.class-addition-update-food-manage').removeClass('d-none');
        typeUpdateFoodBranchManage = 3;
    } else {
        $('.class-food-update-food-manage').removeClass('d-none');
        typeUpdateFoodBranchManage = 1;
    }
    $('#picture-update-food-branch-manage').attr('src', res.data[0].avatar)
    idUpdateFoodBranchManage = res.data[0].id;
    category_id_food_branch_manage = res.data[0].category_id;
    list_branch_kitchen_food_branch_manage = res.data[0].list_branch_kitchen;
    statusUpdateFoodBranchManage = res.data[0].status;
    $('#original-price-update-food-branch-manage').val(formatNumber(res.data[0].original_price));
    let material_food_food_branch_manage = res.data[0].material_food;
    $('#picture-update-food-branch-manage').attr('data-url-avt', res.data[0].avatar);
    $('#picture-update-food-branch-manage').attr('data-url-thumb', res.data[0]['avatar_thump']);
    $('#picture-update-food-branch-manage').attr('src', res.data[0]['avatar_link']);
    $('#name-update-food-branch-manage').text(res.data[0].name);
    $('#price-update-food-branch-manage').val(formatNumber(res.data[0].price));
    $('#point-update-food-branch-manage').text(res.data[0].point_to_purchase);
    $('#time-update-food-branch-manage').text(res.data[0].time_to_completed);
    $('#code-update-food-branch-manage').text(res.data[0].code);
    $('#print-update-food-branch-manage').prop('checked', res.data[0].is_allow_print);
    $('#sell-by-update-food-branch-manage').find('input').text(res.data[0].is_sell_by_weight);
    $('#sell-by-update-food-branch-manage').find('span').text(res.data[0].is_sell_by_weight_name);
    $('#review-update-food-branch-manage').text(res.data[0].is_allow_review);
    $('#party-update-food-branch-manage').text(res.data[0].is_allow_purchase_by_point);
    $('#unit-update-food-branch-manage').text(res.data[0].unit_type);
    $('#category-update-food-branch-manage').text(res.data[0].category_name);
    $('#combo-update-food-manage').text(res.data[0].type_food);
    $('#additional-update-food-manage').val(res.data[0].list_id_addition_food).change();
    $('#description-update-food-branch-manage').val(res.data[0].description);
    $('#update-table-food-create-food-manage tbody').html(res.data[8]);
    $('#additional-update-food-branch-manage').html(res.data[1]);
    $('#food-combo-combo-update-food-manage').html(res.data[4]);
    idSelectedFoodBranchManage = $('#additional-update-food-branch-manage').val();
    if (res.data[0].sale_online_status == 0) {
        $("#take-away-update-food-branch-manage input[type='radio'][value='0']").prop('checked', true);
    } else if (res.data[0].sale_online_status == 1) {
        $("#take-away-update-food-branch-manage input[type='radio'][value='1']").prop('checked', true);
    } else {
        $("#take-away-update-food-branch-manage input[type='radio'][value='2']").prop('checked', true);
    }

    if (material_food_food_branch_manage.length > 0) {
        $('#original-price-update-food-branch-manage').attr('disabled', true);
    } else {
        $('#original-price-update-food-branch-manage').removeAttr('disabled');
    }
}

function removeFoodDetailComboUpdateFoodManage(r) {
    let i = r.parentNode.parentNode.parentNode;
    let name = $(i).find('td:eq(0)').find('label').text(),
        id = $(i).find('td:eq(0)').find('input').val();
    $('#food-combo-combo-update-food-manage').append('<option value="' + id + '">' + name + '</option>');
    $('#table-food-combo-combo-update-food-manage tbody tr').eq(i.rowIndex - 1).remove();
}

function removeFoodUpdateFoodManage(r) {
    let i = r.parentNode.parentNode.parentNode;
    let title = 'Xoá món chi nhánh?',
        content = 'Bạn có muốn xoá món <b>' + $('#name-update-food-manage').val() + '</b> khỏi</br> chi nhánh <b>' + $(i).find('td:eq(0)').find('label').text() + '</b>',
        icon = 'warning';
    sweetAlert(title, content, icon).then((result) => {
        if (result.value) {
            let name = $(i).find('td:eq(0)').find('label').text(),
                id = $(i).find('td:eq(0)').find('input').val();
            $('#select-branch-id-by-brand-update').append('<option value="' + id + '">' + name + '</option>');
            $('#update-table-food-create-food-manage tbody tr').eq(i.rowIndex - 1).remove();
        }
    });

}

function sweetAlert(title, text, icon) {
    let confirm = $('#button-btn-confirm-component').text();
    let cancel = $('#button-btn-cancel-component').text();
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-primary btn-sweet-alert',
            cancelButton: 'btn btn-grd-disabled btn-sweet-alert'
        },
        buttonsStyling: false
    });
    return swalWithBootstrapButtons.fire({
        title: title,
        html: text,
        icon: icon,
        showCancelButton: true,
        confirmButtonText: confirm,
        cancelButtonText: cancel,
        reverseButtons: true,
        focusConfirm: true
    })
}


function removeFoodUpdateFoodManageCombo(r) {
    let i = r.parentNode.parentNode.parentNode;
    let title = 'Xoá món chi nhánh?',
        content = 'Bạn có muốn xoá món <b>' + $('#name-combo-update-food-manage').val() + '</b> khỏi</br> chi nhánh <b>' + $(i).find('td:eq(0)').find('label').text() + '</b>',
        icon = 'warning';
    sweetAlert(title, content, icon).then((result) => {
        if (result.value) {
            let name = $(i).find('td:eq(0)').find('label').text(),
                id = $(i).find('td:eq(0)').find('input').val();
            $('#select-branch-id-by-branch-update-combo').append('<option value="' + id + '">' + name + '</option>');
            $('#update-table-food-create-combo-food-manage tbody tr').eq(i.rowIndex - 1).remove();
        }
    });
}

async function saveModalUpdateFoodManage() {
    if(checkSaveCreateFoodBranchManage != 0 ) return false;
    if (!checkValidateSave($('#modal-update-food-branch-manage'))) return false;
    let x = String(thisRowDataFaceFoodBranchManage.parents('td').data('dt-row')).slice(-2);
    let restaurant_brand_id = $('.select-brand').val(),
        food_category_id = category_id_food_branch_manage,
        price = removeformatNumber($('#price-update-food-branch-manage').val()),
        point_to_purchase = ($('#point-update-food-branch-manage').text()),
        sale_online_status = $('#take-away-update-food-branch-manage').find('input[type="radio"]:checked').val(),
        original_price = ($('#original-price-update-food-branch-manage').val()),
        is_addition = 0,
        is_combo = 0,
        food_material_type = 0,
        food_in_combo = [];

    ($('#party-update-food-branch-manage').is(':checked') === true) ? is_allow_purchase_by_point = 1 : is_allow_purchase_by_point = 0;
    ($('#print-update-food-branch-manage').is(':checked') === true) ? is_allow_print = 1 : is_allow_print = 0;

    switch (typeUpdateFoodBranchManage) {
        case 2:
            is_combo = 1;
            food_addition_ids = [];
            $('#table-food-combo-combo-update-food-manage tbody tr').each(function (row, tr) {
                food_in_combo[row] = {
                    "id": $(tr).find('td:eq(0)').find('input').val(),
                    "quantity": $(tr).find('td:eq(1)').find('input').val(),
                };
            });
            break;
        case 3:
            is_addition = 1;
            food_addition_ids = [];
            break;
    }
    let method = 'post',
        url = 'food-branch-manage.update',
        params = null,
        data = {
            id: idUpdateFoodBranchManage,
            branch_id: $('#change_branch').val(),
            restaurant_brand_id: restaurant_brand_id,
            price: removeformatNumber(price),
            original_price: removeformatNumber(original_price),
            point_to_purchase: removeformatNumber(point_to_purchase),
            sale_online_status: sale_online_status,
        };
    checkSaveCreateFoodBranchManage = 1;
    let res = await axiosTemplate(method, url, params, data, [
        $('#box-list-update-food-branch-manage'),
    ]);
    checkSaveCreateFoodBranchManage = 0;
    switch (res.data.status){
        case 200:
            SuccessNotify($('#success-update-data-to-server').text());
            let x = String(thisRowDataFaceFoodBranchManage.parents('td').data('dt-row')).slice(-2);
            thisRowDataFaceFoodBranchManage.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody').find('tbody tr:eq(' + x + ')').find('td:eq(5)').text(formatNumber(res.data.data.original_price));
            thisRowDataFaceFoodBranchManage.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody').find('tbody tr:eq(' + x + ')').find('td:eq(6)').text(formatNumber(res.data.data.price));
            thisRowDataFaceFoodBranchManage.parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody').find('tbody tr:eq(' + x + ')').find('td:eq(7)').text(res.data.data.temporary_price);
            loadData();
            closeModalUpdateFoodBranchManage();
            break;
        case 500:
            (res.data.message !== null) ? ErrorNotify(res.data.message) : ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            (res.data.message !== null) ? WarningNotify(res.data.message) : WarningNotify($('#error-post-data-to-server').text());
    }
}


async function dataBranchUpdate() {
    let method = 'get',
        url = 'food-manage.get-list-branch',
        restaurant_brand_id = $('.select-brand').val(),
        params = {restaurant_brand_id: restaurant_brand_id},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    await $('#select-branch-id-by-brand-update-combo').html(res.data);
}


async function foodOptionAddition(id) {

    let restaurant_brand_id = $('.select-brand').val(),
        branch_id = $('change_branch').val();
    let method = 'get',
        url = 'food-brand-manage.option-food-addition',
        params = {
            id: id,
            restaurant_brand_id: restaurant_brand_id,
            branch_id: branch_id,

        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    dataAdditionFoodUpdateFoodBranchManage = res.data[0];
    $('#additional-update-food-branch-manage').html(dataAdditionFoodUpdateFoodBranchManage);
    $("#additional-update-food-branch-manage").select2('close');
    $("#additional-update-food-branch-manage").select2('open');

}


function closeModalUpdateFoodBranchManage() {
    $('#modal-update-food-branch-manage').modal('hide');
    shortcut.add('F2', function () {
        openModalCreateFoodManage();
    });
    $('#label-status-update').html('')
    $('#description-update-food-brand-manage').val('');
    $('#name-update-food-manage').val('');
    $('#price-update-food-manage').val('');
    $('#point-update-food-manage').text('');
    $('#time-update-food-manage').val('');
    $('#code-update-food-manage').val('');
    $('#cook-update-food-manage').val('');
    $('#print-update-food-manage').val('');
    $('#point-method-update-food-manage').val('');
    $('#sell-by-update-food-brand-manage').val('');
    $('#review-update-food-manage').val('');
    $('#party-update-food-manage').val('');
    $('#take-away-update-food-manage').val('');
    openTypeFoodBranchManage = 0;
    $('#additional-update-food-manage').val('');
    $('#unit-update-food-brand-manage').val('');
    $('#modal-update-food-manage input[name="format"]:checked').prop('checked', false);
    $('#table-food-combo-combo-update-food-manage tbody').empty();
    $('#check-additional-update-food-manage').addClass('d-none');
    $('#div-food-combo-update-food-manage').addClass('d-none');
    $("#additional-update-food-brand-manage").val('');
    removeAllValidate();
    countCharacterTextarea()
}
