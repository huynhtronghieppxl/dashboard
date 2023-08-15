let checkUpdateMaterialData = 0, thisIdCurrentSpec, priceSpecificationUnitMaterial,
    unitSpecificationExchangeValue, unitSpecificationExchangeValueOld, isUpdated,
    thisUpdateMaterialData, optionRestaurantUnitMaterialDataTemplate, optionUpdateCreateMaterial,
    optionUpdateCreateMaterialTemp, tableUpdateSellingUnit, checkSaveChangeMaterialUpdateUnitFoodData = 0,
    unitSpecificationExchangeId, unitId, optionRestaurantUnitMaterialDataUpdateTemplateCurrent, idOptionUpdate,
    idSpecificationUpdateMaterialOld, idSpecificationUpdateMaterial, idUpdateMaterialData,
    checkConfirmStatusMaterialUnitFoodData = 0;
oldUpdateMaterialData = [],

    $(function () {
        $(document).on('change', '.select-update-unit-material-name', async function () {
            let r = $(this);
            /**
             * Kiểm tra có phải vừa chọn để thêm vào option khác khi không chọn nữa
             */
            if (r.find('option.check').val() !== undefined) {
                $('.select-update-unit-material-name').append('<option value="' + r.find('option.check').val() + '" data-unit="' + r.find('option.check').attr('data-unit') + '" data-inventory="' + r.find('option.check').attr('data-inventory') + '">' + r.find('option.check').text() + '</option>');
                r.find('option.check').remove();
            }
            /**
             * Thêm class nhận biết cho thằng vừa chọn
             */
            r.find('option:selected').addClass('check');
            $('.select-update-unit-material-name').find('option[value="' + $(this).val() + '"]:not(:selected)').remove();
            let option = '<option value="" disabled selected>Vui lòng chọn</option>';
            $('.select-update-unit-material-name:last option').each(function (v, e) {
                // if ($(this).val() !== r.val() && $(this).val() != '') {
                if (!$(this).hasClass('check') && $(this).val() != -1 && $(this).val() != '') {
                    option += '<option value="' + $(this).val() + '">' + $(this).text() + '</option>';
                }
            });
            optionRestaurantUnitMaterialDataTemplate = option;
            await selectUpdateUnitMaterial($(this));
        });
        $(document).on('input paste keyup keydown', '.input-update-quantity-unit', function () {
            if (Number($(this).val().replace(/[^0-9_]/g, "")) > 999999) {
                $(this).val(999999)
            }
            selectUpdateUnitMaterial($(this));
        });
        $('#price-update-material-data').on('input', function () {
            tableUpdateSellingUnit.rows().every(function () {
                let x = $(this.node());
                let exchange_value, specifications_update_material_value
                if (x.find('td:eq(1)').find('input').length > 0) {
                    exchange_value = x.find('td:eq(1)').find('input').val()
                } else {
                    exchange_value = x.find('td:eq(1)').text()
                }
                let price = Math.round(removeformatNumber($('#price-update-material-data').val()) * parseFloat(exchange_value) / $('#specifications-update-material-data option:selected').attr('data-unit-value'))
                // price = price.toFixed(3).replace(/\.?0+$/, '');
                x.find('td:eq(2)').text(formatNumber(price))
            })
        })
        $('#specifications-update-material-data').on('change', function () {
            changeListUnitOrder()
        })
        $('#price-update-material-data').on('paste', function (event) {
            event.preventDefault();
            let clipboardData = event.originalEvent.clipboardData || window.clipboardData;
            let pastedData = clipboardData.getData('text');
            let formattedVal = removeformatNumber(pastedData);
            $(this).val(formattedVal);
            tableUpdateSellingUnit.rows().every(function () {
                let x = $(this.node());
                let exchange_value, specifications_update_material_value
                if (x.find('td:eq(1)').find('input').length > 0) {
                    exchange_value = x.find('td:eq(1)').find('input').val()
                } else {
                    exchange_value = x.find('td:eq(1)').text()
                }
                let price = Math.round(removeformatNumber($('#price-update-material-data').val()) * parseFloat(exchange_value) / $('#specifications-update-material-data option:selected').attr('data-unit-value'))
                // price = price.toFixed(3).replace(/\.?0+$/, '');
                x.find('td:eq(2)').text(formatNumber(price))
            })
        })
        $(document).on('input paste', '#loss-update-material-data', function (e) {
            let value = e.target.value;
            if (value.includes('.')) {
                $(this).val(value.split('.')[0] + '.' + value.split('.')[1].slice(0, 1))
            }
        })

        $(document).on('input paste', '.name-create-unit-material-data, .description-create-unit-material-data', function () {
            $('#modal-update-material-data .btn-renew').removeClass('d-none');
        })

        $(document).on('change', '#load-modal-body-create-unit-material-data select', function () {
            $('#modal-update-material-data .btn-renew').removeClass('d-none');
        })

        $(document).on('input paste', '#load-modal-body-create-specifications-material-data input', function () {
            $('#modal-update-material-data .btn-renew').removeClass('d-none');
        })

        $(document).on('change', '#load-modal-body-create-specifications-material-data select', function () {
            $('#modal-update-material-data .btn-renew').removeClass('d-none');
        })

        $('#name-update-material-data').on('input', function () {
            checkUpdateMaterialData = 1;
            $('#code-update-material-data').val(removeVietnameseString($(this).val()).toUpperCase());
        });

        $('#unit-update-material-data').on('change', function () {
            if ($(this).val() == unitId) {
                $('#form-persent-update-material-data').addClass('d-none');
            } else {
                $('#form-persent-update-material-data').removeClass('d-none');
            }

        });

        $('#min-update-material-data').on('keydown', function (e) {
            checkUpdateMaterialData = 1;
            if (e.keyCode === 13) {
                $('#loss-update-material-data').select();
            }
        });
        $('#loss-update-material-data').on('keydown', function (e) {
            checkUpdateMaterialData = 1;
            if (e.keyCode === 13) {
                $('#des-update-material-data').select();
            }
        });
        $('#price-update-material-data').on('input', function () {
            if ($('#price-update-material-data').val() < 1 || $('#price-update-material-data').val() === '') $('#price-update-material-data').val(0);
        });

        $('#unit-update-material-data').on('change', async function () {
            if ($('.select-update-unit-material-name').length != 0) {
                let title = 'Đổi đơn vị ?',
                    content = 'Bạn có chắc chắn muốn đổi sang đơn vị khác ?',
                    icon = 'question';
                sweetAlertComponent(title, content, icon).then(async (result) => {
                    if (result.value) {
                        tableUpdateSellingUnit.rows().every(function () {
                            let row = $(this.node());
                            if (row.find('td:eq(0) select').length) {
                                tableUpdateSellingUnit.row(row).remove().draw();
                            }
                        })
                        await dataSpecificationsUpdateMaterialData();
                    } else {
                        $(this).val(selectUnitMaterialOption).trigger('change.select2');
                    }
                });
            } else {
                await dataSpecificationsUpdateMaterialData();
                changeListUnitOrder()
            }
        })

        $('#specifications-update-material-data').on('select2:select', function () {
            specNewId = $(this).val();
        })

    })

