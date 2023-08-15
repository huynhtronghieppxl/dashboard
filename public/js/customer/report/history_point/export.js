async function exportExcelHistoryPointReport() {
    $('#title-excel-history-point-report span').text();
    $('#table-export-history-point-report tbody').html('');
    if (dataExcelHistoryPointReport.length === 0) {
        WarningNotify('Dữ liệu rỗng !!!');
        return false;
    }
    for await(const [i, v] of dataExcelHistoryPointReport.entries()) {
        $('#table-export-history-point-report tbody').append(`<tr>
                <td style="text-align: center">${i + 1}</td>
                <td>${v.name}</td>
                <td style="text-align: center">${v.gender === '1' ? 'Nam' : 'Nữ'}</td>
                <td>${v.added_point_count}</td>
                <td>${formatNumber(v.added_point)}</td>
                <td>${formatNumber(v.subtracted_point_count)}</td>
                <td>${formatNumber(v.subtracted_point)}</td>`)
    }
    exportExcelTableTemplate($('#table-export-history-point-report'), $('#title-excel-history-point-report').text())
}
