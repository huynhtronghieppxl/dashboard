let action = 0,
    idFood = 0,
    id_temp = [],
    dataAddtionFoodBrandManage,
    dataQuantityFoodBrandManage,
    dataPriceAreaFoodBrandManage;

$(function (){
    $(document).on('input paste','#loading-modal-detail-food-brand-manage input[type="search"]', function (){
        $('#total-record-tab1').text(dataAddtionFoodBrandManage.rows({'search': 'applied'}).count());
        $('#total-record-tab2').text(dataQuantityFoodBrandManage.rows({'search': 'applied'}).count());
        $('#total-record-tab3').text(dataPriceAreaFoodBrandManage.rows({'search': 'applied'}).count());
    })
})

function openModalFoodDetailFoodBrandManage() {
    $('#detail-info-food-branch-manager').click();
    $('.swal2-container').addClass('d-none');
    $('#modal-detail-food-brand-manage').modal('show');
    shortcut.remove('F2');
    shortcut.remove('F3');

    $('#modal-detail-addtion-food-brand-manage').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailFoodManage();
        });
    });
    $('#modal-detail-material-data').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailFoodManage();
        });
    });
    getDataDetailFoodBrandManage();
    switch (idCategoryFoodDetailManage){
        case 1:
            $('#detail-list-addition-food-branch-manager').removeClass('d-none');
            break;
        case 2:
            $('#detail-list-addition-food-branch-manager').addClass('d-none');
            break;
        case 3:
            $('#detail-list-addition-food-branch-manager').addClass('d-none');
            break;
        case 4:
            $('#detail-list-addition-food-branch-manager').removeClass('d-none');
            break;
    }
}

function openModalDetailFoodInfo(){
    $('#price-area-detail-food-branch-manage').addClass('d-none');
    $('#info-detail-food-brand-manage').removeClass('d-none');
    $('#addtion-detail-food-brand-manage').addClass('d-none');
    $('#quantity-detail-food-brand-manage').addClass('d-none');
}

function openModalDetailFoodAddition(){
    $('#price-area-detail-food-branch-manage').addClass('d-none');
    $('#info-detail-food-brand-manage').addClass('d-none');
    $('#addtion-detail-food-brand-manage').removeClass('d-none');
    $('#quantity-detail-food-brand-manage').addClass('d-none');
    dataAddtionFoodBrandManage.draw();
}
function openModalDetailFoodQuantity(){
    $('#price-area-detail-food-branch-manage').addClass('d-none');
    $('#info-detail-food-brand-manage').addClass('d-none');
    $('#addtion-detail-food-brand-manage').addClass('d-none');
    $('#quantity-detail-food-brand-manage').removeClass('d-none');
    dataQuantityFoodBrandManage.draw();
}
function openModalDetailFoodPriceArea(){
    $('#price-area-detail-food-branch-manage').removeClass('d-none');
    $('#info-detail-food-brand-manage').addClass('d-none');
    $('#addtion-detail-food-brand-manage').addClass('d-none');
    $('#quantity-detail-food-brand-manage').addClass('d-none');
    dataPriceAreaFoodBrandManage.draw();
}

async function getDataDetailFoodBrandManage() {
    let method = 'get',
        url = 'food-brand-manage.data-food-detail',
        params = {
            branch_id: branchIdFood,
            id: idFoodDetailMangae
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-modal-detail-food-brand-manage'),
    ]);
    shortcut.remove('ESC');
    shortcut.add('ESC',function (){
        closeModalDetailFoodManage();
    })
    $('#unit-detail-food-brand-manage').text(res.data[0]?.unit_type);
    $("#avatar-detail-food-brand-manage").attr("src", res.data[0].avatar);
    $('#brand-detail-food-brand-manage').text($('#change_brand').find('option:selected').text());
    $('#name-detail-food-brand-manage').text(res.data[0].name);
    $('#code-detail-food-brand-manage').text(res.data[0].code);
    $('#category-detail-food-brand-manage').text(res.data[0].category_name);
    $('#bbq-detail-food-brand-manage').text(res.data[0].category_type_name);
    $('#point-detail-food-brand-manage').text(res.data[0].is_special_claim_point);
    $('#sell-by-weigh2-food-detail').text(res.data[0].is_sell_by_weight);
    $('#print-detail-food-brand-manage').text(res.data[0].is_allow_print);
    $('#review-detail-food-brand-manage').text(res.data[0].is_allow_review);
    $('#allow-point-detail-food-brand-manage').text(res.data[0].is_allow_purchase_by_point);
    $('#take-away-detail-food-brand-manage').text(res.data[0].sale_online_status);
    $('#time-detail-food-brand-manage').text(res.data[0].time_to_completed);
    $('#orginal-price-detail-food-brand-manage').text(formatNumber(res.data[0].original_price));
    $('#price-detail-food-brand-manage').text(formatNumber(res.data[0].price));
    $('#profit-price-detail-food-brand-manage').text(formatNumber(res.data[0].original_revenue));
    $('#profit-rate-by-original-price-detail-food-brand-manage').text(formatNumber(res.data[0].profit_rate_by_original_price));
    $('#profit-rate-by-price-detail-food-brand-manage').text(formatNumber(res.data[0].profit_rate_by_price));
    $('#vat-detail-food-brand-manage').text(formatNumber(res.data[0].vat));
    $('#allow-point-purchase-detail-food-brand-manage').text(res.data[0].is_allow_purchase_by_point);
    $('#point-to-purchase-detail-food-brand-manage').text(res.data[0].point_to_purchase);
    $('#descript-detail-food-brand-manage').text(res.data[0].description);
    $('#status-detail-food-brand-manage').html(res.data[0].status);
    $('#type-food-detail-food-brand-manage').text(res.data[0].type_food);
    $('#total-record-tab2').text(res.data[4].total_quantity);
    $('#sell-by-detail-food-brand-manage').text(res.data[0]['is_sell_by_weight_name']);
    $('#total-record-tab1').text(res.data[4].total_addition);
    $('#total-record-tab4').text(res.data[4].total_price_by_area);
    dataTableAddtionDetailFoodBrandManage(res);
    hideTextTooLong($('#descript-detail-food-brand-manage'))
}

