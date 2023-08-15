
function openModalDetailUnitData(r){
    $('#modal-detail-unit-data').modal('show');
    shortcut.add("ESC", function () {
        closeModalDetailUnitData();
    });

    dataDetailUnitData(r)
}

async function dataDetailUnitData(r) {
    let url = 'unit-data.detail',
        method = 'get',
        params = {
            id: r.data('id'),
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-detail-unit-data')]);
    $('#name-detail-unit-data').text(res.data[1].data.name);
    $('#code-detail-unit-data').text(res.data[1].data.code);
    $('#des-detail-unit-data').text(res.data[1].data.description);
    $('#specifications-detail-unit-data').text(res.data[1].data.specifications);
}

function closeModalDetailUnitData(){
    $('#modal-detail-unit-data').modal('hide');
    reloadModalDetailUnitData();
}

function reloadModalDetailUnitData(){
    $('#modal-detail-unit-data h6').text('---');
}
