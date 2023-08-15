<style>
    #seemt-menu-left-mini .seemt-menu-title {
        display: none !important;
    }

    #seemt-menu-left-mini .seemt-menu .seemt-menu-item.active a {
        padding: 8px 36px 8px 22px;
    }

    .seemt-main-container #seemt-menu-left-mini {
        width: 64px;
    }

    .seemt-main-container #seemt-menu-left-mini .group-action .action-item {
        margin: 13px 13px 10px 13px;
    }

    .seemt-main-container .seemt-menu-left {
        z-index: 999;
    }
</style>
<div class="seemt-menu-left" id="seemt-menu-left" style="display: none;">
    <div class="seemt-menu">
        <div class="seemt-menu-item">
            <a href="{{ route('dashboard.branch-dashboard.index') }}">
                <i class="fi-rr-layout-fluid"></i>
                <div class="seemt-menu-title">
                    <span class="">Tổng quan</span>
                </div>
            </a>
        </div>
        <div class="seemt-menu-item">
            <a>
                <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="top"
                   data-original-title="Thực hiện trên thương hiệu"></i>
                <div class="seemt-menu-title">
                    <span class="">Thủ quỹ</span>
                    <i class="fi-rr-angle-small-down"></i>
                </div>
            </a>
            <div class="seemt-menu-sub">
                <div class="seemt-menu-sub-title">Thủ Quỹ</div>
                <div class="seemt-menu-sub-item">
                    <a>Thu Chi <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item">
                            <a href="{{ route('treasurer.payment-bill-treasurer.index') }}">
                                @lang('modules.menu.nav.treasurer.payment-bill')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('treasurer.receipts-bill-treasurer.index') }}">@lang('modules.menu.nav.treasurer.receipts-bill')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a>Thu Ngân <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('treasurer.work-history-treasurer.index') }}">@lang('modules.menu.nav.treasurer.work-history')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('treasurer.list-bill-treasurer.index') }}">@lang('modules.menu.nav.treasurer.list-bill')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="seemt-menu-item">
            <a>
                <i class="fi-rr-briefcase"></i>
                <div class="seemt-menu-title">
                    <span class="">Quản Lý</span>
                    <i class="fi-rr-angle-small-down"></i>
                </div>
            </a>
            <div class="seemt-menu-sub">
                <div class="seemt-menu-sub-title">Quản Lý</div>
                <div class="seemt-menu-sub-item">
                    <a>Quản Lý Nhân Viên <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('manage.employee.employee-manage.index') }}">@lang('modules.menu.nav.manage.employee.employee')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
{{--                        @if (Session::get(SESSION_KEY_LEVEL) >= 5)--}}
{{--                            <div class="seemt-menu-sub-item"><a--}}
{{--                                    href="{{ route('manage.employee_off.employee-off-manage.index') }}">--}}
{{--                                    @lang('modules.menu.nav.manage.employee.employee-off')--}}
{{--                                    <label>--}}
{{--                                        <i class="fi-rr-marker icon-branch" data-toggle="tooltip"--}}
{{--                                           data-placement="top" data-original-title="Thực hiện trên chi nhánh"></i>--}}
{{--                                    </label>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="seemt-menu-sub-item"><a--}}
{{--                                    href="{{ route('manage.time_keeping.time-keeping-manage.index') }}">@lang('modules.menu.nav.manage.employee.time_keeping')--}}
{{--                                    <label>--}}
{{--                                        <i class="fi-rr-marker icon-branch" data-toggle="tooltip"--}}
{{--                                           data-placement="top" data-original-title="Thực hiện trên chi nhánh"></i>--}}
{{--                                    </label>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        @endif--}}
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a href="{{ route('manage.food.food-brand-manage.index') }}">@lang('modules.menu.nav.manage.food_menu.title')
                        <label>
                            <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="top"
                               data-original-title="Thực hiện trên thương hiệu"></i>
                        </label>
                    </a>
                </div>
                <div class="seemt-menu-sub-item">
                    <a href="{{ route('manage.area_price.price-by-area-manage.index') }}">@lang('modules.menu.nav.manage.area_price.title')
                        <label>
                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                               data-original-title="Thực hiện trên chi nhánh"></i>
                        </label>
                    </a>
                </div>
                <div class="seemt-menu-sub-item"><a
                        href="{{ route('manage.booking_table.booking-table-manage.index') }}">@lang('modules.menu.nav.manage.booking_table')
                        <label>
                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="top"
                               data-original-title="Thực hiện trên chi nhánh"></i>
                        </label>
                    </a>
                </div>
                <!-- Thêm phân quyền Giải pháp bán hàng -->
                <div class="seemt-menu-sub-item"><a
                        href="{{ route('manage.bill.bill-manage.index') }}">@lang('modules.menu.nav.manage.bill')
                        <label>
                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="top"
                               data-original-title="Thực hiện trên chi nhánh"></i>
                        </label>
                    </a>
                </div>
            </div>
        </div>
        <div class="seemt-menu-item">
            <a>
                <i class="fi-rr-chart-histogram"></i>
                <div class="seemt-menu-title">
                    <span class="">Báo Cáo</span>
                    <i class="fi-rr-angle-small-down"></i>
                </div>
            </a>
            <div class="seemt-menu-sub">
                <div class="seemt-menu-sub-title">Báo cáo</div>
                <div class="seemt-menu-sub-item">
                    <a>Doanh Thu Bán Hàng<i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item">
                            <a href="{{ route('report.sell-order-report.index') }}">
                                Theo thời gian
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a href="{{ route('report.area-report.index') }}">Theo khu
                                vực
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a href="{{ route('report.employee-report.index') }}">Theo
                                nhân viên
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a>Chi Tiết DT Bán Hàng <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('report.detail-revenue-sell.index') }}">Tổng
                                quan chi tiết DT</a>
                        </div>
                        <div class="seemt-menu-sub-item"><a href="{{ route('report.sell.food-report.index') }}">Món
                                ăn
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('report.sell.category-report.index') }}">Danh mục
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('report.sell.gift-food-report.index') }}">Món tặng
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('report.sell.off-menu-dishes-report.index') }}">Ngoài menu
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('report.sell.food-cancel-report.index') }}">Món hủy
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('report.sell.take-away-report.index') }}">Món mang về
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a href="{{route('report.sell.vat-report.index')}}">VAT
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>

                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('report.sell.discount-report.index') }}">Giảm giá
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('report.sell.surcharge-report.index') }}">Phụ thu
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
{{--                        <div class="seemt-menu-sub-item"><a href="{{ route('report.sell.point-report.index') }}">Điểm--}}
{{--                                <label>--}}
{{--                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="top"--}}
{{--                                       data-original-title="Thực hiện trên chi nhánh"></i>--}}
{{--                                </label>--}}
{{--                            </a>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a href="{{ route('report.revenue-report.index') }}">Doanh Thu Tổng
                        <label>
                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="top"
                               data-original-title="Thực hiện trên chi nhánh"></i>
                        </label>
                    </a>
                </div>
                <div class="seemt-menu-sub-item">
                    <a href="{{ route('report.cost-report.index') }}">
                        Chi Phí
                        <label>
                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="top"
                               data-original-title="Thực hiện trên chi nhánh"></i>
                        </label>
                    </a>
                </div>
                    <div class="seemt-menu-sub-item">
                        <a href="{{ route('report.sell.order-report.index') }}">
                            Hoá đơn
                            <label>
                                <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                   data-original-title="Thực hiện trên chi nhánh"></i>
                            </label>
                        </a>
                    </div>
                    <div class="seemt-menu-sub-item">
                        <a href="{{ route('report.work_history_report.work-history-report.index') }}">
                            Chốt ca thu ngân
                            <label>
                                <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                   data-original-title="Thực hiện trên chi nhánh"></i>
                            </label>
                        </a>
                    </div>
            </div>
        </div>
        <div class="seemt-menu-item">
            <a>
                <i class="fi-rr-database"></i>
                <div class="seemt-menu-title">
                    <span class="">Xây Dựng Dữ Liệu</span>
                    <i class="fi-rr-angle-small-down"></i>
                </div>
            </a>
            <div class="seemt-menu-sub">
                <div class="seemt-menu-sub-title">Xây Dựng Dữ Liệu</div>
                <div class="seemt-menu-sub-item">
                    <a>Món ăn <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.food.category-food-data.index') }}">
                                @lang('modules.menu.nav.build_data.food.category')
                                <label>
                                    <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Thực hiện trên thương hiệu"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.food.unit-food-data.index') }}">
                                @lang('modules.menu.nav.build_data.food.unit')
                                <label>
                                    <i class="fi-rr-building icon-restaurant" data-toggle="tooltip"
                                       data-placement="top" data-original-title="Thực hiện trên Công ty"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a href="{{ route('build_data.food.food-data.index') }}">
                                @lang('modules.menu.nav.build_data.food.title')
                                <label>
                                    <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Thực hiện trên thương hiệu"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.food.gift-food-data.index') }}">
                                @lang('modules.menu.nav.build_data.food.gift')
                                <label>
                                    <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Thực hiện trên thương hiệu"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.food.note-food-data.index') }}">
                                @lang('modules.menu.nav.build_data.food.note')
                                <label>
                                    <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Thực hiện trên thương hiệu"></i>
                                </label>
                            </a>
                        </div>
{{--                            <div class="seemt-menu-sub-item"><a--}}
{{--                                    href="{{ route('build_data.food.warning-price-food.index') }}">--}}
{{--                                    @lang('modules.menu.nav.build_data.food.warning-price')--}}
{{--                                    <label>--}}
{{--                                        <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="top"--}}
{{--                                           data-original-title="Thực hiện trên thương hiệu"></i>--}}
{{--                                    </label>--}}
{{--                                </a>--}}
{{--                            </div>--}}
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a>Bếp<i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.kitchen.kitchen-data.index') }}">
                                @lang('modules.menu.nav.build_data.kitchen.title')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.kitchen.assign-kitchen.index') }}">
                                @lang('modules.menu.nav.build_data.kitchen.assign-kitchen')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
{{--                            <div class="seemt-menu-sub-item"><a--}}
{{--                                    href="{{ route('build_data.kitchen.quantitative-data.index') }}">--}}
{{--                                    @lang('modules.menu.nav.build_data.kitchen.quantitative')--}}
{{--                                    <label>--}}
{{--                                        <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="top"--}}
{{--                                           data-original-title="Thực hiện trên thương hiệu"></i>--}}
{{--                                    </label>--}}
{{--                                </a>--}}
{{--                            </div>--}}
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a>Nhân Sự <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.personnel.employee-data.index') }}">
                                @lang('modules.menu.nav.build_data.personnel.employee')
                                <label>
                                    <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Thực hiện trên thương hiệu"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.personnel.shift-data.index') }}">
                                @lang('modules.menu.nav.build_data.personnel.shift')
                                <label>
                                    <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Thực hiện trên thương hiệu"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.personnel.permission-employee-data.index') }}">
                                @lang('modules.menu.nav.build_data.personnel.permission_employee')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.personnel.role-data.index') }}">
                                @lang('modules.menu.nav.build_data.personnel.role')
                                <label>
                                    <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên thương hiệu"></i>
                                </label>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a>Kinh Doanh <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.business.area-data.index') }}">
                                @lang('modules.menu.nav.build_data.business.area')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                       data-placement="top"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.business.table-data.index') }}">
                                @lang('modules.menu.nav.build_data.business.table')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                       data-placement="top"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.business.reasons-cancel-food-data.index') }}">
                                @lang('modules.menu.nav.build_data.business.reasons-cancel-food')
                                <label>
                                    <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Thực hiện trên thương hiệu"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.business.price-temporary.index') }}">
                                @lang('modules.menu.nav.build_data.business.price-food')
                                <label>
                                    <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Thực hiện trên thương hiệu"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.business.price-adjustment-data.index') }}">
                                @lang('modules.menu.nav.build_data.business.price-adjustment')
                                <label>
                                    <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Thực hiện trên thương hiệu"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.business.surcharge-data.index') }}">
                                @lang('modules.menu.nav.build_data.business.surcharge')
                                <label>
                                    <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Thực hiện trên thương hiệu"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.business.price-by-area.index') }}">
                                @lang('modules.menu.nav.build_data.business.price-by-area')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                       data-placement="top"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a>Thu Chi <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.revenue-and-cost.cost-data.index') }}">
                                @lang('modules.menu.nav.build_data.cost&revenue.cost')
                                <label>
                                    <i class="fi-rr-building icon-restaurant" data-toggle="tooltip"
                                       data-placement="top" data-original-title="Thực hiện trên Công ty"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.revenue-and-cost.revenue-data.index') }}">
                                @lang('modules.menu.nav.build_data.cost&revenue.revenue')
                                <label>
                                    <i class="fi-rr-building icon-restaurant" data-toggle="tooltip"
                                       data-placement="top" data-original-title="Thực hiện trên Công ty"></i>
                                </label>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="seemt-menu-item">
            <a>
                <i class="fi-rr-settings"></i>
                <div class="seemt-menu-title">
                    <span class="">Thiết Lập</span>
                    <i class="fi-rr-angle-small-down"></i>
                </div>
            </a>
            <div class="seemt-menu-sub">
                <div class="seemt-menu-sub-title">Thiết Lập</div>
                <div class="seemt-menu-sub-item"><a
                        href="{{ route('setting.sale-solution-setting.index') }}">@lang('modules.menu.nav.setting.setting.restaurant')
                        <label>
                            <i class="fi-rr-building icon-restaurant" data-toggle="tooltip"
                               data-placement="top" data-original-title="Thực hiện trên Công ty"></i>
                        </label>
                    </a>
                </div>
                <div class="seemt-menu-sub-item">
                    <a>Quản Lý VAT<i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('setting.vat-manage.vat-restaurant.index') }}">
                                Chọn VAT Hệ Thống
                                <label>
                                    <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="top"
                                       data-original-title="Thực hiện trên thương hiệu"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('setting.vat-manage.vat-config.index') }}">
                                Cấu hình VAT
                                <label>
                                    <i class="fi-rr-building icon-restaurant" data-toggle="tooltip"
                                       data-placement="top" data-original-title="Thực hiện trên Công ty"></i>
                                </label>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a href="{{ route('setting.bank-setting.index') }}">Thông tin thanh toán
                        <label>
                            <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                               data-original-title="Thực hiện trên thương hiệu"></i>
                        </label>
                    </a>
                </div>
                @if (Session::get(SESSION_KEY_SETTING_CURRENT_BRAND)['branch_type_option'] == 3 &&
                        Session::get(SESSION_KEY_SETTING_CURRENT_BRAND)['branch_type'] == 2)
                    <div class="seemt-menu-sub-item"><a
                            href="{{ route('marketing.display-secondary-pos.index') }}">Màn
                            hình phụ</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="seemt-menu-left" id="seemt-menu-left-mini">
    <div class="seemt-menu">
        <div class="seemt-menu-item" data-toggle="tooltip" data-placement="right" data-original-title="TỔNG QUAN">
            <a href="{{ route('dashboard.branch-dashboard.index') }}">
                <i class="fi-rr-layout-fluid" id="fi-rr-layout-fluid"></i>
                <div class="seemt-menu-title">
                    <span class="">Tổng quan</span>
                </div>
            </a>
        </div>
        <div class="seemt-menu-item"  >
            <a  >
                <i class="fi-rr-bank " id="icon-bank"></i>
                <div class="seemt-menu-title">
                    <span class="">Thủ quỹ</span>
                    <i class="fi-rr-angle-small-down"></i>
                </div>
            </a>
            <div class="seemt-menu-sub">
                <div class="seemt-menu-sub-title">Thủ Quỹ</div>
                <div class="seemt-menu-sub-item">
                    <a  >Thu Chi <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item">
                            <a href="{{ route('treasurer.payment-bill-treasurer.index') }}">
                                @lang('modules.menu.nav.treasurer.payment-bill')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('treasurer.receipts-bill-treasurer.index') }}">@lang('modules.menu.nav.treasurer.receipts-bill')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a  >Thu Ngân <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('treasurer.work-history-treasurer.index') }}">@lang('modules.menu.nav.treasurer.work-history')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('treasurer.list-bill-treasurer.index') }}">@lang('modules.menu.nav.treasurer.list-bill')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="seemt-menu-item"  >
            <a  >
                <i class="fi-rr-briefcase" id="fi-rr-briefcase"></i>
                <div class="seemt-menu-title">
                    <span class="">Quản Lý</span>
                    <i class="fi-rr-angle-small-down"></i>
                </div>
            </a>
            <div class="seemt-menu-sub">
                <div class="seemt-menu-sub-title">Quản Lý</div>
                <div class="seemt-menu-sub-item">
                    <a  >Quản Lý Nhân Viên <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('manage.employee.employee-manage.index') }}">@lang('modules.menu.nav.manage.employee.employee')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
{{--                            <div class="seemt-menu-sub-item"><a--}}
{{--                                    href="{{ route('manage.employee_off.employee-off-manage.index') }}">--}}
{{--                                    @lang('modules.menu.nav.manage.employee.employee-off')--}}
{{--                                    <label>--}}
{{--                                        <i class="fi-rr-marker icon-branch" data-toggle="tooltip"--}}
{{--                                           data-placement="right" data-original-title="Thực hiện trên chi nhánh"></i>--}}
{{--                                    </label>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="seemt-menu-sub-item"><a--}}
{{--                                    href="{{ route('manage.time_keeping.time-keeping-manage.index') }}">@lang('modules.menu.nav.manage.employee.time_keeping')--}}
{{--                                    <label>--}}
{{--                                        <i class="fi-rr-marker icon-branch" data-toggle="tooltip"--}}
{{--                                           data-placement="right" data-original-title="Thực hiện trên chi nhánh"></i>--}}
{{--                                    </label>--}}
{{--                                </a>--}}
{{--                            </div>--}}
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a href="{{ route('manage.food.food-brand-manage.index') }}">@lang('modules.menu.nav.manage.food_menu.title')
                        <label>
                            <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                               data-original-title="Thực hiện trên thương hiệu"></i>
                        </label>
                    </a>
                </div>
                <div class="seemt-menu-sub-item">
                    <a href="{{ route('manage.area_price.price-by-area-manage.index') }}">@lang('modules.menu.nav.manage.area_price.title')
                        <label>
                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                               data-original-title="Thực hiện trên chi nhánh"></i>
                        </label>
                    </a>
                </div>
                <div class="seemt-menu-sub-item"><a
                        href="{{ route('manage.booking_table.booking-table-manage.index') }}">@lang('modules.menu.nav.manage.booking_table')
                        <label>
                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                               data-original-title="Thực hiện trên chi nhánh"></i>
                        </label>
                    </a>
                </div>
                <!-- Thêm phân quyền Giải pháp bán hàng -->
                <div class="seemt-menu-sub-item"><a
                        href="{{ route('manage.bill.bill-manage.index') }}">@lang('modules.menu.nav.manage.bill')
                        <label>
                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                               data-original-title="Thực hiện trên chi nhánh"></i>
                        </label>
                    </a>
                </div>
            </div>
        </div>
        <div class="seemt-menu-item" >
            <a  >
                <i class="fi-rr-chart-histogram" id="fi-rr-chart-histogram"></i>
                <div class="seemt-menu-title">
                    <span class="">Báo Cáo</span>
                    <i class="fi-rr-angle-small-down"></i>
                </div>
            </a>
            <div class="seemt-menu-sub">
                <div class="seemt-menu-sub-title">Báo cáo</div>
                <div class="seemt-menu-sub-item">
                    <a  >Doanh Thu Bán Hàng<i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item">
                            <a href="{{ route('report.sell-order-report.index') }}">
                                Theo thời gian
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a href="{{ route('report.area-report.index') }}">Theo khu
                                vực
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a href="{{ route('report.employee-report.index') }}">Theo
                                nhân viên
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a  >Chi Tiết DT Bán Hàng <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('report.detail-revenue-sell.index') }}">Tổng
                                quan chi tiết DT</a>
                        </div>
                        <div class="seemt-menu-sub-item"><a href="{{ route('report.sell.food-report.index') }}">Món
                                ăn
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('report.sell.category-report.index') }}">Danh mục
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('report.sell.gift-food-report.index') }}">Món tặng
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a href="{{ route('report.sell.off-menu-dishes-report.index') }}">Ngoài menu
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('report.sell.food-cancel-report.index') }}">Món hủy
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('report.sell.take-away-report.index') }}">Món mang về
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a href="{{route('report.sell.vat-report.index')}}">VAT
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>

                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('report.sell.discount-report.index') }}">Giảm giá
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('report.sell.surcharge-report.index') }}">Phụ thu
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
{{--                        <div class="seemt-menu-sub-item"><a href="{{ route('report.sell.point-report.index') }}">Điểm--}}
{{--                                <label>--}}
{{--                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="top"--}}
{{--                                       data-original-title="Thực hiện trên chi nhánh"></i>--}}
{{--                                </label>--}}
{{--                            </a>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a href="{{ route('report.revenue-report.index') }}">Doanh Thu Tổng
                        <label>
                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                               data-original-title="Thực hiện trên chi nhánh"></i>
                        </label>
                    </a>
                </div>
                <div class="seemt-menu-sub-item">
                    <a href="{{ route('report.cost-report.index') }}">
                        Chi Phí
                        <label>
                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                               data-original-title="Thực hiện trên chi nhánh"></i>
                        </label>
                    </a>
                </div>
                    <div class="seemt-menu-sub-item">
                        <a href="{{ route('report.sell.order-report.index') }}">
                            Hoá đơn
                            <label>
                                <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                   data-original-title="Thực hiện trên chi nhánh"></i>
                            </label>
                        </a>
                    </div>
                    <div class="seemt-menu-sub-item">
                        <a href="{{ route('report.work_history_report.work-history-report.index') }}">
                            Chốt ca thu ngân
                            <label>
                                <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                   data-original-title="Thực hiện trên chi nhánh"></i>
                            </label>
                        </a>
                    </div>
            </div>
        </div>
        <div class="seemt-menu-item" >
            <a  >
                <i class="fi-rr-database" id="fi-rr-database"></i>
                <div class="seemt-menu-title">
                    <span class="">Xây Dựng Dữ Liệu</span>
                    <i class="fi-rr-angle-small-down"></i>
                </div>
            </a>
            <div class="seemt-menu-sub">
                <div class="seemt-menu-sub-title">Xây Dựng Dữ Liệu</div>
                <div class="seemt-menu-sub-item">
                    <a  >Món ăn <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.food.category-food-data.index') }}">
                                @lang('modules.menu.nav.build_data.food.category')
                                <label>
                                    <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên thương hiệu"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.food.unit-food-data.index') }}">
                                @lang('modules.menu.nav.build_data.food.unit')
                                <label>
                                    <i class="fi-rr-building icon-restaurant" data-toggle="tooltip"
                                       data-placement="right" data-original-title="Thực hiện trên Công ty"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a href="{{ route('build_data.food.food-data.index') }}">
                                @lang('modules.menu.nav.build_data.food.title')
                                <label>
                                    <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên thương hiệu"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.food.gift-food-data.index') }}">
                                @lang('modules.menu.nav.build_data.food.gift')
                                <label>
                                    <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên thương hiệu"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.food.note-food-data.index') }}">
                                @lang('modules.menu.nav.build_data.food.note')
                                <label>
                                    <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên thương hiệu"></i>
                                </label>
                            </a>
                        </div>
{{--                            <div class="seemt-menu-sub-item"><a--}}
{{--                                    href="{{ route('build_data.food.warning-price-food.index') }}">--}}
{{--                                    @lang('modules.menu.nav.build_data.food.warning-price')--}}
{{--                                    <label>--}}
{{--                                        <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"--}}
{{--                                           data-original-title="Thực hiện trên thương hiệu"></i>--}}
{{--                                    </label>--}}
{{--                                </a>--}}
{{--                            </div>--}}
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a  >Bếp<i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.kitchen.kitchen-data.index') }}">
                                @lang('modules.menu.nav.build_data.kitchen.title')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.kitchen.assign-kitchen.index') }}">
                                @lang('modules.menu.nav.build_data.kitchen.assign-kitchen')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
{{--                            <div class="seemt-menu-sub-item"><a--}}
{{--                                    href="{{ route('build_data.kitchen.quantitative-data.index') }}">--}}
{{--                                    @lang('modules.menu.nav.build_data.kitchen.quantitative')--}}
{{--                                    <label>--}}
{{--                                        <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"--}}
{{--                                           data-original-title="Thực hiện trên thương hiệu"></i>--}}
{{--                                    </label>--}}
{{--                                </a>--}}
{{--                            </div>--}}
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a  >Nhân Sự <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.personnel.employee-data.index') }}">
                                @lang('modules.menu.nav.build_data.personnel.employee')
                                <label>
                                    <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên thương hiệu"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.personnel.shift-data.index') }}">
                                @lang('modules.menu.nav.build_data.personnel.shift')
                                <label>
                                    <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên thương hiệu"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.personnel.permission-employee-data.index') }}">
                                @lang('modules.menu.nav.build_data.personnel.permission_employee')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.personnel.role-data.index') }}">
                                @lang('modules.menu.nav.build_data.personnel.role')
                                <label>
                                    <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên thương hiệu"></i>
                                </label>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a  >Kinh Doanh <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.business.area-data.index') }}">
                                @lang('modules.menu.nav.build_data.business.area')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                       data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.business.table-data.index') }}">
                                @lang('modules.menu.nav.build_data.business.table')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                       data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.business.reasons-cancel-food-data.index') }}">
                                @lang('modules.menu.nav.build_data.business.reasons-cancel-food')
                                <label>
                                    <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên thương hiệu"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.business.price-temporary.index') }}">
                                @lang('modules.menu.nav.build_data.business.price-food')
                                <label>
                                    <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên thương hiệu"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.business.price-adjustment-data.index') }}">
                                @lang('modules.menu.nav.build_data.business.price-adjustment')
                                <label>
                                    <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên thương hiệu"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.business.surcharge-data.index') }}">
                                @lang('modules.menu.nav.build_data.business.surcharge')
                                <label>
                                    <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên thương hiệu"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.business.price-by-area.index') }}">
                                @lang('modules.menu.nav.build_data.business.price-by-area')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                       data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a  >Thu Chi <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.revenue-and-cost.cost-data.index') }}">
                                @lang('modules.menu.nav.build_data.cost&revenue.cost')
                                <label>
                                    <i class="fi-rr-building icon-restaurant" data-toggle="tooltip"
                                       data-placement="right" data-original-title="Thực hiện trên Công ty"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.revenue-and-cost.revenue-data.index') }}">
                                @lang('modules.menu.nav.build_data.cost&revenue.revenue')
                                <label>
                                    <i class="fi-rr-building icon-restaurant" data-toggle="tooltip"
                                       data-placement="right" data-original-title="Thực hiện trên Công ty"></i>
                                </label>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="seemt-menu-item">
            <a  >
                <i class="fi-rr-settings" id="fi-rr-settings"></i>
                <div class="seemt-menu-title">
                    <span class="">Thiết Lập</span>
                    <i class="fi-rr-angle-small-down"></i>
                </div>
            </a>
            <div class="seemt-menu-sub">
                <div class="seemt-menu-sub-title">Thiết Lập</div>
                <div class="seemt-menu-sub-item"><a
                        href="{{ route('setting.sale-solution-setting.index') }}">@lang('modules.menu.nav.setting.setting.restaurant')
                        <label>
                            <i class="fi-rr-building icon-restaurant" data-toggle="tooltip"
                               data-placement="right" data-original-title="Thực hiện trên Công ty"></i>
                        </label>
                    </a>
                </div>
                <div class="seemt-menu-sub-item">
                    <a  >Quản Lý VAT<i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('setting.vat-manage.vat-restaurant.index') }}">
                                Chọn VAT Hệ Thống
                                <label>
                                    <i class="fi-rr-building icon-restaurant" data-toggle="tooltip"
                                       data-placement="right" data-original-title="Thực hiện trên Công ty"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('setting.vat-manage.vat-config.index') }}">
                                Cấu hình VAT
                                <label>
                                    <i class="fi-rr-building icon-restaurant" data-toggle="tooltip"
                                       data-placement="right" data-original-title="Thực hiện trên Công ty"></i>
                                </label>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a href="{{ route('setting.bank-setting.index') }}">Thông tin thanh toán
                        <label>
                            <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                               data-original-title="Thực hiện trên thương hiệu"></i>
                        </label>
                    </a>
                </div>
                @if (Session::get(SESSION_KEY_SETTING_CURRENT_BRAND)['branch_type_option'] == 3 &&
                        Session::get(SESSION_KEY_SETTING_CURRENT_BRAND)['branch_type'] == 2)
                    <div class="seemt-menu-sub-item"><a
                            href="{{ route('marketing.display-secondary-pos.index') }}">Màn
                            hình phụ</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="group-action">
        <a class="action-item" href="/help" data-toggle="tooltip" data-placement="right" data-original-title="Trợ giúp">
            <i class="fi-rr-interrogation"></i>
        </a>
        <div class="action-item" data-toggle="tooltip" data-placement="right" data-original-title="Nâng cấp gói">
            <i class="fi-rr-diploma"></i>
        </div>
    </div>
</div>
