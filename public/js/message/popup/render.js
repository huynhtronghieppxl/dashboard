async function renderMessageTextPopup(data) {
    if ($('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').length === 1) {
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("id", data.random_key);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-position", data.position_message);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-id", data._id);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-random-key", data.random_key);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-type", data.message_type);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-name", data.sender.full_name);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-sender", data.sender.member_id);
    } else {
    //     for await (const v of data.list_tag_name) {
    //         data.message = data.message.replace(v.key_tag_name, `<span class="tag-name">@${v.full_name}</span>`);
    //     }
    //     for await (const v of data.list_link) {
    //         data.message = data.message.replace(v, `<a class="body-message-link" href="${v}" target="_blank">${v}</a>`);
    //     }
    //     data.message = data.message.replaceAll(' \n ','<br>');
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
        $("#chat-body-message-popup").prepend(`${header}<div class="chat-body-message ${classBody}">
                                                                <div class="chat-body-message-text">${data.message}</div>
                                                                 ${footerMessage(data.sender.member_id, data.created_at)}
                                                            </div>
                                                        </div>`);
    }
}

async function renderMessageImagePopup(data) {
    if ($('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').length === 1) {
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("id", data.random_key);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').data("position", data.position_message);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').data("id", data._id);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').data("random-key", data.random_key);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').data("type", data.message_type);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').data("name", data.sender.full_name);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').data("sender", data.sender.member_id);
    } else {
        let imageSocket = await countImagePopup(data);
        let header = "",
            stylebgImage ="",
            classBody = "";
        if (data.sender.member_id === idSession) {
            if(data.files[0].name_file == 'icon_like') {stylebgImage = 'background-color: #e2f1fa !important;'}
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
        $("#chat-body-message-popup").prepend(`${header}<div class="chat-body-message ${classBody}" style="${stylebgImage}">
                                            ${imageSocket}
                                            ${footerMessage(data.sender.member_id, data.created_at)}
                                    </div>
                                </div>`);
    }
}

