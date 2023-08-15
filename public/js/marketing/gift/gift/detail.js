let tableFoodDetailGiftMarketing;

function openModalDetailGiftMarketing(r) {
    $('#modal-detail-gift-marketing').modal('show');
    shortcut.add('F4', function () {
        saveModalCreateGiftMarketing();
    });
    shortcut.add('ESC', function () {
        closeModalDetailGiftMarketing();
    });
    loadDataDetailGiftMarketing(r.data('id'));
}

async function loadDataDetailGiftMarketing(id) {
    let method = 'get',
        url = 'gift-marketing.detail',
        params = {id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data, []);

    $('#day-of-weeks-detail-gift-marketing').text(res.data[1].data.day_of_weeks)
    $('#name-detail-gift-marketing').text(res.data[1].data.name)
    $('#use-guide-detail-gift-marketing').html(res.data[1].data.use_guide === '' ? '---' : res.data[1].data.use_guide)
    $('#branch-detail-gift-marketing').text(res.data[1].data.branches[0].name)
    $('#expire-day-detail-gift-marketing').html(res.data[1].data.expire_after_days)
    $('#description-detail-gift-marketing').html(res.data[1].data.description === '' ? '---' : res.data[1].data.description)
    $('#point-detail-gift-marketing').html(res.data[1].data.gift_object_value)
    $('#thumbnail-gift-logo-detail-gift-marketing').attr('src',res.data[1].data.image_url);
    $('#thumbnail-gift-banner-detail-gift-marketing').attr('src',res.data[1].data.banner_url);
    $('#type-detail-gift-marketing').text(res.data[1].data.type)
    $('#day-create-detail-gift-marketing').text(res.data[1].data.created_at)
    $('#content-detail-gift-marketing').html(res.data[1].data.content === '' ? '---' : res.data[1].data.content)
    $('#term-detail-gift-marketing').html(res.data[1].data.term === '' ? '---' : res.data[1].data.term)
    $('#hour-create-detail-gift-marketing').text(res.data[1].data.time_apply)
    if($('#type-detail-gift-marketing').text() === 'Món ăn'){
        $('.table-food-detail-gift-marketing').removeClass('d-none')
        $('.point-detail-gift-marketing').addClass('d-none');
    }else{
        $('.table-food-detail-gift-marketing').addClass('d-none')
    }
    drawTableFoodDetailGiftMarketing(res)
}

async function drawTableFoodDetailGiftMarketing(data) {
    let id = $('#table-food-detail-gift-marketing'),
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'quantity', name: 'quantity', className: 'text-center',width: '20%'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ];
    tableFoodDetailGiftMarketing = await DatatableTemplateNew(id, data.data[0].original.data, column, '40vh', fixed_left, fixed_right);
}

function closeModalDetailGiftMarketing() {
    $('#modal-detail-gift-marketing').modal('hide');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    $('#name-detail-gift-marketing').text('---')
    $('#branch-detail-gift-marketing').text('---')
    $('#type-detail-gift-marketing').text('---')
    $('#point-detail-gift-marketing').text('---')
    $('#expire-day-detail-gift-marketing').text('---')
    $('#day-create-detail-gift-marketing').text('---')
    $('#hour-create-detail-gift-marketing').text('---')
    $('#description-detail-gift-marketing').text('---')
    $('#content-detail-gift-marketing').text('---')
    $('#use-guide-detail-gift-marketing').text('---')
    $('#role-detail-gift-marketing').text('---')
}
