@extends('layouts.layout')
{{--<link rel="icon" href="{{ asset('images/tms/favicon2.png') }}" type="image/png"/>--}}
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row d-flex">
                <div class="edit-flex-auto-fill col-sm-6 pr-0">
                    <div class="card flex-sub pr-0">
                        <div class="card-block p-b-0 row">
                            <div class="col-lg-12">
                                <h5 class="sub-title mx-0" style="padding-bottom: 12px;">Danh sách VAT hệ thống</h5>
                            </div>
                        </div>
                        <div class="card-block p-t-0 mt-1">
                            <div class="table-responsive new-table">
                                <table id="table-vat-restaurant-setting-system" class="table">
                                    <thead>
                                    <tr>
                                        <th>Tên VAT</th>
                                        <th>Thuế</th>
                                        <th class="text-right">
                                            <div class="btn-group btn-group-sm">
                                                <button type="button"
                                                        class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                                        onclick="checkAllVATRestaurantSetting($(this))"
                                                        style="margin: -7.9px 0 !important; margin-left: -5px"><i
                                                            class="fi-rr-arrow-small-right"></i></button>
                                            </div>
                                        </th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="edit-flex-auto-fill col-sm-6">
                    <div class="card flex-sub">
                        <div class="card-block p-b-0 row">
                            <div class="col-lg-12">
                                <h5 class="sub-title mx-0" style="padding-bottom: 12px" ;>Danh sách VAT nhà hàng</h5>
                            </div>
                        </div>
                        <div class="card-block mt-1 p-t-0" id="body-vat-restaurant-setting">
                            <div class="table-responsive new-table">
                                <table id="table-vat-restaurant-setting-restaurant" class="table">
                                    <thead>
                                    <tr>
                                        <th>
                                            {{--                                            <i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right"  onclick="checkAllSystemSupplierMaterialData($(this))" style="margin: -3.9px 0"></i>--}}
                                        </th>
                                        <th>Tên VAT</th>
                                        <th>Thuế</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\setting\vat_manage\vat_restaurant\index.js?version=4', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