async function renderMessageVideoPopup(data) {
    if ($('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').length === 1) {
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("id", data.random_key);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-position", data.position_message);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-id", data._id);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-random-key", data.random_key);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-type", data.message_type);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-name", data.sender.full_name);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-sender", data.sender.member_id);
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
        $("#chat-body-message-popup").prepend(`${header}<div class="chat-body-message ${classBody}">
                    <div class="chat-body-message-video">
                    <div class="chat-message-video-content">
                        <video class="video-after-img d-none" controls>
                            <source src="${domainSession + data.files[0].link_original}"/>
                        </video>
                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  class="" src="${domainSession + data.files[0].link_thumb}" data-video="${domainSession + data.files[0].link_original}" loading="lazy">
                        <i class="play-video-to-link-btn" onClick="viewVideoPopup($(this))">
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
}

async function renderMessageAudioPopup(data) {
    let second = (data.files[0].size + 1000) / 1000;
    let minute = Math.floor(second / 60);
    let time = second - minute * 60;
    let timeAudio = "";
    if (time < 10) {
        timeAudio = `0${minute}:0${time}`;
    } else {
        timeAudio = `0${minute}:${time}`;
    }
    if ($('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').length === 1) {
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-id", data.random_key);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-position", data.position_message);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-id", data._id);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-random-key", data.random_key);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-type", data.message_type);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-name", data.sender.full_name);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-sender", data.sender.member_id);
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
        $("#chat-body-message-popup").prepend(`${header}<div class="chat-body-message ${classBody}">
            <div class="chat-body-message-audio">
                <div class="sound-container">
                    <div class="sound-container-progress">
                        <div class="audio-wrapper random"> <!-- add class animation -->
                            <div class="bar-1"></div>
                            <div class="bar-2"></div>
                            <div class="bar-3"></div>
                            <div class="bar-4"></div>
                            <div class="bar-5"></div>
                            <div class="bar-6"></div>
                            <div class="bar-7"></div>
                        </div>
                    </div>
                    <i class="icon-dowload-about-visible-message ti-download download-audio" data-toggle="tooltip" data-placement="top" data-original-title="Tải xuống">
                        <a href="${domainSession + data.files[0].link_original}" download>
                    </i>
                </div>
                <div class="sound-container-time sound-duration-time">
                    00:00
                </div>
                <div  class=" sound-resutl-time">
                    ${timeAudio}
                </div>
                <div class="play-audio-body-message">
                    <a  title="Play" class="sound-container-play" sound-container-play data-audio="${domainSession + data.files[0].link_original}" >
                        <i  class="fa fa-play play-audio-btn"></i>
                        <i class="fa fa-stop stop-audio-btn d-none"></i>
                    </a>
                    <div class="progress">
                            <div class="currentValue" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
            ${footerMessage(data.sender.member_id, data.created_at)}
        </div>
    </div>`);
    }
}

async function renderMessageStickerPopup(data) {
    if ($('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').length === 1) {
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("id", data.random_key);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-position", data.position_message);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-id", data._id);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-random-key", data.random_key);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-type", data.message_type);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-name", data.sender.full_name);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-sender", data.sender.member_id);
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
        $("#chat-body-message-popup").prepend(`${header}<div class="chat-body-message ${classBody}">
                <div class="chat-body-message-sticker">
                <img  onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  src="${domainSession + data.message}" alt="Sticker">
                </div>
                ${footerMessage(data.sender.member_id, data.created_at)}
            </div>
        </div>`);
    }
}

async function renderMessageLinkPopup(data) {
    if ($('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').length === 1) {
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("id", data.random_key);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-position", data.position_message);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-id", data._id);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-random-key", data.random_key);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-type", data.message_type);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-name", data.sender.full_name);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-sender", data.sender.member_id);
    } else {
        for await (const v of data.list_tag_name) {
            data.message = data.message.replace(v.key_tag_name, `<span class="tag-name">@${v.full_name}</span>`);
        }
        // for await (const v of data.list_link) {
        //     data.message = data.message.replace(v, `<a class="body-message-link" href="${v}" target="_blank">${v}</a>`);
        // }
        data.message = `<a class="body-message-link" href="${data.message}" target="_blank">${data.message}</a>`;

        let header = "",
            body = "",
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
            // let keyId = link.split( 'v=' )[1].split( '&' )[0];
            let arrayLink = link.split("=");
            let paramId = arrayLink[1].replace("&list", "");
            let mainLink = data.message_link.cannonical_url.replace("https://", "").replace("http://", "").split("/").at(0);
            let convertUrl = ("https://").concat(mainLink).concat("/embed/").concat(paramId);
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
        $("#chat-body-message-popup").prepend(`${header}<div class="chat-body-message ${classBody}">
                                                                <div class="chat-body-message-text-link">${data.message}</div>
                                                                 ${body}
                                                                 ${footerMessage(data.sender.member_id, data.created_at)}
                                                            </div>
                                                        </div>`);
    }
    eventInputTypePopupMessage();
}

async function renderMessageReplyPopup(data) {
    if ($('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').length === 1) {
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("id", data.random_key);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-position", data.position_message);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-id", data._id);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-random-key", data.random_key);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-type", data.message_type);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-name", data.sender.full_name);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-sender", data.sender.member_id);
    } else {
        for await (const v of data.list_tag_name) {
            data.message = data.message.replace(v.key_tag_name, `<span class="tag-name">@${v.full_name}</span>`);
        }
        // for await (const v of data.list_link) {
        //     data.message = data.message.replace(v, `<a class="body-message-link" href="${v}" target="_blank">${v}</a>`);
        // }
        let header = "",
            classBody = "";
        let replySocket = await replyMessagePopup(data);
        if (data.sender.member_id === idSession) {
            header = `<div class="chat-body-message-element message-right" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}" data-identification="${data.key_message_error}">`;
        } else if ($(".chat-body-message-element:first").data("sender") == data.sender.member_id && ["1", "2", "3", "4", "5", "6", "7", "8"].includes($(".chat-body-message-element:first").attr("data-type"))) {
            header = `<div class="chat-body-message-element message-left margin-item" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}" data-identification="${data.key_message_error}">`;
            classBody = "margin-right-50px";
        } else {
            header = `<div class="chat-body-message-element message-left" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}"
                        data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}" data-identification="${data.key_message_error}">
                           <span class="chat-body-message-element-name-text">${data.sender.full_name}</span>
                           <img  onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="chat-body-message-element-avatar" src="${domainSession + data.sender.avatar}">`;
        }
        $("#chat-body-message-popup").prepend(`${header}<div class="chat-body-message ${classBody}">
                    ${replySocket}
                    ${footerMessage(data.sender.member_id, data.created_at)}
            </div>
        </div>`);
    }
    $('#chat-body-message-popup').scrollTop(0);
}

