let checkSearchCustomerCardMembership = 0, idUpdateCardsMembership = 0, phoneUpdateCardsMembership,isSearchCustomerCard=0,
    thisUpdateCustomerCard,phoneCustomerUpdateCards,checkSaveUpdateCustomerCards = 0;
$(function (){
    $('#phone-customer-update-cards').on('input paste focus', function () {
        if($(this).val() == ''){
            $('#data-search-customer-update-card-membership').addClass('d-none')
            $('#phone-customer-update-cards-div').attr('style', 'margin-bottom: 1.5rem !important')
        }else{
            searchCustomerCardMembership();
            $('#phone-customer-update-cards-div').attr('style', 'margin-bottom: 12.5rem !important')
        }
    });

    $(document).on('click', '.item-search-customer', function () {
        $('#data-search-customer-update-card-membership').addClass('d-none');
        $('#phone-customer-update-cards').val($(this).data('phone'));
        $('#name-customer-update-cards').text($(this).find('h4').text());
        $('#phone-customer-update-cards-div').attr('style', 'margin-bottom: 1.5rem !important')
    });

    $('#phone-customer-update-cards').on('change', function (){

        phoneUpdateCardsMembership = $(this).find('.select-update-customer-phone').data('phone');
    })
    $('#phone-customer-update-cards').select2({
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
        dropdownParent: $('#modal-update-cards'),
        templateResult: function (idioma) {
            if (!idioma.loading) {
                let $span = $(`<span data-phone="${ idioma.phone }" class="d-flex align-items-center justify-content-lg-start select-update-customer-phone list-data-customer-search">
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
            console.log(idioma)
            phoneUpdateCardsMembership = idioma.phone;
            // $('#name-customer-update-cards').text(idioma.text)
            let $span;
            if(idioma.selected){
                phoneUpdateCardsMembership=idioma.text
                  $span = $(`<span data-phone="${ idioma.phone }" class="d-flex align-items-center justify-content-lg-center select-update-customer-phone"
                  style="font-weight: 600;">${idioma.text}</span>`);
            }
            else{
                phoneUpdateCardsMembership=idioma.phone
                  $span = $(`<span data-phone="${ idioma.phone }" class="d-flex align-items-center justify-content-lg-center select-update-customer-phone"
                  style="font-weight: 600;">${idioma.phone}</span>`);
                  $('#name-customer-update-cards').text(idioma.text)
            }

            return $span;
        }
    });



})
function openModalUpdateCard(r){
    thisUpdateCustomerCard = r;
    $('#modal-update-cards .js-example-basic-single').select2({
        dropdownParent: $('#modal-update-cards'),
    });
    $('#modal-update-cards').modal('show');
    shortcut.remove('ESC');
    shortcut.remove('F2');
    shortcut.add("F4", function () {
        saveModalUpdateCards();
    });
    shortcut.add("ESC", function () {
        closeModalUpdateCards();
    });
    idUpdateCardsMembership = r.data('id');
    getDataDetailCardMemberShip(r);
}

async function getDataDetailCardMemberShip(r){
    let method = 'get',
        url = 'cards.data-update',
        params = {
            id: r.data('id')
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#select-method-update-card-manage').val(res.data.data.payment_method).trigger('change.select2');
    phoneCustomerUpdateCards = res.data.data.customer_phone;
    $('#phone-customer-update-cards').val(res.data.data.customer_phone);
    $('#name-customer-update-cards').text(res.data.data.customer_name);
    $('#phone-customer-update-cards').empty()
    let newOption = new Option(res.data.data.customer_phone, res.data.data.customer_id ,false, false);
    $('#phone-customer-update-cards').append(newOption);
    $('#modal-update-cards .select2-search__field').val(res.data.data.customer_phone);

}

async function searchCustomerCardMembership() {
    if (checkSearchCustomerCardMembership === 1) return false;
    let method = 'get',
        url = 'booking-table-manage.search-customer',
        phone = $('#phone-customer-update-cards').val(),
        branch = $('.select-branch').val(),
        params = {phone: phone, branch: branch},
        data = null;
    checkSearchCustomerCardMembership = 1;
    let res = await axiosTemplate(method, url, params, data, [$("#name-customer-create-cards")]);
    checkSearchCustomerCardMembership = 0;
    if (res.data[1].status === 200) {
        $('#data-search-customer-update-card-membership').removeClass('d-none');
        $('#data-search-customer-update-card-membership').html(res.data[0]);
    } else {
        let title = res.data.message,
            content = '',
            icon = 'warning';
        ErrorNotify(title, content, icon);
    }
}

async function saveModalUpdateCards(){
    let method = 'post',
        url = 'cards.update',
        params = {
            id: idUpdateCardsMembership,
            phone : phoneUpdateCardsMembership,
        },
        data = null;
    if(phoneCustomerUpdateCards == phoneUpdateCardsMembership) {
        SuccessNotify($('#success-update-data-to-server').text());
        checkSaveUpdateCustomerCards = 0;
        closeModalUpdateCards();
        return false;
    }
    if (checkSaveUpdateCustomerCards === 1) return false;
    checkSaveUpdateCustomerCards = 1;
    let res = await axiosTemplate(method, url, params, data);
    checkSaveUpdateCustomerCards = 0;
    switch(res.data.status) {
        case 200:
            SuccessNotify($('#success-update-data-to-server').text());
            thisUpdateCustomerCard.parents('tr').find('td:eq(1)').html(res.data.data.customer_name);
            thisUpdateCustomerCard.parents('tr').find('td:eq(2)').html(res.data.data.customer_phone);
            thisUpdateCustomerCard.parents('tr').find('td:eq(3)').html(res.data.data.amount);
            thisUpdateCustomerCard.parents('tr').find('td:eq(4)').html(res.data.data.bonus_amount);
            thisUpdateCustomerCard.parents('tr').find('td:eq(5)').html(res.data.data.total_amount);
            thisUpdateCustomerCard.parents('tr').find('td:eq(6)').html(res.data.data.employee_create_name);
            thisUpdateCustomerCard.parents('tr').find('td:eq(7)').html(res.data.data.created_at);
            thisUpdateCustomerCard.parents('tr').find('td:eq(8)').html(res.data.data.branch_name);
            thisUpdateCustomerCard.parents('tr').find('td:eq(9)').html(res.data.data.action);
            thisUpdateCustomerCard.parents('tr').find('td:eq(10)').html(res.data.data.keysearch);
            closeModalUpdateCards();
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify(res.data.message);
    }
}


function closeModalUpdateCards(){
    $('#modal-update-cards').modal('hide');
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add("F2", function () {
        openModalCreateCards();
    });
    $('#phone-customer-update-cards-div').attr('style', 'margin-bottom: 1.5rem !important');
    $('#data-search-customer-update-card-membership').addClass('d-none');
}

