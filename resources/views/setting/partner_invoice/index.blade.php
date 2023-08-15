@extends('layouts.layout')
@section('content')
    <style>
        #partner-invoice-content .nav-item {
            margin-bottom: 8px;
        }

        #partner-invoice-content .nav-link {
            border-radius: 5px;
        }

        #partner-invoice-content .nav-link.active {
            border-color: #007bff !important;
        }
    </style>
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="card card-block">
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
                            <div class="form-validate-select" style="transform: translateX(-6px) !important;">
                                <div class="pr-0 select-material-box">
                                    <select class="js-example-basic-single select-branch">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <table id="partner-invoice-table">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên đối tác</th>
                                <th>Chi nhánh</th>
                                <th>Mã số thuế</th>
                                <th>Tài khoản</th>
                                <th>Mẫu số hóa đơn</th>
                                <th>Chữ ký điện tử</th>
                                <th></th>
                                {{--                                <th class="d-none"></th>--}}
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                {{--               <div class="card-block d-flex" style="max-width: 1200px;--}}
                {{--                 margin: 0 auto;" id="partner-invoice-content">--}}
                {{--                   <div class="col-lg-3 col-md-6 col-sm-12">--}}
                {{--                       <ul class="policy nav nav-tabs nav-tabs--vertical nav-tabs--left nav-tabs-regulations-left" style="flex-direction: column" id="list-partner-invoice-contact">--}}
                {{--                           <li class="nav-item">--}}
                {{--                               <a href="#terms" class="nav-link active" data-id="7" data-toggle="tab">--}}
                {{--                                   <h3 class="level_title display-4" style="font-size: 25px;font-weight: 400">--}}
                {{--                                       MINVOICE--}}
                {{--                                   </h3>--}}
                {{--                               </a>--}}
                {{--                           </li>--}}
                {{--                           <li class="nav-item">--}}
                {{--                               <a href="#agreement" class="nav-link" data-id="2" data-toggle="tab">--}}
                {{--                                   <h3 class="level_title display-4" style="font-size: 25px;font-weight: 400">--}}
                {{--                                       MIFI--}}
                {{--                                   </h3>--}}
                {{--                               </a>--}}
                {{--                           </li>--}}
                {{--                       </ul>--}}
                {{--                   </div>--}}
                {{--                  --}}
                {{--               </div>--}}
            </div>
        </div>
    </div>
    @include('setting.partner_invoice.create')
    @include('setting.partner_invoice.update')
@endsection
@push('scripts')
    @include('layouts.datatable')
    <script type="text/javascript"
            src="{{ asset('js\template_custom\dataTable.js?version=1', env('IS_DEPLOY_ON_SERVER'))}}"></script>
    <script type="text/javascript"
            src="{{ asset('js\setting\partner_invoice\index.js?version=2', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
