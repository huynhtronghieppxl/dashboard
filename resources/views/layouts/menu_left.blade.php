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

</style>

<div class="seemt-menu-left" id="seemt-menu-left" style="display: none;">
    <div class="seemt-menu">
        <div class="seemt-menu-item active">
            <a href="{{ route('dashboard.index') }}">
                <i class="fi-rr-home"></i>
                <div class="seemt-menu-title">
                    <span class="">Giới thiệu</span>
                </div>
            </a>
        </div>
        <div class="seemt-menu-item">
            <a>
                <i class="fi-rr-layout-fluid"></i>
                <div class="seemt-menu-title">
                    <span class="">Tổng quan</span>
                    <i class="fi-rr-angle-small-down"></i>
                </div>
            </a>
            <div class="seemt-menu-sub">
                <div class="seemt-menu-sub-title">Tổng quan</div>
                    <div class="seemt-menu-sub-item">
                        <a href="{{ route('dashboard.branch-dashboard.index') }}">
                            Hoạt động kinh doanh
                            <label>
                                <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                   data-original-title="Thực hiện trên chi nhánh"></i>
                            </label>
                        </a>
                    </div>

                    <div class="seemt-menu-sub-item">
                        <a href="{{ route('dashboard.company-dashboard.index') }}">
                            Hoạt động công ty
                            <label>
                                <i class="fi-rr-building icon-restaurant" data-toggle="tooltip" data-placement="right"
                                   data-original-title="Thực hiện trên Công ty"></i>
                            </label>
                        </a>
                    </div>
            </div>
        </div>
        <div class="seemt-menu-item">
            <a>
                <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                   data-original-title="Thực hiện trên thương hiệu"></i>
                <div class="seemt-menu-title">
                    <span class="">Thủ quỹ</span>
                    <i class="fi-rr-angle-small-down"></i>
                </div>
            </a>
            <div class="seemt-menu-sub">
                <div class="seemt-menu-sub-title">Thủ Quỹ</div>
                <div class="seemt-menu-sub-item">
                    <a>Nhà Cung Cấp <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item">
                            <a href="{{ route('treasurer.order-bill-treasurer.index') }}">
                                Sổ Mua Hàng
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item">
                            <a href="{{ route('treasurer.supplier-payment-debt-treasurer.index') }}">
                                NCC Nhắc nợ
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a>Quỹ <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item">
                            <a href="{{ route('treasurer.cash-book-treasurer.index') }}">
                                @lang('modules.menu.nav.treasurer.cash-book')
                                <label>
                                    <i class="fi-rr-marker icon-branch icon-branch" data-toggle="tooltip"
                                       data-placement="right" data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item">
                            <a href="{{ route('treasurer.fund-period-treasurer.index') }}">
                                @lang('modules.menu.nav.treasurer.fund-period')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item">
                            <a href="{{ route('treasurer.cash-fund-treasurer.index') }}">
                                @lang('modules.menu.nav.treasurer.cash-fund')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a>Thu Chi <i class="fi-rr-angle-small-down"></i></a>
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
{{--                        @if (Session::get(SESSION_KEY_LEVEL) > 5)--}}
                            <div class="seemt-menu-sub-item">
                                <a href="{{ route('treasurer.payment-recurring-bill-treasurer.index') }}">
                                    @lang('modules.menu.nav.treasurer.payment-recurring-bill')
                                    <label>
                                        <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                           data-original-title="Thực hiện trên chi nhánh"></i>
                                    </label>
                                </a>
                            </div>
{{--                        @endif--}}
                    </div>
                </div>

                <div class="seemt-menu-sub-item">
                    <a>Lương <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                            <div class="seemt-menu-sub-item"><a
                                    href="{{ route('treasurer.salary-employee-treasurer.index') }}">@lang('modules.menu.nav.treasurer.salary-employee')
                                    <label>
                                        <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                           data-original-title="Thực hiện trên chi nhánh"></i>
                                    </label>
                                </a>
                            </div>

                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('treasurer.advance-salary-employee.index') }}">@lang('modules.menu.nav.treasurer.advance-salary-employee')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                       data-placement="right" data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('treasurer.employee-bonus-punish.index') }}">@lang('modules.menu.nav.treasurer.employee-bonus-punish')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                       data-placement="right" data-original-title="Thực hiện trên chi nhánh"></i>
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
                    <a>Quản Lý kho <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
{{--                        <div class="seemt-menu-sub-item">--}}
{{--                            <a>@lang('modules.menu.nav.manage.inventory_manage.title-warehouse')<i--}}
{{--                                    class="fi-rr-angle-small-down"></i></a>--}}
{{--                            <div class="seemt-menu-sub-last">--}}
{{--                                <div class="seemt-menu-sub-item"><a--}}
{{--                                        href="{{ route('manage.warehouse.goods-purchase-warehouse.index') }}">Quản lý--}}
{{--                                        mua hàng</a>--}}
{{--                                </div>--}}
{{--                                <div class="seemt-menu-sub-item"><a--}}
{{--                                        href="{{ route('manage.warehouse.export-inventory-warehouse.index') }}">Xuất--}}
{{--                                        xuống kho chi nhánh</a>--}}
{{--                                </div>--}}
{{--                                <div class="seemt-menu-sub-item"><a--}}

