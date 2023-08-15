async function renderMessageText(data) {
    if ($('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').length === 1) {
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("id", data.random_key);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-position", data.position_message);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-id", data._id);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-random-key", data.random_key);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-type", data.message_type);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-name", data.sender.full_name);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-sender", data.sender.member_id);
    } else {
        for (const v of data.list_tag_name) {
            data.message = data.message.replace(v.key_tag_name, `<span class="tag-name">@${v.full_name}</span>`);
        }
        // for await (const v of data.list_link) {
        //     data.message = data.message.replace(v, `<a class="body-message-link" href="${v}" target="_blank">${v}</a>`);
        // }
        data.message = data.message.replaceAll(' \n ','<br>');
        let header = "",
            classBody = "";
        if (data.sender.member_id === idSession) {
            header = `<div class="chat-body-message-element message-right" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}" data-identification="${data.key_message_error}">`;
        } else if ($(".chat-body-message-element:first").data("sender") == data.sender.member_id && ["1", "2", "3", "4", "5", "6", "7", "8"].includes($(".chat-body-message-element:first").attr("data-type"))) {
            header = `<div class="chat-body-message-element message-left margin-item" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}" data-identification="${data.key_message_error}">`;
            classBody = "margin-right-50px";
        } else {
            header = `<div class="chat-body-message-element message-left" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${
                data.message_type
            }" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}" data-identification="${data.key_message_error}">
                           <span class="chat-body-message-element-name-text">${data.sender.full_name}</span>
                           <img  onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="chat-body-message-element-avatar" src="${domainSession + data.sender.avatar}">`;
        }
        $("#data-message-visible-message").prepend(`${header}<div class="chat-body-message ${classBody}">
                                                                 ${data.notify}
                                                                <div class="chat-body-message-text">${data.message}</div>
                                                                 ${footerMessage(data.sender.member_id, data.created_at)}
                                                            </div>
                                                        </div>`);
    }
}

async function renderMessageNotify(data) {
    if ($('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').length === 1) {
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("id", data.random_key);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-position", data.position_message);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-id", data._id);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-random-key", data.random_key);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-type", data.message_type);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-name", data.sender.full_name);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-sender", data.sender.member_id);
    } else {
        for await (const v of data.list_tag_name) {
            data.message = data.message.replace(v.key_tag_name, `<span class="tag-name">@${v.full_name}</span>`);
        }
        // for await (const v of data.list_link) {
        //     data.message = data.message.replace(v, `<a class="body-message-link" href="${v}" target="_blank">${v}</a>`);
        // }
        data.message = data.message.replaceAll(' \n ','<br>');
        let header = "",
            classBody = "";
        if (data.sender.member_id === idSession) {
            header = `<div class="chat-body-message-element message-right" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}" data-identification="${data.key_message_error}">`;
        } else if ($(".chat-body-message-element:first").data("sender") == data.sender.member_id && ["1", "2", "3", "4", "5", "6", "7", "8"].includes($(".chat-body-message-element:first").attr("data-type"))) {
            header = `<div class="chat-body-message-element message-left margin-item" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}" data-identification="${data.key_message_error}">`;
            classBody = "margin-right-50px";
        } else {
            header = `<div class="chat-body-message-element message-left" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${
                data.message_type
            }" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}" data-identification="${data.key_message_error}">
                           <span class="chat-body-message-element-name-text">${data.sender.full_name}</span>
                           <img  onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="chat-body-message-element-avatar" src="${domainSession + data.sender.avatar}">`;
        }
        $("#data-message-visible-message").prepend(`${header}<div class="chat-body-message ${classBody}">
                                                                <div class="content-notify">
                                                                    <i class="fa fa-exclamation mr-1"></i> Quan trọng
                                                                </div>
                                                                <div class="chat-body-message-text">${data.message}</div>
                                                                 ${footerMessage(data.sender.member_id, data.created_at)}
                                                            </div>
                                                        </div>`);
    }
}

