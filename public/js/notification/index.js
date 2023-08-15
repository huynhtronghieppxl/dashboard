let currentPage = 1, limitItem = 4;

$(function () {
    $('#header-notify-hidden').remove();
    addLoading('notify-view.data');
    $('#search-notify').on('change', function () {
        currentPage = 1;
        loadData();
    });
    $('#filter-time-notify a').on('click', function () {
        $('#filter-time-notify a').removeClass('active');
        $(this).addClass('active');
        currentPage = 1;
        loadData();
    });
    $('#filter-status-notify a').on('click', function () {
        $('#filter-status-notify a').removeClass('active');
        $(this).addClass('active');
        currentPage = 1;
        loadData();
    });
    $('#filter-type-notify a').on('click', function () {
        $('#filter-type-notify a').removeClass('active');
        $(this).addClass('active');
        currentPage = 1;
        loadData();
    });
    loadData();
})

function updateTimeNotification() {
    $('#list-item-notify .job-cards').each(function (i, v) {
        let timeNotify = moment($(v).find('.time-notify').data('time'), 'YYYY-MM-DD HH:mm:ss').format('x');
        $(v).find('.time-notify').text(updateTimeTextTemplate(timeNotify));
    })
}

async function loadData() {
    let method = 'get', url = 'notify-view.data', params = {
        page: currentPage,
        limit: limitItem,
        keysearch: $('#search-notify').val(),
        type: $('#filter-type-notify a.active').data('type'),
        status: $('#filter-status-notify a.active').data('status'),
        from: $('#filter-time-notify a.active').data('from'),
        to: $('#filter-time-notify a.active').data('to'),
    }, data = null;
    let res = await axiosTemplate(method, url, params, data);
    await $('#list-item-notify').html(res.data[0]);
    await setupPagination(res.data[1].data.total_record);
    setInterval(updateTimeNotification, 1000);
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
