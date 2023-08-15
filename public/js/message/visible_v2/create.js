$(function () {
    /**
     * Sự kiện nhấn hai lần vào thành viên group chat để tạo cuộc trò chuyện riêng
     */
    $(document).on('click', '.create-two-personal-conversation', function () {
        createChatTwoPeople($(this));
    });
    $(document).on('click', '.create-two-personal-conversations', function () {
        createChatTwoPeople($(this));
    });
    $(document).on('click', '.dropdown.dropdown-action-user-about', function (event) {
        event.stopPropagation();
    });
    $('.select-brand').on('change', function () {
        $('.user-list-create').empty();
        $('.user-list-create').html(' <div class="select-friend">Chọn nhân viên</div>');
        $('.create-group-right').empty()
        $('.create-group-right').addClass('transition-active-hiden');
        setTimeout(function () {
            dataRoleVisibleMessage()
            openModalEmployeeVisibleMessage()
        }, 2000)
    })
    $('.select-branch').on('change', function () {
        $('.user-list-create').empty();
        $('.user-list-create').html(' <div class="select-friend">Chọn nhân viên</div>');
        $('.create-group-right').addClass('transition-active-hiden');
        $('.create-group-right').empty()
        dataRoleVisibleMessage()
        openModalEmployeeVisibleMessage()
    })
    uploadMediaCropTemplate($('input.upload-avt'), $('.image-about.upload-avt'), 3, null);
    $(document).on('click', '.user-list-create .create-group__list-check input', function () {
        let role_id = $(this).attr('data-id')
        if ($(this).prop('checked')) {
            let bg, icon_bg;
            if ($(this).attr('data-type') == 0) {
                bg = 'check-task-right-role'
                icon_bg = 'icon-remove-user-after-click-bg-role'
                $(".user-list-create .create-group__list-check .part-group").each(function () {
                    if ($(this).attr('data-role') == role_id) {
                        $(this).parents('.create-group__list-check').find('input').prop('disabled', true)
                        $(this).parents('.create-group__list-check').find('input').prop('checked', true)
                        $(this).parents('.create-group__list-check').find('.cr-item-list-user').addClass('disabled')
                    }
                })
                $(".create-group__list-check-right .check-task-right-employee").each(function () {
                    if ($(this).parents('.create-group__list-check-right').attr('data-role') == role_id) {
                        $(this).parents('.create-group__list-check-right').remove()
                    }
                })
            } else {
                bg = 'check-task-right-employee'
                icon_bg = 'icon-remove-user-after-click-bg-employee'
            }
            $(".create-group-right").append(`<div class="create-group__list-check-right data count-item" data-id="${$(this).data('id')}" data-name="${$(this).data("name")}" data-role="${$(this).data("role")}" data-role-name="${$(this).data("role-name")}" data-avatar="${$(this).data("avatar")}">
                            <div class="to-do-list-popup-create-group">
                                <div class="checkbox-fade checkbox-fade-right fade-in-primary">
                                    <label class="check-task ${bg}">
                                          <img src="${domainSession + $(this).data("avatar")}" onerror="this.onerror=null; src='/images/tms/default.jpeg'" class="img-user-popup-create-group "  alt="" />
                                        <span class="name-user-popup-create-group name-user-popup-create-group-right">${$(this).data("name")} <i class="ion-close-circled icon-remove-user-after-click ${icon_bg}"  data-role="${role_id}"></i></span>
                                    </label>
                                </div>
                            </div>
                        </div>`);
        } else {
            $('.create-group-right .create-group__list-check-right[data-id="' + $(this).parents('.create-group__list-check').data('id') + '"]').remove();
            if ($(this).attr('data-type') == 0) {
                $(".user-list-create .create-group__list-check .part-group").each(function () {
                    if ($(this).attr('data-role') == role_id) {
                        $(this).parents('.create-group__list-check').find('input').prop('disabled', false)
                        $(this).parents('.create-group__list-check').find('input').prop('checked', false)
                        $(this).parents('.create-group__list-check').find('.cr-item-list-user').removeClass('disabled')
                    }
                })

            }
        }
        checkUserMinLengthAddTransition();
    })
    $(document).on('click', '.user-list-create-member .create-group__list-check input', function () {
        if ($(this).prop('checked')) {
            $(".create-add-member").append(`<div class="create-group__list-check-right data count-item" data-id="${$(this).data('id')}" data-name="${$(this).data("name")}" data-role="${$(this).data("role")}" data-role-name="${$(this).data("role-name")}" data-avatar="${$(this).data("avatar")}">
                            <div class="to-do-list-popup-create-group">
                                <div class="checkbox-fade checkbox-fade-right fade-in-primary">
                                    <label class="check-task check-task-right">
                                          <img src="${domainSession + $(this).data("avatar")}" onerror="this.onerror=null; src='/images/tms/default.jpeg'" class="img-user-popup-create-group "  alt="" />
                                        <span class="name-user-popup-create-group name-user-popup-create-group-right">${$(this).data("name")} <i class="ion-close-circled icon-remove-user-after-click"></i></span>
                                    </label>
                                </div>
                            </div>
                        </div>`);
        } else {
            $('.create-add-member .create-group__list-check-right[data-id="' + $(this).parents('.create-group__list-check').data('id') + '"]').remove();
        }
        checkUserMinLengthAddTransitionAbout();
    })

    $(document).on("click", ".icon-remove-user-after-click", function () {
        $('.create-group__list-check[data-id="' + $(this).parents(".create-group__list-check-right").data('id') + '"] input').prop('checked', false);
        let role_id = $(this).attr('data-role')
        $(this).parents(".create-group__list-check-right").remove();
        if ($(this).hasClass('icon-remove-user-after-click-bg-role')) {
            $(".user-list-create .create-group__list-check .part-group").each(function () {
                if ($(this).attr('data-role') == role_id) {
                    $(this).parents('.create-group__list-check').find('input').prop('disabled', false)
                    $(this).parents('.create-group__list-check').find('input').prop('checked', false)
                    $(this).parents('.create-group__list-check').find('.cr-item-list-user').removeClass('disabled')
                }
            })
        }
        checkUserMinLengthAddTransition();
    });

    $(".filter-partition-item").on("click", function () {
        $(".module-filter-partition span").removeClass("filter-partition-active");
        $(this).addClass("filter-partition-active");
    });

    $('.right-tool-refesh').on('click', function () {
        $(this).addClass('d-none');
        $('.title-filter-not-read').removeClass('d-none') && $(".right-tool").removeClass('d-none') && $('.title-filter-all').removeClass('d-none') && $('.right-tool').css('opacity', '1') && $('.title-filter-all').css('opacity', '1') && $('.marker-filter').removeClass('width-maker')
        $('.title-filter-all').click();
        $('.module-reset-filter-classify').click();
    })

    $('.create-group').on('change', function () {
        if ($(this).prop('checked')) {
            $('.popup-create-gr').html('Công việc');
            $('.tag-work').addClass('tag-orange');
            $('.tag-work').removeClass('tag-friend');
            $('.option-work').removeClass('d-none');
        } else {
            $('.popup-create-gr').html('Nhóm');
            $('.tag-work').removeClass('tag-orange');
            $('.tag-work').addClass('tag-friend');
            $('.option-work').addClass('d-none');
        }
    });

    $(document).on('click', '#open-form-new-conversation', function () {
        $('.icofont-ui-office').click();
    })

    $('.icofont-ui-office').on('click', function () {
        $('#modal-create-group-chat-visible-message').modal('show');
        dataRoleVisibleMessage();
        openModalEmployeeVisibleMessage();
    });

    $('#open-modal-employee-filter-visible-message').on('click', function () {
        $('#modal-employee-visible-message').modal('show');
        openModalEmployeeVisibleMessage();
    });

    $('.input-search').on("input", function () {
        let g = removeVietnameseStringLowerCase($(this).val());
        $(".user-list-create-member .name-user-popup-create-group-left").each(function () {
            let s = removeVietnameseStringLowerCase($(this).text());
            $(this).closest('.create-group__list-check')[s.indexOf(g) !== -1 ? 'show' : 'hide']();
        });
    });

    $('#search-employee-visible-message').on("input", function () {
        let g = removeVietnameseStringLowerCase($(this).val());
        $("#data-employee-visible-message .owl-item").each(function () {
            let s = removeVietnameseStringLowerCase($(this).text());
            $(this)[s.indexOf(g) !== -1 ? 'show' : 'hide']();
        });
    });

    $('.upload-avt').on('change', function () {
        $('.row-pop-ups .upload-avt').removeClass('error-form')
    });

    $('.icon-add-member-visible-message').click(function () {
        openModalEmployeeVisibleMessage()
    });

    $('#search-member-create-group').on("input", function () {
        let g = removeVietnameseStringLowerCase($(this).val());
        let height = 0
        $(".create-group__list-check").each(function () {
            let s = removeVietnameseStringLowerCase($(this).text());
            $(this)[s.indexOf(g) !== -1 ? 'show' : 'hide']();
            if ($(this).is(":visible")) {
                height += $(this).outerHeight(true)
            }
        });
        if (height < $('.row-list-user').outerHeight(true)) {
            $(".user-list-create").css('overflow-y', 'hidden');
        } else $(".user-list-create").css('overflow-y', 'scroll');
        console.log(height, $('.row-list-user').outerHeight(true))

    });

    /**
     * Xóa thành viên cuộc trò chuyện
     */
    $(document).on('click', '#layout-about-visible-message .remove-member', function () {
        removeUserGroup($(this));
    })

    /**
     * Bổ nhiệm phó nhóm thành viên cuộc trò chuyện
     */
    $(document).on('click', '#layout-about-visible-message .promote-member', function () {
        addPermisionGroup($(this));
    })

    /**
     * Xóa cuộc trò chuyện tin nhắn
     */
    $(document).on('click', '#layout-about-visible-message .remove-group-chat', function () {
        removeGroup($(this));
    })
});