async function renderMessageLink(data) {
    if ($('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').length === 1) {
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("id", data.random_key);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-position", data.position_message);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-id", data._id);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-random-key", data.random_key);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-type", data.message_type);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-name", data.sender.full_name);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-sender", data.sender.member_id);
    } else {
        for (const v of data.list_tag_name) {
            data.message = data.message.replace(v.key_tag_name, `<span class="tag-name">@${v.full_name}</span>`);
        }
        for await (const v of data.list_link) {
            data.message = data.message.replace(v, `<a class="body-message-link" href="${v}" target="_blank">${v}</a>`);
        }
        let header = "",
            body = "",notify='';
            classBody = "";
        if (data.sender.member_id === idSession) {
            header = `<div class="chat-body-message-element message-right" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}" data-identification="${data.key_message_error}">`;
        } else if ($(".chat-body-message-element:first").data("sender") == data.sender.member_id && ["1", "2", "3", "4", "5", "6", "7", "8"].includes($(".chat-body-message-element:first").attr("data-type"))) {
            header = `<div class="chat-body-message-element message-left margin-item" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}" data-identification="${data.key_message_error}">`;
            classBody = "margin-right-50px";
        } else {
            header = `<div class="chat-body-message-element message-left" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${
                data.message_type
            }" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}" data-identification="${data.key_message_error}">
                           <span class="chat-body-message-element-name-text">${data.sender.full_name}</span>
                           <img  onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="chat-body-message-element-avatar" src="${domainSession + data.sender.avatar}">`;
        }

        if (data.message_link.cannonical_url.includes('youtube.com') === true || data.message_link.cannonical_url.includes('youtu.be') === true) {
            let link = data.message_link.cannonical_url.replace("https://", "").replace("http://", "");
            let lastLink;
            if(link.includes('&list')) {
                lastLink = link.indexOf('&list');
            }
            else {
                lastLink = link.length
            }
            let keyId = link.substring(link.indexOf("watch?v=") + 8, lastLink);
            let mainLink = data.message_link.cannonical_url.replace("https://", "").replace("http://", "").split("/").at(0);
            let convertUrl = ("https://").concat(mainLink).concat("/embed/").concat(keyId);
            body = `<div class="chat-message-link-thumbnail">
                         <iframe type="text/html" width="100%" loading="lazy" height="100%" src="${convertUrl}" frameborder="0" allowfullscreen> </iframe>
                    </div>`;
        } else {
            let domainLinkPreview = data.message_link.cannonical_url.replace("https://", "").replace("http://", "").split("/").at(0);
            body = `<div class="chat-message-link-text">
                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  class="img-preview-body-chat" src="${data.message_link.media_thumb}" loading="lazy"/>
                        <div class="chat-message-link-info-title-link">
                             <div class="preview-lin-visible-message">
                                  <a class="chat-message-link-info-title-link" target="_blank" href="${data.message_link.cannonical_url}"> ${data.message_link.title} </a>
                                  <a target="_blank" href="${data.message_link.cannonical_url}" class="chat-message-link-info-title-link-preview"> ${domainLinkPreview} </a>
                             </div>
                        </div>
                    </div>`;
        }
        $("#data-message-visible-message").prepend(`${header}<div class="chat-body-message ${classBody}">
                                                                ${data.notify}
                                                                <div class="chat-body-message-text-link">
                                                                ${data.message}
                                                                </div>
                                                                 ${body}
                                                                 ${footerMessage(data.sender.member_id, data.created_at)}
                                                            </div>
                                                        </div>`);
        $('#data-link-about-visible-message').prepend(`<div class="hover-link-file" data-url="${data.message_link.cannonical_url}">
                                                                <div class="link-group-items">
                                                                    <div class="media-item">
                                                                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="link-thumb-img" src="${data.message_link.media_thumb}" alt="" />
                                                                        <div class="info-link">
                                                                            <div class="info-link-title"></div>
                                                                            <div class="group-subtitle">
                                                                                <div class="info-link-subtitle">${data.message_link.description}</div>
                                                                                <span class="info-link-date set-interval-message" data-time="${data.created_at}">Vài giây</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>`)
    }
}

async function renderMessageImage(data) {
    if ($('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').length === 1) {
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("id", data.random_key);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').data("position", data.position_message);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').data("id", data._id);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').data("random-key", data.random_key);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').data("type", data.message_type);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').data("name", data.sender.full_name);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').data("sender", data.sender.member_id);
    } else {
        let imageSocket = await countImage(data);
        let header = "", classBody = "";
        if (data.sender.member_id === idSession) {
            header = `<div class="chat-body-message-element message-right" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}" data-identification="${data.key_message_error}">`;
        } else if ($(".chat-body-message-element:first").data("sender") == data.sender.member_id && ["1", "2", "3", "4", "5", "6", "7", "8"].includes($(".chat-body-message-element:first").attr("data-type"))) {
            header = `<div class="chat-body-message-element message-left margin-item" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}" data-identification="${data.key_message_error}">`;
            classBody = "margin-right-50px";
        } else {
            header = `<div class="chat-body-message-element message-left" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}" data-identification="${data.key_message_error}">
                           <span class="chat-body-message-element-name-text">${data.sender.full_name}</span>
                           <img  onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="chat-body-message-element-avatar" src="${domainSession + data.sender.avatar}">`;
        }
        $("#data-message-visible-message").prepend(`${header}<div class="chat-body-message ${classBody}">
                                            ${imageSocket}
                                            ${footerMessage(data.sender.member_id, data.created_at)}
                                    </div>
                                </div>`);
    }
    if(data.files[0].name_file !== 'icon_like') {
        let detailImage = "";
        let dataTotalImage = parseInt($("#number-img").text());
        for await (const v of data.files) {
            $('#data-image-about-visible-message').find('.see-item-image-video-grid:eq(5)').remove();
            $("#data-image-about-visible-message").prepend(`<div class="see-item-image-video-grid">
                                                                <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="see-item-image-video-grid-img" src="${v.link_original}" data-link-original="${v.link_original}" data-name = "${v.name_file}">
                                                                <div class="see-item-image-video-grid-download">
                                                                    <i class="fa fa-download"></i>
                                                                </div>
                                                            </div>`);
            detailImage += `<div class="item-image-about-see-all-visible-message" data-link-original="${v.link_original}" data-name="${v.name_file}">
                             <img class="image-tab-about-visible-message img-view" onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" src="${v.link_original}" loading="lazy" alt="" data-link-original="${v.link_original}">
                             <div class="icon-dowload-about-visible-message see-item-image-video-grid-download icon-dowload-image-detail icon-download-hover">
                                  <i class="fa fa-download"></i>
                             </div>
                        </div>`;
        }
        loadImg();
        if ($("#detail-about-images-visible-message .hide-img-by-date-about-visible-message:first").text() === moment(data.created_at).format("DD/MM/YYYY")) {
            $("#detail-about-images-visible-message .slide-to-top:first").prepend(detailImage);
        } else {
            $("#detail-about-images-visible-message").prepend(`<div class="media border-color-about">
            <div class="title-img-video"><span class="hide-img-by-date-about-visible-message">${moment(data.created_at).format("DD/MM/YYYY")}</span>
                <div class="hidden-general-info">
                    <i class="fa fa-sort-down"></i>
                </div>
            </div>
            <div class="slide-to-top">${detailImage}</div>
        </div>`);
        }
        if ($('#data-image-about-visible-message .see-item-image-video-grid').length > 0) {
            $("#image-list-about-visible-message").find(".ans").css("display", "block");
            $('.empty-content').addClass('d-none');
            $('#number-img').text((data.files.length) + dataTotalImage);
        }
        if ($('#data-image-about-visible-message .see-item-image-video-grid').length >= 6) {
            $('.see-list-image-video-grid-see-all.image').removeClass('d-none')
        } else {
            $('.see-list-image-video-grid-see-all.image').addClass('d-none')
        }
    }
}

