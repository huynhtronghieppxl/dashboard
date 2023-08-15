let checkSaveUploadImageFoodManage = 0, quantityFoodUploadImage;

$(function (){
    $('#div-upload-logo-create-food-brand-restaurant').on('click', function () {
        $('#upload-logo-create-food-brand-restaurant').click();
    });
    $('#upload-logo-create-food-brand-restaurant').on('change', function () {
        let length = Number($(this).prop('files').length) + Number($('.item-upload-logo-create-food-brand-restaurant').length);
        if(length > quantityFoodUploadImage){
            WarningNotify('Bạn chỉ có ' + quantityFoodUploadImage + ' món ăn nên chỉ chọn được tối đa ' + quantityFoodUploadImage + ' ảnh !');
            return false;
        }
        jQuery.each($(this).prop('files'), async function (i, v) {
            switch((v.type).slice(6)) {
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
            if ($(v)[0].size <= (5 * 1024 * 1024)) {
                let data = await uploadMediaTemplate($(v)[0], 0);
                let code = updateSelectCodeFood();
                $('#data-upload-logo-create-food-brand-restaurant').append(`<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 item-upload-logo-create-food-brand-restaurant select2_theme pb-4 d-flex flex-column">
                                                                                      <div class="item-box item-box-food">
                                                                                             <div class="over-photo-food">
                                                                                                <a href="javascript:void(0)" class="float-right"><i class="fa fa-times remove-item-upload-logo-create-food-brand-restaurant" data-toggle="tooltip" data-placement="top" data-original-title="Xoá"></i></a>
                                                                                             </div>
                                                                                                <a class="strip" href="${URL.createObjectURL($(v)[0])}" target="_blank" data-strip-group="mygroup"
                                                                                                   data-strip-group-options="loop: false">
                                                                                                    <img src="${URL.createObjectURL($(v)[0])}" alt="" data-src="${data.data[0]}" data-thumb="${data.data[1]}" style="height: 9rem !important;">
                                                                                                </a>
                                                                                                <span class="text-warning"></span>
                                                                                      </div>
                                                                                      <div class="form-group select2_theme m-0 w-100" id="id-combo-create-food-manage">
                                                                                           <div class="form-validate-select">
                                                                                                <div class="select-material-box">
                                                                                                    <select class="js-example-basic-single" data-select="1" data-selected="1">
                                                                                                         <option value="-1"  disabled selected hidden>--- Vui lòng chọn ---</option>${code}
                                                                                                    </select>
                                                                                                    <div class="line"></div>
                                                                                                </div>
                                                                                           </div>
                                                                                      </div>
                                                                                 </div>`);
                $('#modal-upload-image-multi-file-food-manage .js-example-basic-single').select2({
                    dropdownParent: $('#modal-upload-image-multi-file-food-manage'),
                });
                updateSelectCodeFood();
            } else {
                WarningNotify('Ảnh ' + $(v)[0].name + ' vượt quá kích thước 5MB !');
            }
        });
    });
    $(document).on('click', '.remove-item-upload-logo-create-food-brand-restaurant', function () {
        $(this).parents('.item-upload-logo-create-food-brand-restaurant').remove();
        updateSelectCodeFood();
    });
    $(document).on('select2:select', '.item-upload-logo-create-food-brand-restaurant select', function () {
        updateSelectCodeFood();
    });
})

async function openModalUploadImageFoodManage() {
    $('#modal-upload-image-multi-file-food-manage').modal('show');
    await foodBuildData();
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalUploadImgFoodManage()();
    });
    shortcut.add('F4', function () {
        saveUploadImg();
    })
    checkSaveUploadImageFoodManage = 0;
    quantityFoodUploadImage = Number($('#tabs-food-data li').find('a.active .label').text());
}

function updateSelectCodeFood() {
    let code = [];
    $('#data-upload-logo-create-food-brand-restaurant select').each(function (i, v) {
        code.push($(v).val());
    });
    let newCode = dataCodeUploadLogoFood.filter(o1 => !code.some(o2 => o1.code === o2));
    let selectCode = '';
    jQuery.each(newCode, function (i, v) {
        if(categoryTypeId == v.category_type && isCombo == v.is_combo && isSpecialGift == v.is_special_gift && isAddition == v.is_addition && v.status == 1){
            selectCode += '<option value="' + v.code + '" data-category-type = "' + v.category_type + '">' + v.name + '</option>';
        }
    });
    $('#data-upload-logo-create-food-brand-restaurant').find('select option:not(:selected)').remove();
    $('#data-upload-logo-create-food-brand-restaurant').find('select').append(selectCode);
    return selectCode;
}

async function saveUploadImg() {
    if (!checkValidateSave($('#data-upload-logo-create-food-brand-restaurant'))) return false;
    if (checkSaveUploadImageFoodManage === 1) return false;
    let list_img = [];
    $('#data-upload-logo-create-food-brand-restaurant .item-upload-logo-create-food-brand-restaurant').each(function () {
        list_img.push({
            code: $(this).find('select').val(),
            avatar: $(this).find('img').data('src'),
            avatar_thumb: $(this).find('img').data('thumb')
        })
    });
    checkSaveUploadImageFoodManage = 1;
    let method = 'post',
        url = 'food-brand-manage.update-images',
        params = null,
        data = {image: list_img, brand: $('.select-brand').val()};
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-update-image-food-brand-manage')
    ]);
    checkSaveUploadImageFoodManage = 0;
    switch (res.data.status){
        case 200:
            let text = 'Cập nhật ảnh thành công';
            SuccessNotify(text);
            loadData();
            closeModalUploadImgFoodManage();
            break;
        case 500:
            (res.data.message !== null) ? ErrorNotify(res.data.message) : ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            (res.data.message !== null) ? WarningNotify(res.data.message) : WarningNotify($('#error-post-data-to-server').text());
    }
}

function closeModalUploadImgFoodManage() {
    $('#modal-upload-image-multi-file-food-manage').modal('hide');
    shortcut.remove('F4');
    $('.item-upload-logo-create-food-brand-restaurant').remove();
    $('#upload-logo-create-food-brand-restaurant').replaceWith($('#upload-logo-create-food-brand-restaurant').val('').clone(true));
}
