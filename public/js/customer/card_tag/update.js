let checkSaveUpdateCardTag,idCardTag, thisCardTagUpdate, oldUpdateCardTagData;
function openModalUpdateCardTag(r) {
    idCardTag = r.data('id');
    thisCardTagUpdate = r;
    $('#modal-update-card-tag').modal('show');
    shortcut.remove('ESC');
    shortcut.add('ESC', function (){
        closeModalUpdateCardTag();
    })
    shortcut.add('F4', function (){
        saveModalUpdateCardTag();
    })
    dataUpdateCardTag();

    $('#card-tag-color-update').on('click',function(e) {
        $('#loading-modal-update-card-tag').css('height','300px');
    })

    $('#card-tag-color-update').on('blur',function(e) {
        $('#loading-modal-update-card-tag').css('height','auto');
    })

    $('#card-tag-color-update').on('input', function (){
        $('#card-tag-color-update-validate').val($('#card-tag-color-update').val());
        if($('#card-tag-color-update-validate').val() != '') {
            $('.card-tag-color-update-validate-group').css('border-color', 'transparent');
            $('.text-danger').text('');
        }
    })
}

async function dataUpdateCardTag(){
    let method = 'get',
        url = 'card-tag.data-update',
        params = {
            id: idCardTag,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-update-card-tag')]);
    oldUpdateCardTagData = res.data.data;
    $('#name-update-card-tag').val(res.data.data.name);
    $('#card-tag-color-update').val(res.data.data.color_hex_code);
    $('#card-tag-color-update').parent().find('span').find('span').attr('style', 'background-color:' + res.data.data.color_hex_code);
}

async function saveModalUpdateCardTag(r){
    if($('#card-tag-color-update-validate').val() == '') {
        $('.card-tag-color-update-validate-group').css('border-color', '#fe5d70');
    }
    if (!checkValidateSave($('#modal-update-card-tag'))) return false;
    if (checkSaveUpdateCardTag === 1) return false;
    let name = $('#name-update-card-tag').val(),
        color_hex_code = $('#card-tag-color-update').val();
    let method = 'post',
        url = 'card-tag.update',
        params = null,
        data = {
            id: idCardTag,
            name: name,
            color_hex_code: color_hex_code,
        },
        successNotify = $('#success-update-data-to-server').text();

    if (data.name == oldUpdateCardTagData.name
        && data.color_hex_code == oldUpdateCardTagData.color_hex_code) {
        SuccessNotify(successNotify);
        closeModalUpdateCardTag();
        return;
    }

    checkSaveUpdateCardTag = 1;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-update-card-tag')]);
    checkSaveUpdateCardTag = 0;
    if (res.data.status === 200) {
        SuccessNotify(successNotify);
        closeModalUpdateCardTag();
        thisCardTagUpdate.parents('tr').find('td:eq(2)').html(res.data.data.color_hex_code)
        thisCardTagUpdate.parents('tr').find('td:eq(1)').html(res.data.data.name)
        thisCardTagUpdate.parents('tr').find('td:eq(3)').html(res.data.data.quantity)
        thisCardTagUpdate.parents('tr').find('td:eq(4)').html(res.data.data.action)
        thisCardTagUpdate.parents('tr').find('td:eq(5)').html(res.data.data.keysearch)
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        WarningNotify(text);
        return false;
    }
}

function closeModalUpdateCardTag(){
    $('#modal-update-card-tag').modal('hide');
    reloadModalUpdateCardTag()
    shortcut.remove('ESC')
    shortcut.remove('F4')
}
function reloadModalUpdateCardTag(){
    $('#name-update-card-tag').val('');
    $('#card-tag-color-update').val('#ffa223');
    $('#card-tag-color-update').parent().find('span').find('span').attr('style', 'background-color: #ffa223');
}
