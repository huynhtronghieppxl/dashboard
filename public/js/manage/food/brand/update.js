let idUpdateFoodManage, statusUpdateFoodManage, category_type_id, list_branch_kitchen,
    material_food, typeUpdateFoodBrandManage, thisRowDataFaceFoodBrandManage,
    openTypeFoodBrandManage = 0, tableFoodInComboFoodBrandManage,
    dataFoodNoteUpdateFoodBrandManage = '',
    nameFoodUpdateManage, codeFoodUpdateManage, unitFoodUpdateManage,
    categoryFoodUpdateManage, avatarFoodUpdateManage, avatarThumpFoodUpdateManage,
    avatarLinkFoodUpdateManage, descriptionFoodUpdateManage, sellByFoodUpdateManage,
    originalPriceFoodUpdateManage, priceFoodUpdateManage, timeFoodUpdateManage, isLikeUpdateFoodManage,
    cookFoodUpdateManage, reviewFoodUpdateManage, takeAwayFoodUpdateManage, foodListAdditionFoodUpdateManage,
    printFoodUpdateManage, printLakeFoodUpdateManage, vatFoodUpdateManage, pointFoodUpdateManage,
    foodNoteFoodUpdateManage = [], dataTableInComboUpdateFoodBrandManage, noteFoods;
let idSelectedFoodBrandManage = [], id_update_food_brand_manage, status_update_food_brand_manage,
    temporaryPriceFromDate, temporaryPriceToDate, dataUpdateImageUpload, printStampFoodUpdateManage, profitUpdateFoodManage;

$(function () {
    $('#print-tem-update-food-brand-manage, #print-lake-update-food-brand-manage').css('cursor', 'no-drop');

    $('#sell-by-update-food-brand-manage input[name=by]').on('click', function () {
        if ($('#sell-by-update-food-brand-manage input[name=by]:checked').val() == 1) {
            $('#print-lake-update-food-brand-manage-div').removeClass('d-none')
        } else {
            $('#print-lake-update-food-brand-manage-div').addClass('d-none')
        }
    })

    $($('#print-kitchen-update-food-brand-manage')).on('change', function () {
        if ($(this).is(':checked')) {
            $('#print-tem-update-food-brand-manage-div, #print-lake-update-food-brand-manage-div').removeClass('disabled')
            $('#print-tem-update-food-brand-manage, #print-lake-update-food-brand-manage').prop('disabled', false);
            $('#print-tem-update-food-brand-manage, #print-lake-update-food-brand-manage').css('cursor', 'pointer');
            $('#print-tem-update-food-brand-manage, #print-lake-update-food-brand-manage').removeClass('disabled')
        } else {
            $('#print-tem-update-food-brand-manage-div, #print-lake-update-food-brand-manage-div').addClass('disabled')
            $('#print-tem-update-food-brand-manage, #print-lake-update-food-brand-manage').prop('disabled', true);
            $('#print-tem-update-food-brand-manage, #print-lake-update-food-brand-manage').css('cursor', 'no-drop');
            $('#print-tem-update-food-brand-manage, #print-lake-update-food-brand-manage').prop('checked', false);
        }

    })
})

async function LoadDataVatSetupFoodBrandManage() {
    let brand = $('.select-brand').val(),
        url = 'food-brand-manage.data',
        method = 'get',
        params = {brand: brand},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    dataFoodConfigVatFoodBrandManage = res.data[7];
}

