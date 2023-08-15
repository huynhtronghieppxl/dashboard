// select option call ajax
$('#select-card2').on('change', function () {
    dataCard2();
});

$('#select-card3').on('change', function () {
    dataCard3();
});

$('#select-type-order-report').on('change', function () {
    dataOrderReport();
});

$('#select-type-debt-report').on('change', function () {
    dataDebtReport();
});

$('#select-card4').on('change', function () {
    dataCard4();
});

$('#select-card5').on('change', function () {
    dataCard5();
});

$('#select-card6').on('change', function () {
    dataChartCard6();
});

$('#select-card6-new').on('change', function () {
    dataCard6New();
});

$('#select-category-card-6').on('select2:select', function () {
    dataChartCard6();
});

$('#select-card7').on('change', function () {
    dataCard7();
});

$('#select-card8').on('change', function () {
    dataCard8();
});

$('#select-card9').on('change', function () {
    dataChartCard9();
});

$('#select-card10').on('change', function () {
    dataCard10();
});

$('#select-food-card-9').on('change', function () {
    dataChartCard9();
});

// $('#select-card11').on('change', function () {
//     let data_from = $(this).find('option:selected').data('from');
//     let data_to = $(this).find('option:selected').data('to');
//     data_card11(data_from, data_to);
// });
//
// $('#select-card12').on('change', function () {
//     let type = $(this).val();
//     data_card12(type);
// });

// Detail Card1 - Tab1
// function detail_card1_tab1_title() {
//     $('.card1-tab').addClass('d-none');
//     $('#card1-tab1-detail-title').removeClass('d-none');
//     card1_tab1_1();
// }
//
// function remove_detail_card1_tab1_title() {
//     $('#card1-tab1-detail-title').addClass('d-none');
//     $('.card1-tab').removeClass('d-none');
// }
//
// /*
//  */
// function detail_card1_tab1_1() {
//     $('.card1-tab').addClass('d-none');
//     $('#card1-tab1-detail-1').removeClass('d-none');
//     card1_tab1_2();
// }
//
// function remove_detail_card1_tab1_1() {
//     $('#card1-tab1-detail-1').addClass('d-none');
//     $('.card1-tab').removeClass('d-none');
// }
//
// /*
//  */
// function detail_card1_tab1_2() {
//     $('.card1-tab').addClass('d-none');
//     $('#card1-tab1-detail-2').removeClass('d-none');
//     card1_tab1_3();
// }
//
// function remove_detail_card1_tab1_2() {
//     $('#card1-tab1-detail-2').addClass('d-none');
//     $('.card1-tab').removeClass('d-none');
// }
//
// /*
//  */
// function detail_card1_tab1_3() {
//     $('.card1-tab').addClass('d-none');
//     $('#card1-tab1-detail-3').removeClass('d-none');
//     card1_tab1_4();
// }
//
// function remove_detail_card1_tab1_3() {
//     $('#card1-tab1-detail-3').addClass('d-none');
//     $('.card1-tab').removeClass('d-none');
// }
//
// // Detail Card1 - Tab2
// function detail_card1_tab2_1() {
//     $('.card1-tab').addClass('d-none');
//     $('#card1-tab2-detail-1').removeClass('d-none');
//     card1_tab2_1();
// }
//
// function remove_detail_card1_tab2_1() {
//     $('#card1-tab2-detail-1').addClass('d-none');
//     $('.card1-tab').removeClass('d-none');
// }
//
// /*
//  */
// function detail_card1_tab2_2() {
//     $('.card1-tab').addClass('d-none');
//     $('#card1-tab2-detail-2').removeClass('d-none');
//     card1_tab2_2();
// }
//
// function remove_detail_card1_tab2_2() {
//     $('#card1-tab2-detail-2').addClass('d-none');
//     $('.card1-tab').removeClass('d-none');
// }
//
// // Detail Card1 - Tab3
// function detail_card1_tab3_1() {
//     $('.card1-tab').addClass('d-none');
//     $('#card1-tab3-detail-1').removeClass('d-none');
//     card1_tab3_1();
// }
//
// function remove_detail_card1_tab3_1() {
//     $('#card1-tab3-detail-1').addClass('d-none');
//     $('.card1-tab').removeClass('d-none');
// }
//
// /*
//  */
// function detail_card1_tab3_2() {
//     $('.card1-tab').addClass('d-none');
//     $('#card1-tab3-detail-2').removeClass('d-none');
//     card1_tab3_2();
// }
//
// function remove_detail_card1_tab3_2() {
//     $('#card1-tab3-detail-2').addClass('d-none');
//     $('.card1-tab').removeClass('d-none');
// }

