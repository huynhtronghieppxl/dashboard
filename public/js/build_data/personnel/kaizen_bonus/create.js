 let checkSaveCreateKaizenBonusData = 0, tableCreateKaizenBonusData;

function openModalCreateKaizenBonusData() {
    $('#modal-create-kaizen-bonus-data').modal('show');
    addLoading("kaizen-bonus-data.create", 'loading-create-kaizen-bonus-data');
    shortcut.add('F4', function () {
        saveModalCreateKaizenBonusData();
    });
    shortcut.add('ESC', function () {
        closeModalCreateKaizenBonusData();
    });
    drawTableCreateKaizenBonusData();
}

async function drawTableCreateKaizenBonusData() {
    let id = $('#table-create-kaizen-bonus-data'),
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center'},
            {data: 'level', className: 'text-left'},
            {data: 'amount', className: 'text-center'},
        ];
    tableCreateKaizenBonusData = await DatatableTemplateNew(id, dataTableCreateKaizenBonusData, column, vh_of_table, fixed_left, fixed_right,[]);
    $('#table-create-kaizen-bonus-data_filter, #table-create-kaizen-bonus-data_length, #table-create-kaizen-bonus-data_info, #table-create-kaizen-bonus-data_paginate').addClass('d-none');
}

async function saveModalCreateKaizenBonusData() {
    if (checkSaveCreateKaizenBonusData === 1) return false;
    if(!checkValidateSave($('#table-create-kaizen-bonus-data'))) return false;
    let bonus = [];
    tableCreateKaizenBonusData.rows().every(function () {
        let row = $(this.node());
        bonus.push(removeformatNumber(row.find('td:eq(2) input').val()));
    });
    checkSaveCreateKaizenBonusData = 1;
    let method = 'post',
        url = 'kaizen-bonus-data.create',
        params = null,
        data = {
            bonus: bonus,
        };
    let res = await axiosTemplate(method, url, params, data,[$("#loading-create-kaizen-bonus-data")]);
    checkSaveCreateKaizenBonusData = 0;
    if (res.data.status === 200) {
        let text = $('#success-create-data-to-server').text();
        SuccessNotify(text);
        loadData();
        closeModalCreateKaizenBonusData();
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
    }
}

function closeModalCreateKaizenBonusData() {
    $('#modal-create-kaizen-bonus-data').modal('hide');
    removeAllValidate();
    shortcut.remove('F4');
    shortcut.remove('ESC');
}

