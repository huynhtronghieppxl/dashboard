let loadingTabDeliveryOutInventoryBranchManage = 0, loadingTabMaterialOutInventoryBranchManage = 0, loadingTabGoodsOutInventoryBranchManage = 0, loadingTabInternalOutInventoryBranchManage = 0,
    loadingTabOtherOutInventoryBranchManage = 0, loadingTabCancelOutInventoryBranchManage = 0,
    tabActiveOutInventoryBranchManage = 0, checkGet1,
    tableOutInventoryBranchManageMaterial = '', tableOutInventoryBranchManageGoods = '',
    tableOutInventoryBranchManageInternal = '',
    tableOutInventoryBranchManageOther = '', tableOutInventoryInternalManageCancel = '',
    tableOutInventoryBranchManageDelivery = '',checkCancelOutInventory = 0,
    branchIdOutInventoryBranch = $('.select-branch').val(), typeTabAllOutInventoryBranch = '', typeInventoryAllOutInventoryBranch = 6 , typeTabMaterialOutInventoryBranch = 1, typeTabGoodsOutInventoryBranch = 2, typeTabInternalOutInventoryBranch = 3,
    typeTabOtherOutInventoryBranch = 12, typeCancelOutInventoryBranch = 5,
    fromOutInventoryBranch = $('.from-date-out-inventory-internal-manage').val(), toOutInventoryBranch = $('.to-date-out-inventory-internal-manage').val(),
    columnOutInventoryBranchManage = [
        {data: 'index', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
        {data: 'code', name: 'code', className: 'text-left'},
        {data: 'employee', name: 'employee', className: 'text-left'},
        {data: 'target_branch.name', name: 'branch', className: 'text-center'},
        {data: 'delivery_date', name: 'delivery_date', className: 'text-center'},
        {data: 'total_material', name: 'total_material', className: 'text-center'},
        {data: 'total_amount', name: 'total_amount', className: 'text-right'},
        {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        {data: 'keysearch', className: 'd-none'},
    ];

$(function () {
    shortcut.add("F2", function () {
        openCreateOutInventoryInternalManage();
    });
    dateTimePickerFromMaxToDate($('.from-date-out-inventory-internal-manage'), $('.to-date-out-inventory-internal-manage'))
    if(getCookieShared('out-inventory-branch-manage-user-id' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('out-inventory-branch-manage-user-id' + idSession));
        fromOutInventoryBranch = dataCookie.from;
        toOutInventoryBranch = dataCookie.to;
        tabActiveOutInventoryBranchManage = dataCookie.tab;
        $('.from-date-out-inventory-internal-manage').val(fromOutInventoryBranch);
        $('.to-date-out-inventory-internal-manage').val(toOutInventoryBranch)
    }
    $('.from-date-out-inventory-internal-manage').on('dp.change', function () {
        $('.from-date-out-inventory-internal-manage').val($(this).val());
    });
    $('.to-date-out-inventory-internal-manage').on('dp.change', function () {
        $('.to-date-out-inventory-internal-manage').val($(this).val());
    });
    $('.search-out-inventory-internal-manage').on('click', function () {
        if(!checkDateTimePicker($(this))) return false
        fromOutInventoryBranch = $('.from-date-out-inventory-internal-manage').val();
        toOutInventoryBranch = $('.to-date-out-inventory-internal-manage').val();
        validateDateTemplate($('.from-date-out-inventory-internal-manage'), $('.to-date-out-inventory-internal-manage'), loadingData);
    });
    $('#nav-tab-out-inventory-branch a[data-id="' + tabActiveOutInventoryBranchManage + '"]').click()
});

async function loadData() {
    branchIdOutInventoryBranch = $('.select-branch').val();
    loadingData();
}

function updateCookieOutInventoryBranch(){
    saveCookieShared('out-inventory-branch-manage-user-id' + idSession, JSON.stringify({
        'tab' : tabActiveOutInventoryBranchManage,
        'from' : fromOutInventoryBranch,
        'to' : toOutInventoryBranch,
    }))
}

async function loadingData() {

    updateCookieOutInventoryBranch()
    switch (tabActiveOutInventoryBranchManage) {
        case 0:
            loadingTabDeliveryOutInventoryBranchManage = 1;
            loadingTabMaterialOutInventoryBranchManage = 0;
            loadingTabGoodsOutInventoryBranchManage = 0;
            loadingTabInternalOutInventoryBranchManage = 0;
            loadingTabOtherOutInventoryBranchManage = 0;
            loadingTabCancelOutInventoryBranchManage = 0;
            tableOutInventoryBranchManageDelivery.ajax?.url("out-inventory-branch-manage.data?from=" + fromOutInventoryBranch + "&to=" + toOutInventoryBranch + "&branch_id=" + branchIdOutInventoryBranch + "&type=" + typeTabAllOutInventoryBranch + "&warehouse_session_statuses=" + 1 +"&type_all=" + typeInventoryAllOutInventoryBranch + "&warehouse_session_statuses_count=" + 2).load();
            break;
        case 1:
            loadingTabDeliveryOutInventoryBranchManage = 0;
            loadingTabMaterialOutInventoryBranchManage = 1;
            loadingTabGoodsOutInventoryBranchManage = 0;
            loadingTabInternalOutInventoryBranchManage = 0;
            loadingTabOtherOutInventoryBranchManage = 0;
            loadingTabCancelOutInventoryBranchManage = 0;
            tableOutInventoryBranchManageMaterial.ajax?.url("out-inventory-branch-manage.data?from=" + fromOutInventoryBranch + "&to=" + toOutInventoryBranch + "&branch_id=" + branchIdOutInventoryBranch + "&type=" +typeTabMaterialOutInventoryBranch  + "&warehouse_session_statuses=" + 2 + "&type_all=" + typeTabMaterialOutInventoryBranch + "&warehouse_session_statuses_count=" + 2).load();
            break;
        case 2:
            loadingTabDeliveryOutInventoryBranchManage = 0;
            loadingTabMaterialOutInventoryBranchManage = 0;
            loadingTabGoodsOutInventoryBranchManage = 1;
            loadingTabInternalOutInventoryBranchManage = 0;
            loadingTabOtherOutInventoryBranchManage = 0;
            loadingTabCancelOutInventoryBranchManage = 0;
            tableOutInventoryBranchManageGoods.ajax?.url("out-inventory-branch-manage.data?from=" + fromOutInventoryBranch + "&to=" + toOutInventoryBranch + "&branch_id=" + branchIdOutInventoryBranch + "&type=" + typeTabGoodsOutInventoryBranch + "&warehouse_session_statuses=" + 2 + "&type_all=" + typeTabGoodsOutInventoryBranch + "&warehouse_session_statuses_count=" + 2).load();
            break;
        case 3:
            loadingTabDeliveryOutInventoryBranchManage = 0;
            loadingTabMaterialOutInventoryBranchManage = 0;
            loadingTabGoodsOutInventoryBranchManage = 0;
            loadingTabInternalOutInventoryBranchManage = 1;
            loadingTabOtherOutInventoryBranchManage = 0;
            loadingTabCancelOutInventoryBranchManage = 0;
            tableOutInventoryBranchManageInternal.ajax?.url("out-inventory-branch-manage.data?from=" + fromOutInventoryBranch + "&to=" + toOutInventoryBranch + "&branch_id=" + branchIdOutInventoryBranch + "&type=" + typeTabGoodsOutInventoryBranch + "&warehouse_session_statuses=" + 2 + "&type_all=" + typeTabInternalOutInventoryBranch + "&warehouse_session_statuses_count=" + 2).load();
            break;
        case 4:
            loadingTabDeliveryOutInventoryBranchManage = 0;
            loadingTabMaterialOutInventoryBranchManage = 0;
            loadingTabGoodsOutInventoryBranchManage = 0;
            loadingTabInternalOutInventoryBranchManage = 0;
            loadingTabOtherOutInventoryBranchManage = 1;
            loadingTabCancelOutInventoryBranchManage = 0;
            tableOutInventoryBranchManageOther.ajax?.url("out-inventory-branch-manage.data?from=" + fromOutInventoryBranch + "&to=" + toOutInventoryBranch + "&branch_id=" + branchIdOutInventoryBranch + "&type=" + typeTabInternalOutInventoryBranch + "&warehouse_session_statuses=" + 2 + "&type_all=" + typeTabOtherOutInventoryBranch + "&warehouse_session_statuses_count=" + 2).load();
            break;
        case 5:
            loadingTabDeliveryOutInventoryBranchManage = 0;
            loadingTabMaterialOutInventoryBranchManage = 0;
            loadingTabGoodsOutInventoryBranchManage = 0;
            loadingTabInternalOutInventoryBranchManage = 0;
            loadingTabOtherOutInventoryBranchManage = 0;
            loadingTabCancelOutInventoryBranchManage = 1;
            tableOutInventoryInternalManageCancel.ajax?.url("out-inventory-branch-manage.data?from=" + fromOutInventoryBranch + "&to=" + toOutInventoryBranch + "&branch_id=" + branchIdOutInventoryBranch + "&type=" + typeTabAllOutInventoryBranch + "&warehouse_session_statuses=" + 3 + "&type_all=" + typeCancelOutInventoryBranch + "&warehouse_session_statuses_count=" + 2).load();
            break;
    }
}

async function changeActiveTabOutInventoryInternalManage(tab) {
    tabActiveOutInventoryBranchManage = tab;
    updateCookieOutInventoryBranch()
    !branchIdOutInventoryBranch ? await updateSessionBrandNew($('.select-brand')) : false;
    switch (tab) {
        case 0:
            if (tableOutInventoryBranchManageDelivery === '') {
                let element = $('#table-material-waiting-inventory-internal-manage'),
                    url = "out-inventory-branch-manage.data?from=" + fromOutInventoryBranch + "&to=" + toOutInventoryBranch + "&branch_id=" + branchIdOutInventoryBranch + "&type=" + typeTabAllOutInventoryBranch + "&warehouse_session_statuses=" + 1 + "&type_all=" + typeInventoryAllOutInventoryBranch + "&warehouse_session_statuses_count=" + 2;
                tableOutInventoryBranchManageDelivery = await loadDataOutInventoryInternalManage(element, url);
                loadingTabDeliveryOutInventoryBranchManage = 1;
            } else if (loadingTabDeliveryOutInventoryBranchManage === 0) {
                tableOutInventoryBranchManageDelivery.ajax.url("out-inventory-branch-manage.data?from=" + fromOutInventoryBranch + "&to=" + toOutInventoryBranch + "&branch_id=" + branchIdOutInventoryBranch + "&type=" + typeTabAllOutInventoryBranch + "&warehouse_session_statuses=" + 1  +"&type_all=" + typeInventoryAllOutInventoryBranch + "&warehouse_session_statuses_count=" + 2).load();
            }
            break;
        case 1:
            if (tableOutInventoryBranchManageMaterial === '') {
                let element = $('#table-material-out-inventory-internal-manage'),
                    url = "out-inventory-branch-manage.data?from=" + fromOutInventoryBranch + "&to=" + toOutInventoryBranch + "&branch_id=" + branchIdOutInventoryBranch + "&type=" + typeTabMaterialOutInventoryBranch + "&warehouse_session_statuses=" + 2 + "&type_all=" + typeTabMaterialOutInventoryBranch + "&warehouse_session_statuses_count=" + 2;
                tableOutInventoryBranchManageMaterial = await loadDataOutInventoryInternalManage(element, url);
                loadingTabMaterialOutInventoryBranchManage = 1;
            } else if (loadingTabMaterialOutInventoryBranchManage === 0) {
                tableOutInventoryBranchManageMaterial.ajax.url("out-inventory-branch-manage.data?from=" + fromOutInventoryBranch + "&to=" + toOutInventoryBranch + "&branch_id=" + branchIdOutInventoryBranch + "&type=" + typeTabMaterialOutInventoryBranch + "&warehouse_session_statuses=" + 2 + "&type_all=" + typeTabMaterialOutInventoryBranch + "&warehouse_session_statuses_count=" + 2).load();
            }
            break;
        case 2:
            if (tableOutInventoryBranchManageGoods === '') {
                let element = $('#table-goods-out-inventory-internal-manage'),
                    url = "out-inventory-branch-manage.data?from=" + fromOutInventoryBranch + "&to=" + toOutInventoryBranch + "&branch_id=" + branchIdOutInventoryBranch + "&type=" + typeTabGoodsOutInventoryBranch + "&warehouse_session_statuses=" + 2 + "&type_all=" + typeTabGoodsOutInventoryBranch + "&warehouse_session_statuses_count=" + 2;
                tableOutInventoryBranchManageGoods = await loadDataOutInventoryInternalManage(element, url);
                loadingTabGoodsOutInventoryBranchManage = 1;
            } else if (loadingTabGoodsOutInventoryBranchManage === 0) {
                tableOutInventoryBranchManageGoods.ajax.url("out-inventory-branch-manage.data?from=" + fromOutInventoryBranch + "&to=" + toOutInventoryBranch + "&branch_id=" + branchIdOutInventoryBranch + "&type=" + typeTabGoodsOutInventoryBranch + "&warehouse_session_statuses=" + 2 + "&type_all=" + typeTabGoodsOutInventoryBranch + "&warehouse_session_statuses_count=" + 2).load();
            }
            break;
        case 3:
            if (tableOutInventoryBranchManageInternal === '') {
                let element = $('#table-internal-out-inventory-internal-manage'),
                    url = "out-inventory-branch-manage.data?from=" + fromOutInventoryBranch + "&to=" + toOutInventoryBranch + "&branch_id=" + branchIdOutInventoryBranch + "&type=" + typeTabInternalOutInventoryBranch + "&warehouse_session_statuses=" + 2 + "&type_all=" + typeTabInternalOutInventoryBranch + "&warehouse_session_statuses_count=" + 2;
                tableOutInventoryBranchManageInternal = await loadDataOutInventoryInternalManage(element, url);
                loadingTabInternalOutInventoryBranchManage = 1;
            } else if (loadingTabInternalOutInventoryBranchManage === 0) {
                tableOutInventoryBranchManageInternal.ajax.url("out-inventory-branch-manage.data?from=" + fromOutInventoryBranch + "&to=" + toOutInventoryBranch + "&branch_id=" + branchIdOutInventoryBranch + "&type=" + typeTabInternalOutInventoryBranch + "&warehouse_session_statuses=" + 2 + "&type_all=" + typeTabInternalOutInventoryBranch + "&warehouse_session_statuses_count=" + 2).load();
            }
            break;
        case 4:
            if (tableOutInventoryBranchManageOther === '') {
                let element = $('#table-other-out-inventory-internal-manage'),
                    url = "out-inventory-branch-manage.data?from=" + fromOutInventoryBranch + "&to=" + toOutInventoryBranch + "&branch_id=" + branchIdOutInventoryBranch + "&type=" + typeTabOtherOutInventoryBranch + "&warehouse_session_statuses=" + 2 + "&type_all=" + typeTabOtherOutInventoryBranch + "&warehouse_session_statuses_count=" + 2;
                tableOutInventoryBranchManageOther = await loadDataOutInventoryInternalManage(element, url);
                loadingTabOtherOutInventoryBranchManage = 1;
            } else if (loadingTabOtherOutInventoryBranchManage === 0) {
                tableOutInventoryBranchManageOther.ajax.url("out-inventory-branch-manage.data?from=" + fromOutInventoryBranch + "&to=" + toOutInventoryBranch + "&branch_id=" + branchIdOutInventoryBranch + "&type=" + typeTabOtherOutInventoryBranch + "&warehouse_session_statuses=" + 2 + "&type_all=" + typeTabOtherOutInventoryBranch + "&warehouse_session_statuses_count=" + 2).load();
            }
            break;
        case 5:
            if (tableOutInventoryInternalManageCancel === '') {
                let element = $('#table-cancel-out-inventory-internal-manage'),
                    url = "out-inventory-branch-manage.data?from=" + fromOutInventoryBranch + "&to=" + toOutInventoryBranch + "&branch_id=" + branchIdOutInventoryBranch + "&type=" + typeTabAllOutInventoryBranch + "&warehouse_session_statuses=" + 3 + "&type_all=" + typeCancelOutInventoryBranch + "&warehouse_session_statuses_count=" + 2 + "&warehouse_session_statuses_count=" + 2;
                tableOutInventoryInternalManageCancel = await loadDataOutInventoryInternalManage(element, url);
                loadingTabCancelOutInventoryBranchManage = 1;
            } else if (loadingTabCancelOutInventoryBranchManage === 0) {
                tableOutInventoryInternalManageCancel.ajax.url("out-inventory-branch-manage.data?from=" + fromOutInventoryBranch + "&to=" + toOutInventoryBranch + "&branch_id=" + branchIdOutInventoryBranch + "&type=" + typeTabAllOutInventoryBranch + "&warehouse_session_statuses=" + 3 + "&type_all=" + typeCancelOutInventoryBranch + "&warehouse_session_statuses_count=" + 2 + "&warehouse_session_statuses_count=" + 2).load();
            }
            break;
    }
}

async function loadDataOutInventoryInternalManage(element, url) {
    let fixedLeftTable = 0,
        fixedRightTable = 0,
        optionRenderTable = [{
            'title': 'Thêm mới',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'openCreateOutInventoryInternalManage',
        }]
    return DatatableServerSideTemplateNew(element, url, columnOutInventoryBranchManage, vh_of_table, fixedLeftTable, fixedRightTable, optionRenderTable, callbackLoadData);
}

function callbackLoadData(response) {
    $('#total-record-waiting').text(response.config[1].data.count_waiting_confirm_out);
    $('#total-record-material').text(response.config[1].data.count_material);
    $('#total-record-goods').text(response.config[1].data.count_goods);
    $('#total-record-material-internal').text(response.config[1].data.count_internal);
    $('#total-record-other').text(response.config[1].data.count_other);
    $('#total-record-cancel').text(response.config[1].data.count_other_cancel_out);

    $('#total-amount-waiting-confirm-out-inventory-branch').text(formatNumber(response.config[1].data.total_amount_waiting_confirm_out))
    $('#total-amount-material-out-inventory-branch').text(formatNumber(response.config[1].data.total_amount_material))
    $('#total-amount-goods-out-inventory-branch').text(formatNumber(response.config[1].data.total_amount_goods))
    $('#total-amount-internal-out-inventory-branch').text(formatNumber(response.config[1].data.total_amount_internal))
    $('#total-amount-other-out-inventory-branch').text(formatNumber(response.config[1].data.total_amount_other))
    $('#total-amount-other-cancel-out-inventory-branch').text(formatNumber(response.config[1].data.total_amount_other_cancel_out))
}

function cancelOutInventoryInternalManageBranch(r) {
    if (checkCancelOutInventory === 1) return false;
    let title = 'Hủy giao hàng ?',
        content = `Xác nhận hủy phiếu xuất hàng sang chi nhánh [${r.data('target-branch')}] ?`,
        icon = 'question';
    let noteCancel = '';
    sweetAlertInputComponent(title, 'id-note-cancel-reson-out-inventory', content, icon).then(async (result) => {
        if (result.isConfirmed) {
            noteCancel = result.value;
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
                    `<div class="card-block p-0 d-flex justify-content-center">
                       <div class="col-lg-11">
                        <div class="input-group w-100 add-display border-group pr-0" id="day">
                            <input id="reject-date-in-inventory" class="form-control text-center input-sm input-datetimepicker custom-form-search class-date-from-validate" type="text" value="${moment().format('DD/MM/YYYY')}" />
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
                    checkCancelOutInventory = 1;
                    let method = 'post',
                        branch = $('.select-branch').val(),
                        url = 'in-inventory-branch-manage.cancel',
                        params = null,
                        data = {
                            id: r.data('id'),
                            branch: branch,
                            cancel_reason: noteCancel,
                            reject_date: $('#reject-date-in-inventory').val(),
                            note: r.data('note')
                        };
                    let res = await axiosTemplate(method, url, params, data);
                    checkCancelOutInventory = 0;
                    let text = $('#success-cancel-data-to-server').text();
                    switch (res.data.status){
                        case 200:
                            SuccessNotify(text);
                            loadingData();
                            break;
                        case 500:
                            text = $('#error-post-data-to-server').text();
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
        }
        dateTimePickerFomartTemplate($('#reject-date-in-inventory'));
    });
}

