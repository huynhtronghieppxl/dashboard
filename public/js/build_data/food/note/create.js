let tableDisSelectedCreateNoteFoodData, tableSelectedCreateNoteFoodData, checkSaveNoteFoodData = 0,
    idCategoryNoteFoodData = $('.select-category-name-note-food').find(':selected').val(),
    dataCategoryName = '';

function openModalCreateNoteFoodData() {
    $('#modal-create-note-food-data').modal('show');
    shortcut.remove("F2");
    shortcut.add('F4', function () {
        saveModalCreateNoteFoodData();
    });
    shortcut.add('ESC', function () {
        closeModalCreateNoteFoodData();
    });
    dataFoodCreateNoteFoodData();
    $('.select-category-name-note-food').on('select2:select', function () {
        $('.select-category-name-note-food').val($(this).val()).trigger('change.select2');
        idCategoryNoteFoodData = $(this).val();
        dataFoodCreateNoteFoodData();
    });
    getCategoryNameDataIndex();
    $('.select-category-name-note-food').select2({
        dropdownParent: $('#modal-create-note-food-data'),
    });

    $('#modal-create-note-food-data').on('keyup', function () {
        $('#modal-create-note-food-data .btn-renew').removeClass('d-none')
    })
}

async function getCategoryNameDataIndex() {
    if (dataCategoryName !== '') {
        await $('.select-category-name-note-food').html(dataCategoryName);
    } else {
        let method = 'get',
            url = 'note-food-data.category',
            brand = $('.select-brand-note-food').val(),
            params = {brand: brand},
            data = null;
        let res = await axiosTemplate(method, url, params, data);
        await $('.select-category-name-note-food').html(res.data[0]);
        await $('.select-category-name-note-food-update').html(res.data[0]);
        dataCategoryName = res.data[0];
    }
}

async function dataFoodCreateNoteFoodData() {
    let method = 'get',
        url = 'note-food-data.data-food',
        brand = $('.select-brand-note-food').val(),
        params = {brand: brand, category_id: idCategoryNoteFoodData},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-dis-select-note-food-data'), $('#table-select-note-food-data')]);
    dataTableCreateNoteFoodData(res.data[0].original.data);
}

async function selectNoteFoodData(r) {
    tableDisSelectedCreateNoteFoodData.row(r.parents('tr')).remove().draw(false);
    addRowDatatableTemplate(tableSelectedCreateNoteFoodData, {
        'avatar': '<div><img onerror="imageDefaultOnLoadError($(this))" src="' + r.data('avatar') + '" class="img-inline-name-data-table" onclick="modalImageComponent(' + r.data('avatar') + ')" style="object-fit:cover;"/>' + r.data('name') + '</div>',
        'category_name': r.data('category'),
        'action': `<div class="btn-group btn-group-sm">
                        <button type="button"
                                class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                data-id=" ${r.data('id')}  " data-name=" ${r.data('name')}  " data-category=" ${r.data('category')} "
                                data-avatar=" ${r.data('avatar')} " onclick="disSelectNoteFoodData($(this))"
                                >
                            <i class="fi-rr-arrow-small-left"></i>
                        </button>
                    </div>`,
        'keysearch':r.parents('tr').find('td:eq(4)').text()
    });
    $('#modal-create-note-food-data .btn-renew').removeClass('d-none')
}
async function disSelectNoteFoodData(r) {
    tableSelectedCreateNoteFoodData.row(r.parents('tr')).remove().draw(false);
    addRowDatatableTemplate(tableDisSelectedCreateNoteFoodData, {
        'action': `<div class="btn-group btn-group-sm">
                        <button type="button"
                                class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                data-id=" ${r.data('id')}  " data-name=" ${r.data('name')}  " data-category=" ${r.data('category')} "
                                data-avatar=" ${r.data('avatar')} " onclick="selectNoteFoodData($(this))"
                                >
                            <i class="fi-rr-arrow-small-right"></i>
                        </button>
                    </div>`,
        'avatar': '<div><img onerror="imageDefaultOnLoadError($(this))" src="' + r.data('avatar') + '" class="img-inline-name-data-table" onclick="modalImageComponent(' + r.data('avatar') + ')" style="object-fit:cover;"/>' + r.data('name') + '</div>',
        'category_name': r.data('category'),
        'keysearch':r.parents('tr').find('td:eq(4)').text()
    });
}

