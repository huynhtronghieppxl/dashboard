/**
 * Nhấn vào tin nhắn được reply scroll đến tin nhắn gốc
 */
$(function () {
    $(document).on('click', '#chat-body-message-popup .transition-reply', async function () {
        $('#chat-body-message-popup').animate({
            scrollTop: $('#chat-body-message-popup .chat-body-message-element[id="' + $(this).data('id') + '"]').offset().top - 2470
        }, 500);
        $('#chat-body-message-popup .chat-body-message-element[id="' + $(this).data('id') + '"]').find('.chat-body-message').addClass('active-scroll-message-reply');
        setTimeout(function () {
            $('#chat-body-message-popup .active-scroll-message-reply').removeClass('active-scroll-message-reply');
        }, 5000);
    })
    $(document).on('click', '.action-scroll-back-current-message-popup', function (){
        $('#chat-body-message-popup').animate({scrollTop: 0}, 800);
        return false;
    });
})

/**
 * Thực hiện tính năng scroll đến tin nhắn cũ sẽ có nút trở về tin nhắn hiện tại
 */
async function getScrollBodyPopup(thisScroll){
    if (thisScroll.scrollTop() < -300) {
        $('.action-scroll-back-current-message-popup').removeClass('d-none');
    } else {
        $('.action-scroll-back-current-message-popup').addClass('d-none');
    }
}

/**
 * Function xử lý ẩn hiện thanh scroll
 */
(function (timer) {
    window.addEventListener("load", function () {
        var el = document.querySelector("#chat-body-message-popup");
        el.addEventListener("scroll", function (e) {
            (function (el) {
                el.classList.add("scroll");
                clearTimeout(timer);
                timer = setTimeout(function () {
                    el.classList.remove("scroll");
                }, 1000);
            })(el);
        });
    });
})();