function checkUserMinLengthAddTransition() {
    // let a = $('#modal-create-group-chat-visible-message .create-group__list-check-right.count-item').length;
    let a = $('#modal-create-group-chat-visible-message .create-group__list-check input:checked').filter(function () {
        return $(this).parents('.create-group__list-check').find('.part-group').length > 0;
    }).length;
    let b = $('#modal-create-group-chat-visible-message .create-group__list-check input:checked').filter(function () {
        return $(this).parents('.create-group__list-check').find('.part-group').length == 0;
    }).length;
    if (a >= 1 || b>=1) {
        $('.error-select-user').html('');
        $('.create-group-right').removeClass('transition-active-hiden');
    } else {
        $('.error-select-user').html('');
        $('.create-group-right').addClass('transition-active-hiden');
    }
    $('#modal-create-group-chat-visible-message .select-friend-right').text('Đã chọn ' + a + '/' + $('#modal-create-group-chat-visible-message .create-group__list-check .part-group').length);
}

function checkUserMinLengthAddTransitionAbout() {
    let a = $('#modal-add-member-group-chat-visible-message .create-group__list-check-right.count-item').length;
    if (a >= 1) {
        $('.error-select-user').html('');
        $('.create-add-member').removeClass('transition-active-hiden');
    } else {
        $('.error-select-user').html('');
        $('.create-add-member').addClass('transition-active-hiden');
    }
    $('#modal-add-member-group-chat-visible-message .select-friend-right-about').text('Đã chọn ' + a + '/' + $('.create-group__list-check ').length);
}

