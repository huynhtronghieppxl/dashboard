let optionFoodOneGetOneCampaign, idOneGetOneCampaign, checkSaveOneGetOneData = 0, listFoodSelected = '';
function openModalUpdateFoodOneGetOneCampaign(r) {
    idOneGetOneCampaign = r.data('id');
    $('#modal-update-food-one-get-one-campaign').modal('show');
    dataTableUpdateFoodOneGetOneCampaign([]);
    dataTableSelectUpdateFoodOneGetOneCampaign([]);
    loadDataListFood();
}

async function loadDataListFood(){
    let restaurant_brand_id = $('.select-brand').val();
    let method = 'get',
        url = 'one-get-one-campaign.list-food',
        params = {
            id: idOneGetOneCampaign,
            brand:restaurant_brand_id
        },
        body = {};
    let res = await axiosTemplate(method, url, params, body,[$('#loading-list-food-all-one-get-one-campign')]);
    dataTableUpdateFoodOneGetOneCampaign(res.data[0].original.data);
    dataTableSelectUpdateFoodOneGetOneCampaign(res.data[2].original.data);
    listFoodSelected = res.data[3];
    optionFoodOneGetOneCampaign = res.data[1].data.list.filter(op => op.is_combo !==1 && op.is_addition !==1 && op.restaurant_kitchen_place_id )
        .reduce((option, v) => {
        option.push({
            id: v.id,
            name: v.name,
            category_type_id: v.category_type_id,
            is_sell_by_weight : v.is_sell_by_weight,
            restaurant_kitchen_place_id: v.restaurant_kitchen_place_id
        })
        return option;
    },[]);
}

async function dataTableUpdateFoodOneGetOneCampaign(data) {
    let id = $('#table-all-food-update-one-get-one'),
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'avatar', name: 'avatar', width: '5%'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', class: 'd-none'},
        ],
        option = [];
    tableAllSelectOneGetOne = await DatatableTemplateNew(id, data, column, '50vh', fixed_left, fixed_right, option);
}

async function dataTableSelectUpdateFoodOneGetOneCampaign(data) {
    let id = $('#table-selected-food-update-one-get-one'),
        fixed_left = 0,
        fixed_right = 0,
        column1 = [
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'avatar', name: 'avatar', width: '5%'},
            {data: 'food', name: 'food', className: 'text-center', width:'80%'},
            {data: 'keysearch', class: 'd-none'},
        ],
    option = [];
    tableSelectOneGetOne = await DatatableTemplateNew(id, data, column1,'50vh' , fixed_left, fixed_right, option);
    $('.select-list-food-one-get-one').select2({
        dropdownParent: $('#modal-update-food-one-get-one-campaign')
    });
    await $('.select-list-food-one-get-one').html(listFoodSelected);
    tableSelectOneGetOne.rows().every(async function (index, element) {
        let row = $(this.node());
        let food = optionFoodOneGetOneCampaign.find(v => v.id === +row.find('td:eq(0)').find('button').data('id'));
        let cateType = food.category_type_id;
        let isSellByWeight = food.is_sell_by_weight;

        row.find('.select-list-food-one-get-one').html(filterUnitTypeAllowed(cateType, isSellByWeight));
        row.find('td:eq(2)').find('select').val(row.find('td:eq(2)').find('select').attr('data-ids').split(',')).trigger('change.select2');
        row.find('td:eq(2)').find('select').find('option:selected').attr('data-type', 0);
    })
}

function filterUnitTypeAllowed (cateType,isSellByWeight) {
    return  optionFoodOneGetOneCampaign.filter(v => v.is_sell_by_weight === isSellByWeight)
        .map(opt => `<option value="${opt.id}" data-type="1" data-cate-type="${cateType}"">${opt.name}</option>`).join('');
}

async function checkFoodOneGetOne(r){
    let cateType = r.data('cate-type');
    let isSellByWeight = r.data('sell-by-weight');
    addRowDatatableTemplate(tableSelectOneGetOne, {
        'action': '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light" data-type="' + r.data('type') +'" data-id="' +  r.data('id') +'" onclick="unCheckFoodOneGetOne($(this)) "><i class="fi-rr-arrow-small-left"></i></button></div>',
        'avatar': '<div><label><img src="'+   r.parents('tr').find('td:eq(0)').find('img').attr('src') +'" class="img-inline-name-data-table" onclick="modalImageComponent('+  r.parents('tr').find('td:eq(0)').find('img').attr('src') +')"></label><input value="'+  r.data('id') +'" class="d-none">' + r.parents('tr').find('td:eq(0)').text() + '</div>',
        'food' : '<select class="select-list-food-one-get-one js-example-basic-single" multiple data-select="1" >' + filterUnitTypeAllowed(cateType, isSellByWeight)  + '</select>',
        'keysearch':r.parents('tr').find('td:eq(4)').text()
    });
    $('.select-list-food-one-get-one').select2({
        dropdownParent: $('#modal-update-food-one-get-one-campaign')
    });
    tableAllSelectOneGetOne.row(r.parents('tr')).remove().draw(false);
}