function changeListUnitOrder() {
    let isGetData = 0, description, unit, quantity
    tableUpdateSellingUnit.rows().every(function () {
        let x = $(this.node());
        if (isGetData == 0) {
            if (x.find('td:eq(0) select').length > 0) {
                unit = x.find('td:eq(0) select').find('option:selected').text();
                quantity = x.find('td:eq(1) input').val();
            } else {
                unit = x.find('td:eq(0)').text();
                quantity = x.find('td:eq(1)').text();
            }
            description = '1 ' + unit + ' = ' + quantity + ' ' + $('#specifications-update-material-data').find('option:selected').attr('data-unit-exchange-name')
            if (description.length > 27) description = description.substring(0, 27) + '...';
            x.find('td:eq(3)').text(description)
        }

        let exchange_value, specifications_update_material_value
        if (x.find('td:eq(1)').find('input').length > 0) {
            exchange_value = x.find('td:eq(1)').find('input').val()
        } else {
            exchange_value = x.find('td:eq(1)').text()
        }
        let price = Math.round(removeformatNumber($('#price-update-material-data').val()) * parseFloat(exchange_value) / $('#specifications-update-material-data option:selected').attr('data-unit-value'))
        // price = price.toFixed(3).replace(/\.?0+$/, '');
        x.find('td:eq(2)').text(formatNumber(price))
    })
}

function openModalUpdateMaterialData(r) {
    thisUpdateMaterialData = r;
    $('#modal-update-material-data').modal('show');
    $('#value-name-create-specifications-material-data,#select-specifications-create-unit-material-data,#category-update-material-data, #unit-update-material-data,#specifications-update-material-data, #sub-inventory-update-material-data').select2({
        dropdownParent: $('#modal-update-material-data'),
    });
    shortcut.add('F4', function () {
        saveModalUpdateMaterialData();
    });
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalUpdateMaterialData();
    });
    $('.btn-renew').addClass('d-none');
    $('#modal-calc-create-material-data').on('hidden.bs.modal', function () {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalUpdateMaterialData();
        });
    });
    $('#form-persent-update-material-data').addClass('d-none');
    $('#id-update-material-data').val(r.attr('data-id'));

    $('#modal-update-unit-food-maps .js-example-basic-single').select2({
        dropdownParent: $('#modal-update-unit-food-maps'),
    })

    $('#price-update-material-data').on('keydown', function (e) {
        checkUpdateMaterialData = 1;
        if (e.keyCode === 13) {
            $('#min-update-material-data').select();
        }
    });

    //xử lý text ô select loại nguyên liệu
    switch (Number(r.attr('data-type'))) {
        case 1 :
            $('.sub-inventory-update-material-data').parents('.select-material-box').find('label div').html('Loại nguyên liệu');
            break;
        case 2 :
            $('.sub-inventory-update-material-data').parents('.select-material-box').find('label div').html('Loại hàng hoá')
            break;
        case 3 :
            $('.sub-inventory-update-material-data').parents('.select-material-box').find('label div').html('Loại nội bộ')
            break;
        case 12 :
            $('.sub-inventory-update-material-data').parents('.select-material-box').find('label div').html('Loại khác')
            break;
        default :
            $('.sub-inventory-update-material-data').parents('.select-material-box').find('label div').html('Loại nguyên liệu')
    }

    $('.modal-body-create-unit-material-data').addClass('d-none')
    $('.modal-body-create-specifications-material-data').addClass('d-none')
    $('#modal-body-update-material').removeClass('d-none')
    dataUpdateMaterialData(r.attr('data-id'));
}

