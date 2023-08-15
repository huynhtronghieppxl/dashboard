let drawUnSelectedBestsellingFoodCustomer,
    drawSelectedBestsellingFoodCustomer,
    checkSaveBestsellingFoodCustomer = 0;

$(async function () {
    shortcut.add("F4", function () {
        saveBestsellingFoodCustomer();
    });
    if(!$('.select-branch').val()) {
        await updateSessionBrandNew($('.select-brand'));
    }else {
        loadData();
    }
});

async function loadData() {
    let method = 'get',
        url = 'booking-food-customer.data',
        branch = $('.select-branch').val(),
        restaurant_brand_id = $('.select-brand').val(),
        params = {
            branch: branch,
            restaurant_brand_id: restaurant_brand_id
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data,[
        $("#table-all-bestselling-food-customer"),
        $("#table-selected-bestselling-food-customer"),
    ]);
    dataTableUnSelectedBestsellingFoodCustomer(res.data[0].original.data);
    dataTableSelectedBestsellingFoodCustomer(res.data[1].original.data);
}

async function dataTableUnSelectedBestsellingFoodCustomer(data) {
    let id = $('#table-all-bestselling-food-customer'),
        fixed_left = 0,
        fixed_right = 2,
        columns = [
            {data: 'avatar', name: 'avatar', width: '5%', className: 'text-left'},
            {data: 'amount', name: 'amount', className: 'text-right'},
            {data: 'detail', name: 'detail', className: 'text-center', width: '5%'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ],
        option = [];
    drawUnSelectedBestsellingFoodCustomer = await DatatableTemplateNew(id, data, columns, vh_of_table, fixed_left, fixed_right,option);
}

async function dataTableSelectedBestsellingFoodCustomer(data) {
    let id = $('#table-selected-bestselling-food-customer'),
        fixed_left = 0,
        fixed_right = 0,
        columns = [
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'avatar', name: 'avatar', width: '5%', className: 'text-left'},
            {data: 'amount', name: 'amount', className: 'text-right'},
            {data: 'detail', name: 'detail', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ],
        option = [
            {
                'title': 'Cập nhật',
                'icon': 'fa fa-upload',
                'class': '',
                'function': 'saveBestsellingFoodCustomer',
            }
        ];
    drawSelectedBestsellingFoodCustomer = await DatatableTemplateNew(id, data, columns, vh_of_table, fixed_left, fixed_right,option);
}

async function checkBestsellingFoodCustomer(r) {
    let item = {
        'avatar': r.parents('tr').find('td:eq(0)').html(),
        'amount': r.parents('tr').find('td:eq(1)').text(),
        'detail': r.parents('tr').find('td:eq(2)').html(),
         'action': '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  data-type="' + r.parents('tr').find('td:eq(3)').find('button').attr('data-type') + '" onclick="unCheckBestsellingFoodCustomer($(this))" data-id="' + r.parents('tr').find('td:eq(3)').find('button').attr('data-id') + '"><i class="fi-rr-arrow-small-left"></i></button></div>',
        'keysearch': r.parents('tr').find('td:eq(4)').text(),
    };
    addRowDatatableTemplate(drawSelectedBestsellingFoodCustomer, item);
    drawUnSelectedBestsellingFoodCustomer.row(r.parents('tr')).remove().draw(false);
}

async function unCheckBestsellingFoodCustomer(r) {
     let item = {
        'avatar': r.parents('tr').find('td:eq(1)').html(),
        'amount': r.parents('tr').find('td:eq(2)').text(),
         'action': '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  data-type="' + r.parents('tr').find('td:eq(0)').find('button').attr('data-type') + '" onclick="checkBestsellingFoodCustomer($(this))" data-id="' + r.parents('tr').find('td:eq(0)').find('button').attr('data-id') + '"><i class="fi-rr-arrow-small-right"></i></button></div>',
        'detail': r.parents('tr').find('td:eq(3)').html(),
        'keysearch': r.parents('tr').find('td:eq(4)').text(),
    };
    addRowDatatableTemplate(drawUnSelectedBestsellingFoodCustomer, item);
    drawSelectedBestsellingFoodCustomer.row(r.parents('tr')).remove().draw(false);
}

async function checkAllBestSellingFoodCustomer() {
    await addAllRowDatatableTemplate(drawUnSelectedBestsellingFoodCustomer, drawSelectedBestsellingFoodCustomer, itemCheckBestsellingFoodCustomer)
}

async function unCheckAllBestSellingFoodCustomer() {
    await addAllRowDatatableTemplate(drawSelectedBestsellingFoodCustomer, drawUnSelectedBestsellingFoodCustomer, itemUnCheckBestsellingFoodCustomer)
}

function itemCheckBestsellingFoodCustomer(row) {
    return {
        'avatar': row.find('td:eq(0)').html(),
        'amount': row.find('td:eq(1)').text(),
        'detail': row.find('td:eq(2)').html(),
         'action': ' <div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  onclick="unCheckBestsellingFoodCustomer($(this))" data-id="' + row.find('td:eq(3)').find('button').attr('data-id') + '" data-type="' + row.find('td:eq(3)').find('button').attr('data-type') + '"><i class="fi-rr-arrow-small-left"></i></button></div>',
        'keysearch': row.find('td:eq(4)').text(),
    };
}

function itemUnCheckBestsellingFoodCustomer(row) {
    return {
        'avatar': row.find('td:eq(1)').html(),
        'amount': row.find('td:eq(2)').text(),
         'action': ' <div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  onclick="checkBestsellingFoodCustomer($(this))" data-id="' + row.find('td:eq(0)').find('button').attr('data-id') + '" data-type="' + row.find('td:eq(0)').find('button').attr('data-type') + '"><i class="fi-rr-arrow-small-right"></i></button></div>',
        'detail': row.find('td:eq(3)').html(),
        'keysearch': row.find('td:eq(4)').text(),
    };

}

async function saveBestsellingFoodCustomer() {
    if (checkSaveBestsellingFoodCustomer === 1) {
        return false;
    }
    let restaurant_brand_id = $('.select-brand').val(),
        food_insert_ids = [],
        food_delete_ids = [];
    await drawSelectedBestsellingFoodCustomer.rows().every(function (index, element) {
        let row = $(this.node());
         if(row.find('td:eq(0)').find('button').attr('data-type') == 0){
            food_insert_ids.push(row.find('td:eq(0)').find('button').attr('data-id'));
        }
    });

    await drawUnSelectedBestsellingFoodCustomer.rows().every(function (index, element) {
        let row = $(this.node());
        console.log(row.find('td:eq(3)'))
        if(row.find('td:eq(3)').find('button').attr('data-type')==1){
            food_delete_ids.push(row.find('td:eq(3)').find('button').attr('data-id'));
        }
    });

    checkSaveBestsellingFoodCustomer = 1;
    let method = 'post',
        url = 'booking-food-customer.update',
        params = null,
        data = {restaurant_brand_id: restaurant_brand_id, food_insert_ids: food_insert_ids, food_delete_ids : food_delete_ids};
    let res = await axiosTemplate(method, url, params, data,[
        $("#table-all-bestselling-food-customer"),
        $("#table-selected-bestselling-food-customer"),
    ]);
    checkSaveBestsellingFoodCustomer = 0;
    switch(res.data.status) {
        case 200:
            SuccessNotify($('#success-update-data-to-server').text());
            await drawSelectedBestsellingFoodCustomer.rows().every(function (index, element) {
                let row = $(this.node());
                row.find('td:eq(0)').find('button').attr('data-type', 1)
            });
            await drawUnSelectedBestsellingFoodCustomer.rows().every(function (index, element) {
                let row = $(this.node());
                row.find('td:eq(0)').find('button').attr('data-type', 0)
            });
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify($('#error-post-data-to-server').text());
    }
}