let dataEmployeeVisibleMessage = [];

async function openModalEmployeeVisibleMessage() {

    // if (dataEmployeeVisibleMessage.length === 0) {
    let method = 'get',
        url = 'visible-message.data-employee',
        params = {
            brand: $('.select-branch').val(),
            restaurant_brand_id: $('.select-brand').val()
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('.user-list-create')
    ]);
    dataEmployeeVisibleMessage = res.data[0];
    $('#data-employee-visible-message').html(res.data[0]);
    $('.user-list-create-member').html(res.data[1]);
    $('.user-list-create').append(res.data[1]);
    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover'
    });
    jQuery.each(dataMemberConversation, function (i, v) {
        $('.user-list-create-member .create-group__list-check[data-id="' + v.member_id + '"] input').prop('disabled', true);
        $('.user-list-create-member .create-group__list-check[data-id="' + v.member_id + '"] input').prop('checked', true);
        $('.user-list-create-member .create-group__list-check[data-id="' + v.member_id + '"] span.cr-item-list-user').addClass('disabled-add-member-visible-message');

    })

}

let loadDataRoleVisibleMessage = "";

async function dataRoleVisibleMessage() {
    // if (loadDataRoleVisibleMessage === "") {
    // axios({
    //     method: 'get',
    //     url: 'visible-message.data-role',
    //     params: {
    //         brand: $('#restaurant-branch-id-selected span').attr('data-value')
    //     }
    // }).then(function (res) {
    //     loadDataRoleVisibleMessage = res;
    //     $('#data-role-create-group-chat-visible-message').html(res.data[0]);
    // })
    let method = 'get',
        url = 'visible-message.data-role',
        brand = $('.select-branch').val(),
        params = {
            brand: brand
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('.user-list-create')
    ]);
    loadDataRoleVisibleMessage = res;
    // $('#data-role-create-group-chat-visible-message').html(res.data[0]);
    $('.user-list-create').prepend(res.data[0]);
    // } else {
    //     $('#data-role-create-group-chat-visible-message').html(loadDataRoleVisibleMessage.data[0]);
    // }
}

