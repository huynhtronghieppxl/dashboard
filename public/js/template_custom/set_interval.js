/**
 * Bộ xử lí đếm thời gian đã trôi qua từ một tham số thời gian biết trước
 */
$(function () {
    setInterval(setIntervalMessage, 1000);
})

function setIntervalMessage() {
    $('.set-interval-message').each(function (i, v) {
        $(v).text(updateTimeTextTemplate(moment($(v).data('time')).format('x')));
    })
}
