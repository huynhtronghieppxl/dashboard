<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::namespace('Auth')->group(function () {
    Route::get("/login", "LoginController@showLoginForm")->name("login")->middleware('checkSession');
    Route::get('/forgot-password', function () {
        return view('auth/forgot_password2');
    });
    Route::get("/interview", function () {
        return view('interview');
    })->name("login")->middleware('checkSession');
    Route::post('/login', 'LoginController@postLogin')->name("login")->middleware('checkSession');
    Route::post('/login-aloline', 'LoginAlolineController@postLogin');
    Route::get("/logout", "LogoutController@logout");
    Route::post("/login-chat", "LoginChatController@postLogin");
    /**
     * Trans: Quên mật khẩu
     */
    Route::post('forgot-password', 'ForgotPasswordController@forgotPassword');
    Route::post('verify-code', 'ForgotPasswordController@verifyCode');
    Route::post('change-password', 'ForgotPasswordController@changePassword');
});

Route::namespace('Notification')->group(function () {
    Route::post("/push-token", "notificationController@index");
    Route::post("/push-token-chat", "notificationController@PushTokenChat");
    Route::post("/push-token-logout", "notificationController@PushTokenLogout");
});

Route::get('/layout', function (Request $request) {
    return view('layouts.layouts_new.layout');
});

Route::get('/el', function (Request $request) {
    return view('layouts.layouts_new.component');
});


// -------------------------------- Router ----------------------------------------------->
/**
 * Trans: TỔNG QUAN
 */
Route::group(
    ['namespace' => 'Dashboard', 'as' => 'dashboard.', 'middleware' => []],
    function () {
        /**
         * Dashboard index
         */
        Route::resource('/', 'IndexController');

        /**
         * Dashboard index
         */
        Route::get('/info-php', 'IndexController@infoPhp');

        Route::resource('/dashboard-report', 'ReportDashboardController');
        Route::get('dashboard-introduce.data', ['as' => 'dashboard-introduce.data', 'uses' => 'IndexController@data']);
        Route::get('dashboard-introduce.search-customer', ['as' => 'dashboard-introduce.search-customer', 'uses' => 'IndexController@searchCustomer']);
        Route::get('dashboard-introduce.review-restaurant', ['as' => 'dashboard-introduce.review-restaurant', 'uses' => 'IndexController@review']);
        Route::post('dashboard-introduce.reply-review-restaurant', ['as' => 'dashboard-introduce.reply-review-restaurant', 'uses' => 'IndexController@replyReview']);
        Route::post('dashboard-introduce.logout-aloline', ['as' => 'dashboard-introduce.logout-aloline', 'uses' => 'IndexController@logoutAloline']);
        /**
         *********************** Dashboard restaurant ***************************
         */
        Route::resource('restaurant-dashboard', 'RestaurantDashboardController');
        /**
         * Trans: Báo cáo lợi nhuận thực tế
         */
        Route::get('restaurant-dashboard.data-real-profit-report', ['as' => 'restaurant-dashboard.data-real-profit-report', 'uses' => 'RestaurantDashboardController@dataRealProfitReport']);
        /**
         * Trans: Báo cáo nhà cung cấp
         */
        Route::get('restaurant-dashboard.data-supplier-report', ['as' => 'restaurant-dashboard.data-supplier-report', 'uses' => 'RestaurantDashboardController@dataSupplierReport']);


        /**
         * Giải pháp bán hàng
         *********************** Dashboard branch ********************************
         */
        Route::resource('dashboard-sale-solution', 'DashboardSaleSolutionController');
        Route::get('dashboard-sale-solution.update-datatable-length', ['as' => 'dashboard-sale-solution.update-datatable-length', 'uses' => 'DashboardSaleSolutionController@updateDatatableLength']);
        Route::get('dashboard-sale-solution.data-current-day-report', ['as' => 'dashboard-sale-solution.data-current-day-report', 'uses' => 'DashboardSaleSolutionController@dataCurrentDayReport']);
        Route::get('dashboard-sale-solution.data-revenue-cost-profit-report', ['as' => 'dashboard-sale-solution.data-revenue-cost-profit-report', 'uses' => 'DashboardSaleSolutionController@dataRevenueCostProfitReport']);
        Route::get('dashboard-sale-solution.data-analysis-cost-report', ['as' => 'dashboard-sale-solution.data-analysis-cost-report', 'uses' => 'DashboardSaleSolutionController@dataAnalysisCost']);
        Route::get('dashboard-sale-solution.data-profit-report', ['as' => 'dashboard-sale-solution.data-profit-report', 'uses' => 'DashboardSaleSolutionController@dataProfitReport']);
        Route::get('dashboard-sale-solution.data-food-drink-report', ['as' => 'dashboard-sale-solution.data-food-drink-report', 'uses' => 'DashboardSaleSolutionController@dataFoodDrinkReport']);
        Route::get('dashboard-sale-solution.data-employee-report', ['as' => 'dashboard-sale-solution.data-employee-report', 'uses' => 'DashboardSaleSolutionController@dataEmployeeReport']);
        Route::get('dashboard-sale-solution.data-area-report', ['as' => 'dashboard-sale-solution.data-area-report', 'uses' => 'DashboardSaleSolutionController@dataAreaReport']);
        Route::get('dashboard-sale-solution.data-discount-report', ['as' => 'dashboard-sale-solution.data-discount-report', 'uses' => 'DashboardSaleSolutionController@dataDiscountReport']);
        Route::get('dashboard-sale-solution.data-off-dished-report', ['as' => 'dashboard-sale-solution.data-off-dished-report', 'uses' => 'DashboardSaleSolutionController@dataOffDishedMenuReport']);
        Route::get('dashboard-sale-solution.data-revenue-report', ['as' => 'dashboard-sale-solution.data-revenue-report', 'uses' => 'DashboardSaleSolutionController@dataRevenueReport']);
        Route::get('dashboard-sale-solution.data-cost-report', ['as' => 'dashboard-sale-solution.data-cost-report', 'uses' => 'DashboardSaleSolutionController@dataCostReport']);
        Route::get('dashboard-sale-solution.data-surcharge-report', ['as' => 'dashboard-sale-solution.data-surcharge-report', 'uses' => 'DashboardSaleSolutionController@dataSurchargeReport']);
        Route::get('dashboard-sale-solution.data-order-report', ['as' => 'dashboard-sale-solution.data-order-report', 'uses' => 'DashboardSaleSolutionController@dataOrderReport']);
        Route::get('dashboard-sale-solution.data-category-report', ['as' => 'dashboard-sale-solution.data-category-report', 'uses' => 'DashboardSaleSolutionController@dataCategoryReport']);
        Route::get('dashboard-sale-solution.data-gift-food-report', ['as' => 'dashboard-sale-solution.data-gift-food-report', 'uses' => 'DashboardSaleSolutionController@dataGiftFoodReport']);
        Route::get('dashboard_sale_solution.data-off-dished-report', ['as' => 'dashboard_sale_solution.data-off-dished-report', 'uses' => 'DashboardSaleSolutionController@dataOffDishedMenuReport']);
        Route::get('dashboard_sale_solution.data-detail-cost-report', ['as' => 'dashboard_sale_solution.data-detail-cost-report', 'uses' => 'DashboardSaleSolutionController@detailCost']);
        Route::get('dashboard_sale_solution.data-detail-revenue-report', ['as' => 'dashboard_sale_solution.data-detail-revenue-report', 'uses' => 'DashboardSaleSolutionController@detailRevenue']);

        /**
         * Giải pháp quản trị
         *********************** Dashboard branch ********************************
         * Hoạt dộng kinh doanh
         */
        Route::resource('branch-dashboard', 'BranchDashboardController');
        Route::get('branch-dashboard.update-datatable-length', ['as' => 'branch-dashboard.update-datatable-length', 'uses' => 'BranchDashboardController@updateDatatableLength']);
        /**
         * Báo cáo hoạt động trong ngày
         */
        Route::get('branch-dashboard.data-current-day-report', ['as' => 'branch-dashboard.data-current-day-report', 'uses' => 'BranchDashboardController@dataCurrentDayReport']);
        /**
         * Báo cáo chi tiết doanh thu bán hàng tổng quan
         */
        Route::get('branch-dashboard.data-detail-revenue-sell-report', ['as' => 'branch-dashboard.data-detail-revenue-report', 'uses' => 'BranchDashboardController@dataDetailRevenueReport']);
        /**
         * Báo cáo tăng trưởng kinh doanh
         */
        Route::get('branch-dashboard.data-business-growth-report', ['as' => 'branch-dashboard.data-business-growth-report', 'uses' => 'BranchDashboardController@dataBusinessGrowthReport']);
        /**
         * Báo cáo doanh thu, chi phí, lợi nhuận
         */
        Route::get('branch-dashboard.data-revenue-cost-profit-report', ['as' => 'branch-dashboard.data-revenue-cost-profit-report', 'uses' => 'BranchDashboardController@dataRevenueCostProfitReport']);
        Route::get('branch-dashboard.data-detail-revenue-report', ['as' => 'branch-dashboard.data-detail-revenue-report', 'uses' => 'BranchDashboardController@detailRevenue']);
        Route::get('branch-dashboard.data-detail-cost-report', ['as' => 'branch-dashboard.data-detail-cost-report', 'uses' => 'BranchDashboardController@detailCost']);
        /**
         * Báo cáo phân tích chi phí
         */
        Route::get('branch-dashboard.data-analysis-cost-report', ['as' => 'branch-dashboard.data-analysis-cost-report', 'uses' => 'BranchDashboardController@dataAnalysisCost']);
        /**
         * Báo cáo doanh thu
         */
        Route::get('branch-dashboard.data-revenue-report', ['as' => 'branch-dashboard.data-revenue-report', 'uses' => 'BranchDashboardController@dataRevenueReport']);
        /**
         * Báo cáo chi phí
         */
        Route::get('branch-dashboard.data-cost-report', ['as' => 'branch-dashboard.data-cost-report', 'uses' => 'BranchDashboardController@dataCostReport']);
        /**
         * Báo cáo lợi nhuận
         */
        Route::get('branch-dashboard.data-profit-report', ['as' => 'branch-dashboard.data-profit-report', 'uses' => 'BranchDashboardController@dataProfitReport']);
        Route::get('branch-dashboard.data-detail-other-cost-report', ['as' => 'branch-dashboard.data-detail-other-cost-report', 'uses' => 'BranchDashboardController@detailAdditionReasonDetail']);

        /**
         * Trans: Báo cáo công nợ
         */
        Route::get('branch-dashboard.data-debt-report', ['as' => 'branch-dashboard.data-debt-report', 'uses' => 'BranchDashboardController@dataDebtReport']);
        Route::get('branch-dashboard.data-supplier-debt-report', ['as' => 'branch-dashboard.data-supplier-debt-report', 'uses' => 'BranchDashboardController@dataSupplierDebtReport']);
        Route::get('branch-dashboard.data-detail-supplier-debt-report', ['as' => 'branch-dashboard.data-detail-supplier-debt-report', 'uses' => 'BranchDashboardController@dataDetailSupplierDebtReport']);
        /**
         * Trans: Báo cáo xuất/nhập kho
         */
        Route::get('branch-dashboard.data-inventory-report', ['as' => 'branch-dashboard.data-inventory-report', 'uses' => 'BranchDashboardController@dataInventoryReport']);
        /**
         * Trans: Báo cáo DT theo món ăn, hàng hóa
         */
        Route::get('branch-dashboard.data-food-report', ['as' => 'branch-dashboard.data-food-report', 'uses' => 'BranchDashboardController@dataFoodReport']);
        /**
         * Trans: Báo cáo DT theo hàng hóa
         */
        Route::get('branch-dashboard.data-drink-report', ['as' => 'branch-dashboard.data-drink-report', 'uses' => 'BranchDashboardController@dataDrinkReport']);
        /**
         * Trans: Báo cáo DT theo khu vực
         */
        Route::get('branch-dashboard.data-area-report', ['as' => 'branch-dashboard.data-area-report', 'uses' => 'BranchDashboardController@dataAreaReport']);
        /**
         * Trans: Báo cáo DT theo nhân viên
         */
        Route::get('branch-dashboard.data-employee-report', ['as' => 'branch-dashboard.data-employee-report', 'uses' => 'BranchDashboardController@dataEmployeeReport']);
        /**
         * Trans: Báo cáo khách hàng
         */
        Route::get('branch-dashboard.data-customer-report', ['as' => 'branch-dashboard.data-customer-report', 'uses' => 'BranchDashboardController@dataCustomerReport']);
        /**
         * Trans: Báo cáo món tặng
         */
        Route::get('branch-dashboard.data-gift-food-report', ['as' => 'branch-dashboard.data-gift-food-report', 'uses' => 'BranchDashboardController@dataGiftFoodReport']);
        /**
         * Trans: Báo cáo giảm giá
         */
        Route::get('branch-dashboard.data-discount-report', ['as' => 'branch-dashboard.data-discount-report', 'uses' => 'BranchDashboardController@dataDiscountReport']);
        /**
         * Trans: Báo cáo phụ thu
         */
        Route::get('branch-dashboard.data-surcharge-report', ['as' => 'branch-dashboard.data-surcharge-report', 'uses' => 'BranchDashboardController@dataSurchargeReport']);
        /**
         * Trans: Báo cáo lợi nhuận món ăn
         */
        Route::get('branch-dashboard.data-profit-food-report', ['as' => 'branch-dashboard.data-profit-food-report', 'uses' => 'BranchDashboardController@dataProfitFoodReport']);
        /**
         * Trans: Báo cáo bán hàng
         */
        Route::get('branch-dashboard.data-order-report', ['as' => 'branch-dashboard.datart', 'uses' => 'BranchDashboardController@dataOrderReport']);
        /**-order-repo
         * Trans: Báo cáo danh mục
         */
        Route::get('branch-dashboard.data-category-report', ['as' => 'branch-dashboard.data-category-report', 'uses' => 'BranchDashboardController@dataCategoryReport']);
        /**
         * Trans: Báo cáo khách hàng tích điểm
         */
        Route::get('branch-dashboard.data-customer-accumulate-point-report', ['as' => 'branch-dashboard.data-customer-accumulate-point-report', 'uses' => 'BranchDashboardController@dataCustomerAccumulatePoint']);
        /**
         * Trans: Báo cáo khách hàng sử dụng điểm
         */
        Route::get('branch-dashboard.data-customer-use-point-report', ['as' => 'branch-dashboard.data-customer-use-point-report', 'uses' => 'BranchDashboardController@dataCustomerUsePoint']);
        /**
         * Trans: Báo cáo điểm
         */
        Route::get('branch-dashboard.data-point-report', ['as' => 'branch-dashboard.data-point-report', 'uses' => 'BranchDashboardController@dataPoint']);
        /**
         * Trans: Báo cáo món ngoài menu
         */
        Route::get('branch-dashboard.data-off-dished-report', ['as' => 'branch-dashboard.data-off-dished-report', 'uses' => 'BranchDashboardController@dataOffDishedMenuReport']);
        /**
         * Trans: Báo cáo món Món huỷ
         */
        Route::get('branch-dashboard.data-food-cancel-report', ['as' => 'branch-dashboard.data-food-cancel-report', 'uses' => 'BranchDashboardController@dataFoodCancelReport']);
        /**
         * Trans: Báo cáo món Món mang về
         */
        Route::get('branch-dashboard.data-take-away-report', ['as' => 'branch-dashboard.data-take-away-report', 'uses' => 'BranchDashboardController@dataTakeAwayReport']);
        /**
         * Trans: Báo cáo món VAT
         */
        Route::get('branch-dashboard.data-vat-food-report', ['as' => 'branch-dashboard.data-vat-food-report', 'uses' => 'BranchDashboardController@dataVatFoodReport']);

        /**
         * Trans: Báo cáo P&L
         */
        Route::get('branch-dashboard.data-cost-freight-report', ['as' => 'branch-dashboard.data-cost-freight-report', 'uses' => 'BranchDashboardController@dataCostFreightReport']);

        /**
         * Trans: Báo cáo nạp thẻ
         */
        Route::get('branch-dashboard.data-recharge-point-report', ['as' => 'branch-dashboard.data-recharge-point-report', 'uses' => 'BranchDashboardController@dataRechargePointReport']);

        /******************************
         * Hoạt dộng công ty
         */

        /**
         * Báo cáo doanh thu, chi phí, lợi nhuận
         */
        Route::resource('company-dashboard', 'CompanyDashboardController');
        Route::get('company-dashboard.data-revenue-cost-cash-flow-report', ['as' => 'company-dashboard.data-revenue-cost-cash-flow-report', 'uses' => 'CompanyDashboardController@dataRevenueCostCashFlowReport']);
        //        Route::get('company-dashboard.data-detail-revenue-report', ['as' => 'company-dashboard.data-detail-revenue-report', 'uses' => 'CompanyDashboardController@detailRevenue']);
        //        Route::get('company-dashboard.data-detail-cost-report', ['as' => 'company-dashboard.data-detail-cost-report', 'uses' => 'CompanyDashboardController@detailCost']);

        /**
         * Trans: Báo cáo P&L
         */
        Route::get('branch-dashboard.data-profit-loss-report', ['as' => 'branch-dashboard.data-off-dished-report', 'uses' => 'BranchDashboardController@dataProfitLossReport']);
    }
);

/**
 * Trans: THỦ QUỸ
 */
Route::group(
    ['namespace' => 'Treasurer', 'as' => 'treasurer.', 'middleware' => []],
    function () {
        /**
         * Eng: Bill-liabilities-treasurer
         * Trans: Sổ mua hàng
         */
        Route::resource('order-bill-treasurer', 'BillLiabilitiesController');
        Route::get('order-bill-treasurer.data', ['as' => 'order-bill-treasurer.data', 'uses' => 'BillLiabilitiesController@data']);
        Route::get('order-bill-treasurer.detail', ['as' => 'order-bill-treasurer.detail', 'uses' => 'BillLiabilitiesController@detail']);
        Route::get('order-bill-treasurer.order', ['as' => 'order-bill-treasurer.order', 'uses' => 'BillLiabilitiesController@order']);
        Route::get('order-bill-treasurer.data-order', ['as' => 'order-bill-treasurer.data-order', 'uses' => 'BillLiabilitiesController@dataOrder']);
        Route::post('order-bill-treasurer.retention-money', ['as' => 'order-bill-treasurer.retention-money', 'uses' => 'BillLiabilitiesController@retentionMoney']);
        Route::get('order-bill-treasurer.reason', ['as' => 'order-bill-treasurer.reason', 'uses' => 'BillLiabilitiesController@reason']);


        /**
         * Eng: supplier-payment-debt
         * Trans: NCC nhắc nợ
         */
        Route::resource('supplier-payment-debt-treasurer', 'SupplierPaymentDebtController');
        Route::get('supplier-payment-debt-treasurer.data', ['as' => 'supplier-payment-debt-treasurer.data', 'uses' => 'SupplierPaymentDebtController@data']);
        Route::get('supplier-payment-debt-treasurer.detail', ['as' => 'supplier-payment-debt-treasurer.detail', 'uses' => 'SupplierPaymentDebtController@detail']);
        Route::get('supplier-payment-debt-treasurer.order', ['as' => 'supplier-payment-debt-treasurer.order', 'uses' => 'SupplierPaymentDebtController@order']);
        Route::post('supplier-payment-debt-treasurer.change-status', ['as' => 'supplier-payment-debt-treasurer.change-statu', 'uses' => 'SupplierPaymentDebtController@changeStatus']);


        /**
         * Eng: cash-book-treasurer
         * Trans: Sổ quỹ
         */
        Route::resource('cash-book-treasurer', 'CashBookController');
        Route::get('cash-book-treasurer.time', ['as' => 'cash-book-treasurer.time', 'uses' => 'CashBookController@time']);
        Route::get('cash-book-treasurer.data', ['as' => 'cash-book-treasurer.data', 'uses' => 'CashBookController@data']);
        Route::post('cash-book-treasurer.create', ['as' => 'cash-book-treasurer.create', 'uses' => 'CashBookController@create']);
        /**
         * Eng: fund-period-treasurer
         * Trans: Kỳ quỹ
         */
        Route::resource('fund-period-treasurer', 'FundPeriodController');
        Route::get('fund-period-treasurer.data', ['as' => 'fund-period-treasurer.data', 'uses' => 'FundPeriodController@data']);
        Route::post('fund-period-treasurer.confirm', ['as' => 'fund-period-treasurer.confirm', 'uses' => 'FundPeriodController@confirm']);
        Route::post('fund-period-treasurer.cancel', ['as' => 'fund-period-treasurer.cancel', 'uses' => 'FundPeriodController@cancel']);
        Route::get('fund-period-treasurer.detail', ['as' => 'fund-period-treasurer.detail', 'uses' => 'FundPeriodController@detail']);
        /**
         * Eng: Payment-bill-treasurer
         * Trans: Phiếu chi
         */
        Route::resource('payment-bill-treasurer', 'PaymentBillController');
        Route::get('payment-bill-treasurer.data', ['as' => 'payment.bill.treasurer.data', 'uses' => 'PaymentBillController@data']);
        Route::get('payment-bill-treasurer.supplier', ['as' => 'payment-bill-treasurer.supplier', 'uses' => 'PaymentBillController@supplier']);
        Route::get('payment-bill-treasurer.reason', ['as' => 'payment.bill.treasurer.reason', 'uses' => 'PaymentBillController@reason']);
        Route::get('payment-bill-treasurer.customer', ['as' => 'payment-bill-treasurer.customer', 'uses' => 'PaymentBillController@customer']);
        Route::get('payment-bill-treasurer.employee', ['as' => 'payment-bill-treasurer.employee', 'uses' => 'PaymentBillController@employee']);
        Route::get('payment-bill-treasurer.inventory', ['as' => 'payment-bill-treasurer.inventory', 'uses' => 'PaymentBillController@inventory']);
        Route::get('payment-bill-treasurer.detail', ['as' => 'payment-bill-treasurer.detail', 'uses' => 'PaymentBillController@detail']);
        Route::post('payment-bill-treasurer.create', ['as' => 'payment-bill-treasurer.create', 'uses' => 'PaymentBillController@create']);
        Route::get('payment-bill-treasurer.data-update', ['as' => 'payment-bill-treasurer.data-update', 'uses' => 'PaymentBillController@dataUpdate']);
        Route::post('payment-bill-treasurer.update', ['as' => 'payment-bill-treasurer.update', 'uses' => 'PaymentBillController@update']);
        Route::post('payment-bill-treasurer.confirm-payment', ['as' => 'payment-bill-treasurer.confirm-payment', 'uses' => 'PaymentBillController@confirmPayment']);
        Route::post('payment-bill-treasurer.confirm-payment-multi', ['as' => 'payment-bill-treasurer.confirm-payment-multi', 'uses' => 'PaymentBillController@confirmPaymentMulti']);
        Route::post('payment-bill-treasurer.payment', ['as' => 'payment-bill-treasurer.payment', 'uses' => 'PaymentBillController@payment']);
        Route::post('payment-bill-treasurer.payment-multi', ['as' => 'payment-bill-treasurer.payment-multi', 'uses' => 'PaymentBillController@paymentMulti']);
        Route::post('payment-bill-treasurer.cancel', ['as' => 'payment-bill-treasurer.cancel', 'uses' => 'PaymentBillController@cancel']);
        Route::get('payment-bill-treasurer.order', ['as' => 'payment-bill-treasurer.order', 'uses' => 'PaymentBillController@order']);
        Route::get('payment-bill-treasurer.list-fund', ['as' => 'payment-bill-treasurer.list-fund', 'uses' => 'PaymentBillController@listFund']);
        /**
         * Eng: Payment-recurring-bill-treasurer
         * Trans: Phiếu chi định kỳ
         */
        Route::resource('payment-recurring-bill-treasurer', 'PaymentRecurringBillController');
        Route::get('payment-recurring-bill-treasurer.data', ['as' => 'payment-recurring-bill-treasurer.data', 'uses' => 'PaymentRecurringBillController@data']);
        Route::get('payment-recurring-bill-treasurer.reason', ['as' => 'payment-recurring-bill-treasurer.reason', 'uses' => 'PaymentRecurringBillController@reason']);
        Route::post('payment-recurring-bill-treasurer.create', ['as' => 'payment-recurring-bill-treasurer.create', 'uses' => 'PaymentRecurringBillController@create']);
        Route::get('payment-recurring-bill-treasurer.data-update', ['as' => 'payment-recurring-bill-treasurer.data-update', 'uses' => 'PaymentRecurringBillController@dataUpdate']);
        Route::post('payment-recurring-bill-treasurer.update', ['as' => 'payment-recurring-bill-treasurer.update', 'uses' => 'PaymentRecurringBillController@update']);
        Route::post('payment-recurring-bill-treasurer.change-status', ['as' => 'payment-recurring-bill-treasurer.change-status', 'uses' => 'PaymentRecurringBillController@changeStatus']);
        Route::get('payment-recurring-bill-treasurer.detail', ['as' => 'payment-recurring-bill-treasurer.detail', 'uses' => 'PaymentRecurringBillController@detail']);

        /**
         * Eng: Receipts-bill-treasurer
         * Trans: Phiếu thu
         */
        Route::resource('receipts-bill-treasurer', 'ReceiptsBillController');
        Route::get('receipts-bill-treasurer.data', ['as' => 'receipts.bill.treasurer.data', 'uses' => 'ReceiptsBillController@data']);
        Route::get('receipts-bill-treasurer.supplier', ['as' => 'receipts-bill-treasurer.supplier', 'uses' => 'ReceiptsBillController@supplier']);
        Route::get('receipts-bill-treasurer.reason', ['as' => 'receipts.bill.treasurer.reason', 'uses' => 'ReceiptsBillController@reason']);
        Route::get('receipts-bill-treasurer.customer', ['as' => 'receipts-bill-treasurer.customer', 'uses' => 'ReceiptsBillController@customer']);
        Route::get('receipts-bill-treasurer.employee', ['as' => 'receipts-bill-treasurer.employee', 'uses' => 'ReceiptsBillController@employee']);
        Route::get('receipts-bill-treasurer.detail', ['as' => 'receipts-bill-treasurer.detail', 'uses' => 'ReceiptsBillController@detail']);
        Route::get('receipts-bill-treasurer.vat', ['as' => 'receipts-bill-treasurer.vat', 'uses' => 'ReceiptsBillController@getVAT']);
        Route::get('receipts-bill-treasurer.bill', ['as' => 'receipts-bill-treasurer.bill', 'uses' => 'ReceiptsBillController@getListBill']);
        Route::get('receipts-bill-treasurer.data-update', ['as' => 'receipts-bill-treasurer.detail', 'uses' => 'ReceiptsBillController@dataUpdate']);
        Route::post('receipts-bill-treasurer.create', ['as' => 'receipts-bill-treasurer.create', 'uses' => 'ReceiptsBillController@create']);
        Route::post('receipts-bill-treasurer.update', ['as' => 'receipts-bill-treasurer.update', 'uses' => 'ReceiptsBillController@update']);
        Route::post('receipts-bill-treasurer.cancel', ['as' => 'receipts-bill-treasurer.cancel', 'uses' => 'ReceiptsBillController@cancel']);

        /**
         * Eng: salary-employee-treasurer
         * Trans: lương nhân viên
         */
        Route::resource('salary-employee-treasurer', 'SalaryEmployeeController');
        Route::get('salary-employee-treasurer.data', ['as' => 'salary-employee-treasurer.data', 'uses' => 'SalaryEmployeeController@data']);
        Route::post('salary-employee-treasurer.salary-confirm', ['as' => 'salary-employee-treasurer.salary-confirm', 'uses' => 'SalaryEmployeeController@salaryConfirm']);
        Route::post('salary-employee-treasurer.send-salary', ['as' => 'salary-employee-treasurer.send-salary', 'uses' => 'SalaryEmployeeController@sendSalary']);
        Route::get('salary-employee-treasurer.role', ['as' => 'salary-employee-treasurer.role', 'uses' => 'SalaryEmployeeController@role']);
        Route::post('salary-employee-treasurer.confirm-treasurer', ['as' => 'salary-employee-treasurer.confirm-treasurer', 'uses' => 'SalaryEmployeeController@confirmTreasurer']);
        Route::post('salary-employee-treasurer.denied-salary', ['as' => 'salary-employee-treasurer.denied-salary', 'uses' => 'SalaryEmployeeController@deniedSalary']);
        /**
         * Eng: work-history-treasurer
         * Trans: Lịch sử chốt ca thu ngân
         */
        Route::resource('work-history-treasurer', 'WorkHistoryController');
        Route::get('work-history-treasurer.data', ['as' => 'work-history-treasurer.data', 'uses' => 'WorkHistoryController@data']);
        Route::get('work-history-treasurer.detail', ['as' => 'work-history-treasurer.detail', 'uses' => 'WorkHistoryController@detail']);
        Route::get('work-history-treasurer.revenue-detail', ['as' => 'work-history-treasurer.revenue-detail', 'uses' => 'WorkHistoryController@revenueDetail']);
        Route::get('work-history-treasurer.payment-detail', ['as' => 'work-history-treasurer.payment-detail', 'uses' => 'WorkHistoryController@paymentDetail']);
        Route::get('work-history-treasurer.receipt-detail', ['as' => 'work-history-treasurer.receipt-detail', 'uses' => 'WorkHistoryController@receiptDetail']);
        Route::get('work-history-treasurer.deposit-detail', ['as' => 'work-history-treasurer.deposit-detail', 'uses' => 'WorkHistoryController@depositDetail']);
        /**
         * Eng: advance-salary-employee
         * Trans: Chi ứng lương
         */
        Route::resource('advance-salary-employee', 'AdvanceSalaryEmployeeController');
        Route::get('advance-salary-employee.data', ['as' => 'advance-salary-employee.data', 'uses' => 'AdvanceSalaryEmployeeController@data']);
        Route::get('advance-salary-employee.detail', ['as' => 'advance-salary-employee.detail', 'uses' => 'AdvanceSalaryEmployeeController@detail']);
        Route::post('advance-salary-employee.confirm', ['as' => 'advance-salary-employee.confirm', 'uses' => 'AdvanceSalaryEmployeeController@confirm']);
        Route::post('advance-salary-employee.reject', ['as' => 'advance-salary-employee.reject', 'uses' => 'AdvanceSalaryEmployeeController@reject']);
        /**
         * Eng: employee-bonus-punish
         * Trans: Thưởng phạt nhân viên
         */
        Route::resource('employee-bonus-punish', 'EmployeeBonusPunishController');
        Route::get('employee-bonus-punish.data', ['as' => 'employee-bonus-punish.data', 'uses' => 'EmployeeBonusPunishController@data']);
        Route::get('employee-bonus-punish.employee', ['as' => 'employee-bonus-punish.employee', 'uses' => 'EmployeeBonusPunishController@employee']);
        Route::get('employee-bonus-punish.employee-working', ['as' => 'employee-bonus-punish.employee-working', 'uses' => 'EmployeeBonusPunishController@employeeWorking']);
        Route::post('employee-bonus-punish.create', ['as' => 'employee-bonus-punish.create', 'uses' => 'EmployeeBonusPunishController@create']);
        Route::get('employee-bonus-punish.data-update', ['as' => 'employee-bonus-punish.data-update', 'uses' => 'EmployeeBonusPunishController@dataUpdate']);
        Route::post('employee-bonus-punish.update', ['as' => 'employee-bonus-punish.update', 'uses' => 'EmployeeBonusPunishController@update']);
        Route::post('employee-bonus-punish.confirm', ['as' => 'employee-bonus-punish.confirm', 'uses' => 'EmployeeBonusPunishController@confirm']);
        Route::post('employee-bonus-punish.approve', ['as' => 'employee-bonus-punish.approve', 'uses' => 'EmployeeBonusPunishController@approve']);
        Route::post('employee-bonus-punish.cancel', ['as' => 'employee-bonus-punish.cancel', 'uses' => 'EmployeeBonusPunishController@cancel']);
        Route::get('employee-bonus-punish.detail', ['as' => 'employee-bonus-punish.detail', 'uses' => 'EmployeeBonusPunishController@detail']);
        Route::get('employee-bonus-punish.data-employee', ['as' => 'employee-bonus-punish.data-employee', 'uses' => 'EmployeeBonusPunishController@dataEmployee']);
        Route::post('employee-bonus-punish.create-holiday', ['as' => 'employee-bonus-punish.create-holiday', 'uses' => 'EmployeeBonusPunishController@createHoliday']);
        /**
         * Eng: list-bill-treasurer
         * Trans: Danh sách đơn hàng
         */
        Route::resource('list-bill-treasurer', 'ListBillController');
        Route::get('list-bill-treasurer.data', ['as' => 'list-bill-treasurer.data', 'uses' => 'ListBillController@data']);
        /**
         * Eng: cash-fund-treasurer
         * Trans: Qũy tiền mặt
         */
        Route::resource('cash-fund-treasurer', 'CashFundController');
        Route::get('cash-fund-treasurer.data', ['as' => 'cash-fund-treasurer.data', 'uses' => 'CashFundController@data']);
    }
);
/**
 * Trans: Folder Manage Controller
 */
