$(function () {
    $('#message-facebook').on('input', function(){
        if($(this).text() != "") {
            $('#submitbutton').removeAttr('disabled');
            $('.message-facebook').removeClass('message-facebook-options');
            $('.message-facebook-menu').addClass('active');
        } else {
            $('#submitbutton').prop('disabled', true);
            $('.message-facebook').addClass('message-facebook-options');
            $('.message-facebook-menu').removeClass('active');
        }
    });

      const tx = $("#message-facebook");
      for (let i = 0; i < tx.length; i++) {
        tx[i].setAttribute(
        "style",
        "height:" + tx[i].scrollHeight + "px;overflow-y:auto;");

        tx[i].addEventListener("input", OnInput, false);
      }

      function OnInput() {
        this.style.height = "auto";
        this.style.height = this.scrollHeight + "px";
      }

      $("#toggle").click(function () {
        $(this).toggleClass("rotate-180");
      });

    /**
     * Ràng buộc thao tác để gửi tin nhắn và xuống dòng
     */
    $('.message-facebook-textarea').on('keydown',function(e) {
        if(e.which === 13 && e.shiftKey) {
            // Xuống dòng
        }
        else if (e.which === 13) {
            e.preventDefault();
            getContentToSendMessengerUser();
        }
        $('.dashboard-facebook-button-send-content').on('click',function (){
            getContentToSendMessengerUser();
        })
    });
});
/**
 * Kiểm tra dữ liệu nhập vào và tiến hành gửi
 */
async function getContentToSendMessengerUser(){
    let textVal = $('.message-facebook-textarea').text().trim();
    if(textVal !== ""){
        $('#data-message-visible-message-facebook').prepend('<div class="chat-body-message-element message-right">\n' +
            '                                                        <div class="chat-body-message">\n' +
            '                                                            <div class="chat-body-message-text">' + textVal + '</div>\n' +
            '                                                            <div class="chat-body-message-footer">\n' +
            '                                                                <ul class="chat-body-message-item-action-list d-none">\n' +
            '                                                                    <li class="chat-body-message-item-action-item item-action-revoke">\n' +
            '                                                                        <i class="chat-body-message-item-action-icon ion-refresh"></i>\n' +
            '                                                                    </li>\n' +
            '                                                                    <li class="chat-body-message-item-action-item item-action-reply">\n' +
            '                                                                        <i class="chat-body-message-item-action-icon ion-quote"></i>\n' +
            '                                                                    </li>\n' +
            '                                                                    <li class="chat-body-message-item-action-item item-action-pin">\n' +
            '                                                                        <i class="chat-body-message-item-action-icon ion-pin"></i>\n' +
            '                                                                    </li>\n' +
            '                                                                </ul>\n' +
            '                                                                <div class="chat-body-message-status-send d-none">\n' +
            '                                                                    <i class="chat-body-message-sending-icon fa fa-check-circle-o"></i>\n' +
            '                                                                    <i class="chat-body-message-send-icon fa fa-check-circle d-none"></i>\n' +
            '                                                                </div>\n' +
            '                                                                <div class="reacts-list-content">\n' +
            '                                                                    <div class="reacts-list d-none">\n' +
            '                                                                        <div class="react-icon-list" data-love="0" data-smile="0" data-like="0" data-angry="0" data-sad="0" data-wow="0"></div>\n' +
            '                                                                        <div class="total-reacts">0</div>\n' +
            '                                                                    </div>\n' +
            '                                                                </div>\n' +
            '                                                                <span class="time-message-ago">Vừa xong</span>\n' +
            '                                                            </div>\n' +
            '                                                        </div>\n' +
            '                                                    </div>');
        $('.message-facebook-textarea').text('');
        $('.message-facebook-textarea').css('height','46px');
        $('.message-facebook-textarea').parent().addClass('message-facebook-options');
        $('.dashboard-facebook-button-send-content').prop('disabled', true);
    }
}





