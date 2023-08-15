let checkSaveUpdateKaizenBonusData = 0;
$(function () {
    $(document).on('click', '#btn-save-kaizen-bonus-data', function () {
        saveUpdateUpdateKaizenBonusData();
    });
});

async function saveUpdateUpdateKaizenBonusData() {
    if (checkSaveUpdateKaizenBonusData === 1) return false;
    if(!checkValidateSave($('#content-body-techres'))) return false;
    let bonus = [];
    tableKaizenBonusData.rows().every(function () {
        let row = $(this.node());
        bonus.push(removeformatNumber(row.find('td:eq(2) input').val()));
    });
    checkSaveUpdateKaizenBonusData = 1;
    let method = 'post',
        url = 'kaizen-bonus-data.update',
        params = null,
        data = {
            bonus: bonus,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#table-kaizen-bonus-data')]);
    checkSaveUpdateKaizenBonusData = 0;
    $('.label-input-amount').addClass('text-right')
    if (res.data.status === 200) {
        let text = $('#success-update-data-to-server').text();
        SuccessNotify(text);
        // tableKaizenBonusData.rows().every(function () {
        //     let row = $(this.node());
        //     row.find('td:eq(2) label').text(row.find('td:eq(2) input').val());
        //     row.find('td:eq(4)').text(res.data.time);
        // });
        loadData();
        $('.not-edit-kaizen-bonus-data').removeClass('d-none');
        $('.edit-kaizen-bonus-data').addClass('d-none');
        $('#btn-close-kaizen-bonus-data').addClass('d-none');
        $('#btn-save-kaizen-bonus-data').addClass('d-none');
        $('#btn-update-kaizen-bonus-data').removeClass('d-none');
        $('#table-kaizen-bonus-data .validate-table-validate').removeClass('input-group');
        $('#table-kaizen-bonus-data .validate-table-validate').removeClass('border-group');
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
    }
}

