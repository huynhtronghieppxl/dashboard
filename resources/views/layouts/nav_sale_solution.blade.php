<nav id="nav-header-menu">
    <ul class="nav-list" style="display: block">
        <li>
            <a href="{{route('dashboard.dashboard-sale-solution.index')}}"><em
                    class="fa fa-home"></em> @lang('modules.menu.nav.dashboard.title')</a>
        </li>
        <li>
            <a href="javascript:void(0)"><em
                    class="fa fa-wpforms"></em> @lang('modules.menu.nav.treasurer.title')</a>
            <ul>
                <li><a href="{{route('treasurer.payment-bill-treasurer.index')}}"
                    >@lang('modules.menu.nav.treasurer.payment-bill')</a>
                </li>
                <li><a href="{{route('treasurer.receipts-bill-treasurer.index')}}"
                    >@lang('modules.menu.nav.treasurer.receipts-bill')</a>
                </li>
                <li><a href="{{route('treasurer.work-history-treasurer.index')}}"
                    >@lang('modules.menu.nav.treasurer.work-history')</a>
                </li>
                <li><a href="{{route('treasurer.list-bill-treasurer.index')}}"
                    >@lang('modules.menu.nav.treasurer.list-bill')</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0)">
                <em class="fa fa-cubes"></em> @lang('modules.menu.nav.manage.title')
            </a>
            <ul>
                <!-- Thêm phân quyền Giải pháp bán hàng -->
                <li><a href="javascript:void(0)">@lang('modules.menu.nav.manage.employee.title')<em class="fa fa-caret-right"></em></a>
                    <ul>
                        <li><a href="{{route('manage.employee.employee-manage.index')}}"
                            >@lang('modules.menu.nav.manage.employee.employee')</a>
                        </li>
                        <li><a href="{{route('build_data.personnel.permission-employee-data.index')}}">
                                @lang('modules.menu.nav.build_data.personnel.permission_employee')</a>
                        </li>
                        <li><a href="{{route('build_data.personnel.role-data.index')}}">
                                @lang('modules.menu.nav.build_data.personnel.role')</a>
                        </li>
                    </ul>
                </li>
                <li><a href="{{route('manage.food.food-brand-manage.index')}}"
                    >@lang('modules.menu.nav.manage.food_menu.title_solution')</a>
                </li>
                <li><a href="{{route('manage.area_price.price-by-area-manage.index')}}"
                    >@lang('modules.menu.nav.manage.area_price.title')</a>
                </li>
                <li><a href="{{route('manage.booking_table.booking-table-manage.index')}}"
                    >@lang('modules.menu.nav.manage.booking_table')</a>
                </li>
                <li><a href="{{route('manage.bill.bill-manage.index')}}"
                    >@lang('modules.menu.nav.manage.bill')</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0)"><em
                    class="fa fa-line-chart"></em> @lang('modules.menu.nav.report.title')</a>
            <ul>
                <li><a href="{{route('report.revenue-report.index')}}"
                    >@lang('modules.menu.nav.report.revenue')</a>
                </li>
                <li><a href="{{route('report.cost-report.index')}}"
                    >@lang('modules.menu.nav.report.cost')</a>
                </li>
                <li><a href="javascript:void(0)"
                    >@lang('modules.menu.nav.report.sell')<em class="fa fa-caret-right"></em></a>
                    <ul>
                        <li><a href="{{route('report.sell.category-report.index')}}"
                            >Danh mục</a>
                        </li>
                        <li><a href="{{route('report.sell.food-report.index')}}"
                            >Món ăn</a>
                        </li>
                        <li><a href="{{route('report.sell.gift-food-report.index')}}"
                            >Món tặng</a>
                        </li>
                        <li><a href="{{route('report.sell.discount-report.index')}}"
                            >Giảm giá</a>
                        </li>
                        <li><a href="{{route('report.sell.take-away-report.index')}}"
                            >Món mang về</a>
                        </li>
                        <li><a href="{{route('report.sell.food-cancel-report.index')}}"
                            >Món hủy</a>
                        </li>
                        <li><a href="{{route('report.sell.order-report.index')}}"
                            >Đơn hàng</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('report.profit-report.index')}}">
                        @lang('modules.menu.nav.report.profit')</a>
                </li>

                <li>
                    <a href="{{route('report.area-report.index')}}"
                    >@lang('modules.menu.nav.report.area')</a>
                </li>

                <li><a href="{{route('report.employee-report.index')}}"
                    >@lang('modules.menu.nav.report.employee')</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0)"><em class="fa fa-cloud-upload"></em> @lang('modules.menu.nav.build_data.title')</a>
            <ul>
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
{{--                        @if(Session::get(SESSION_KEY_LEVEL) > 5)--}}
{{--                            <li><a href="{{route('build_data.food.warning-price-food.index')}}">--}}
{{--                                    @lang('modules.menu.nav.build_data.food.warning-price')</a>--}}
{{--                            </li>--}}
{{--                        @endif--}}
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
        <li>
            <a href="javascript:void(0)"><em class="fa fa-cog"></em> @lang('modules.menu.nav.setting.title')
            </a>
            <ul>
                <li><a href="{{route('setting.sale-solution-setting.index')}}"
                    >@lang('modules.menu.nav.setting.setting.restaurant')</a>
                </li>
                <li><a href="javascript:void(0)"
                    >Quản lý VAT</a>
                    <ul>
                        <li><a href="{{route('setting.vat-manage.vat-restaurant.index')}}">
                                Chọn VAT Hệ Thống </a>
                        </li>
                        <li><a href="{{route('setting.vat-manage.vat-config.index')}}">
                                Cấu hình VAT </a>
                        </li>
                    </ul>
                </li>
                {{--                                    <li><a href="{{route('message.visible-message.index')}}"--}}
                {{--                                        >@lang('modules.menu.nav.setting.setting.chat')</a>--}}
                {{--                                    </li>--}}
                @if((Session::get(SESSION_KEY_SETTING_CURRENT_BRAND)['branch_type_option'] == 3 &&  Session::get(SESSION_KEY_SETTING_CURRENT_BRAND)['branch_type'] == 2))
                    <li>
                        <a href="{{route('marketing.display-secondary-pos.index')}}">Màn hình phụ</a>
                    </li>
                @endif
            </ul>
        </li>
    </ul>
</nav>
