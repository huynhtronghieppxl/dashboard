
$(function () {
    dateTimePickerTemplate($('#calendar-day'));
    dateTimePickerMonthYearTemplate($('#calendar-month'));
    dateTimePickerYearTemplate($('#calendar-year'));
    templateReportTypeOption();

    $(document).on("change", "#select-time-customer-new-report", async function () {
        let timeVal = $(this).val();
        switch (timeVal) {
            case "1":
                $(".add-display").addClass("d-none");
                $("#day").removeClass("d-none");
                break;
            case "2":
                $(".add-display").addClass("d-none");
                $("#week").removeClass("d-none");
                break;
            case "3":
                $(".add-display").addClass("d-none");
                $("#month").removeClass("d-none");
                break;
            case "4":
                $(".add-display").addClass("d-none");
                break;
            case "5":
                $(".add-display").addClass("d-none");
                $("#year.form-year-time-filter").removeClass("d-none");
                break;
            case "6":
                $(".add-display").addClass("d-none");
                break;
            case "13":
                $(".add-display").addClass("d-none");
                $('#btn-custom-time-filter').removeClass('d-none');
                $('#btn-custom-time-filter .custom-date').removeClass('d-none');
                break;
            case "15":
                $(".add-display").addClass("d-none");
                $('#btn-custom-time-filter').removeClass('d-none');
                $('#btn-custom-time-filter .custom-month').removeClass('d-none');
                break;
            case "16":
                $(".add-display").addClass("d-none");
                $('#btn-custom-time-filter').removeClass('d-none');
                $('#btn-custom-time-filter .custom-year').removeClass('d-none');
                break;
            case "8":
                $(".add-display").addClass("d-none");
                break;
        }
    });
})

function isVisibleDetailValueDiscountReport(checkBoxElm, chartReport) {
    const isChecked = checkBoxElm.is(':checked');
    const labelOption = isChecked ? {
        show: true,
        verticalAlign: "middle",
        position: "top",
        color: "rgba(0, 0, 0, 1)",
        rotate: 0,
        distance: 15,
        fontWeight: "bolder",
        fontFamily: "roboto",
        formatter: function (param) {
            return formatNumber(param.value);
        }
    } : {
        show: false
    };
    const series = chartReport.getOption().series;
    for (let i = 0; i < series.length; i++){
        series[i].label = labelOption;
    }
    chartReport.setOption({
        series: series
    });
}

