let tableEnableMembershipCardBrand,
    focusStatusMembershipCard = 0,
    idBranch = -1,
    checkSaveUpdateSettingBranchMembershipCard = 0, checkSaveBranchMembershipCard = 0,
    checkChangeStatusBranchMembershipCard = 0, checkSaveSettingMembershipCard = 0, checkChangeAllStatusBranchMembershipCard = 0,
    tabCurrentRestaurantMemberShipCard = 0, typeSettingRestaurantMemberShipCard = 0,tableListMemberShipCard;
$(function () {
    if (getCookieShared('cookieMediaRestaurant')) {
        let data = JSON.parse(getCookieShared('cookieMediaRestaurant'));
        tabCurrentRestaurantMemberShipCard = data.tab;
        typeSettingRestaurantMemberShipCard = data.type;
    }
    if (typeSettingRestaurantMemberShipCard !== 0) {
        $('#list-branch-membership').addClass('d-none');
        $('#list-branch-membership .branch-setting-detail[data-type="' + tabCurrentRestaurantMemberShipCard + '"]').click();
    }
    shortcut.remove('F2');
    shortcut.add("F2",function() {
        openModalCreateMemberShipCard();
    });
    $('#change_branch').prop('disabled', true);
    $(document).on('input', '.input-maximum', function () {
        $(this).parents('td').find('label').text($(this).val());
    });

    $('#btn-back-list-branch').click(function () {
        typeSettingRestaurantMemberShipCard = 0;
        $('#list-branch-membership').removeClass('d-none');
        $('#data-membershipcard').addClass('d-none');
        $(this).addClass('d-none');
        $('#mySidenav-321').addClass('d-none');
        $('#action-membership-card').removeClass('d-none');
        $('#action-membership-card').addClass('d-flex');
        updateCookie();
    });
    let id = ['use-guide-setting-restaurant-membership-card', 'term-setting-restaurant-membership-card','update-use-guide-setting-restaurant-membership-card', 'update-term-setting-restaurant-membership-card'];
    ckEditorTemplate(id);
});

async function loadData() {
    loadDataMembership();
}

function updateCookie() {
    saveCookieShared('cookieMediaRestaurant', JSON.stringify({
        'tab': tabCurrentRestaurantMemberShipCard,
        'type': typeSettingRestaurantMemberShipCard
    }))
}

async function loadDataMembership(id) {
    let method = 'get',
        url = 'restaurant-membership-card.data',
        params = {
            restaurant_brand_id: id,
            idBranch: idBranch,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $("#table-list-member-ship-card"),
        $("#table-branch-enable-member-ship-card"),
        $("#table-branch-disable-member-ship-card"),
    ]);
    if (res.status == '200') {
        dataTableMemberShipCard(res);
        dataTotalMemberShipCard(res.data[3]);
    }
}

async function dataTableMemberShipCard(data) {
    let scroll_Y = '45vh',
        fixed_left = 2,
        fixed_right = 0,
        idTableListMemberShipCard = $('#table-list-member-ship-card'),
        idTableBranchEnableMemberShipCard = $('#table-branch-enable-member-ship-card'),
        idTableBranchDisableMemberShipCard = $('#table-branch-disable-member-ship-card'),
        column1 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'color', name: 'color', className: 'text-center'},
            {data: 'total_amount_to_level_up', name: 'total_amount_to_level_up', className: 'text-center'},
            {data: 'cashback_to_point_percent', name: 'cashback_to_point_percent', className: 'text-center'},
            {
                data: 'month_to_expire_promotion_point',
                name: 'month_to_expire_promotion_point',
                className: 'text-center'
            },
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ],
        column2 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'phone', name: 'phone', className: 'text-center'},
            {data: 'address', name: 'address', className: 'text-center'},
            {data: 'maximum', name: 'maximum', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ],
        option = [{
            'title': 'Thêm mới (F2)',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'openModalCreateMemberShipCard',
        }]
    tableListMemberShipCard = await DatatableTemplateNew(idTableListMemberShipCard, data.data[0].original.data, column1, scroll_Y, fixed_left, fixed_right, option);
    tableEnableMembershipCardBrand = await DatatableTemplateNew(idTableBranchEnableMemberShipCard, data.data[1].original.data, column2, scroll_Y, fixed_left, fixed_right, option);
    DatatableTemplateNew(idTableBranchDisableMemberShipCard, data.data[2].original.data, column2, scroll_Y, fixed_left, fixed_right, option);
}

function dataTotalMemberShipCard(data) {
    $('#total-record-tab1-restaurant-membership-card').text(data.total_record_list);
    $('#total-record-tab2-restaurant-membership-card').text(data.total_record_branch_enable);
    $('#total-record-tab3-restaurant-membership-card').text(data.total_record_branch_disable);
}

