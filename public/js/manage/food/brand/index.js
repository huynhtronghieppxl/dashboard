let dataDisableFoodBrandManage, dataTableFoodFoodBrandManage, dataTableFoodDrinkFoodBrandManage,
    dataTableFoodOtherFoodBrandManage, dataTableFoodComboFoodBrandManage,
    dataTableFoodAdditionFoodBrandManage, dataTableFoodDisableFoodBrandManage, thisStatusFoodDataFoodBrandManage,
    dataFoodConfigVatFoodBrandManage, dataCategoryComboFoodBrandManage, dataUnitFoodBrandManage,
    dataCategoryFoodBrandManage, dataFoodNoteFoodBrandManage, dataVatFoodBrandManage,
    categoryFoodBrandManage = -1, indexDataTabFoodBrandManage = 0, alert_original_price_id = -1,
    category_type = $('#tabs-food-brand-manage .nav-link.active').data('category-type'),
    checkLoadDataCountTab = 0,
    checkLoadAlertOriginalPrice = 0;

let page_tab_disable_food_brand_manage, limitFoodBrandManage;
let loading_tab_food_disable_food_brand_manage = 0, tab_current_food_brand_manage = 0,
    columnDisableFoodBrandManage = [
        {data: 'index', name: 'DT_RowIndex', class:'text-center', width: '5%'},
        {data: 'food_name', name: 'food_name', className:'white-space-normal text-left', width: '25%'},
        {data: 'category_name', name: 'category_name', className:'text-left'},
        {data: 'price', name: 'price', className:'text-right'},
        {data: 'original_percent', name: 'original_percent', className:'text-center'},
        {data: 'vat', name: 'vat', className:'text-center'},
        {data: 'original_revenue', name: 'original_revenue', className: 'text-right'},
		{data: 'profit_rate_by_original_price', name: 'profit_rate_by_original_price', className: 'text-center'},
		{data: 'profit_rate_by_price', name: 'profit_rate_by_price', className: 'text-center'},
        {data: 'material_count', name: 'material_count', className: 'text-center'},
        {data: 'action', name: 'action', className: 'text-center', width: '10%'},
        {data: 'keysearch', name: 'keysearch', className: 'd-none'},
    ],
    fixedLeftTableDisable = 2,
    fixedRightTableDisable = 2,
    optionRenderTableDisable = [
        {
            'title': 'Thiết lập VAT',
            'icon': 'fi-rr-settings seemt-green',
            'class': '',
            'function': 'openModalSetupVatFoodBrandManage',
        }
    ];

