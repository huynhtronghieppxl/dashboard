let typeActionMaterialFoodReport = 1, timeActionMaterialFoodReport = $('#calendar-day').val(),
    typeTimeMaterialFood = 1, dateMaterialFoodReport ,
    monthMaterialFoodReport ,yearMaterialFoodReport, tabMaterialFoodReport = 1,
    fromDateMaterialFoodReport, toDateMaterialFoodReport;
$(async function () {
    if(getCookieShared('material-food-report-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('material-food-report-id-' + idSession));
        tabMaterialFoodReport = dataCookie.tab;
        typeTimeMaterialFood = dataCookie.type;
        dateMaterialFoodReport = dataCookie.date;
        monthMaterialFoodReport = dataCookie.month;
        yearMaterialFoodReport = dataCookie.year;
        $('#calendar-year').val(yearMaterialFoodReport);
        $('#calendar-month').val(monthMaterialFoodReport);
        $('#calendar-day').val(dateMaterialFoodReport);
    }

    $(document).on("dp.change", "#calendar-day, #calendar-month, #calendar-year", function () {
        timeActionMaterialFoodReport = $(this).val();
    });

    $('.amount-total-header-report').addClass('d-none')
    $('.filter-header').removeClass('d-none')
    $(document).on("change", "#select-time-report", async function () {
        let timeVal = $(this).val();
        switch (timeVal) {
            case "day":
                typeActionMaterialFoodReport = 1;
                timeActionMaterialFoodReport = $("#calendar-day").val();
                fromDateMaterialFoodReport = '';
                toDateMaterialFoodReport = '';
                break;
            case "week":
                typeActionMaterialFoodReport = 2;
                timeActionMaterialFoodReport = moment().format("WW/YYYY");
                fromDateMaterialFoodReport = '';
                toDateMaterialFoodReport = '';
                break;
            case "month":
                typeActionMaterialFoodReport = 3;
                timeActionMaterialFoodReport = $("#calendar-month").val();
                fromDateMaterialFoodReport = '';
                toDateMaterialFoodReport = '';
                break;
            case "3month":
                typeActionMaterialFoodReport = 4;
                timeActionMaterialFoodReport = moment().format("MM/YYYY");
                fromDateMaterialFoodReport = '';
                toDateMaterialFoodReport = '';
                break;
            case "year":
                typeActionMaterialFoodReport = 5;
                timeActionMaterialFoodReport = $("#calendar-year").val();
                fromDateMaterialFoodReport = '';
                toDateMaterialFoodReport = '';
                break;
            case "3year":
                typeActionMaterialFoodReport = 6;
                timeActionMaterialFoodReport = moment().format("YYYY");
                fromDateMaterialFoodReport = '';
                toDateMaterialFoodReport = '';
                break;
            case "13":
                fromDateMaterialFoodReport = '';
                toDateMaterialFoodReport = '';
                detectDateOptionTimeMaterialFood(13);
                break;
            case "15":
                fromDateMaterialFoodReport = '';
                toDateMaterialFoodReport = '';
                detectDateOptionTimeMaterialFood(15);
                break;
            case "16":
                fromDateMaterialFoodReport = '';
                toDateMaterialFoodReport = '';
                detectDateOptionTimeMaterialFood(16);
                break;
            case "all_year":
                typeActionMaterialFoodReport = 8;
                timeActionMaterialFoodReport = moment().format("YYYY");
                fromDateMaterialFoodReport = '';
                toDateMaterialFoodReport = '';
                break;
        }
        await loadData();
        updateCookieMaterialFood()
    });

    $("#day .custom-button-search").on("click", function () {
        loadData();
    });

    $("#month .custom-button-search").on("click", function () {
        loadData();
    });

    $("#year .custom-button-search").on("click", function () {
        loadData();
    });

    if(!($('.select-branch').val())) {
        await updateSessionBrandNew($('.select-brand'));
    }else {
        loadData();
    }

    $(".search-date-option-filter-time-bar").on("click", async function () {
        await detectDateOptionTimeMaterialFood(Number($("#select-time-report").val()));
        loadData();
    });

    $('#btn-group-time-material-food-report button').on('click', function (){
        typeTimeMaterialFood = $(this).data('type')
        updateCookieMaterialFood()
    })

    $('#nav-tabs-material-food li a').on('click', function (){
        tabMaterialFoodReport = $(this).data('tab')
        updateCookieMaterialFood()
    })
    $('#nav-tabs-material-food li a[data-tab="'+ tabMaterialFoodReport +'"]').click();
    $('#btn-group-time-material-food-report button[data-type="'+ typeTimeMaterialFood +'"]').click();
});

function updateCookieMaterialFood(){
    saveCookieShared('material-food-report-id-' + idSession, JSON.stringify({
        'type' : typeTimeMaterialFood,
        'tab' : tabMaterialFoodReport,
        'date' :  $('#calendar-day').val(),
        'month' :  $('#calendar-month').val(),
        'year' :  $('#calendar-year').val(),
    }))
}

async function loadData() {
    let branch = $(".select-branch").val(),
        method = 'get',
        params = {
            branch: branch,
            type: typeActionMaterialFoodReport,
            time: timeActionMaterialFoodReport,
            from_date: fromDateMaterialFoodReport,
            to_date: toDateMaterialFoodReport,
        },
        data = null,
        url = 'material-food-report.data';
    let res = await axiosTemplate(method, url, params, data,[
        $("#table-material-material-food-report"),
        $("#table-goods-material-food-report"),
        $("#table-internal-material-food-report"),
        $("#table-other-material-food-report")
    ]);
    dataTableMaterialReport(res);
    dataTotalMaterialReport(res.data[4]);
}

function dataTableMaterialReport(data) {
    let idMaterial = $('#table-material-material-food-report'),
        idGoods = $('#table-goods-material-food-report'),
        idInternal = $('#table-internal-material-food-report'),
        idOther = $('#table-other-material-food-report'),
        fixed_left = 2,
        fixed_right = 2,
        column = [
            {data: 'index', name: 'index', class: 'text-center', width: '5%'},
            {data: 'restaurant_material_name', name: 'restaurant_material_name', class: 'text-left'},
            {data: 'material_category_type_name', name: 'material_category_type_name', class: 'text-left'},
            {data: 'food_name', name: 'food_name', class: 'text-left'},
            {data: 'system_last_big_quantity', name: 'food_name', class: 'text-right'},
            {data: 'material_quantity_in_recipe', name: 'material_quantity_in_recipe', class: 'text-right'},
            {data: 'material_unit_specification_exchange_name', name: 'material_unit_specification_exchange_name', class: 'text-left'},
            {data: 'food_total_quantity', name: 'food_total_quantity', class: 'text-right'},
            {data: 'food_unit', name: 'food_unit', class: 'text-left'},
            {data: 'material_total_quantity', name: 'material_total_quantity', class: 'text-right'},
            {data: 'material_unit_specification_exchange_name', name: 'material_unit_specification_exchange_name', class: 'text-left'},
            {data: 'material_total_big_quantity_used', name: 'material_total_big_quantity_used', class: 'text-right'},
            {data: 'material_unit_name', name: 'material_unit_name', class: 'text-left'},
            {data: 'keysearch', className: 'd-none'},
        ],
        rowsGroup = [0, 1, 2, 10, 11];
    DatatableTemplateRowGroupNew(idMaterial, data.data[0].original.data, column, vh_of_table, fixed_left, fixed_right, '', rowsGroup);
    DatatableTemplateRowGroupNew(idGoods, data.data[1].original.data, column, vh_of_table, fixed_left, fixed_right, '', rowsGroup);
    DatatableTemplateRowGroupNew(idInternal, data.data[2].original.data, column, vh_of_table, fixed_left, fixed_right, '', rowsGroup);
    DatatableTemplateRowGroupNew(idOther, data.data[3].original.data, column, vh_of_table, fixed_left, fixed_right, '', rowsGroup);


}

function dataTotalMaterialReport(data) {
    $('#total-record-material').text(data.total_record_material);
    $('#total-record-goods').text(data.total_record_goods);
    $('#total-record-internal').text(data.total_record_internal);
    $('#total-record-other').text(data.total_record_other);
}

function detectDateOptionTimeMaterialFood(type) {
    switch (type) {
        case 15:
            typeActionMaterialFoodReport = 15;
            timeActionMaterialFoodReport = "";
            fromDateMaterialFoodReport = $(".from-month-filter-time-bar").val();
            toDateMaterialFoodReport = $(".to-month-filter-time-bar").val();
            break;
        case 16:
            typeActionMaterialFoodReport = 16;
            timeActionMaterialFoodReport = "";
            fromDateMaterialFoodReport = $(".from-year-filter-time-bar").val();
            toDateMaterialFoodReport = $(".to-year-filter-time-bar").val();
            break;
        default:
            typeActionMaterialFoodReport = 13;
            timeActionMaterialFoodReport = "";
            fromDateMaterialFoodReport = $(".from-date-filter-time-bar").val();
            toDateMaterialFoodReport = $(".to-date-filter-time-bar").val();
    }
}
