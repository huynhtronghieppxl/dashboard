$(function () {
    $('#change-name-group').on('input paste', function (){
        if($(this).val().trim()==''){
            $('#confirm-change-name-group').addClass('disabled')
            $('#confirm-change-name-group').prop('disabled', true)
        }
        else {
            $('#confirm-change-name-group').removeClass('disabled')
            $('#confirm-change-name-group').prop('disabled', false)
        }
    })
})
async function openModalChangeNameVisibleMessage() {
    $('#change-name-group').val($('.name-about-custom-style').text());
    $('#modal-change-name-group-chat-visible-message').modal('show');
}
function saveModalChangeNameVisibleMessage(){

}
function closeModalChangeNameVisibleMessage() {
    $('#confirm-change-name-group').removeClass('disabled')
    $('#confirm-change-name-group').prop('disabled', false)
    $('#modal-change-name-group-chat-visible-message').modal('hide');
}
