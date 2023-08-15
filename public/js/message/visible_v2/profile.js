$(function () {
    $(document).on('click', '.profile-user', function () {
        $('#modal-profile-user-visible-message').css('display','block');
        let src = $(this).prop('src');
        let name = $(this).data('name');
        $('#avatar-profile-user-visible-message').attr('src', src);
        $('.name-profile-user-visible-message').text(name);
    })
})


/**
 * Đóng modal thông tin của một người trong cuộc trò chuyện
 */
function closeModalProfileUserVisibleMessage() {
    $('#modal-profile-user-visible-message').modal('hide');
    $('#modal-profile-user-visible-message').css('display','none');
}

