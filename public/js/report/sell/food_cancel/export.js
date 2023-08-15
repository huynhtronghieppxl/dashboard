async function exportSellFoodCancelReport() {
    $('.total-quantity-card7 label').text($('#total-quantity-card7').text());
    $('.total-amount-card7 label').text($('#total-amount-card7').text());
    $('#title-excel-food-cancel-report span').text();
    $('#table-export-food-cancel-report tbody').html('');
    await dataTableCancelFood.rows().every(function () {
        let x = $(this.node());
        $('#table-export-food-cancel-report tbody').append('<tr>\n' +
            '<td style="text-align: center">' + x.find('td:eq(0)').text() + '</td>' +
            '<td style="text-align: center">' + x.find('td:eq(1) label').data('name') + '</td>' +
            '<td style="text-align: center">' + x.find('td:eq(1) label').data('role-name') + '</td>' +
            '<td style="text-align: center">' + x.find('td:eq(2)').text() + '</td>' +
            '<td style="text-align: center">' + x.find('td:eq(3)').text() + '</td>' +
            '<td style="text-align: center">' + x.find('td:eq(4)').text() + '</td>' +
            '<td style="text-align: center">' + x.find('td:eq(5)').text() + '</td>' +
            '<td style="text-align: center">' + x.find('td:eq(6)').text() + '</td>' +
            '<td style="text-align: center">' + x.find('td:eq(7)').text() + '</td>' +
            '</tr>');
    });
    MergeCommonRows($('#table-export-food-cancel-report'), [1])
    ExportFoodCancelReportIndex();
}


function MergeCommonRows(table, rowGroup) {
    let firstColumnBrakes = rowGroup;
    for(let i=1 ; i<=table.find('th').length; i++){
        let previous = null, cellToExtend = null, rowspan = 1;
        table.find("tbody td:nth-child(" + i + ")").each(function(index, e){
            let jthis = $(this), content = jthis.text();
            if (previous == content && content !== "" && jQuery.inArray(i, firstColumnBrakes) !== -1) {
                jthis.addClass('hidden');
                cellToExtend.attr("rowspan", (rowspan = rowspan+1));
            }else{
                // store row breaks only for the first column:
                if(i === 1) firstColumnBrakes.push(index);
                rowspan = 1;
                previous = content;
                cellToExtend = jthis;
            }
        });
    }
    $('td.hidden').remove();
}

function ExportFoodCancelReportIndex() {
    let element = $('#table-export-food-cancel-report');
    let name = $('#title-excel-food-cancel-report').text();
    exportExcelTableTemplate(element, name);
}
