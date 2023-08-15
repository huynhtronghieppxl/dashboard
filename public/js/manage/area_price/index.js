let tableBranchFoodAreaPriceManage,
    checkSaveUpdateAreaPriceManage = 0,
    selectPriceByArea = $('#select-area-price-table-manage').val(),
    selectBranchPriceByArea = $('.select-branch').val(),
    valueAreaSelectedPriceByArea = '';

$(async function () {
    // if(!selectBranchPriceByArea) {
    //     await updateSessionBrandNew($('.select-brand'));
    //     selectBranchPriceByArea = $('.select-branch').val()
    // }
    $(document).on('select2:select', '#select-area-price-table-manage',async function () {
        selectPriceByArea = $(this).val()
        foodDataAreaPriceManage();
    })
    $(document).on('select2:select', '#branch-price-by-area-manage',async function () {
        selectBranchPriceByArea = $(this).val();
        // await dataFoodAreaPriceManage();
        // if(valueAreaSelectedPriceByArea == ''){
        //     dataTableAreaPriceFood([]);
        // }else{
        //     foodDataAreaPriceManage();
        // }
        loadData()
    })

    $(document).on('input paste', '.amount-price-by-area-data',async function () {
         $(this).parents('.validate-table-validate').removeClass('border-danger')
    })
    if(!selectBranchPriceByArea) {
        await updateSessionBrandNew($('.select-brand'));
        selectBranchPriceByArea = $('.select-branch').val()
    }else {
        loadData();
    }
});

async function loadData() {
    await dataFoodAreaPriceManage();
    if(valueAreaSelectedPriceByArea == ''){
        dataTableAreaPriceFood([]);
    }else{
        foodDataAreaPriceManage();
    }

}

async function foodDataAreaPriceManage() {
    let branch_id = selectBranchPriceByArea,
        area_id = $('#select-area-price-table-manage').val(),
        restaurant_brand_id = $('.select-brand').val(),
        method = 'get',
        url = 'price-by-area-manage.data',
        params = {
            area_id: area_id,
            branch_id: branch_id,
            restaurant_brand_id: restaurant_brand_id
        },
        data = null;
        let res = await axiosTemplate(method, url, params, data, [$('#table-area-price-manage')]);
    dataTableAreaPriceFood(res.data[0].original.data);
}

async function dataFoodAreaPriceManage() {
    selectBranchPriceByArea = $('.select-branch').val()
    let method = 'get',
        url = 'price-by-area-manage.area',
        branch_id = selectBranchPriceByArea,
        params = {
            branch_id: branch_id,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#select-area-price-table-manage')]);
    $('#select-area-price-table-manage').html(res.data[0]);
    valueAreaSelectedPriceByArea = $('#select-area-price-table-manage option:selected').val();
}

async function dataTableAreaPriceFood(data) {
    let idPriceByArea = $('#table-area-price-manage'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'food_name', name: 'food_name', className: 'text-left white-space-normal'},
            {data: 'category_name', name: 'category_name', className: 'text-right'},
            {data: 'price', name: 'price', className: 'text-right'},
            {data: 'price_by_area', name: 'price_by_area', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center'},
            {data: 'keysearch' , name:'keysearch', className:'d-none'}
        ],
        fixedLeft = 0,
        fixedRight = 0,
        option = [{
            'title': 'Cập nhật',
            'icon': 'fi-rr-print',
            'class': '',
            'function': 'updateAreaPriceManage',
        }];
    tableBranchFoodAreaPriceManage = await DatatableTemplateNew(idPriceByArea, data, column, vh_of_table, fixedLeft, fixedRight, option);
}

async function updateAreaPriceManage() {
    let foods = [];
    if (checkSaveUpdateAreaPriceManage === 1) return false;
    if (!checkValidateSave($('#table-area-price-manage'))) return false;
    checkSaveUpdateAreaPriceManage = 1;
    await tableBranchFoodAreaPriceManage.rows().every(function () {
        let x = $(this.node());
        foods.push({
            food_id: x.find('td:eq(5)').find('button').data('id'),
            area_id: $('#select-area-price-table-manage').val(),
            price: removeformatNumber(x.find('td:eq(4)').find('input').val()),
            is_applied: 1,
        })
    })
    let method = 'post',
        url = 'price-by-area-manage.update',
        branch_id = selectBranchPriceByArea,
        params = null,
        data = {
            branch_id: branch_id,
            foods: foods,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#table-area-price-manage')]);
    checkSaveUpdateAreaPriceManage = 0;
    let text = '';
    switch (res.data.status) {
        case 200:
            SuccessNotify($('#success-update-data-to-server').text());
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
