let idUpdateInCustomerMessage,
    typeUpdateInCustomerMessage,
    branchIdUpdateInCustomerMessage,
    restaurentBrandIdCustomerMessage,
    contentUpdateCustomerMessage  = [],
    checkSaveUpdateMessageData;

function openModalUpdateCustomerMessage(r) {
    $('#modal-update-after-payment-campaign-data').modal('show');
    $('#modal-update-after-payment-campaign-data').on('shown.bs.modal', function () {
        shortcut.remove('F4');
        shortcut.add('F4', function () {
            saveModalUpdateCustomerMessageData();
        });
        shortcut.add('ESC', function () {
            closeModalUpdateCustomerMessage();
        });

        idUpdateInCustomerMessage = r.attr('data-id');
        typeUpdateInCustomerMessage = r.attr('data-type');
        branchIdUpdateInCustomerMessage = r.attr('data-branch-id');
        restaurentBrandIdCustomerMessage = r.attr('data-restaurant-brand');
        contentUpdateCustomerMessage = r.attr('data-content');
        $('#content-update-after-payment-campaign-data').val(contentUpdateCustomerMessage);
        $('#content-update-after-payment-campaign-data').focus();
        $('#modal-update-after-payment-campaign-data').find('#char-count > span:eq(0)').text($('#content-update-after-payment-campaign-data').val().length);
    });
}

async function saveModalUpdateCustomerMessageData() {
    if (checkSaveUpdateMessageData === 1) return false;
    checkSaveUpdateMessageData = 1;
    let id = idUpdateInCustomerMessage,
        branch = branchIdUpdateInCustomerMessage,
        type = typeUpdateInCustomerMessage,
        content = $('#content-update-after-payment-campaign-data').val(),
        method = 'post',
        url = 'after_payment.update',
        params = null,
        data = {id: id,branch: branch, content: content, type: type, restaurant_brand_id : restaurentBrandIdCustomerMessage};
    let res = await axiosTemplate(method, url, params, data);
    checkSaveUpdateMessageData = 0;
    let text = $('#success-update-data-to-server').text();
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
            closeModalUpdateCustomerMessage();
            loadDataAfterPayment();
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
    $('#modal-update-after-payment-campaign-data').modal('hide');
    $('#modal-update-after-payment-campaign-data').on('hidden.bs.modal', function () {
        shortcut.remove('F4');
        shortcut.remove('ESC');
        shortcut.add("F2", function () {
            openModalCreateCustomerMessage();
        });
    });
}

function appendUpdateRestaurantName() {
    let restaurant_name = [];
    let text = '[RESTAURANT_NAME]';
    restaurant_name.push('[RESTAURANT_NAME]');
    let $txt = $("#content-update-after-payment-campaign-data");
    let caretPos = $txt[0].selectionStart;
    let textAreaTxt = $('#content-update-after-payment-campaign-data').val();
    if(textAreaTxt.length === 500 || (textAreaTxt.length + text.length) > 500) return false;
    $('#content-update-after-payment-campaign-data').focus().val(textAreaTxt.substring(0, caretPos) + restaurant_name.join('') + textAreaTxt.substring(caretPos));
    $('#content-update-after-payment-campaign-data').trigger('input');
}

function appendUpdateBranchName() {
    let branch_name = [];
    let text = '[BRANCH_NAME]';
    branch_name.push('[BRANCH_NAME]');
    let $txt = $("#content-update-after-payment-campaign-data");
    let caretPos = $txt[0].selectionStart;
    let textAreaTxt = $('#content-update-after-payment-campaign-data').val();
    if(textAreaTxt.length === 500 || (textAreaTxt.length + text.length) > 500) return false;
    $('#content-update-after-payment-campaign-data').focus().val(textAreaTxt.substring(0, caretPos) + branch_name.join('') + textAreaTxt.substring(caretPos));
    $('#content-update-after-payment-campaign-data').trigger('input');
}

function appendUpdateCustomerName() {
    let customer_name = [];
    let text = '[CUSTOMER_NAME]';
    customer_name.push('[CUSTOMER_NAME]');
    let $txt = $("#content-update-after-payment-campaign-data");
    let caretPos = $txt[0].selectionStart;
    let textAreaTxt = $('#content-update-after-payment-campaign-data').val();
    if(textAreaTxt.length === 500 || (textAreaTxt.length + text.length) > 500) return false;
    $('#content-update-after-payment-campaign-data').focus().val(textAreaTxt.substring(0, caretPos) + customer_name.join('') + textAreaTxt.substring(caretPos));
    $('#content-update-after-payment-campaign-data').trigger('input');
}

function openModalUpdateMoreInformation() {
    $('#modal-update-more-information').modal('show')
    $('#modal-update-after-payment-campaign-data').modal('hide')
}

function closeModalUpdateMoreInformation() {
    $('#modal-update-more-information').modal('hide')
    $('#modal-update-after-payment-campaign-data').modal('show')
}