$(function () {
    $("#change-restaurant-branch-id li").on('click', async function () {
        $('#tabs-food-brand-manage li:eq(0)').click();
    });
    $('#tabs-food-brand-manage a').on('click',function (){
        $('.select-category-food-manage').html(categoryFoodBrandManage);
        category_type = $(this).data('category-type')
        categoryFoodBrandManage = -1
        alert_original_price_id=-1
        if($(this).data('index')==6) {
            $('.select-data-alert-original-price').parents('.form-validate-select').addClass('d-none')
        }
        else{
            $('.select-data-alert-original-price ').parents('.form-validate-select').removeClass('d-none')
            loadData()
            if(checkLoadAlertOriginalPrice == 0) {
                dataAlertOriginalPrice();
                checkLoadAlertOriginalPrice = 1;
            }
        }
        updateCookieFoodBrandManage();
    })

    $('.select-category-food-brand-manage-food').on('select2:select', function () {
        categoryFoodBrandManage = $(this).val();
        loadDataEnableFoodBrandManage();
    });
    $('.select-category-food-brand-manage-drink').on('select2:select', function () {
        categoryFoodBrandManage = $(this).val();
        loadDataEnableFoodBrandManage();
    });
    $('.select-category-food-brand-manage-other').on('select2:select', function () {
        categoryFoodBrandManage = $(this).val();
        loadDataEnableFoodBrandManage();
    });

    $('.select-data-alert-original-price').on('change', function (){
        alert_original_price_id = $(this).val()
        loadDataEnableFoodBrandManage()
        // loadDataDisableFoodBrandManage()
    })
    $('.select-brand').on('change', function (){
        restaurant_brand_id = $(this).val()
    })
    dataDisableFoodBrandManage = 0;
        dataTableFoodDisableFoodBrandManage = '';
        limitFoodBrandManage = Number($('#data-table-length').val());
        branch_id = $('#change_branch').val();
        restaurant_brand_id = $('.select-brand').val();
    page_tab_disable_food_brand_manage = 1;
    loading_tab_food_disable_food_brand_manage = 1;

    $('#tabs-food-brand-manage a').on('click', function (){
        indexDataTabFoodBrandManage = $(this).data('index')
        updateCookieFoodBrandManage();
    })

    $(document).on('click','#tab-change-status-food-data .nav-link', function (){
        $(this).data('index') == '1' ? $('.swal2-confirm').addClass('d-none') : $('.swal2-confirm').removeClass('d-none');
    })

    if(getCookieShared('food-brand-manage-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('food-brand-manage-user-id-' + idSession));
        indexDataTabFoodBrandManage = dataCookie.index
        categoryFoodBrandManage = dataCookie.idCategoryFoodBrandManage
    }
    $('#tabs-food-brand-manage a[data-index="' + indexDataTabFoodBrandManage + '"]').click()
});

async function loadData() {
    loadDataEnableFoodBrandManage();
    if(checkLoadDataCountTab == 1) return false;
    loadDataCountTab();
    loadDataUpdateFoodBrandManage();
    checkLoadDataCountTab = 1;
}

async function loadDataCountTab() {
    let brand = $('.select-brand').val(),
        url = 'food-brand-manage.data-count-tab',
        method = 'get',
        params = {
            brand: brand,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    dataTotalFoodBrandManage(res);
}

async function changeTabFoodBrandManage(tab) {
    tab_current_food_brand_manage = tab;
    loadDataCountTab();
    switch (tab) {
        case 6:
            if (dataTableFoodDisableFoodBrandManage === '') {
                loadDataDisableFoodBrandManage();
                loading_tab_food_disable_food_brand_manage = 0;
            } else if (loading_tab_food_disable_food_brand_manage === 0) {
                loadingDataDisableFoodBrandManage()
            }
            break;
    }
}
async function loadingDataDisableFoodBrandManage(){
    restaurant_brand_id=$('.select-brand').val()
    await dataTableFoodDisableFoodBrandManage.ajax.url("food-brand-manage.data-disable?category_id=" + categoryFoodBrandManage + '&brand=' + restaurant_brand_id + "&page=" + page_tab_disable_food_brand_manage + "&limit=" + limitFoodBrandManage + "&alert_original_price=-1" ).load();
}

async function loadDataEnableFoodBrandManage() {
    let brand = $('.select-brand').val(),
        url = 'food-brand-manage.data',
        method = 'get',
        params = {
            brand: brand,
            category_id: -1,
            alert_original_price : alert_original_price_id
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data,[
        $('#table-food-food-brand-manage'),
        $('#table-drink-food-brand-manage'),
        $('#table-sea-food-food-brand-manage'),
        $('#table-other-food-brand-manage'),
        $('#table-combo-food-brand-manage'),
        $('#table-addition-food-brand-manage'),
    ]);
    dataTableFoodBrandManage(res);
    dataFoodConfigVatFoodBrandManage = res.data[5];
    // loadDataUpdateFoodBrandManage();
    // foodOptionAdditionCreate();
}
async function LoadDataVatSetupFoodBrandManage() {
    let brand = $('.select-brand').val(),
        url = 'food-brand-manage.data',
        method = 'get',
        params = {brand: brand},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    dataFoodConfigVatFoodBrandManage = res.data[7];
}

async function sortDataCategoryFoodBrandManage(){
    let brand = $('.select-brand').val(),
        url = 'food-brand-manage.category',
        method = 'get',
        params = {
            brand: brand,
            category_id: categoryFoodBrandManage
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('.select-category-food-brand-manage-food').html(res.data[0]);
    $('.select-category-food-brand-manage-drink').html(res.data[1]);
    $('.select-category-food-brand-manage-other').html(res.data[2]);
}

async function loadDataDisableFoodBrandManage(){
    restaurant_brand_id=$('.select-brand').val()
    loading_tab_food_disable_food_brand_manage = 1;
    let id = $('#table-disable-food-brand-manage'),
        url = "food-brand-manage.data-disable?category_id=" + categoryFoodBrandManage + '&brand=' + restaurant_brand_id + "&page=" + page_tab_disable_food_brand_manage + "&limit=" + limitFoodBrandManage + "&alert-original-price=" + alert_original_price_id;
    dataTableFoodDisableFoodBrandManage = await DatatableServerSideTemplateNew(id, url, columnDisableFoodBrandManage, vh_of_table, fixedLeftTableDisable, fixedRightTableDisable, optionRenderTableDisable, callbackLoadData);

}

function callbackLoadData(response){
     $('#total-record-disable').text(formatNumber(response.total_record_disable))
}

async function dataTableFoodBrandManage(data) {
    let idFoodFoodBrandManage = $('#table-food-food-brand-manage'),
        idDrinkFoodBrandManage = $('#table-drink-food-brand-manage'),
        idOtherFoodBrandManage = $('#table-other-food-brand-manage'),
        idComboFoodBrandManage = $('#table-combo-food-brand-manage'),
        idAdditionFoodBrandManage = $('#table-addition-food-brand-manage'),
        columnFoodBrandManage = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'food_name', name: 'food_name', className: 'text-left'},
            {data: 'category_name', name: 'category_name', className: 'text-left'},
            {data: 'price', name: 'price', className: 'text-right', width: '10%'},
            {data: 'original_percent', name: 'original_percent', className: 'text-center', width: '10%'},
            {data: 'vat', name: 'vat', className: 'text-center', width: '5%'},
            {data: 'original_revenue', name: 'original_revenue', className: 'text-right', width: '10%'},
			{data: 'profit_rate_by_original_price', name: 'profit_rate_by_original_price', className: 'text-center', width: '10%'},
            {data: 'profit_rate_by_price', name: 'profit_rate_by_price', className: 'text-center', width: '10%'},
            {data: 'material_count', name: 'material_count', className: 'text-center', width: '5%'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
            {data: 'full_food_name', name: 'full_food_name', className: 'd-none'},
        ],
        columnFoodComboBrandManage = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'food_name', name: 'food_name', className: 'text-left'},
            {data: 'category_name', name: 'category_name', className: 'text-left'},
            {data: 'price', name: 'price', className: 'text-right'},
            {data: 'original_percent', name: 'original_percent', className: 'text-center'},
            {data: 'vat', name: 'vat', className: 'text-center'},
            {data: 'original_revenue', name: 'original_revenue', className: 'text-right'},
			{data: 'profit_rate_by_original_price', name: 'profit_rate_by_original_price', className: 'text-center'},
            {data: 'profit_rate_by_price', name: 'profit_rate_by_price', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '10%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
            {data: 'full_food_name', name: 'full_food_name', className: 'd-none'},
        ],
        fixed_left = 3,
        fixed_right = 2,
        option = [{
            'title' : 'Thiết lập VAT',
            'icon' : 'fi-rr-settings seemt-green',
            'class' : '',
            'function': 'openModalSetupVatFoodBrandManage'
        }];
    dataTableFoodFoodBrandManage = await DatatableTemplateNew(idFoodFoodBrandManage, data.data[0], columnFoodBrandManage, vh_of_table, fixed_left, fixed_right, option);
    dataTableFoodDrinkFoodBrandManage = await DatatableTemplateNew(idDrinkFoodBrandManage, data.data[1], columnFoodBrandManage, vh_of_table, fixed_left, fixed_right, option);
    dataTableFoodOtherFoodBrandManage = await DatatableTemplateNew(idOtherFoodBrandManage, data.data[2], columnFoodBrandManage, vh_of_table, fixed_left, fixed_right, option);
    dataTableFoodComboFoodBrandManage = await DatatableTemplateNew(idComboFoodBrandManage, data.data[3], columnFoodComboBrandManage, vh_of_table, fixed_left, fixed_right, option);
    dataTableFoodAdditionFoodBrandManage = await DatatableTemplateNew(idAdditionFoodBrandManage, data.data[4], columnFoodBrandManage, vh_of_table, fixed_left, fixed_right, option);

	$(document).on('input paste keyup','input[type="search"]', function (){
        $('#total-record-food').text(formatNumber(dataTableFoodFoodBrandManage.rows({'search': 'applied'}).count()))
        $('#total-record-drink').text(formatNumber(dataTableFoodDrinkFoodBrandManage.rows({'search': 'applied'}).count()))
        $('#total-record-other').text(formatNumber(dataTableFoodOtherFoodBrandManage.rows({'search': 'applied'}).count()))
        $('#total-record-combo').text(formatNumber(dataTableFoodComboFoodBrandManage.rows({'search': 'applied'}).count()))
        $('#total-record-addition').text(formatNumber(dataTableFoodAdditionFoodBrandManage.rows({'search': 'applied'}).count()))
        searchUpdateIndexDataTable(dataTableFoodFoodBrandManage)
        searchUpdateIndexDataTable(dataTableFoodDrinkFoodBrandManage)
        searchUpdateIndexDataTable(dataTableFoodOtherFoodBrandManage)
        searchUpdateIndexDataTable(dataTableFoodComboFoodBrandManage)
        searchUpdateIndexDataTable(dataTableFoodAdditionFoodBrandManage)
    })

}

function dataTotalFoodBrandManage(res) {
    $('#total-record-food').text(res.data.data.total_record_food);
    $('#total-record-drink').text(res.data.data.total_record_drink);
    $('#total-record-other').text(res.data.data.total_record_other);
    $('#total-record-combo').text(res.data.data.total_record_combo);
    $('#total-record-addition').text(res.data.data.total_record_addition);
    $('#total-record-disable').text(res .data.data.total_record_stop_selling);
}

function updateCookieFoodBrandManage(){
    saveCookieShared('food-brand-manage-user-id-' + idSession, JSON.stringify({
        'index' : indexDataTabFoodBrandManage,
        'idCategoryFoodBrandManage': categoryFoodBrandManage
    }))
}

function changeStatusFoodBrandManage(r) {
    thisStatusFoodDataFoodBrandManage = r;
    let id = r.data('id'),
        status = r.data('status'),
        restaurant_brand_id = r.data('restaurant');
    let title, content;
    if (status === 0) {
        title = 'Đổi trạng thái thành đang hoạt động ?';
        content = "Bạn có muốn mở hoạt động món ăn cho toàn chi nhánh ?"
    } else {
        title = $('#notify-off-update-status-component').text();
        content = "Bạn có muốn tạm dừng hoạt động món ăn cho toàn chi nhánh ?"
    }
    let icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'food-brand-manage.change-status',
                params = null,
                data = {
                    id: id,
                    restaurant_brand_id: restaurant_brand_id,
                    is_confirm: 0,
                };
            let res = await axiosTemplate(method, url, params, data,[$('#content-body-techres')]);
            let text =''
            switch (res.data[1].status){
                case 200:
                    text = $('#success-status-data-to-server').text();
                    SuccessNotify(text);
                    loadData();
                    break;
                case 300:
                    $('#tab-food-data-1').removeClass('d-none');
                    $('#tab-food-drink-data-2').removeClass('d-none');
                    $('#tab-food-combo-data').removeClass('d-none');
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            container: "modal-create-note popup-swal-205",
                            popup: "swal-lg-50",
                            cancelButton: 'swal-cancle btn btn-grd-disabled btn-sweet-alert swal-button--cancel',
                            confirmButton: 'btn btn-grd-primary btn-sweet-alert swal-button--confirm',
                        },
                        buttonsStyling: false
                    });
                    swalWithBootstrapButtons.fire({
                        title: 'Món ăn đang được sử dụng !',
                        icon: 'warning',
                        html:  `<div class="seemt-main-content">
                                    <ul class="nav nav-tabs md-tabs "
                                        id="tab-change-status-food-data" role="tablist">
                                        <li class="nav-item w-100" style="margin-right: 0px !important;">
                                            <a class="nav-link" id="tab-food-data-1" data-toggle="tab"
                                               data-type="1" href="#tab-addtion-food-data" role="tab"
                                               aria-expanded="true" data-category-type="1"
                                               data-index="0" data-column="1">
                                               Món đang sử dụng
                                                <span class="label label-success" id="total-record-addition-disabled">0</span>
                                            </a>
                                            <div class="slide"></div>
                                        </li>
                                        <li class="nav-item w-100">
                                            <a class="nav-link" id="tab-food-drink-data-2" data-toggle="tab"
                                               href="#tab-booking-food-data" role="tab" aria-expanded="false"
                                               data-category-type="2"
                                               data-index="1" data-column="1" data-type="1">
                                               Món ăn booking
                                                <span class="label label-warning" id="total-record-booking-disabled">0</span>
                                            </a>
                                            <div class="slide"></div>
                                        </li>
                                        <li class="nav-item w-100">
                                            <a class="nav-link" id="tab-food-combo-data" data-toggle="tab"
                                               href="#tab-combo-food-data" role="tab" aria-expanded="false"
                                               data-category-type="2"
                                               data-index="2" data-column="1" data-type="1">
                                               Món ăn combo
                                                <span class="label label-warning" id="total-record-combo-chang-status-disabled">0</span>
                                            </a>
                                            <div class="slide"></div>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab-addtion-food-data" role="tabpanel">
                                            <div class="table-responsive new-table">
                                                <table class="table" id="table-addtion-food-data">
                                                    <thead>
                                                        <tr>
                                                            <th>STT</th>
                                                            <th>TÊN</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab-booking-food-data" role="tabpanel">
                                            <div class="table-responsive new-table">
                                                <table class="table" id="table-booking-food-data">
                                                    <thead>
                                                        <tr>
                                                            <th>STT</th>
                                                            <th>Tên khách hàng</th>
                                                            <th>Số điện thoại</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab-combo-food-data" role="tabpanel">
                                            <div class="table-responsive new-table">
                                                <table class="table" id="table-combo-food-food-data">
                                                    <thead>
                                                        <tr>
                                                            <th>STT</th>
                                                            <th>TÊN</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>`,
                        showCloseButton: false,
                        showCancelButton: true,
                        showConfirmButton: true,
                        confirmButtonText: $('#button-btn-confirm-component').text(),
                        cancelButtonText: $('#button-btn-cancel-component').text(),
                        reverseButtons: true,
                        focusConfirm: false,
                    }).then(async (result) => {
                        if (result.value) {
                            let method = 'post',
                                url = 'food-brand-manage.change-status',
                                params = null,
                                data = {
                                    id: id,
                                    restaurant_brand_id: restaurant_brand_id,
                                    is_confirm: 1,
                                };
                            let res = await axiosTemplate(method, url, params, data);
                            if (res.data[1].status === 200) {
                                let text = $('#success-status-data-to-server').text();
                                SuccessNotify(text);
                                loadData();
                            } else {
                                let text = $('#error-post-data-to-server').text();
                                if (res.data[1].message !== null) {
                                    text = res.data[1].message;
                                }
                                ErrorNotify(text);
                                return false;
                            }
                        }

                    })
                    drawTableChangeStatusFoodBrandManage(res)
                    switch (parseInt($('#tabs-food-brand-manage .nav-item .active').attr('data-type'))){
                        case 1:
                        case 2:
                        case 3:
                            $('#tab-food-drink-data-2').click();
                            $('#tab-food-data-1').addClass('d-none');
                            break;
                        case 4:
                            $('#tab-food-drink-data-2').click();
                            $('#tab-food-data-1').addClass('d-none');
                            $('#tab-food-combo-data').addClass('d-none');
                            break;
                        case 5:
                            $('#tab-food-drink-data-2').click();
                            $('#tab-food-combo-data').addClass('d-none')
                            break;
                    }
                    $('[data-toggle="tooltip"]').tooltip();
                    break;
                case 500:
                    text = $('#error-post-data-to-server').text();
                    if (res.data[1].message !== null) {
                        text = res.data[1].message;
                    }
                    ErrorNotify(text);
                    break;
                default:
                    text = $('#error-post-data-to-server').text();
                    if (res.data[1].message !== null) {
                        text = res.data[1].message;
                    }
                    WarningNotify(text);
            }
        }
    })

}


