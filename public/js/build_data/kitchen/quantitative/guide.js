function modalGuidelQuantitativeData(r) {
    $('#modal-calc-guide-quantitative-data').modal('show');
    shortcut.add('ESC', function () {
        closeModalGuideQuantitativeData();
    });
}

function closeModalGuideQuantitativeData(r) {
    $('#modal-calc-guide-quantitative-data').modal('hide');
}
