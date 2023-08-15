<div class="body-visible-message" id="body-visible-message" style="height:calc(100vh - 80px - 60px - 103px)">
    <div class="chat-body-scroll-top-btn scroll-btn d-none">
        <i class="fa fa-angle-down"></i>
    </div>
    <div class="chat-body-text-scroll-top-btn d-none"><i class='fa fa-angle-double-down'></i>Có tin nhắn mới</div>
    <div class="chat-body-message-main" id="data-message-visible-message">
        <div class="force-overflow"></div>
    </div>
    <div class="tag-input-visible-message d-none" id="tag-input-body-visible-message">
        <ul class="tag-ul-event" id="tag-name-visible-message">
        </ul>
    </div>
    @include('message.visible_ver2.right.body.sticker')
    @include('message.visible_ver2.right.body.order')
    <div class="chat-bubble d-none" id="typing-data-message-visible-message">
        <div style="display: inline-block;" class="content-data-message-visible-message"></div>
        <div style="display: inline-block;">
            <div class="typing">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
        </div>
    </div>
</div>