function checkCountUser() {
    checkValueInputAddGroup = false;
    let number_of_users_selected = $('#modal-create-group-chat-visible-message').find('.check-task-right-employee').length;
    // let number_of_role_selected = $('#data-role-create-group-chat-visible-message .check-task-left input:checkbox:checked').length;
    let number_of_role_selected = $('#modal-create-group-chat-visible-message').find('.check-task-right-role').length;
    if ($('.input-name').val() === '') {
        $('.row-pop-ups:first .input-name').addClass('error-form');
        checkValueInputAddGroup = true;
    }
    console.log(number_of_users_selected, number_of_role_selected)
    if (number_of_users_selected < 2) {
        if (number_of_role_selected === 0) {
            $('.error-select-user').html('Bạn cần chọn 1 bộ phần hoặc 2 thành viên trở lên')
            checkValueInputAddGroup = true;
        } else {
            $('.error-select-user').html('')
        }
    } else {
        $('.error-select-user').html('')
    }
    //
    // if ($('#modal-create-group-chat-visible-message .image-about').attr('data-src') === '') {
    //     $('.upload-avt').addClass('error-form')
    //     checkValueInputAddGroup = true;
    // }

    return checkValueInputAddGroup;
}

async function createConversation() {
    if (checkCountUser()) return false;
    let roles = [],members=[]
        // member = [{
        //     "member_id": idSession,
        //     "role_id": roleSession,
        //     "role_name": roleNameSession,
        //     "avatar": avatarSession,
        //     "full_name": nameSession,
        // }];

    $('.create-group-right .create-group__list-check-right').each(function (i, v) {
        if($(v).find('.check-task-right-role').length){
           roles.push($(v).data('id'))
        }
        else {
            members.push($(v).data('id'))
        }
    });

    axios({
        method: 'post',
        url: 'visible-message.create-conversation-group',
        data: {
            name:$('.input-name-add-group').find('.input-name').val(),
            object_type:($('.popup-create-gr').text() === 'Nhóm') ? 3 : 2,
            avatar: $('.image-about.upload-avt').attr('data-media-id'),
            members:members,
            roles: roles,
        }
    }).then(function (res) {
        closeModalCreateConversationVisibleMessage();
        $('#data-conversation-visible-message-restaurant .item-conversation-visible-message:eq(0)').click();
        let db = {
            members: member,
            member_id: idSession,
            group_id: res.data.data._id,
            conversation_type: res.data.data.conversation_type,
        }
        socket.emit('new-group-created', db);
    })
}

function closeModalCreateConversationVisibleMessage() {
    $('.create-group').prop('checked', true);
    $('.switchery.switchery-small').attr('style', 'background-color: rgb(0, 113, 187); border-color: rgb(0, 113, 187); box-shadow: rgb(0 113 187) 0px 0px 0px 8.5px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s, background-color 1.2s ease 0s;');
    $('#layout-left-visible-message .switchery > small').attr('style', 'left: 25px');
    $('.row-pop-ups:first .input-name').val('');
    $('.image-about.upload-avt').data('src', '');
    $('.image-about.upload-avt').attr('src', '/images/tms/default.jpeg');
    $('#modal-create-group-chat-visible-message .change-content input').prop('checked', true);
    $('.popup-create-gr').html('Công việc');
    $('.tag-work').addClass('tag-orange');
    $('.tag-work').removeClass('tag-greens');
    $('.tag-work').removeClass('tag-friend');
    $('.option-work').removeClass('d-none');
    $('#data-role-create-group-chat-visible-message input').prop('checked', false);
    $('.user-list-create input').prop('checked', false);
    $('.create-group-right .create-group__list-check-right').remove();
    $('.input-search').val('');
    $('#modal-create-group-chat-visible-message').modal('hide');
    $('.error-select-user').html('');
    $('.row-pop-ups:first .input-name').removeClass('error-form');
    $('.upload-avt').removeClass('error-form');
    $('.select-friend-right').text('Đã chọn ' + 0 + '/' + $('.create-group__list-check').length);
    $('.create-group-right').addClass('transition-active-hiden');
    $('.create-group__list-check').show();
    $('.user-list-create').animate({scrollTop: 0}, 0);
    $('.user-list-create').empty();
    $('.user-list-create').html(' <div class="select-friend">Chọn nhân viên</div>');

}