Route::group(
    ['namespace' => 'Manage', 'as' => 'manage.', 'middleware' => []],
    function () {
        /**
         * Trans: Quản lý đơn hàng NCC
         */
        Route::group(
            ['namespace' => 'SupplierOrder', 'as' => 'supplier_order.', 'middleware' => []],
            function () {
                Route::resource('supplier-order', 'SupplierOrderController');
                Route::get('supplier-order.data', ['as' => 'supplier-order.data', 'uses' => 'SupplierOrderController@data']);
                Route::get('supplier-order.data-list-request', ['as' => 'supplier-order.data-list-request', 'uses' => 'SupplierOrderController@dataListRequest']);
                Route::get('supplier-order.data-list-order-restaurant', ['as' => 'supplier-order.data-list-order-restaurant', 'uses' => 'SupplierOrderController@dataListOrderRestaurant']);
                Route::get('supplier-order.data-list-order', ['as' => 'supplier-order.data-list-order', 'uses' => 'SupplierOrderController@dataListOrder']);
                Route::get('supplier-order.data-list-return', ['as' => 'supplier-order.data-list-return', 'uses' => 'SupplierOrderController@dataListReturn']);
                Route::get('restaurant-material-order-request', ['as' => 'restaurant-material-order-request', 'uses' => 'SupplierOrderController@historyRequest']);

                Route::get('supplier-order.material-supplier', ['as' => 'supplier-order.material-supplier', 'uses' => 'SupplierOrderController@materialSupplier']);
                Route::get('supplier-order.supplier', ['as' => 'supplier-order.supplier', 'uses' => 'SupplierOrderController@supplier']);
                Route::post('supplier-order.create', ['as' => 'supplier-order.create', 'uses' => 'SupplierOrderController@create']);

                Route::get('supplier-order.data-update-request', ['as' => 'supplier-order.data-update-request', 'uses' => 'SupplierOrderController@dataUpdateRequest']);
                Route::post('supplier-order.update-request', ['as' => 'supplier-order.update-request', 'uses' => 'SupplierOrderController@updateRequest']);
                Route::post('supplier-order.cancel-request', ['as' => 'supplier-order.update-request', 'uses' => 'SupplierOrderController@cancelRequest']);
                Route::get('supplier-order.data-detail-request', ['as' => 'supplier-order.data-detail-request', 'uses' => 'SupplierOrderController@dataDetailRequest']);
                Route::post('supplier-order.confirm-request', ['as' => 'supplier-order.confirm-request', 'uses' => 'SupplierOrderController@confirmRequest']);

                Route::post('supplier-order.confirm-restaurant', ['as' => 'supplier-order.confirm-restaurant', 'uses' => 'SupplierOrderController@confirmRestaurant']);
                Route::post('supplier-order.cancel-restaurant', ['as' => 'supplier-order.cancel-restaurant', 'uses' => 'SupplierOrderController@cancelRestaurant']);
                Route::get('supplier-order.data-update-restaurant', ['as' => 'supplier-order.data-update-restaurant', 'uses' => 'SupplierOrderController@dataUpdateRestaurant']);
                Route::post('supplier-order.update-restaurant', ['as' => 'supplier-order.update-restaurant', 'uses' => 'SupplierOrderController@updateRestaurant']);
                Route::get('supplier-order.data-detail-restaurant', ['as' => 'supplier-order.data-detail-restaurant', 'uses' => 'SupplierOrderController@dataDetailRestaurant']);

                Route::post('supplier-order.confirm-order', ['as' => 'supplier-order.confirm-order', 'uses' => 'SupplierOrderController@confirmOrder']);
                Route::post('supplier-order.received-order', ['as' => 'supplier-order.received-order', 'uses' => 'SupplierOrderController@receivedOrder']);
                Route::post('supplier-order.cancel-order', ['as' => 'supplier-order.cancel-order', 'uses' => 'SupplierOrderController@cancelOrder']);
                Route::get('supplier-order.data-received-order', ['as' => 'supplier-order.data-received-order', 'uses' => 'SupplierOrderController@dataReceivedOrder']);
                Route::get('supplier-order.data-detail-order', ['as' => 'supplier-order.data-detail-order', 'uses' => 'SupplierOrderController@detailOrder']);
                Route::get('supplier-order.data-request', ['as' => 'supplier-order.data-request', 'uses' => 'SupplierOrderController@dataRequest']);
                Route::get('supplier-order.data-return-order', ['as' => 'supplier-order.data-return-order', 'uses' => 'SupplierOrderController@dataReturnOrder']);
                Route::post('supplier-order.return-order', ['as' => 'supplier-order.return-order', 'uses' => 'SupplierOrderController@returnOrder']);
                Route::get('supplier-order.detail-return', ['as' => 'supplier-order.detail-return', 'uses' => 'SupplierOrderController@detailReturnOrder']);
            }
        );

        /**
         * Trans: Quản lý kho chi nhánh
         */
        Route::group(
            ['namespace' => 'Inventory', 'as' => 'inventory.', 'middleware' => []],
            function () {

                /**
                 * Eng: in-inventory-internal-branch-manage
                 * Trans: nhập kho chi nhánh khác
                 */
                Route::resource('in-inventory-branch-manage', 'InInventoryBranchController');
                Route::get('in-inventory-branch-manage.data', ['as' => 'in-inventory-branch-manage.data', 'uses' => 'InInventoryBranchController@data']);
                Route::get('in-inventory-branch-manage.detail', ['as' => 'in-inventory-branch-manage.detail', 'uses' => 'InInventoryBranchController@detail']);
                Route::post('in-inventory-branch-manage.confirm', ['as' => 'in-inventory-branch-manage.confirm', 'uses' => 'InInventoryBranchController@confirm']);
                Route::post('in-inventory-branch-manage.cancel', ['as' => 'in-inventory-branch-manage.cancel', 'uses' => 'InInventoryBranchController@cancel']);
                Route::get('in-inventory-branch-manage.out-inventory-data', ['as' => 'in-inventory-branch-manage.out-inventory-data', 'uses' => 'InInventoryBranchController@dataOutInventory']);


                /**
                 * Eng: out-inventory-internal-branch-manage
                 * Trans: xuất kho chi nhánh khác
                 */
                Route::resource('out-inventory-branch-manage', 'OutInventoryBranchController');
                Route::get('out-inventory-branch-manage.data', ['as' => 'out-inventory-branch-manage.data', 'uses' => 'OutInventoryBranchController@data']);
                Route::get('out-inventory-branch-manage.detail', ['as' => 'out-inventory-branch-manage.detail', 'uses' => 'OutInventoryBranchController@detail']);
                Route::get('out-inventory-branch-manage-update', ['as' => 'out-inventory-branch-manage.data-update', 'uses' => 'OutInventoryBranchController@dataUpdate']);
                Route::post('out-inventory-branch-manage.create', ['as' => 'out-inventory-branch-manage.create', 'uses' => 'OutInventoryBranchController@create']);
                Route::get('out-inventory-branch-manage.material', ['as' => 'out-inventory-branch-manage.material', 'uses' => 'OutInventoryBranchController@material']);
                Route::post('out-inventory-branch-manage.update', ['as' => 'out-inventory-branch-manage.update', 'uses' => 'OutInventoryBranchController@update']);
                Route::post('out-inventory-branch-manage.cancel', ['as' => 'out-inventory-branch-manage.cancel', 'uses' => 'OutInventoryBranchController@cancel']);
                Route::post('out-inventory-branch-manage.confirm', ['as' => 'out-inventory-branch-manage.confirm', 'uses' => 'OutInventoryBranchController@confirm']);

                /**
                 * Eng: in-inventory-manage
                 * Trans: Nhập kho
                 */
                Route::resource('in-inventory-manage', 'InInventoryController');
                Route::get('in-inventory-manage.data', ['as' => 'in-inventory-manage.data', 'uses' => 'InInventoryController@data']);
                Route::get('in-inventory-manage.detail', ['as' => 'in-inventory-manage.detail', 'uses' => 'InInventoryController@detail']);
                //                Route::get('in-inventory-manage.supplier', ['as' => 'in-inventory-manage.supplier', 'uses' => 'InInventoryController@supplier']);
                //                Route::post('in-inventory-manage.material', ['as' => 'in-inventory-manage.material', 'uses' => 'InInventoryController@material']);
                //                Route::post('in-inventory-manage.create', ['as' => 'in-inventory-manage.create', 'uses' => 'InInventoryController@create']);
                //                Route::get('in-inventory-manage.data-update', ['as' => 'in-inventory-manage.data-update', 'uses' => 'InInventoryController@dataUpdate']);
                //                Route::post('in-inventory-manage.update', ['as' => 'in-inventory-manage.update', 'uses' => 'InInventoryController@update']);
                //                Route::post('in-inventory-manage.cancel', ['as' => 'in-inventory-manage.cancel', 'uses' => 'InInventoryController@cancel']);
                /**
                 * Eng: out-inventory-manage
                 * Trans: Xuất kho
                 */
                Route::resource('out-inventory-manage', 'OutInventoryController');
                Route::get('out-inventory-manage.data', ['as' => 'out-inventory-manage.data', 'uses' => 'OutInventoryController@data']);
                Route::get('out-inventory-manage.detail', ['as' => 'out-inventory-manage.detail', 'uses' => 'OutInventoryController@detail']);
                Route::get('out-inventory-manage.supplier', ['as' => 'out-inventory-manage.supplier', 'uses' => 'OutInventoryController@supplier']);
                Route::get('out-inventory-manage.material', ['as' => 'out-inventory-manage.material', 'uses' => 'OutInventoryController@material']);
                Route::post('out-inventory-manage.create', ['as' => 'out-inventory-manage.create', 'uses' => 'OutInventoryController@create']);
                Route::get('out-inventory-manage.data-update', ['as' => 'out-inventory-manage.data-update', 'uses' => 'OutInventoryController@dataUpdate']);
                Route::post('out-inventory-manage.update', ['as' => 'out-inventory-manage.update', 'uses' => 'OutInventoryController@update']);
                Route::post('out-inventory-manage.cancel', ['as' => 'out-inventory-manage.cancel', 'uses' => 'OutInventoryController@cancel']);
                Route::get('out-inventory-manage.export', ['as' => 'out-inventory-manage.export', 'uses' => 'OutInventoryController@export']);
                Route::get('out-inventory-manage.data-export', ['as' => 'out-inventory-manage.data-export', 'uses' => 'OutInventoryController@dataExport']);


                /**
                 * Eng: checklist-goods-manage
                 * Trans: Kiểm kê
                 */
                Route::resource('checklist-goods-manage', 'CheckListGoodsController');
                Route::get('checklist-goods-manage.data', ['as' => 'CheckList-goods.data', 'uses' => 'CheckListGoodsController@data']);
                Route::get('checklist-goods-manage.detail', ['as' => 'checklist-goods-manage.detail', 'uses' => 'CheckListGoodsController@dataDetail']);
                Route::get('checklist-goods-manage.data-material', ['as' => 'checklist-goods-manage.data-material', 'uses' => 'CheckListGoodsController@dataMaterial']);
                Route::get('checklist-goods-manage.final', ['as' => 'checklist-goods-manage.final', 'uses' => 'CheckListGoodsController@finalChecklistGoods']);
                Route::post('checklist-goods-manage.create', ['as' => 'checklist-goods-manage.create', 'uses' => 'CheckListGoodsController@create']);
                Route::get('checklist-goods-manage.data-update', ['as' => 'checklist-goods-manage.data-edit', 'uses' => 'CheckListGoodsController@dataUpdate']);
                Route::post('checklist-goods-manage.confirm', ['as' => 'checklist-goods-manage.confirm', 'uses' => 'CheckListGoodsController@confirm']);
                Route::post('checklist-goods-manage.cancel', ['as' => 'checklist-goods-manage.cancel', 'uses' => 'CheckListGoodsController@changeStatusCheckList']);
                Route::post('checklist-goods-manage.confirm-checklist', ['as' => 'checklist-goods-manage.confirm-checklist', 'uses' => 'CheckListGoodsController@changeStatusCheckList']);

                /**
                 * Eng: checklist-goods-internal-manage
                 * Trans: Kiểm kê nội bộ
                 */
                Route::resource('checklist-goods-internal-manage', 'ChecklistGoodsInternalController');
                Route::get('checklist-goods-internal-manage.data', ['as' => 'checklist-goods-internal-manage.data', 'uses' => 'ChecklistGoodsInternalController@data']);
                Route::get('checklist-goods-internal-manage.detail', ['as' => 'checklist-goods-internal-manage.detail', 'uses' => 'ChecklistGoodsInternalController@detail']);
                Route::get('checklist-goods-internal-manage.data-material', ['as' => 'checklist-goods-internal-manage.data-material', 'uses' => 'ChecklistGoodsInternalController@dataMaterial']);
                Route::get('checklist-goods-internal-manage.final', ['as' => 'checklist-goods-internal-manage.final', 'uses' => 'ChecklistGoodsInternalController@finalChecklistGoods']);
                Route::post('checklist-goods-internal-manage.create', ['as' => 'checklist-goods-internal-manage.create', 'uses' => 'ChecklistGoodsInternalController@create']);
                Route::get('checklist-goods-internal-manage.data-update', ['as' => 'checklist-goods-internal-manage.data-update', 'uses' => 'ChecklistGoodsInternalController@dataUpdate']);
                Route::post('checklist-goods-internal-manage.update', ['as' => 'checklist-goods-internal-manage.update', 'uses' => 'ChecklistGoodsInternalController@update']);
                Route::post('checklist-goods-internal-manage.confirm', ['as' => 'checklist-goods-internal-manage.confirm', 'uses' => 'ChecklistGoodsInternalController@changeStatus']);
                Route::post('checklist-goods-internal-manage.cancel', ['as' => 'checklist-goods-internal-manage.cancel', 'uses' => 'ChecklistGoodsInternalController@changeStatus']);
                Route::get('checklist-goods-internal-manage.select-material', ['as' => 'checklist-goods-internal-manage.select-material', 'uses' => 'ChecklistGoodsInternalController@dataSelectMaterial']);


                /**
                 * Eng: cancel-inventory-manage
                 * Trans: Hủy hàng
                 */
                Route::resource('cancel-inventory-manage', 'CancelInventoryController');
                Route::get('cancel-inventory-manage.data', ['as' => 'cancel-inventory-manage.data', 'uses' => 'CancelInventoryController@data']);
                Route::get('cancel-inventory-manage.material', ['as' => 'cancel-inventory-manage.material', 'uses' => 'CancelInventoryController@material']);
                Route::post('cancel-inventory-manage.create', ['as' => 'cancel-inventory-manage.create', 'uses' => 'CancelInventoryController@create']);
                Route::get('cancel-inventory-manage.detail', ['as' => 'cancel-inventory-manage.detail', 'uses' => 'CancelInventoryController@detail']);
            }
        );
        /**
         * Trans: Quản lý kho nội bộ
         */
        Route::group(
            ['namespace' => 'InventoryInternal', 'as' => 'inventory_internal.', 'middleware' => []],
            function () {

                /**
                 * Eng: return-inventory-internal-manage
                 * Trans: Nhập kho nội bộ
                 */
                Route::resource('in-inventory-internal-manage', 'InInventoryInternalController');
                Route::get('in-inventory-internal-manage.data', ['as' => 'in-inventory-internal-manage.data', 'uses' => 'InInventoryInternalController@data']);
                Route::get('in-inventory-internal-manage.detail', ['as' => 'in-inventory-internal-manage.detail', 'uses' => 'InInventoryInternalController@detail']);


                /**
                 * Eng: return-inventory-internal-manage
                 * Trans: Trả hàng
                 */
                Route::resource('return-inventory-internal-manage', 'ReturnInventoryInternalController');
                Route::get('return-inventory-internal-manage.data', ['as' => 'return-inventory-internal-manage.data', 'uses' => 'ReturnInventoryInternalController@data']);
                Route::get('return-inventory-internal-manage.inventory', ['as' => 'return-inventory-internal-manage.inventory', 'uses' => 'ReturnInventoryInternalController@dataInventory']);
                //                Route::get('return-inventory-internal-manage.detail-inventory', ['as' => 'return-inventory-internal-manage.detail-inventory', 'uses' => 'ReturnInventoryInternalController@detailInventory']);
                Route::post('return-inventory-internal-manage.create', ['as' => 'return-inventory-internal-manage.data_return', 'uses' => 'ReturnInventoryInternalController@create']);
                Route::post('return-inventory-internal-manage.cancel', ['as' => 'return-inventory-internal-manage.cancel', 'uses' => 'ReturnInventoryInternalController@cancel']);
                Route::post('return-inventory-internal-manage.confirm', ['as' => 'return-inventory-internal-manage.confirm', 'uses' => 'ReturnInventoryInternalController@confirm']);
                Route::get('return-inventory-internal-manage.detail', ['as' => 'return-inventory-internal-manage.detail', 'uses' => 'ReturnInventoryInternalController@detail']);
                Route::get('return-inventory-internal-manage.material-internal', ['as' => 'return-inventory-internal-manage.material-internal', 'uses' => 'ReturnInventoryInternalController@materialInternal']);


                /**
                 * Eng: cancel-inventory-internal-manage
                 * Trans: Hủy hàng
                 */
                Route::resource('cancel-inventory-internal-manage', 'CancelInventoryInternalController');
                Route::get('cancel-inventory-internal-manage.data', ['as' => 'cancel-inventory-internal-manage.data', 'uses' => 'CancelInventoryInternalController@data']);
                Route::get('cancel-inventory-internal-manage.data-update', ['as' => 'cancel-inventory-internal-manage.data-update', 'uses' => 'CancelInventoryInternalController@dataUpdate']);
                Route::get('cancel-inventory-internal-manage.material', ['as' => 'cancel-inventory-internal-manage.material', 'uses' => 'CancelInventoryInternalController@material']);
                Route::post('cancel-inventory-internal-manage.create', ['as' => 'cancel-inventory-internal-manage.create', 'uses' => 'CancelInventoryInternalController@create']);
                Route::post('cancel-inventory-internal-manage.update', ['as' => 'cancel-inventory-internal-manage.update', 'uses' => 'CancelInventoryInternalController@update']);
                Route::post('cancel-inventory-internal-manage.cancel', ['as' => 'cancel-inventory-internal-manage.cancel', 'uses' => 'CancelInventoryInternalController@cancel']);
                Route::post('cancel-inventory-internal-manage.confirm', ['as' => 'cancel-inventory-internal-manage.confirm', 'uses' => 'CancelInventoryInternalController@confirm']);
                Route::get('cancel-inventory-internal-manage.detail', ['as' => 'cancel-inventory-internal-manage.detail', 'uses' => 'CancelInventoryInternalController@detail']);
                Route::get('cancel-inventory-internal-manage.material-internal', ['as' => 'cancel-inventory-internal-manage.material-internal', 'uses' => 'CancelInventoryInternalController@materialInternal']);
            }
        );

        /**
         * Trans: Quản lý kho tổng
         */
        Route::group(
            ['namespace' => 'Warehouse', 'as' => 'warehouse.', 'middleware' => []],
            function () {
                Route::resource('warehouse-manage', 'WarehouseController');
                /**
                 * Eng: goods-purchase-total-warehouse-manage
                 * Trans: Quản lý mua hàng
                 */
                Route::resource('goods-purchase-warehouse', 'GoodsPurchaseController');
                Route::get('goods-purchase-warehouse.data-request', ['as' => 'goods-purchase-warehouse.data-request', 'uses' => 'GoodsPurchaseController@dataRequest']);

                Route::get('goods-purchase-warehouse.data-order-waiting', ['as' => 'goods-purchase-warehouse.data-order-waiting', 'uses' => 'GoodsPurchaseController@listOrderWaitingSupplierConfirm']);
                Route::get('goods-purchase-warehouse.data-update-order-waiting-supplier', ['as' => 'goods-purchase-warehouse.data-update-order-waiting-supplier', 'uses' => 'GoodsPurchaseController@dataUpdateOrderWaitingSupplier']);
                Route::post('goods-purchase-warehouse.cancel-order-waiting-supplier', ['as' => 'goods-purchase-warehouse.cancel-order-waiting-supplier', 'uses' => 'GoodsPurchaseController@cancelOrderWaitingSupplier']);


                Route::get('goods-purchase-warehouse.data-list-order', ['as' => 'goods-purchase-warehouse.data-list-order', 'uses' => 'GoodsPurchaseController@dataListOrder']);
                Route::get('goods-purchase-warehouse.data-list-return', ['as' => 'goods-purchase-warehouse.data-list-return', 'uses' => 'GoodsPurchaseController@dataListReturn']);
                Route::get('goods-purchase-warehouse.history-request', ['as' => 'goods-purchase-warehouse.history-request', 'uses' => 'GoodsPurchaseController@historyRequest']);
                Route::get('goods-purchase-warehouse.material', ['as' => 'goods-purchase-warehouse.material', 'uses' => 'GoodsPurchaseController@material']);
                Route::get('goods-purchase-warehouse.list-total-warehouse', ['as' => 'goods-purchase-warehouse.list-total-warehouse', 'uses' => 'GoodsPurchaseController@listTotalWarehouse']);
                Route::post('goods-purchase-warehouse.create', ['as' => 'goods-purchase-warehouse.create', 'uses' => 'GoodsPurchaseController@create']);
                Route::post('goods-purchase-warehouse.create-by-request', ['as' => 'goods-purchase-warehouse.create-by-request', 'uses' => 'GoodsPurchaseController@createByRequest']);
                Route::get('goods-purchase-warehouse.export-by-request', ['as' => 'goods-purchase-warehouse.export-by-request', 'uses' => 'GoodsPurchaseController@export']);
                Route::get('goods-purchase-warehouse.data-export', ['as' => 'goods-purchase-warehouse.data-export', 'uses' => 'GoodsPurchaseController@dataExport']);
                Route::post('goods-purchase.confirm-request', ['as' => 'goods-purchase.confirm-request', 'uses' => 'GoodsPurchaseController@handleOrderRequest']);
                Route::get('goods-purchase.detail-order-request', ['as' => 'goods-purchase.detail-order-request', 'uses' => 'GoodsPurchaseController@detailOrderRequest']);

                /**
                 * Eng: out-inventory-total-warehouse-manage
                 * Trans: Xuất xuống kho chi nhánh
                 */
                Route::resource('export-inventory-warehouse', 'ExportInventoryController');
                Route::get('export-inventory-warehouse.data', ['as' => 'export-inventory-warehouse.data', 'uses' => 'ExportInventoryController@data']);
                Route::post('export-inventory-warehouse.create', ['as' => 'export-inventory-warehouse.create', 'uses' => 'ExportInventoryController@create']);
                Route::get('export-inventory-warehouse.list-branch', ['as' => 'export-inventory-warehouse.list-branch', 'uses' => 'ExportInventoryController@listBranch']);
                Route::get('export-inventory-warehouse.material', ['as' => 'export-inventory-warehouse.material', 'uses' => 'ExportInventoryController@material']);
                Route::get('export-inventory-warehouse.detail', ['as' => 'export-inventory-warehouse.detail', 'uses' => 'ExportInventoryController@detail']);
                Route::get('export-inventory-warehouse.list-request', ['as' => 'export-inventory-warehouse.list-request', 'uses' => 'ExportInventoryController@listRequest']);

                /**
                 * Eng: return-inventory-internal-manage
                 * Trans: Kiểm kê
                 */
                Route::resource('inventory', 'InventoryController');
                Route::get('inventory.data', ['as' => 'inventory.data', 'uses' => 'InventoryController@data']);
                Route::post('inventory.confirm-checklist', ['as' => ' inventory.confirm-checklist', 'uses' => 'InventoryController@confirmChecklist']);
                Route::get('inventory.detail', ['as' => 'inventory.detail', 'uses' => 'InventoryController@dataDetail']);
                Route::get('inventory.data-material', ['as' => 'inventory.data-material', 'uses' => 'InventoryController@dataMaterial']);
                Route::get('inventory.final', ['as' => 'inventory.final', 'uses' => 'InventoryController@finalChecklistGoods']);
                Route::post('inventory.create', ['as' => 'inventory.create', 'uses' => 'InventoryController@create']);
                Route::get('inventory.data-update', ['as' => 'inventory.data-edit', 'uses' => 'InventoryController@dataUpdate']);
                Route::post('inventory.confirm', ['as' => 'inventory.confirm', 'uses' => 'InventoryController@confirm']);
                Route::post('inventory.cancel', ['as' => 'inventory.cancel', 'uses' => 'InventoryController@cancel']);

                /**
                 * Eng: cancel-inventory-total-warehouse-manage
                 * Trans: Hủy hàng
                 */
                Route::resource('cancel-inventory-warehouse', 'CancelInventoryController');
                Route::get('cancel-inventory-warehouse.data', ['as' => 'cancel-inventory-warehouse.data', 'uses' => 'CancelInventoryController@data']);
                Route::post('cancel-inventory-warehouse.create', ['as' => 'cancel-inventory-warehouse.create', 'uses' => 'CancelInventoryController@create']);
                Route::get('cancel-inventory-warehouse.data-material', ['as' => 'cancel-inventory-warehouse.data-material', 'uses' => 'CancelInventoryController@dataMaterial']);
                Route::get('cancel-inventory-warehouse.detail', ['as' => 'cancel-inventory-warehouse.detail', 'uses' => 'CancelInventoryController@detail']);

                /**
                 * Eng: cancel-inventory-total-warehouse-manage
                 * Trans: Trả hàng
                 */
                Route::resource('return-inventory-warehouse', 'ReturnInventoryController');
                Route::get('return-inventory-warehouse.data', ['as' => 'return-inventory-warehouse.data', 'uses' => 'ReturnInventoryController@data']);
                Route::get('return-inventory-warehouse.detail', ['as' => 'return-inventory-warehouse.detail', 'uses' => 'ReturnInventoryController@detail']);
                Route::post('return-inventory-warehouse.confirm', ['as' => 'return-inventory-warehouse.confirm', 'uses' => 'ReturnInventoryController@confirm']);
                Route::post('return-inventory-warehouse.cancel', ['as' => 'return-inventory-warehouse.cancel', 'uses' => 'ReturnInventoryController@cancel']);
                Route::get('return-inventory-warehouse.out-inventory-data', ['as' => 'return-inventory-warehouse.out-inventory-data', 'uses' => 'ReturnInventoryController@dataOutInventory']);

                //                /**
                //                 * Eng: in-inventory-supplier
                //                 * Trans: Nhập kho từ NCC
                //                 */
                //                Route::resource('in-inventory-supplier', 'InInventorySupplierController');
                //                Route::get('in-inventory-supplier.data', ['as' => 'in-inventory-supplier.data', 'uses' => 'InInventorySupplierController@data']);
                //                Route::get('in-inventory-supplier.detail', ['as' => 'in-inventory-supplier.detail', 'uses' => 'InInventorySupplierController@detail']);

                /**
                 * Eng: assign-warehouse-branch
                 * Trans: Gán kho chi nhánh
                 */
                Route::resource('assign-warehouse-branch', 'AssignWarehouseBranchController');
                Route::get('assign-warehouse-branch.data', ['as' => 'assign-warehouse-branch.data', 'uses' => 'AssignWarehouseBranchController@data']);
                Route::get('assign-warehouse-branch.data-branch-assign-warehouse', ['as' => 'assign-warehouse-branch.data-branch-assign-warehouse', 'uses' => 'AssignWarehouseBranchController@dataBranchAssignWarehouse']);
                Route::post('assign-warehouse-branch.assign', ['as' => 'assign-warehouse-branch.assign', 'uses' => 'AssignWarehouseBranchController@assign']);
            }

        );


        /**
         * Eng: booking-table-manage
         * Trans: Quản lý đặt bàn
         */
        Route::group(
            ['namespace' => 'BookingTable', 'as' => 'booking_table.', 'middleware' => []],
            function () {
                Route::resource('booking-table-manage', 'BookingTableController');
                Route::get('booking-table-manage.data', ['as' => 'booking-table-manage.data', 'uses' => 'BookingTableController@data']);
                Route::get('booking-table-manage.detail', ['as' => 'booking-table-manage.detail', 'uses' => 'BookingTableController@detail']);
                Route::get('booking-table-manage.data-confirm-table', ['as' => 'booking-table-manage.data-confirm-table', 'uses' => 'BookingTableController@dataConfirm']);
                Route::get('booking-table-manage.table', ['as' => 'booking-table-manage.table', 'uses' => 'BookingTableController@table']);
                Route::post('booking-table-manage.confirm', ['as' => 'booking-table-manage.confirm', 'uses' => 'BookingTableController@confirm']);
                Route::post('booking-table-manage.confirm-table', ['as' => 'booking-table-manage.confirm-table', 'uses' => 'BookingTableController@confirmTable']);
                Route::post('booking-table-manage.accept-customer', ['as' => 'booking-table-manage.accept-customer', 'uses' => 'BookingTableController@acceptCustomer']);
                Route::get('booking-table-manage.food', ['as' => 'booking-table-manage.food', 'uses' => 'BookingTableController@food']);
                Route::get('booking-table-manage.employee', ['as' => 'booking-table-manage.employee', 'uses' => 'BookingTableController@employee']);
                Route::get('booking-table-manage.data-update', ['as' => 'booking-table-manage.data-update', 'uses' => 'BookingTableController@dataUpdate']);
                Route::get('booking-table-manage.data-area-table-update', ['as' => 'booking-table-manage.data-area-table-update', 'uses' => 'BookingTableController@getAreaTableUpdate']);
                Route::get('booking-table-manage.data-area-update', ['as' => 'booking-table-manage.data-area-update', 'uses' => 'BookingTableController@getAreaUpdate']);
                Route::get('booking-table-manage.data-table-update', ['as' => 'booking-table-manage.data-table-update', 'uses' => 'BookingTableController@getTableUpdate']);
                Route::post('booking-table-manage.update', ['as' => 'booking-table-manage.update', 'uses' => 'BookingTableController@update']);
                Route::post('booking-table-manage.create', ['as' => 'booking-table-manage.create', 'uses' => 'BookingTableController@create']);
                Route::post('booking-table-manage.setting', ['as' => 'booking-table-manage.setting', 'uses' => 'BookingTableController@setting']);
                Route::get('booking-table-manage.search-customer', ['as' => 'booking-table-manage.search-customer', 'uses' => 'BookingTableController@searchCustomer']);
                Route::post('booking-table-manage.return-deposit', ['as' => 'booking-table-manage.return-deposit', 'uses' => 'BookingTableController@returnDeposit']);
                Route::post('booking-table-manage.cancel', ['as' => 'booking-table-manage.cancel', 'uses' => 'BookingTableController@cancel']);
                Route::post('booking-table-manage.setup', ['as' => 'booking-table-manage.setup', 'uses' => 'BookingTableController@setup']);
                Route::post('booking-table-manage.update-deposit', ['as' => 'booking-table-manage.update-deposit', 'uses' => 'BookingTableController@updateDeposit']);
                Route::post('booking-table-manage.confirm-deposit', ['as' => 'booking-table-manage.confirm-deposit', 'uses' => 'BookingTableController@confirmDeposit']);
                Route::get('booking-table-manage.total-booking', ['as' => 'booking-table-manage.total-booking', 'uses' => 'BookingTableController@totalBookingProsesing']);
                Route::get('booking-table-manage.data-gift', ['as' => 'booking-table-manage.data-gift', 'uses' => 'BookingTableController@dataGift']);
                Route::get('branch-detail.data-profile', ['as' => 'booking-table-manage.data-table-update', 'uses' => 'BookingTableController@getBranchDetail']);
                Route::get('branch-detail.data-booking', ['as' => 'branch-detail.data-booking', 'uses' => 'BookingTableController@dataBooking']);
                Route::get('branch-detail.data-list-branch-booking', ['as' => 'branch-detail.data-list-branch-booking', 'uses' => 'BookingTableController@dataListbranch']);
                Route::get('booking-table-manage.tags', ['as' => 'booking-table-manage.tag', 'uses' => 'BookingTableController@dataTags']);
                Route::post('booking-table.accept-setup', ['as' => 'booking-table.accept-setup', 'uses' => 'BookingTableController@acceptSetupTable']);
            }
        );
        /**
         * Trans: Quản lý món ăn
         */
        Route::group(
            ['namespace' => 'Food', 'as' => 'food.', 'middleware' => []],
            function () {
                /**
                 * Eng: food-branch-manage
                 * Trans: Chi nhánh
                 */
                Route::resource('food-branch-manage', 'FoodBranchManageController');
                Route::get('food-branch-manage.data', ['as' => 'food-branch-manage.data', 'uses' => 'FoodBranchManageController@data']);
                Route::get('food-branch-manage.data-disable', ['as' => 'food-branch-manage.data-disable', 'uses' => 'FoodBranchManageController@dataDisable']);
                Route::get('food-branch-manage.data-price-by-area', ['as' => 'food-branch-manage.data-price-by-area', 'uses' => 'FoodBranchManageController@dataPriceByArea']);
                Route::post('food-branch-manage.change-status', ['as' => 'food-branch-manage.change-status', 'uses' => 'FoodBranchManageController@changeStatus']);
                Route::get('food-branch-manage.data-kitchen', ['as' => 'food-branch-manage.data-kitchen', 'uses' => 'FoodBranchManageController@dataKitchen']);
                Route::get('food-branch-manage.data-food-kitchen', ['as' => 'food-branch-manage.data-food-kitchen', 'uses' => 'FoodBranchManageController@dataFoodKitchen']);
                Route::post('food-branch-manage.change-kitchen', ['as' => 'food-branch-manage.change-kitchen', 'uses' => 'FoodBranchManageController@changeKitchen']);
                Route::get('food-branch-manage.data-update', ['as' => 'food-branch-manage.data-update', 'uses' => 'FoodBranchManageController@dataUpdate']);
                Route::post('food-branch-manage.update', ['as' => 'food-branch-manage.update', 'uses' => 'FoodBranchManageController@update']);
                Route::get('food-branch-manage.data-update-food-area', ['as' => 'food-branch-manage.data-update-food-area', 'uses' => 'FoodBranchManageController@dataUpdateFoodArea']);
                Route::post('food-branch-manage.update-food-area', ['as' => 'food-branch-manage.update-food-area', 'uses' => 'FoodBranchManageController@updateFoodArea']);
                Route::get('food-branch-manage.category', ['as' => 'food-branch-manage.category', 'uses' => 'FoodBranchManageController@category']);

                /**
                 * Eng: food-brand-manage
                 * Trans: Thương hiệu
                 */
                Route::resource('food-brand-manage', 'FoodBrandManageController');
                Route::get('food-brand-manage.data', ['as' => 'food-brand-manage.data', 'uses' => 'FoodBrandManageController@data']);
                Route::get('food-brand-manage.data-count-tab', ['as' => 'food-brand-manage.data-count-tab', 'uses' => 'FoodBrandManageController@dataCountTab']);
                Route::get('food-brand-manage.data-disable', ['as' => 'food-brand-manage.data-disable', 'uses' => 'FoodBrandManageController@dataDisable']);
                Route::get('food-brand-manage.data-create', ['as' => 'food-brand-manage.data-create', 'uses' => 'FoodBrandManageController@dataCreate']);
                Route::get('food-brand-manage.data-food-detail', ['as' => 'food-brand-manage.data-food-detail', 'uses' => 'FoodBrandManageController@dataFoodDetail']);
                Route::get('food-brand-manage.data-food-unexist-category', ['as' => 'food-brand-manage.data-food-unexist-category', 'uses' => 'FoodBrandManageController@getFoodUnExistCategory']);
                Route::post('food-brand-manage.assign-food', ['as' => 'food-brand-manage.assign-food', 'uses' => 'FoodBrandManageController@AssignFood']);
                Route::post('food-brand-manage.create', ['as' => 'food-brand-manage.create', 'uses' => 'FoodBrandManageController@create']);
                Route::post('food-brand-manage.update', ['as' => 'food-brand-manage.update', 'uses' => 'FoodBrandManageController@update']);
                Route::get('food-brand-manage.data-food-update', ['as' => 'food-brand-manage.data-food-update', 'uses' => 'FoodBrandManageController@dataFoodUpdate']);
                Route::get('food-brand-manage.data-combo', ['as' => 'food-brand-manage.data-combo', 'uses' => 'FoodBrandManageController@dataCombo']);
                Route::post('food-brand-manage.combo', ['as' => 'food-brand-manage.combo', 'uses' => 'FoodBrandManageController@combo']);
                Route::post('food-brand-manage.update-images', ['as' => 'food-brand-manage.update-images', 'uses' => 'FoodBrandManageController@updateImages']);
                Route::post('food-brand-manage.change-status', ['as' => 'food-brand-manage.change-status', 'uses' => 'FoodBrandManageController@changeStatus']);
                Route::get('/file/template', ['as' => 'food-brand-manage.template', 'uses' => 'FoodBrandManageController@downloadTemplate']);
                Route::get('food-brand-manage.material', ['as' => 'food-brand-manage.material', 'uses' => 'FoodBrandManageController@material']);
                Route::get('food-brand-manage.material-quantitative', ['as' => 'food-brand-manage.material-quantitative', 'uses' => 'FoodBrandManageController@materialQuantitative']);
                Route::post('food-brand-manage.create-quantity', ['as' => 'food-brand-manage.create-quantity', 'uses' => 'FoodBrandManageController@createMaterial']);
                Route::get('food-brand-manage.data-kitchen', ['as' => 'food-brand-manage.data-kitchen', 'uses' => 'FoodBrandManageController@dataKitchen']);
                Route::get('food-brand-manage.option-food-addition', ['as' => 'food-brand-manage.option-food-addition', 'uses' => 'FoodBrandManageController@foodOptionAdditon']);
                Route::get('food-brand-manage.unit', ['as' => 'food-brand-manage.unit', 'uses' => 'FoodBrandManageController@unit']);
                Route::get('food-brand-manage.category', ['as' => 'food-brand-manage.category', 'uses' => 'FoodBrandManageController@category']);
                Route::get('food-brand-manage.food-note', ['as' => 'food-brand-manage.food-note', 'uses' => 'FoodBrandManageController@foodNote']);
                Route::get('food-brand-manage.food-create-food', ['as' => 'food-brand-manage.food-create-food', 'uses' => 'FoodBrandManageController@dataCreateFoodManage']);
                Route::get('food-brand-manage.vat', ['as' => 'food-brand-manage.vat', 'uses' => 'FoodBrandManageController@vat']);
                Route::post('food-brand-manage.setup-vat', ['as' => 'food-brand-manage.setup-vat', 'uses' => 'FoodBrandManageController@setupVat']);
                Route::get('food-brand-manage.data-update', ['as' => 'food-brand-manage.data-update', 'uses' => 'FoodBrandManageController@dataUpdateFoodManage']);
                Route::post('food-brand-manage.remove-vat', ['as' => 'food-brand-manage.remove-vat', 'uses' => 'FoodBrandManageController@cancelVat']);
                Route::get('food-brand-manage.data-food-vat', ['as' => 'food-brand-manage.data-food-vat', 'uses' => 'FoodBrandManageController@dataFoodVat']);
                Route::get('food-brand-manage.material-unit-food-map', ['as' => 'food-brand-manage.material-unit-food-map', 'uses' => 'FoodBrandManageController@unitFoodMap']);
                Route::get('food-brand-manage.alert-original-price', ['as' => 'food-brand-manage.alert-original-price', 'uses' => 'FoodBrandManageController@dataAlertOriginalPrice']);
            }
        );
        /**
         * Eng: employee-manage
         * Trans: nhân viên
         */
        Route::group(
            ['namespace' => 'Employee', 'as' => 'employee.', 'middleware' => []],
            function () {
                Route::resource('employee-manage', 'EmployeeController');
                Route::get('employee-manage.data', ['as' => 'employee-manage.data', 'uses' => 'EmployeeController@data']);
                Route::get('employee-manage.role', ['as' => 'employee-manage.role', 'uses' => 'EmployeeController@role']);
                Route::get('employee-manage.rank', ['as' => 'employee-manage.rank', 'uses' => 'EmployeeController@rank']);
                Route::get('employee-manage.salary', ['as' => 'employee-manage.salary', 'uses' => 'EmployeeController@salary']);
                Route::get('employee-manage.area', ['as' => 'employee-manage.area', 'uses' => 'EmployeeController@area']);
                Route::get('employee-manage.work', ['as' => 'employee-manage.work', 'uses' => 'EmployeeController@work']);
                Route::get('employee-manage.employee-to-branch', ['as' => 'employee-to-branch', 'uses' => 'EmployeeController@employeeToBranch']);
                Route::get('employee-manage.detail', ['as' => 'employee-manage.detail', 'uses' => 'EmployeeController@detail']);
                Route::get('employee-manage.info', ['as' => 'employee-manage.info', 'uses' => 'EmployeeController@info']);
                Route::post('employee-manage.update-ares-salary', ['as' => 'employee-manage.update-ares-salary', 'uses' => 'EmployeeController@updateAresSalary']);
                Route::get('employee-manage.data-update', ['as' => 'employee-manage.data-update', 'uses' => 'EmployeeController@dataUpdate']);
                Route::post('employee-manage.update-employee', ['as' => 'employee-manage.update-employee', 'uses' => 'EmployeeController@update']);
                Route::post('employee-manage.update-rank-salary', ['as' => 'employee-manage.update-rank-salary', 'uses' => 'EmployeeController@updateRankSalary']);
                Route::post('employee-manage.update', ['as' => 'employee-manage.update', 'uses' => 'EmployeeController@update']);
                Route::post('employee-manage.create', ['as' => 'employee-manage.create', 'uses' => 'EmployeeController@create']);
                Route::get('employee-manage.data-off', ['as' => 'employee-manage.data-off', 'uses' => 'EmployeeController@dataOff']);
                Route::post('employee-manage.update-off', ['as' => 'employee-manage.update-off', 'uses' => 'EmployeeController@updateOff']);
                Route::post('employee-manage.quit-job', ['as' => 'employee-manage.quit-job', 'uses' => 'EmployeeController@changeStatusWorking']);
                Route::post('employee-manage.off', ['as' => 'employee-manage.off', 'uses' => 'EmployeeController@changeStatus']);
                Route::post('employee-manage.update-branch-employee', ['as' => 'employee-manage.update-branch-employee', 'uses' => 'EmployeeController@updateBranchEmployee']);
                Route::post('employee-manage.update-role-employee', ['as' => 'employee-manage.update-role-employee', 'uses' => 'EmployeeController@updateRoleEmployee']);
                Route::post('employee-manage.reset-password', ['as' => 'employee-manage.reset-password', 'uses' => 'EmployeeController@resetPassWord']);
                Route::get('employee-manage.get-data-create-employee', ['as' => 'employee-manage.get-data-create-employee', 'uses' => 'EmployeeController@getAllDataEmployee']);
                Route::get('employee-manage.data-select-load-update', ['as' => 'employee-manage.data-select-load-update', 'uses' => 'EmployeeController@dataSelectLoadUpdate']);
                Route::get('employee-manage.data-select-role', ['as' => 'employee-manage.data-select-role', 'uses' => 'EmployeeController@dataSelectRole']);
                Route::get('employee-manage.get-branch', ['as' => 'employee-manage.get-branch', 'uses' => 'EmployeeController@getBranch']);
                Route::get('employee-manage.cities-data', ['as' => 'employee-manage.cities-data', 'uses' => 'EmployeeController@dataSelectCity']);
                Route::get('employee-manage.districts-data', ['as' => 'employee-manage.districts-data', 'uses' => 'EmployeeController@dataSelectDistrict']);
                Route::get('employee-manage.wards-data', ['as' => 'employee-manage.wards-data', 'uses' => 'EmployeeController@dataSelectWard']);
            }
        );

        /**
         * Eng: employee-off-manage
         * Trans: Hoạt động
         */
        Route::group(
            ['namespace' => 'EmployeeOff', 'as' => 'employee_off.', 'middleware' => []],
            function () {
                Route::resource('employee-off-manage', 'EmployeeOffController');
                Route::get('employee-off-manage.data', ['as' => 'employee-off-manage.data', 'uses' => 'EmployeeOffController@data']);
                Route::get('employee-off-manage.diligence', ['as' => 'employee-off-manage.diligence', 'uses' => 'EmployeeOffController@drawTableDiligenceMonths']);
                Route::get('employee-off-manage.branch', ['as' => 'employee-off-manage.branch', 'uses' => 'EmployeeOffController@branchList']);
            }
        );
        /**
         * Eng: supplier-manage
         * Trans: Quản lý nhà cung cấp
         */
        Route::group(
            ['namespace' => 'Supplier', 'as' => 'supplier.', 'middleware' => []],
            function () {
                Route::resource('supplier-manage', 'SupplierManageController');
                Route::get('supplier-manage.data', ['as' => 'supplier-manage.data', 'uses' => 'SupplierManageController@data']);
                Route::get('supplier-manage.detail', ['as' => 'supplier-manage.detail', 'uses' => 'SupplierManageController@detail']);
                Route::get('supplier-manage.info', ['as' => 'supplier-manage.info', 'uses' => 'SupplierManageController@info']);
                Route::get('supplier-manage.material', ['as' => 'supplier-manage.material', 'uses' => 'SupplierManageController@material']);
                Route::get('supplier-manage.order', ['as' => 'supplier-manage.order', 'uses' => 'SupplierManageController@order']);
            }
        );
        /**
         * Eng: bill-manage
         * Trans: Quản lý hoá đơn
         */
        Route::group(
            ['namespace' => 'Bill', 'as' => 'bill.', 'middleware' => []],
            function () {
                Route::resource('bill-manage', 'BillController');
                Route::get('bill-manage.data', ['as' => 'bill-manage.data', 'uses' => 'BillController@data']);
                Route::get('bill-manage.data-excel', ['as' => 'bill-manage.data-excel', 'uses' => 'BillController@dataExcel']);
                Route::get('bill-manage.detail', ['as' => 'bill-manage.detail', 'uses' => 'BillController@detail']);
                Route::get('bill-manage.history', ['as' => 'bill-manage.history', 'uses' => 'BillController@history']);
            }
        );
        /**
         * Eng: time-keeping-manage
         * Trans: Quản lý chấm công
         */
        Route::group(
            ['namespace' => 'TimeKeeping', 'as' => 'time_keeping.', 'middleware' => []],
            function () {
                Route::resource('time-keeping-manage', 'TimeKeepingController');
                Route::get('time-keeping-manage.data-date', ['as' => 'time-keeping-manage.data-date', 'uses' => 'TimeKeepingController@dataDate']);
                Route::get('time-keeping-manage.data-month', ['as' => 'time-keeping-manage.data-month', 'uses' => 'TimeKeepingController@dataMonth']);
                Route::get('time-keeping-manage.employee', ['as' => 'time-keeping-manage.employee', 'uses' => 'TimeKeepingController@employee']);
                Route::get('time-keeping-manage.get-employee-leave-day', ['as' => 'time-keeping-manage.get-employee-leave-day', 'uses' => 'TimeKeepingController@getEmployeeLeaveDay']);
                Route::post('time-keeping-manage.update', ['as' => 'time-keeping-manage.update', 'uses' => 'TimeKeepingController@update']);
            }
        );
        /**
         * Eng: payroll-manage
         * Trans: Quản lý bảng lương
         */
        Route::group(
            ['namespace' => 'Payroll', 'as' => 'payroll.', 'middleware' => []],
            function () {
                Route::resource('payroll-manage', 'PayrollController');
                Route::get('payroll-manage.data', ['as' => 'payroll-manage.data', 'uses' => 'PayrollController@data']);
                Route::get('payroll-manage.owner-confirm', ['as' => 'payroll-manage.owner-confirm', 'uses' => 'PayrollController@ownerConfirm']);
                Route::get('payroll-manage.salary-confirm', ['as' => 'payroll-manage.salary-confirm', 'uses' => 'PayrollController@salaryConfirm']);
                Route::get('payroll-manage.detail', ['as' => 'payroll-manage.detail', 'uses' => 'PayrollController@detail']);
                Route::post('payroll-manage.export', ['as' => 'payroll.export', 'uses' => 'PayrollController@export']);
                Route::get('payroll-manage.data-notify', ['as' => 'payroll.data-notify', 'uses' => 'PayrollController@dataNotify']);
                Route::post('payroll-manage.reply-notify', ['as' => 'payroll.reply-notify', 'uses' => 'PayrollController@replyNotify']);
                Route::get('payroll-manage.role', ['as' => 'payroll.role', 'uses' => 'PayrollController@role']);
                Route::get('payroll-manage.data-update', ['as' => 'payroll-manage.data-update', 'uses' => 'PayrollController@dataUpdate']);
                Route::post('payroll-manage.update', ['as' => 'payroll-manage.update', 'uses' => 'PayrollController@Update']);
            }
        );

        /**
         * Eng: cash-book-manage
         * Trans: Quản lý quỹ tiền mặt
         */
        Route::group(
            ['namespace' => 'CashBook', 'as' => 'cash_book.', 'middleware' => []],
            function () {
                Route::resource('cash-book-manage', 'CashBookController');
                Route::get('cash-book-manage.data', ['as' => 'cash-book-manage.data', 'uses' => 'CashBookController@data']);
                Route::post('cash-book-manage.confirm', ['as' => 'cash-book-manage.confirm', 'uses' => 'CashBookController@confirm']);
                Route::post('cash-book-manage.cancel', ['as' => 'cash-book-manage.cancel', 'uses' => 'CashBookController@cancel']);
                Route::get('cash-book-manage.detail', ['as' => 'cash-book-manage.detail', 'uses' => 'CashBookController@detail']);
            }
        );

        /**
         * Eng: price-by-area-manage
         * Trans: Quản lý giá theo khu vực
         */
        Route::group(
            ['namespace' => 'AreaPrice', 'as' => 'area_price.', 'middleware' => []],
            function () {
                Route::resource('price-by-area-manage', 'AreaPriceController');
                Route::get('price-by-area-manage.data', ['as' => 'price-by-area-manage.data', 'uses' => 'AreaPriceController@data']);
                Route::get('price-by-area-manage.area', ['as' => 'price-by-area-manage.area', 'uses' => 'AreaPriceController@area']);
                Route::post('price-by-area-manage.update', ['as' => 'price-by-area-manage.update', 'uses' => 'AreaPriceController@update']);
            }
        );

        /**
         * Eng: e-invoice-manage
         * Trans: Quản lý hoá đơn điện tử
         */
        Route::group(
            ['namespace' => 'EInvoice', 'as' => 'e_invoice.', 'middleware' => []],
            function () {
                Route::resource('e-invoice-manage', 'EInvoiceController');
                Route::get('e-invoice.check', ['as' => 'e-invoice.check', 'uses' => 'EInvoiceController@check']);
                Route::get('e-invoice-manage.data', ['as' => 'e-invoice-manage.data', 'uses' => 'EInvoiceController@data']);
                Route::post('e-invoice-manage.export', ['as' => 'e-invoice-manage.export', 'uses' => 'EInvoiceController@export']);
                Route::post('e-invoice-manage.update', ['as' => 'e-invoice-manage.update', 'uses' => 'EInvoiceController@update']);
                Route::post('e-invoice-manage.change-status', ['as' => 'e-invoice-manage.change-status', 'uses' => 'EInvoiceController@changeStatus']);
                Route::post('e-invoice-manage.update-waiting-accept', ['as' => 'e-invoice-manage.update-waiting-accept', 'uses' => 'EInvoiceController@updateWaitingAccept']);
                Route::get('e-invoice-manage.data-create', ['as' => 'e-invoice-manage.data-create', 'uses' => 'EInvoiceController@dataCreate']);
                Route::get('e-invoice-manage.data-update', ['as' => 'e-invoice-manage.data-update', 'uses' => 'EInvoiceController@dataUpdate']);
                Route::post('e-invoice-manage.cancel', ['as' => 'e-invoice-manage.cancel', 'uses' => 'EInvoiceController@cancel']);
                Route::get('e-invoice-manage.detail', ['as' => 'e-invoice-manage.detail', 'uses' => 'EInvoiceController@detail']);
            }
        );
    }
);

