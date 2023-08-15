let InventoryMaterial, InventoryGoods, InventoryInternal, InventoryOther,
    // typeChangeInventory = 1,
    tabChangeInventory = 1,
    // selectFromMaterial = "", selectToMaterial = "", selectFromGood = "", selectToGood = "", selectFromInternal = "", selectToInternal = "", selectFromOther = "", selectToOther = "",
    dataCookie, tableInventoryReport;
$(async function () {
    $('.search-btn-inventory-report').on('click', async function () {
        // selectFromMaterial = $('#select-material-from-inventory-report').val();
        // selectToMaterial = $('#select-material-to-inventory-report').val();
        // selectFromGood = $('#select-good-from-inventory-report').val();
        // selectToGood = $('#select-good-to-inventory-report').val();
        // selectFromInternal = $('#select-internal-from-inventory-report').val();
        // selectToInternal = $('#select-internal-from-inventory-report').val();
        // selectFromOther = $('#select-other-from-inventory-report').val();
        // selectToOther = $('#select-other-from-inventory-report').val();
        let from, to;
        switch (Number(tabChangeInventory)) {
            case 1:
                from = $('#select-material-from-inventory-report').val();
                to = $('#select-material-to-inventory-report').val();
                loadDataMaterial($('#table-material-inventory-report'), tabChangeInventory, from, to);
                break;
            case 2:
                from = $('#select-good-from-inventory-report').val();
                to = $('#select-good-to-inventory-report').val();
                loadDataMaterial($('#table-goods-inventory-report'), tabChangeInventory, from, to);
                break;
            case 3:
                from = $('#select-internal-from-inventory-report').val();
                to = $('#select-internal-to-inventory-report').val();
                loadDataMaterial($('#table-internal-inventory-report'), tabChangeInventory, from, to);
                break;
            default:
                from = $('#select-other-from-inventory-report').val();
                to = $('#select-other-to-inventory-report').val();
                loadDataMaterial($('#table-other-inventory-report'), tabChangeInventory, from, to);
        }
        // updateCookieInventoryData()
    });
    // $('#select-material-from-inventory-report').val(selectFromMaterial);
    // $('#select-material-to-inventory-report').val(selectToMaterial);
    // $('#select-good-from-inventory-report').val(selectFromGood);
    // $('#select-good-to-inventory-report').val(selectToGood);
    // $('#select-internal-from-inventory-report').val(selectFromInternal);
    // $('#select-internal-to-inventory-report').val(selectToInternal);
    // $('#select-other-from-inventory-report').val(selectFromOther);
    // $('#select-other-to-inventory-report').val(selectToOther);

    $('#tabs-form-inventory .nav-link').on('click', function () {
        let from, to;
        tabChangeInventory = $(this).attr('data-type');
        switch (Number(tabChangeInventory)) {
            case 1:
                from = $('#select-material-from-inventory-report').val();
                to = $('#select-material-to-inventory-report').val();
                loadDataMaterial($('#table-material-inventory-report'), tabChangeInventory, from, to);
                break;
            case 2:
                from = $('#select-good-from-inventory-report').val();
                to = $('#select-good-to-inventory-report').val();
                loadDataMaterial($('#table-goods-inventory-report'), tabChangeInventory, from, to);
                break;
            case 3:
                from = $('#select-internal-from-inventory-report').val();
                to = $('#select-internal-to-inventory-report').val();
                loadDataMaterial($('#table-internal-inventory-report'), tabChangeInventory, from, to);
                break;
            default:
                from = $('#select-other-from-inventory-report').val();
                to = $('#select-other-to-inventory-report').val();
                loadDataMaterial($('#table-other-inventory-report'), tabChangeInventory, from, to);
        }
        // updateCookieInventoryData();
    })

    // if(getCookieShared('inventory-report-user-id-' + idSession)){
    //     dataCookie = JSON.parse(getCookieShared('inventory-report-user-id-' + idSession));
    //     tabChangeInventory = dataCookie.tab;
    //     // selectFromMaterial = dataCookie.fromMaterial;
    //     // selectToMaterial = dataCookie.toMaterial;
    //     // selectFromGood = dataCookie.fromGood;
    //     // selectToGood = dataCookie.toGood;
    //     // selectFromInternal = dataCookie.fromInternal;
    //     // selectToInternal = dataCookie.toInternal;
    //     // selectFromOther = dataCookie.fromOther;
    //     // selectToOther = dataCookie.toOther;
    //     // typeChangeInventory = dataCookie.type;
    //     // dataInventory();
    // }else{
    //     loadData()
    // }

    $(document).on('input paste keyup keydown', '#table-internal-inventory-report_filter, #table-material-inventory-report_filter, #table-goods-inventory-report_filter, #table-other-inventory-report_filter', async function () {
        let totalOpening = 0, totalOpeningQuantity = 0, totalReceiveQuantity = 0, totalReceive = 0, totalExport = 0, totalExportQuantity = 0,
            totalReturn = 0, totalReturnQuantity = 0, totalCancel = 0, totalCancelQuantity = 0,
            totalWastageAllow = 0, totalWastageAllowQuantity = 0, totalLast = 0, totalLastQuantity = 0,
            totalConfirmLast = 0, totalConfirmLastQuantity = 0, totalDifferenceQuantity = 0 , totalDifference = 0;
        await tableInventoryReport.rows({'search': 'applied'}).every(function () {
            let row = $(this.node());
            totalOpening += removeformatNumber(row.find('td:eq(3)').find('label:first-child').text());
            totalOpeningQuantity += removeformatNumber(row.find('td:eq(3)').find('label:last-child').text());
            totalReceive += removeformatNumber(row.find('td:eq(4)').find('label:first-child').text());
            totalReceiveQuantity += removeformatNumber(row.find('td:eq(4)').find('label:last-child').text());
            totalExport += removeformatNumber(row.find('td:eq(5)').find('label:first-child').text());
            totalExportQuantity += removeformatNumber(row.find('td:eq(5)').find('label:last-child').text());
            totalReturn += removeformatNumber(row.find('td:eq(6)').find('label:first-child').text());
            totalReturnQuantity += removeformatNumber(row.find('td:eq(6)').find('label:last-child').text());
            totalCancel += removeformatNumber(row.find('td:eq(7)').find('label:first-child').text());
            totalCancelQuantity += removeformatNumber(row.find('td:eq(7)').find('label:last-child').text());
            totalLast += removeformatNumber(row.find('td:eq(8)').find('label:first-child').text());
            totalLastQuantity += removeformatNumber(row.find('td:eq(8)').find('label:last-child').text());
            totalConfirmLast += removeformatNumber(row.find('td:eq(9)').find('label:first-child').text());
            totalConfirmLastQuantity += removeformatNumber(row.find('td:eq(9)').find('label:last-child').text());
            totalDifference += removeformatNumber(row.find('td:eq(10)').find('label:first-child').text());
            totalDifferenceQuantity += removeformatNumber(row.find('td:eq(10)').find('label:last-child').text());
        })
        switch (Number(tabChangeInventory)){
            case 1:
                $('#total-amount-open-material').text(formatNumber(totalOpening))
                $('#total-quantity-open-material').html('<em>Số lượng : </em>' + formatNumber(totalOpeningQuantity))
                $('#total-amount-import-material').text(formatNumber(totalReceive))
                $('#total-quantity-import-material').html('<em>Số lượng : </em>' + formatNumber(totalReceiveQuantity))
                $('#total-amount-export-material').text(formatNumber(totalExport))
                $('#total-quantity-export-material').html('<em>Số lượng : </em>' + formatNumber(totalExportQuantity))
                $('#total-amount-return-material').text(formatNumber(totalReturn))
                $('#total-quantity-return-material').html('<em>Số lượng : </em>' + formatNumber(totalReturnQuantity))
                $('#total-amount-cancel-material').text(formatNumber(totalCancel))
                $('#total-quantity-cancel-material').html('<em>Số lượng : </em>' + formatNumber(totalCancelQuantity))
                $('#total-amount-after-material').text(formatNumber(totalLast))
                $('#total-quantity-after-material').html('<em>Số lượng : </em>' + formatNumber(totalLastQuantity))
                $('#total-amount-check-material').text(formatNumber(totalConfirmLast))
                $('#total-quantity-check-material').html('<em>Số lượng : </em>' + formatNumber(totalConfirmLastQuantity))
                $('#total-amount-diff-material').text(formatNumber(totalDifference))
                $('#total-quantity-diff-material').html('<em>Số lượng : </em>' + formatNumber(totalDifferenceQuantity))
            case 2:
                $('#total-amount-open-goods').text(formatNumber(totalOpening))
                $('#total-quantity-open-goods').html('<em>Số lượng : </em>' + formatNumber(totalOpeningQuantity))
                $('#total-amount-import-goods').text(formatNumber(totalReceive))
                $('#total-quantity-import-goods').html('<em>Số lượng : </em>' + formatNumber(totalReceiveQuantity))
                $('#total-amount-export-goods').text(formatNumber(totalExport))
                $('#total-quantity-export-goods').html('<em>Số lượng : </em>' + formatNumber(totalExportQuantity))
                $('#total-amount-return-goods').text(formatNumber(totalReturn))
                $('#total-quantity-return-goods').html('<em>Số lượng : </em>' + formatNumber(totalReturnQuantity))
                $('#total-amount-cancel-goods').text(formatNumber(totalCancel))
                $('#total-quantity-cancel-goods').html('<em>Số lượng : </em>' + formatNumber(totalCancelQuantity))
                $('#total-amount-after-goods').text(formatNumber(totalLast))
                $('#total-quantity-after-goods').html('<em>Số lượng : </em>' +formatNumber(totalLastQuantity))
                $('#total-amount-check-goods').text(formatNumber(totalConfirmLast))
                $('#total-quantity-check-goods').html('<em>Số lượng : </em>' +formatNumber(totalConfirmLastQuantity))
                $('#total-amount-diff-goods').text(formatNumber(totalDifference))
                $('#total-quantity-diff-goods').html('<em>Số lượng : </em>' +formatNumber(totalDifferenceQuantity))
            case 3:
                $('#total-amount-open-internal').text(formatNumber(totalOpening))
                $('#total-quantity-open-internal').html('<em>Số lượng : </em>' + formatNumber(totalOpeningQuantity))
                $('#total-amount-import-internal').text(formatNumber(totalReceive))
                $('#total-quantity-import-internal').html('<em>Số lượng : </em>' + formatNumber(totalReceiveQuantity))
                $('#total-amount-export-internal').text(formatNumber(totalExport))
                $('#total-quantity-export-internal').html('<em>Số lượng : </em>' + formatNumber(totalExportQuantity))
                $('#total-amount-return-internal').text(formatNumber(totalReturn))
                $('#total-quantity-return-internal').html('<em>Số lượng : </em>' + formatNumber(totalReturnQuantity))
                $('#total-amount-cancel-internal').text(formatNumber(totalCancel))
                $('#total-quantity-cancel-internal').html('<em>Số lượng : </em>' + formatNumber(totalCancelQuantity))
                $('#total-amount-after-internal').text(formatNumber(totalLast))
                $('#total-quantity-after-internal').html('<em>Số lượng : </em>' + formatNumber(totalLastQuantity))
                $('#total-amount-check-internal').text(formatNumber(totalConfirmLast))
                $('#total-quantity-check-internal').html('<em>Số lượng : </em>' + formatNumber(totalConfirmLastQuantity))
                $('#total-amount-diff-internal').text(formatNumber(totalDifference))
                $('#total-quantity-diff-internal').html('<em>Số lượng : </em>' + formatNumber(totalDifferenceQuantity))
            case 12:
                $('#total-amount-open-other').text(formatNumber(totalOpening))
                $('#total-quantity-open-other').html('<em>Số lượng : </em>' + formatNumber(totalOpeningQuantity))
                $('#total-amount-import-other').text(formatNumber(totalReceive))
                $('#total-quantity-import-other').html('<em>Số lượng : </em>' + formatNumber(totalReceiveQuantity))
                $('#total-amount-export-other').text(formatNumber(totalExport))
                $('#total-quantity-export-other').html('<em>Số lượng : </em>' + formatNumber(totalExportQuantity))
                $('#total-amount-return-other').text(formatNumber(totalReturn))
                $('#total-quantity-return-other').html('<em>Số lượng : </em>' + formatNumber(totalReturnQuantity))
                $('#total-amount-cancel-other').text(formatNumber(totalCancel))
                $('#total-quantity-cancel-other').html('<em>Số lượng : </em>' + formatNumber(totalCancelQuantity))
                $('#total-amount-after-other').text(formatNumber(totalLast))
                $('#total-quantity-after-other').html('<em>Số lượng : </em>' + formatNumber(totalLastQuantity))
                $('#total-amount-check-other').text(formatNumber(totalConfirmLast))
                $('#total-quantity-check-other').html('<em>Số lượng : </em>' + formatNumber(totalConfirmLastQuantity))
                $('#total-amount-diff-other').text(formatNumber(totalDifference))
                $('#total-quantity-diff-other').html('<em>Số lượng : </em>' + formatNumber(totalDifferenceQuantity))
        }
    })
    // $('#tabs-form-inventory a[data-type="'+ tabChangeInventory +'"]').click();
    if(!($('.select-branch').val())) {
        await updateSessionBrandNew($('.select-brand'));
    }else {
        loadData();
    }
});

