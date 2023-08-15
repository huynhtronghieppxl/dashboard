let dataTableNoteFoodDataEnable = [],
    dataTableNoteFoodDataDisable = [],
    thisChangeStatusNoteData,
    checkChangeStatusNoteFoodData = 0, tabNoteFoodData = 1;

$(function () {
    if (getCookieShared('note-food-data-user-id-' + idSession)) {
        let dataCookie = JSON.parse(getCookieShared('note-food-data-user-id-' + idSession));
        tabNoteFoodData = dataCookie.tab
    }

    shortcut.remove("F2");
    shortcut.add("F2",openModalCreateNoteFoodData);

    $('#nav-tab-note-food-data .nav-link[data-tab="' + tabNoteFoodData + '"]').click();

    $('#nav-tab-note-food-data li').on('click', function () {
         if ($(this).find('a').attr('href') === '#cards-tab1') {
            if (dataTableNoteFoodDataEnable.rows().count() > 0) {
                loadData()
            } else {
                dataTableDetailNoteFoodData([]);
            }
        } else {
             if (dataTableNoteFoodDataDisable.rows().count() > 0) {
                 loadData()
            } else {
                dataTableDetailNoteFoodData([]);
            }
        }
    })

    $(document).on('click', '#table-enable-note-food-data tbody tr', function (e) {
        if ($(this).hasClass('selected')) return false;
        if (!$(this).hasClass('btn')) {
            $('#table-enable-note-food-data tbody').find('.selected').removeClass('selected');
            $(this).addClass('selected');
            dataDetailNoteFoodData($('#table-enable-note-food-data tbody tr.selected').find('td:eq(3) .seemt-btn-hover-orange').data('id'));
        }
    })

    $(document).on('click', '#table-disable-note-food-data tbody tr', function () {
        if ($(this).hasClass('selected')) return false;
        if (!$(this).hasClass('btn')) {
            $('#table-disable-note-food-data tbody').find('.selected').removeClass('selected');
            $(this).addClass('selected');
            dataDetailNoteFoodData($('#table-disable-note-food-data tbody tr.selected').find('td:eq(3) .seemt-btn-hover-orange').data('id'));
        }
    })

    $('#nav-tab-note-food-data .nav-link').on('click', function () {
        tabNoteFoodData = $(this).data('tab')
        updateCookieNoteFoodData();
    })

    loadData();

});

function updateCookieNoteFoodData() {
    saveCookieShared('note-food-data-user-id-' + idSession, JSON.stringify({
        'tab': tabNoteFoodData,
    }))
}

async function loadData() {
    let method = 'get',
        url = 'note-food-data.data',
        brand = $('.select-brand-note-food').val(),
        params = {brand: brand},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-enable-note-food-data'), $('#table-disable-note-food-data'), $('#table-detail-note-food-data')]);
    await dataTableNoteFoodData(res);
    dataTotalNoteFoodData(res.data[2]);
    $('#table-enable-note-food-data tbody tr:eq(0)').addClass('selected');
    $('#table-disable-note-food-data tbody tr:eq(0)').addClass('selected');
    if (parseInt(tabNoteFoodData) === 1) {
        dataDetailNoteFoodData($('#table-enable-note-food-data tbody tr:eq(0)').find('td:eq(3) .seemt-btn-hover-orange').data('id'));
    } else {
        dataDetailNoteFoodData($('#table-disable-note-food-data tbody tr:eq(0)').find('td:eq(3) .seemt-btn-hover-orange').data('id'));
    }
}