function selectUpdateUnitMaterial(r) {
    let unit = r.parents('tr').find('td:eq(0) select').find('option:selected').text();
    let quantity = r.parents('tr').find('td:eq(1) input').val();
    r.parents('tr').find('td:eq(3)').text('1 ' + unit + ' = ' + quantity + ' ' + $('#specifications-update-material-data option:selected').attr('data-unit-exchange-name'))
    let price = Math.round(removeformatNumber(r.parents('tr').find('td:eq(1)').find('input').val()) * removeformatNumber($('#price-update-material-data').val()) / $('#specifications-update-material-data option:selected').attr('data-unit-value'))
    // price = price.toFixed(3).replace(/\.?0+$/, '');
    r.parents('tr').find('td:eq(2)').text(formatNumber(price))
}

async function dataUpdateMaterialData(id) {
    idUpdateMaterialData = id
    let method = 'get',
        url = 'material-data.data-update',
        params = {id: id, restaurant_brand_id: $('.select-brand-material-data').val()},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#sub-inventory-update-material-data'), $('#unit-update-material-data'), $('#category-update-material-data'), $('#specifications-update-material-data')]);
    oldUpdateMaterialData = res.data[0];
    $('#category-update-material-data').html(res.data[1]);
    $('#unit-update-material-data').html(res.data[2]);
    optionUpdateCreateMaterial = res.data[5];
    optionRestaurantUnitMaterialDataTemplate = res.data[6];
    optionRestaurantUnitMaterialDataUpdateTemplateCurrent = res.data[6];
    $('#name-update-material-data').val(res.data[0].name);
    $('#code-update-material-data').val(res.data[0].code);
    $('#price-update-material-data').val(res.data[0].price);
    $('#min-update-material-data').val(res.data[0].out_stock);
    $('#loss-update-material-data').val(res.data[0].wastage_rate);
    $('#des-update-material-data').val(res.data[0].description);
    $('#status-id-update-material-data').val(res.data[0].status);
    $('#persent-update-material-data').val(res.data[0].exchange_current_value);
    $('#value-exchange-rate-material-data').val(res.data[0].exchange_current_value);
    if (res.data[0].is_office_material == 1) {
        $('#is-office-update-material-data').prop('checked', true);
    } else $('#is-office-update-material-data').prop('checked', false);
    isUpdated = res.data[0].is_updated;
    thisIdCurrentSpec = res.data[0].specifications;
    idSpecificationUpdateMaterialOld = res.data[0].specifications;
    idSpecificationUpdateMaterial = res.data[0].specifications;
    unitSpecificationExchangeValue = res.data[0].unit_specification_exchange_value;
    unitSpecificationExchangeValueOld = res.data[0].unit_specification_exchange_value;
    thisUpdateMaterialData.attr('data-specification-exchang-id', res.data[0].unit_specification_exchange_id);
    rateMaterial = res.data[0].exchange_current_value;
    unitSpecificationExchangeId = res.data[0].unit_specification_exchange_id;
    priceSpecificationUnitMaterial = res.data[0].price;
    specNewId = res.data[0].specifications;
    unitId = res.data[0].unit;
    countCharacterTextarea()
    drawTableUpdateSellingUnit(res.data[4]);
    let opt4 = $('#opt4-sub-inventory-create-material-data').html(),
        opt5 = $('#opt5-sub-inventory-create-material-data').html(),
        opt14 = $('#opt14-sub-inventory-create-material-data').html(),

        opt8 = $('#opt8-sub-inventory-create-material-data').html(),
        opt9 = $('#opt9-sub-inventory-create-material-data').html(),
        opt10 = $('#opt10-sub-inventory-create-material-data').html(),
        opt15 = $('#opt15-sub-inventory-create-material-data').html(),

        opt11 = $('#opt11-sub-inventory-create-material-data').html(),
        opt16 = $('#opt16-sub-inventory-create-material-data').html(),

        opt6 = $('#opt6-sub-inventory-create-material-data').html(),
        opt13 = $('#opt13-sub-inventory-create-material-data').html(),
        opt17 = $('#opt17-sub-inventory-create-material-data').html(),
        opt18 = $('#opt18-sub-inventory-create-material-data').html(),
        opt19 = $('#opt19-sub-inventory-create-material-data').html(),
        opt20 = $('#opt20-sub-inventory-create-material-data').html(),
        opt21 = $('#opt21-sub-inventory-create-material-data').html(),
        opt22 = $('#opt22-sub-inventory-create-material-data').html(),
        opt23 = $('#opt23-sub-inventory-create-material-data').html();
    switch (res.data[0].category_type_parent_id) {
        case 1:
            $('#sub-inventory-update-material-data').html(opt4 + opt5 + opt14);
            $('#sub-inventory-update-material-data').val(res.data[0].category_type_id).trigger('change.select2');
            break;
        case 2:
            $('#sub-inventory-update-material-data').html(opt8 + opt9 + opt10 + opt15);
            $('#sub-inventory-update-material-data').val(res.data[0].category_type_id).trigger('change.select2');
            break;
        case 3:
            $('#sub-inventory-update-material-data').html(opt11 + opt16);
            $('#sub-inventory-update-material-data').val(res.data[0].category_type_id).trigger('change.select2');
            break;
        case 12:
            $('#sub-inventory-update-material-data').html(opt6 + opt17 + opt18 + opt19 + opt20 + opt21 + opt22 + opt23 + opt13);
            $('#sub-inventory-update-material-data').val(res.data[0].category_type_id).trigger('change.select2');
            break;
    }
    await dataSpecificationsUpdateMaterialData();
    $('#specifications-update-material-data').val(res.data[0].specifications).trigger('change.select2');
}


