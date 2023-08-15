let tableEnableShiftData,
    tableDisableShiftData,
    thisTableShiftData, indexDataTabShiftData = 0;
$(function () {
    loadData();
    $('#tab-shift-data a').on('click', function () {
        indexDataTabShiftData = $(this).data('index')
        updateCookieShiftData();
    })
    if (getCookieShared('shift-data-user-id-' + idSession)) {
        let dataCookie = JSON.parse(getCookieShared('shift-data-user-id-' + idSession));
        indexDataTabShiftData = dataCookie.index
    }
    $('#tab-shift-data a[data-index="' + indexDataTabShiftData + '"]').click();
    $(document).on('change', '.select-brand.shift-data', function () {
        $('.select-brand.shift-data').val($(this).val()).trigger('change.select2');
    });
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function (){
        openModalCreateShiftData()
    })
});

async function loadData() {
    let method = 'get',
        url = 'shift-data.data',
        brand_id = $('.select-brand.shift-data').val(),
        params = {brand_id: brand_id},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-enable-shift-data'), $('#table-disable-shift-data')]);
    dataTableShiftData(res);
    $('#total-record-enable').text(res.data[2].total_record_enable);
    $('#total-record-disable').text(res.data[2].total_record_disable);
}

async function dataTableShiftData(data) {
    let id1 = $('#table-enable-shift-data'),
        id2 = $('#table-disable-shift-data'),
        fixed_left = 0,
        fixed_right = 0,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', className: 'text-left'},
            {data: 'time_interval_string', className: 'text-center', width: '50%'},
            {data: 'action', name: 'action', className: 'text-center', width: '10%'},
            {data: 'keysearch', className: 'd-none'},
        ],
        option = [
            {
                'title': 'Thêm mới (F2)',
                'icon': 'fa fa-plus text-primary',
                'class': '',
                'function': 'openModalCreateShiftData'
            }
        ];
    tableEnableShiftData = await DatatableTemplateNew(id1, data.data[0].original.data, columns, vh_of_table, fixed_left, fixed_right, option);
    tableDisableShiftData = await DatatableTemplateNew(id2, data.data[1].original.data, columns, vh_of_table, fixed_left, fixed_right, option);
    $(document).on('input paste keyup','input[type="search"]', async function (){
        $('#total-record-enable').text(formatNumber(tableEnableShiftData.rows({'search':'applied'}).count()))
        $('#total-record-disable').text(formatNumber(tableDisableShiftData.rows({'search':'applied'}).count()))
        searchUpdateIndexShift(tableEnableShiftData)
        searchUpdateIndexShift(tableDisableShiftData)

    })
}
async function searchUpdateIndexShift(datatable){
    let index = 1;
    await datatable.rows({'search':'applied'}).every(function (){
        let row = $(this.node())
        row.find('td:eq(0)').text(index)
        index++;
    })
}

function changeStatusShiftData(r) {
    thisTableShiftData = r;
    let title,
        content = '',
        status = r.data('status'),
        icon = 'question';
    title = (status === 0) ? $('#notify-on-update-status-component').text() : $('#notify-off-update-status-component').text();
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let id = r.data('id'),
                name = r.data('name'),
                form_hour = r.data('from-hour'),
                to_hour = r.data('to-hour');
            let method = 'post',
                url = 'shift-data.status',
                params = null,
                data = {
                    id: id,
                    status: (status === 0) ? 1 : 0,
                    name: name,
                    form_hour: form_hour,
                    to_hour: to_hour,
                };
            let res = await axiosTemplate(method, url, params, data, [$('#table-enable-shift-data'), $('#table-disable-shift-data')]);
            switch (res.data.status) {
                case 200:
                    SuccessNotify($('#success-status-data-to-server').text());
                    drawTableStatusShiftData(res.data.data);
                    break;
                case 400:
                    WarningNotify(res.data.message);
                    break;
                case 500:
                    let text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    ErrorNotify(text);
                    break;
                case 205:
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            container: "popup-swal-205",
                            confirmButton: 'btn btn-primary btn-sweet-alert',
                            cancelButton: 'swal2-cancel btn btn-grd-disabled btn-sweet-alert swal-button--cancel'
                        },
                        buttonsStyling: false,
                        allowOutsideClick: false,
                        showCancelButton: true,
                        cancelButtonText: `<i class="fi fi-rr-cross"></i>Đóng`
                    });
                    swalWithBootstrapButtons.fire({
                        title: 'Ca làm việc đang được sử dụng !',
                        icon: 'warning',
                        html: `
                            <div class="card-block px-0 seemt-main-content">
                            <div class="table-responsive new-table">
                                <h5 class="text-center font-weight-bold mt-0">${res.data.message}</h5>
                                    <table class="table" id="table-change-status-shift-data">
                                        <thead>
                                            <tr>
                                                <th class="text-center">STT</th>
                                                <th class="text-center">Tên</th>
                                                <th></th>
                                                <th class="d-none"></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>`,
                        showCloseButton: false,
                        showCancelButton: true,
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        cancelButtonText: $('#button-btn-cancel-component').text(),
                        reverseButtons: false,
                        focusConfirm: false
                    }).then(async () => {
                    })
                    $('[data-toggle="tooltip"]').tooltip();
                    drawTableChangeStatusShiftData(res);
                    break;
                default:
                    text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    WarningNotify(text);
            }
        }
    })
}

async function drawTableChangeStatusShiftData(data) {
    let tableChangeStatusShift = $('#table-change-status-shift-data'),
        scroll_Y = '300px',
        fixed_left = 0,
        fixed_right = 0,
        columnFood = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '8%'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '10%'},
            {data: 'keysearch',name: 'keysearch', className: 'd-none'},
        ];
    let dataTableShift = await DatatableTemplateNew(tableChangeStatusShift, data.data.data.original.data, columnFood, scroll_Y, fixed_left, fixed_right, []);
    $(document).on('input paste','#table-change-status-shift-data_filter input', function (){

        let keysearch=removeVietnameseString($(this).val())
        dataTableShift.column(3).search(keysearch).draw(false);
        let indexShift = 1;
        dataTableShift.rows({'search':'applied'}).every(function () {
            let row = $(this.node())
            row.find('td:eq(0)').text(indexShift)
            indexShift++;
        });
    })
}

function drawTableStatusShiftData(data) {
    switch (data.status) {
        case 0:
            $('#total-record-enable').text(formatNumber(removeformatNumber($('#total-record-enable').text()) - 1));
            $('#total-record-disable').text(formatNumber(removeformatNumber($('#total-record-disable').text()) + 1));
            removeRowDatatableTemplate(tableEnableShiftData, thisTableShiftData, true);
            addRowDatatableTemplate(tableDisableShiftData, {
                'name': data.name,
                'time_interval_string': data.time_interval_string,
                'action': data.action,
                'keysearch': data.keysearch,
            });
            break;
        case 1:
            $('#total-record-enable').text(formatNumber(removeformatNumber($('#total-record-enable').text()) + 1));
            $('#total-record-disable').text(formatNumber(removeformatNumber($('#total-record-disable').text()) - 1));
            removeRowDatatableTemplate(tableDisableShiftData, thisTableShiftData, true);
            addRowDatatableTemplate(tableEnableShiftData, {
                'name': data.name,
                'time_interval_string': data.time_interval_string,
                'action': data.action,
                'keysearch': data.keysearch,
            });
            break;
    }
}

function updateCookieShiftData() {
    saveCookieShared('shift-data-user-id-' + idSession, JSON.stringify({
        'index': indexDataTabShiftData,
    }))
}
