/**
 * Event
 */
// $('#select-type-food-drink-report').on('change', function () {
//     loadDataCurrentDayReport = 0;
//     dataCurrentDayReport();
// });

/**
 * Call data
 * @returns {Promise<void>}
 */
function dataCurrentDayReport() {
    if (loadDataCurrentDayReport === 1) return false;
    $('.loading-card1-item').remove();
    $('.loading-card1-sub1-item').remove();
    $('.loading-card1-sub2-item').remove();
    $('.loading-card1-sub3-item').remove();
    loadDataCurrentDayReport = 1;
    let brand = $('.select-brand').val(),
        branch = $('.select-branch').val(),
        type = 1,
        date_string = $('#current-day-report-date').text();
    $('#chart-brand-card1').prepend(themeLoading($('#chart-brand-card1').height(), 'loading-card1-item'))
    $('#chart-data-card1 .content-revenue-month-chart-report').prepend(themeLoading($('#chart-data-card1 .count-loading-chart').height(), 'branch-current-day-loading'))
    axios({
        method: 'get',
        url: 'branch-dashboard.data-current-day-report',
        params: {brand: brand, branch: branch, type: type, date_string: date_string}
    }).then(function (res) {
        if (res.data[1] === 'error') {
            showErrorServer(res);
            return false;
        }
        if (res.data[2][1].data.length > 1) {
            chartDataCurrentAllCurrentDayReport(res.data[0]);
        } else {
            chartDataCurrentAllCurrentDayReportLarge(res.data[0]);
        }
        chartCurrentDayReport(res.data[1]);
        $('#total_in_amount_card1').text(res.data[1].total_in_amount);
        $('#completed_order_amount_card1_tab1').text(res.data[1].completed_order_amount);
        $('#receive_customer_debt_amount_card1').text(res.data[1].receive_customer_debt_amount);
        $('#deposit_amount_card1').text(res.data[1].deposit_amount);

        $('#out_amount_by_addition_fee_confirmed_card1').text(res.data[1].out_amount_by_addition_fee_confirmed);
        $('#out_amount_by_addition_fee_waiting_confirm_card1').text(res.data[1].out_amount_by_addition_fee_waiting_confirm);
        $('#total_order_amount_card1').text(res.data[1].total_order_amount);

        $('#completed_order_amount_card1_tab3').text(res.data[1].total_revenue_amount_paided);
        $('#serving_order_amount_card1').text(res.data[1].serving_order_amount);
        $('#number_served_customer_card1').text(res.data[1].number_served_customer);

        $('#total_customer_card1').html(res.data[1].total_customer);
        $('#total_out_amount_card1').text(res.data[1].total_out_amount);
        $('#number_serving_customer_card1').text(res.data[1].number_serving_customer);

        $('.loading-card1-item').remove();
        $('.branch-current-day-loading').remove();
    }).catch(function (e) {
        console.log(e);
    });
}

