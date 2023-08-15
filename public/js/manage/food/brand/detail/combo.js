let dataTableComboCreateFoodBrandManage,
    dataTableComboPriceAreaFoodBrandManage;
function openModalDetailComboFoodBrandManage(){
    $('#detail-info-food-manage').click();
    $('#modal-detail-combo-food-brand-manage').modal('show');
    getComboDataDetailFoodBrandManage();

    $('#modal-detail-food-brand-manage').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailComboFoodBrandManage();
        });
    });
}

function openModalDetailComboFoodInfo(){
    $('#info-detail-combo-food-brand-manage').removeClass('d-none');
    $('#price-area-detail-combo-food-branch-manage').addClass('d-none');
    $('#table-food-combo-food-brand-manage').addClass('d-none');
}
function openModalDetailFoodInCombo(){
    $('#info-detail-combo-food-brand-manage').addClass('d-none');
    $('#price-area-detail-combo-food-branch-manage').addClass('d-none');
    $('#table-food-combo-food-brand-manage').removeClass('d-none');
    dataTableComboCreateFoodBrandManage.draw();
}
function openModalDetailComboFoodPriceArea(){
    $('#info-detail-combo-food-brand-manage').addClass('d-none');
    $('#price-area-detail-combo-food-branch-manage').removeClass('d-none');
    $('#table-food-combo-food-brand-manage').addClass('d-none');
    dataTableComboPriceAreaFoodBrandManage.draw();
}

