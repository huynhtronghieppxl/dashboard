function openModalCreateCustomerMessage() {
    $('#modal-create-customer-message-data').modal('show');
    $('#modal-create-customer-message-data').on('shown.bs.modal', function () {
        shortcut.remove('F2');
        shortcut.remove('F4');
        shortcut.add('F4', function () {
            saveModalCreateCustomerMessageData();
        });
        shortcut.add('ESC', function () {
            closeModalCreateCustomerMessage();
        });
        $('#branch-create-customer-message-data, #create-type-customer-message-data').select2({
            dropdownParent: $('#modal-create-customer-message-data'),
            theme: 'material'
        });
        let branch_id = $('#change_branch').val(),
            branch_name = $('#change_branch option:selected').text();
        $('#branch-create-customer-message-data').val(branch_id).prop('selected', true);
        $('#branch-create-customer-message-data option:selected').text(branch_name).change()
        $('#content-create-customer-message-data').val('Tập thể [RESTAURANT_NAME] chúc anh/chị [CUSTOMER_NAME] bước sang một tuổi mới gặp nhiều may mắn và thành tựu, có thật nhiều hạnh phúc trong cuộc sống.')
        $('#create-type-customer-message-data').on('change', function () {
            if ($(this).val() !== 2) {
                $('#div-branch-greeting').removeClass('d-none')
            }
            if ($(this).val() == 2) {
                $('#div-branch-greeting').addClass('d-none')
                $('#content-create-customer-message-data').val("Tập thể [RESTAURANT_NAME] chúc anh/chị [CUSTOMER_NAME] bước sang một tuổi mới gặp nhiều may mắn và thành tựu, có thật nhiều hạnh phúc trong cuộc sống.")
            } else if ($(this).val() == 1) {
                $('#content-create-customer-message-data').val('Tập thể  [RESTAURANT_NAME] xin cảm ơn anh/chị [CUSTOMER_NAME] đã ủng hộ quán trong thời gian qua, cũng như thời gian tới. [RESTAURANT_NAME] rất hy vọng nhận được những lời góp ý chân thành từ quý khách để quán luôn nâng cấp sản phẩm và dịch vụ 1 cách tốt nhất.\n' +
                    '\n' +
                    'Chúc anh/chị  [CUSTOMER_NAME] có 1 sức khoẻ tốt, 1 gia đình hạnh phúc và 1 sự nghiệp thành công.')
            } else if ($(this).val() == 3){
                $('#content-create-customer-message-data').val('Bạn đã đăng ký thành công thẻ thành viên tại Công ty/Nhà hàng [RESTAURANT_NAME]')
            } else if ($(this).val() == 4) {
                $('#content-create-customer-message-data').val('Chúc mừng bạn đã lên cấp thẻ thành viên tại hệ thống Công ty/Nhà hàng [RESTAURANT_NAME]')
            } else if ($(this).val() == 5) {
                $('#content-create-customer-message-data').val('Chúc mừng bạn đã có thêm [POINT] điểm từ Công ty/Nhà hàng [RESTAURANT_NAME]')
            }
        })
        $('#content-create-customer-message-data').focus();
    });
}

async function saveModalCreateCustomerMessageData() {
    if(!checkValidateSave($('#content-body-techres'))) return false;
    await $('#save-create-customer-message').prop('disabled', true);
    await shortcut.remove('F4');

    let branch = $('#branch-create-customer-message-data').val(),
        type = $('#create-type-customer-message-data').val(),
        content = $('#content-create-customer-message-data').val(),
        name_content = 'Nội dung';
    let checkContent = checkRequire(name_content, content);
    if(checkContent === false) return false;
    let method = 'post',
        url = 'message.create',
        data = {branch: branch, content: content, type: type} ,
        params = null;
    let res = await axiosTemplate(method, url, params, data, [$('#modal-create-customer-message-data')]);

    let text = $('#success-create-data-to-server').text();

    switch (res.data.status){
        case 200:
            $('#modal-create-customer-message-data').modal('hide');
            SuccessNotify(text);
            closeModalCreateCustomerMessage();
            $('#create-type-customer-message-data').val(2)
            $('#content-create-customer-message-data').val("Tập thể [RESTAURANT_NAME] chúc anh/chị [CUSTOMER_NAME] bước sang một tuổi mới gặp nhiều may mắn và thành tựu, có thật nhiều hạnh phúc trong cuộc sống.")
            $('#change_branch').val(branch).prop('selected', true)
            $('#change_branch option:selected').text($('#branch-create-customer-message-data option:selected').text()).change()
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

function closeModalCreateCustomerMessage() {
    $('#modal-create-customer-message-data').modal('hide');
    $('#modal-create-customer-message-data').on('hidden.bs.modal', function () {
        shortcut.remove('F4');
        shortcut.remove('ESC');
        shortcut.add("F2", function () {
            openModalCreateCustomerMessage();
        });
        $('#save-create-customer-message').prop('disabled', false);
    });
}

function append_restaurant_name() {
    let restaurant_name = []
    restaurant_name.push('[RESTAURANT_NAME]')
    let $txt = $("#content-create-customer-message-data");
    let caretPos = $txt[0].selectionStart;
    let textAreaTxt = $('#content-create-customer-message-data').val()
    $('#content-create-customer-message-data').focus().val(textAreaTxt.substring(0, caretPos) + restaurant_name.join('') + textAreaTxt.substring(caretPos));
}

function append_branch_name() {
    let branch_name = []
    branch_name.push('[BRANCH_NAME]')
    let $txt = $("#content-create-customer-message-data");
    let caretPos = $txt[0].selectionStart;
    let textAreaTxt = $('#content-create-customer-message-data').val()
    $('#content-create-customer-message-data').focus().val(textAreaTxt.substring(0, caretPos) + branch_name.join('') + textAreaTxt.substring(caretPos));
}

function append_customer_name() {
    let customer_name = []
    customer_name.push('[CUSTOMER_NAME]')
    let $txt = $("#content-create-customer-message-data");
    let caretPos = $txt[0].selectionStart;
    let textAreaTxt = $('#content-create-customer-message-data').val()
    $('#content-create-customer-message-data').focus().val(textAreaTxt.substring(0, caretPos) + customer_name.join('') + textAreaTxt.substring(caretPos));
}

function open_modal_more_information() {
    $('#modal-create-more-information').modal('show')
    $('#modal-create-customer-message-data').modal('hide')
}

function close_modal_create_more_information() {
    $('#modal-create-more-information').modal('hide')
    $('#modal-create-customer-message-data').modal('show')
}
