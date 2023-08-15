let saveCreateCards,
    idCustomerCreateCards,
    customer_name,
    branch_id = $('.select-branch').val();

function openModalCreateCards() {
    $('#modal-create-cards .js-example-basic-single').select2({
        dropdownParent: $('#modal-create-cards'),
    });

    idCustomerCreateCards = '';
    saveCreateCards = 0;
    dataCreateCards();
    $('#modal-create-cards').modal('show');
    shortcut.remove('F2');
    shortcut.add("F4", function () {
        saveModalCreateCards();
    });
    shortcut.add("ESC", function () {
        closeModalCreateCards();
    });
    $('#modal-create-cards input').on('click', function () {
        $(this).select();
    });

    $('#modal-create-cards').on('click focus', function () {
        $('#data-search-customer-booking-table-manage').addClass('d-none')
    });

    $('#data-search-customer-booking-table-manage').html('');

    $(document).on('click', '.item-search-customer', function () {
        $('#data-search-customer-booking-table-manage').addClass('d-none');
        $('#phone-customer-create-cards').val($(this).data('phone'));
        $('#phone-customer-create-cards').data('id', $(this).data('id'));
        $('#name-customer-create-cards').text($(this).find('h4').text());
        idCustomerCreateCards = parseInt($(this).data('id'));
    });

    $(document).on('click', '.custom-card-value', function () {
        $('.custom-card-value').not(this).removeClass('custom-card-value-focus');
        $(this).addClass('custom-card-value-focus');
    });

    $('#select-method-create-card-manage').on('change', function (){
        $('#modal-create-cards .btn-renew').removeClass('d-none');
    })
    $('#phone-customer-create-cards').on('change', function (){
        $('#name-customer-create-cards').text($(this).find('option:selected').text())
        $('#modal-create-cards .btn-renew').removeClass('d-none');
    })

    $('#phone-customer-create-cards').select2({
        language: {
            inputTooShort: function () {
                return "Nhập số điện thoại";
            },
            searching: function () {
                return 'Đang tìm kiếm...';
            },
        },
        ajax: {
            url: "cards.search-customer",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    phone: params.term, // search term
                    page: params.page,
                    branch: $('.select-branch').val()
                };
            },
            processResults: function (data, params) {
                return {
                    results: data[0],
                };
            },
        },
        placeholder: 'Nhập số điện thoại',
        minimumInputLength: 2,
        dropdownParent: $('#modal-create-cards'),
        templateResult: function (idioma) {
            if (!idioma.loading) {
                let $span = $(`<span class="d-flex align-items-center justify-content-lg-start list-data-customer-search">
                                    <img onerror="this.src='/images/tms/default.jpeg'" class="media-object mr-3 avatar-customer-search mb-1"
                                     src='${idioma.avatar}'/>
                                     <div>
                                             <h4 class="mb-0 name-customer-search">${idioma.text}</h4>
                                             <p class="phone-customer-search">${idioma.phone}</p>
                                    </div>
                                </span>`);
                return $span;
            } else {
                return idioma.text;
            }
        },
        templateSelection : function (idioma) {
            let $span;
            if(idioma.selected){
                $span = $(`<span data-phone="${ idioma.phone }" class="d-flex align-items-center justify-content-lg-center select-update-customer-phone"
                  style="font-weight: 600;">${idioma.text}</span>`);
            }
            else{
                let textNoNuberPhone = '<span class="select2-selection__placeholder" style="font-weight: 400;">Nhập số điện thoại</span>';
                $span = $(`<span data-phone="${ idioma.phone }" class="d-flex align-items-center justify-content-lg-center select-update-customer-phone"
                  style="font-weight: 600;">${idioma.phone ? idioma.phone : textNoNuberPhone}</span>`);
            }
            return $span;
        }
    });

}

async function dataCreateCards() {
    let method = 'get',
        url = 'cards.data-create',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data,[$("#loading-modal-create-cards")]);
    $('#choose-card-create-cards').html(res.data[0]);
}

let checkSearchCustomerBookingTableManage = 0;

