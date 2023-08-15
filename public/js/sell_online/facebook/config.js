$(function () {
    getListPageFacebook();
    checkPageActiveConnect();

    $(document).on('change', '.checkbox-control-page-item-input', function(){
        if($(this).is(':checked') === true) {
            $(this).parents('.card-item-list-category').addClass('active');
        } else {
            $(this).parents('.card-item-list-category').removeClass('active');
        }
    });

    $(document).on('click', '.card-item-list-category', function(){
        let titleCard = $(this).find('.manage-page-card-item-content-title').text();
        let idCard = $(this).data('id');
        let imgCard = $(this).find('.manage-page-card-item-img').attr('src');
        $(this).toggleClass('active');
        if($(this).hasClass('active')){
            $(this).find('.checkbox-control-page-item-input').prop('checked', true);
            $(this).find('.manage-page-card-item-content-title-status').text('Kết nối');
            $('.item-card-menu-list-check').append(`<div class="card-item-list-category-check d-flex align-items-center" data-id="${idCard}">
                                                                <div class="img-logo-card-item-check">
                                                                    <img class="manage-page-card-item-img-right" src="${imgCard}" />
                                                                </div>
                                                                <div class="title-information-card-item-check">
                                                                    <div class="content-title-check-01">
                                                                        <p class="manage-page-card-item-content-title-check-01">${titleCard}</p>
                                                                    </div>
                                                                </div>
                                                                <i class="fa fa-times-circle remove-page-collect"></i>
                                                            </div>`);
        } else{
            $(this).find('.checkbox-control-page-item-input').prop('checked', false);
            $(this).find('.manage-page-card-item-content-title-status').text('Chưa kết nối');
            $(`.card-item-list-category-check[data-id="${idCard}"]`).remove();
            $(this).find('.manage-page-card-item-content-title-status').text('Đã kết nối');
        }

        $(document).on('click', '.remove-page-collect', function(){
            let idRemove = $(this).parents('.card-item-list-category-check').data('id');
            $(this).parents('.card-item-list-category-check').remove();
            $(`.card-item-list-category[data-id="${idRemove}"]`).removeClass('active');
            $(`.card-item-list-category[data-id="${idRemove}"]`).find('.checkbox-control-page-item-input').prop('checked', false);
            $(`.card-item-list-category[data-id="${idCard}"]`).find('.manage-page-card-item-content-title-status').text('Chưa kết nối');
        });
        checkPageActiveConnect();
    });
});

/** Count page connected **/
function checkPageActiveConnect(){
    if($('.item-card-menu-list-check').find('.card-item-list-category-check').length !== 0){
        $('#count-all-page-collect').removeClass('d-none');
        $('#btn-close-create-specifications').prop('disabled',false);
        $('#btn-close-create-connect-page-choosen').prop('disabled',false);
    } else {
        $('#count-all-page-collect').addClass('d-none');
        $('#btn-close-create-specifications').prop('disabled',true);
        $('#btn-close-create-connect-page-choosen').prop('disabled',true);
    }
    let count = $('.item-card-menu-list-check').find('.card-item-list-category-check').length;
    let html = `<span>- Đã chọn: ${count} trang</span>`;
    $('#count-all-page-collect').html(html);
}
/** Get all page facebook **/
async function getListPageFacebook() {
    let method = 'get',
        url = 'config-facebook.get-all-page',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#manage-page-connect')]);
    $('#list-page-facebook').html(res.data[0]);
    if(parseInt(res.data[2]) > 0) {
        $('#count-all-page-collect').removeClass('d-none');
        $('#count-all-page-collect').html(`<span> - Đã chọn ${res.data[2]} trang</span>`);
        $('#btn-close-create-specifications').prop('disabled',false);
        $('#btn-close-create-connect-page-choosen').prop('disabled',false);
    } else {
        $('#count-all-page-collect').html('');
        $('#count-all-page-collect').addClass('d-none');
        $('#btn-close-create-specifications').prop('disabled',true);
        $('#btn-close-create-connect-page-choosen').prop('disabled',true);
    }
    checkAllPageConnect();
}
/** Choose pages to connect with dashboard **/
async function connectPage() {
    let listID = [];
    $('.card-item-list-category-check.d-flex.align-items-center').each(function (i, e) {
        listID.push($(this).data('id'));
    });
    let method = 'post',
        url = 'config-facebook.select-page',
        params = {
            id: listID
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    if (res.data['status-connect'] === '1') {
        sweetAlertTimeoutComponent('Thông báo', 'Kết nối thành công!', 'success');
        $('.checkbox-checked').each(function (i, e) {
            if ($(this).data('type') === 0) {
                $(this).data('type', 1);
                $(this).parents('.info-page').find('div.d-flex').html('<span class="status text-success">Đã kết nối</span>');
            }
        });
        window.location.href = '/message-facebook';
    } else {
        sweetAlertTimeoutComponent('Thông báo', 'Kết nối thất bại vui lòng thử lại!', 'danger');
    }
}

function checkAllPageConnect() {
    $('.card-item-list-category.pointer.d-flex.align-items-center').each(function () {
        if($(this).hasClass('active')){
            let namePage = $(this).find('.manage-page-card-item-content-title').text();
            let imgPage = $(this).find('.manage-page-card-item-img').attr('src');
            let idPage = $(this).data('id');
            $('.item-card-menu-list-check').append(`<div class="card-item-list-category-check d-flex align-items-center" data-id="${idPage}">
                                                                <div class="img-logo-card-item-check">
                                                                    <img class="manage-page-card-item-img-right" src="${imgPage}">
                                                                </div>
                                                                <div class="title-information-card-item-check">
                                                                    <div class="content-title-check-01">
                                                                        <p class="manage-page-card-item-content-title-check-01">${namePage}</p>
                                                                    </div>
                                                                </div>
                                                                <i class="fa fa-times-circle remove-page-collect"></i>
                                                            </div>`);
        }
    });
}
