let bonusPunishEmployeeManager, orderEmployeeManager,idDetailEmployee
$(function (){
    $(document).on('click', '.search-date-filter-time-bar', function (){
        dataDetailEmployeeManage(idDetailEmployee)
    })
})
async function openModalDetailEmployeeManage(r) {
    idDetailEmployee=r.attr('data-id')
    $('#modal-detail-employee-manage').modal('show');
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalDetailEmployeeManage();
    });
    $('.reset-data-detail-employee-manage').html('---');
    $('#modal-detail-employee-bonus-punish, #modal-detail-bill-manage').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailEmployeeManage();
        });
    });
    $('#detail-employee-manage-info').click();
    await dataDetailEmployeeManage(r);
}

function openModalDetailEmployeeInfo() {
    $('#tab0-employee-manage-detail').removeClass('d-none');
    $('#tab1-employee-manage-detail').addClass('d-none');
    $('#tab2-employee-manage-detail').addClass('d-none');
    $('#detail-employee-manage-info').addClass('active');
    $('#detail-employee-manage-bonus').removeClass('active');
    $('#detail-employee-manage-receipts').removeClass('active');
}

function openModalDetailEmployeeBonus() {
    $('#tab0-employee-manage-detail').addClass('d-none');
    $('#tab1-employee-manage-detail').removeClass('d-none');
    $('#tab2-employee-manage-detail').addClass('d-none');
    $('#detail-employee-manage-bonus').addClass('active');
    $('#detail-employee-manage-info').removeClass('active');
    $('#detail-employee-manage-receipts').removeClass('active');
    bonusPunishEmployeeManager.draw();
}

function openModalDetailEmployeeReceipts() {
    $('#tab0-employee-manage-detail').addClass('d-none');
    $('#tab1-employee-manage-detail').addClass('d-none');
    $('#tab2-employee-manage-detail').removeClass('d-none');
    $('#detail-employee-manage-receipts').addClass('active');
    $('#detail-employee-manage-info').removeClass('active');
    $('#detail-employee-manage-bonus').removeClass('active');
    orderEmployeeManager.draw();
}

async function dataDetailEmployeeManage(r) {
    let method = 'get',
        url = 'employee-manage.detail',
        params = {
            id: r.attr('data-id'),
            brand: r.attr('data-brand-id'),
            branch:  '',
            type: 3,
            time: '01/'+ $('#calendar-month').val()
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-modal-detail-employee-manage'),
    ]);
    $('#name-detail-employee-manage').text(res.data[0].name);
    $('#birthday-detail-employee-manage').text(res.data[0].birthday);
    $('#gender-detail-employee-manage').text(res.data[0].gender);
    $('#phone-detail-employee-manage').text(res.data[0].phone);
    $('#email-detail-employee-manage').text(res.data[0].email);
    $('#birth-place-detail-employee-manage').text(res.data[0].birth_place);
    $('#passport-detail-employee-manage').text(res.data[0].passport);
    $('#address-detail-employee-manage').text(res.data[4].data.employee_profile.address_full_text);
    $('#branch-detail-employee-manage').text(res.data[0].branch);
    $('#role-detail-employee-manage').text(res.data[0].role);
    $('#rank-detail-employee-manage').text(res.data[0].rank);
    $('#work-detail-employee-manage').text(res.data[0].work);
    $('#point-detail-employee-manage').text(res.data[0].point);
    $('#salary-detail-employee-manage').text(res.data[0].salary);
    $('#area-detail-employee-manage').text(res.data[0].area);
    $('#group-role-detail-employee-manage').text(res.data[0].employee_role_type);
    $('#area-control-detail-employee-manage').text(res.data[0].area_control);
    $('#date-work-detail-employee-manage').text(res.data[0].date_work);
    $('#avatar-detail-employee-manage').attr('src', res.data[0].avatar);
    $('#status-detail-employee-manage').html(res.data[0].status);
    (res.data[4].data.employee_role_type === 2) ? $('#show-rank-detail-employee-manage').removeClass('d-none') : $('#show-rank-detail-employee-manage').addClass('d-none');
    dataTableDetailInfoEmployeeManage(res);
    dataTotalDetailEmployeeManage(res.data[3]);
}

