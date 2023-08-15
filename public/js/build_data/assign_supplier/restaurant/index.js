let dataRestaurantSupplierData = [],
    dataSystemSupplierData = [],
    drawRestaurantSupplierData,
    isSaveRestaurantSupplierData = 0,
    drawSystemSupplierData, typeIsRestaurantSupplier;
$(function () {

    loadData();
    $('#restaurant-branch-id-selected').parent('div').addClass('d-none');
    $('#change_branch').parent().addClass('d-none');
    $('#select-type-supplier-restaurant-data').change(function () {
        typeIsRestaurantSupplier = $(this).val();
        loadData();
    })

})

async function loadData() {
    let method = 'get',
        url = 'restaurant-assign-supplier-data.data',
        params = {
            is_restaurant_supplier: typeIsRestaurantSupplier
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#body-system-supplier-data'), $('#body-restaurant-supplier-data')]);
    dataSystemSupplierData = res.data[1].original.data;
    dataRestaurantSupplierData = res.data[0].original.data;
    dataTableSystemSupplierForRestaurant(res);
    if (dataSystemSupplierData.length === 0) {
        $('.btn-all-left').css({"opacity": "0", "pointer-events": "none"})
    } else {
        $('.btn-all-left').css({"opacity": "", "pointer-events": ""})
    }
}

async function dataTableSystemSupplierForRestaurant(data) {
    let tableSystem = $('#table-system-supplier-data'),
        tableRestaurant = $('#table-restaurant-supplier-data'),
        fixed_left = 0,
        fixed_right = 0,
        columnSystem = [
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'phone', name: 'phone', className: 'text-left'},
            {data: 'action', name: 'action', className: 'text-left', width: '10%'},
            {data: 'keysearch', className: 'd-none'},
        ],
        columnRestaurant = [
            {data: 'action', name: 'action', className: 'text-center', width: '10%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'phone', name: 'phone', className: 'text-left'},
            {data: 'keysearch', className: 'd-none'},
        ],
        option = [
            {
                'title': 'Cập nhật',
                'icon': 'fa fa-upload',
                'class': 'btn-save-restaurant-supplier-data',
                'function': 'saveRestaurantSupplierData',
            }
        ];
    drawSystemSupplierData = await DatatableTemplateNew(tableSystem, data.data[1].original.data, columnSystem, vh_of_table, fixed_left, 2, [], '', false);
    drawRestaurantSupplierData = await DatatableTemplateNew(tableRestaurant, data.data[0].original.data, columnRestaurant, vh_of_table, 1, fixed_right, option, '', false);
    $('#body-restaurant-supplier-data .toolbar-button-datatable').css({
        "transition": "all .2s linear",
        "opacity": "0.5",
        "pointer-events": "none"
    });
}


async function saveRestaurantSupplierData() {
    if (isSaveRestaurantSupplierData !== 0) {
        return false;
    }
    let supplier_ids = [];
    await drawRestaurantSupplierData.rows().every(function (index, element) {
        let row = $(this.node());
        supplier_ids[index] = row.find('td:eq(0)').find('div').find('button').data('id');
    });
    isSaveRestaurantSupplierData = 1;
    let method = 'post',
        url = 'restaurant-assign-supplier-data.update',
        params = null,
        data = {
            supplier_ids: supplier_ids,
            remove_supplier_ids: []
        };
    let res = await axiosTemplate(method, url, params, data, [$('#body-restaurant-supplier-data')]);
    isSaveRestaurantSupplierData = 0;
    switch (res.data.status) {
        case 200:
            SuccessNotify('Cập nhật thành công');
            $('#table-restaurant-supplier-data tr td div button.seemt-btn-hover-gray[data-type="0"]').attr('data-type', 1);
            $('#body-restaurant-supplier-data .toolbar-button-datatable').css({
                "transition": "all .2s linear",
                "opacity": "0.5",
                "pointer-events": "none"
            });
            shortcut.remove('F4');
            loadData();
            if (dataSystemSupplierData.length === 0) {
                $('.btn-all-left').css({"opacity": "0", "pointer-events": "none"})
            } else {
                $('.btn-all-left').css({"opacity": "", "pointer-events": ""})
            }
            break;
        case 500:
            ErrorNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify((res.data.message !== null) ? res.data.message : $('#warning-post-data-to-server').text());
    }

}

async function checkAllSystemSupplierData() {
    if(!drawSystemSupplierData.data()[0]) return false;
    addAllRowDatatableTemplate(drawSystemSupplierData, drawRestaurantSupplierData, itemRestaurantDraw);
    $('#body-restaurant-supplier-data .toolbar-button-datatable').css({
        "transition": "",
        "opacity": "",
        "pointer-events": ""
    });
    shortcut.add('F4', function () {
        saveRestaurantSupplierData();
    });
}

async function unCheckAllSystemSupplierData() {
    addAllRowDatatableTemplate(drawRestaurantSupplierData, drawSystemSupplierData, itemSystemDraw);
}

function itemRestaurantDraw(r) {
    return {
        'name': r.find('td:eq(0)').html(),
        'phone': r.find('td:eq(1)').text(),
        'action': '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light" onclick="unCheckSystemSupplierData($(this))" data-id="' + r.find('td:eq(2)').find('div').find('button').data('id') + '" data-type="0"><i class="fi-rr-arrow-small-left"></i></button></div>',
        'keysearch': r.find('td:eq(3)').text(),
    };
}

function itemSystemDraw(r) {
    return {
        'name': r.find('td:eq(1)').html(),
        'phone': r.find('td:eq(2)').text(),
        'action': '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  onclick="checkSystemSupplierData($(this))" data-id="' + r.find('td:eq(0)').find('div').find('button').data('id') + '" data-type="1"><i class="fi-rr-arrow-small-right"></i></button></div>',
        'keysearch': r.find('td:eq(4)').text(),
    };
}

async function checkSystemSupplierData(r) {
    let item = {
        'name': r.parents('tr').find('td:eq(0)').html(),
        'phone': r.parents('tr').find('td:eq(1)').text(),
        'action': '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  onclick="unCheckSystemSupplierData($(this))" data-id="' + r.parents('tr').find('td:eq(2)').find('div').find('button').data('id') + '"  data-type="0"><i class="fi-rr-arrow-small-left"></i></button></div>',
        'keysearch': r.parents('tr').find('td:eq(4)').text(),
    };

    await addRowDatatableTemplate(drawRestaurantSupplierData, item);
    drawSystemSupplierData.row(r.parents('tr')).remove().draw(false);
    $('#body-restaurant-supplier-data .toolbar-button-datatable').css({
        "transition": "",
        "opacity": "",
        "pointer-events": ""
    });
}

async function unCheckSystemSupplierData(r) {
    let item = {
        'name': r.parents('tr').find('td:eq(1)').html(),
        'phone': r.parents('tr').find('td:eq(2)').text(),
        'action': '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  onclick="checkSystemSupplierData($(this))" data-id="' + r.parents('tr').find('td:eq(0)').find('div').find('button').data('id') + '"  data-type="1"><i class="fi-rr-arrow-small-right"></i></button></div>',
        'keysearch': r.parents('tr').find('td:eq(4)').text(),
    };
    if (r.data('type') == 1) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary btn-sweet-alert',
                cancelButton: 'btn btn-grd-disabled btn-sweet-alert'
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: 'Bỏ gán NCC khỏi nhà hàng',
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
                    url = 'restaurant-assign-supplier-data.un-assign',
                    params = null,
                    data = {
                        supplier_id: id_supplier_uncheck,
                    };
                let res = await axiosTemplate(method, url, params, data);
                switch (res.data.status) {
                    case 200 :
                        SuccessNotify('Cập nhật thành công');
                        addRowDatatableTemplate(drawSystemSupplierData, item);
                        drawRestaurantSupplierData.row(r.parents('tr')).remove().draw(false);
                        if (dataSystemSupplierData.length + 1 === 0) {
                            $('.btn-all-left').css({"opacity": "0", "pointer-events": "none"})
                        } else {
                            $('.btn-all-left').css({"opacity": "", "pointer-events": ""})
                        }
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
                                `<div class="card-block p-0 seemt-main-content">
                            <div class="table-responsive new-table">
                            <h5>${res.data.message}</h5>
                                <table id="table-un-assign-supplier" class="table" >
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
                        dataTableUnAssignSupplier(res);
                        break;
                    case 500:
                        ErrorNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
                        break;
                    default:
                        WarningNotify((res.data.message !== null) ? res.data.message : $('#warning-post-data-to-server').text());
                }
            }
        });
    } else {
        addRowDatatableTemplate(drawSystemSupplierData, item);
        drawRestaurantSupplierData.row(r.parents('tr')).remove().draw(false);
    }

}

async function dataTableUnAssignSupplier(data) {
    let table_un_assign = $('#table-un-assign-supplier'),
        scroll_Y = '300px',
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '8%'},
            {data: 'code', name: 'code', className: 'text-center'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '10%'},
            {data: 'keysearch', className: 'd-none'},
        ];
    await DatatableTemplateNew(table_un_assign, data.data.data.original.data, column, scroll_Y, fixed_left, fixed_right, []);
}



