let drawAllTakeAwayBrand,
    drawSelectedTakeAwayBrand;

async function openModalUpdateTakeAwayBrand() {
    $('#modal-update-take-away-brand').modal('show');
    shortcut.add('F4', function () {
        saveModalUpdateTakeAway();
    });
    shortcut.add('ESC', function () {
        closeModalUpdateTakeAwayBrand();
    });
    dataUpdateTakeAwayBrand();
}

async function dataUpdateTakeAwayBrand() {
    let method = 'get',
        url = 'take-away-brand.data-update',
        params = {
            brand: $('.select-brand').val(),
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data,[
        $("#table-all-take-away"),
        $("#table-selected-take-away")
    ]);
    dataTableAllTakeAway(res);
}

async function dataTableAllTakeAway(data) {
    let table_all = $('#table-all-take-away'),
        table_selected = $('#table-selected-take-away'),
        scroll_Y = '45vh',
        fixed_left = 0,
        fixed_right = 0,
        column_all = [
            {data: 'name', name: 'name'},
            {data: 'amount', name: 'amount', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ],
        column_selected = [
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name'},
            {data: 'amount', name: 'amount', className: 'text-center'},
        ],
        option = []
    drawAllTakeAwayBrand = await DatatableTemplateNew(table_all, data.data[0].original.data , column_all, scroll_Y, fixed_left, fixed_right,option);
    drawSelectedTakeAwayBrand = await DatatableTemplateNew(table_selected, data.data[1].original.data , column_selected, scroll_Y, fixed_left, fixed_right,option);
}



async function saveModalUpdateTakeAway() {
    let foods = [];
    await drawSelectedTakeAwayBrand.rows().every(function () {
        let row = $(this.node());
        foods.push(row.find('td:eq(0)').find('button').data('id'));
    });
    let method = 'post',
        url = 'take-away-brand.update',
        params = null,
        data = {
            brand: $('.select-brand').val(),
            foods: foods
        };
    let res = await axiosTemplate(method, url, params, data);
    let text = '';
    switch(res.data.status) {
        case 200:
            text = $('#success-update-data-to-server').text();
            SuccessNotify(text);
            closeModalUpdateTakeAwayBrand();
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

function itemBrandDraw(row) {
    return {
        // 'action': '<i class="fa fa-2x fa-arrow-circle-left btn-convert-left-to-right" data-id="' + row.find('td:eq(2)').find('i').data('id') +'" data-name="'+ row.find('td:eq(2)').text() +'" data-avatar="'+ row.find('td:eq(1)').find('img').attr('src') +'" data-amount="' + row.find('td:eq(3)').text() + '" onclick="unCheckFoodTakeAway($(this))"></i>',
        'action': '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  data-id="' + row.find('td:eq(2)').find('button').data('id') +'" data-name="'+ row.find('td:eq(2)').text() +'" data-avatar="'+ row.find('td:eq(1)').find('img').attr('src') +'" data-amount="' + row.find('td:eq(3)').text() + '" onclick="unCheckFoodTakeAway($(this))"><i class="fi-rr-arrow-small-left"></i></button></div>',
        'avatar': '<label><img src="'+  row.find('td:eq(0)').find('img').attr('src') +'" class="img-data-table" onclick="modalImageComponent('+  row.find('td:eq(1)').find('img').attr('src') +')"></label><input value="'+ row.data('id') +'" class="d-none">',
        'name': row.find('td:eq(0)').html(),
        'amount': row.find('td:eq(1)').text(),
    };
}
async function checkAllFoodTakeAwayBrand() {
    await addAllRowDatatableTemplate(drawAllTakeAwayBrand, drawSelectedTakeAwayBrand, itemBrandDraw);
    drawSelectedTakeAwayBrand.page('last').draw(false);
    $(drawSelectedTakeAwayBrand.table().node()).parent().scrollTop($(drawSelectedTakeAwayBrand.table().node()).parent().get(0).scrollHeight);
}

function itemSelectBrandDraw(row) {
    return {
        // 'action': '<i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right" data-id="' + row.find('td:eq(0)').find('i').data('id') +'" onclick="checkFoodTakeAway($(this))"></i>',
        'action': '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  data-id="' + row.find('td:eq(0)').find('button').data('id') +'" onclick="checkFoodTakeAway($(this))"><i class="fi-rr-arrow-small-right"></i></button></div>',
        'avatar': '<label><img src="'+  row.find('td:eq(1)').find('img').attr('src') +'" class="img-data-table" onclick="modalImageComponent('+  row.find('td:eq(1)').find('img').attr('src') +')"></label><input value="'+ row.data('id') +'" class="d-none">',
        'name': row.find('td:eq(1)').html(),
        'amount': row.find('td:eq(2)').text(),
    };
}
async function unCheckAllFoodTakeAwayBrand() {
    await addAllRowDatatableTemplate(drawSelectedTakeAwayBrand, drawAllTakeAwayBrand, itemSelectBrandDraw);
    drawAllTakeAwayBrand.page('last').draw(false);
    $(drawAllTakeAwayBrand.table().node()).parent().scrollTop($(drawAllTakeAwayBrand.table().node()).parent().get(0).scrollHeight);
}

async function checkFoodTakeAway(r){
    addRowDatatableTemplate(drawSelectedTakeAwayBrand, {
        // 'action': '<i class="fa fa-2x fa-arrow-circle-left btn-convert-left-to-right" data-id="' +  r.data('id') +'" onclick="unCheckFoodTakeAway($(this))"></i>',
        'action': '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  data-id="' +  r.data('id') +'" onclick="unCheckFoodTakeAway($(this))"><i class="fi-rr-arrow-small-left"></i></button></div>',
        'name': r.parents('tr').find('td:eq(0)').html(),
        'amount': r.parents('tr').find('td:eq(1)').text(),
    });
    drawAllTakeAwayBrand.row(r.parents('tr')).remove().draw(false);
}
async function unCheckFoodTakeAway(r){
    addRowDatatableTemplate(drawAllTakeAwayBrand, {
        // 'action': '<i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right"  onclick="checkFoodTakeAway($(this))" data-id="' +  r.data('id') + '"></i>',
        'action': '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  onclick="checkFoodTakeAway($(this))" data-id="' +  r.data('id') + '"><i class="fi-rr-arrow-small-right"></i></button></div>',
        'name': r.parents('tr').find('td:eq(1)').html(),
        'amount': r.parents('tr').find('td:eq(2)').text(),
    });
    drawSelectedTakeAwayBrand.row(r.parents('tr')).remove().draw(false);
}

function closeModalUpdateTakeAwayBrand() {
    $('#modal-update-take-away-brand').modal('hide');
    shortcut.remove('F4');
    shortcut.remove('ESC');
}


