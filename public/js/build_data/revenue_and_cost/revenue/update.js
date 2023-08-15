let thisUpdateRevenueData,checkSaveUpdateRevenueData = 0, idUpdateCRevenueData;
async function openModalUpdateRevenueData(r) {
    thisUpdateRevenueData = r
    idUpdateCRevenueData = r.data('id')
    $('#modal-revenue-data-detail').modal('show');
    shortcut.add('F4', function () {
        saveModalUpdateRevenueData();
    });
    shortcut.add('ESC', function () {
        closeModalUpdateRevenueData();
    })
    $('#name-update-revenue-data').val(r.data('name'));
}

async function getTypeRevenueDataUpdate() {
    let method = 'get',
        url = 'revenue-data.cost-type',
        params = null,
        data = {};
    let res = await axiosTemplate(method, url, params, data, [$('#select-update-revenue-data'), $('#name-update-revenue-data')]);
    if (res) {
        $('#select-update-revenue-data').html(res.data[0]);
    }
}

async function saveModalUpdateRevenueData() {
    if(checkSaveUpdateRevenueData === 1) return false;
    if (!checkValidateSave($('#modal-revenue-data-detail'))) return false;
    let name = $('#name-update-revenue-data').val(),
        addition_fee_reason_type_id = $('#select-update-revenue-data').find('option:selected').val();
    checkSaveUpdateRevenueData = 1;
    let method = 'post',
        url = 'revenue-data.update',
        params = null,
        data = {
            id: idUpdateCRevenueData,
            name: name,
        };
    let text = $('#success-update-data-to-server').html();
    if (thisUpdateRevenueData.data('name') === data.name) {
        SuccessNotify(text);
        closeModalUpdateRevenueData();
        checkSaveUpdateRevenueData = 0;
        return
    }
    let res = await axiosTemplate(method, url, params, data, [$('#modal-revenue-data-detail-content')]);
    checkSaveUpdateRevenueData = 0;
    switch (res.data.status){
        case 200:
            SuccessNotify(text);
             thisUpdateRevenueData.parents('tr').find('td:eq(1)').text(res.data.data.name);
             thisUpdateRevenueData.parents('tr').find('td:eq(2)').html(res.data.data.action);
            closeModalUpdateRevenueData();
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            ErrorNotify(text);
            break;
        default :
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            WarningNotify(text);
    }
}

function closeModalUpdateRevenueData() {
    removeAllValidate();
    $('#modal-revenue-data-detail').modal('hide');
    resetModalUpdateRevenueData();
}
function  resetModalUpdateRevenueData(){
    $('#modal-revenue-data-detail input').val('');
    $('#select-update-revenue-data').val(null).trigger('change');
    $('#revenue-data-edit-save').prop('disabled', false);
}
