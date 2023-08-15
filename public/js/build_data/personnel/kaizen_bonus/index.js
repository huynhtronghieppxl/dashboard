let tableKaizenBonusData, dataTableCreateKaizenBonusData;

$(function () {
    loadData();
    $(document).on('click focus', 'input', function () {
        $(this).select();
    })

    $(document).on('input','#table-kaizen-bonus-data input', function (){
        $(this).parent().removeClass('border-danger');
    })

    $(document).on('click', '#btn-update-kaizen-bonus-data', function () {
        $('.not-edit-kaizen-bonus-data').addClass('d-none');
        $('.edit-kaizen-bonus-data').removeClass('d-none');
        $('#btn-update-kaizen-bonus-data').addClass('d-none');
        $('#btn-close-kaizen-bonus-data').removeClass('d-none');
        $('#btn-save-kaizen-bonus-data').removeClass('d-none');
        $('#table-kaizen-bonus-data .validate-table-validate').addClass('input-group');
        $('#table-kaizen-bonus-data .validate-table-validate').addClass('border-group');
        $('.label-input-amount').removeClass('text-right')


    });
    $(document).on('click', '#btn-close-kaizen-bonus-data', function () {
        $('.not-edit-kaizen-bonus-data').removeClass('d-none');
        $('.edit-kaizen-bonus-data').addClass('d-none');
        $('#btn-update-kaizen-bonus-data').removeClass('d-none');
        $('#btn-close-kaizen-bonus-data').addClass('d-none');
        $('#btn-save-kaizen-bonus-data').addClass('d-none');
        $('#table-kaizen-bonus-data .validate-table-validate').removeClass('input-group');
        $('#table-kaizen-bonus-data .validate-table-validate').removeClass('border-group');
        $('#table-kaizen-bonus-data .validate-table-validate').removeClass('border-danger');
        $('.label-input-amount').addClass('text-right')
        tableKaizenBonusData.rows().every(function () {
            let row = $(this.node());
            row.find('td:eq(2) input').val(row.find('td:eq(2) label').text());
        });
    });
});

async function loadData() {
    let method = 'get',
        url = 'kaizen-bonus-data.data',
        brand = $('.select-brand').val(),
        params = {brand: brand},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-kaizen-bonus-data')]);
    await dataTableKaizenBonusData(res.data[0].original.data);
    if(res.data[2].data.length>0) {
        $('#btn-update-kaizen-bonus-data').removeClass('d-none')
    }
    $('#table-kaizen-bonus-data_filter, #table-kaizen-bonus-data_length, #table-kaizen-bonus-data_info, #table-kaizen-bonus-data_paginate').addClass('d-none');
    dataTableCreateKaizenBonusData = res.data[1].original.data;
}

async function dataTableKaizenBonusData(data) {
    let idKaizen = $('#table-kaizen-bonus-data'),
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'level', className: 'text-left'},
            {data: 'amount', className: 'text-right label-input-amount'},
            {data: 'updated_at', className: 'text-center'},
            {data: 'keysearch',name: 'keysearch', className: 'd-none'}
        ],
            option = [
                {
                    'title' : 'Thêm mới',
                    'icon' : 'fa fa-plus text-primary',
                    'class' : '',
                    'function' : 'openModalCreateKaizenBonusData'
                }
            ];
    tableKaizenBonusData = await DatatableTemplateNew(idKaizen, data, column, vh_of_table, fixed_left, fixed_right, option);
    $('#table-kaizen-bonus-data .validate-table-validate').removeClass('input-group');
    $('#table-kaizen-bonus-data .validate-table-validate').removeClass('border-group');
    if (data.length > 0) {
        $('.toolbar-button-datatable').addClass('d-none');
        $('#btn-update-kaizen-bonus-data').removeClass('d-none');
    } else {
        $('.toolbar-button-datatable').removeClass('d-none');
        $('#btn-update-kaizen-bonus-data').addClass('d-none');
    }
}
