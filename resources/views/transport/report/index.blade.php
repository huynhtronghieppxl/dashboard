@extends('layouts.layout')
@section('content')
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card statustic-progress-card">
                            <div class="card-header">
                                <h5>@lang('app.trasport-dashboard.card1.tab1')</h5>
                            </div>
                            <div class="card-block">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <label class="label label-success">
                                            35% <i class="m-l-10 feather icon-arrow-up"></i>
                                        </label>
                                    </div>
                                    <div class="col text-right">
                                        <h5 class="">35</h5>
                                    </div>
                                </div>
                                <div class="progress m-t-15">
                                    <div class="progress-bar bg-c-green" style="width:35%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card statustic-progress-card">
                            <div class="card-header">
                                <h5>@lang('app.trasport-dashboard.card1.tab2')</h5>
                            </div>
                            <div class="card-block">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <label class="label bg-c-lite-green">
                                            35% <i class="m-l-10 feather icon-arrow-up"></i>
                                        </label>
                                    </div>
                                    <div class="col text-right">
                                        <h5 class="">28</h5>
                                    </div>
                                </div>
                                <div class="progress m-t-15">
                                    <div class="progress-bar bg-c-lite-green" style="width:28%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card statustic-progress-card">
                            <div class="card-header">
                                <h5>@lang('app.trasport-dashboard.card1.tab3')</h5>
                            </div>
                            <div class="card-block">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <label class="label label-danger">
                                            35% <i class="m-l-10 feather icon-arrow-up"></i>
                                        </label>
                                    </div>
                                    <div class="col text-right">
                                        <h5 class="">87</h5>
                                    </div>
                                </div>
                                <div class="progress m-t-15">
                                    <div class="progress-bar bg-c-pink" style="width:87%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card statustic-progress-card">
                            <div class="card-header">
                                <h5>@lang('app.trasport-dashboard.card1.tab4')</h5>
                            </div>
                            <div class="card-block">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <label class="label label-warning">
                                            35% <i class="m-l-10 feather icon-arrow-up"></i>
                                        </label>
                                    </div>
                                    <div class="col text-right">
                                        <h5 class="">32</h5>
                                    </div>
                                </div>
                                <div class="progress m-t-15">
                                    <div class="progress-bar bg-c-yellow" style="width:32%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-block">
                                <div class="row align-items-center m-l-0">
                                    <div class="col-auto">
                                        <i class="feather icon-book f-30 text-c-lite-green"></i>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="text-muted m-b-10">@lang('app.trasport-dashboard.card1.tab5')</h6>
                                        <h2 class="m-b-0">379</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-block">
                                <div class="row align-items-center m-l-0">
                                    <div class="col-auto">
                                        <i class="feather icon-feather f-30 text-c-green"></i>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="text-muted m-b-10">@lang('app.trasport-dashboard.card1.tab6')</h6>
                                        <h2 class="m-b-0">205</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-block">
                                <div class="row align-items-center m-l-0">
                                    <div class="col-auto">
                                        <i class="feather icon-users f-30 text-c-pink"></i>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="text-muted m-b-10">@lang('app.trasport-dashboard.card1.tab7')</h6>
                                        <h2 class="m-b-0">5984</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-block">
                                <div class="row align-items-center m-l-0">
                                    <div class="col-auto">
                                        <i class="feather icon-battery-charging f-30 text-c-blue"></i>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="text-muted m-b-10">@lang('app.trasport-dashboard.card1.tab8')</h6>
                                        <h2 class="m-b-0">325</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