async function dataTableNoteFoodData(data) {
    let fixed_left = 0,
        fixed_right = 0,
        idTableEnableNoteFoodData = $('#table-enable-note-food-data'),
        idTableDisableNoteFoodData = $('#table-disable-note-food-data'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'note', name: 'note', className: 'text-left'},
            {data: 'count', name: 'count', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'}
        ],
        option = []
    dataTableNoteFoodDataEnable = await DatatableTemplateNew(idTableEnableNoteFoodData, data.data[0].original.data, column, vh_of_table, fixed_left, 2, option, '', false);
    dataTableNoteFoodDataDisable = await DatatableTemplateNew(idTableDisableNoteFoodData, data.data[1].original.data, column, vh_of_table, fixed_left, fixed_right, option, '', false);
    $(document).on('input paste', '#table-enable-note-food-data_filter input', async function () {
        $('#total-record-enable').text(dataTableNoteFoodDataEnable.rows({'search': 'applied'}).count())
        searchUpdateIndexDataTable(dataTableNoteFoodDataEnable)
    })

    $(document).on('input paste', '#table-disable-note-food-data_filter input', async function () {
        $('#total-record-disable').text(dataTableNoteFoodDataDisable.rows({'search': 'applied'}).count())
        searchUpdateIndexDataTable(dataTableNoteFoodDataDisable)

    })
}


function dataTotalNoteFoodData(data) {
    $('#total-record-enable').text(data.total_record_enable);
    $('#total-record-disable').text(data.total_record_disable);
}

function changeStatusNoteFoodData(r) {
    if (checkChangeStatusNoteFoodData === 1) return false;
    thisChangeStatusNoteData = r;
    let title = 'Đổi trạng thái sở thích phục vụ ?',
        content = '',
        icon = 'question';
    let id = r.data('id');
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            checkChangeStatusNoteFoodData = 1;
            let method = 'post',
                url = 'note-food-data.change-status',
                params = null,
                data = {id: id};
            let res = await axiosTemplate(method, url, params, data, [$('#table-enable-note-food-data'), $('#table-disable-note-food-data')]);
            checkChangeStatusNoteFoodData = 0;
            let text = ''
            switch (res.data.status) {
                case 200:
                    text = $('#success-status-data-to-server').text();
                    SuccessNotify(text);
                    drawDataChangeStatusNoteData(res.data.data)
                    break;
                case 500:
                    text = $('#error-post-data-to-server').text()
                    if (res.data.message !== null) {
                        text = res.data.message
                    }
                    ErrorNotify(text);
                default:
                    text = $('#error-post-data-to-server').text()
                    if (res.data.message !== null) {
                        text = res.data.message
                    }
                    WarningNotify(text);
            }
        }
    })
}

function drawDataChangeStatusNoteData(data) {
    if (data.is_hidden === 0) {
        $('#total-record-disable').text(formatNumber(removeformatNumber($('#total-record-disable').text()) - 1));
        $('#total-record-enable').text(formatNumber(removeformatNumber($('#total-record-enable').text()) + 1));
        removeRowDatatableTemplate(dataTableNoteFoodDataDisable, thisChangeStatusNoteData, true);
        addRowDatatableTemplate(dataTableNoteFoodDataEnable, {
            'note': data.note,
            'count': data.number_food,
            'action': data.action,
            'keysearch': data.keysearch
        });
    } else {
        $('#total-record-enable').text(formatNumber(removeformatNumber($('#total-record-enable').text()) - 1));
        $('#total-record-disable').text(formatNumber(removeformatNumber($('#total-record-disable').text()) + 1));
        removeRowDatatableTemplate(dataTableNoteFoodDataEnable, thisChangeStatusNoteData, true);
        addRowDatatableTemplate(dataTableNoteFoodDataDisable, {
            'note': data.note,
            'count': data.number_food,
            'action': data.action,
            'keysearch': data.keysearch
        });
    }
}

async function dataDetailNoteFoodData(id) {
    if (id === undefined) {
        dataTableDetailNoteFoodData([]);
        return false;
    }
    let method = 'get',
        url = 'note-food-data.detail',
        brand = $('.select-brand-note-food').val(),
        params = {brand: brand, id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-detail-note-food-data')]);
    await dataTableDetailNoteFoodData(res.data[0].original.data);

}

async function dataTableDetailNoteFoodData(data) {
    let fixed_left = 0,
        fixed_right = 0,
        id = $('#table-detail-note-food-data'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'food_name', name: 'food_name', className: 'text-left'},
            {data: 'category_name', name: 'category_name', className: 'text-left'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'}
        ],
        option = [{
            'title': 'Thêm mới',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'openModalCreateNoteFoodData',
        }];
    await DatatableTemplateNew(id, data, column, vh_of_table, fixed_left, fixed_right, option);
}