function itemFoodUnCheckData(r) {
    return {
        'action': `<div class="btn-group btn-group-sm">
                        <button type="button"
                                class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                data-id=" ${r.find('td:eq(2)').find('button').data('id')}  " data-name=" ${r.find('td:eq(2)').find('button').data('name')}  " data-category=" ${r.find('td:eq(2)').find('button').data('category')} "
                                data-avatar=" ${r.find('td:eq(2)').find('button').data('avatar')} " onclick="disSelectNoteFoodData($(this))"
                                >
                            <i class="fi-rr-arrow-small-left"></i>
                        </button>
                    </div>`,
        'avatar': '<div><img onerror="imageDefaultOnLoadError($(this))" src="' + r.find('td:eq(2)').find('button').data('avatar') + '" class="img-inline-name-data-table" onclick="modalImageComponent(' + r.find('td:eq(2)').find('button').data('avatar') + ')" style="object-fit:cover;"/>' + r.find('td:eq(0)').text() + '</div>',
        'category_name': r.find('td:eq(1)').text(),
        'keysearch':r.parents('tr').find('td:eq(4)').text()
    };
}
function itemFoodCheckData(r) {
    return {
        'avatar': '<div><img onerror="imageDefaultOnLoadError($(this))" src="' + r.find('td:eq(0)').find('button').data('avatar') + '" class="img-inline-name-data-table" onclick="modalImageComponent(' + r.find('td:eq(0)').find('button').data('avatar') + ')" style="object-fit:cover;"/>' + r.find('td:eq(1)').text() + '</div>',
        'category_name': r.find('td:eq(2)').text(),
        'action': `<div class="btn-group btn-group-sm">
                        <button type="button"
                                class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                data-id=" ${r.find('td:eq(0)').find('button').data('id')}  " data-name=" ${r.find('td:eq(0)').find('button').data('name')}  " data-category=" ${r.find('td:eq(0)').find('button').data('category')} "
                                data-avatar=" ${r.find('td:eq(0)').find('button').data('avatar')} " onclick="selectNoteFoodData($(this))"
                                >
                            <i class="fi-rr-arrow-small-right"></i>
                        </button>
                    </div>`,
        'keysearch':r.parents('tr').find('td:eq(4)').text()
    };
}

async function selectAllNoteFoodData(){
    $('#modal-create-note-food-data .btn-renew').removeClass('d-none')
    await addAllRowDatatableTemplate(tableDisSelectedCreateNoteFoodData, tableSelectedCreateNoteFoodData, itemFoodUnCheckData);
    tableSelectedCreateNoteFoodData.page('last').draw(false);
    $(tableSelectedCreateNoteFoodData.table().node()).parent().scrollTop($(tableSelectedCreateNoteFoodData.table().node()).parent().get(0).scrollHeight);
}
async function unSelectAllNoteFoodData(){
    await addAllRowDatatableTemplate(tableSelectedCreateNoteFoodData, tableDisSelectedCreateNoteFoodData, itemFoodCheckData);
    tableDisSelectedCreateNoteFoodData.page('last').draw(false);
    $(tableDisSelectedCreateNoteFoodData.table().node()).parent().scrollTop($(tableDisSelectedCreateNoteFoodData.table().node()).parent().get(0).scrollHeight);
}


