let checkChangeCreateRequestExportWarehouse = 0,
    checkSaveCreateRequestExportWarehouse = 0,
    tableMaterialRequestExportWarehouse,
    exportCreateRequestWarehouse = $("#select-export-create-request-export-warehouse").val();

async function openCreateRequestExportWarehouse() {
    checkChangeCreateRequestExportWarehouse = 0;
    checkSaveCreateRequestExportWarehouse = 0;
    $("#modal-create-request-export-warehouse").modal("show");
    $("#select-export-create-request-export-warehouse").select2({
        dropdownParent: $("#modal-create-request-export-warehouse"),
    });
    shortcut.remove("F3");
    shortcut.add("F3", function () {
        $("#select-export-create-request-export-warehouse").select2("open");
    });
    registerShortcutCreateRequestOutInventoryManage();
    dateTimePickerTemplate($("#date-create-request-export-warehouse"),null,new Date());
    $("#select-export-create-request-export-warehouse").on("select2:select", async function () {
            if (tableMaterialRequestExportWarehouse.data().any()) {
                let title = "Đổi phiếu yêu cầu ?",
                    content ="Bạn đã chọn nguyên liệu, đổi phiếu yêu cầu sẽ làm mới danh sách nguyên liệu !",
                    icon = "question";
                sweetAlertComponent(title, content, icon).then(
                    async (result) => {
                        if (result.value) {
                            exportCreateRequestWarehouse =$(this).val();
                            $("#inventory-create-request-export-warehouse").text($("#select-export-create-request-export-warehouse option:selected").data("name"));
                            $("#inventory-target-create-request-export-warehouse").text($("#select-export-create-request-export-warehouse option:selected").data("export"));
                            dataMaterialRequestCreateRequestExportWarehouse();
                        } else {
                            $(this).val(exportCreateRequestWarehouse).trigger("change.select2");
                        }
                    }
                );
            } else {
                exportCreateRequestWarehouse = $(this).val();
                $("#inventory-create-request-export-warehouse").text($("#select-export-create-request-export-warehouse option:selected").data("name"));
                $("#inventory-target-create-request-export-warehouse").text($("#select-export-create-request-export-warehouse option:selected").data("export"));
                dataMaterialRequestCreateRequestExportWarehouse();
            }
        }
    );
    $(document).on("input", "#table-material-create-request-export-warehouse tbody input.quantity", async function () {
            let quantity = parseFloat(removeformatNumber($(this).val()));
            let price = parseFloat(removeformatNumber($(this).parents("tr").find(".price").text()));
            $(this).parents("td").find("label").text(quantity);
            $(this).parents("tr").find("label.total").text(formatNumber(checkDecimal(quantity * price)));
        }
    );
    $(document).on("focus", "input", function () {$(this).select();
    });
    $("#modal-create-request-export-warehouse select").on("change", function () {
            $("#modal-create-request-export-warehouse .btn-renew").removeClass("d-none");
        }
    );
    $("#date-create-request-export-warehouse").on("dp.change", function () {
        $("#modal-create-request-export-warehouse .btn-renew").removeClass("d-none");
    });
    $("#modal-create-request-export-warehouse textarea").on("input", function () {
            $( "#modal-create-request-export-warehouse .btn-renew").removeClass("d-none");
        }
    );
    $("#check-create-request-export-warehouse").on("input", function () {
        $("#modal-create-request-export-warehouse .btn-renew").removeClass("d-none");
    });
    $("#modal-detail-material-data").on("hidden.bs.modal", function () {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalCreateRequestOutInventoryManage();
        });
    });
    dataRequestCreateRequestOutInventoryManage();
    dataTableMaterialRequestExportWarehouse([]);
}

async function dataRequestCreateRequestOutInventoryManage() {
    let method = "get",
        url = "goods-purchase-warehouse.export-by-request",
        officeId = $(".select-total-warehouse").val(),
        params = { officeId: officeId },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $("#select-export-create-request-export-warehouse"),
    ]);
    $("#select-export-create-request-export-warehouse").html(res.data[0]);
}

function registerShortcutCreateRequestOutInventoryManage() {
    removeAllShortcuts();
    removeAllShortcuts();
    shortcut.add("ESC", function () {
        closeModalCreateRequestOutInventoryManage();
    });
    shortcut.add("F4", function () {
        saveModalCreateRequestOutInventoryManage();
    });
}

async function dataMaterialRequestCreateRequestExportWarehouse() {
    let method = "get",
        url = "goods-purchase-warehouse.data-export",
        id = $("#select-export-create-request-export-warehouse").val(),
        inventory = $("#select-export-create-request-export-warehouse option:selected").data("inventory"),
        brand = $(".select-total-warehouse").find(':selected').data('brand-id'),
        branch = $(".select-total-warehouse").val(),
        params = { id: id, brand: brand, branch: branch, inventory: inventory },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $("#table-material-create-request-export-warehouse tbody"),
    ]);
    dataTableMaterialRequestExportWarehouse(res.data[0].original.data);
}

function removeMaterialCreateRequestOutInventoryManage(r) {
    removeRowDatatableTemplate(tableMaterialRequestExportWarehouse, r, false);
}

