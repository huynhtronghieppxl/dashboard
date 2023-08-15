let usernameCustomerDashboardIntroduce;

$(function () {
    $(document).on('click', '.item-review-restaurant-dashboard-introduce', function (e) {
        if (e.target.className == 'form-control border-valid-input w-100 input-reply-review-restaurant-dashboard-introduce' || e.target.className == 'm-r-10 f-12 edit-text-introduce') {
            return false;
        } else {
            $(this).find('.input-group').addClass('d-none')
        }
    })
    $(document).on('click', '.edit-text-introduce', function () {
        if ($(this).parents('.media-body').find('.input-reply').hasClass('input-group')) {
            $(this).parents('.media-body').find('.input-reply').removeClass('d-none');
        } else {
            $('.input-reply').remove();
            $(this).parents('.media-body').append('<div class="input-group border-group input-reply" style="overflow: hidden"><input type="text" style="border: none" class="form-control border-valid-input w-100 input-reply-review-restaurant-dashboard-introduce" placeholder="Nhập tin nhắn ...">' + '<label class="input-add-icon h-100 text-muted" style="margin-top: -1px;" data-toggle="tooltip" data-placement="top" data-original-title="Gửi" ><i class="typcn typcn-location-arrow-outline" style="font-size: 17px;"></i></label></div>')
            $('.input-reply-review-restaurant-dashboard-introduce').focus();
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover'
            });
        }
    });
    $(document).on('keypress', '.input-reply-review-restaurant-dashboard-introduce', function (e) {
        if (e.keyCode === 13) {
            replyReviewRestaurantDashboardIntroduce($(this));
        }
    })
    $('#btn-search-customer-dashboard-introduce').on('click', function () {
        loadDataCustomerDashboardIntroduce();
    });
    $(document).on('click', '.item-customer-dashboard-introduce', function () {
        usernameCustomerDashboardIntroduce = $(this).parents('.job-cards').find('.company-name i').text();
        let title = 'Nhập mật khẩu ?', element = 'input-sweet-alert-cancel-restaurant-order';
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'ml-2 btn btn-grd-success',
                cancelButton: 'btn btn-grd-disabled waves-effect',
                input: 'input-swal-fire-alert-custom'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: title,
            text: '',
            input: 'password',
            inputAttributes: {
                autocapitalize: 'off', id: element, 'sweetalert-not-empty': '', autocomplete: 'off',
            },
            showCancelButton: true,
            confirmButtonText: 'Đăng nhập',
            cancelButtonText: $('#button-btn-cancel-component').text(),
            reverseButtons: true,
            focusConfirm: true,
            preConfirm: () => {
                if ($('#' + element).val() === '') {
                    ErrorNotify('Vui lòng nhập mật khẩu!');
                    return false;
                }
            },
        }).then(async (result) => {
            if (result.value) {
                let method = 'post', url = 'login-aloline', password = $('#' + element).val(), params = null,
                    data = {username: usernameCustomerDashboardIntroduce, password: password};
                let res = await axiosTemplate(method, url, params, data);
                if (res.data[0].status === 200) {
                    SuccessNotify('Đăng nhập thành công !');
                    closeModalLoginDashboardIntroduce()
                    $('#disable-login-aloline-dashboard-introduce').addClass('d-none');
                    $('#enable-login-aloline-dashboard-introduce').removeClass('d-none');
                    $('#list-feedback-dashboard-introduce').removeClass('d-none');
                    $('.pagination-review-dashboard-introduce').removeClass('d-none');
                    $('.enable-login-aloline-dashboard-introduce img').data('original-title', res.data[0].data.name);
                    $('.enable-login-aloline-dashboard-introduce img').attr('src', domainSession + res.data[0].data.avatar);
                    loadDataReviewRestaurantDashboardIntroduce();
                } else if (res.data[0].status !== 500) {
                    ErrorNotify(res.data[0].message);
                } else {
                    ErrorNotify('Lỗi hệ thống !');
                }
            }
        })
    })

    $('.open-custom-search-review-restaurant-dashboard-introduce').on('click', function () {
        $('#modal-custom-search-dashboard-introduce').modal('show');
    });
    $('#search-review').on('click', function () {
        $('#modal-custom-search-dashboard-introduce').modal('hide');
        currentPage = 1;
        loadDataReviewRestaurantDashboardIntroduce();
    });
    $('#close-search-modal').on('click', function () {
        $('#modal-custom-search-dashboard-introduce').modal('hide');
        currentPage = 1;
        $(".value-default").prop("checked", true);
        $("#check-time-search-review").prop("checked", false);
    });
    $('#check-time-search-review').on('change', function () {
        if ($(this).is(':checked')) {
            $('.time-search-review').removeClass('d-none');
        } else {
            $('.time-search-review').addClass('d-none');
        }
    })
    dateTimePickerTemplate($('#from-date-search-review-restaurant'));
    dateTimePickerTemplate($('#to-date-search-review-restaurant'));
    loadData();
    if ($('#disable-login-aloline-dashboard-introduce').hasClass('d-none')) {
        loadDataReviewRestaurantDashboardIntroduce();
    }

});

