let checkSaveCreateMessageData = 0, valueOfThisBranch;
function openModalCreateAfterPaymentCampaign() {
    $('#modal-create-after-payment-campaign-data').modal('show');
    $('#modal-create-after-payment-campaign-data').on('shown.bs.modal', function () {
        shortcut.remove('F4');
        shortcut.remove('F2');
        shortcut.add('F4', function () {
            saveModalCreateAfterMessageData();
        });
        shortcut.add('ESC', function () {
            closeModalCreateCustomerMessage();
        });
        $('.branch-create-after-payment-campaign-data, #create-type-after-payment-campaign-data').select2({
            dropdownParent: $('#modal-create-after-payment-campaign-data'),
        });
        let branch_id = $('.branch-create-after-payment-campaign-data').val(),
            branch_name = $('.branch-create-after-payment-campaign-data option:selected').text(),
            branchOption = $.trim($('#div-layout-after-payment-campaign .tab-pane.active .select-branch').html());
        $('.branch-create-after-payment-campaign-data').html(branchOption);
        // $('.branch-create-after-payment-campaign-data').val(branch_id).prop('selected', true);
        // $('#branch-create-after-payment-campaign-data option:selected').text(branch_name).change()
        $('#content-create-after-payment-campaign-data').val('Tập thể [RESTAURANT_NAME] chúc anh/chị [CUSTOMER_NAME] bước sang một tuổi mới gặp nhiều may mắn và thành tựu, có thật nhiều hạnh phúc trong cuộc sống.')
        $('#create-type-after-payment-campaign-data').on('change', function () {
            if ($(this).val() !== 2) {
                $('#div-branch-greeting').removeClass('d-none')
            }
            if ($(this).val() == 2) {
                $('#div-branch-greeting').addClass('d-none')
                $('#content-create-after-payment-campaign-data').val("Tập thể [RESTAURANT_NAME] chúc anh/chị [CUSTOMER_NAME] bước sang một tuổi mới gặp nhiều may mắn và thành tựu, có thật nhiều hạnh phúc trong cuộc sống.")
            } else if ($(this).val() == 1) {
                $('#content-create-after-payment-campaign-data').val('Tập thể  [RESTAURANT_NAME] xin cảm ơn anh/chị [CUSTOMER_NAME] đã ủng hộ quán trong thời gian qua, cũng như thời gian tới. [RESTAURANT_NAME] rất hy vọng nhận được những lời góp ý chân thành từ quý khách để quán luôn nâng cấp sản phẩm và dịch vụ 1 cách tốt nhất.\n' +
                    '\n' +
                    'Chúc anh/chị  [CUSTOMER_NAME] có 1 sức khoẻ tốt, 1 gia đình hạnh phúc và 1 sự nghiệp thành công.')
            } else if ($(this).val() == 3){
                $('#content-create-after-payment-campaign-data').val('Bạn đã đăng ký thành công thẻ thành viên tại Công ty/Nhà hàng [RESTAURANT_NAME]')
            } else if ($(this).val() == 4) {
                $('#content-create-after-payment-campaign-data').val('Chúc mừng bạn đã lên cấp thẻ thành viên tại hệ thống Công ty/Nhà hàng [RESTAURANT_NAME]')
            } else if ($(this).val() == 5) {
                $('#content-create-after-payment-campaign-data').val('Chúc mừng bạn đã có thêm [POINT] điểm từ Công ty/Nhà hàng [RESTAURANT_NAME]')
            }
        })
        $('#content-create-after-payment-campaign-data').focus();
        $('#modal-create-after-payment-campaign-data').find('#char-count > span:eq(0)').text($('#content-create-after-payment-campaign-data').val().length);
    });
    valueOfThisBranch = $('.branch-create-after-payment-campaign-data').val();
    if(valueOfThisBranch == -1){
        $('#branch-after-payment-select').addClass('d-none');
        $('#all-branch-after-payment-select').removeClass('d-none')
    }else{
        $('#branch-after-payment-select').removeClass('d-none');
        $('#all-branch-after-payment-select').addClass('d-none')
    }
}