async function loadDataUpdateFoodBrandManage(){
    let brand = $('.select-brand').val(),
        url = 'food-brand-manage.data-update',
        method = 'get',
        params = {
            brand: brand
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    dataUnitFoodBrandManage = res.data[0];
    dataCategoryFoodBrandManage = res.data[1];
    dataVatFoodBrandManage = res.data[2];
    dataFoodNoteFoodBrandManage = res.data[3];
    dataCategoryComboFoodBrandManage = res.data[5];
}


async function openModalUpdateFoodManage(r) {
    thisRowDataFaceFoodBrandManage = r;
    id_update_food_brand_manage = r.data('id');
    temporaryPriceFromDate = r.data('from');
    temporaryPriceToDate = r.data('to');
    let id = r.attr('data-id');
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('ESC', function () {
        closeModalUpdateFoodBrandManage();
    });
    shortcut.add('F4', function () {
        saveModalFoodUpdateFoodManage();
    });
    $('#title-update-info-food-addition-brand-manage').text('Thông tin món bán kèm')
    $('#check-additional-update-food-brand-manage').addClass('d-none');
    $('#check-col-node-food-addition-update-food-brand-manage').addClass('col-lg-12');
    $('#check-col-node-food-addition-update-food-brand-manage').removeClass('col-lg-6');
    let type_category = $('#tabs-food-data .nav-link.active').data('category-type');
    switch (type_category) {
        case 1:
            $('#check-title-food-update-food-brand-manage').text('Chỉnh sửa món ăn')
            $('#title-update-info-food-brand-manage').text('Thông tin món ăn')
            break;
        case 2:
             $('#check-title-food-update-food-brand-manage').text('Chỉnh sửa nước uống')
            $('#title-update-info-food-brand-manage').text('Thông tin nước uống')
            break;
        case 3:
             $('#check-title-food-update-food-brand-manage').text('Chỉnh sửa món ăn khác')
            $('#title-update-info-food-brand-manage').text('Thông tin món ăn khác')
            break;
    }
    $('#modal-update-food-brand-manage .js-example-basic-single, .kitchen-update-food-manage').select2({
        dropdownParent: $('#modal-update-food-brand-manage')
    });
    $('#modal-update-food-brand-manage .js-example-basic-single').on('select2:close', function () {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalUpdateFoodBrandManage();
        });
    })
    switch (thisRowDataFaceFoodBrandManage.data('type-food')) {
        case 0:
            openModalUpdateFoodBrandManage();
            break;
        case 1:
            openModalComboUpdateFoodManage();
            break;
        case 2:
            openModalAdditionUpdateFoodManage()
            break;
    }
    $('#unit-update-food-brand-manage').html(dataUnitFoodBrandManage);
    $('#vat-update-food-brand-manage').html(dataVatFoodBrandManage);
    $('#note-update-food-brand-manage').html(dataFoodNoteFoodBrandManage);
    $('#category-update-food-brand-manage').html(dataCategoryFoodBrandManage);
    $('#note-addition-update-food-brand-manage').html(dataFoodNoteFoodBrandManage);

    $('#select-food-in-combo-update-food-brand-manage').unbind('select2:select').on('select2:select', function () {
        let is_by_weight = $(this).find(':selected').data('weight') === 1 ? 'data-float="1"' : 'data-number="1"';
        addRowDatatableTemplate(tableFoodInComboFoodBrandManage, {
            'name': '<label>' + $(this).find(':selected').text() + '</label><input value="' + $(this).find(':selected').val() + '" class="d-none"/>',
            'quantity': '<div class="input-group border-group validate-table-validate">' +
                '<input data-value="1" ' + is_by_weight + ' value="1" data-min="1" data-max="50" data-float="1" class="form-control text-center quantity-food-combo-update border-0 w-100"/>' +
                '</div>',
            'original_price': '<label>' + formatNumber($(this).find(':selected').data('original-price')) + '</label>',
            'total_price': '<label>' + formatNumber($(this).find(':selected').data('original-price')) + '</label>',
            'action': '<div class="btn-group btn-group-sm text-center">' +
                '    <button class="tabledit-delete-button btn seemt-btn-hover-red waves-effect waves-light" onclick="removeFoodDetailComboUpdateFoodManage($(this))"><i class="fi-rr-trash"></i></button>' +
                '</div> '
        });

        $('#select-food-in-combo-update-food-brand-manage').find(':selected').remove();
        $('#select-food-in-combo-update-food-brand-manage').val('').trigger('change.select2');
        sumOriginalPriceUpdate();
    });
    $(document).on('input', 'table#table-food-combo-combo-update-food-manage tbody tr td:eq(1) input', function () {
        if (removeformatNumber($(this).val()) < 1) {
            $(this).val(1);
            $(this).select();
            alertify.notify('Tối thiểu bằng 1 !', 'error', 5);
        }
        if (removeformatNumber($(this).val()) > 1000000) {
            $(this).val('1,000,000');
            $(this).select();
            alertify.notify('Tối đa bằng 1,000,000 !', 'error', 5);
        }
        $(this).attr('data-value', removeformatNumber($(this).val()));
    });

    $('#input-picture-update-food-brand-manage').unbind('change').on('change', async function (v) {
        url_image = URL.createObjectURL($(this).prop('files')[0]);
        dataUpdateImageUpload = $(this).prop('files')[0];
        switch ((dataUpdateImageUpload.type).slice(6)) {
            case 'png':
                break;
            case 'jpeg':
                break;
            case 'jpg':
                break;
            case 'webp':
                break;
            default:
                WarningNotify('Bạn chỉ được chọn đuôi ảnh là JPEG, JPG, PNG, WEBP!');
                return false;
        }
        if (dataUpdateImageUpload.size <= (5 * 1024 * 1024)) {
            $('#picture-update-food-brand-manage').attr('src', URL.createObjectURL($(this).prop('files')[0]));
            checkSaveUpdateFoodBrandManage = 1
            let data = await uploadMediaTemplate($(this).prop('files')[0], 0);
            checkSaveUpdateFoodBrandManage = 0
            urlAvatarFood = data.data[0]
            $('#picture-update-food-brand-manage').attr('data-url-avt', data.data[0]);
            $('#picture-update-food-brand-manage').attr('data-url-thumb', data.data[1]);
            $(this).replaceWith($(this).val('').clone(true));
        } else {
            WarningNotify('Ảnh vượt quá kích thước 5MB !');
        }

    });
    $('#category-update-food-brand-manage').on('select2:select', async function () {
        $('#additional-update-food-brand-manage').html(await foodOptionAdditionUpdate($(this).val()));
    })

}


