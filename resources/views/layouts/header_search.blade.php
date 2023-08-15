<style>
    .seemt-search-item .search-item .header-search-item {
        height: 50px;
    }


    .seemt-container .seemt-header .seemt-nav-left .seemt-search .search-item {
        height: 50px;
        display: flex;
        align-items: center;
    }

    /*#list-search-header {*/
    /*    position: relative;*/
    /*    max-height: 400px;*/
    /*    height: 400px !important;*/
    /*    overflow-y: auto;*/
    /*    z-index: 1;*/
    /*}*/

    /*#search-history {*/
    /*    position: sticky;*/
    /*    bottom: 0;*/
    /*    z-index: 2;*/
    /*}*/

    .seemt-search-item {
        display: block;
        max-height: 550px;
    }

    .header-search-list {
        max-height: 300px;
        overflow-y: auto;
    }

    #search-history {
        max-height: 250px;
        overflow-y: hidden;
    }

    .seemt-search-item .header-search-list .search-item .header-search-item .search-name {
        font-size: 14px;
    }

    .seemt-container .seemt-header .seemt-search-item span {
        height: 100%;
        align-items: center;
        border-radius: 20px;
        cursor: pointer;
    }

    .header-search-list::-webkit-scrollbar {
        width: 5px;
    }

</style>
@if(Session::get(SESSION_KEY_LEVEL) > 0)
    <div class="seemt-search-item">
        <div class="header-search-list" id="list-search-header">
            <div class="search-item">
                <a class="header-search-item d-flex" data-href="/">
                    <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                    <span
                        class="search-name">@lang('modules.menu.nav.dashboard.title') / @lang('modules.menu.nav.dashboard.index')</span>
                </a>
            </div>
            @if(in_array('OWNER', Session::get(SESSION_PERMISSION)) || in_array('WEB_MENU_TREASURER', Session::get(SESSION_PERMISSION)))
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('treasurer.order-bill-treasurer.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.treasurer.title') / @lang('modules.menu.nav.treasurer.order-bill')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('treasurer.supplier-payment-debt-treasurer.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.treasurer.title') / @lang('modules.menu.nav.treasurer.supplier-payment-debt')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('treasurer.cash-book-treasurer.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.treasurer.title') / @lang('modules.menu.nav.treasurer.cash-book')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('treasurer.fund-period-treasurer.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.treasurer.title') / @lang('modules.menu.nav.treasurer.fund-period')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('treasurer.cash-fund-treasurer.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.treasurer.title') / @lang('modules.menu.nav.treasurer.cash-fund')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('treasurer.payment-bill-treasurer.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.treasurer.title') / @lang('modules.menu.nav.treasurer.payment-bill')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('treasurer.payment-recurring-bill-treasurer.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.treasurer.title') / @lang('modules.menu.nav.treasurer.payment-recurring-bill')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('treasurer.receipts-bill-treasurer.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.treasurer.title') / @lang('modules.menu.nav.treasurer.receipts-bill')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('treasurer.salary-employee-treasurer.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.treasurer.title') / @lang('modules.menu.nav.treasurer.salary-employee')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('treasurer.advance-salary-employee.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.treasurer.title') / @lang('modules.menu.nav.treasurer.advance-salary-employee')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('treasurer.employee-bonus-punish.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.treasurer.title') / @lang('modules.menu.nav.treasurer.employee-bonus-punish')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('treasurer.work-history-treasurer.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.treasurer.title') / @lang('modules.menu.nav.treasurer.work-history')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('treasurer.list-bill-treasurer.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.treasurer.title') / @lang('modules.menu.nav.treasurer.list-bill')</span>
                    </a>
                </div>
            @endif
            @if(in_array('OWNER', Session::get(SESSION_PERMISSION)) || in_array('WEB_MENU_MANAGE', Session::get(SESSION_PERMISSION)))
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{ route('manage.warehouse.goods-purchase-warehouse.index') }}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.manage.title') / @lang('modules.menu.nav.manage.inventory_manage.title') / @lang('modules.menu.nav.manage.inventory_manage.title-warehouse') / @lang('modules.menu.nav.manage.ware_house.ware_order')</span>
                    </a>
                </div>
{{--                <div class="search-item">--}}
{{--                    <a class="header-search-item d-flex"--}}
{{--                       data-href="{{ route('manage.supplier_order.supplier-order.index') }}">--}}
{{--                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>--}}
{{--                        <span class="search-name">@lang('modules.menu.nav.manage.title') / @lang('modules.menu.nav.manage.inventory_manage.title') / @lang('modules.menu.nav.manage.inventory_manage.title-warehouse') / @lang('modules.menu.nav.manage.ware_house.export_inventory')</span>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="search-item">--}}
{{--                    <a class="header-search-item d-flex"--}}
{{--                       data-href="{{ route('manage.supplier_order.supplier-order.index') }}">--}}
{{--                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>--}}
{{--                        <span class="search-name">@lang('modules.menu.nav.manage.title') / @lang('modules.menu.nav.manage.inventory_manage.title') / @lang('modules.menu.nav.manage.inventory_manage.title-warehouse') / @lang('modules.menu.nav.manage.ware_house.checkList')</span>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="search-item">--}}
{{--                    <a class="header-search-item d-flex"--}}
{{--                       data-href="{{ route('manage.supplier_order.supplier-order.index') }}">--}}
{{--                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>--}}
{{--                        <span class="search-name">@lang('modules.menu.nav.manage.title') / @lang('modules.menu.nav.manage.inventory_manage.title') / @lang('modules.menu.nav.manage.inventory_manage.title-warehouse') / @lang('modules.menu.nav.manage.ware_house.cancel')</span>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="search-item">--}}
{{--                    <a class="header-search-item d-flex"--}}
{{--                       data-href="{{ route('manage.supplier_order.supplier-order.index') }}">--}}
{{--                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>--}}
{{--                        <span class="search-name">@lang('modules.menu.nav.manage.title') / @lang('modules.menu.nav.manage.inventory_manage.title') / @lang('modules.menu.nav.manage.inventory_manage.title-warehouse') / @lang('modules.menu.nav.manage.ware_house.return')</span>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="search-item">--}}
{{--                    <a class="header-search-item d-flex"--}}
{{--                       data-href="{{ route('manage.supplier_order.supplier-order.index') }}">--}}
{{--                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>--}}
{{--                        <span class="search-name">@lang('modules.menu.nav.manage.title') / @lang('modules.menu.nav.manage.inventory_manage.title') / @lang('modules.menu.nav.manage.inventory_manage.title-warehouse') / @lang('modules.menu.nav.manage.ware_house.assign_branch_manager')</span>--}}
{{--                    </a>--}}
{{--                </div>--}}

                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{ route('manage.supplier_order.supplier-order.index') }}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.manage.title') / @lang('modules.menu.nav.manage.inventory_manage.title') / @lang('modules.menu.nav.manage.inventory.title') / @lang('modules.menu.nav.manage.supplier-order')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('manage.inventory.in-inventory-manage.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.manage.title') / @lang('modules.menu.nav.manage.inventory_manage.title') / @lang('modules.menu.nav.manage.inventory_manage.title-branch') / @lang('modules.menu.nav.manage.inventory.in-inventory')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('manage.inventory.out-inventory-manage.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.manage.title') / @lang('modules.menu.nav.manage.inventory_manage.title') / @lang('modules.menu.nav.manage.inventory_manage.title-branch') / @lang('modules.menu.nav.manage.inventory.out-inventory')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('manage.inventory.checklist-goods-manage.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.manage.title') / @lang('modules.menu.nav.manage.inventory_manage.title') / @lang('modules.menu.nav.manage.inventory_manage.title-branch') / @lang('modules.menu.nav.manage.inventory.checklist-goods')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('manage.inventory.cancel-inventory-manage.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.manage.title') / @lang('modules.menu.nav.manage.inventory_manage.title') / @lang('modules.menu.nav.manage.inventory_manage.title-branch') / @lang('modules.menu.nav.manage.inventory.cancel-inventory')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('manage.inventory.in-inventory-branch-manage.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.manage.title') / @lang('modules.menu.nav.manage.inventory_manage.title') / @lang('modules.menu.nav.manage.inventory_manage.title-branch') / @lang('modules.menu.nav.manage.inventory.in-inventory-branch')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('manage.inventory.out-inventory-branch-manage.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.manage.title') / @lang('modules.menu.nav.manage.inventory_manage.title') / @lang('modules.menu.nav.manage.inventory_manage.title-branch') / @lang('modules.menu.nav.manage.inventory.out-inventory-branch')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('manage.inventory_internal.in-inventory-internal-manage.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.manage.title') / @lang('modules.menu.nav.manage.inventory_manage.title') / @lang('modules.menu.nav.manage.inventory_manage.title-internal') / @lang('modules.menu.nav.manage.inventory_internal.in-inventory-internal')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('manage.inventory.checklist-goods-internal-manage.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.manage.title') / @lang('modules.menu.nav.manage.inventory_manage.title') / @lang('modules.menu.nav.manage.inventory_manage.title-internal') / @lang('modules.menu.nav.manage.inventory_internal.checklist-goods-internal')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('manage.inventory_internal.return-inventory-internal-manage.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.manage.title') / @lang('modules.menu.nav.manage.inventory_manage.title') / @lang('modules.menu.nav.manage.inventory_manage.title-internal') / @lang('modules.menu.nav.manage.inventory_internal.return-inventory-internal')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('manage.inventory_internal.cancel-inventory-internal-manage.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.manage.title') / @lang('modules.menu.nav.manage.inventory_manage.title') / @lang('modules.menu.nav.manage.inventory_manage.title-internal') / @lang('modules.menu.nav.manage.inventory_internal.cancel-inventory-internal')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('manage.food.food-brand-manage.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.manage.title') / @lang('modules.menu.nav.manage.food_menu.title')</span>
                    </a>
                </div>
{{--                <div class="search-item">--}}
{{--                    <a class="header-search-item d-flex" data-href="{{route('manage.food.food-branch-manage.index')}}">--}}
{{--                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>--}}
{{--                        <span class="search-name">@lang('modules.menu.nav.manage.title') / @lang('modules.menu.nav.manage.food_menu.title') / @lang('modules.menu.nav.manage.food_menu.branch')</span>--}}
{{--                    </a>--}}
{{--                </div>--}}
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('manage.employee.employee-manage.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.manage.title') / @lang('modules.menu.nav.manage.employee.title') / @lang('modules.menu.nav.manage.employee.employee')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('manage.employee_off.employee-off-manage.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.manage.title') / @lang('modules.menu.nav.manage.employee.title') / @lang('modules.menu.nav.manage.employee.employee-off')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('manage.time_keeping.time-keeping-manage.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.manage.title') / @lang('modules.menu.nav.manage.employee.title') / @lang('modules.menu.nav.manage.employee.time_keeping')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('manage.booking_table.booking-table-manage.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.manage.title') / @lang('modules.menu.nav.manage.booking_table')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('manage.supplier.supplier-manage.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.manage.title') / @lang('modules.menu.nav.manage.supplier')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('manage.bill.bill-manage.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.manage.title') / @lang('modules.menu.nav.manage.bill')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('manage.payroll.payroll-manage.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.manage.title') / @lang('modules.menu.nav.manage.payroll')</span>
                    </a>
                </div>
            @endif
            @if(in_array('OWNER', Session::get(SESSION_PERMISSION)) || in_array('WEB_MENU_REPORT', Session::get(SESSION_PERMISSION)))
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.sell-order-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.revenue_sell') / @lang('modules.menu.nav.report.time')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.employee-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.revenue_sell') / @lang('modules.menu.nav.report.employee')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.area-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.revenue_sell') / @lang('modules.menu.nav.report.area')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.detail-revenue-sell.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.detail_revenue_sell') / @lang('modules.menu.nav.report.overview')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.sell.food-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.detail_revenue_sell') / @lang('modules.menu.nav.report.food')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.sell.category-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.detail_revenue_sell') / @lang('modules.menu.nav.report.category')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.sell.gift-food-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.detail_revenue_sell') / @lang('modules.menu.nav.report.gift_food')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.sell.off-menu-dishes-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.detail_revenue_sell') / @lang('modules.menu.nav.report.off_menu')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.sell.take-away-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.detail_revenue_sell') / @lang('modules.menu.nav.report.take_away')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.sell.food-cancel-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.detail_revenue_sell') / @lang('modules.menu.nav.report.cancel')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.sell.vat-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.detail_revenue_sell') / @lang('modules.menu.nav.report.vat')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.sell.discount-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.detail_revenue_sell') / @lang('modules.menu.nav.report.discount')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.sell.surcharge-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.detail_revenue_sell') / @lang('modules.menu.nav.report.surcharge')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.sell.point-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.detail_revenue_sell') / @lang('modules.menu.nav.report.point')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.sell.order-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.detail_revenue_sell') / @lang('modules.menu.nav.report.order')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.revenue-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.revenue')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.cost-debt-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.cost-debt')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.inventory-supplier-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.supplier') / @lang('modules.menu.nav.report.purchase')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.price-change-histories.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.supplier') / @lang('modules.menu.nav.report.price-change-histories')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.warehouse_report.material.warehouse-material-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.ware_houses') / @lang('modules.menu.nav.report.warehouse') / @lang('modules.menu.nav.report.import_export')</span>
                    </a>
                </div><div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.warehouse_report.inventory.warehouse-inventory-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.ware_houses') / @lang('modules.menu.nav.report.warehouse') / @lang('modules.menu.nav.report.stock_take')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.material-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.ware_houses') / @lang('modules.menu.nav.report.warehouse_branch') / @lang('modules.menu.nav.report.import_export')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.inventory-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.ware_houses') / @lang('modules.menu.nav.report.warehouse_branch') / @lang('modules.menu.nav.report.stock_take')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.material-internal-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.ware_houses') / @lang('modules.menu.nav.report.warehouse_material') / @lang('modules.menu.nav.report.import_export')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.inventory-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.ware_houses') / @lang('modules.menu.nav.report.warehouse_material') / @lang('modules.menu.nav.report.stock_take')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.inventory-internal-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.ware_houses') / @lang('modules.menu.nav.report.quantitative')</span>
                    </a>
                </div>
{{--                <div class="search-item">--}}
{{--                    <a class="header-search-item d-flex" data-href="{{route('report.material-food-report.index')}}">--}}
{{--                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>--}}
{{--                        <span--}}
{{--                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.material_food')</span>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                --}}{{--        <a class="header-search-item d-flex" data-href="{{route('report.sell-report.index')}}">--}}
{{--                --}}{{--            <span class="search-icon mr-3"><i class="fi-rr-search"></em></span>--}}
{{--                --}}{{--            <span--}}
{{--                --}}{{--                class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.sell')</span>--}}
{{--                --}}{{----}}
{{--                </a></--}}







{{--                <div class="search-item">--}}
{{--                    <a class="header-search-item d-flex" data-href="{{route('report.profit-report.index')}}">--}}
{{--                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>--}}
{{--                        <span--}}
{{--                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.profit')</span>--}}
{{--                    </a>--}}
{{--                </div>--}}


{{--                <div class="search-item">--}}
{{--                    <a class="header-search-item d-flex" data-href="{{route('report.detail-money-report.index')}}">--}}
{{--                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>--}}
{{--                        <span--}}
{{--                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.detail_money')</span>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="search-item">--}}
{{--                    <a class="header-search-item d-flex" data-href="{{route('report.business-results-report.index')}}">--}}
{{--                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>--}}
{{--                        <span--}}
{{--                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.business_results')</span>--}}
{{--                    </a>--}}
{{--                </div>--}}
            @endif
            @if(in_array('OWNER', Session::get(SESSION_PERMISSION)) || in_array('WEB_MENU_ALOLINE', Session::get(SESSION_PERMISSION)))
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('customer.new-customer-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.customer.title') / @lang('modules.menu.nav.customer.report.title') / @lang('modules.menu.nav.customer.report.new-customer-report')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('customer.history-point-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.customer.title') / @lang('modules.menu.nav.customer.report.title') / @lang('modules.menu.nav.customer.report.history-point-report')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('customer.restaurant-membership-card.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.customer.title') / @lang('modules.menu.nav.customer.restaurant-membership-card')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('customer.customers.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.customer.title') / @lang('modules.menu.nav.customer.customers')</span>
                    </a>
                </div>
                <div class="search-item">
                        <a class="header-search-item d-flex" data-href="{{route('customer.card-value.index')}}">
                            <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                            <span class="search-name">@lang('modules.menu.nav.customer.title') / @lang('modules.menu.nav.customer.card-value')</span>

                        </a></div>
                <div class="search-item">
                        <a class="header-search-item d-flex" data-href="{{route('customer.cards.index')}}">
                            <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                            <span class="search-name">@lang('modules.menu.nav.customer.title') / @lang('modules.menu.nav.customer.cards')</span>

                        </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('customer.assign-customer.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.customer.title') / @lang('modules.menu.nav.customer.assign-customer')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('customer.card-tag.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.customer.title') / @lang('modules.menu.nav.customer.card-tag')</span>
                    </a>
                </div>
                {{--        <a class="header-search-item d-flex" data-href="{{route('customer.discount.index')}}">--}}
                {{--            <span class="search-icon mr-3"><i class="fi-rr-search"></em></span>--}}
                {{--            <span class="search-name">@lang('modules.menu.nav.customer.title') / @lang('modules.menu.nav.customer.discount')</span>--}}
                {{--
                </a></--}}
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('customer.banner.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.customer.title') / Banner</span>
                    </a>
                </div>
{{--                <div class="search-item">--}}
{{--                    <a class="header-search-item d-flex" data-href="{{route('customer.notification.index')}}">--}}
{{--                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>--}}
{{--                        <span--}}
{{--                            class="search-name">@lang('modules.menu.nav.customer.title') / @lang('modules.menu.nav.customer.notification')</span>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="search-item">--}}
{{--                    <a class="header-search-item d-flex" data-href="{{route('customer.takeaway.take-away-brand.index')}}">--}}
{{--                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>--}}
{{--                        <span class="search-name">@lang('modules.menu.nav.customer.title') / @lang('modules.menu.nav.customer.take-away.title') / @lang('modules.menu.nav.customer.take-away.brand')</span>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="search-item">--}}
{{--                    <a class="header-search-item d-flex" data-href="{{route('customer.takeaway.take-away-branch.index')}}">--}}
{{--                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>--}}
{{--                        <span class="search-name">@lang('modules.menu.nav.customer.title') / @lang('modules.menu.nav.customer.take-away.title') / @lang('modules.menu.nav.customer.take-away.branch')</span>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="search-item">--}}
{{--                    <a class="header-search-item d-flex" data-href="{{route('customer.bestselling-food-customer.index')}}">--}}
{{--                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>--}}
{{--                        <span--}}
{{--                            class="search-name">@lang('modules.menu.nav.customer.title') / @lang('modules.menu.nav.customer.bestselling-food')</span>--}}
{{--                    </a>--}}
{{--                </div>--}}
            @endif
            @if(in_array('OWNER', Session::get(SESSION_PERMISSION)) || in_array('WEB_MENU_MARKETING', Session::get(SESSION_PERMISSION)))
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('marketing.campaign-marketing.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.marketing.title') / @lang('modules.menu.nav.marketing.campaign')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('marketing.media-restaurant-marketing.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.marketing.title') / @lang('modules.menu.nav.marketing.media-restaurant')</span>
                    </a>
                </div>
                {{--        <a class="header-search-item d-flex" data-href="{{route('marketing.promotion.promotion.index')}}">--}}
                {{--            <span class="search-icon mr-3"><i class="fi-rr-search"></em></span>--}}
                {{--            <span class="search-name">@lang('modules.menu.nav.marketing.title') / @lang('modules.menu.nav.marketing.promotion')</span>--}}
                {{--
                </a></--}}
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('marketing.gift.gift-marketing.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.marketing.title') / @lang('modules.menu.nav.marketing.gift.title') / @lang('modules.menu.nav.marketing.gift.gift')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('marketing.gift.new-customer-gift.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.marketing.title') / @lang('modules.menu.nav.marketing.gift.title') / @lang('modules.menu.nav.marketing.gift.gift-full-text')</span>
                    </a>
                </div>
{{--                <div class="search-item">--}}
{{--                    <a class="header-search-item d-flex" data-href="{{route('marketing.gift.notify-gift.index')}}">--}}
{{--                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>--}}
{{--                        <span class="search-name">@lang('modules.menu.nav.marketing.title') / @lang('modules.menu.nav.marketing.gift.title') / @lang('modules.menu.nav.marketing.gift.notify')</span>--}}
{{--                    </a>--}}
{{--                </div>--}}
            @endif
            @if(in_array('OWNER', Session::get(SESSION_PERMISSION)) || in_array('BUILD_RESTAURANT_DATA', Session::get(SESSION_PERMISSION)) || in_array('WEB_MENU_SETUP_DATA', Session::get(SESSION_PERMISSION)))
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('build_data.supplier.list-supplier-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.list-supplier.title') / @lang('modules.menu.nav.build_data.list-supplier.list-supplier-data')</span>
                    </a>
                </div>
{{--                <div class="search-item">--}}
{{--                    <a class="header-search-item d-flex"--}}
{{--                       data-href="{{route('build_data.supplier.supplier-material-data.index')}}">--}}
{{--                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>--}}
{{--                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.list-supplier.title') / @lang('modules.menu.nav.build_data.list-supplier.material-supplier-data')</span>--}}
{{--                    </a>--}}
{{--                </div>--}}
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('build_data.assign-supplier.restaurant-assign-supplier-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.list-supplier.title') / @lang('modules.menu.nav.build_data.list-supplier.choose-supplier-use')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('build_data.assign-supplier.brand-assign-supplier-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.list-supplier.title') / @lang('modules.menu.nav.build_data.list-supplier.material_supplier_company')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('build_data.assign-supplier.branch-assign-supplier-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.list-supplier.title') / @lang('modules.menu.nav.build_data.list-supplier.choose_brand')</span>
                    </a>
                </div>
{{--                <div class="search-item">--}}
{{--                    <a class="header-search-item d-flex"--}}
{{--                       data-href="{{route('build_data.assign_supplier_material.restaurant-material-data.index')}}">--}}
{{--                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>--}}
{{--                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.assign-material-supplier.title') / @lang('modules.menu.nav.build_data.assign-material-supplier.title_sub_menu_one')</span>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="search-item">--}}
{{--                    <a class="header-search-item d-flex"--}}
{{--                       data-href="{{route('build_data.assign_supplier_material.restaurant-material-data.index')}}">--}}
{{--                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>--}}
{{--                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.assign-material-supplier.title') / @lang('modules.menu.nav.build_data.assign-material-supplier.title_sub_menu_two')</span>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="search-item">--}}
{{--                    <a class="header-search-item d-flex"--}}
{{--                       data-href="{{route('build_data.assign_supplier_material.restaurant-material-data.index')}}">--}}
{{--                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>--}}
{{--                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.assign-material-supplier.title') / @lang('modules.menu.nav.build_data.assign-material-supplier.title_sub_menu_three')</span>--}}
{{--                    </a>--}}
{{--                </div>--}}
                <!--Nguyeen lieu-->
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('build_data.material.specifications-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.material.title') / @lang('modules.menu.nav.build_data.material.specifications')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.material.unit-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.material.title') / @lang('modules.menu.nav.build_data.material.unit')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.material.unit-order-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.material.title') / @lang('modules.menu.nav.build_data.material.unit-order')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.material.material-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.material.title') / @lang('modules.menu.nav.build_data.material.title')</span>
                    </a>
                </div>
                {{--        <a class="header-search-item d-flex" data-href="{{route('build_data.material.inventory-material.index')}}">--}}
                {{--            <span class="search-icon mr-3"><i class="fi-rr-search"></em></span>--}}
                {{--            <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.material.title') / @lang('modules.menu.nav.build_data.material.inventory')</span>--}}
                {{--
                </a></--}}
                <!--Mon an-->
                <div class="search-item">
                    <a class="header-search-item d-flex" id="123"
                       data-href="{{route('build_data.food.category-food-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.food.title') / @lang('modules.menu.nav.build_data.food.category')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.food.unit-food-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.food.title') / @lang('modules.menu.nav.build_data.food.unit')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.food.food-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.food.title') / @lang('modules.menu.nav.build_data.food.title')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.food.gift-food-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.food.title') / @lang('modules.menu.nav.build_data.food.gift')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.food.note-food-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.food.title') / @lang('modules.menu.nav.build_data.food.note')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.food.warning-price-food.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.food.title') / @lang('modules.menu.nav.build_data.food.warning-price')</span>
                    </a>
                </div>
                <!--Nhan su-->
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.personnel.employee-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.personnel.title') / @lang('modules.menu.nav.build_data.personnel.employee')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.personnel.shift-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.personnel.title') / @lang('modules.menu.nav.build_data.personnel.shift')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('build_data.personnel.permission-employee-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.personnel.title') / @lang('modules.menu.nav.build_data.personnel.permission_employee')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.personnel.role-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.personnel.title') / @lang('modules.menu.nav.build_data.personnel.role')</span>
                    </a>
                </div>

                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.personnel.wage-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.personnel.title') / @lang('modules.menu.nav.build_data.personnel.wage')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.personnel.level-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.personnel.title') / @lang('modules.menu.nav.build_data.personnel.level')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('build_data.personnel.category-work-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.personnel.title') / @lang('modules.menu.nav.build_data.personnel.category-work')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.personnel.work-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.personnel.title') / @lang('modules.menu.nav.build_data.personnel.work')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.personnel.point-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.personnel.title') / @lang('modules.menu.nav.build_data.personnel.point')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('build_data.personnel.booking-bonus-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.personnel.title') / @lang('modules.menu.nav.build_data.personnel.booking-bonus')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('build_data.personnel.kaizen-bonus-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.personnel.title') / @lang('modules.menu.nav.build_data.personnel.kaizen-bonus')</span>
                    </a>
                </div>
                <!--Kinh doanh-->
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.business.area-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.business.title') / @lang('modules.menu.nav.build_data.business.area')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.business.table-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.business.title') / @lang('modules.menu.nav.build_data.business.table')</span>
                    </a>
                </div>
{{--                <div class="search-item">--}}
{{--                    <a class="header-search-item d-flex" data-href="{{route('build_data.business.permission-sales.index')}}">--}}
{{--                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>--}}
{{--                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.business.title') / @lang('modules.menu.nav.build_data.business.permission-sales')</span>--}}
{{--                    </a>--}}
{{--                </div>--}}
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('build_data.business.reasons-cancel-food-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.business.title') / @lang('modules.menu.nav.build_data.business.reasons-cancel-food')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.business.price-temporary.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.business.title') / @lang('modules.menu.nav.build_data.business.price-food')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('build_data.business.price-adjustment-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.business.title') / @lang('modules.menu.nav.build_data.business.price-adjustment')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.business.surcharge-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.business.title') / @lang('modules.menu.nav.build_data.business.surcharge')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.business.price-by-area.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.business.title') / @lang('modules.menu.nav.build_data.business.price-by-area')</span>
                    </a>
                </div>
                <!--Bep-->
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.kitchen.kitchen-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.kitchen.title') / @lang('modules.menu.nav.build_data.kitchen.title')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('build_data.kitchen.assign-kitchen.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.kitchen.title') / @lang('modules.menu.nav.build_data.kitchen.assign-kitchen')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.kitchen.quantitative-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.kitchen.title') / @lang('modules.menu.nav.build_data.kitchen.quantitative')</span>
                    </a>
                </div>
                <!--Thu chi-->
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('build_data.revenue-and-cost.cost-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.cost&revenue.title') / @lang('modules.menu.nav.build_data.cost&revenue.cost')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('build_data.revenue-and-cost.revenue-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.cost&revenue.title') / @lang('modules.menu.nav.build_data.cost&revenue.revenue')</span>
                    </a>
                </div>
            @endif

            <!-- Bán hàng onl -->
{{--            @if(in_array('OWNER', Session::get(SESSION_PERMISSION)) || in_array('WEB_MENU_SALE_CHANNEL', Session::get(SESSION_PERMISSION)))--}}

{{--                <div class="search-item">--}}
{{--                    <a class="header-search-item d-flex" data-href="{{route('sell_online.facebook.facebook.redirect')}}">--}}
{{--                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>--}}
{{--                        <span--}}
{{--                            class="search-name">@lang('modules.menu.nav.sell_online.title') / @lang('modules.menu.nav.sell_online.facebook')</span>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            @endif--}}
            <!-- Thiet lap -->
            @if(in_array('OWNER', Session::get(SESSION_PERMISSION)) || in_array('WEB_MENU_SETTING', Session::get(SESSION_PERMISSION)))
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('setting.restaurant-setting.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.setting.title') / @lang('modules.menu.nav.setting.setting.restaurant')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('setting.brand-setting.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.setting.title') / @lang('modules.menu.nav.setting.setting.brand')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('setting.branch-setting.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.setting.title') / @lang('modules.menu.nav.setting.setting.branch')</span>
                    </a>
                </div>
                {{--
                 <a class="header-search-item d-flex" data-href="{{route('setting.vat-setting.index')}}">--}}
                {{--            <span class="search-icon mr-3"><i class="fi-rr-search"></em></span>--}}
                {{--            <span--}}
                {{--                class="search-name">@lang('modules.menu.nav.setting.title') / @lang('modules.menu.nav.setting.vat')</span>--}}
                {{--
                </a></--}}
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('setting.vat-manage.vat-restaurant.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.setting.title') / @lang('modules.menu.nav.setting.setting.vat_manage') / @lang('modules.menu.nav.setting.setting.choose_VAT_system')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('setting.vat-manage.vat-config.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.setting.title') / @lang('modules.menu.nav.setting.setting.offline') / @lang('modules.menu.nav.setting.setting.setting_VAT')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('setting.offline-setting.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.setting.title') / @lang('modules.menu.nav.setting.setting.offline')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('setting.service-cost-history.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.setting.title') / @lang('modules.menu.nav.setting.setting.service_cost_history')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('setting.partner-invoice.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.setting.title') / @lang('modules.menu.nav.setting.setting.e-invoice')</span>
                    </a>
                </div>
{{--                <div class="search-item">--}}
{{--                    <a class="header-search-item d-flex" data-href="{{route('message.visible-message.index')}}">--}}
{{--                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>--}}
{{--                        <span--}}
{{--                            class="search-name">@lang('modules.menu.nav.setting.title') / @lang('modules.menu.nav.setting.setting.chat')</span>--}}
{{--                    </a>--}}
{{--                </div>--}}
            @endif
            <div id="img-not-found-search" class="d-none w-100" style="text-align: center">
                <img src="{{asset('images/tms/empty.png')}}" alt="empty-image" style="width: 200px">
            </div>

            <div class="search-outstanding">
                <p class="search-total-title">Kết quả tìm kiếm: <span id="total-search"
                                                                      style="font-size: 11px!important">0</span></p>
                <p class="search-outstanding-title font-weight-bold">Chức năng nổi bật</p>
                <div class="row m-0">
                    <div class="search-item">
                        <a class="col-6 d-flex align-items-center search-outstanding-item"
                           data-href="{{route('treasurer.salary-employee-treasurer.index')}}">
                            <span class="search-icon mr-3"><i class="icofont icofont-gears"></i></span>
                            <span class="search-name">@lang('modules.menu.nav.treasurer.salary-employee')</span>
                        </a>
                    </div>
                    <div class="search-item">
                        <a class="col-6 d-flex align-items-center search-outstanding-item"
                           data-href="{{route('treasurer.list-bill-treasurer.index')}}">
                            <span class="search-icon mr-3"><i class="fa fa-wpforms"></i></span>
                            <span class="search-name">@lang('modules.menu.nav.treasurer.list-bill')</span>
                        </a>
                    </div>
                </div>
                <div class="row ml-0 mr-0">
                    <div class="search-item">
                        <a class="col-6 d-flex align-items-center search-outstanding-item"
                           data-href="{{ route('manage.supplier_order.supplier-order.index') }}">
                            <span class="search-icon mr-3"><i class="fa fa-wpforms"></i></span>
                            <span class="search-name">@lang('modules.menu.nav.manage.supplier-order')</span>
                        </a>
                    </div>
                    <div class="search-item">
                        <a class="col-6 d-flex align-items-center search-outstanding-item"
                           data-href="{{route('build_data.food.food-data.index')}}">
                            <span class="search-icon mr-3"><i class="icofont icofont-gears"></i></span>
                            <span class="search-name">@lang('modules.menu.nav.build_data.food.title')
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-search-list" id="search-history" style="background: #ffffff">

        </div>
    </div>
@else
    <div class="seemt-search-item" id="header-search">
        <div class="header-search-list" id="list-search-header">
            <div class="search-item">
                <a class="header-search-item d-flex" data-href="/dashboard-sale-solution">
                    <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                    <span
                        class="search-name">@lang('modules.menu.nav.dashboard.title')</span>
                </a>
            </div>
            @if(in_array('OWNER', Session::get(SESSION_PERMISSION)) || in_array('WEB_MENU_TREASURER', Session::get(SESSION_PERMISSION)))
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('treasurer.payment-bill-treasurer.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.treasurer.title') / @lang('modules.menu.nav.treasurer.payment-bill')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('treasurer.receipts-bill-treasurer.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.treasurer.title') / @lang('modules.menu.nav.treasurer.receipts-bill')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('treasurer.work-history-treasurer.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.treasurer.title') / @lang('modules.menu.nav.treasurer.work-history')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('treasurer.list-bill-treasurer.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.treasurer.title') / @lang('modules.menu.nav.treasurer.list-bill')</span>
                    </a>
                </div>
            @endif
            @if(in_array('OWNER', Session::get(SESSION_PERMISSION)) || in_array('WEB_MENU_MANAGE', Session::get(SESSION_PERMISSION)))
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('manage.food.food-brand-manage.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.manage.title') / @lang('modules.menu.nav.manage.food_menu.title')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('manage.employee.employee-manage.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.manage.title') / @lang('modules.menu.nav.manage.employee.title') / @lang('modules.menu.nav.manage.employee.employee')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('build_data.personnel.permission-employee-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.manage.title') / @lang('modules.menu.nav.manage.employee.title') / @lang('modules.menu.nav.build_data.personnel.permission_employee')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.personnel.role-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.manage.title') / @lang('modules.menu.nav.manage.employee.title') / @lang('modules.menu.nav.build_data.personnel.role')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('manage.booking_table.booking-table-manage.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.manage.title') / @lang('modules.menu.nav.manage.booking_table')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('manage.bill.bill-manage.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.manage.title') / @lang('modules.menu.nav.manage.bill')</span>
                    </a>
                </div>
            @endif
            @if(in_array('OWNER', Session::get(SESSION_PERMISSION)) || in_array('WEB_MENU_REPORT', Session::get(SESSION_PERMISSION)))
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.revenue-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.revenue')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.cost-debt-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.cost-debt')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.sell.category-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.detail_revenue_sell') / Danh mục</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.sell.food-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.detail_revenue_sell') / Món ăn</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.sell.gift-food-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.detail_revenue_sell') / Món tặng</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.sell.discount-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.detail_revenue_sell') / Giảm giá</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.sell.take-away-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.detail_revenue_sell') / Món mang về</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.sell.food-cancel-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.detail_revenue_sell') / Món hủy</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.sell.order-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.detail_revenue_sell') / Đơn hàng</span>
                    </a>
                </div>

                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.profit-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.profit')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.area-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.area')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('report.employee-report.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.report.title') / @lang('modules.menu.nav.report.employee')</span>
                    </a>
                </div>
            @endif
            @if(in_array('OWNER', Session::get(SESSION_PERMISSION)) || in_array('BUILD_RESTAURANT_DATA', Session::get(SESSION_PERMISSION)) || in_array('WEB_MENU_SETUP_DATA', Session::get(SESSION_PERMISSION)))
                <div class="search-item">
                    <a class="header-search-item d-flex" id="123"
                       data-href="{{route('build_data.food.category-food-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.food.title') / @lang('modules.menu.nav.build_data.food.category')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.food.unit-food-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.food.title') / @lang('modules.menu.nav.build_data.food.unit')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.food.food-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.food.title') / @lang('modules.menu.nav.build_data.food.title')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.food.gift-food-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.food.title') / @lang('modules.menu.nav.build_data.food.gift')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.food.note-food-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.food.title') / @lang('modules.menu.nav.build_data.food.note')</span>
                    </a>
                </div>

                <!--Nhan su-->
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.personnel.employee-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.personnel.title') / @lang('modules.menu.nav.build_data.personnel.employee')</span>
                    </a>
                </div>

                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.personnel.shift-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.personnel.title') / @lang('modules.menu.nav.build_data.personnel.shift')</span>
                    </a>
                </div>

                <!--Kinh doanh-->
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.business.area-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.business.title') / @lang('modules.menu.nav.build_data.business.area')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.business.table-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.business.title') / @lang('modules.menu.nav.build_data.business.table')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('build_data.business.permission-sales.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.business.title') / @lang('modules.menu.nav.build_data.business.permission-sales')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('build_data.business.reasons-cancel-food-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.business.title') / @lang('modules.menu.nav.build_data.business.reasons-cancel-food')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.business.price-temporary.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.business.title') / @lang('modules.menu.nav.build_data.business.price-food')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('build_data.business.price-adjustment-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.business.title') / @lang('modules.menu.nav.build_data.business.price-adjustment')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.business.surcharge-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.business.title') / @lang('modules.menu.nav.build_data.business.surcharge')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.business.price-by-area.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.business.title') / @lang('modules.menu.nav.build_data.business.price-by-area')</span>
                    </a>
                </div>
                <!--Bep-->
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('build_data.kitchen.kitchen-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.kitchen.title') / @lang('modules.menu.nav.build_data.kitchen.title')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('build_data.kitchen.quantitative-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.kitchen.title') / @lang('modules.menu.nav.build_data.kitchen.quantitative')</span>
                    </a>
                </div>
                <!--Thu chi-->
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('build_data.revenue-and-cost.cost-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.cost&revenue.title') / @lang('modules.menu.nav.build_data.cost&revenue.cost')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex"
                       data-href="{{route('build_data.revenue-and-cost.revenue-data.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span class="search-name">@lang('modules.menu.nav.build_data.title') / @lang('modules.menu.nav.build_data.cost&revenue.title') / @lang('modules.menu.nav.build_data.cost&revenue.revenue')</span>
                    </a>
                </div>
            @endif
            <!-- Thiet lap -->
            @if(in_array('OWNER', Session::get(SESSION_PERMISSION)) || in_array('WEB_MENU_SETTING', Session::get(SESSION_PERMISSION)))
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('setting.restaurant-setting.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.setting.title') / @lang('modules.menu.nav.setting.setting.restaurant')</span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('setting.vat-manage.vat-restaurant.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.setting.title') / Quản lý VAT / Chọn VAT hệ thống </span>
                    </a>
                </div>
                <div class="search-item">
                    <a class="header-search-item d-flex" data-href="{{route('setting.vat-manage.vat-config.index')}}">
                        <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                        <span
                            class="search-name">@lang('modules.menu.nav.setting.title') / Quản lý VAT / Cấu hình VAT </span>
                    </a>
                </div>
                {{--                <a class="header-search-item d-flex" data-href="{{route('message.visible-message.index')}}">--}}
                {{--                    <span class="search-icon mr-3"><i class="fi-rr-search"></em></span>--}}
                {{--                    <span class="search-name">@lang('modules.menu.nav.setting.title') / @lang('modules.menu.nav.setting.setting.chat')</span>--}}
                {{--
                </a></--}}
            @endif
            <div id="img-not-found-search" class="d-none w-100" style="text-align: center">
                <img src="{{asset('images/tms/empty.png')}}" style="width: 200px">
            </div>
        </div>
                <div class="search-outstanding">
                                        <p class="search-total-title">Kết quả tìm kiếm: <span id="total-search"
                                                                                              style="font-size: 11px!important">0</span></p>
                    <p class="search-outstanding-title font-weight-bold">Chức năng nổi bật</p>
                    <div class="row m-0">
                        <div class="search-item">
                            <a class="col-6 d-flex align-items-center search-outstanding-item"
                               data-href="{{route('treasurer.salary-employee-treasurer.index')}}">
                                <span class="search-icon mr-3"><i class="icofont icofont-gears"></i></span>
                                <span class="search-name">@lang('modules.menu.nav.treasurer.salary-employee')</span>
                            </a>
                        </div>
                        <div class="search-item">
                            <a class="col-6 d-flex align-items-center search-outstanding-item"
                               data-href="{{route('treasurer.list-bill-treasurer.index')}}">
                                <span class="search-icon mr-3"><i class="fa fa-wpforms"></i></span>
                                <span class="search-name">@lang('modules.menu.nav.treasurer.list-bill')</span>
                            </a>
                        </div>
                    </div>
                    <div class="row ml-0 mr-0">
                        <div class="search-item">
                            <a class="col-6 d-flex align-items-center search-outstanding-item"
                               data-href="{{ route('manage.supplier_order.supplier-order.index') }}">
                                <span class="search-icon mr-3"><i class="fa fa-wpforms"></i></span>
                                <span class="search-name">@lang('modules.menu.nav.manage.supplier-order')</span>
                            </a>
                        </div>
                        <div class="search-item">
                            <a class="col-6 d-flex align-items-center search-outstanding-item"
                               data-href="{{route('build_data.food.food-data.index')}}">
                                <span class="search-icon mr-3"><i class="icofont icofont-gears"></i></span>
                                <span class="search-name">@lang('modules.menu.nav.build_data.food.title')
                            </a>
                        </div>
                    </div>
                </div>
        <div class="header-search-list" id="search-history" style="background: #ffffff">

        </div>
    </div>
@endif

@push('scripts')
    <script>
        const heightWindow = window.innerHeight;
        let historyMenu = [];
        let htmlSearchHistory = `<p class="search-outstanding-title font-weight-bold" style="padding: 20px 20px 10px 20px">Lịch sử truy cập</p>`;
        let keyCodeSearch = $('#header-search .header-search-list').html();
        let total_sum = $('#header-search .header-search-list .header-search-item').length;
        $('#total-search').text(total_sum);
        let active_nav = '<?php Print($active_nav) ?>'
        $(function () {
            if (getCookieShared('search-history-user-id-' + idSession)) {
                let dataCookie = JSON.parse(getCookieShared('search-history-user-id-' + idSession));
                historyMenu = dataCookie.search_history;
                if (historyMenu.length > 0) {
                    historyMenu.map(item => {
                        htmlSearchHistory += `<div class="search-item history">
                                                 <a class="header-search-item d-flex" href="${item.href}">
                                                    <span class="search-icon mr-3"><i class="fi-rr-search"></i></span>
                                                    <span class="search-name">${item.name}</span>
                                                </a>
                                              </div>`
                    });
                    $('#search-history').html(htmlSearchHistory);
                    $('.search-outstanding').first().addClass('d-none');
                }
            }

            // if(getCookieShared('menu-active-' + idSession)){
            //     let dataCookie = JSON.parse(getCookieShared('menu-active-' + idSession));
            //     let class_active = dataCookie.class_active;
            //
            $('.seemt-menu-item').removeClass('active')
            if(window.location.pathname != '/'){
                if(window.location.pathname === '/dashboard-sale-solution') {
                    $('.seemt-menu-left a[href="'+ window.location.origin + '/' + 'branch-dashboard"]').parent().addClass('active');
                    $('.seemt-menu-left a[href="'+ window.location.origin + '/' + 'branch-dashboard"]').parents('.seemt-menu-item').addClass('active');
                    $('.seemt-menu-left a[href="'+ window.location.origin + '/' + 'branch-dashboard"]').parent().parents('.seemt-menu-sub-item').addClass('active')
                    $('.seemt-menu-left a[href="'+ window.location.origin + '/' + 'branch-dashboard"]').parents('.seemt-menu-item').find('path').attr('fill', '#e96012');
                    return false;
                }
                $('.seemt-menu-left a[href="'+ window.location.href +'"]').parent().addClass('active');
                $('.seemt-menu-left a[href="'+ window.location.href +'"]').parents('.seemt-menu-item').addClass('active');
                $('.seemt-menu-left a[href="'+ window.location.href +'"]').parent().parents('.seemt-menu-sub-item').addClass('active')
                $('.seemt-menu-left a[href="'+ window.location.href +'"]').parents('.seemt-menu-item').find('path').attr('fill', '#e96012');
                }else {
                    $('.seemt-menu-left a[href="'+ window.location.origin +'"]').parent().addClass('active');

                }
            // }

            //popup trợ giúp
            $('.help').on('click', function () {
                $('.help-ul').toggleClass('d-none')
            })

            $('.seemt-main').on('click', function () {
                $('.help-ul').addClass('d-none')
            })

            $(".search-item").mousedown(function(e) {
                if (e.button === 0) {
                    window.location.href = $(this).find('a').data('href');
                }
            });

            $(document).on('submit', '#new_header .top-search form', function (e) {
                e.preventDefault();
            })
            $(document).on('click', '.seemt-menu-left a', function (e) {
                saveCookieShared('menu-active-' + idSession, JSON.stringify({
                    class_active : $(this).attr('href')
                }))
            })
            $(document).on('click', '#fi-rr-layout-fluid', function (e) {
                saveCookieShared('tab-active-' + idSession, JSON.stringify({
                    class_active : 'fi-rr-layout-fluid'
                }))
            })

            $(document).on('focus', '#new_header .top-search form input', function () {
                $('#new_header .top-search form input').css({
                    'border-radius': '20px 20px 0 0',
                    'background': '#ffffffd9',
                    'color': '#111111',
                    'font-weight': '500'
                });
                $('#new_header .top-search form input').addClass('placeholder-input-header');
                $('#new_header .top-search form button i').css('color', '#000000');
                openSearchBox();
            })

            $(document).on('blur', '#new_header .top-search form input', function () {
                $(this).css('color', 'red');
                $('#new_header .top-search form input').css({
                    'border-radius': '33px',
                    'background': 'rgba(255,255,255,0.1)',
                    'color': '#ffffff'
                });
                $('#new_header .top-search form input').removeClass('placeholder-input-header');
                $('#new_header .top-search form button i').css('color', '#b6b6b6');
                closeSearchBox();
            })

            $(document).on('keydown', '#new_header .top-search form input', function (e) {
                switch (e.keyCode) {
                    case 13: //enter
                        $('.header-search-item.active')[0].click()
                        break;
                    case 38: //up
                        $("#list-search-header .header-search-item").addClass('normal')
                        $("#list-search-header .header-search-item.active").prev('.header-search-item:not(.d-none)').addClass('active');
                        $("#list-search-header .header-search-item.active").next('.header-search-item:not(.d-none)').removeClass('active');
                        if (isInViewport(document.querySelector('.header-search-item.active'))) {
                            document.querySelector('.header-search-item.active').scrollIntoView({
                                behavior: "smooth",
                                block: "start"
                            })
                        }
                        $('#list-search-header .header-search-item').addClass('no-mouse');
                        break;
                    case 40: //down
                        $("#list-search-header .header-search-item").addClass('normal')
                        $("#list-search-header .header-search-item.active").next('.header-search-item:not(.d-none)').addClass('active');
                        $("#list-search-header .header-search-item.active").prev('.header-search-item:not(.d-none)').removeClass('active');
                        if (isInViewport(document.querySelector('.header-search-item.active'))) {
                            document.querySelector('.header-search-item.active').scrollIntoView({
                                behavior: "smooth",
                                block: "end"
                            })
                        }
                        $('#list-search-header .header-search-item').addClass('no-mouse');
                        break;
                    default:
                        $('#list-search-header').html(keyCodeSearch);
                        const value = $(this).val();
                        $("#list-search-header .search-name").each(function () {
                            if (value === '') {
                                $('#list-search-header').html(keyCodeSearch);
                            } else if (removeVietnameseStringLowerCase($(this).text()).indexOf(removeVietnameseStringLowerCase(value)) === -1) {
                                $(this).parents('a').remove();
                            }
                        })
                        if ($('#list-search-header .header-search-item').length === 0) {
                            $('#img-not-found-search').removeClass('d-none')
                        } else {
                            $('#img-not-found-search').addClass('d-none')
                        }

                        $("#list-search-header .header-search-item").removeClass('active');
                        $("#list-search-header .header-search-item").siblings().not('.d-none').first().addClass('active');
                        $('#total-search').text($('#header-search .header-search-list .header-search-item').length);
                }
            })

            // Sự kiện chuột khi hover vào
            $(document).on('mouseover', '#list-search-header .header-search-item', function () {
                $('#list-search-header .header-search-item').removeClass('active');
                $(this).addClass('active');
            })

            $(document).on('mousemove', '#list-search-header', function () {
                $('#list-search-header .header-search-item').removeClass('no-mouse')
            });

            // End sự kiện chuột

            if (historyMenu.findIndex(x => x.name == active_nav) !== -1) {
                historyMenu = historyMenu.filter(item => item.name !== active_nav);
                historyMenu.unshift({
                    'name': active_nav,
                    'href': window.location.pathname,
                });
            } else if (historyMenu.length > 3) {
                historyMenu.pop();
                historyMenu.unshift({
                    'name': active_nav,
                    'href': window.location.pathname,
                });
            } else {
                historyMenu.unshift({
                    'name': active_nav,
                    'href': window.location.pathname,
                });
            }
            updateCookieHistorySearch()
            // Đóng gợi ý search khi click ra ngoài
            $('#seemt-menu-left-mini .seemt-menu-item').hover(function () {
                $('#search-input-seemt').parents('.seemt-search').removeClass('active')
            })
        })

        function checkHistory() {
            if ($('#search-history .search-item').length === 0) {
                $(this).addClass('d-none')
            }else {
                $(this).removeClass('d-none')
            }
        }

        function updateCookieHistorySearch() {
            saveCookieShared('search-history-user-id-' + idSession, JSON.stringify({
                'search_history': historyMenu
            }))
        }

        function openSearchBox() {
            $("#header-search").css('transform', 'scaleY(1)');
            $("#header-search").slideDown(300);
            $('#list-search-header .header-search-item').removeClass('active');
            $('#list-search-header .header-search-item:first-child').addClass('active');
        }

        function closeSearchBox() {
            $("#header-search").slideUp(300)
        }

        function isInViewport(element) {
            const rect = element.getBoundingClientRect();
            return rect.bottom > 300 || rect.top < 56;
        }
    </script>
@endpush