// function updateCookieInventoryData(){
//     saveCookieShared('inventory-report-user-id-' + idSession, JSON.stringify({
//         'tab' : tabChangeInventory,
//         // 'fromMaterial' : selectFromMaterial,
//         // 'toMaterial' : selectToMaterial,
//         // 'fromGood' : selectFromGood,
//         // 'toGood' : selectToGood,
//         // 'fromInternal' : selectFromInternal,
//         // 'toInternal' : selectToInternal,
//         // 'fromOther' : selectFromOther,
//         // 'toOther' : selectToOther,
//         // 'type' : typeChangeInventory,
//     }))
// }

async function loadData() {
    await dataInventory();
    switch (Number(tabChangeInventory)) {
        case 1 :
            loadDataMaterial($('#table-material-inventory-report'), tabChangeInventory, $('#select-material-from-inventory-report').val(), $('#select-material-to-inventory-report').val())
            break;
        case 2 :
            loadDataMaterial($('#table-goods-inventory-report'), tabChangeInventory, $('#select-good-from-inventory-report').val(), $('#select-good-to-inventory-report').val())
            break;
        case 3 :
            loadDataMaterial($('#table-internal-inventory-report'), tabChangeInventory, $('#select-internal-from-inventory-report').val(), $('#select-internal-to-inventory-report').val())
            break;
        default:
            loadDataMaterial($('#table-other-inventory-report'), tabChangeInventory, $('#select-other-from-inventory-report').val(), $('#select-other-to-inventory-report').val())
    }
}

