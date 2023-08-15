let currentPage = 1, limitItem = 100, keySearchPriceChangeHistories = '', sub_data = [], view_mode = 'col-lg-4',
    timeBefore;

$(async function () {
    // dateTimePickerTemplate($('.input-datetimepicker'));
    dateTimePickerFromMaxToDate($('#from-report-price-change-histories'), $('#to-report-price-change-histories'));
    dateTimePickerMonthYearTemplate($('#calendar-month'));
    dateTimePickerYearTemplate($('#calendar-year'));

    $('#btn-search-report-price-change-histories').unbind('click').on('click', function () {
        loadData();
    })

    $('#supplier-report-price-change-histories').on('change', function () {
        loadData();
    })

    $('#inventory-report-price-change-histories').on('change', function () {
        loadData();
    })

    //xử lý khi tìm kiếm nguyên liệu
    $('#value-material-price-change-histories').on('input', function () {
        keySearchPriceChangeHistories = $(this).val();
    })

    let typingTimer;                //timer identifier
    let doneTypingInterval = 500;  //time in ms, 2 seconds for example
    let $input = $('#value-material-price-change-histories');
    $(document).on('change', '#view-mode-price-change-histories', function () {
        view_mode = $(this).val()
        loadData()
    })

    $('#view-max-item-price-change-histories').on('change', function () {
        currentPage = 1;
        limitItem = $(this).val();
        loadData()
    })

//on keyup, start the countdown
    $input.on('keyup', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
    });

//on keydown, clear the countdown
    $input.on('keydown', function () {
        clearTimeout(typingTimer);
    });

//user is "finished typing," do something
    function doneTyping() {
        //do something
        loadData();
    }

    if(!$('.select-branch').val()) {
        await updateSessionBrandNew($('.select-brand'));
    }else {
        dataSupplierPriceChange();
    }

})

