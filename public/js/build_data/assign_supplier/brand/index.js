let dataBrandSupplierData = [],
    dataRestaurantSupplierData = [],
    drawBrandSupplierData,
    isSaveBrandSupplierData = 0,
    drawRestaurantSupplierData,
    selectBrandSupplier, typeSupplierAssignBrand = -1;

$(function () {
    if(getCookieShared('assign-supplier-brand-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('assign-supplier-brand-user-id-' + idSession));
        selectBrandSupplier = dataCookie.select;
        $('#select-brand-assign-supplier-data').val(selectBrandSupplier).trigger('change.select2');
    }
    shortcut.add('F4', function () {
        saveBrandSupplierData();
    });
    $('#select-brand-assign-supplier-data').on('select2:select', function () {
        selectBrandSupplier= $(this).val();
        updateCookieUnitSelectBrand()
        loadData();
    })
    $('#select-type-supplier-data').on('select2:select', function () {
        typeSupplierAssignBrand= $(this).val();
        updateCookieUnitSelectBrand()
        loadData();
    })
    loadData();
})

function updateCookieUnitSelectBrand(){
    saveCookieShared('assign-supplier-brand-user-id-' + idSession, JSON.stringify({
        'select':selectBrandSupplier
    }))
}

async function loadData() {
    let brand = $('#select-brand-assign-supplier-data').val(),
        method = 'get',
        url = 'brand-assign-supplier-data.data',
        params = {restaurant_brand_id: brand,
            is_restaurant_supplier : typeSupplierAssignBrand},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#body-restaurant-supplier-data'), $('#body-brand-supplier-data')]);
    dataBrandSupplierData = await res.data[0].original.data;
    dataRestaurantSupplierData = await res.data[1].original.data;
    dataTableSystemSupplierForBrand(res);
}

async function dataTableSystemSupplierForBrand(data) {
    let tableRestaurant = $('#table-restaurant-supplier-data'),
        tableBrand = $('#table-brand-supplier-data'),
        fixed_left = 0,
        fixed_right = 0,
        columnRestaurant = [
            {data: 'name', name: 'name'},
            {data: 'phone', name: 'phone', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center',width: '10%'},
            {data: 'keysearch', className: 'd-none'},
        ],
        columnBrand = [
            {data: 'action', name: 'action', className: 'text-center' ,width: '10%'},
            {data: 'name', name: 'name', className: 'py-2'},
            {data: 'phone', name: 'phone', className: 'text-center'},
            {data: 'keysearch', className: 'd-none'},
        ],
        option = [
            {
                'title': 'Cập nhật',
                'icon': 'fa fa-upload',
                'class': '',
                'function': 'saveBrandSupplierData',
            }
        ];
    drawRestaurantSupplierData = await DatatableTemplateNew(tableRestaurant, data.data[1].original.data, columnRestaurant, vh_of_table, fixed_left, 2, []);
    drawBrandSupplierData = await DatatableTemplateNew(tableBrand, data.data[0].original.data, columnBrand, vh_of_table, 1, fixed_right, option);
}

async function saveBrandSupplierData() {
    if (isSaveBrandSupplierData !== 0) {
        return false;
    }
    let supplier_ids = [];
    await drawBrandSupplierData.rows().every(function (index, element) {
        let row = $(this.node());
        supplier_ids[index] = row.find('td:eq(0)').find('i').data('id');
    });
    isSaveBrandSupplierData = 1;
    let brand = $('#select-brand-assign-supplier-data').val(),
        method = 'post',
        url = 'brand-assign-supplier-data.update',
        params = null,
        data = {
            supplier_ids: supplier_ids,
            restaurant_brand_id: brand,
            remove_supplier_ids: []
        };
    let res = await axiosTemplate(method, url, params, data, [$('#body-brand-supplier-data'), $('#table-un-assign-supplier-brand')]);
    isSaveBrandSupplierData = 0;
    switch (res.data.status){
        case 200:
            SuccessNotify('Cập nhật thành công');
            $('#table-brand-supplier-data tr td i.fa-2x[data-type="0"]').attr('data-type', 1);
            $('#body-brand-supplier-data .toolbar-button-datatable').css({"border":"", "border-radius": "", "margin-bottom" : "", "transition" : ""});
            break;
        case 500:
            ErrorNotify(res.data.message);
            break;
        default:
            WarningNotify(res.data.message);
    }
}

async function checkAllBrandSupplierData() {
    addAllRowDatatableTemplate(drawRestaurantSupplierData,drawBrandSupplierData, itemBrandDraw)
    $('#body-brand-supplier-data .toolbar-button-datatable').css({"border":"2px solid #10e610", "border-radius": "8px", "margin-bottom" : "6px", "transition" : "all .2s linear"});
}

async function unCheckAllBrandSupplierData() {
    addAllRowDatatableTemplate(drawBrandSupplierData,drawRestaurantSupplierData, itemRestaurantDraw)
}

function itemBrandDraw(row){
    return  {
        'id': row.find('td:eq(2)').find('i').data('id'),
        'name': row.find('td:eq(0)').html(),
        'phone': row.find('td:eq(1)').text(),
        'action': '<i class="fa fa-2x fa-arrow-circle-left btn-convert-left-to-right pointer" onclick="unCheckBrandSupplierData($(this))" data-id="' + row.find('td:eq(2)').find('i').data('id') + '"></i>',
        'keysearch': row.find('td:eq(3)').text(),
    };
}
function itemRestaurantDraw(row){
    return  {
        'id': row.find('td:eq(0)').find('i').data('id'),
        'name': row.find('td:eq(1)').html(),
        'phone': row.find('td:eq(2)').text(),
        'action': '<i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right pointer" onclick="checkBrandSupplierData($(this))" data-id="' + row.find('td:eq(0)').find('i').data('id') + '"></i>',
        'keysearch': row.find('td:eq(3)').text(),
    };
}

async function checkBrandSupplierData(r) {
    let item = {
        'id': r.parents('tr').find('td:eq(2)').find('i').data('id'),
        'name': r.parents('tr').find('td:eq(0)').html(),
        'phone': r.parents('tr').find('td:eq(1)').text(),
        'action': '<i class="fa fa-2x fa-arrow-circle-left btn-convert-left-to-right pointer" onclick="unCheckBrandSupplierData($(this))" data-id="' + r.parents('tr').find('td:eq(2)').find('i').data('id') + '" data-type="0"></i>',
        'keysearch': r.parents('tr').find('td:eq(3)').text(),
    };
    addRowDatatableTemplate(drawBrandSupplierData, item);
    drawRestaurantSupplierData.row(r.parents('tr')).remove().draw(false);
    $('#body-brand-supplier-data .toolbar-button-datatable').css({"border":"2px solid #10e610", "border-radius": "8px", "margin-bottom" : "6px", "transition" : "all .2s linear"});
}

async function unCheckBrandSupplierData(r) {
    let item = {
        'id': r.parents('tr').find('td:eq(0)').find('i').data('id'),
        'name': r.parents('tr').find('td:eq(1)').html(),
        'phone': r.parents('tr').find('td:eq(2)').text(),
        'action': '<i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right pointer" onclick="checkBrandSupplierData($(this))" data-id="' + r.parents('tr').find('td:eq(0)').find('i').data('id') + '" data-type="1"></i>',
        'keysearch': r.parents('tr').find('td:eq(3)').text(),
    };
    if(r.data('type') == 1){
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary btn-sweet-alert',
                cancelButton: 'btn btn-grd-disabled btn-sweet-alert'
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: 'Bỏ gán NCC khỏi thương hiệu',
            text: "Nhà cung cấp và các nguyên liệu sẽ được bỏ gán!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Đồng ý',
            cancelButtonText: 'Hủy',
            reverseButtons: true,
            focusConfirm: true
        }).then(async (result) => {
            if (result.value) {
                let id_supplier_uncheck = r.data('id');
                let method = 'post',
                    url = 'brand-assign-supplier-data.un-assign',
                    params = null,
                    data = {
                        supplier_id: id_supplier_uncheck,
                        restaurant_brand_id: $('#select-brand-assign-supplier-data').val(),
                    };
                let res = await axiosTemplate(method, url, params, data);
                switch (res.data.status) {
                    case 200 :
                        SuccessNotify('Cập nhật thành công');
                        addRowDatatableTemplate(drawRestaurantSupplierData , item);
                        drawBrandSupplierData.row(r.parents('tr')).remove().draw(false);
                        break;
                    case 205:
                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                cancelButton: 'btn btn-grd-disabled btn-sweet-alert',
                            },
                            buttonsStyling: false
                        });
                        swalWithBootstrapButtons.fire({
                            title: 'Nhà cung cấp vẫn còn đơn hàng chưa hoàn tất!',
                            icon: 'warning',
                            html:
                                `<div class="card-block p-0" >
                            <div class="table-responsive new-table">
                            <h5>${res.data.message}</h5>
                                <table id="table-un-assign-brand" class="table" >
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Mã đơn</th>
                                            <th>Tên NCC</th>
                                            <th></th>
                                            <th class="d-none"></th>
                                        </tr>
                                    </thead>
                                </table>
                                </h5>
                            </div>`,
                            showCancelButton: true,
                            showConfirmButton: false,
                            cancelButtonText: $('#button-btn-cancel-component').text(),
                            reverseButtons: true,
                            focusConfirm: true,
                            customClass: {
                                container: 'popup-swal-205',
                                cancelButton: 'btn btn-grd-disabled btn-sweet-alert',
                            }
                        })
                        dataTableUnAssignBrand(res);
                        break;
                    case 500:
                        ErrorNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
                        break;
                    default:
                        WarningNotify((res.data.message !== null) ? res.data.message : $('#warning-post-data-to-server').text());
                }
            }
        });
    }else{
        addRowDatatableTemplate(drawRestaurantSupplierData , item);
        drawBrandSupplierData.row(r.parents('tr')).remove().draw(false);
    }
}

async function dataTableUnAssignBrand(data) {
    let table_un_assign = $('#table-un-assign-brand'),
        scroll_Y = '300px',
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '8%'},
            {data: 'code', name: 'code', className: 'text-center'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center' , width: '10%'},
            {data: 'keysearch', className: 'd-none'},
        ];
    await DatatableTemplateNew(table_un_assign, data.data.data.original.data, column, scroll_Y, fixed_left, fixed_right, []);
}

