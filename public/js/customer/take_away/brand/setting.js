let checkSaveSettingTakeAwayBrand = 0, brandId = -1;
async function dataSettingTakeAway() {
    await changeBrandAllShared();
    $('#modal-setting-take-away').modal('show');
    $('#check-setting-take-away').on('change', function () {
        if ($(this).is(':checked') === true) {
            $('#btn-save-setting-take-away').removeClass('d-none');
            shortcut.remove('F4');
        } else {
            $('#btn-save-setting-take-away').addClass('d-none');
            shortcut.add('F4', function () {
                saveModalSettingTakeAwayBrand();
            });
        }
    })
}

async function saveModalSettingTakeAwayBrand() {
    if(checkSaveSettingTakeAwayBrand === 1) return false;
    checkSaveSettingTakeAwayBrand = 1;
    let method = 'post',
        url = 'take-away-brand.setting',
        params = {
            brand: brandIdTakeAway ,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data,[$("#list-branch-take-away")]);
    checkSaveSettingTakeAwayBrand = 0;
    let text = '';
    switch(res.data.status) {
        case 200:
            text = $('#success-status-data-to-server').text();
            SuccessNotify(text);
            location.reload();
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
