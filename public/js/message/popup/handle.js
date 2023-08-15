// $(function (){

// $(document).mouseup(function (e) {
//     let container = $('.message-header-list');
//     if (!container.is(e.target) && container.has(e.target).length === 0 && !$('.message-header-list').hasClass('active')) {
//         $('.message-header-list').addClass('active');
//     }
// });
// $(document).on("click", "#hide-message-form", function () {
//     let tong = 0;
//     let plus = 0;
//     $(this).parents(".chat-form").remove();
//     let image = $(this).parents(".chat-form").find(".chat-avatar-image").attr('src');
//     let name = $(this).parents(".chat-form").data('name');
//     let type = $(this).parents(".chat-form").data('type');
//     let id = $(this).parents(".chat-form").data("id");
//     let html = `<li data-image="${image}" data-type="${type}" data-id="${id}" data-name="${name}" class="chat-queue-item">
//                 <div class="chat-queue-item-avatar">
//                     <img data-toggle="tooltip" data-placement="left" title="${name}" class="chat-queue-item-avatar-img" src="${image}" alt="" />
//                 </div>
//             </li>`;

//     let length = $(".chat-queue-item").length;

//     if (length > 3) {
//         if (length >= 4) {
//             plus += 1;
//         } else {
//             plus = length - 3;
//         }
//         if (tong > 0) {
//             $(".chat-queue-modal-numbe").text(plus);
//         }
//         if (tong === 0) {
//             $(".chat-queue-list").append(`
//             <li class="chat-queue-item loaikhac" id="chat-queue-item">
//                 <div class="chat-queue-item-avatar multi-chat-show">
//                     <img class="chat-queue-item-avatar-img" src="https://source.unsplash.com/100x100/?animal" alt="" />
//                 </div>
//                 <div class="chat-queue-modal">
//                     <span class="chat-queue-modal-numbe"></span><span class="chat-queue-modal-plus">+</span>
//                 </div>
//             </li>
//         `);
//             tong++;
//             $(".chat-queue-modal-numbe").text(plus);
//         }
//     } else {
//         $("#chat-queue-list").prepend(html);
//     }
//     $('[data-toggle="tooltip"]').tooltip({
//         trigger: 'hover'
//     });
// });
// $(".chat-footer-message-input").on("input", function () {
//     if ($(this).text() == "") {
//         $(".chat-footer-option").show();
//         $("#chat-footer-send").addClass("d-none");
//         $("#chat-footer-like").removeClass("d-none");

//         $(".chat-footer").css("position", "");
//         $(".chat-footer").css("bottom", "");
//     } else {
//         $(".chat-footer-option").hide(300);
//         $(".chat-footer-message").css("width", "95%");
//         $(".chat-footer").css("width", "95%");

//         $("#chat-footer-like").addClass("d-none");
//         $("#chat-footer-send").removeClass("d-none");
//     }
// });


$(function () {
    $(document).on('click','.chat-item-sidebar',function () {
        checkNumberFormPopup = false;
        let name = $(this).data("name");
        let img = $(this).attr("data-image");
        let typeName = $(this).data("type-name");
        idCurrentConversation = $(this).data("id");
        typeCurrentConversationPopup = $(this).data("type");

        let html = `<div class="chat-form" data-id="${idCurrentConversation}">
                        <div class="chat-header">
                            <div class="chat-header-info">
                                <div class="chat-header-info-avatar">
                                    <div class="chat-header-avatar">
                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="chat-avatar-image" src="${img}" alt="" />
                                        <span class="chat-status online-status"></span>
                                    </div>
                                    <div class="header-chat-display">
                                        <p class="header-chat-display-name"><b>${name}</b></p>
                                        <p class="header-chat-display-category">${typeName}</p>
                                    </div>
                                    <div class="header-chat-display-option">
                                        <i class="header-chat-display-icon bx bx-chevron-down"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="chat-box-tools">
                                <div class="box-tools-flex">
                                    <div class="chat-box-tools-link">
                                        <i class="box-tools-icon bx bxs-phone"></i>
                                    </div>
                                    <div class="chat-box-tools-link">
                                        <i class="box-tools-icon bx bxs-video"></i>
                                    </div>
                                    <div class="mini chat-box-tools-link" id="hide-message-form">
                                        <i class="box-tools-icon bx bx-minus icon-font-size-22"></i>
                                    </div>
                                    <div class="chat-box-tools-link icon-font-size close-popup">
                                        <i class="box-tools-icon bx bx-x icon-font-size-22"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat-body">
                            <div class="chat-body-message" id="chat-body-message-popup">
                                <div class="chat-bubble d-none" id="typing-data-message-visible-message">
                                    <div class="typing">
                                        <div class="dot"></div>
                                        <div class="dot"></div>
                                        <div class="dot"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat-footer">
                            <div class="chat-footer-other-action">
                                <i class="chat-footer-option-icon bx bxs-plus-circle"></i>
                            </div>
                            <div class="chat-footer-option">
                                <div class="chat-footer-option-sticker">
                                    <i class="chat-footer-option-icon fa fa-github-alt"></i>
                                </div>
                                <div class="chat-footer-option-images">
                                    <label for="chat-footer-option-image" class="mb-0">
                                        <i class="chat-footer-option-icon fa fa-file-image-o"></i>
                                        <input type="file" name="file" id="chat-footer-option-image" class="d-none" />
                                    </label>
                                </div>
                                <div class="chat-footer-option-file">
                                    <label for="chat-footer-option-file" class="mb-0">
                                        <i class="chat-footer-option-icon fa fa-file"></i>
                                        <input type="file" name="file" id="chat-footer-option-file" class="d-none" />
                                    </label>
                                </div>
                            </div>
                            <div class="chat-footer-message">
                                <div contenteditable placeholder="Aa" class="chat-footer-message-input"></div>
                                <i class="chat-footer-message-animation chat-footer-option-icon bx bxs-smile" id="emoji-button"></i>
                            </div>
                            <div class="chat-footer-send">
                                <button class="chat-footer-send-button" id="chat-footer-like">
                                    <i class="chat-footer-option-icon bx bxs-like"></i>
                                </button>
                                <button class="chat-footer-send-button d-none" id="chat-footer-send">
                                    <i class="chat-footer-option-icon bx bxs-send"></i>
                                </button>
                            </div>
                        </div>
                    </div>`;

        $(".chat-form").each(function () {
            if ($(this).data("id") == idCurrentConversation) {
                checkNumberFormPopup = true;
                html = "";
            }
        });
        let length = $(".chat-form").length;
        if (length >= 2) {
            if (checkNumberFormPopup) {
            } else {
                $(".chat-form:last").remove();
                $(".chat-contain").prepend(html);
                $('.chat-form:nth-child(3)').find('.chat-footer-message-input').focus();
            }
        } else {
            if (checkNumberFormPopup) {
            } else {
                $(".chat-contain").prepend(html);
                $('.chat-form:last-child()').find('.chat-footer-message-input').focus();
            }

        }
        dataMessageConversationPopup();
    })

})


