let dataDisSelectedRestaurantSupplierMaterialData = [],
    drawDisSelectedRestaurantSupplierMaterialData,
    drawSelectedRestaurantSupplierMaterialData,
    dataSupplierMaterialData,
    dataRestaurantSupplierMaterial,
    isSaveRestaurantSupplierMaterialData = 0,
    optionRestaurantMaterialDataTemplate = '',
    selectRestaurantSupplierMaterial;

$(function () {
    if(getCookieShared('supplier-material-for-restaurant-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('supplier-material-for-restaurant-user-id-' + idSession));
        selectRestaurantSupplierMaterial = dataCookie.selectRestaurantSupplierMaterial;
    }else{
        selectRestaurantSupplierMaterial = 0;
    }
    loadData();
    $('#select-restaurant-supplier-material-data').on('select2:select', function () {
        selectRestaurantSupplierMaterial = $(this).val()
        dataMaterialSupplier();
        updateCookieSupplierMaterialForRestaurant();
    });
    $(document).on('select2:select', '.select-data-restaurant-material-map-to-supplier', function () {
        selectMaterialRestaurant($(this));
        $('#body-restaurant-supplier-material-data .toolbar-button-datatable').css({"transition" : "","opacity": "", "pointer-events": ""});
    });
    shortcut.add('F4', function () {
        saveRestaurantSupplierMaterialData();
    });
})

async function loadData() {
    await getSupplierSystem();
    await dataMaterialRestaurant();
    dataMaterialSupplier();
}

async function getSupplierSystem() {
    let method = 'get',
        url = 'restaurant-material-data.supplier',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#select-restaurant-supplier-material-data')]);
    $('#select-restaurant-supplier-material-data').html(res.data[0]);
    //chọn option đầu tiên khi cookie rỗng
    checkHasInSelect(selectRestaurantSupplierMaterial, $('#select-restaurant-supplier-material-data'))
    selectRestaurantSupplierMaterial = $('#select-restaurant-supplier-material-data').val()
}

async function dataMaterialRestaurant() {
    let method = 'get',
        url = 'restaurant-material-data.material',
        params = {
        supplier_id: -1
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    dataRestaurantSupplierMaterial = res.data.data;
}

async function dataMaterialSupplier() {
    let method = 'get',
        url = 'restaurant-material-data.data',
        params = {supplier_id: $('#select-restaurant-supplier-material-data').val()},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#body-supplier-material-data'), $('#body-restaurant-supplier-material-data')]);
    dataDisSelectedRestaurantSupplierMaterialData = res.data[0].original.data;
    dataSupplierMaterialData = await dataRestaurantSupplierMaterial.filter(o1 => !res.data[2].some(o2 => o1.id === o2.restaurant_material_id));
    await dataTableSupplierMaterialForRestaurant(res);
    updateOptionMaterialRestaurant();
}

async function dataTableSupplierMaterialForRestaurant(data) {
    let tableSupplier = $('#table-supplier-material-data'),
        tableRestaurant = $('#table-restaurant-supplier-material-data'),
        fixed_left = 0,
        fixed_right = 0,
        columnSupplier = [
            {data: 'supplier_material_name', name: 'restaurant_material_name', className: 'text-left'},
            {data: 'supplier_material_unit_full_name', name: 'supplier_material_unit_full_name', className: 'text-left', width:'10%'},
            {data: 'action', name: 'action', className: 'text-left', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ],
        columnRestaurant = [
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'supplier_material_name', name: 'supplier_material_name', className: 'text-left py-2'},
            {
                data: 'supplier_material_unit_full_name',
                name: 'supplier_material_unit_full_name',
                className: 'text-left py-2'
            },
            {data: 'rate', name: 'rate', className: 'text-center py-2', width: '5%'},
            {data: 'material_select', name: 'material_select', className: 'text-center'},
            {
                data: 'restaurant_material_unit_full_name',
                name: 'restaurant_material_unit_full_name',
                className: 'text-left'
            },
            {data: 'keysearch', className: 'd-none'},
        ],
        option = [
            {
                'title': 'Cập nhật',
                'icon': 'fa fa-upload',
                'class': '',
                'function': 'saveRestaurantSupplierMaterialData',
            }
        ];
    drawDisSelectedRestaurantSupplierMaterialData = await DatatableTemplateNew(tableSupplier, data.data[0].original.data, columnSupplier, vh_of_table, fixed_left, 2, [], '', false);
    drawSelectedRestaurantSupplierMaterialData = await DatatableTemplateNew(tableRestaurant, data.data[1].original.data, columnRestaurant, vh_of_table, 1, fixed_right, option, '', false);
    $('.select-data-restaurant-material-map-to-supplier').select2();
    $('#body-restaurant-supplier-material-data .toolbar-button-datatable').css({"transition" : "all .2s linear","opacity": "0.5", "pointer-events": "none"});
    tableRestaurant.on('page.dt', function () {
        updateOptionMaterialRestaurant();
    })
}

function updateOptionMaterialRestaurant() {
    let option = '';
    dataSupplierMaterialData.forEach(function (v) {
        let unit= v.unit_full_name
        option += '<option value="' + v.id + '" data-unit="' + unit + '" data-inventory="' + v.category_type_parent_id + '">' + v.name + '</option>';
    });
    optionRestaurantMaterialDataTemplate = option;
    $('.select-data-restaurant-material-map-to-supplier').find('option').not(':selected').remove();
    $('.select-data-restaurant-material-map-to-supplier').append(option);
}

function updateCookieSupplierMaterialForRestaurant(){
    saveCookieShared('supplier-material-for-restaurant-user-id-' + idSession, JSON.stringify({
        selectRestaurantSupplierMaterial : $('#select-restaurant-supplier-material-data').val()
    }))
}

async function selectMaterialRestaurant(r) {
    /**
     * Thêm thằng đã từng chọn vào mảng option chưa map
     */
    if (r.find('option.check').val() !== undefined) {
        dataSupplierMaterialData.push({
            'id': r.find('option.check').val(),
            'name': r.find('option.check').text(),
            'inventory': r.find('option.check').data('inventory'),
            'unit_full_name': r.find('option.check').data('unit'),
        });
        /**
         * Thêm thằng đã từng chọn vào tất cả các select khác
         */
        $('.select-data-restaurant-material-map-to-supplier').append('<option value="' + r.find('option.check').val() + '" data-unit="' + r.find('option.check').data('unit') + '" data-inventory="' + r.find('option.check').data('inventory') + '">' + r.find('option.check').text() + '</option>');
        /**
         * Xoá thằng đã từng chọn
         */
        r.find('option.check').remove();

    }
    /**
     * Thêm class nhận biết cho thằng vừa chọn
     */
    r.find('option:selected').addClass('check');
    /**
     * Xoá thằng Vui lòng chọn
     */
    r.find('option[value=""]').remove();
    /**
     * Update đơn vị thằng vừa đc chọn và thằng cần map
     */
    r.parents('tr').find('td:eq(5)').text(r.find(':selected').data('unit'));
    (r.find(':selected').data('inventory') !== 2) ? r.parents('tr').find('td:eq(2)').text(r.parents('tr').find('td:eq(0) i').data('unit-full')) : r.parents('tr').find('td:eq(2)').text(r.parents('tr').find('td:eq(0) i').data('unit'));
    /**
     * Xoá tất cả những thằng giống thằng vừa chọn trong các select khác
     */
    $('.select-data-restaurant-material-map-to-supplier').find('option[value="' + r.val() + '"]:not(:selected)').remove();
    let option = '';
    $('.select-data-restaurant-material-map-to-supplier:last option').each(function (v, e) {
        if($(this).val() !== r.val()){
            option += '<option value="' + $(this).val() + '" data-unit="' + $(this).data('unit') + '" data-inventory="' + $(this).data('inventory') + '">' + $(this).text() + '</option>';
        }
    });
    optionRestaurantMaterialDataTemplate = option;
}

async function saveRestaurantSupplierMaterialData() {
    if (isSaveRestaurantSupplierMaterialData !== 0) {
        return false;
    }
    if (!checkValidateSave($('#body-restaurant-supplier-material-data'))) return false;
    let restaurant_materials_insert_ids = [], restaurant_materials_update_ids = [],
        restaurant_materials_delete_ids = [];
    await drawDisSelectedRestaurantSupplierMaterialData.rows().every(function () {
        let row = $(this.node());
        if (row.find('td:eq(2) div button').data('type') == 1) {
            restaurant_materials_delete_ids.push({
                supplier_material_id: row.find('td:eq(2)').find('div').find('button').data('id'),
                restaurant_material_id: row.find('td:eq(2)').find('div').find('button').data('restaurant-id'),
                material_unit_conversion_rate: row.find('td:eq(2)').find('div').find('button').data('rate'),
            });
        }
    });
    await drawSelectedRestaurantSupplierMaterialData.rows().every(function (index,) {
        let row = $(this.node());
        if (row.find('td:eq(0) div button').data('type') == 0) {
            restaurant_materials_insert_ids.push({
                supplier_material_id: row.find('td:eq(0)').find('div').find('button').data('id'),
                restaurant_material_id: row.find('td:eq(4)').find('select').val(),
                material_unit_conversion_rate: row.find('td:eq(3)').find('label').text()
            });
        } else {
            restaurant_materials_update_ids.push({
                supplier_material_id: row.find('td:eq(0)').find('div').find('button').data('id'),
                restaurant_material_id: row.find('td:eq(4)').find('select').val(),
                material_unit_conversion_rate: row.find('td:eq(3)').find('label').text()
            });
        }
    });

    isSaveRestaurantSupplierMaterialData = 1;
    let method = 'post',
        url = 'restaurant-material-data.update',
        params = null,
        data = {
            supplier_id: $('#select-restaurant-supplier-material-data').val(),
            materials_insert: restaurant_materials_insert_ids,
            materials_update: restaurant_materials_update_ids,
            materials_delete: restaurant_materials_delete_ids,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#body-restaurant-supplier-material-data')], $('#table-un-assign-material'));
    isSaveRestaurantSupplierMaterialData = 0;
    switch(res.data.status) {
        case 200:
            SuccessNotify('Cập nhật thành công');
            drawDisSelectedRestaurantSupplierMaterialData.rows().every(function () {
                let row = $(this.node());
                row.find('td:eq(2) div button').data('type', 0)
            });
            drawSelectedRestaurantSupplierMaterialData.rows().every(function (index,) {
                let row = $(this.node());
                row.find('td:eq(0) div button').data('type', 1);
            });
            $('#body-restaurant-supplier-material-data .toolbar-button-datatable').css({"transition" : "all .2s linear","opacity": "0.5", "pointer-events": "none"});
            loadData()
            break;
        case 205:
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    cancelButton: 'btn btn-grd-disabled btn-sweet-alert',
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: 'Nguyên liệu nhà hàng hiện đang được sử dụng!',
                icon: 'warning',
                html:
                    `<div class="card-block p-0 seemt-main-content" >
                            <div class="table-responsive new-table">
                            <h5>${res.data.message}</h5>
                                <table id="table-warning-material-is-used" class="table" >
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
            }).then(async (result) => {
                if (!result.isConfirmed) {
                    dataMaterialSupplier();
                }
            })
            dataTableMaterialIsUsed(res);
            break;
        case 500:
            ErrorNotify(res.data.message);
            break;
        default:
            WarningNotify(res.data.message);
    }
}

async function dataTableMaterialIsUsed(data) {
    let table_material = $('#table-warning-material-is-used'),
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
    await DatatableTemplateNew(table_material, data.data.data.original.data, column, scroll_Y, fixed_left, fixed_right, []);
}

function checkRestaurantSupplierMaterialData(r) {
    let item = {
        'supplier_material_id': r.parents('tr').find('td:eq(2)').find('div').find('button').data('id'),
        'supplier_material_name': r.parents('tr').find('td:eq(0)').text(),
        'supplier_material_unit_full_name': r.parents('tr').find('td:eq(1)').text(),
        'rate': '<label>1</label>',
        'material_select': '<select class="select-data-restaurant-material-map-to-supplier js-example-basic-single" data-select="1" data-empty="1">' +
            '<option value="" selected disabled>Vui lòng chọn</option>' + optionRestaurantMaterialDataTemplate +
            '</select>',
        'restaurant_material_unit_full_name': '---',
        'action': '<div class="btn-group btn-group-sm"> <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light" onclick="unCheckRestaurantSupplierMaterialData($(this))" data-id="' + r.parents('tr').find('td:eq(2)').find('div').find('button').data('id') + '" data-unit-full="' + r.parents('tr').find('td:eq(2)').find('div').find('button').data('unit-full') + '"  data-unit="' + r.parents('tr').find('td:eq(2)').find('div').find('button').data('unit') + '" data-type="' + r.data('type') + '" data-restaurant-id="' + r.data('restaurant-id') + '" data-rate="' + r.data('rate') + '"><i class="fi-rr-arrow-small-left"></i></button> </div>',
        'keysearch': r.parents('tr').find('td:eq(3)').text(),
    };
    addRowDatatableTemplate(drawSelectedRestaurantSupplierMaterialData, item);
    $('#table-restaurant-supplier-material-data tr:last .select-data-restaurant-material-map-to-supplier').select2();
    drawDisSelectedRestaurantSupplierMaterialData.row(r.parents('tr')).remove().draw(false);
    $('#body-restaurant-supplier-material-data .toolbar-button-datatable').css({"transition" : "","opacity": "", "pointer-events": ""});
}

async function unCheckRestaurantSupplierMaterialData(r) {
    let item = {
        'supplier_material_id': r.parents('tr').find('td:eq(0)').find('div').find('button').data('id'),
        'supplier_material_name': r.parents('tr').find('td:eq(1)').text(),
        'supplier_material_unit_full_name': r.parents('tr').find('div').find('button').data('unit-full'),
        'action': '<div class="btn-group btn-group-sm"> <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light" onclick="checkRestaurantSupplierMaterialData($(this))" data-id="' + r.parents('tr').find('td:eq(0)').find('div').find('button').data('id') + '" data-unit-full="' + r.parents('tr').find('td:eq(0)').find('div').find('button').data('unit-full') + '"  data-unit="' + r.parents('tr').find('td:eq(0)').find('div').find('button').data('unit') + '" data-type="' + r.data('type') + '" data-restaurant-id="' + r.data('restaurant-id') + '" data-rate="' + r.data('rate') + '"><i class="fi-rr-arrow-small-right"></i></button> </div>',
        'keysearch': r.parents('tr').find('td:eq(6)').text(),
    };
    if(r.attr('data-type') == 1){
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
                    url = 'restaurant-assign-supplier-material-data.un-assign',
                    params = null,
                    data = {
                        supplier_id: $('#select-restaurant-supplier-material-data').val(),
                        supplier_material_id: r.parents('tr').find('td:eq(0)').find('div').find('button').data('id'),
                        restaurant_material_id: r.parents('tr').find('td:eq(4)').find('select').val(),
                        material_unit_conversion_rate: r.parents('tr').find('td:eq(3)').find('label').text()
                    };
                let res = await axiosTemplate(method, url, params, data);
                switch (res.data.status) {
                    case 200 :
                        SuccessNotify('Cập nhật thành công');
                        addRowDatatableTemplate(drawDisSelectedRestaurantSupplierMaterialData, item);
                        drawSelectedRestaurantSupplierMaterialData.row(r.parents('tr')).remove().draw(false);
                        $('#table-supplier-material-data tr td div button.seemt-btn-hover-gray[data-type="1"]').attr('data-type', 0);
                        $('#table-restaurant-supplier-material-data7 tr r td div button.seemt-btn-hover-gray[data-type="0"]').attr('data-type', 1);
                        if (r.parents('tr').find(':selected').val() !== "") {
                            optionRestaurantMaterialDataTemplate += '<option value="' + r.parents('tr').find(':selected').val() + '" data-unit="' + r.parents('tr').find(':selected').data('unit') + '" data-inventory="' + r.parents('tr').find(':selected').data('inventory') + '">' + r.parents('tr').find(':selected').text() + '</option>';
                            $('.select-data-restaurant-material-map-to-supplier').append('<option value="' + r.parents('tr').find(':selected').val() + '" data-unit="' + r.parents('tr').find(':selected').data('unit') + '" data-inventory="' + r.parents('tr').find(':selected').data('inventory') + '">' + r.parents('tr').find(':selected').text() + '</option>');
                        }
                        break;
                    case 205:
                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                // confirmButton: 'btn btn-primary btn-sweet-alert',
                                cancelButton: 'btn btn-grd-disabled btn-sweet-alert',
                            },
                            buttonsStyling: false
                        });
                        swalWithBootstrapButtons.fire({
                            title: "Nguyên liệu đang được sử dụng!",
                            icon: 'warning',
                            html:
                                `<div class="card-block px-0 seemt-main-content" >
                            <div class="table-responsive new-table">
                            <h5>${res.data.message}</h5>
                                <table id="table-un-assign-material" class="table" >
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
                        dataTableRestaurantUnAssignMaterial(res);
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
        addRowDatatableTemplate(drawDisSelectedRestaurantSupplierMaterialData, item);
        drawSelectedRestaurantSupplierMaterialData.row(r.parents('tr')).remove().draw(false);
        if (r.parents('tr').find(':selected').val() !== "") {
            optionRestaurantMaterialDataTemplate += '<option value="' + r.parents('tr').find(':selected').val() + '" data-unit="' + r.parents('tr').find(':selected').data('unit') + '" data-inventory="' + r.parents('tr').find(':selected').data('inventory') + '">' + r.parents('tr').find(':selected').text() + '</option>';
            $('.select-data-restaurant-material-map-to-supplier').append('<option value="' + r.parents('tr').find(':selected').val() + '" data-unit="' + r.parents('tr').find(':selected').data('unit') + '" data-inventory="' + r.parents('tr').find(':selected').data('inventory') + '">' + r.parents('tr').find(':selected').text() + '</option>');
        }
    }
}

function dataTableRestaurantUnAssignMaterial(data) {
    let table_un_assign = $('#table-un-assign-material'),
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
    DatatableTemplateNew(table_un_assign, data.data.data.original.data, column, scroll_Y, fixed_left, fixed_right, []);
}