function chartDataCurrentAllCurrentDayReport(data) {
    console.log({data})
    $('#title-card1').text(`Thương Hiệu ${data[0].name}`);
    $('#done-card1').text(formatNumber(data[0].value1));
    $('#waiting-card1').text(formatNumber(data[0].value2));
    $('#total-card1').text(formatNumber(data[0].value3));
    $('#total-customer-service-complete').text(formatNumber(data[0].value4));
    if (data[0].value1 == 0 && data[0].value2 == 0) {
        nullDataImg($('#chart-brand-card1'));
    } else {
        c3.generate({
            bindto: '#chart-brand-card1',
            data: {
                columns: [['Doanh thu đã thanh toán', data[0].value1], ['Doanh thu đang phục vụ', data[0].value2]],
                type: 'pie',
            },
            size: {
                height: 400
            },
            color: {
                pattern: ['#1ABC9C', '#e47800'],
            },
            tooltip: {
                format: {
                    value: function (value, ratio, id) {
                        let format = d3.format(',');
                        return format(value);
                    }
                }
            }
        });
    }

    $('#chart-data-card1').html('');
    let class1 = '',
        class2 = '',
        class3 = '';
    jQuery.each(data.slice(1), async function (i, v) {
        if (i % 2 !== 0) {
            class1 = 'p-r-0';
            class2 = 'p-r-0';
            class3 = 'p-0';
        } else {
            class1 = 'p-0';
            class2 = '';
            class3 = '';
        }

        await $('#chart-data-card1').append(`<div class="revenue-content-sub col-lg-6">
                <div class="revenue-month seemt-green seemt-border-bottom">
                    <div class="title-revenue-month-sub seemt-before-green">
                        <p id="title-card1">Chi nhánh ${v.name}</p>
                    </div>
                </div>
                <div class="content-revenue-month-sub">
                    <div class="row m-0 content-revenue-month-group">
                        <div
                            class="col-lg-7 col-md-6 col-sm-12 seemt-border-radius-6 content-revenue-month-chart-report">
                            <div id="chart-data-card1-${v.id}" class="count-loading-chart h-100 w-100"></div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12 pr-0">
                            <div class="revenue seemt-report-item">
                                <div class="paid-revenue d-flex justify-content-between">
                                    <div class="logo-revenue seemt-bg-green mt-1">
                                        <i class="fi-rr-stats seemt-green"></i>
                                    </div>
                                    <div class="content-revenue seemt-green d-flex flex-wrap">
                                        <div class="text-revenue col-12 p-0 text-right">
                                            <label class="m-0 mr-1">${v.title1}</label>
                                        </div>
                                        <div class="total-revenue col-12 pr-0 text-right">
                                            <label class="m-0 float-right font-weight-bold">${formatNumber(v.value1)}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="revenue seemt-report-item">
                                <div class="paid-revenue d-flex justify-content-between">
                                    <div class="logo-revenue seemt-bg-blue mt-1">
                                        <i class="fi-rr-chat-arrow-down seemt-blue"></i>
                                    </div>
                                    <div class="content-revenue seemt-blue d-flex flex-wrap">
                                        <div class="text-revenue col-12 p-0 text-right">
                                            <label class="m-0 mr-1">${v.title2}</label>
                                        </div>
                                        <div class="total-revenue col-12 pr-0 seemt-blue text-right">
                                            <label class="m-0 float-right font-weight-bold">${formatNumber(v.value2)}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="revenue seemt-report-item">
                                <div class="paid-revenue d-flex justify-content-between">
                                    <div class="logo-revenue seemt-bg-orange mt-1">
                                        <i class="fi-rr-chat-arrow-grow seemt-orange"></i>
                                    </div>
                                    <div class="content-revenue seemt-orange d-flex flex-wrap">
                                        <div class="text-revenue col-12 p-0 text-right">
                                            <label class="m-0 seemt-orange mr-1">${v.title3}</label>
                                        </div>
                                        <div class="total-revenue col-12 pr-0 text-right">
                                            <label class="m-0 float-right font-weight-bold seemt-orange">${formatNumber(v.value3)}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="revenue seemt-report-item">
                                <div class="paid-revenue d-flex justify-content-between">
                                    <div class="logo-revenue seemt-bg-red mt-1">
                                        <i class="fi-rr-user seemt-red"></i>
                                    </div>
                                    <div class="content-revenue seemt-red d-flex flex-wrap">
                                        <div class="text-revenue col-12 p-0 text-right">
                                            <label class="m-0 seemt-red mr-1">${v.title4}</label>
                                        </div>
                                        <div class="total-revenue col-12 pr-0 text-right">
                                            <label class="m-0 float-right font-weight-bold seemt-red">${formatNumber(v.value4)}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`);
        if ($('#chart-data-card1')[0].scrollWidth > $('#chart-data-card1').innerWidth()) {
            $('#scroll-to-right').removeClass('d-none')
        }
        if (v.value1 == 0 && v.value2 == 0) {
            let id = $('#chart-data-card1-' + v.id);
            nullDataImg(id);
            return false;
        }
        c3.generate({
            bindto: '#chart-data-card1-' + v.id,
            data: {
                columns: [[v.title1, v.value1], [v.title2, v.value2]],
                type: 'pie',
            },
            color: {
                pattern: ['#1ABC9C', '#e47800'],
            },
            tooltip: {
                format: {
                    value: function (value, ratio, id) {
                        let format = d3.format(',');
                        return format(value);
                    }
                }
            }
        });
    })

    setupPaginationCurrentDayReport(data.length - 1);
}

