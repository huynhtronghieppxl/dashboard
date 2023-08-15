let tableMaterial, typeInventory,  currentInventory , currentInventorySelector, dataMaterialCurrentInventory;

$(function () {

})
function openModalSelectMultipleMaterial (inventory = 1) {
    $('#modal-select-multiple-material').modal('show');
    switch (inventory) {
        case 1:
            drawDatatableMaterial(dataMaterialMaterialInventory);
            currentInventory = tableMaterialCreateSupplierOrder;
            currentInventorySelector = '#table-material-create-supplier-order';
            dataMaterialCurrentInventory = dataMaterialCreateSupplierOrder;
            typeInventory = 1;
            break;
        case 2:
            drawDatatableMaterial(dataMaterialGoodsInventory);
            currentInventory = tableGoodsCreateSupplierOrder;
            currentInventorySelector = '#table-goods-create-supplier-order';
            dataMaterialCurrentInventory = dataGoodsCreateSupplierOrder;
            typeInventory = 2;
            break;
        case 3:
            drawDatatableMaterial(dataMaterialInternalInventory);
            currentInventory = tableInternalCreateSupplierOrder;
            currentInventorySelector = '#table-internal-create-supplier-order';
            dataMaterialCurrentInventory = dataInternalCreateSupplierOrder;
            typeInventory = 3;
            break;
        case 12:
            drawDatatableMaterial(dataMaterialOtherInventory);
            currentInventory = tableOtherCreateSupplierOrder;
            currentInventorySelector = '#table-other-create-supplier-order';
            dataMaterialCurrentInventory = dataOtherCreateSupplierOrder;
            typeInventory = 4;
    }
    $('#modal-select-multiple-material').on('click', '#check-all-apply-material', function () {
        $('#modal-select-multiple-material').find('.check-apply-material').prop('checked', $(this).is(':checked'));
    })
    $('#modal-select-multiple-material').on('change', '.check-apply-material', function () {
        let checkedAll = true;
        $('#modal-select-multiple-material').find('.check-apply-material').each( (i, v) => {
            if(!$(v).is(':checked')) {
                checkedAll = false;
                return false;
            }
        })
        $('#check-all-apply-material').prop('checked', checkedAll);
    })
    shortcut.remove('ESC');
    shortcut.add('ESC', closeModalSelectMultipleMaterial);
}

async function drawDatatableMaterial (data) {
    let table = $('#table-material-by-inventory-supplier-order'),
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'checkbox', name: 'checkbox', class: 'text-left'},
            {data: 'name', name: 'material_name', className: 'text-left'},
            {data: 'price', name: 'price', className: 'text-right'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ];

    tableMaterial = await DatatableTemplateNew(table, data, column, '80vh', fixed_left, fixed_right);
}
function saveModalAddMultiMaterialSupplierOrder () {
    let material = [];
    tableMaterial.rows().every(function () {
        let rows = $(this.node());
        rows.each(function (i, v) {
            if($(v).find('td:eq(0)').find('input').is(':checked')) {
                material.push({
                    material_id: $(v).find('.checkbox-form-group').data('id'),
                    name: $(v).find('td:eq(1)').text(),
                    is_material_office: $(v).find('.checkbox-form-group').data('is-office'),
                    price: removeformatNumber($(v).find('.checkbox-form-group').data('price')),
                    unit: $(v).find('.checkbox-form-group').data('unit'),
                    remaining: $(v).find('.checkbox-form-group').data('remain-quantity'),
                    keySearch: $(v).find('.checkbox-form-group').data('keysearch')
                })
            }
        })
    })
    if(!material.length) {
        WarningNotify('Vui lòng chọn nguyên liệu !');
        return false;
    }
    let data = material.map((material, index) => {
        let provider = '';
        for (const v of Object.keys(dataMaterialCurrentInventory)) {
            if (dataMaterialCurrentInventory[v].restaurant_material_id === material.material_id) {
                jQuery.each(dataMaterialCurrentInventory[v].suppliers, function (i1, v1) {
                    let selected = '';
                    if (v1.last_order_supplier_id === 1) selected = 'selected';
                    provider += '<option value="' + v1.id + '" data-type="' + v1.restaurant_id + '" data-price="' + formatNumber(v1.cost_price) + '" data-wholesale-price="' + v1.wholesale_price + '" data-wholesale-quantity="' + v1.wholesale_price_quantity + '" ' + selected + '>' + v1.name + ' (' + formatNumber(v1.cost_price) + ') </option>'
                })
            }
        }

        return {
            id: material.material_id,
            DT_RowIndex: index + 1,
            restaurant_material_name: `${material.name} <div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                                                             <i class="fi-rr-hastag"></i>
                                                             <label class="m-0">${material.unit}</label>
                                                        </div>`,
            restaurant_quantity: material.remaining,
            quantity: `<div class="input-group border-group validate-table-validate">
                            <input class="form-control adjustment text-center rounded border-0" data-type="currency-edit" data-max="9999" data-value-min-value-of="0" data-float="1" value="1" >
                      </div>`,
            supplier: material.is_material_office ? "Nhập từ kho tổng" : `<select class="js-example-basic-single" style="width:max-content !important;" onchange="selectSupplierMaterialOrder($(this))">${provider}</select>`,
            price: formatNumber(material.price),
            action: `<div class="btn-group-sm">
                        <button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailMaterialData(${material.material_id})" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"><i class="fi-rr-eye"></i></button>
                        <button class="tabledit-edit-button btn seemt-red seemt-btn-hover-red waves-effect waves-light" onclick="removeMaterialCreateSupplierOrder($(this), ${typeInventory})" data-id=${material.material_id} data-toggle="tooltip" data-placement="top" data-original-title="Xoá"><i class="fi-rr-trash"></i></button>
                    </div>`,
            keysearch: material.keySearch,
        }
    });
    addRowDatatableTemplateNew(currentInventory, $(currentInventorySelector), data);
    sumMaterialCreateSupplierOrder();
    closeModalSelectMultipleMaterial();
}

function closeModalSelectMultipleMaterial () {
    $('#modal-select-multiple-material').modal('hide');
    currentInventory = null;
    currentInventorySelector = null;
    dataMaterialCurrentInventory = null;
    $('#check-all-apply-material').prop('checked', false);
    shortcut.remove('ESC');
    shortcut.add('ESC', closeModalCreateSupplierOrder)
}