async function dataSpecificationsUpdateMaterialData() {
    let method = 'get',
        url = 'material-data.specifications',
        unit = $('#unit-update-material-data').val(),
        params = {unit: unit},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#specifications-update-material-data')]);
    $('#specifications-update-material-data').html(res.data[0]);
    loadDataSpecificationsUpdateMaterial = res.data[0]
    if (isUpdated) {
        $('#specifications-update-material-data').find('option[data-unit-exchange-id!="' + unitSpecificationExchangeId + '"]').remove();
    }
}


async function drawTableUpdateSellingUnit(data) {
    let table = $('#table-update-selling-unit'),
        scroll_Y = '300px',
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'name', name: 'unit_name', className: 'text-center'},
            {data: 'exchange_value', name: 'exchange_value', className: 'text-center'},
            {data: 'price', name: 'price', className: 'text-center'},
            {data: 'rate', name: 'rate', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center'},
        ],
        option = [{
            'title': 'Thêm đơn vị bán',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'addUpdateRowUnitPriceQuantity',
        }];
    tableUpdateSellingUnit = await DatatableTemplateNew(table, data.original.data, column, scroll_Y, fixed_left, fixed_right, option);
}

function changeStatusMaterialUnitFoodData(r) {
    let title = 'Bạn có muốn xoá đơn vị bán ?',
        content = '',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (checkSaveChangeMaterialUpdateUnitFoodData !== 0) return false;
        if (result.value) {
            let method = 'post',
                url = 'material-unit-food-data.change-status',
                params = null,
                data = {id: r.attr('data-id')};
            checkSaveChangeMaterialUpdateUnitFoodData = 1;
            let res = await axiosTemplate(method, url, params, data, [$('#table-material-unit-food-data')]);
            checkSaveChangeMaterialUpdateUnitFoodData = 0;
            switch (res.data.status) {
                case 200:
                    SuccessNotify('Xoá thành công');
                    let option = '<option value="' + r.attr('data-id') + '">' + r.parents('tr').find('td:eq(0)').text() + '</option>';
                    if (r.parents('tr').find('td:eq(0)').find('select option:selected').val() !== "") {
                        $('.select-unit-material-name').append(option);
                        optionRestaurantUnitMaterialDataTemplate += option;
                        optionRestaurantUnitMaterialDataUpdateTemplateCurrent += option;
                    }
                    tableUpdateSellingUnit.row(r.parents('tr')).remove().draw(false);
                    break;
                case 205:
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            cancelButton: 'btn btn-grd-disabled btn-sweet-alert',
                        },
                        buttonsStyling: false
                    });
                    swalWithBootstrapButtons.fire({
                        title: `${res.data.message}`,
                        icon: 'warning',
                        html:
                            `<div class="card-block p-0" >
                            <div class="table-responsive new-table">
                                <table id="table-change-status-sale-unit" class="table" >
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên Món Ăn</th>
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
                    dataTableFoodCantEnable(res);
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

function dataTableFoodCantEnable(data) {
    let table = $('#table-change-status-sale-unit'),
        scroll_Y = '300px',
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'keysearch', className: 'd-none'},
        ];
    DatatableTemplateNew(table, data.data.data.original.data, column, scroll_Y, fixed_left, fixed_right, []);
}

function addUpdateRowUnitPriceQuantity() {
    if ($('.custom-button-update.seemt-btn-hover-green.d-none').length != $('.custom-button-update.seemt-btn-hover-green').length) {
        WarningNotify('Vui lòng hoàn tất chỉnh sửa');
        return false;
    }

    if (!checkValidateSave($('#modal-body-update-material'))) {
        return false;
    }
    addRowDatatableTemplate(tableUpdateSellingUnit, {
        'name': `<select class="js-example-basic-single select-update-unit-material-name" data-select="1">
                                    ${optionRestaurantUnitMaterialDataTemplate}
                                </select>`,
        'exchange_value': `<div class="input-group border-group validate-table-validate">
                                <input class="form-control adjustment text-center rounded border-0 w-100 input-update-quantity-unit" data-type="currency-edit" data-value-min-value-of="0" data-max="999999" data-float="1" value="1" >
                            </div>`,
        'price': '---',
        'rate': '---',
        'action': '<div class="btn-group btn-group-sm float-right">\n' +
            '<button type="button" class="tabledit-edit-button btn seemt-red seemt-btn-hover-red seemt-red waves-effect waves-light" onclick="removeUpdateRecordMaerialFood($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Xoá"><i class="fi-rr-trash"></i></button>\n' +
            '</div>',
    })

    $('.select-update-unit-material-name').find('option[value="' + $('#unit-update-material-data').val() + '"]').remove();

    $(".select-update-unit-material-name:last").val($(".select-update-unit-material-name:last option:eq(1)").val()).trigger('change.select2');
    let option = '';
    $('.select-update-unit-material-name:last option').each(function (v, e) {
        if ($(this).val() !== $(".select-update-unit-material-name:last option:eq(1)").val()) {
            option += '<option value="' + $(this).val() + '">' + $(this).text() + '</option>';
        }
    });
    if ($('.select-update-unit-material-name:last').find('option.check').val() !== undefined) {
        $('.select-update-unit-material-name').append('<option value="' + r.find('option.check').val() + '" >' + r.find('option.check').text() + '</option>');
        $('.select-update-unit-material-name:last').find('option.check').remove();
    }

    /**
     * Thêm class nhận biết cho thằng vừa chọn
     */
    $('.select-update-unit-material-name:last').find('option:selected').addClass('check');
    $('.select-update-unit-material-name').find('option[value="' + $('.select-update-unit-material-name:last').val() + '"]:not(:selected)').remove();

    optionRestaurantUnitMaterialDataTemplate = option;
    selectUpdateUnitMaterial($('.select-update-unit-material-name').last())
    if ($(".select-update-unit-material-name:last option").length == 2) {
        $('#table-update-selling-unit_wrapper .toolbar-button-datatable').css({
            "transition": "all .2s linear",
            "opacity": "0.5",
            "pointer-events": "none"
        });
    }

}

function updateStatusMaterialUnitFoodData(r) {
    if (r.parents('table').find('.btn-confirm-status-update-material-unit-sale.d-none').length === r.parents('table').find('.btn-confirm-status-update-material-unit-sale').length) {
        if (!$('.select-update-unit-material-name').find('option[value=""]:selected').length > 0) {
            let value = r.attr('data-id');
            let name = r.parents('tr').find('td:eq(0)').text();
            idOptionUpdate = value;
            optionUpdateCreateMaterialTemp = optionRestaurantUnitMaterialDataTemplate;
            optionRestaurantUnitMaterialDataTemplate += `<option selected class="check" value="${value}">${name}</option>`
            r.parents('tr').find('td:eq(0)').html(`<select class="js-example-basic-single select-update-unit-material-name">
                                                ${optionRestaurantUnitMaterialDataTemplate}
                                            </select>`);
            r.parents('tr').find('td:eq(1)').html(`<div class="input-group border-group validate-table-validate">
                                                <input class="form-control adjustment text-center rounded border-0 w-100 input-update-quantity-unit" data-value-min-value-of="0" data-float="1" data-max="999999" data-type="currency-edit" data-float="1" value="${formatNumber(removeformatNumber(r.parents('tr').find('td:eq(1)').text()))}" >
                                            </div>`);
            tableUpdateSellingUnit.draw(false)
            $('#table-update-selling-unit .js-example-basic-single').select2({
                dropdownParent: $('#modal-update-material-data'),
            })
            r.parents('tr').find('td:eq(0) select').val(value).trigger('change.select2');
            r.parents('td').find('.custom-button-update').removeClass('d-none');
            r.parents('td').find('.custom-button-not-update').addClass('d-none');
        } else {
            if (!checkValidateSave($('#modal-body-update-material'))) {
                return false;
            }
        }
    } else {
        WarningNotify('Vui lòng hoàn tất chỉnh sửa');
        return false;
    }
}

function removeStatusMaterialUnitFoodData(r) {
    r.parents('tr').find('td:eq(0)').text(r.parents('tr').find('td:eq(0) select').find('option:selected').text())
    if (idSpecificationUpdateMaterial == idSpecificationUpdateMaterialOld) {
        r.parents('tr').find('td:eq(1)').text(formatNumber(r.attr('data-exchange')));
        r.parents('tr').find('td:eq(3)').text(r.attr('data-rate'));
    } else {
        r.parents('tr').find('td:eq(1)').text(r.parents('tr').find('td:eq(1) input').val());
    }
    r.parents('td').find('.custom-button-update').addClass('d-none');
    r.parents('td').find('.custom-button-not-update').removeClass('d-none');
    optionRestaurantUnitMaterialDataTemplate = optionUpdateCreateMaterialTemp;
    let option = '<option value="' + r.parents('tr').find('td:eq(0)').find('select option:selected').val() + '">' + r.parents('tr').find('td:eq(0)').find('select option:selected').text() + '</option>';
    if (r.parents('tr').find('td:eq(0)').find('select option:selected').val() !== "") {
        $('.select-unit-material-name').append(option)
    }
    tableUpdateSellingUnit.draw(false)
}

async function confirmStatusMaterialUnitFoodData(r) {
    if (checkConfirmStatusMaterialUnitFoodData !== 0) return false;
    if (!checkValidateSave($('#table-update-selling-unit'))) {
        return false
    }
    let unit = r.parents('tr').find('td:eq(0) select').find('option:selected').val(),
        id = r.attr('data-unit'),
        exchange = removeformatNumber(r.parents('tr').find('td:eq(1) input').val());
    let method = 'post',
        url = 'material-data.update-quantity-food',
        params = null,
        data = {
            exchange: exchange,
            unit: unit,
            id: id,
            is_confirmed: 1
        };
    checkConfirmStatusMaterialUnitFoodData = 1;
    let res = await axiosTemplate(method, url, params, data, [$('#modal-body-update-material')]);
    checkConfirmStatusMaterialUnitFoodData = 0;
    switch (res.data.status) {
        case 200:
            SuccessNotify($('#success-update-data-to-server').text());
            r.parents('tr').find('td:eq(0)').text(r.parents('tr').find('td:eq(0) select').find('option:selected').text());
            r.parents('tr').find('td:eq(1)').text(formatNumber(r.parents('tr').find('td:eq(1)').find('input').val()));
            r.parents('td').find('.custom-button-update').addClass('d-none');
            r.parents('td').find('.custom-button-not-update').removeClass('d-none');
            r.parents('td').find('.custom-button-not-update').attr('data-exchange', removeformatNumber(r.parents('tr').find('td:eq(1)').text()));
            r.parents('td').find('.custom-button-not-update').attr('data-unit', checkDecimal(data.id));
            r.parents('td').find('.custom-button-update').attr('data-id', data.unit)
            r.parents('td').find('.custom-button-not-update').attr('data-id', data.unit)
            if (idOptionUpdate == unit) {
                optionRestaurantUnitMaterialDataTemplate = optionUpdateCreateMaterialTemp;
            }
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify(res.data.message);
    }

}

function showRateUpdateMaterialData() {
    let nameRestaurant = $('#name-update-material-data').val(),
        unitRestaurant = $('#unit-update-material-data option:selected').text(),
        rate = $('#rate-supplier-update-material-data').val().replace(/[^0-9]/g, ''),
        nameSupplier = $('#material-supplier-update-material-data option:selected').text(),
        unitSupplier = $('#unit-update-material-data option:selected').text();
    if (nameRestaurant === '' || $('#unit-update-material-data').val() === null || $('#material-supplier-update-material-data').val() === null) {
        $('#text-rate-supplier-update-material-data').text('---');
    } else {
        if (Number(rate) > 100) {
            rate = '100';
        } else if (rate === '') {
            rate = '0';
        }
        $('#text-rate-supplier-update-material-data').text('1 ' + nameRestaurant + '(' + unitRestaurant + ') = ' + rate + ' ' + nameSupplier + '[' + unitSupplier + ']');
    }
}

function closeModalUpdateMaterialData() {
    $('#modal-update-material-data').modal('hide');
    resetModalUpdate()
}

function drawDataUpdateMaterialData(data) {

    switch (inventoryCurrentMaterialData) {
        case 4:
            thisUpdateMaterialData.parents('tr').find('td:eq(1)').html(data.name);
            thisUpdateMaterialData.parents('tr').find('td:eq(2)').text(data.category_type_parent_name);
            thisUpdateMaterialData.parents('tr').find('td:eq(3)').text(data.category_type_name);
            thisUpdateMaterialData.parents('tr').find('td:eq(4)').text(data.material_category.name);
            thisUpdateMaterialData.parents('tr').find('td:eq(5)').text(data.price);
            break;
        default:
            thisUpdateMaterialData.parents('tr').find('td:eq(1)').html(data.name);
            thisUpdateMaterialData.parents('tr').find('td:eq(2)').text(data.category_type_name);
            thisUpdateMaterialData.parents('tr').find('td:eq(3)').text(data.material_category.name);
            thisUpdateMaterialData.parents('tr').find('td:eq(4)').text(formatNumber(data.price));
    }
}

function reloadModalCreateUnitUpdateMaterial(r) {
    if (!r.parents('.modal-dialog').find('#load-modal-body-create-unit-material-data').hasClass('d-none')) {
        $('#load-modal-body-create-unit-material-data input').val('')
        $('#load-modal-body-create-unit-material-data .select-specifications-create-unit-material-data').val('').trigger('change.select2');
        $('.description-create-unit-material-data').val('');
    } else {
        $('.name-create-specifications-material-data').val('')
        $('.value-exchange-create-specifications-material-data').val(1)
        $('.modal-body-create-specifications-material-data .value-name-create-specifications-material-data').val('').trigger('change.select2');
    }
    r.addClass('d-none')
}

async function saveUpdateMaterialData() {
    if (isSaveUpdateMaterialData !== 0) return false;
    if (!checkValidateSave($('#modal-body-update-material'))) {
        return false
    }
    if ($('.custom-button-update.seemt-btn-hover-green.d-none').length != $('.custom-button-update.seemt-btn-hover-green').length) {
        WarningNotify('Vui lòng hoàn tất chỉnh sửa');
        return false;
    }
    if (tableUpdateSellingUnit.rows().count() == 0) {
        WarningNotify('Vui lòng thêm đơn vị bán');
        return false;
    }
    let dataUnitFood = [];
    await tableUpdateSellingUnit.rows().every(function () {
        let r = $(this.node());
        if (r.find('td:eq(0) select').find('option:selected').val() != undefined) {
            dataUnitFood.push({
                "id": r.find('td:eq(0) select').find('option:selected').val(),
                "exchange_value": removeformatNumber(r.find('td:eq(1) input').val())
            })
        }
    })
    let category_text = $('#msg-name-category-update-material-data').text(),
        unit_text = $('#msg-name-unit-update-material-data').text(),
        name_text = $('#msg-name-update-material-data').text(),
        specifications_text = $('#msg-specifications-update-material-data').text(),
        category = $('#category-update-material-data').val(),
        unit = $('#unit-update-material-data').val(),
        specifications = $('#specifications-update-material-data').val(),
        material_category_type_id = $('#sub-inventory-update-material-data').val(),
        name = $('#name-update-material-data').val(),
        material_unit_specification_current_id = $('#specifications-update-material-data').val(),
        exchange_current_value = $('#persent-update-material-data').val();
    let is_office_material;
    let code = $('#code-update-material-data').val(),
        price = removeformatNumber($('#price-update-material-data').val()),
        min = removeformatNumber($('#min-update-material-data').val()),
        lose = removeformatNumber($('#loss-update-material-data').val()),
        status = $('#status-id-update-material-data').val(),
        id = $('#id-update-material-data').val(),
        des = $('#des-update-material-data').val();

    if ($('#is-office-update-material-data').is(':checked')) {
        is_office_material = 1;
    } else is_office_material = 0;
    isSaveUpdateMaterialData = 1;
    let method = 'post',
        url = 'material-data.update',
        params = null,
        data = {
            price: price,
            name: name,
            code: code,
            material_unit_id: unit,
            material_unit_specification_id: specifications,
            material_category_id: category,
            out_stock_alert_quantity: min,
            wastage_rate: lose,
            description: des,
            status: status,
            material_category_type_id: material_category_type_id,
            data_unit: dataUnitFood,
            material_unit_specification_current_id: specifications,
            exchange_current_value: 0,
            id: id,
            is_office_material: is_office_material
        };

    if (price == removeformatNumber(oldUpdateMaterialData.price)
        && data.name == oldUpdateMaterialData.name
        && data.code == oldUpdateMaterialData.code
        && data.material_unit_id == oldUpdateMaterialData.unit
        && data.material_unit_specification_id == oldUpdateMaterialData.specifications
        && data.material_category_id == oldUpdateMaterialData.category_id
        && data.out_stock_alert_quantity == removeformatNumber(oldUpdateMaterialData.out_stock)
        && data.wastage_rate == oldUpdateMaterialData.wastage_rate
        && data.description == oldUpdateMaterialData.description
        && data.status == oldUpdateMaterialData.status
        && data.material_category_type_id == oldUpdateMaterialData.category_type_id
        && data.data_unit.length <= 0
        && data.material_unit_specification_current_id == oldUpdateMaterialData.unit_specification_current_id
        && data.exchange_current_value == oldUpdateMaterialData.exchange_current_value
        && data.is_office_material == oldUpdateMaterialData.is_office_material) {
        SuccessNotify($('#success-update-data-to-server').text());
        closeModalUpdateMaterialData();
        isSaveUpdateMaterialData = 0;
        return;
    }

    let res = await axiosTemplate(method, url, params, data, [$('#modal-body-update-material')]);
    isSaveUpdateMaterialData = 0;
    switch (res.data.status) {
        case 200:
            SuccessNotify($('#success-update-data-to-server').text());
            let selectedMaterialType  = $('#select-material-type-material-data').find(':selected').val();
            removeRowDatatableTemplate(dataTableMaterial, thisUpdateMaterialData, true);
            await loadData();
            $('#select-material-type-material-data').val(selectedMaterialType);
            $('#select-material-type-material-data').trigger('change');
            closeModalUpdateMaterialData();
            break;
        case 205:
            const swalWithBootstrapButton = Swal.mixin({
                customClass: {
                    container: 'modal-create-note, popup-swal-205',
                    cancelButton: 'btn btn-grd-disabled btn-sweet-alert',
                },
                buttonsStyling: false,
            });
            swalWithBootstrapButton.fire({
                title: 'Nguyên liệu đang có đơn hàng !',
                icon: 'warning',
                html: `<div class="card-block px-0" >
                            <div class="table-responsive new-table">
                                <h5 class="text-justify font-weight-bold">${res.data.message}</h5>
                                <table class="table" id="table-update-material-order-data">
                                    <thead>
                                        <tr>
                                            <th class="text-center">STT</th>
                                            <th class="text-center">Mã đơn</th>
                                            <th class="text-center">Tên NCC</th>
                                            <th></th>
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
            }).then(async (result) => {
                if (result.value) {
                    let method = 'post',
                        url = 'material-data.update',
                        params = null,
                        data = {
                            price: price,
                            name: name,
                            code: code,
                            material_unit_id: unit,
                            material_unit_specification_id: specifications,
                            material_category_id: category,
                            out_stock_alert_quantity: min,
                            wastage_rate: lose,
                            description: des,
                            status: status,
                            material_category_type_id: material_category_type_id,
                            id: id,
                        };
                    let res = await axiosTemplate(method, url, params, data, [$('#modal-body-update-material')]);
                    if (res.data.status === 200) {
                        let text = $('#success-update-data-to-server').text();
                        SuccessNotify(text);
                        drawDataUpdateMaterialData(res.data.data);
                    }
                }
            })
            drawTableUpdateMaterialData(res);
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify(res.data.message);
    }
}