function openModalLoginDashboardIntroduce() {
    $('#modal-login-dashboard-introduce').modal('show');
    loadDataCustomerDashboardIntroduce();
}

function closeModalLoginDashboardIntroduce() {
    $('#modal-login-dashboard-introduce').modal('hide');
    $('#search-customer-dashboard-introduce').val('');
}

async function loadData() {
    let method = 'get', url = 'dashboard-introduce.data', params = null, data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#chart-restaurant-membership-card-dashboard-introduce'),
        $('#loading-flow-detail1'),
        $('#loading-flow-detail2'),
        $('#loading-flow-detail3'),
        $('#loading-flow-detail4'),
        $('#avatar-restaurant-dashboard-introduce'),
    ]);
    $('#background-restaurant-dashboard-introduce').attr('src', res.data[0].banner);
    $('#avatar-restaurant-dashboard-introduce').attr('src', res.data[0].logo);
    // $('#rate-restaurant-dashboard-introduce span').text(checkTrunc(res.data[0].average_rate) + '/5');
    $('#rate-restaurant-dashboard-introduce').parents('.pit-rate').find('.name-lever').text(parseInt(res.data[0].average_rate)+'/5')
    switch (parseInt(res.data[0].average_rate)) {
        case 1:
            $('#rate-restaurant-dashboard-introduce li:eq(0)').addClass('rated');
            break;
        case 2:
            $('#rate-restaurant-dashboard-introduce li:eq(0)').addClass('rated');
            $('#rate-restaurant-dashboard-introduce li:eq(1)').addClass('rated');
            break;
        case 3:
            $('#rate-restaurant-dashboard-introduce li:eq(0)').addClass('rated');
            $('#rate-restaurant-dashboard-introduce li:eq(1)').addClass('rated');
            $('#rate-restaurant-dashboard-introduce li:eq(2)').addClass('rated');
            break;
        case 4:
            $('#rate-restaurant-dashboard-introduce').find('li').not(':last').addClass('rated');
            break;
        case 5:
            $('#rate-restaurant-dashboard-introduce').find('li').addClass('rated');
            break;
    }
    $('#name-restaurant-dashboard-introduce').text(res.data[0].name);
    $('#customer-restaurant-dashboard-introduce').text(res.data[0].customer_members === null ? '0' : res.data[0].customer_members);
    $('#count-rate-restaurant-dashboard-introduce').text(res.data[0].rate_count === null ? '0' : res.data[0].rate_count);
    $('#accumulate-point-restaurant-dashboard-introduce').text(res.data[0].total_accumulate_point === null ? '0' : res.data[0].total_accumulate_point);
    $('#use-point-restaurant-dashboard-introduce').text(res.data[0].used_accumulate_point === null ? '0' : res.data[0].used_accumulate_point);
    // pieChartMultiValueTemplate(res.data[1], 'chart-restaurant-membership-card-dashboard-introduce');
    echart(res.data[1], 'chart-restaurant-membership-card-dashboard-introduce')
}

