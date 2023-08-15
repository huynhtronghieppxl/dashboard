let dataBrandSupplierMaterialData = [],
    drawBrandSupplierMaterialData,
    isSaveBrandSupplierMaterialData = 0,
    drawRestaurantSupplierMaterialData,
    dataRestaurantSupplierMaterialData = [],
    selectBrandSupplierMaterial = $('#select-brand-assign-supplier-material-data').val();

$(function () {
    if(getCookieShared('supplier-material-for-brand-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('supplier-material-for-brand-user-id-' + idSession));
        selectBrandSupplierMaterial = dataCookie.selectBrandSupplierMaterial;
    }
    $('#select-brand-assign-supplier-material-data').on('change', function () {
        updateCookieSupplierMaterialForBrand()
        loadData();
    });

    shortcut.add('F4', function () {
        saveBrandSupplierMaterialData();
    });
    loadData();
});

function updateCookieSupplierMaterialForBrand(){
    saveCookieShared('supplier-material-for-brand-user-id-' + idSession, JSON.stringify({
        selectBrandSupplierMaterial : $('#select-brand-assign-supplier-material-data').val()
    }))
}

async function loadData() {
    let method = 'get',
        url = 'brand-material-data.data',
        params = {
            brand: $('#select-brand-assign-supplier-material-data').val()
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#body-restaurant-supplier-material-data'), $('#body-brand-supplier-material-data')]);
    dataTableSupplierMaterialForBrand(res.data);
    dataRestaurantSupplierMaterialData = await res.data[0].original.data;
    dataBrandSupplierMaterialData = await res.data[1].original.data;
    $('#body-brand-supplier-material-data .toolbar-button-datatable').css({"transition" : "all .2s linear","opacity": "0.5", "pointer-events": "none"});
}

async function dataTableSupplierMaterialForBrand(data) {
    let idRestaurant = $('#table-restaurant-supplier-material-data'),
        idBrand = $('#table-brand-supplier-material-data'),
        fixed_left = 0,
        fixed_right = 0,
        columnRestaurant = [
            {data: 'restaurant_material_name', name: 'restaurant_material_name', className: 'text-left'},
            {data: 'supplier_names', name: 'supplier_names', className: 'text-left'},
            {data: 'action', name: 'action', className: 'text-left', width: '5%'},
            {data: 'keysearch', className:'d-none'},
        ],
        columnBrand = [
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'restaurant_material_name', name: 'restaurant_material_name', className: 'text-left'},
            {data: 'restaurant_material_unit_full_name', name: 'restaurant_material_unit_full_name', className: 'text-left'},
            {data: 'material_category_name', name: 'material_category_name', className: 'text-left'},
            {data: 'supplier_names', name: 'supplier_names', className: 'text-left'},
            {data: 'keysearch', className:'d-none'},
        ],
        option = [
            {
                'title': 'Cập nhật',
                'icon': 'fa fa-upload',
                'class': '',
                'function': 'saveBrandSupplierMaterialData',
            }
        ];
    drawRestaurantSupplierMaterialData = await DatatableTemplateNew(idRestaurant, data[0].original.data, columnRestaurant, vh_of_table, fixed_left, 2, [], '', false);
    drawBrandSupplierMaterialData = await DatatableTemplateNew(idBrand, data[1].original.data, columnBrand, vh_of_table, 1, fixed_right, option, '', false);
}

async function checkSystemSupplierMaterialData(r) {
    let item = {
        'restaurant_material_id': r.data('id'),
        'restaurant_material_name': r.parents('tr').find('td:eq(0)').text(),
        'restaurant_material_unit_full_name': r.data('unit'),
        'material_category_name': r.data('category'),
        'supplier_names': r.data('supplier'),
         'action': '<div class="btn-group btn-group-sm">' +
            '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  data-action="0" onclick="unCheckSystemSupplierMaterialData($(this))" data-id="' +  r.data('id') + '" data-unit="' + r.data('unit') + '" data-category="' + r.data('category') + '" data-material="' + r.parents('tr').find('td:eq(0)').text() + '" data-supplier="' + r.parents('tr').find('td:eq(1)').text() + '"><i class="fi-rr-arrow-small-left"></i></button></div>',
        'keysearch':r.parents('tr').find('td:eq(3)').text(),
    };
    addRowDatatableTemplate(drawBrandSupplierMaterialData, item);
    drawRestaurantSupplierMaterialData.row(r.parents('tr')).remove().draw(false);
    $('#body-brand-supplier-material-data .toolbar-button-datatable').css({"transition" : "","opacity": "", "pointer-events": ""});
}

async function unCheckSystemSupplierMaterialData(r) {

    let item = {
        'restaurant_material_id': r.data('id'),
        'restaurant_material_name': r.parents('tr').find('td:eq(1)').text(),
        'supplier_names': r.parents('tr').find('td:eq(0)').find('div').find('button').data('supplier'),
        'action': '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  data-action="0" onclick="checkSystemSupplierMaterialData($(this))" data-id="' +  r.parents('tr').find('td:eq(0)').find('button').attr('data-id') + '" data-unit="' + r.parents('tr').find('td:eq(2)').text() + '" data-category="' + r.parents('tr').find('td:eq(3)').text() + '" data-material="' + r.parents('tr').find('td:eq(1)').text() + '" data-supplier="' + r.parents('tr').find('td:eq(4)').text() + '"><i class="fi-rr-arrow-small-right"></i></button></div>',
        'keysearch':r.parents('tr').find('td:eq(4)').text(),
    };
    if(Number(r.attr('data-action')) === 1){
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary btn-sweet-alert',
                cancelButton: 'btn btn-grd-disabled btn-sweet-alert'
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: 'Bỏ gán Nguyên liệu khỏi nhà hàng',
            text: "Nguyên liệu được chọn sẽ được bỏ gán!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Đồng ý',
            cancelButtonText: 'Hủy',
            reverseButtons: true,
            focusConfirm: true
        }).then(async (result) => {
            if (result.value) {
                let method = 'post',
                    url = 'brand-assign-supplier-material-data.un-assign',
                    params = null,
                    data = {
                        restaurant_brand_id: $('#select-brand-assign-supplier-material-data').val(),
                        restaurant_material_id: r.data('id'),
                    };
                let res = await axiosTemplate(method, url, params, data);
                switch (res.data.status) {
                    case 200 :
                        r.attr('data-action', 0)
                        SuccessNotify('Cập nhật thành công');
                        addRowDatatableTemplate(drawRestaurantSupplierMaterialData, item);
                        drawBrandSupplierMaterialData.row(r.parents('tr')).remove().draw(false);
                        break;
                    case 205:
                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                cancelButton: 'btn btn-grd-disabled btn-sweet-alert',
                            },
                            buttonsStyling: false
                        });
                        swalWithBootstrapButtons.fire({
                            title: "Nguyên liệu đang được sử dụng!",
                            icon: 'warning',
                            html:
                                `<div class="card-block card px-0 seemt-main-content">
                           <div class="table-responsive new-table">
                           <h5>${res.data.message}</h5>
                           <table id="table-brand-un-assign-material" class="table" >
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
                           </div>
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
                        dataTableBrandUnAssignMaterial(res);
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
        addRowDatatableTemplate(drawRestaurantSupplierMaterialData, item);
        drawBrandSupplierMaterialData.row(r.parents('tr')).remove().draw(false);
    }
}

async function dataTableBrandUnAssignMaterial(data) {
    let table_un_assign = $('#table-brand-un-assign-material'),
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

async function checkAllSystemSupplierMaterialData() {
    if(!drawRestaurantSupplierMaterialData.data()[0]) return false;
    await addAllRowDatatableTemplate(drawRestaurantSupplierMaterialData, drawBrandSupplierMaterialData, itemBrandDraw);
    drawBrandSupplierMaterialData.page('last').draw(false);
    $(drawBrandSupplierMaterialData.table().node()).parent().scrollTop($(drawBrandSupplierMaterialData.table().node()).parent().get(0).scrollHeight);
    $('#body-brand-supplier-material-data .toolbar-button-datatable').css({"transition" : "","opacity": "", "pointer-events": ""});
}

function itemBrandDraw(r) {
    return {
        'restaurant_material_id': r.find('td:eq(2)').find('button').data('id'),
        'restaurant_material_name': r.find('td:eq(2)').find('button').data('material'),
        'restaurant_material_unit_full_name':  r.find('td:eq(2)').find('button').data('unit'),
        'material_category_name':  r.find('td:eq(2)').find('button').data('category'),
        'supplier_names':  r.find('td:eq(2)').find('button').data('supplier'),
         'action': '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  data-action="0" onclick="unCheckSystemSupplierMaterialData($(this))" data-id="' + r.find('td:eq(2)').find('button').attr('data-id') + '" data-unit="' + r.find('td:eq(2)').find('button').attr('data-unit') + '" data-category="' + r.find('td:eq(2)').find('button').attr('data-category') + '" data-material="' + r.find('td:eq(2)').find('button').attr('data-material') + '" data-supplier="' + r.find('td:eq(2)').find('button').attr('data-supplier') + '"><i class="fi-rr-arrow-small-left"></i></button></div>',
        'keysearch':r.parents('tr').find('td:eq(4)').text()
    };
}

async function unCheckAllSystemSupplierMaterialData() {
    await addAllRowDatatableTemplate(drawBrandSupplierMaterialData, drawRestaurantSupplierMaterialData, itemRestaurantDraw);
    drawRestaurantSupplierMaterialData.page('last').draw(false);
    $(drawRestaurantSupplierMaterialData.table().node()).parent().scrollTop($(drawRestaurantSupplierMaterialData.table().node()).parent().get(0).scrollHeight);
}

function itemRestaurantDraw(r) {
    return {
        'restaurant_material_id': r.data('id'),
        'restaurant_material_name': r.data('material'),
        'supplier_names': r.find('div').find('button').data('supplier'),
         'action': '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  data-action="' + r.find('button').attr('data-action') + '" onclick="checkSystemSupplierMaterialData($(this))" data-id="' + r.find('button').attr('data-id') + '" data-unit="' + r.find('button').attr('data-unit') + '" data-category="' + r.find('button').attr('data-category') + '" data-material="' + r.find('button').attr('data-material') + '" data-supplier="' + r.find('button').attr('data-supplier') + '"><i class="fi-rr-arrow-small-right"></i></button></div>',
        'keysearch': r.parents('tr').find('td:eq(3)').text()
    };
}

async function saveBrandSupplierMaterialData() {
    if (isSaveBrandSupplierMaterialData !== 0) {
        return false;
    }
    isSaveBrandSupplierMaterialData = 1;
    let material_insert = [],
        material_delete = [];
    await drawBrandSupplierMaterialData.rows().every(function () {
        let row = $(this.node());
        if (row.find('td:eq(0)').find('button').attr('data-action') == 0) {
            material_insert.push(row.find('td:eq(0)').find('button').attr('data-id'));
        }
    });
    await drawRestaurantSupplierMaterialData.rows().every(function () {
        let row = $(this.node());
        if (row.find('td:eq(2)').find('button').attr('data-action') == 1) {
            material_delete.push(row.find('td:eq(2)').find('button').attr('data-id'));
        }
    });
    let url = 'brand-material-data.update',
        data = {
            restaurant_brand_id: $('#select-brand-assign-supplier-material-data').val(),
            material_insert: material_insert,
            material_delete: material_delete
        };
    let res = await axiosTemplate('post', url, null, data, [$('#body-brand-supplier-material-data')]);
    isSaveBrandSupplierMaterialData = 0;
    switch (res.data.status) {
        case 200:
            SuccessNotify('Cập nhật thành công');
            $('#body-brand-supplier-material-data .toolbar-button-datatable').css({"transition" : "all .2s linear","opacity": "0.5", "pointer-events": "none"});
            $('#table-brand-supplier-material-data tr td i.fa-2x[data-action="0"]').attr('data-action', 1);
            await drawBrandSupplierMaterialData.rows().every(function () {
                let row = $(this.node());
                if (row.find('td:eq(0)').find('button').attr('data-action') == 0) {
                    row.find('td:eq(0)').find('button').attr('data-action', 1)
                }
            });
            await drawRestaurantSupplierMaterialData.rows().every(function () {
                let row = $(this.node());
                if (row.find('td:eq(2)').find('button').attr('data-action') == 1) {
                    row.find('td:eq(0)').find('button').attr('data-action', 0)
                }
            });
            break;
        case 500:
            ErrorNotify(res.data.message);
            break;
        default:
            WarningNotify(res.data.message);
    }
}
