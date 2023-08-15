@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row d-flex">
                <div class="edit-flex-auto-fill col-lg-5 pr-2">
                    <div class="card flex-sub pr-0">
                        <div class="card-block p-b-0">
                            <h5 class="sub-title ml-0">@lang('app.assign-customer.title-left')</h5>
                        </div>
                        <div class="card-block p-t-0">
                            <div class="table-responsive new-table">
                                <table id="table-all-assign-customer" class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('app.assign-customer.name')</th>
                                        <th>@lang('app.assign-customer.gender')</th>
                                        <th>@lang('app.assign-customer.tag')</th>
                                        <th>
                                            {{--                                            <i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right pointer" onclick="checkAllAssignCustomerEmployee()"></i>--}}
                                            <div class="btn-group btn-group-sm">
                                                <button type="button"
                                                        class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                                        onclick="checkAllAssignCustomerEmployee($(this))"><i
                                                            class="fi-rr-arrow-small-right"></i></button>
                                            </div>
                                        </th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="edit-flex-auto-fill col-lg-7 pr-2">
                    <div class="card flex-sub pr-0">
                        <div class="card-block p-b-0">
                            <h5 class="sub-title ml-0">@lang('app.assign-customer.title-right')</h5>
                        </div>
                        <div class="card-block p-t-0">
                            <div class="table-responsive new-table">
                                <div class="select-filter-dataTable">
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-brand">
                                                @foreach(collect(Session::get(SESSION_KEY_DATA_BRAND))->where('status', ENUM_SELECTED)->all() as $db)
                                                    @if($db['is_office'] === 0)
                                                        @if(Session::get(SESSION_KEY_BRAND_ID) === $db['id'])
                                                            <option value="{{$db['id']}}"
                                                                    selected>{{$db['name']}}</option>
                                                        @else
                                                            <option value="{{$db['id']}}">{{$db['name']}}</option>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select class="js-example-basic-single select-branch">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-validate-select">
                                        <div class="pr-0 select-material-box">
                                            <select id="select-customer-assign-customer" data-select="1"
                                                    class="js-example-basic-single select2-hidden-accessible">
                                                <option disabled selected
                                                        hidden>@lang('app.component.option_default')</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <table id="table-selected-assign-customer" class="table">
                                    <thead>
                                    <tr>
                                        <th>
                                            {{--                                            <i class="fa fa-2x fa-arrow-circle-left btn-convert-right-to-left pointer" onclick="unCheckAllAssignCustomerEmployee()"></i>--}}
                                            <div class="btn-group btn-group-sm">
                                                <button type="button"
                                                        class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                                        onclick="unCheckAllAssignCustomerEmployee($(this))"><i
                                                            class="fi-rr-arrow-small-left"></i></button>
                                            </div>
                                        </th>
                                        <th>@lang('app.assign-customer.name')</th>
                                        <th>@lang('app.assign-customer.gender')</th>
                                        <th>@lang('app.assign-customer.tag')</th>
                                        <th class="d-none"></th>
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
    @include('manage.food.brand.detail')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js/customer/assgin_customer/index.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript"
            src="{{ asset('js/template_custom/validate/func.js?version=2', env('IS_DEPLOY_ON_SERVER')) }}"></script>
@endpush