async function callApiChangeStatusRestaurantMembershipCard(r) {
    $('#modal-setting-restaurant-membership-card').modal('show');
    $('#check-setting-restaurant-membership-card').on('change', function () {
        if ($(this).is(':checked') === true) {
            $('#btn-save-setting-restaurant-membership-card').removeClass('d-none');
            shortcut.remove('F4');
        } else {
            $('#btn-save-setting-restaurant-membership-card').addClass('d-none');
            shortcut.add('F4', function () {
                saveModalSettingMembershipCard();
            });
        }
    });
}

async function saveModalSettingBranchMembershipCard(r) {
    if (checkSaveUpdateSettingBranchMembershipCard === 1) return false;
    checkSaveUpdateSettingBranchMembershipCard = 1;
    let method = 'post',
        url = 'restaurant-membership-card.update-status-branch',
        id = idBranch,
        status = 1,
        params = null,
        data = {
            id: id,
            status: status
        };
    let res = await axiosTemplate(method, url, params, data, [$('#tab1-restaurant-membership-card')]);
    checkSaveUpdateSettingBranchMembershipCard = 0;
    if (res.data.status === 200) {
        let success = $('#success-status-data-to-server').text();
        SuccessNotify(success);
        $('#modal-setting-restaurant-membership-card').modal('hide');
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
    }
}

async function saveBranchMemberShipCard() {
    if (checkSaveBranchMembershipCard === 1) return false;
    checkSaveBranchMembershipCard = 1;
    let method = 'post',
        url = 'restaurant-membership-card.update-branch',
        id = r.data('id'),
        maximum = removeformatNumber(r.parents('tr').find('input.input-maximum').val()),
        params = null,
        data = {id: id, maximum: maximum};
    let res = await axiosTemplate(method, url, params, data);
    checkSaveBranchMembershipCard = 0;
    if (res.data.status === 200) {
        let success = $('#success-update-data-to-server').text();
        SuccessNotify(success);
        r.parents('tr').find('input.input-maximum').addClass('d-none');
        r.parents('tr').find('button.btn-save').addClass('d-none');
        r.parents('tr').find('label.label-maximum').removeClass('d-none');
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
    }
}

async function changeAllStatusBranchMemberShipCard(r) {
    if (checkChangeAllStatusBranchMembershipCard === 1) return false;
    status = r.data('status');
    if (focusStatusMembershipCard === 0) {
        let title = 'Tạm ngưng thẻ thành viên cho chi nhánh này ?',
            content = '',
            icon = 'warning';
        sweetAlertComponent(title, content, icon).then(async (result) => {
            if (result.value) {
                checkChangeAllStatusBranchMembershipCard = 1;
                let method = 'post',
                    url = 'restaurant-membership-card.setting',
                    params = {
                        status: status
                    },
                    data = null;
                let res = await axiosTemplate(method, url, params, data);
                checkChangeAllStatusBranchMembershipCard = 0;
                if (res.data[0].status === 200) {
                    let success = $('#success-status-data-to-server').text();
                    SuccessNotify(success);
                    $('#action-membership-card').removeClass('d-flex justify-content-end');
                    $('#action-membership-card').addClass('d-none');
                    $('.page-wrap').removeClass('d-none');
                    $('#list-branch-membership').addClass('d-none')
                    $('#page-body-setting-restaurant-membership-card').removeClass('d-none')
                    location.href = '/restaurant-membership-card';
                } else {
                    let text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    ErrorNotify(text);
                }
                r.prop('checked', false);
            }
            else {
                focusStatusMembershipCard = 1;
                r.click();
                focusStatusMembershipCard = 0;
            }
        })
    }
}