async function renderMessageFilePopup(data) {
    console.log('data truyen vao: ',domainSession + data.files[0].link_original);
    if ($('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').length === 1) {
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("id", data.random_key);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-position", data.position_message);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-id", data._id);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-random-key", data.random_key);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-type", data.message_type);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-name", data.sender.full_name);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-sender", data.sender.member_id);
    } else {
        let nameImage = await convertImageFilePopup(data.files[0].link_thumb);
        let header = "",
            sizeFile = convertSizeFilePopup(data.files[0].size),
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

        $("#chat-body-message-popup").prepend(`${header}<div class="chat-body-message ${classBody}">
                <div class="chat-body-message-file">
                    <a href="${domainSession + data.files[0].link_original}">
                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="chat-message-file-icon-image" src="${nameImage}" loading="lazy"/>
                    </a>
                    <div class="chat-message-file-content">
                            <div class="chat-message-file-action">
                            <span class="chat-message-file-name">${data.files[0].name_file}</span>
                            <span>${sizeFile}</span>
                            </div>
                            <i id="download-files-visible-message" class="ti-download icon-download-file"></i>
                    </div>
                </div>
                ${footerMessage(data.sender.member_id, data.created_at)}
            </div>
        </div>`);
    }
}

/**
 * CÁC FUNCTION ĐƯỢC GỌI CÙNG SOCKET ON Công ty/Nhà hàng - NHÀ CUNG CẤP
 */
async function multiCallFunctionReactionPopup(data){
    let element = $('.chat-body-message-element[data-random-key="' + data.random_key + '"]');
    (data.reactions.reactions_count > 99) ? element.find('.total-reacts').text('99+') : element.find('.total-reacts').text(data.reactions.reactions_count);
    if (data.reactions.last_reactions_id === idSession) {
        switch (data.reactions.last_reactions) {
            case 1: //love
                element.find('.chat-body-message-item-reactions-group').html(loveReactionPopup);
                break;
            case 2: //smile
                element.find('.chat-body-message-item-reactions-group').html(hahaReactionPopup);
                break;
            case 3: //like
                element.find('.chat-body-message-item-reactions-group').html(likeReactionPopup);
                break;
            case 4: //sad
                element.find('.chat-body-message-item-reactions-group').html(sadReactionPopup);
                break;
            case 5: //angry
                element.find('.chat-body-message-item-reactions-group').html(angryReactionPopup);
                break;
            case 6: //wow
                element.find('.chat-body-message-item-reactions-group').html(wowReactionPopup);
                break;
        }
    }
    element.find('.reacts-list').removeClass('d-none');
    if (element.find('.total-reacts') === "0") {
        element.find('.total-reacts').text('1');
        switch (data.reactions.last_reactions) {
            case 1: //love
                element.find('.react-icon-list').append(loveReactionPopup);
                break;
            case 2: //smile
                element.find('.react-icon-list').append(hahaReactionPopup);
                break;
            case 3: //like
                element.find('.react-icon-list').append(likeReactionPopup);
                break;
            case 4: //sad
                element.find('.react-icon-list').append(sadReactionPopup);
                break;
            case 5: //angry
                element.find('.react-icon-list').append(angryReactionPopup);
                break;
            case 6: //wow
                element.find('.react-icon-list').append(wowReactionPopup);
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
            {content: loveReactionPopup, quantity: data.reactions.love},
            {content: hahaReactionPopup, quantity: data.reactions.smile},
            {content: likeReactionPopup, quantity: data.reactions.like},
            {content: sadReactionPopup, quantity: data.reactions.sad},
            {content: angryReactionPopup, quantity: data.reactions.angry},
            {content: wowReactionPopup, quantity: data.reactions.wow}];
        arr = arr.sort((a, b) => a.quantity - b.quantity).reverse().slice(0, 3);
        arr = arr.filter(item => item.quantity !== 0);
        let content = arr.map(function (item) {
            return item.content;
        });
        element.find('.react-icon-list').html(content.join(""));
    }
}