async function renderMessageVideo(data) {
    console.log(1234567, data)
    if ($('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').length === 1) {
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("id", data.random_key);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-position", data.position_message);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-id", data._id);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-random-key", data.random_key);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-type", data.message_type);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-name", data.sender.full_name);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-sender", data.sender.member_id);
    } else {
        let header = "",
            classBody = "";
        if (data.sender.member_id === idSession) {
            header = `<div class="chat-body-message-element message-right" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}" data-identification="${data.key_message_error}">`;
        } else if ($(".chat-body-message-element:first").data("sender") == data.sender.member_id && ["1", "2", "3", "4", "5", "6", "7", "8"].includes($(".chat-body-message-element:first").attr("data-type"))) {
            header = `<div class="chat-body-message-element message-left margin-item" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}" data-identification="${data.key_message_error}">`;
            classBody = "margin-right-50px";
        } else {
            header = `<div class="chat-body-message-element message-left" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${
                data.message_type
            }" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}" data-identification="${data.key_message_error}">
                           <span class="chat-body-message-element-name-text">${data.sender.full_name}</span>
                           <img  onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="chat-body-message-element-avatar" src="${domainSession + data.sender.avatar}">`;
        }
        $("#data-message-visible-message").prepend(`${header}<div class="chat-body-message ${classBody}">
                    <div class="chat-body-message-video">
                    <div class="chat-message-video-content">
                        <video class="video-after-img d-none" controls>
                            <source src="${domainSession + data.files[0].link_original}"/>
                        </video>
                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  class="" src="${domainSession + data.files[0].link_thumb}" data-video="${domainSession + data.files[0].link_original}" loading="lazy">
                        <i class="play-video-to-link-btn" onClick="viewVideo($(this))">
                            <svg version="1.1" class="play" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" height="50px" width="50px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" fill="#000" xml:space="preserve">
                                <path class="stroke-solid" fill="none" stroke=""
                                        d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7
                                                                C97.3,23.7,75.7,2.3,49.9,2.5"/>
                                <path class="icon" fill="#fff" d="M38,69c-1,0.5-1.8,0-1.8-1.1V32.1c0-1.1,0.8-1.6,1.8-1.1l34,18c1,0.5,1,1.4,0,1.9L38,69z" />
                            </svg>
                        </i>
                    </div>
                </div>
                    ${footerMessage(data.sender.member_id, data.created_at)}
            </div>
        </div>`);
    }
    let detailImageVideo = "";
    for await (const v of data.files) {
        $("#data-video-about-visible-message").find('.see-item-image-video-grid:eq(0)').remove();
        $("#data-video-about-visible-message").prepend(`<div class="see-item-image-video-grid">
                                                             <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="see-item-image-video-grid-img" src="http://172.16.2.255:1488/public/resource/TMS/FOOD/748/1359/3026/2022/10/1-10-2022/image/original/web-1664592682-Anh-gai-xinh-Viet-Nam.jpg" alt="">
                                                             <div class="see-item-image-video-grid-download">
                                                                  <i class="fa fa-download"></i>
                                                             </div>
                                                             <i onclick="viewVideoAbout($(this))" class="play-video-to-link-btn">
                                                               <svg version="1.1" class="play" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="30px" width="30px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
                                                                    <path class="stroke-solid" fill="none" stroke="" d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7C97.3,23.7,75.7,2.3,49.9,2.5"></path>
                                                                     <path class="icon" fill="" d="M38,69c-1,0.5-1.8,0-1.8-1.1V32.1c0-1.1,0.8-1.6,1.8-1.1l34,18c1,0.5,1,1.4,0,1.9L38,69z"></path>
                                                               </svg>
                                                             </i>
                                                        </div>`);
        detailImageVideo += `<div class="item-image-detail-about-visible-message video-hover-show-download"
                    data-link-original="${domainSession + v.link_original}"
                    data-name="${v.name_file}">
                    <img class="video-tab-about-visible-message" src="http://172.16.2.255:1488/public/resource/TMS/FOOD/71/468/2501/2022/6/29-6-2022/image/original/web-1656496485-V3.jpg" alt="" />
                    <i class="icon-dowload-about-visible-message ti-download" data-toggle="tooltip" data-placement="top" data-original-title="Tải xuống"></i>
                    <i>
                        <svg version="1.1" class="play" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="30px" width="30px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
                            <path class="stroke-solid" fill="none" stroke="" d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7C97.3,23.7,75.7,2.3,49.9,2.5"></path>
                            <path class="icon" fill="" d="M38,69c-1,0.5-1.8,0-1.8-1.1V32.1c0-1.1,0.8-1.6,1.8-1.1l34,18c1,0.5,1,1.4,0,1.9L38,69z"></path>
                        </svg>
                    </i>
                </div>`;
    }
    if ($("#detail-about-video-visible-message .hide-img-by-date-about-visible-message:first").text() === moment(data.created_at).format("DD/MM/YYYY")) {
        $("#detail-about-video-visible-message .slide-to-top:first").prepend(detailImageVideo);
    } else {
        $("#detail-about-video-visible-message").prepend(`<div class="media border-color-about">
            <div class="title-img-video"><span class="hide-img-by-date-about-visible-message">${moment(data.created_at).format("DD/MM/YYYY")}</span>
                <div class="hidden-general-info">
                    <i class="fa fa-sort-down"></i>
                </div>
            </div>
            <div class="slide-to-top">${detailImageVideo}</div>
        </div>`);
    }
    if ($("#data-video-about-visible-message .resource-slider-item").length >= 6) $("#show-all-video-about").removeClass("d-none");
    if ($("#data-video-about-visible-message .resource-slider-item").length == 0) $("#video-about-visible-message").find(".slide-to-top").removeClass("d-none");
    let dataVideo1 = parseInt($("#number-video").text());
    $("#number-video").text(parseInt(dataVideo1) + data.files.length);
    if ($("#data-video-about-visible-message .resource-slider-item").length >= 1){
        $('#video-about-visible-message').find('.slide-to-top').removeClass('d-none');
        $('#video-about-visible-message').find('.hidden-general-info').removeClass('rotate-icon-drop-down-info-visible-about');
        $('#video-about-visible-message').find('.hidden-general-info').toggleClass('rotate-icon-drop-down');
        $('#video-about-visible-message').find('.slide-to-top').slideToggle('slow');
        $('#title-img-video').append(`<div class="hidden-general-info">
                                    <i class="fa fa-sort-down"></i>
                                    </div>`)
    }
}

