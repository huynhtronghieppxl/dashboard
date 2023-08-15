<div class="modal fade" id="modal-detail-cards" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Chi tiết</h4>
                <h5 id="status-detail-cards" style="margin-left: auto"></h5>
                <button type="button" class="close" onclick="closeModalDetailCards()" onkeypress="closeModalDetailCards()">
                    <i class="fi-rr-cross"></i>
                </button>
            </div>
            <div class="modal-body" id="loading-modal-detail-cards">
              <div class="card card-block">
                  <div class="row">
                      <div class="col-lg-4 col-md-6">
                          <p class="mb-1 f-w-600 col-form-label-fz-15">Chi nhánh</p>
                          <h6 class="text-muted f-w-400 col-form-label-fz-15"
                              id="branch-detail-customer-card"></h6>
                      </div>
                      <div class="col-lg-4 col-md-6 ">
                          <p class="mb-1 f-w-600 col-form-label-fz-15">Tên khách hàng</p>
                          <h6 class="text-muted f-w-400 col-form-label-fz-15"
                              id="name-customer-detail-customer-card"></h6>
                      </div>
                      <div class="col-lg-4 col-md-6 ">
                          <p class="mb-1 f-w-600 col-form-label-fz-15">Số điện thoại</p>
                          <h6 class="text-muted f-w-400 col-form-label-fz-15"
                              id="customer-phone-detail-customer-card"></h6>
                      </div>

                      <div class="col-lg-4 col-md-6 ">
                          <p class="mb-1 f-w-600 col-form-label-fz-15">Tên thẻ</p>
                          <h6 class="text-muted f-w-400 col-form-label-fz-15"
                              id="card-name-detail-customer-card"></h6>
                      </div>
                      <div class="col-lg-4 col-md-6 ">
                          <p class="mb-1 f-w-600 col-form-label-fz-15">Mệnh giá</p>
                          <h6 class="text-muted f-w-400 col-form-label-fz-15"
                              id="total-detail-customer-card"></h6>
                      </div>
                      <div class="col-lg-4 col-md-6 ">
                          <p class="mb-1 f-w-600 col-form-label-fz-15">Thưởng thêm</p>
                          <h6 class="text-muted f-w-400 col-form-label-fz-15"
                              id="bonus-detail-customer-card"></h6>
                      </div>
                      <div class="col-lg-4 col-md-6 ">
                          <p class="mb-1 f-w-600 col-form-label-fz-15">Thành tiền</p>
                          <h6 class="text-muted f-w-400 col-form-label-fz-15"
                              id="total-amount-detail-customer-card"></h6>
                      </div>
                      <div class="col-lg-4 col-md-6">
                          <p class="mb-1 f-w-600 col-form-label-fz-15">Người tạo</p>
                          <h6 class="text-muted f-w-400 col-form-label-fz-15" style="word-break: break-all;"
                              id="person-recharge-detail-customer-card"></h6>
                      </div>
                      <div class="col-lg-4 col-md-6">
                          <p class="mb-1 f-w-600 col-form-label-fz-15">Ngày tạo</p>
                          <h6 class="text-muted f-w-400 col-form-label-fz-15"
                              id="date-create-detail-customer-card"></h6>
                      </div>
                      <div class="col-lg-4 col-md-6 date-recharge-detail-customer-card-div d-none">
                          <p class="mb-1 f-w-600 col-form-label-fz-15">Ngày nạp</p>
                          <h6 class="text-muted f-w-400 col-form-label-fz-15"
                              id="date-recharge-detail-customer-card"></h6>
                      </div>
                  </div>
                  <div class="row">
                      {{--                        <div class="col-lg-4 col-md-6 date-recharge-detail-customer-card-div">--}}
                      {{--                        <p class="mb-1 f-w-600 col-form-label-fz-15">Ngày nạp</p>--}}
                      {{--                        <h6 class="text-muted f-w-400 col-form-label-fz-15"--}}
                      {{--                            id="date-recharge-detail-customer-card"></h6>--}}
                      {{--                    </div>--}}
                      <div class="col-lg-4 col-md-6 person-detail-update-card-div d-none">
                          <p class="mb-1 f-w-600 col-form-label-fz-15">Người chỉnh sửa</p>
                          <h6 class="text-muted f-w-400 col-form-label-fz-15"
                              id="customer-update-detail-customer-card"></h6>
                      </div>
                      <div class="col-lg-4 col-md-6 person-detail-update-card-div d-none">
                          <p class="mb-1 f-w-600 col-form-label-fz-15">Ngày chỉnh sửa</p>
                          <h6 class="text-muted f-w-400 col-form-label-fz-15"
                              id="date-update-detail-customer-card"></h6>
                      </div>
                      <div class="col-lg-4 col-md-6 person-detail-cancel-card-div d-none">
                          <p class="mb-1 f-w-600 col-form-label-fz-15">Người hủy</p>
                          <h6 class="text-muted f-w-400 col-form-label-fz-15"
                              id="person-cancel-detail-customer-card"></h6>
                      </div>
                      <div class="col-lg-4 col-md-6 person-detail-cancel-card-div d-none">
                          <p class="mb-1 f-w-600 col-form-label-fz-15">Ngày hủy</p>
                          <h6 class="text-muted f-w-400 col-form-label-fz-15"
                              id="date-cancel-detail-customer-card"></h6>
                      </div>

                  </div>
                  <div class="row person-detail-cancel-card-div d-none">
                      <div class="col-12">
                          <p class="mb-1 f-w-600 col-form-label-fz-15">Lý do hủy</p>
                          <h6 class="text-muted f-w-400 col-form-label-fz-15"
                              id="reason-cancel-detail-customer-card"></h6>
                      </div>
                  </div>
              </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/customer/cards/detail.js?version=5', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