/**
 * Trans: Folder Sell Online Controller
 */
Route::group(
    ['namespace' => 'SellOnline', 'as' => 'sell_online.', 'middleware' => []],
    function () {
        /**
         * Trans: Facebook
         */
        Route::group(
            ['namespace' => 'Facebook', 'as' => 'facebook.', 'middleware' => []],
            function () {
                /**
                 * Eng: new-feed-facebook
                 * Trans: Đăng nhập facebook
                 */
                Route::resource('facebook-auth', 'LoginFacebookController');
                Route::get('facebook-auth.login.index', ['as' => 'facebook-auth.login.index', 'uses' => 'LoginFacebookController@index']);

                /**
                 * Eng: webhook
                 * Trans: Đăng nhập facebook
                 */
                Route::resource('webhook', 'WebHookController');
                Route::get('webhooks', ['as' => 'webhook.webhook', 'uses' => 'WebHookController@index']);
                Route::post('webhooks', ['as' => 'webhook.webhook', 'uses' => 'WebHookController@index']);


                /**
                 * Eng: new-feed-facebook
                 * Trans: Cấu hình facebook
                 */
                Route::resource('config-facebook', 'ConfigFacebookController');
                Route::get('config-facebook.config.index', ['as' => 'new-feed-facebook.feed.index', 'uses' => 'ConfigFacebookController@index']);
                Route::get('config-facebook.get-all-page', ['as' => 'config-facebook.get-all-page', 'uses' => 'ConfigFacebookController@getAllPage']);
                Route::post('config-facebook.select-page', ['as' => 'config-facebook.select-page', 'uses' => 'ConfigFacebookController@selectPageConnect']);
                Route::post('config-facebook.select-one-page', ['as' => 'config-facebook.select-one-page', 'uses' => 'ConfigFacebookController@selectOnePageConnect']);

                /**
                 * Eng: facebook
                 * Trans: Facebook
                 */
                Route::resource('facebook', 'FacebookController');
                Route::get('facebook.connect.manage-page', ['as' => 'facebook.connect.manage-page', 'uses' => 'FacebookController@managePage']);
                Route::get('facebook.auth.callback', ['as' => 'facebook.auth.callback', 'uses' => 'FacebookController@callBack']);
                Route::get('facebook.redirect', ['as' => 'facebook.redirect', 'uses' => 'FacebookController@index']);
                Route::get('facebook-auth-config', ['as' => 'facebook-auth-config', 'uses' => 'FacebookController@viewUserHome']);
                Route::get('facebook.auth.view-profile-page', ['as' => 'facebook.auth.view-profile-page', 'uses' => 'FacebookController@viewProfilePage']);
                Route::get('facebook.auth', ['as' => 'facebook.auth', 'uses' => 'FacebookController@auth']);
                /**
                 * Eng: message-facebook
                 * Trans: Tin nhắn facebook
                 */
                Route::resource('message-facebook', 'MessageFacebookController');
                Route::get('message-facebook.index', ['as' => 'message-facebook.index', 'uses' => 'MessageFacebookController@index']);
                Route::get('message-facebook.page', ['as' => 'message-facebook.page', 'uses' => 'MessageFacebookController@page']);
                Route::get('message-facebook.user', ['as' => 'message-facebook.user', 'uses' => 'MessageFacebookController@user']);
                Route::get('message-facebook.get-page-selected', ['as' => 'message-facebook.get-page-selected', 'uses' => 'MessageFacebookController@getPageSelected']);
                Route::get('message-facebook.get-sender-page', ['as' => 'message-facebook.get-sender-page', 'uses' => 'MessageFacebookController@getSenderPage']);
                Route::get('message-facebook.get-messenger-page', ['as' => 'message-facebook.get-messenger-page', 'uses' => 'MessageFacebookController@getMessengerPage']);
                Route::get('message-facebook.get-post-page', ['as' => 'message-facebook.get-post-page', 'uses' => 'MessageFacebookController@getPostPage']);
                Route::get('message-facebook.get-all-page-return', ['as' => 'message-facebook.get-all-page-return', 'uses' => 'MessageFacebookController@getAllPageReturn']);
                Route::get('message-facebook.select-page', ['as' => 'message-facebook.select-page', 'uses' => 'MessageFacebookController@selectPageConnect']);
                Route::post('message-facebook.send-message', ['as' => 'message-facebook.send-message', 'uses' => 'MessageFacebookController@sendMessage']);
                Route::post('message-facebook.typing-on', ['as' => 'message-facebook.typing-on', 'uses' => 'MessageFacebookController@typingOn']);
                Route::get('message-facebook.booking', ['as' => 'message-facebook.booking', 'uses' => 'MessageFacebookController@getListBooking']);
                Route::get('message-facebook.booking-facebook', ['as' => 'message-facebook.booking-facebook', 'uses' => 'MessageFacebookController@getOrderMessageFacebook']);
                /**
                 * Eng: live-stream-facebook
                 * Trans: Live stream facebook
                 */
                Route::resource('live-stream-facebook', 'LiveStreamFacebookController');
                Route::get('live-stream-facebook.list.index', ['as' => 'live-stream-facebook.in', 'uses' => 'MessageFacebookController@index']);

                /**
                 * Eng: report-facebook
                 * Trans: Báo cáo facebook
                 */
                Route::resource('report-facebook', 'ReportFacebookController');
                /**
                 * Eng: new-feed-facebook
                 * Trans: Bảng tin facebook
                 */
                Route::resource('new-feed-facebook', 'NewFeedFacebookController');
                Route::get('new-feed-facebook.feed.index', ['as' => 'new-feed-facebook.feed.index', 'uses' => 'NewFeedFacebookController@index']);
                Route::get('new-feed-facebook.feed.get-page-selected', ['as' => 'new-feed-facebook.feed.get-page-selected', 'uses' => 'NewFeedFacebookController@getFeedPageSelected']);
                Route::get('new-feed-facebook.get-sender-page', ['as' => 'new-feed-facebook.get-sender-page', 'uses' => 'NewFeedFacebookController@getSenderPage']);
                Route::get('new-feed-facebook.get-messenger-sender-page', ['as' => 'new-feed-facebook.get-messenger-sender-page', 'uses' => 'NewFeedFacebookController@getMessengerPage']);
                Route::get('new-feed-facebook.get-media-page', ['as' => 'new-feed-facebook.get-media-page', 'uses' => 'NewFeedFacebookController@getMediaPage']);
            }
        );
        /**
         * Trans: Zalo
         */
        Route::group(
            ['namespace' => 'Zalo', 'as' => 'zalo.', 'middleware' => []],
            function () {
                /**
                 * Eng: zalo
                 * Trans: Zalo
                 */
                Route::resource('zalo', 'ZaloController');
                /**
                 * Eng: message-zalo
                 * Trans: Tin nhắn zalo
                 */
                Route::resource('message-zalo', 'MessageZaloController');
                /**
                 * Eng: live-stream-zalo
                 * Trans: Live stream zalo
                 */
                Route::resource('live-stream-zalo', 'LiveStreamZaloController');
                /**
                 * Eng: report-zalo
                 * Trans: Báo cáo zalo
                 */
                Route::resource('report-zalo', 'ReportZaloController');
                /**
                 * Eng: new-feed-zalo
                 * Trans: Bảng tin zalo
                 */
                Route::resource('new-feed-zalo', 'NewFeedZaloController');
            }
        );
    }
);

