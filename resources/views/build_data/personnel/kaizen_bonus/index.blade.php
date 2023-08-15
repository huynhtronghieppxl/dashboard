@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card card-block3">
                <div class="table-responsive new-table">
                    <table id="table-kaizen-bonus-data" class="table">
                        <thead>
                        <tr>
                            <th>@lang('app.kaizen-bonus-data.stt')</th>
                            <th>@lang('app.kaizen-bonus-data.name')</th>
                            <th>@lang('app.kaizen-bonus-data.amount')</th>
                            <th>@lang('app.kaizen-bonus-data.update_at')</th>
                            <th class="d-none"></th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <div class="input-group d-flex justify-content-end py-2">
                    <div class="btn seemt-btn-hover-blue seemt-bg-blue seemt-blue d-none d-flex align-items-center"
                         style="margin-right: 10px ; text-transform: uppercase" id="btn-update-kaizen-bonus-data">
                        <i class="fa fa-upload" style="font-size: 16.5px !important;"></i>
                        <span>@lang('app.component.button.update')</span>
                    </div>
                    <div class="btn seemt-btn-hover-gray seemt-bg-gray-w200 d-none d-flex align-items-center"
                         style="margin-right: 10px" id="btn-close-kaizen-bonus-data">
                        <i class="fi-rr-cross"></i>
                        <span>@lang('app.component.button.close')</span>
                    </div>
                    <div class="btn seemt-blue seemt-bg-blue seemt-btn-hover-blue d-none d-flex align-items-center"
                         id="btn-save-kaizen-bonus-data">
                        <i class="fi-rr-disk"></i>
                        <span>@lang('app.component.button.save')</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('build_data.personnel.kaizen_bonus.create')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('js/build_data/personnel/kaizen_bonus/index.js?version=4', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript"
            src="{{asset('js/build_data/personnel/kaizen_bonus/update.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
