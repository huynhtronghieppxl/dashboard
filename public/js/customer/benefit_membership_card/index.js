$(function () {
    addLoading('benefit-membership-card.data');
    addLoading('benefit-membership-card.card');
    addLoading('benefit-membership-card.change-status');
    shortcut.remove('F2');
    shortcut.add('F2', function () {
        openModalCreateBenefitMemberShipCard();
    });
    loadData();
    $('#select-card-benefit-membership-card').on('select2:select', function () {
        dataBenefitMemberShipCard();
    })
});

async function loadData() {
    dataCardBenefitMemberShipCard();
}

async function dataCardBenefitMemberShipCard() {
    let method = 'get',
        url = 'benefit-membership-card.card',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#select-card-benefit-membership-card').html(res.data[0]);
    let table = [[], []];
    dataTableBenefitMemberShipCard(table);
}

async function dataBenefitMemberShipCard() {
    let method = 'get',
        id = $('#select-card-benefit-membership-card').val(),
        url = 'benefit-membership-card.data',
        params = {id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    dataTableBenefitMemberShipCard(res);
    dataTotalBenefitMemberShipCard(res.data[2]);
}

async function dataTableBenefitMemberShipCard(data) {
    let scroll_Y = '65vh',
        fixed_left = 2,
        fixed_right = 0,
        id1 = $('#table-enable-member-ship-card'),
        id2 = $('#table-disable-member-ship-card'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'content', name: 'content', class: 'text-center'},
            {data: 'description', name: 'description', class: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ];
    DatatableTemplate(id1, data.data[0].original.data, column, scroll_Y, fixed_left, fixed_right);
    DatatableTemplate(id2, data.data[1].original.data, column, scroll_Y, fixed_left, fixed_right);
}

function dataTotalBenefitMemberShipCard(data) {
    $('#total-record-tab1-restaurant-membership-card').text(data.total_record_enable);
    $('#total-record-tab2-restaurant-membership-card').text(data.total_record_disable);
}

function changeStatusRestaurantMembershipCard(r) {
    if (focus_status_membership_card === 0) {
        if (r.is(':checked') === false) {
            let title = 'Hủy kích hoạt thẻ thành viên ?',
                content = '',
                icon = 'warning';
            sweetAlertComponent(title, content, icon).then(async (result) => {
                if (result.value) {
                    callApiChangeStatusRestaurantMembershipCard();
                } else {
                    focus_status_membership_card = 1;
                    r.click();
                    focus_status_membership_card = 0;
                }
            })
        } else {
            let title = 'Kích hoạt thẻ thành viên ?',
                content = '',
                icon = 'warning';
            sweetAlertComponent(title, content, icon).then(async (result) => {
                if (result.value) {
                    callApiChangeStatusRestaurantMembershipCard();
                } else {
                    focus_status_membership_card = 1;
                    r.click();
                    focus_status_membership_card = 0;
                }
            })
        }
    }
}