async function dataInventory() {
    let branch = $(".select-branch").val(),
        method = 'get',
        url = 'inventory-report.inventory',
        params = {
            branch: branch,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data,[
        $("#table-material-inventory-report"),
        $("#table-goods-inventory-report"),
        $("#table-internal-inventory-report"),
        $("#table-other-inventory-report"),
        $("#select-material-from-inventory-report"),
        $("#select-material-to-inventory-report"),
    ]);
    InventoryMaterial = res.data[0];
    InventoryGoods = res.data[1];
    InventoryInternal = res.data[2];
    InventoryOther = res.data[3];
    $("#select-material-from-inventory-report").html(InventoryMaterial)
    $("#select-material-to-inventory-report").html(InventoryMaterial)
    $("#select-good-from-inventory-report").html(InventoryGoods)
    $("#select-good-to-inventory-report").html(InventoryGoods)
    $("#select-internal-from-inventory-report").html(InventoryInternal)
    $("#select-internal-to-inventory-report").html(InventoryInternal)
    $("#select-other-from-inventory-report").html(InventoryOther)
    $("#select-other-to-inventory-report").html(InventoryOther)

    // await $('#select-material-from-inventory-report').html(res.data[0]);
    // await $('#select-material-to-inventory-report').html(res.data[0]);
    //
    // checkHasInSelect(selectFromMaterial, $('#select-material-from-inventory-report'))
    // checkHasInSelect(selectToMaterial, $('#select-material-to-inventory-report'))
    //
    // await $('#select-good-from-inventory-report').html(res.data[1]);
    // await $('#select-good-to-inventory-report').html(res.data[1]);
    //
    //
    // checkHasInSelect(selectFromGood, $('#select-good-from-inventory-report'))
    // checkHasInSelect(selectToGood, $('#select-good-to-inventory-report'))
    //
    //
    // await $('#select-internal-from-inventory-report').html(res.data[2]);
    // await $('#select-internal-to-inventory-report').html(res.data[2]);
    //
    // checkHasInSelect(selectFromInternal, $('#select-internal-from-inventory-report'))
    // checkHasInSelect(selectToInternal, $('#select-internal-to-inventory-report'))
    //
    // await $('#select-other-from-inventory-report').html(res.data[3]);
    // await $('#select-other-to-inventory-report').html(res.data[3]);
    //
    // checkHasInSelect(selectFromOther, $('#select-other-from-inventory-report'))
    // checkHasInSelect(selectToOther, $('#select-other-to-inventory-report'))
    //
    //
    // $('#tabs-form-inventory .nav-link[href="' + tabChangeInventory + '"]').click()
}

