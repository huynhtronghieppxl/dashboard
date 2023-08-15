let checkCreateFolderSettingBrand = 0, checkRemoveFolderSettingBrand = 0, checkUpdateNameFolderSettingBrand = 0;
$(function () {
    $('#search-folder-setting-branch').on('keyup', function () {
        let g = removeVietnameseStringLowerCase($(this).val());

        $("#data-folder-setting-branch .name-folder-setting-branch").each(function () {
            let s = removeVietnameseStringLowerCase($(this).val());
            $(this).closest('.item-folder-setting-branch')[s.indexOf(g) !== -1 ? 'show' : 'hide']();
        });
    });
    $('#create-folder-setting-branch').on('click', function () {
        if ($('.item-folder-setting-branch').length === 9) {
            $('.item-folder-setting-branch:eq(8)').remove();
        }
        if ($('#data-folder-setting-branch').text() === '') {
            $('#data-folder-setting-branch').html('');
            $('#nav-media-setting-branch').removeClass('d-none');
        }
        $('#data-folder-setting-branch').prepend(`<div class="col-4 item-folder-setting-branch" data-id="">
                <div class="card-block2 card card-border-default">
                    <div class="job-cards">
                        <div class="media" style="padding-top: 10px;">
                            <a class="media-left media-middle" href="#">
                                <img src="images/folder-icon.webp" style="width: auto; height: 60px">
                            </a>
                            <div class="media-body">
                                <div class="company-name m-b-10">
                                    <div class="row">
                                        <input
                                               class="name-folder-setting-branch col-9" data-validate="empty" data-name="Thư mục" value="Thư mục" readonly/>
                                               <span class="update-name-folder" data-bs-toggle="tooltip" title="Sửa tên thư mục"><i class="ti-pencil"></i></span>
                                               <span class="save-name-folder d-none" data-bs-toggle="tooltip" title="Xác nhận"><i class="ion-ios-checkmark icon-check-update-name"></i></span>
                                        <i class="text-muted f-14"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="media-right remove-foder" data-bs-toggle="tooltip" title="Xoá thư mục">
                                <i class="ti-trash"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`);
        createFolderSettingBrand();
    });

    $(document).on('click', '.item-folder-setting-branch .ti-trash', function () {
        let title = 'Xoá thư mục',
            content = 'Thư mục đã xoá sẽ không thể khôi phục lại !',
            icon = 'warning';
        sweetAlertComponent(title, content, icon).then(async (result) => {
            if (result.value) {
                $(this).parent().parent().parent().parent().parent().remove();
                removeFolderSettingBrand($(this));
                if ($('#data-folder-setting-branch').text() === '') {
                    $('#data-folder-setting-branch').html(`<div class="empty-datatable-custom" style="width: 100%;text-align: center;"><img src="../../../../files/assets/images/nodata-datatable2.png"></div>`);
                    $('#nav-media-setting-branch').addClass('d-none');
                }
            }
        })
    });
    $(document).on('mouseup', function (e) {
        let container = $('.name-folder-setting-branch');
        if (!container.is(e.target) && container.has(e.target).length === 0 && !$('.name-folder-setting-branch').hasClass('d-none')) {
            if ($('.name-folder-setting-branch').val() !== '') {
                $(".save-name-folder").addClass('d-none');
                $(".save-name-folder").parents('.item-folder-setting-branch').find('.update-name-folder').removeClass('d-none');
                $(".save-name-folder").parents('.item-folder-setting-branch').find('.name-folder-setting-branch').prop('readonly', true);
                $(".save-name-folder").parents('.item-folder-setting-branch').find('.name-folder-setting-branch').removeClass('border-name');
            }
        } else {
            $('.icon-sticker-footer-visible-message').removeClass('active');
        }
    });

    $(document).mouseup(function (e){
        if(e.target.className == 'save-name-folder d-none' || e.target.className == 'ion-ios-checkmark icon-check-update-name' || e.target.className == 'name-folder-setting-branch col-9 border-name'){
            return false
        }else{
            $('.name-folder-setting-branch').each(function (){
                $(this).val($(this).attr('data-name'))
            })
        }
    })

    $(document).on('click', '.update-name-folder', function (event) {
        $(this).addClass('d-none');
        $(this).parents('.item-folder-setting-branch').find('.save-name-folder ').removeClass('d-none');
        $(this).parents('.item-folder-setting-branch').find('.save-name-visible-message').removeClass('d-none');
        $(this).parents('.item-folder-setting-branch').find('.name-folder-setting-branch').prop('readonly', false);
        $(this).parents('.item-folder-setting-branch').find('.name-folder-setting-branch').addClass('border-name');
        // drawDataValidate($('#data-folder-setting-branch'));
    })

    $(document).on('click', '.save-name-folder', function (event) {
            updateNameFolderSettingBrand($(this).parents('.item-folder-setting-branch').find('.name-folder-setting-branch '));
    })
    $(document).on('focusout input change onkeypress', '.name-folder-setting-branch', function () {
        $(this).removeAttr('style');
    });

    $('#create-media-setting-branch').on('click', function () {
        $('#modal-create-media-setting-branch').modal('show');
        checkUploadMediaBranch = 0;
    });
    $(document).on('dblclick', '.item-folder-setting-branch', function () {
        if ($(this).find('.name-folder-setting-branch').hasClass('border-name')) {
            return false;
        } else {
            $('#div-folder-setting-branch').addClass('d-none');
            $('#div-media-setting-branch').removeClass('d-none');
            $('#name-folder-media-setting-branch').text($(this).find('input').val());
            $('#name-folder-media-setting-branch').data('id', $(this).data('id'));
            dataMediaBranch();
        }
    });
})