function chartDataCurrentAllCurrentDayReportLarge(data) {
    $('#title-card1').text(`Thương Hiệu ${data[0].name}`);
    $('#done-card1').text(formatNumber(data[0].value1));
    $('#waiting-card1').text(formatNumber(data[0].value2));
    $('#total-card1').text(formatNumber(data[0].value3));
    $('#total-customer-service-complete').text(formatNumber(data[0].value4));
    if (data[0].value1 == 0 && data[0].value2 == 0) {
        nullDataImg($('#chart-brand-card1'));
    } else {
        c3.generate({
            bindto: '#chart-brand-card1',
            data: {
                columns: [['Doanh thu đã thanh toán', data[0].value1], ['Doanh thu đang phục vụ', data[0].value2]],
                type: 'pie',
            },
            size: {
                height: 400
            },
            color: {
                pattern: ['#1ABC9C', '#e47800'],
            },
            tooltip: {
                format: {
                    value: function (value, ratio, id) {
                        let format = d3.format(',');
                        return format(value);
                    }
                }
            }
        });
    }

    $('#chart-data-card1').html('');
    let class1 = '',
        class2 = '',
        class3 = '';
    jQuery.each(data.slice(1), async function (i, v) {
        if (i % 2 !== 0) {
            class1 = 'p-r-0';
            class2 = 'p-r-0';
            class3 = 'p-0';
        } else {
            class1 = 'p-0';
            class2 = '';
            class3 = '';
        }

        await $('#chart-data-card1').append(`<div class="revenue-content-sub col-lg-12">
                <div class="revenue-month seemt-green seemt-border-bottom">
                    <div class="title-revenue-month-sub seemt-before-green">
                        <p id="title-card1">Chi nhánh ${v.name}</p>
                    </div>
                </div>
                <div class="content-revenue-month-sub">
                    <div class="row m-0 content-revenue-month-group">
                        <div
                            class="col-lg-7 col-md-6 col-sm-12 seemt-border-radius-6 content-revenue-month-chart-report">
                            <div id="chart-data-card1-${v.id}" class="count-loading-chart h-100 w-100"></div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12 pr-0">
                            <div class="revenue seemt-report-item">
                                <div class="paid-revenue d-flex justify-content-between">
                                    <div class="logo-revenue seemt-bg-green mt-1">
                                        <i class="fi-rr-stats seemt-green"></i>
                                    </div>
                                    <div class="content-revenue seemt-green d-flex flex-wrap">
                                        <div class="text-revenue col-12 p-0 text-right">
                                            <label class="m-0 mr-1">${v.title1}</label>
                                        </div>
                                        <div class="total-revenue col-12 pr-0 text-right">
                                            <label class="m-0 float-right font-weight-bold">${formatNumber(v.value1)}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="revenue seemt-report-item">
                                <div class="paid-revenue d-flex justify-content-between">
                                    <div class="logo-revenue seemt-bg-blue mt-1">
                                        <i class="fi-rr-chat-arrow-down seemt-blue"></i>
                                    </div>
                                    <div class="content-revenue seemt-blue d-flex flex-wrap">
                                        <div class="text-revenue col-12 p-0 text-right">
                                            <label class="m-0 mr-1">${v.title2}</label>
                                        </div>
                                        <div class="total-revenue col-12 pr-0 seemt-blue text-right">
                                            <label class="m-0 float-right font-weight-bold">${formatNumber(v.value2)}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="revenue seemt-report-item">
                                <div class="paid-revenue d-flex justify-content-between">
                                    <div class="logo-revenue seemt-bg-orange mt-1">
                                        <i class="fi-rr-chat-arrow-grow seemt-orange"></i>
                                    </div>
                                    <div class="content-revenue seemt-orange d-flex flex-wrap">
                                        <div class="text-revenue col-12 p-0 text-right">
                                            <label class="m-0 seemt-orange mr-1">${v.title3}</label>
                                        </div>
                                        <div class="total-revenue col-12 pr-0 text-right">
                                            <label class="m-0 float-right font-weight-bold seemt-orange">${formatNumber(v.value3)}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="revenue seemt-report-item">
                                <div class="paid-revenue d-flex justify-content-between">
                                    <div class="logo-revenue seemt-bg-red mt-1">
                                        <i class="fi-rr-user seemt-red"></i>
                                    </div>
                                    <div class="content-revenue seemt-red d-flex flex-wrap">
                                        <div class="text-revenue col-12 p-0 text-right">
                                            <label class="m-0 seemt-red mr-1">${v.title4}</label>
                                        </div>
                                        <div class="total-revenue col-12 pr-0 text-right">
                                            <label class="m-0 float-right font-weight-bold seemt-red">${formatNumber(v.value4)}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`);
        if (v.value1 == 0 && v.value2 == 0) {
            let id = $('#chart-data-card1-' + v.id);
            nullDataImg(id);
            return false;
        }
        c3.generate({
            bindto: '#chart-data-card1-' + v.id,
            data: {
                columns: [[v.title1, v.value1], [v.title2, v.value2]],
                type: 'pie',
            },
            color: {
                pattern: ['#1ABC9C', '#e47800'],
            },
            tooltip: {
                format: {
                    value: function (value, ratio, id) {
                        let format = d3.format(',');
                        return format(value);
                    }
                }
            }
        });
    })

    setupPaginationCurrentDayReport(data.length - 1);
}

