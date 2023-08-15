$(function () {
    addLoading('update-session-brand');
    addLoading('update-session-branch');
    $('#change-restaurant-branch-id li').on('click', async function () {
        let title = 'Cảnh báo',
            content = 'Bạn vừa thay đổi thương hiệu, vui lòng tải lại trang !',
            icon = 'warning';
        sweetAlertComponent(title, content, icon).then(async (result) => {
            if (result.value) {
                $('#restaurant-branch-id-selected img').attr('src', $(this).find('img').attr('src'));
                $('#restaurant-branch-id-selected span').text($(this).find('span').text());
                $('#restaurant-branch-id-selected span').attr('data-value', $(this).find('span').data('value'));
                updateSessionBrand($(this).find('span').data('value'));
            }
        })
    });
    $(document).on('select2:open', () => {
        document.querySelector('.select2-container--open .select2-search__field').focus();
    });

    // $('#change_branch').on('change', async function () {
    //     await updateSessionBranch($(this).val());
    //     loadData();
    //     $(".tooltip").tooltip("hide");
    // });
    let packageName = $('.package-name-restaurant span').text().slice(-11)
    window.addEventListener("resize", function (){
        // if(window.innerWidth <= 1200 && $('.package-name-restaurant').text().length > 13){
        if(window.innerWidth <= 1150){
            // $('.package-name-restaurant span').text('Gói QT ' + packageName)
            $("#new_header .top-area > ul.setting-area > li:nth-child(1)").find($(".fa")).removeClass('fa-times').addClass('fa-bars');
            $("#new_header .top-area > ul.setting-area > li:nth-child(2)").removeAttr("style");
            $("#new_header .top-area > ul.setting-area > li:nth-child(3)").removeAttr("style");
            $("#new_header .top-area > ul.setting-area > li:nth-child(4)").removeAttr("style");
            $("#new_header .top-area > ul.setting-area > li:nth-child(5)").removeAttr("style");
        }else{
            $('.package-name-restaurant span').text('Gói Quản Trị ' + packageName)
        }
    });

    // if(window.innerWidth <= 1150){
    //     $('.package-name-restaurant span').text('Gói QT ' + packageName)
    // }

    if(window.innerWidth <= 1200){
        $("#new_header .top-area > ul.setting-area > li:nth-child(1)").find($(".fa")).removeClass('fa-times').addClass('fa-bars');
        $("#new_header .top-area > ul.setting-area > li:nth-child(1)").css('display', 'block !important');
        $("#new_header .top-area > ul.setting-area > li:nth-child(2)").removeAttr("style");
        $("#new_header .top-area > ul.setting-area > li:nth-child(3)").removeAttr("style");
        $("#new_header .top-area > ul.setting-area > li:nth-child(4)").removeAttr("style");
        $("#new_header .top-area > ul.setting-area > li:nth-child(5)").removeAttr("style");
    }

    $(document).on('click', '.menu-bars-header', function (){
        if($(this).attr('data-click-state') == 1) {
            $(this).attr('data-click-state', 0);
            $(this).find($(".fa")).removeClass('fa-times').addClass('fa-bars');
            $("#new_header .top-area > ul.setting-area > li:nth-child(2)").removeAttr("style");
            $("#new_header .top-area > ul.setting-area > li:nth-child(3)").removeAttr("style");
            $("#new_header .top-area > ul.setting-area > li:nth-child(4)").removeAttr("style");
            $("#new_header .top-area > ul.setting-area > li:nth-child(5)").removeAttr("style");
        }
        else {
            $(this).attr('data-click-state', 1);
            $(this).find($(".fa")).removeClass('fa-bars').addClass('fa-times');
            $("#new_header .top-area > ul.setting-area > li:nth-child(2)").attr('style' , 'display : block !important');
            $("#new_header .top-area > ul.setting-area > li:nth-child(3)").attr('style' , 'display : block !important');
            $("#new_header .top-area > ul.setting-area > li:nth-child(4)").attr('style' , 'display : block !important');
            $("#new_header .top-area > ul.setting-area > li:nth-child(5)").attr('style' , 'display : block !important');
        }

    })


})

async function updateSessionBrand(id) {
    let method = 'get';
    let url = 'update-session-brand';
    let params = {brand: id};
    let data = null;
    let res = await axiosTemplate(method, url, params, data);
    if (res.data[0] === true) {
        window.location.reload();
    } else {
        ErrorNotify($('#error-post-data-to-server').text());
    }
}