async function drawTableChangeStatusFoodBrandManage(data) {
    $('#total-record-addition-disabled').text(data.data[1].data['total_addition']);
    $('#total-record-booking-disabled').text(data.data[1].data['total_booking']);
    $('#total-record-combo-chang-status-disabled').text(data.data[1].data['total_combo']);
    let tableCombo = $('#table-combo-food-food-data'),
        tableBooking = $('#table-booking-food-data'),
        tableAddition = $('#table-addtion-food-data'),
        scroll_Y = '300px',
        fixed_left = 0,
        fixed_right = 0,
        columnFoodCombo = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'food_name', name: 'food_name', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ],
        columnBooking = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '8%'},
            {data: 'customer_name', name: 'customer_name', className: 'text-center'},
            {data: 'customer_phone', name: 'customer_phone', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ],
        columnAddtion = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'food_name', name: 'food_name', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '10%'},
        ];
    DatatableTemplateNew(tableCombo, data.data[1].data.combo.original.data, columnFoodCombo, scroll_Y, fixed_left, fixed_right, []);
    DatatableTemplateNew(tableBooking, data.data[1].data.booking.original.data, columnBooking, scroll_Y, fixed_left, fixed_right, []);
    DatatableTemplateNew(tableAddition, data.data[1].data.addition.original.data , columnAddtion, scroll_Y, fixed_left, fixed_right, []);
}

