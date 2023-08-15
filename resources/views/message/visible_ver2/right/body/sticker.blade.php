<div class="sticker-input-visible-message  d-none">
    <div class="body-footer-sticker-visible-message">
        {{--        <div class="name-sticker-visible-message">Tên sticker</div>--}}
        <div class="body-sticker-visible-message d-flex" id="data-sticker-visible-message"></div>
    </div>
    <div class="footer-sticker-visible-message">
        <ul class="list-sticker-visible-message suggested-frnd-caro" id="data-category-sticker-visible-message"></ul>
    </div>
</div>
@push('scripts')
    <script src="{{asset('js/message/visible_v2/sticker.js',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
