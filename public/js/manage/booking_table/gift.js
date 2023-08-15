let dataTableGiftCreateFoodBookingManage, dataTableGiftUpdateFoodBookingManage, checkDataGiftCreateFoodBooking = 0;

async function dataGiftBooking(){
    let method = 'get',
        url = 'booking-table-manage.data-gift',
        brand = $('#restaurant-branch-id-selected span').attr('data-value'),
        params = {branch: brand},
        data = null;
    let res = await axiosTemplate(method, url, params, data,  [$('#loading-modal-gift-booking-table-manage')]);
    await dataGiftCreateBookingTable(res.data[0].original.data);
}

function dataGiftCreateBookingTable(data){
    let item = `
        <div class="search-gift-booking-table-wrapper">
            <input type="search" placeholder="Tìm kiếm" class="search-gift-booking-table">
        </div>
    `
    if (data.length === 0){
        item = `
            <div id="data-gift-empty-booking-table">
                <img src="../../../../files/assets/images/nodata-datatable2.png">
            </div>
        `
    }
    for (let i = 0; i < data.length; i++) {
        if(data[i].restaurant_brand_id == $('.select-brand').val()) {
            item += `
            <li data-id="${data[i].id}">
                <div class="d-flex align-items-center justify-content-between row-wrap">
                    <div>
                        <img onerror="imageDefaultOnLoadError($(this))" src="${data[i].image_url}" class="img-inline-name-data-table" />
                        <label class="name-inline-data-table mb-0">
                            ${data[i].name}<br/>
                        </label>
                    </div>
                    <div class="checkbox-fade fade-in-primary m-0">
                        <label class="mb-0">
                            <input type="checkbox" onclick="totalGiftCreateBookingTable($(this))" data-id="${data[i].id}"/>
                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                        </label>
                    </div>
                </div>
            </li>
        `
        }
    }
    $('#booking-table-create-gift').html(item)
    $('#booking-table-update-gift').html(item)
}

function dataGiftDetailBookingTable(data){
    let item = `
        <div class="search-gift-booking-table-wrapper">
            <input type="search" placeholder="Tìm kiếm" class="search-gift-booking-table">
        </div>
    `
    if (data.length === 0){
        item = `
            <div id="data-gift-empty-booking-table">
                <img src="../../../../files/assets/images/nodata-datatable2.png">
            </div>
        `
    }
    for (let i = 0; i < data.length; i++) {
        item += `
            <li data-id="${data[i].restaurant_gift_id}">
                <div class="d-flex align-items-center justify-content-between row-wrap">
                    <div>
                        <img onerror="imageDefaultOnLoadError($(this))" src="${data[i].image_url}" class="img-inline-name-data-table" />
                        <label class="name-inline-data-table mb-0">
                            ${data[i].name}<br/>
                        </label>
                    </div>
                </div>
            </li>
        `
    }
    $('#booking-table-detail-gift').html(item)
}

function closeModalGiftBooking(){
    $('#modal-gift-booking-table-manage').modal('hide');

}
function closeModalUpdateGiftBooking(){
    $('#modal-update-gift-booking-table-manage').modal('hide');
}