/**
 * Trans: Folder Marketing Controller
 */
Route::group(
    ['namespace' => 'Marketing', 'as' => 'marketing.', 'middleware' => []],
    function () {
        /**
         * Eng: campaign-marketing
         * Trans: Chiến dịch
         */
        Route::resource('campaign-marketing', 'CampaignMarketingController');
        Route::get('campaign-marketing.data', ['as' => 'campaign-marketing.data', 'uses' => 'CampaignMarketingController@data']);
        Route::group(
            ['namespace' => 'Campaign', 'as' => 'campaign.', 'middleware' => []],
            function () {
                /**
                 * Eng: send-message-campaign
                 * Trans: Gửi tin nhắn hàng loạt
                 */
                Route::get('send-message-campaign.data', ['as' => 'send-message-campaign.data', 'uses' => 'SendMessageController@data']);
                Route::get('send-message-campaign.data-update', ['as' => 'send-message-campaign.data-update', 'uses' => 'SendMessageController@dataUpdate']);
                Route::get('send-message-campaign.detail', ['as' => 'send-message-campaign.detail', 'uses' => 'SendMessageController@detail']);
                Route::post('send-message-campaign.create', ['as' => 'send-message-campaign.create', 'uses' => 'SendMessageController@create']);
                Route::post('send-message-campaign.update', ['as' => 'send-message-campaign.update', 'uses' => 'SendMessageController@update']);
                Route::get('send-message-campaign.gift', ['as' => 'send-message-campaign.gift', 'uses' => 'SendMessageController@gift']);
                Route::get('send-message-campaign.customer', ['as' => 'send-message-campaign.customer', 'uses' => 'SendMessageController@customer']);
                Route::post('send-message-campaign.send', ['as' => 'send-message-campaign.send', 'uses' => 'SendMessageController@send']);
                Route::post('success-cancel-data-to-server', ['as' => 'success-cancel-data-to-server', 'uses' => 'SendMessageController@cancel']);
                Route::get('send-message-campaign.member-card', ['as' => 'send-message-campaign.member-card', 'uses' => 'SendMessageController@dataMemberShip']);
                Route::post('send-message-campaign.change-status', ['as' => 'send-message-campaign.change-status', 'uses' => 'SendMessageController@changeStatus']);
                Route::post('send-message-campaign.cancel-submit-admin', ['as' => 'send-message-campaign.cancel-submit-admin', 'uses' => 'SendMessageController@cancel']);
                /**
                 * Eng: campaign-marketing
                 * Trans: Mua 1 tặng 1
                 */
                Route::get('one-get-one-campaign.data', ['as' => 'one-get-one-campaign.data', 'uses' => 'OneGetOneController@data']);
                Route::post('one-get-one-campaign.create', ['as' => 'one-get-one-campaign.create', 'uses' => 'OneGetOneController@create']);
                Route::get('one-get-one-campaign.list-food', ['as' => 'one-get-one-campaign.create', 'uses' => 'OneGetOneController@listFood']);
                Route::post('one-get-one-campaign.change-status', ['as' => 'one-get-one-campaign.change-status', 'uses' => 'OneGetOneController@changeStatus']);
                Route::post('one-get-one-campaign.assign-food', ['as' => 'one-get-one-campaign.assign-food', 'uses' => 'OneGetOneController@assignFood']);
                Route::get('one-get-one-campaign.detail', ['as' => 'one-get-one-campaign.detail', 'uses' => 'OneGetOneController@detail']);
                Route::post('one-get-one-campaign.update', ['as' => 'one-get-one-campaign.update', 'uses' => 'OneGetOneController@update']);
                Route::post('one-get-one-campaign.change-running', ['as' => 'one-get-one-campaign.change-running', 'uses' => 'OneGetOneController@changeRunning']);
                /**
                 * Eng: after-payment-campaign
                 * Trans: Kho bia
                 */
                Route::resource('beer-store', 'BeerStoreController');
                Route::get('beer-store.', ['as' => 'after_payment.data', 'uses' => 'BeerStoreController@data']);
                Route::get('beer-store.food', ['as' => 'beer-store.food', 'uses' => 'BeerStoreController@getFood']);
                Route::get('beer-store.material', ['as' => 'beer-store.material', 'uses' => 'BeerStoreController@getMaterial']);
                Route::post('beer-store.update-config', ['as' => 'beer-store.update-config', 'uses' => 'BeerStoreController@updateConfig']);
                Route::get('beer-store.get-config', ['as' => 'beer-store.get-config', 'uses' => 'BeerStoreController@getDetailConfig']);
                Route::get('beer-store.get-detail', ['as' => 'beer-store.get-detail', 'uses' => 'BeerStoreController@getDetail']);
                Route::post('beer-store.change-status', ['as' => 'beer-store.change-status', 'uses' => 'BeerStoreController@changeStatus']);
                Route::post('beer-store-policy.update', ['as' => 'beer-store-policy.update', 'uses' => 'BeerStoreController@updatePolicy']);


                /**
                 * Eng: after-payment-campaign
                 * Trans: Gửi thông báo sau khi mua hàng
                 */
                Route::resource('after_payment', 'AfterPaymentController');
                Route::get('after_payment.data', ['as' => 'after_payment.data', 'uses' => 'AfterPaymentController@data']);
                Route::post('after_payment.create', ['as' => 'after_payment.create', 'uses' => 'AfterPaymentController@create']);
                Route::post('after_payment.change-status', ['as' => 'after_payment.change-status', 'uses' => 'AfterPaymentController@changeStatus']);
                Route::post('after_payment.update', ['as' => 'after_payment.update', 'uses' => 'AfterPaymentController@update']);
                Route::post('after_payment.delete', ['as' => 'after_payment.delete', 'uses' => 'AfterPaymentController@delete']);
                Route::post('after_payment.is-running', ['as' => 'after_payment.is-running', 'uses' => 'AfterPaymentController@changeIsRunning']);
            }
        );


        /**
         * Eng: media-restaurant-marketing
         * Trans: Cập nhật Banner/Video Công ty/Nhà hàng
         */
        Route::resource('display-secondary-pos', 'DisplaySecondaryPosController');
        Route::get('display-secondary-pos.data', ['as' => 'display-secondary-pos.data', 'uses' => 'DisplaySecondaryPosController@data']);
        Route::get('display-secondary-pos.data-content', ['as' => 'display-secondary-pos.data-content', 'uses' => 'DisplaySecondaryPosController@dataContent']);
        Route::post('display-secondary-pos.create', ['as' => 'display-secondary-pos.create', 'uses' => 'DisplaySecondaryPosController@create']);
        Route::post('display-secondary-pos.create-content', ['as' => 'display-secondary-pos.create-content', 'uses' => 'DisplaySecondaryPosController@createContent']);
        Route::post('display-secondary-pos.delete', ['as' => 'display-secondary-pos.delete', 'uses' => 'DisplaySecondaryPosController@delete']);
        Route::post('display-secondary-pos.change-status', ['as' => 'display-secondary-pos.change-status', 'uses' => 'DisplaySecondaryPosController@changeStatus']);

        /**
         * Eng: media-restaurant-marketing
         * Trans: Cập nhật Banner/Video Công ty/Nhà hàng
         */
        Route::resource('media-restaurant-marketing', 'MediaRestaurantMarketingController');
        Route::get('media-restaurant-marketing.data', ['as' => 'media-restaurant-marketing.data', 'uses' => 'MediaRestaurantMarketingController@data']);
        Route::post('media-restaurant-marketing.create', ['as' => 'media-restaurant-marketing.create', 'uses' => 'MediaRestaurantMarketingController@create']);
        Route::post('media-restaurant-marketing.change-is-running', ['as' => 'media-restaurant-marketing.change-is-running', 'uses' => 'MediaRestaurantMarketingController@changeVideoIsRunning']);
        Route::post('media-restaurant-marketing.cancel', ['as' => 'media-restaurant-marketing.cancel', 'uses' => 'MediaRestaurantMarketingController@cancel']);
        Route::post('media-restaurant-marketing.send-to-aloline', ['as' => 'media-restaurant-marketing.send-to-aloline', 'uses' => 'MediaRestaurantMarketingController@sendBanner']);

        /**
         * Eng game
         * Trans: Trò chơi
         */
        Route::resource('game-marketing', 'GameMarketingController');
        Route::get('game-marketing.data', ['as' => 'game-marketing.data', 'uses' => 'GameMarketingController@data']);

        /**
         * Eng promotion
         * Trans: Chương trình khuyến mãi
         */
        //        Route::group(
        //            ['namespace' => 'Promotion', 'as' => 'promotion.', 'middleware' => []],
        //            function () {
        //                /**
        //                 * Eng promotion
        //                 * Trans: Chương trình khuyến mãi
        //                 */
        //                Route::resource('promotion', 'PromotionController');
        //                Route::get('promotion.data', ['as' => 'promotion.data', 'uses' => 'PromotionController@data']);
        //
        //
        //                /**
        //                 * Eng: happy-time-promotion
        //                 * Trans: Chương trình Happy Time
        //                 */
        //                Route::get('happy-time-promotion.data', ['as' => 'happy-time-promotion.data', 'uses' => 'HappyTimeController@data']);
        //                Route::post('happy-time-promotion.create', ['as' => 'happy-time-promotion.create', 'uses' => 'HappyTimeController@create']);
        //                Route::get('happy-time-promotion.detail', ['as' => 'happy-time-promotion.detail', 'uses' => 'HappyTimeController@detail']);
        //                Route::get('happy-time-promotion.data-update', ['as' => 'happy-time-promotion.data-update', 'uses' => 'HappyTimeController@dataUpdate']);
        //                Route::post('happy-time-promotion.voucher', ['as' => 'happy-time-promotion.voucher', 'uses' => 'HappyTimeController@voucher']);
        //                Route::post('happy-time-promotion.update', ['as' => 'happy-time-promotion.update', 'uses' => 'HappyTimeController@update']);
        //                Route::post('happy-time-promotion.change-status', ['as' => 'happy-time-promotion.change-status', 'uses' => 'HappyTimeController@changeStatus']);
        //                Route::post('happy-time-promotion.upload-images', ['as' => 'happy-time-promotion.upload-images', 'uses' => 'HappyTimeController@uploadImages']);
        //                Route::get('happy-time-promotion.food-assign', ['as' => 'happy-time-promotion.food-assign', 'uses' => 'HappyTimeController@dataFood']);
        //                Route::get('happy-time-promotion.promotion-assign', ['as' => 'happy-time-promotion.promotion-assign', 'uses' => 'HappyTimeController@promotionAssign']);
        //                Route::get('happy-time-promotion.promotion-assign-detail', ['as' => 'happy-time-promotion.promotion-assign-detail', 'uses' => 'HappyTimeController@promotionAssignDetail']);
        //                Route::post('happy-time-promotion.assign-food', ['as' => 'happy-time-promotion.assign-food', 'uses' => 'HappyTimeController@assignFood']);
        //                /**
        //                 * Eng: voucher-promotion
        //                 * Trans: Chương trình Voucher
        //                 */
        //                Route::get('voucher-promotion.data', ['as' => 'voucher-promotion.data', 'uses' => 'VoucherController@data']);
        //                Route::post('voucher-promotion.create', ['as' => 'voucher-promotion.create', 'uses' => 'VoucherController@create']);
        //                /**
        //                 * Eng: happy-hour-promotion
        //                 * Trans: Chương trình Happy Hour
        //                 */
        //                Route::get('happy-hour-promotion.data', ['as' => 'happy-hour-promotion.data', 'uses' => 'HappyHourController@data']);
        //                Route::post('happy-hour-promotion.update', ['as' => 'happy-hour-promotion.update', 'uses' => 'HappyHourController@update']);
        //                Route::post('happy-hour-promotion.create', ['as' => 'happy-hour-promotion.create', 'uses' => 'HappyHourController@create']);
        //                Route::get('happy-hour-promotion.data-gift', ['as' => 'happy-hour-promotion.data-gift', 'uses' => 'HappyHourController@dataGift']);
        //                Route::post('happy-hour-promotion.gift', ['as' => 'happy-hour-promotion.gift', 'uses' => 'HappyHourController@gift']);
        //            });

        /**
         * Eng gift
         * Trans: Quà tặng
         */
        Route::group(
            ['namespace' => 'Gift', 'as' => 'gift.', 'middleware' => []],
            function () {
                /**
                 * Eng customer-gift
                 * Trans: Danh sách khách hàng
                 */
                Route::resource('customer-gift-marketing', 'CustomerGiftMarketingController');
                Route::get('customer-gift-marketing.data', ['as' => 'customer-gift-marketing.data', 'uses' => 'CustomerGiftMarketingController@data']);
                Route::get('customer-gift-marketing.detail', ['as' => 'customer-gift-marketing.detail', 'uses' => 'CustomerGiftMarketingController@detail']);
                Route::post('customer-gift-marketing.create', ['as' => 'customer-gift-marketing.create', 'uses' => 'CustomerGiftMarketingController@create']);
                Route::get('customer-gift-marketing.gift', ['as' => 'customer-gift-marketing.gift', 'uses' => 'CustomerGiftMarketingController@gift']);
                Route::post('customer-gift-marketing.customer', ['as' => 'customer-gift-marketing.customer', 'uses' => 'CustomerGiftMarketingController@customer']);
                /**
                 * Eng: gift-marketing
                 * Trans: Quà tặng
                 */
                Route::resource('gift-marketing', 'GiftMarketingController');
                Route::get('gift-marketing.data', ['as' => 'gift-marketing.data', 'uses' => 'GiftMarketingController@data']);
                Route::get('gift-marketing.detail', ['as' => 'gift-marketing.detail', 'uses' => 'GiftMarketingController@detail']);
                Route::post('gift-marketing.create', ['as' => 'gift-marketing.create', 'uses' => 'GiftMarketingController@create']);
                Route::get('gift-marketing.data-update', ['as' => 'gift-marketing.data-update', 'uses' => 'GiftMarketingController@dataUpdate']);
                Route::post('gift-marketing.update', ['as' => 'gift-marketing.update', 'uses' => 'GiftMarketingController@update']);
                Route::post('gift-marketing.change-status', ['as' => 'gift-marketing.change-status', 'uses' => 'GiftMarketingController@changeStatus']);
                Route::get('gift-marketing.food', ['as' => 'gift-marketing.food', 'uses' => 'GiftMarketingController@food']);
                /**
                 * Eng: new-customer-gift
                 * Trans: Quà tặng khách hàng mới
                 */
                Route::resource('new-customer-gift', 'NewCustomerGiftMarketingController');
                Route::get('new-customer-gift.data', ['as' => 'new-customer-gift.data', 'uses' => 'NewCustomerGiftMarketingController@data']);
                Route::post('new-customer-gift.update', ['as' => 'new-customer-gift.update', 'uses' => 'NewCustomerGiftMarketingController@update']);
                /**
                 * Eng: notify-gif
                 * Trans: Thông báo quà tặng
                 */
                Route::resource('notify-gift', 'NotifyGiftMarketingController');
                Route::get('notify-gift.data', ['as' => 'notify-gift.data', 'uses' => 'NotifyGiftMarketingController@data']);
                Route::post('notify-gift.create', ['as' => 'notify-gift.create', 'uses' => 'NotifyGiftMarketingController@create']);
                Route::post('notify-gift.update', ['as' => 'notify-gift.update', 'uses' => 'NotifyGiftMarketingController@update']);
                Route::get('notify-gift.gift', ['as' => 'notify-gift.gift', 'uses' => 'NotifyGiftMarketingController@gift']);
                Route::get('notify-gift.customer', ['as' => 'notify-gift.customer', 'uses' => 'NotifyGiftMarketingController@customer']);
            }
        );
    }
);

