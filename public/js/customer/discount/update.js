let saveUpdateDiscount,
    idUpdateDiscount,
    nameUpdateDiscount;


function openModalUpdateCardValue(r) {
    idUpdateDiscount = r.data('id')
    saveUpdateDiscount = 0;
    $('#modal-update-discount').modal('show');
    $('#select-material-update-discount').select2({
        dropdownParent: $('#modal-update-discount'),
    });
    $('#select-material-create-in-inventory-manage').val(r.data('type')).trigger('change.select2');
    dataUpdateDetail();
}
 async  function  dataUpdateDetail() {
        let method = 'get',
            url = 'discount.detail',
            params = {
                id: idUpdateDiscount,
            },
            data = null;
         let res = await  axiosTemplate(method, url, params, data );
}
async function saveModalUpdateGift() {
/*    if(!checkValidateSave($('#loading-modal-create-discount-customer'))) return false*/
    let method = 'post',
        params = null,
        data = {
            id : idUpdateDiscount
        }
    let res = await  axiosTemplate(method, url, params, data, [$('#loading-modal-create-discount-customer')]);
    console.log(res)
    saveUpdateDiscount = 0;
    if (res.data.status === 200) {
        let text = $('#success-update-data-to-server').text();
        SuccessNotify(text);
        closeModalUpdateGift();
        loadData();
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
    }
}

function closeModalUpdateGift() {
    $('#modal-update-discount').modal('hide');
}