function closeModalEmployeeVisibleMessage() {
    $('#search-employee-visible-message').val('');
    $('#modal-employee-visible-message').modal('hide');
}

async function createConversationFromTagVisibleMessage(r) {
    let member = [{
        "member_id": idSession,
        "role_id": roleSession,
        "role_name": roleNameSession,
        "full_name": nameSession,
    }, {
        "member_id": r.data('id'),
        "role_id": r.data('role'),
        "role_name": r.data('role-name'),
        "full_name": r.data('name'),
    }];
    axios({
        method: 'post',
        url: 'visible-message.create-conversation-personal',
        data: {
            type: 2,
            member: member,
            name: r.data('name'),
            branch: $('#change_branch').val(),
            avatar: r.data('avatar'),
            roles: [],
        }
    }).then(function (res) {
        $('#data-conversation-visible-message-restaurant .item-conversation-visible-message[data-id="' + res.data.data._id + '"]').remove();
        $('#data-conversation-visible-message-restaurant').prepend(`<li class="item-conversation-visible-message box-user active" data-id="${res.data.data._id}" data-type="${res.data.data.conversation_type}">
                    <div class="user_chat">
                            <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="${domainSession + res.data.data.member.avatar}" data-src="${res.data.data.member.avatar}" alt="" class="img_userchat">
                    <div class="content">
                            <h9 class="name pl-0 pr-0">${res.data.data.member.full_name}</h9>
                            <div class="Message-preview-and-category-tags">
                                <i class="fa fa-tag tag-greens"></i>
                           <p class="info-mess">${res.data.data.last_message}</p>
                    </div>
                        </div>
                        <div class="option">
                            <span class="time-last-message-conversation">${res.data.data.created_last_message}</span>
                            <div>
                                 <div class="notifycation pl-0 pr-0"></div>
                            </div>
                        </div>
                    </div>
                </li>`);

        $('#data-conversation-visible-message-restaurant .item-conversation-visible-message:eq(0)').click();
        let db = {
            members: member,
            member_id: idSession,
            group_id: res.data.data._id,
            conversation_type: 2,
        }
        console.log('new-group-created', db);
        socket.emit('new-group-created', db);
    })
}

/**
 * sự kiện kiểm tra phím nhập nếu rỗng và không rỗng
 */
$('.row-pop-ups:first .input-name').on('keypress', function () {
    if ($('.input-name').val() != null) {
        $('.row-pop-ups .text-danger').html('')
        $('.row-pop-ups:first .input-name').removeClass('error-form')
    } else {
        $('.row_of_group_pop-ups-name-group .text-danger').html('Không được nhập trống')
        $('.row-pop-ups:first .input-name').addClass('error-form')
    }
})

function removeUserGroup(r) {
    let title = 'Xóa thành viên này khỏi nhóm',
        content = '',
        icon = 'warning';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            axios({
                method: 'post',
                url: 'visible-message.remove-user-group',
                data: {
                    id_group: r.parents('.row-member').data('group-id'),
                    member_id: r.parents('.row-member').data('member-id'),
                }
            }).then(function (res) {
                console.log(res);
            })
        }
        console.log(dataMemberConversation);
    })
}


function addPermisionGroup(r) {
    let title = 'Thêm thành viên này làm phó nhóm',
        content = '',
        icon = 'warning';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            axios({
                method: 'post',
                url: 'visible-message.authorized',
                data: {
                    id: r.parents('.row-member').data('group-id'),
                    member_id: r.parents('.row-member').data('member-id')
                }
            }).then(function (res) {
                console.log(res);
                r.remove();
            })
            r.parents('.row-member').find('.img-members-about').append('<i class="fa fa-key key-member-detail-visible-message"></i>');
        }
        console.log(dataMemberConversation);
    })
}