/**
 * Trans: Folder Report Controller
 */
Route::group(
    ['namespace' => 'Report', 'as' => 'report.', 'middleware' => []],
    function () {
        Route::group(
            ['namespace' => 'warehouse_report', 'as' => 'warehouse_report.', 'middleware' => []],
            function () {
                Route::group(
                    ['namespace' => 'inventory', 'as' => 'inventory.', 'middleware' => []],
                    function () {
                        /**
                         * Eng: warehouse-inventory-report
                         * Trans: Báo cáo kho tổng kiểm kê
                         */
                        Route::resource('warehouse-inventory-report', 'WareHouseInventoryController');
                        Route::get('warehouse-report.data', ['as' => 'warehouse-report.data', 'uses' => 'WareHouseInventoryController@data']);
                    }
                );
            }
        );
        Route::group(
            ['namespace' => 'warehouse_report', 'as' => 'warehouse_report.', 'middleware' => []],
            function () {
                Route::group(
                    ['namespace' => 'material', 'as' => 'material.', 'middleware' => []],
                    function () {
                        /**
                         * Eng: warehouse-material-report
                         * Trans: Báo cáo kho tổng nhập xuất
                         */
                        Route::resource('warehouse-material-report', 'WareHouseMaterialController');
                        Route::get('warehouse-material-report.data', ['as' => 'warehouse-material-report.data', 'uses' => 'WareHouseMaterialController@data']);
                    }
                );
            }
        );
        Route::group(
            ['namespace' => 'work_history_report', 'as' => 'work_history_report.', 'middleware' => []],
            function () {
                // Báo cáo chốt ca thu ngân
                Route::resource('work-history-report', 'WorkHistoryReportController');
            }
        );
        /**
         * Eng: material-food-report
         * Trans: Chi tiết DT Bán hàng / Tổng quan
         */
        //        Route::resource('all-report', 'AllReportController');
        //        Route::get('all-report.data', ['as' => 'all-report.data', 'uses' => 'AllReportController@data']);

        Route::resource('service-cost-history-report', 'serviceCostHistoryReportController');
        /**
         * Eng: revenue-report
         * Trans: Doanh thu
         */
        Route::resource('revenue-report', 'RevenueReportController');
        Route::get('revenue-report.data', ['as' => 'revenue-report.data', 'uses' => 'RevenueReportController@data']);
        Route::get('revenue-report.detail', ['as' => 'revenue-report.detail', 'uses' => 'RevenueReportController@detail']);
        /**
         * Eng: cost-debt-report
         * Trans: Chi phí, công nợ
         */
        Route::resource('cost-debt-report', 'CostDebtReportController');
        Route::get('cost-debt-report.data', ['as' => 'cost-debt-report.data', 'uses' => 'CostDebtReportController@data']);
        Route::get('cost-debt-report.detail', ['as' => 'cost-debt-report.detail', 'uses' => 'CostDebtReportController@detail']);
        /**
         * Eng: cost-report
         * Trans: Báo cáo chi phí
         */
        Route::resource('cost-report', 'CostReportController');
        Route::get('cost-report.data', ['as' => 'cost-report.data', 'uses' => 'CostReportController@data']);
        Route::get('cost-report.detail', ['as' => 'cost-report.detail', 'uses' => 'CostReportController@detail']);
        /**
         * Eng: deposit-to-card-report
         * Trans: Báo cáo nạp thẻ
         */
        Route::resource('deposit-to-card-report', 'DepositToCardReportController');
        /**
         * Eng: debt-report
         * Trans: Báo cáo công nợ
         */
        Route::resource('debt-report', 'DebtReportController');
        Route::get('debt-report.data', ['as' => 'debt-report.data', 'uses' => 'DebtReportController@data']);
        Route::get('debt-report.detail', ['as' => 'debt-report.detail', 'uses' => 'DebtReportController@detail']);
        /**
         * Eng: inventory-supplier-report
         * Trans: Báo cáo nhập kho nhà cung cấp
         */
        Route::resource('inventory-supplier-report', 'InventorySupplierReportController');
        Route::get('inventory-supplier-report.data', ['as' => 'inventory-supplier-report.data', 'uses' => 'InventorySupplierReportController@data']);
        Route::get('inventory-supplier-report.supplier', ['as' => 'inventory-supplier-report.supplier', 'uses' => 'InventorySupplierReportController@supplier']);
        /**
         * Eng: material-report
         * Trans: Báo cáo kho chi nhánh
         */
        Route::resource('material-report', 'MaterialReportController');
        Route::get('material-report.data', ['as' => 'material-report.data', 'uses' => 'MaterialReportController@data']);
        Route::get('material-report.data2', ['as' => 'material-report.data2', 'uses' => 'MaterialReportController@data2']);
        /**
         * Eng: material-internal-report
         * Trans: Báo cáo kho bếp/bar
         */
        Route::resource('material-internal-report', 'MaterialInternalReportController');
        Route::get('material-internal-report.data', ['as' => 'material-internal-report.data', 'uses' => 'MaterialInternalReportController@data']);
        /**
         * Eng: inventory-report
         * Trans: Báo cáo kiểm kê kho chi nhánh
         */
        Route::resource('inventory-report', 'InventoryReportController');
        Route::get('inventory-report.data', ['as' => 'inventory-report.data', 'uses' => 'InventoryReportController@data']);
        Route::get('inventory-report.inventory', ['as' => 'inventory-report.inventory', 'uses' => 'InventoryReportController@inventory']);
        /**
         * Eng: inventory-internal-report
         * Trans: Báo cáo kiểm kê kho bếp/bar
         */
        Route::resource('inventory-internal-report', 'InventoryInternalReportController');
        Route::get('inventory-internal-report.data', ['as' => 'inventory-internal-report.data', 'uses' => 'InventoryInternalReportController@data']);
        Route::get('inventory-internal-report.inventory', ['as' => 'inventory-internal-report.inventory', 'uses' => 'InventoryInternalReportController@inventory']);
        /**
         * Eng: material-food-report
         * Trans: Nguyên liệu món ăn
         */
        Route::resource('material-food-report', 'MaterialFoodReportController');
        Route::get('material-food-report.data', ['as' => 'material-food-report.data', 'uses' => 'MaterialFoodReportController@data']);

        /**
         * Eng: material-food-report
         * Trans: Chi tiết DT Bán hàng / Tổng quan
         */
        Route::resource('detail-revenue-sell', 'DetailRevenueSellController');
        Route::get('detail-revenue-sell.data', ['as' => 'detail-revenue-sell.data', 'uses' => 'DetailRevenueSellController@data']);


        /**
         * Eng: sell-report
         * Trans: Báo cáo bán hàng
         */
        //        Route::resource('sell-report', 'SellReportController');
        //        Route::get('sell-report.data-category-revenue', ['as' => 'sell-report.data-category-revenue', 'uses' => 'SellReportController@dataCategoryRevenue']);
        //        Route::get('sell-report.data-food-revenue', ['as' => 'sell-report.data-food-revenue', 'uses' => 'SellReportController@dataFoodRevenue']);
        //        Route::get('sell-report.data-detail-food-revenue', ['as' => 'sell-report.data-detail-food-revenue', 'uses' => 'SellReportController@dataDetailFoodRevenue']);
        //        Route::get('sell-report.data-discount-report', ['as' => 'sell-report.data-discount-report', 'uses' => 'SellReportController@dataDiscountReport']);
        //        Route::get('sell-report.data-gift-food-report', ['as' => 'sell-report.data-gift-food-report', 'uses' => 'SellReportController@dataGiftFoodReport']);
        //        Route::get('sell-report.data-food-take-away-report', ['as' => 'sell-report.data-food-take-away-report', 'uses' => 'SellReportController@dataFoodTakeAwayReport']);
        //        Route::get('sell-report.data-food-cancel-report', ['as' => 'sell-report.data-food-cancel-report', 'uses' => 'SellReportController@dataFoodCancelReport']);
        //        Route::get('sell-report.data-order-report', ['as' => 'sell-report.data-order-report', 'uses' => 'SellReportController@dataOrderReport']);
        //        Route::get('sell-report.data-list-food', ['as' => 'sell-report.data-list-food', 'uses' => 'SellReportController@dataListFood']);


        /**
         * Eng: order-report
         * Trans: Báo cáo Bán hàng
         */

        Route::resource('sell-order-report', 'OrderController');
        Route::get('sell-order-report.data', ['as' => 'sell-order-report.data', 'uses' => 'OrderController@data']);


        Route::group(
            ['namespace' => 'Sell', 'as' => 'sell.', 'middleware' => []],
            function () {
                /**
                 * Eng: sell-report
                 * Trans: Báo cáo bán hàng
                 */
                Route::resource('category-report', 'SellCategoryReportController');
                Route::get('category-report.data', 'SellCategoryReportController@dataCategoryRevenue');
                Route::get('category-report.detail', 'SellCategoryReportController@detailCategoryRevenue');
                Route::get('category-report.category-food-report', ['as' => 'category-report.category-food-report', 'uses' => 'SellCategoryReportController@dataFoodCategory']);

                Route::resource('food-report', 'SellFoodReportController');
                Route::get('food-report.data', 'SellFoodReportController@dataFoodRevenue');
                Route::get('food-report.data-detail', 'SellFoodReportController@dataDetailFoodRevenue');
                Route::get('food-report.food', 'SellFoodReportController@food');
                Route::get('food-report.detail', ['as' => 'food-report.detail', 'uses' => 'SellFoodReportController@detailFood']);

                Route::resource('gift-food-report', 'SellGiftFoodReportController');
                Route::get('gift-food-report.data', 'SellGiftFoodReportController@dataGiftFoodReport');
                Route::get('report-gift-food.detail', ['as' => 'report-gift-food.detail', 'uses' => 'SellGiftFoodReportController@detail']);

                Route::resource('off-menu-dishes-report', 'SellOffMenuReportController');
                Route::get('off-menu-dishes-report.data', 'SellOffMenuReportController@dataOffMenuReport');
                Route::get('off-menu-dishes-report.detail', 'SellOffMenuReportController@detail');


                Route::resource('discount-report', 'SellDiscountReportController');
                Route::get('discount-report.data', 'SellDiscountReportController@dataDiscountReport');

                Route::resource('surcharge-report', 'SellSurchargeReportController');
                Route::get('surcharge-report.data', 'SellSurchargeReportController@dataSurchargeReport');
                Route::get('surcharge-report.detail', 'SellSurchargeReportController@detail');

                Route::resource('point-report', 'SellPointController');
                Route::get('point-report.data', ['as' => 'point-report.data', 'uses' => 'SellPointController@dataPointReport']);


                Route::resource('vat-report', 'SellVATReportController');
                Route::get('vat-report.data', 'SellVATReportController@dataVATReport');
                Route::get('vat-report.detail-vat', ['as' => 'vat-report.detail-vat', 'uses' => 'SellVATReportController@detail']);

                Route::resource('take-away-report', 'SellTakeAwayReportController');
                Route::get('take-away-report.data', 'SellTakeAwayReportController@dataTakeAwayReport');
                Route::get('take-away-report.detail', ['as' => 'take-away-report.detail', 'uses' => 'SellTakeAwayReportController@detail']);

                Route::resource('food-cancel-report', 'SellFoodCancelReportController');
                Route::get('food-cancel-report.data', 'SellFoodCancelReportController@dataFoodCancelReport');

                Route::resource('order-report', 'SellOrderReportController');
                Route::get('order-report.data', 'SellOrderReportController@dataOrderReport');
                Route::get('order-report.data-excel', 'SellOrderReportController@dataExcel');
            }
        );

        /**
         * Trans: Chi tiết báo cáo bán hàng
         */
        Route::get('sell-report.detail-category', ['as' => 'sell-report.detail-category', 'uses' => 'SellReportController@detailCategory']);
        Route::get('sell-report.detail-food', ['as' => 'sell-report.detail-food', 'uses' => 'SellReportController@detailFood']);
        Route::get('sell-report.detail-discount', ['as' => 'sell-report.detail-discount', 'uses' => 'SellReportController@detailDiscount']);
        /**
         * Eng: profit-report
         * Trans: Lợi nhuận từng món, hàng hóa
         */
        Route::resource('profit-report', 'ProfitReportController');
        Route::get('profit-report.data', ['as' => 'profit-report.data', 'uses' => 'ProfitReportController@data']);

        /**
         * Eng: area-report
         * Trans: Báo cáo khu vực
         */
        Route::resource('area-report', 'AreaReportController');
        Route::get('area-report.data', ['as' => 'area-report.data', 'uses' => 'AreaReportController@data']);
        Route::get('area-report.detail', ['as' => 'area-report.detail', 'uses' => 'AreaReportController@detail']);
        /**
         * Eng: employee-report
         * Trans: Báo cáo nhân viên
         */
        Route::resource('employee-report', 'EmployeeReportController');
        Route::get('employee-report.data', ['as' => 'employee-report.data', 'uses' => 'EmployeeReportController@data']);
        Route::get('employee-report.detail', ['as' => 'employee-report.detail', 'uses' => 'EmployeeReportController@detail']);
        /**
         * Eng: detail-money-report
         * Trans: Báo cáo chi tiết tiền mặt
         */
        Route::resource('detail-money-report', 'DetailMoneyReportController');
        Route::get('detail-money-report.data', ['as' => 'detail-money-report.data', 'uses' => 'DetailMoneyReportController@data']);
        /**
         * Eng: business-results-report
         * Trans: Kết quả kinh doanh
         */
        Route::resource('business-results-report', 'BusinessResultsReportController');
        Route::get('business-results-report.data', ['as' => 'business-results-report.data', 'uses' => 'BusinessResultsReportController@data']);
        /**
         * Eng: price-change-histories
         * Trans: Báo cáo biến động giá
         */
        Route::resource('price-change-histories', 'PriceChangeHistoriesReportController');
        Route::get('price-change-histories-report.data', ['as' => 'price-change-histories-report.data', 'uses' => 'PriceChangeHistoriesReportController@data']);
        Route::get('price-change-histories-report.supplier', ['as' => 'price-change-histories-report.supplier', 'uses' => 'PriceChangeHistoriesReportController@supplier']);
        /**
         * Eng: price-change-histories
         * Trans: Báo cáo nạp thẻ
         */
        Route::resource('deposit-to-card-report', 'DepositToCardReportController');
        Route::get('deposit-to-card-report.data', ['as' => 'deposit-to-card-report.data', 'uses' => 'DepositToCardReportController@data']);
    }
);
/**
 * Trans: Folder Customer Controller
 */
