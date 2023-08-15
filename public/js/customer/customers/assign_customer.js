let tableCustomerCardTag = '', loadingCardTag = 0, idRestaurantId, checkSaveAssignCustomerTag = 0,
    dataListCardTag = '';

async function openModalAssignCustomerTagForCustomers(r){
    // idRestaurantId = r.data('id');
    $('#modal-assign-customer-tag-for-customers').modal('show');
    await loadDataAssign();
    $('.select-card-tag-customer').select2({
        dropdownParent: $('#modal-assign-customer-tag-for-customers'),
    });
    $(document).on('click','.checkbox-card-tag-customer', async function () {
        let i = 0;
        let x = 0;
        await tableCustomerCardTag.rows().every(function (index, element) {
            let row = $(this.node());
            if (row.find('td:eq(0)').find('input').is(':checked') === true) {
                i++;
            }
            x++;
        });
        $('#total-check-assign-customer').text(formatNumber(i));

        if (i === x) {
            $('#check-all-assign-customer').prop('checked', true);
        } else {
            $('#check-all-assign-customer').prop('checked', false);
        }
    })
}

function loadDataAssign(){
    listCustomer();
    listCardTag();
}

async function loadingDataCardTag() {
    loadingCardTag = 1;
    tableCustomerCardTag.ajax.url("card-tag.list-customer?type=" + 1).load();
}

async function listCardTag(){
    let method = 'get',
        url = 'customers.list-card-tag',
        is_delete = 0,
        params = {is_delete: is_delete},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    await $('.select-card-tag-customer').html(res.data[0]);
}

async function checkAllAssignCustomerTagForCustomers(r){
    let i = 0;
    if (r.is(':checked') === true) {
        await tableCustomerCardTag.rows().every(function (index, element) {
            let row = $(this.node());
            row.find('td:eq(0)').find('input').prop('checked', true);
            i++;
        });
    } else {
        await tableCustomerCardTag.rows().every(function (index, element) {
            let row = $(this.node());
            row.find('td:eq(0)').find('input').prop('checked', false);
        });
    }
    $('#total-check-assign-customer').text(formatNumber(i));
}

async function listCustomer(){
    if (tableCustomerCardTag === '') {
        let element = $('#table-assign-customer-tag-for-customers'),
            url = "customers.list-customer?type=" + 1 + "&id=" + idRestaurantId ,
            column = [
                {data: 'name', name: 'name', width: '5%'},
                {data: 'phone', name: 'phone', className: 'text-center'},
                {data: 'gender', name: 'gender', className: 'text-center'},
                {data: 'detail', name: 'detail', className: 'text-center'},
                // {data: 'action', name: 'action', class: 'text-center', width: '5%'},
                {data: 'keysearch', className: 'd-none'},
            ];
        tableCustomerCardTag = await loadDataCustomerCardTag(element, url, column);
        loadingCardTag = 1;
    } else if (loadingCardTag === 1) {
        tableCustomerCardTag.ajax.url("card-tag.list-customer?type=" + 1 + "&id=" + idRestaurantId).load();
    }
}

async function loadDataCustomerCardTag(element, url, column){
    let fixedLeftTable = 0,
        fixedRightTable = 0,
    optionRenderTable = []
    return DatatableServerSideTemplateNew(element, url, column, '45vh', fixedLeftTable, fixedRightTable, optionRenderTable, callbackLoadDataCardTag);
}

function callbackLoadDataCardTag(response) {
    console.log(response);
    $('#total-all-check-assign-customer').text(response.data.length);
}

async function saveModalAssignCustomerTagForCustomers(r){
    if(checkSaveAssignCustomerTag === 1) return false;
    if(!checkValidateSave($('#modal-assign-customer-tag-for-customers'))) return false;
    let listCardTagCustomer = [],
        listDeleteCardTagCustomer = [];
    await tableCustomerCardTag.rows().every(function (index, element) {
        let row = $(this.node());
        if (row.find('td:eq(0)').find('input').is(':checked') === true) {
            listCardTagCustomer.push(row.find('td:eq(0)').find('input').val());
        } else {
            listDeleteCardTagCustomer.push(row.find('td:eq(0)').find('input').val());
        }
    });
    checkSaveAssignCustomerTag = 1;
    let method = 'post',
        url = 'customers.assign-restaurant-customer',
        params = null,
        data = {
            restaurant_tag_id: idRestaurantId,
            customer_insert: listCardTagCustomer,
            customer_delete: listDeleteCardTagCustomer,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#table-assign-customer-tag-for-customers')]);
    checkSaveAssignCustomerTag = 0;
    switch (res.data.status) {
        case 200:
            SuccessNotify($('#success-update-data-to-server').text());
            closeModalAssignCustomerTagForCustomers();
            loadData();
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify(res.data.message);
    }
}

function closeModalAssignCustomerTagForCustomers(){
    $('#modal-assign-customer-tag-for-customers').modal('hide');
    $('#check-all-assign-customer').prop('checked', false);
    $('#total-check-assign-customer').text('0');
    $('#total-all-check-assign-customer').text('0');
}
