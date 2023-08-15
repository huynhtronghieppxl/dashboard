function hideLabelCard3() {
    $('#monthly-graph-home-vertical .amcharts-graph-column text').addClass('d-none');
    $('#monthly-graph-home-horizontal .amcharts-graph-column text').addClass('d-none');
}

function hideLabelOrderReport() {
    $('#chart-vertical-order-report .amcharts-graph-column text').addClass('d-none');
    $('#chart-horizontal-order-report .amcharts-graph-column text').addClass('d-none');
}

function hideLabelCard4() {
    $('#monthly-graph-home-hours .amcharts-graph-line text').addClass('d-none');
}

function hideLabelCard5() {
    $('#monthly-graph-home-dish-vertical .amcharts-graph-column text').addClass('d-none');
    $('#monthly-graph-home-dish-horizontal .amcharts-graph-column text').addClass('d-none');
}

function hideLabelCard6() {
    $('#monthly-graph-home-value-dish-vertical .amcharts-graph-column text').addClass('d-none');
    $('#monthly-graph-home-value-dish-horizontal .amcharts-graph-column text').addClass('d-none');
}

function hideLabelCard9() {
    $('#chart-item-sales-day .amcharts-graph-line text').addClass('d-none');
}

// Show
function showLabelOrderReport() {
    $('#chart-vertical-order-report .amcharts-graph-column text').removeClass('d-none');
    $('#chart-horizontal-order-report .amcharts-graph-column text').removeClass('d-none');
}

function showLabelCard3() {
    $('#monthly-graph-home-vertical .amcharts-graph-column text').removeClass('d-none');
    $('#monthly-graph-home-horizontal .amcharts-graph-column text').removeClass('d-none');
}

function showLabelCard4() {
    $('#monthly-graph-home-hours .amcharts-graph-line text').removeClass('d-none');
}

function showLabelCard5() {
    $('#monthly-graph-home-dish-vertical .amcharts-graph-column text').removeClass('d-none');
    $('#monthly-graph-home-dish-horizontal .amcharts-graph-column text').removeClass('d-none');
}

function showLabelCard6() {
    $('#monthly-graph-home-value-dish-vertical .amcharts-graph-column text').removeClass('d-none');
    $('#monthly-graph-home-value-dish-horizontal .amcharts-graph-column text').removeClass('d-none');
}

function showLabelCard9() {
    $('#chart-item-sales-day .amcharts-graph-line text').removeClass('d-none');
}

$(document).on('change', '#label-chart-card3', function () {
    if ($(this).is(':checked')) {
        showLabelCard3();
    } else {
        hideLabelCard3();
    }
});

$(document).on('change', '#label-chart-order-report', function () {
    if ($(this).is(':checked')) {
        showLabelOrderReport();
    } else {
        hideLabelOrderReport();
    }
});

$(document).on('change', '#label-chart-card4', function () {
    if ($(this).is(':checked')) {
        showLabelCard4();
    } else {
        hideLabelCard4();
    }
});
$(document).on('change', '#label-chart-card5', function () {
    if ($(this).is(':checked')) {
        showLabelCard5();
    } else {
        hideLabelCard5();
    }
});
$(document).on('change', '#label-chart-card6', function () {
    if ($(this).is(':checked')) {
        showLabelCard6();
    } else {
        hideLabelCard6();
    }
});

$(document).on('change', '#label-chart-food-card6-new', function () {
    if ($(this).is(':checked')) {
        $('#chart-vertical-food-card6-new .amcharts-graph-column text').removeClass('d-none');
        $('#chart-horizontal-food-card6-new .amcharts-graph-column text').removeClass('d-none');
    } else {
        $('#chart-vertical-food-card6-new .amcharts-graph-column text').addClass('d-none');
        $('#chart-horizontal-food-card6-new .amcharts-graph-column text').addClass('d-none');
    }
});

$(document).on('change', '#label-chart-drink-card6-new', function () {
    if ($(this).is(':checked')) {
        $('#chart-vertical-drink-card6-new .amcharts-graph-column text').removeClass('d-none');
        $('#chart-horizontal-drink-card6-new .amcharts-graph-column text').removeClass('d-none');
    } else {
        $('#chart-vertical-drink-card6-new .amcharts-graph-column text').addClass('d-none');
        $('#chart-horizontal-drink-card6-new .amcharts-graph-column text').addClass('d-none');
    }
});

$(document).on('change', '#label-chart-sea-food-card6-new', function () {
    if ($(this).is(':checked')) {
        $('#chart-vertical-sea-food-card6-new .amcharts-graph-column text').removeClass('d-none');
        $('#chart-horizontal-sea-food-card6-new .amcharts-graph-column text').removeClass('d-none');
    } else {
        $('#chart-vertical-sea-food-card6-new .amcharts-graph-column text').addClass('d-none');
        $('#chart-horizontal-sea-food-card6-new .amcharts-graph-column text').addClass('d-none');
    }
});

$(document).on('change', '#label-chart-other-card6-new', function () {
    if ($(this).is(':checked')) {
        $('#chart-vertical-other-card6-new .amcharts-graph-column text').removeClass('d-none');
        $('#chart-horizontal-other-card6-new .amcharts-graph-column text').removeClass('d-none');
    } else {
        $('#chart-vertical-other-card6-new .amcharts-graph-column text').addClass('d-none');
        $('#chart-horizontal-other-card6-new .amcharts-graph-column text').addClass('d-none');
    }
});
$(document).on('change', '#label-chart-card9', function () {
    if ($(this).is(':checked')) {
        showLabelCard9();
    } else {
        hideLabelCard9();
    }
});
