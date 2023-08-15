let idUpdateReasonsCancelFoodData, checkSaveUpdateReasonsCanCelFoodData = 0,contentDataUpdateReasonsCancelFoodData,thisUpdateReasonsCancelFoodData;

function openModalUpdateReasonsCancelFoodData(r) {
    $('#modal-update-reasons-cancel-food-data').modal('show');
    shortcut.remove("ESC");
    shortcut.add("ESC", function () {
        closeModalUpdateReasonsCancelFoodData();
    });
    shortcut.add("F4", function () {
        saveUpdateReasonsCancelFoodData();
    });
    thisUpdateReasonsCancelFoodData = r;
    idUpdateReasonsCancelFoodData = r.data('id')
    contentDataUpdateReasonsCancelFoodData = r.data('content');
    $('#content-update-reasons-cancel-food-data').val(contentDataUpdateReasonsCancelFoodData);
    $('#content-update-reasons-cancel-food-data').parents('.form-validate-textarea').find('.the-count span:first-child').text(r.data('content').length);
    countCharacterTextarea()
}

async function saveUpdateReasonsCancelFoodData() {
    if (checkSaveUpdateReasonsCanCelFoodData === 1) return false;
    if (!checkValidateSave($('#modal-update-reasons-cancel-food-data'))) return false;
    checkSaveUpdateReasonsCanCelFoodData = 1;
    let method = 'POST',
        url = 'reasons-cancel-food-data.update',
        restaurant_brand_id = $('#select-brand-reasons-cancel-food-data').val(),
        content = $('#content-update-reasons-cancel-food-data').val(),
        params = null,
        data = {
            id: idUpdateReasonsCancelFoodData,
            content: content,
            restaurant_brand_id: restaurant_brand_id
        };
    if(contentDataUpdateReasonsCancelFoodData == content) {
        SuccessNotify($('#success-update-data-to-server').text());
        checkSaveUpdateReasonsCanCelFoodData = 0;
        closeModalUpdateReasonsCancelFoodData();
        return false;
    }
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-update-reasons-cancel-food-data')]);
    checkSaveUpdateReasonsCanCelFoodData = 0;
    let text = '';
    switch(res.data.status) {
        case 200:
            text = $('#success-update-data-to-server').text();
            SuccessNotify(text);
            thisUpdateReasonsCancelFoodData.parents('tr').find('td:eq(1)').text(content);
            thisUpdateReasonsCancelFoodData.parents('tr').find('td:eq(2)').html(`<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-red seemt-btn-hover-red waves-effect waves-light" onclick="removeReasonsCancelFoodData($(this))" data-id="${res.data.data}" data-toggle="tooltip" data-placement="top" data-original-title="Xóa"><i class="fi-rr-trash"></i></button><button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateReasonsCancelFoodData($(this))" data-id="${res.data.data}" data-content="${content}" data-toggle="tooltip" data-placement="top" data-original-title="Chỉnh sửa"><i class="fi-rr-pencil"></i></button></div>`);
            thisUpdateReasonsCancelFoodData.parents('tr').find('td:eq(3)').html(combineKeySearch(content,res.data.data));
            closeModalUpdateReasonsCancelFoodData();
            break;
        case 400:
            text = 'Nội dung lý do hủy món đã tồn tại';
            WarningNotify(text);
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

function closeModalUpdateReasonsCancelFoodData() {
    shortcut.remove("F4");
    $('#modal-update-reasons-cancel-food-data').modal('hide');
    resetModalUpdateReasonsCancelFoodData();
    countCharacterTextarea()
}
function resetModalUpdateReasonsCancelFoodData(){
    $('#content-reasons-cancel-food-data').val('');
    $('#content-update-reasons-cancel-food-data').text('');
}

