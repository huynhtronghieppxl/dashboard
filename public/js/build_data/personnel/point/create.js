let checkSaveCreatePointData = 0;
function openModalCreatePointData() {
    checkSaveCreatePointData = 0;
    $("#modal-create-point-data").modal("show");
    $('#salary-create-point-data').val('100');
    $("#modal-create-point-data").on("shown.bs.modal", function () {
        $("#point-create-point-data").focus();
    });
    $("#select-role-create-point-data").select2({
        dropdownParent: $("#modal-create-point-data"),
    });
    shortcut.remove('F2');
    shortcut.add('ESC', function () {
        closeModalCreatePointData();
    });
    shortcut.add('F4', function () {
        saveModalCreatePointData();
    });
    $("#modal-create-point-data input").on("click", function () {
        $(this).select();
    });
    $("#select-role-create-point-data").val($("#table-role-point-data tbody tr.selected").find("td:eq(1)").find("input").val()).trigger("change.select2");
    $('.btn-renew').addClass('d-none');
    $('#modal-create-point-data input').on('input', function (){
        $('.btn-renew').removeClass('d-none');
    });
    $('#modal-create-point-data select').on('change', function (){
        $('.btn-renew').removeClass('d-none');
    });
    $('.btn-renew').on('click', function (){
        $(this).addClass('d-none');
    })
}

async function saveModalCreatePointData() {
    if (checkSaveCreatePointData === 1) return false;
    if (!checkValidateSave($("#modal-create-point-data"))) return false;
    let point = removeformatNumber($("#point-create-point-data").val());
    let salary = removeformatNumber($("#salary-create-point-data").val());
    let role = $('.select-role-point-data').val();
    checkSaveCreatePointData = 1;
    let method = "post",
        url = "point-data.create",
        params = null,
        data = {point: point, salary: salary , role : role };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-create-point-data')]);
    checkSaveCreatePointData = 0;
    switch (res.data.status){
        case 200:
            SuccessNotify($("#success-create-data-to-server").text());
            dataPointData();
            closeModalCreatePointData();
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

function closeModalCreatePointData() {
    $("#modal-create-point-data").modal("hide");
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function () {
        openModalCreatePointData()
    })
    reloadModalCreatePointData();
}

function reloadModalCreatePointData() {
    removeAllValidate();
    $('#point-create-point-data').val(1)
    $('#salary-create-point-data').val(100)
    let valueSelectRoleCreatePointData = $("#select-role-create-point-data").val($("#table-role-point-data tbody tr.selected").find("td:eq(1)").find("input").val()).trigger("change.select2").val()
    $('#select-role-create-point-data').val(valueSelectRoleCreatePointData).trigger('change.select2')
}
