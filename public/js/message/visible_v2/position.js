$(function () {
    $(document).on('click', '.transition-reply', async function () {
        if ($('#data-message-visible-message .chat-body-message-element[id="' + $(this).data('id') + '"]').length === 1) {
            $('#data-message-visible-message').animate({
                scrollTop: $('#data-message-visible-message .chat-body-message-element[id="' + $(this).data('id') + '"]').offset().top - 300
            }, 500);
            $('#data-message-visible-message .chat-body-message-element[id="' + $(this).data('id') + '"]').find('.chat-body-message').addClass('active-scroll-message-reply');
            setTimeout(function () {
                $('#data-message-visible-message .chat-body-message-element[id="' + $(this).data('id') + '"]').find('.chat-body-message').removeClass('active-scroll-message-reply');
            }, 5000);
            console.log('Đang có');
        } else {
            await dataMessageConversation($(this).data('id'), -1, -1);
            $('#data-message-visible-message').animate({
                scrollTop: $('#data-message-visible-message .chat-body-message-element[id="' + $(this).data('id') + '"]').offset().top - 300
            }, 500);
            $('#data-message-visible-message .chat-body-message-element[id="' + $(this).data('id') + '"] .chat-body-message').addClass('active-scroll-message-reply');
            setTimeout($('#data-message-visible-message .chat-body-message-element[id="' + $(this).data('id') + '"] .chat-body-message').removeClass('active-scroll-message-reply'), 5000);
            console.log('Chưa có');
        }
    })
})
