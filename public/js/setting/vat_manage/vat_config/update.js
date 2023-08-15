let idVatUpdateSetting, thisUpdateVATConfigData, checkSaveUpdateVATConfigData = 0;
$(function () {
    $('#name-update-vat-setting').on('input paste', function () {
        $(this).val($(this).val().replace(/[`\\\#,@!|\^=?;$~._'":*?<>{}]/g, ''));
    })
})

function openModalUpdateVATConfig(r) {
    idVatUpdateSetting = r.data('id');
    thisUpdateVATConfigData = r;
    $('#modal-update-food-vat-setting').modal('show');
    shortcut.add('F4', function () {
        saveModalUpdateVatSetting();
    });
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalUpdateVatSetting();
    });
    dataUpdateVatSetting(r);
}

function dataUpdateVatSetting(r) {
    $('#name-update-vat-setting').val(r.parents('tr').find('td:eq(1)').text())
    $('#percent-update-vat-setting').val(r.parents('tr').find('td:eq(2)').text().replace('%', ''))
}

async function saveModalUpdateVatSetting() {
    if (checkSaveUpdateVATConfigData === 1) {
        return false;
    }
    if (!checkValidateSave($('#modal-update-food-vat-setting'))) return false;
    let method = 'post',
        url = 'vat-setting.update',
        params = {
            id: idVatUpdateSetting,
            name: $('#name-update-vat-setting').val(),
            percent: $('#percent-update-vat-setting').val()
        },
        data = null,
        vat_config_name = thisUpdateVATConfigData.parents('tr').find('td:eq(1)').text(),
        percent = thisUpdateVATConfigData.parents('tr').find('td:eq(2)').text().replace('%', '');

    if (vat_config_name == $('#name-update-vat-setting').val()
        && percent == $('#percent-update-vat-setting').val()) {
        SuccessNotify($('#success-update-data-to-server').text());
        closeModalUpdateVatSetting()
        return;
    }

    checkSaveUpdateVATConfigData = 1
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-update-food-vat-setting')]);
    checkSaveUpdateVATConfigData = 0;
    switch (res.data.status) {
        case 200:
            SuccessNotify($('#success-update-data-to-server').text());
            closeModalUpdateVatSetting()
            thisUpdateVATConfigData.parents('tr').find('td:eq(1)').text(res.data.data.vat_config_name);
            thisUpdateVATConfigData.parents('tr').find('td:eq(2)').text(res.data.data.percent);
            thisUpdateVATConfigData.parents('tr').find('td:eq(3)').html(res.data.data.detail_food);
            thisUpdateVATConfigData.parents('tr').find('td:eq(4)').text(res.data.data.keysearch);
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify(res.data.message);
    }
}


function closeModalUpdateVatSetting() {
    $('#modal-update-food-vat-setting').modal('hide');
    $('#name-update-vat-setting').val()
    $('#percent-update-vat-setting').val(0)
    shortcut.remove('F4');
    shortcut.remove('ESC');
}
