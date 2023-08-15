let dataTableSupplierMaterialEnable = [],
    dataTableSupplierMaterialDisable = [],
    thisStatusSupplierMaterialData,
    checkGetListSupplierMaterialData,
    tabChangeTableSupplierMaterial = 1, selectSupplierMaterial,
    checkChangeSupplierMaterialStatus = 0;
$(function () {
    addLoading('supplier-material-data.data');
    addLoading('supplier-material-data.get-supplier');
    if(getCookieShared('material-supplier-user-id-' + idSession)) {
        let dataCookie = JSON.parse(getCookieShared('material-supplier-user-id-' + idSession));
        tabChangeTableSupplierMaterial = dataCookie.tab
        selectSupplierMaterial = dataCookie.select
    }else {
        selectSupplierMaterial = 0 ;
    }
    $('.nav-link').on('click', function () {
        tabChangeTableSupplierMaterial  = $(this).data('id')
        updateCookieMaterialSupplier()
    })
    $('.nav-link[data-id="' + tabChangeTableSupplierMaterial + '"]').click()
    $('.supplier-material-supplier-data').on('change', function () {
        $('.supplier-material-supplier-data').val($(this).val()).trigger('change.select2');
    });
    $('.supplier-material-supplier-data').on('select2:select', function () {
        selectSupplierMaterial = $(this).val();
        updateCookieMaterialSupplier()
        dataMaterialSupplier();
    });
    loadData();
})

async function loadData() {
    await getSupplierData();
    dataMaterialSupplier();
}
function updateCookieMaterialSupplier(){
    saveCookieShared('material-supplier-user-id-' + idSession, JSON.stringify({
        'tab' : tabChangeTableSupplierMaterial,
        'select' : selectSupplierMaterial,
    }))
}

async function getSupplierData() {
    if(checkGetListSupplierMaterialData !== 1){
        let method = 'get',
            url = 'supplier-material-data.get-supplier',
            params = null,
            data = null;
        checkGetListSupplierMaterialData = 1;

        let res = await axiosTemplate(method, url, params, data);
        checkGetListSupplierMaterialData = 0;
        $('.supplier-material-supplier-data, #select-supplier-in-supplier-material-data').html(res.data[0]);
            //kiểm tra nếu giá trị select chưa có cookie
        checkHasInSelect(selectSupplierMaterial, $('.supplier-material-supplier-data'))
        selectSupplierMaterial = $('.supplier-material-supplier-data').val()
    }
}

async function dataMaterialSupplier() {
    let method = 'get',
        url = 'supplier-material-data.data',
        params = {supplier_id: $('.supplier-material-supplier-data').val()},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#content-body-techres')]);
    dataTableSupplierMaterial(res.data);
    dataTotalSupplierMaterial(res.data[2]);
}

async function dataTableSupplierMaterial(data) {
    let tableEnable = $('#table-enable-material-supplier-data'),
        tableDisable = $('#table-disable-material-supplier-data'),
        scroll_Y = vh_of_table,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name',  width: '10%'},
            {data: 'material_category_name', name: 'material_category_name', className: 'text-center'},
            {data: 'cost_price', name: 'cost_price', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '10%'},
            {data: 'keysearch', className: 'd-none'},
        ],
        option = [{
            'title': 'Thêm mới',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'openModalCreateSupplierMaterial',
        },
        {
            'title': 'Gán nguyên liệu',
            'icon': 'fa fa-exchange',
            'class': '',
            'function': 'openModalUpdateSupplierMaterialData',
        }],
        fixed_left = 0,
        fixed_right = 0;
    dataTableSupplierMaterialEnable = await DatatableTemplateNew(tableEnable, data[0], columns, scroll_Y, fixed_left, fixed_right, option);
    dataTableSupplierMaterialDisable = await DatatableTemplateNew(tableDisable, data[1], columns, scroll_Y, fixed_left, fixed_right, option);
    $(document).on('input paste keyup','#table-enable-material-supplier-data_filter', function (){
        let index = 1 ;
        $('#total-record-enable').text( dataTableSupplierMaterialEnable.rows({'search': 'applied'}).count());
        dataTableSupplierMaterialEnable.rows({'search': 'applied'}).every( function () {
            let row = $(this.node());
            row.find('td:eq(0)').text(index);
            index++ ;
        } );
    })
    $(document).on('input paste keyup','#table-disable-material-supplier-data_filter', function (){
        let index = 1 ;
        $('#total-record-disable').text( dataTableSupplierMaterialDisable.rows({'search': 'applied'}).count());
        dataTableSupplierMaterialDisable.rows({'search': 'applied'}).every( function () {
            let row = $(this.node());
            row.find('td:eq(0)').text(index);
            index++ ;
        } );
    })
}

function dataTotalSupplierMaterial(data) {
    $('#total-record-enable').text(data.enable);
    $('#total-record-disable').text(data.disable);
}

