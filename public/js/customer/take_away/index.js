let focusStatusTakeAway = 0, branchIdTakeAway = -1 ,
    isHaveTakeAway = 0;

$(function () {
    addLoading('take-away.data');
    $('#btn-back-list-branch').click(function(){
        $('#form-list-branch-booking').removeClass('d-none');
        $('#data-visible-take-away').addClass('d-none');
        $(this).addClass('d-none');
        $('#mySidenav-321').addClass('d-none');
    })
});

async function loadData() {
    dataVisibleTakeAway();
}

async function dataVisibleTakeAway() {
    let method = 'get',
        url = 'take-away.data',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    dataTableTakeAway(res);
    dataTotalTakeAway(res.data[4]);
}

function dataTableTakeAway(data) {
    let table_food = $('#table-food-take-away'),
        table_drink = $('#table-drink-take-away'),
        table_sea = $('#table-sea-food-take-away'),
        table_other = $('#table-other-take-away'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'avatar', name: 'avatar', className: 'text-center'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'category_name', name: 'category_name', className: 'text-center'},
            {data: 'price', name: 'price', className: 'text-center'},
            {data: 'unit_type', name: 'unit_type', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ],
        scroll_Y = "65vh",
        fixed_left = 3,
        fixed_right = 1;
    DatatableTemplate(table_food, data.data[0].original.data, column, scroll_Y, fixed_left, fixed_right);
    DatatableTemplate(table_drink, data.data[1].original.data, column, scroll_Y, fixed_left, fixed_right);
    DatatableTemplate(table_sea, data.data[2].original.data, column, scroll_Y, fixed_left, fixed_right);
    DatatableTemplate(table_other, data.data[3].original.data, column, scroll_Y, fixed_left, fixed_right);
}

function changeStatusSettingTakeAway(r) {
    branchIdTakeAway = r.data('id');
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
        }
        else{
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

async function detailBranch(button){
    $('#branch_id').val(button.attr('data-id'));
    branchIdTakeAway = button.attr('data-id');
    let is_take_away = button.attr('data-take-away');
        $('#data-visible-take-away').removeClass('d-none');
        $('#form-list-branch-booking').addClass('d-none');
        $('#btn-back-list-branch').removeClass('d-none');
        await $('#mySidenav-321').removeClass('d-none');
        countSideNavWidth()
        loadData();
}