async function createFolderSettingBrand() {
    if(checkCreateFolderSettingBrand === 1) return false;
    let method = 'post',
        url = 'branch-setting.create-folder',
        params = null,
        data = {branch: branchSettingId};
    checkCreateFolderSettingBrand = 1;
    let res = await axiosTemplate(method, url, params, data);
    checkCreateFolderSettingBrand = 0;
    let text = '';
    switch(res.data.status) {
        case 200:
            $('.item-folder-setting-branch:eq(0)').attr('data-id', res.data.data._id);
            $('.item-folder-setting-branch:eq(0) .name-folder-setting-branch').val(res.data.data.folder_name);
            $('.item-folder-setting-branch:eq(0) .text-muted').text(res.data.data.created_at);
            $('[data-bs-toggle="tooltip"]').tooltip();
            text = 'Thêm mới thành công';
            SuccessNotify(text);
            dataFolderBranch();
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
            WarningNotify(text)
    }
}

async function removeFolderSettingBrand(r) {
    if(checkRemoveFolderSettingBrand === 1) return false;
    let category_id = r.parents('.item-folder-setting-branch').data('id');
    let method = 'POST',
        url = 'branch-setting.remove-folder',
        params = null,
        data = {category_id: category_id};
    checkRemoveFolderSettingBrand = 1;
    let res = await axiosTemplate(method, url, params, data);
    checkRemoveFolderSettingBrand = 0;
    let text = '';
    switch(res.data.status) {
        case 200:
            text = 'Xóa thành công';
            SuccessNotify(text);
            dataFolderBranch();
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            ErrorNotify(text);
            return false;
            break;
        default:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            WarningNotify(text);
            return false;
    }
}