async function dataTableDetailInfoEmployeeManage(data) {
    let id1 = $('#table-employee-manage-detail-tab1'),
        id2 = $('#table-employee-manage-detail-tab2'),
        scroll_Y = '40vh',
        fixed_left = 0,
        fixed_right = 0,
        column1 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'bonusrole', name: 'bonusrole', className: 'text-center'},
            {data: 'bonus', name: 'bonus', className: 'text-center', width: '20%'},
            {data: 'punish', name: 'punish', className: 'text-center', width: '20%'},
            {data: 'time', name: 'time', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'}
        ],
        column2 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'id', name: 'id', className: 'text-center', width: '20%'},
            {data: 'total_amount', name: 'total_amount', className: 'text-center', width: '20%'},
            {data: 'created_at', name: 'created_at', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},

        ];
    let option = [];
    bonusPunishEmployeeManager = await DatatableTemplateNew(id1, data.data[1].original.data, column1, scroll_Y, fixed_left, fixed_right, option);
    orderEmployeeManager = await DatatableTemplateNew(id2, data.data[2].original.data, column2, scroll_Y, fixed_left, fixed_right, option);

    $(document).on('input paste keyup', '#loading-modal-detail-employee-manage input[type="search"]', async function () {
        $('#total-record-bonus-punish-employee-manage').text(bonusPunishEmployeeManager.rows({'search': 'applied'}).count());
        $('#total-record-bill-employee-manage').text(orderEmployeeManager.rows({'search': 'applied'}).count());
        let tableBonusPunishEmployeeManager = searchTableBonus(bonusPunishEmployeeManager),
            tableOrderEmployeeManager = searchTableOrder(orderEmployeeManager);
        $('#total-bonus-detail-employee-manage').text(formatNumber(tableBonusPunishEmployeeManager[0]))
        $('#total-punish-detail-employee-manage').text(formatNumber(tableBonusPunishEmployeeManager[1]))
        $('#total-amount-bill-detail-employee-manage').text(formatNumber(tableOrderEmployeeManager))
    })
}

function searchTableBonus(datatable) {
    let totalBonus = 0, totalPunish = 0;
    datatable.rows({'search': 'applied'}).every(function () {
        let row = $(this.node());
        totalBonus += removeformatNumber(row.find('td:eq(2)').text());
        totalPunish += removeformatNumber(row.find('td:eq(3)').text());
    })
    return [totalBonus, totalPunish]
}

function searchTableOrder(datatable) {
    let totalAmount = 0;
    datatable.rows({'search': 'applied'}).every(function () {
        let row = $(this.node());
        totalAmount += removeformatNumber(row.find('td:eq(2)').text());
    })
    return totalAmount
}

function dataTotalDetailEmployeeManage(data) {
    $('#total-record-bonus-punish-employee-manage').text(data.total_record_bonus_punish);
    $('#total-record-bill-employee-manage').text(data.total_record_bill);
    $('#total-bonus-detail-employee-manage').text(data.total_bonus);
    $('#total-punish-detail-employee-manage').text(data.total_punish);
    $('#total-amount-bill-detail-employee-manage').text(data.total_bill);
}

function closeModalDetailEmployeeManage() {
    $('#modal-detail-employee-manage').modal('hide');
    reloadModalDetailEmployeeManage();
}

function reloadModalDetailEmployeeManage() {
    $('.reset-data-detail-employee-manage').html('---');
    $('#total-record-bonus-punish-employee-manage').html(0);
    $('#total-record-bill-employee-manage').html(0);
    $('#avatar-detail-employee-manage').attr('src', '');
}