function echart(data, element) {
    var chartDom = document.getElementById(element);
    var myChart = echarts.init(chartDom);
    var option;

    option = {
        tooltip: {
            trigger: 'item'
        },
        legend: {
            orient: 'vertical',
            left: 'right'
        },
        series: [
            {
                name: 'Access From',
                type: 'pie',
                radius: '50%',
                data: data,
                emphasis: {
                    itemStyle: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }
        ]
    };

    option && myChart.setOption(option);

}

async function loadDataCustomerDashboardIntroduce() {
    let method = 'get', url = 'dashboard-introduce.search-customer',
        params = {phone: $('#search-customer-dashboard-introduce').val()}, data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-modal-detail-bill-manage')
    ]);
    $('#data-customer-dashboard-introduce').html(res.data[0]);
}

async function logoutAlolineRestaurantDashboardIntroduce() {
    let title = 'Đăng xuất tài khoản Aloline ?', content = '', icon = 'warning';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post', url = 'dashboard-introduce.logout-aloline', params = null, data = null;
            await axiosTemplate(method, url, params, data);
            $('#disable-login-aloline-dashboard-introduce').removeClass('d-none');
            $('#enable-login-aloline-dashboard-introduce').addClass('d-none');
            $('#list-feedback-dashboard-introduce').addClass('d-none');
            $('#list-feedback-dashboard-introduce').addClass('d-none');
            $('.pagination-review-dashboard-introduce').addClass('d-none');
            SuccessNotify('Đăng xuất tài khoản Aloline thành công !');
        }
    });
}

let currentPage = 1, limitItem = 10;

async function loadDataReviewRestaurantDashboardIntroduce() {
    let rate = $('#search-rate-review-restaurant input:checked').val(),
        reply = $('#search-reply-review-restaurant input:checked').val(), from = '', to = '';
    if ($('.time-search-review').hasClass('d-none') === false) {
        from = $('#from-date-search-review-restaurant').val();
        to = $('#to-date-search-review-restaurant').val();
    }
    let method = 'get', url = 'dashboard-introduce.review-restaurant',
        params = {
            limit: limitItem,
            page: currentPage,
            rate: rate,
            reply: reply,
            from: from,
            to: to,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#list-feedback-dashboard-introduce')]);
    await $('#list-feedback-dashboard-introduce').html(res.data[0]);
    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover'
    });
    $('#list-feedback-dashboard-introduce').scrollTop(0);
    setupPagination(res.data[1].data.total_record);
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
            loadDataReviewRestaurantDashboardIntroduce();
        }
    });
}

async function replyReviewRestaurantDashboardIntroduce(r) {
    let method = 'post', url = 'dashboard-introduce.reply-review-restaurant', params = null, data = {
        id: r.parents('.item-review-restaurant-dashboard-introduce').data('id'), content: r.val(),
    };
    let res = await axiosTemplate(method, url, params, data);
    if (res.data.status === 200) {
        r.parents('.media-body').find('.list-comment-review').prepend(`<div class="media item-comment-review-restaurant-dashboard-introduce" style="margin-bottom: 5px;">
                                    <div class="media-body" style="background-color: #f2f2f2;border-radius: 10px;padding: 5px;">
                                        <h6 class="media-heading">${res.data.data.customer_name} <span class="f-12 text-muted m-l-5">${res.data.data.updated_at}</span></h6>
                                        <p class="m-b-0">${res.data.data.content}</p>
                                    </div>
                                </div>`);
        r.parents('.input-reply').remove();
        r.parents('.item-review-restaurant-dashboard-introduce').find('.icon-check-reply-review-restaurant-dashboard-introduce').removeClass('d-none');
        SuccessNotify('Bài đánh giá đã được phản hồi !');
    }
}

function modalImageIndex(img) {
    $('#avatar-restaurant-dashboard-introduce').attr('src', img);
    $('#modal-popup-image-component').modal('show');
    shortcut.add('ESC', function () {
        $('#modal-popup-image-component').modal('hide');
    })
}