async function unCheckFoodOneGetOne(r){
    addRowDatatableTemplate(tableAllSelectOneGetOne, {
        'action': '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light" onclick="checkFoodOneGetOne($(this))" data-id="' +  r.data('id') + '" data-type="' + r.data('type') +'"><i class="fi-rr-arrow-small-right"></i></button></div>',
        'avatar': '<div><label><img src="'+  r.parents('tr').find('td:eq(1)').find('img').attr('src') +'" class="img-inline-name-data-table" onclick="modalImageComponent('+  r.parents('tr').find('td:eq(1)').find('img').attr('src') +')"></label><input value="'+  r.data('id') +'" class="d-none">' + r.parents('tr').find('td:eq(1)').text() + '</div>',
        'keysearch':r.parents('tr').find('td:eq(4)').text()
    });
    tableSelectOneGetOne.row(r.parents('tr')).remove().draw(false);
}

async function saveFoodOneGetOneCampaign(){
    if (checkSaveOneGetOneData === 1) return false;
    let foodListInsertIds = [], foodListDeleteIds = [], foodList = [] , listFoodRemove = [];
    await tableSelectOneGetOne.rows().every(async function (index, element) {
        let row = $(this.node());
        foodListInsertIds = [];
        foodListDeleteIds = [];
        row.find('td:eq(2)').find('option:selected').filter(function (){
            if($(this).data('type') != 0){
                foodListInsertIds.push(Number($(this).val()));
            }
        })
        row.find('td:eq(2)').find('option').not(':selected').filter(function (){
            if($(this).data('type') == 0){
                foodListDeleteIds.push(Number($(this).val()));
            }
        })
        foodList.push({
            food_id : row.find('td:eq(0)').find('button').data('id'),
            food_insert_ids: foodListInsertIds,
            food_delete_ids: foodListDeleteIds ,
        });
    });
    await tableAllSelectOneGetOne.rows().every(async function (index, element) {
        let row = $(this.node());
        if(row.find('td:eq(1)').find('button').attr('data-type') == 1){
            listFoodRemove.push(row.find('td:eq(1)').find('button').attr('data-id'));
        }
    });
    checkSaveOneGetOneData = 1;
    let method = 'post',
        url = 'one-get-one-campaign.assign-food',
        params = null,
        body = {
            id : idOneGetOneCampaign,
            list_food : foodList,
            list_remove : listFoodRemove
        };
    let res = await axiosTemplate(method, url, params, body,[$('#modal-update-food-one-get-one-campaign')]);
    checkSaveOneGetOneData = 0;
    if(listFoodRemove.length == 0){
        let text = '';
        switch (res.data[0].status){
            case 200:
                text= $('#success-create-data-to-server').text();
                SuccessNotify(text);
                closeModalUpdateFoodOneGetOneCampaign();
                loadDataOneGetOne();
                break;
            case 500:
                text = $('#error-post-data-to-server').text();
                if (res.data.message !== null) text = res.data.message;
                ErrorNotify(text);
                break;
            default:
                text = $('#error-post-data-to-server').text();
                if (res.data.message !== null) text = res.data.message;
                WarningNotify(text);
        }
    }else {
        if (res.data[0].status === 200 && res.data[1].status === 200) {
            SuccessNotify($('#success-create-data-to-server').text());
            closeModalUpdateFoodOneGetOneCampaign();
            loadDataOneGetOne();
        } else {
            if(res.data[0].status !== 200 )
                ErrorNotify((res.data[0].message !== null) ? res.data[0].message : $('#error-post-data-to-server').text());
            if(res.data[1].status !== 200 )
                ErrorNotify((res.data[1].message !== null) ? res.data[1].message : $('#error-post-data-to-server').text());
        }
    }
}

function closeModalUpdateFoodOneGetOneCampaign(){
    $('#modal-update-food-one-get-one-campaign').modal('hide');
    tableSelectOneGetOne.clear();
    tableAllSelectOneGetOne.clear();
}
