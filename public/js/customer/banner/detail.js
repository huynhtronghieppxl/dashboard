let idDetailSetBanner
function openModalDetailBanner(r){
    $('#modal-detail-set-banner-advertisement').modal('show')
    shortcut.add('ESC', function (){
        closeModalDetailBanner()
    })
    idDetailSetBanner = r.data('id')
    dataDetail()
}

async function dataDetail(){
    let method = 'get',
        url = 'banner-advertisement.detail',
        params = {
            id: idDetailSetBanner,
        },
        data = null
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-detail-set-banner-advertisement')])
    $('#image-detail-banner-set-banner-advertisement').attr('src', res.data.data.domain + res.data.data.image_url)
    $('#name-detail-set-banner-advertisement').text(res.data.data.name)
    $('#url-detail-set-banner-advertisement').text(res.data.data.landing_page_url)
    if(res.data.data.status === 3){
        $('#detail-reason-set-banner-advertisement').removeClass('d-none')
        $('#reason-detail-set-banner-advertisement').text(res.data.data.reason)
    }
    else{
        $('#detail-reason-set-banner-advertisement').addClass('d-none')
    }
   switch (res.data.data.type) {
       case 0:
           $('#type-detail-set-banner-advertisement').text('Kho beer');
           $('#ulr-set-banner-advertisement').addClass('d-none');
           break;
       case 1:
           $('#type-detail-set-banner-advertisement').text('Quà tặng');
           $('#ulr-set-banner-advertisement').addClass('d-none');
           break;
       case 2:
           $('#type-detail-set-banner-advertisement').text('Web');
           $('#ulr-set-banner-advertisement').removeClass('d-none');
           break;

   }
}

function closeModalDetailBanner(){
    $('#modal-detail-set-banner-advertisement').modal('hide')
    shortcut.remove('ESC')
    $('#image-detail-banner-set-banner-advertisement').attr('src', '/images/admin/default.jpeg')
    $('#name-detail-set-banner-advertisement').text('')
    $('#url-detail-set-banner-advertisement').text('')
}
