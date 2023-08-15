let id_update_in_customer_message,
    type_update_in_customer_message,
    branch_id_update_in_customer_message,
    content_update_customer_message  = [];

function openModalUpdateCustomerMessage(r) {
    $('#modal-update-customer-message-data').modal('show');
    addLoading('message.update', '#loading-modal-update-customer-message-data');
    $('#modal-update-customer-message-data').on('shown.bs.modal', function () {
        shortcut.remove('F2');
        shortcut.remove('F4');
        shortcut.add('F4', function () {
            saveModalUpdateCustomerMessageData();
        });
        shortcut.add('ESC', function () {
            closeModalUpdateCustomerMessage();
        });

        id_update_in_customer_message = r.attr('data-id');
        type_update_in_customer_message = r.attr('data-type');
        branch_id_update_in_customer_message = r.attr('data-branch-id');
        content_update_customer_message = r.attr('data-content');
        $('#content-update-customer-message-data').val(content_update_customer_message);
        $('#content-update-customer-message-data').focus();
    });
}

async function saveModalUpdateCustomerMessageData() {
    if(!checkValidateSave($('#loading-modal-update-customer-message-data'))) return false;
    let id = id_update_in_customer_message,
        branch = branch_id_update_in_customer_message,
        type = type_update_in_customer_message,
        content = $('#content-update-customer-message-data').val(),
        method = 'post',
        url = 'message.update',
        params = null,
        data = {id: id,branch: branch, content: content, type: type};
    let res = await axiosTemplate(method, url, params, data, [$('#content-update-customer-message-data')]);

    let text = $('#success-update-data-to-server').text();
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            closeModalUpdateCustomerMessage();
            loadData();
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) text = res.data.message;
            ErrorNotify(text);
            break;
        default:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) text = res.data.message;
            WarningNotify(text);
    }
}

function closeModalUpdateCustomerMessage() {
    $('#modal-update-customer-message-data').modal('hide');
    $('#modal-update-customer-message-data').on('hidden.bs.modal', function () {
        shortcut.remove('F4');
        shortcut.remove('ESC');
        shortcut.add("F2", function () {
            openModalCreateCustomerMessage();
        });
    });
}

function append_update_restaurant_name() {
    let restaurant_name = []
    restaurant_name.push('[RESTAURANT_NAME]')
    let $txt = $("#content-update-customer-message-data");
    let caretPos = $txt[0].selectionStart;
    let textAreaTxt = $('#content-update-customer-message-data').val()
    $('#content-update-customer-message-data').focus().val(textAreaTxt.substring(0, caretPos) + restaurant_name.join('') + textAreaTxt.substring(caretPos));
}

function append_update_branch_name() {
    let branch_name = []
    branch_name.push('[BRANCH_NAME]')
    let $txt = $("#content-update-customer-message-data");
    let caretPos = $txt[0].selectionStart;
    let textAreaTxt = $('#content-update-customer-message-data').val()
    $('#content-update-customer-message-data').focus().val(textAreaTxt.substring(0, caretPos) + branch_name.join('') + textAreaTxt.substring(caretPos));
}

function append_update_customer_name() {
    let customer_name = []
    customer_name.push('[CUSTOMER_NAME]')
    let $txt = $("#content-update-customer-message-data");
    let caretPos = $txt[0].selectionStart;
    let textAreaTxt = $('#content-update-customer-message-data').val()
    $('#content-update-customer-message-data').focus().val(textAreaTxt.substring(0, caretPos) + customer_name.join('') + textAreaTxt.substring(caretPos));
}

function open_modal_update_more_information() {
    $('#modal-update-more-information').modal('show')
    $('#modal-update-customer-message-data').modal('hide')
}

function close_modal_update_more_information() {
    $('#modal-update-more-information').modal('hide')
    $('#modal-update-customer-message-data').modal('show')
}
