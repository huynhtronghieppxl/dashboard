let idFoodDetailMangae, branchIdFood,idCategoryFoodDetailManage;
if ($('.select-branch').parent().hasClass('d-none')){
    branchIdFood = -1;
}else {
    branchIdFood = $('.select-branch').val();
}
async function openModalDetailFoodBrandManage(r) {
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalDetailFoodManage();
    });
    idFoodDetailMangae = r.data('id');
    idCategoryFoodDetailManage = r.data('category-type');
    switch (r.data('type')) {
        case 0:
            openModalFoodDetailFoodBrandManage();
            break;
        case 1:
            $('#detail-price-by-area-food-manage').parents('li').addClass('d-none');
            openModalDetailComboFoodBrandManage();
            break;
        case 2:
            openModalDetailAddtionFoodBrandManage();
            break;
        case 3:
            openModalFoodDetailFoodBrandManage();
            break;
        case 4:
            openModalFoodDetailFoodBrandManage();
            break;
    }

    if ($('#change_branch').parent().hasClass('d-none')){
        $('#detail-price-by-area-food-branch-manager').addClass('d-none');
        $('#detail-price-by-area-detail-manage').addClass('d-none');
    }else {
        $('#detail-price-by-area-food-manage').removeClass('d-none');
        $('#detail-price-by-area-food-branch-manager').removeClass('d-none');
        $('#detail-price-by-area-detail-manage').removeClass('d-none');
    }

}



