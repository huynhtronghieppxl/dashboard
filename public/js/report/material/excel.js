let formType;
async function exportExcelReportMaterial() {
    await $('#tabs-form-material li').each(function () {
        if($(this).find('a').hasClass('active')){
            formType = $(this).find('a').attr('data-type');
        }
    });
    let dataTable = null;
    if( formType === '1'){
        dataTable = dataTableWarehouseMaterial;
    }else if (formType === '2'){
        dataTable = dataTableWarehouse;
    }else if (formType === '3'){
        dataTable = dataTableInternalWarehouse;
    }else{
        dataTable = dataTableOtherWarehouse;
    }
    try {
        let i = $('#table-material-material-report_wrapper').find('.dataTables_scrollBody').find('tbody tr .dataTables_empty').length;
        if (i === 1) {
            let text = $('#error-export-excel-template').text();
            ErrorNotify(text);
            return false;
        }
        $('#table-export-report-material tbody tr').remove();
        dataTable.rows().every(function (index, element) {
            let x = $(this.node());
            $('#table-material-material-report tbody').append('<tr>\n' +
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
        });

    } catch (e) {
        console.log('Error export Excel: ' + e);
    }
}

function ExportExcelMaterial() {
    let element = $('#table-export-report-material');
    let name = $('#title-detail-excel').text();
    exportExcelTableTemplate(element, name);
}

function closeModalExcel() {
    $('#modal-excel-report-material').modal('hide');
}