async function updateNameFolderSettingBrand(r) {
    if(checkUpdateNameFolderSettingBrand === 1) return false;
    if (!checkValidateSave($('.item-folder-setting-branch'))) return false;
    let method = 'post',
        url = 'branch-setting.update-name-folder',
        params = null, data = {
        id: r.parents('.item-folder-setting-branch').data('id'), name: r.val(), branch: branchSettingId,
    };
    checkUpdateNameFolderSettingBrand = 1;
    let res = await axiosTemplate(method, url, params, data, [$('#data-folder-setting-branch')]);
    checkUpdateNameFolderSettingBrand = 0;
    let text = '';
    switch(res.data.status) {
        case 200:
            text = 'Chỉnh sửa thành công';
            SuccessNotify(text);
            r.parent().find('.name-folder-setting-branch').attr('value', res.data.data.folder_name);
            r.parent().find('.name-folder-setting-branch').attr('data-name', res.data.data.folder_name);
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            ErrorNotify(text);
            r.removeAttr('readonly')
            r.addClass('border-name')
            r.parents('.company-name').find('.update-name-folder').addClass('d-none');
            r.parents('.company-name').find('.save-name-folder').removeClass('d-none');
            return false;
            break;
        default:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            WarningNotify(text);
            r.removeAttr('readonly')
            r.addClass('border-name')
            r.parents('.company-name').find('.update-name-folder').addClass('d-none');
            r.parents('.company-name').find('.save-name-folder').removeClass('d-none');
            return false;
    }
}

let currentPageFolder = 1, currentPageMedia = 1, limitItemFolder = 9, limitItemMedia = 7, lengthFolderBranch = 0;

async function dataFolderBranch() {
    let method = 'get',
        url = 'branch-setting.data-folder',
        params = {
            branch: branchSettingId,
            page: currentPageFolder,
            limit: limitItemFolder,
            key: $('#search-folder-setting-branch').val()
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#data-folder-setting-branch')]);
    await $('#data-folder-setting-branch').html(res.data[0]);
    lengthFolderBranch = res.data[1].data.total_record;
    setupPaginationFolder(res.data[1].data.total_record);
    if (lengthFolderBranch === 0) {
        $('#data-folder-setting-branch').html(`<div class="empty-datatable-custom" style="width: 100%;text-align: center;"><img src="../../../../files/assets/images/nodata-datatable2.png"></div>`);
        $('#nav-media-setting-branch').addClass('d-none');
    } else if (lengthFolderBranch === 9) {
        $('#nav-media-setting-branch li:eq(1) a').click()
        $('#nav-media-setting-branch').removeClass('d-none');
    } else {
        $('#nav-media-setting-branch').removeClass('d-none');
    }
    $('[data-bs-toggle="tooltip"]').tooltip()
}

function setupPaginationFolder(length) {
    $('.simple-pagination').pagination({
        items: length,
        itemsOnPage: limitItemFolder,
        currentPage: currentPageFolder,
        prevText: "&laquo;",
        nextText: "&raquo;",
        hrefTextPrefix: "javascript:void(0)",
        onPageClick: function (pageNumber) {
            currentPageFolder = pageNumber;
            dataFolderBranch();
        }
    });
}

async function dataMediaBranch() {
    let method = 'get',
        url = 'branch-setting.data-media',
        params = {
            folder: $('#name-folder-media-setting-branch').data('id'),
            page: currentPageMedia,
            limit: limitItemMedia,
            key: $('#search-media-setting-branch').val()
        }, data = null;
    let res = await axiosTemplate(method, url, params, data, [$("#create-media-setting-branch")]);
    await $('#data-media-setting-branch .item-media-setting-branch').remove();
    await $('#create-media-setting-branch').after(res.data[0]);
    setupPaginationMedia(res.data[1].data.total_record);
}

function setupPaginationMedia(length) {
    $('.simple-pagination').pagination({
        items: length,
        itemsOnPage: limitItemMedia,
        currentPage: currentPageMedia,
        prevText: "&laquo;",
        nextText: "&raquo;",
        hrefTextPrefix: "javascript:void(0)",
        onPageClick: function (pageNumber) {
            currentPageMedia = pageNumber;
            dataMediaBranch();
        }
    });
}