async function renderMessageAudio(data) {
    console.log(data, "ádasdasdasdas");
    let second = (data.files[0].size + 1000) / 1000;
    let minute = Math.floor(second / 60);
    let time = second - minute * 60;
    let timeAudio = "";
    if (time < 10) {
        timeAudio = `0${minute}:0${time}`;
    } else {
        timeAudio = `0${minute}:${time}`;
    }
    if ($('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').length === 1) {
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-id", data.random_key);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-position", data.position_message);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-id", data._id);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-random-key", data.random_key);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-type", data.message_type);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-name", data.sender.full_name);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-sender", data.sender.member_id);
    } else {
        let header = "",
            classBody = "";
        if (data.sender.member_id === idSession) {
            header = `<div class="chat-body-message-element message-right" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}" data-identification="${data.key_message_error}">`;
        } else if ($(".chat-body-message-element:first").data("sender") == data.sender.member_id && ["1", "2", "3", "4", "5", "6", "7", "8"].includes($(".chat-body-message-element:first").attr("data-type"))) {
            header = `<div class="chat-body-message-element message-left margin-item" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}" data-identification="${data.key_message_error}">`;
            classBody = "margin-right-50px";
        } else {
            header = `<div class="chat-body-message-element message-left" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${
                data.message_type
            }" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}" data-identification="${data.key_message_error}">
                           <span class="chat-body-message-element-name-text">${data.sender.full_name}</span>
                           <img  onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="chat-body-message-element-avatar" src="${domainSession + data.sender.avatar}">`;
        }
        $("#data-message-visible-message").prepend(`${header}<div class="chat-body-message ${classBody}">
            <div class="chat-body-message-audio">
                <div class="chat-audio-header d-flex align-items-center">
                                                    <a title="Play" class="sound-container-play" data-audio="${domainSession + data.files[0].link_original}">
                                                        <i class="fa fa-play-circle play-audio-btn"></i>
                                                        <i class="fa fa-pause stop-audio-btn d-none"></i>
                                                    </a>
                                                    <div class="chat-audio-name">${domainSession + data.files[0].name_file}</div>
                                                    <div class="see-item-image-video-grid-download audio btn-download-file-upload">
                                                        <i class="fa fa-download" data-download="${domainSession + data.files[0].link_original}" data-name-file="${domainSession + data.files[0].name_file}"></i>
                                                    </div>
                                                </div>
                                                <div class="play-audio-body-message">
                                                    <div class="sound-container-time sound-duration-time">00:00</div>
                                                    <div class="progress">
                                                        <div class="currentValue" style="width: 100%;">
                                                            <div class="media-fixed-progress-bar-dot"></div>
                                                        </div>
                                                    </div>
                                                    <div class="sound-resutl-time" data-duration="">${timeAudio}</div>
                                                </div>
            </div>
            ${footerMessage(data.sender.member_id, data.created_at)}
        </div>
    </div>

`);
    }
}