async function getComboDataDetailFoodBrandManage(){
    let method = 'get',
        url = 'food-brand-manage.data-food-detail',
        params = {
            branch_id: branchIdFood,
            id: idFoodDetailMangae
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-modal-detail-combo-food-brand-manage')
    ]);
    shortcut.remove('ESC')
    shortcut.add('ESC', function () {
        closeModalDetailComboFoodBrandManage();
    });
    $('#unit-detail-combo-food-brand-manage').text(res.data[0].unit_type);
    $("#avatar-detail-combo-food-brand-manage").attr("src", res.data[0].avatar);
    $('#brand-detail-combo-food-brand-manage').text($('#change_brand').find('option:selected').text());
    $('#name-detail-combo-food-brand-manage').text(res.data[0].name);
    $('#code-detail-combo-food-brand-manage').text(res.data[0].code);
    $('#category-detail-combo-food-brand-manage').text(res.data[0].category_name);
    $('#bbq-detail-combo-food-brand-manage').text(res.data[0].category_type_name);
    $('#point-detail-combo-food-brand-manage').text(res.data[0].is_special_claim_point);
    $('#sell-by-weigh2-food-detail').text(res.data[0].is_sell_by_weight);
    $('#print-detail-combo-food-brand-manage').text(res.data[0].is_allow_print);
    $('#review-detail-combo-food-brand-manage').text(res.data[0].is_allow_review);
    $('#allow-point-detail-combo-food-brand-manage').text(res.data[0].is_allow_purchase_by_point);
    $('#take-away-detail-combo-food-brand-manage').text(res.data[0].sale_online_status);
    $('#time-detail-combo-food-brand-manage').text(res.data[0].time_to_completed);
    $('#price-detail-combo-food-brand-manage').text(formatNumber(res.data[0].price));
    $('#allow-point-purchase-detail-combo-food-brand-manage').text(res.data[0].is_allow_purchase_by_point);
    $('#point-to-purchase-detail-combo-food-brand-manage').text(res.data[0].point_to_purchase);
    $('#descript-detail-combo-food-brand-manage').text(res.data[0].description === '' ? '---' : res.data[0].description);
    $('#status-detail-combo-food-brand-manage').html(res.data[0].status);
    $('#type-food-detail-combo-food-brand-manage').text(res.data[0].type_food);
    $('#total-record-combo-food-brand-manage').text(res.data[4]['total_combo']);
    $('#sell-by-detail-combo-food-brand-manage').text(res.data[0]['is_sell_by_weight_name']);
    $('#original-price-detail-combo-food-brand-manage').text(formatNumber(res.data[0].original_price))
    $('#vat-detail-combo-food-brand-manage').text(res.data[0].vat)
    $('#profit-detail-combo-food-brand-manage').text(res.data[0].original_revenue)
    $('#profit-rate-by-original-price-detail-combo-food-brand-manage').text(res.data[0].profit_rate_by_original_price)
    $('#profit-rate-by-price-detail-combo-food-brand-manage').text(res.data[0].profit_rate_by_price)
    $('#total-record-price-by-area').text(res.data[4].total_price_by_area)
    hideTextTooLong($('#descript-detail-combo-food-brand-manage'));
    retail = res.data[0].is_addition_like_food == 0 ? 'Không' :  'Có';
    $('#retail-detail-combo-food-brand-manage').text(retail);
    dataTableComboDetailFoodBrandManage(res);
}
async function dataTableComboDetailFoodBrandManage(data) {
    let id = $('#table-foods-in-combo-detail-combo-food-brand-manage'),
        idFoodComboPriceArea = $('#table-price-area-detail-combo-food-branch-manage'),
        column = [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%' },
            { data: 'none', name: 'none', className: 'text-left',width: '30%'},
            { data: 'name', name: 'name', className: 'text-left'},
            { data: 'quantity', name: 'quantity', className: 'text-center', width: '20%'},
            { data: 'action', name: 'action', className: 'text-center', width: '5%' },
            { data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ],
        column2 = [
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'price', name: 'price', className: 'text-right'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ],
        scroll_Y = "30vh",
        fixed_left = 0,
        fixed_right = 0;
    dataTableComboCreateFoodBrandManage = await  DatatableTemplateNew(id, data.data[2].original.data, column, scroll_Y, fixed_left, fixed_right)
    dataTableComboPriceAreaFoodBrandManage = await  DatatableTemplateNew(idFoodComboPriceArea, data.data[6].original.data, column2, scroll_Y, fixed_left, fixed_right)

    $(document).on('input paste','#table-foods-in-combo-detail-combo-food-brand-manage_filter input[type="search"]', function (){
        $('#total-record-combo-food-brand-manage').text(dataTableComboCreateFoodBrandManage.rows({'search': 'applied'}).count());
    })
}
function closeModalDetailComboFoodBrandManage(){
    $('#modal-detail-combo-food-brand-manage').modal('hide');
    $('#group-btn-detail-combo-food-brand-manage button:first').click();
    $('#name-detail-combo-food-brand-manage').html('---');
    $('#code-detail-combo-food-brand-manage').html('---');
    $('#unit-detail-combo-food-brand-manage').html('---');
    $('#category-detail-combo-food-brand-manage').html('---');
    $('#sell-by-detail-combo-food-brand-manage').html('---');
    $('#review-detail-combo-food-brand-manage').html('---');
    $('#original-price-detail-combo-food-brand-manage').html('---');
    $('#price-detail-combo-food-brand-manage').html('---');
    $('#profit-detail-combo-food-brand-manage').html('---');
    $('#time-detail-combo-food-brand-manage').html('---');
    $('#bbq-detail-combo-food-brand-manage').html('---');
    $('#vat-detail-combo-food-brand-manage').html('---');
    $('#type-food-detail-combo-food-brand-manage').html('---');
    $('#print-detail-combo-food-brand-manage').html('---');
    $('#take-away-detail-combo-food-brand-manage').html('---');
    $('#allow-point-purchase-detail-combo-food-brand-manage').html('---');
    $('#point-to-purchase-detail-combo-food-brand-manage').html('---');
    $('#point-detail-combo-food-brand-manage').html('---');
    $('#descript-detail-combo-food-brand-manage').html('---');
    $('#total-record-combo-food-brand-manage').html(0);
    $('#total-record-price-by-area').html(0);
}