async function dataTableAddtionDetailFoodBrandManage(data) {
    let idAddtion = $('#table-addition-detail-food-brand-manage'),
        idQuantity = $('#table-quantity-detail-food-brand-manage'),
        idPriceArea = $('#table-price-area-detail-food-branch-manage'),
        column1 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'price', name: 'price', className: 'text-right'},
            {data: 'action', name: 'action', className: 'text-center'},
            { data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ],
        column2 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'material_category_type_name', name: 'material_category_type_name', className: 'text-left'},
            {data: 'unit_order', name: 'unit_order', className: 'text-left'},
            {data: 'price', name: 'price', className: 'text-right'},
            {data: 'quantity', name: 'quantity', className: 'text-right'},
            {data: 'total_price', name: 'total_price', className: 'text-right'},
            {data: 'wastage_rate', name: 'wastage_rate', className: 'text-center'},
            {data: 'price_quantitative', name: 'price_quantitative', className: 'text-right'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ],
        column3 = [
            {data: 'left-none', name: 'left-none', className: 'text-left', width: "25%"},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'price', name: 'price', className: 'text-right'},
            {data: 'right-none', name: 'right-none', className: 'text-left', width: "25%"},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ],
        scroll_Y = "30vh",
        fixed_left = 0,
        fixed_right = 0;
    dataAddtionFoodBrandManage = await DatatableTemplateNew(idAddtion, data.data[1].original.data, column1, scroll_Y, fixed_left, fixed_right)
    dataQuantityFoodBrandManage = await DatatableTemplateNew(idQuantity, data.data[3].original.data, column2, scroll_Y, fixed_left, fixed_right)
    dataPriceAreaFoodBrandManage = await DatatableTemplateNew(idPriceArea, data.data[6].original.data, column3, scroll_Y, fixed_left, fixed_right)

    $(document).on('input paste', '#loading-modal-detail-food-brand-manage input[type="search"]', function (){
        $('#total-record-tab1').text(dataAddtionFoodBrandManage.rows({'search':'applied'}).count())
        $('#total-record-tab2').text(dataQuantityFoodBrandManage.rows({'search':'applied'}).count())
        $('#total-record-tab4').text(dataPriceAreaFoodBrandManage.rows({'search':'applied'}).count())

        searchUpdateIndexDataTable(dataAddtionFoodBrandManage)
        searchUpdateIndexDataTable(dataQuantityFoodBrandManage)
        searchUpdateIndexDataTable(dataPriceAreaFoodBrandManage)

    })
    let totalLossIncluded = 0
    dataQuantityFoodBrandManage.rows().every(function (){
        totalLossIncluded += Number(removeformatNumber($(this.node()).find('td:eq(8)').text()))
    })
    $('#total-amount-loss-included-detail-food-brand-manage').text(formatNumber(checkDecimal(totalLossIncluded)));
}



function closeModalDetailFoodManage() {
    $('.swal2-container').removeClass('d-none');
    shortcut.add("F2", function () {
        openModalFoodDetailFoodBrandManage();
    });
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
      $('.swal2-cancel').click();

    });
    shortcut.remove('F4');
    shortcut.remove('ESC');
    $('#modal-detail-food-brand-manage').modal('hide');
    $('#group-btn-detail-food-brand-manage button:first').click();
    $('#name-detail-food-brand-manage').html('---');
    $('#code-detail-food-brand-manage').html('---');
    $('#unit-detail-food-brand-manage').html('---');
    $('#category-detail-food-brand-manage').html('---');
    $('#sell-by-detail-food-brand-manage').html('---');
    $('#review-detail-food-brand-manage').html('---');
    $('#orginal-price-detail-food-brand-manage').html('---');
    $('#price-detail-food-brand-manage').html('---');
    $('#profit-price-detail-food-brand-manage').html('---');
    $('#time-detail-food-brand-manage').html('---');
    $('#bbq-detail-food-brand-manage').html('---');
    $('#vat-detail-food-brand-manage').html('---');
    $('#type-food-detail-food-brand-manage').html('---');
    $('#print-detail-food-brand-manage').html('---');
    $('#take-away-detail-food-brand-manage').html('---');
    $('#point-to-purchase-detail-food-brand-manage').html('---');
    $('#allow-point-purchase-detail-food-brand-manage').html('---');
    $('#point-detail-food-brand-manage').html('---');
    $('#descript-detail-food-brand-manage').html('---');
    $('#total-record-tab1').html(0);
    $('#total-record-tab2').html(0);
    $('#total-record-tab3').html(0);
    $('#total-record-tab4').html(0);
}