async function loadData() {
    let restaurant_brand_id = $('.select-brand').val(),
        branch = $(".select-branch").val(),
        method = 'get',
        url = 'price-change-histories-report.data',
        params = {
            branch: branch,
            inventory: $('#inventory-report-price-change-histories').val(),
            restaurant_brand_id: restaurant_brand_id,
            supplier_id: $('#supplier-report-price-change-histories').val(),
            from: $('#from-report-price-change-histories').val(),
            to: $('#to-report-price-change-histories').val(),
            page: currentPage,
            limit: limitItem,
            key_search: keySearchPriceChangeHistories
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#body-price-change-histories-report')])
    if (res.data[0].length === 0) {
        $('#list-material-chart-line').html(`<div id="chart-profit-report-vertical-center" class="empty-datatable-custom center-loading" ><img src="../../../images/tms/empty.png" style="width: 200px; height: auto; object-fit: contain;"></div>`);
        $('.simple-pagination').addClass('d-none');
    } else {
        $('.simple-pagination').removeClass('d-none');
        $('#list-material-chart-line').html('');
        drawData(res.data[0], view_mode)
        setupPagination(res.data[1]['data']['total_record']);
    }

    $('#list-material-chart-line h5').each(function () {
        let text = $.trim($(this).text());
        let characterCount = text.length;
        if ($(this).parents('.chart-item').hasClass('col-lg-4')) {
            if (characterCount > 47) {
                $(this).mouseenter(function () {
                    $(this).css('animation', 'scroll 10s linear infinite alternate');
                }).mouseleave(function () {
                    $(this).css('animation', 'none')
                });
            }
        }
    });
}

function drawData(data_array, view_mode) {
    for (let data of data_array) {
        chartLine(data, view_mode);
    }
}

async function dataSupplierPriceChange() {
    let method = 'get',
        url = 'price-change-histories-report.supplier',
        params = {},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#supplier-report-price-change-histories'), $('#body-price-change-histories-report')])
    $('#supplier-report-price-change-histories').html(res.data[0]);
    loadData();
}

function setupPagination(length) {
    $('.simple-pagination').pagination({
        items: length,
        itemsOnPage: limitItem,
        currentPage: currentPage,
        prevText: "&laquo;",
        nextText: "&raquo;",
        hrefTextPrefix: "javascript:void(0)",
        onPageClick: function (pageNumber) {
            currentPage = pageNumber;
            loadData();
        }
    });
}

function chartLine(data, viewMode) {
    let heightChart = data['supplier_change_price_histories'].length > 6 ? '60%' : '70%';
    let title = ($('#supplier-report-price-change-histories').val() == -1) ? (data.supplier_name + ' - ' + data.restaurant_material_name) : data.restaurant_material_name
    $('#list-material-chart-line').append(`<div class="${viewMode} card-block chart-item">
                                                <div class="card-shadow-custom-2 card-block">
                                                    <div style="overflow: hidden">
                                                        <h5 class="sub-title f-w-800 m-0" style="color: #1462B0; "> ${title} </h5>
                                                    </div>
                                                    <div id="chart-price-change-histories-container-${data.id}"  style="height: 270px !important;"></div>
                                                </div>
                                          </div>`)
    let dom = document.getElementById('chart-price-change-histories-container-' + data.id);
    let myChart = echarts.init(dom, null, {
        renderer: 'canvas',
        useDirtyRect: false
    });
    let option;
    option = {
        tooltip: {
            show: true,
            trigger: 'axis',
            formatter: function (value, index, callback) {
                return `<div class="d-flex align-items-center"><svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_12660_311137)">
<path d="M7 0C3.14008 0 0 3.14008 0 7C0 10.8599 3.14008 14 7 14C10.8599 14 14 10.8599 14 7C14 3.14008 10.8599 0 7 0ZM7 12.8333C3.7835 12.8333 1.16667 10.2165 1.16667 7C1.16667 3.7835 3.7835 1.16667 7 1.16667C10.2165 1.16667 12.8333 3.7835 12.8333 7C12.8333 10.2165 10.2165 12.8333 7 12.8333ZM9.33333 8.16667C9.33333 9.1315 8.54817 9.91667 7.58333 9.91667V10.5C7.58333 10.8226 7.32258 11.0833 7 11.0833C6.67742 11.0833 6.41667 10.8226 6.41667 10.5V9.91667H6.26033C5.63792 9.91667 5.05692 9.58183 4.74483 9.04225C4.58325 8.76283 4.67892 8.40642 4.95717 8.24542C5.23658 8.08267 5.59358 8.1795 5.754 8.45775C5.85842 8.63858 6.05208 8.75 6.25975 8.75H7.58275C7.90475 8.75 8.16608 8.48867 8.16608 8.16667C8.16608 7.94617 8.008 7.7595 7.79042 7.72333L6.0165 7.42758C5.23367 7.2975 4.66608 6.62667 4.66608 5.83333C4.66608 4.8685 5.45125 4.08333 6.41608 4.08333V3.5C6.41608 3.178 6.67683 2.91667 6.99942 2.91667C7.322 2.91667 7.58275 3.178 7.58275 3.5V4.08333H7.73908C8.3615 4.08333 8.9425 4.41875 9.25458 4.95833C9.41617 5.23717 9.3205 5.59358 9.04225 5.75517C8.76225 5.91675 8.40583 5.82108 8.24542 5.54225C8.141 5.362 7.94733 5.25058 7.73967 5.25058H6.41667C6.09467 5.25058 5.83333 5.5125 5.83333 5.83392C5.83333 6.05442 5.99142 6.24108 6.209 6.27725L7.98292 6.573C8.76575 6.70308 9.33333 7.37392 9.33333 8.16725V8.16667Z" fill="#C5C6C9"/>
</g>
<defs>
<clipPath id="clip0_12660_311137">
<rect width="14" height="14" fill="white"/>
</clipPath>
</defs>
</svg> Giá cũ: ${formatNumber(value[0]['data'].old_price)}</div>
                          <div class="d-flex align-items-center"><svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_12660_311137)">
<path d="M7 0C3.14008 0 0 3.14008 0 7C0 10.8599 3.14008 14 7 14C10.8599 14 14 10.8599 14 7C14 3.14008 10.8599 0 7 0ZM7 12.8333C3.7835 12.8333 1.16667 10.2165 1.16667 7C1.16667 3.7835 3.7835 1.16667 7 1.16667C10.2165 1.16667 12.8333 3.7835 12.8333 7C12.8333 10.2165 10.2165 12.8333 7 12.8333ZM9.33333 8.16667C9.33333 9.1315 8.54817 9.91667 7.58333 9.91667V10.5C7.58333 10.8226 7.32258 11.0833 7 11.0833C6.67742 11.0833 6.41667 10.8226 6.41667 10.5V9.91667H6.26033C5.63792 9.91667 5.05692 9.58183 4.74483 9.04225C4.58325 8.76283 4.67892 8.40642 4.95717 8.24542C5.23658 8.08267 5.59358 8.1795 5.754 8.45775C5.85842 8.63858 6.05208 8.75 6.25975 8.75H7.58275C7.90475 8.75 8.16608 8.48867 8.16608 8.16667C8.16608 7.94617 8.008 7.7595 7.79042 7.72333L6.0165 7.42758C5.23367 7.2975 4.66608 6.62667 4.66608 5.83333C4.66608 4.8685 5.45125 4.08333 6.41608 4.08333V3.5C6.41608 3.178 6.67683 2.91667 6.99942 2.91667C7.322 2.91667 7.58275 3.178 7.58275 3.5V4.08333H7.73908C8.3615 4.08333 8.9425 4.41875 9.25458 4.95833C9.41617 5.23717 9.3205 5.59358 9.04225 5.75517C8.76225 5.91675 8.40583 5.82108 8.24542 5.54225C8.141 5.362 7.94733 5.25058 7.73967 5.25058H6.41667C6.09467 5.25058 5.83333 5.5125 5.83333 5.83392C5.83333 6.05442 5.99142 6.24108 6.209 6.27725L7.98292 6.573C8.76575 6.70308 9.33333 7.37392 9.33333 8.16725V8.16667Z" fill="#C5C6C9"/>
</g>
<defs>
<clipPath id="clip0_12660_311137">
<rect width="14" height="14" fill="white"/>
</clipPath>
</defs>
</svg> Giá mới: ${formatNumber(value[0]['data'].new_price)}</div>
                          <div class="d-flex align-items-center"><svg width="15" height="15" viewBox="0 0 14 14" fill="black" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_12660_312460)">
<path fill-rule="evenodd" clip-rule="evenodd" d="M7 1.36585C3.8881 1.36585 1.36585 3.8881 1.36585 7C1.36585 10.1119 3.8881 12.6341 7 12.6341C10.1119 12.6341 12.6341 10.1119 12.6341 7C12.6341 3.8881 10.1119 1.36585 7 1.36585ZM0 7C0 3.13376 3.13376 0 7 0C10.8662 0 14 3.13376 14 7C14 10.8662 10.8662 14 7 14C3.13376 14 0 10.8662 0 7Z" fill="#C5C6C9"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M6.7688 3.48047C7.14597 3.48047 7.45173 3.78623 7.45173 4.1634V7.08573L9.69331 8.42295C10.0172 8.61618 10.1232 9.03541 9.92993 9.35932C9.7367 9.68323 9.31748 9.78917 8.99356 9.59594L6.41893 8.06004C6.21238 7.93682 6.08588 7.71405 6.08588 7.47354V4.1634C6.08588 3.78623 6.39163 3.48047 6.7688 3.48047Z" fill="#C5C6C9"/>
</g>
<defs>
<clipPath id="clip0_12660_312460">
<rect width="14" height="14" fill=""/>
</clipPath>
</defs>
</svg>
 ${moment(value[0]['data']['value'][0]).format("DD/MM/YYYY HH:mm")}</div>`;
            },
            textStyle: {
                fontFamily: 'Roboto',
                fontSize: 14,
                // fontWeight: 'bold'
            },
            axisPointer: {
                animation: true
            },
            position: 'inside',
        },
        dataZoom: [
            {
                realtime: true,
                height: 20,
                show: $('.chart-item').hasClass('col-lg-12') ? (data['supplier_change_price_histories'].length >= 10) : (data['supplier_change_price_histories'].length > 6),
                startValue: 0,
                endValue: $('.chart-item').hasClass('col-lg-12') ? (data['supplier_change_price_histories'].length >= 10 ? 15 : 100) : (data['supplier_change_price_histories'].length > 5 ? 5 : 100),
                zoomLock: true,
                showDetail: false,
                brushSelect: false
            },
        ],
        grid: {
            left: '3%',
            width: '90%',
            // right: '3%',
            height: heightChart,
            containLabel: true
        },
        toolbox: {
            feature: {
                saveAsImage: {
                    show: false,
                    title: 'Lưu ảnh',
                },
            }
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: data['supplier_change_price_histories'].map(function (item) {
                return item.created_at;
            }),
            axisLabel: {
                interval: 0,
                rotate: 45,
                // width: 100,
                fontWeight: 'bold',
                overflow: 'truncate',
                ellipsis: '...',
                formatter: function (value, index) {
                    timeBefore = value;
                    return moment(value).format("DD/MM/YYYY")
                }
            },
        },
        axisPointer: {
            show: true,
            type: 'line',
        },
        yAxis: {
            type: 'value',
            axisLabel: {
                formatter: function (value, index) {
                    if (value > 999999999) {
                        return value % 1000000000 === 0 ? formatNumber(value / 1000000000) + 'B' : formatNumber((value / 1000000000).toFixed(1)) + 'B'
                    }
                    if (value > 999999) {
                        return value % 1000000 === 0 ? formatNumber(value / 1000000) + 'M' : formatNumber((value / 1000000).toFixed(1)) + 'M'
                    }
                    if (value > 999) {
                        return value % 1000 === 0 ? formatNumber(value / 1000) + 'K' : formatNumber((value / 1000).toFixed(1)) + 'K'
                    }
                    if (value < -999999999) {
                        return value % 1000000000 === 0 ? formatNumber(value / 1000000000) + 'B' : formatNumber((value / 1000000000).toFixed(1)) + 'B'
                    }
                    if (value < -999999) {
                        return value % 1000000 === 0 ? formatNumber(value / 1000000) + 'M' : formatNumber((value / 1000000).toFixed(1)) + 'M'
                    }
                    if (value < -999) {
                        return value % 1000 === 0 ? formatNumber(value / 1000) + 'K' : formatNumber((value / 1000).toFixed(1)) + 'K'
                    }
                },
                margin: 25
            },
            nameGap: 80,
            nameTextStyle: {
                fontSize: 14,
                fontWeight: 600
            },
            nameRotate: 90,
            nameLocation: 'middle',
        },
        stateAnimation: {
            duration: 300,
            easing: 'cubicOut',
        },

        hoverLayerThreshold: 3000,
        series: [{
            name: data.restaurant_material_name,
            type: 'line',
            color: '#1462B0',
            data: data['supplier_change_price_histories'].map(function (item) {
                return {
                    'value': [item.created_at, item.new_price],
                    'old_price': item.old_price,
                    'new_price': item.new_price,
                };
            }),
            symbol: "rect",
            symbolSize: 10,
            symbolRotate: -45,
            label: {
                show: true,
                verticalAlign: "middle",
                align: "center",
                formatter: function (value, index) {
                    return formatNumber(value['value'][1]);
                },
                position: [20, -20, 0, 0],
                fontSize: 11,
                rotate: 45,
                // color: '#E96012',
                // fontWeight: "bolder",
            },
            // markPoint: {
            //     symbol: 'pin',
            //     symbolOffset: [0, '-10%'],
            //     data: [
            //         { name: 'Giá cao nhất', type: 'max' },
            //         { name: 'Giá thấp nhất', type: 'min' },
            //     ],
            //     position : 'inside',
            //     label : {
            //         formatter : function (value, index) {
            //             return formatNumber(value['value']);
            //         },
            //         fontSize : 8
            //     },
            //     symbolSize : 50,
            //     animationEasing: 'cubicOut' ,
            //     silent : false
            // },

        }]
    };

    if (option && typeof option === 'object') {
        myChart.setOption(option);
    }
    window.addEventListener('resize', myChart.resize);
}
