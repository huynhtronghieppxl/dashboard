let dataAllTakeAway = [],
    dataSelectedTakeAway = [],
    drawAllTakeAwayBranch,
    drawSelectedTakeAwayBranch,
    saveTakeAway = 0;

async function openModalUpdateTakeAway() {
    $('#modal-update-take-away').modal('show');
    shortcut.add('F4', function () {
        saveModalUpdateTakeAway();
    });
    shortcut.add('ESC', function () {
        closeModalUpdateTakeAway();
    });
    dataUpdateTakeAway();
}

async function dataUpdateTakeAway() {
    let method = 'get',
        url = 'take-away-branch.data-update',
        params = {
            brand: $('.select-brand').val(),
            branch: $('.select-branch').val(),
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data,[
        $("#table-all-take-away"),
        $("#table-selected-take-away"),
    ]);
    dataAllTakeAway = res.data[0].original.data;
    dataSelectedTakeAway = res.data[1].original.data;
    dataTableAllTakeAway(res);
}

async function dataTableAllTakeAway(data) {
    let table_all = $('#table-all-take-away'),
        table_selected = $('#table-selected-take-away'),
        scroll_Y = '45vh',
        fixed_left = 0,
        fixed_right = 1,
        column_all = [
            {data: 'name', name: 'name'},
            {data: 'amount', name: 'amount', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ],
        column_selected = [
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name'},
            {data: 'amount', name: 'amount', className: 'text-center'},
        ],option = [];
    drawAllTakeAwayBranch = await DatatableTemplateNew(table_all, data.data[0].original.data, column_all, scroll_Y, fixed_left, fixed_right,option);
    drawSelectedTakeAwayBranch = await DatatableTemplateNew(table_selected, data.data[1].original.data, column_selected, scroll_Y, fixed_left, fixed_right,option);

}

async function saveModalUpdateTakeAway() {
    if (saveTakeAway !== 0) {
        return false;
    }
    saveTakeAway = 1;
    let foods = [];
    await drawSelectedTakeAwayBranch.rows().every(function (index, element) {
        let row = $(this.node());
        foods.push(row.find('td:eq(0)').find('button').data('id'));
    });
    let method = 'post',
        url = 'take-away-branch.update',
        params = null,
        data = {branch: branchId, foods: foods};
    let res = await axiosTemplate(method, url, params, data);
    saveTakeAway = 0;
    let text = '';
    switch(res.data.status) {
        case 200:
            text = $('#success-update-data-to-server').text();
            SuccessNotify(text);
            closeModalUpdateTakeAway();
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

function itemBranchDraw(r) {
    return {
        // 'action': '<i class="fa fa-2x fa-arrow-circle-left btn-convert-left-to-right" data-id="' + r.find('td:eq(2)').find('i').data('id') + '" data-name="' + r.find('td:eq(2)').text() + '" data-avatar="' + r.find('td:eq(1)').find('img').attr('src') + '" data-amount="' + r.find('td:eq(1)').text() + '" onclick="unCheckFoodTakeAway($(this))"></i>',
        'action': '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  data-id="' + r.find('td:eq(2)').find('button').data('id') + '" data-name="' + r.find('td:eq(2)').text() + '" data-avatar="' + r.find('td:eq(1)').find('img').attr('src') + '" data-amount="' + r.find('td:eq(1)').text() + '" onclick="unCheckFoodTakeAway($(this))"><i class="fi-rr-arrow-small-left"></i></button></div>',
        'avatar': '<label><img src="' + r.find('td:eq(0)').find('img').attr('src') + '" class="img-data-table" onclick="modalImageComponent(' + r.find('td:eq(1)').find('img').attr('src') + ')"></label><input value="' + r.data('id') + '" class="d-none">',
        'name': r.find('td:eq(0)').html(),
        'amount': r.find('td:eq(1)').text(),
    };
}

async function checkAllFoodTakeAwayBranch() {
    await addAllRowDatatableTemplate(drawAllTakeAwayBranch, drawSelectedTakeAwayBranch, itemBranchDraw);
    drawSelectedTakeAwayBranch.page('last').draw(false);
    $(drawSelectedTakeAwayBranch.table().node()).parent().scrollTop($(drawSelectedTakeAwayBranch.table().node()).parent().get(0).scrollHeight);
}

function itemBranchSelectDraw(r) {
    return {
        // 'action': '<i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right" onclick="checkFoodTakeAway($(this))" data-id="' + r.find('td:eq(0)').find('i').data('id') + '" ></i>',
        'action': '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  onclick="checkFoodTakeAway($(this))" data-id="' + r.find('td:eq(0)').find('button').data('id') + '"><i class="fi-rr-arrow-small-right"></i></button></div>',
        // 'avatar': '<label><img src="' + r.find('td:eq(1)').find('img').attr('src') + '" class="img-data-table" onclick="modalImageComponent(' + r.find('td:eq(1)').find('img').attr('src') + ')"></label><input value="' + r.data('id') + '" class="d-none">',
        'name': r.find('td:eq(1)').html(),
        'amount': r.find('td:eq(2   )').text(),
    };
}

async function unCheckAllFoodTakeAwayBranch() {
    await addAllRowDatatableTemplate(drawSelectedTakeAwayBranch, drawAllTakeAwayBranch, itemBranchSelectDraw);
    drawAllTakeAwayBranch.page('last').draw(false);
    $(drawAllTakeAwayBranch.table().node()).parent().scrollTop($(drawAllTakeAwayBranch.table().node()).parent().get(0).scrollHeight);
}

async function checkFoodTakeAway(r) {
    let name = r.parents('tr').find('td:eq(0)').html(),
        id = r.data('id'),
        // avatar = r.parents('tr').find('td:eq(0)').find('img').attr('src'),
        amount = r.parents('tr').find('td:eq(1)').text();

    let item = {
        // 'avatar': '<label><img src="' + avatar + '" class="img-data-table" onclick="modalImageComponent(' + avatar + ')"></label><input value="' + id + '" class="d-none">',
        'name': name,
        'amount': amount,
        // 'action': '<i class="fa fa-2x fa-arrow-circle-left btn-convert-left-to-right" data-id="' + id + '" onclick="unCheckFoodTakeAway($(this))"></i>',
        'action': '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  data-id="' + id + '" onclick="unCheckFoodTakeAway($(this))"><i class="fi-rr-arrow-small-left"></i></button></div>',
    };
    addRowDatatableTemplate(drawSelectedTakeAwayBranch, item);
    drawAllTakeAwayBranch.row(r.parents('tr')).remove().draw(false);
}

async function unCheckFoodTakeAway(r) {
    let item = {
        // 'action': '<i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right" onclick="checkFoodTakeAway($(this))" data-id="' + r.data('id') + '" ></i>',
        'action': '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  onclick="checkFoodTakeAway($(this))" data-id="' + r.data('id') + '"><i class="fi-rr-arrow-small-right"></i></button></div>',
        'name': r.parents('tr').find('td:eq(1)').html(),
        'amount': r.parents('tr').find('td:eq(2)').text(),
    };
    addRowDatatableTemplate(drawAllTakeAwayBranch, item);
    drawSelectedTakeAwayBranch.row(r.parents('tr')).remove().draw(false);
}

function closeModalUpdateTakeAway() {
    shortcut.remove('F4');
    shortcut.remove('ESC');
    $('#modal-update-take-away').modal('hide');
}


