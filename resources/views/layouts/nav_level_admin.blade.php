<nav id="nav-header-menu">
    <ul class="nav-list" style="display: block">
        @if(in_array('OWNER', Session::get(SESSION_PERMISSION)) || in_array('WEB_MENU_SUMMARY', Session::get(SESSION_PERMISSION)))
            <li>
                <a href="javascript:void(0)"><em
                        class="fa fa-home"></em> @lang('modules.menu.nav.dashboard.title')</a>
                <ul>
                    @if(Session::get(SESSION_KEY_LEVEL) > 3)
                        <li><a href="/">@lang('modules.menu.nav.dashboard.index')</a></li>
                    @endif
                    <li>
                        <a href="{{route('dashboard.branch-dashboard.index')}}">@lang('modules.menu.nav.dashboard.branch')</a>
                    </li>
                </ul>
            </li>
        @endif
        @if(in_array('OWNER', Session::get(SESSION_PERMISSION)) || in_array('WEB_MENU_TREASURER', Session::get(SESSION_PERMISSION)))
            <li><a href="javascript:void(0)"><em
                        class="fa fa-wpforms"></em> @lang('modules.menu.nav.treasurer.title')</a>
                <ul>
                    <li><a href="javascript:void(0)"
                        >Nhà cung cấp<em class="fa fa-caret-right"></em></a>
                        <ul>
                            <li><a href="{{route('treasurer.order-bill-treasurer.index')}}"
                                >@lang('modules.menu.nav.treasurer.order-bill')</a>
                            </li>
                            <li><a href="{{route('treasurer.supplier-payment-debt-treasurer.index')}}"
                                >@lang('modules.menu.nav.treasurer.supplier-payment-debt')</a>
                            </li>
                        </ul>
                    </li>
{{--                    <li><a href="{{route('treasurer.supplier-payment-debt-treasurer.index')}}"--}}
{{--                        >@lang('modules.menu.nav.treasurer.supplier-payment-debt')</a>--}}
{{--                    </li>--}}
                    <li><a href="javascript:void(0)"
                        >Quỹ<em class="fa fa-caret-right"></em></a>
                        <ul>
                            <li><a href="{{route('treasurer.cash-book-treasurer.index')}}"
                                >@lang('modules.menu.nav.treasurer.cash-book')</a>
                            </li>
                            <li><a href="{{route('treasurer.fund-period-treasurer.index')}}"
                                >@lang('modules.menu.nav.treasurer.fund-period')</a>
                            </li>
                            <li><a href="{{route('treasurer.cash-fund-treasurer.index')}}"
                                >@lang('modules.menu.nav.treasurer.cash-fund')</a>
                            </li>
                        </ul>
                    </li>
{{--                    <li><a href="{{route('treasurer.fund-period-treasurer.index')}}"--}}
{{--                        >@lang('modules.menu.nav.treasurer.fund-period')</a>--}}
{{--                    </li>--}}
{{--                    <li><a href="{{route('treasurer.cash-fund-treasurer.index')}}"--}}
{{--                        >@lang('modules.menu.nav.treasurer.cash-fund')</a>--}}
{{--                    </li>--}}
                    <li><a href="javascript:void(0)"
                        >Thu Chi<em class="fa fa-caret-right"></em></a>
                        <ul>
                            <li><a href="{{route('treasurer.payment-bill-treasurer.index')}}"
                                >@lang('modules.menu.nav.treasurer.payment-bill')</a>
                            </li>
                            <li><a href="{{route('treasurer.receipts-bill-treasurer.index')}}"
                                >@lang('modules.menu.nav.treasurer.receipts-bill')</a>
                            </li>
                            @if(Session::get(SESSION_KEY_LEVEL) > 5)
                                <li><a href="{{route('treasurer.payment-recurring-bill-treasurer.index')}}"
                                    >@lang('modules.menu.nav.treasurer.payment-recurring-bill')</a>
                                </li>
                            @endif
                        </ul>
                    </li>

