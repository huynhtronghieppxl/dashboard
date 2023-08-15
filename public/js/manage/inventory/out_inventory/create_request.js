let checkChangeCreateRequestOutInventoryManage = 0,
    saveCreateRequestOutInventoryManage = 0,
    tableMaterialRequestOutInventory,
    exportCreateRequestOutInventoryManage = $(
        "#select-export-create-request-out-inventory-manage"
    ).val();

async function openCreateRequestOutInventoryManage() {
    checkChangeCreateRequestOutInventoryManage = 0;
    saveCreateRequestOutInventoryManage = 0;
    $("#modal-create-request-out-inventory-manage").modal("show");
    $("#select-export-create-request-out-inventory-manage").select2({
        dropdownParent: $("#modal-create-request-out-inventory-manage"),
    });
    shortcut.remove("F3");
    shortcut.add("F3", function () {
        $("#select-export-create-request-out-inventory-manage").select2("open");
    });
    registerShortcutCreateRequestOutInventoryManage();
    dateTimePickerTemplate(
        $("#date-create-request-out-inventory-manage"),
        null,
        new Date()
    );
    $("#select-export-create-request-out-inventory-manage").on("select2:select",async function () {
            if (tableMaterialRequestOutInventory.data().any()) {
                let title = "Đổi phiếu yêu cầu ?",
                    content =
                        "Bạn đã chọn nguyên liệu, đổi phiếu yêu cầu sẽ làm mới danh sách nguyên liệu !",
                    icon = "question";
                sweetAlertComponent(title, content, icon).then(
                    async (result) => {
                        if (result.value) {
                            exportCreateRequestOutInventoryManage =
                                $(this).val();
                            $(
                                "#inventory-create-request-out-inventory-manage"
                            ).text(
                                $(
                                    "#select-export-create-request-out-inventory-manage option:selected"
                                ).data("name")
                            );
                            $(
                                "#inventory-target-create-request-out-inventory-manage"
                            ).text(
                                $(
                                    "#select-export-create-request-out-inventory-manage option:selected"
                                ).data("export")
                            );
                            dataMaterialRequestCreateRequestOutInventoryManage();
                        } else {
                            $(this)
                                .val(exportCreateRequestOutInventoryManage)
                                .trigger("change.select2");
                        }
                    }
                );
            } else {
                exportCreateRequestOutInventoryManage = $(this).val();
                $("#inventory-create-request-out-inventory-manage").text(
                    $(
                        "#select-export-create-request-out-inventory-manage option:selected"
                    ).data("name")
                );
                $("#inventory-target-create-request-out-inventory-manage").text(
                    $(
                        "#select-export-create-request-out-inventory-manage option:selected"
                    ).data("export")
                );
                dataMaterialRequestCreateRequestOutInventoryManage();
            }
        }
    );
    $(document).on(
        "input",
        "#table-material-create-request-out-inventory-manage tbody input.quantity",
        async function () {
            let quantity = parseFloat(removeformatNumber($(this).val()));
            let price = parseFloat(
                removeformatNumber($(this).parents("tr").find(".price").text())
            );
            $(this).parents("td").find("label").text(quantity);
            $(this)
                .parents("tr")
                .find("label.total")
                .text(formatNumber(checkDecimal(quantity * price)));
        }
    );
    $(document).on("focus", "input", function () {
        $(this).select();
    });
    $("#modal-create-request-out-inventory-manage select").on(
        "change",
        function () {
            $(
                "#modal-create-request-out-inventory-manage .btn-renew"
            ).removeClass("d-none");
        }
    );
    $("#date-create-request-out-inventory-manage").on("dp.change", function () {
        $("#modal-create-request-out-inventory-manage .btn-renew").removeClass(
            "d-none"
        );
    });
    $("#modal-create-request-out-inventory-manage textarea").on(
        "input",
        function () {
            $(
                "#modal-create-request-out-inventory-manage .btn-renew"
            ).removeClass("d-none");
        }
    );
    $("#check-create-request-out-inventory-manage").on("input", function () {
        $("#modal-create-request-out-inventory-manage .btn-renew").removeClass(
            "d-none"
        );
    });
    $("#modal-detail-material-data").on("hidden.bs.modal", function () {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalCreateRequestOutInventoryManage();
        });
    });
    dataRequestCreateRequestOutInventoryManage();
    dataTableMaterialRequestOutInventoryManage([]);
}

