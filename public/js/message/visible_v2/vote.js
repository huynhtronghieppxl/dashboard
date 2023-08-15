let countVoteMax = 0, idDetailVote;
let isExistOption=false
$(function () {
    /** Đóng modal **/
    $('#modal-vote-visible-message').on('hidden.bs.modal', function () {
       closeModalVoteVisibleMessage()
    });
    /** Thêm vote **/
    $('#add-vote-visible-message').on('click', function () {
        $('#list-votes-visible-message').append(`<div class="vote-option-visible-message flex-column">
                        <input class="empty-input-vote" type="text" placeholder="Nhập lựa chọn" data-validate="empty">
                        <p class="option-exist-vote mb-1 seemt-red d-none"  >Lựa chọn được thêm đã tồn tại </p>
                        <i class="ti-close"></i>
                    </div>`);
        $('.vote-option-visible-message:last').focus();
    });
    /** Kiểm tra vote đủ 2 option **/
    $(document).on('click', '#list-votes-visible-message .vote-option-visible-message .ti-close', function () {
        if ($('#list-votes-visible-message').find('.vote-option-visible-message').length > 2) {
            $(this).parents('.vote-option-visible-message').remove();
        }
    });
    /** Kiểm tra nhập chủ đề vote **/
    $(document).on('input paste', '#title-vote-visible-message', function () {
        let hiddenP=$(this).parents('.modal-body').find('.empty-input-vote').parents('.vote-option-visible-message').find('p:not(.d-none)').length
        if ($(this).val() === ''  || hiddenP>0) {
            $('#modal-vote-visible-message .modal-footer .btn.btn-grd-primary').addClass('disabled');
            $('#modal-vote-visible-message .modal-footer .btn.btn-grd-primary').attr('disabled');
            return false;
        } else {
            let val = $(this).parents('.modal-body').find('.empty-input-vote')
            let allInputsFilled = 0;
            val.each(function() {
                if ($(this).val().trim() != '') {
                    allInputsFilled++
                }
            });
            if (allInputsFilled >=2 ) {
                $('#modal-vote-visible-message .modal-footer .btn.btn-grd-primary').removeClass('disabled');
                $('#modal-vote-visible-message .modal-footer .btn.btn-grd-primary').removeAttr('disabled');
            }
            else {
                $('#modal-vote-visible-message .modal-footer .btn.btn-grd-primary').addClass('disabled');
                $('#modal-vote-visible-message .modal-footer .btn.btn-grd-primary').attr('disabled');
            }
        }
    });
    $(document).on('input paste', '.empty-input-vote', function () {
        let input = $(this);
        let values = [];
        input.parents('.votes-group-visible-message').find('p').addClass('d-none')
        input.parents('.votes-group-visible-message').find('.empty-input-vote').each(function(index,element) {
            let value = $(element).val().trim();
            values.push(value);
        });
        input.parents('.votes-group-visible-message').find('.empty-input-vote').each(function(index, element) {
            let value = $(element).val().trim();
            if (value !== '' && values.indexOf(value) !== index) {
                let matchingInputs = input.parents('.votes-group-visible-message').find('.empty-input-vote').filter(function (i, el) {
                    return $(el).val().trim() === value;
                });
                matchingInputs.each(function (i, el) {
                    $(el).parents('.vote-option-visible-message').find('p').removeClass('d-none');
                    $('#modal-vote-visible-message .modal-footer .btn.btn-grd-primary').addClass('disabled');
                    $('#modal-vote-visible-message .modal-footer .btn.btn-grd-primary').attr('disabled');
                });
            }
        })
        if(input.parents('.votes-group-visible-message').find('.empty-input-vote').parents('.vote-option-visible-message').find('p:not(.d-none)').length>0) return
        if ($(this).parents('.modal-body').find('#title-vote-visible-message').val() === '') {
            $('#modal-vote-visible-message .modal-footer .btn.btn-grd-primary').addClass('disabled');
            $('#modal-vote-visible-message .modal-footer .btn.btn-grd-primary').attr('disabled');
            return false;
        } else {
            let val = $(this).parents('.modal-body').find('.empty-input-vote')
            let allInputsFilled = 0;
            val.each(function() {
                if ($(this).val().trim() != '') {
                    allInputsFilled++
                }
            });
            if (allInputsFilled >=2 ) {
                $('#modal-vote-visible-message .modal-footer .btn.btn-grd-primary').removeClass('disabled');
                $('#modal-vote-visible-message .modal-footer .btn.btn-grd-primary').removeAttr('disabled');
            }
            else {
                $('#modal-vote-visible-message .modal-footer .btn.btn-grd-primary').addClass('disabled');
                $('#modal-vote-visible-message .modal-footer .btn.btn-grd-primary').attr('disabled');
            }
        }
    });


    /** Update vote **/
    socket.on('res-view-vote/' + idSession, async data => {
        $('#list-option-detail-vote-visible-message').html('');
        $('#title-detail-vote-visible-message').text(data.message_vote.title);
        $('#user-create-detail-vote-visible-message').html(`Tạo bởi <span style="font-size: 11px !important;color: #f8af51;">${data.sender.full_name}</span> - ${moment(data.message_vote.time_create, 'YYYY/MM/DD HH:mm:ss').format('HH:mm DD/MM/YYYY')}`);
        $('#user-detail-vote-visible-message').html(data.message_vote.number_user_vote + `lượt tham gia, ${data.message_vote.number_vote} lượt bình chọn<i class="ion-arrow-right-b"></i>`);
        let index = 0;
        jQuery.each(data.message_vote.list_option, function (i, v) {
            if (v.id !== -1) {
                index++;
                let check = (v.isActive === true) ? 'checked' : '';
                let user, width;
                if (index === 1) {
                    width = (v.list_user.length === 0) ? 0 : 100;
                    countVoteMax = v.list_user.length;
                } else {
                    width = rateTemplate(v.list_user.length, countVoteMax);
                }
                switch (v.list_user.length) {
                    case 0:
                        user = '';
                        break;
                    case 1:
                        user = ` <div class="display-inline user-seen-message vertical-middle">
                                    <div class="users-thumb-list">
                                        <a data-toggle="tooltip" data-original-title="${v.list_user[0].full_name}">
                                            <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" alt=""
                                                 src="${domainSession + v.list_user[0].avatar}">
                                        </a>
                                    </div>
                                </div>`;
                        break;
                    default:
                        user = ` <div class="display-inline user-seen-message vertical-middle">
                                    <div class="users-thumb-list">
                                        <a data-toggle="tooltip" data-original-title="${v.list_user[0].full_name}">
                                            <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" alt=""
                                                 src="${domainSession + v.list_user[0].avatar}">
                                        </a>
                                        <a data-toggle="tooltip" data-original-title="${v.list_user.length - 1} người khác">
                                            <span class="icon-vote-more"><i class="typcn typcn-group"></i></span>
                                        </a>
                                    </div>
                                </div>`;
                }
                $('#list-option-detail-vote-visible-message').append(`<div class="item-detail-vote" data-id="${v.id}">
                        <div class="checkbox-fade fade-in-primary m-0 p-0 vertical-middle">
                            <label class="m-0 p-0">
                                <input type="checkbox" ${check} data-check="${v.isActive}"/>
                                <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                            </label>
                        </div>
                        <div class="display-inline div-item-vote">
                             <div class="item-vote">
                                <div class="div-vote" style="width: ${width}%;"></div>
                                <div class="content-vote">
                                     <span>${v.content}</span>
                                </div>
                                <div class="count-vote">${v.list_user.length}</div>
                             </div>
                        </div>
                        ${user}
                    </div>`);
            }
        })
        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'hover'
        });
    });

    $('#add-detail-vote-visible-message').on('click', function () {
        $('#list-option-detail-vote-visible-message').append(`
                <div class="item-new-vote">
                    <div class="checkbox-fade fade-in-primary m-0 p-0 vertical-middle">
                         <label class="m-0 p-0">
                             <input type="checkbox"/>
                             <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                         </label>
                    </div>
                    <div class="option-detail-vote-option-visible-message">
                         <input type="text" placeholder="Nhập lựa chọn"><i class="ti-close"></i>
                    </div>
                </div>`);
        $('#modal-detail-vote-visible-message .btn-grd-primary').removeClass('d-none');
    })

    $(document).on('click', '#list-option-detail-vote-visible-message .option-detail-vote-option-visible-message .ti-close', function () {
        $(this).parents('.item-new-vote').remove();
        if ($('#list-option-detail-vote-visible-message .item-new-vote').length === 0) {
            $('#modal-detail-vote-visible-message .btn-grd-primary').addClass('d-none');
        }
    })

    $(document).on('click', '.div-item-vote', function () {
        $(this).parents('.item-detail-vote').find('input[type="checkbox"]').click();
    })

    $(document).on('click', '#list-option-detail-vote-visible-message input[type="checkbox"]', async function () {
        await voteOption($(this).parents('.item-detail-vote'));
        calcUserVote();
        checkCheckedVote();
    })

    $(document).on('mouseup', function (e) {
        if (!$('.modal-vote-visible-message').is(":visible")) {
            $('.vote-visible-message').removeClass('active');
        }
    });
})

