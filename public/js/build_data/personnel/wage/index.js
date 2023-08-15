let tableWageData, tableWageDataCancel, checkChangeStatusSalaryLevel=0, tabWageDataChange=0;

$(function () {
    if(getCookieShared('wage-data-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('wage-data-user-id-' + idSession));
        tabWageDataChange = dataCookie.tabWageDataChange;
    }
    $('#tab-wage-data .nav-link').on('click',function (){
        tabWageDataChange = $(this).data('index');
        updateCookieWageData()
    })
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function (){
        openModalCreateWageData()
    })
    loadData();
    $('#tab-wage-data .nav-link[data-index="' +tabWageDataChange+ '"]').click();
});
function updateCookieWageData(){
    saveCookieShared('wage-data-user-id-' + idSession, JSON.stringify({
        tabWageDataChange: tabWageDataChange
    }))
}
async function loadData() {
    await changeBrandAllShared();
    let method = 'get',
        url = 'wage-data.data',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('.page-body')]);
    $('#total-record-enable').text(res.data[0].original.recordsTotal)
    $('#total-record-disable').text(res.data[1].original.recordsTotal)
    dataTableWageData(res.data[0].original.data)
    dataTableWageDataCancel(res.data[1].original.data)
}

async function dataTableWageData(data) {
    let id = $('#salary-table'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'level', className: 'text-center'},
            {data: 'basic_salary', className: 'text-right'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ],
        fixedLeft = 0,
        fixedRight = 0,
        option = [{
            'title' : 'Thêm mới (F2)',
            'icon' : 'fa fa-plus text-primary',
            'class' : '',
            'function': 'openModalCreateWageData'
        }];
    tableWageData = await DatatableTemplateNew(id, data, column, vh_of_table, fixedLeft, fixedRight, option);
    $(document).on('keyup input paste keydown', '#salary-table_filter input[type="search"]', function (){
        searchUpdateIndexDataTableWageData(tableWageData)
    })
}
async function dataTableWageDataCancel(data) {
    let id = $('#salary-table-cancle'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'level', className: 'text-center'},
            {data: 'basic_salary', className: 'text-right'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ],
        fixedLeft = 0,
        fixedRight = 0,
        option = [{
            'title' : 'Thêm mới (F2)',
            'icon' : 'fa fa-plus text-primary',
            'class' : '',
            'function': 'openModalCreateWageData'
        }];
    tableWageDataCancel = await DatatableTemplateNew(id, data, column, vh_of_table, fixedLeft, fixedRight, option);
    $(document).on('keyup input paste keydown', '#salary-table-cancel_filter input[type="search"]', function (){
        searchUpdateIndexDataTableWageCancelData(tableWageDataCancel)
    })
}

async function searchUpdateIndexDataTableWageData(datatable){
    let index = 1;
    await datatable.rows({'search':'applied'}).every(function (){
        let row = $(this.node())
        row.find('td:eq(0)').text(index)
        index++;
    })
    $('#total-record-enable').text(index-1)
}
async function searchUpdateIndexDataTableWageCancelData(datatable){
    let index = 1;
    await datatable.rows({'search':'applied'}).every(function (){
        let row = $(this.node())
        row.find('td:eq(0)').text(index)
        index++;
    })
    $('#total-record-disable').text(index-1)
}

function changeStatusWage(r) {
    if(checkChangeStatusSalaryLevel === 1) return false;
    let title = r.attr('data-original-title') +' bậc lương này ?',
        content =  '' ,
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let id = r.attr('data-id');
            checkChangeStatusSalaryLevel  = 1;
            let method = 'post',
                url = 'wage-data.change-status',
                params = {
                    id:id
                },
                data = null;
            let res = await axiosTemplate(method, url, params, data);
            checkChangeStatusSalaryLevel  = 0;
            switch (res.data.status) {
                case 200:
                    SuccessNotify('Đổi trạng thái thành công !');
                    loadData()
                    break;
                case 400:
                    const swalWithBootstrapButton = Swal.mixin({
                        customClass: {
                            container: "modal-create-note, modal, popup-swal-205",
                            cancelButton: 'swal2-cancel btn btn-grd-disabled btn-sweet-alert swal-button--cancel'
                        },
                        buttonsStyling: false,
                        allowOutsideClick: false,
                    });
                    swalWithBootstrapButton.fire({
                        title: 'Nhân viên đang có bậc lương này !',
                        icon: 'warning',
                        html:`
                            <div class="card-block px-0 seemt-main-content"  style="padding-top: 5px">
                            <style>
                            .fi-rr-eye::before{
                            display: flex!important;
                            justify-content: center;
                            }
                            </style>
                            <div class="table-responsive new-table">
                                <h5 class="text-center font-weight-bold mt-0">${res.data.message}</h5>
                                    <table class="table" id="table-change-status-wage-data">
                                        <thead>
                                            <tr>
                                                <th class="text-center">STT</th>
                                                <th class="text-left">Tên </th>
                                                <th class="text-center">SĐT</th>
                                                 <th class="text-center"></th>
                                                <th class="d-none"></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>`,
                        showConfirmButton: false,
                        showCloseButton: false,
                        showCancelButton: true,
                        confirmButtonText: $('#button-btn-confirm-component').text(),
                        cancelButtonText: $('#button-btn-cancel-component').text(),
                        reverseButtons: true,
                        focusConfirm: true,
                    })
                    drawTableChangeStatusWageData(res);
                    break;

                case 500:
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    ErrorNotify($('#error-post-data-to-server').text());
                    break;
                default:
                    let text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    WarningNotify(text);
            }
        }
    })
}
async function drawTableChangeStatusWageData(data) {
    let tableChangeStatusWageData = $('#table-change-status-wage-data'),
        scroll_Y = '300px',
        fixed_left = 0,
        fixed_right = 0,
        columnArea = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '8%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'phone', name: 'phone', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center'},
            {data: 'keysearch', className: 'd-none'},
        ];
    let dataTableArea = await DatatableTemplateNew(tableChangeStatusWageData, data.data.table_employee.original.data, columnArea, scroll_Y, fixed_left, fixed_right, []);
    $(document).on('input paste','#table-change-status-wage-data_filter input', function (){
        let indexArea = 1;
        dataTableArea.rows({'search':'applied'}).every(function () {
            let row = $(this.node())
            row.find('td:eq(0)').text(indexArea)
            indexArea++;
        });
    })
}