function chartCurrentDayReport(data) {
    let data_tab3 = [];
    data_tab3.push({
            'name': 'Đã thanh toán',
            'value': removeformatNumber(data.completed_order_amount)
        },
        {
            'name': 'Đang phục vụ',
            'value': removeformatNumber(data.serving_order_amount)
        });

    let data_tab4 = [];
    data_tab4.push({
            'name': 'Đã phục vụ xong',
            'value': removeformatNumber(data.number_served_customer),
        },
        {
            'name': 'Đang phục vụ',
            'value': removeformatNumber(data.number_serving_customer),
        });

    if (data.completed_order_amount == 0 && data.serving_order_amount == 0) data_tab3 = [];
    if (data.number_served_customer == 0 && data.number_serving_customer == 0) data_tab4 = [];

    if (data_tab4.length === 0) {
        $('#card1-tab4 .card-shadow-custom').height($('#card1-tab3 .card-shadow-custom').height());
    }

    if (data_tab3.length === 0) {
        $('#card1-tab3 .card-shadow-custom').height($('#card1-tab4 .card-shadow-custom').height());
    }

    $('#customer_dashboard').html(data.total_customer);
    $('#take_away-number').html(data.number_take_away_order);
    $('#bill_finished').html(data.number_completed_order);
    $('#number_serving_order').html(data.number_serving_order);
    $('#canceled_bill').html(data.number_canceled_order);
}

/**
 * Reload Data
 */
function reloadCurrentDayReport() {
    $('.chart-customer-report-loading').remove();
    loadDataCurrentDayReport = 0;
    dataCurrentDayReport();
}

let currentPage = 1;

function setupPaginationCurrentDayReport(length) {
    $('.div-item-branch-card1[data-id="0"]').removeClass('d-none');
    $('.div-item-branch-card1[data-id="1"]').removeClass('d-none');
    if (length > 2) {
        $('.simple-pagination').pagination({
            items: length,
            itemsOnPage: 2,
            currentPage: 1,
            prevText: "&laquo;",
            nextText: "&raquo;",
            hrefTextPrefix: "javascript:void(0)",
            onPageClick: function (pageNumber) {
                $('.div-item-branch-card1').addClass('d-none');
                $('.div-item-branch-card1[data-id="' + (pageNumber * 2 - 1) + '"]').removeClass('d-none');
                $('.div-item-branch-card1[data-id="' + (pageNumber * 2 - 2) + '"]').removeClass('d-none');
            }
        });
    }
}
