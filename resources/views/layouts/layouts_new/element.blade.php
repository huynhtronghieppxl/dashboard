<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
{{--    <link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/head.css', env('IS_DEPLOY_ON_SERVER'))}}"/>--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/dataTable.css', env('IS_DEPLOY_ON_SERVER'))}}"/>--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/header.css', env('IS_DEPLOY_ON_SERVER'))}}"/>--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/menu_left.css', env('IS_DEPLOY_ON_SERVER'))}}"/>--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/menu_sub.css', env('IS_DEPLOY_ON_SERVER'))}}"/>--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/modal.css', env('IS_DEPLOY_ON_SERVER'))}}"/>--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/input.css', env('IS_DEPLOY_ON_SERVER'))}}"/>--}}
{{--    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/element.css', env('IS_DEPLOY_ON_SERVER'))}}"/>--}}

    @include('layouts.head')
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
</head>
<body style="background: #fff">
<div class="seemt-container">
{{--    header--}}
    <div class="seemt-header">
        <div class="seemt-nav-left col-lg-6">
            <div class="seemt-btn">
                <span class="cursor-pointer"><i class="fi-rr-list"></i></span>
            </div>
            <div class="seemt-logo">
                {{--            <div class="">--}}
                <img class="" src="{{ asset('images/tms/logonew.jpg', env('IS_DEPLOY_ON_SERVER')) }}"/>
                {{--            </div>--}}
            </div>
            <div class="seemt-search">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M8.3545 2.05704C4.71877 2.05704 1.77142 4.94083 1.77142 8.49816C1.77142 12.0555 4.71877 14.9393 8.3545 14.9393C11.9902 14.9393 14.9376 12.0555 14.9376 8.49816C14.9376 4.94083 11.9902 2.05704 8.3545 2.05704ZM0.123291 8.49816C0.123291 4.05022 3.80853 0.444458 8.3545 0.444458C12.9005 0.444458 16.5857 4.05022 16.5857 8.49816C16.5857 12.9461 12.9005 16.5519 8.3545 16.5519C3.80853 16.5519 0.123291 12.9461 0.123291 8.49816Z"
                          fill="#7D7E81"/>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M12.9227 13.3458C13.2441 13.0305 13.7659 13.0298 14.0881 13.3443L16.9922 16.1783C17.3144 16.4928 17.3151 17.0033 16.9937 17.3186C16.6723 17.6339 16.1505 17.6345 15.8283 17.3201L12.9242 14.4861C12.602 14.1716 12.6013 13.6611 12.9227 13.3458Z"
                          fill="#7D7E81"/>
                </svg>

                <input class="ml-1" placeholder="Tìm kiếm">
            </div>
            <div class="seemt-menu-name">
                <span class="">TỔNG QUAN</span>
            </div>
        </div>
        <div class="seemt-nav-right d-flex justify-content-between align-items-center position-relative">
            <div class="box-restaurant-system">
                <div class="box-restaurant-system-brand">
                    <div class="box-restaurant-system-brand-item">
                        <img src="{{asset('images/tms/default.jpeg', env('IS_DEPLOY_ON_SERVER'))}}" alt="">
                        <label>
                            Thương hiệu 1
                        </label>
                        </div>
                </div>
                <div class="box-restaurant-system-branch">
                    <div class="d-flex align-items-center px-2 py-3"
                         style="height: 37px;border-bottom: 0.0rem solid #f5f6fa;">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M8.3545 2.05704C4.71877 2.05704 1.77142 4.94083 1.77142 8.49816C1.77142 12.0555 4.71877 14.9393 8.3545 14.9393C11.9902 14.9393 14.9376 12.0555 14.9376 8.49816C14.9376 4.94083 11.9902 2.05704 8.3545 2.05704ZM0.123291 8.49816C0.123291 4.05022 3.80853 0.444458 8.3545 0.444458C12.9005 0.444458 16.5857 4.05022 16.5857 8.49816C16.5857 12.9461 12.9005 16.5519 8.3545 16.5519C3.80853 16.5519 0.123291 12.9461 0.123291 8.49816Z"
                                  fill="#7D7E81"/>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M12.9227 13.3458C13.2441 13.0305 13.7659 13.0298 14.0881 13.3443L16.9922 16.1783C17.3144 16.4928 17.3151 17.0033 16.9937 17.3186C16.6723 17.6339 16.1505 17.6345 15.8283 17.3201L12.9242 14.4861C12.602 14.1716 12.6013 13.6611 12.9227 13.3458Z"
                                  fill="#7D7E81"/>
                        </svg>

                        <input class="ml-1 w-100 border-0" placeholder="Tìm Kiếm Chi Nhánh">
                    </div>
                    <div class="border-top list-branch-header col-lg-12">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <label>all branch</label>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <label>all branch</label>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <label>all branch</label>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <label>all branch</label>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <label>all branch</label>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <label>all branch</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="seemt-restaurant-system d-flex align-items-center" data-id="'. Session::get(SESSION_KEY_DATA_CURRENT_BRAND)['id'] .'">
                <div> <img src="/images/tms/default.jpeg"> </div>
                <div class="content ml-2">
                    <p> Elusmod Tempor </p>
                    <p> 303 Phạm Văn Đồng</p>
                </div>
                <span class="ml-3 icon-down-system cursor-pointer">
                                    <i class="fi-rr-angle-small-down"></i>
                                </span>
            </div>
            <a class="brand-select has-active d-none" href="javascript:void(0)" data-ripple="" id="restaurant-branch-id-selected">
                <span class="d-none" data-value="' . Session::get(SESSION_KEY_DATA_CURRENT_BRAND)['id'] . '"></span>
            </a>
            <div class="seemt-btn-nav row">
                    <span>
                        <i class="fi-rr-bell"></i>
                        <span class="seemt-quantity">
                            999
                        </span>
                    </span>
                <span>
                        <i class="fi-rr-comment-alt"></i>
                         <span class="seemt-quantity">
                            999
                        </span>
                    </span>
                <span>
                        <i class="fi-rr-time-quarter-to"></i>
                    </span>
                <div>
                    <div>
                        <img class=""
                             src="{{ asset('https://st2.depositphotos.com/5142301/10947/v/950/depositphotos_109476358-stock-illustration-d-letter-with-healthy-food.jpg') }}"/>
                    </div>
                </div>
            </div>
        </div>
    </div>













{{--    input select--}}
    <div class="container-fluid p-5">
        <div class="row card-block card">
            <div class="col-lg-4">
                <div class="form-group validate-group">
                    <div class="form-validate-input">
                        <input type="text" id="name-create-employee-manage" data-spec="1" class="form-control" data-empty="1" data-min-length="2" data-max-length="50">
                        <label for="name-create-employee-manage">
                            Tên                                            <span><i class="fi-rr-asterik"></i></span>
                        </label>
                        <div class="line"></div>
                    </div>
                    <div class="link-href"></div>
                </div>
                <div class="form-group validate-group">
                    <div class="form-validate-input">
                        <input type="text" id="name-create-employee-manage" data-spec="1" class="form-control" data-empty="1" data-min-length="2" data-max-length="50">
                        <label for="name-create-employee-manage">
                            Tên                                            <span><i class="fi-rr-asterik"></i></span>
                        </label>
                        <div class="line"></div>
                    </div>
                    <div class="link-href"></div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group select2_theme validate-group">
                    <div class="form-validate-select">
                        <div class="col-lg-12 pr-0 select-material-box">
                            <select id="select-salary-create-employee-manage" class="js-example-basic-single select2-hidden-accessible" data-select="1" >
                                <option value="" disabled="" selected="">Select subject ...subject select</option>
                                <option value="1589">Bậc 1 - 1,000</option>
                                <option value="1589">Bậc 1 - 1,000</option>
                                <option value="1589">Bậc 1 - 1,000</option>
                                <option value="1589">Bậc 1 - 1,000</option>
                                <option value="1589">Bậc 1 - 1,000</option>
                                <option value="1589">Bậc 1 - 1,000</option>
                            </select>

                            <label for="select-salary-create-employee-manage">
                                Select subject ...subject select
                                <span><i class="fi-rr-asterik"></i></span>
                            </label>
                        </div>
                    </div>
                    <div class="link-href"></div>
                </div>



                <div class="form-group select2_theme validate-group">
                    <div class="form-validate-select">
                        <div class="col-lg-12 mx-0 px-0">
                            <div class="col-lg-12 pr-0 select-material-box">
                                <select id="select-salary-create-employee-manage" class="js-example-basic-single select2-hidden-accessible" data-select="1" >
                                    <option value="" disabled="" selected="">Vui lòng chọn</option>
                                    <option value="1589">Bậc 1 - 1,000</option>
                                    <option value="1589">Bậc 1 - 1,000</option>
                                    <option value="1589">Bậc 1 - 1,000</option>
                                    <option value="1589">Bậc 1 - 1,000</option>
                                    <option value="1589">Bậc 1 - 1,000</option>
                                </select>

                                <label for="select-salary-create-employee-manage">
                                    Bậc lương
                                    <span><i class="fi-rr-asterik"></i></span>
                                </label>
{{--                                <div class="line"></div>--}}
                            </div>
                        </div>
                    </div>
                    <div class="link-href"></div>
                </div>


            </div>


            <div class="col-lg-4">
                <div class="form-validate-select mb-0">
                    <div class="col-lg-12 mx-0 px-0">
                        <div class="pr-0 select-material-box">
                            <select id="select-specifications-create-unit-data" class="js-example-basic-single select2-hidden-accessible" multiple="" data-select="1" tabindex="-1" aria-hidden="true"><option value="1196" data-unit-id="1">bịch (500 gram)</option><option value="1151" data-unit-id="1">30kg (30000 gram)</option><option value="1141" data-unit-id="1">1 tấn gạo (1000 gram)</option><option value="1131" data-unit-id="1">1 kílogram (10 gram)</option><option value="1125" data-unit-id="1">túi lớn hơn (10 gram)</option><option value="1124" data-unit-id="1">1 túi lớn (10 gram)</option><option value="1116" data-unit-id="1">90kg (90000 gram)</option><option value="1046" data-unit-id="1">1 kí (1000 gram)</option><option value="1042" data-unit-id="1">1 kg (1000 gram)</option><option value="1195" data-unit-id="10">1 bịch (3 kg)</option><option value="1045" data-unit-id="10">kj (1000 kg)</option><option value="1044" data-unit-id="10">1 tạ (1000 kg)</option><option value="1043" data-unit-id="10">1 tấn (1000 kg)</option><option value="1194" data-unit-id="67">1 thùng bia (24 Lon)</option><option value="1156" data-unit-id="73">3 lốc (20 Chai)</option><option value="1154" data-unit-id="73">1 lốc (10 Chai)</option><option value="1114" data-unit-id="73">1 thùng bự (100 Chai)</option><option value="1052" data-unit-id="73">thung to (1000 Chai)</option><option value="1051" data-unit-id="73">1 thùng (1000 Chai)</option><option value="1155" data-unit-id="37">2 lốc (20 Hộp)</option><option value="1150" data-unit-id="37">5 phần (5 Hộp)</option><option value="1101" data-unit-id="37">1 túi to (10 Hộp)</option><option value="1153" data-unit-id="31">qưertyuioplkjhgfdaszxcvbnmkjhgfdsazxcvbnmpoiuytrew (1 Bịch)</option><option value="1140" data-unit-id="31">1 thùng too (2 Bịch)</option><option value="1127" data-unit-id="31">1 phần to (1 Bịch)</option><option value="1126" data-unit-id="31">1 phần lớn (1 Bịch)</option><option value="1110" data-unit-id="31">fgj (100 Bịch)</option><option value="1093" data-unit-id="31">1 thìa (10 Bịch)</option><option value="1152" data-unit-id="52">20 (20000 Lốc)</option><option value="1146" data-unit-id="52">2 túi lớn (10 Lốc)</option><option value="1147" data-unit-id="81">1 thùng to (10 Bình)</option><option value="1129" data-unit-id="81">ytfyt (1 Bình)</option><option value="1113" data-unit-id="81">gfg (1 Bình)</option><option value="1099" data-unit-id="81">sot (200 Bình)</option><option value="1098" data-unit-id="81">1 sọt (10 Bình)</option><option value="1055" data-unit-id="81">hgy (10 Bình)</option><option value="1054" data-unit-id="81">1 thungg (10 Bình)</option><option value="1139" data-unit-id="43">1 bịch to (10 Con)</option><option value="1138" data-unit-id="61">1 túi nilong to (10 Miếng)</option><option value="1137" data-unit-id="28">1 tui nilong (10 Muỗng)</option><option value="1134" data-unit-id="70">1 khạp (1 Cái)</option><option value="1133" data-unit-id="70">1 lu lớn (1 Cái)</option><option value="1132" data-unit-id="55">dfg (100000 Bao)</option><option value="1106" data-unit-id="55">ryt (1000 Bao)</option><option value="1123" data-unit-id="76">1thung (1000 Can)</option><option value="1050" data-unit-id="19">tutfdu (1000 Két)</option><option value="1048" data-unit-id="19">hỳhh (100000 Két)</option><option value="1049" data-unit-id="22">1 quý (1000 Vỉ)</option></select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 200px;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1"><ul class="select2-selection__rendered"><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" role="textbox" aria-autocomplete="list" placeholder="" style="width: 0.75em;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                            <label class="icon-validate">
                                Quy cách
                                <span><i class="fi-rr-asterik"></i></span>
                            </label>
                            <div class="line"></div>
                        </div>
                    </div>
                </div>


                <div class="form-validate-select mb-0">
                    <div class="col-lg-12 mx-0 px-0">
                        <div class="pr-0 select-material-box">
                            <select id="select-specifications-create-unit-data" class="js-example-basic-single select2-hidden-accessible" multiple="" data-select="1" tabindex="-1" aria-hidden="true"><option value="1196" data-unit-id="1">bịch (500 gram)</option><option value="1151" data-unit-id="1">30kg (30000 gram)</option><option value="1141" data-unit-id="1">1 tấn gạo (1000 gram)</option><option value="1131" data-unit-id="1">1 kílogram (10 gram)</option><option value="1125" data-unit-id="1">túi lớn hơn (10 gram)</option><option value="1124" data-unit-id="1">1 túi lớn (10 gram)</option><option value="1116" data-unit-id="1">90kg (90000 gram)</option><option value="1046" data-unit-id="1">1 kí (1000 gram)</option><option value="1042" data-unit-id="1">1 kg (1000 gram)</option><option value="1195" data-unit-id="10">1 bịch (3 kg)</option><option value="1045" data-unit-id="10">kj (1000 kg)</option><option value="1044" data-unit-id="10">1 tạ (1000 kg)</option><option value="1043" data-unit-id="10">1 tấn (1000 kg)</option><option value="1194" data-unit-id="67">1 thùng bia (24 Lon)</option><option value="1156" data-unit-id="73">3 lốc (20 Chai)</option><option value="1154" data-unit-id="73">1 lốc (10 Chai)</option><option value="1114" data-unit-id="73">1 thùng bự (100 Chai)</option><option value="1052" data-unit-id="73">thung to (1000 Chai)</option><option value="1051" data-unit-id="73">1 thùng (1000 Chai)</option><option value="1155" data-unit-id="37">2 lốc (20 Hộp)</option><option value="1150" data-unit-id="37">5 phần (5 Hộp)</option><option value="1101" data-unit-id="37">1 túi to (10 Hộp)</option><option value="1153" data-unit-id="31">qưertyuioplkjhgfdaszxcvbnmkjhgfdsazxcvbnmpoiuytrew (1 Bịch)</option><option value="1140" data-unit-id="31">1 thùng too (2 Bịch)</option><option value="1127" data-unit-id="31">1 phần to (1 Bịch)</option><option value="1126" data-unit-id="31">1 phần lớn (1 Bịch)</option><option value="1110" data-unit-id="31">fgj (100 Bịch)</option><option value="1093" data-unit-id="31">1 thìa (10 Bịch)</option><option value="1152" data-unit-id="52">20 (20000 Lốc)</option><option value="1146" data-unit-id="52">2 túi lớn (10 Lốc)</option><option value="1147" data-unit-id="81">1 thùng to (10 Bình)</option><option value="1129" data-unit-id="81">ytfyt (1 Bình)</option><option value="1113" data-unit-id="81">gfg (1 Bình)</option><option value="1099" data-unit-id="81">sot (200 Bình)</option><option value="1098" data-unit-id="81">1 sọt (10 Bình)</option><option value="1055" data-unit-id="81">hgy (10 Bình)</option><option value="1054" data-unit-id="81">1 thungg (10 Bình)</option><option value="1139" data-unit-id="43">1 bịch to (10 Con)</option><option value="1138" data-unit-id="61">1 túi nilong to (10 Miếng)</option><option value="1137" data-unit-id="28">1 tui nilong (10 Muỗng)</option><option value="1134" data-unit-id="70">1 khạp (1 Cái)</option><option value="1133" data-unit-id="70">1 lu lớn (1 Cái)</option><option value="1132" data-unit-id="55">dfg (100000 Bao)</option><option value="1106" data-unit-id="55">ryt (1000 Bao)</option><option value="1123" data-unit-id="76">1thung (1000 Can)</option><option value="1050" data-unit-id="19">tutfdu (1000 Két)</option><option value="1048" data-unit-id="19">hỳhh (100000 Két)</option><option value="1049" data-unit-id="22">1 quý (1000 Vỉ)</option></select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 200px;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1"><ul class="select2-selection__rendered"><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" role="textbox" aria-autocomplete="list" placeholder="" style="width: 0.75em;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                            <label class="icon-validate">
                                Quy cách
                                <span><i class="fi-rr-asterik"></i></span>
                            </label>
                            <div class="line"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="checkbox-form-group">
                    <input id="test" name="" type="checkbox" value="">
                    <label for="test">
                        Select subject ...
                    </label>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="radio-form-group">
                    <form action="#">
                        <div>
                            <input type="radio" id="test1" name="radio-group" checked>
                            <label for="test1">Apple</label>
                        </div>
                        <div>
                            <input type="radio" id="test2" name="radio-group">
                            <label for="test2">Peach</label>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript" src="{{asset('files\bower_components\jquery-ui\js\jquery-ui.min.js')}}"></script>
@include('layouts.script')
@stack('scripts')

</script>
</html>



