let tableDraftBanner, tablePendingBanner, tableApprovedBanner, tableRejectedBanner, checkSaveIsRunningBanner = 0,
    quantityAllowed = 0;

$(function () {
    loadData();
});

async function loadData() {
    let method = 'GET',
        url = 'banner-advertisement.data',
        params = '',
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$("#content-body-techres")]);
    dataTableBanner(res.data);
    $('#total-record-draft').text(res.data[5].total_record_draft)
    $('#total-record-pending').text(res.data[5].total_record_pendding)
    $('#total-record-approved').text(res.data[5].total_record_approved)
    $('#total-record-rejected').text(res.data[5].total_record_rejected)
    quantityAllowed = Number(res.data[5].total_record_draft);
}

async function dataTableBanner(data) {
    let id = $('#table-draft-banner-advertisement'),
        id1 = $('#table-pendding-banner-advertisement'),
        id2 = $('#table-approved-banner-advertisement'),
        id3 = $('#table-rejected-banner-advertisement'),
        fixed_left = 0,
        fixed_right = 0;
    let column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'image_url', name: 'image_url', className: 'text-center'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'type', name: 'type', className: 'text-left'},
            {data: 'action', name: 'action', className: 'text-right'},
            {data: 'keysearch', name: 'keysearch', className: 'text-center d-none'}
        ],
        column1 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'image_url', name: 'image_url', className: 'text-center'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'type', name: 'type', className: 'text-left'},
            {data: 'status_date_draft', name: 'status_date_draft', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-right'},
            {data: 'keysearch', name: 'keysearch', className: 'text-center d-none'}
        ],
        column2 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'image_url', name: 'image_url', className: 'text-center'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'type', name: 'type', className: 'text-left'},
            {data: 'status_date_approved', name: 'status_date_approved', className: 'text-center'},
            {data: 'is_runing', name: 'is_runing', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-right'},
            {data: 'keysearch', name: 'keysearch', className: 'text-center d-none'}
        ],
        column3 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'image_url', name: 'image_url', className: 'text-center'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'type', name: 'type', className: 'text-left'},
            {data: 'status_date_rejected', name: 'status_date_rejected', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-right'},
            {data: 'keysearch', name: 'keysearch', className: 'text-center d-none'}
        ],
        option = [{
            'title': 'Thêm mới (F2)',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'openModalCreateBanner',
        },]

    tableDraftBanner = await DatatableTemplateNew(id, data[0].original.data, column, vh_of_table, fixed_left, fixed_right, option);
    tablePendingBanner = await DatatableTemplateNew(id1, data[1].original.data, column1, vh_of_table, fixed_left, fixed_right, option);
    tableApprovedBanner = await DatatableTemplateNew(id2, data[2].original.data, column2, vh_of_table, fixed_left, fixed_right, option);
    tableRejectedBanner = await DatatableTemplateNew(id3, data[3].original.data, column3, vh_of_table, fixed_left, fixed_right, option);
}

function changeStatusSetBanner(r) {
    let title = 'Xác nhận',
        content = 'Xác nhận gửi banner';
    let icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'banner-advertisement.change-status',
                params = null,
                data = {id: r.data('id'),};
            let res = await axiosTemplate(method, url, params, data, [$('#content-body-techres')]);
            switch (res.data.status) {
                case 200:
                    SuccessNotify($('#success-status-data-to-server').text());
                    removeRowDatatableTemplate(tableDraftBanner, r, true);
                    addRowDatatableTemplate(tablePendingBanner, {
                        "image_url": res.data.data.image_url,
                        "name": res.data.data.name,
                        "type": res.data.data.type,
                        "status_date_draft": res.data.data.status_date_draft,
                        "action": res.data.data.action,
                        "keysearch": res.data.data.keysearch,
                    })
                    $('#total-record-draft').text(parseInt($('#total-record-draft').text()) - 1)
                    $('#total-record-pending').text(parseInt($('#total-record-pending').text()) + 1)
                    break;
                case 500:
                    ErrorNotify($('#error-post-data-to-server').text());
                    break;
                default:
                    WarningNotify(res.data.message);
            }
        }
    })
}

function deleteBannerAdverts(r) {
    let title = 'Xác nhận',
        content = 'Xác nhận xóa banner';
    let icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'banner-advertisement.delete',
                params = null,
                data = {id: r.data('id'),};
            let res = await axiosTemplate(method, url, params, data, [$('#content-body-techres')]);
            switch (res.data.status) {
                case 200:
                    SuccessNotify('Xóa banner thành công');
                    drawDatatableDeleteBanner(r)
                    break;
                case 500:
                    ErrorNotify($('#error-post-data-to-server').text());
                    break;
                default:
                    WarningNotify(res.data.message);
            }
        }
    })
}

function drawDatatableDeleteBanner(r) {
    switch (r.parents('table').attr('id')) {
        case 'table-draft-banner-advertisement':
            $('#total-record-draft').text(parseInt($('#total-record-draft').text()) - 1)
            removeRowDatatableTemplate(tableDraftBanner, r, true)
            break;
        case 'table-pendding-banner-advertisement':
            removeRowDatatableTemplate(tablePendingBanner, r, true)
            $('#total-record-pending').text(parseInt($('#total-record-pending').text()) - 1)
            break;
        case 'table-approved-banner-advertisement':
            removeRowDatatableTemplate(tableApprovedBanner, r, true)
            $('#total-record-approved').text(parseInt($('#total-record-approved').text()) - 1)
            break;
    }
}

async function changeIsRunningBanner(r) {
    if (checkSaveIsRunningBanner === 1) return false;
    let title = 'Đổi trạng thái ?', text = '', icon = 'question';
    sweetAlertComponent(title, text, icon).then(async result => {
        if (result.value) {
            checkSaveIsRunningBanner = 1;
            let method = 'POST',
                url = 'banner-advertisement.is-running',
                params = {id: r.data('id')},
                data = '';
            let res = await axiosTemplate(method, url, params, data);
            checkSaveIsRunningBanner = 0;
            let text = '';
            switch (res.data.status) {
                case 200:
                    text = $('#success-status-data-to-server').text();
                    SuccessNotify(text);
                    loadData();
                    break;
                case 500:
                    text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) text = res.data.message;
                    ErrorNotify(text);
                    break;
                default:
                    text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) text = res.data.message;
                    WarningNotify(text);
            }
        }
    });
}