Route::group(
    ['namespace' => 'Customer', 'as' => 'customer.', 'middleware' => []],
    function () {
        /**
         * Eng: restaurant-membership-card
         * Trans: Thẻ thành viên
         */
        Route::resource('restaurant-membership-card', 'RestaurantMembershipCardController');
        Route::get('restaurant-membership-card.data', ['as' => 'restaurant-membership-card.data', 'uses' => 'RestaurantMembershipCardController@data']);
        Route::get('restaurant-membership-card.detail', ['as' => 'restaurant-membership-card.detail', 'uses' => 'RestaurantMembershipCardController@detail']);
        Route::get('restaurant-membership-card.data-template', ['as' => 'restaurant-membership-card.data-template', 'uses' => 'RestaurantMembershipCardController@dataTemplate']);
        Route::post('restaurant-membership-card.create', ['as' => 'restaurant-membership-card.create', 'uses' => 'RestaurantMembershipCardController@create']);
        Route::post('restaurant-membership-card.update', ['as' => 'restaurant-membership-card.update', 'uses' => 'RestaurantMembershipCardController@update']);
        Route::post('restaurant-membership-card.change-status-restaurant', ['as' => 'restaurant-membership-card.change-status-restaurant', 'uses' => 'RestaurantMembershipCardController@changeStatusRestaurant']);
        Route::post('restaurant-membership-card.update-branch', ['as' => 'restaurant-membership-card.update-branch', 'uses' => 'RestaurantMembershipCardController@updateBranch']);
        Route::post('restaurant-membership-card.update-status-branch', ['as' => 'restaurant-membership-card.update-status-branch', 'uses' => 'RestaurantMembershipCardController@updateStatusBranch']);
        Route::get('restaurant-membership-card.data-setting', ['as' => 'restaurant-membership-card.data-setting', 'uses' => 'RestaurantMembershipCardController@dataSetting']);
        Route::post('restaurant-membership-card.setting', ['as' => 'restaurant-membership-card.setting', 'uses' => 'RestaurantMembershipCardController@setting']);
        Route::post('restaurant-membership-card.update-setting', ['as' => 'restaurant-membership-card.update-setting', 'uses' => 'RestaurantMembershipCardController@Updatesetting']);
        Route::get('restaurant-membership-card.data-branch', ['as' => 'restaurant-membership-card.data-branch', 'uses' => 'RestaurantMembershipCardController@dataBranch']);
        Route::get('restaurant-detail-membership-card.data-setting', ['as' => 'restaurant-detail-membership-card.data-setting', 'uses' => 'RestaurantMembershipCardController@detailPolicy']);
        Route::post('update-restaurant-membership-card.update-setting', ['as' => 'update-restaurant-membership-card.update-setting', 'uses' => 'RestaurantMembershipCardController@updateMemberShipCard']);
        /**
         * Eng: benefit-membership-card
         * Trans: Lợi ích thẻ thành viên
         */
        Route::resource('benefit-membership-card', 'BenefitMembershipCardController');
        Route::get('benefit-membership-card.card', ['as' => 'benefit-membership-card.card', 'uses' => 'BenefitMembershipCardController@membershipCard']);
        Route::get('benefit-membership-card.data', ['as' => 'benefit-membership-card.data', 'uses' => 'BenefitMembershipCardController@data']);
        Route::get('benefit-membership-card.data', ['as' => 'benefit-membership-card.data', 'uses' => 'BenefitMembershipCardController@data']);
        /**
         * Eng: customers
         * Trans: Danh sách khách hàng
         */
        Route::resource('customers', 'CustomersController');
        Route::get('customers.data', ['as' => 'customers.data', 'uses' => 'CustomersController@data']);
        Route::get('customers.data-use-point-customer', ['as' => 'customers.data-use-point-customer', 'uses' => 'CustomersController@dataUsePointCustomer']);
        Route::get('customers.detail', ['as' => 'customers.detail', 'uses' => 'CustomersController@detail']);
        Route::get('customers.list-card-tag', ['as' => 'customers.list-card-tag', 'uses' => 'CustomersController@listCardTag']);
        Route::post('customers.assign-restaurant-customer', ['as' => 'customers.assign-restaurant-customer', 'uses' => 'CustomersController@assignRestaurantCustomer']);
        Route::get('customers.list-customer', ['as' => 'customers.list-customer', 'uses' => 'CustomersController@listCustomer']);

        /**
         * Eng: card-value
         * Trans: Mệnh giá thẻ
         */
        Route::resource('card-value', 'CardValueController');
        Route::get('card-value.data', ['as' => 'card-value.data', 'uses' => 'CardValueController@data']);
        Route::post('card-value.create', ['as' => 'card-value.create', 'uses' => 'CardValueController@create']);
        Route::post('card-value.update', ['as' => 'card-value.update', 'uses' => 'CardValueController@update']);
        Route::post('card-value.change-status', ['as' => 'card-value.change-status', 'uses' => 'CardValueController@changeStatus']);
        /**
         * Eng: cards
         * Trans: Nạp thẻ
         */
        Route::resource('cards', 'CardsController');
        Route::get('cards.data', ['as' => 'cards.data', 'uses' => 'CardsController@data']);
        Route::get('cards.data-create', ['as' => 'cards.data-create', 'uses' => 'CardsController@dataCreate']);
        Route::get('cards.detail', ['as' => 'card.detail', 'uses' => 'CardsController@detail']);
        Route::get('cards.data-update', ['as' => 'cards.data-update', 'uses' => 'CardsController@dataUpdate']);
        Route::post('cards.create', ['as' => 'cards.create', 'uses' => 'CardsController@create']);
        Route::post('cards.confirm', ['as' => 'cards.confirm', 'uses' => 'CardsController@confirm']);
        Route::post('cards.cancel', ['as' => 'cards.cancel', 'uses' => 'CardsController@cancel']);
        Route::post('cards.update', ['as' => 'cards.update', 'uses' => 'CardsController@update']);
        Route::get('cards.search-customer', ['as' => 'cards.search-customer', 'uses' => 'CardsController@searchCustomer']);
        /**
         * Eng: birthday-gift
         * Trans: Quà sinh nhật
         */
        Route::resource('birthday-gift', 'BirthdayGiftController');
        Route::get('birthday-gift.data', ['as' => 'birthday-gift.data', 'uses' => 'BirthdayGiftController@data']);
        Route::get('birthday-gift.data-gift-item', ['as' => 'birthday-gift.data-gift-item', 'uses' => 'BirthdayGiftController@dataGiftItem']);
        Route::post('birthday-gift.post-img', ['as' => 'birthday-gift.post-img', 'uses' => 'BirthdayGiftController@postImg']);
        Route::post('birthday-gift.create', ['as' => 'birthday-gift.create', 'uses' => 'BirthdayGiftController@create']);
        Route::get('birthday-gift.data-gift-for-update', ['as' => 'birthday-gift.data-gift-for-update', 'uses' => 'BirthdayGiftController@dataGiftForUpdate']);
        Route::post('birthday-gift.update', ['as' => 'birthday-gift.update', 'uses' => 'BirthdayGiftController@update']);
        Route::post('birthday-gift.change-status', ['as' => 'birthday-gift.change-status', 'uses' => 'BirthdayGiftController@changeStatus']);
        /**
         * Eng: gift
         * Trans: Quà tặng
         */
        Route::resource('gift', 'GiftController');
        Route::get('gift.data', ['as' => 'gift.data', 'uses' => 'GiftController@data']);
        Route::post('gift.create', ['as' => 'gift.create', 'uses' => 'GiftController@create']);
        Route::post('gift.update', ['as' => 'gift.update', 'uses' => 'GiftController@update']);
        Route::post('gift.change-status', ['as' => 'gift.change-status', 'uses' => 'GiftController@changeStatus']);
        /**
         * Eng: discount
         * Trans: Mã giảm giá
         */
        //        Route::resource('discount', 'DiscountController');
        //        Route::get('discount.data', ['as' => 'discount.data', 'uses' => 'DiscountController@data']);
        //        Route::post('discount.create', ['as' => 'discount.create', 'uses' => 'DiscountController@create']);
        //        Route::post('discount.update', ['as' => 'discount.update', 'uses' => 'DiscountController@update']);
        //        Route::post('discount.change-status', ['as' => 'discount.change-status', 'uses' => 'DiscountController@changeStatus']);
        //        Route::get('discount.detail', ['as' => 'discount.detail', 'uses' => 'DiscountController@detail']);
        /**
         * Eng: message
         * Trans: Tin nhắn tự động
         */
        Route::resource('message', 'MessageController');
        Route::get('message.data', ['as' => 'message.data', 'uses' => 'MessageController@data']);
        Route::post('message.create', ['as' => 'message.create', 'uses' => 'MessageController@create']);
        Route::post('message.change-status', ['as' => 'message.change-status', 'uses' => 'MessageController@changeStatus']);
        Route::post('message.update', ['as' => 'message.update', 'uses' => 'MessageController@update']);
        Route::post('message.delete', ['as' => 'message.delete', 'uses' => 'MessageController@delete']);
        /**
         * Eng: Notification
         * Trans: Tin nhắn marketing
         */
        Route::resource('notification', 'NotificationController');
        Route::get('notification.data', ['as' => 'notification.data', 'uses' => 'NotificationController@data']);
        Route::post('notification.create', ['as' => 'notification.create', 'uses' => 'NotificationController@create']);
        Route::post('notification.update', ['as' => 'notification.update', 'uses' => 'NotificationController@update']);
        Route::get('notification.get-all-restaurant-membership-card', ['as' => 'notification.get-all-restaurant-membership-card', 'uses' => 'NotificationController@getAllRestaurantMembershipCard']);
        Route::post('notification.send-notify', ['as' => 'notification.send-notify', 'uses' => 'NotificationController@sendNotify']);
        Route::post('notification.post-img', ['as' => 'notification.post-img', 'uses' => 'NotificationController@uploadImg']);

        Route::group(
            ['namespace' => 'TakeAway', 'as' => 'takeaway.', 'middleware' => []],
            function () {
                /**
                 * Eng: take-away-branch
                 * Trans: Món mang về chi nhánh
                 */
                Route::resource('take-away-branch', 'TakeAwayBranchController');
                Route::get('take-away-branch.data', ['as' => 'take-away-branch.data', 'uses' => 'TakeAwayBranchController@data']);
                Route::get('take-away-branch.data-update', ['as' => 'take-away-branch.data-update', 'uses' => 'TakeAwayBranchController@dataUpdate']);
                Route::post('take-away-branch.update', ['as' => 'take-away-branch.update', 'uses' => 'TakeAwayBranchController@update']);
                Route::post('take-away-branch.setting', ['as' => 'take-away-branch.setting', 'uses' => 'TakeAwayBranchController@setting']);
                Route::get('take-away-branch.data-branch', ['as' => 'take-away-branch.data-branch', 'uses' => 'TakeAwayBranchController@dataBranch']);
                Route::get('take-away-branch.category-food', ['as' => 'take-away-branch.category-food', 'uses' => 'TakeAwayBranchController@categoryFood']);
                /**
                 * Eng: take-away-branch
                 * Trans: Món mang về thương hiệu
                 */
                Route::resource('take-away-brand', 'TakeAwayBrandController');
                Route::get('take-away-brand.data', ['as' => 'take-away-brand.data', 'uses' => 'TakeAwayBrandController@data']);
                Route::get('take-away-brand.data-update', ['as' => 'take-away-brand.data-update', 'uses' => 'TakeAwayBrandController@dataUpdate']);
                Route::post('take-away-brand.update', ['as' => 'take-away-brand.update', 'uses' => 'TakeAwayBrandController@update']);
                Route::post('take-away-brand.setting', ['as' => 'take-away-brand.setting', 'uses' => 'TakeAwayBrandController@setting']);
                Route::get('take-away-brand.data-branch', ['as' => 'take-away-brand.data-branch', 'uses' => 'TakeAwayBrandController@dataBranch']);
                Route::get('take-away-brand.category-food', ['as' => 'take-away-brand.category-food', 'uses' => 'TakeAwayBrandController@categoryFood']);
            }
        );


        /**
         * Eng: bestselling-food-customer
         * Trans: Món bán chạy
         */
        //        Route::resource('bestselling-food-customer', 'BestsellingFoodController');
        //        Route::get('bestselling-food-customer.data', ['as' => 'bestselling-food-customer.data', 'uses' => 'BestsellingFoodController@data']);
        //        Route::post('bestselling-food-customer.update', ['as' => 'bestselling-food-customer.update', 'uses' => 'BestsellingFoodController@update']);
        /**
         * Eng: booking-food-customer
         * Trans: Món booking
         */
        Route::resource('booking-food-customer', 'BookingFoodController');
        Route::get('booking-food-customer.data', ['as' => 'booking-food-customer.data', 'uses' => 'BookingFoodController@data']);
        Route::post('booking-food-customer.update', ['as' => 'booking-food-customer.update', 'uses' => 'BookingFoodController@update']);

        /**
         * Eng: assign-customer
         * Trans: Gán khách hàng
         */
        Route::resource('assign-customer', 'AssginCustomerController');
        Route::get('assign-customer.data', ['as' => 'assign-customer.data', 'uses' => 'AssginCustomerController@data']);
        Route::post('assign-customer.update', ['as' => 'assign-customer.update', 'uses' => 'AssginCustomerController@update']);
        Route::get('assign-customer.employee', ['as' => 'assign-customer.employee', 'uses' => 'AssginCustomerController@employee']);
        Route::post('assign-customer.assign', ['as' => 'assign-customer.assign', 'uses' => 'AssginCustomerController@assign']);


        /**
         * Eng: new-customer-report
         * Trans: Danh sách khách hàng mới
         */
        Route::resource('new-customer-report', 'NewCustomerReportController');
        Route::get('report-customer-new.data', ['as' => 'report-customer-new.data', 'uses' => 'NewCustomerReportController@getReportCustomerNew']);
        Route::get('report-customer-new.detail', ['as' => 'report-customer-new.detail', 'uses' => 'NewCustomerReportController@detail']);
        /**
         * Eng: history-point-report
         * Trans: Báo cáo lịch sử tích điểm
         */
        Route::resource('history-point-report', 'HistoryPointReportController');
        Route::get('history-point-report.data', ['as' => 'history-point-report.data', 'uses' => 'HistoryPointReportController@data']);
        /**
         * Eng: card-tag
         * Trans: Thẻ tag
         */
        Route::resource('card-tag', 'CardTagController');
        Route::get('card-tag.data', ['as' => 'card-tag.data', 'uses' => 'CardTagController@data']);
        Route::post('card-tag.create', ['as' => 'card-tag.create', 'uses' => 'CardTagController@create']);
        Route::get('card-tag.data-update', ['as' => 'card-tag.data-update', 'uses' => 'CardTagController@dataUpdate']);
        Route::post('card-tag.update', ['as' => 'card-tag.update', 'uses' => 'CardTagController@update']);
        Route::get('card-tag.detail-tag', ['as' => 'card-tag.detail-tag', 'uses' => 'CardTagController@detail']);
        Route::post('card-tag.change-status', ['as' => 'card-tag.change-status', 'uses' => 'CardTagController@changeStatus']);
        Route::get('card-tag.list-customer', ['as' => 'card-tag.list-customer', 'uses' => 'CardTagController@listCustomer']);
        //        Route::post('card-tag.assign-restaurant-customer', ['as' => 'card-tag.assign-restaurant-customer', 'uses' => 'CardTagController@assignRestaurantCustomer']);

        /**
         * Eng: banner
         * Trans: Banner
         */
        Route::resource('banner', 'BannerController');
        Route::get('banner-advertisement.data', ['as' => 'banner-advertisement.data', 'uses' => 'BannerController@data']);
        Route::post('banner-advertisement.create', ['as' => 'banner-advertisement.create', 'uses' => 'BannerController@create']);
        Route::post('banner-advertisement.update', ['as' => 'banner-advertisement.update', 'uses' => 'BannerController@update']);
        Route::post('banner-advertisement.change-status', ['as' => 'banner-advertisement.change-status', 'uses' => 'BannerController@changeStatus']);
        Route::get('banner-advertisement.data-update', ['as' => 'banner-advertisement.data-update', 'uses' => 'BannerController@dataUpdate']);
        Route::get('banner-advertisement.detail', ['as' => 'banner-advertisement.detail', 'uses' => 'BannerController@detail']);
        Route::post('banner-advertisement.delete', ['as' => 'banner-advertisement.delete', 'uses' => 'BannerController@deleteBannerAdverts']);
        Route::post('banner-advertisement.is-running', ['as' => 'banner-advertisement.is-running', 'uses' => 'BannerController@changeBannerIsRunning']);
        Route::get('banner-advertisement.gift', ['as' => 'banner-advertisement.gift', 'uses' => 'BannerController@gift']);
    }
);

/**
 * Trans: Folder Build Data Controller
 */
