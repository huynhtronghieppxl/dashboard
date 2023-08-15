function openModalDetailQuantitativeData(r) {
    $('#modal-calc-detail-quantitative-data').modal('show');
    $('#total-material-calc').text(r.parents('tr').find('td:eq(7)').text());
    $('#price-material-calc').text(formatNumber(r.parents('tr').find('td:eq(4)').find('label div:eq(0)').text()));
    $('#quatity-material-calc').text(r.parents('tr').find('td:eq(2) input').val());
    $('#percent-wastage-rate').text(r.parents('tr').find('td:eq(6) input').val() + '%');
    shortcut.add('ESC', function () {
        closeModalDetailQuantitativeData();
    });
}

function closeModalDetailQuantitativeData(r) {
    $('#modal-calc-detail-quantitative-data').modal('hide');
}
