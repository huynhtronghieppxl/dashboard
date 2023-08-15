function openModalDetailOtherCostRevenueCostProfit() {
    $('#modal-detail-other-cost-revenue-cost-profit-report').modal('show');
    dataDetailOtherCostRevenueCostProfit();
}

async function dataDetailOtherCostRevenueCostProfit(){
    let method = 'get',
        url = 'branch-dashboard.data-detail-other-cost-report',
        branch = $('#change_branch').val(),
        restaurant_brand_id = $('#restaurant-branch-id-selected span').attr('data-value'),
        params = {branch: branch, restaurant_brand_id: restaurant_brand_id,
            type: $('#select-type-revenue-cost-profit-report').val(), time: $('#select-type-revenue-cost-profit-report option:selected').data('time')},
        data = null;
    console.log(params);
    let res = await axiosTemplate(method, url, params, data, [
        $('#content-body-techres')
    ]);
    tableDetailOtherCostRevenueCostProfit(res.data[0].original.data);
    $('#total-detail-other-cost-revenue-cost-profit-report').text(res.data[1])
}

function tableDetailOtherCostRevenueCostProfit(data) {
    let id = $('#table-detail-other-cost-revenue-cost-profit-report'),
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'addition_fee_reason_name', name: 'addition_fee_reason_name', className: 'text-center'},
            {data: 'amount', name: 'amount', className: 'text-center'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ],
        scroll_Y = '60vh',
        fixed_left = 0,
        fixed_right = 0;
    DatatableTemplateNew(id, data, columns, scroll_Y, fixed_left, fixed_right);
}

function closeModalDetailOtherCostRevenueCostProfit() {
    $('#modal-detail-other-cost-revenue-cost-profit-report').modal('hide');
}
