let checkChangeStatusOfflineSetting = 0,tabIndexSettingOffline = 0;
$(function (){
    loadData();
})

async function loadData(){
    if (getCookieShared('offline-setting-user-id-' + idSession)) {
        let data = JSON.parse(getCookieShared('offline-setting-user-id-' + idSession));
        tabIndexSettingOffline = data.tab;
    }
    let method = 'get',
        url = 'offline-setting.list-branch',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data,[
        $("#table-enable-online-branch-data"),
        $("#table-disable-offline-branch-data"),
    ]);
    $('.nav-link').on('click',function (){
        tabIndexSettingOffline = $(this).attr('data-type');
        updateCookieSettingOffline();
    })
    $('.nav-link[data-type="' + tabIndexSettingOffline + '"]').click();
    dataTableBranchData(res);
    $('#total-record-enable-online-data').text(res.data['2']);
    $('#total-record-disable-offline-data').text(res.data['3']);
}

function updateCookieSettingOffline() {
    saveCookieShared('offline-setting-user-id-' + idSession, JSON.stringify({
        'tab': tabIndexSettingOffline,
    }))
}

function dataTableBranchData(data) {
    let id_table_enable_online = $('#table-enable-online-branch-data'),
        id_table_disable_offline = $('#table-disable-offline-branch-data'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'address', name: 'address', className: 'text-left'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ],
        scroll_Y = null,
        fixed_left = 1,
        fixed_right = 2,
        optionRenderTable = [];
    DatatableTemplateNew(id_table_enable_online, data.data[0].original.data, column, scroll_Y, fixed_left, fixed_right, optionRenderTable);
    DatatableTemplateNew(id_table_disable_offline, data.data[1].original.data, column, scroll_Y, fixed_left, fixed_right, optionRenderTable);
}

function changeStatusOfflineBranch(id, status) {
    if (checkChangeStatusOfflineSetting === 1) return false;
    let title, content;
    if (status === 0) {
        title = $('#notify-on-update-status-component').text();
    } else {
        title = $('#notify-off-update-status-component').text();
    }

    let icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'offline-setting.change-offline-branch',
                params = null,
                data = {id: id,};
            checkChangeStatusOfflineSetting = 1;
            let res = await axiosTemplate(method, url, params, data);
            checkChangeStatusOfflineSetting = 0;
            let text = $('#success-status-data-to-server').text();
            switch (res.data.status){
                case 200:
                    SuccessNotify(text);
                    loadData();
                    break;
                case 500:
                    text = $('#error-post-data-to-server').text();
                    ErrorNotify(text);
                    break;
                default :
                    text = $('#error-post-data-to-server').text();
                    if (data.data.message !== null) {
                        text = data.data.message;
                    }
                    WarningNotify(text);
            }
        }
    })
}
