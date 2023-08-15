/** Function xử lý hiển thị nút cuộn xuống tin nhắn cuối cùng **/
function btnOnTop() {
    $("#data-message-visible-message").on('scroll', function () {
        if ($(this).scrollTop() < -300 && $('.chat-body-text-scroll-top-btn').hasClass('d-none')) {
            $('.chat-body-scroll-top-btn').removeClass('d-none');
        } else {
            $('.chat-body-scroll-top-btn').addClass('d-none');
            $('.chat-body-text-scroll-top-btn').addClass('d-none');
        }
    });
    $('.chat-body-scroll-top-btn, .chat-body-text-scroll-top-btn').on('click', function () {
        $('#data-message-visible-message').animate({scrollTop: 0}, 400);
        return false;
    });
}

/** Function xử lý ẩn hiện thanh scroll **/
(function (timer) {
    window.addEventListener("load", function () {
        /** Xử lý ẩn hiện thanh scroll chi tiết tin nhắn cuộc trò chuyện **/
        let el = document.querySelector(".chat-body-message-main");
        el.addEventListener("scroll", function (e) {
            (function (el) {
                el.classList.add("scroll");
                clearTimeout(timer);
                timer = setTimeout(function () {
                    el.classList.remove("scroll");
                }, 1000);
            })(el);
        });
        /** Xử lý ẩn hiện thanh scroll danh sách cuộc trò chuyện **/
        let eli = document.querySelector(".data-conversation-visible-message");
        eli.addEventListener("scroll", function (e) {
            (function (eli) {
                eli.classList.add("scroll");
                clearTimeout(timer);
                timer = setTimeout(function () {
                    eli.classList.remove("scroll");
                }, 1000);
            })(eli);
        });
        /** Xử lý ẩn hiện thanh scroll about cuộc trò chuyện **/
        let about = document.querySelector("#layout-about-visible-message .right-model");
        about.addEventListener("scroll", function (e) {
            (function (about) {
                about.classList.add("scroll");
                clearTimeout(timer);
                timer = setTimeout(function () {
                    about.classList.remove("scroll");
                }, 1000);
            })(about);
        });
        /** Xử lý ẩn hiện thanh scroll danh sách thành viên **/
        let member = document.querySelector("#layout-about-visible-message .body-all-member-popup");
        member.addEventListener("scroll", function (e) {
            (function (member) {
                member.classList.add("scroll");
                clearTimeout(timer);
                timer = setTimeout(function () {
                    member.classList.remove("scroll");
                }, 1000);
            })(member);
        });
    });
})();
