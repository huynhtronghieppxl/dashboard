@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card card-block">
                <div class="table-responsive new-table">
                    <table id="table-unit-food-data" class="table">
                        <thead>
                        <tr>
                            <th>@lang('app.unit-food-data.stt')</th>
                            <th>@lang('app.unit-food-data.name')</th>
                            <th></th>
                            <th class="d-none"></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('build_data.food.unit.create')
    @include('build_data.food.unit.update')
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{ asset('js\build_data\food\unit\index.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