{{--                    <li><a href="{{route('treasurer.receipts-bill-treasurer.index')}}"--}}
{{--                        >@lang('modules.menu.nav.treasurer.receipts-bill')</a>--}}
{{--                    </li>--}}
                    @if(Session::get(SESSION_KEY_LEVEL) >= 5)
                        <li><a href="javascript:void(0)"
                            >Lương<em class="fa fa-caret-right"></em></a>
                            <ul>
                                <li><a href="{{route('treasurer.salary-employee-treasurer.index')}}"
                                    >@lang('modules.menu.nav.treasurer.salary-employee')</a>
                                </li>
                                <li><a href="{{route('treasurer.advance-salary-employee.index')}}"
                                    >@lang('modules.menu.nav.treasurer.advance-salary-employee')</a>
                                </li>
                                <li><a href="{{route('treasurer.employee-bonus-punish.index')}}"
                                    >@lang('modules.menu.nav.treasurer.employee-bonus-punish')</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    <li><a href="javascript:void(0)"
                        >Thu ngân<em class="fa fa-caret-right"></em></a>
                        <ul>
                            <li><a href="{{route('treasurer.work-history-treasurer.index')}}"
                                >@lang('modules.menu.nav.treasurer.work-history')</a>
                            </li>
                            <li><a href="{{route('treasurer.list-bill-treasurer.index')}}"
                                >@lang('modules.menu.nav.treasurer.list-bill')</a>
                            </li>
                        </ul>
                    </li>
{{--                    <li><a href="{{route('treasurer.list-bill-treasurer.index')}}"--}}
{{--                        >@lang('modules.menu.nav.treasurer.list-bill')</a>--}}
{{--                    </li>--}}
                </ul>
            </li>
        @endif
        @if(in_array('OWNER', Session::get(SESSION_PERMISSION)) || in_array('WEB_MENU_MANAGE', Session::get(SESSION_PERMISSION)))
            <li>
                <a href="javascript:void(0)">
                    <em class="fa fa-cubes"></em> @lang('modules.menu.nav.manage.title')
                </a>
                <ul>
                    <li><a href="javascript:void(0)">@lang('modules.menu.nav.manage.inventory_manage.title') <em
                                class="fa fa-caret-right"></em></a>
                        <ul>
                            <li><a href="{{ route('manage.supplier_order.supplier-order.index') }}">
                                    @lang('modules.menu.nav.manage.supplier-order')</a>
                            </li>
                            {{--                                        <li><a href="javascript:void(0)"--}}
                            {{--                                            >@lang('modules.menu.nav.manage.inventory_manage.title-warehouse')<em--}}
                            {{--                                                    class="fa fa-caret-right"></em></a>--}}
                            {{--                                            <ul>--}}
                            {{--                                                <li>--}}
                            {{--                                                    <a href="{{ route('manage.warehouse.supplier-order-warehouse.index')  }}">Mua hàng NCC</a>--}}
                            {{--                                                </li>--}}
                            {{--                                                <li>--}}
                            {{--                                                    <a href="{{ route('manage.warehouse.warehouse-manage.index')  }}">Gán kho chi nhánh</a>--}}
                            {{--                                                </li>--}}
                            {{--                                                <li>--}}
                            {{--                                                    <a href="{{route('manage.warehouse.in-inventory-warehouse.index')}}">Nhập kho</a>--}}
                            {{--                                                </li>--}}
                            {{--                                                <li>--}}
                            {{--                                                    <a href="{{route('manage.warehouse.out-inventory-warehouse.index')}}">Xuất kho</a>--}}
                            {{--                                                </li>--}}
                            {{--                                            </ul>--}}
                            {{--                                        </li>--}}
                            <li><a href="javascript:void(0)"
                                >@lang('modules.menu.nav.manage.inventory_manage.title-branch')<em
                                        class="fa fa-caret-right"></em></a>
                                <ul>

                                    <li><a href="{{route('manage.inventory.in-inventory-manage.index')}}"
                                        >@lang('modules.menu.nav.manage.inventory.in-inventory')</a>
                                    </li>

                                    <li><a href="{{route('manage.inventory.out-inventory-manage.index')}}"
                                        >@lang('modules.menu.nav.manage.inventory.out-inventory')</a>
                                    </li>
                                    <li><a href="{{route('manage.inventory.checklist-goods-manage.index')}}"
                                        >@lang('modules.menu.nav.manage.inventory.checklist-goods')</a>
                                    </li>
                                    <li><a href="{{route('manage.inventory.cancel-inventory-manage.index')}}"
                                        >@lang('modules.menu.nav.manage.inventory.cancel-inventory')</a>
                                    </li>
                                    <li><a href="{{route('manage.inventory.in-inventory-branch-manage.index')}}"
                                        >@lang('modules.menu.nav.manage.inventory.in-inventory-branch')</a>
                                    </li>
                                    <li>
                                        <a href="{{route('manage.inventory.out-inventory-branch-manage.index')}}"
                                        >@lang('modules.menu.nav.manage.inventory.out-inventory-branch')</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)"
                                >@lang('modules.menu.nav.manage.inventory_manage.title-internal')<em
                                        class="fa fa-caret-right"></em></a>
                                <ul>
                                    <li>
                                        <a href="{{route('manage.inventory_internal.in-inventory-internal-manage.index')}}"
                                        >@lang('modules.menu.nav.manage.inventory_internal.in-inventory-internal')</a>
                                    </li>
                                    <li>
                                        <a href="{{route('manage.inventory.checklist-goods-internal-manage.index')}}"
                                        >@lang('modules.menu.nav.manage.inventory_internal.checklist-goods-internal')</a>
                                    </li>
                                    <li>
                                        <a href="{{route('manage.inventory_internal.return-inventory-internal-manage.index')}}"
                                        >@lang('modules.menu.nav.manage.inventory_internal.return-inventory-internal')</a>
                                    </li>
                                    <li>
                                        <a href="{{route('manage.inventory_internal.cancel-inventory-internal-manage.index')}}"
                                        >@lang('modules.menu.nav.manage.inventory_internal.cancel-inventory-internal')</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)"
                        >@lang('modules.menu.nav.manage.employee.title')<em class="fa fa-caret-right"></em></a>
                        <ul>
                            <li><a href="{{route('manage.employee.employee-manage.index')}}"
                                >@lang('modules.menu.nav.manage.employee.employee')</a>
                            </li>
                            @if(Session::get(SESSION_KEY_LEVEL) >= 5)
                                <li><a href="{{route('manage.employee_off.employee-off-manage.index')}}">
                                        @lang('modules.menu.nav.manage.employee.employee-off')</a>
                                </li>
                                <li><a href="{{route('manage.time_keeping.time-keeping-manage.index')}}"
                                    >@lang('modules.menu.nav.manage.employee.time_keeping')</a>
                                </li>
                            @endif
                            <li><a href="{{route('build_data.personnel.permission-employee-data.index')}}">
                                    @lang('modules.menu.nav.build_data.personnel.permission_employee')</a>
                            </li>
                            <li><a href="{{route('build_data.personnel.role-data.index')}}">
                                    @lang('modules.menu.nav.build_data.personnel.role')</a>
                            </li>
                            <li><a href="{{route('build_data.business.permission-sales.index')}}">
                                    @lang('modules.menu.nav.build_data.business.permission-sales')</a>
                            </li>
                            <li><a href="{{route('build_data.kitchen.permission-kitchen.index')}}">
                                    @lang('modules.menu.nav.build_data.kitchen.permission-kitchen')</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="{{route('manage.food.food-brand-manage.index')}}"
                        >@lang('modules.menu.nav.manage.food_menu.title')</a>
                    </li>
                    <li><a href="{{route('manage.area_price.price-by-area-manage.index')}}"
                        >@lang('modules.menu.nav.manage.area_price.title')</a>
                    </li>
                    <li><a href="{{route('manage.booking_table.booking-table-manage.index')}}"
                        >@lang('modules.menu.nav.manage.booking_table')</a>
                    </li>
                    <!-- Thêm phân quyền Giải pháp bán hàng -->
                    <li><a href="{{route('manage.supplier.supplier-manage.index')}}"
                        >@lang('modules.menu.nav.manage.supplier')</a>
                    </li>
                    <li><a href="{{route('manage.bill.bill-manage.index')}}"
                        >@lang('modules.menu.nav.manage.bill')</a>
                    </li>
                    @if(Session::get(SESSION_KEY_LEVEL) >= 5)
                        <li><a href="{{route('manage.payroll.payroll-manage.index')}}"
                            >@lang('modules.menu.nav.manage.payroll')</a>
                        </li>
                        @endif
                    <li><a href="{{route('manage.e_invoice.e-invoice-manage.index')}}"
                        >@lang('modules.menu.nav.manage.e_invoice.title')</a>
                    </li>
                </ul>
            </li>
        @endif
        @if(in_array('OWNER', Session::get(SESSION_PERMISSION)) || in_array('WEB_MENU_REPORT', Session::get(SESSION_PERMISSION)))
        <li> <a href="javascript:void(0)"><em
                    class="fa fa-line-chart"></em> @lang('modules.menu.nav.report.title')</a>
            <ul>
                {{-- Doanh thu bán hàng --}}
                <li>
                    <a href="javascript:void(0)">Doanh thu bán hàng<em class="fa fa-caret-right"></em></a>
                    <ul>
                        <li><a href="{{route('report.sell-order-report.index')}}">Theo thời gian</a>
                        </li>
                        <li><a href="{{route('report.area-report.index')}}"
                            >Theo khu vực</a>
                        </li>
                        <li><a href="{{route('report.employee-report.index')}}"
                            >Theo nhân viên</a>
                        </li>
                    </ul>
                </li>
            {{-- Chi tiết DT bán hàng --}}
                <li>
                    <a href="javascript:void(0)">Chi tiết DT bán hàng<em class="fa fa-caret-right"></em></a>
                    <ul>
                        <li><a href="{{ route('report.detail-revenue-sell.index') }}">Tổng quan</a>
                        </li>
                        <li><a href="{{route('report.sell.food-report.index')}}"
                            >Món ăn</a>
                        </li>
                        <li><a href="{{route('report.sell.category-report.index')}}"
                            >Danh mục</a>
                        </li>
                        <li><a href="{{route('report.sell.gift-food-report.index')}}"
                            >Món tặng</a>
                        </li>
                        <li class="disabled"><a href=""
                            >Ngoài menu</a>
                        </li>
                        <li><a href="{{route('report.sell.food-cancel-report.index')}}"
                            >Món hủy</a>
                        </li>
                        <li><a href="{{route('report.sell.take-away-report.index')}}"
                            >Món mang về</a>
                        </li>
                        <li class="disabled"><a href=""
                            >VAT</a>
                        </li>

                        <li><a href="{{route('report.sell.discount-report.index')}}"
                            >Giảm giá</a>
                        </li>
                        <li class="disabled"><a href=""
                            >Phụ thu</a>
                        </li>
                        <li class="disabled"><a href=""
                            >Điểm</a>
                        </li>
                        <li><a href="{{route('report.sell.order-report.index')}}"
                            >Hoá đơn</a>
                        </li>
                    </ul>
                </li>
            {{-- Doanh thu tổng --}}
                <li><a href="{{route('report.revenue-report.index')}}"
                    >Doanh thu tổng</a>
                </li>
            {{-- Chi phí --}}
                <li><a href="{{route('report.cost-report.index')}}"
                    >@lang('modules.menu.nav.report.cost')</a>
                </li>
            {{-- Nhà cung cấp --}}
                <li>
                    <a href="javascript:void(0)">Nhà cung cấp<em class="fa fa-caret-right"></em></a>
                    <ul>
                        <li><a href="{{route('report.inventory-supplier-report.index')}}"
                            >Mua hàng</a>
                        </li>
                        <li><a href="{{route('report.price-change-histories.index')}}"
                            >Điều chỉnh giá</a>
                        </li>
                    </ul>
                </li>
            {{-- Kho --}}
                <li>
                    <a href="javascript:void(0)">Kho<em class="fa fa-caret-right"></em></a>
                    <ul>
                        <li>
                            <a href="javascript:void(0)">Kho chi nhánh<em class="fa fa-caret-right"></em></a>
                            <ul>
                                <li><a href="{{route('report.material-report.index')}}"
                                    >Nhập xuất</a>
                                </li>
                                <li><a href="{{route('report.inventory-report.index')}}"
                                    >Kiểm kê</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Kho bộ phận<em class="fa fa-caret-right"></em></a>
                            <ul>
                                <li><a href="{{route('report.material-internal-report.index')}}"
                                    >Nhập xuất</a>
                                </li>
                                <li><a href="{{route('report.inventory-internal-report.index')}}"
                                    >Kiểm kê</a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="{{route('report.material-food-report.index')}}"
                            >Định lượng</a>
                        </li>
                    </ul>
                </li>
{{--                    <li><a href="{{route('report.debt-report.index')}}"--}}
{{--                        >@lang('modules.menu.nav.report.debt')</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="{{route('report.profit-report.index')}}">--}}
{{--                            @lang('modules.menu.nav.report.profit')</a>--}}
{{--                    </li>--}}
{{--                    <li><a href="{{route('report.detail-money-report.index')}}"--}}
{{--                        >@lang('modules.menu.nav.report.detail_money')</a>--}}
{{--                    </li>--}}
{{--                    <li><a href="{{route('report.business-results-report.index')}}"--}}
{{--                        >@lang('modules.menu.nav.report.business_results')</a>--}}
{{--                    </li>--}}
                </ul>
            </li>
        @endif
        @if(Session::get(SESSION_KEY_LEVEL) > 5 && in_array('OWNER', Session::get(SESSION_PERMISSION)) || in_array('WEB_MENU_ALOLINE', Session::get(SESSION_PERMISSION)))
            <li>
                <a href="javascript:void(0)"><em
                        class="fa fa-group"></em> @lang('modules.menu.nav.customer.title')</a>
                <ul>
                    <li><a href="javascript:void(0)"
                        >@lang('modules.menu.nav.customer.report.title')<em class="fa fa-caret-right"></em> </a>
                        <ul>
                            <li><a href="{{route('customer.new-customer-report.index')}}"
                                >@lang('modules.menu.nav.customer.report.new-customer-report')</a>
                            </li>
                            <li><a href="{{route('customer.history-point-report.index')}}"
                                >@lang('modules.menu.nav.customer.report.history-point-report')</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="{{route('customer.restaurant-membership-card.index')}}"
                        >@lang('modules.menu.nav.customer.restaurant-membership-card')</a>
                    </li>
                    <li><a href="{{route('customer.customers.index')}}"
                        >@lang('modules.menu.nav.customer.customers')</a>
                    </li>
                    <li><a href="{{route('customer.card-value.index')}}"
                        >@lang('modules.menu.nav.customer.card-value')</a>
                    </li>
                    <li><a href="{{route('customer.cards.index')}}"
                        >@lang('modules.menu.nav.customer.cards')</a>
                    </li>
                    {{--                            <li><a href="{{route('customer.discount.index')}}"--}}
                    {{--                                >@lang('modules.menu.nav.customer.discount')</a>--}}
                    {{--                            </li>--}}
                    <li><a href="javascript:void(0)"
                        >@lang('modules.menu.nav.customer.take-away.title')<em
                                class="fa fa-caret-right"></em></a>
                        <ul>
                            <li><a href="{{route('customer.takeaway.take-away-brand.index')}}"
                                >@lang('modules.menu.nav.customer.take-away.brand')</a>
                            </li>
                            <li><a href="{{route('customer.takeaway.take-away-branch.index')}}"
                                >@lang('modules.menu.nav.customer.take-away.branch')</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="{{route('customer.bestselling-food-customer.index')}}"
                        >@lang('modules.menu.nav.customer.bestselling-food')</a>
                    </li>
                    <li><a href="{{route('customer.booking-food-customer.index')}}"
                        >@lang('modules.menu.nav.customer.booking-food')</a>
                    </li>
                    <li><a href="{{route('customer.assign-customer.index')}}"
                        >@lang('modules.menu.nav.customer.assign-customer')</a>
                    </li>
                    <li><a href="{{route('customer.card-tag.index')}}"
                        >@lang('modules.menu.nav.customer.card-tag')</a>
                    </li>
                </ul>
            </li>
        @endif
        @if(Session::get(SESSION_KEY_LEVEL) > 5 && in_array('OWNER', Session::get(SESSION_PERMISSION)) || in_array('WEB_MENU_MARKETING', Session::get(SESSION_PERMISSION)))
            <li>
                <a href="javascript:void(0)"><em
                        class="fa fa-paint-brush"></em> @lang('modules.menu.nav.marketing.title')</a>
                <ul>
                    <li><a href="{{route('marketing.campaign-marketing.index')}}"
                        >@lang('modules.menu.nav.marketing.campaign')</a>
                    </li>
                    <li><a href="{{route('marketing.media-restaurant-marketing.index')}}"
                        >@lang('modules.menu.nav.marketing.media-restaurant')</a>
                    </li>
                    <li><a href="javascript:void(0)"
                        >@lang('modules.menu.nav.marketing.gift.title')<em class="fa fa-caret-right"></em></a>
                        <ul>
                            <li><a href="{{route('marketing.gift.gift-marketing.index')}}"
                                >@lang('modules.menu.nav.marketing.gift.gift')</a>
                            </li>
                            {{--                                                <li><a href="{{route('marketing.promotion.promotion.index')}}"--}}
                            {{--                                                    >@lang('modules.menu.nav.marketing.promotion')</a>--}}
                            {{--                                                </li>--}}
                            <li><a href="{{route('marketing.gift.new-customer-gift.index')}}"
                                >@lang('modules.menu.nav.marketing.gift.gift-full-text')</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        @endif
        @if(in_array('OWNER', Session::get(SESSION_PERMISSION)) || in_array('VIEW_ALL', Session::get(SESSION_PERMISSION)) || in_array('BUILD_RESTAURANT_DATA', Session::get(SESSION_PERMISSION)) || in_array('WEB_MENU_SETUP_DATA', Session::get(SESSION_PERMISSION)))
        <li>
            <a href="javascript:void(0)"><em class="fa fa-cloud-upload"></em> @lang('modules.menu.nav.build_data.title')</a>
            <ul>
                @if(Session::get(SESSION_KEY_LEVEL) > 3)
                    <li><a href="javascript:void(0)">
                            @lang('modules.menu.nav.build_data.list-supplier.title')<em
                                class="fa fa-caret-right"></em></a>
                        <ul>
                            <li><a href="{{route('build_data.supplier.list-supplier-data.index')}}">
                                    @lang('modules.menu.nav.build_data.list-supplier.list-supplier-data')</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">@lang('modules.menu.nav.build_data.list-supplier.system-supplier')
                                    <em
                                        class="fa fa-caret-right"></em></a>
                                {{--                                            <a href="{{route('build_data.supplier.supplier-material-data.index')}}">--}}
                                {{--                                                @lang('modules.menu.nav.build_data.list-supplier.material-supplier-data')</a>--}}
                                <ul style="width: 205px;">
                                    <li>
                                        <a style="white-space: normal" href="{{route('build_data.assign-supplier.restaurant-assign-supplier-data.index')}}">
                                            @lang('modules.menu.nav.build_data.assign-supplier.title_sub_menu_one')</a>
                                    </li>
                                    <li>
                                        <a style="white-space: normal" href="{{route('build_data.assign_supplier_material.restaurant-material-data.index')}}">
                                            @lang('modules.menu.nav.build_data.assign-material-supplier.title_sub_menu_one')</a>
                                    </li>
                                    <li>
                                        <a href="{{route('build_data.assign_supplier_material.brand-material-data.index')}}">
                                            @lang('modules.menu.nav.build_data.assign-material-supplier.title_sub_menu_two')</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    {{--                                <li><a href="javascript:void(0)">--}}
                    {{--                                        @lang('modules.menu.nav.build_data.assign-supplier.title')<em--}}
                    {{--                                            class="fa fa-caret-right"></em></a>--}}
                    {{--                                    <ul>--}}
                    {{--                                        <li>--}}
                    {{--                                            <a href="{{route('build_data.assign-supplier.restaurant-assign-supplier-data.index')}}">--}}
                    {{--                                                @lang('modules.menu.nav.build_data.assign-supplier.title_sub_menu_one')</a>--}}
                    {{--                                        </li>--}}
                    {{--                                        <li>--}}
                    {{--                                            <a href="{{route('build_data.assign-supplier.brand-assign-supplier-data.index')}}">--}}
                    {{--                                                @lang('modules.menu.nav.build_data.assign-supplier.title_sub_menu_two')</a>--}}
                    {{--                                        </li>--}}
                    {{--                                        --}}{{--                                    <li>--}}
                    {{--                                        --}}{{--                                        <a href="{{route('build_data.assign-supplier.branch-assign-supplier-data.index')}}">--}}
                    {{--                                        --}}{{--                                            @lang('modules.menu.nav.build_data.assign-supplier.title_sub_menu_three')</a>--}}
                    {{--                                        --}}{{--                                    </li>--}}
                    {{--                                    </ul>--}}
                    {{--                                </li>--}}
                    {{--                                <li>--}}
                    {{--                                    <a href="javascript:void(0)">--}}
                    {{--                                        @lang('modules.menu.nav.build_data.assign-material-supplier.title')<em--}}
                    {{--                                            class="fa fa-caret-right"></em></a>--}}
                    {{--                                    <ul>--}}
                    {{--                                        <li>--}}
                    {{--                                            <a href="{{route('build_data.assign_supplier_material.restaurant-material-data.index')}}">--}}
                    {{--                                                @lang('modules.menu.nav.build_data.assign-material-supplier.title_sub_menu_one')</a>--}}
                    {{--                                        </li>--}}
                    {{--                                        <li>--}}
                    {{--                                            <a href="{{route('build_data.assign_supplier_material.brand-material-data.index')}}">--}}
                    {{--                                                @lang('modules.menu.nav.build_data.assign-material-supplier.title_sub_menu_two')</a>--}}
                    {{--                                        </li>--}}
                    {{--                                        --}}{{--                                    <li>--}}
                    {{--                                        --}}{{--                                        <a href="{{route('build_data.assign_supplier_material.branch-material-data.index')}}">--}}
                    {{--                                        --}}{{--                                            @lang('modules.menu.nav.build_data.assign-material-supplier.title_sub_menu_three')</a>--}}
                    {{--                                        --}}{{--                                    </li>--}}
                    {{--                                    </ul>--}}
                    {{--                                </li>--}}
                    <li>
                        <a href="javascript:void(0)">
                            @lang('modules.menu.nav.build_data.material.title')<em
                                class="fa fa-caret-right"></em></a>
                        <ul>
                            <li><a href="{{route('build_data.material.specifications-data.index')}}">
                                    @lang('modules.menu.nav.build_data.material.specifications')</a>
                            </li>
                            <li><a href="{{route('build_data.material.unit-data.index')}}">
                                    @lang('modules.menu.nav.build_data.material.unit')</a>
                            </li>
                            <li><a href="{{route('build_data.material.material-data.index')}}">
                                    @lang('modules.menu.nav.build_data.material.title')</a>
                            </li>
                            {{--                                    <li><a href="{{route('build_data.material.inventory-material.index')}}">--}}
                            {{--                                            @lang('modules.menu.nav.build_data.material.inventory')</a>--}}
                            {{--                                    </li>--}}
                        </ul>
                    </li>
                @endif
                <li>
                    <a href="javascript:void(0)">
                        @lang('modules.menu.nav.build_data.food.title')<em
                            class="fa fa-caret-right"></em></a>
                    <ul>
                        <li><a href="{{route('build_data.food.category-food-data.index')}}">
                                @lang('modules.menu.nav.build_data.food.category')</a>
                        </li>
                        <li><a href="{{route('build_data.food.unit-food-data.index')}}">
                                @lang('modules.menu.nav.build_data.food.unit')</a>
                        </li>
                        <li><a href="{{route('build_data.food.food-data.index')}}">
                                @lang('modules.menu.nav.build_data.food.title')</a>
                        </li>
                        <li><a href="{{route('build_data.food.gift-food-data.index')}}">
                                @lang('modules.menu.nav.build_data.food.gift')</a>
                        </li>
                        <li><a href="{{route('build_data.food.note-food-data.index')}}">
                                @lang('modules.menu.nav.build_data.food.note')</a>
                        </li>
                        @if(Session::get(SESSION_KEY_LEVEL) > 5)
                            <li><a href="{{route('build_data.food.warning-price-food.index')}}">
                                    @lang('modules.menu.nav.build_data.food.warning-price')</a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        @lang('modules.menu.nav.build_data.personnel.title')<em
                            class="fa fa-caret-right"></em></a>
                    <ul>
                        <li><a href="{{route('build_data.personnel.employee-data.index')}}">
                                @lang('modules.menu.nav.build_data.personnel.employee')</a>
                        </li>
                        {{--                                        <li><a href="{{route('build_data.personnel.permission-employee-data.index')}}">--}}
                        {{--                                                @lang('modules.menu.nav.build_data.personnel.permission_employee')</a>--}}
                        {{--                                        </li>--}}
                        {{--                                        <li><a href="{{route('build_data.personnel.role-data.index')}}">--}}
                        {{--                                                @lang('modules.menu.nav.build_data.personnel.role')</a>--}}
                        {{--                                        </li>--}}
                        <li><a href="{{route('build_data.personnel.shift-data.index')}}">
                                @lang('modules.menu.nav.build_data.personnel.shift')</a>
                        </li>
                        @if(Session::get(SESSION_KEY_LEVEL) >= 5)
                            <li><a href="{{route('build_data.personnel.wage-data.index')}}">
                                    @lang('modules.menu.nav.build_data.personnel.wage')</a>
                            </li>
                            <li><a href="{{route('build_data.personnel.level-data.index')}}">
                                    @lang('modules.menu.nav.build_data.personnel.level')</a>
                            </li>
                            <li><a href="{{route('build_data.personnel.category-work-data.index')}}">
                                    @lang('modules.menu.nav.build_data.personnel.category-work')</a>
                            </li>
                            <li><a href="{{route('build_data.personnel.work-data.index')}}">
                                    @lang('modules.menu.nav.build_data.personnel.work')</a>
                            </li>
                            <li><a href="{{route('build_data.personnel.point-data.index')}}">
                                    @lang('modules.menu.nav.build_data.personnel.point')</a>
                            </li>
                            <li><a href="{{route('build_data.personnel.booking-bonus-data.index')}}">
                                    @lang('modules.menu.nav.build_data.personnel.booking-bonus')</a>
                            </li>
                            <li><a href="{{route('build_data.personnel.kaizen-bonus-data.index')}}">
                                    @lang('modules.menu.nav.build_data.personnel.kaizen-bonus')</a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        @lang('modules.menu.nav.build_data.business.title')<em
                            class="fa fa-caret-right"></em></a>
                    <ul>
                        <li><a href="{{route('build_data.business.area-data.index')}}">
                                @lang('modules.menu.nav.build_data.business.area')</a>
                        </li>
                        <li><a href="{{route('build_data.business.table-data.index')}}">
                                @lang('modules.menu.nav.build_data.business.table')</a>
                        </li>
                        {{--                                        <li><a href="{{route('build_data.business.permission-sales.index')}}">--}}
                        {{--                                                @lang('modules.menu.nav.build_data.business.permission-sales')</a>--}}
                        {{--                                        </li>--}}
                        <li><a href="{{route('build_data.business.reasons-cancel-food-data.index')}}">
                                @lang('modules.menu.nav.build_data.business.reasons-cancel-food')</a>
                        </li>
                        <li><a href="{{route('build_data.business.price-temporary.index')}}">
                                @lang('modules.menu.nav.build_data.business.price-food')</a>
                        </li>
                        <li><a href="{{route('build_data.business.price-adjustment-data.index')}}">
                                @lang('modules.menu.nav.build_data.business.price-adjustment')</a>
                        </li>
                        <li><a href="{{route('build_data.business.surcharge-data.index')}}">
                                @lang('modules.menu.nav.build_data.business.surcharge')</a>
                        </li>
                        <li><a href="{{route('build_data.business.price-by-area.index')}}">
                                @lang('modules.menu.nav.build_data.business.price-by-area')</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        @lang('modules.menu.nav.build_data.kitchen.title')<em
                            class="fa fa-caret-right"></em></a>
                    <ul>
                        <li><a href="{{route('build_data.kitchen.kitchen-data.index')}}">
                                @lang('modules.menu.nav.build_data.kitchen.title')</a>
                        </li>
                        @if(Session::get(SESSION_KEY_LEVEL) > 3)
                            <li><a href="{{route('build_data.kitchen.quantitative-data.index')}}">
                                    @lang('modules.menu.nav.build_data.kitchen.quantitative')</a>
                            </li>
                        @endif
                        {{--                                        <li><a href="{{route('build_data.kitchen.permission-kitchen.index')}}">--}}
                        {{--                                                @lang('modules.menu.nav.build_data.kitchen.permission-kitchen')</a>--}}
                        {{--                                        </li>--}}
                        <li><a href="{{route('build_data.kitchen.assign-kitchen.index')}}">
                                @lang('modules.menu.nav.build_data.kitchen.assign-kitchen')</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        @lang('modules.menu.nav.build_data.cost&revenue.title')<em
                            class="fa fa-caret-right"></em></a>
                    <ul>
                        <li><a href="{{route('build_data.revenue-and-cost.cost-data.index')}}">
                                @lang('modules.menu.nav.build_data.cost&revenue.cost')</a>
                        </li>
                        <li><a href="{{route('build_data.revenue-and-cost.revenue-data.index')}}">
                                @lang('modules.menu.nav.build_data.cost&revenue.revenue')</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        @endif
        @if(Session::get(SESSION_KEY_LEVEL) > 5 && in_array('OWNER', Session::get(SESSION_PERMISSION)) || in_array('WEB_MENU_SALE_CHANNEL', Session::get(SESSION_PERMISSION)))
                <li>
                    <a href="javascript:void(0)"><em
                            class="fa fa-mixcloud"></em> @lang('modules.menu.nav.sell_online.title')</a>
                    <ul>
                        <li><a href="/facebook-auth.login.index"
                            >@lang('modules.menu.nav.sell_online.facebook')</a>
                        </li>
                    </ul>
                </li>
            @endif
        @if(in_array('OWNER', Session::get(SESSION_PERMISSION)) || in_array('WEB_MENU_SETTING', Session::get(SESSION_PERMISSION)))
            <li>
                <a href="javascript:void(0)"><em class="fa fa-cog"></em> @lang('modules.menu.nav.setting.title')
                </a>
                <ul>

                    <li><a href="{{route('setting.restaurant-setting.index')}}"
                        >@lang('modules.menu.nav.setting.setting.restaurant')</a>
                    </li>
                    <li><a href="{{route('setting.brand-setting.index')}}"
                        >@lang('modules.menu.nav.setting.setting.brand')</a>
                    </li>
                    <li><a href="{{route('setting.branch-setting.index')}}"
                        >@lang('modules.menu.nav.setting.setting.branch')</a>
                    </li>
                    <li><a href="javascript:void(0)"
                        >Quản lý VAT<em
                                class="fa fa-caret-right"></em></a>
                        <ul>
                            <li><a href="{{route('setting.vat-manage.vat-restaurant.index')}}">
                                    Chọn VAT Hệ Thống </a>
                            </li>
                            <li><a href="{{route('setting.vat-manage.vat-config.index')}}">
                                    Cấu hình VAT </a>
                            </li>
                        </ul>
                    </li>
                    @if(Session::get(SESSION_KEY_LEVEL) > 5)
                    <li><a href="{{route('setting.offline-setting.index')}}"
                        >@lang('modules.menu.nav.setting.setting.offline')</a>
                    </li>
                    @endif
                    <li><a href="{{route('setting.service-cost-history.index')}}"
                        >Lịch sử chi phí dịch vụ</a></li>
                    {{--                                    <li><a href="{{route('message.visible-message.index')}}"--}}
                    {{--                                        >@lang('modules.menu.nav.setting.setting.chat')</a>--}}
                    {{--                                    </li>--}}
                    @if((Session::get(SESSION_KEY_SETTING_CURRENT_BRAND)['branch_type_option'] == 3 &&  Session::get(SESSION_KEY_SETTING_CURRENT_BRAND)['branch_type'] == 2))
                        <li><a href="{{route('marketing.display-secondary-pos.index')}}">Màn hình phụ</a>
                        </li>
                    @endif
                    <li>
                        <a href="{{route('setting.partner-invoice.index')}}">Hóa đơn điện tử</a>
                    </li>
                </ul>
            </li>
        @endif
        <li class="" id="more_menu">
            <i class="icofont icofont-curved-double-right"></i>
        </li>
        <li class="" id="compact_menu">
            <i class="icofont icofont-curved-double-left"></i>
        </li>
    </ul>
</nav>
