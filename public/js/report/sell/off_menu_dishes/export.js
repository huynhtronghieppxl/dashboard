async function exportExcelOffMenuDishes() {
    $('#total-quantity-off-menu-dishes label').text($('#total-quantity-card6').text());
    $('#total-original-off-menu-dishes label').text($('#total-original-card6').text());
    $('#total-money-off-menu-dishes label').text($('#total-money-card6').text());
    $('#total-profit-off-menu-dishes label').text($('#total-profit-card6').text());
    $('#title-excel-off-menu-dishes span').text();
    $('#table-export-off-menu-dishes tbody').html('');
    if (dataExportOffMenuDishes.length === 0) {
        WarningNotify('Dữ liệu rỗng !!!');
        return false;
    }
    for await(const [i, v] of dataExportOffMenuDishes.entries()) {
        $('#table-export-off-menu-dishes tbody').append(`
        <tr>
            <td class="text-center">${i + 1}</td>
            <td class="text-center">${v.food_name}</td>
            <td class="text-center">${formatNumber(v.quantity)}</td>
            <td class="text-center">${formatNumber(v.total_original_amount)}</td>
            <td class="text-center">${formatNumber(v.total_amount)}</td>
            <td class="text-center">${formatNumber(v.profit)}</td>
            <td class="text-center">${formatNumber(v.profit_ratio)}</td>
        </tr>
        `)
    }
    exportExcelTableTemplate($('#table-export-off-menu-dishes'), $('#title-excel-off-menu-dishes').text(),
        $('#total-quantity-off-menu-dishes label').text(),
        $('#total-original-off-menu-dishes label').text(),
        $('#total-money-off-menu-dishes label').text(),
        $('#total-profit-off-menu-dishes label').text())
}
