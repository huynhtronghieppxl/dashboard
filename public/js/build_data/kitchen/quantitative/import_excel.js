let checkImportQuantitativeData = 0,
    checkImportData, importExcelData;

function openModalImportExcelQuantitativeData() {
    checkImportData = 0;
    importExcelData = 0;
    $('#modal-import-quantitative-data').modal('show');
    $('#branch-import-quantitative-data').select2({
        dropdownParent: $('#modal-import-quantitative-data')
    });
}

function previousModalImportQuantitativeData() {
    $('#previous-import-quantitative-data').addClass('d-none');
    $('#tab1-import-quantitative-data').removeClass('d-none');
    $('#tab2-import-quantitative-data').addClass('d-none');
}

function nextModalImportQuantitativeData() {
    if ($('#files-upload-quantitative-data').val() === '') {
        ErrorNotify('Vui chọn file Excel !');
        return false;
    } else if (checkImportQuantitativeData === 0) {
        ErrorNotify('Vui chọn kiểm tra dữ liệu trước !');
        return false;
    } else {
        checkImportQuantitativeData = 1;
    }
}

async function checkModalImportQuantitativeData() {
    if (checkImportData === 1) return false;
    if ($('#files-upload-quantitative-data').val() === '') {
        ErrorNotify('Vui chọn file Excel !');
        return false;
    }
    if ($('#branch-import-quantitative-data').val() === null) {
        ErrorNotify('Vui chọn chi nhánh!');
        return false;
    }
    checkImportData = 1;
    let restaurant_brand_id = $('#branch-import-quantitative-data').val(),
        form_data = new FormData(),
        file = await $('#files-upload-quantitative-data')[0].files[0];
        form_data.append('file', file);
        form_data.append('restaurant_brand_id', restaurant_brand_id);
    let method = 'post',
        url = 'quantitative-data.check-excel',
        params = null;
    let res = await axiosTemplate(method, url, params, form_data);
    checkImportData = 0;
    switch(res.data[0].status) {
        case 200:
            $('#tab1-import-quantitative-data').addClass('d-none');
            $('#tab2-import-quantitative-data').removeClass('d-none');
            $('#previous-import-quantitative-data').removeClass('d-none');
            dataTableImportQuantitativeData(res.data[0].data);
            break;
        case 500:
            ErrorNotify(res.data[0].message)
            break;
        default:
            WarningNotify(res.data[0].message)
    }
}

function dataTableImportQuantitativeData(data) {
    $('#edit-review-quantitative-import').DataTable({
        processing: true,
        serverSide: false,
        responsive: true,
        destroy: true,
        ordering: false,
        scrollX: true,
        fixedHeader: true,
        scrollCollapse: true,
        scrollY: '40vh',
        language: {
            emptyTable: "<div class='empty-datatable-custom'><img src='../../../../files/assets/images/nodata-datatable2.png'></div>",
        },
        data: data,
        "createdRow": function (row, data, dataIndex) {
            if (data.status == 0) {
                $(row).removeClass('text-danger');
            } else {
                $(row).addClass('text-danger');
            }
        },
        columns: [
            {
                data: null, orderable: true, className: 'text-center', render: function (data, type, row) {
                    let food_code = data.food_code;
                    return food_code.toUpperCase();
                }
            },
            {
                data: null, orderable: true, className: 'text-center', render: function (data, type, row) {
                    let material_code = data.material_code;
                    return material_code.toUpperCase();
                }
            },
            {
                data: null, className: 'text-center', render: function (data, type, row) {
                    return data.quantity;
                }
            },
            {
                data: null, className: 'text-center', render: function (data, type, row) {
                    let textAction;
                    if (data.error == "") {
                        textAction = '<label class="text-success">Có thể nhập định lượng</label>';
                    } else {
                        textAction = '<label class="text-danger">' + data.error + '</label>';
                    }
                    return textAction;
                }
            },
        ]
    })
}

function addNewFoodFromExcel() {
    let foods = [];
    let branch_id = $('#branch-quantitative-import').val();
    if (importExcelData === 1) return false;
    importExcelData = 1;
    $('#edit-review-quantitative-import tbody tr').each(function () {
        let food = $(this).find('td').eq(0).html();
        let material = $(this).find('td').eq(1).html();
        let item = {};
        item.food_code = food;
        item.material_code = material;
        item.quantity = removeformatNumber($(this).find('td').eq(2).html());
        foods.push(item);
    });
    axios({
        method: 'post',
        url: '/quantitative-data.food.import.excel',
        data: {
            branch_id: branch_id,
            foods: foods
        }
    }).then(res => {
        let data = res.data;
        importExcelData = 0;
        let text = '';
        switch(data.status) {
            case 200:
                SuccessNotify('Nhập món ăn thành công');
                $('#edit-check-food-import').addClass('d-none');
                closeModalImportQuantitativeData();
                break;
            case 500:
                ErrorNotify(data.message);
                $('#message-error-import').html(data.message + '. Vui lòng kiểm tra lại!!');
                $('#edit-check-food-import').addClass('d-none');
                break;
            default:
                WarningNotify(data.message);
                $('#message-error-import').html(data.message + '. Vui lòng kiểm tra lại!!');
                $('#edit-check-food-import').addClass('d-none');
        }
    })
}

$(document).on('click', '#edit-review-quantitative-import tbody td', function () {
    if ($(this).hasClass('changed') == true) {
        $(this).removeClass('changed');
        $(this).html($(this).find('input').val())
    } else {
        $(this).addClass('changed');
        $(this).html('<input oninput="this.value = this.value.toUpperCase()" value="' + $(this).text() + '">');
        $(this).find('input').select();
    }
});

function closeModalImportQuantitativeData() {
    $('#modal-import-quantitative-data').modal('hide');
    resetModalImportQuantitativeData();
}

function resetModalImportQuantitativeData(){
    $('#tab1-import-quantitative-data').removeClass('d-none');
    $('#tab2-import-quantitative-data').addClass('d-none');
    $('#previous-import-quantitative-data').addClass('d-none');
    $('#files-upload-quantitative-data').val('');
    $("#branch-import-quantitative-data").val('');
    $(".file-upload-name-js").text('Chưa có tệp được chọn');
    $('#edit-review-quantitative-import').DataTable().clear().draw();
}
