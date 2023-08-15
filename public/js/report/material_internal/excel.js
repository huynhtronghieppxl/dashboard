async function exportExcelReportMaterial() {
    await $('#tabs-form-material li').each(function () {
        if($(this).find('a').hasClass('active')){
            form_type = $(this).find('a').attr('data-type');
        }
    });
    let data_table = null;
    if( form_type == '1'){
        data_table = data_table1;
    }else if (form_type == '2'){
        data_table = data_table2;
    }else if (form_type == '3'){
        data_table = data_table3;
    }else{
        data_table = data_table4;
    }

    try {
        let i = $('#table-material-material-report_wrapper').find('.dataTables_scrollBody').find('tbody tr .dataTables_empty').length;
        if (i === 1) {
            let text = $('#error-export-excel-template').text();
            ErrorNotify(text);
            return false;
        }
        $('#table_export_report_material tbody tr').remove();
        data_table.rows().every(function (index, element) {
            let x = $(this.node());
            $('#table_export_report_material tbody').append('<tr>\n' +
            '<td class="text-center"><label>' + x.find('td:eq(0)').html() + '</label></td>' +
            '<td class="text-center"><label>' + x.find('td:eq(1)').html() + '</label></td>' +
            '<td class="text-center"><label>' + x.find('td:eq(2)').html() + '</label></td>' +
            '<td class="text-center"><label>' + x.find('td:eq(3)').html() + '</label></td>' +
            '<td class="text-center"><label>' + x.find('td:eq(4)').html() + '</label></td>' +
            '<td class="text-center"><label>' + x.find('td:eq(5)').html() + '</label></td>' +
            '<td class="text-center"><label>' + x.find('td:eq(6)').html() + '</label></td>' +
            '<td class="text-center"><label>' + x.find('td:eq(7)').html() + '</label></td>' +
            '<td class="text-center"><label>' + x.find('td:eq(8)').html() + '</label></td>' +
            '<td class="text-center"><label>' + x.find('td:eq(9)').html() + '</label></td>' +
            '<td class="text-center"><label>' + x.find('td:eq(10)').html() + '</label></td>' +
            '<td class="text-center"><label>' + x.find('td:eq(11)').html() + '</label></td>' +
            '<td class="text-center"><label>' + x.find('td:eq(12)').html() + '</label></td>' +
            '<td class="text-center"><label>' + x.find('td:eq(13)').html() + '</label></td>' +
            '<td class="text-center"><label>' + x.find('td:eq(14)').html() + '</label></td>' +
            '<td class="text-center"><label>' + x.find('td:eq(15)').html() + '</label></td>' +
            '<td class="text-center"><label>' + x.find('td:eq(16)').html() + '</label></td>' +
            '<td class="text-center"><label>' + x.find('td:eq(17)').html() + '</label></td>' +
            '<td class="text-center"><label>' + x.find('td:eq(18)').html() + '</label></td>' +
            '<td class="text-center"><label>' + x.find('td:eq(19)').html() + '</label></td>' +
            '<td class="text-center"><label>' + x.find('td:eq(20)').html() + '</label></td>' +
            '<td class="text-center"><label>' + x.find('td:eq(21)').html() + '</label></td>' +
            '<td class="text-center"><label>' + x.find('td:eq(22)').html() + '</label></td>' +
            '<td class="text-center"><label>' + x.find('td:eq(23)').html() + '</label></td>' +
            '<td class="text-center"><label>' + x.find('td:eq(24)').html() + '</label></td>' +
            '<td class="text-center"><label>' + x.find('td:eq(25)').html() + '</label></td>' +
            '<td class="text-center"><label>' + x.find('td:eq(26)').html() + '</label></td>' +
            '<td class="text-center"><label>' + x.find('td:eq(27)').html() + '</label></td>' +
            '<td class="text-center"><label>' + x.find('td:eq(28)').html() + '</label></td>' +
            '<td class="text-center"><label>' + x.find('td:eq(29)').html() + '</label></td>' +
            '<td class="text-center"><label>' + x.find('td:eq(30)').html() + '</label></td>' +
            + '</tr>');
            $('#modal-excel-report-material').modal('show');
        });

    } catch (e) {
        console.log('Error export Excel: ' + e);
    }
}

function ExportExcelMaterial() {
    let element = $('#table_export_report_material');
    let name = $('#title-detail-excel').text();
    exportExcelTableTemplate(element, name);
}

function closeModalExcel() {
    $('#modal-excel-report-material').modal('hide');
}
