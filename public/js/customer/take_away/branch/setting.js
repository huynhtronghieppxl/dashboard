let checkSaveSettingAway = 0;
async function dataSettingTakeAway() {
    addLoading('take-away.setting', '#loading-modal-setting-take-away');
    await changeBrandAllShared();
    $('#modal-setting-take-away').modal('show');
    $('#check-setting-take-away').on('change', function () {
        if ($(this).is(':checked') === true) {
            $('#btn-save-setting-take-away').removeClass('d-none');
            shortcut.remove('F4');
        } else {
            $('#btn-save-setting-take-away').addClass('d-none');
            shortcut.add('F4', function () {
                saveModalSettingTakeAway();
            });
        }
    })
}

async function saveModalSettingTakeAway() {
    if(checkSaveSettingAway === 1 ) return false;
    checkSaveSettingAway = 1;
    let method = 'post',
        url = 'take-away-branch.setting',
        params = null,
        data = {
            branch: $('.select-branch').val(),
            is_have_take_away :  isHaveTakeAway
        };
    let res = await axiosTemplate(method, url, params, data,[$("#list-branch-take-away")]);
    checkSaveSettingAway = 0;
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