async function dataTableMaterialRequestExportWarehouse(data) {
    let id = $("#table-material-create-request-export-warehouse"),
        fixed_left = 0,
        fixed_right = 0,
        columns = [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                class: "text-center",
                width: "5%",
            },
            { data: "name", name: "name" },
            {
                data: "system_last_quantity",
                name: "system_last_quantity",
                className: "text-center",
            },
            {
                data: "quantity_request",
                name: "quantity_request",
                className: "text-center",
            },
            { data: "quantity", name: "quantity", className: "text-center" },
            {
                data: "action",
                name: "action",
                className: "text-center",
                width: "5%",
            },
            {
                data: "keysearch",
                name: "keysearch",
                className: "text-center d-none",
            },
        ];
    tableMaterialRequestExportWarehouse = await DatatableTemplateNew(
        id,
        data,
        columns,
        vh_of_table,
        fixed_left,
        fixed_right
    );
}

async function saveModalCreateRequestExportWarehouse() {
    if (checkSaveCreateRequestExportWarehouse === 1) return false;
    if (!checkValidateSave($("#modal-create-request-export-warehouse")))
        return false;
    let TableData = [];
    await tableMaterialRequestExportWarehouse.rows().every(function () {
        let row = $(this.node());
        if (removeformatNumber(row.find("td:eq(4)").find("input").val()) >= 0) {
            TableData.push({
                material_id: row.find("td:eq(5)").find("button").data("id"),
                user_input_quantity: removeformatNumber(
                    row.find("td:eq(4)").find("input").val()
                ),
                user_input_unit_type: 1,
                note: "",
                sort: 1,
            });
        }
    });
    if (TableData.length === 0) {
        WarningNotify("Vui lòng chọn phiếu yêu cầu từ kho chi nhánh!");
        return false;
    }
    let note = $("#note-create-request-export-warehouse").val(),
        is_complete_export = Number($("#check-create-request-export-warehouse").is(":checked")),
        officeId = $(".select-total-warehouse").val(),
        branch = $(".select-branch").val(),
        delivery_date = $("#date-create-request-export-warehouse").val(),
        export_type = $("#select-export-create-request-export-warehouse option:selected").data("id"),
        request_id = $("#select-export-create-request-export-warehouse option:selected").val(),
        inventory = $("#select-export-create-request-export-warehouse option:selected").data("inventory");
    checkSaveCreateRequestExportWarehouse = 1;
    let method = "post",
        url = "goods-purchase-warehouse.create-by-request",
        params = null,
        data = {
            material: TableData,
            note: note,
            delivery_date: delivery_date,
            branch: branch,
            inventory: inventory,
            export_type: export_type,
            request_id: request_id,
            is_complete_export: is_complete_export,
        };
    let res = await axiosTemplate(method, url, params, data, [
        $("#loading-create-request-export-warehouse"),
    ]);
    checkSaveCreateRequestExportWarehouse = 0;
    let text = $("#success-create-data-to-server").text();
    switch (res.data.status) {
        case 200:
            SuccessNotify(text);
            closeModalCreateRequestOutInventoryManage();
            loadingData();
            break;
        case 500:
            text = $("#error-post-data-to-server").text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            ErrorNotify(text);
            break;
        default:
            text = $("#error-post-data-to-server").text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            WarningNotify(text);
    }
}

function cancelShortcutCreateRequestExportWarehouse() {
    removeAllShortcuts();
    shortcut.add("F1", function () {
        let check = $("#styleSelector").hasClass("open");
        if (check === true) {
            $("#styleSelector").removeClass("open");
        } else {
            $("#styleSelector").addClass("open");
        }
    });
    shortcut.add("F2", function () {
        openCreateRequestOutInventoryManage();
    });
    shortcut.add("F5", function () {
        loadData();
    });
}

function closeModalCreateRequestExportWarehouse() {
    cancelShortcutCreateRequestExportWarehouse();
    resetDataCreateRequestExportWarehouse();
    $("#modal-create-request-export-warehouse").modal("hide");
    removeAllValidate();
    countCharacterTextarea();
}

function resetDataCreateRequestExportWarehouse() {
    $("#check-create-request-export-warehouse").prop("checked", false);
    tableMaterialRequestExportWarehouse.clear().draw(false);
    $("#select-export-create-request-export-warehouse").val(null).trigger("change.select2");
    // $("#select-branch-create-out-inventory-manage").find($("#change_branch").val()).trigger("change.select2");
    $("#select-inventory-target-create-request-export-warehouse").find("option:first").trigger("change.select2");
    $("#date-create-request-export-warehouse").val(moment().format("DD/MM/YYYY"));
    $("#total-record-create-request-export-warehouse").text("0");
    $("#total-sum-price-create-request-export-warehouse").text("0");
    $("#inventory-create-request-export-warehouse").text("---");
    $("#inventory-target-create-request-export-warehouse").text("---");
    $("#note-create-request-export-warehouse").val("");
    $("#modal-create-request-export-warehouse .btn-renew").addClass( "d-none");
    countCharacterTextarea();
}