async function dataRequestCreateRequestOutInventoryManage() {
    let method = "get",
        url = "out-inventory-manage.export",
        branch = $(".select-branch").val(),
        params = { branch: branch },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $("#select-export-create-request-out-inventory-manage"),
    ]);
    $("#select-export-create-request-out-inventory-manage").html(res.data[0]);
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

async function dataMaterialRequestCreateRequestOutInventoryManage() {
    let method = "get",
        url = "out-inventory-manage.data-export",
        id = $("#select-export-create-request-out-inventory-manage").val(),
        inventory = $(
            "#select-export-create-request-out-inventory-manage option:selected"
        ).data("inventory"),
        brand = $(".select-brand").val(),
        branch = $(".select-branch").val(),
        params = { id: id, brand: brand, branch: branch, inventory: inventory },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $("#table-material-create-request-out-inventory-manage tbody"),
    ]);
    dataTableMaterialRequestOutInventoryManage(res.data[0].original.data);
}

function removeMaterialCreateRequestOutInventoryManage(r) {
    removeRowDatatableTemplate(tableMaterialRequestOutInventory, r, false);
}

async function dataTableMaterialRequestOutInventoryManage(data) {
    let id = $("#table-material-create-request-out-inventory-manage"),
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
    tableMaterialRequestOutInventory = await DatatableTemplateNew(
        id,
        data,
        columns,
        vh_of_table,
        fixed_left,
        fixed_right
    );
}

async function saveModalCreateRequestOutInventoryManage() {
    if (saveCreateRequestOutInventoryManage === 1) return false;
    if (!checkValidateSave($("#modal-create-request-out-inventory-manage")))
        return false;
    let TableData = [];
    await tableMaterialRequestOutInventory.rows().every(function () {
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
        WarningNotify("Vui lòng chọn phiếu yêu cầu từ kho bộ phận!");
        return false;
    }
    let note = $("#note-create-request-out-inventory-manage").val(),
        is_complete_export = Number(
            $("#check-create-request-out-inventory-manage").is(":checked")
        ),
        branch = $(".select-branch").val(),
        delivery_date = $("#date-create-request-out-inventory-manage").val(),
        export_type = $("#select-export-create-request-out-inventory-manage option:selected").data("id"),
        request_id = $("#select-export-create-request-out-inventory-manage option:selected").val(),
        inventory = $("#select-export-create-request-out-inventory-manage option:selected").data("inventory");
    saveCreateRequestOutInventoryManage = 1;
    let method = "post",
        url = "out-inventory-manage.create",
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
        $("#loading-create-request-out-inventory-manage"),
    ]);
    saveCreateRequestOutInventoryManage = 0;
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

function cancelShortcutCreateRequestOutInventoryManage() {
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

function closeModalCreateRequestOutInventoryManage() {
    cancelShortcutCreateRequestOutInventoryManage();
    resetDataCreateRequestOutInventoryManage();
    $("#modal-create-request-out-inventory-manage").modal("hide");
    switch (
        $(
            "#select-export-create-request-out-inventory-manage option:selected"
        ).data("inventory")
    ) {
        case 1:
            $("#tab-out-inventory-manage-1").click();
            break;
        case 2:
            $("#tab-out-inventory-manage-2").click();
            break;
    }
    removeAllValidate();
    countCharacterTextarea();
}

function resetDataCreateRequestOutInventoryManage() {
    $("#check-create-request-out-inventory-manage").prop("checked", false);
    tableMaterialRequestOutInventory.clear().draw(false);
    $("#select-export-create-request-out-inventory-manage")
        .val(null)
        .trigger("change.select2");
    $("#select-branch-create-out-inventory-manage")
        .find($("#change_branch").val())
        .trigger("change.select2");
    $("#select-inventory-target-create-request-out-inventory-manage")
        .find("option:first")
        .trigger("change.select2");
    $("#date-create-request-out-inventory-manage").val(
        moment().format("DD/MM/YYYY")
    );
    $("#total-record-create-request-out-inventory-manage").text("0");
    $("#total-sum-price-create-request-out-inventory-manage").text("0");
    $("#inventory-create-request-out-inventory-manage").text("---");
    $("#inventory-target-create-request-out-inventory-manage").text("---");
    $("#note-create-request-out-inventory-manage").val("");
    $("#modal-create-request-out-inventory-manage .btn-renew").addClass(
        "d-none"
    );
    countCharacterTextarea();
}