function removeUpdateRecordMaerialFood(r) {

    if ($('.select-update-unit-material-name').length == 0) {
        optionRestaurantUnitMaterialDataTemplate = optionRestaurantUnitMaterialDataUpdateTemplateCurrent
    } else {
        let option = '<option value="' + r.parents('tr').find('td:eq(0)').find('select option:selected').val() + '">' + r.parents('tr').find('td:eq(0)').find('select option:selected').text() + '</option>';
        if (r.parents('tr').find('td:eq(0)').find('select option:selected').val() !== "") {
            $('.select-update-unit-material-name').append(option);
            optionRestaurantUnitMaterialDataTemplate += option;
        }
    }
    tableUpdateSellingUnit.row(r.parents('tr')).remove().draw(false);
    $('#table-update-selling-unit_wrapper .toolbar-button-datatable').css({
        "transition": " ",
        "opacity": "",
        "pointer-events": ""
    });
}

function updatePriceRateMaterial() {

    let rateNew = $('#specifications-update-material-data option:selected').attr('data-unit-value');
    let rateOld = unitSpecificationExchangeValue;

    //TỈ LỆ QUY ĐỔI =  GIÁ TRỊ QUY ĐỔI CŨ / GIÁ TRỊ QUY ĐỔI MỚI
    // GIÁ TIỀN MỚI = GIÁ TRỊ QUY ĐỔI MỚI * (GIÁ TIỀN CŨ / GIÁ TRỊ QUY ĐỔI CŨ  )
    $('#price-update-material-data').val(formatNumber(rateNew * (removeformatNumber(priceSpecificationUnitMaterial) / removeformatNumber(unitSpecificationExchangeValueOld))));
    tableUpdateSellingUnit.rows().every(function () {
        let r = $(this.node());
        if (r.find('td:eq(1) input').length === 0) {
            r.find('td:eq(1)').text(formartFloat((removeformatNumber(rateOld) / removeformatNumber(rateNew)) * removeformatNumber(r.find('td:eq(1)').text())));
            r.find('td:eq(2)').text('1 ' + r.find('td:eq(0)').text() + ' = ' + r.find('td:eq(1)').text() + ' ' + $('#specifications-update-material-data option:selected').attr('data-unit-exchange-name'))
        } else {
            let rate = removeformatNumber(rateOld) / removeformatNumber(rateNew);
            let quantity = removeformatNumber(r.find('td:eq(1) input').val());
            r.find('td:eq(1) input').val(rate * quantity);
            r.find('td:eq(2)').text('1 ' + r.find('td:eq(0) select').find('option:selected').text() + ' = ' + r.find('td:eq(1) input').val() + ' ' + $('#specifications-update-material-data option:selected').attr('data-unit-exchange-name'))
        }
    })
    unitSpecificationExchangeValue = $('#specifications-update-material-data option:selected').attr('data-unit-value');
    idSpecificationUpdateMaterial = $('#specifications-update-material-data option:selected').val();
}

