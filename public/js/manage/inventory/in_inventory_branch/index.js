let loadingTabMaterial = 0, loadingTabGoods = 0, loadingTabBranch = 0, loadingTabOther = 0, loadingTabWaiting = 0,
    loadingTabCancel = 0,
    tabActiveInInventoryBranchManage = 4,
    tableInInventoryBranchManageMaterial = '', tableInInventoryBranchManageGoods = '',
    tableInInventoryBranchManageBranch = '',
    tableInInventoryBranchManageOther = '', tableInInventoryBranchManageWaiting = '',
    tableInInventoryBranchManageCancel = '',
    branchId = $('.select-branch').val(), typeTabMaterial = 1, typeTabGoods = 2, typeTabBranch = 3, typeTabOther = 12,
    typeTabWaiting = '',
    typeTabCancel = '', fromInInventoryBranchManage = $('.from-date-in-inventory-branch-manage').val(),checkSaveRejectInInventory = 0,checkSaveConfirmInInventory = 0,
    toInInventoryBranchManage = $('.to-date-in-inventory-branch-manage').val(),
    columnTable = [
        {data: 'index', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
        {data: 'code', name: 'code', className: 'text-left'},
        {data: 'employee', name: 'employee', className: 'text-left'},
        {data: 'import_from_branch.name', name: 'branch', className: 'text-center'},
        {data: 'delivery_date', name: 'delivery_date', className: 'text-center'},
        {data: 'total_material', name: 'total_amount', className: 'text-center'},
        {data: 'total_amount', name: 'total_amount', className: 'text-right'},
        {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        {data: 'keysearch', className: 'd-none'},
    ],
    columnTableWaiting = [
        {data: 'index', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
        {data: 'code', name: 'code', className: 'text-left'},
        {data: 'employee', name: 'employee', className: 'text-left'},
        {data: 'branch.name', name: 'branch', className: 'text-center'},
        {data: 'delivery_date', name: 'delivery_date', className: 'text-center'},
        {data: 'total_material', name: 'total_amount', className: 'text-center'},
        {data: 'total_amount', name: 'total_amount', className: 'text-right'},
        {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        {data: 'keysearch', className: 'd-none'},
    ];



$(function () {
    dateTimePickerFromMaxToDate($('.from-date-in-inventory-branch-manage'), $('.to-date-in-inventory-branch-manage'))
    if(getCookieShared('in-inventory-branch-manage-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('in-inventory-branch-manage-user-id-' + idSession));
        fromInInventoryBranchManage = dataCookie.from;
        toInInventoryBranchManage = dataCookie.to;
        tabActiveInInventoryBranchManage = dataCookie.tab;

        $('.from-date-in-inventory-branch-manage').val(fromInInventoryBranchManage);
        $('.to-date-in-inventory-branch-manage').val(toInInventoryBranchManage)
    }
    $('.from-date-in-inventory-branch-manage').on('dp.change', function () {
        $('.from-date-in-inventory-branch-manage').val($(this).val());
    });
    $('.to-date-in-inventory-branch-manage').on('dp.change', function () {
        $('.to-date-in-inventory-branch-manage').val($(this).val());
    });
    $('.search-in-inventory-branch').on('click', function () {
        if(!checkDateTimePicker($(this))) return false
        fromInInventoryBranchManage = $('.from-date-in-inventory-branch-manage').val();
        toInInventoryBranchManage = $('.to-date-in-inventory-branch-manage').val();
        validateDateTemplate($('.from-date-in-inventory-branch-manage'), $('.to-date-in-inventory-branch-manage'), loadingData);
    });
    $('#nav-tab-in-inventory-branch a[data-id="' + tabActiveInInventoryBranchManage + '"]').click()
});

async function loadData() {
    branchId = $('.select-branch').val();
    loadingData();
}

function updateCookieInInventoryBranch(){
    saveCookieShared('in-inventory-branch-manage-user-id-' + idSession, JSON.stringify({
        'tab' : tabActiveInInventoryBranchManage,
        'from' : fromInInventoryBranchManage,
        'to' : toInInventoryBranchManage,
    }))
}

async function loadingData() {
    updateCookieInInventoryBranch()
    switch (tabActiveInInventoryBranchManage) {
        case 1:
            loadingTabMaterial = 1;
            loadingTabGoods = 0;
            loadingTabBranch = 0;
            loadingTabOther = 0;
            loadingTabWaiting = 0;
            loadingTabCancel = 0;
            if(tableInInventoryBranchManageMaterial) {
                tableInInventoryBranchManageMaterial.ajax.url("in-inventory-branch-manage.data?from=" + fromInInventoryBranchManage + "&to=" + toInInventoryBranchManage + "&branch_id=" + branchId + "&type=" + typeTabMaterial).load();
            }
            break;
        case 2:
            loadingTabMaterial = 0;
            loadingTabGoods = 1;
            loadingTabBranch = 0;
            loadingTabOther = 0;
            loadingTabWaiting = 0;
            loadingTabCancel = 0;
            if(tableInInventoryBranchManageGoods) {
                tableInInventoryBranchManageGoods.ajax.url("in-inventory-branch-manage.data?from=" + fromInInventoryBranchManage + "&to=" + toInInventoryBranchManage + "&branch_id=" + branchId + "&type=" + typeTabGoods).load();
            }
            break;
        case 3:
            loadingTabMaterial = 0;
            loadingTabGoods = 0;
            loadingTabBranch = 1;
            loadingTabOther = 0;
            loadingTabWaiting = 0;
            loadingTabCancel = 0;
            if(tableInInventoryBranchManageBranch) {
                tableInInventoryBranchManageBranch.ajax.url("in-inventory-branch-manage.data?from=" + fromInInventoryBranchManage + "&to=" + toInInventoryBranchManage + "&branch_id=" + branchId + "&type=" + typeTabBranch).load();
            }
            break;
        case 12:
            loadingTabMaterial = 0;
            loadingTabGoods = 0;
            loadingTabBranch = 0;
            loadingTabOther = 1;
            loadingTabWaiting = 0;
            loadingTabCancel = 0;
            if(tableInInventoryBranchManageOther) {
                tableInInventoryBranchManageOther.ajax.url("in-inventory-branch-manage.data?from=" + fromInInventoryBranchManage + "&to=" + toInInventoryBranchManage + "&branch_id=" + branchId + "&type=" + typeTabOther).load();
            }
            break;
        case 4:
            loadingTabMaterial = 0;
            loadingTabGoods = 0;
            loadingTabBranch = 0;
            loadingTabOther = 0;
            loadingTabWaiting = 1;
            loadingTabCancel = 0;
            if(tableInInventoryBranchManageWaiting) {
                tableInInventoryBranchManageWaiting.ajax.url("in-inventory-branch-manage.out-inventory-data?from=" + fromInInventoryBranchManage + "&to=" + toInInventoryBranchManage + "&branch_id=" + branchId + "&type=" + typeTabWaiting + "&status=" + 0 + "&warehouse_session_statuses=" + 1).load();
            }
            break;
        case 5:
            loadingTabMaterial = 0;
            loadingTabGoods = 0;
            loadingTabBranch = 0;
            loadingTabOther = 0;
            loadingTabWaiting = 0;
            loadingTabCancel = 1;
            if(tableInInventoryBranchManageCancel) {
                tableInInventoryBranchManageCancel.ajax.url("in-inventory-branch-manage.out-inventory-data?from=" + fromInInventoryBranchManage + "&to=" + toInInventoryBranchManage + "&branch_id=" + branchId + "&type=" + typeTabCancel + "&status=" + -1 + "&warehouse_session_statuses=" + 3).load();
            }
            break;
    }
}

async function changeActiveTabMaterialData(tab) {
    tabActiveInInventoryBranchManage = tab;
    updateCookieInInventoryBranch()
    !branchId ? await updateSessionBrandNew($('.select-brand')) : false;
    switch (tab) {
        case 1:
            if (tableInInventoryBranchManageMaterial === '') {
                let element = $('#table-material-in-inventory-branch-manage'),
                    url = "in-inventory-branch-manage.data?from=" + fromInInventoryBranchManage + "&to=" + toInInventoryBranchManage + "&branch_id=" + branchId + "&type=" + typeTabMaterial;
                tableInInventoryBranchManageMaterial = await loadDataOutInventoryBranchManage(element, url);
                loadingTabMaterial = 1;
            } else if (loadingTabMaterial === 0) {
                tableInInventoryBranchManageMaterial.ajax.url("in-inventory-branch-manage.data?from=" + fromInInventoryBranchManage + "&to=" + toInInventoryBranchManage + "&branch_id=" + branchId + "&type=" + typeTabMaterial).load();
            }
            break;
        case 2:
            if (tableInInventoryBranchManageGoods === '') {
                let element = $('#table-goods-in-inventory-branch-manage'),
                    url = "in-inventory-branch-manage.data?from=" + fromInInventoryBranchManage + "&to=" + toInInventoryBranchManage + "&branch_id=" + branchId + "&type=" + typeTabGoods;
                tableInInventoryBranchManageGoods = await loadDataOutInventoryBranchManage(element, url);
                loadingTabGoods = 1;
            } else if (loadingTabGoods === 0) {
                tableInInventoryBranchManageGoods.ajax.url("in-inventory-branch-manage.data?from=" + fromInInventoryBranchManage + "&to=" + toInInventoryBranchManage + "&branch_id=" + branchId + "&type=" + typeTabGoods).load();
            }
            break;
        case 3:
            if (tableInInventoryBranchManageBranch === '') {
                let element = $('#table-internal-in-inventory-branch-manage'),
                    url = "in-inventory-branch-manage.data?from=" + fromInInventoryBranchManage + "&to=" + toInInventoryBranchManage + "&branch_id=" + branchId + "&type=" + typeTabBranch;
                tableInInventoryBranchManageBranch = await loadDataOutInventoryBranchManage(element, url);
                loadingTabBranch = 1;
            } else if (loadingTabBranch === 0) {
                tableInInventoryBranchManageBranch.ajax.url("in-inventory-branch-manage.data?from=" + fromInInventoryBranchManage + "&to=" + toInInventoryBranchManage + "&branch_id=" + branchId + "&type=" + typeTabBranch).load();
            }
            break;
        case 12:
            if (tableInInventoryBranchManageOther === '') {
                let element = $('#table-other-in-inventory-branch-manage'),
                    url = "in-inventory-branch-manage.data?from=" + fromInInventoryBranchManage + "&to=" + toInInventoryBranchManage + "&branch_id=" + branchId + "&type=" + typeTabOther;
                tableInInventoryBranchManageOther = await loadDataOutInventoryBranchManage(element, url);
                loadingTabOther = 1;
            } else if (loadingTabOther === 0) {
                tableInInventoryBranchManageOther.ajax.url("in-inventory-branch-manage.data?from=" + fromInInventoryBranchManage + "&to=" + toInInventoryBranchManage + "&branch_id=" + branchId + "&type=" + typeTabOther).load();
            }
            break;
        case 4:
            if (tableInInventoryBranchManageWaiting === '') {
                let element = $('#table-waiting-in-inventory-branch-manage'),
                    url = "in-inventory-branch-manage.out-inventory-data?from=" + fromInInventoryBranchManage + "&to=" + toInInventoryBranchManage + "&branch_id=" + branchId + "&type=" + typeTabWaiting + "&status=" + 0 + "&warehouse_session_statuses=" + 1;
                tableInInventoryBranchManageWaiting = await loadDataWaitingOutInventoryBranchManage(element, url);
                loadingTabWaiting = 1;
            } else if (loadingTabWaiting === 0) {
                tableInInventoryBranchManageWaiting.ajax.url("in-inventory-branch-manage.out-inventory-data?from=" + fromInInventoryBranchManage + "&to=" + toInInventoryBranchManage + "&branch_id=" + branchId + "&type=" + typeTabWaiting + "&status=" + 0 + "&warehouse_session_statuses=" + 1).load();
            }
            break;
        case 5:
            if (tableInInventoryBranchManageCancel === '') {
                let element = $('#table-cancel-in-inventory-branch-manage'),
                    url = "in-inventory-branch-manage.out-inventory-data?from=" + fromInInventoryBranchManage + "&to=" + toInInventoryBranchManage + "&branch_id=" + branchId + "&type=" + typeTabCancel + "&status=" + -1 + "&warehouse_session_statuses=" + 3;
                tableInInventoryBranchManageCancel = await loadDataWaitingOutInventoryBranchManage(element, url);
                loadingTabCancel = 1;
            } else if (loadingTabCancel === 0) {
                tableInInventoryBranchManageCancel.ajax.url("in-inventory-branch-manage.out-inventory-data?from=" + fromInInventoryBranchManage + "&to=" + toInInventoryBranchManage + "&branch_id=" + branchId + "&type=" + typeTabCancel + "&status=" + -1 + "&warehouse_session_statuses=" + 3).load();
            }
    }
}

async function loadDataOutInventoryBranchManage(element, url) {
    let fixedLeftTable = 2,
        fixedRightTable = 2,
        optionRenderTable = [];
    return DatatableServerSideTemplateNew(element, url, columnTable, vh_of_table, fixedLeftTable, fixedRightTable, optionRenderTable, callbackLoadData);
}

async function loadDataWaitingOutInventoryBranchManage(element, url) {
    let fixedLeftTable = 2,
        fixedRightTable = 2,
        optionRenderTable = [];
    return DatatableServerSideTemplateNew(element, url, columnTableWaiting, vh_of_table, fixedLeftTable, fixedRightTable, optionRenderTable, callbackLoadData);
}


function callbackLoadData(response) {
    $('#total-record-material').text(response.count_material);
    $('#total-record-goods').text(response.count_goods);
    $('#total-record-material-internal').text(response.count_internal);
    $('#total-record-other').text(response.count_other);
    $('#total-record-waiting').text(response.count_waiting_confirm);
    $('#total-record-cancel').text(response.count_cancel);
    $('#total-material-in-inventory-branch-manage').text(response.total_amount_material);
    $('#total-goods-in-inventory-branch-manage').text(response.total_amount_goods);
    $('#total-internal-in-inventory-branch-manage').text(response.total_amount_internal);
    $('#total-other-in-inventory-branch-manage').text(response.total_amount_other);
    $('#total-waiting-in-inventory-branch-manage').text(response.total_amount_waiting_confirm);
    $('#total-cancel-in-inventory-branch-manage').text(response.total_amount_cancel);
}

async function confirmInInventoryBranchManage(r) {
    if (checkSaveConfirmInInventory === 1) return false;
    let title = 'Xác nhận phiếu nhập kho ?',
        icon = 'question';
    sweetAlertComponent(title, '', icon).then(async (result) => {
        if(result.isConfirmed){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    cancelButton: 'btn btn-grd-disabled btn-sweet-alert',
                    confirmButton: 'btn btn-grd-primary btn-sweet-alert',
                },
                buttonsStyling: false,
            });
            swalWithBootstrapButtons.fire({
                title: 'Chọn ngày xác nhận phiếu nhập kho!',
                icon: 'warning',
                html:
                    `<div class="card-block p-0 d-flex justify-content-center">
                   <div class="col-lg-11">
                    <div class="input-group w-100 add-display border-group pr-0" id="day">
                        <input id="delivery-date-in-inventory" class="form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate" type="text" placeholder="${r.data('created-at')}" value="${r.data('created-at')}" />
                    </div>
                </div>`,
                showCancelButton: true,
                showConfirmButton: true,
                cancelButtonText: $('#button-btn-cancel-component').text(),
                confirmButtonText: $('#button-btn-confirm-component').text(),
                reverseButtons: true,
                focusConfirm: true,
                customClass: {
                    container: 'popup-swal-205',
                    cancelButton: 'btn btn-grd-disabled btn-sweet-alert',
                    confirmButton: 'btn btn-primary btn-sweet-alert',
                }
            }).then(async (result) => {
                if (result.isConfirmed) {
                    checkSaveConfirmInInventory = 1;
                    let method = 'post',
                        url = 'in-inventory-branch-manage.confirm',
                        params = null,
                        data = {
                            note: r.data('note'),
                            id: r.data('id'),
                            branch: r.data('branch'),
                            delivery : $('#delivery-date-in-inventory').val(),
                        };
                    let res = await axiosTemplate(method, url, params, data);
                    checkSaveConfirmInInventory = 0;
                    let text = $('#success-create-data-to-server').text();
                    switch (res.data.status) {
                        case 200:
                            SuccessNotify(text);
                            loadingData();
                            break;
                        case 500:
                            text = $('#error-post-data-to-server').text();
                            if (res.data.message !== null) {
                                text = res.data.message;
                            }
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
            })
            dateTimePickerFomartTemplate($('#delivery-date-in-inventory'));
        }

    });
}

function rejectInInventoryBranchManage(r) {
    if (checkSaveRejectInInventory === 1) return false;
    let title = 'Từ chối phiếu nhập từ chi nhánh khác ?',
        icon = 'question',
        content = '';
    sweetAlertInputComponent(title, 'id-cancel-in-inventory', content, icon).then(async (result) => {
        if (result.isConfirmed) {
            let cancel_reason = result.value
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    cancelButton: 'btn btn-grd-disabled btn-sweet-alert',
                    confirmButton: 'btn btn-grd-primary btn-sweet-alert',
                },
                buttonsStyling: false,
            });
            swalWithBootstrapButtons.fire({
                title: 'Chọn ngày hủy phiếu nhập kho!',
                icon: 'warning',
                html:
                    `<div class="card-block p-0 d-flex justify-content-center" >
                   <div class="col-lg-11">
                    <div class="input-group w-100 add-display border-group pr-0" id="day">
                        <input id="reject-date-in-inventory" class="form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate" type="text" placeholder="${r.data('created-at')}" value="${moment().format('DD/MM/YYYY')}" />
                    </div>
                </div>`,
                showCancelButton: true,
                showConfirmButton: true,
                cancelButtonText: $('#button-btn-cancel-component').text(),
                confirmButtonText: $('#button-btn-confirm-component').text(),
                reverseButtons: true,
                focusConfirm: true,
                customClass: {
                    container: 'popup-swal-205',
                    cancelButton: 'btn btn-grd-disabled btn-sweet-alert',
                    confirmButton: 'btn btn-primary btn-sweet-alert',
                }
            }).then(async (result) => {
                if (result.isConfirmed) {
                    let method = 'post',
                        branch = $('.select-branch').val(),
                        url = 'in-inventory-branch-manage.cancel',
                        params = null,
                        data = {
                            id: r.data('id'),
                            branch: branch,
                            note: r.data('note'),
                            cancel_reason: cancel_reason,
                            reject_date: $('#reject-date-in-inventory').val()
                        };
                    checkSaveRejectInInventory = 1;
                    let res = await axiosTemplate(method, url, params, data);
                    checkSaveRejectInInventory = 0;
                    let text = $('#success-cancel-data-to-server').text();
                    switch (res.data.status){
                        case 200:
                            SuccessNotify(text);
                            loadingData();
                            break;
                        case 500:
                            text = $('#error-post-data-to-server').text();
                            if (res.data.message !== null) {
                                text = res.data.message;
                            }
                            ErrorNotify(text);
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
            dateTimePickerTemplate($('#reject-date-in-inventory'),'', new Date());
        }
    });
}
