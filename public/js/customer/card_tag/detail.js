let tableCustomerDetailTagCard;
function openModalDetailCardTag(r){
    idCardTag = r.data('id');
    $('#modal-detail-card-tag').modal('show');
    shortcut.remove('ESC');
    shortcut.add('ESC', function (){
        closeModalDetailCardTag();
    })
    getDataDetailCardTag()
}
async function getDataDetailCardTag(){
    let method = 'get',
        url = 'card-tag.detail-tag',
        params = {
            id: idCardTag,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-modal-detail-card-tag'),
    ]);
    $('#name-detail-card-tag').text(res.data[0].data.name);
    $('#color-detail-card-tag').html(res.data[0].data.color_hex_code);
    await dataTableDetailCardTag(res)
}
async function dataTableDetailCardTag(data) {
    let infoCustomer = $('#table-customer-detail-in-card-tag'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'gender', name: 'gender', className: 'text-left'},
            {data: 'phone', name: 'phone', className: 'text-left'},
            { data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ],
        scroll_Y = "30vh",
        fixed_left = 0,
        fixed_right = 0;
    tableCustomerDetailTagCard = await DatatableTemplateNew(infoCustomer, data.data[1].original.data, column, scroll_Y, fixed_left, fixed_right)
}
function closeModalDetailCardTag(){
    $('#modal-detail-card-tag').modal('hide');
    reloadModalDetailCardTag()
}
function reloadModalDetailCardTag(){
    $('#name-detail-card-tag').text('---');
    $('#color-detail-card-tag').text('---');
    tableCustomerDetailTagCard.clear().draw(false);
}