async function renderMessageFile(data) {
    if ($('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').length === 1) {
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("id", data.random_key);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-position", data.position_message);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-id", data._id);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-random-key", data.random_key);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-type", data.message_type);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-name", data.sender.full_name);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-sender", data.sender.member_id);
    } else {
        let nameImage = await convertImageFile(data.files[0].link_thumb);
        let header = "",
            sizeFile = convertSizeFile(data.files[0].size),
            classBody = "";
        if (data.sender.member_id === idSession) {
            header = `<div class="chat-body-message-element message-right" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}" data-identification="${data.key_message_error}">`;
        } else if ($(".chat-body-message-element:first").data("sender") == data.sender.member_id && ["1", "2", "3", "4", "5", "6", "7", "8"].includes($(".chat-body-message-element:first").attr("data-type"))) {
            header = `<div class="chat-body-message-element message-left margin-item" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}" data-identification="${data.key_message_error}">`;
            classBody = "margin-right-50px";
        } else {
            header = `<div class="chat-body-message-element message-left" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${
                data.message_type
            }" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}" data-identification="${data.key_message_error}">
                           <span class="chat-body-message-element-name-text">${data.sender.full_name}</span>
                           <img  onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="chat-body-message-element-avatar" src="${domainSession + data.sender.avatar}">`;
        }
        $("#data-message-visible-message").prepend(`${header}<div class="chat-body-message ${classBody}">
                <div class="chat-body-message-file">
                    <a href="${domainSession + data.files[0].link_original}" download>
                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="chat-message-file-icon-image" src="${nameImage}" loading="lazy"/>
                    </a>
                    <div class="chat-message-file-content">
                            <div class="chat-message-file-action">
                            <span class="chat-message-file-name">${data.files[0].name_file}</span>
                            <span class="chat-message-file-size-body"> ${sizeFile}</span>
                            </div>
                            <div class="see-item-image-video-grid-download btn-download-file-upload d-flex">
                                <i class="fa fa-download" data-download="${domainSession + data.files[0].link_original}" data-name-file="${data.files[0].name_file}"></i>
                            </div>
                    </div>
                </div>
                ${footerMessage(data.sender.member_id, data.created_at)}
            </div>
        </div>`);
    }
    $("#detail-about-file-visible-message").find('.empty-content').remove();
    $("#data-file-about-visible-message").find('.empty-content').remove();
    for await (const v of data.files) {
        $("#data-file-about-visible-message").prepend(`<div class="hover-link-file" data-link-original="${domainSession + data.files[0].link_original}">
            <div class="file-group-items">
                <div class="media-item-file">
                    <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="file-thumb-img" src="${convertImageFile(data.files[0].link_thumb)}">
                    <div class="info-file">
                        <div class="info-file-title" title="${data.files[0].name_file}">
                            ${data.files[0].name_file}
                        </div>
                        <div class="group-subtitle-file">
                            <div class="info-file-subtitle" style="width: unset">${convertSizeFile(data.files[0].size)}</div>
                            <span class="info-file-date set-interval-message" data-time="${data.created_at}">Vài giây</span>
                        </div>
                    </div>
                    <div class="download-file-visible-message">
                        <i class="ti-download .icon-dowload-file-about"></i>
                    </div>
                </div>
            </div>
        </div>`);
        if ($("#data-file-about-visible-message .hover-link-file").length >= 6){
            $("#data-file-about-visible-message").find('.hover-link-file:last').remove();
        }
        $("#detail-about-file-visible-message").prepend(`<div class="hover-link-file" data-link-original="${domainSession + data.files[0].link_original}">
            <div class="file-group-items">
                <div class="media-item-file">
                    <img onerror="this.onerror=null; this.src='/images/piknik/frnd-figure6.jpg'" class="file-thumb-img" src="${convertImageFile(data.files[0].link_thumb)}">
                    <div class="info-file">
                        <div class="info-file-title" title="${data.files[0].name_file}">
                            ${data.files[0].name_file}
                        </div>
                        <div class="group-subtitle-file">
                            <div class="info-file-subtitle" style="width: unset">${convertSizeFile(data.files[0].size)}</div>
                        </div>
                    </div>
                    <div class="download-file-visible-message">
                        <i class="ti-download .icon-dowload-file-about"></i>
                    </div>
                </div>
            </div>
        </div>`);
    }
    /* Mỗi lần up được 1 file nên chỉ cập nhập thêm 1 */
    let elementFileAmount = $('#file-about-number')
    elementFileAmount.text(parseInt(elementFileAmount.text()) + 1)
    if ($("#data-file-about-visible-message .hover-link-file").length >= 5){
        $("#show-all-file-about").removeClass("d-none");
    }
}

async function renderMessageSticker(data) {
    if ($('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').length === 1) {
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("id", data.random_key);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-position", data.position_message);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-id", data._id);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-random-key", data.random_key);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-type", data.message_type);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-name", data.sender.full_name);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-sender", data.sender.member_id);
    } else {
        let header = "",
            classBody = "";
        if (data.sender.member_id === idSession) {
            header = `<div class="chat-body-message-element message-right" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}" data-identification="${data.key_message_error}">`;
        } else if ($(".chat-body-message-element:first").data("sender") == data.sender.member_id && ["1", "2", "3", "4", "5", "6", "7", "8"].includes($(".chat-body-message-element:first").attr("data-type"))) {
            header = `<div class="chat-body-message-element message-left margin-item" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}" data-identification="${data.key_message_error}">`;
            classBody = "margin-right-50px";
        } else {
            header = `<div class="chat-body-message-element message-left" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${
                data.message_type
            }" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}" data-identification="${data.key_message_error}">
                           <span class="chat-body-message-element-name-text">${data.sender.full_name}</span>
                           <img  onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="chat-body-message-element-avatar" src="${domainSession + data.sender.avatar}">`;
        }
        $("#data-message-visible-message").prepend(`${header}<div class="chat-body-message ${classBody}">
                <div class="chat-body-message-sticker">
                <img  onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  src="${domainSession + data.message}" alt="Sticker">
                </div>
                ${footerMessage(data.sender.member_id, data.created_at)}
            </div>
        </div>`);
    }
}