Route::group(
    ['namespace' => 'BuildData', 'as' => 'build_data.', 'middleware' => []],
    function () {
        /**
         * Eng: supplier
         * Trans: Nhà cung cấp
         */
        Route::group(
            ['namespace' => 'Supplier', 'as' => 'supplier.', 'middleware' => []],
            function () {
                /**
                 * Eng: supplier-data
                 * Trans: danh sách nhà cung cấp
                 */
                Route::resource('list-supplier-data', 'SupplierDataController');
                Route::get('list-supplier-data.data', ['as' => 'list-supplier-data.data', 'uses' => 'SupplierDataController@data']);
                Route::post('list-supplier-data.create', ['as' => 'list-supplier-data.create', 'uses' => 'SupplierDataController@create']);
                Route::get('list-supplier-data.get-role', ['as' => 'list-supplier-data.get-role', 'uses' => 'SupplierDataController@getlistRoleSupplier']);
                Route::post('list-supplier-data.create-contact', ['as' => 'list-supplier-data.create-contact', 'uses' => 'SupplierDataController@createContact']);
                Route::get('list-supplier-data.data-update-contact', ['as' => 'list-supplier-data.data-update-contact', 'uses' => 'SupplierDataController@dataUpdateContact']);
                Route::post('list-supplier-data.update-contact', ['as' => 'list-supplier-data.update-contact', 'uses' => 'SupplierDataController@updateContact']);
                Route::get('list-supplier-data.data-contact', ['as' => 'list-supplier-data.data-contact', 'uses' => 'SupplierDataController@dataContact']);
                Route::post('list-supplier-data.change-status-contact', ['as' => 'list-supplier-data.change-status-contact', 'uses' => 'SupplierDataController@changeStatusContact']);

                /**
                 * Eng: supplier-datarestaurant-assign-supplier-data
                 * Trans: Nhà cung cấp
                 */
                Route::get('restaurant-supplier-data.detail', ['as' => 'restaurant-supplier-data.detail', 'uses' => 'SupplierDataController@detail']);
                Route::get('restaurant-supplier-data.material-supplier', ['as' => 'restaurant-supplier-data.material-supplier', 'uses' => 'SupplierDataController@dataMaterialSupplier']);
                Route::post('restaurant-supplier-data.update-material', ['as' => 'restaurant-supplier-data.update-material', 'uses' => 'SupplierDataController@updateMaterial']);
                Route::get('restaurant-supplier-data.data-update', ['as' => 'restaurant-supplier-data.data-update', 'uses' => 'SupplierDataController@dataUpdate']);
                Route::post('restaurant-supplier-data.update', ['as' => 'restaurant-supplier-data.update', 'uses' => 'SupplierDataController@update']);
                Route::post('restaurant-supplier-data.change-status', ['as' => 'restaurant-supplier-data.change-status', 'uses' => 'SupplierDataController@changeStatus']);
                /**
                 * Eng: list-material-data
                 * Trans: Nguyên liệu nhà cung cấp
                 */
                Route::resource('supplier-material-data', 'SupplierMaterialDataController');
                Route::get('supplier-material-data.data', ['as' => 'supplier-material-data.data', 'uses' => 'SupplierMaterialDataController@data']);
                Route::get('supplier-material-data.get-supplier', ['as' => 'supplier-material-data.get-supplier', 'uses' => 'SupplierMaterialDataController@getHandBookSupplier']);
                Route::get('supplier-material-data.get-data-create', ['as' => 'supplier-
                .get-data-create', 'uses' => 'SupplierMaterialDataController@getDataCreate']);
                Route::get('supplier-material-data.get-specifications-by-unit', ['as' => 'supplier-material-data.get-specifications-by-unit', 'uses' => 'SupplierMaterialDataController@getSpecificationsByUnit']);
                Route::post('supplier-material-data.create-Supplier-material', ['as' => 'supplier-material-data.create-Supplier-material', 'uses' => 'SupplierMaterialDataController@createSupplierMaterial']);
                Route::post('supplier-material-data.change-supplier-material-status', ['as' => 'supplier-material-data.change-supplier-material-status', 'uses' => 'SupplierMaterialDataController@changeSupplierMaterialStatus']);
                Route::get('supplier-material-data.get-detail', ['as' => 'supplier-material-data.get-detail', 'uses' => 'SupplierMaterialDataController@detail']);
                Route::get('supplier-material-data.get-supplier-book-hand-material', ['as' => 'supplier-material-data.get-supplier-book-hand-material', 'uses' => 'SupplierMaterialDataController@getRestaurantMaterialBySupplier']);
                Route::get('supplier-material-data.get-restaurant-material', ['as' => 'supplier-material-data.get-restaurant-material', 'uses' => 'SupplierMaterialDataController@getMaterialRestaurants']);
                Route::post('supplier-material-data.assign-restaurant-material', ['as' => 'supplier-material-data.assign-restaurant-material', 'uses' => 'SupplierMaterialDataController@assignRestaurantMaterial']);
                Route::get('supplier-material-data.get-data-update', ['as' => 'supplier-material-data.get-data-update', 'uses' => 'SupplierMaterialDataController@getDataUpdate']);
                Route::post('supplier-material-data.update-Supplier-material', ['as' => 'supplier-material-data.update-Supplier-material', 'uses' => 'SupplierMaterialDataController@updateSupplierMaterial']);
                Route::post('supplier-material-data.remove-material-book-supplier', ['as' => 'supplier-material-data.remove-material-book-supplier', 'uses' => 'SupplierMaterialDataController@changeStatusMaterialBookSupplier']);
            }
        );

        /**
         * Eng: assign-supplier
         * Trans: gán nhà cung cấp
         */
        Route::group(
            ['namespace' => 'AssignSupplier', 'as' => 'assign-supplier.', 'middleware' => []],
            function () {
                /**
                 * Eng: restaurant-assign-supplier-data
                 * Trans: Gán nhà cung cấp Công ty/Nhà hàng
                 */
                Route::resource('restaurant-assign-supplier-data', 'AssignRestaurantSupplierDataController');
                Route::get('restaurant-assign-supplier-data.data', ['as' => 'restaurant-assign-supplier-data.data', 'uses' => 'AssignRestaurantSupplierDataController@data']);
                Route::post('restaurant-assign-supplier-data.update', ['as' => 'restaurant-assign-supplier-data.update', 'uses' => 'AssignRestaurantSupplierDataController@update']);
                Route::post('restaurant-assign-supplier-data.un-assign', ['as' => 'restaurant-assign-supplier-data.un-assign', 'uses' => 'AssignRestaurantSupplierDataController@unAssign']);
                /**
                 * Eng: brand-assign-supplier-data
                 * Trans: Gán nhà cung cấp thương hiệu
                 */
                Route::resource('brand-assign-supplier-data', 'AssignBrandSupplierDataController');
                Route::get('brand-assign-supplier-data.data', ['as' => 'brand-assign-supplier-data.data', 'uses' => 'AssignBrandSupplierDataController@data']);
                Route::post('brand-assign-supplier-data.update', ['as' => 'brand-assign-supplier-data.update', 'uses' => 'AssignBrandSupplierDataController@update']);
                Route::post('brand-assign-supplier-data.un-assign', ['as' => 'brand-assign-supplier-data.un-assign', 'uses' => 'AssignBrandSupplierDataController@unAssign']);
                /**
                 * Eng: branch-assign-supplier-data
                 * Trans: Gán nhà cung cấp chi nhánh
                 */
                Route::resource('branch-assign-supplier-data', 'AssignBranchSupplierDataController');
                Route::get('branch-assign-supplier-data.data', ['as' => 'branch-assign-supplier-data.data', 'uses' => 'AssignBranchSupplierDataController@data']);
                Route::post('branch-assign-supplier-data.update', ['as' => 'branch-assign-supplier-data.update', 'uses' => 'AssignBranchSupplierDataController@update']);
                Route::post('branch-assign-supplier-data.update-branches', ['as' => 'branch-assign-supplier-data.update-branches', 'uses' => 'AssignBranchSupplierDataController@updateAll']);
            }
        );
        /**
         * Eng: assign-supplier-material
         * Trans: gán nguyên liệu nhà cung cấp
         */
        Route::group(
            ['namespace' => 'AssignSupplierMaterial', 'as' => 'assign_supplier_material.', 'middleware' => []],
            function () {
                /**
                 * Eng: restaurant-material-data
                 * Trans: Gán nguyên liệu ncc Công ty/Nhà hàng
                 */
                Route::resource('restaurant-material-data', 'AssignRestaurantSupplierMaterialDataController');
                Route::get('restaurant-material-data.data', ['as' => 'restaurant-material-data.data', 'uses' => 'AssignRestaurantSupplierMaterialDataController@data']);
                Route::get('restaurant-material-data.supplier', ['as' => 'restaurant-material-data.supplier', 'uses' => 'AssignRestaurantSupplierMaterialDataController@supplier']);
                Route::get('restaurant-material-data.material', ['as' => 'restaurant-material-data.material', 'uses' => 'AssignRestaurantSupplierMaterialDataController@materialRestaurant']);
                Route::post('restaurant-material-data.update', ['as' => 'restaurant-material-data.update', 'uses' => 'AssignRestaurantSupplierMaterialDataController@update']);
                Route::post('restaurant-assign-supplier-material-data.un-assign', ['as' => 'restaurant-assign-supplier-material-data.un-assign', 'uses' => 'AssignRestaurantSupplierMaterialDataController@unAssign']);
                /**
                 * Eng: brand-material-data
                 * Trans: Gán nguyên liệu ncc thương hiệu
                 */
                Route::resource('brand-material-data', 'AssignBrandSupplierMaterialDataController');
                Route::get('brand-material-data.data', ['as' => 'brand-material-data.data', 'uses' => 'AssignBrandSupplierMaterialDataController@data']);
                Route::get('brand-material-data.supplier', ['as' => 'brand-material-data.supplier', 'uses' => 'AssignBrandSupplierMaterialDataController@supplier']);
                Route::post('brand-material-data.update', ['as' => 'brand-material-data.update', 'uses' => 'AssignBrandSupplierMaterialDataController@update']);
                Route::post('brand-assign-supplier-material-data.un-assign', ['as' => 'brand-assign-supplier-material-data.un-assign', 'uses' => 'AssignBrandSupplierMaterialDataController@unAssign']);
                /**
                 * Eng: branch-material-data
                 * Trans: Gán nguyên liệu ncc chi nhánh
                 */
                Route::resource('branch-material-data', 'AssignBranchSupplierMaterialDataController');
                Route::get('branch-material-data.data', ['as' => 'branch-material-data.data', 'uses' => 'AssignBranchSupplierMaterialDataController@data']);
                Route::get('branch-material-data.supplier', ['as' => 'branch-material-data.supplier', 'uses' => 'AssignBranchSupplierMaterialDataController@supplier']);
                Route::post('branch-material-data.update', ['as' => 'branch-material-data.update', 'uses' => 'AssignBranchSupplierMaterialDataController@update']);
            }
        );

        /**
         * Eng: material
         * Trans: nguyên liệu
         */
        Route::group(
            ['namespace' => 'Material', 'as' => 'material.', 'middleware' => []],
            function () {
                /**
                 * Eng: unit-data
                 * Trans: Đơn vị nhập hàng
                 */
                Route::resource('unit-data', 'UnitDataController');
                Route::get('unit-data.data', ['as' => 'unit-data.data', 'uses' => 'UnitDataController@data']);
                Route::post('unit-data.create', ['as' => 'unit-data.create', 'uses' => 'UnitDataController@create']);
                Route::get('unit-data.data-update', ['as' => 'unit-data.data-update', 'uses' => 'UnitDataController@dataUpdate']);
                Route::get('unit-data.detail', ['as' => 'unit-data.detail', 'uses' => 'UnitDataController@detail']);
                Route::post('unit-data.update', ['as' => 'unit-data.update', 'uses' => 'UnitDataController@update']);
                Route::post('unit-data.change-status', ['as' => 'unit-data.change-status', 'uses' => 'UnitDataController@changeStatus']);
                Route::get('unit-data.specifications', ['as' => 'unit-data.specifications', 'uses' => 'UnitDataController@specifications']);
                Route::get('unit-data.specifications-of-change', ['as' => 'unit-data.specifications-of-change', 'uses' => 'UnitDataController@specificationsOfexchange']);
                Route::post('unit-data.confirm-unit', ['as' => 'unit-data.confirm-unit', 'uses' => 'UnitDataController@confirmUnit']);

                /**
                 * Eng: specifications-data
                 * Trans: Quy cách nhập hàng
                 */
                Route::resource('specifications-data', 'SpecificationsDataController');
                Route::get('specifications-data.data', ['as' => 'specifications-data.data', 'uses' => 'SpecificationsDataController@data']);
                Route::get('specifications-data.data-server', ['as' => 'specifications-data.data-server', 'uses' => 'SpecificationsDataController@dataServer']);
                Route::post('specifications-data.create', ['as' => 'specifications-data.create', 'uses' => 'SpecificationsDataController@create']);
                Route::get('specifications-data.data-update', ['as' => 'specifications-data.data-update', 'uses' => 'SpecificationsDataController@dataUpdate']);
                Route::post('specifications-data.update', ['as' => 'specifications-data.update', 'uses' => 'SpecificationsDataController@update']);
                Route::post('specifications-data.change-status', ['as' => 'specifications-data.change-status', 'uses' => 'SpecificationsDataController@changeStatus']);

                /**
                 * Eng: unit-order-data
                 * Trans: Đơn vị bán hàng
                 */
                Route::resource('unit-order-data', 'UnitOrderDataController');
                Route::get('unit-order-data.data', ['as' => 'unit-order-data.data', 'uses' => 'UnitOrderDataController@data']);
                Route::get('unit-order-data.material', ['as' => 'unit-order-data.material', 'uses' => 'UnitOrderDataController@material']);
                Route::post('unit-order-data.create', ['as' => 'unit-order-data.create', 'uses' => 'UnitOrderDataController@create']);
                Route::post('unit-order-data.update', ['as' => 'unit-order-data.update', 'uses' => 'UnitOrderDataController@update']);
                Route::post('unit-order-data.delete', ['as' => 'unit-order-data.delete', 'uses' => 'UnitOrderDataController@delete']);

                /**
                 * Eng: material-data
                 * Trans: Nguyên liệu
                 */
                Route::resource('material-data', 'MaterialDataController');
                Route::get('material-data.data', ['as' => 'material-data.data', 'uses' => 'MaterialDataController@data']);
                Route::get('material-data.unit', ['as' => 'material-data.unit', 'uses' => 'MaterialDataController@unit']);
                Route::get('material-data.unit-order', ['as' => 'material-data.unit-order', 'uses' => 'MaterialDataController@unitOrder']);
                Route::get('material-data.specifications', ['as' => 'material-data.specifications', 'uses' => 'MaterialDataController@specifications']);
                Route::get('material-data.category', ['as' => 'material-data.category', 'uses' => 'MaterialDataController@category']);
                Route::post('material-data.change-status', ['as' => 'material-data.change-status', 'uses' => 'MaterialDataController@changeStatus']);
                Route::get('material-data.detail', ['as' => 'material-data.detail', 'uses' => 'MaterialDataController@detail']);
                Route::post('material-data.create', ['as' => 'material-data.create', 'uses' => 'MaterialDataController@create']);
                Route::get('material-data.supplier', ['as' => 'material-data.supplier', 'uses' => 'MaterialDataController@supplier']);
                Route::get('material-data.material-supplier', ['as' => 'material-data.material-supplier', 'uses' => 'MaterialDataController@materialSupplier']);
                Route::get('material-data.data-update', ['as' => 'material-data.data-update', 'uses' => 'MaterialDataController@dataUpdate']);
                Route::post('material-data.update', ['as' => 'material-data.update', 'uses' => 'MaterialDataController@update']);
                Route::post('material-data.create-specifications', ['as' => 'material-data.create-specifications', 'uses' => 'MaterialDataController@createSpecifications']);
                Route::get('material-data-brand', ['as' => 'material-data.data-brand', 'uses' => 'MaterialDataController@indexBrand']);
                Route::get('material-data.dataBrand', ['as' => 'material-data.dataBrand', 'uses' => 'MaterialDataController@dataBrand']);
                Route::get('material-data.unit-food-maps', ['as' => 'material-data.unit-food-maps', 'uses' => 'MaterialDataController@unitFoodMap']);
                Route::post('material-data.update-quantity-food', ['as' => 'material-data.update-quantity-food', 'uses' => 'MaterialDataController@unitFoodUpdate']);
                Route::post('material-data.delete-unit-order-map', ['as' => 'material-data.delete-unit-order-map', 'uses' => 'MaterialDataController@deleteUnitOrder']);

                /**
                 * Eng: inventory-material
                 * Trans: Nguyên liệu kiểm kê kỳ
                 */
                Route::resource('inventory-material', 'InventoryMaterialDataController');
                Route::get('inventory-material.data', ['as' => 'inventory-material.data', 'uses' => 'InventoryMaterialDataController@data']);
                Route::post('inventory-material.update', ['as' => 'inventory-material.update', 'uses' => 'InventoryMaterialDataController@update']);
            }
        );


        /**
         * Eng: food
         * Trans: món ăn
         */
        Route::group(
            ['namespace' => 'GroupMaterial', 'as' => 'group_material.', 'middleware' => []],
            function () {
                /**
                 * Eng: category-group-material
                 * Trans: Loại Nhóm nguyên liệu
                 */
                Route::resource('category-group-material', 'CategoryGroupMaterialController');
                Route::GET('category-group-material.data', ['as' => 'category-group-material.data', 'uses' => 'CategoryGroupMaterialController@data']);
                Route::POST('category-group-material.create', ['as' => 'category-group-material.create', 'uses' => 'CategoryGroupMaterialController@create']);
                Route::GET('category-group-material.data-update', ['as' => 'category-group-material.data-update', 'uses' => 'CategoryGroupMaterialController@dataUpdate']);
                Route::POST('category-group-material.update', ['as' => 'category-group-material.update', 'uses' => 'CategoryGroupMaterialController@update']);
                Route::POST('category-group-material.delect', ['as' => 'category-group-material.delect', 'uses' => 'CategoryGroupMaterialController@delect']);


                /**
                 * Eng: map-group-material
                 * Trans: Gán Nhóm nguyên liệu
                 */
                Route::resource('map-group-material', 'MapGroupMaterialController');
                Route::GET('map-group-material.data', ['as' => 'map-group-material.assgin', 'uses' => 'MapGroupMaterialController@data']);
                Route::POST('map-group-material.assgin', ['as' => 'category-group-material.assgin', 'uses' => 'MapGroupMaterialController@assgin']);
                Route::GET('map-group-material.dataCategory', ['as' => 'category-group-material.dataCategory', 'uses' => 'MapGroupMaterialController@dataCategory']);
                Route::GET('map-group-material.material', ['as' => 'category-group-material.material', 'uses' => 'MapGroupMaterialController@material']);
                Route::POST('map-group-material.map-material', ['as' => 'map-group-material.map-material', 'uses' => 'MapGroupMaterialController@mapMaterial']);
                Route::GET('map-group-material.material-category', ['as' => 'map-group-material.material-category', 'uses' => 'MapGroupMaterialController@materialCategory']);
            }
        );


        /**
         * Eng: food
         * Trans: món ăn
         */
        Route::group(
            ['namespace' => 'Food', 'as' => 'food.', 'middleware' => []],
            function () {
                /**
                 * Eng: food-data
                 * Trans: Món ăn
                 */
                Route::resource('food-data', 'FoodDataController');
                Route::get('food-data.data', ['as' => 'food-data.data', 'uses' => 'FoodDataController@data']);
                Route::get('food-data.data-food-code', ['as' => 'food-data.data-food-code', 'uses' => 'FoodDataController@dataCodeFood']);
                Route::get('food-data-manage.data-create', ['as' => 'food-data.data-create', 'uses' => 'FoodDataController@dataCreateFoodManage']);

                /**
                 * Eng: category-food-data
                 * Trans: Danh mục món ăn
                 */
                Route::resource('category-food-data', 'CategoryFoodDataController');
                Route::get('category-food-data.data', ['as' => 'category-food-data.data', 'uses' => 'CategoryFoodDataController@data']);
                Route::post('category-food-data.change-status', ['as' => 'category-food-data.change-status', 'uses' => 'CategoryFoodDataController@changeStatus']);
                Route::post('category-food-data.create', ['as' => 'category-food-data.create', 'uses' => 'CategoryFoodDataController@create']);
                Route::post('category-food-data.update', ['as' => 'category-food-data.update', 'uses' => 'CategoryFoodDataController@update']);

                /**
                 * Eng: unit-food-data
                 * Trans: Đơn vị món ăn
                 */
                Route::resource('unit-food-data', 'UnitFoodDataController');
                Route::get('unit-food-data.data', ['as' => 'unit-food-data.data', 'uses' => 'UnitFoodDataController@data']);
                Route::post('unit-food-data.remove', ['as' => 'unit-food-data.remove', 'uses' => 'UnitFoodDataController@remove']);
                Route::post('unit-food-data.create', ['as' => 'unit-food-data.create', 'uses' => 'UnitFoodDataController@create']);
                Route::post('unit-food-data.update', ['as' => 'unit-food-data.update', 'uses' => 'UnitFoodDataController@update']);

                /**
                 * Eng: gift-food-data
                 * Trans: Món tặng
                 */
                Route::resource('gift-food-data', 'GiftFoodDataController');
                Route::get('gift-food-data.data', ['as' => 'gift-food-data.data', 'uses' => 'GiftFoodDataController@data']);
                Route::get('gift-food-data.category', ['as' => 'gift-food-data.category', 'uses' => 'GiftFoodDataController@category']);
                Route::post('gift-food-data.assign-gift-food', ['as' => 'gift-food-data.assign-gift-food', 'uses' => 'GiftFoodDataController@assignGiftFood']);

                /**
                 * Eng: note-food-data
                 * Trans: Ghi chú món ăn
                 */
                Route::resource('note-food-data', 'NoteFoodDataController');
                Route::get('note-food-data.data', ['as' => 'note-food-data.data', 'uses' => 'NoteFoodDataController@data']);
                Route::get('note-food-data.data-food', ['as' => 'note-food-data.data-food', 'uses' => 'NoteFoodDataController@dataFood']);
                Route::post('note-food-data.create', ['as' => 'note-food-data.create', 'uses' => 'NoteFoodDataController@create']);
                Route::post('note-food-data.update', ['as' => 'note-food-data.update', 'uses' => 'NoteFoodDataController@update']);
                Route::post('note-food-data.change-status', ['as' => 'note-food-data.change-status', 'uses' => 'NoteFoodDataController@changeStatus']);
                Route::get('note-food-data.detail', ['as' => 'note-food-data.detail', 'uses' => 'NoteFoodDataController@detail']);
                Route::get('note-food-data.data-update', ['as' => 'note-food-data.data-update', 'uses' => 'NoteFoodDataController@dataUpdate']);
                Route::get('note-food-data.data-food-update', ['as' => 'note-food-data.data-food-update', 'uses' => 'NoteFoodDataController@dataFoodUpdate']);
                Route::get('note-food-data.category', ['as' => 'note-food-data.category', 'uses' => 'NoteFoodDataController@category']);

                /**
                 * Eng: warning-price-food
                 * Trans: Cảnh báo giá vốn
                 */
                Route::resource('warning-price-food', 'WarningPriceFoodController');
                Route::get('warning-price-food.data', ['as' => 'warning-price-food.data', 'uses' => 'WarningPriceFoodController@data']);
                Route::post('warning-price-food.update', ['as' => 'warning-price-food.update', 'uses' => 'WarningPriceFoodController@update']);
            }
        );

        /**
         * Eng: personnel
         * Trans: nhân sự
         */
        Route::group(
            ['namespace' => 'Personnel', 'as' => 'personnel.', 'middleware' => []],
            function () {
                /**
                 * Eng: employee-data
                 * Trans: nhân viên
                 */
                Route::resource('employee-data', 'EmployeeDataController');
                Route::get('employee-data.data', ['as' => 'employee-data.data', 'uses' => 'EmployeeDataController@data']);
                Route::get('employee-data.role', ['as' => 'employee-data.role', 'uses' => 'EmployeeDataController@role']);
                Route::get('employee-data.rank', ['as' => 'employee-data.rank', 'uses' => 'EmployeeDataController@rank']);
                Route::get('employee-data.salary', ['as' => 'employee-data.salary', 'uses' => 'EmployeeDataController@salary']);
                Route::get('employee-data.area', ['as' => 'employee-data.area', 'uses' => 'EmployeeDataController@area']);
                Route::get('employee-data.work', ['as' => 'employee-data.work', 'uses' => 'EmployeeDataController@work']);
                Route::get('employee-data.detail', ['as' => 'employee-data.detail', 'uses' => 'EmployeeDataController@detail']);
                Route::post('employee-data.create', ['as' => 'employee-data.create', 'uses' => 'EmployeeDataController@create']);

                /**
                 * Eng: permission-employee-data
                 * Trans: Quyền nhân viên
                 */
                Route::resource('permission-employee-data', 'PermissionEmployeeDataController');
                Route::get('permission-employee-data.employee', ['as' => 'permission-employee-data.employee', 'uses' => 'PermissionEmployeeDataController@employee']);
                Route::get('permission-employee-data.permission', ['as' => 'permission-employee-data.permission', 'uses' => 'PermissionEmployeeDataController@permission']);
                Route::post('permission-employee-data.update', ['as' => 'permission-employee-data.update', 'uses' => 'PermissionEmployeeDataController@update']);

                /**F
                 * Eng: role-data
                 * Trans: Quyền bộ phận
                 */
                Route::resource('role-data', 'RoleDataController');
                Route::get('role-data.data', ['as' => 'role-data.data', 'uses' => 'RoleDataController@data']);
                Route::get('role-data.permission', ['as' => 'role-data.permission', 'uses' => 'RoleDataController@permission']);
                Route::post('role-data.update-permission', ['as' => 'role-data.update-permission', 'uses' => 'RoleDataController@updatePrivileges']);
                Route::get('role-data.data-permission', ['as' => 'role-data.data-permission', 'uses' => 'RoleDataController@dataPermission']);
                Route::post('role-data.create', ['as' => 'role-data.create', 'uses' => 'RoleDataController@create']);
                Route::post('role-data.update', ['as' => 'role-data.update', 'uses' => 'RoleDataController@update']);

                /**
                 * Eng: wage-data
                 * Trans: Bậc lương
                 */
                Route::resource('wage-data', 'WageDataController');
                Route::get('wage-data.data', ['as' => 'wage-data.data', 'uses' => 'WageDataController@data']);
                Route::post('wage-data.create', ['as' => 'wage-data.create', 'uses' => 'WageDataController@create']);
                Route::post('wage-data.update', ['as' => 'wage-data.update', 'uses' => 'WageDataController@update']);
                Route::post('wage-data.change-status', ['as' => 'wage-data.change-status', 'uses' => 'WageDataController@changeStatus']);
                /**
                 * Eng: shift-data
                 * Trans: Danh sách ca làm
                 */
                Route::resource('shift-data', 'ShiftDataController');
                Route::get('shift-data.data', ['as' => 'shift-data.data', 'uses' => 'ShiftDataController@data']);
                Route::post('shift-data.create', ['as' => 'shift-data.create', 'uses' => 'ShiftDataController@create']);
                Route::post('shift-data.update', ['as' => 'shift-data.update', 'uses' => 'ShiftDataController@update']);
                Route::post('shift-data.status', ['as' => 'shift-data.status', 'uses' => 'ShiftDataController@changeStatus']);

                /**
                 * Eng: level-data
                 * Trans: Thứ hạng
                 */
                Route::resource('level-data', 'LevelDataController');
                Route::get('level-data.data', ['as' => 'level-data.data', 'uses' => 'LevelDataController@data']);
                Route::get('level-data.role', ['as' => 'level-data.role', 'uses' => 'LevelDataController@role']);
                Route::post('level-data.create', ['as' => 'level-data.create', 'uses' => 'LevelDataController@create']);
                Route::post('level-data.update', ['as' => 'level-data.update', 'uses' => 'LevelDataController@update']);

                /**
                 * Eng: category-work-data
                 * Trans: Danh mục công việc
                 */
                Route::resource('category-work-data', 'CategoryWorkDataController');
                Route::get('category-work-data.data', ['as' => 'category-work-data.data', 'uses' => 'CategoryWorkDataController@data']);
                Route::post('category-work-data.create', ['as' => 'category-work-data.create', 'uses' => 'CategoryWorkDataController@create']);
                Route::post('category-work-data.update', ['as' => 'category-work-data.update', 'uses' => 'CategoryWorkDataController@update']);
                Route::post('category-work-data.sort', ['as' => 'category-work-data.sort', 'uses' => 'CategoryWorkDataController@sort']);
                //                Route::post('category-work-data.change-status', ['as' => 'category-work-data.change-status', 'uses' => 'CategoryWorkDataController@changeStatus']);

                /**
                 * Eng: work-data
                 * Trans: Công việc
                 */
                Route::resource('work-data', 'WorkDataController');
                Route::get('work-data.data', ['as' => 'work-data.data', 'uses' => 'WorkDataController@data']);
                Route::get('work-data.data-role', ['as' => 'work-data.data-role', 'uses' => 'WorkDataController@dataRole']);
                Route::get('work-data.data-category', ['as' => 'work-data.data-category', 'uses' => 'WorkDataController@dataCategory']);
                Route::post('work-data.create', ['as' => 'work-data.create', 'uses' => 'WorkDataController@create']);
                Route::post('work-data.update', ['as' => 'work_data.update', 'uses' => 'WorkDataController@update']);
                Route::post('work-data.status', ['as' => 'work_data.status', 'uses' => 'WorkDataController@status']);
                Route::post('work-data.sort', ['as' => 'work_data.sort', 'uses' => 'WorkDataController@sort']);
                Route::post('work-data.check_excel', ['as' => 'work_data.check_excel', 'uses' => 'WorkDataController@check_excel']);
                Route::post('work-data.import_work_excel', ['as' => 'work_data.import_work_excel', 'uses' => 'WorkDataController@Import_Excel']);

                /**
                 * Eng: point-data
                 * Trans: Thang điểm thưởng
                 */
                Route::resource('point-data', 'PointDataController');
                Route::get('point-data.data', ['as' => 'point-data.data', 'uses' => 'PointDataController@data']);
                Route::get('point-data.role', ['as' => 'point-data.role', 'uses' => 'PointDataController@role']);
                Route::post('point-data.create', ['as' => 'point-data.create', 'uses' => 'PointDataController@create']);
                Route::post('point-data.update', ['as' => 'point-data.update', 'uses' => 'PointDataController@update']);
                Route::post('point-data.remove', ['as' => 'point-data.remove', 'uses' => 'PointDataController@remove']);

                /**
                 * Eng: booking-bonus-data
                 * Trans: Thưởng booking
                 */
                Route::resource('booking-bonus-data', 'BookingBonusDataController');
                Route::get('booking-bonus-data.data', ['as' => 'booking-bonus-data.data', 'uses' => 'BookingBonusDataController@data']);
                Route::post('booking-bonus-data.create', ['as' => 'booking-bonus-data.create', 'uses' => 'BookingBonusDataController@create']);
                Route::post('booking-bonus-data.update', ['as' => 'booking-bonus-data.update', 'uses' => 'BookingBonusDataController@update']);
                Route::post('booking-bonus-data.change-status', ['as' => 'booking-bonus-data.change-status', 'uses' => 'BookingBonusDataController@changeStatus']);
                Route::post('booking-bonus-data.update-setting', ['as' => 'booking-bonus-data.update-setting', 'uses' => 'BookingBonusDataController@updateSetting']);
                Route::post('booking-bonus-data.data-setting', ['as' => 'booking-bonus-data.data-setting', 'uses' => 'BookingBonusDataController@dataBookingSetting']);

                /**
                 * Eng: point-data
                 * Trans: Thưởng kaizen
                 */
                Route::resource('kaizen-bonus-data', 'KaizenBonusDataController');
                Route::get('kaizen-bonus-data.data', ['as' => 'kaizen-bonus-data.data', 'uses' => 'KaizenBonusDataController@data']);
                Route::post('kaizen-bonus-data.create', ['as' => 'kaizen-bonus-data.create', 'uses' => 'KaizenBonusDataController@create']);
                Route::post('kaizen-bonus-data.update', ['as' => 'kaizen-bonus-data.update', 'uses' => 'KaizenBonusDataController@update']);
            }
        );

        /**
         * Eng: business
         * Trans: kinh doanh
         */
        Route::group(
            ['namespace' => 'Business', 'as' => 'business.', 'middleware' => []],
            function () {
                /**
                 * Eng: area-data
                 * Trans: Khu vực
                 */
                Route::resource('area-data', 'AreaDataController');
                Route::get('area-data.data', ['as' => 'area.data', 'uses' => 'AreaDataController@data']);
                Route::get('area-data.data-update', ['as' => 'area.data-update', 'uses' => 'AreaDataController@dataUpdate']);
                Route::post('area-data.create', ['as' => 'area.create', 'uses' => 'AreaDataController@create']);
                Route::post('area-data.update', ['as' => 'area.update', 'uses' => 'AreaDataController@update']);
                Route::post('area-data.status', ['as' => 'area.status', 'uses' => 'AreaDataController@changeStatus']);

                /**
                 * Eng: table-data
                 * Trans: Bàn
                 */
                Route::resource('table-data', 'TableDataController');
                Route::get('table-data.data', ['as' => 'table-data.data', 'uses' => 'TableDataController@data']);
                Route::post('table-data.create', ['as' => 'table-data.create', 'uses' => 'TableDataController@create']);
                Route::post('table-data.update', ['as' => 'table-data.update', 'uses' => 'TableDataController@update']);
                Route::get('table-data.area', ['as' => 'table-data.area', 'uses' => 'TableDataController@area']);
                Route::post('table-data.change-status', ['as' => 'table-data.change-status', 'uses' => 'TableDataController@updateStatus']);

                /**
                 * Eng: permission-sales
                 * Trans: Quyền doanh số
                 */
                Route::resource('permission-sales', 'PermissionSalesController');
                Route::get('permission-sales.data', ['as' => 'permission-sales.data', 'uses' => 'PermissionSalesController@data']);
                Route::post('permission-sales.changeArea', ['as' => 'permission-sales.changeArea', 'uses' => 'PermissionSalesController@changeArea']);
                Route::post('permission-sales.manage-branch', ['as' => 'permission-sales.manage-branch', 'uses' => 'PermissionSalesController@manageBranch']);
                Route::get('permission-sales.data-update', ['as' => 'permission-sales.data-update', 'uses' => 'PermissionSalesController@dataUpdate']);

                /**
                 * Eng: reasons-cancel-food-data
                 * Trans: Lý do hủy món ăn
                 */
                Route::resource('reasons-cancel-food-data', 'ReasonsCancelFoodDataController');
                Route::get('reasons-cancel-food-data.data', ['as' => 'reasons-cancel-food-data.data', 'uses' => 'ReasonsCancelFoodDataController@data']);
                Route::post('reasons-cancel-food-data.create', ['as' => 'reasons-cancel-food-data.create', 'uses' => 'ReasonsCancelFoodDataController@create']);
                Route::post('reasons-cancel-food-data.update', ['as' => 'reasons-cancel-food-data.update', 'uses' => 'ReasonsCancelFoodDataController@update']);
                Route::post('reasons-cancel-food-data.remove', ['as' => 'reasons-cancel-food-data.remove', 'uses' => 'ReasonsCancelFoodDataController@remove']);

                /**
                 * Eng: price-temporary
                 * Trans: giá thời vụ
                 */
                Route::resource('price-temporary', 'PriceTemporaryController');
                Route::get('price-temporary.data', ['as' => 'price-temporary.data', 'uses' => 'PriceTemporaryController@data']);
                Route::post('price-temporary.update', ['as' => 'price-temporary.update', 'uses' => 'PriceTemporaryController@update']);

                /**
                 * Eng: price-adjustment
                 * Trans: Tạo phiếu điều chỉnh
                 */
                Route::resource('price-adjustment-data', 'PriceAdjustmentController');
                Route::get('price-adjustment-data.data', ['as' => 'price-adjustment-data.data', 'uses' => 'PriceAdjustmentController@data']);
                Route::get('price-adjustment-data.food', ['as' => 'price-adjustment-data.food', 'uses' => 'PriceAdjustmentController@food']);
                Route::get('price-adjustment-data.data-update', ['as' => 'price-adjustment-data.data-update', 'uses' => 'PriceAdjustmentController@dataUpdate']);
                Route::post('price-adjustment-data.create', ['as' => 'price-adjustment-data.create', 'uses' => 'PriceAdjustmentController@create']);
                Route::post('price-adjustment-data.update', ['as' => 'price-adjustment-data.update', 'uses' => 'PriceAdjustmentController@update']);
                Route::post('price-adjustment-data.cancel', ['as' => 'price-adjustment-data.cancel', 'uses' => 'PriceAdjustmentController@cancel']);
                Route::post('price-adjustment-data.apply', ['as' => 'price-adjustment-data.apply', 'uses' => 'PriceAdjustmentController@apply']);
                Route::get('price-adjustment-data.detail', ['as' => 'price-adjustment-data.detail', 'uses' => 'PriceAdjustmentController@detail']);

                /**
                 * Eng: surcharge
                 * Trans: Phụ thu
                 */
                Route::resource('surcharge-data', 'SurchargeController');
                Route::get('surcharge-data.data', ['as' => 'surcharge-data.data', 'uses' => 'SurchargeController@data']);
                Route::get('surcharge-data.detail', ['as' => 'surcharge-data.detail', 'uses' => 'SurchargeController@detail']);
                Route::post('surcharge-data.create', ['as' => 'surcharge-data.create', 'uses' => 'SurchargeController@create']);
                Route::post('surcharge-data.update', ['as' => 'surcharge-data.update', 'uses' => 'SurchargeController@update']);
                Route::post('surcharge-data.change-status', ['as' => 'surcharge-data.change-status', 'uses' => 'SurchargeController@changeStatus']);
                Route::post('surcharge-data.get-vat', ['as' => 'surcharge-data.get-vat', 'uses' => 'SurchargeController@getVat']);

                /**
                 * Eng: price_by_area
                 * Trans: Giá theo khu vực
                 */
                Route::resource('price-by-area', 'PriceByAreaController');
                Route::get('price-by-area.area', ['as' => 'price-by-area.area', 'uses' => 'PriceByAreaController@area']);
                Route::get('price-by-area.food', ['as' => 'price-by-area.food', 'uses' => 'PriceByAreaController@getFood']);
                Route::post('price-by-area.assgin-food', ['as' => 'price-by-area.assgin-food', 'uses' => 'PriceByAreaController@assignFood']);
            }
        );

        /**
         * Eng: kitchen
         * Trans: bếp
         */
        Route::group(
            ['namespace' => 'Kitchen', 'as' => 'kitchen.', 'middleware' => []],
            function () {
                /**
                 * Eng: kitchen-data
                 * Trans: Bếp
                 */
                Route::resource('kitchen-data', 'KitchenDataController');
                Route::get('kitchen-data.data', ['as' => 'kitchen-data.data', 'uses' => 'KitchenDataController@data']);
                Route::get('kitchen-data.data-update', ['as' => 'kitchen-data.data-update', 'uses' => 'KitchenDataController@dataUpdate']);
                Route::get('kitchen-data.detail', ['as' => 'kitchen-data.detail', 'uses' => 'KitchenDataController@detail']);
                Route::post('kitchen-data.create', ['as' => 'kitchen-data.create', 'uses' => 'KitchenDataController@create']);
                Route::post('kitchen-data.update', ['as' => 'kitchen-data.update', 'uses' => 'KitchenDataController@update']);
                Route::post('kitchen-data.change-status', ['as' => 'kitchen-data.change-status', 'uses' => 'KitchenDataController@changeStatus']);
                Route::post('kitchen-assign-employee-data.assign', ['as' => 'kitchen-assign-employee-data.assign', 'uses' => 'KitchenDataController@assignEmployee']);
                Route::get('employee-assign-manage.data', ['as' => 'employee-assign-manage.data', 'uses' => 'KitchenDataController@employeeData']);

                /**
                 * Eng: quantitative-data
                 * Trans: Định lượng món
                 */
                Route::resource('quantitative-data', 'QuantitativeDataController');
                Route::get('quantitative-data.food-data', ['as' => 'quantitative-data.food-data', 'uses' => 'QuantitativeDataController@food']);
                Route::get('quantitative-data.material-data', ['as' => 'quantitative-data.material-data', 'uses' => 'QuantitativeDataController@material']);
                Route::get('quantitative-data.material-unit-data', ['as' => 'quantitative-data.material-unit-data', 'uses' => 'QuantitativeDataController@materialUnit']);
                Route::post('quantitative-data.create', ['as' => 'quantitative-data.create', 'uses' => 'QuantitativeDataController@create']);
                Route::post('quantitative-data.check-excel', ['as' => 'quantitative-data.check-excel', 'uses' => 'QuantitativeDataController@checkImportExcel']);

                /**
                 * Eng: permission-kitchen
                 * Trans: Quyền doanh số bếp
                 */
                Route::resource('permission-kitchen', 'PermissionKitchenDataController');
                Route::get('permission-kitchen.data', ['as' => 'permission-kitchen.data', 'uses' => 'PermissionKitchenDataController@data']);
                Route::post('permission-kitchen.update', ['as' => 'permission-kitchen.update', 'uses' => 'PermissionKitchenDataController@update']);
                Route::post('permission-kitchen.update-leader', ['as' => 'permission-kitchen.update-leader', 'uses' => 'PermissionKitchenDataController@updateLeader']);
                /**
                 * Eng: material-unit-food
                 * Trans: Đơn vị định lượng
                 */
                Route::resource('material-unit-food', 'MaterialUnitFoodController');
                Route::get('material-unit-food.data', ['as' => 'material-unit-food.data', 'uses' => 'MaterialUnitFoodController@data']);
                Route::get('material-unit-food-data.unit', ['as' => 'material-unit-food-data.unit', 'uses' => 'MaterialUnitFoodController@unit']);
                Route::post('material-unit-food-data.create', ['as' => 'material-unit-food-data.create', 'uses' => 'MaterialUnitFoodController@create']);
                Route::post('material-unit-food-data.change-status', ['as' => 'material-unit-food-data.change-status', 'uses' => 'MaterialUnitFoodController@changeStatus']);
                /**
                 * Eng: assign-kitchen
                 * Trans: Gán bếp
                 */
                Route::resource('assign-kitchen', 'AssignKitchenDataController');
                Route::get('assign-kitchen.data', ['as' => 'assign-kitchen.data', 'uses' => 'AssignKitchenDataController@data']);
                //                Route::get('assign-kitchen-data.unit', ['as' => 'assign-kitchen-data.unit', 'uses' => 'AssignKitchenDataController@unit']);
                Route::post('assign-kitchen-data.create', ['as' => 'assign-kitchen-data.create', 'uses' => 'AssignKitchenDataController@create']);
            }
        );

        /**
         * Eng: revenue-and-cost
         * Trans: thu chi
         */
        Route::group(
            ['namespace' => 'RevenueAndCost', 'as' => 'revenue-and-cost.', 'middleware' => []],
            function () {
                /**
                 * Eng: cost-data
                 * Trans: Hạng mục chi
                 */
                Route::resource('cost-data', 'CostDataController');
                Route::get('cost-data.data', ['as' => 'cost-data.data', 'uses' => 'CostDataController@data']);
                Route::get('cost-data.cost-type', ['as' => 'cost-data.cost-type', 'uses' => 'CostDataController@dataType']);
                Route::post('cost-data.change-status', ['as' => 'cost-data.change-status', 'uses' => 'CostDataController@changeStatus']);
                Route::post('cost-data.create', ['as' => 'cost-data.create', 'uses' => 'CostDataController@create']);
                Route::post('cost-data.update', ['as' => 'cost-data.update', 'uses' => 'CostDataController@update']);
                /**
                 * Eng: revenue-data
                 * Trans: Hạng mục thu
                 */
                Route::resource('revenue-data', 'RevenueDataController');
                Route::get('revenue-data.data', ['as' => 'revenue-data.data', 'uses' => 'RevenueDataController@data']);
                Route::get('revenue-data.cost-type', ['as' => 'revenue-data.cost-type', 'uses' => 'RevenueDataController@dataType']);
                Route::post('revenue-data.change-status', ['as' => 'revenue-data.change-status', 'uses' => 'RevenueDataController@changeStatus']);
                Route::post('revenue-data.create', ['as' => 'revenue-data.create', 'uses' => 'RevenueDataController@create']);
                Route::post('revenue-data.update', ['as' => 'revenue-data.update', 'uses' => 'RevenueDataController@update']);
            }
        );

        /**
         * Eng: price-promotion
         * Trans: giảm giá món ăn
         */
        Route::resource('price-promotion', 'PricePromotionController');
        Route::get('price-promotion.data', ['as' => 'price-promotion.data', 'uses' => 'PricePromotionController@data']);
        Route::post('price-promotion.update', ['as' => 'price-promotion.update', 'uses' => 'PricePromotionController@update']);
    }
);
/**
 * Trans: Folder Transport Controller
 */
Route::group(
    ['namespace' => 'Transport', 'as' => 'transport.', 'middleware' => []],
    function () {
        /**
         * Eng: transport-dashboard
         * Trans: Tổng quan vận chuyển
         */
        Route::resource('transport-dashboard', 'TransportDashboardController');
        Route::get('transport-dashboard.data-order-complete', ['as' => 'transport-dashboard.data-order-complete', 'uses' => 'TransportDashboardController@dataOrderComplete']);
        /**
         * Eng: transport-express
         * Trans: Quản lý đơn hàng
         */
        Route::resource('transport-express', 'TransportExpressController');
        /**
         * Eng: transport-partner
         * Trans: Đối tác vận chuyển
         */
        Route::resource('transport-partner', 'TransportPartnerController');
        /**
         * Eng: transport-report
         * Trans: Báo cáo vận chuyển
         */
        Route::resource('transport-report', 'TransportReportController');
        /**
         * Eng: transport-setting
         * Trans: Thiêt lập vận chuyển
         */
        Route::resource('transport-setting', 'TransportSettingController');
    }
);

/**
 * Trans: Folder Setting Controller
 */
Route::group(
    ['namespace' => 'Setting', 'as' => 'setting.', 'middleware' => []],
    function () {
        // Profile
        Route::resource('profile', 'ProfileController');
        Route::get('profile.data', ['as' => 'profile.data', 'uses' => 'ProfileController@data']);
        Route::post('profile.change-profile', ['as' => 'profile.change-profile', 'uses' => 'ProfileController@changeProfile']);
        Route::post('profile.update-profile', ['as' => 'profile.update-profile', 'uses' => 'ProfileController@imageUpdateProfile']);
        Route::post('profile.update-password', ['as' => 'profile.update-password', 'uses' => 'ProfileController@updatePassword']);

        /**
         * Eng: setting.history
         * Trans: Lịch sử hoạt động
         */
        Route::get('setting.history', ['as' => 'setting.history', 'uses' => 'SettingController@history']);

        /**
         *  Eng: setting
         *  Trans: thiết lập
         */
        Route::get('update-session-brand', ['as' => 'update-session-brand', 'uses' => 'SettingController@updateSessionBrand']);
        Route::get('update-session-branch', ['as' => 'update-session-branch', 'uses' => 'SettingController@updateSessionBranch']);
        Route::get('get-list-branch', ['as' => 'get-list-branch', 'uses' => 'SettingController@getBranch']);

        /**
         *  Eng: restaurant-setting
         *  Trans: Thiết lập Công ty/Nhà hàng
         */
        Route::resource('restaurant-setting', 'RestaurantSettingController');
        Route::get('restaurant-setting.data', ['as' => 'restaurant-setting.data', 'uses' => 'RestaurantSettingController@data']);
        Route::post('restaurant-setting.update', ['as' => 'restaurant-setting.update', 'uses' => 'RestaurantSettingController@update']);
        Route::post('restaurant-setting.update-setting', ['as' => 'restaurant-setting.update-setting', 'uses' => 'RestaurantSettingController@updateSetting']);
        Route::post('restaurant-setting.setting-membership-card', ['as' => 'restaurant-setting.update-setting', 'uses' => 'RestaurantSettingController@settingMemberShipCard']);

        /**
         *  Eng: sale-solution-setting
         *  Trans: Thiết lập Công ty/Nhà hàng thuộc giải pháp bán hàng
         */
        Route::resource('sale-solution-setting', 'SaleSolutionSettingController');
        Route::get('sale-solution-setting.data', ['as' => 'sale-solution-setting.data', 'uses' => 'SaleSolutionSettingController@data']);
        Route::get('sell-solution-res-setting.data', ['as' => 'sell-solution-res-setting.data', 'uses' => 'SaleSolutionSettingController@dataRestaurant']);
        Route::post('sale-solution-setting.update', ['as' => 'sale-solution-setting.update', 'uses' => 'SaleSolutionSettingController@update']);
        Route::post('sale-solution-setting.update-setting', ['as' => 'sale-solution-setting.update-setting', 'uses' => 'SaleSolutionSettingController@updateSetting']);

        /**
         *  Eng: brand-setting
         *  Trans: Thiết lập thương hiệu
         */
        Route::resource('brand-setting', 'BrandSettingController');
        Route::get('brand-setting.data', ['as' => 'brand-setting.data', 'uses' => 'BrandSettingController@data']);
        Route::get('brand-setting.data-profile', ['as' => 'brand-setting.data-profile', 'uses' => 'BrandSettingController@dataProfile']);
        Route::get('brand-setting.data-setting', ['as' => 'brand-setting.data-setting', 'uses' => 'BrandSettingController@dataSetting']);
        Route::post('brand-setting.update', ['as' => 'brand-setting.update', 'uses' => 'BrandSettingController@update']);
        Route::post('brand-setting.update-logo', ['as' => 'brand-setting.update-logo', 'uses' => 'BrandSettingController@updateLogo']);
        Route::post('brand-setting.update-banner', ['as' => 'brand-setting.update-banner', 'uses' => 'BrandSettingController@updateBanner']);
        Route::get('restaurant.data-price-service', ['as' => 'restaurant.data-price-service', 'uses' => 'BrandSettingController@dataPriceService']);
        /**
         *  Eng: branch-setting
         *  Trans: Thiết lập chi nhánh
         */
        Route::resource('branch-setting', 'BranchSettingController');
        Route::get('branch-setting.data', ['as' => 'branch-setting.data', 'uses' => 'BranchSettingController@data']);
        Route::get('branch-setting.serve', ['as' => 'branch-setting.serve', 'uses' => 'BranchSettingController@dataServe']);
        Route::get('branch-setting.data-profile', ['as' => 'branch-setting.data', 'uses' => 'BranchSettingController@dataProfile']);
        Route::get('branch-setting.cities-data', ['as' => 'branch-setting.cities-data', 'uses' => 'BranchSettingController@citiesData']);
        Route::get('branch-setting.Country-data', ['as' => 'branch-setting.Country-data', 'uses' => 'BranchSettingController@countryData']);
        Route::get('branch-setting.districts-data', ['as' => 'branch-setting.districts-data', 'uses' => 'BranchSettingController@districtsData']);
        Route::get('branch-setting.wards-data', ['as' => 'branch-setting.wards-data', 'uses' => 'BranchSettingController@wardsData']);
        Route::post('branch-setting.update-banner', ['as' => 'branch-setting.update-banner', 'uses' => 'BranchSettingController@updateBanner']);
        Route::post('branch-setting.update-logo', ['as' => 'branch-setting.update-logo', 'uses' => 'BranchSettingController@updateLogo']);
        Route::post('branch-setting.upload-logo', ['as' => 'branch-setting.upload-logo', 'uses' => 'BranchSettingController@uploadLogo']);
        Route::post('branch-setting.update-setting', ['as' => 'branch-setting.update-setting', 'uses' => 'BranchSettingController@updateSetting']);
        Route::post('branch-setting.update', ['as' => 'branch-setting.update', 'uses' => 'BranchSettingController@update']);
        Route::post('branch-setting.update-list-image', ['as' => 'branch-setting.update-list-image', 'uses' => 'BranchSettingController@updateListImage']);

        Route::get('branch-setting.data-folder', ['as' => 'branch-setting.data-folder', 'uses' => 'BranchSettingController@dataFolder']);
        Route::post('branch-setting.create-folder', ['as' => 'branch-setting.create-folder', 'uses' => 'BranchSettingController@createFolder']);
        Route::post('branch-setting.remove-folder', ['as' => 'branch-setting.remove-folder', 'uses' => 'BranchSettingController@removeFolder']);
        Route::post('branch-setting.update-name-folder', ['as' => 'branch-setting.update-name-folder', 'uses' => 'BranchSettingController@updateNameFolder']);

        Route::get('branch-setting.data-media', ['as' => 'branch-setting.data-media', 'uses' => 'BranchSettingController@dataMedia']);
        Route::post('branch-setting.upload-media', ['as' => 'branch-setting.upload-media', 'uses' => 'BranchSettingController@uploadMedia']);
        Route::post('branch-setting.create-media', ['as' => 'branch-setting.create-media', 'uses' => 'BranchSettingController@createMedia']);
        Route::post('branch-setting.remove-media', ['as' => 'branch-setting.remove-media', 'uses' => 'BranchSettingController@removeMedia']);
        Route::post('branch-setting.update-name-media', ['as' => 'branch-setting.update-name-media', 'uses' => 'BranchSettingController@updateNameMedia']);
        Route::get('branch-setting.search-address-map4d', ['as' => 'branch-setting.search-address-map4d', 'uses' => 'BranchSettingController@searchAddressMap4D']);

        /**
         *  Eng: restaurant-setting
         *  Trans: offline
         */
        Route::resource('offline-setting', 'OfflineSettingController');
        Route::get('offline-setting.list-branch', ['as' => 'offline-setting.list-branch', 'uses' => 'OfflineSettingController@listBranch']);
        Route::post('offline-setting.change-offline-branch', ['as' => 'offline-setting.change-offline-branch', 'uses' => 'OfflineSettingController@changeOfflineBranch']);


        /**
         *  Eng: vat-setting
         *  Trans: cấu hình vat
         */
        Route::group(
            ['namespace' => 'VATManage', 'as' => 'vat-manage.', 'middleware' => []],
            function () {
                Route::resource('vat-config', 'VATConfigController');
                Route::post('vat-setting.update', ['as' => 'vat-setting.update', 'uses' => 'VATConfigController@update']);
                Route::get('vat-setting.data', ['as' => 'vat-setting.data', 'uses' => 'VATConfigController@data']);
                Route::post('vat-setting.change-update', ['as' => 'vat-setting.change-update', 'uses' => 'VATConfigController@changeStatus']);
                Route::get('vat-setting.detail-vat', ['as' => 'vat-setting.detail-vat', 'uses' => 'VATConfigController@detail']);
            }
        );


        /**
         *  Eng: vat-restaurant
         *  Trans: gán vat
         */
        Route::group(
            ['namespace' => 'VATManage', 'as' => 'vat-manage.', 'middleware' => []],
            function () {
                Route::resource('vat-restaurant', 'VATRestaurantController');
                Route::get('vat-restaurant.data', ['as' => 'vat-restaurant.data', 'uses' => 'VATRestaurantController@data']);
                Route::post('vat-restaurant.assign', ['as' => 'vat-restaurant.assign', 'uses' => 'VATRestaurantController@assign']);
            }
        );

        /**
         * Eng: partner-invoice
         * Trans: Hóa đơn điện tử
         */
        Route::resource('partner-invoice', 'PartnerInvoiceController');
        Route::get('partner-invoice.data', ['as' => 'partner-invoice.data', 'uses' => 'PartnerInvoiceController@data']);
        Route::post('partner-invoice.create', ['as' => 'partner-invoice.create', 'uses' => 'PartnerInvoiceController@create']);
        Route::get('partner-invoice.data-update', ['as' => 'partner-invoice.data-update', 'uses' => 'PartnerInvoiceController@dataUpdate']);
        Route::post('partner-invoice.update', ['as' => 'partner-invoice.update', 'uses' => 'PartnerInvoiceController@update']);
        Route::get('partner-invoice.list-partner', ['as' => 'partner-invoice.list-partner', 'uses' => 'PartnerInvoiceController@dataPartnerInvoice']);

        /**
         * Eng: service-cost-history
         * Trans: Lịch sử chi phí dịch vụ
         */
        Route::resource('service-cost-history', 'ServiceCostHistoryController');
        Route::get('service-restaurant-balance.transaction', ['as' => 'service-restaurant-balance.transaction', 'uses' => 'ServiceCostHistoryController@dataAdd']);
        Route::get('service-restaurant-balance.histories', ['as' => 'service-restaurant-balance.histories', 'uses' => 'ServiceCostHistoryController@dataMinus']);
        Route::get('service-restaurant-balance.data-balance', ['as' => 'service-restaurant-balance.data-balance', 'uses' => 'ServiceCostHistoryController@dataBalance']);

        /**
         * Eng: bank-setting
         * Trans: Thông tin thanh toán
         */
        Route::resource('bank-setting', 'BankController');
        Route::get('bank-setting.data', ['as' => 'brand-setting.data', 'uses' => 'BankController@data']);
        Route::get('bank-setting.bank', ['as' => 'brand-setting.data', 'uses' => 'BankController@bank']);
        Route::post('bank-setting.search-bank-number', ['as' => 'brand-setting.search-bank-number', 'uses' => 'BankController@searchBankNumber']);
        Route::post('bank-setting.create', ['as' => 'brand-setting.create', 'uses' => 'BankController@create']);
        Route::post('bank-setting.update', ['as' => 'brand-setting.update', 'uses' => 'BankController@update']);
        Route::post('bank-setting.change-status', ['as' => 'brand-setting.change-status', 'uses' => 'BankController@changeStatus']);
        Route::post('bank-setting.assign', ['as' => 'brand-setting.assign', 'uses' => 'BankController@assign']);
    }
);

/**
 * Trans: Message
 */
Route::group(
    ['namespace' => 'Message', 'as' => 'message.', 'middleware' => []],
    function () {
        /**
         * Eng: popup-message
         * Trans: Popup
         */
        Route::get('popup-message.data', ['as' => 'profile.data', 'uses' => 'PopupMessageController@data']);
        Route::get('popup-message.data-conversation', ['as' => 'popup-message.data-conversation', 'uses' => 'PopupMessageController@dataConversation']);
        Route::get('popup-message.message-conversation', ['as' => 'popup-message.message-conversation', 'uses' => 'PopupMessageController@dataMessageOfConversationPopup']);
        Route::get('popup-message.message-not-seen', ['as' => 'popup-message.message-not-seen', 'uses' => 'PopupMessageController@messageNotSeen']);
        Route::get('popup-message-supplier.data-conversation', ['as' => 'popup-message-supplier.data-conversation', 'uses' => 'PopupMessageController@dataConversationSupplierPopup']);
        /**
         * Eng: visible-message
         * Trans: Visible
         */
        Route::resource('visible-message', 'VisibleMessageController');
        Route::get('visible-message.data-conversation', ['as' => 'visible-message.data-conversation', 'uses' => 'VisibleMessageController@dataConversation']);
        Route::get('visible-message.employee', ['as' => 'visible-message.employee', 'uses' => 'VisibleMessageController@listMember']);

        Route::get('visible-message.message-conversation', ['as' => 'visible-message.message-conversation', 'uses' => 'VisibleMessageController@dataMessageOfConversation']);
        Route::get('visible-message.detail-conversation', ['as' => 'visible-message.detail-conversation', 'uses' => 'VisibleMessageController@detailConversation']);
        Route::get('visible-message.detail-info-conversation', ['as' => 'visible-message.detail-info-conversation', 'uses' => 'VisibleMessageController@detailConversation']);
        Route::get('visible-message.detail-file-conversation', ['as' => 'visible-message.detail-file-conversation', 'uses' => 'VisibleMessageController@dataFileDetailConversation']);
        Route::get('visible-message.detail-pinned-current-conversation', ['as' => 'visible-message.detail-pinned-current-conversation', 'uses' => 'VisibleMessageController@dataPinnedCurrentDetailConversation']);
        Route::get('visible-message.detail-pinned-conversation', ['as' => 'visible-message.detail-pinned-conversation', 'uses' => 'VisibleMessageController@dataPinnedDetailConversation']);
        Route::get('visible-message.detail-vote-conversation', ['as' => 'visible-message.detail-vote-conversation', 'uses' => 'VisibleMessageController@dataVoteDetailConversation']);
        Route::get('visible-message.data-category-sticker-conversation', ['as' => 'visible-message.data-category-sticker-conversation', 'uses' => 'VisibleMessageController@dataCategorySticker']);
        Route::get('visible-message.data-sticker-conversation', ['as' => 'visible-message.data-sticker-conversation', 'uses' => 'VisibleMessageController@dataSticker']);
        Route::get('visible-message.data-role', ['as' => 'visible-message.data-role', 'uses' => 'VisibleMessageController@dataRole']);
        Route::get('visible-message.data-employee', ['as' => 'visible-message.data-employee', 'uses' => 'VisibleMessageController@dataEmployee']);
        Route::post('visible-message.create-conversation-personal', ['as' => 'visible-message.create-conversation-personal', 'uses' => 'VisibleMessageController@createConversationPersonal']);
        Route::post('visible-message.create-conversation-group', ['as' => 'visible-message.create-conversation-group', 'uses' => 'VisibleMessageController@createConversationGroup']);
        Route::post('visible-message.update-conversation', ['as' => 'visible-message.update-conversation', 'uses' => 'VisibleMessageController@updateConversation']);
        Route::post('visible-message.remove-user-group', ['as' => 'visible-message.remove-user-group', 'uses' => 'VisibleMessageController@removeUserGroup']);
        Route::post('visible-message.authorized', ['as' => 'visible-message.authorized', 'uses' => 'VisibleMessageController@addPermisionUserGroup']);
        Route::post('visible-message.add-user-group', ['as' => 'visible-message.add-user-group', 'uses' => 'VisibleMessageController@addUserGroup']);
        Route::post('visible-message.leave-user-group', ['as' => 'visible-message.leave-user-group', 'uses' => 'VisibleMessageController@leaveUserGroup']);
        Route::post('visible-message.disband-group', ['as' => 'visible-message.disband-group', 'uses' => 'VisibleMessageController@disbandGroup']);
        Route::get('visible-message.tag-my-name', ['as' => 'visible-message.tag-my-name', 'uses' => 'VisibleMessageController@getMessageTagName']);
        /**
         * Eng: visible-message-supplier
         * Trans: Visible supplier
         */
        Route::get('visible-message-supplier.data-conversation', ['as' => 'visible-message-supplier.data-conversation', 'uses' => 'VisibleMessageSupplierController@dataConversation']);
        Route::get('visible-message-supplier.data-order', ['as' => 'visible-message-supplier.data-order', 'uses' => 'VisibleMessageSupplierController@dataOrder']);
    }
);

/**
 * Eng: upload
 * Trans: Upload ảnh
 */
Route::group(
    ['namespace' => 'Upload', 'as' => 'upload.', 'middleware' => []],
    function () {
        Route::post('upload-media-template', ['as' => 'upload-media-template', 'uses' => 'UploadNodeController@uploadMedia']);
    }
);

/**
 * Eng: notify
 * Trans: Thông báo
 */
Route::group(
    ['namespace' => 'Layout', 'as' => 'layout.', 'middleware' => []],
    function () {
        Route::resource('notify-view', 'NotifyHeaderController');
        Route::get('notify-header', ['as' => 'notify-header', 'uses' => 'NotifyHeaderController@notify']);
        Route::get('count-notify-header', ['as' => 'count-notify-header', 'uses' => 'NotifyHeaderController@countNotifyNotSeen']);
        Route::get('notify-view.data', ['as' => 'notify-view.data', 'uses' => 'NotifyHeaderController@data']);
        Route::resource('error-404', 'ErrorController');
    }
);

/**
 * Eng: help
 * Trans: Support
 */
Route::group(
    ['namespace' => 'Help', 'as' => 'help.', 'middleware' => []],
    function () {
        Route::resource('help', 'HelpController');
        Route::get('level1-detail', 'HelpController@level1');
        Route::get('level2-detail', 'HelpController@level2');
        Route::get('level3-detail', 'HelpController@level3');
        Route::get('question', 'HelpController@question');
        Route::get('manipulation', 'HelpController@manipulation');
    }

);

/**
 * Eng: upgrade
 * Trans: Support
 */
Route::group(
    ['namespace' => 'UpgradePackage', 'as' => 'upgrade_package.', 'middleware' => []],
    function () {
        Route::resource('upgrade-package', 'UpgradePackageController');
    }

);

Route::get('test', function () {
    return view('test');
});
