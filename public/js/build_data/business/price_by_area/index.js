let tableBranchFood, tableBranchFoodArea,
    checkSaveAssignFoodBranchArea = 0,
    selectPriceByArea = $('#select-area-table-build-data').val();
$(async function () {
    if(getCookieShared('price-by-area-user-id-' + idSession)){
        let data = JSON.parse(getCookieShared('price-by-area-user-id-' + idSession));
        selectPriceByArea = data.select;
    }

    $(document).on('select2:select', '#select-area-table-build-data',function () {
        selectPriceByArea = $(this).val()
        updateCookiePriceByArea();
        foodDataArea();
    })
    $(document).on('input paste keyup keydown', '.amount-price-by-area-data', function (){
        $('#body-price-by-area-data .toolbar-button-datatable').css({"transition" : "","opacity": "", "pointer-events": ""});
        $(this).parent().removeClass('border-danger')
    })

    if(!$('.select-branch').val()) {
        await updateSessionBrandNew($('.select-brand'));
    }else {
        loadData();
    }
});

async function loadData() {
    await dataFoodAreaBuildData();
    foodDataArea();
}

function updateCookiePriceByArea(){
    saveCookieShared('price-by-area-user-id-' + idSession, JSON.stringify({
        'select' : selectPriceByArea
    }))
}

async function foodDataArea() {
    let area_id = $('#select-area-table-build-data').val(),
        restaurant_brand_id = $('.select-branch').val(),
        branch_id = $('.select-branch').val(),
        method = 'get',
        url = 'price-by-area.food',
        params = {
            area_id: area_id,
            branch_id: branch_id,
            restaurant_brand_id: restaurant_brand_id
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('.page-body')]);
    dataTableBranchFood(res);
    dataTableBranchFoodArea(res);
}

