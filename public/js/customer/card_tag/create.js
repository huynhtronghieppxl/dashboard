let checkSaveCreateCardTag;

$(function () {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('F2', function () {
        openModalCreateCardTag();
    });

    $('#card-tag-color').on('click',function(e) {
        $('#loading-modal-create-card-tag').css('height','300px');
    })

    $('#card-tag-color').on('blur',function(e) {
        $('#loading-modal-create-card-tag').css('height','auto');
    })

})

function openModalCreateCardTag() {
    $('#modal-create-card-tag').modal('show');
    shortcut.remove('ESC');
    shortcut.add('ESC', function (){
        closeModalCreateCardTag();
    })
    shortcut.add('F4', function (){
        saveModalCreateCardTag();
    })
    shortcut.remove('F2');
    $('#name-create-card-tag').on('input',function (){
        if ($(this).val() !== ''){
            $('#reload-create-card-tag').removeClass('d-none')
        } else {
            $('#reload-create-card-tag').addClass('d-none')
        }
    })
    $('#card-tag-color').on('input', function (){
        $('#card-tag-color-validate').val($('#card-tag-color').val());
        if($('#card-tag-color-validate').val() != '') {
            $('.card-tag-color-validate-group').css('border-color', 'transparent');
            $('.text-danger').text('');
        }
        if ($(this).val() !== '#ffa223'){
            $('#reload-create-card-tag').removeClass('d-none')
        } else {
            $('#reload-create-card-tag').addClass('d-none')
        }
    })
}

async function saveModalCreateCardTag(){
    if($('#card-tag-color-validate').val() == '') {
        $('.card-tag-color-validate-group').css('border-color', '#fe5d70');
    }
    if (!checkValidateSave($('#modal-create-card-tag'))) return false;
    if (checkSaveCreateCardTag === 1) return false;
    let name = $('#name-create-card-tag').val(),
        color_hex_code = $('#card-tag-color').val();
    let method = 'post',
        url = 'card-tag.create',
        params = null,
        data = {
            name: name,
            color_hex_code: color_hex_code,
        };
    checkSaveCreateCardTag = 1;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-create-card-tag')]);
    checkSaveCreateCardTag = 0;
    if (res.data.status === 200) {
        SuccessNotify($('#success-create-data-to-server').text());
        closeModalCreateCardTag();
        addRowDatatableTemplate(tableEnableCardTag, {
            'name': res.data.data.name,
            'color': res.data.data.color_hex_code,
            'quantity': (res.data.data.customers).length,
            'action': res.data.data.action,
            'keysearch': res.data.data.keysearch,
        });
        $('#total-record-card-tag-enable').text(Number(formatNumber($('#total-record-card-tag-enable').text())) + 1);
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        WarningNotify(text);
        return false;
    }
}

function reloadModalCreateCardTag(){
    $('#name-create-card-tag').val('');
    $('#card-tag-color').val('#ffa223');
    $('#card-tag-color').parents().find('span').find('span').attr('style', 'background-color: #ffa223');
    $('#reload-create-card-tag').addClass('d-none');
}

function closeModalCreateCardTag(){
    $('#modal-create-card-tag').modal('hide');
    reloadModalCreateCardTag()

    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('F2', function () {
        openModalCreateCardTag();
    });
}
