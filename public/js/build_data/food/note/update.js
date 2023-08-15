let tableDisSelectedUpdateNoteFoodData, tableSelectedUpdateNoteFoodData, idUpdateNoteFoodData, brandUpdateNoteFoodData,
    dataAllFoodUpdateNoteFoodData, dataUpdateNoteFoodData, checkDataFoodNoteData = 0,
    checkSaveDataFoodNoteData = 0, dataCategoryNameUpdate = '', categoryTypeUpdate,
    nameUpdateNoteFoodData;

async function openModalUpdateNoteFoodData(r) {
    $('#modal-update-note-food-data').modal('show');
    shortcut.add('F4', function () {
        saveModalUpdateNoteFoodData();
    });
    shortcut.add('ESC', function () {
        closeModalUpdateNoteFoodData();
    });
    $('.select-category-name-note-food-update').select2({
        dropdownParent: $('#modal-update-note-food-data'),
    });
    $('.select-category-name-note-food-update').val(-1).trigger('change.select2')
    getCategoryNameDataUpdate()
    $('.select-category-name-note-food-update').on('select2:select', function () {
        $('.select-category-name-note-food-update').val($(this).val()).trigger('change.select2');
        categoryTypeUpdate = $(this).val();
        dataFoodNoteFoodData();
    });
    nameUpdateNoteFoodData = r.data('name');
    idUpdateNoteFoodData = r.data('id');
    brandUpdateNoteFoodData = r.data('brand');
    $('#name-update-note-food-data').val(nameUpdateNoteFoodData);
    checkSaveDataFoodNoteData = 0;
    dataFoodNoteFoodData();
}

async function getCategoryNameDataUpdate() {
    if (dataCategoryNameUpdate !== '') {
        await $('.select-category-name-note-food-update').html(dataCategoryNameUpdate);
    } else {
        let method = 'get',
            url = 'note-food-data.category',
            brand = $('.select-brand-note-food').val(),
            params = {brand: brand},
            data = null;
        let res = await axiosTemplate(method, url, params, data);
        await $('.select-category-name-note-food-update').html(res.data[0]);
        dataCategoryNameUpdate = res.data[0];
    }
}

async function dataFoodNoteFoodData() {
        let method = 'get',
            url = 'note-food-data.data-food-update',
            brand = $('.select-brand-note-food').val(),
            params = {
                brand: brand,
                category_id: categoryTypeUpdate,
                id: idUpdateNoteFoodData
            },
            data = null;
        let res = await axiosTemplate(method, url, params, data);
        checkDataFoodNoteData = 1;
        dataTableSelectedUpdateNoteFoodData(res.data[1].original.data);
        dataTableUpdateNoteFoodData(res.data[0].original.data);
        dataAllFoodUpdateNoteFoodData = res.data[0].original.data;
}

async function dataTableUpdateNoteFoodData(data) {
    let id = $('#table-dis-select-update-note-food-data'),
        column = [
            {data: 'avatar', name: 'avatar', width: '5%', className: 'text-left'},
            {data: 'category_name', name: 'category_name', className: 'text-left'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch',name:'keysearch',className:'d-none'}
        ],
        scroll_Y = "30vh",
        fixed_left = 0,
        fixed_right = 2,
        option = [];
    tableDisSelectedUpdateNoteFoodData = await DatatableTemplateNew(id, data, column, scroll_Y, fixed_left, fixed_right, option, '', false);
}

async function dataTableSelectedUpdateNoteFoodData(data) {
    let id = $('#table-select-update-note-food-data'),
        column = [
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'avatar', name: 'avatar', width: '5%', className: 'text-left'},
            {data: 'category_name', name: 'category_name', className: 'text-left'},
            {data: 'keysearch',name:'keysearch',className:'d-none'}
        ],
        scroll_Y = "30vh",
        fixed_left = 2,
        fixed_right = 0,
        option = [];
    tableSelectedUpdateNoteFoodData = await DatatableTemplateNew(id, data, column, scroll_Y, fixed_left, fixed_right, option, '', false);
}