/**
 * Vote
 */
function closeModalVoteVisibleMessage() {
    $('#list-votes-visible-message').html(`
                   <div class="vote-option-visible-message flex-column">
                        <input class="empty-input-vote" type="text" placeholder="Nhập lựa chọn">
                        <p class="option-exist-vote mb-1 seemt-red d-none">Lựa chọn được thêm đã tồn tại</p>
                   </div>
                   <div class="vote-option-visible-message flex-column">
                        <input class="empty-input-vote" type="text" placeholder="Nhập lựa chọn">
                        <p class="option-exist-vote mb-1 seemt-red d-none">Lựa chọn được thêm đã tồn tại</p>
                   </div>`);
    $('#setting-vote-visible-message input').prop('checked', true);
    $('#pin-vote-visible-message').prop('checked', false);
    $('#title-vote-visible-message').val('');
    $('#modal-vote-visible-message').modal('hide');
    $('.vote-visible-message').removeClass('active');
}

/** Lưu vote **/
async function saveModalVoteVisibleMessage() {
    if (checkOptionEmptyVote() === 1) return false;
    let listOption = [];
    let key = 'key-identification-' + moment().format('x');
    for await (const v of $('#list-votes-visible-message').find('.vote-option-visible-message')) {
        listOption.push({
            content: $(v).find('input').val(),
            id: listOption.length,
            isActive: false,
            list_user: []
        })
    }
    listOption.push({
        content: "",
        id: -1,
        isActive: false,
        list_user: []
    });
    if (checkIdEmpty(idCurrentConversation, idSession)) return false;
    let data = {
        member_id: idSession,
        group_id: idCurrentConversation,
        message_type: 27,
        message_vote: {
            title: $('#title-vote-visible-message').val(),
            list_option: listOption,
            multi_chose: ($('#setting-vote-visible-message input:eq(0)').prop('checked') === true) ? 1 : 0,
            allow_add_option: ($('#setting-vote-visible-message input:eq(1)').prop('checked') === true) ? 1 : 0,
            deadline: "",
            lock_vote: ($('#pin-vote-visible-message').prop('checked') === true) ? 1 : 0,
        },
        key_message_error: key
    }
    closeModalVoteVisibleMessage();
    //hardcode
    $('#body-visible-message').prepend(`<div class="chat-body-message-element notify-message-container">
                                                    <div class="body-message-vote">
                                                        <div class="div-body-message-vote">
                                                            <div class="title-message-vote">Code không</div>
                                                            <div class="member-message-vote"><span>Đã có 1 người bình chọn<i class="ion-arrow-right-b"></i></span></div>
                                                            <div style="position: relative;">
                                                                <div class="item-vote">
                                                                    <div class="div-vote" style="width:50%;"></div>
                                                                    <div class="content-vote"><span>Code</span></div>
                                                                    <div class="count-vote">10</div>
                                                                </div>
                                                                <div class="item-vote">
                                                                    <div class="div-vote" style="width:25%;"></div>
                                                                    <div class="content-vote"><span>Không code</span></div>
                                                                    <div class="count-vote">5</div>
                                                                </div>
                                                            </div>
                                                            <span class="other-vote-message-vote ">Còn 3 sự lựa chọn khác</span>
                                                            <div class="pin-details-content-item-bottom">
                                                                <button class="button-message-vote" onclick="openModalDetailVoteVisibleMessage(123)">Xem bình chọn</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>`);
    // socket.emit('create-vote', data);
}

