function exportExcelDiscountReport() {
    $('#total-value-sell-discount-report label').text(totalValueDiscountReport);
    $('#title-excel-discount-report span').text();
    $('#table-export-discount-report tbody').html('');
    dataTableDiscount.rows().every(function () {
        let x = $(this.node());
        $('#table-export-discount-report tbody').append(`<tr>
            <td style="text-align: center"> ${x.find('td:eq(0)').text()} </td>
            <td style="text-align: center"> ${x.find('td:eq(1)').text()} </td>
            <td style="text-align: center"> ${x.find('td:eq(2)').text()} </td>
            <td style="text-align: center"> ${x.find('td:eq(3)').text()} </td>
            <td style="text-align: center"> ${x.find('td:eq(4)').text()} </td>
            <td style="text-align: center"> ${x.find('td:eq(5)').text()} </td>
            <td style="text-align: center"> ${x.find('td:eq(6)').text()} </td>
            <td style="text-align: center"> ${x.find('td:eq(7)').text()} </td>
            <td style="text-align: center"> ${x.find('td:eq(8)').text()} </td>
            <td style="text-align: center"> ${x.find('td:eq(9)').text()} </td>
            <td style="text-align: center"> ${x.find('td:eq(10)').text()} </td>
            </tr>`);
    });
    ExportDiscountReportIndex();
}

function ExportDiscountReportIndex() {
    let element = $('#table-export-discount-report');
    let name = $('#title-excel-discount-report').text();
    exportExcelTableTemplate(element, name);
}