async function loadDataMaterial(id, inventory, from, to) {
    console.log(+from, +to)
    if(+to < +from) {
        WarningNotify('Vui lòng chọn khoảng kiểm kê với ngày bắt đầu nhỏ hơn ngày kết khúc!');
        return false;
    }
    // switch (tabChangeInventory) {
    //     case '#tab1-inventory-report':
    //         from = selectFromMaterial
    //         to = selectToMaterial
    //         break;
    //     case '#tab2-inventory-report':
    //         from = selectFromGood
    //         to = selectToGood
    //         break;
    //     case '#tab3-inventory-report':
    //         from = selectFromInternal
    //         to = selectToInternal
    //         break;
    //     case '#tab4-inventory-report':
    //         from = selectFromOther
    //         to = selectToOther
    //         break;
    // }
    let branch = $('.select-branch').val(),
        method = 'get',
        url = 'inventory-report.data',
        params = {
            branch: branch,
            inventory: inventory,
            from: from,
            to: to,
        },
        data = null;
    if (from === '' || to === '') {
        dataTableMaterialReport(id, []);
    } else {
        let res = await axiosTemplate(method, url, params, data, [$('#table-material-inventory-report_wrapper')]);
         dataTableMaterialReport(id, res.data[0].original.data);
        dataExcelWarehouseInternalReport = res.data[2].data;
        switch (Number(tabChangeInventory)) {
            case 1:
                $('#total-record-material').text(res.data[1].record);
                $('#total-quantity-before-material').html('<em>Số lượng : </em>' + res.data[1].opening_quantity);
                $('#total-amount-open-material').html(res.data[1].opening_amount);
                $('#total-quantity-import-material').html('<em>Số lượng : </em>' +  res.data[1].total_receive_quantity);
                $('#total-amount-import-material').html(res.data[1].total_receive_amount);
                $('#total-quantity-export-material').html('<em>Số lượng : </em>' +  res.data[1].total_export_quantity);
                $('#total-amount-export-material').html(res.data[1].total_export_amount);
                $('#total-quantity-return-material').html('<em>Số lượng : </em>' +  res.data[1].total_return_quantity);
                $('#total-amount-return-material').html(res.data[1].total_return_amount);
                $('#total-quantity-cancel-material').html('<em>Số lượng : </em>' +  res.data[1].total_cancel_quantity);
                $('#total-amount-cancel-material').html(res.data[1].total_cancel_amount);
                $('#total-quantity-wastage-material').html('<em>Số lượng : </em>' + res.data[1].wastage_allow_quantity);
                $('#total-amount-wastage-material').html(res.data[1].wastage_allow_amount);
                $('#total-quantity-after-material').html('<em>Số lượng : </em>' + res.data[1].system_last_quantity);
                $('#total-amount-after-material').html(res.data[1].system_last_amount);
                $('#total-quantity-check-material').html('<em>Số lượng : </em>' + res.data[1].confirm_last_quantity);
                $('#total-amount-check-material').html(res.data[1].confirm_last_amount);
                $('#total-quantity-diff-material').html('<em>Số lượng : </em>' + res.data[1].difference_quantity);
                $('#total-amount-diff-material').html(res.data[1].difference_amount);
                break;
            case 2:
                $('#total-record-goods').html(res.data[1].record);
                // $('#total-quantity-before-goods').html('<em>Số lượng : </em>' + res.data[1].opening_quantity);
                $('#total-quantity-open-goods').html('<em>Số lượng : </em>' + res.data[1].opening_quantity);
                $('#total-amount-open-goods').html(res.data[1].opening_amount);
                $('#total-quantity-import-goods').html('<em>Số lượng : </em>' + res.data[1].total_receive_quantity);
                $('#total-amount-import-goods').html(res.data[1].total_receive_amount);
                $('#total-quantity-export-goods').html('<em>Số lượng : </em>' + res.data[1].total_export_quantity);
                $('#total-amount-export-goods').html(res.data[1].total_export_amount);
                $('#total-quantity-return-goods').html('<em>Số lượng : </em>' + res.data[1].total_return_quantity);
                $('#total-amount-return-goods').html(res.data[1].total_return_amount);
                $('#total-quantity-cancel-goods').html('<em>Số lượng : </em>' + res.data[1].total_cancel_quantity);
                $('#total-amount-cancel-goods').html(res.data[1].total_cancel_amount);
                $('#total-quantity-wastage-goods').html('<em>Số lượng : </em>' + res.data[1].wastage_allow_quantity);
                $('#total-amount-wastage-goods').html(res.data[1].wastage_allow_amount);
                $('#total-quantity-after-goods').html('<em>Số lượng : </em>' + res.data[1].system_last_quantity);
                $('#total-amount-after-goods').html(res.data[1].system_last_amount);
                $('#total-quantity-check-goods').html('<em>Số lượng : </em>' + res.data[1].confirm_last_quantity);
                $('#total-amount-check-goods').html(res.data[1].confirm_last_amount);
                $('#total-quantity-diff-goods').html('<em>Số lượng : </em>' + res.data[1].difference_quantity);
                $('#total-amount-diff-goods').html(res.data[1].difference_amount);
                break;
            case 3:
                $('#total-record-internal').html(res.data[1].record);
                // $('#total-quantity-before-internal').html('<em>Số lượng : </em>' + res.data[1].opening_quantity);
                $('#total-quantity-open-internal').html('<em>Số lượng : </em>' + res.data[1].opening_quantity);
                $('#total-amount-open-internal').html(res.data[1].opening_amount);
                $('#total-quantity-import-internal').html('<em>Số lượng : </em>' + res.data[1].total_receive_quantity);
                $('#total-amount-import-internal').html(res.data[1].total_receive_amount);
                $('#total-quantity-export-internal').html('<em>Số lượng : </em>' + res.data[1].total_export_quantity);
                $('#total-amount-export-internal').html(res.data[1].total_export_amount);
                $('#total-quantity-return-internal').html('<em>Số lượng : </em>' + res.data[1].total_return_quantity);
                $('#total-amount-return-internal').html(res.data[1].total_return_amount);
                $('#total-quantity-cancel-internal').html('<em>Số lượng : </em>' + res.data[1].total_cancel_quantity);
                $('#total-amount-cancel-internal').html(res.data[1].total_cancel_amount);
                $('#total-quantity-wastage-internal').html('<em>Số lượng : </em>' + res.data[1].wastage_allow_quantity );
                $('#total-amount-wastage-internal').html(res.data[1].wastage_allow_amount);
                $('#total-quantity-after-internal').html('<em>Số lượng : </em>' + res.data[1].system_last_quantity);
                $('#total-amount-after-internal').html(res.data[1].system_last_amount);
                $('#total-quantity-check-internal').html('<em>Số lượng : </em>' + res.data[1].confirm_last_quantity);
                $('#total-amount-check-internal').html(res.data[1].confirm_last_amount);
                $('#total-quantity-diff-internal').html('<em>Số lượng : </em>' + res.data[1].difference_quantity);
                $('#total-amount-diff-internal').html(res.data[1].difference_amount);
                break;
            case 12:
                $('#total-record-other').html(res.data[1].record);
                // $('#total-quantity-before-other').html('<em>Số lượng : </em>' + res.data[1].opening_quantity);
                $('#total-quantity-open-other').html('<em>Số lượng : </em>' + res.data[1].opening_quantity);
                $('#total-amount-open-other').html(res.data[1].opening_amount);
                $('#total-quantity-import-other').html('<em>Số lượng : </em>' + res.data[1].total_receive_quantity);
                $('#total-amount-import-other').html(res.data[1].total_receive_amount);
                $('#total-quantity-export-other').html('<em>Số lượng : </em>' + res.data[1].total_export_quantity);
                $('#total-amount-export-other').html(res.data[1].total_export_amount);
                $('#total-quantity-return-other').html('<em>Số lượng : </em>' + res.data[1].total_return_quantity);
                $('#total-amount-return-other').html(res.data[1].total_return_amount);
                $('#total-quantity-cancel-other').html('<em>Số lượng : </em>' + res.data[1].total_cancel_quantity);
                $('#total-amount-cancel-other').html(res.data[1].total_cancel_amount);
                $('#total-quantity-wastage-other').html('<em>Số lượng : </em>' + res.data[1].wastage_allow_quantity);
                $('#total-amount-wastage-other').html( +res.data[1].wastage_allow_amount );
                $('#total-quantity-after-other').html('<em>Số lượng : </em>' +res.data[1].system_last_quantity);
                $('#total-amount-after-other').html(res.data[1].system_last_amount);
                $('#total-quantity-check-other').html('<em>Số lượng : </em>' +res.data[1].confirm_last_quantity);
                $('#total-amount-check-other').html(res.data[1].confirm_last_amount);
                $('#total-quantity-diff-other').html('<em>Số lượng : </em>' +res.data[1].difference_quantity);
                $('#total-amount-diff-other').html(res.data[1].difference_amount);
                break;
        }
        // Material
        totalInventoryMaterialOpenAmount = res.data[1].opening_amount;
        totalInventoryMaterialImportAmount = res.data[1].total_receive_amount;
        totalInventoryMaterialExportAmount = res.data[1].total_export_amount;
        totalInventoryMaterialReturnAmount = res.data[1].total_return_amount;
        totalInventoryMaterialCancelAmount = res.data[1].total_cancel_amount;
        totalInventoryMaterialAfterAmount = res.data[1].system_last_amount;
        totalInventoryMaterialCheckAmount = res.data[1].confirm_last_amount;
        totalInventoryMaterialDiffAmount = res.data[1].difference_amount;

        totalInventoryMaterialOpenQuantity = res.data[1].opening_quantity;
        totalInventoryMaterialImportQuantity = res.data[1].total_receive_quantity;
        totalInventoryMaterialExportQuantity = res.data[1].total_export_quantity;
        totalInventoryMaterialReturnQuantity = res.data[1].total_return_quantity;
        totalInventoryMaterialCancelQuantity = res.data[1].total_cancel_quantity;
        totalInventoryMaterialAfterQuantity = res.data[1].system_last_quantity;
        totalInventoryMaterialCheckQuantity = res.data[1].confirm_last_quantity;
        totalInventoryMaterialDiffQuantity = res.data[1].difference_quantity;
        // Goods
        totalInventoryGoodsOpenAmount = res.data[1].opening_amount;
        totalInventoryGoodsImportAmount = res.data[1].total_receive_amount;
        totalInventoryGoodsExportAmount = res.data[1].total_export_amount;
        totalInventoryGoodsReturnAmount = res.data[1].total_return_amount;
        totalInventoryGoodsCancelAmount = res.data[1].total_cancel_amount;
        totalInventoryGoodsAfterAmount = res.data[1].system_last_amount;
        totalInventoryGoodsCheckAmount = res.data[1].confirm_last_amount;
        totalInventoryGoodsDiffAmount = res.data[1].difference_amount;

        totalInventoryGoodsOpenQuantity = res.data[1].opening_quantity;
        totalInventoryGoodsImportQuantity = res.data[1].total_receive_quantity;
        totalInventoryGoodsExportQuantity = res.data[1].total_export_quantity;
        totalInventoryGoodsReturnQuantity = res.data[1].total_return_quantity;
        totalInventoryGoodsCancelQuantity = res.data[1].total_cancel_quantity;
        totalInventoryGoodsAfterQuantity = res.data[1].system_last_quantity;
        totalInventoryGoodsCheckQuantity = res.data[1].confirm_last_quantity;
        totalInventoryGoodsDiffQuantity = res.data[1].difference_quantity;
        // Internal
        totalInventoryInternalOpenAmount = res.data[1].opening_amount;
        totalInventoryInternalImportAmount = res.data[1].total_receive_amount;
        totalInventoryInternalExportAmount = res.data[1].total_export_amount;
        totalInventoryInternalReturnAmount = res.data[1].total_return_amount;
        totalInventoryInternalCancelAmount = res.data[1].total_cancel_amount;
        totalInventoryInternalAfterAmount = res.data[1].system_last_amount;
        totalInventoryInternalCheckAmount = res.data[1].confirm_last_amount;
        totalInventoryInternalDiffAmount = res.data[1].difference_amount;

        totalInventoryInternalOpenQuantity = res.data[1].opening_quantity;
        totalInventoryInternalImportQuantity = res.data[1].total_receive_quantity;
        totalInventoryInternalExportQuantity = res.data[1].total_export_quantity;
        totalInventoryInternalReturnQuantity = res.data[1].total_return_quantity;
        totalInventoryInternalCancelQuantity = res.data[1].total_cancel_quantity;
        totalInventoryInternalAfterQuantity = res.data[1].system_last_quantity;
        totalInventoryInternalCheckQuantity = res.data[1].confirm_last_quantity;
        totalInventoryInternalDiffQuantity = res.data[1].difference_quantity;
        // Other
        totalInventoryOtherOpenAmount = res.data[1].opening_amount;
        totalInventoryOtherImportAmount = res.data[1].total_receive_amount;
        totalInventoryOtherExportAmount = res.data[1].total_export_amount;
        totalInventoryOtherReturnAmount = res.data[1].total_return_amount;
        totalInventoryOtherCancelAmount = res.data[1].total_cancel_amount;
        totalInventoryOtherAfterAmount = res.data[1].system_last_amount;
        totalInventoryOtherCheckAmount = res.data[1].confirm_last_amount;
        totalInventoryOtherDiffAmount = res.data[1].difference_amount;

        totalInventoryOtherOpenQuantity = res.data[1].opening_quantity;
        totalInventoryOtherImportQuantity = res.data[1].total_receive_quantity;
        totalInventoryOtherExportQuantity = res.data[1].total_export_quantity;
        totalInventoryOtherReturnQuantity = res.data[1].total_return_quantity;
        totalInventoryOtherCancelQuantity = res.data[1].total_cancel_quantity;
        totalInventoryOtherAfterQuantity = res.data[1].system_last_quantity;
        totalInventoryOtherCheckQuantity = res.data[1].confirm_last_quantity;
        totalInventoryOtherDiffQuantity = res.data[1].difference_quantity;
    }
}