async function dataFoodDetail(id) {
    let type_load;
    type_load = window.location.pathname === '/food-data' ? $('#tabs-food-data li a.nav-link.active').data('index') : $('#tabs-food-brand-manage li a.nav-link.active').data('index')
    let method = 'get',
        url = 'food-brand-manage.data-food-update',
        restaurant_brand_id = $('.select-brand').val(),
        params = {
            id: id,
            restaurant_brand_id: restaurant_brand_id,
            type_load: type_load
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#tab-info-update-food-manager'),
        $('#loading-modal-update-addition-food-brand-manage'),
        $('#loading-modal-update-combo-food-brand-manage')]);
    status_update_food_brand_manage = res.data[0].status
    foodNoteFoodUpdateManage = [];
    for (let i = 0; i < res.data[0].food_notes.length; i++) {
        foodNoteFoodUpdateManage.push(res.data[0].food_notes[i].id)
    }
    avatarFoodUpdateManage = res.data[0].avatar
    avatarThumpFoodUpdateManage = res.data[0]['avatar_thump']
    avatarLinkFoodUpdateManage = res.data[0]['avatar_link']
    nameFoodUpdateManage = res.data[0].name
    codeFoodUpdateManage = res.data[0].code
    descriptionFoodUpdateManage = res.data[0].description
    foodListAdditionFoodUpdateManage = res.data[0]['list_addtion']
    unitFoodUpdateManage = res.data[0].unit_type
    categoryFoodUpdateManage = res.data[0].category_id
    sellByFoodUpdateManage = res.data[0].is_sell_by_weight
    originalPriceFoodUpdateManage = res.data[0].original_price
    priceFoodUpdateManage = res.data[0].price
    pointFoodUpdateManage = res.data[0].point_to_purchase
    timeFoodUpdateManage = res.data[0].time_to_completed
    cookFoodUpdateManage = res.data[0].is_bbq
    reviewFoodUpdateManage = res.data[0].is_allow_review
    takeAwayFoodUpdateManage = res.data[0].sale_online_status
    printFoodUpdateManage = res.data[0].is_allow_print
    printLakeFoodUpdateManage = res.data[0].is_allow_print_fishbowl
    printStampFoodUpdateManage = res.data[0].is_allow_print_stamp
    vatFoodUpdateManage = res.data[0]['restaurant_vat_config_id']
    dataTableInComboUpdateFoodBrandManage = res
    idUpdateFoodManage = res.data[0].id;
    category_type_id = res.data[0].category_type_id;
    list_branch_kitchen = res.data[0].list_branch_kitchen;
    statusUpdateFoodManage = res.data[0].status;
    isLikeUpdateFoodManage = res.data[0].is_addition_like_food;
    material_food = res.data[0].material_food;
    profitUpdateFoodManage=res.data[0].profit_rate_by_price;
    $('#update-table-food-update-food-manage tbody').html(res.data[8]);
    $('#select-food-in-combo-update-food-brand-manage').html(res.data[4]);
    idSelectedFoodBrandManage = $('#additional-update-food-brand-manage').val();
    switch (res.data[0].category_type_id) {
        case 1:
        case 4:
            $('.div-review-update-food-brand-manage').removeClass('d-none');
            break;
        case 2:
        case 3:
            $('.div-review-update-food-brand-manage').addClass('d-none');
            break;
    }
}


// Danh sách móm bán kèm
async function foodOptionAdditionUpdate(type) {
    let restaurant_brand_id = $('.select-brand').val(),
        branch_id = $('change_branch').val();
    let method = 'get',
        url = 'food-brand-manage.option-food-addition',
        params = {
            restaurant_brand_id: restaurant_brand_id,
            branch_id: branch_id,
            id: $('#additional-create-food-brand-manage').val(),
            category_type_id: type,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#category-update-food-brand-manage'),
        $('#category-update-combo-food-brand-manage'),
        $('#category-update-addition-food-brand-manage'),]);
    dataAdditionFoodCreateFoodManage = res.data[0];
    return res.data[0];
}

