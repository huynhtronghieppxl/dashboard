<style>
    /*.new-table .dataTables_scrollBody table tbody tr:hover {*/
    /*    background: transparent !important;*/
    /*}*/

</style>
@extends('layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card">
                <div class="row">
                    <div class="col-lg-12 d-flex align-items-center">
                        <div class="col-lg-12">
                            @include('report.filter')
                        </div>
                    </div>
                </div>
                <div class="card-block">
                    <ul class="nav nav-tabs md-tabs" role="tablist" id="nav-tabs-material-food">
                        <li class="nav-item">
                            <a class="nav-link" data-tab="1" data-toggle="tab" href="#tab1-material-food-report"
                               role="tab" aria-expanded="true">@lang('app.material-food-report.tab1') <span
                                        class="label label-success" id="total-record-material">0</span></a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-tab="2" data-toggle="tab" href="#tab2-material-food-report"
                               role="tab" aria-expanded="false">@lang('app.material-food-report.tab2') <span
                                        class="label label-warning" id="total-record-goods">0</span></a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-tab="3" data-toggle="tab" href="#tab3-material-food-report"
                               role="tab" aria-expanded="false">@lang('app.material-food-report.tab3') <span
                                        class="label label-primary"
                                        id="total-record-internal">0</span></a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-tab="4" data-toggle="tab" href="#tab4-material-food-report"
                               role="tab" aria-expanded="false">@lang('app.material-food-report.tab4') <span
                                        class="label label-inverse" id="total-record-other">0</span></a>
                            <div class="slide"></div>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1-material-food-report" role="tabpanel">
                            <div class="table-responsive new-table new-table-row-group">
                                <table class="table" id="table-material-material-food-report">
                                    <thead>
                                    <tr>
                                        <th>
                                            @lang('app.material-food-report.stt')<br>
                                        </th>
                                        <th>
                                            @lang('app.material-food-report.material')<br>
                                        </th>

                                        <th>
                                            @lang('app.material-food-report.type')<br>
                                        </th>
                                        <th>
                                            @lang('app.material-food-report.food')<br>
                                        </th>
                                        <th>Nhập + Tồn đầu</th>

                                        <th>
                                            @lang('app.material-food-report.quantitative')
                                            <div style="padding: 5px 20px">
                                                @lang('app.material-food-report.note-1')
                                            </div>
                                        </th>
                                        <th>
                                            <div class="d-flex">
                                                @lang('app.material-food-report.unit-quantitative')
                                                <i class="fi-rr-exclamation" style="font-size: 13px !important;"
                                                   data-toggle="tooltip" data-placement="top"
                                                   data-original-title="@lang('app.material-food-report.unit-quantitative-2')"></i>
                                            </div>
                                            <div style="padding: 5px 20px">
                                                @lang('app.material-food-report.note-2')
                                            </div>
                                        </th>
                                        <th>
                                            @lang('app.material-food-report.quantity')
                                            <div style="padding: 5px 20px">
                                                @lang('app.material-food-report.note-3')
                                            </div>
                                        </th>
                                        <th>
                                            @lang('app.material-food-report.unit-food')<br>
                                            <div style="padding: 5px 20px">
                                                @lang('app.material-food-report.note-4')
                                            </div>

                                        </th>
                                        <th>
                                            @lang('app.material-food-report.total-material-food')
                                            <div style="padding: 5px 45px">
                                                @lang('app.material-food-report.note-5')
                                            </div>
                                        </th>
                                        <th>
                                            @lang('app.material-food-report.total-unit')
                                            <div style="padding: 5px 40px">
                                                @lang('app.material-food-report.note-6')
                                            </div>
                                        </th>
                                        <th>
                                            @lang('app.material-food-report.total-material')
                                            <div style="padding: 5px 45px">
                                                @lang('app.material-food-report.note-7')
                                            </div>
                                        </th>
                                        <th>
                                            <div class="d-flex">
                                                @lang('app.material-food-report.unit-material')
                                                <i class="fi-rr-exclamation" style="font-size: 13px !important;"
                                                   data-toggle="tooltip" data-placement="top"
                                                   data-original-title="@lang('app.material-food-report.unit-material-2')"></i><br>
                                            </div>
                                            <div style="padding: 5px 20px">
                                                @lang('app.material-food-report.note-8')
                                            </div>
                                        </th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2-material-food-report" role="tabpanel">
                            <div class="table-responsive new-table">
                                <table class="table" id="table-goods-material-food-report">
                                    <thead>
                                    <tr>
                                        <th>
                                            @lang('app.material-food-report.stt')<br>
                                        </th>
                                        <th>
                                            @lang('app.material-food-report.material')<br>
                                        </th>

                                        <th>
                                            @lang('app.material-food-report.type')<br>
                                        </th>
                                        <th>
                                            @lang('app.material-food-report.food')<br>
                                        </th>
                                        <th>Nhập + Tồn đầu</th>

                                        <th>
                                            @lang('app.material-food-report.quantitative')
                                            <div style="padding: 5px 20px">
                                                @lang('app.material-food-report.note-1')
                                            </div>
                                        </th>
                                        <th>
                                            <div class="d-flex">
                                                @lang('app.material-food-report.unit-quantitative')
                                                <i class="fi-rr-exclamation" style="font-size: 13px !important;"
                                                   data-toggle="tooltip" data-placement="top"
                                                   data-original-title="@lang('app.material-food-report.unit-quantitative-2')"></i>
                                            </div>
                                            <div style="padding: 5px 20px">
                                                @lang('app.material-food-report.note-2')
                                            </div>
                                        </th>
                                        <th>
                                            @lang('app.material-food-report.quantity')
                                            <div style="padding: 5px 20px">
                                                @lang('app.material-food-report.note-3')
                                            </div>
                                        </th>
                                        <th>
                                            @lang('app.material-food-report.unit-food')<br>
                                            <div style="padding: 5px 20px">
                                                @lang('app.material-food-report.note-4')
                                            </div>

                                        </th>
                                        <th>
                                            @lang('app.material-food-report.total-material-food')
                                            <div style="padding: 5px 45px">
                                                @lang('app.material-food-report.note-5')
                                            </div>
                                        </th>
                                        <th>
                                            @lang('app.material-food-report.total-unit')
                                            <div style="padding: 5px 40px">
                                                @lang('app.material-food-report.note-6')
                                            </div>
                                        </th>
                                        <th>
                                            @lang('app.material-food-report.total-material')
                                            <div style="padding: 5px 45px">
                                                @lang('app.material-food-report.note-7')
                                            </div>
                                        </th>
                                        <th>
                                            <div class="d-flex">
                                                @lang('app.material-food-report.unit-material')
                                                <i class="fi-rr-exclamation" style="font-size: 13px !important;"
                                                   data-toggle="tooltip" data-placement="top"
                                                   data-original-title="@lang('app.material-food-report.unit-material-2')"></i><br>
                                            </div>
                                            <div style="padding: 5px 20px">
                                                @lang('app.material-food-report.note-8')
                                            </div>
                                        </th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab3-material-food-report" role="tabpanel">
                            <div class="table-responsive new-table">
                                <table class="table" id="table-internal-material-food-report">
                                    <thead>
                                    <tr>
                                        <th>
                                            @lang('app.material-food-report.stt')<br>
                                        </th>
                                        <th>
                                            @lang('app.material-food-report.material')<br>
                                        </th>

                                        <th>
                                            @lang('app.material-food-report.type')<br>
                                        </th>
                                        <th>
                                            @lang('app.material-food-report.food')<br>
                                        </th>
                                        <th>Nhập + Tồn đầu</th>

                                        <th>
                                            @lang('app.material-food-report.quantitative')
                                            <div style="padding: 5px 20px">
                                                @lang('app.material-food-report.note-1')
                                            </div>
                                        </th>
                                        <th>
                                            <div class="d-flex">
                                                @lang('app.material-food-report.unit-quantitative')
                                                <i class="fi-rr-exclamation" style="font-size: 13px !important;"
                                                   data-toggle="tooltip" data-placement="top"
                                                   data-original-title="@lang('app.material-food-report.unit-quantitative-2')"></i>
                                            </div>
                                            <div style="padding: 5px 20px">
                                                @lang('app.material-food-report.note-2')
                                            </div>
                                        </th>
                                        <th>
                                            @lang('app.material-food-report.quantity')
                                            <div style="padding: 5px 20px">
                                                @lang('app.material-food-report.note-3')
                                            </div>
                                        </th>
                                        <th>
                                            @lang('app.material-food-report.unit-food')<br>
                                            <div style="padding: 5px 20px">
                                                @lang('app.material-food-report.note-4')
                                            </div>

                                        </th>
                                        <th>
                                            @lang('app.material-food-report.total-material-food')
                                            <div style="padding: 5px 45px">
                                                @lang('app.material-food-report.note-5')
                                            </div>
                                        </th>
                                        <th>
                                            @lang('app.material-food-report.total-unit')
                                            <div style="padding: 5px 40px">
                                                @lang('app.material-food-report.note-6')
                                            </div>
                                        </th>
                                        <th>
                                            @lang('app.material-food-report.total-material')
                                            <div style="padding: 5px 45px">
                                                @lang('app.material-food-report.note-7')
                                            </div>
                                        </th>
                                        <th>
                                            <div class="d-flex">
                                                @lang('app.material-food-report.unit-material')
                                                <i class="fi-rr-exclamation" style="font-size: 13px !important;"
                                                   data-toggle="tooltip" data-placement="top"
                                                   data-original-title="@lang('app.material-food-report.unit-material-2')"></i><br>
                                            </div>
                                            <div style="padding: 5px 20px">
                                                @lang('app.material-food-report.note-8')
                                            </div>
                                        </th>
                                        <th class="d-none"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab4-material-food-report" role="tabpanel">
                            <div class="table-responsive  new-table">
                                <table class="table" id="table-other-material-food-report">
                                    <thead>
                                    <tr>
                                        <th>
                                            @lang('app.material-food-report.stt')<br>
                                        </th>
                                        <th>
                                            @lang('app.material-food-report.material')<br>
                                        </th>

                                        <th>
                                            @lang('app.material-food-report.type')<br>
                                        </th>
                                        <th>
                                            @lang('app.material-food-report.food')<br>
                                        </th>
                                        <th>Nhập + Tồn đầu</th>

                                        <th>
                                            @lang('app.material-food-report.quantitative')
                                            <div style="padding: 5px 20px">
                                                @lang('app.material-food-report.note-1')
                                            </div>
                                        </th>
                                        <th>
                                            <div class="d-flex">
                                                @lang('app.material-food-report.unit-quantitative')
                                                <i class="fi-rr-exclamation" style="font-size: 13px !important;"
                                                   data-toggle="tooltip" data-placement="top"
                                                   data-original-title="@lang('app.material-food-report.unit-quantitative-2')"></i>
                                            </div>
                                            <div style="padding: 5px 20px">
                                                @lang('app.material-food-report.note-2')
                                            </div>
                                        </th>
                                        <th>
                                            @lang('app.material-food-report.quantity')
                                            <div style="padding: 5px 20px">
                                                @lang('app.material-food-report.note-3')
                                            </div>
                                        </th>
                                        <th>
                                            @lang('app.material-food-report.unit-food')<br>
                                            <div style="padding: 5px 20px">
                                                @lang('app.material-food-report.note-4')
                                            </div>

                                        </th>
                                        <th>
                                            @lang('app.material-food-report.total-material-food')
                                            <div style="padding: 5px 45px">
                                                @lang('app.material-food-report.note-5')
                                            </div>
                                        </th>
                                        <th>
                                            @lang('app.material-food-report.total-unit')
                                            <div style="padding: 5px 40px">
                                                @lang('app.material-food-report.note-6')
                                            </div>
                                        </th>
                                        <th>
                                            @lang('app.material-food-report.total-material')
                                            <div style="padding: 5px 45px">
                                                @lang('app.material-food-report.note-7')
                                            </div>
                                        </th>
                                        <th>
                                            <div class="d-flex">
                                                @lang('app.material-food-report.unit-material')
                                                <i class="fi-rr-exclamation" style="font-size: 13px !important;"
                                                   data-toggle="tooltip" data-placement="top"
                                                   data-original-title="@lang('app.material-food-report.unit-material-2')"></i><br>
                                            </div>
                                            <div style="padding: 5px 20px">
                                                @lang('app.material-food-report.note-8')
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
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('..\js\report\material_food\index.js?version=8')}}"></script>
    <script type="text/javascript" src="{{ asset('..\js\report\material_food\action.js?version=2')}}"></script>
@endpush
