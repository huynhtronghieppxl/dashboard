let isStatus = 0, dataTablePriceTemporary,
    saveOffPriceTemporary = 0,
    dateFromUpdatePriceTemporary, dateToUpdatePriceTemporary, thisCancelPriceTemporaryData;
$(async function(){
    if(!$('.select-branch').val()) {
        await updateSessionBrandNew($('.select-brand'));
    }else {
        loadData();
    }
})
async function loadData() {
    let method = 'get',
        url = 'price-temporary.data',
        branch_id = $('#select-branch-price-temporary').val(),
        restaurant_brand_id = $('#select-brand-price-temporary').val(),
        params = {
            restaurant_brand_id: restaurant_brand_id,
            branch_id : branch_id,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-food-price-temporary')]);
    await dataTableFoodData(res.data[1].original.data);
    dateFromUpdatePriceTemporary = res.data[4];
    dateToUpdatePriceTemporary = res.data[5];
    if(jQuery.isEmptyObject(res.data[1].original.data)){
        isStatus = 0;
        $('.btn-off-table-price-temporary').addClass('d-none');
        $('.btn-update-table-price-temporary').removeClass('d-none');
        countSideNavWidth();
    }else{
        isStatus = 1;
        $('.btn-update-table-price-temporary').addClass('d-none');
        $('.btn-off-table-price-temporary').removeClass('d-none');
        countSideNavWidth();
    }
}

async function dataTableFoodData(data) {
    let id = $('#table-food-price-temporary'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'unit_type', name: 'unit_type', className: 'text-left'},
            {data: 'category_name', name: 'category_name', className: 'text-left'},
            {data: 'original_price', name: 'original_price', className: 'text-right'},
            {data: 'price_not_temporary', name: 'price_not_temporary', className: 'text-right'},
            {data: 'temporary_price', name: 'temporary_price', className: 'text-right'},
            {data: 'temporary_price_from_date', name: 'temporary_price_from_date', className: 'text-center'},
            {data: 'temporary_price_to_date', name: 'temporary_price_to_date', className: 'text-center'},
            {data: 'status', name: 'status', className: 'text-center',width: '5%'},
            {data: 'action', name: 'action', className: 'text-center',width: '5%'},
            {data : 'keysearch', name:'keysearch',className:'d-none'}
        ],
        option = [],
        fixedLeft = 3,
        fixedRight = 1;
    if(data.length>0) option.push( {
        'title': 'Không áp dụng',
        'icon': 'icofont icofont-ui-close',
        'class': data.length > 0 ? 'btn-off-table-price-temporary' : 'btn-off-table-price-temporary d-none',
        'function': 'cancelPriceTemporary',
    })
    else {
        option.push( {
            'title': 'Cập nhật ',
            'icon': 'fa fa-upload',
            'class': data.length > 0 ? 'btn-update-table-price-temporary d-none' : ' btn-update-table-price-temporary ',
            'function': 'openModalUpdatePriceTemporary',
        })
    }

    option.reverse()
    dataTablePriceTemporary = await DatatableTemplateNew(id, data, column, vh_of_table, fixedLeft, fixedRight, option);
    $(document).on('input paste keyup','input[type="search"]', async function (){
        let index = 1;
        await dataTablePriceTemporary.rows({'search':'applied'}).every(function (){
            let row = $(this.node())
            row.find('td:eq(0)').text(index)
            index++;
        })
    })
}

async function cancelPriceTemporary() {
    if(saveOffPriceTemporary === 1) return false;
    saveOffPriceTemporary = 1;
    let title = 'Thông báo',
        content = 'Bạn có muốn huỷ áp dụng giá thời vụ cho tất cả món?',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let table = [];
            await dataTablePriceTemporary.rows().every(function (index, element) {
                let row = $(this.node());
                table[index] = {
                    'food_id': row.find('td:eq(10)').find('button').data('id'),
                    'temporary_price': 0,
                    'temporary_percent': 0,
                };
            });
            let method = 'post',
                url = 'price-temporary.update',
                params = null,
                data = {
                    branch: [$('#select-branch-price-temporary').val()],
                    date_in: dateFromUpdatePriceTemporary,
                    date_out: dateToUpdatePriceTemporary,
                    restaurant_brand_id: $('#select-brand-price-temporary').val(),
                    status: 0,
                    food: table,
                };
            let res = await axiosTemplate(method, url, params, data, [$('#table-food-price-temporary')]);
            saveOffPriceTemporary = 0;
            let text = '';
            switch (res.data.status ) {
                case 200:
                    let success = $('#success-cancel-data-to-server').text();
                    SuccessNotify(success);
                    dataTableFoodData([])
                    break;
                case 500:
                    text = $('#error-post-data-to-server').text();
                    if (res.message !== null) {
                        text = res.message;
                    }
                    ErrorNotify(text);
                    break;
                default:
                    text = $('#error-post-data-to-server').text();
                    if (res.message !== null) {
                        text = res.message;
                    }
                    WarningNotify($('#error-post-data-to-server').text())
            }

        } else {
            saveOffPriceTemporary = 0;
        }
    });
}

async function cancelByOnePriceTemporary(r) {
    if(saveOffPriceTemporary === 1) return false;
    saveOffPriceTemporary = 1;
    let title = 'Thông báo',
        content = 'Bạn có muốn huỷ áp dụng giá thời vụ cho món ' + r.data('name') + '?',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'price-temporary.update',
                params = null,
                data = {
                    branch: [$('#select-branch-price-temporary').val()],
                    date_in: dateFromUpdatePriceTemporary,
                    date_out: dateToUpdatePriceTemporary,
                    restaurant_brand_id: $('#select-brand-price-temporary').val(),
                    status: 0,
                    food: [{
                        'food_id': r.data('id'),
                        'temporary_price': 0,
                        'temporary_percent': 0,
                        }],
                };
            let res = await axiosTemplate(method, url, params, data, [$('#table-food-price-temporary')]);
            saveOffPriceTemporary = 0;
            let text = '';
            switch (res.data.status ) {
                case 200:
                    let success = $('#success-cancel-data-to-server').text();
                    SuccessNotify(success);
                    await removeRowDatatableTemplate(dataTablePriceTemporary, r, true);
                    if(!dataTablePriceTemporary.data().count()) {
                        dataTableFoodData([]);
                    }
                    break;
                case 500:
                    text = $('#error-post-data-to-server').text();
                    if (res.message !== null) {
                        text = res.message;
                    }
                    ErrorNotify(text);
                    break;
                default:
                    text = $('#error-post-data-to-server').text();
                    if (res.message !== null) {
                        text = res.message;
                    }
                    WarningNotify($('#error-post-data-to-server').text())
            }
        } else {
            saveOffPriceTemporary = 0;
        }
    });
}
