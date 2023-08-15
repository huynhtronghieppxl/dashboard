@extends('layouts.layout')
@section('content')
    <style>
        .content-chart {
            height: calc(100vh / 10);
        }
    </style>
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card-block card ">
                <div id="chart-price-change-histories-container-1" class="content-chart"
                     style="background: #f5f6fa">
                </div>
            </div>
            <div class="card-block card ">
                <div id="chart-price-change-histories-container-2" class="content-chart"
                     style="background: #f5f6fa">
                </div>
            </div>
            <div class="card-block card ">
                <div id="chart-price-change-histories-container-3" class="content-chart"
                     style="background: #f5f6fa">
                </div>
            </div>
            <div class="card-block card ">
                <div id="chart-price-change-histories-container-4" class="content-chart"
                     style="background: #f5f6fa">
                </div>
            </div>
            <div class="card-block card ">
                <div id="chart-price-change-histories-container-5" class="content-chart"
                     style="background: #f5f6fa">
                </div>
            </div>
            <div class="card-block card ">
                <div id="chart-price-change-histories-container-6" class="content-chart"
                     style="background: #f5f6fa">
                </div>
            </div>
            <div class="card-block card ">
                <div id="chart-price-change-histories-container-7" class="content-chart"
                     style="background: #f5f6fa">
                </div>
            </div>
            <div class="card-block card ">
                <div id="chart-price-change-histories-container-8" class="content-chart"
                     style="background: #f5f6fa">
                </div>
            </div>
            <div class="card-block card ">
                <div id="chart-price-change-histories-container-9" class="content-chart"
                     style="background: #f5f6fa">
                </div>
            </div>
            <div class="card-block card ">
                <div id="chart-price-change-histories-container-10" class="content-chart"
                     style="background: #f5f6fa">
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('..\js\report\all_report\index.js?version=1')}}"></script>
@endpush
