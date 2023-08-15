function openModalDetailSupplierMaterial(id) {
    $('#modal-detail-supplier-material-data').modal('show')
    shortcut.add('ESC', function () {
        closeModalDetailSupplierMaterial();
    });

    dataDetailSupplierMaterial(id);
}

async function dataDetailSupplierMaterial(id){
    let method = 'get',
        url = 'supplier-material-data.get-detail',
        params = {material_id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-detail-supplier-material-data')]);
    $('#status-detail-supplier-material-data').html(res.data[0].status_text);
    $('#supplier-material-name-Supplier-data').text(res.data[0].name);
    $('#supplier-material-code-Supplier-data').text(res.data[0].code);
    $('#supplier-material-category-Supplier-data').text(res.data[0].category_name);
    $('#supplier-material-unit-Supplier-data').text(res.data[0].unit);
    $('#supplier-material-specifications-Supplier-data').text(res.data[0].specifications);
    $('#supplier-material-cost-price-Supplier-data').text(formatNumber(res.data[0].cost_price));
    $('#supplier-material-retail-price-Supplier-data').text(formatNumber(res.data[0].retail_price));
    $('#supplier-material-wholesale-price-Supplier-data').text(formatNumber(res.data[0].wholesale_price));
    $('#supplier-material-wholesale-price-quantity-Supplier-data').text(formatNumber(res.data[0].wholesale_price_quantity));
    $('#supplier-material-out-stock-quantity-Supplier-data').text(formatNumber(res.data[0].out_stock_alert_quantity));
}

function closeModalDetailSupplierMaterial() {
    $('#modal-detail-supplier-material-data').modal('hide');
    shortcut.remove('ESC');
    reloadModalDetailSupplierMaterial();
}

function reloadModalDetailSupplierMaterial(){
    $('#supplier-material-name-Supplier-data').text('---');
    $('#supplier-material-code-Supplier-data').text('---');
    $('#supplier-material-category-Supplier-data').text('---');
    $('#supplier-material-unit-Supplier-data').text('---');
    $('#supplier-material-specifications-Supplier-data').text('---');
    $('#supplier-material-cost-price-Supplier-data').text(0);
    $('#supplier-material-retail-price-Supplier-data').text(0);
    $('#supplier-material-wholesale-price-Supplier-data').text(0);
    $('#supplier-material-wholesale-price-quantity-Supplier-data').text(0);
    $('#supplier-material-out-stock-quantity-Supplier-data').text(0);
}
