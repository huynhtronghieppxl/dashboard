let countItemCategoryWorkData, checkSaveChangeCategoryWorkData, selectRole;
$(function () {
    checkSaveChangeCategoryWorkData = 0;
    if(getCookieShared('category-work-data-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('category-work-data-user-id-' + idSession));
        selectRole = dataCookie.select;
    }
    loadData();
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function (){
        openModalCreateCategoryWorkData()
    })
    $('#select-role-work-data').on('select2:select', function () {
        selectRole = $(this).val()
        dataCategoryWorkData();
        updateCookieCategoryWork()
        $('#button-service-2').addClass('d-warning')
    });
});

function updateCookieCategoryWork(){
    saveCookieShared('category-work-data-user-id-' + idSession, JSON.stringify({
        'select' : selectRole,
    }))
}

async function loadData() {
    await dataRoleWorkData();
    dataCategoryWorkData();
}

async function dataRoleWorkData() {
    let method = 'get',
        url = 'work-data.data-role',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#select-role-work-data')]);
    $('#select-role-work-data').html(res.data[0]);
    checkHasInSelect(selectRole, $('#select-role-work-data'))
}

function eventCategoryWorkData() {
    $('#draggableMultiple .fa-square').unbind('click').on('click', function () {
        $('#button-service-2').removeClass('d-warning');
        $(this).parents('.sortable-moves').removeClass('work-not-active');
        $(this).parents('.sortable-moves').addClass('work-active');
        $(this).removeClass('fa-square');
        $(this).addClass('fa-check-square');
        $(this).attr('data-original-title', 'Đang hoạt động')
        eventCategoryWorkData();
    });
    $('#draggableMultiple .fa-check-square').unbind('click').on('click', function () {
        $('#button-service-2').removeClass('d-warning');
        $(this).parents('.sortable-moves').removeClass('work-active');
        $(this).parents('.sortable-moves').addClass('work-not-active');
        $(this).removeClass('fa-check-square');
        $(this).addClass('fa-square');
        $(this).attr('data-original-title', 'Không hoạt động')
        eventCategoryWorkData();
    });
}

async function dataCategoryWorkData() {
    $('.empty-datatable-custom').remove();
    let method = 'get',
        url = 'category-work-data.data',
        brand = $('.select-brand.category-work-data').val(),
        params = {
            brand: brand,
            role: $('#select-role-work-data option:selected').val(),
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#content-body-techres')]);
    $('#draggableMultiple').attr('style', '');
    await $('#draggableMultiple').html(res.data[0]);
    countItemCategoryWorkData = res.data[1].data.length;
    eventCategoryWorkData();
    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover'
    });
    Sortable.create(draggableMultiple, {
        containment: "#draggableMultiple",
        group: draggableMultiple,
        animation: 150,
        dropOnEmpty: false,

    });
    $("#draggableMultiple").sortable({
        containment: ".box-parent-category-work",
        update: function () {
            $('#draggableMultiple .sortable-moves').each(function (i, v) {
                $(v).find('button').text(i + 1);
            });
            $('#button-service-2').removeClass('d-warning');
        }
    });
    if($('#draggableMultiple').text() === ''){
        $('#draggableMultiple').parent().append(`<div class="empty-datatable-custom row col-12 w-100 justify-content-center" style="width: 200px ; text-align: center;"><img style="width: 200px" src="../../../../images/tms/empty.png"></div>`);
    }
}

async function saveSortCategoryWorkData() {
    if (checkSaveChangeCategoryWorkData  === 1) return false;
    let sort = [];
    $('#draggableMultiple .sortable-moves').each(function (i, v) {
        let status = 0;
        if ($(v).find('.fa-check-square').length === 1) status = 1;
        sort.push({
            'id': $(v).find('.fa-pencil-square').data('id'),
            'sort': i,
            'status': status,
        });
    });
    checkSaveChangeCategoryWorkData = 1;
    let method = 'post',
        url = 'category-work-data.sort',
        params = null,
        data = {sort: sort};
    let res = await axiosTemplate(method, url, params, data, [$('#content-body-techres')]);
    checkSaveChangeCategoryWorkData = 0;
    let text = ''
    switch (res.data.status) {
        case 200:
            $('#button-service-2').addClass('d-warning');
            text = $('#success-upload-data-to-server').text();
            SuccessNotify(text);
            loadData();
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




