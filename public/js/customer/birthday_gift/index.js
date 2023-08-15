$(function () {
    shortcut.add('F2', function () {
        openModalCreateBirthdayGift();
    });
    loadData();
});

async function loadData() {
    let method = 'get',
        url = 'birthday-gift.data',
        branch = $('#change_branch').val(),
        params = {branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data,[$("#table-birthday-gift")]);
    dataTableBirthdayGift(res.data.data);
}

function dataTableBirthdayGift(data) {
    let scroll_Y = '65vh';
    let fixed_left = 2;
    let fixed_right = 2;
    let id = $('#table-birthday-gift');
    let column = [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
        {data: 'avatar', name: 'avatar', className: 'text-center', width: '5%'},
        {data: 'icon', name: 'icon', className: 'text-center', width: '5%'},
        {data: 'title', name: 'title', className: 'text-center'},
        {data: 'gift', name: 'gift', className: 'text-center'},
        {data: 'status', name: 'status', className: 'text-center', width: '10%'},
        {data: 'action', name: 'action', className: 'text-center', width: '5%'},
    ];
    DatatableTemplate(id, data, column, scroll_Y, fixed_left, fixed_right);
}

function changeStatusBirthdayGift(r) {
    let title = '',
        content = '',
        icon = '';
    if(r.data('status') === 1){
        title = 'Đổi trạng thái ?';
        content = 'Đổi trạng thái thành tạm ngưng';
        icon = 'warning';
    }else {
        title = 'Đổi trạng thái ?';
        content = 'Đổi trạng thái thành hoạt động';
        icon = 'warning';
    }
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'birthday-gift.change-status',
                params = null,
                data = {id: r.data('id')};
            let res = await axiosTemplate(method, url, params, data);
            if (res.data.status === 200) {
                let text = $('#msg-success-status-birthday-gift').text();
                SuccessNotify(text);
                loadData();
            } else {
                let text = $('#error-post-data-to-server').text();
                if (data.data.message !== null) {
                    text = data.data.message;
                }
                ErrorNotify(text);
                return false;
            }
        }
    })
}
function selectIconBirthdayGift(res) {
    let id = res.attr('data-id'),
        div = res.closest('div').attr('id');
    $('.w-img-icon-group').removeClass('border-selected card-shadow-custom');
    $('#'+div+' #img-icon-birthday-gift-' + id).addClass('border-selected card-shadow-custom');
}
