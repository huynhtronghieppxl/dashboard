let idComboFoodManage,
    branchComboFoodManage,
    dataAllComboFoodManage,
    dataSelectedComboFoodManage,
    drawAllComboFoodManage,
    drawSelectedComboFoodManage,
    saveComboFoodManage;

function openModalUpdateComboFoodManage(r) {
    $('#modal-combo-food-manage').modal('show');
    addLoading('food-manage.data-for-action', '#loading-modal-combo-food-manage');
    addLoading('food-brand-manage.data-combo', '#loading-modal-combo-food-manage');
    addLoading('food-brand-manage.combo', '#loading-modal-combo-food-manage');
    shortcut.remove('F2');
    shortcut.remove('F3');
    shortcut.add('F4', function () {
        saveModalComboFoodManage();
    });
    shortcut.add('ESC', function () {
        closeModalComboFoodManage();
    });
    idComboFoodManage = r.data('id');
    dataComboFoodManage();
}

async function dataComboFoodManage() {
    let method = 'get',
        url = 'food-brand-manage.data-combo',
        params = {
            id: idComboFoodManage,
            brand: $('.select-brand').val()
        },
        data = {};
    let res = await axiosTemplate(method, url, params, data);

    dataAllComboFoodManage = res.data[0].original.data;
    dataSelectedComboFoodManage = res.data[1].original.data;
    dataTableAllComboFoodManage(res.data[0].original.data);
    dataTableSelectedComboFoodManage(res.data[1].original.data);
}

async function dataTableAllComboFoodManage(data) {
    let id = $('#table-all-combo-food-manage'),
        scroll_Y = '45vh',
        fixed_left = 0,
        fixed_right = 0,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'avatar', name: 'avatar', className: 'text-center'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'category_name', name: 'category_name', className: 'text-center'},
            {data: 'amount', name: 'amount', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},

        ];
    drawAllComboFoodManage = await DatatableFullSizeTemplate(id, data, columns, scroll_Y, fixed_left, fixed_right);
}

async function dataTableSelectedComboFoodManage(data) {
    let id = $('#table-selected-combo-food-manage'),
        scroll_Y = '45vh',
        fixed_left = 0,
        fixed_right = 0,
        columns = [
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'avatar', name: 'avatar', className: 'text-center'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'category_name', name: 'category_name', className: 'text-center'},
            {data: 'amount', name: 'amount', className: 'text-center'},
            {data: 'quantity', name: 'quantity', className: 'text-center',width: '1%'},
        ];
    drawSelectedComboFoodManage = await DatatableFullSizeTemplate(id, data, columns, scroll_Y, fixed_left, fixed_right);
}

async function checkComboFoodManage() {
    dataSelectedComboFoodManage = [];
    await drawAllComboFoodManage.rows().every(function (index, element) {
        let row = $(this.node());
        if (row.find('td:eq(1)').find('input').is(':checked') === true) {
            let item = {
                'id': row.find('td:eq(1)').find('input').val(),
                'name': row.find('td:eq(1)').find('input').data('name'),
                'category_name': row.find('td:eq(1)').find('input').data('category'),
                'avatar': '<label><img src="' + row.find('td:eq(1)').find('input').data('avatar') + '" class="img-data-table" onclick="modalImageComponent(' + "'" + row.find('td:eq(1)').find('input').data('avatar') + "'" + ')"/></label><input value="' + row.find('td:eq(1)').find('input').val() + '" class="d-none"/>',
                'amount': row.find('td:eq(1)').find('input').data('amount'),
                'quantity': '<input data-value="'+ row.find('td:eq(1)').find('input').data('id')+ '" value="1" data-type="currency-edit" class="text-center">',
                'DT_RowIndex': dataSelectedComboFoodManage.length + 1,
            };
            dataSelectedComboFoodManage.push(item);
        }
    });
    dataTableSelectedComboFoodManage(dataSelectedComboFoodManage);
}

async function saveModalComboFoodManage() {
    let foods = [];
    await drawSelectedComboFoodManage.rows().every(function () {
        let row = $(this.node());
        foods.push({
            "id": row.find('td:eq(1)').find('input').val(),
            "quantity": row.find('td:eq(5)').find('input').val(),
        });
    });
    // saveComboFoodManage = 1;
    let method = 'post',
        url = 'food-brand-manage.combo',
        params = null,
        data = {
            id: idComboFoodManage,
            restaurant_brand_id: $('.select-brand').val(),
            foods: foods};
    let res = await axiosTemplate(method, url, params, data);
    if (res.data.status === 200) {
        let text = $('#success-combo-data-to-server').text();
        SuccessNotify(text);
        $('#modal-combo-food-manage').modal('hide');
        loadData();
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
    }
}

async function checkSelectCombolData(r) {
    let item = {
        'action': '<i class="fa fa-2x fa-arrow-circle-left btn-convert-left-to-right" onclick="unSelectCombolData($(this))" data-id="'+ r.data('id') +'"></i>',
        'avatar': '<label><img src="'+ r.parents('tr').find('td:eq(1)').find('img').data("src") +'" class="img-data-table" onclick="modalImageComponent()"></label>',
        'name': r.parents('tr').find('td:eq(2)').text(),
        'category_name': r.parents('tr').find('td:eq(3)').text(),
        'amount': r.parents('tr').find('td:eq(4)').text(),
        'quantity': '1',
    };
    addRowDatatableTemplate(drawSelectedComboFoodManage, item);
    drawAllComboFoodManage.row(r.parents('tr')).remove().draw(false);
}
async function unSelectCombolData(r) {
    let item = {
        'avatar': '<label><img src="'+ r.parents('tr').find('td:eq(1) lable img').data("src") +'" class="img-data-table" onclick="modalImageComponent()"></label>',
        'name': r.parents('tr').find('td:eq(2)').text(),
        'category_name': r.parents('tr').find('td:eq(3)').text(),
        'amount': r.parents('tr').find('td:eq(4)').text(),
        'action': '<i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right pointer" onclick="unSelectCombolData($(this))" data-id="'+ r.data('id') +'"></i>',
    };
    addRowDatatableTemplate(drawAllComboFoodManage , item);
    drawSelectedComboFoodManage.row(r.parents('tr')).remove().draw(false);
}

function closeModalComboFoodManage() {
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function () {
        openModalCreateFoodManage();
    });
    shortcut.add('F3', function () {
        openModalUploadImgFoodManage();
    });
    $('#modal-combo-food-manage').modal('hide');
}