async function selectAllUpdateNoteFoodData() {
    await addAllRowDatatableTemplate(tableDisSelectedUpdateNoteFoodData, tableSelectedUpdateNoteFoodData, itemUpdateFoodUnCheckData);
    tableSelectedUpdateNoteFoodData.page('last').draw(false);
    $(tableSelectedUpdateNoteFoodData.table().node()).parent().scrollTop($(tableSelectedUpdateNoteFoodData.table().node()).parent().get(0).scrollHeight);
}

async function unSelectAllUpdateNoteFoodData() {
    await addAllRowDatatableTemplate(tableSelectedUpdateNoteFoodData, tableDisSelectedUpdateNoteFoodData, itemUpdateFoodCheckData);
    tableDisSelectedUpdateNoteFoodData.page('last').draw(false);
    $(tableDisSelectedUpdateNoteFoodData.table().node()).parent().scrollTop($(tableDisSelectedUpdateNoteFoodData.table().node()).parent().get(0).scrollHeight);
}

function itemUpdateFoodUnCheckData(r) {
    return {
        'action': `<div class="btn-group btn-group-sm">
                        <button type="button"
                                class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                data-id=" ${r.find('td:eq(2)').find('button').data('id')}" data-name=" ${r.find('td:eq(2)').find('button').data('name')}" data-type="${r.find('td:eq(2)').find('button').data('type')}" data-category=" ${r.find('td:eq(2)').find('button').data('category')} "
                                data-avatar=" ${r.find('td:eq(2)').find('button').data('avatar')} " onclick="disSelectUpdateNoteFoodData($(this))"
                                >
                            <i class="fi-rr-arrow-small-left"></i>
                        </button>
                    </div>`,
        'avatar': '<div><img onerror="imageDefaultOnLoadError($(this))" src="' + r.find('td:eq(2)').find('button').data('avatar') + '" class="img-inline-name-data-table" onclick="modalImageComponent(' + r.find('td:eq(2)').find('button').data('avatar') + ')" style="object-fit:cover;"/>' + r.find('td:eq(0)').text() + '</div>',
        'category_name': r.find('td:eq(1)').text(),
        'keysearch':r.parents('tr').find('td:eq(4)').text()
    };
}
function itemUpdateFoodCheckData(r) {
    return {
        'avatar': '<div><img onerror="imageDefaultOnLoadError($(this))" src="' + r.find('td:eq(0)').find('button').data('avatar') + '" class="img-inline-name-data-table" onclick="modalImageComponent(' + r.find('td:eq(0)').find('button').data('avatar') + ')" style="object-fit:cover;"/>' + r.find('td:eq(1)').text() + '</div>',
        'category_name': r.find('td:eq(2)').text(),
        'action': `<div class="btn-group btn-group-sm">
                        <button type="button"
                                class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                data-id=" ${r.find('td:eq(0)').find('button').data('id')}  " data-name=" ${r.find('td:eq(0)').find('button').data('name')}  " data-category=" ${r.find('td:eq(0)').find('button').data('category')} "
                                data-avatar=" ${r.find('td:eq(0)').find('button').data('avatar')} " data-type="${r.find('td:eq(0)').find('button').data('type')}" onclick="selectUpdateNoteFoodData($(this))"
                                >
                            <i class="fi-rr-arrow-small-right"></i>
                        </button>
                    </div>`,
        'keysearch':r.parents('tr').find('td:eq(4)').text()
    };
}

async function selectUpdateNoteFoodData(r) {
    tableDisSelectedUpdateNoteFoodData.row(r.parents('tr')).remove().draw(false);
    addRowDatatableTemplate(tableSelectedUpdateNoteFoodData, {
        'avatar': '<div><img  onerror="imageDefaultOnLoadError($(this))" src="' + r.data('avatar') + '" class="img-inline-name-data-table" onclick="modalImageComponent(' + r.data('avatar') + ')" style="object-fit:cover;"/>' + r.data('name') + '</div>',
        'category_name': r.data('category'),
        'action': `<div class="btn-group btn-group-sm">
                        <button type="button"
                                class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                data-id="${r.data('id')}" data-name="${r.data('name')}" data-category=" ${r.data('category')} "
                                data-avatar=" ${ r.data('avatar')} " data-type="${r.data('type')}" onclick="disSelectUpdateNoteFoodData($(this))"
                                >
                            <i class="fi-rr-arrow-small-left"></i>
                        </button>
                    </div>`,
        'keysearch':r.parents('tr').find('td:eq(4)').text()
    });
}