async function multiCallFunctionRevokeMessagePopup(data) {
    $('.chat-body-message-element[data-random-key="' + data.random_key + '"] .chat-body-message').html('<div class="chat-body-message-revoke">Tin nhắn đã thu hồi</div>');
}

async function multiCallFunctionPinnedMessagePopup(data) {
    if (data.sender.member_id !== idSession) {
        $('#chat-body-message-popup').prepend(`<div class="chat-body-message-element notify-message-container" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}">
                    <div class="notify-message-content">
                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  class="chat-body-message-item-pin-img" src="${domainSession + data.sender.avatar}" alt="" />
                        <div class="notify-message-block">
                            <span  class="notify-message-username showmore underline"><span class="event-message-content-name showmore underline-you">${data.sender.full_name}</span></span>
                            <span class="notify-message-text">đã ghim tin nhắn</span>
                            <i class="event-message-content-info-icon typcn typcn-pin"></i>
                        </div>
                    </div>
                </div>`)
    } else if ($('#chat-body-message-popup [data-identification="' + data.key_message_error + '"]').length === 0) {
        $('#chat-body-message-popup').prepend(`<div class="chat-body-message-element notify-message-container" id="${data.random_key}" data-position="${data.position_message}">
                    <div class="notify-message-content">
                        <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  class="chat-body-message-item-pin-img" src="${domainSession + data.sender.avatar}" alt="" />
                        <div class="notify-message-block">
                            <span  class="notify-message-username showmore underline"><span class="event-message-content-name showmore underline">Bạn</span></span>
                            <span class="notify-message-text">đã ghim tin nhắn</span>
                            <i class="event-message-content-info-icon typcn typcn-pin"></i>
                        </div>
                    </div>
                </div>`)
    }
    $('#get-pinned-list-popup-message').html('');
    await dataPinDetailAboutPopupMessage();
}