async function saveModalCreateAfterMessageData() {
    if (checkSaveCreateMessageData === 1) return false;
    if (!checkValidateSave($('#modal-create-after-payment-campaign-data'))) return false;
    await $('#save-create-after-payment-campaign').prop('disabled', true);
    await shortcut.remove('F4');

    let restaurant_brand_id = $('.select-brand').val(),
        branch = $('.select-branch ').val(),
        type = $('#create-type-after-payment-campaign-data').val(),
        content = $('#content-create-after-payment-campaign-data').val();
    let checkContent = checkRequire(content);
    if(checkContent === false) return false;
    checkSaveCreateMessageData = 1;
    let method = 'post',
        url = 'after_payment.create',
        data = {branch: branch, content: content, type: type, restaurant_brand_id : restaurant_brand_id},
        params = null;
    let res = await axiosTemplate(method, url, params, data);
    checkSaveCreateMessageData = 0;
    let text = $('#success-create-data-to-server').text();
    switch (res.data.status){
        case 200:
            $('#modal-create-after-payment-campaign-data').modal('hide')
            SuccessNotify(text);
            closeModalCreateCustomerMessage();
            $('#create-type-after-payment-campaign-data').val()
            $('#content-create-after-payment-campaign-data').val()
            // $('#change_branch').val(branch).prop('selected', true)
            // $('#change_branch option:selected').text($('.branch-create-after-payment-campaign-data option:selected').text()).change()
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

function closeModalCreateCustomerMessage() {
    $('#modal-create-after-payment-campaign-data').modal('hide');
    $('#modal-create-after-payment-campaign-data').on('hidden.bs.modal', function () {
        shortcut.remove('F4');
        shortcut.remove('ESC');
        shortcut.add("F2",function() {
            openModalCreateAfterPaymentCampaign();
        });
        $('#save-create-after-payment-campaign').prop('disabled', false);
    });
}

function appendCreateRestaurantName() {
    let restaurant_name = [];
    let text = '[RESTAURANT_NAME]';
    restaurant_name.push('[RESTAURANT_NAME]');
    let $txt = $("#content-create-after-payment-campaign-data");
    let caretPos = $txt[0].selectionStart;
    let textAreaTxt = $('#content-create-after-payment-campaign-data').val();
    if(textAreaTxt.length === 500 || (textAreaTxt.length + text.length) > 500) return false;
    $('#content-create-after-payment-campaign-data').focus().val(textAreaTxt.substring(0, caretPos) + restaurant_name.join('') + textAreaTxt.substring(caretPos));
    $('#content-create-after-payment-campaign-data').trigger('input');
}

function appendCreateBranchName() {
    let branch_name = [];
    let text = '[BRANCH_NAME]';
    branch_name.push('[BRANCH_NAME]')
    let $txt = $("#content-create-after-payment-campaign-data");
    let caretPos = $txt[0].selectionStart;
    let textAreaTxt = $('#content-create-after-payment-campaign-data').val();
    if(textAreaTxt.length === 500 || (textAreaTxt.length + text.length) > 500) return false;
    $('#content-create-after-payment-campaign-data').focus().val(textAreaTxt.substring(0, caretPos) + branch_name.join('') + textAreaTxt.substring(caretPos));
    $('#content-create-after-payment-campaign-data').trigger('input');

}

function appendCreateCustomerName() {
    let customer_name = [];
    let text = '[CUSTOMER_NAME]';
    customer_name.push('[CUSTOMER_NAME]');
    let $txt = $("#content-create-after-payment-campaign-data");
    let caretPos = $txt[0].selectionStart;
    let textAreaTxt = $('#content-create-after-payment-campaign-data').val()
    if(textAreaTxt.length === 500 || (textAreaTxt.length + text.length) > 500) return false;
    $('#content-create-after-payment-campaign-data').focus().val(textAreaTxt.substring(0, caretPos) + customer_name.join('') + textAreaTxt.substring(caretPos));
    $('#content-create-after-payment-campaign-data').trigger('input');
}

function openModalMoreInformation() {
    $('#modal-create-more-information').modal('show')
    $('#modal-create-after-payment-campaign-data').modal('hide')
}

function closeModalCreateMoreInformation() {
    $('#modal-create-more-information').modal('hide')
    $('#modal-create-after-payment-campaign-data').modal('show')
}
