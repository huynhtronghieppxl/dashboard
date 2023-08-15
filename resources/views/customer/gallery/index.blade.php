@extends('layouts.layout')
@section('content')
    <style>
        #myDIV {
            height: 250px;
            width: 250px;
            overflow: auto;
        }

        #content1 {
            width: 2000px;
            background-color: #e2d776;
        }

        #content2 {
            width: 2000px;
            background-color: #4ea7cb;
        }

        #content3 {
            width: 2000px;
            background-color: #7bc494;
        }

        .insert{
            border: 2px solid #7bc494;
            padding: 2px;
        }
    </style>
    <div class="main-body">
        <div class="page-wrapper">
            <!-- Page-header start -->
            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="page-header-title">
                            <div class="d-inline">
                                <h4>@lang('app.gallery.title')</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="page-header-breadcrumb">
                            <ul class="breadcrumb-title">
                                <li class="breadcrumb-item">
                                    <a href="/"> <i class="feather icon-home"></i> </a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="{{route('customer.gallery-customer.index')}}">@lang('app.gallery.breadcrumb')</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page-header end -->

            <div class="page-body masonry-page">


                <!-- Test scroll div -->
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 m-auto">
                            <input class="insert" id="number"><br>
                            <label class="font-weight-bold" id="demo"></label>
                        </div>
                        <div class="col-lg-7">
                            <div class="card card-block" id="scroll"></div>
                        </div>
                    </div>
                </div>
                <!-- End test scroll div -->
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    @include('layouts.oldDatatable')
    <script type="text/javascript"
            src="{{asset('js/customer/gallery/index.js?version=', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