async function disSelectUpdateNoteFoodData(r) {
    tableSelectedUpdateNoteFoodData.row(r.parents('tr')).remove().draw(false);
    addRowDatatableTemplate(tableDisSelectedUpdateNoteFoodData, {
        'action': `<div class="btn-group btn-group-sm">
                        <button type="button"
                                class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                data-id=" ${r.data('id')}  " data-name=" ${r.data('name')}  " data-category=" ${r.data('category')} "
                                data-avatar=" ${ r.data('avatar')} " data-type="${r.data('type')}" onclick="selectUpdateNoteFoodData($(this))">
                            <i class="fi-rr-arrow-small-right"></i>
                        </button>
                    </div>`,
        'avatar': '<div><img onerror="imageDefaultOnLoadError($(this))" src="' + r.data('avatar') + '" class="img-inline-name-data-table" onclick="modalImageComponent(' + r.data('avatar') + ')" style="object-fit:cover;"/>' + r.data('name') + '</div>',
        'category_name': r.data('category'),
        'keysearch':r.parents('tr').find('td:eq(4)').text()
    });
}

async function saveModalUpdateNoteFoodData() {
    if (checkSaveDataFoodNoteData === 1) return false;
    if (!checkValidateSave($('#modal-update-note-food-data'))) return false;
    let totalRowTableSelectedUpdateNoteFoodData = tableSelectedUpdateNoteFoodData.data().count();
    let totalRowTableDisSelectedUpdateNoteFoodData = tableDisSelectedUpdateNoteFoodData.data().count();
    let food_insert = [], food_delete = [],
        note = $('#name-update-note-food-data').val();
    await tableSelectedUpdateNoteFoodData.rows().every(function () {
        let x = $(this.node());
        if (x.find('td:eq(0)').find('button').data('type') === 0) {
            food_insert.push(x.find('td:eq(0)').find('button').data('id'));
        }
    });
    await tableDisSelectedUpdateNoteFoodData.rows().every(function () {
        let x = $(this.node());
        if (x.find('td:eq(2)').find('button').data('type') === 1) {
            food_delete.push(x.find('td:eq( 2)').find('button').data('id'));
        }
    });
    checkSaveDataFoodNoteData = 1;
    let method = 'post',
        url = 'note-food-data.update',
        params = null,
        data = {
            brand: brandUpdateNoteFoodData,
            id: idUpdateNoteFoodData,
            note: note,
            food_insert: food_insert,
            food_delete: food_delete,
        };
    if(nameUpdateNoteFoodData == note
       && totalRowTableSelectedUpdateNoteFoodData - (totalRowTableSelectedUpdateNoteFoodData - food_insert.length) == 0
       && totalRowTableDisSelectedUpdateNoteFoodData - (totalRowTableDisSelectedUpdateNoteFoodData - food_delete.length) == 0) {
        SuccessNotify($('#success-update-data-to-server').text());
        checkSaveDataFoodNoteData = 0;
        closeModalUpdateNoteFoodData();
        return false;
    }
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-update-note-food-data')]);
    checkSaveDataFoodNoteData = 0;
    let text = '';
    switch(res.data[0].status && res.data[1].status) {
        case 200:
            text = $('#success-update-data-to-server').text();
            SuccessNotify(text);
            closeModalUpdateNoteFoodData();
            loadData();
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            if (res.data[1].message !== null) {
                text = res.data[1].message;
            }
            ErrorNotify(text);
            break;
        default:
            text = $('#error-post-data-to-server').text();
            if (res.data[1].message !== null) {
                text = res.data[1].message;
            }
            WarningNotify(text);
    }
}

function closeModalUpdateNoteFoodData() {
    shortcut.remove('F4');
    shortcut.remove('ESC');
    $('#modal-update-note-food-data').modal('hide');
    resetModalUpdateNoteFoodData();
}

function resetModalUpdateNoteFoodData() {
    $('#name-update-note-food-data').val('');
    $('#check-all-update-note-food-data').prop('checked', false);
    $('.select-category-name-note-food-update').val(-1).trigger('change.select2')
}