async function renderMessageReply(data) {
    if ($('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').length === 1) {
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("id", data.random_key);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-position", data.position_message);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-id", data._id);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-random-key", data.random_key);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-type", data.message_type);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-name", data.sender.full_name);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-sender", data.sender.member_id);
    } else {
        for await (const v of data.list_tag_name) {
            data.message = data.message.replace(v.key_tag_name, `<span class="tag-name">@${v.full_name}</span>`);
        }
        // for await (const v of data.list_link) {
        //     data.message = data.message.replace(v, `<a class="body-message-link" href="${v}" target="_blank">${v}</a>`);
        // }
        let header = "",
            classBody = "";
        let replySocket = await replyMessageVisible(data);
        if (data.sender.member_id === idSession) {
            header = `<div class="chat-body-message-element message-right" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}" data-identification="${data.key_message_error}">`;
        } else if ($(".chat-body-message-element:first").data("sender") == data.sender.member_id && ["1", "2", "3", "4", "5", "6", "7", "8"].includes($(".chat-body-message-element:first").attr("data-type"))) {
            header = `<div class="chat-body-message-element message-left margin-item" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}" data-identification="${data.key_message_error}">`;
            classBody = "margin-right-50px";
        } else {
            header = `<div class="chat-body-message-element message-left" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${
                data.message_type
            }" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}" data-identification="${data.key_message_error}">
                           <span class="chat-body-message-element-name-text">${data.sender.full_name}</span>
                           <img  onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="chat-body-message-element-avatar" src="${domainSession + data.sender.avatar}">`;
        }
        $("#data-message-visible-message").prepend(`${header}<div class="chat-body-message ${classBody}">
                    ${replySocket}
                    ${footerMessage(data.sender.member_id, data.created_at)}
            </div>
        </div>`);
    }
}

async function renderMessageOrder(data) {
    if ($('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').length === 1) {
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("id", data.random_key);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-position", data.position_message);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-id", data._id);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-random-key", data.random_key);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-type", data.message_type);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-name", data.sender.full_name);
        $('#data-message-visible-message .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-sender", data.sender.member_id);
    } else {
        let bodyOrder = `<div class="card-information-order-restaurant-supplier-message" style="width: 300px;margin: 0;">
                                <div class="css-translateX-card-order"></div>
                                <div class="left-information-order">
                                    <i class="feather icon-shopping-cart" style="font-size: 33px;"></i>
                                    <label class="label label-success" style="padding: 5px;margin: 0;position: absolute;width: max-content;bottom: 19px;left: 15px;"> Hoàn tất</label>
                                </div>
                                <div class="line-up-one"></div>
                                <div class="right-information-order">
                                    <div class="content-infor">
                                        <div class="d-flex detail-information-card">
                                            <i>MÃ: </i><p class="">${data.message_order.code}</p>
                                        </div>
                                        <div class="d-flex detail-information-card">
                                            <i>GIÁ: </i><p class="">${formatNumber(data.message_order.total)}đ</p>
                                        </div>
                                        <div class="d-flex detail-information-card">
                                            <i>NGÀY: </i><p class="">${data.message_order.order_time_delivery}</p>
                                        </div>
                                    </div>
                                    <div class="line-card-order-footer">
                                        <button class="buttun-action-card-order btn btn-grd-primary waves-effect waves-light" onclick="openDetailOrderSupplierOrder(${data.message_order.order_id})">Chi tiết</button>
                                    </div>
                                </div>
                            </div>`;
        if (data.sender.member_id !== idSession) {
            $('#data-message-visible-message').prepend(`<div class="chat-body-message-element message-left" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}">
                                                                    <span class="chat-body-message-element-name-text">${data.sender.full_name}</span>
                                                                    <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="chat-body-message-element-avatar" src="${domainSession + data.sender.avatar}">
                                                                    <div class="chat-body-message">
                                                                           ${bodyOrder}
                                                                          ${footerMessage(data.sender.member_id, data.created_at)}
                                                                    </div>
                                                                </div>`);

            $('#chat-body-message-popup').prepend(`<div class="chat-body-message-element message-left" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}">
                                                                    <span class="chat-body-message-element-name-text">${data.sender.full_name}</span>
                                                                    <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="chat-body-message-element-avatar" src="${domainSession + data.sender.avatar}">
                                                                    <div class="chat-body-message">
                                                                           ${bodyOrder}
                                                                          ${footerMessage(data.sender.member_id, data.created_at)}
                                                                    </div>
                                                                </div>`);
        } else {
            $('#data-message-visible-message').prepend(`<div class="chat-body-message-element message-right" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}">
                                                        <div class="chat-body-message">
                                                                ${bodyOrder}
                                                             ${footerMessage(data.sender.member_id, data.created_at)}
                                                        </div>
                                                    </div>`);

            $('#chat-body-message-popup').prepend(`<div class="chat-body-message-element message-right" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}">
                                                        <div class="chat-body-message">
                                                                ${bodyOrder}
                                                             ${footerMessage(data.sender.member_id, data.created_at)}
                                                        </div>
                                                    </div>`);
        }
    }
}

function renderLayoutNotifyToDay() {
    $("#data-message-visible-message").prepend(`<div class="notify-message-container">
        <div class="line"></div>
        <div class="notify-message-content" style="padding: 0 10px; background-color: #39393966;color: #fff;">
            <span class="notify-message-text">' . date_format(date_create($db['created_at']), 'H:i d/m/Y') . '</span>
        </div>
        <div class="line"></div>
    </div>`);
}

