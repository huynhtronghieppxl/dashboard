let checkRejectAdvanceSalaryEmployeeTreasurer = 0,
    checkPaymentAdvanceSalaryEmployeeTreasurer = 0,
    tabCurrentAdvanceSalaryTreasurer = 1;
let dataTableWaiting, dataTableDone, dataTableReject;
$(function () {
    if (getCookieShared("advance-salary-employee-user-id-" + idSession)) {
        let dataCookie = JSON.parse(
            getCookieShared("advance-salary-employee-user-id-" + idSession)
        );
        tabCurrentAdvanceSalaryTreasurer = dataCookie.tab;
    }
    $("#nav-advance-salary-employee .nav-link").on("click", function () {
        tabCurrentAdvanceSalaryTreasurer = $(this).attr("data-id");
        saveCookieShared(
            "advance-salary-employee-user-id-" + idSession,
            JSON.stringify({
                tab: tabCurrentAdvanceSalaryTreasurer,
            })
        );
    });
    dateTimePickerMonthYearTemplate($(".filter-advance-salary.by-month"));
    loadData();
    $(
        '#nav-advance-salary-employee a[data-id="' +
            tabCurrentAdvanceSalaryTreasurer +
            '"]'
    ).click();
    $(document).on("dp.change", ".filter-advance-salary.by-month", function () {
        $(".filter-advance-salary.by-month").val($(this).val());
    });
    $("#div-advance-salary-employee").on(
        "click",
        ".custom-button-search",
        function () {
            loadData();
        }
    );
});

async function loadData() {
    let method = "get",
        branch = $(".select-branch").val(),
        params = {
            branch: branch,
            month: $(".filter-advance-salary.by-month").val(),
        },
        data = null,
        url = "advance-salary-employee.data";
    let res = await axiosTemplate(method, url, params, data, [
        $("#div-advance-salary-employee"),
        // $('#table-waiting-advance-salary-employee'),
        // $('#table-done-advance-salary-employee'),
        // $('#table-reject-advance-salary-employee')
    ]);
    dataTableAdvanceSalaryEmployee(res);
    dataTotalAdvanceSalaryEmployee(res.data[3]);
}

async function dataTableAdvanceSalaryEmployee(data) {
    let idWaiting = $("#table-waiting-advance-salary-employee"),
        idDone = $("#table-done-advance-salary-employee"),
        idReject = $("#table-reject-advance-salary-employee"),
        scroll_Y = vh_of_table,
        fixedLeft = 0,
        fixedRight = 0,
        columnWaiting = [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                class: "text-center border-resize-datatable",
                width: "5%",
            },
            {
                data: "employee_name",
                name: "employee",
                className: "text-left",
                width: "20%",
            },
            {
                data: "employee_approved",
                name: "employee_approved",
                width: "20%",
            },
            {
                data: "reason",
                name: "reason",
                className: "text-left",
                width: "15%",
            },
            {
                data: "amount",
                name: "amount",
                className: "text-center",
                width: "15%",
            },
            {
                data: "time",
                name: "time",
                className: "text-center",
                width: "10%",
            },
            {
                data: "approved_at",
                name: "approved_at",
                className: "text-center",
                width: "10%",
            },
            {
                data: "action",
                name: "action",
                className: "text-center",
                width: "5%",
            },
            { data: "keysearch", className: "d-none" },
        ],
        columnDone = [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                class: "text-center border-resize-datatable",
                width: "5%",
            },
            {
                data: "employee_name",
                name: "employee",
                className: "text-left",
                width: "20%",
            },
            { data: "employee_paid", name: "employee_paid", width: "20%" },
            {
                data: "reason",
                name: "reason",
                className: "text-center",
                width: "15%",
            },
            {
                data: "amount",
                name: "amount",
                className: "text-center",
                width: "10%",
            },
            {
                data: "time",
                name: "time",
                className: "text-center",
                width: "15%",
            },
            {
                data: "paid_at",
                name: "paid_at",
                className: "text-center",
                width: "15%",
            },
            {
                data: "action",
                name: "action",
                className: "text-center",
                width: "10%",
            },
            { data: "keysearch", className: "d-none" },
        ],
        columnReject = [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                class: "text-center border-resize-datatable",
                width: "5%",
            },
            {
                data: "employee_name",
                name: "employee",
                className: "text-left",
                width: "20%",
            },
            { data: "employee_cancel", name: "employee_cancel", width: "20%" },
            {
                data: "reason",
                name: "reason",
                className: "text-center",
                width: "20%",
            },
            {
                data: "amount",
                name: "amount",
                className: "text-center",
                width: "20%",
            },
            {
                data: "time",
                name: "time",
                className: "text-center",
                width: "10%",
            },
            {
                data: "canceled_at",
                name: "canceled_at",
                className: "text-center",
                width: "10%",
            },
            {
                data: "action",
                name: "action",
                className: "text-center",
                width: "15%",
            },
            { data: "keysearch", className: "d-none" },
        ],
        option = [];
    dataTableWaiting = await DatatableTemplateNew(
        idWaiting,
        data.data[0].original.data,
        columnWaiting,
        scroll_Y,
        fixedLeft,
        2,
        option
    );
    dataTableDone = await DatatableTemplateNew(
        idDone,
        data.data[1].original.data,
        columnDone,
        scroll_Y,
        fixedLeft,
        fixedRight,
        option
    );
    dataTableReject = await DatatableTemplateNew(
        idReject,
        data.data[2].original.data,
        columnReject,
        scroll_Y,
        fixedLeft,
        fixedRight,
        option
    );

    $(document).on(
        "input paste keyup",
        '#content-body-techres input[type="search"]',
        async function () {
            $("#total-record-waiting-advance-salary-employee").text(
                dataTableWaiting.rows({ search: "applied" }).count()
            );
            $("#total-record-done-advance-salary-employee").text(
                dataTableDone.rows({ search: "applied" }).count()
            );
            $("#total-record-reject-advance-salary-employee").text(
                dataTableReject.rows({ search: "applied" }).count()
            );

            let totalAmountTableWaiting = searchTable(dataTableWaiting),
                totalAmountTableDone = searchTable(dataTableDone),
                totalAmountTableReject = searchTable(dataTableReject);

            $("#total-waiting-advance-salary-employee").text(
                formatNumber(totalAmountTableWaiting)
            );
            $("#total-done-advance-salary-employee").text(
                formatNumber(totalAmountTableDone)
            );
            $("#total-reject-advance-salary-employee").text(
                formatNumber(totalAmountTableReject)
            );
        }
    );
}

