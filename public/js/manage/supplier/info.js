let lastIdDetailInfoSupplierManage,
    lastBranchDetailInfoSupplierManage,
    idDetailInfoSupplierManage,
  brand = $('.select-brand').val(), branch = $('.select-branch').val();

function openDetailInfoSupplierManage(id) {
    $('#modal-detail-info-supplier-manage').modal('show');
    reloadModalDetailInfoSupplierManage();
    shortcut.remove("ESC");
    shortcut.add('ESC', function () {
        closeModalDetailInfoSupplierManage();
    });
    idDetailInfoSupplierManage = id;
    dataDetailInfoSupplierManage(id);
}

async function dataDetailInfoSupplierManage(id) {
    if (id !== lastIdDetailInfoSupplierManage || $('.select-branch').val() !== lastBranchDetailInfoSupplierManage) {
        let method = 'get',
            url = 'supplier-manage.info',
            params = {
                supplier: id,
                brand: brand,
                branch: branch == undefined ? -1 : $('.select-branch').val(),
            },
            data = null;
        let res = await axiosTemplate(method, url, params, data,[$('#loading-modal-detail-info-supplier-manage')]);
        lastIdDetailInfoSupplierManage = res.data[0].id;
        lastBranchDetailInfoSupplierManage = res.data[0].branch;
        $('#name-detail-info-supplier-manage').text(res.data[0].name);
        $('#avatar-detail-info-supplier-manage').attr('src',res.data[0].avatar)
        $('#type-detail-info-supplier-manage').text(res.data[0].type);
        $('#create-detail-info-supplier-manage').text(res.data[0].created_at);
        $('#phone-detail-info-supplier-manage').text(res.data[0].phone);
        $('#address-detail-info-supplier-manage').text(res.data[0].address);
        if (res.data[0].tax_code){
            $('#code-detail-info-supplier-manager').text(res.data[0].tax_code);
        }
        if (res.data[0].email){
            $('#email-detail-info-supplier-manage').text(res.data[0].email);
        }
        if(res.data[0].website){
            $('#website-detail-info-supplier-manage').addClass('class-link-status')
            $('#website-detail-info-supplier-manage').text(res.data[0].website);
            $('#website-detail-info-supplier-manage').attr('href',res.data[0].website)
        }
        if(res.data[0].description){
            $('#description-detail-info-supplier-manage').text(res.data[0].description);
        }
        $('#total-order-detail-info-supplier-manage').text(res.data[0].count_total_order);
        $('#total-amount-detail-info-supplier-manage').text(res.data[0].total_order_amount);
        $('#done-order-detail-info-supplier-manage').text(res.data[0].count_total_order_complete);
        $('#done-amount-detail-info-supplier-manage').text(res.data[0].total_order_amount_complete);
        $('#return-order-detail-info-supplier-manage').text(res.data[0].count_total_order_return);
        $('#return-amount-detail-info-supplier-manage').text(res.data[0].total_order_amount_return);
        $('#debt-order-detail-info-supplier-manage').text(res.data[0].count_total_order_debt);
        $('#debt-amount-detail-info-supplier-manage').text(res.data[0].total_order_amount_debt);
        $('#waiting-order-detail-info-supplier-manage').text(res.data[0].count_total_order_processing);
        $('#waiting-amount-detail-info-supplier-manage').text(res.data[0].total_order_amount_processing);


        hideTextTooLong($('#description-detail-info-supplier-manage'));

    }
}



function closeModalDetailInfoSupplierManage() {
    $('#modal-detail-info-supplier-manage').modal('hide');
    reloadModalDetailInfoSupplierManage();
}

function reloadModalDetailInfoSupplierManage(){
    $('#tab-Detail').click();
    $('#name-detail-info-supplier-manage').text('---');
    $('#type-detail-info-supplier-manage').text('---');
    $('#create-detail-info-supplier-manage').text('---');
    $('#phone-detail-info-supplier-manage').text('---');
    $('#address-detail-info-supplier-manage').text('---');
    $('#code-detail-info-supplier-manager').text('---');
    $('#email-detail-info-supplier-manage').text('---');
    $('#website-detail-info-supplier-manage').text('---');
    $('#description-detail-info-supplier-manage').text('---');
    $('#total-order-detail-info-supplier-manage').text(0);
    $('#total-amount-detail-info-supplier-manage').text(0);
    $('#done-order-detail-info-supplier-manage').text(0);
    $('#done-amount-detail-info-supplier-manage').text(0);
    $('#return-order-detail-info-supplier-manage').text(0);
    $('#return-amount-detail-info-supplier-manage').text(0);
    $('#waiting-order-detail-info-supplier-manage').text(0);
    $('#waiting-amount-detail-info-supplier-manage').text(0);
    $('#debt-order-detail-info-supplier-manage').text(0);
    $('#debt-amount-detail-info-supplier-manage').text(0);
}
