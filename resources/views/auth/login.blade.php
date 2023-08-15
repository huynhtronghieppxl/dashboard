@extends('auth.layout')
@section('content')
    <section class="login-block">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    <form class="md-float-material form-material" method="post" action="/login">
                        {{ csrf_field() }}
                        <div class="text-center"
                            style="width: 400px;
                            height: 150px;
                            z-index: 999;
                            margin-bottom: -100px !important;
                            position: relative;
                            margin: auto;
                            background: linear-gradient(60deg, #0066cc, #003366);
                            box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(255, 152, 0, 0.4);
                            border-radius: 10px">
                            <img src="..\files\assets\images\logo-login.png" alt="logo.png">
                        </div>
                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-20" style="margin-top: 80px">
                                    <div class="col-md-12">
                                        <h3 class="text-center">@lang('modules.employee.login')</h3>
                                    </div>
                                </div>
                                <div class="form-group form-primary">
                                    <input type="text" name="restaurant_name" class="form-control" required="" placeholder="@lang('modules.employee.restaurant_name')">
                                    <span class="form-bar"></span>
                                </div>

                                <div class="form-group form-primary">
                                    <input type="text" name="username" class="form-control" required=""  placeholder="@lang('modules.employee.username')">
                                    <span class="form-bar"></span>
                                </div>
                                <div class="form-group form-primary">
                                    <input type="password" name="password" class="form-control" required="" placeholder="@lang('modules.employee.password')">
                                    <span class="form-bar"></span>
                                </div>

                                <div class="row m-t-25 text-left">
                                    <div class="col-12">
                                        <div class="checkbox-fade fade-in-primary d-">
                                            <label>
                                                <div class="border-checkbox-section">
                                                    <div class="border-checkbox-group border-checkbox-group-warning">
                                                        <input class="border-checkbox" type="checkbox" id="checkbox4">
                                                        <label class="border-checkbox-label" for="checkbox4">@lang('modules.employee.remember')</label>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="forgot-phone text-right f-right">
                                            <a href="#" class="text-right f-w-600">@lang('modules.employee.register_account')</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">@lang('modules.employee.login')</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- end of form -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
        <!-- end of container-fluid -->
@endsection