function searchTable(datatable) {
    let totalAmount = 0;
    datatable.rows({ search: "applied" }).every(function () {
        let row = $(this.node());
        totalAmount += removeformatNumber(row.find("td:eq(4)").text());
    });
    return totalAmount;
}

function dataTotalAdvanceSalaryEmployee(data) {
    $("#total-record-done-advance-salary-employee").text(
        data.total_record_done
    );
    $("#total-done-advance-salary-employee").text(data.total_amount_done);
    $("#total-record-waiting-advance-salary-employee").text(
        data.total_record_waiting
    );
    $("#total-waiting-advance-salary-employee").text(data.total_amount_waiting);
    $("#total-record-reject-advance-salary-employee").text(
        data.total_record_reject
    );
    $("#total-reject-advance-salary-employee").text(data.total_amount_reject);
}

function paymentAdvanceSalaryEmployeeTreasurer(id, branch, employee) {
    if (checkPaymentAdvanceSalaryEmployeeTreasurer !== 0) return false;
    let title = "Xác nhận chi ứng lương ?",
        content = "",
        icon = "question";
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = "post",
                url = "advance-salary-employee.confirm",
                params = null,
                data = {
                    id: id,
                    branch: branch,
                    employee: employee,
                };
            checkPaymentAdvanceSalaryEmployeeTreasurer = 1;
            let res = await axiosTemplate(method, url, params, data, [
                $("#table-waiting-advance-salary-employee"),
                $("#table-done-advance-salary-employee"),
                $("#table-reject-advance-salary-employee"),
            ]);
            checkPaymentAdvanceSalaryEmployeeTreasurer = 0;
            let text = $("#success-payment-data-to-server").text();
            switch (res.data.status) {
                case 200:
                    SuccessNotify(text);
                    loadData();
                    break;
                case 500:
                    text = $("#error-post-data-to-server").text();
                    if (res.data.message !== null) text = res.data.message;
                    ErrorNotify(text);
                    break;
                default:
                    text = $("#error-post-data-to-server").text();
                    if (res.data.message !== null) text = res.data.message;
                    WarningNotify(text);
            }
        }
    });
}

function rejectAdvanceSalaryEmployeeTreasurer(id, branch, employee) {
    if (checkRejectAdvanceSalaryEmployeeTreasurer !== 0) return false;
    let title = "Từ chối chi ứng lương ?",
        content = "",
        icon = "question";
    sweetAlertInputComponent(
        title,
        "id-cancel-update-salary-employee",
        content,
        icon
    ).then(async (result) => {
        if (result.isConfirmed) {
            let method = "post",
                url = "advance-salary-employee.reject",
                reason = result.value,
                params = null,
                data = {
                    id: id,
                    branch: branch,
                    employee: employee,
                    reason: reason,
                };
            checkRejectAdvanceSalaryEmployeeTreasurer = 1;
            let res = await axiosTemplate(method, url, params, data, [
                $("#table-waiting-advance-salary-employee"),
                $("#table-done-advance-salary-employee"),
                $("#table-reject-advance-salary-employee"),
            ]);
            checkRejectAdvanceSalaryEmployeeTreasurer = 0;
            let text = 0;
            switch (res.data.status) {
                case 200:
                    text = 'Từ chối thành công !';
                    SuccessNotify(text);
                    loadData();
                    break;
                case 500:
                    text = $("#error-post-data-to-server").text();
                    if (data.data.message !== null) {
                        text = data.data.message;
                    }
                    ErrorNotify(text);
                    break;
                default:
                    text = $("#error-post-data-to-server").text();
                    if (data.data.message !== null) {
                        text = data.data.message;
                    }
                    WarningNotify(text);
            }
        }
    });
}
