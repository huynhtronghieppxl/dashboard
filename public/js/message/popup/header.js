$(function () {
    // getAllMessageNotSeen();
});

async function getAllMessageNotSeen() {
    let x1 = moment();
    axios({
        method: 'get',
        url: 'popup-message.message-not-seen',
    }).then(function (res) {
        if (res.data.data.message_not_seen_all > 99) {
            document.title = '(99+) Techres';
            $('#number-count-message-not-seen').text('99+');
        } else if (res.data.data.message_not_seen_all > 0) {
            document.title = '(' + res.data.data.message_not_seen_all + ') Techres';
            $('#number-count-message-not-seen').text(res.data.data.message_not_seen_all);
        }
    }).catch(function (e) {
        console.log(e)
    })

}