/**
 * Detail vote
 */
function openModalDetailVoteVisibleMessage(id) {
    $('#modal-detail-vote-visible-message').modal('show');
    let data = {
        group_id: idCurrentConversation,
        member_id: idSession,
        random_key_message_vote: id.toString()
    }
    idDetailVote = id;
    socket.emit('view-vote', data);
}

async function voteOption(r) {
    let vote = parseInt(r.find('.count-vote').text());
    if (r.find('input[type="checkbox"]').prop('checked') === true) {
        r.find('.count-vote').text(vote + 1);
        if (parseInt(r.find('.count-vote').text()) > countVoteMax) countVoteMax = parseInt(r.find('.count-vote').text());
    } else {
        r.find('.count-vote').text(vote - 1);
        let arrVote = [];
        for await (const v of $('#list-option-detail-vote-visible-message .count-vote')) {
            arrVote.push(parseInt($(v).text()));
        }
        countVoteMax = arrVote.sort().reverse()[0];
    }
}

function calcUserVote() {
    $('#list-option-detail-vote-visible-message .item-detail-vote').each(function (i, v) {
        $(v).find('.div-vote').css('width', rateTemplate(parseInt($(v).find('.count-vote').text()), countVoteMax) + '%');
    })
}

function checkCheckedVote() {
    $('#list-option-detail-vote-visible-message .item-detail-vote input').each(function (i, v) {
        if ($(v).data('checked') !== $(this).prop('checked')) {
            $('#modal-detail-vote-visible-message .btn-grd-primary').removeClass('d-none');
            return false;
        }
    })
}