async function sumOriginalPriceUpdate() {
    let total = 0;
    await tableFoodInComboFoodBrandManage.rows().every(function () {
        let row = $(this.node());
        total += Number(removeformatNumber(row.find('td:eq(3)').text()));
    })
    $('#original-update-food-combo-brand-manage').val(formatNumber(total));
    let original = removeformatNumber($('#original-update-food-combo-brand-manage').val());
    let price = removeformatNumber($('#price-update-combo-brand-manage').val());
    $('#profit-update-combo-food-brand-manage').val(formatNumber(Number(price) - Number(original)));
    $('#profit-margin-update-combo-food-brand-manage').text(formatNumber((((price - original) / price) * 100).toFixed(2).replace('.00', '')) + "%");
}


async function dataTableComboUpdateFoodBrandManage(data) {
    let id = $('#table-food-in-combo-update-food-brand-manage'),
        column = [
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'original_price', name: 'original_price', className: 'text-center'},
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'total_price', name: 'total_price', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ],
        fixed_left = 0,
        fixed_right = 0;
    tableFoodInComboFoodBrandManage = await DatatableTemplateNew(id, data.data[3].original.data, column, '20vh', fixed_left, fixed_right);
}

function removeFoodDetailComboUpdateFoodManage(r) {
    let name = $(r).parents('tr').find('td:eq(0)').find('label').text(),
        id = $(r).parents('tr').find('td:eq(0)').find('input').val(),
        price = r.parents('tr').find('td:eq(1)').find('label').text();
    $('#select-food-in-combo-update-food-brand-manage').append('<option data-original-price="' + removeformatNumber(price) + '" value="' + id + '">' + name + '</option>');
    removeRowDatatableTemplate(tableFoodInComboFoodBrandManage, r, false);
    sumOriginalPriceUpdate();
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
            $('#update-table-food-update-food-manage tbody tr').eq(i.rowIndex - 1).remove();
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
        icon = 'question';
    sweetAlert(title, content, icon).then((result) => {
        if (result.value) {
            let name = $(i).find('td:eq(0)').find('label').text(),
                id = $(i).find('td:eq(0)').find('input').val();
            $('#select-branch-id-by-brand-update-combo').append('<option value="' + id + '">' + name + '</option>');
            $('#update-table-food-update-combo-food-manage tbody tr').eq(i.rowIndex - 1).remove();
        }
    });
}

// Danh sách món ăn
async function foodNoteUpdate() {
    let method = 'get',
        url = 'food-brand-manage.food-note',
        brand = $('.select-brand').val(),
        params = {
            brand: brand
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    dataFoodNoteUpdateFoodBrandManage = res.data[0];
    $('#note-update-food-brand-manage').html(dataFoodNoteUpdateFoodBrandManage);
    $('#note-addition-update-food-brand-manage').html(dataFoodNoteUpdateFoodBrandManage);
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

function drawTableUpdateCategoryFoodManage(data) {
    let category_id = data.category_type_id,
        table = '';
    if (data.is_combo == 1) {
        $('#total-record-combo').text(formatNumber(Number($('#total-record-combo').text()) + 1));
        $('#tab-food-combo-data-5').click();
        table = dataTableFoodComboFoodBrandManage;
    } else if (data.is_addition == 1) {
        $('#total-record-addition').text(formatNumber(Number($('#total-record-addition').text()) + 1));
        $('#tab-food-addition-data-7').click();
        table = dataTableFoodAdditionFoodBrandManage;
    } else {
        switch (category_id) {
            case 1:
                $('#total-record-food').text(formatNumber(Number($('#total-record-food').text()) + 1));
                $('#tab-food-data-1').click();
                table = dataTableFoodFoodBrandManage;
                break;
            case 2:
                $('#total-record-drink').text(formatNumber(Number($('#total-record-drink').text()) + 1));
                $('#tab-food-drink-data-2').click();
                table = dataTableFoodDrinkFoodBrandManage;
                break;
            case 3:
                $('#total-record-other').text(formatNumber(Number($('#total-record-other').text()) + 1));
                $('#tab-food-other-data-4').click();
                table = dataTableFoodOtherFoodBrandManage;
                break;
            case 4:
                $('#total-record-sea-food').text(formatNumber(Number($('#total-record-sea-food').text()) + 1));
                $('#tab-food-sea-data-3').click();
                table = dataTableFoodSeaFoodBrandManage;
                break;
        }
    }
    addRowDatatableTemplate(table, {
        'avatar': '<img src="' + url_image + '" class="img-data-table">',
        'name': data.name,
        'unit_type': data.unit_type,
        'category_name': data.category_name,
        'price': formatNumber(data.price),
        'point_to_purchase': data.point_to_purchase,
        'action': data.action,
    });
}