async function multiCallFunctionReactionMessageVisible(data) {
    let element = $('.chat-body-message-element[data-random-key="' + data.random_key + '"]');
    (data.reactions.reactions_count > 99) ? element.find('.total-reacts').text('99+') : element.find('.total-reacts').text(data.reactions.reactions_count);
    if (data.reactions.last_reactions_id === idSession) {
        element.find('.chat-body-message-item-reactions-group').attr('data-id',data.reactions.last_reactions);
        switch (data.reactions.last_reactions) {
            case 1: //love
                element.find('.chat-body-message-item-reactions-group').html(loveReaction);
                break;
            case 2: //smile
                element.find('.chat-body-message-item-reactions-group').html(hahaReaction);
                break;
            case 3: //like
                element.find('.chat-body-message-item-reactions-group').html(likeReaction);
                break;
            case 4: //sad
                element.find('.chat-body-message-item-reactions-group').html(sadReaction);
                break;
            case 5: //angry
                element.find('.chat-body-message-item-reactions-group').html(angryReaction);
                break;
            case 6: //wow
                element.find('.chat-body-message-item-reactions-group').html(wowReaction);
                break;
        }
    }
    element.find('.reacts-list').removeClass('d-none');
    if (element.find('.total-reacts') === "0") {
        element.find('.total-reacts').text('1');
        switch (data.reactions.last_reactions) {
            case 1: //love
                element.find('.react-icon-list').append(loveReaction);
                break;
            case 2: //smile
                element.find('.react-icon-list').append(hahaReaction);
                break;
            case 3: //like
                element.find('.react-icon-list').append(likeReaction);
                break;
            case 4: //sad
                element.find('.react-icon-list').append(sadReaction);
                break;
            case 5: //angry
                element.find('.react-icon-list').append(angryReaction);
                break;
            case 6: //wow
                element.find('.react-icon-list').append(wowReaction);
                break;
        }
    } else {
        element.find('.react-icon-list').data('love', data.reactions.love);
        element.find('.react-icon-list').data('smile', data.reactions.smile);
        element.find('.react-icon-list').data('like', data.reactions.like);
        element.find('.react-icon-list').data('angry', data.reactions.angry);
        element.find('.react-icon-list').data('sad', data.reactions.sad);
        element.find('.react-icon-list').data('wow', data.reactions.wow);
        let arr = [
            {content: loveReaction, quantity: data.reactions.love},
            {content: hahaReaction, quantity: data.reactions.smile},
            {content: likeReaction, quantity: data.reactions.like},
            {content: sadReaction, quantity: data.reactions.sad},
            {content: angryReaction, quantity: data.reactions.angry},
            {content: wowReaction, quantity: data.reactions.wow}];
        arr = arr.sort((a, b) => a.quantity - b.quantity).reverse().slice(0, 3);
        arr = arr.filter(item => item.quantity !== 0);
        let content = arr.map(function (item) {
            return item.content;
        });
        element.find('.react-icon-list').html(content.join(""));
    }
}

async function multiCallFunctionRevokeMessageVisible(data) {
    $('.chat-body-message-element[data-random-key="' + data.random_key + '"] .chat-body-message').html('<div class="chat-body-message-revoke">Tin nhắn đã thu hồi</div>');
}

async function multiCallFunctionPinnedMessageVisible(data) {
    if (data.sender.member_id !== idSession) {
        $('#data-message-visible-message').prepend(`<div class="chat-body-message-element notify-message-container" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}">
                    <div class="notify-message-content">
                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  class="chat-body-message-item-pin-img" src="${domainSession + data.sender.avatar}" alt="" />
                        <div class="notify-message-block">
                            <span class="notify-message-username showmore underline"><span class="event-message-content-name showmore underline-you">${data.sender.full_name}</span></span>
                            <span class="notify-message-text">đã ghim tin nhắn</span>
                            <i class="event-message-content-info-icon typcn typcn-pin"></i>
                        </div>
                    </div>
                </div>`)
    } else if ($('#data-message-visible-message .notify-message-container[data-identification="' + data.key_message_error + '"]').length === 0) {
        $('#data-message-visible-message').prepend(`<div class="chat-body-message-element notify-message-container" id="${data.random_key}" data-position="${data.position_message}">
                    <div class="notify-message-content">
                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  class="chat-body-message-item-pin-img" src="${domainSession + data.sender.avatar}" alt="" />
                        <div class="notify-message-block">
                            <span class="notify-message-username showmore underline"><span class="event-message-content-name showmore underline">Bạn</span></span>
                            <span class="notify-message-text">đã ghim tin nhắn</span>
                            <i class="event-message-content-info-icon typcn typcn-pin"></i>
                        </div>
                    </div>
                </div>`)
    }
    $('.pin-details-content-about-visible-message').html('');
    pagePinDetailAboutVisibleMessage = 1;
    dataPinDetailAboutVisibleMessage();
}

async function multiCallFunctionRevokePinnedMessageVisible(data) {
    if (data.sender.member_id !== idSession) {
        $('#data-message-visible-message').prepend(`<div class="chat-body-message-element notify-message-container" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}">
                    <div class="notify-message-content">
                        <img onerror="imageDefaultOnLoadError($(this))"  class="chat-body-message-item-pin-img" src="${domainSession + data.sender.avatar}" alt="" />
                        <div class="notify-message-block">
                            <span class="notify-message-username showmore underline"><span class="event-message-content-name showmore underline-you">${data.sender.full_name}</span></span>
                            <span class="notify-message-text">đã bỏ ghim tin nhắn</span>
                            <i class="event-message-content-info-icon typcn typcn-pin"></i>
                        </div>
                    </div>
                </div>`)
    } else if ($('#data-message-visible-message .notify-message-container[data-identification="' + data.key_message_error + '"]').length === 0) {
        $('#data-message-visible-message').prepend(`<div class="chat-body-message-element notify-message-container" id="${data.random_key}" data-position="${data.position_message}">
                    <div class="notify-message-content">
                        <img onerror="imageDefaultOnLoadError($(this))" class="chat-body-message-item-pin-img" src="${domainSession + data.sender.avatar}" alt="" />
                        <div class="notify-message-block">
                            <span class="notify-message-username showmore underline"><span class="event-message-content-name showmore underline">Bạn</span></span>
                            <span class="notify-message-text">đã bỏ ghim tin nhắn</span>
                            <i class="event-message-content-info-icon icofont icofont-ban"></i>
                        </div>
                    </div>
                </div>`)
    }
    $('.pin-details-content-about-visible-message').html('');
    await dataDetailConversation();
}