function changeSupplierMaterialStatus(r) {
    if(checkChangeSupplierMaterialStatus === 1) return false;
    thisStatusSupplierMaterialData = r;
    let title = (r.data('status') == 1) ? 'Đổi sang trạng thái tạm ngưng?' : 'Đổi sang trạng thái hoạt động?',
        content = '',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            checkChangeSupplierMaterialStatus = 1;
            let method = 'post',
                url = 'supplier-material-data.change-supplier-material-status',
                params = null,
                data = {material_id: r.data('material-id')};
            let res = await axiosTemplate(method, url, params, data, [$('#content-body-techres')]);
            checkChangeSupplierMaterialStatus = 0;
            switch(res.data.status) {
                case 200:
                    SuccessNotify($('#success-status-data-to-server').text());
                    let item = {
                        'DT_RowIndex':1,
                        'name' : res.data.data.name,
                        'material_category_name' :  res.data.data.material_category_name,
                        'cost_price' : res.data.data.cost_price,
                        'action' : res.data.data.action,
                        'keysearch':''
                    }
                    if (res.data.data.status === 0){
                        addRowDatatableTemplate(dataTableSupplierMaterialDisable, item);
                        removeRowDatatableTemplate(dataTableSupplierMaterialEnable, r, true);
                        $('#total-record-enable').text(removeformatNumber($('#total-record-enable').text()) - 1)
                        $('#total-record-disable').text(removeformatNumber($('#total-record-disable').text()) + 1)
                    }
                    else{
                        addRowDatatableTemplate(dataTableSupplierMaterialEnable, item);
                        removeRowDatatableTemplate(dataTableSupplierMaterialDisable, r, true);
                        $('#total-record-enable').text(removeformatNumber($('#total-record-enable').text()) + 1)
                        $('#total-record-disable').text(removeformatNumber($('#total-record-disable').text()) - 1)
                    }
                    break;
                case 205:
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            container: 'popup-swal-205',
                            cancelButton: 'btn btn-grd-disabled btn-sweet-alert',
                        },
                        buttonsStyling: false
                    });
                    swalWithBootstrapButtons.fire({
                        title: 'Đơn hàng chưa hoàn tất' ,
                        icon: 'warning',
                        html:
                            `<h5 class="f-w-600 col-form-label-fz-15"> ${res.data.message} </h5>
                                <div class="card-block px-0">
                                    <div class="table-responsive new-table">
                                        <table id="table-order-not-complete" class="table" >
                                            <thead>
                                                <tr>
                                                    <th class="text-center">STT </th>
                                                    <th class="text-center">Mã đơn hàng</th>
                                                    <th></th>
                                                    <th class="d-none"></th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>`,
                        showCancelButton: true,
                        showConfirmButton: false,
                        cancelButtonText: $('#button-btn-cancel-component').text(),
                        reverseButtons: true,
                        focusConfirm: true,
                    }).then(async (result) => {
                        if (result.value) {
                            let method = 'post',
                                url = 'restaurant-supplier-data.change-status',
                                params = null,
                                data = {id: id};
                            let res = await axiosTemplate(method, url, params, data);
                             if (res.status === 200) {
                                SuccessNotify($('#success-update-data-to-server').text());
                            }
                        }
                    })
                    dataTableUnAssignSupplier(res);
                    break;
                case 500:
                    ErrorNotify($('#error-post-data-to-server').text());
                    break;
                default:
                    WarningNotify(res.data.message);
            }
        }
    })
}

function drawTableEnableSupplierMaterialData(data) {
    switch (data.status) {
        case 0:
            $('#total-record-enable').text(formatNumber(removeformatNumber(Number($('#total-record-enable').text()) - 1)));
            $('#total-record-disable').text(formatNumber(removeformatNumber(Number($('#total-record-disable').text()) + 1)));
            removeRowDatatableTemplate(dataTableSupplierMaterialEnable , thisStatusSupplierMaterialData , true);
            addRowDatatableTemplate(dataTableSupplierMaterialDisable, {
                'name': data.name,
                'code': data.code,
                'material_category_name': data.material_category_name,
                'cost_price': formatNumber(data.cost_price),
                'action': data.action,
                'keysearch': data.keysearch,
            });
            break;
        case 1:
            $('#total-record-disable').text(formatNumber(removeformatNumber(Number($('#total-record-disable').text()) - 1)));
            $('#total-record-enable').text(formatNumber(removeformatNumber(Number($('#total-record-enable').text()) + 1)));
            removeRowDatatableTemplate(dataTableSupplierMaterialDisable , thisStatusSupplierMaterialData , true);
            addRowDatatableTemplate(dataTableSupplierMaterialEnable, {
                'name': data.name,
                'code': data.code,
                'material_category_name': data.material_category_name,
                'cost_price': formatNumber(data.cost_price),
                'action': data.action,
                'keysearch': data.keysearch,
            });
            break;
    }
}

async function dataTableUnAssignSupplier(data) {
    let table_un_assign = $('#table-order-not-complete'),
        scroll_Y = '300px',
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'code', name: 'code', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center' , width: '10%'},
            {data: 'keysearch', className: 'd-none'},
        ];
    await DatatableTemplateNew(table_un_assign, data.data.data.original.data, column, scroll_Y, fixed_left, fixed_right, []);
}
