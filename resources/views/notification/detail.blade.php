<div class="modal fade" id="modal-detail-notification" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 20px;">
            <div class="modal-header modal-header-radius">
                <h4 class="modal-title">@lang('app.Notification.detail.title')</h4>
            </div>
            <div class="modal-body background-body-color text-left" id="loading-modal-detail-notificat">
                <div class="row m-2">
                    <div class="card col-lg-12">
                        <div class="card-body row">
                            <div class="col-sm-8 mt-2">
                                <div class="col-sm-12">
                                    <h4>Thông báo</h4>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ipsam, minus consequuntur! Suscipit unde earum odit vitae similique ducimus mollitia ad pariatur quis, minus debitis. Voluptatem ex odio illo beatae atque.</p>
                                </div>
                                <div class="col-sm-12">
                                    <h4>Nội dung</h4>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ipsam, minus consequuntur! Suscipit unde earum odit vitae similique ducimus mollitia ad pariatur quis, minus debitis. Voluptatem ex odio illo beatae atque.</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="media">
                                    <span class="mr-3">
                                        <img class="rounded-circle" src="" alt="Generic placeholder image" width="50" height="50">
                                    </span>
                                    <div class="media-body w100p mt-2">
                                        <a href="javascript:void(0)">Nguyễn Huy Dũng</a>
                                        <span>20/3/2021</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-grd-disabled waves-effect button-radius" onclick="closeModalDetailNotification()">@lang('app.component.button.close')</button>
                    <a href="hahaha" target="blank" class="btn btn-primary waves-effect button-radius" >Xem chi tiết</a>
            </div>
        </div>
    </div>
</div>
<div class="d-none">
    <span id="id-detail-payroll-manage"></span>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('..\files\assets\js\notification\detail.js?version=',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

