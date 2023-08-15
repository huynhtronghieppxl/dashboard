function openDetailCategorySellReport(r) {
    $('#modal-detail-category-sell-report').modal('show');
    shortcut.add('ESC', function () {
        closeModalDetailCategorySellReport();
    });
    $('#name-detail-category-sell-report').text(r.data('name'));
    dataDetailCategorySellReport(r.data('brand'), r.data('branch'), r.data('type'), r.data('time'), r.data('id'), r.data('from'), r.data('to'),);
    getTimeBasedOnTypeReport($('#time-detail-category-sell-report'), r.data('type'));
}

async function dataDetailCategorySellReport(brand, branch, type, time, category, from_date, to_date) {
    let method = 'get',
        url = 'category-report.detail',
        params = {
            brand: brand,
            branch: branch,
            category: category,
            type: type,
            time: time,
            from_date: from_date,
            to_date: to_date,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data,[$("#table-detail-category-sell-report")]);
    let totalProfit = (removeformatNumber(res.data[1].sum_profit) / removeformatNumber(res.data[1].sum_total) * 100);
    $('#original-detail-category-sell-report').text(res.data[1].sum_total_original);
    $('#price-detail-category-sell-report').text(res.data[1].sum_total);
    $('#profit-detail-category-sell-report').text(res.data[1].sum_profit);
    $('#rate-profit-detail-category-sell-report').text((totalProfit).toFixed(2));
    let id = $('#table-detail-category-sell-report'),
        fixed_left = 0,
        fixed_right = 0,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'avatar', name: 'avatar', className: 'text-left'},
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'total_original_amount', name: 'total_original_amount', className: 'text-right'},
            {data: 'total_amount', name: 'total_amount', className: 'text-right'},
            {data: 'total_profit', name: 'total_profit', className: 'text-right'},
            {data: 'profit_ratio', name: 'profit_ratio', className: 'text-center'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ],
        option = []
    DatatableTemplateNew(id, res.data[0].original.data, columns, '45vh', fixed_left, fixed_right, option);
}

function closeModalDetailCategorySellReport() {
    $('#modal-detail-category-sell-report').modal('hide');
    resetModalDetailCategorySellReport();
}

function resetModalDetailCategorySellReport() {
    $('#name-detail-category-sell-report').text('---');
    // $('#time-detail-category-sell-report').text('---');
    $('#original-detail-category-sell-report').text('0');
    $('#rate-profit-detail-category-sell-report').text('0');
    $('#price-detail-category-sell-report').text('0');
    $('#profit-detail-category-sell-report').text('0');
}
