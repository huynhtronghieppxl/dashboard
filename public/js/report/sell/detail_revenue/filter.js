
$(function () {
    dateTimePickerTemplate($('#calendar-day'));
    dateTimePickerMonthYearTemplate($('#calendar-month'));
    dateTimePickerYearTemplate($('#calendar-year'));
    templateReportTypeOption();

    $('#select-time-report ~ .select2.select2-container').on('click', function () {
        $('#select-time-report').val() === 'day' ? $("#day").removeClass("d-none") : false;
    })

    $(document).on("change", "#select-time-report", async function () {
        let timeVal = $(this).val();
        switch (timeVal) {
            case "day":
                $(".add-display").addClass("d-none");
                $("#day").removeClass("d-none");
                break;
            case "week":
                $(".add-display").addClass("d-none");
                $("#week").removeClass("d-none");
                break;
            case "month":
                $(".add-display").addClass("d-none");
                $("#month").removeClass("d-none");
                break;
            case "3month":
                $(".add-display").addClass("d-none");
                break;
            case "year":
                $(".add-display").addClass("d-none");
                $("#year.form-year-time-filter").removeClass("d-none");
                break;
            case "3year":
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
            case "all_year":
                $(".add-display").addClass("d-none");
                break;
        }
    });
})

function isVisibleDetailValueReport(checkBoxElm, chartReport) {
    const isChecked = checkBoxElm.is(':checked');
    const labelOption = isChecked ? {
        show: true,
        verticalAlign: "middle",
        position: "top",
        color: "rgba(0, 0, 0, 1)",
        rotate: 180,
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