async function multiCallFunctionRevokePinnedMessagePopup(data) {
    if (data.sender.member_id !== idSession) {
        $('#chat-body-message-popup').prepend(`<div class="chat-body-message-element notify-message-container" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}">
                    <div class="notify-message-content">
                        <img onerror="imageDefaultOnLoadError($(this))"  class="chat-body-message-item-pin-img" src="${domainSession + data.sender.avatar}" alt="" />
                        <div class="notify-message-block">
                            <span class="notify-message-username showmore underline"><span class="event-message-content-name showmore underline-you">${data.sender.full_name}</span></span>
                            <span class="notify-message-text">đã bỏ ghim tin nhắn</span>
                            <i class="event-message-content-info-icon typcn typcn-pin"></i>
                        </div>
                    </div>
                </div>`)
    } else if ($('#chat-body-message-popup .notify-message-container[data-identification="' + data.key_message_error + '"]').length === 0) {
        $('#chat-body-message-popup').prepend(`<div class="chat-body-message-element notify-message-container" id="${data.random_key}" data-position="${data.position_message}">
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
    $('#get-pinned-list-popup-message').html('');
    await dataPinDetailAboutPopupMessage();
}

async function renderActionRemoveMember(data) {
    if (data.list_member[0].member_id == idSession) {
        if (data.receiver_id == idCurrentConversation) {
            $('.message-header-list-body .item-conversation-visible-message[data-id="' + data.receiver_id + '"]').remove();
            $('.chat-box-tools-link.icon-font-size.close-popup').click();
        } else {
            $('.message-header-list-body .item-conversation-visible-message[data-id="' + data.receiver_id + '"]').remove();
        }
    } else {
        $('#chat-body-message-popup').prepend(`<div class="chat-body-message-element notify-message-container">
                    <div class="notify-message-content">
                          <img  onerror="this.onerror=null; this.src='/images/tms/default.jpeg'"  class=""  src="${domainSession + data.list_member[0].avatar}" alt="" loading="lazy">
                          <div class="notify-message-block">
                              <span class="notify-message-username "><span class="event-message-content-name-show text-report-body-visible-message showmore-you underline-you"> ${data.list_member[0].full_name}</span></span>
                              <span class="notify-message-text">đã bị mời rời khỏi nhóm</span>
                          </div>
                    </div>
                </div>`)
    }
    let currentMember = $('#chat-popup-layout #data-all-member-visible-message div.row-member').length;
    let countRemoveUser = $('#member-about-visible-message').data('employee');
    $('#chat-popup-layout .number-person-about').text(countRemoveUser);
    /**
     * Xóa thành viên khỏi danh sách about
     */
    $('.row-member').each(function (i, v) {
        if (data.list_member[0].member_id == $(this).data('member-id')) {
            $(this).remove();
        }
    })
    /**
     * Kiểm tra số thành viên hiển thị about và detail
     */
    $('#chat-popup-layout .number-person-about').text(currentMember - 1);
}

async function renderMessageOrderPopup(data) {
    if ($('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').length === 1) {
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("id", data.random_key);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-position", data.position_message);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-id", data._id);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-random-key", data.random_key);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-type", data.message_type);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-name", data.sender.full_name);
        $('#chat-body-message-popup .chat-body-message-element[data-identification="' + data.key_message_error + '"]').attr("data-sender", data.sender.member_id);
    } else {
        let bodyOrderPopup = `<div class="card-information-order-restaurant-supplier-message" style="width: 223px;height: 135px;margin: 0;">
                                                    <div class="css-translateX-card-order"></div>
                                                    <div class="left-information-order">
                                                        <i class="feather icon-shopping-cart" style="font-size: 33px;"></i>
                                                        <label class="label label-success" style="padding: 5px;margin: 0;position: absolute;width: max-content;bottom: 19px;left: 2px;"> Hoàn tất</label>
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
                                                        <div class="line-card-order-footer pl-2">
                                                            <button class="buttun-action-card-order btn btn-grd-primary waves-effect waves-light" onclick="openDetailOrderSupplierOrder(${data.message_order.order_id})">Chi tiết</button>
                                                        </div>
                                                    </div>
                                                </div>`;
        let bodyOrderVisible = `<div class="card-information-order-restaurant-supplier-message" style="width: 300px;margin: 0;">
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
                                                                           ${bodyOrderVisible}
                                                                          ${footerMessage(data.sender.member_id, data.created_at)}
                                                                    </div>
                                                                </div>`);

            $('#chat-body-message-popup').prepend(`<div class="chat-body-message-element message-left" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}">
                                                                    <span class="chat-body-message-element-name-text">${data.sender.full_name}</span>
                                                                    <img onerror="this.onerror=null; this.src='/images/tms/default.jpeg'" class="chat-body-message-element-avatar" src="${domainSession + data.sender.avatar}">
                                                                    <div class="chat-body-message">
                                                                           ${bodyOrderPopup}
                                                                          ${footerMessage(data.sender.member_id, data.created_at)}
                                                                    </div>
                                                                </div>`);
        } else {
            $('#data-message-visible-message').prepend(`<div class="chat-body-message-element message-right" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}">
                                                        <div class="chat-body-message">
                                                                ${bodyOrderVisible}
                                                             ${footerMessage(data.sender.member_id, data.created_at)}
                                                        </div>
                                                    </div>`);

            $('#chat-body-message-popup').prepend(`<div class="chat-body-message-element message-right" id="${data.random_key}" data-position="${data.position_message}" data-id="${data._id}" data-random-key="${data.random_key}" data-type="${data.message_type}" data-name="${data.sender.full_name}" data-sender="${data.sender.member_id}">
                                                        <div class="chat-body-message">
                                                                ${bodyOrderPopup}
                                                             ${footerMessage(data.sender.member_id, data.created_at)}
                                                        </div>
                                                    </div>`);
        }
    }
}