async function deleteMaterialUnitFoodData(r) {
    let countOrderUnitIsSave = 0;
    tableUpdateSellingUnit.rows().every(function () {
        let r = $(this.node());
        if (r.find('td:eq(4)').find('.fi-rr-trash').parents('button').attr('data-is-save')) {
            countOrderUnitIsSave++
        }
    })
    if (countOrderUnitIsSave <= 1) {
        WarningNotify('Nguyên liệu phải có ít nhất một đơn vị bán');
        return false;
    }
    let title = 'Bạn có muốn xoá đơn vị bán ?',
        content = '',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (checkSaveChangeMaterialUpdateUnitFoodData !== 0) return false;
        if (result.value) {
            let method = 'post',
                url = 'material-data.delete-unit-order-map',
                params = null,
                data = {id: r.attr('data-unit')};
            checkSaveChangeMaterialUpdateUnitFoodData = 1;
            let res = await axiosTemplate(method, url, params, data, [$('#table-material-unit-food-data')]);
            checkSaveChangeMaterialUpdateUnitFoodData = 0;
            switch (res.data.status) {
                case 200:
                    SuccessNotify('Xoá thành công');
                    let option = '<option value="' + r.attr('data-id') + '">' + r.parents('tr').find('td:eq(0)').text() + '</option>';
                    if (r.parents('tr').find('td:eq(0)').find('select option:selected').val() !== "") {
                        $('.select-update-unit-material-name').append(option);
                        optionRestaurantUnitMaterialDataTemplate += option;
                        optionRestaurantUnitMaterialDataUpdateTemplateCurrent += option;
                    }
                    tableUpdateSellingUnit.row(r.parents('tr')).remove().draw(false);
                    $('#table-update-selling-unit_wrapper .toolbar-button-datatable').css({
                        "transition": " ",
                        "opacity": "",
                        "pointer-events": ""
                    });
                    break;
                case 205:
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            cancelButton: 'btn btn-grd-disabled btn-sweet-alert',
                        },
                        buttonsStyling: false
                    });
                    swalWithBootstrapButtons.fire({
                        title: `${res.data.message}`,
                        icon: 'warning',
                        html:
                            `<div class="card-block p-0" >
                            <div class="table-responsive new-table">
                                <table id="table-change-status-sale-unit" class="table" >
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên Món Ăn</th>
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
                    dataTableFoodCantEnable(res);
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

function resetModalUpdate() {
    $('#category-update-material-data').val('').trigger('change.select2');
    $('#supplier-update-material-data').val('').trigger('change.select2');
    $('#material-supplier-update-material-data').val('').trigger('change.select2');
    $('#unit-update-material-data').val('').trigger('change.select2');
    $('#specifications-update-material-data').html('<option disabled selected>Vui lòng chọn</option>');
    $('#modal-update-material-data input').val('');
    $('#modal-update-material-data textarea').val('');
    $('#rate-supplier-update-material-data').val('1');
    $('#price-update-material-data').val('100');
    $('#min-update-material-data').val('0');
    $('#loss-update-material-data').val('0');
    $('#map-update-material-data').prop('checked', false);
    $('#assign-brand-update-material-data').prop('checked', false);
    $('#div-assign-brand-update-material-data').addClass('d-none');
    $('#div-map-update-material-data').addClass('d-none');
    $('#select-brand-update-material-data').val([]).trigger('change.select2');
    $('#sub-inventory-update-material-data').val(-1).trigger('change.select2');
    $('#text-rate-supplier-update-material-data').text('---');
    $('.title-h5-update-material').removeClass('d-none');
    $('.title-h5-create-unit').addClass('d-none');
    $('.btn-renew').addClass('d-none');
    $('.title-h5-create-specifications').addClass('d-none');
    $('.calc-percent').remove();
    $('#btn-add-input-calc-quantity-loss').removeClass('d-none');
    $('#loss-average-all-create-material-data').text(0);
    $('#title-calc-loss-material').addClass('d-none');
    $('#modal-calc-create-material-data .btn-renew').addClass('d-none');
    tableUpdateSellingUnit.clear().draw();
    removeAllValidate();
}