function saveModalDetailVoteVisibleMessage() {
    addVoteVisibleMessage();
    voteVisibleMessage();
    closeModalDetailVoteVisibleMessage();
}

async function addVoteVisibleMessage() {
    let option = [];
    for await (const v of $('#list-option-detail-vote-visible-message .item-new-vote')) {
        if ($(v).find('.option-detail-vote-option-visible-message input').val() !== '') {
            option.push({
                content: $(v).find('.option-detail-vote-option-visible-message input').val(),
                id: $('#list-option-detail-vote-visible-message .item-detail-vote').length + option.length,
                isActive: $(v).find('input[type="checkbox"]').prop('checked'),
                list_user: ($(v).find('input[type="checkbox"]').prop('checked')) ?
                    [{
                        avatar: avatarSession,
                        member_id: idSession,
                        full_name: nameSession
                    }] : []
            })
        }
    }
    if (option.length > 0) {
        let data = {
            member_id: idSession,
            group_id: idCurrentConversation,
            random_key: idDetailVote.toString(),
            option: option
        }
        socket.emit('add-option-vote', data);
    }
}

async function voteVisibleMessage() {
    let vote = [];
    for await (const v of $('#list-option-detail-vote-visible-message .item-detail-vote input:checked')) {
        if ($(v).data('check') === false) {
            vote.push($(v).parents('.item-detail-vote').data('id'))
        }
    }
    if (vote.length > 0) {
        let data = {
            member_id: idSession,
            group_id: idCurrentConversation,
            random_key: idDetailVote.toString(),
            id: vote
        }
        socket.emit('user-vote', data);
    }
}

function closeModalDetailVoteVisibleMessage() {
    $('#modal-detail-vote-visible-message').modal('hide');
    $('#modal-detail-vote-visible-message .btn-grd-primary').addClass('d-none');
    $('#title-detail-vote-visible-message').text('');
    $('#user-detail-vote-visible-message').html('');
    $('#list-option-detail-vote-visible-message').html('');
    $('.layout-action-input-visible-message .vote-visible-message').removeClass('active');
    $('.vote-visible-message').removeClass('active');
}

function checkOptionEmptyVote() {
    let checkEmpty = 0;
    $("#modal-vote-visible-message").find('.vote-option-visible-message input').each(function (index) {
        if ($(this).val() === '') {
            checkEmpty = 1;
        }
    });
    // if (checkEmpty === 1) {
    //     $('.alert-empty-option-vote').removeClass('d-none');
    //     return 1;
    // } else {
    //     $('.alert-empty-option-vote').addClass('d-none')
    //     return 0;
    // }
}
