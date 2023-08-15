@extends('layouts.layout')
<style>
    section {
        column-width: initial !important;
        float: left;
        position: relative;
        width: 100%;
        color: #fff;
    }

    .price-box {
        background: #fff none repeat scroll 0 0;
        box-shadow: 0 10px 20px rgb(0 0 0 / 20%);
        display: inline-block;
        text-align: center;
        width: 100%;
    }

    .pricings {
        display: inline-block;
        padding: 30px 30px;
        width: 100%;
    }

    .pricings > h1 {
        color: #0e304c;
        display: inline-block;
        font-size: 45px;
        position: relative;
        width: 100%;
        font-weight: 600;
    }

    .pricings > h2 {
        color: #0e304c;
        font-weight: bold;
        margin: 0 0 17px;
        text-transform: uppercase;
    }

    .price-box > span {
        color: #fff;
        text-transform: capitalize;
        font-weight: 500;color: #fff;
        display: inline-block;
        width: 100%;
        text-transform: capitalize;
        font-weight: 500;
        width: 100%;
        height: 45px;
        display: flex;
        align-content: center;
        justify-content: center;
        align-items: center;
        font-size: 18px !important;
    }

    .bg-blue {
        background: #23d2e2;
    }

    .page-header {
        background: #495b72 none repeat scroll 0 0;
        border-bottom: 1px solid #e1e8ed;
        position: relative;
        float: left;
        padding: 50px 15px 0;
        width: 100%;
    }

    .header-inner {
        display: block;
        margin: 0 auto;
        max-width: 50%;
        text-align: center;
        width: 100%;
        z-index: 3;
        position: relative;
    }

    .page-header > figure {
        float: left;
        margin-bottom: 0;
        margin-top: 30px;
        text-align: center;
        width: 100%;
        z-index: 3;
        position: relative;
    }

    .gap {
        float: left;
        padding: 40px 0;
        position: relative;
        width: 100%;
    }

    .sec-heading {
        display: inline-block;
        margin-bottom: 50px;
        width: 100%;
    }

    .sec-heading.style9 > span {
        font-size: 12px;
        text-transform: capitalize;
    }

    .sec-heading.style9 > h2 {
        font-size: 32px;
        font-weight: bold;
        text-transform: uppercase;
        color: #0e304c;
    }

    .sec-heading.style9 > span i {
        font-size: 15px;
        margin-right: 5px;
    }

    .pricings > p {
        color: #535165;
        line-height: 20px;
        padding: 10px 0px 10px 0px;
    }

    .price-features {
        display: inline-block;
        list-style: outside none none;
        margin-bottom: 20px;
        padding-left: 0;
        text-align: left;
        width: 100%;
    }

    [class*=" ti-"], [class^=ti-] {
        font-family: themify;
        speak: none;
        font-style: normal;
        font-weight: 400;
        font-variant: normal;
        text-transform: none;
        line-height: 1;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .price-features > li {
        display: inline-block;
        font-size: 14px;
        margin-bottom: 15px;
        width: 100%;
    }

    .price-features > li > i {
        color: red;
        font-size: 10px;
        margin-right: 10px;
    }

    a.main-btn, a.main-btn3 {
        border-color: transparent;
    }

    .bg-purple {
        background: #7750f8;
    }

    .pricings > h1 span {
        font-size: 11px;
        font-style: italic;
        position: absolute;
        right: 60px;
        top: 0;
    }

    .bg-red {
        background: #e44a3c;
    }

    a.main-btn, a.main-btn2, a.main-btn3 {
        -webkit-border-radius: 30px;
        -moz-border-radius: 30px;
        -ms-border-radius: 30px;
        -o-border-radius: 30px;
        border-radius: 30px;
        color: #fff;
        font-size: 13px;
        font-weight: 500;
        padding: 10px 26px;
        display: inline-block;
        transition: all 0.2s linear 0s;
        box-shadow: 4px 7px 12px 0 rgb(250 99 66 / 20%)
    }

    .pricings .main-btn {
        width: 100%;
    }

    .main-btn:hover {
        background: #888da8;
    }
</style>
@section('content')
    <section>
        <div class="page-header">
            <div class="header-inner">
                <h2>Price Plans</h2>
                <p style="font-size: 17px !important;">
                    Welcome to Pitnik Social Network. Here you’ll find all the typography, content sources, &amp; ready made elemets as you want. you can use to show on your custom pages.
                </p>
            </div>
            <figure><img src="{{asset('/images/baner-badges.png', env('IS_DEPLOY_ON_SERVER'))}}" alt="" style="width: 50%;"></figure>
        </div>
    </section>
    <section style="color: #757a95">
        <div class="gap">
            <div class="container">
                <div class="row">
                    <div class="offset-lg-1 col-lg-10">
                        <div class="sec-heading style9 text-center">
                            <span style="color: gray"><i class="fa fa-trophy" style="color: #fa6342"></i> this is an optional</span>
                            <h2>Our Price <span>Plans</span></h2>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="price-box">
                            <span class="bg-blue">Free of cost</span>
                            <div class="pricings">
                                <h2 class="">Free</h2>
                                <h1>$0 <span style="color: #fa6342; margin-top: -8px">Per Month</span></h1>
                                <p>
                                    our price is free of cost for this package. you can not unlock all features.
                                </p>
                                <ul class="price-features">
                                    <li><i class="ti-check"></i> Unlimited usages our cloud</li>
                                    <li><i class="ti-check"></i> Unlimited Users</li>
                                    <li><i class="ti-check"></i> Unlimited storage</li>
                                    <li><i class="ti-close"></i> 24x7 great support</li>
                                    <li><i class="ti-close"></i> Unlimited Bandwidth</li>
                                </ul>
                                <a class="main-btn" style="background: #fa6342" href="#" title="" data-ripple="">Buy Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="price-box">
                            <span class="bg-purple">Most Popular</span>
                            <div class="pricings">
                                <h2>Basics</h2>
                                <h1>$19 <span style="color: #fa6342 ; margin-top: -8px">Per Month</span></h1>
                                <p>
                                    our price is free of cost for this package. you can not unlock all features.
                                </p>
                                <ul class="price-features">
                                    <li><i class="ti-check"></i> Unlimited usages our cloud</li>
                                    <li><i class="ti-check"></i> Unlimited Users</li>
                                    <li><i class="ti-check"></i> Unlimited storage</li>
                                    <li><i class="ti-close"></i> 24x7 great support</li>
                                    <li><i class="ti-close"></i> Unlimited Bandwidth</li>
                                </ul>
                                <a class="main-btn" style="background: #fa6342" href="#" title="" data-ripple="">Buy Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="price-box">
                            <span class="bg-red">best Value</span>
                            <div class="pricings">
                                <h2>Premium</h2>
                                <h1>$79 <span style="color: #fa6342; margin-top: -8px">Per Year</span></h1>
                                <p>
                                    our price is free of cost for this package. you can not unlock all features.
                                </p>
                                <ul class="price-features">
                                    <li><i class="ti-check"></i> Unlimited usages our cloud</li>
                                    <li><i class="ti-check"></i> Unlimited Users</li>
                                    <li><i class="ti-check"></i> Unlimited storage</li>
                                    <li><i class="ti-close"></i> 24x7 great support</li>
                                    <li><i class="ti-close"></i> Unlimited Bandwidth</li>
                                </ul>
                                <a class="main-btn" style="background: #fa6342" href="#" title="" data-ripple="">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