async function dataTableCreateNoteFoodData(data) {
    let idTableCreateDisSelectNoteFood = $('#table-dis-select-note-food-data'),
        idTableCreateSelectNoteFood = $('#table-select-note-food-data'),
        column1 = [
            {data: 'avatar', name: 'avatar', width: '5%', className: 'text-left'},
            {data: 'category_name', name: 'category_name', className: 'text-left'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch',name:'keysearch',className:'d-none'}
        ],
        column2 = [
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'avatar', name: 'avatar', width: '5%', className: 'text-left'},
            {data: 'category_name', name: 'category_name', className: 'text-left'},
            {data: 'keysearch',name:'keysearch',className:'d-none'}
        ],
        scroll_Y = "30vh",
        fixed_left = 0,
        fixed_right = 0,
        option =  [];
    tableDisSelectedCreateNoteFoodData = await DatatableTemplateNew(idTableCreateDisSelectNoteFood, data, column1, scroll_Y, fixed_left, 2, option, '', false);
    tableSelectedCreateNoteFoodData = await DatatableTemplateNew(idTableCreateSelectNoteFood, [], column2, scroll_Y, fixed_left, fixed_right, option, '', false);
}

async function saveModalCreateNoteFoodData() {
    if(checkSaveNoteFoodData === 1) return false;
    if(!checkValidateSave($('#modal-create-note-food-data'))) return false;
    let food_insert = [], brand = $('.select-brand-note-food').val(),
        note = $('#name-create-note-food-data').val();
    await tableSelectedCreateNoteFoodData.rows().every(function () {
        let x = $(this.node());
        food_insert.push(x.find('td:eq(0)').find('button').data('id'));
    });
    checkSaveNoteFoodData = 1;
    let method = 'post',
        url = 'note-food-data.create',
        params = null,
        data = {
            brand: brand,
            note: note,
            food_insert: food_insert,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-create-note-food-data')]);
    checkSaveNoteFoodData = 0;
    let text = '';
    if(res.data[0].status === 200){
        text = $('#success-create-data-to-server').text();
        SuccessNotify(text);
        addRowDatatableTemplate(dataTableNoteFoodDataEnable, {
            'note': note,
            'count' : food_insert.length,
            'action': `<div class="btn-group btn-group-sm">
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusNoteFoodData($(this))" data-id="${res.data[0].data.id}" data-toggle="tooltip" data-placement="top" data-original-title="Tạm ngưng"><i class="fi-rr-cross"></i></button>
                             <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" data-id="${res.data[0].data.id}" data-name="${note}" data-brand="${brand}" onclick="openModalUpdateNoteFoodData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Chỉnh sửa"><i class="fi-rr-pencil"></i></button>
                        </div>`,
            'keysearch': combineKeySearch(note,food_insert.length),
        });
        $('#total-record-enable').text(Number($('#total-record-enable').text()) + 1);
        closeModalCreateNoteFoodData();
    }else {
        let text = $('#error-post-data-to-server').text();
        if (res.data[0].status !== 200 && res.data[0].status !== 500) {
            text = res.data[0].message;
            WarningNotify(text);
        }
        else if (res.data[1].status !== 200 && res.data[1].status !== 500) {
            text = res.data[1].message;
            WarningNotify(text);
        }
        else if (res.data[0].status === 500) {
            text = res.data[0].message;
            ErrorNotify(text);
        }
        else if (res.data[1].status === 500) {
            text = res.data[1].message;
            ErrorNotify(text);
        }
    }
}

function closeModalCreateNoteFoodData() {
    $('#modal-create-note-food-data').modal('hide');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add("F2",function(){
        openModalCreateNoteFoodData();
    });

    dataCategoryName = "";
    resetModalCreateNoteFoodData();
}

function resetModalCreateNoteFoodData() {
    unSelectAllNoteFoodData();
    $('#name-create-note-food-data').val('');
    $('#modal-create-note-food-data .btn-renew').addClass('d-none')
}

function removeDiacritics(str) {
    return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "").replace(/đ/g, 'd').replace(/Đ/g, 'D');
}

function combineKeySearch(content, id) {
    const formattedContent = removeDiacritics(content.replace(/\s+/g, '').toLowerCase());
    return `${id}${formattedContent}`;
}