// Draw bật lại món ăn
function drawTableChangeEnableFoodManage(data) {
    let category_id = data.category_type_id ,
        table = '';
    if (data.is_combo == 1) {
        table = dataTableFoodComboFoodBrandManage;
        $('#total-record-combo').text(formatNumber(Number(removeformatNumber($('#total-record-combo').text()))  + 1));
    } else if (data.is_addition == 1) {
        table = dataTableFoodAdditionFoodBrandManage;
        $('#total-record-addition').text(formatNumber(Number(removeformatNumber($('#total-record-addition').text())) + 1));
    }
    else {
        switch (category_id) {
            case 1:
                table = dataTableFoodFoodBrandManage;
                $('#total-record-food').text(formatNumber(Number(removeformatNumber($('#total-record-food').text()))  + 1));
                break;
            case 2:
                table = dataTableFoodDrinkFoodBrandManage;
                $('#total-record-drink').text(formatNumber(Number(removeformatNumber($('#total-record-drink').text()))  + 1));
                break;
            case 3:
                table = dataTableFoodOtherFoodBrandManage;
                $('#total-record-other').text(formatNumber(Number(removeformatNumber($('#total-record-other').text()))  + 1));
                break;
        }
    }
    removeRowDatatableTemplate(dataTableFoodDisableFoodBrandManage,thisStatusFoodDataFoodBrandManage, true);
    $('#total-record-disable').text(formatNumber(Number(removeformatNumber($('#total-record-disable').text()))  - 1));
    addRowDatatableTemplate(table, {
        'food_name': data.food_name,
        'category_name': data.category_name,
        'price': data.price,
        'original_percent': data.original_percent,
        'vat' : data.vat,
        'original_revenue': data.original_revenue,
        'profit_rate_by_original_price': data.profit_rate_by_original_price,
        'profit_rate_by_price': data.profit_rate_by_price,
        'material_count': data.material_count,
        'action':  data.action,
        'keysearch': data.keysearch
    });
}
// tắt món
function drawTableChangeDisableFoodManage(data) {
    $('#total-record-disable').text(formatNumber(Number(removeformatNumber($('#total-record-disable').text()))  + 1));
    let category_id = data.category_type_id;
    if (data.is_combo == 1) {
        $('#tab-food-combo-data-5').click();
        $('#total-record-combo').text(formatNumber(Number(removeformatNumber($('#total-record-combo').text())) -1));
        removeRowDatatableTemplate(dataTableFoodComboFoodBrandManage,thisStatusFoodDataFoodBrandManage, true);

    } else if (data.is_addition == 1) {
        $('#tab-food-addition-data-7').click();
        $('#total-record-addition').text(formatNumber(Number(removeformatNumber($('#total-record-addition').text())) - 1));
        removeRowDatatableTemplate(dataTableFoodAdditionFoodBrandManage,thisStatusFoodDataFoodBrandManage, true);

    } else {
        switch (category_id) {
            case 1:
                $('#total-record-food').text(formatNumber(Number(removeformatNumber($('#total-record-food').text())) -1));
                removeRowDatatableTemplate(dataTableFoodFoodBrandManage,thisStatusFoodDataFoodBrandManage, true);

                break;
            case 2:
                $('#total-record-drink').text(formatNumber(Number(removeformatNumber($('#total-record-drink').text())) -1));
                removeRowDatatableTemplate(dataTableFoodDrinkFoodBrandManage,thisStatusFoodDataFoodBrandManage, true);

                break;
            case 3:
                $('#total-record-other').text(formatNumber(Number(removeformatNumber($('#total-record-other').text())) - 1));
                removeRowDatatableTemplate(dataTableFoodOtherFoodBrandManage,thisStatusFoodDataFoodBrandManage, true);
                break;
        }
    }
    addRowDatatableTemplate(dataTableFoodDisableFoodBrandManage, {
        'index': '',
        'food_name': data.food_name,
        'category_name': data.category_name,
        'price': formatNumber(data.price),
        'original_percent': data.original_percent,
        'vat' : data.vat,
        'original_revenue': data.original_revenue,
        'profit_rate_by_original_price': data.profit_rate_by_original_price,
        'profit_rate_by_price': data.profit_rate_by_price,
        'material_count': data.material_count,
        'action': data.action,
        'keysearch': data.keysearch
    });
}

function removeVatFoodBrandManage(r){
    let title = 'Không áp dụng ?',
        content = 'Bạn có chắc chắn muốn không áp dụng món ăn này ?',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'food-brand-manage.remove-vat',
                params = null,
                data = {
                    id: r.data('id'),
                };
            let res = await axiosTemplate(method, url, params, data, [$('#content-body-techres')]);
            let text = '';
            switch (res.data.status){
                case 200:
                    text = $('#success-update-data-to-server').text();
                    r.parents('td').html('(0%)');
                    SuccessNotify(text);
                    LoadDataVatSetupFoodBrandManage();
                    break;
                case 500:
                    text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    ErrorNotify(text);
                    break;
                default:
                    text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    WarningNotify(text);
            }
        }
    });
}

async function dataAlertOriginalPrice(){
    let brand = $('.select-brand').val(),
        url = 'food-brand-manage.alert-original-price',
        method = 'get',
        params = {
            restaurant_brand_id: brand,
            category_type: category_type
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('.select-data-alert-original-price').html(res.data[0])
}


