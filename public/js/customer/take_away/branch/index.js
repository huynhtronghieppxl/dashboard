let focusStatusTakeAway = 0, branchId = -1, isHaveTakeAway = 0,tabCurrentTakeAwayBranch = 0,typeSettingTakeAwayBranch = 0,
    takeAwayBranch = $('.select-branch-take-away').find(':selected').val(), dataTakeAwayBranch ='',
    tabTakeAwayBranch = 0;

$(function () {
    if(getCookieShared('take-away-branch-user-id' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('take-away-branch-user-id' + idSession));
        tabTakeAwayBranch = dataCookie.tab
    }
    $('#btn-back-list-branch').click(function () {
        tabCurrentTakeAwayBranch = 0;
        $('#form-list-branch-booking').removeClass('d-none');
        $('#data-visible-take-away').addClass('d-none');
        $(this).addClass('d-none');
        $('#mySidenav-321').addClass('d-none');
    })
    $('.select-category-name-note-food').on('select2:select', function () {
        $('.select-category-name-note-food').val($(this).val()).trigger('change.select2');
        takeAwayBranch = $(this).val();
        dataVisibleTakeAway();
    });
    $('.select-branch-take-away').on('select2:select', function () {
        $('.select-branch-take-away').val($(this).val()).trigger('change.select2');
        takeAwayBranch = $(this).val();
        dataVisibleTakeAway();
    });
    $('#data-visible-take-away .nav-link').on('click', function (){
        tabTakeAwayBranch = $(this).data('type');
        updateCookieTakeAwayBranch();
    })
    $('#data-visible-take-away .nav-link[data-type="' + tabTakeAwayBranch + '"]').click();
    loadData();
    getCategoryNameDataIndex()
});

async function loadData() {
    dataVisibleTakeAway();
    getCategoryNameDataIndex();
}

function updateCookieTakeAwayBranch(){
    saveCookieShared('take-away-branch-user-id' + idSession, JSON.stringify({
        tab: tabTakeAwayBranch
    }))
}

async function dataVisibleTakeAway() {
    let method = 'get',
        url = 'take-away-branch.data',
        params = {
            brand: $('.select-brand').val(),
            branch: $('.select-branch').val(),
            category_id: takeAwayBranch
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data,  [
        $("#table-food-take-away"),
        $("#table-drink-take-away"),
        $("#table-sea-food-take-away"),
        $("#table-other-take-away"),
    ]);
    dataTableTakeAway1(res);
    dataTotalTakeAway(res.data[4]);
}

async function getCategoryNameDataIndex() {
    if (dataTakeAwayBranch !== '') {
        await $('.select-branch-take-away').html(dataTakeAwayBranch);
    } else {
        let method = 'get',
            url = 'take-away-branch.category-food',
            params = {
                brand: $('.select-brand').val(),
            },
            data = null;
        let res = await axiosTemplate(method, url, params, data);
        await $('.select-category-name-note-food').html(res.data[0]);
        dataTakeAwayBranch = res.data[0];
    }
}

function dataTableTakeAway1(data) {
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
        'function': 'openModalUpdateTakeAway',
    }],
        scroll_Y = "65vh",
        fixed_left = 3,
        fixed_right = 1;
    DatatableTemplateNew(table_food, data.data[0].original.data, column, scroll_Y, fixed_left, fixed_right,option);
    DatatableTemplateNew(table_drink, data.data[1].original.data, column, scroll_Y, fixed_left, fixed_right,option);
    DatatableTemplateNew(table_sea, data.data[2].original.data, column, scroll_Y, fixed_left, fixed_right,option);
    DatatableTemplateNew(table_other, data.data[3].original.data, column, scroll_Y, fixed_left, fixed_right,option);
}

function changeStatusSettingTakeAway(r) {
    branchId = r.data('id');
    if (focusStatusTakeAway === 0) {
        if (r.is(':checked') === false) {
            let title = 'Hủy kích hoạt món mang về ?',
                content = '',
                icon = 'warning';
            sweetAlertComponent(title, content, icon).then(async (result) => {
                if (result.value) {
                    isHaveTakeAway = 0;
                    saveModalSettingTakeAway();
                } else {
                    focusStatusTakeAway = 1;
                    r.click();
                    focusStatusTakeAway = 0;
                }
            })
        } else {
            let title = ' kích hoạt món mang về ?',
                content = '',
                icon = 'warning';
            sweetAlertComponent(title, content, icon).then(async (result) => {
                if (result.value) {
                    isHaveTakeAway = 1;
                    dataSettingTakeAway();
                } else {
                    focusStatusTakeAway = 1;
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

async function detailBranch(r) {
    typeSettingTakeAwayBranch = 1;
    branchId = r.data('id');
    $('#data-visible-take-away').removeClass('d-none');
    $('#form-list-branch-booking').addClass('d-none');
    $('#btn-back-list-branch').removeClass('d-none');
    await $('#mySidenav-321').removeClass('d-none');
    countSideNavWidth()
    loadData();
    updateCookie();
}