async function searchCustomerBookingTableManage() {
    if (checkSearchCustomerBookingTableManage === 1) return false;
    $('#phone-customer-create-cards').data('id', 0);
    $('#last-name-create-customer-booking-table-manage').val('');
    $('#first-name-create-customer-booking-table-manage').val('');

    let method = 'get',
        url = 'booking-table-manage.search-customer',
        phone = $('#phone-customer-create-cards').val(),
        branch = $('.select-branch').val(),
        params = {phone: phone, branch_id: branch},
        data = null;
    checkSearchCustomerBookingTableManage = 1;
    let res = await axiosTemplate(method, url, params, data, '');
    checkSearchCustomerBookingTableManage = 0;
    if (res.data[1].status === 200) {
        $('#data-search-customer-booking-table-manage').removeClass('d-none');
        $('#data-search-customer-booking-table-manage').html(res.data[0]);
    } else {
        let title = res.data.message,
            content = '',
            icon = 'warning';
        ErrorNotify(title, content, icon);
    }
}

async function saveModalCreateCards() {
    if(!checkValidateSave($('#modal-create-cards'))) return false;
    let name = $('#name-customer-create-cards').text();
    let title = '',
        content = 'Bạn có chắc muốn nạp thẻ cho khách hàng ' + '"'  + name + '"',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            if (saveCreateCards !== 0) {
                return false;
            }
            let customer = $('#phone-customer-create-cards').val(),
                branch_id = $('.select-branch').val(),
                restaurant_top_up_card_id = $('.custom-card-value-focus').data('id'),
                top_up_amount = removeformatNumber($('.custom-card-value-focus').children('a').text()),
                payment_method = $('#select-method-create-card-manage').val();
            if ($('#phone-customer-create-cards').val() === '') {
                WarningNotify('Vui lòng nhập số điện thoại khách hàng !');
                return false;
            }
            saveCreateCards = 1;
            console.log("payment_method ",payment_method);
            let method = 'post',
                url = 'cards.create',
                params = null,
                data = {
                    customer: customer,
                    branch_id: branch_id,
                    restaurant_top_up_card_id: restaurant_top_up_card_id,
                    top_up_amount: top_up_amount,
                    payment_method: payment_method,
                    restaurant_brand_id: $('.select-brand').val(),
                };
            let res = await axiosTemplate(method, url, params, data,[$("#loading-modal-create-cards")]);
            saveCreateCards = 0;
            if (res.data.status === 200) {
                let text = $('#success-create-data-to-server').text();
                SuccessNotify(text);
                if(payment_method != 1) {
                    addRowDatatableTemplate(tableWaitingConfirmCardMembership,{
                        'customer_name': res.data.data.customer_name,
                        'customer_phone': res.data.data.customer_phone,
                        'amount': res.data.data.amount,
                        'bonus_amount': res.data.data.bonus_amount,
                        'total_amount': res.data.data.total_amount,
                        'employee_create_name': res.data.data.employee_create_name,
                        'created_at': res.data.data.created_at,
                        'branch_name': res.data.data.branch_name,
                        'action': res.data.data.action,
                        'keysearch': res.data.data.keysearch,
                    })
                    $('#total-record-waiting-confirm-card').text(Number($('#total-record-waiting-confirm-card').text()) + 1);
                } else {
                    addRowDatatableTemplate(tableConfirmedCardMembership,{
                        'customer_name': res.data.data.customer_name,
                        'customer_phone': res.data.data.customer_phone,
                        'amount': res.data.data.amount,
                        'bonus_amount': res.data.data.bonus_amount,
                        'total_amount': res.data.data.total_amount,
                        'employee_create_name': res.data.data.employee_create_name,
                        'created_at': res.data.data.created_at,
                        'branch_name': res.data.data.branch_name,
                        'status_card': res.data.data.status_card,
                        'action': res.data.data.action,
                        'keysearch': res.data.data.keysearch,
                    })
                    $('#total-record-confirm-card').text(Number($('#total-record-confirm-card').text()) + 1);
                }
                closeModalCreateCards();
            } else {
                let text = $('#error-post-data-to-server').text();
                if (res.data.message !== null) {
                    text = res.data.message;
                }
                ErrorNotify(text);
            }
        }
    })
}

function closeModalCreateCards() {
    $('#modal-create-cards').modal('hide');
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add("F2", function () {
        openModalCreateCards();
    });
    $('#modal-create-cards .js-example-basic-single').val('').trigger('change.select2');
    $('#name-customer-create-cards').text('');
    $('#phone-customer-create-cards').val('').trigger('change.select2');
    removeAllValidate();
}

function reloadModalCreateCards(){
    $('#phone-customer-create-cards').val('').trigger('change.select2');
    $('#name-customer-create-cards').text('');
    $('#data-search-customer-booking-table-manage').html('');
    $('#select-method-create-card-manage').val('').trigger('change.select2')
    $('#modal-create-cards .btn-renew').addClass('d-none')
}