{{--                                        href="{{ route('manage.warehouse.inventory.index') }}">Kiểm kê</a>--}}
{{--                                </div>--}}
{{--                                <div class="seemt-menu-sub-item"><a--}}
{{--                                        href="{{ route('manage.warehouse.cancel-inventory-warehouse.index') }}">Hủy--}}
{{--                                        hàng</a>--}}
{{--                                </div>--}}
{{--                                <div class="seemt-menu-sub-item"><a--}}
{{--                                        href="{{ route('manage.warehouse.return-inventory-warehouse.index') }}">Trả--}}
{{--                                        hàng</a>--}}
{{--                                </div>--}}
{{--                                <div class="seemt-menu-sub-item">--}}
{{--                                    <a href="{{ route('manage.warehouse.assign-warehouse-branch.index') }}">Gán kho--}}
{{--                                        chi nhánh</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="seemt-menu-sub-item">
                            <a>Kho chi nhánh <i class="fi-rr-angle-small-down"></i></a>
                            <div class="seemt-menu-sub-last">
                                <div class="seemt-menu-sub-item">
                                    <a href="{{ route('manage.supplier_order.supplier-order.index') }}">
                                        @lang('modules.menu.nav.manage.supplier-order')
                                        <label>
                                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                               data-placement="right"
                                               data-original-title="Thực hiện trên chi nhánh"></i>
                                        </label>
                                    </a>
                                </div>
                                <div class="seemt-menu-sub-item"><a
                                        href="{{ route('manage.inventory.out-inventory-manage.index') }}">@lang('modules.menu.nav.manage.inventory.out-inventory')
                                        <label>
                                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                               data-placement="right"
                                               data-original-title="Thực hiện trên chi nhánh"></i>
                                        </label>
                                    </a>
                                </div>
                                <div class="seemt-menu-sub-item"><a
                                        href="{{ route('manage.inventory.checklist-goods-manage.index') }}">@lang('modules.menu.nav.manage.inventory.checklist-goods')
                                        <label>
                                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                               data-placement="right"
                                               data-original-title="Thực hiện trên chi nhánh"></i>
                                        </label>
                                    </a>
                                </div>
                                <div class="seemt-menu-sub-item"><a
                                        href="{{ route('manage.inventory.cancel-inventory-manage.index') }}">@lang('modules.menu.nav.manage.inventory.cancel-inventory')
                                        <label>
                                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                               data-placement="right"
                                               data-original-title="Thực hiện trên chi nhánh"></i>
                                        </label>
                                    </a>
                                </div>
                                <div class="seemt-menu-sub-item"><a
                                        href="{{ route('manage.inventory.in-inventory-branch-manage.index') }}">@lang('modules.menu.nav.manage.inventory.in-inventory-branch')
                                        <label>
                                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                               data-placement="right"
                                               data-original-title="Thực hiện trên chi nhánh"></i>
                                        </label>
                                    </a>
                                </div>
                                <div class="seemt-menu-sub-item">
                                    <a href="{{ route('manage.inventory.out-inventory-branch-manage.index') }}">@lang('modules.menu.nav.manage.inventory.out-inventory-branch')
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
                            <a>Kho Bộ Phận <i class="fi-rr-angle-small-down"></i></a>
                            <div class="seemt-menu-sub-last">
                                <div class="seemt-menu-sub-item">
                                    <a
                                        href="{{ route('manage.inventory_internal.in-inventory-internal-manage.index') }}">@lang('modules.menu.nav.manage.inventory_internal.in-inventory-internal')
                                        <label>
                                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                               data-placement="right"
                                               data-original-title="Thực hiện trên chi nhánh"></i>
                                        </label>
                                    </a>
                                </div>
                                <div class="seemt-menu-sub-item">
                                    <a href="{{ route('manage.inventory.checklist-goods-internal-manage.index') }}">@lang('modules.menu.nav.manage.inventory_internal.checklist-goods-internal')
                                        <label>
                                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                               data-placement="right"
                                               data-original-title="Thực hiện trên chi nhánh"></i>
                                        </label>
                                    </a>
                                </div>
                                <div class="seemt-menu-sub-item">
                                    <a
                                        href="{{ route('manage.inventory_internal.return-inventory-internal-manage.index') }}">@lang('modules.menu.nav.manage.inventory_internal.return-inventory-internal')
                                        <label>
                                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                               data-placement="right"
                                               data-original-title="Thực hiện trên chi nhánh"></i>
                                        </label>
                                    </a>
                                </div>
                                <div class="seemt-menu-sub-item">
                                    <a
                                        href="{{ route('manage.inventory_internal.cancel-inventory-internal-manage.index') }}">@lang('modules.menu.nav.manage.inventory_internal.cancel-inventory-internal')
                                        <label>
                                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                               data-placement="right"
                                               data-original-title="Thực hiện trên chi nhánh"></i>
                                        </label>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a>Quản Lý Nhân Viên <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('manage.employee.employee-manage.index') }}">@lang('modules.menu.nav.manage.employee.employee')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
{{--                        @if(Session::get('SESSION_KEY_LEVEL') > 1)--}}
                            <div class="seemt-menu-sub-item"><a
                                    href="{{ route('manage.employee_off.employee-off-manage.index') }}">
                                    @lang('modules.menu.nav.manage.employee.employee-off')
                                    <label>
                                        <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                           data-placement="right" data-original-title="Thực hiện trên chi nhánh"></i>
                                    </label>
                                </a>
                            </div>
                            <div class="seemt-menu-sub-item"><a
                                    href="{{ route('manage.time_keeping.time-keeping-manage.index') }}">@lang('modules.menu.nav.manage.employee.time_keeping')
                                    <label>
                                        <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                           data-placement="right" data-original-title="Thực hiện trên chi nhánh"></i>
                                    </label>
                                </a>
                            </div>
{{--                        @endif--}}
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
                        href="{{ route('manage.supplier.supplier-manage.index') }}">@lang('modules.menu.nav.manage.supplier')
                        <label>
                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                               data-original-title="Thực hiện trên chi nhánh"></i>
                        </label>
                    </a>
                </div>
                <div class="seemt-menu-sub-item"><a
                        href="{{ route('manage.bill.bill-manage.index') }}">@lang('modules.menu.nav.manage.bill')
                        <label>
                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                               data-original-title="Thực hiện trên chi nhánh"></i>
                        </label>
                    </a>
                </div>
                <div class="seemt-menu-sub-item"><a
                        href="{{ route('manage.payroll.payroll-manage.index') }}">@lang('modules.menu.nav.manage.payroll')
                        <label>
                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                               data-original-title="Thực hiện trên chi nhánh"></i>
                        </label>
                    </a>
                </div>
                <div class="seemt-menu-sub-item"><a
                        href="{{ route('manage.e_invoice.e-invoice-manage.index') }}">@lang('modules.menu.nav.manage.e_invoice.title')
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
                    <a>Chi Tiết DT Bán Hàng <i class="fi-rr-angle-small-down"></i></a>
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
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('report.sell.off-menu-dishes-report.index') }}">Ngoài menu
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
                        <div class="seemt-menu-sub-item"><a href="{{ route('report.sell.point-report.index') }}">Điểm
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
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
                <div class="seemt-menu-sub-item">
                    <a>Nhà Cung Cấp<i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('report.inventory-supplier-report.index') }}">Mua hàng
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('report.price-change-histories.index') }}">Điều chỉnh giá
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a>Kho <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item">
                            <a>Kho Chi Nhánh <i class="fi-rr-angle-small-down"></i></a>
                            <div class="seemt-menu-sub-last">
                                <div class="seemt-menu-sub-item"><a
                                        href="{{ route('report.material-report.index') }}">Nhập xuất
                                        <label>
                                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                               data-placement="right"
                                               data-original-title="Thực hiện trên chi nhánh"></i>
                                        </label>
                                    </a>
                                </div>
                                <div class="seemt-menu-sub-item"><a
                                        href="{{ route('report.inventory-report.index') }}">Kiểm kê
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
                            <a>Kho Bộ phận <i class="fi-rr-angle-small-down"></i></a>
                            <div class="seemt-menu-sub-last">
                                <div class="seemt-menu-sub-item"><a
                                        href="{{ route('report.material-internal-report.index') }}">Nhập xuất
                                        <label>
                                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                               data-placement="right"
                                               data-original-title="Thực hiện trên chi nhánh"></i>
                                        </label>
                                    </a>
                                </div>
                                <div class="seemt-menu-sub-item"><a
                                        href="{{ route('report.inventory-internal-report.index') }}">Kiểm kê
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
                            <a href="{{ route('report.material-food-report.index') }}">Định Lượng
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a href="{{ route('report.deposit-to-card-report.index') }}">
                        Nạp thẻ
                        <label>
                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                               data-original-title="Thực hiện trên chi nhánh"></i>
                        </label>
                    </a>
                </div>
                <div class="seemt-menu-sub-item">
                    <a href="{{ route('report.service-cost-history-report.index') }}">
                        Lịch sử chi phí dịch vụ
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
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M15.8333 20H4.16667C3.062 19.9987 2.00296 19.5593 1.22185 18.7782C0.440735 17.997 0.00132321 16.938 0 15.8333V4.16667C0.00132321 3.062 0.440735 2.00296 1.22185 1.22185C2.00296 0.440735 3.062 0.00132321 4.16667 0H15.8333C16.938 0.00132321 17.997 0.440735 18.7782 1.22185C19.5593 2.00296 19.9987 3.062 20 4.16667V15.8333C19.9987 16.938 19.5593 17.997 18.7782 18.7782C17.997 19.5593 16.938 19.9987 15.8333 20ZM4.16667 1.66667C3.50363 1.66667 2.86774 1.93006 2.3989 2.3989C1.93006 2.86774 1.66667 3.50363 1.66667 4.16667V15.8333C1.66667 16.4964 1.93006 17.1323 2.3989 17.6011C2.86774 18.0699 3.50363 18.3333 4.16667 18.3333H15.8333C16.4964 18.3333 17.1323 18.0699 17.6011 17.6011C18.0699 17.1323 18.3333 16.4964 18.3333 15.8333V4.16667C18.3333 3.50363 18.0699 2.86774 17.6011 2.3989C17.1323 1.93006 16.4964 1.66667 15.8333 1.66667H4.16667ZM10.9939 14.2154C10.8817 14.0113 10.8246 13.7839 10.8277 13.5536V11.5044C10.8289 11.099 10.7033 10.7024 10.467 10.3651C10.2307 10.0278 9.89427 9.7649 9.50055 9.60994C9.10683 9.45499 8.67358 9.41492 8.25587 9.49485C7.83816 9.57477 7.45486 9.77107 7.15469 10.0588C6.95191 10.2462 6.79162 10.4712 6.68369 10.7198C6.57577 10.9684 6.52251 11.2354 6.52719 11.5044C6.52331 11.7743 6.57691 12.0422 6.68475 12.2919C6.79259 12.5416 6.95245 12.768 7.15469 12.9573C7.35168 13.15 7.58801 13.3023 7.84916 13.4049C8.1103 13.5074 8.39074 13.5581 8.67321 13.5536H9.30303C9.93053 13.5536 10.3919 13.8419 10.7018 14.4242C10.7867 14.6051 10.8304 14.8011 10.8301 14.9992H8.67321C7.44912 14.9992 6.45919 14.5176 5.69568 13.5536C5.23666 12.9603 4.99258 12.2411 5.00017 11.5044C4.99905 11.0451 5.09329 10.5902 5.27748 10.1657C5.46167 9.7412 5.73218 9.35551 6.07348 9.03078C6.41478 8.70603 6.82014 8.44865 7.26628 8.27339C7.71242 8.09814 8.19055 8.00846 8.67321 8.00953H8.86255C8.9944 8.01713 9.12571 8.03161 9.25589 8.05291C9.39941 8.06842 9.54098 8.09724 9.67861 8.13894C9.813 8.17248 9.9445 8.21574 10.072 8.26836C10.3297 8.37364 10.5754 8.50373 10.8053 8.65659L10.8277 8.6713C10.9848 8.78136 11.1338 8.90149 11.2736 9.03086C11.6212 9.35129 11.8958 9.73627 12.0804 10.1619C12.2651 10.5875 12.3558 11.0447 12.347 11.5051V15C11.7574 14.9992 11.3038 14.7404 10.9939 14.2154ZM13.5928 14.1081C13.6695 14.2837 13.783 14.4426 13.9265 14.575C14.0656 14.7115 14.2326 14.8195 14.4172 14.8925C14.6018 14.9655 14.8 15.0018 14.9999 14.9993V6.45294C15.0005 6.26259 14.9617 6.07401 14.8856 5.89794C14.8096 5.72188 14.6978 5.56181 14.5567 5.42687C14.4156 5.29193 14.248 5.18478 14.0633 5.11153C13.8787 5.03829 13.6806 5.00039 13.4806 5V13.5537C13.478 13.7438 13.5161 13.9325 13.5928 14.1081Z"
                          fill="#A7A8AB"></path>
                </svg>
                <div class="seemt-menu-title">
                    <span style="padding-top: 5px" class="">ALOLINE</span>
                    <i class="fi-rr-angle-small-down"></i>
                </div>
            </a>
            <div class="seemt-menu-sub">
                <div class="seemt-menu-sub-title">Aloline</div>
                <div class="seemt-menu-sub-item">
                    <a>Báo Cáo <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item">
                            <a href="{{ route('customer.new-customer-report.index') }}">
                                @lang('modules.menu.nav.customer.report.new-customer-report')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                       data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item">
                            <a href="{{ route('customer.history-point-report.index') }}">
                                @lang('modules.menu.nav.customer.report.history-point-report')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                       data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="seemt-menu-sub-item"><a
                        href="{{ route('customer.restaurant-membership-card.index') }}">
                        @lang('modules.menu.nav.customer.restaurant-membership-card')
                        <label>
                            <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                               data-original-title="Thực hiện trên thương hiệu"></i>
                        </label>
                    </a>
                </div>
                <div class="seemt-menu-sub-item">
                    <a href="{{ route('customer.customers.index') }}">@lang('modules.menu.nav.customer.customers')
                        <label>
                            <i class="fi-rr-building icon-restaurant" data-toggle="tooltip" data-placement="right"
                               data-original-title="Thực hiện trên Công ty"></i>
                        </label>
                    </a>
                </div>
                <div class="seemt-menu-sub-item">
                    <a href="{{ route('customer.card-value.index') }}">@lang('modules.menu.nav.customer.card-value')
                        <label>
                            <i class="fi-rr-building icon-restaurant" data-toggle="tooltip" data-placement="right"
                               data-original-title="Thực hiện trên Công ty"></i>
                        </label>
                    </a>
                </div>
                <div class="seemt-menu-sub-item">
                    <a href="{{ route('customer.cards.index') }}">@lang('modules.menu.nav.customer.cards')
                        <label>
                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                               data-placement="right"
                               data-original-title="Thực hiện trên chi nhánh"></i>
                        </label>
                    </a>
                </div>
                <div class="seemt-menu-sub-item">
                    <a>Món Mang Về <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('customer.takeaway.take-away-brand.index') }}">@lang('modules.menu.nav.customer.take-away.brand')
                                <label>
                                    <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên thương hiệu"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item">
                            <a href="{{ route('customer.takeaway.take-away-branch.index') }}">@lang('modules.menu.nav.customer.take-away.branch')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                       data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                    </div>
                </div>
                {{--                    <div class="seemt-menu-sub-item"><a--}}
                {{--                            href="{{ route('customer.bestselling-food-customer.index') }}">@lang('modules.menu.nav.customer.bestselling-food')--}}
                {{--                            <label>--}}
                {{--                                <i class="fi-rr-marker icon-branch" data-toggle="tooltip"--}}
                {{--                                   data-placement="right"--}}
                {{--                                   data-original-title="Thực hiện trên chi nhánh"></i>--}}
                {{--                            </label>--}}
                {{--                        </a>--}}
                {{--                    </div>--}}
                <div class="seemt-menu-sub-item"><a
                        href="{{ route('customer.booking-food-customer.index') }}">@lang('modules.menu.nav.customer.booking-food')
                        <label>
                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                               data-placement="right"
                               data-original-title="Thực hiện trên chi nhánh"></i>
                        </label>
                    </a>
                </div>
                <div class="seemt-menu-sub-item"><a
                        href="{{ route('customer.assign-customer.index') }}">@lang('modules.menu.nav.customer.assign-customer')
                        <label>
                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                               data-placement="right"
                               data-original-title="Thực hiện trên chi nhánh"></i>
                        </label>
                    </a>
                </div>
                <div class="seemt-menu-sub-item"><a
                        href="{{ route('customer.card-tag.index') }}">@lang('modules.menu.nav.customer.card-tag')
                        <label>
                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                               data-placement="right"
                               data-original-title="Thực hiện trên chi nhánh"></i>
                        </label>
                    </a>
                </div>
                <div class="seemt-menu-sub-item"><a
                        href="{{ route('customer.banner.index') }}">Banner
                        <label>
                            <i class="fi-rr-bank icon-brand" data-toggle="tooltip"
                               data-placement="right"
                               data-original-title="Thực hiện trên chi nhánh"></i>
                        </label>
                    </a>
                </div>
            </div>
        </div>
        <div class="seemt-menu-item">
            <a>
                <i class="fi-rr-presentation"></i>
                <div class="seemt-menu-title">
                    <span class="">Marketing</span>
                    <i class="fi-rr-angle-small-down"></i>
                </div>
            </a>
            <div class="seemt-menu-sub">
                <div class="seemt-menu-sub-title">Marketing</div>
                <div class="seemt-menu-sub-item"><a
                        href="{{ route('marketing.campaign-marketing.index') }}">@lang('modules.menu.nav.marketing.campaign')
                        <label>
                            <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                               data-original-title="Thực hiện trên thương hiệu"></i>
                        </label>
                    </a>
                </div>
                <div class="seemt-menu-sub-item"><a
                        href="{{ route('marketing.media-restaurant-marketing.index') }}">@lang('modules.menu.nav.marketing.media-restaurant')
                        <label>
                            <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                               data-original-title="Thực hiện trên thương hiệu"></i>
                        </label>
                    </a>
                </div>
                <div class="seemt-menu-sub-item">
                    <a>Quà tặng <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('marketing.gift.gift-marketing.index') }}">@lang('modules.menu.nav.marketing.gift.gift')
                                <label>
                                    <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên thương hiệu"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('marketing.gift.new-customer-gift.index') }}">@lang('modules.menu.nav.marketing.gift.gift-full-text')
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
                    <a>Nhà Cung Cấp <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item">
                            <a href="{{ route('build_data.supplier.list-supplier-data.index') }}">
                                @lang('modules.menu.nav.build_data.list-supplier.list-supplier-data')
                                <label>
                                    <i class="fi-rr-building icon-restaurant" data-toggle="tooltip"
                                       data-placement="right" data-original-title="Thực hiện trên Công ty"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.assign-supplier.restaurant-assign-supplier-data.index') }}">@lang('modules.menu.nav.build_data.assign-supplier.title_sub_menu_one')
                                <label>
                                    <i class="fi-rr-building icon-restaurant" data-toggle="tooltip"
                                       data-placement="right" data-original-title="Thực hiện trên Công ty"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.assign_supplier_material.restaurant-material-data.index') }}">@lang('modules.menu.nav.build_data.assign-material-supplier.title_sub_menu_one')
                                <label>
                                    <i class="fi-rr-building icon-restaurant" data-toggle="tooltip"
                                       data-placement="right" data-original-title="Thực hiện trên Công ty"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.assign_supplier_material.brand-material-data.index') }}">@lang('modules.menu.nav.build_data.assign-material-supplier.title_sub_menu_two')
                                <label>
                                    <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên thương hiệu"></i>
                                </label>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a>Nguyên Liệu <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.material.specifications-data.index') }}">
                                @lang('modules.menu.nav.build_data.material.specifications')
                                <label>
                                    <i class="fi-rr-building icon-restaurant" data-toggle="tooltip"
                                       data-placement="right" data-original-title="Thực hiện trên Công ty"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.material.unit-data.index') }}">
                                @lang('modules.menu.nav.build_data.material.unit')
                                <label>
                                    <i class="fi-rr-building icon-restaurant" data-toggle="tooltip"
                                       data-placement="right" data-original-title="Thực hiện trên Công ty"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.material.unit-order-data.index') }}">
                                @lang('modules.menu.nav.build_data.material.unit-order')
                                <label>
                                    <i class="fi-rr-building icon-restaurant" data-toggle="tooltip"
                                       data-placement="right" data-original-title="Thực hiện trên Công ty"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.material.material-data.index') }}">
                                @lang('modules.menu.nav.build_data.material.title')
                                <label>
                                    <i class="fi-rr-building icon-restaurant" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên Công ty"></i>
                                </label>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a>Món ăn <i class="fi-rr-angle-small-down"></i></a>
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
{{--                        @if (Session::get(SESSION_KEY_LEVEL) > 5)--}}
                            <div class="seemt-menu-sub-item"><a
                                    href="{{ route('build_data.food.warning-price-food.index') }}">
                                    @lang('modules.menu.nav.build_data.food.warning-price')
                                    <label>
                                        <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                                           data-original-title="Thực hiện trên thương hiệu"></i>
                                    </label>
                                </a>
                            </div>
{{--                        @endif--}}
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a>Bếp<i class="fi-rr-angle-small-down"></i></a>
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
{{--                        @if (Session::get(SESSION_KEY_LEVEL) > 3)--}}
                            <div class="seemt-menu-sub-item"><a
                                    href="{{ route('build_data.kitchen.quantitative-data.index') }}">
                                    @lang('modules.menu.nav.build_data.kitchen.quantitative')
                                    <label>
                                        <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                                           data-original-title="Thực hiện trên thương hiệu"></i>
                                    </label>
                                </a>
                            </div>
{{--                        @endif--}}
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a>Nhân Sự <i class="fi-rr-angle-small-down"></i></a>
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
{{--                        @if(Session::get('SESSION_KEY_LEVEL') > 1)--}}
                            <div class="seemt-menu-sub-item"><a
                                    href="{{ route('build_data.personnel.wage-data.index') }}">
                                    @lang('modules.menu.nav.build_data.personnel.wage')
                                    <label>
                                        <i class="fi-rr-building icon-restaurant" data-toggle="tooltip"
                                           data-placement="right" data-original-title="Thực hiện trên Công ty"></i>
                                    </label>
                                </a>
                            </div>
{{--                        @endif--}}
{{--                        @if(Session::get('SESSION_KEY_LEVEL') > 2)--}}
                            <div class="seemt-menu-sub-item"><a
                                    href="{{ route('build_data.personnel.level-data.index') }}">
                                    @lang('modules.menu.nav.build_data.personnel.level')
                                    <label>
                                        <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                                           data-original-title="Thực hiện trên thương hiệu"></i>
                                    </label>
                                </a>
                            </div>
                            <div class="seemt-menu-sub-item"><a
                                    href="{{ route('build_data.personnel.category-work-data.index') }}">
                                    @lang('modules.menu.nav.build_data.personnel.category-work')
                                    <label>
                                        <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                                           data-original-title="Thực hiện trên thương hiệu"></i>
                                    </label>
                                </a>
                            </div>
                            <div class="seemt-menu-sub-item"><a
                                    href="{{ route('build_data.personnel.work-data.index') }}">
                                    @lang('modules.menu.nav.build_data.personnel.work')
                                    <label>
                                        <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                                           data-original-title="Thực hiện trên thương hiệu"></i>
                                    </label>
                                </a>
                            </div>
                            <div class="seemt-menu-sub-item"><a
                                    href="{{ route('build_data.personnel.point-data.index') }}">
                                    @lang('modules.menu.nav.build_data.personnel.point')
                                    <label>
                                        <i class="fi-rr-building icon-restaurant" data-toggle="tooltip"
                                           data-placement="right" data-original-title="Thực hiện trên Công ty"></i>
                                    </label>
                                </a>
                            </div>
                            <div class="seemt-menu-sub-item"><a
                                    href="{{ route('build_data.personnel.booking-bonus-data.index') }}">
                                    @lang('modules.menu.nav.build_data.personnel.booking-bonus')
                                    <label>
                                        <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                                           data-original-title="Thực hiện trên thương hiệu"></i>
                                    </label>
                                </a>
                            </div>
                            <div class="seemt-menu-sub-item"><a
                                    href="{{ route('build_data.personnel.kaizen-bonus-data.index') }}">
                                    @lang('modules.menu.nav.build_data.personnel.kaizen-bonus')
                                    <label>
                                        <i class="fi-rr-building icon-restaurant" data-toggle="tooltip"
                                           data-placement="right" data-original-title="Thực hiện trên Công ty"></i>
                                    </label>
                                </a>
                            </div>
{{--                        @endif--}}
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
{{--                        @if(Session::get('SESSION_KEY_LEVEL') > 2)--}}
                            <div class="seemt-menu-sub-item"><a
                                    href="{{ route('build_data.business.permission-sales.index') }}">
                                    @lang('modules.menu.nav.build_data.business.permission-sales')
                                    <label>
                                        <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                           data-original-title="Thực hiện trên chi nhánh"></i>
                                    </label>
                                </a>
                            </div>
                            <div class="seemt-menu-sub-item"><a
                                    href="{{ route('build_data.kitchen.permission-kitchen.index') }}">
                                    @lang('modules.menu.nav.build_data.kitchen.permission-kitchen')
                                    <label>
                                        <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                           data-original-title="Thực hiện trên chi nhánh"></i>
                                    </label>
                                </a>
                            </div>
{{--                        @endif--}}
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
                    <a>Thu Chi <i class="fi-rr-angle-small-down"></i></a>
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
                        href="{{ route('setting.restaurant-setting.index') }}">@lang('modules.menu.nav.setting.setting.restaurant')
                        <label>
                            <i class="fi-rr-building icon-restaurant" data-toggle="tooltip"
                               data-placement="right" data-original-title="Thực hiện trên Công ty"></i>
                        </label>
                    </a>
                </div>
                <div class="seemt-menu-sub-item"><a
                        href="{{ route('setting.brand-setting.index') }}">@lang('modules.menu.nav.setting.setting.brand')
                        <label>
                            <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                               data-original-title="Thực hiện trên thương hiệu"></i>
                        </label>
                    </a>
                </div>
                <div class="seemt-menu-sub-item"><a
                        href="{{ route('setting.branch-setting.index') }}">@lang('modules.menu.nav.setting.setting.branch')
                        <label>
                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                               data-placement="right"
                               data-original-title="Thực hiện trên chi nhánh"></i>
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
                                    <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên thương hiệu"></i>
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
                @if (Session::get(SESSION_KEY_SETTING_CURRENT_BRAND)['branch_type_option'] == 3 &&
                        Session::get(SESSION_KEY_SETTING_CURRENT_BRAND)['branch_type'] == 2)
                    <div class="seemt-menu-sub-item"><a
                            href="{{ route('marketing.display-secondary-pos.index') }}">Màn
                            hình phụ</a>
                    </div>
                @endif
                @if(Session::get('SESSION_KEY_LEVEL') > 1)
                    <div class="seemt-menu-sub-item">
                    <a href="{{ route('setting.partner-invoice.index') }}">Hóa đơn điện tử
                        <label>
                            <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                               data-original-title="Thực hiện trên thương hiệu"></i>
                        </label>
                    </a>
                </div>
                @endif
                <div class="seemt-menu-sub-item">
                    <a href="{{ route('setting.bank-setting.index') }}">Thông tin thanh toán
                        <label>
                            <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                               data-original-title="Thực hiện trên thương hiệu"></i>
                        </label>
                    </a>
                </div>
            </div>
        </div>
        <div class="seemt-menu-item">
            <a href="{{URL::to('visible-message')}}">
                <i class="fi-rr-comment"></i>
                <div class="seemt-menu-title">
                    <span class="">Tin nhăn</span>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="seemt-menu-left" id="seemt-menu-left-mini">
    <div class="seemt-menu">
        <div class="seemt-menu-item " data-toggle="tooltip" data-placement="right" data-original-title="GIỚI THIỆU">
            <a href="{{ route('dashboard.index') }}">
                <i class="fi-rr-home" id="fi-rr-home"></i>
                <div class="seemt-menu-title">
                    <span class="">Giới thiệu</span>
                    <i class="fi-rr-angle-small-down"></i>
                </div>
            </a>
        </div>
        <div class="seemt-menu-item">
            <a>
                <i class="fi-rr-layout-fluid" id="fi-rr-layout-fluid"></i>
                <div class="seemt-menu-title">
                    <span class="">Tổng quan</span>
                </div>
            </a>
            <div class="seemt-menu-sub">
                <div class="seemt-menu-sub-title">Tổng quan</div>
                <div class="seemt-menu-sub-item">
                    <a href="{{ route('dashboard.branch-dashboard.index') }}">
                        Hoạt động kinh doanh
                        <label>
                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                               data-original-title="Thực hiện trên chi nhánh"></i>
                        </label>
                    </a>
                </div>
                <div class="seemt-menu-sub-item">
                    <a href="{{ route('dashboard.company-dashboard.index') }}">
                        Hoạt động công ty
                        <label>
                            <i class="fi-rr-building icon-restaurant" data-toggle="tooltip" data-placement="right"
                               data-original-title="Thực hiện trên Công ty"></i>
                        </label>
                    </a>
                </div>
            </div>
        </div>
        <div class="seemt-menu-item">
            <a>
                <i class="fi-rr-bank " id="icon-bank"></i>
                <div class="seemt-menu-title">
                    <span class="">Thủ quỹ</span>
                    <i class="fi-rr-angle-small-down"></i>
                </div>
            </a>
            <div class="seemt-menu-sub">
                <div class="seemt-menu-sub-title">Thủ Quỹ</div>
                <div class="seemt-menu-sub-item">
                    <a>Nhà Cung Cấp <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item">
                            <a href="{{ route('treasurer.order-bill-treasurer.index') }}">
                                Sổ Mua Hàng
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item">
                            <a href="{{ route('treasurer.supplier-payment-debt-treasurer.index') }}">
                                NCC Nhắc nợ
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a>Quỹ <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item">
                            <a href="{{ route('treasurer.cash-book-treasurer.index') }}">
                                @lang('modules.menu.nav.treasurer.cash-book')
                                <label>
                                    <i class="fi-rr-marker icon-branch icon-branch" data-toggle="tooltip"
                                       data-placement="right" data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item">
                            <a href="{{ route('treasurer.fund-period-treasurer.index') }}">
                                @lang('modules.menu.nav.treasurer.fund-period')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item">
                            <a href="{{ route('treasurer.cash-fund-treasurer.index') }}">
                                @lang('modules.menu.nav.treasurer.cash-fund')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a>Thu Chi <i class="fi-rr-angle-small-down"></i></a>
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
{{--                        @if (Session::get(SESSION_KEY_LEVEL) > 5)--}}
                            <div class="seemt-menu-sub-item">
                                <a href="{{ route('treasurer.payment-recurring-bill-treasurer.index') }}">
                                    @lang('modules.menu.nav.treasurer.payment-recurring-bill')
                                    <label>
                                        <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                           data-original-title="Thực hiện trên chi nhánh"></i>
                                    </label>
                                </a>
                            </div>
{{--                        @endif--}}
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a>Lương <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('treasurer.salary-employee-treasurer.index') }}">@lang('modules.menu.nav.treasurer.salary-employee')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('treasurer.advance-salary-employee.index') }}">@lang('modules.menu.nav.treasurer.advance-salary-employee')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                       data-placement="right" data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('treasurer.employee-bonus-punish.index') }}">@lang('modules.menu.nav.treasurer.employee-bonus-punish')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                       data-placement="right" data-original-title="Thực hiện trên chi nhánh"></i>
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
        <div class="seemt-menu-item">
            <a>
                <i class="fi-rr-briefcase" id="fi-rr-briefcase"></i>
                <div class="seemt-menu-title">
                    <span class="">Quản Lý</span>
                    <i class="fi-rr-angle-small-down"></i>
                </div>
            </a>
            <div class="seemt-menu-sub">
                <div class="seemt-menu-sub-title">Quản Lý</div>
                <div class="seemt-menu-sub-item">
                    <a>Quản Lý kho <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
{{--                        <div class="seemt-menu-sub-item">--}}
{{--                            <a>@lang('modules.menu.nav.manage.inventory_manage.title-warehouse')<i--}}
{{--                                    class="fi-rr-angle-small-down"></i></a>--}}
{{--                            <div class="seemt-menu-sub-last">--}}
{{--                                <div class="seemt-menu-sub-item"><a--}}
{{--                                        href="{{ route('manage.warehouse.goods-purchase-warehouse.index') }}">Quản lý--}}
{{--                                        mua hàng--}}
{{--                                        <label>--}}
{{--                                            <i class="fi-rr-bank icon-brand" data-toggle="tooltip"--}}
{{--                                               data-placement="right"--}}
{{--                                               data-original-title="Thực hiện trên thương hiệu"></i>--}}
{{--                                        </label>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="seemt-menu-sub-item"><a--}}
{{--                                        href="{{ route('manage.warehouse.export-inventory-warehouse.index') }}">Xuất--}}
{{--                                        xuống kho chi nhánh--}}
{{--                                        <label>--}}
{{--                                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"--}}
{{--                                               data-placement="right"--}}
{{--                                               data-original-title="Thực hiện trên chi nhánh"></i>--}}
{{--                                        </label>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="seemt-menu-sub-item"><a--}}
{{--                                        href="{{ route('manage.warehouse.inventory.index') }}">Kiểm kê--}}
{{--                                        <label>--}}
{{--                                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"--}}
{{--                                               data-placement="right"--}}
{{--                                               data-original-title="Thực hiện trên chi nhánh"></i>--}}
{{--                                        </label>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="seemt-menu-sub-item"><a--}}
{{--                                        href="{{ route('manage.warehouse.cancel-inventory-warehouse.index') }}">Hủy hàng--}}
{{--                                        <label>--}}
{{--                                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"--}}
{{--                                               data-placement="right"--}}
{{--                                               data-original-title="Thực hiện trên chi nhánh"></i>--}}
{{--                                        </label>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="seemt-menu-sub-item"><a--}}
{{--                                        href="{{ route('manage.warehouse.return-inventory-warehouse.index') }}">Trả hàng--}}
{{--                                        <label>--}}
{{--                                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"--}}
{{--                                               data-placement="right"--}}
{{--                                               data-original-title="Thực hiện trên chi nhánh"></i>--}}
{{--                                        </label>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="seemt-menu-sub-item">--}}
{{--                                    <a href="{{ route('manage.warehouse.assign-warehouse-branch.index') }}">Gán kho chi--}}
{{--                                        nhánh--}}
{{--                                        <label>--}}
{{--                                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"--}}
{{--                                               data-placement="right"--}}
{{--                                               data-original-title="Thực hiện trên chi nhánh"></i>--}}
{{--                                        </label>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="seemt-menu-sub-item">
                            <a>Kho chi nhánh <i class="fi-rr-angle-small-down"></i></a>
                            <div class="seemt-menu-sub-last">
                                {{--                                <div class="seemt-menu-sub-item"><a--}}
                                {{--                                        href="{{ route('manage.inventory.in-inventory-manage.index') }}">@lang('modules.menu.nav.manage.inventory.in-inventory')--}}
                                {{--                                        <label>--}}
                                {{--                                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"--}}
                                {{--                                               data-placement="right"--}}
                                {{--                                               data-original-title="Thực hiện trên chi nhánh"></i>--}}
                                {{--                                        </label>--}}
                                {{--                                    </a>--}}
                                {{--                                </div>--}}

                                <div class="seemt-menu-sub-item">
                                    <a href="{{ route('manage.supplier_order.supplier-order.index') }}">
                                        @lang('modules.menu.nav.manage.supplier-order')
                                        <label>
                                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                               data-placement="right"
                                               data-original-title="Thực hiện trên chi nhánh"></i>
                                        </label>
                                    </a>
                                </div>
                                <div class="seemt-menu-sub-item"><a
                                        href="{{ route('manage.inventory.out-inventory-manage.index') }}">@lang('modules.menu.nav.manage.inventory.out-inventory')
                                        <label>
                                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                               data-placement="right"
                                               data-original-title="Thực hiện trên chi nhánh"></i>
                                        </label>
                                    </a>
                                </div>
                                <div class="seemt-menu-sub-item"><a
                                        href="{{ route('manage.inventory.checklist-goods-manage.index') }}">@lang('modules.menu.nav.manage.inventory.checklist-goods')
                                        <label>
                                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                               data-placement="right"
                                               data-original-title="Thực hiện trên chi nhánh"></i>
                                        </label>
                                    </a>
                                </div>
                                <div class="seemt-menu-sub-item"><a
                                        href="{{ route('manage.inventory.cancel-inventory-manage.index') }}">@lang('modules.menu.nav.manage.inventory.cancel-inventory')
                                        <label>
                                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                               data-placement="right"
                                               data-original-title="Thực hiện trên chi nhánh"></i>
                                        </label>
                                    </a>
                                </div>
                                <div class="seemt-menu-sub-item"><a
                                        href="{{ route('manage.inventory.in-inventory-branch-manage.index') }}">@lang('modules.menu.nav.manage.inventory.in-inventory-branch')
                                        <label>
                                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                               data-placement="right"
                                               data-original-title="Thực hiện trên chi nhánh"></i>
                                        </label>
                                    </a>
                                </div>
                                <div class="seemt-menu-sub-item">
                                    <a href="{{ route('manage.inventory.out-inventory-branch-manage.index') }}">@lang('modules.menu.nav.manage.inventory.out-inventory-branch')
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
                            <a>Kho Bộ Phận <i class="fi-rr-angle-small-down"></i></a>
                            <div class="seemt-menu-sub-last">
                                <div class="seemt-menu-sub-item">
                                    <a
                                        href="{{ route('manage.inventory_internal.in-inventory-internal-manage.index') }}">@lang('modules.menu.nav.manage.inventory_internal.in-inventory-internal')
                                        <label>
                                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                               data-placement="right"
                                               data-original-title="Thực hiện trên chi nhánh"></i>
                                        </label>
                                    </a>
                                </div>
                                <div class="seemt-menu-sub-item">
                                    <a href="{{ route('manage.inventory.checklist-goods-internal-manage.index') }}">@lang('modules.menu.nav.manage.inventory_internal.checklist-goods-internal')
                                        <label>
                                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                               data-placement="right"
                                               data-original-title="Thực hiện trên chi nhánh"></i>
                                        </label>
                                    </a>
                                </div>
                                <div class="seemt-menu-sub-item">
                                    <a
                                        href="{{ route('manage.inventory_internal.return-inventory-internal-manage.index') }}">@lang('modules.menu.nav.manage.inventory_internal.return-inventory-internal')
                                        <label>
                                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                               data-placement="right"
                                               data-original-title="Thực hiện trên chi nhánh"></i>
                                        </label>
                                    </a>
                                </div>
                                <div class="seemt-menu-sub-item">
                                    <a
                                        href="{{ route('manage.inventory_internal.cancel-inventory-internal-manage.index') }}">@lang('modules.menu.nav.manage.inventory_internal.cancel-inventory-internal')
                                        <label>
                                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                               data-placement="right"
                                               data-original-title="Thực hiện trên chi nhánh"></i>
                                        </label>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a>Quản Lý Nhân Viên <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('manage.employee.employee-manage.index') }}">@lang('modules.menu.nav.manage.employee.employee')
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
{{--                        @if(Session::get('SESSION_KEY_LEVEL') > 1)--}}
                            <div class="seemt-menu-sub-item"><a
                                    href="{{ route('manage.employee_off.employee-off-manage.index') }}">
                                    @lang('modules.menu.nav.manage.employee.employee-off')
                                    <label>
                                        <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                           data-placement="right" data-original-title="Thực hiện trên chi nhánh"></i>
                                    </label>
                                </a>
                            </div>
                            <div class="seemt-menu-sub-item"><a
                                    href="{{ route('manage.time_keeping.time-keeping-manage.index') }}">@lang('modules.menu.nav.manage.employee.time_keeping')
                                    <label>
                                        <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                           data-placement="right" data-original-title="Thực hiện trên chi nhánh"></i>
                                    </label>
                                </a>
                            </div>
{{--                        @endif--}}
                    </div>
                </div>
                {{--                <div class="seemt-menu-sub-item">--}}
                {{--                    <a href="javascript:void(0)">@lang('modules.menu.nav.manage.food_menu.title')<i--}}
                {{--                            class="fi-rr-angle-small-down"></i></a>--}}
                {{--                    <div class="seemt-menu-sub-last">--}}
                {{--                        <div class="seemt-menu-sub-item"><a--}}
                {{--                                href="{{ route('manage.food.food-brand-manage.index') }}">@lang('modules.menu.nav.manage.food_menu.title')--}}
                {{--                                <label>--}}
                {{--                                    <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"--}}
                {{--                                       data-original-title="Thực hiện trên thương hiệu"></i>--}}
                {{--                                </label>--}}
                {{--                            </a>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
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
                        href="{{ route('manage.supplier.supplier-manage.index') }}">@lang('modules.menu.nav.manage.supplier')
                        <label>
                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                               data-original-title="Thực hiện trên chi nhánh"></i>
                        </label>
                    </a>
                </div>
                <div class="seemt-menu-sub-item"><a
                        href="{{ route('manage.bill.bill-manage.index') }}">@lang('modules.menu.nav.manage.bill')
                        <label>
                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                               data-original-title="Thực hiện trên chi nhánh"></i>
                        </label>
                    </a>
                </div>
                <div class="seemt-menu-sub-item"><a
                        href="{{ route('manage.payroll.payroll-manage.index') }}">@lang('modules.menu.nav.manage.payroll')
                        <label>
                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                               data-original-title="Thực hiện trên chi nhánh"></i>
                        </label>
                    </a>
                </div>
                <div class="seemt-menu-sub-item"><a
                        href="{{ route('manage.e_invoice.e-invoice-manage.index') }}">@lang('modules.menu.nav.manage.e_invoice.title')
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
                <i class="fi-rr-chart-histogram" id="fi-rr-chart-histogram"></i>
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
                    <a>Chi Tiết DT Bán Hàng <i class="fi-rr-angle-small-down"></i></a>
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
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('report.sell.off-menu-dishes-report.index') }}">Ngoài menu
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
                        <div class="seemt-menu-sub-item"><a href="{{ route('report.sell.point-report.index') }}">Điểm
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
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
                <div class="seemt-menu-sub-item">
                    <a>Nhà Cung Cấp<i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('report.inventory-supplier-report.index') }}">Mua hàng
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('report.price-change-histories.index') }}"> Biến động giá
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a>Kho <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
{{--                        <div class="seemt-menu-sub-item">--}}
{{--                            <a>Kho Tổng <i class="fi-rr-angle-small-down"></i></a>--}}
{{--                            <div class="seemt-menu-sub-last">--}}
{{--                                <div class="seemt-menu-sub-item"><a--}}
{{--                                        href="{{ route('report.warehouse_report.material.warehouse-material-report.index') }}">Nhập--}}
{{--                                        xuất--}}
{{--                                        <label>--}}
{{--                                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"--}}
{{--                                               data-placement="right"--}}
{{--                                               data-original-title="Thực hiện trên chi nhánh"></i>--}}
{{--                                        </label>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="seemt-menu-sub-item"><a--}}
{{--                                        href="{{ route('report.warehouse_report.inventory.warehouse-inventory-report.index') }}">Kiểm--}}
{{--                                        kê--}}
{{--                                        <label>--}}
{{--                                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"--}}
{{--                                               data-placement="right"--}}
{{--                                               data-original-title="Thực hiện trên chi nhánh"></i>--}}
{{--                                        </label>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="seemt-menu-sub-item">
                            <a>Kho Chi Nhánh <i class="fi-rr-angle-small-down"></i></a>
                            <div class="seemt-menu-sub-last">
                                <div class="seemt-menu-sub-item"><a
                                        href="{{ route('report.material-report.index') }}">Nhập xuất
                                        <label>
                                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                               data-placement="right"
                                               data-original-title="Thực hiện trên chi nhánh"></i>
                                        </label>
                                    </a>
                                </div>
                                <div class="seemt-menu-sub-item"><a
                                        href="{{ route('report.inventory-report.index') }}">Kiểm kê
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
                            <a>Kho Bộ phận <i class="fi-rr-angle-small-down"></i></a>
                            <div class="seemt-menu-sub-last">
                                <div class="seemt-menu-sub-item"><a
                                        href="{{ route('report.material-internal-report.index') }}">Nhập xuất
                                        <label>
                                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                               data-placement="right"
                                               data-original-title="Thực hiện trên chi nhánh"></i>
                                        </label>
                                    </a>
                                </div>
                                <div class="seemt-menu-sub-item"><a
                                        href="{{ route('report.inventory-internal-report.index') }}">Kiểm kê
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
                            <a href="{{ route('report.material-food-report.index') }}">Định Lượng
                                <label>
                                    <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên chi nhánh"></i>
                                </label>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a href="{{ route('report.deposit-to-card-report.index') }}">
                        Nạp thẻ
                        <label>
                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                               data-original-title="Thực hiện trên chi nhánh"></i>
                        </label>
                    </a>
                </div>
                <div class="seemt-menu-sub-item">
                    <a href="{{ route('report.service-cost-history-report.index') }}">
                        Lịch sử chi phí dịch vụ
                        <label>
                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                               data-original-title="Thực hiện trên chi nhánh"></i>
                        </label>
                    </a>
                </div>
            </div>
        </div>
{{--        @if ((Session::get(SESSION_KEY_LEVEL)))--}}
            <div class="seemt-menu-item">
                <a>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M15.8333 20H4.16667C3.062 19.9987 2.00296 19.5593 1.22185 18.7782C0.440735 17.997 0.00132321 16.938 0 15.8333V4.16667C0.00132321 3.062 0.440735 2.00296 1.22185 1.22185C2.00296 0.440735 3.062 0.00132321 4.16667 0H15.8333C16.938 0.00132321 17.997 0.440735 18.7782 1.22185C19.5593 2.00296 19.9987 3.062 20 4.16667V15.8333C19.9987 16.938 19.5593 17.997 18.7782 18.7782C17.997 19.5593 16.938 19.9987 15.8333 20ZM4.16667 1.66667C3.50363 1.66667 2.86774 1.93006 2.3989 2.3989C1.93006 2.86774 1.66667 3.50363 1.66667 4.16667V15.8333C1.66667 16.4964 1.93006 17.1323 2.3989 17.6011C2.86774 18.0699 3.50363 18.3333 4.16667 18.3333H15.8333C16.4964 18.3333 17.1323 18.0699 17.6011 17.6011C18.0699 17.1323 18.3333 16.4964 18.3333 15.8333V4.16667C18.3333 3.50363 18.0699 2.86774 17.6011 2.3989C17.1323 1.93006 16.4964 1.66667 15.8333 1.66667H4.16667ZM10.9939 14.2154C10.8817 14.0113 10.8246 13.7839 10.8277 13.5536V11.5044C10.8289 11.099 10.7033 10.7024 10.467 10.3651C10.2307 10.0278 9.89427 9.7649 9.50055 9.60994C9.10683 9.45499 8.67358 9.41492 8.25587 9.49485C7.83816 9.57477 7.45486 9.77107 7.15469 10.0588C6.95191 10.2462 6.79162 10.4712 6.68369 10.7198C6.57577 10.9684 6.52251 11.2354 6.52719 11.5044C6.52331 11.7743 6.57691 12.0422 6.68475 12.2919C6.79259 12.5416 6.95245 12.768 7.15469 12.9573C7.35168 13.15 7.58801 13.3023 7.84916 13.4049C8.1103 13.5074 8.39074 13.5581 8.67321 13.5536H9.30303C9.93053 13.5536 10.3919 13.8419 10.7018 14.4242C10.7867 14.6051 10.8304 14.8011 10.8301 14.9992H8.67321C7.44912 14.9992 6.45919 14.5176 5.69568 13.5536C5.23666 12.9603 4.99258 12.2411 5.00017 11.5044C4.99905 11.0451 5.09329 10.5902 5.27748 10.1657C5.46167 9.7412 5.73218 9.35551 6.07348 9.03078C6.41478 8.70603 6.82014 8.44865 7.26628 8.27339C7.71242 8.09814 8.19055 8.00846 8.67321 8.00953H8.86255C8.9944 8.01713 9.12571 8.03161 9.25589 8.05291C9.39941 8.06842 9.54098 8.09724 9.67861 8.13894C9.813 8.17248 9.9445 8.21574 10.072 8.26836C10.3297 8.37364 10.5754 8.50373 10.8053 8.65659L10.8277 8.6713C10.9848 8.78136 11.1338 8.90149 11.2736 9.03086C11.6212 9.35129 11.8958 9.73627 12.0804 10.1619C12.2651 10.5875 12.3558 11.0447 12.347 11.5051V15C11.7574 14.9992 11.3038 14.7404 10.9939 14.2154ZM13.5928 14.1081C13.6695 14.2837 13.783 14.4426 13.9265 14.575C14.0656 14.7115 14.2326 14.8195 14.4172 14.8925C14.6018 14.9655 14.8 15.0018 14.9999 14.9993V6.45294C15.0005 6.26259 14.9617 6.07401 14.8856 5.89794C14.8096 5.72188 14.6978 5.56181 14.5567 5.42687C14.4156 5.29193 14.248 5.18478 14.0633 5.11153C13.8787 5.03829 13.6806 5.00039 13.4806 5V13.5537C13.478 13.7438 13.5161 13.9325 13.5928 14.1081Z"
                              fill="#A7A8AB"></path>
                        <i id="icon-aloline" class="icon-aloline"></i>
                    </svg>
                </a>
                <div class="seemt-menu-sub">
                    <div class="seemt-menu-sub-title">Aloline</div>
                    <div class="seemt-menu-sub-item">
                        <a>Báo Cáo <i class="fi-rr-angle-small-down"></i></a>
                        <div class="seemt-menu-sub-last">
                            <div class="seemt-menu-sub-item">
                                <a href="{{ route('customer.new-customer-report.index') }}">
                                    @lang('modules.menu.nav.customer.report.new-customer-report')
                                    <label>
                                        <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                           data-placement="right"
                                           data-original-title="Thực hiện trên chi nhánh"></i>
                                    </label>
                                </a>
                            </div>
                            <div class="seemt-menu-sub-item">
                                <a href="{{ route('customer.history-point-report.index') }}">
                                    @lang('modules.menu.nav.customer.report.history-point-report')
                                    <label>
                                        <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                           data-placement="right"
                                           data-original-title="Thực hiện trên chi nhánh"></i>
                                    </label>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="seemt-menu-sub-item"><a
                            href="{{ route('customer.restaurant-membership-card.index') }}">
                            @lang('modules.menu.nav.customer.restaurant-membership-card')
                            <label>
                                <i class="fi-rr-building icon-restaurant" data-toggle="tooltip" data-placement="right"
                                   data-original-title="Thực hiện trên Công ty"></i>
                            </label>
                        </a>
                    </div>
                    <div class="seemt-menu-sub-item">
                        <a href="{{ route('customer.customers.index') }}">@lang('modules.menu.nav.customer.customers')
                            <label>
                                <i class="fi-rr-building icon-restaurant" data-toggle="tooltip" data-placement="right"
                                   data-original-title="Thực hiện trên Công ty"></i>
                            </label>
                        </a>
                    </div>
                    <div class="seemt-menu-sub-item">
                        <a href="{{ route('customer.card-value.index') }}">@lang('modules.menu.nav.customer.card-value')
                            <label>
                                <i class="fi-rr-building icon-restaurant" data-toggle="tooltip" data-placement="right"
                                   data-original-title="Thực hiện trên Công ty"></i>
                            </label>
                        </a>
                    </div>
                    <div class="seemt-menu-sub-item">
                        <a href="{{ route('customer.cards.index') }}">@lang('modules.menu.nav.customer.cards')
                            <label>
                                <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                   data-placement="right"
                                   data-original-title="Thực hiện trên chi nhánh"></i>
                            </label>
                        </a>
                    </div>
                    {{--                    <div class="seemt-menu-sub-item">--}}
                    {{--                        <a href="#">Món Mang Về <i class="fi-rr-angle-small-down"></i></a>--}}
                    {{--                        <div class="seemt-menu-sub-last">--}}
                    {{--                            <div class="seemt-menu-sub-item"><a--}}
                    {{--                                    href="{{ route('customer.takeaway.take-away-brand.index') }}">@lang('modules.menu.nav.customer.take-away.brand')--}}
                    {{--                                    <label>--}}
                    {{--                                        <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"--}}
                    {{--                                           data-original-title="Thực hiện trên thương hiệu"></i>--}}
                    {{--                                    </label>--}}
                    {{--                                </a>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="seemt-menu-sub-item">--}}
                    {{--                                <a href="{{ route('customer.takeaway.take-away-branch.index') }}">@lang('modules.menu.nav.customer.take-away.branch')--}}
                    {{--                                    <label>--}}
                    {{--                                        <i class="fi-rr-marker icon-branch" data-toggle="tooltip"--}}
                    {{--                                           data-placement="right"--}}
                    {{--                                           data-original-title="Thực hiện trên chi nhánh"></i>--}}
                    {{--                                    </label>--}}
                    {{--                                </a>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    {{--                    <div class="seemt-menu-sub-item"><a--}}
                    {{--                            href="{{ route('customer.bestselling-food-customer.index') }}">@lang('modules.menu.nav.customer.bestselling-food')--}}
                    {{--                            <label>--}}
                    {{--                                <i class="fi-rr-marker icon-branch" data-toggle="tooltip"--}}
                    {{--                                   data-placement="right"--}}
                    {{--                                   data-original-title="Thực hiện trên chi nhánh"></i>--}}
                    {{--                            </label>--}}
                    {{--                        </a>--}}
                    {{--                    </div>--}}
                    <div class="seemt-menu-sub-item"><a
                            href="{{ route('customer.booking-food-customer.index') }}">@lang('modules.menu.nav.customer.booking-food')
                            <label>
                                <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                   data-placement="right"
                                   data-original-title="Thực hiện trên chi nhánh"></i>
                            </label>
                        </a>
                    </div>
                    <div class="seemt-menu-sub-item"><a
                            href="{{ route('customer.assign-customer.index') }}">@lang('modules.menu.nav.customer.assign-customer')
                            <label>
                                <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                                   data-placement="right"
                                   data-original-title="Thực hiện trên chi nhánh"></i>
                            </label>
                        </a>
                    </div>
                    <div class="seemt-menu-sub-item"><a
                            href="{{ route('customer.card-tag.index') }}">@lang('modules.menu.nav.customer.card-tag')
                            <label>
                                <i class="fi-rr-building icon-restaurant" data-toggle="tooltip" data-placement="right"
                                   data-original-title="Thực hiện trên Công ty"></i>
                            </label>
                        </a>
                    </div>
                    <div class="seemt-menu-sub-item"><a
                            href="{{ route('customer.banner.index') }}">Banner
                            <label>
                                <i class="fi-rr-bank icon-brand" data-toggle="tooltip"
                                   data-placement="right"
                                   data-original-title="Thực hiện trên thương hiệu"></i>
                            </label>
                        </a>
                    </div>
                </div>
            </div>
{{--        @endif--}}
{{--        @if (--}}
{{--            (Session::get(SESSION_KEY_LEVEL) > 5 && in_array('OWNER', Session::get(SESSION_PERMISSION))) ||--}}
{{--                in_array('WEB_MENU_MARKETING', Session::get(SESSION_PERMISSION)))--}}
            <div class="seemt-menu-item">
                <a>
                    <i class="fi-rr-presentation" id="fi-rr-presentation"></i>
                    <div class="seemt-menu-title">
                        <span class="">Marketing</span>
                        <i class="fi-rr-angle-small-down"></i>
                    </div>
                </a>
                <div class="seemt-menu-sub">
                    <div class="seemt-menu-sub-title">Marketing</div>
                    <div class="seemt-menu-sub-item"><a
                            href="{{ route('marketing.campaign-marketing.index') }}">@lang('modules.menu.nav.marketing.campaign')
                            <label>
                                <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                                   data-original-title="Thực hiện trên thương hiệu"></i>
                            </label>
                        </a>
                    </div>
                    <div class="seemt-menu-sub-item"><a
                            href="{{ route('marketing.media-restaurant-marketing.index') }}">@lang('modules.menu.nav.marketing.media-restaurant')
                            <label>
                                <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                                   data-original-title="Thực hiện trên thương hiệu"></i>
                            </label>
                        </a>
                    </div>
                    <div class="seemt-menu-sub-item">
                        <a>Quà tặng <i class="fi-rr-angle-small-down"></i></a>
                        <div class="seemt-menu-sub-last">
                            <div class="seemt-menu-sub-item"><a
                                    href="{{ route('marketing.gift.gift-marketing.index') }}">@lang('modules.menu.nav.marketing.gift.gift')
                                    <label>
                                        <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                                           data-original-title="Thực hiện trên thương hiệu"></i>
                                    </label>
                                </a>
                            </div>
                            {{--                                                <div class="seemt-menu-sub-item"><a href="{{route('marketing.promotion.promotion.index')}}" --}}
                            {{--                                                    >@lang('modules.menu.nav.marketing.promotion')</a> --}}
                            {{--                                                </div> --}}
                            <div class="seemt-menu-sub-item"><a
                                    href="{{ route('marketing.gift.new-customer-gift.index') }}">@lang('modules.menu.nav.marketing.gift.gift-full-text')
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
{{--        @endif--}}
        <div class="seemt-menu-item">
            <a>
                <i class="fi-rr-database" id="fi-rr-database"></i>
                <div class="seemt-menu-title">
                    <span class="">Xây Dựng Dữ Liệu</span>
                    <i class="fi-rr-angle-small-down"></i>
                </div>
            </a>
            <div class="seemt-menu-sub">
                <div class="seemt-menu-sub-title">Xây Dựng Dữ Liệu</div>
                <div class="seemt-menu-sub-item">
                    <a>Nhà Cung Cấp <i class="fi-rr-angle-small-down"></i></a>
                    {{--                    <div class="seemt-menu-sub-last"> --}}
                    {{--                        <div class="seemt-menu-sub-item"><a href="{{route('build_data.supplier.list-supplier-data.index')}}"> --}}
                    {{--                                @lang('modules.menu.nav.build_data.list-supplier.list-supplier-data')</a> --}}
                    {{--                        </div> --}}
                    {{--                        <div class="seemt-menu-sub-item"> --}}
                    {{--                            <a href="#">Nhà Cung Cấp <i class="fi-rr-angle-small-down"></i></a> --}}
                    {{--                            <div class="seemt-menu-sub-last"> --}}
                    {{--                                <div class="seemt-menu-sub-item"> --}}
                    {{--                                    <a href="{{route('build_data.assign-supplier.restaurant-assign-supplier-data.index')}}"> --}}
                    {{--                                        @lang('modules.menu.nav.build_data.assign-supplier.title_sub_menu_one')</a> --}}
                    {{--                                </div> --}}
                    {{--                                <div class="seemt-menu-sub-item"> --}}
                    {{--                                    <a href="{{route('build_data.assign_supplier_material.restaurant-material-data.index')}}"> --}}
                    {{--                                        @lang('modules.menu.nav.build_data.assign-material-supplier.title_sub_menu_one')</a> --}}
                    {{--                                </div> --}}
                    {{--                                <div class="seemt-menu-sub-item"> --}}
                    {{--                                    <a href="{{route('build_data.assign_supplier_material.brand-material-data.index')}}"> --}}
                    {{--                                        @lang('modules.menu.nav.build_data.assign-material-supplier.title_sub_menu_two')</a> --}}
                    {{--                                </div> --}}
                    {{--                            </div> --}}
                    {{--                        </div> --}}
                    {{--                    </div> --}}
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item">
                            <a href="{{ route('build_data.supplier.list-supplier-data.index') }}">
                                @lang('modules.menu.nav.build_data.list-supplier.list-supplier-data')
                                <label>
                                    <i class="fi-rr-building icon-restaurant" data-toggle="tooltip"
                                       data-placement="right" data-original-title="Thực hiện trên Công ty"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.assign-supplier.restaurant-assign-supplier-data.index') }}">@lang('modules.menu.nav.build_data.assign-supplier.title_sub_menu_one')
                                <label>
                                    <i class="fi-rr-building icon-restaurant" data-toggle="tooltip"
                                       data-placement="right" data-original-title="Thực hiện trên Công ty"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.assign_supplier_material.restaurant-material-data.index') }}">@lang('modules.menu.nav.build_data.assign-material-supplier.title_sub_menu_one')
                                <label>
                                    <i class="fi-rr-building icon-restaurant" data-toggle="tooltip"
                                       data-placement="right" data-original-title="Thực hiện trên Công ty"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.assign_supplier_material.brand-material-data.index') }}">@lang('modules.menu.nav.build_data.assign-material-supplier.title_sub_menu_two')
                                <label>
                                    <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên thương hiệu"></i>
                                </label>
                            </a>
                        </div>
                        {{--                        <div class="seemt-menu-sub-item"> --}}
                        {{--                            <a href="#">Nhà Cung Cấp <i class="fi-rr-angle-small-down"></i></a> --}}
                        {{--                            <div class="seemt-menu-sub-last"> --}}
                        {{--                                <div class="seemt-menu-sub-item"><a --}}
                        {{--                                        href="{{route('build_data.assign-supplier.restaurant-assign-supplier-data.index')}}" --}}
                        {{--                                    >@lang('modules.menu.nav.build_data.assign-supplier.title_sub_menu_one')</a> --}}
                        {{--                                </div> --}}
                        {{--                                <div class="seemt-menu-sub-item"><a --}}
                        {{--                                        href="{{route('build_data.assign_supplier_material.restaurant-material-data.index')}}" --}}
                        {{--                                    >@lang('modules.menu.nav.build_data.assign-material-supplier.title_sub_menu_one')</a> --}}
                        {{--                                </div> --}}
                        {{--                                <div class="seemt-menu-sub-item"><a --}}
                        {{--                                        href="{{route('build_data.assign_supplier_material.brand-material-data.index')}}" --}}
                        {{--                                    >@lang('modules.menu.nav.build_data.assign-material-supplier.title_sub_menu_two')</a> --}}
                        {{--                                </div> --}}
                        {{--                            </div> --}}
                        {{--                        </div> --}}
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a>Nguyên Liệu <i class="fi-rr-angle-small-down"></i></a>
                    <div class="seemt-menu-sub-last">
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.material.specifications-data.index') }}">
                                @lang('modules.menu.nav.build_data.material.specifications')
                                <label>
                                    <i class="fi-rr-building icon-restaurant" data-toggle="tooltip"
                                       data-placement="right" data-original-title="Thực hiện trên Công ty"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.material.unit-data.index') }}">
                                @lang('modules.menu.nav.build_data.material.unit')
                                <label>
                                    <i class="fi-rr-building icon-restaurant" data-toggle="tooltip"
                                       data-placement="right" data-original-title="Thực hiện trên Công ty"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.material.unit-order-data.index') }}">
                                @lang('modules.menu.nav.build_data.material.unit-order')
                                <label>
                                    <i class="fi-rr-building icon-restaurant" data-toggle="tooltip"
                                       data-placement="right" data-original-title="Thực hiện trên Công ty"></i>
                                </label>
                            </a>
                        </div>
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.material.material-data.index') }}">
                                @lang('modules.menu.nav.build_data.material.title')
                                <label>
                                    <i class="fi-rr-building icon-restaurant" data-toggle="tooltip"
                                       data-placement="right" data-original-title="Thực hiện trên Công ty"></i>
                                </label>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a>Món ăn <i class="fi-rr-angle-small-down"></i></a>
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
                        @if (Session::get(SESSION_KEY_LEVEL) > 5)
                            <div class="seemt-menu-sub-item"><a
                                    href="{{ route('build_data.food.warning-price-food.index') }}">
                                    @lang('modules.menu.nav.build_data.food.warning-price')
                                    <label>
                                        <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                                           data-original-title="Thực hiện trên thương hiệu"></i>
                                    </label>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="seemt-menu-sub-item">
                    <a>Bếp<i class="fi-rr-angle-small-down"></i></a>
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
{{--                        @if (Session::get(SESSION_KEY_LEVEL) > 3)--}}
                            <div class="seemt-menu-sub-item"><a
                                    href="{{ route('build_data.kitchen.quantitative-data.index') }}">
                                    @lang('modules.menu.nav.build_data.kitchen.quantitative')
                                    <label>
                                        <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                                           data-original-title="Thực hiện trên thương hiệu"></i>
                                    </label>
                                </a>
                            </div>
{{--                        @endif--}}
                    </div>
                </div>
                <div class="seemt-menu-sub-item">
                    <a>Nhân Sự <i class="fi-rr-angle-small-down"></i></a>
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
                        {{--                                        <div class="seemt-menu-sub-item"><a href="{{route('build_data.personnel.permission-employee-data.index')}}"> --}}
                        {{--                                                @lang('modules.menu.nav.build_data.personnel.permission_employee')</a> --}}
                        {{--                                        </li> --}}
                        {{--                                        <div class="seemt-menu-sub-item"><a href="{{route('build_data.personnel.role-data.index')}}"> --}}
                        {{--                                                @lang('modules.menu.nav.build_data.personnel.role')</a> --}}
                        {{--                                        </li> --}}
                        <div class="seemt-menu-sub-item"><a
                                href="{{ route('build_data.personnel.shift-data.index') }}">
                                @lang('modules.menu.nav.build_data.personnel.shift')
                                <label>
                                    <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                                       data-original-title="Thực hiện trên thương hiệu"></i>
                                </label>
                            </a>
                        </div>
{{--                        @if(Session::get('SESSION_KEY_LEVEL') > 1)--}}
                            <div class="seemt-menu-sub-item"><a
                                    href="{{ route('build_data.personnel.wage-data.index') }}">
                                    @lang('modules.menu.nav.build_data.personnel.wage')
                                    <label>
                                        <i class="fi-rr-building icon-restaurant" data-toggle="tooltip"
                                           data-placement="right" data-original-title="Thực hiện trên Công ty"></i>
                                    </label>
                                </a>
                            </div>
{{--                        @endif--}}
{{--                        @if(Session::get('SESSION_KEY_LEVEL') > 2)--}}
                            <div class="seemt-menu-sub-item"><a
                                    href="{{ route('build_data.personnel.level-data.index') }}">
                                    @lang('modules.menu.nav.build_data.personnel.level')
                                    <label>
                                        <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                                           data-original-title="Thực hiện trên thương hiệu"></i>
                                    </label>
                                </a>
                            </div>
                            <div class="seemt-menu-sub-item"><a
                                    href="{{ route('build_data.personnel.category-work-data.index') }}">
                                    @lang('modules.menu.nav.build_data.personnel.category-work')
                                    <label>
                                        <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                                           data-original-title="Thực hiện trên thương hiệu"></i>
                                    </label>
                                </a>
                            </div>
                            <div class="seemt-menu-sub-item"><a
                                    href="{{ route('build_data.personnel.work-data.index') }}">
                                    @lang('modules.menu.nav.build_data.personnel.work')
                                    <label>
                                        <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                                           data-original-title="Thực hiện trên thương hiệu"></i>
                                    </label>
                                </a>
                            </div>
                            <div class="seemt-menu-sub-item"><a
                                    href="{{ route('build_data.personnel.point-data.index') }}">
                                    @lang('modules.menu.nav.build_data.personnel.point')
                                    <label>
                                        <i class="fi-rr-building icon-restaurant" data-toggle="tooltip"
                                           data-placement="right" data-original-title="Thực hiện trên Công ty"></i>
                                    </label>
                                </a>
                            </div>
                            <div class="seemt-menu-sub-item"><a
                                    href="{{ route('build_data.personnel.booking-bonus-data.index') }}">
                                    @lang('modules.menu.nav.build_data.personnel.booking-bonus')
                                    <label>
                                        <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                                           data-original-title="Thực hiện trên thương hiệu"></i>
                                    </label>
                                </a>
                            </div>
                            <div class="seemt-menu-sub-item"><a
                                    href="{{ route('build_data.personnel.kaizen-bonus-data.index') }}">
                                    @lang('modules.menu.nav.build_data.personnel.kaizen-bonus')
                                    <label>
                                        <i class="fi-rr-building icon-restaurant" data-toggle="tooltip"
                                           data-placement="right" data-original-title="Thực hiện trên Công ty"></i>
                                    </label>
                                </a>
                            </div>
{{--                        @endif--}}
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
{{--                        @if(Session::get('SESSION_KEY_LEVEL') > 2)--}}
                            <div class="seemt-menu-sub-item"><a
                                    href="{{ route('build_data.business.permission-sales.index') }}">
                                    @lang('modules.menu.nav.build_data.business.permission-sales')
                                    <label>
                                        <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                           data-original-title="Thực hiện trên chi nhánh"></i>
                                    </label>
                                </a>
                            </div>
                            <div class="seemt-menu-sub-item"><a
                                    href="{{ route('build_data.kitchen.permission-kitchen.index') }}">
                                    @lang('modules.menu.nav.build_data.kitchen.permission-kitchen')
                                    <label>
                                        <i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="right"
                                           data-original-title="Thực hiện trên chi nhánh"></i>
                                    </label>
                                </a>
                            </div>
{{--                        @endif--}}
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
                        {{--                                        <div class="seemt-menu-sub-item"><a href="{{route('build_data.business.permission-sales.index')}}"> --}}
                        {{--                                                @lang('modules.menu.nav.build_data.business.permission-sales')</a> --}}
                        {{--                                        </li> --}}
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
                    <a>Thu Chi <i class="fi-rr-angle-small-down"></i></a>
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
            <a>
                <i class="fi-rr-settings" id="fi-rr-settings"></i>
                <div class="seemt-menu-title">
                    <span class="">Thiết Lập</span>
                    <i class="fi-rr-angle-small-down"></i>
                </div>
            </a>
            <div class="seemt-menu-sub">
                <div class="seemt-menu-sub-title">Thiết Lập</div>
                <div class="seemt-menu-sub-item"><a
                        href="{{ route('setting.restaurant-setting.index') }}">@lang('modules.menu.nav.setting.setting.restaurant')
                        <label>
                            <i class="fi-rr-building icon-restaurant" data-toggle="tooltip"
                               data-placement="right" data-original-title="Thực hiện trên Công ty"></i>
                        </label>
                    </a>
                </div>
                <div class="seemt-menu-sub-item"><a
                        href="{{ route('setting.brand-setting.index') }}">@lang('modules.menu.nav.setting.setting.brand')
                        <label>
                            <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                               data-original-title="Thực hiện trên thương hiệu"></i>
                        </label>
                    </a>
                </div>
                <div class="seemt-menu-sub-item"><a
                        href="{{ route('setting.branch-setting.index') }}">@lang('modules.menu.nav.setting.setting.branch')
                        <label>
                            <i class="fi-rr-marker icon-branch" data-toggle="tooltip"
                               data-placement="right"
                               data-original-title="Thực hiện trên chi nhánh"></i>
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
                @if (Session::get(SESSION_KEY_SETTING_CURRENT_BRAND)['branch_type_option'] == 3 &&
                        Session::get(SESSION_KEY_SETTING_CURRENT_BRAND)['branch_type'] == 2)
                    <div class="seemt-menu-sub-item"><a
                            href="{{ route('marketing.display-secondary-pos.index') }}">Màn
                            hình phụ</a>
                    </div>
                @endif
{{--                @if(Session::get('SESSION_KEY_LEVEL') > 1)--}}
                    <div class="seemt-menu-sub-item">
                    <a href="{{ route('setting.partner-invoice.index') }}">Hóa đơn điện tử
                        <label>
                            <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                               data-original-title="Thực hiện trên thương hiệu"></i>
                        </label>
                    </a>
                </div>
{{--                @endif--}}
                <div class="seemt-menu-sub-item">
                    <a href="{{ route('setting.bank-setting.index') }}">Thông tin thanh toán
                        <label>
                            <i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="right"
                               data-original-title="Thực hiện trên thương hiệu"></i>
                        </label>
                    </a>
                </div>
            </div>
        </div>
        <div class="seemt-menu-item" data-toggle="tooltip" data-placement="right" data-original-title="TIN NHẮN">
            <a href="{{URL::to('visible-message')}}">
                <i class="fi-rr-comment"></i>
                <div class="seemt-menu-title">
                    <span class="">Tin nhăn</span>
                </div>
            </a>
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
