let dataNewCustomerDisSelected,
    dataNewCustomerSelected,
    drawNewCustomerSelected,
    checkSaveNewCustomerGift = 0,
    drawNewCustomerDisSelected;

$(function () {
    loadData();
})

async function loadData() {
    let method = 'get',
        url = 'new-customer-gift.data',
        params = {},
        data = null;
    let res = await axiosTemplate(method, url, params, data,[
        $("#table-unselected-new-customer-gift"),
        $("#table-selected-new-customer-gift"),
    ]);
    dataTableNewCustomerGift(res);
    dataNewCustomerDisSelected = res.data[0];
    dataNewCustomerSelected = res.data[1];
}

async function dataTableNewCustomerGift(data) {
    let id1 = $('#table-unselected-new-customer-gift'),
        id2 = $('#table-selected-new-customer-gift'),
        fixed_left = 0,
        fixed_right = 0,
        column1 = [
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'gift_type', name: 'gift_type', className: 'text-center'},
            {data: 'description', name: 'description', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none', width: '5%'},
        ],
        column2 = [
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'gift_type', name: 'gift_type', className: 'text-center'},
            {data: 'description', name: 'description', className: 'text-center'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ],
        option = [
            {
                'title': 'Cập nhật',
                'icon': 'fa fa-upload text-warning',
                'class': '',
                'function': 'saveNewCustomerGift',
            }
        ];
    drawNewCustomerDisSelected = await DatatableTemplateNew(id1, data.data[0].original.data, column1, vh_of_table, fixed_left, fixed_right, []);
    drawNewCustomerSelected = await DatatableTemplateNew(id2, data.data[1].original.data, column2, vh_of_table, fixed_left, fixed_right, option);
}

async function checkNewCustomerGift(r) {
    let gift_type = 0;
    drawNewCustomerSelected.rows().every(function () {
        let row = $(this.node());
        if(row.find('td:eq(0) button').data('gift-type')){
            gift_type = 1;
        }
    })
    if(gift_type && r.data('gift-type')){
        await drawNewCustomerSelected.rows().every(function () {
            let row = $(this.node());
            if(row.find('td:eq(0) button').data('gift-type')){
                let text = row.find('td:eq(1)').text();
                WarningNotify('Hãy gỡ ' + text + ' để gán quà tặng điểm mới!');
            }
        })
    }else{
        drawNewCustomerDisSelected.row(r.parents('tr')).remove().draw(false);
        addRowDatatableTemplate(drawNewCustomerSelected, {
            'name': r.parents('tr').find('td:eq(0)').text(),
            'gift_type': r.parents('tr').find('td:eq(1)').html(),
            'description': r.parents('tr').find('td:eq(2)').html(),
            'action': `<div class="btn-group btn-group-sm">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                              onclick="unCheckNewCustomerGift($(this))" data-id="${ r.parents('tr').find('td:eq(3) button').data('id')}" data-type="${r.parents('tr').find('td:eq(3) button').data('type')}" data-gift-type="${r.parents('tr').find('td:eq(3) button').data('gift-type')}">
                                <i class="fi-rr-arrow-small-left"></i>
                            </button>
                        </div>`,
            'keysearch' : r.parents('tr').find('td:eq(4)').text()
        });
    }
}

async function unCheckNewCustomerGift(r) {
    drawNewCustomerSelected.row(r.parents('tr')).remove().draw(false);
    addRowDatatableTemplate(drawNewCustomerDisSelected, {
        'name': r.parents('tr').find('td:eq(1)').text(),
        'gift_type': r.parents('tr').find('td:eq(2)').html(),
        'description': r.parents('tr').find('td:eq(3)').html(),
        'action' : `<div class="btn-group btn-group-sm">
                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                          onclick="checkNewCustomerGift($(this))" data-id="${ r.parents('tr').find('td:eq(0) button').data('id')}" data-type="${r.parents('tr').find('td:eq(0) button').data('type')}" data-gift-type="${r.parents('tr').find('td:eq(0) button').data('gift-type')}">
                            <i class="fi-rr-arrow-small-right"></i>
                        </button>
                    </div>`,
        'keysearch' : r.parents('tr').find('td:eq(4)').text()
    });
}

async function checkAllNewCustomerGift() {
    addAllRowDatatableTemplate(drawNewCustomerDisSelected, drawNewCustomerSelected, itemCheckNewCustomerGift)
}

async function unCheckAllNewCustomerGift() {
    addAllRowDatatableTemplate(drawNewCustomerSelected, drawNewCustomerDisSelected, itemUnCheckNewCustomerGift);
}

function itemCheckNewCustomerGift(row) {
    return {
        'name': row.find('td:eq(0)').text(),
        'gift_type': row.find('td:eq(1)').text(),
        'description': row.find('td:eq(2)').html(),
        'action': `<div class="btn-group btn-group-sm">
                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                          onclick="unCheckNewCustomerGift($(this))" data-id="${ row.find('td:eq(3) button').data('id')}" data-type="${row.find('td:eq(3) button').data('type')}" data-gift-type="${row.find('td:eq(3) button').data('gift-type')}">
                            <i class="fi-rr-arrow-small-left"></i>
                        </button>
                    </div>`,
        'keysearch' : row.parents('tr').find('td:eq(4)').text()
    };
}

function itemUnCheckNewCustomerGift(row) {
    return {
        'name': row.find('td:eq(1)').text(),
        'gift_type': row.find('td:eq(2)').text(),
        'description': row.find('td:eq(3)').html(),
        'action' : `<div class="btn-group btn-group-sm">
                        <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                          onclick="checkNewCustomerGift($(this))" data-id="${ row.find('td:eq(0) button').data('id')}" data-type="${row.find('td:eq(0) button').data('type')}" data-gift-type="${row.find('td:eq(0) button').data('gift-type')}">
                            <i class="fi-rr-arrow-small-right"></i>
                        </button>
                    </div>`,
        'keysearch' : row.parents('tr').find('td:eq(4)').text()
    };
}

async function saveNewCustomerGift() {
    if (checkSaveNewCustomerGift !== 0) {
        return false;
    }
    checkSaveNewCustomerGift = 1;
    let giftInsert = [], giftDelete = [];
    await drawNewCustomerSelected.rows().every(function () {
        let row = $(this.node());
        if (row.find('td:eq(0) button').data('type') == 0) {
            giftInsert.push(row.find('td:eq(0) button').data('id'));
        }
    });
    await drawNewCustomerDisSelected.rows().every(function () {
        let row = $(this.node());
        if (row.find('td:eq(3) button').data('type') == 1) {
            giftDelete.push(row.find('td:eq(3) button').data('id'));
        }
    });
    let method = 'post',
        url = 'new-customer-gift.update',
        params = null,
        data = {
            gift_insert: giftInsert,
            gift_delete: giftDelete,
        };
    checkSaveNewCustomerGift = 1;
    let res = await axiosTemplate(method, url, params, data,[$("#table-unselected-new-customer-gift"),$("#table-selected-new-customer-gift"),]);
    checkSaveNewCustomerGift = 0;
    switch(res.data.status) {
        case 200:
            SuccessNotify($('#success-update-data-to-server').text());
            loadData();
            break;
        case 500:
            ErrorNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text())
    }
}
