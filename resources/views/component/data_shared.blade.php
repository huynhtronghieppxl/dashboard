<div class="d-none">
    <input id="data-table-length" value="100"/>
    <input id="data-view-branch" value="@if(isset($key_branch_view)){{$key_branch_view}}@endif"/>
    <input id="point-ratio-food-server" value="1000"/>
    <input id="token-expiration-server" value="{{Session::get(SESSION_STATUS_SERVER)}}"/>
    <input id="domain-ads-template" value="{{Session::get(SESSION_NODE_KEY_BASE_URL_ADS)}}"/>
    <input id="restaurant-id-template" value="{{Session::get(SESSION_RESTAURANT)}}"/>
    <input id="tms-template" value="{{Session::get(SESSION_KEY_TMS)}}"/>
    <input id="level-template" value="{{Session::get(SESSION_KEY_LEVEL)}}"/>
    {{--    <input id="hour-to-take-report-template" value="{{Session::get(Config::get('constants.cache_session.HOUR_TO_TAKE_REPORT'))}}"/>--}}
</div>
