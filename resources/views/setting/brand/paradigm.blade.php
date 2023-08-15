<head>
    <link href="{{ asset('css/css_custom/setting_brand/media.css') }}" rel="stylesheet">
</head>
<div class="card card-block mt-2 bg-white-border box-shadow-div">
    <div class="d-flex justify-content-between">
        <h2 class="sub-title d-block">@lang('app.brand-setting.paradigm.title')</h2>
        <a href="javascript:void(0)" class="show-more-detail-procedure" onclick="openDetail()">@lang('app.brand-setting.detail')</a>
    </div>
    <div class="row">
        <div class="col-md-6">
            <p class="m-b-10 f-w-600 d-inline text-uppercase" style="font-size: 15px !important;">Quy mô : </p>
            <h6 class="text-muted f-w-400 d-inline " style="font-size: 15px !important;"
                id="scale-detail-paradigm-restaurant"></h6>
        </div>
        <div class="col-md-6">
            <p class="m-b-10 f-w-600 d-inline" style="font-size: 15px !important;">@lang('app.brand-setting.paradigm.price') : </p>
            <h6 class="text-muted f-w-400 d-inline " style="font-size: 15px !important;"
                id="price-detail-paradigm-restaurant"></h6>
        </div>
    </div>
</div>
<div class="card card-block mt-2 bg-white-border box-shadow-div">
    <div class="d-flex justify-content-between">
        <h2 class="sub-title d-block">@lang('app.brand-setting.paradigm.name')</h2>
        <a href="javascript:void(0)" class="show-more-detail-procedure" onclick="openDetailProcedure()">@lang('app.brand-setting.detail')</a>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <p class="m-b-10 f-w-600 d-inline text-uppercase" style="font-size: 15px !important;">Giải pháp : </p>
            <h6 class="text-muted f-w-400 d-inline " style="font-size: 15px !important;"
                id="process-detail-paradigm-restaurant"></h6>
        </div>
        <div class="col-lg-6">
            <p class="m-b-10 f-w-600 d-inline text-uppercase" style="font-size: 15px !important;">@lang('app.brand-setting.procedure.option') : </p>
            <h6 class="text-muted f-w-400 d-inline " style="font-size: 15px !important;"
                id="option-detail-paradigm-restaurant"></h6>
        </div>
    </div>
</div>

@include('setting.brand.detail')
@include('setting.brand.detail_procedure')
