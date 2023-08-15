/**
 * export Excel from data table
 * @param element
 * @param data_table
 * @param name
 * @returns {Promise<boolean>}
 */

async function exportExcelTemplate(element, data_table, name) {
    try {
        let i = $('#'+element.attr('id')+'_wrapper').find('.dataTables_scrollBody').find('tbody tr .dataTables_empty').length;
        if (i === 1) {
            let text = $('#error-export-excel-template').text();
            ErrorNotify(text);
            return false;
        }
        $('#table-export-excel-template thead').html($('#'+element.attr('id')+'_wrapper').find('.dataTables_scrollHeadInner').find('thead').html());
        $('#table-export-excel-template tbody tr').remove();
        let length_table = element.find('thead tr:eq(0) th').length;
        await data_table.rows().every(function (index, element) {
            let data_body = '';
            let row = $(this.node());
            for (let i = 0; i < length_table; i++) {
                data_body = data_body + '<td class="text-center" rowspan="1" colspan="1">' + row.find('td:eq(' + i + ')').text() + '</td>';
            }
            $('#table-export-excel-template tbody').append('<tr role="row" style="height:30px">' + data_body + '</tr>');
        });
        exportExcelFileTemplate(name);
    } catch (e) {
        console.log('Error export Excel: ' + e);
    }
}

/**
 * export Excel from data table
 * @param name
 */
function exportExcelFileTemplate(name) {
    try {
        let branch = $('.select-branch').val().toLocaleUpperCase();
        let htmls = "";
        let uri = 'data:application/vnd.ms-Excel;base64,';
        let template = '<html xmlns:o="urn:schemas-Microsoft-com:office:office" xmlns:x="urn:schemas-Microsoft-com:office:Excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>';
        let base64 = function (s) {
            return window.btoa(unescape(encodeURIComponent(s)))
        };
        let format = function (s, c) {
            return s.replace(/{(\w+)}/g, function (m, p) {
                return c[p];
            })
        };
        htmls = $('#table-export-excel-template').html();
        let ctx = {
            worksheet: name,
            table: htmls
        };
        let link = document.createElement("a");
        link.download = name + ' chi nhánh-' + branch + ', thương hiệu-' + $('#select-brand').val() + ".xls";
        link.href = uri + base64(format(template, ctx));
        link.click();
    } catch (e) {
        console.log('Error export Excel: ' + e);
    }
}

function exportExcelTableTemplate(element, name) {
    try {
        let htmls = "";
        let uri = 'data:application/vnd.ms-Excel;base64,';
        let template = '<html xmlns:o="urn:schemas-Microsoft-com:office:office" xmlns:x="urn:schemas-Microsoft-com:office:Excel" xmlns="http://www.w3.org/TR/REC-html40"><head>' +
                        '<!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>';
        let base64 = function (s) {
            return window.btoa(unescape(encodeURIComponent(s)))
        };
        let format = function (s, c) {
            return s.replace(/{(\w+)}/g, function (m, p) {
                return c[p];
            })
        };
        htmls = element.html();
        let ctx = {
            worksheet: name,
            table: htmls
        };
        let link = document.createElement("a");
        link.download = name + ".xls";
        link.href = uri + base64(format(template, ctx));
        link.click();
    } catch (e) {
        console.log('Error export Excel: ' + e);
    }
}
