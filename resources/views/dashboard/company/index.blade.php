@extends('layouts.layout')
@section('content')
    <link rel="stylesheet" type="text/css"
          href="{{asset('/files/assets/pages/timeline/style.css', env('IS_DEPLOY_ON_SERVER'))}}">
    <style>
        .seemt-container .seemt-main {
            overflow-y: hidden;
        }

        .cd-timeline {
            padding: 0 21px 9px 9px !important;
        }

        .page-wrapper::-webkit-scrollbar {
            width: 4px;
        }

        .cd-timeline::-webkit-scrollbar {
            width: 0;
        }

        .text-revenue > label {
            text-transform: uppercase;
        }

        #company-dashboard-report .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 26px;
        }

        @media screen and (max-width: 1500px) {
            .seemt-container .revenue .paid-revenue {
                align-items: center;
                justify-content: space-between;
            }

            .seemt-container .revenue .logo-revenue {
                width: 50px;
                height: 50px;
                padding: 10px 18.33px 18.33px 11.33px;
                border-radius: 6px;
            }

            .seemt-container .revenue .logo-revenue i {
                font-size: 26.33px !important;
            }

            .seemt-container .revenue .paid-revenue .content-revenue .total-revenue label {
                font-size: 20px;
            }
        }

        @media screen and (max-width: 1300px) {
            .seemt-container .revenue .logo-revenue {
                width: 40px;
                height: 40px;
                padding: 8px 18.33px 18.33px 11.33px;
                border-radius: 6px;
            }

            .seemt-container .revenue .logo-revenue i {
                font-size: 20.33px !important;
            }
        }

        @media screen and (min-width: 1201px) and (max-width: 1300px) {
            .seemt-container .revenue .paid-revenue .content-revenue .total-revenue label {
                font-size: 18px;
            }
        }

        @media screen and (max-width: 1200px) {
            .seemt-container .revenue .paid-revenue .content-revenue .total-revenue label {
                font-size: 18px;
            }
        }
    </style>
    <div class="main-body">
        <div class="page-wrapper" style=" overflow: auto; max-height: calc(100vh - 62px); overflow-x: hidden"
             id="company-dashboard-report">
            <div class="cd-timeline cd-container"
                 style="width: 45px; position: fixed;height: calc(100vh - 90px);display: block;overflow-y: auto;">
                <div class="cd-timeline-block">
                    <div class="cd-timeline-icon bg-customer-default revenue-cost-cash-flow-report active"
                         data-position="0" data-key="revenue-cost-cash-flow-report" title=""
                         data-toggle="tooltip" data-placement="right"
                         data-original-title="@lang('app.branch-dashboard.revenue-cost-profit-report.title1')">
                        <i class="fi-rr-chat-arrow-grow"></i>
                    </div>
                </div>
                <div class="cd-timeline-block d-none">
                    <div class="cd-timeline-icon bg-customer-default profit-loss-report"
                         data-position="1" data-key="profit-loss-report" title=""
                         data-toggle="tooltip" data-placement="right"
                         data-original-title="Báo cáo P&L">
                        <i class="icofont icofont-papers"></i>
                    </div>
                </div>
                <div class="cd-timeline-block">
                    <div class="cd-timeline-icon bg-customer-default cost-freight-report"
                         data-position="2" data-key="cost-freight-report" title=""
                         data-toggle="tooltip" data-placement="right"
                         data-original-title="Báo cáo C&F">
                        <i class="icofont icofont-papers"></i>
                    </div>
                </div>
            </div>
            <div class="page-body page-body-dashboard" style="padding-left: 50px">
                @include('dashboard.company.revenue_cost__cash-flow_report')
                {{--                @include('dashboard.company.profit_loss_report')--}}
                @include('dashboard.branch.cost_freight_report')
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript"
            src="{{asset('/js/dashboard/company/index.js?version=1 ',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
