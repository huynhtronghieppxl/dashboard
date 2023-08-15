let loadingTabMaterial = 0, loadingTabGoods = 0, loadingTabBranch = 0, loadingTabOther = 0, loadingTabWaiting = 0,
    loadingTabCancel = 0,
    tabActiveReturnInventoryWarehouseManage = 4,
    tableReturnInventoryWarehouseManageMaterial = '', tableReturnInventoryWarehouseManageGoods = '',
    tableReturnInventoryWarehouseManageBranch = '',
    tableReturnInventoryWarehouseManageOther = '', tableReturnInventoryWarehouseManageWaiting = '',
    tableReturnInventoryWarehouseManageCancel = '',
    branchId = $('.select-branch').val(), typeTabMaterial = 1, typeTabGoods = 2, typeTabBranch = 3, typeTabOther = 12,
    typeTabWaiting = '',
    typeTabCancel = '', fromReturnInventoryWarehouseManage = $('.from-date-return-inventory-warehouse-manage').val(),checkSaveRejectReturnInventoryWarehouse = 0,checkSaveConfirmReturnInventoryWarehouse = 0,
    toReturnInventoryWarehouseManage = $('.to-date-return-inventory-warehouse-manage').val(),
    columnTable = [
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
    let showDatetimepicker;

$(function () {
    dateTimePickerFromMaxToDate($('.from-date-return-inventory-warehouse-manage'), $('.to-date-return-inventory-warehouse-manage'))
    if(getCookieShared('return-inventory-warehouse-manage-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('return-inventory-warehouse-manage-user-id-' + idSession));
        fromReturnInventoryWarehouseManage = dataCookie.from;
        toReturnInventoryWarehouseManage = dataCookie.to;
        tabActiveReturnInventoryWarehouseManage = dataCookie.tab;

        $('.from-date-return-inventory-warehouse-manage').val(fromReturnInventoryWarehouseManage);
        $('.to-date-return-inventory-warehouse-manage').val(toReturnInventoryWarehouseManage)
    }
    $('.from-date-return-inventory-warehouse-manage').on('dp.change', function () {
        $('.from-date-return-inventory-warehouse-manage').val($(this).val());
    });
    $('.to-date-return-inventory-warehouse-manage').on('dp.change', function () {
        $('.to-date-return-inventory-warehouse-manage').val($(this).val());
    });
    $('.search-return-inventory-warehouse').on('click', function () {
        if(!checkDateTimePicker($(this))) return false
        fromReturnInventoryWarehouseManage = $('.from-date-return-inventory-warehouse-manage').val();
        toReturnInventoryWarehouseManage = $('.to-date-return-inventory-warehouse-manage').val();
        validateDateTemplate($('.from-date-return-inventory-warehouse-manage'), $('.to-date-return-inventory-warehouse-manage'), loadingData);
    });
    $('#nav-tab-return-inventory-warehouse a[data-id="' + tabActiveReturnInventoryWarehouseManage + '"]').click()
});

async function loadData() {
    branchId = $('.select-branch').val();
    loadingData();
}

function updateCookieReturnInventoryWarehouse(){
    saveCookieShared('return-inventory-warehouse-manage-user-id-' + idSession, JSON.stringify({
        'tab' : tabActiveReturnInventoryWarehouseManage,
        'from' : fromReturnInventoryWarehouseManage,
        'to' : toReturnInventoryWarehouseManage,
    }))
}

async function loadingData() {
    updateCookieReturnInventoryWarehouse()
    switch (tabActiveReturnInventoryWarehouseManage) {
        case 1:
            loadingTabMaterial = 1;
            loadingTabGoods = 0;
            loadingTabBranch = 0;
            loadingTabOther = 0;
            loadingTabWaiting = 0;
            loadingTabCancel = 0;
            tableReturnInventoryWarehouseManageMaterial.ajax.url("return-inventory-warehouse.data?from=" + fromReturnInventoryWarehouseManage + "&to=" + toReturnInventoryWarehouseManage + "&branch_id=" + branchId + "&type=" + typeTabMaterial).load();
            break;
        case 2:
            loadingTabMaterial = 0;
            loadingTabGoods = 1;
            loadingTabBranch = 0;
            loadingTabOther = 0;
            loadingTabWaiting = 0;
            loadingTabCancel = 0;
            tableReturnInventoryWarehouseManageGoods.ajax.url("return-inventory-warehouse.data?from=" + fromReturnInventoryWarehouseManage + "&to=" + toReturnInventoryWarehouseManage + "&branch_id=" + branchId + "&type=" + typeTabGoods).load();
            break;
        case 3:
            loadingTabMaterial = 0;
            loadingTabGoods = 0;
            loadingTabBranch = 1;
            loadingTabOther = 0;
            loadingTabWaiting = 0;
            loadingTabCancel = 0;
            tableReturnInventoryWarehouseManageBranch.ajax.url("return-inventory-warehouse.data?from=" + fromReturnInventoryWarehouseManage + "&to=" + toReturnInventoryWarehouseManage + "&branch_id=" + branchId + "&type=" + typeTabBranch).load();
            break;
        case 12:
            loadingTabMaterial = 0;
            loadingTabGoods = 0;
            loadingTabBranch = 0;
            loadingTabOther = 1;
            loadingTabWaiting = 0;
            loadingTabCancel = 0;
            tableReturnInventoryWarehouseManageOther.ajax.url("return-inventory-warehouse.data?from=" + fromReturnInventoryWarehouseManage + "&to=" + toReturnInventoryWarehouseManage + "&branch_id=" + branchId + "&type=" + typeTabOther).load();
            break;
        case 4:
            loadingTabMaterial = 0;
            loadingTabGoods = 0;
            loadingTabBranch = 0;
            loadingTabOther = 0;
            loadingTabWaiting = 1;
            loadingTabCancel = 0;
            tableReturnInventoryWarehouseManageWaiting.ajax.url("return-inventory-warehouse.out-inventory-data?from=" + fromReturnInventoryWarehouseManage + "&to=" + toReturnInventoryWarehouseManage + "&branch_id=" + branchId + "&type=" + typeTabWaiting + "&status=" + 0 + "&warehouse_session_statuses=" + 1).load();
            break;
        case 5:
            loadingTabMaterial = 0;
            loadingTabGoods = 0;
            loadingTabBranch = 0;
            loadingTabOther = 0;
            loadingTabWaiting = 0;
            loadingTabCancel = 1;
            tableReturnInventoryWarehouseManageCancel.ajax.url("return-inventory-warehouse.out-inventory-data?from=" + fromReturnInventoryWarehouseManage + "&to=" + toReturnInventoryWarehouseManage + "&branch_id=" + branchId + "&type=" + typeTabCancel + "&status=" + -1 + "&warehouse_session_statuses=" + 3).load();
            break;
    }
}

async function changeActiveTabMaterialData(tab) {
    tabActiveReturnInventoryWarehouseManage = tab;
    updateCookieReturnInventoryWarehouse()
    switch (tab) {
        case 1:
            if (tableReturnInventoryWarehouseManageMaterial === '') {
                let element = $('#table-material-return-inventory-warehouse-manage'),
                    url = "return-inventory-warehouse.data?from=" + fromReturnInventoryWarehouseManage + "&to=" + toReturnInventoryWarehouseManage + "&branch_id=" + branchId + "&type=" + typeTabMaterial;
                tableReturnInventoryWarehouseManageMaterial = await loadDataOutInventoryBranchManage(element, url);
                loadingTabMaterial = 1;
            } else if (loadingTabMaterial === 0) {
                tableReturnInventoryWarehouseManageMaterial.ajax.url("return-inventory-warehouse.data?from=" + fromReturnInventoryWarehouseManage + "&to=" + toReturnInventoryWarehouseManage + "&branch_id=" + branchId + "&type=" + typeTabMaterial).load();
            }
            break;
        case 2:
            if (tableReturnInventoryWarehouseManageGoods === '') {
                let element = $('#table-goods-return-inventory-warehouse-manage'),
                    url = "return-inventory-warehouse.data?from=" + fromReturnInventoryWarehouseManage + "&to=" + toReturnInventoryWarehouseManage + "&branch_id=" + branchId + "&type=" + typeTabGoods;
                tableReturnInventoryWarehouseManageGoods = await loadDataOutInventoryBranchManage(element, url);
                loadingTabGoods = 1;
            } else if (loadingTabGoods === 0) {
                tableReturnInventoryWarehouseManageGoods.ajax.url("return-inventory-warehouse-manage.data?from=" + fromReturnInventoryWarehouseManage + "&to=" + toReturnInventoryWarehouseManage + "&branch_id=" + branchId + "&type=" + typeTabGoods).load();
            }
            break;
        case 3:
            if (tableReturnInventoryWarehouseManageBranch === '') {
                let element = $('#table-internal-return-inventory-warehouse-manage'),
                    url = "return-inventory-warehouse.data?from=" + fromReturnInventoryWarehouseManage + "&to=" + toReturnInventoryWarehouseManage + "&branch_id=" + branchId + "&type=" + typeTabBranch;
                tableReturnInventoryWarehouseManageBranch = await loadDataOutInventoryBranchManage(element, url);
                loadingTabBranch = 1;
            } else if (loadingTabBranch === 0) {
                tableReturnInventoryWarehouseManageBranch.ajax.url("return-inventory-warehouse.data?from=" + fromReturnInventoryWarehouseManage + "&to=" + toReturnInventoryWarehouseManage + "&branch_id=" + branchId + "&type=" + typeTabBranch).load();
            }
            break;
        case 12:
            if (tableReturnInventoryWarehouseManageOther === '') {
                let element = $('#table-other-return-inventory-warehouse-manage'),
                    url = "in-inventory-branch-manage.data?from=" + fromReturnInventoryWarehouseManage + "&to=" + toReturnInventoryWarehouseManage + "&branch_id=" + branchId + "&type=" + typeTabOther;
                tableReturnInventoryWarehouseManageOther = await loadDataOutInventoryBranchManage(element, url);
                loadingTabOther = 1;
            } else if (loadingTabOther === 0) {
                tableReturnInventoryWarehouseManageOther.ajax.url("return-inventory-warehouse.data?from=" + fromReturnInventoryWarehouseManage + "&to=" + toReturnInventoryWarehouseManage + "&branch_id=" + branchId + "&type=" + typeTabOther).load();
            }
            break;
        case 4:
            if (tableReturnInventoryWarehouseManageWaiting === '') {
                let element = $('#table-waiting-return-inventory-warehouse-manage'),
                    url = "return-inventory-warehouse.out-inventory-data?from=" + fromReturnInventoryWarehouseManage + "&to=" + toReturnInventoryWarehouseManage + "&branch_id=" + branchId + "&type=" + typeTabWaiting + "&status=" + 0 + "&warehouse_session_statuses=" + 1;
                tableReturnInventoryWarehouseManageWaiting = await loadDataOutInventoryBranchManage(element, url);
                loadingTabWaiting = 1;
            } else if (loadingTabWaiting === 0) {
                tableReturnInventoryWarehouseManageWaiting.ajax.url("return-inventory-warehouse.out-inventory-data?from=" + fromInInventoryBranchManage + "&to=" + toInInventoryBranchManage + "&branch_id=" + branchId + "&type=" + typeTabWaiting + "&status=" + 0 + "&warehouse_session_statuses=" + 1).load();
            }
            break;
        case 5:
            if (tableReturnInventoryWarehouseManageCancel === '') {
                let element = $('#table-cancel-return-inventory-warehouse-manage'),
                    url = "return-inventory-warehouse.out-inventory-data?from=" + fromReturnInventoryWarehouseManage + "&to=" + toReturnInventoryWarehouseManage + "&branch_id=" + branchId + "&type=" + typeTabCancel + "&status=" + -1 + "&warehouse_session_statuses=" + 3;
                tableReturnInventoryWarehouseManageCancel = await loadDataOutInventoryBranchManage(element, url);
                loadingTabCancel = 1;
            } else if (loadingTabCancel === 0) {
                tableReturnInventoryWarehouseManageCancel.ajax.url("return-inventory-warehouse.out-inventory-data?from=" + fromReturnInventoryWarehouseManage + "&to=" + toReturnInventoryWarehouseManage + "&branch_id=" + branchId + "&type=" + typeTabCancel + "&status=" + -1 + "&warehouse_session_statuses=" + 3).load();
            }
    }
}

async function loadDataOutInventoryBranchManage(element, url) {
    let fixedLeftTable = 2,
        fixedRightTable = 2,
        optionRenderTable = [];
    return DatatableServerSideTemplateNew(element, url, columnTable, vh_of_table, fixedLeftTable, fixedRightTable, optionRenderTable, callbackLoadData);
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

async function confirmReturnInventoryWarehouseManage(r) {
    if (checkSaveConfirmReturnInventoryWarehouse === 1) return false;
    let title = 'Xác nhận phiếu nhập kho ?',
        icon = 'question';
    sweetAlertComponent(title, '', icon).then(async (result) => {
        if(result.isConfirmed){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    cancelButton: 'btn btn-primary btn-sweet-alert ',
                    confirmButton: 'btn btn-grd-disabled btn-sweet-alert',
                },
                buttonsStyling: false,
            });
            swalWithBootstrapButtons.fire({
                title: 'Chọn ngày xác nhận phiếu nhập kho!',
                icon: 'warning',
                html:
                    `<div class="card-block p-0 d-flex justify-content-center seemt-main-content seemt-container" >
                   <div class="card-block-swal-alert"  >
                    <div class="form-group validate-group" style="margin-bottom: 0 !important;">
                                    <div class="form-validate-input" id="day" style="flex-direction:unset !important;height: 40px !important;">
                                    <input id="delivery-date-in-inventory" class="form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate" type="text" placeholder="${r.data('created-at')}" value="${r.data('created-at')}" />
                                    </div>
                                </div>
                </div></div>`,
                showCancelButton: true,
                showConfirmButton: true,
                cancelButtonText: $('#button-btn-cancel-component').text(),
                confirmButtonText: $('#button-btn-confirm-component').text(),
                reverseButtons: true,
                focusConfirm: true,
                customClass: {
                    cancelButton: 'swal2-cancel btn btn-grd-disabled btn-sweet-alert swal-button--cancel',
                    confirmButton: 'swal2-confirm btn btn-grd-primary btn-sweet-alert swal-button--confirm',
                }
            }).then(async (result) => {
                if (result.isConfirmed) {
                    checkSaveConfirmInInventory = 1;
                    let method = 'post',
                        url = 'return-inventory-warehouse.confirm',
                        params = null,
                        data = {
                            note: r.data('note'),
                            id: r.data('id'),
                            branch: r.data('branch'),
                            delivery : $('#delivery-date-in-inventory').val(),
                        };
                    let res = await axiosTemplate(method, url, params, data);
                    checkSaveConfirmReturnInventoryWarehouse = 0;
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
            dateTimePickerTemplate($('#delivery-date-in-inventory'));
            $('#delivery-date-in-inventory').on('dp.show', function(e) {
                $(this).parents('.card-block').attr('style', 'height:250px !important')
                $('.bootstrap-datetimepicker-widget').attr('style', 'width:300px !important; display:block')
            });
            $('#delivery-date-in-inventory').on('dp.hide', function(e) {
                $(this).parents('.card-block').attr('style', 'height:40px !important')
            });
        }

    });
}

function rejectReturnInventoryWarehouseManage(r) {
    if (checkSaveRejectReturnInventoryWarehouse === 1) return false;
    let title = 'Từ chối phiếu nhập từ chi nhánh khác ?',
        icon = 'question',
        content = '';
    sweetAlertInputComponent(title, 'id-cancel-in-inventory', content, icon).then(async (result) => {
        if (result.isConfirmed) {
            let cancel_reason = result.value
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    cancelButton: 'btn btn-primary btn-sweet-alert swal-button--cancel ',
                    confirmButton: 'btn btn-grd-disabled btn-sweet-alert swal-button--confirm',
                },
                buttonsStyling: false,
            });
            swalWithBootstrapButtons.fire({
                title: 'Chọn ngày hủy phiếu nhập kho!',
                icon: 'warning',
                html:
                    `<div class="card-block p-0 d-flex justify-content-center seemt-main-content seemt-container" >
                   <div class="card-block-swal-alert"  >
                    <div class="form-group validate-group" style="margin-bottom: 0 !important;">
                                    <div class="form-validate-input" id="day" style="flex-direction:unset !important;height: 40px !important;">
                                                         <input id="reject-date-in-inventory" class="form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate" type="text" placeholder="${r.data('created-at')}" value="${moment().format('DD/MM/YYYY')}" />
                                    </div>
                                </div>
                </div></div>`,
                showCancelButton: true,
                showConfirmButton: true,
                cancelButtonText: $('#button-btn-cancel-component').text(),
                confirmButtonText: $('#button-btn-confirm-component').text(),
                reverseButtons: true,
                focusConfirm: true,
                customClass: {
                    cancelButton: 'swal2-cancel btn btn-grd-disabled btn-sweet-alert swal-button--cancel',
                    confirmButton: 'swal2-confirm btn btn-grd-primary btn-sweet-alert swal-button--confirm',
                }
            }).then(async (result) => {
                if (result.isConfirmed) {
                    let method = 'post',
                        branch = $('.select-branch').val(),
                        url = 'return-inventory-warehouse.cancel',
                        params = null,
                        data = {
                            id: r.data('id'),
                            branch: branch,
                            note: r.data('note'),
                            cancel_reason: cancel_reason,
                            reject_date: $('#reject-date-in-inventory').val()
                        };
                    checkSaveRejectReturnInventoryWarehouse = 1;
                    let res = await axiosTemplate(method, url, params, data);
                    checkSaveRejectReturnInventoryWarehouse = 0;
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
            $('#reject-date-in-inventory').on('dp.show', function(e) {
                $(this).parents('.card-block').attr('style', 'height:250px !important')
                $('.bootstrap-datetimepicker-widget').attr('style', 'width:300px !important; display:block')
            });
            $('#reject-date-in-inventory').on('dp.hide', function(e) {
                $(this).parents('.card-block').attr('style', 'height:40px !important')
            });
        }
    });
}