async function dataFoodAreaBuildData() {
    let method = 'get',
        url = 'price-by-area.area',
        branch_id = $('.select-branch').val(),
        params = {
            branch_id: branch_id,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#select-area-table-build-data')]);
    $('#select-area-table-build-data').html(res.data[0]);
    checkHasInSelect(selectPriceByArea, $('#select-area-table-build-data'))
}

async function dataTableBranchFood(data) {
    let idBranchFood = $('#table-branch-food'),
        column = [
            {data: 'food_name', name: 'food_name', className: 'text-left white-space-normal'},
            {data: 'category_name', name: 'category_name', className: 'text-left'},
            {data: 'price', name: 'price', className: 'd-none'},
            {data: 'price', name: 'price', className: 'text-right'},
            {data: 'action', name: 'action', className: 'text-right'},
            {data: 'keysearch' , name:'keysearch', className:'d-none'}
        ],
        fixedLeft = 0,
        fixedRight = 0,
        option = [];
    let vh_of_table_branch=vh_of_table -50
    tableBranchFood = await DatatableTemplateNew(idBranchFood, data.data[0].original.data, column, vh_of_table_branch, fixedLeft, fixedRight, option);
    $('#body-price-by-area-data .toolbar-button-datatable').css({"transition" : "all .2s linear","opacity": "0.5", "pointer-events": "none"});

}

async function dataTableBranchFoodArea(data) {
    let idPriceByArea = $('#table-price-by-area-data'),
        column = [
            {data: 'action', name: 'action', className: 'text-left', width: '10%'},
            {data: 'food_name', name: 'food_name', className: 'text-left white-space-normal'},
            {data: 'category_name', name: 'category_name', className: 'text-left'},
            {data: 'price', name: 'price', className: 'text-right'},
            {data: 'price_by_area', name: 'price_by_area', className: 'text-center'},
            {data: 'action_detail', name: 'action_detail', className: 'text-center'},
            {data: 'keysearch' , name:'keysearch', className:'d-none'}
        ],
        fixedLeft = 0,
        fixedRight = 0,
        option = [{
            'title': 'Cập nhật',
            'icon': 'fa fa-upload',
            'class': '',
            'function': 'saveAssignFoodBranchArea',
        }];
    tableBranchFoodArea = await DatatableTemplateNew(idPriceByArea, data.data[1].original.data, column, vh_of_table, fixedLeft, fixedRight, option);
    $('#select-filter-dataTable-select-area').css({"display" : "flex !important", "right": "160px !important"})

}

async function checkBranchFoodData(r) {
    let item = {
        'id': r.attr('data-id'),
        'food_name': r.parents('tr').find('td:eq(0)').html(),
        'category_name': r.parents('tr').find('td:eq(1)').text(),
        'price': r.parents('tr').find('td:eq(2)').text(),
        'price_by_area': '<div class="input-group border-group validate-table-validate">' +
            '<input value="' + r.parents('tr').find('td:eq(3)').text() + '" data-price="' + r.parents('tr').find('td:eq(3)').text() + '" class="form-control amount-price-by-area-data quantity text-center border-0 w-100" data-min="" data-max="999999999" data-money="1">' + '</div>',
        'action': '<div class="btn-group btn-group-sm">' +
                        '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light" onclick="unCheckBranchFoodData($(this))" data-price="' + r.attr('data-price') + '" data-type="' + r.attr('data-type') + '" data-id="' + r.attr('data-id') + '"><i class="fi-rr-arrow-small-left"></i></button>' +
                '</div>',
        'action_detail' : '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailFoodBrandManage($(this))" data-id="' + r.parent().find('.seemt-btn-hover-blue').data('id') + '" data-type="' + r.parent().find('.seemt-btn-hover-blue').attr('data-type') + '" ' +
            'data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết" ><i class="fi-rr-eye"></i></button>',
        'keysearch':r.parents('tr').find('td:eq(4)').text()
    };
    addRowDatatableTemplate(tableBranchFoodArea, item);
    tableBranchFood.row(r.parents('tr')).remove().draw(false);
    $('#body-price-by-area-data .toolbar-button-datatable').css({"transition" : "","opacity": "", "pointer-events": ""});
}

async function unCheckBranchFoodData(r) {
    console.log(r)
    let item = {
        'id': r.attr('data-id'),
        'food_name': r.parents('tr').find('td:eq(1)').html(),
        'category_name': r.parents('tr').find('td:eq(2)').text(),
        'price': r.parents('tr').find('td:eq(3)').find('input').attr('data-price'),
        'price': r.parents('tr').find('td:eq(4)').find('input').attr('data-price'),
        'action': '<div class="btn-group btn-group-sm">' +
                    '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light"onclick="openModalDetailFoodBrandManage($(this))" data-id="' + r.parents('tr').find('td:eq(5)').find('button').attr('data-id') + '" data-type="' + r.parents('tr').find('td:eq(5)').find('button').attr('data-type') + '" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết" ><i class="fi-rr-eye"></i></button>' +
                    '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  data-action="1" onclick="checkBranchFoodData($(this))" data-price="' + r.attr('data-price') + '" data-type="' + r.attr('data-type') + '" data-id="' + r.attr('data-id') + '"><i class="fi-rr-arrow-small-right"></i></button>' +
                  '</div>',
        'keysearch':r.parents('tr').find('td:eq(4)').text()
    };
    addRowDatatableTemplate(tableBranchFood, item);
    tableBranchFoodArea.row(r.parents('tr')).remove().draw(false);
    $('#body-price-by-area-data .toolbar-button-datatable').css({"transition" : "","opacity": "", "pointer-events": ""});
}

async function checkAllBranchFoodData(r) {
    await addAllRowDatatableTemplate(tableBranchFood, tableBranchFoodArea, itemBranchDraw);
    tableBranchFood.page('last').draw(false);
    $(tableBranchFood.table().node()).parent().scrollTop($(tableBranchFood.table().node()).parent().get(0).scrollHeight);
    $('#body-price-by-area-data .toolbar-button-datatable').css({"transition" : "","opacity": "", "pointer-events": ""});
}

async function unCheckAllBranchFoodData(r) {
    await addAllRowDatatableTemplate(tableBranchFoodArea, tableBranchFood, itemBrandDraw);
    tableBranchFoodArea.page('last').draw(false);
    $(tableBranchFoodArea.table().node()).parent().scrollTop($(tableBranchFoodArea.table().node()).parent().get(0).scrollHeight);
    $('#body-price-by-area-data .toolbar-button-datatable').css({"transition" : "","opacity": "", "pointer-events": ""});
}

function itemBranchDraw(row) {
    return {
        'id': row.find('td:eq(4)').find('div').find('button').attr('data-id'),
        'food_name': row.find('td:eq(0)').html(),
        'category_name': row.find('td:eq(1)').text(),
        'price': row.find('td:eq(2)').text(),
        'price_by_area': '<div class="input-group border-group validate-table-validate">' +
            '<input value="' + row.find('td:eq(3)').text() + '" data-price="' + row.find('td:eq(3)').text() + '" class="form-control quantity text-center border-0 w-100" data-min="0" data-max="999999999" data-money="1">' + '</div>',
        'action': '<div class="btn-group btn-group-sm">' +
                    '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  onclick="unCheckBranchFoodData($(this))" data-price="' + row.find('td:eq(4)').find('div').find('button').attr('data-price') + '" data-type="'+ row.find('td:eq(4)').find('button:eq(1)').attr('data-type') +'" data-id="' + row.find('td:eq(4)').find('div').find('button').attr('data-id') + '"><i class="fi-rr-arrow-small-left"></i></button>' +
                '</div>',
        'action_detail' : '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailFoodBrandManage($(this))" data-id="' + row.find('td:eq(4)').find('button:eq(1)').attr('data-id') + '" data-type="' + row.find('td:eq(4)').find('button:eq(1)').attr('data-type') + '" data-toggle="tooltip" data-placement="top" ' +
            'data-original-title="Chi tiết" ><i class="fi-rr-eye"></i></button>',
        'keysearch':row.parents('tr').find('td:eq(5)').text()
    }
}

function itemBrandDraw(row) {
    // console.log(row, row.find('td:eq(0)').find('button:eq(0)'))
    return {
        'id': row.find('td:eq(0)').find('div').find('button').attr('data-id'),
        'food_name': row.find('td:eq(1)').html(),
        'category_name': row.find('td:eq(2)').text(),
        'price': row.find('td:eq(4)').find('input').attr('data-price'),
        'action': '<div class="btn-group btn-group-sm">' +
                    '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailFoodBrandManage($(this))" data-id="' + row.find('td:eq(5)').find('button').attr('data-id') + '" data-type="' + row.find('td:eq(5)').find('button').attr('data-type') + '" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết" ><i class="fi-rr-eye"></i></button>' +
                    '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light" onclick="checkBranchFoodData($(this))" data-price="' + row.find('td:eq(0)').find('div').find('button').attr('data-price') + '" data-type="' + row.find('td:eq(0)').find('button:eq(0)').attr('data-type') + '" data-id="' + row.find('td:eq(0)').find('div').find('button').attr('data-id') + '"><i class="fi-rr-arrow-small-right"></i></button>' +
                '</div>',
        'keysearch':row.parents('tr').find('td:eq(5)').text()
    }
}

async function saveAssignFoodBranchArea() {
    let foods = [], un_foods = [], foodUpdate = [];
    if (checkSaveAssignFoodBranchArea === 1) return false;
    if (!checkValidateSave($('#table-price-by-area-data'))) return false;
    checkSaveAssignFoodBranchArea = 1;
    tableBranchFoodArea.rows().every(function () {
        let x = $(this.node());
        if (x.find('td:eq(0)').find('div').find('button').attr('data-type') == 0) {
            foods.push({
                id: x.find('td:eq(0)').find('div').find('button').attr('data-id'),
                price: removeformatNumber(x.find('td:eq(4)').find('input').val())
            })
            tableBranchFoodArea.draw();
        }
        foodUpdate.push({
            food_id: x.find('td:eq(0)').find('div').find('button').attr('data-id'),
            area_id: $('#select-area-table-build-data').val(),
            is_applied: 1,
            price: removeformatNumber(x.find('td:eq(4)').find('input').val())
        })
    })
    tableBranchFood.rows().every(function () {
        let x = $(this.node());
        if (x.find('td:eq(4)').find('div').find('button:last').attr('data-type') == 1) {
            un_foods.push(x.find('td:eq(4)').find('div').find('button:last').attr('data-id'))
        }
    })
    let method = 'post',
        url = 'price-by-area.assgin-food',
        branch_id = $('.select-branch').val(),
        area_id = $('#select-area-table-build-data').val(),
        params = null,
        data = {
            branch_id: branch_id,
            area_id: area_id,
            foods: foods,
            un_foods: un_foods,
            food_update: foodUpdate,
        };
    let res = await axiosTemplate(method, url, params, data, [$('.page-body')]);
    checkSaveAssignFoodBranchArea = 0;
    if (res.data[0].status === 200 && res.data[1].status === 200) {
        let text = 'Cập nhật thành công';
        SuccessNotify(text);
        tableBranchFoodArea.rows().every(function () {
            let x = $(this.node());
            x.find('td:eq(0)').find('div').find('button').attr('data-type',1)
        })
        tableBranchFood.rows().every(function () {
            let x = $(this.node());
            x.find('td:eq(4)').find('div').find('button:last').attr('data-type',0)
        })
        foods = [], un_foods = [], foodUpdate = []
        $('#body-price-by-area-data .toolbar-button-datatable').css({"transition" : "all .2s linear","opacity": "0.5", "pointer-events": "none"});
    } else if (res.data[0].status === 500) {
        let text = $('#error-post-data-to-server').text();
        if (res.data[0].message !== null) {
            text = res.data[0].message;
        }
        ErrorNotify(text);
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data[1].message !== null) {
            text = res.data[1].message;
        }
        WarningNotify(text);
    }
}

