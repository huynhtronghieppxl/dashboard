@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card card-block">
                <div class="table-responsive new-table">
                    <table id="table-unit-order-data" class="table">
                        <thead>
                        <tr>
                            <th>@lang('app.unit-order-data.stt')</th>
                            <th>@lang('app.unit-order-data.name')</th>
                            <th>@lang('app.unit-order-data.material')</th>
                            <th></th>
                            <th class="d-none key_search"></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('build_data.material.unit_order.create')
    @include('build_data.material.unit_order.update')
    @include('build_data.material.unit_order.material')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\build_data\material\unit_order\index.js?version=1', env('IS_DEPLOY_ON_SERVER')) }}"></script>
@endpush
