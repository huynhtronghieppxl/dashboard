let dataQuantitativeFoodBrandManage;

function openModalDetailAddtionFoodBrandManage() {
    $('#detail-addtion-food-brand-manage-info').click();
    $('#modal-detail-addtion-food-brand-manage').modal('show');
    $('#modal-detail-material-data').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailAddtionFoodBrandManage();
        });
    });
    getAddtionDataDetailFoodBrandManage();
}

function openModalDetailAddtionFoodInfo() {
    $('#quantitative-detail-addtion-food-brand-manage').addClass('d-none');
    $('#info-detail-addtion-food-brand-manage').removeClass('d-none');
}

function openModalDetailAddtionFoodQuantity() {
    $('#info-detail-addtion-food-brand-manage').addClass('d-none');
    $('#quantitative-detail-addtion-food-brand-manage').removeClass('d-none');
    dataQuantitativeFoodBrandManage.draw()
}

async function getAddtionDataDetailFoodBrandManage() {
    let method = 'get',
        url = 'food-brand-manage.data-food-detail',
        params = {
            branch_id: branchIdFood,
            id: idFoodDetailMangae
        },
        data = null;

    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-modal-detail-addtion-food-brand-manage')
    ]);
    shortcut.remove('ESC')
    shortcut.add('ESC', function () {
        closeModalDetailAddtionFoodBrandManage();
    });
    $('#unit-detail-addtion-food-brand-manage').text(res.data[0].unit_type);
    $("#avatar-detail-addtion-food-brand-manage").attr("src", res.data[0].avatar);
    $('#brand-detail-addtion-food-brand-manage').text($('#change_brand').find('option:selected').text());
    $('#name-detail-addtion-food-brand-manage').text(res.data[0].name);
    $('#code-detail-addtion-food-brand-manage').text(res.data[0].code);
    $('#category-detail-addtion-food-brand-manage').text(res.data[0].category_name);
    $('#bbq-detail-addtion-food-brand-manage').text(res.data[0].category_type_name);
    $('#point-detail-addtion-food-brand-manage').text(res.data[0].is_special_claim_point);
    $('#sell-by-weigh2-food-detail').text(res.data[0].is_sell_by_weight);
    $('#print-detail-addtion-food-brand-manage').text(res.data[0].is_allow_print);
    $('#review-detail-addtion-food-brand-manage').text(res.data[0].is_allow_review);
    $('#allow-point-detail-addtion-food-brand-manage').text(res.data[0].is_allow_purchase_by_point);
    $('#take-away-detail-addtion-food-brand-manage').text(res.data[0].sale_online_status);
    $('#time-detail-addtion-food-brand-manage').text(res.data[0].time_to_completed);
    $('#price-detail-addtion-food-brand-manage').text(formatNumber(res.data[0].price));
    $('#allow-point-purchase-detail-addtion-food-brand-manage').text(res.data[0].is_allow_purchase_by_point);
    $('#point-to-purchase-detail-addtion-food-brand-manage').text(res.data[0].point_to_purchase);
    $('#descript-detail-addtion-food-brand-manage').text(res.data[0].description === '' ? '---' : res.data[0].description);
    $('#status-detail-addtion-food-brand-manage').html(res.data[0].status);
    $('#type-food-detail-addtion-food-brand-manage').text(res.data[0].type_food);
    $('#sell-by-detail-addtion-food-brand-manage').text(res.data[0].is_sell_by_weight_name);
    is_addition_like_food = res.data[0].is_addition_like_food == 0 ? 'Không' : 'Có';
    $('#like-food-detail-addtion-food-brand-manage').text(is_addition_like_food);
    $('#vat-detail-addtion-food-brand-manage').text(res.data[0].vat);
    $('#original-price-detail-addtion-food-brand-manage').text(formatNumber(res.data[0].original_price));
    $('#profit-price-detail-addtion-food-brand-manage').text(res.data[0].original_revenue);
    $('#profit-rate-by-original-price-detail-addtion-food-brand-manage').text(res.data[0].profit_rate_by_original_price);
    $('#profit-rate-by-price-detail-addtion-food-brand-manage').text(res.data[0].profit_rate_by_price);
    retail = res.data[0].is_addition_like_food == 0 ? 'Không' : 'Có';
    $('#retail-detail-addtion-food-brand-manage').text(retail);
    // $('#total-record-tab2').text(res.data[4].total_quantity);
    // $('#total-record-tab1').text(res.data[4].total_addition);
    // dataTableAddtionDetailFoodBrandManage(res);
    hideTextTooLong($('#descript-detail-addtion-food-brand-manage'))
    dataTableQuantitativeDetailFoodBrandManage(res);
    $('#total-addtion-record-tab2').text(res.data[4].total_quantity)
}

async function dataTableQuantitativeDetailFoodBrandManage(data) {
    let idAddtion = $('#table-quantitative-detail-addtion-food-brand-manage'),
        column1 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-left', width: '15%'},
            {data: 'material_category_name', name: 'material_category_name', className: 'text-left'},
            {data: 'unit_order', name: 'unit_order', className: 'text-left'},
            {data: 'price', name: 'price', className: 'text-right'},
            {data: 'quantity', name: 'quantity', className: 'text-right'},
            {data: 'total_price', name: 'total_price', className: 'text-right'},
            {data: 'wastage_rate', name: 'wastage_rate', className: 'text-center'},
            {data: 'price_quantitative', name: 'price_quantitative', className: 'text-right'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ],
        scroll_Y = "30vh",
        fixed_left = 0,
        fixed_right = 0;
    dataQuantitativeFoodBrandManage = await DatatableTemplateNew(idAddtion, data.data[3].original.data, column1, scroll_Y, fixed_left, fixed_right)
    let totalAmount = 0
    dataQuantitativeFoodBrandManage.rows().every(function (){
        totalAmount += Number(removeformatNumber($(this.node()).find('td:eq(8)').text()))
    })
    $('#total-amount-quantity-material-food-brand-manage').text(formatNumber(totalAmount))
}

function closeModalDetailAddtionFoodBrandManage() {
    $('#group-btn-detail-addtion-food-brand-manage button:first').click();
    $('#modal-detail-addtion-food-brand-manage').modal('hide');
    $('.reset-data-detail-addtion-employee-manage').html('---');
    $('#total-addtion-record-tab2').html(0);
}


