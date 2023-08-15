let checkSaveChangeOneGetOne = 0, checkSaveRunningChangeOneGetOne = 0,
    fromDateOneGetOneCampaign = $('.from-date-one-get-one-campaign').val(),
    toDateOneGetOneCampaign = $('.to-date-one-get-one-campaign').val() , dataTableApply, dataTablePending ,dataTableExpired;

$(async function (){
    dateTimePickerFromToDate($('.from-date-one-get-one-campaign'), $('.to-date-one-get-one-campaign'));
    $(document).on('click', '.search-btn-one-get-one-campaign',function (){
        // validateDateTemplate($('.from-date-one-get-one-campaign'), $('.to-date-one-get-one-campaign'), loadDataOneGetOne);
        fromDateOneGetOneCampaign = $('.from-date-one-get-one-campaign').val();
        toDateOneGetOneCampaign = $('.to-date-one-get-one-campaign').val();
        updateCookieTabOneGetOneCampaign()
    })
    if(getCookieShared('one-get-one-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('one-get-one-user-id-' + idSession));
        fromDateOneGetOneCampaign = dataCookie.from;
        toDateOneGetOneCampaign = dataCookie.to;
        $('.from-date-one-get-one-campaign').val(fromDateOneGetOneCampaign);
        $('.to-date-one-get-one-campaign').val(toDateOneGetOneCampaign);
    }

    $(document).on('dp.change','.from-date-one-get-one-campaign', function () {
        $('.from-date-one-get-one-campaign').val($(this).val());
    })
    $(document).on('dp.change','.to-date-one-get-one-campaign', function () {
        console.log($(this).val());
        $('.to-date-one-get-one-campaign').val($(this).val());
    })
})

function updateCookieTabOneGetOneCampaign(){
    saveCookieShared('one-get-one-user-id-' + idSession, JSON.stringify({
        from: fromDateOneGetOneCampaign,
        to: toDateOneGetOneCampaign
    }))
}

async function loadDataOneGetOne(){
    let method = 'get',
        url = 'one-get-one-campaign.data',
        params = {
            'brand_id' : $('.select-brand').val(),
            'form' : $('#from-date-one-get-one-campaign').val(),
            'to' : $('#to-date-one-get-one-campaign').val(),
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data,
    [$('#div-layout-one-get-one-campaign')]);
    dataTableVoucherPromotion(res);
    $('#total-record-applying-one-get-one-marketing').text(res.data[2].total_running);
    $('#total-record-expired-one-get-one-marketing').text(res.data[2].total_not_active);
    if(!$('.select-branch').val()) {
        await updateSessionBrandNew($('.select-brand'))
    }
}

async function dataTableVoucherPromotion(data) {
    let tableOneGetOneMarketing = $('#table-active-one-get-one-marketing'),
        tableExpiredOneGetOneMarketing = $('#table-expired-one-get-one-marketing'),
        fixed_left = 2,
        fixed_right = 2,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'hour', name: 'hour', className: 'text-center'},
            {data: 'time', name: 'time', className: 'text-center'},
            {data: 'date', name: 'date', className: 'text-center'},
            {data: 'status_text', name: 'status_text', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '10%'},
            {data: 'keySearch', name: 'keySearch', className: 'text-center d-none', width: '10%'},
        ],
        column1 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'hour', name: 'hour', className: 'text-center'},
            {data: 'time', name: 'time', className: 'text-center'},
            {data: 'date', name: 'date', className: 'text-center'},
            // {data: 'action', name: 'action', className: 'text-center', width: '10%'},
            {data: 'keySearch', name: 'keySearch', className: 'text-center d-none', width: '10%'},
        ],

    option = [{
            'title': 'Thêm mới',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'openCreateOneGetOneMarketing',
        }];
    dataTablePending = await DatatableTemplateNew(tableOneGetOneMarketing, data.data[0].original.data, column, '60vh', fixed_left, fixed_right, option);
    dataTableExpired =  await DatatableTemplateNew(tableExpiredOneGetOneMarketing, data.data[1].original.data, column1, '60vh', fixed_left, fixed_right, option);

    $(document).on('input paste', 'input[type="search"]', async function () {
        $('#total-record-applying-one-get-one-marketing').text(dataTablePending.rows({'search': 'applied'}).count())
        $('#total-record-expired-one-get-one-marketing').text(dataTableExpired.rows({'search': 'applied'}).count())
    })
}

function changeStatusOneGetOneCampaign(r){
    if(checkSaveChangeOneGetOne === 1) return false;
    if (r.data('status')) {
        let title = 'Đổi trạng thái thành tạm ngưng',
            content = '',
            icon = 'question';
        sweetAlertComponent(title,content,icon).then(async (result) =>{
            if (result.value){
                let method = 'post',
                    url = 'one-get-one-campaign.change-status',
                    params = {
                        'id' : r.data('id'),
                    },
                    data = null;
                checkSaveChangeOneGetOne = 1;
                let res = await axiosTemplate(method, url, params, data, [$('#div-layout-one-get-one-campaign')]);
                checkSaveChangeOneGetOne = 0;
                let text = $('#success-status-data-to-server').text();
                switch (res.data.status){
                    case 200:
                        SuccessNotify(text);
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
            }
        })
    } else{
        let title = 'Đổi trạng thái thành hoạt động',
            content = '',
            icon = 'question';
        sweetAlertComponent(title,content,icon).then(async (result) => {
            if(result.value){
                let method = 'post',
                    url = 'one-get-one-campaign.change-status',
                    params = {
                        'id' : r.data('id'),
                    },
                    data = null;
                checkSaveChangeOneGetOne = 1;
                let res = await axiosTemplate(method, url, params, data, [$('#div-layout-one-get-one-campaign')]);
                checkSaveChangeOneGetOne = 0;
                let text = $('#success-status-data-to-server').text();
                switch (res.data.status){
                    case 200:
                        SuccessNotify(text);
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
            }
        })
    }
}
function changeRunningOneGetOneCampaign(r){
    if(checkSaveRunningChangeOneGetOne === 1) return false;
    if (r.data('status')) {
        let title = 'Chạy chương trình ?',
            content = '',
            icon = 'question';
        sweetAlertComponent(title,content,icon).then(async (result) =>{
            if (result.value){
                let method = 'post',
                    url = 'one-get-one-campaign.change-running',
                    params = {
                        'id' : r.data('id'),
                    },
                    data = null;
                checkSaveRunningChangeOneGetOne = 1;
                let res = await axiosTemplate(method, url, params, data, [$('#div-layout-one-get-one-campaign')]);
                checkSaveRunningChangeOneGetOne = 0;
                let text = $('#success-status-data-to-server').text();
                switch (res.data.status){
                    case 200:
                        SuccessNotify(text);
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
            }
        })
    } else{
        let title = 'Tạm ngưng chương trình ?',
            content = '',
            icon = 'question';
        sweetAlertComponent(title,content,icon).then(async (result) => {
            if(result.value){
                let method = 'post',
                    url = 'one-get-one-campaign.change-running',
                    params = {
                        'id' : r.data('id'),
                    },
                    data = null;
                checkSaveRunningChangeOneGetOne = 1;
                let res = await axiosTemplate(method, url, params, data, [$('#div-layout-one-get-one-campaign')]);
                checkSaveRunningChangeOneGetOne = 0;
                let text = $('#success-status-data-to-server').text();
                switch (res.data.status){
                    case 200:
                        SuccessNotify(text);
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
            }
        })
    }
}