$(document).on('click', '#chart_horizontal', function () {
    $('#monthly-graph-home-vertical').addClass('d-none');
    $('#monthly-graph-home-horizontal').removeClass('d-none');
    $('#label-chart-card3').prop('checked', true);
});

$(document).on('click', '#chart_vertical', function () {
    $('#monthly-graph-home-vertical').removeClass('d-none');
    $('#monthly-graph-home-horizontal').addClass('d-none');
    $('#label-chart-card3').prop('checked', true);
});

/**
 * Order Report
 */
$(document).on('click', '#show-vertical-order-report', function () {
    $('#chart-vertical-order-report').removeClass('d-none');
    $('#chart-horizontal-order-report').addClass('d-none');
    $('#label-chart-order-report').prop('checked', true);
});
$(document).on('click', '#show-horizontal-order-report', function () {
    $('#chart-vertical-order-report').addClass('d-none');
    $('#chart-horizontal-order-report').removeClass('d-none');
    $('#label-chart-order-report').prop('checked', true);
});


$(document).on('click', '#chart_horizontal_card5', function () {
    $('#monthly-graph-home-dish-vertical').addClass('d-none');
    $('#monthly-graph-home-dish-horizontal').removeClass('d-none');
    $('#label-chart-card5').prop('checked', true);
});

$(document).on('click', '#chart_vertical_card5', function () {
    $('#monthly-graph-home-dish-vertical').removeClass('d-none');
    $('#monthly-graph-home-dish-horizontal').addClass('d-none');
    $('#label-chart-card5').prop('checked', true);
})
;
$(document).on('click', '#chart_horizontal_card6', function () {
    $('#monthly-graph-home-value-dish-vertical').addClass('d-none');
    $('#monthly-graph-home-value-dish-horizontal').removeClass('d-none');
    $('#label-chart-card6').prop('checked', true);
});

$(document).on('click', '#chart_vertical_card6', function () {
    $('#monthly-graph-home-value-dish-vertical').removeClass('d-none');
    $('#monthly-graph-home-value-dish-horizontal').addClass('d-none');
    $('#label-chart-card6').prop('checked', true);
});

$(document).on('click', '#radio-vertical-food-card6-new', function () {
    $('#chart-horizontal-food-card6-new').addClass('d-none');
    $('#chart-vertical-food-card6-new').removeClass('d-none');
    $('#label-chart-food-card6-new').prop('checked', true);
});

$(document).on('click', '#radio-horizontal-food-card6-new', function () {
    $('#chart-vertical-food-card6-new').addClass('d-none');
    $('#chart-horizontal-food-card6-new').removeClass('d-none');
    $('#label-chart-food-card6-new').prop('checked', true);
});

$(document).on('click', '#radio-vertical-drink-card6-new', function () {
    $('#chart-horizontal-drink-card6-new').addClass('d-none');
    $('#chart-vertical-drink-card6-new').removeClass('d-none');
    $('#label-chart-drink-card6-new').prop('checked', true);
});

$(document).on('click', '#radio-horizontal-drink-card6-new', function () {
    $('#chart-vertical-drink-card6-new').addClass('d-none');
    $('#chart-horizontal-drink-card6-new').removeClass('d-none');
    $('#label-chart-drink-card6-new').prop('checked', true);
});

$(document).on('click', '#radio-vertical-sea-food-card6-new', function () {
    $('#chart-horizontal-sea-food-card6-new').addClass('d-none');
    $('#chart-vertical-sea-food-card6-new').removeClass('d-none');
    $('#label-chart-sea-food-card6-new').prop('checked', true);
});

$(document).on('click', '#radio-horizontal-sea-food-card6-new', function () {
    $('#chart-vertical-sea-food-card6-new').addClass('d-none');
    $('#chart-horizontal-sea-food-card6-new').removeClass('d-none');
    $('#label-chart-sea-food-card6-new').prop('checked', true);
});

$(document).on('click', '#radio-vertical-other-card6-new', function () {
    $('#chart-horizontal-other-card6-new').addClass('d-none');
    $('#chart-vertical-other-card6-new').removeClass('d-none');
    $('#label-chart-other-card6-new').prop('checked', true);
});

$(document).on('click', '#radio-horizontal-other-card6-new', function () {
    $('#chart-vertical-other-card6-new').addClass('d-none');
    $('#chart-horizontal-other-card6-new').removeClass('d-none');
    $('#label-chart-other-card6-new').prop('checked', true);
});

$(window).on('click', function () {
    if ($('#modal_card2_tooltip').is(':visible')) {
        $('#modal_card2_tooltip').modal('hide');
    }
});
