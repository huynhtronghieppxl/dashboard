<div class="modal fade" id="modal-detail-work-data" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chi tiết</h5>
                <button type="button" class="close ml-4" onclick="closeModalDetailWorkData()" onkeypress="closeModalDetailWorkData()">
                    <i class="fi-rr-cross"></i>
                </button>

            </div>
            <div class="modal-body">
                <div class="card card-block m-0">
                    <div id="data-detail-work-data" style="font-size: 14px">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{asset('js/build_data/personnel/work/detail.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush

