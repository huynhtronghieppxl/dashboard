async function openModalAddMemberConversation() {
  await openModalEmployeeVisibleMessage();
    $('#modal-add-member-group-chat-visible-message').modal('show');
}


function closeModalAddMemberConversationVisibleMessage() {
    jQuery.each(dataMemberConversation,  function (i, v) {
        $('.user-list-create .create-group__list-check[data-id="' + v.member_id + '"] input').prop('disabled', false);
        $('.user-list-create .create-group__list-check[data-id="' + v.member_id + '"] input').prop('checked', false);
        $('.user-list-create .create-group__list-check[data-id="' + v.member_id + '"] span').removeClass('disabled-add-member-visible-message');
    })
    $('#add-member-user-group').html('');
    $('.input-search').val('');
    $('.user-list-create-member').scrollTop(0);
    $('#modal-add-member-group-chat-visible-message').modal('hide');
    $('.create-group__list-check').show();
    openModalEmployeeVisibleMessage();
}