async function updateSessionBrandNew(r, hasAllBranch = 0) {
    let method = 'get';
    let url = 'update-session-brand';
    let params = {brand: r.find('option:selected').val(), type: r.parents('.select-filter-dataTable').find('.select-branch').length, hasAllBranch};
    let data = null;
    let res = await axiosTemplate(method, url, params, data);
    if (res.data[0] === true) {
        if(r.parents('.select-filter-dataTable').find('.select-branch').length > 0 ){
            $('.select-branch').html(res.data[1])
            await updateSessionBranch(r.parents('.select-filter-dataTable').find('.select-branch').val());
            $('.select-branch').val(r.parents('.select-filter-dataTable').find('.select-branch').val()).trigger('change.select2')
        }else {
            loadData();
        }
    } else {
        ErrorNotify($('#error-post-data-to-server').text());
    }
}

async function updateSessionBranch(id) {
    let method = 'get';
    let url = 'update-session-branch';
    let params = {branch: id};
    let data = null;
    await axiosTemplate(method, url, params, data);
    console.log('update')
    loadData();
}


async function changeBranchDefaultShared() {
    return true;
    try {
        if ($('#change_branch').val() === '-1') {
            let branch = $('#branch-default').val();
            $('#change_branch').val(branch).change();
        }
        $("#change_branch option[value='-1']").remove();
    } catch (e) {
        console.log('Error change branch default : ' + e);
    }
}

async function changeBranchAllShared() {
    return true;
    try {
        if ($('#change_branch').val() !== '-1') {
            $("#change_branch > option").each(function () {
                $(this).remove();
            });
            $('#change_branch').append('<option value="-1" selected >Toàn chi nhánh</option>');
        }
        // $('#change_branch').parent().addClass('d-none');
    } catch (e) {
        console.log('Error change branch all : ' + e);
    }
}

async function changeBrandAllShared() {
    return true;
    try {
        await changeBranchAllShared();
        await changeRestaurantBrandsSelect('-1');
        $('#restaurant-branch-id-selected').addClass('d-none')
    } catch (e) {
        console.log('Error change branch all : ' + e);
    }
}

async function addBranchAllShared() {
    return true;
    try {
        let flag = true;
        if ($('#change_branch').val() !== '-1') {
            $("#change_branch > option").each(function () {
                if ($(this).val() === '-1') {
                    flag = false;
                    return false;
                }
            })
        }
        if (flag) {
            $('#change_branch').prepend('<option value="-1" selected >Toàn chi nhánh</option>');
        }
    } catch (e) {
        console.log('Error change branch all : ' + e);
    }
}

async function addBrandAllShared() {
    return true;
    try {
        if ($('#restaurant-branch-id-selected span').data('value') != '-1') {
            $('#restaurant-branch-id-selected span').attr('data-value', -1);
            $('#restaurant-branch-id-selected span').text('Toàn thương hiệu');
            addBranchAllShared();
        }
    } catch (e) {
        console.log('Error change branch all : ' + e);
    }
}

async function changeBranchSelect(branch_id) {
    return true;
    addLoading('setting.update-session-branch', '.page-body');
    try {
        let method = 'get';
        let url = 'setting.update-session-branch';
        let params = {
            branch_id_new: branch_id
        };
        let data = null;
        await axiosTemplate(method, url, params, data);
    } catch (e) {
        console.log('Error change branch: ' + e);
    }
}

async function changeBranch(restaurant_brand_id) {
    return true;
    addLoading('setting.change-branch-by-brands', '.page-body');
    let restaurant_brands_id = restaurant_brand_id;
    try {
        let method = 'get';
        let url = 'setting.change-branch-by-brands';
        let params = {restaurant_brands_id: restaurant_brands_id};
        let data = null;
        let res = await axiosTemplate(method, url, params, data);
        if (res.status === 200) {
            $('#change_branch').html(res.data[0]);
        }
    } catch (e) {
        console.log('Error change branch: ' + e);
    }
}

async function changeRestaurantBrandsSelect(restaurant_brands_id) {
    return true;
    addLoading('setting.update-session-restaurant-brands', '.page-body');
    try {
        let method = 'get';
        let url = 'setting.update-session-restaurant-brands';
        let params = {restaurant_brands_id: restaurant_brands_id};
        let data = null;
        await axiosTemplate(method, url, params, data);
    } catch (e) {
        console.log('Error change branch: ' + e);
    }
}
async function getBrach(restaurant_brands_id){
    let method = 'get',
        url = 'get-list-branch',
        params = {restaurant_brand_id: restaurant_brands_id},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    return res.data[0];
}
