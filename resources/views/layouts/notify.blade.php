<li class="header-notification" id="header-notify-hidden">
    <div class="dropdown-primary dropdown">
        <span class="badge bg-c-pink" id="count-notify-not-seen-header">0</span>
        <div class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o hover-icon-header"></i>
        </div>
        <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn"
            data-dropdown-out="fadeOut">
            <li style="border-bottom: 2px solid #c2c2c2">
                <h4 style="font-weight: bold; display: inline-block">Thông báo</h4>
                <label onclick="location.href='notify-view';" class="label label-primary" style="cursor: pointer">Xem
                    tất cả</label>
            </li>
            <li style="padding: 0.5em 0">
                <ul style="min-height: 20vh; max-height: 40vh; overflow-y: auto" id="list-notify-header"></ul>
            </li>
        </ul>
    </div>
</li>