/** render message call */
/**
 * Render tin nhắn thông báo cuộc trò chuyện bị bỏ lỡ vào visible và popup
 */
async function renderNoAnswerMessager(data) {
    let typeIcon = '';
    if(data.message_type == 22) {
        typeIcon = 'fa fa-phone';
    }
    else {
        typeIcon = 'fa fa-video-camera';
    }
    $('#data-message-visible-message').prepend(`<div class="chat-body-message-element message-left margin-item" id="" data-position=""
                         data-id="" data-random-key="" data-type="" data-name=""
                         data-sender=""
                         data-avatar="">
                        <div class="chat-body-message margin-right-50px">
                            <div class="chat-body-message-text"><i class="${typeIcon}"></i> Cuộc gọi nhỡ</div>
                            <button class="recall-message-button">Gọi lại</button>
                        </div>
                    </div>`);

    $('#chat-body-message-popup').prepend(`<div class="chat-body-message-element message-left margin-item" id="" data-position=""
                         data-id="" data-random-key="" data-type="" data-name=""
                         data-sender=""
                         data-avatar="">
                        <div class="chat-body-message ">
                            <div class="chat-body-message-text"><i class="${typeIcon}"></i> Cuộc gọi nhỡ</div>
                            <button class="recall-message-button">Gọi lại</button>
                        </div>
                    </div>`);
}

/**
 * Render tin nhắn thông báo cuộc trò chuyện không thành công vào visible và popup
 */
async function renderCallCancelMessage(data) {
    let typeIcon = '';
    if(data.message_type == 22) {
        typeIcon = 'fa fa-phone';
    }
    else {
        typeIcon = 'fa fa-video-camera';
    }
    $('#data-message-visible-message').prepend(`<div class="chat-body-message-element message-right margin-item" id="" data-position=""
                         data-id="" data-random-key="" data-type="" data-name=""
                         data-sender=""
                         data-avatar="">
                        <div class="chat-body-message">
                            <div class="chat-body-message-text"><i class="${typeIcon}"></i> Cuộc gọi thất bại</div>
                            <button class="recall-message-button">Gọi lại</button>
                        </div>
                    </div>`);

    $('#chat-body-message-popup').prepend(`<div class="chat-body-message-element message-right margin-item" id="" data-position=""
                         data-id="" data-random-key="" data-type="" data-name=""
                         data-sender=""
                         data-avatar="">
                        <div class="chat-body-message ">
                            <div class="chat-body-message-text"><i class="${typeIcon}"></i> Cuộc gọi thất bại</div>
                            <button class="recall-message-button">Gọi lại</button>
                        </div>
                    </div>`);
}

/**
 * Render tin nhắn thông báo cuộc trò chuyện không thành công vào visible và popup
 */
async function renderCallRejectMessage(data) {
    let typeIcon = '';
    if(data.message_type == 22) {
        typeIcon = 'fa fa-phone';
    }
    else {
        typeIcon = 'fa fa-video-camera';
    }
    $('#data-message-visible-message').prepend(`<div class="chat-body-message-element message-left margin-item" id="" data-position=""
                         data-id="" data-random-key="" data-type="" data-name=""
                         data-sender=""
                         data-avatar="">
                        <div class="chat-body-message margin-right-50px">
                            <div class="chat-body-message-text"><i class="${typeIcon}"></i> Cuộc gọi thất bại</div>
                            <button class="recall-message-button">Gọi lại</button>
                        </div>
                    </div>`);

    $('#chat-body-message-popup').prepend(`<div class="chat-body-message-element message-left margin-item" id="" data-position=""
                         data-id="" data-random-key="" data-type="" data-name=""
                         data-sender=""
                         data-avatar="">
                        <div class="chat-body-message ">
                            <div class="chat-body-message-text"><i class="${typeIcon}"></i> Cuộc gọi thất bại</div>
                            <button class="recall-message-button">Gọi lại</button>
                        </div>
                    </div>`);
}

/**
 * Render tin nhắn thông báo cuộc trò chuyện thành công vào visible và popup
 */
async function renderCallCompleteMessage(data) {
    let typeIcon = '';
    if(data.message_type == 22) {
        typeIcon = 'fa fa-phone';
    }
    else {
        typeIcon = 'fa fa-video-camera';
    }
    $('#data-message-visible-message').prepend(`<div class="chat-body-message-element message-right margin-item" id="" data-position=""
                         data-id="" data-random-key="" data-type="" data-name=""
                         data-sender=""
                         data-avatar="">
                        <div class="chat-body-message ">
                            <div class="chat-body-message-text"><i class="${typeIcon}"></i> Cuộc gọi hoàn tất ${data.call_time}</div>
                            <button class="recall-message-button">Gọi lại</button>
                        </div>
                    </div>`);

    $('#chat-body-message-popup').prepend(`<div class="chat-body-message-element message-right margin-item" id="" data-position=""
                         data-id="" data-random-key="" data-type="" data-name=""
                         data-sender=""
                         data-avatar="">
                        <div class="chat-body-message ">
                            <div class="chat-body-message-text"><i class="${typeIcon}"></i> Cuộc gọi hoàn tất</div>
                            <button class="recall-message-button">Gọi lại</button>
                        </div>
                    </div>`);
}



