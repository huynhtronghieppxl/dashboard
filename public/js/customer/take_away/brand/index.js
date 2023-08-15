let focusStatusTakeAway = 0,
    getIsHaveTakeAway = 0,
    isHaveTakeAway = 0,
    tabCurrentTakeAwayBrand = 0,
    typeSettingTakeAwayBrand = 0,
    tabCurrentIndexTakeAwayBrand = 0,
    takeAwayBrand = $('.select-branch-take-away').find(':selected').val(), dataTakeAwayBrand ='',
    brandIdTakeAway = -1;

$(function () {
    if (getCookieShared('take-away-brand-user-id-' + idSession)) {
        let data = JSON.parse(getCookieShared('take-away-brand-user-id-' + idSession));
        tabCurrentIndexTakeAwayBrand = data.tabSetting;
        tabCurrentTakeAwayBrand = data.tab;
        typeSettingTakeAwayBrand = data.type;
    }
    $('#data-visible-take-away a.nav-link').on('click', function () {
        tabCurrentTakeAwayBrand = $(this).attr('data-type');
        updateCookie();
    })
    $('#list-branch-take-away .btn-detail-branch-booking').on('click', function () {
        typeSettingTakeAwayBrand = 1
        tabCurrentIndexTakeAwayBrand = $(this).attr('data-type');
        updateCookie();
    })
    $('.select-category-name-note-food').on('select2:select', function () {
        $('.select-category-name-note-food').val($(this).val()).trigger('change.select2');
        takeAwayBrand = $(this).val();
        dataVisibleTakeAway();
    });
    if (typeSettingTakeAwayBrand === 1) {
        $('#list-branch-take-away .btn-detail-branch-booking[data-type="' + tabCurrentIndexTakeAwayBrand + '"]').click();
        $('#data-visible-take-away a.nav-link[data-type="' + tabCurrentTakeAwayBrand + '"]').click();
    }
    $('#change_branch').addClass('d-none');

    $('#btn-back-list-branch').on('click',function(){
        typeSettingTakeAwayBrand = 0;
        tabCurrentTakeAwayBrand = 0;
        updateCookie();
        $('#form-list-branch-booking').removeClass('d-none');
        $('#data-visible-take-away').addClass('d-none');
        $(this).addClass('d-none');
        $('#mySidenav-321').addClass('d-none');
    })
    $('.select-brand-take-away').on('select2:select', function () {
        $('.select-brand-take-away').val($(this).val()).trigger('change.select2');
        takeAwayBrand = $(this).val();
        dataVisibleTakeAway();
    });
    loadData()
});

function updateCookie() {
    saveCookieShared('take-away-brand-user-id-' + idSession, JSON.stringify({
        'tab': tabCurrentTakeAwayBrand,
        'type': typeSettingTakeAwayBrand,
        'tabSetting' : tabCurrentIndexTakeAwayBrand,
    }))
}

async function loadData() {
    dataVisibleTakeAway();
    getCategoryNameDataIndex()
}

async function dataVisibleTakeAway() {
    let method = 'get',
        url = 'take-away-brand.data',
        params = {
            brand : $('.select-brand').val(),
            category_id: takeAwayBrand
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data,[
        $("#table-food-take-away"),
        $("#table-drink-take-away"),
        $("#table-sea-food-take-away"),
        $("#table-other-take-away")
    ]);
    dataTableTakeAway(res);
    dataTotalTakeAway(res.data[4]);
}

async function getCategoryNameDataIndex() {
    if (dataTakeAwayBrand !== '') {
        await $('.select-brand-take-away').html(dataTakeAwayBrand);
    } else {
        let method = 'get',
            url = 'take-away-brand.category-food',
            params = {
                brand: $('.select-brand').val(),
            },
            data = null;
        let res = await axiosTemplate(method, url, params, data);
        await $('.select-category-name-note-food').html(res.data[0]);
        dataTakeAwayBrand = res.data[0];
    }
}

function dataTableTakeAway(data) {
    let table_food = $('#table-food-take-away'),
        table_drink = $('#table-drink-take-away'),
        table_sea = $('#table-sea-food-take-away'),
        table_other = $('#table-other-take-away'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name'},
            {data: 'unit_type', name: 'unit_type', className: 'text-center'},
            {data: 'category_name', name: 'category_name', className: 'text-center'},
            {data: 'price', name: 'price', className: 'text-center'},
            {data: 'vat', name: 'vat', className: 'text-center'},
            {data: 'original_revenue', name: 'original_revenue', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ],
        option = [{
            'title': 'Cập nhật món ăn',
            'icon': 'fa fa-exchange',
            'class': '',
            'function': 'openModalUpdateTakeAwayBrand',
        }],
        scroll_Y = "65vh",
        fixed_left = 3,
        fixed_right = 1;
    DatatableTemplateNew(table_food, data.data[0].original.data, column, scroll_Y, fixed_left, fixed_right,option);
    DatatableTemplateNew(table_drink, data.data[1].original.data, column, scroll_Y, fixed_left, fixed_right,option);
    DatatableTemplateNew(table_sea, data.data[2].original.data, column, scroll_Y, fixed_left, fixed_right,option);
    DatatableTemplateNew(table_other, data.data[3].original.data, column, scroll_Y, fixed_left, fixed_right,option);
}

function changeStatusSettingTakeAwayBrand(r) {
    brandIdTakeAway = r.data('id');
    if (focusStatusTakeAway === 0) {
        if (r.is(':checked') === false) {
            let title = 'Hủy kích hoạt món mang về ?',
                content = '',
                icon = 'warning';
            sweetAlertComponent(title,content,icon).then(async (result) =>{
                if (result.value){
                    getIsHaveTakeAway = 0;
                    saveModalSettingTakeAwayBrand();
                }else{
                    focusStatusTakeAway = 1;
                    r.click();
                    focusStatusTakeAway = 0;
                }
            })
        } else{
            let title = 'Kích hoạt món mang về ?',
                content = '',
                icon = 'warning';
            sweetAlertComponent(title,content,icon).then(async (result) => {
                if(result.value){
                    getIsHaveTakeAway = 1;
                    dataSettingTakeAway();
                }else {
                    focusStatusTakeAway = 1 ;
                    r.click();
                    focusStatusTakeAway = 0;
                }
            })
        }
    }
}

function dataTotalTakeAway(data) {
    $('#total-record-food').text(data.total_record_food);
    $('#total-record-drink').text(data.total_record_drink);
    $('#total-record-sea-food').text(data.total_record_sea_food);
    $('#total-record-other').text(data.total_record_other);
}

async function detailBrand(r){
    $('#data-visible-take-away a.nav-link[data-type="' + tabCurrentTakeAwayBrand + '"]').click();
    typeSettingTakeAwayBrand = 1;
    brandIdTakeAway = r.data('id');
    $('#data-visible-take-away').removeClass('d-none');
    $('#form-list-branch-booking').addClass('d-none');
    $('#btn-back-list-branch').removeClass('d-none');
    await $('#mySidenav-321').removeClass('d-none');
    countSideNavWidth()
    loadData();
}
