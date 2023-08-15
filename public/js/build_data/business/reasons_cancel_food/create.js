let checkSaveCreateReasonsCanCelFoodData = 0;

function openModalCreateReasonsCancelFoodData() {
    $('#modal-create-reasons-cancel-food-data').modal('show');
    shortcut.remove("ESC");
    shortcut.remove("F2");
    shortcut.add("ESC", function () {
        closeModalCreateReasonsCancelFoodData();
    });
    shortcut.add("F4", function () {
        saveCreateReasonsCancelFoodData();
    });
    $('#modal-create-reasons-cancel-food-data textarea').on('input', function (){
        $('#modal-create-reasons-cancel-food-data .btn-renew').removeClass('d-none')
    });
    $('#content-create-reasons-cancel-food-data').on('input paste keyup keydown', function () {
        if ($(this).val().length > 50) {
            $(this).val($(this).val().slice(0, 50));
        }
    });
}

async function saveCreateReasonsCancelFoodData() {
    if (checkSaveCreateReasonsCanCelFoodData === 1) return false;
    if (!checkValidateSave($('#modal-create-reasons-cancel-food-data'))) return false;
    checkSaveCreateReasonsCanCelFoodData = 1;
    let method = 'POST',
        url = 'reasons-cancel-food-data.create',
        restaurant_brand_id = $('#select-brand-reasons-cancel-food-data').val(),
        content = $('#content-create-reasons-cancel-food-data').val(),
        params = null,
        data = {
            content: content,
            restaurant_brand_id: restaurant_brand_id
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-create-reasons-cancel-food-data')]);
    checkSaveCreateReasonsCanCelFoodData = 0;
    let text = ''
    switch (res.data.status) {
        case 200:
            text = $('#success-create-data-to-server').text();
            SuccessNotify(text);
            addRowDatatableTemplate(tableReasonsCancelFoodData, {
                'content': content,
                'action': `<div class="btn-group btn-group-sm">
                        <button type="button" class="tabledit-edit-button btn seemt-red seemt-btn-hover-red waves-effect waves-light" onclick="removeReasonsCancelFoodData($(this))" data-id="${res.data.data}" data-toggle="tooltip" data-placement="top" data-original-title="Xóa"><i class="fi-rr-trash"></i></button>
                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateReasonsCancelFoodData($(this))" data-id="${res.data.data}" data-content="${content}" data-toggle="tooltip" data-placement="top" data-original-title="Chỉnh sửa"><i class="fi-rr-pencil"></i></button>
                    </div>`,
                'keysearch': combineKeySearch(content,res.data.data),
            });
            closeModalCreateReasonsCancelFoodData();
            break;
        case 400:
            text = 'Nội dung lý do hủy món đã tồn tại';
            WarningNotify(text);
            break;
            case 500:
            text = $('#error-post-data-to-server').text();
            if(res.data.message !== null){
                text = res.data.message;
            }
            ErrorNotify(text);
            break;
        default:
            text = $('#error-post-data-to-server').text();
            if(res.data.message !== null){
                text = res.data.message;
            }
            WarningNotify(text);
    }
}

function closeModalCreateReasonsCancelFoodData() {
    $('#modal-create-reasons-cancel-food-data').modal('hide');
    shortcut.remove("ESC");
    shortcut.remove("F4");
    shortcut.add("F2", function () {
        openModalCreateReasonsCancelFoodData();
    });
    resetModalCreateReasonsCancelFoodData();
    countCharacterTextarea()
}

function resetModalCreateReasonsCancelFoodData() {
    removeAllValidate();
    $('#content-reasons-cancel-food-data').val('');
    $('#content-create-reasons-cancel-food-data').val('');
    $('#modal-create-reasons-cancel-food-data .btn-renew').addClass('d-none')
}
function removeDiacritics(str) {
    return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "").replace(/đ/g, 'd').replace(/Đ/g, 'D');
}

function combineKeySearch(content, id) {
    const formattedContent = removeDiacritics(content.replace(/\s+/g, '').toLowerCase());
    return `${id}${formattedContent}`;
}