function saveModalAddMemberConversationVisibleMessage() {
    let data_id = $('.item-conversation-visible-message.active').data('id');
    $('.checkbox-fade:first input').prop('checked', 'true');
    let member = [{
        "member_id": idSession,
        "role_id": roleSession,
        "role_name": roleNameSession,
        "avatar": avatarSession,
        "full_name": nameSession,
    }];
    $('.create-add-member .create-group__list-check-right').each(function (i, v) {
        member.push({
            "member_id": $(v).data('id'),
            "role_id": $(v).data('role'),
            "role_name": $(v).data('role-name'),
            "avatar": $(v).data('avatar'),
            "full_name": $(v).data('name'),
            "number": 0,
            "tag_name": 1,
            "is_notification": 1,
            "is_join_room": 0,
            "normalize_name": "",
            "prefix": "",
            "permissions": 0,
        })
    })
    axios({
        method: 'post',
        url: 'visible-message.add-user-group',
        data: {
            id: data_id,
            member: member,
        }
    }).then(function (res) {
        console.log(res);
    })

    closeModalAddMemberConversationVisibleMessage();

}

function leaveGroupUser(r) {
    let title = 'Bạn muốn rời nhóm ?',
        content = 'Rời nhóm sẽ đồng thời xóa toàn bộ tin nhắn của nhóm đó. Bạn có muốn tiếp tục?',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let data_id = $('.item-conversation-visible-message.active').data('id');
            axios({
                method: 'post',
                url: 'visible-message.leave-user-group',
                data: {
                    id: data_id,
                    member_id: idSession,
                }
            }).then(function (res) {
                console.log(res)
                let countRemoveUser = $('#member-about-visible-message').data('employee');
                --countRemoveUser;
                $('.header-chat-number_employee').text(countRemoveUser + ' thành viên');
                $('.number-person-about').text(countRemoveUser);
                $('#member-about-visible-message').attr('data-employee', countRemoveUser);
                $('#layout-body-visible-message').addClass('d-none');
                $('#layout-about-visible-message').addClass('d-none');
                $('li.item-conversation-visible-message.active').remove();
                leaveRoomGroupPersonal();

            })
        }
    })
}

function removeGroup() {
    let title = 'Bạn muốn giải tán nhóm ?',
        content = 'Giản tán nhóm sẽ đồng thời xóa toàn bộ tin nhắn của nhóm đó. Bạn có muốn tiếp tục?',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            axios({
                method: 'post',
                url: 'visible-message.disband-group',
                data: {
                    id: idCurrentConversation,
                }
            }).then(function (res) {
                console.log(res);
                $('#layout-body-visible-message').addClass('d-none');
                $('#layout-about-visible-message').addClass('d-none');
                $('li.item-conversation-visible-message.active').remove();
                leaveRoomGroupPersonal();
                $('.message-header-list-body').find('.message-header-item[data-id="' + idCurrentConversation + '"]').remove();
                $('.chat-box-tools-link.icon-font-size.close-popup').click();
            })
        }
    })
}

function createChatTwoPeople(r) {
    axios({
        method: 'post',
        url: 'visible-message.create-conversation-personal',
        data: {
            user_id: r.data('member-id')
        }
    }).then(function (res) {
        console.log(res);
        $('#div-empty-conversation').remove();
        $('#data-conversation-visible-message-restaurant .item-conversation-visible-message[data-id="' + res.data.data._id + '"]').remove();
        $('#data-conversation-visible-message-restaurant').prepend(`<li class="item-conversation-visible-message box-user" data-id="${res.data.data._id}" data-type="${res.data.data.conversation_type}">
                    <div class="user_chat">
                            <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="${domainSession + res.data.data.member.avatar}" data-src="${res.data.data.member.avatar}" alt="" class="img_userchat">
                    <div class="content">
                            <h9 class="name pl-0 pr-0">${res.data.data.member.full_name}</h9>
                            <div class="Message-preview-and-category-tags">
                                <i class="zmdi zmdi-label-alt tag-greens"></i>
                           <p class="info-mess">${res.data.data.last_message}</p>
                    </div>
                        </div>
                        <div class="option">
                            <span class="time-last-message-conversation">Vừa xong</span>
                            <div>
                                 <div class="notifycation pl-0 pr-0"></div>
                            </div>
                        </div>
                    </div>
                </li>`);
        $('#data-conversation-visible-message-restaurant .item-conversation-visible-message[data-id=' + res.data.data._id + ']').click();
        let db = {
            members: member,
            member_id: idSession,
            group_id: res.data.data._id,
            conversation_type: 2,
        }
        closeModalEmployeeVisibleMessage();
        socket.emit('new-group-created', db);
    })
}