async function dataTableMaterialReport(id, data) {
    let fixed_left = 2,
        fixed_right = 0,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-left', width: '10%'},
            // {data: 'material_unit_full_name', name: 'material_unit_full_name', className: 'text-left'},
            {data: 'material_category_name', name: 'material_category_name', className: 'text-left', width: '5%'},
            {data: 'opening_amount', name: 'opening_amount', className: 'text-right'},
            {data: 'total_receive_amount', name: 'total_receive_amount', className: 'text-right'},
            {data: 'total_export_amount', name: 'total_export_amount', className: 'text-right'},
            {data: 'total_return_amount', name: 'total_return_amount', className: 'text-right'},
            {data: 'total_cancel_amount', name: 'total_cancel_amount', className: 'text-right'},
            // {data: 'wastage_allow_amount', name: 'wastage_allow_amount', className: 'text-right'},
            {data: 'system_last_amount', name: 'system_last_amount', className: 'text-right'},
            {data: 'confirm_last_amount', name: 'confirm_last_amount', className: 'text-right'},
            {data: 'difference_amount', name: 'difference_amount', className: 'text-right'},
            {data: 'keysearch', className: 'd-none'}
        ],
        option=[
            {
                'title': 'Xuất excel',
                'icon': 'fi-rr-print',
                'class': 'seemt-btn-hover-blue',
                'function': 'exportExcelInventoryReport',
            }
        ];
    tableInventoryReport = await DatatableTemplateNew(id, data, column, vh_of_table, fixed_left, fixed_right,option);
    $(document).on('input paste keyup keydown', 'input[type="search"]', async function () {
        switch (Number(tabChangeInventory)) {
            case 1 :
                $('#total-record-material').text(tableInventoryReport.rows({'search': 'applied'}).count())
                break;
            case 2 :
                $('#total-record-goods').text(tableInventoryReport.rows({'search': 'applied'}).count())
                break;
            case 3 :
                $('#total-record-internal').text(tableInventoryReport.rows({'search': 'applied'}).count())
                break;
            default:
                $('#total-record-other').text(tableInventoryReport.rows({'search': 'applied'}).count())
        }
    })
}
