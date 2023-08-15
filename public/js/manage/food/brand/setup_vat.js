let dataTableFoodSetupVatFoodManage,checkSaveSetupVatFoodBrandManage = 0;
let countCheckbox = 0;
async function openModalSetupVatFoodBrandManage() {
    $('#modal-setup-vat-food-brand-manage').modal('show');
    $('#vat-setup-vat-food-brand-manage').select2({
        dropdownParent: $('#modal-setup-vat-food-brand-manage'),
    })
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalSetupVatFoodBrandManage();
    });
    dataTableFoodSetupBrandManage([]);
    shortcut.add('F4', function () {
        saveSetupVatFoodBrandManage();
    })
    $(document).on('click', '.checkbox-vat-config-food-brand-manage' ,async function () {
        let i = 0;
        let x = 0;
        await dataTableFoodSetupVatFoodManage.rows().every(function (index, element) {
            let row = $(this.node());
            if (row.find('td:eq(0)').find('input').is(':checked') === true) {
                i++;
            }
            x++;
        });
        $('#total-check-vat-food-manage').text(formatNumber(i));

        if (i === x) {
            $('#check-all-setup-vat-food-manage').prop('checked', true);
        } else {
            $('#check-all-setup-vat-food-manage').prop('checked', false);
        }
    })
    dataFoodVat();
    await vatFoodCreateFoodManage();
    $('#vat-setup-vat-food-brand-manage').html(optionSetUpVatFoodManage);

    $('#vat-setup-vat-food-brand-manage').on('change', function (){
        $('#vat-setup-vat-food-brand-manage').find('option[value=0]').remove();
    })
    $(document).on('click', 'input[name="check-vat-food-brand-manage"]' ,async function () {

            let checkboxes = $('input[name="check-vat-food-brand-manage"]');
            let allChecked = (checkboxes.length === checkboxes.filter(':checked').length);
            if (allChecked) {
                $('input[name="check-all-vat-food-brand-manage"]').prop('checked', true);
            } else {
                $('input[name="check-all-vat-food-brand-manage"]').prop('checked', false);
            }
    })
}

    $(document).on('change', 'input[name="check-vat-food-brand-manage"]', function () {
        if ($(this).is(':checked')) {
            countCheckbox++
        }else {
            countCheckbox--
        }
        $('#total-check-vat-food-manage').text(countCheckbox)
    })

async function dataFoodVat(){
    let brand = $('.select-brand').val(),
        url = 'food-brand-manage.data-food-vat',
        method = 'get',
        params = {
            brand: brand,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-change-setup-food-brand-manage')]);
    dataTableFoodSetupBrandManage(res.data[0].original.data);
}

async function dataTableFoodSetupBrandManage(data) {
    let id = $('#table-setup-food-brand-manage'),
        column = [
            {data: 'checkbox', name: 'checkbox', className: 'text-left', width : '5%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'category_name', name: 'category_name', className: 'text-left'},
            {data: 'vat_setup', name: 'vat_setup', className: 'text-left'},
            {data: 'keysearch' , name:'keysearch', className:'d-none'}
        ],
        fixed_left = 0,
        fixed_right = 0;
    dataTableFoodSetupVatFoodManage = await DatatableTemplateNew(id, data, column, '45vh', fixed_left, fixed_right);
    $('#total-all-check-vat-food-manage').text(formatNumber(dataTableFoodSetupVatFoodManage.rows().count()));
}

async function checkAllSetupVatFoodBrandManage(r) {
    let i = 0;
    countCheckbox = 0
    if (r.is(':checked') === true) {
        await dataTableFoodSetupVatFoodManage.rows().every(function (index, element) {
            let row = $(this.node());
            row.find('td:eq(0)').find('input').prop('checked', true);
            i++;
            countCheckbox++
        });
    } else {
        await dataTableFoodSetupVatFoodManage.rows().every(function (index, element) {
            let row = $(this.node());
            row.find('td:eq(0)').find('input').prop('checked', false);
            countCheckbox = 0
        });
    }
    $('#total-check-vat-food-manage').text(formatNumber(i));
}


async function saveSetupVatFoodBrandManage() {
    if(checkSaveSetupVatFoodBrandManage !== 0) return false;
   if(!$('#vat-setup-vat-food-brand-manage').val()){
       let text = 'Vui lòng chọn loại VAT';
       WarningNotify(text);
   }
    if(!checkValidateSave($('#modal-setup-vat-food-brand-manage'))) return false;
    if($('input[name="check-vat-food-brand-manage"]:checked').length < 1){
        let text = 'Vui lòng chọn món ăn áp dụng VAT';
        WarningNotify(text);
        return false;
    }
    let listFoodSetupVat = [];
    await dataTableFoodSetupVatFoodManage.rows().every(function (index, element) {
        let row = $(this.node());
        if (row.find('td:eq(0)').find('input').is(':checked') === true) {
            listFoodSetupVat.push(row.find('td:eq(0)').find('input').val());
        }
    });
    checkSaveSetupVatFoodBrandManage = 1;
    let method = 'post',
        url = 'food-brand-manage.setup-vat',
        params = null,
        data = {
            id: $('#vat-setup-vat-food-brand-manage').val(),
            food: listFoodSetupVat,
            brand_id: $('.select-brand').val(),
        };
    let res = await axiosTemplate(method, url, params, data, [$('#table-setup-food-brand-manage')]);
    checkSaveSetupVatFoodBrandManage = 0;
    if (res.data.status === 200) {
        let text = 'Áp dụng VAT thành công';
        SuccessNotify(text);
        closeModalSetupVatFoodBrandManage();
        loadData();
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) text = res.data.message;
        ErrorNotify(text);
    }
}

function closeModalSetupVatFoodBrandManage() {
    shortcut.remove('F4');
    countCheckbox = 0
    dataTableFoodSetupVatFoodManage.clear().draw(false);
    $('#modal-setup-vat-food-brand-manage').modal('hide');
    $('#check-all-setup-vat-food-manage').prop('checked', false);
    $('#vat-setup-vat-food-brand-manage').find('option:first').trigger('change.select2');
    $('#total-check-vat-food-manage').text(0);
    $('#total-all-check-vat-food-manage').text(0);
}
