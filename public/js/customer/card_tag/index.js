let tableDisableCardTag, tableEnableCardTag,
    thisChangeStatusCardTag;
$(function () {
    loadData();
});

async function  loadData(){
    let method = 'get',
        url = 'card-tag.data',
        is_delete = -1,
        params = {is_delete: is_delete},
        data = null;
    let res = await axiosTemplate(method, url, params, data,[$("#table-card-tag")]);
    await dataTableCardTag(res);
    $('#total-record-card-tag-enable').text(res.data[3].total_record_tag_enable);
    $('#total-record-card-tag-disable').text(res.data[3].total_record_tag_disable);
}

async function dataTableCardTag(data) {
    let scroll_Y = '65vh';
    let fixed_left = 2;
    let fixed_right = 2;
    let enableCard = $('#table-card-tag'),
        disableCard = $('#table-disable-card-tag');
    let column = [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
        {data: 'name', name: 'name', className: 'text-left'},
        {data: 'color', name: 'color', className: 'text-center'},
        {data: 'quantity', name: 'quantity-customer', className: 'text-center'},
        {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        {data: 'keysearch', name: 'keysearch', className: 'd-none'},
    ],
    option = [{
        'title': 'Thêm mới (F2)',
        'icon': 'fa fa-plus text-primary',
        'class': '',
        'function': 'openModalCreateCardTag',
    }];
    tableEnableCardTag = await DatatableTemplateNew(enableCard, data.data[0].original.data, column, scroll_Y, fixed_left, fixed_right, option);
    tableDisableCardTag = await DatatableTemplateNew(disableCard, data.data[2].original.data, column, scroll_Y, fixed_left, fixed_right, option);
}
function changeStatusCardTag(r){
    thisChangeStatusCardTag = r;
    let id = r.data('id');
    let title = 'Đổi trạng thái thành Đang hoạt động ?';
    if(r.find('span').hasClass('icofont-ui-close')){
        title = 'Đổi trạng thái thành Tạm ngưng ?';
    }
    let content = '';
    let icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'card-tag.change-status',
                params = null,
                data = {id: id,
                        is_confirm: 1};
            let res = await axiosTemplate(method, url, params, data, [$('#content-body-techres')]);
            switch (res.data.status) {
                case 200:
                    SuccessNotify($('#success-status-data-to-server').text());
                    await drawDataChangeStatusCardTag(res.data.data);
                    break;
                case 300:
                    SuccessNotify($('#success-status-data-to-server').text());
                    await drawDataChangeStatusCardTag(res.data.data);
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
async function drawDataChangeStatusCardTag(data){
    switch (data.is_delete){
        case 0:
            $('#total-record-card-tag-enable').text(formatNumber(removeformatNumber($('#total-record-card-tag-enable').text()) + 1));
            $('#total-record-card-tag-disable').text(formatNumber(removeformatNumber($('#total-record-card-tag-disable').text()) - 1));
            await removeRowDatatableTemplate(tableDisableCardTag, thisChangeStatusCardTag, true);
            addRowDatatableTemplate(tableEnableCardTag, {
                'name': data.name,
                'color': data.color_hex_code,
                'quantity': (data.customers).length,
                'action': data.action,
                'keysearch': data.keysearch,
            });
            break;
        case 1:
            $('#total-record-card-tag-enable').text(formatNumber(removeformatNumber($('#total-record-card-tag-enable').text()) - 1));
            $('#total-record-card-tag-disable').text(formatNumber(removeformatNumber($('#total-record-card-tag-disable').text()) + 1));
            await removeRowDatatableTemplate(tableEnableCardTag, thisChangeStatusCardTag, true);
            addRowDatatableTemplate(tableDisableCardTag, {
                'name': data.name,
                'color': data.color_hex_code,
                'quantity': (data.customers).length,
                'action': data.action,
                'keysearch': data.keysearch,
            });
            break;
    }
}
