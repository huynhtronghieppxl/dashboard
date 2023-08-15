let tableRestaurantVideoAdvMarketing, idBrandaddClass ,checkCancelMedia = 0,
    checkChangeStatusBranchDisplaySecondary = 0 , focusStatusDisplaySecondary = 0,
    checkSaveDisplaySecPos;
async function loadData() {
    let method = 'get',
        url = 'display-secondary-pos.data',
        params = {
            brand: idBrandaddClass,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#template-review-update')]);
    dataTableMediaRestaurant(res);
}

async function cancelMediaDisplay(r) {
    // if (checkCancelMedia === 1) return false;
    checkCancelMedia = 1;
    let title = 'Xoá ?', text = 'Xoá hình ảnh màn hình phụ !', icon = 'question';
    sweetAlertComponent(title, text, icon).then(async result => {
        if (result.value) {
            let method = 'POST',
                url = 'display-secondary-pos.delete',
                params = {id: r.data('id')},
                data = '';
            let res = await axiosTemplate(method, url, params, data);
            checkCancelMedia = 0;
            let text = $('#success-cancel-data-to-server').text();
            switch (res.data.status){
                case 200:
                    SuccessNotify(text);
                    loadData();
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
    });
}
async function dataTableMediaRestaurant(data) {
    let restaurantBannerAdvMarketing = $('#restaurant-banner-adv-marketing'),
        fixed_left = '',
        fixed_right = '',
        columnRestaurantBannerAdvMarketing = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'media_url', name: 'media_url', width: '5%'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ],
        option = [
            {
                'title': 'Cập nhật',
                'icon': 'fa fa-pencil',
                'class': 'btn-create-image-display',
                'function': 'openModalUpdateDisplaySecPos',
            },
            {
                'title': 'Thêm mới',
                'icon': 'fa fa-plus',
                'class': 'btn-create-image-display',
                'function': 'openModalUploadImageDisplay',
            }
        ]
    tableRestaurantVideoAdvMarketing = await DatatableTemplateNew(restaurantBannerAdvMarketing, data.data[0].original.data, columnRestaurantBannerAdvMarketing, vh_of_table, fixed_left, fixed_right, option);
}
async function changeStatusDisplaySecondary(r){
    if (focusStatusDisplaySecondary === 0) {
        if (r.data('status') === 1) {
            let title = 'Bạn có muốn tắt chức năng màn hình phụ ?',
                content = '',
                icon = 'warning';
            sweetAlertComponent(title, content, icon).then(async (result) => {
                if (result.value) {
                    checkChangeStatusBranchDisplaySecondary = 1;
                    let method = 'POST',
                        url = 'display-secondary-pos.change-status',
                        params = {id: r.data('id')},
                        data = '';
                    let res = await axiosTemplate(method, url, params, data);
                    checkChangeStatusBranchDisplaySecondary = 0;
                    switch (res.data.status){
                        case 200:
                            SuccessNotify($('#success-create-data-to-server').text());
                            location.reload();
                            break;
                        case 500:
                            (res.data.message !== null) ? ErrorNotify(res.data.message) : ErrorNotify($('#error-post-data-to-server').text());
                            break;
                        default:
                            (res.data.message !== null) ? WarningNotify(res.data.message) : WarningNotify($('#error-post-data-to-server').text());
                    }
                }
                else {
                    focusStatusDisplaySecondary = 1;
                    r.click();
                    focusStatusDisplaySecondary = 0;
                }
            })
        } else {
            let title = 'Bạn có muốn bật chức năng màn hình phụ ?',
                content = '',
                icon = 'warning';
            sweetAlertComponent(title, content, icon).then(async (result) => {
                if (result.value) {
                    checkChangeStatusBranchDisplaySecondary = 1;
                    let method = 'POST',
                        url = 'display-secondary-pos.change-status',
                        params = {id: r.data('id')},
                        data = '';
                    let res = await axiosTemplate(method, url, params, data);
                    checkChangeStatusBranchDisplaySecondary = 0;
                    switch (res.data.status){
                        case 200:
                            SuccessNotify($('#success-create-data-to-server').text());
                            location.reload();
                            break;
                        case 500:
                            (res.data.message !== null) ? ErrorNotify(res.data.message) : ErrorNotify($('#error-post-data-to-server').text());
                            break;
                        default:
                            (res.data.message !== null) ? WarningNotify(res.data.message) : WarningNotify($('#error-post-data-to-server').text());
                    }
                } else {
                    focusStatusDisplaySecondary = 1;
                    r.click();
                    focusStatusDisplaySecondary = 0;
                }
            })

        }
    }
}

function getDetailMediaDisplaySecondary(r){
    idBrandaddClass = r.data('id');
    $('#list-branch-display-secondary').addClass('d-none');
    $('#data-table-display-secondary').removeClass('d-none');
    loadData();
    getDataContentDisplaySecPos();
}

function closeDataDisplaySecondary(){
    $('#list-branch-display-secondary').removeClass('d-none');
    $('#data-table-display-secondary').addClass('d-none');
}


