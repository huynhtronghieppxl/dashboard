async function exportExcelGiftFoodReport() {
    $('#total-quantity-sell-gift-food-report label').text($('#total-quantity').text());
    $('#total-amount-sell-gift-food-report label').text($('#total-total').text());
    $('#title-excel-gift-food-report span').text();
    $('#table-export-gift-food-report tbody').html('');
    if (dataExportGiftFood.length === 0) {
        WarningNotify('Dữ liệu rỗng !!!');
        return false;
    }
    for await(const [i, v] of dataExportGiftFood.entries()) {
        $('#table-export-gift-food-report tbody').append(`<tr>
                <td style="text-align: center">${i + 1}</td>
                <td style="text-align: left">${v.employee_name}<br>
                ĐV: ${v.employee_role_name}</td>
                <td style="text-align: center">${v.food_name}</td>
                <td style="text-align: center">${v.quantity}</td>
                <td style="text-align: center">${v.price}</td>
                <td style="text-align: center">${v.total_amount}</td>
                <td style="text-align: center">${v.day}</td>
                <td style="text-align: center">${v.table_name}</td>
                <td style="text-align: center">${v.customer_slot_number}</td>`)
    }
    ExportGiftFoodReportIndex();
}

function ExportGiftFoodReportIndex() {
    let element = $('#table-export-gift-food-report');
    let name = $('#title-excel-gift-food-report').text();
    exportExcelTableTemplate(element, name);
}