async function changeStatusBranchMemberShipCard(r) {
    if (checkChangeStatusBranchMembershipCard === 1) return false;
    status = r.data('status');
    idBranch = r.data('id');
    if (focusStatusMembershipCard === 0) {
        if (r.data('status') === 1) {
            let title = 'Tạm ngưng thẻ thành viên cho chi nhánh này ?',
                content = '',
                icon = 'warning';
            sweetAlertComponent(title, content, icon).then(async (result) => {
                if (result.value) {
                    checkChangeStatusBranchMembershipCard = 1;
                    let method = 'post',
                        url = 'restaurant-membership-card.update-status-branch',
                        id = r.data('id'),
                        maximum = removeformatNumber(r.parents('tr').find('input.input-maximum').val()),
                        status = r.data('status'),
                        params = null,
                        data = {
                            id: id,
                            maximum: maximum,
                            status: status
                        };
                    let res = await axiosTemplate(method, url, params, data);
                    checkChangeStatusBranchMembershipCard = 0;
                    switch (res.data.status) {
                        case 200:
                            SuccessNotify($('#success-status-data-to-server').text());
                            location.href = '/restaurant-membership-card';
                            break;
                        case 500:
                            ErrorNotify($('#error-post-data-to-server').text());
                            break;
                        default:
                            WarningNotify($('#error-post-data-to-server').text());
                    }
                    r.prop('checked',true);
                }
                else {
                    focusStatusMembershipCard = 1;
                    r.click();
                    focusStatusMembershipCard = 0;
                }
            })
        } else {
            let title = 'Bật thẻ thành viên cho chi nhánh này ?',
                content = '',
                icon = 'warning';
            sweetAlertComponent(title, content, icon).then(async (result) => {
                if (result.value) {
                    let method = 'post',
                        url = 'restaurant-membership-card.update-status-branch',
                        id = r.data('id'),
                        maximum = removeformatNumber(r.parents('tr').find('input.input-maximum').val()),
                        status = r.data('status'),
                        params = null,
                        data = {
                            id: id,
                            maximum: maximum,
                            status: status
                        };
                    let res = await axiosTemplate(method, url, params, data);
                    checkChangeStatusBranchMembershipCard = 0;
                    switch (res.data.status) {
                        case 200:
                            SuccessNotify($('#success-status-data-to-server').text());
                            location.href = '/restaurant-membership-card';
                            break;
                        case 500:
                            ErrorNotify($('#error-post-data-to-server').text());
                            break;
                        default:
                            WarningNotify($('#error-post-data-to-server').text());
                    }
                    r.prop('checked',true);
                }else{
                    focusStatusMembershipCard = 1;
                    r.click();
                    focusStatusMembershipCard = 0;
                }
            })

        }
    }
}

async function saveModalSettingMembershipCardRestaurant() {
    if (checkSaveSettingMembershipCard === 1) return false;
    let
        // condition = CKEDITOR.instances['condition-setting-restaurant-membership-card'].getData(),
        // point = CKEDITOR.instances['point-setting-restaurant-membership-card'].getData(),
        // benefit = CKEDITOR.instances['benefit-setting-restaurant-membership-card'].getData(),
        // level = CKEDITOR.instances['level-setting-restaurant-membership-card'].getData(),
        use_guide = CKEDITOR.instances['use-guide-membership-card'].getData(),
        policy = CKEDITOR.instances['term-setting-membership-card'].getData(),

        amount = $('#percent-amount-setting-restaurant-membership-card').val(),
        alo_point = removeformatNumber($('#percent-amount-alo-point-in-each-bill').val()),
        amount_alo_point = removeformatNumber($('#alo-point-allow-use-in-each-bill').val());
    checkSaveSettingMembershipCard = 1;
    let method = 'post',
        url = 'restaurant-membership-card.setting',
        params = {
            use_guide : use_guide,
            policy : policy,
            amount: amount,
            amount_alo_point: amount_alo_point,
            alo_point: alo_point,
            id: idBranch,
            status: 0
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    checkSaveSettingMembershipCard = 0;
    if (res.data[0].status === 200 && res.data[1].status === 200) {
        $('#action-membership-card').removeClass('d-none');
        $('#action-membership-card').addClass('d-flex justify-content-end');
        $('#page-body-setting-restaurant-membership-card').addClass('d-none')
        $('#list-branch-membership').removeClass('d-none');
        closeModalSettingMembershipCard();
        location.href = '/restaurant-membership-card';
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
        return false;
    }
}

async function detailMemberShipCard(r) {
   typeSettingRestaurantMemberShipCard = 1;
   idBranch = r.data('id');
   $('#list-branch-membership').addClass('d-none');
   $('#data-membershipcard').removeClass('d-none');
   $('#btn-back-list-branch').removeClass('d-none');
   await $('#mySidenav-321').removeClass('d-none');
   countSideNavWidth();
   loadDataMembership(idBranch);
   updateCookie();
   $('#action-membership-card').removeClass('d-flex');
   $('#action-membership-card').addClass('d-none');
    }


function closeModalSettingMembershipCard() {
    $('#modal-setting-restaurant-membership-card').modal('hide');
    $('#is_enable_membership_card').prop('checked', false);
    $('#check-setting-restaurant-membership-card').prop('checked', false);
    $('#btn-save-setting-restaurant-membership-card').addClass('d-none');
    $('#percent-amount-setting-restaurant-membership-card').val('0');
    $('#percent-amount-alo-point-in-each-bill').val('0');
    $('#alo-point-allow-use-in-each-bill').val('0');
}
