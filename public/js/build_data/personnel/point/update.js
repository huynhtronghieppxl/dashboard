let checkSaveEditPointData;
async function openModalUpdatePointData(r) {
    checkSaveEditPointData = 0;
    $("#modal-update-point-data").modal("show");
    $("#select-role-update-point-data").select2({
        dropdownParent: $("#modal-update-point-data"),
    });
    shortcut.remove('F2');
    shortcut.add('ESC', function () {
        closeModalUpdatePointData();
    });
    shortcut.add('F4', function () {
        saveModalUpdatePointData();
    });
    $("#modal-update-point-data input").on("click", function () {
        $(this).select();
    });
    $("#id-update-point-data").text(r.data("id"));
    $("#point-update-point-data").val(r.data("point"));
    $("#salary-update-point-data").val(r.data("salary"));
    $("#select-role-update-point-data").val(r.data("role")).trigger("change.select2");
}

async function saveModalUpdatePointData() {
    if (checkSaveEditPointData === 1) return false;
    if (!checkValidateSave($("#modal-update-point-data"))) return false;
    let role = $('.select-role-point-data').val();
    let point = removeformatNumber($("#point-update-point-data").val());
    let salary = removeformatNumber($("#salary-update-point-data").val());
    let id = $("#id-update-point-data").text();
    checkSaveEditPointData = 1;
    let method = "post",
        url = "point-data.update",
        params = null,
        data = { id: id, point: point, salary: salary , role : role};
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-update-point-data')]);
    checkSaveEditPointData = 0;
    switch (res.data.status){
        case 200:
            SuccessNotify($("#success-update-data-to-server").text());
            dataPointData();
            closeModalUpdatePointData();
            shortcut.remove('F4');
            shortcut.remove('ESC');
            shortcut.add('F2', function () {
                openModalCreatePointData()
            })
            break;
        case 500:
            (res.data.message !== null) ? ErrorNotify(res.data.message) : ErrorNotify($("#error-post-data-to-server").text());
            break;
        default:
            (res.data.message !== null) ? WarningNotify(res.data.message) : WarningNotify($("#error-post-data-to-server").text());
    }
}

function closeModalUpdatePointData() {
    $("#modal-update-point-data").modal("hide");
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function (){
        openModalCreatePointData()
    })
    reloadModalUpdatePointData();
}

function reloadModalUpdatePointData(){
    removeAllValidate();
    $('#point-create-point-data').val(1)
    $('#salary-create-point-data').val(100)
}


