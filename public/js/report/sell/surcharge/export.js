function exportExcelSurchargeReport() {
    $('#total-value-sell-surcharge-report label').text(totalValueSurchargeReport);
    $('#title-excel-surcharge-report span').text();
    $('#table-export-surcharge-report tbody').html('');
    dataTableSurcharge.rows().every(function () {
        let x = $(this.node());
        $('#table-export-surcharge-report tbody').append('<tr>\n' +
            '<td style="text-align: center">' + x.find('td:eq(0)').text() + '</td>' +
            '<td style="text-align: center">' + x.find('td:eq(1)').text() + '</td>' +
            '<td style="text-align: center">' + x.find('td:eq(2)').text() + '</td>' +
            '</tr>');
    });
    ExportSurchargeReportIndex();
}

function ExportSurchargeReportIndex() {
    let element = $('#table-export-surcharge-report');
    let name = $('#title-excel-surcharge-report').text();
    exportExcelTableTemplate(element, name);
}
