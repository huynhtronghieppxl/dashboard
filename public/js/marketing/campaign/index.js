let indexCampaign,typeTabIndexCampaign = 100, typeTabAfterPayment = 0, typeTabSendMessage = 0, typeOneGetOne = 0,
tabIndexCampaign = 100;

$(function () {
    if(getCookieShared('campaign-marketing-user-id' + idSession)){
        let data = JSON.parse(getCookieShared('campaign-marketing-user-id' + idSession));
        typeTabIndexCampaign = data.tab;
        typeTabAfterPayment = data.typeTabPayment;
        typeTabSendMessage = data.typeTabSendMessage;
        typeOneGetOne = data.typeOneGetOne;
        tabIndexCampaign = data.tabIndexCampaign;
    }
    switch (typeTabIndexCampaign){
        case "0":
        $('#div-layout-campaign button.btn-grd-primary[data-type="' + typeTabIndexCampaign + '"]').click();
        $('#div-layout-send-message-campaign .nav-link[data-type="' + typeTabSendMessage + '"]').click();
            break;
        case "1":
            $('#div-layout-campaign button.btn-grd-primary[data-type="' + typeTabIndexCampaign + '"]').click();
            $('#div-layout-after-payment-campaign .nav-link[data-type="' + typeTabAfterPayment + '"]').click();
            break;
        case "7":
            $('#div-layout-campaign button.btn-grd-primary[data-type="' + typeTabIndexCampaign + '"]').click();
            $('#div-layout-one-get-one-campaign .nav-link[data-type="' + typeOneGetOne + '"]').click();
            break;
        case "8":
            $('#div-layout-campaign button.btn-grd-primary[data-type="' + typeTabIndexCampaign + '"]').click();
            break;
        default:
    }
    $('#div-layout-campaign button.btn-grd-primary').on('click',function (){
        typeTabIndexCampaign = $(this).attr('data-type');
        updateCookie();
    })
    $('#div-layout-send-message-campaign .nav-link').on('click',function (){
        typeTabSendMessage = $(this).attr('data-type');
        updateCookie();
    })
    $('#div-layout-after-payment-campaign .nav-link').on('click',function (){
        typeTabAfterPayment = $(this).attr('data-type');
        updateCookie();
    })
    $('#div-layout-one-get-one-campaign .nav-link').on('click',function (){
        typeOneGetOne = $(this).attr('data-type');
        updateCookie();
    })

    $('#button-service-1').on('click', function () {
        switch (indexCampaign) {
            case 0:
                openModalCreateSendMessageCampaign();
                break;
            case 1:
                openModalCreateAfterPaymentCampaign();
                break;
            case 7:
                openCreateOneGetOneMarketing();
                break;
        }
    })
    ckEditorTemplate(['content-create-send-message-campaign']);
})

function updateCookie(){
    saveCookieShared('campaign-marketing-user-id' + idSession, JSON.stringify({
        'tab' : typeTabIndexCampaign,
        'typeTabPayment' : typeTabAfterPayment,
        'typeTabSendMessage' : typeTabSendMessage,
        'typeOneGetOne' : typeOneGetOne,
        'tabIndexCampaign' : tabIndexCampaign
    }))
}

function openLayoutCampaign(index) {
    indexCampaign = index;
    $('#button-service-1').removeClass('d-none');
    $('#div-layout-campaign').addClass('d-none');
    switch (index) {
        case 0:
            $('#div-layout-send-message-campaign').removeClass('d-none');
            loadDataSendMessage();
            break;
        case 1:
            $('#div-layout-after-payment-campaign').removeClass('d-none');
            loadDataAfterPayment();
            break;
        case 2:
            $('#div-layout-birthday-campaign').removeClass('d-none');
            break;
        case 7:
            $('#div-layout-one-get-one-campaign').removeClass('d-none');
            loadDataOneGetOne();
            break;
        case 8:
            $('#div-layout-store-campaign-campaign').removeClass('d-none');
            loadBeerStoreCampaign();
            break;
    }
}

function loadData(){
    switch (indexCampaign) {
        case 0:
            loadDataSendMessage();
            break;
        case 1:
            loadDataAfterPayment();
            break;
        case 2:
            break;
        case 7:
            loadDataOneGetOne();
            break;
        case 8:
            loadBeerStoreCampaign();
            break;
    }
}

function backLayoutCampaign() {
    typeTabIndexCampaign = 100;
    updateCookie();
    $('#button-service-1').addClass('d-none');
    $('.item-campaign').addClass('d-none');
    $('#div-layout-campaign').removeClass('d-none');
}
