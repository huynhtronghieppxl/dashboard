let drawTableAssignCustomerEmployee,
    drawTableNotAssignCustomerEmployee,
    checkSaveAssignCustomerEmployee = 0;
$(async function () {
    shortcut.add("F4", function () {
        saveBestsellingFoodCustomer();
    });

    $('#select-customer-assign-customer').on('change', function (){
        loadData();
    })
    if(!$('.select-branch').val()) {
        await updateSessionBrandNew($('.select-brand'));
    }

    $('.select-branch, .select-brand').on('change', async function () {
        await updateSessionBrandNew($('.select-brand'))
        EmployeeAssignCustomer()
    })
    EmployeeAssignCustomer();
});

async function EmployeeAssignCustomer(){
    let method = 'get',
        url = 'assign-customer.employee',
        branch = $('.select-branch').val(),
        restaurant_brand_id = $('.select-brand').val(),
        params = {
            branch: branch,
            restaurant_brand_id: restaurant_brand_id,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data,[
        $("#select-customer-assign-customer"),
    ]);
    $('#select-customer-assign-customer').html(res.data[0]);
    loadData();
}

async function loadData() {
    let method = 'get',
        url = 'assign-customer.data',
        employee_id = $('#select-customer-assign-customer option:selected').val(),
        restaurant_brand_id = $('.select-brand').val(),
        params = {
            employee_id : employee_id,
            restaurant_brand_id: restaurant_brand_id,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data,[
        $("#table-all-assign-customer"),
        $("#table-selected-assign-customer"),
    ]);
    dataTableAllEmployeeCustomer(res.data[0].original.data);
    dataTableAssignEmployeeCustomer(res.data[1].original.data);
}

async function dataTableAllEmployeeCustomer(data) {
    let id = $('#table-all-assign-customer'),
        fixed_left = 0,
        fixed_right = 2,
        columns = [
            {data: 'avatar', name: 'avatar', width: '5%', className: 'text-left'},
            {data: 'gender', name: 'gender', width: '5%', className: 'text-left'},
            {data: 'tag', name: 'tag', className: 'text-left'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ],
        option = [];
    drawTableNotAssignCustomerEmployee = await DatatableTemplateNew(id, data ,columns, vh_of_table, fixed_left, fixed_right,option);
}

async function dataTableAssignEmployeeCustomer(data) {
    let id = $('#table-selected-assign-customer'),
        fixed_left = 0,
        fixed_right = 0,
        columns = [
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'avatar', name: 'avatar', width: '5%', className: 'text-left'},
            {data: 'gender', name: 'gender', width: '5%', className: 'text-left'},
            {data: 'tag', name: 'tag', className: 'text-left'},
            {data: 'keysearch', className: 'd-none'},
        ],
        option = [
            {
                'title': 'Cập nhật',
                'icon': 'fa fa-upload',
                'class': '',
                'function': 'saveAssignCustomerEmployee',
            }
        ];
    drawTableAssignCustomerEmployee = await DatatableTemplateNew(id, data, columns, vh_of_table, fixed_left, fixed_right,option);
}

async function checkAssignCustomerEmployee(r) {
    let item = {
        'avatar': r.parents('tr').find('td:eq(0)').html(),
        'gender': r.parents('tr').find('td:eq(1)').html(),
        'tag': r.parents('tr').find('td:eq(2)').html(),
         'action': ' <div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  data-type="' + r.parents('tr').find('td:eq(3)').find('button').attr('data-type') + '" onclick="unCheckAssignCustomerEmployee($(this))" data-id="' + r.parents('tr').find('td:eq(3)').find('button').attr('data-id') + '"><i class="fi-rr-arrow-small-left"></i></button></div>',
        'keysearch': r.parents('tr').find('td:eq(4)').text(),
    };
    addRowDatatableTemplate(drawTableAssignCustomerEmployee, item);
    drawTableNotAssignCustomerEmployee.row(r.parents('tr')).remove().draw(false);
}

async function unCheckAssignCustomerEmployee(r) {
    let item = {
        'avatar': r.parents('tr').find('td:eq(1)').html(),
        'gender': r.parents('tr').find('td:eq(2)').html(),
         'action': ' <div class="btn-group btn-group-sm"> <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  data-type="' + r.attr('data-type') + '" onclick="checkAssignCustomerEmployee($(this))" data-id="' + r.parents('tr').find('td:eq(0)').find('button').attr('data-id') + '"><i class="fi-rr-arrow-small-right"></i></button></div>',
        'tag': r.parents('tr').find('td:eq(3)').html(),
        'keysearch': r.parents('tr').find('td:eq(4)').text(),
    };
    addRowDatatableTemplate(drawTableNotAssignCustomerEmployee, item);
    drawTableAssignCustomerEmployee.row(r.parents('tr')).remove().draw(false);
}

async function checkAllAssignCustomerEmployee() {
    await addAllRowDatatableTemplate(drawTableNotAssignCustomerEmployee ,drawTableAssignCustomerEmployee, itemCheckAllAssignCustomerEmployee)
}

async function unCheckAllAssignCustomerEmployee() {
    await addAllRowDatatableTemplate(drawTableAssignCustomerEmployee, drawTableNotAssignCustomerEmployee, itemCheckAssignCustomerEmployee)
}

function itemCheckAllAssignCustomerEmployee(row) {
    return {
        'avatar': row.find('td:eq(0)').html(),
        'gender': row.find('td:eq(1)').html(),
        'tag': row.find('td:eq(2)').html(),
         'action': ' <div class="btn-group btn-group-sm"> <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  onclick="unCheckAssignCustomerEmployee($(this))" data-type="'+  row.find('td:eq(3) button').attr('data-type') +'" data-id="' + row.find('td:eq(3) button').attr('data-id') + '"><i class="fi-rr-arrow-small-left"></i></button> </div>',
        'keysearch': row.find('td:eq(4)').text(),
    };
}

function itemCheckAssignCustomerEmployee(row) {
    return {
        'avatar': row.find('td:eq(1)').html(),
        'gender': row.find('td:eq(2)').html(),
         'action': ' <div class="btn-group btn-group-sm"> <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  onclick="checkAssignCustomerEmployee($(this))" data-type="'+  row.find('td:eq(0) button').attr('data-type') +'" data-id="' + row.find('td:eq(0) button').attr('data-id') + '"><i class="fi-rr-arrow-small-right"></i></button> </div>',
        'tag': row.find('td:eq(3)').html(),
        'keysearch': row.find('td:eq(4)').text(),
    };
}

async function saveAssignCustomerEmployee() {
    if (checkSaveAssignCustomerEmployee === 1) {
        return false;
    }
    let restaurant_brand_id = $('.select-brand').val(),
        employee_id = $('#select-customer-assign-customer').val(),
        customer_insert_ids = [],
        customer_delete_ids = [];
    await drawTableAssignCustomerEmployee.rows().every(function (index, element) {
        let row = $(this.node());
        if(row.find('td:eq(0)').find('button').attr('data-type') == 0){
            customer_insert_ids.push(row.find('td:eq(0)').find('button').attr('data-id'));
        }
    });
    await drawTableNotAssignCustomerEmployee.rows().every(function (index, element) {
        let row = $(this.node());
        if(row.find('td:eq(3)').find('button').attr('data-type') == 1){
            customer_delete_ids.push(row.find('td:eq(3)').find('button').attr('data-id'));
        }
    });
    checkSaveAssignCustomerEmployee = 1;
    let method = 'post',
        url = 'assign-customer.assign',
        params = null,
        data = {
            restaurant_brand_id: restaurant_brand_id,
            employee_id: employee_id,
            customer_insert_ids: customer_insert_ids,
            customer_delete_ids : customer_delete_ids
        };
    let res = await axiosTemplate(method, url, params, data,[
        $("#table-selected-assign-customer"),
        $("#table-all-assign-customer"),
    ]);
    checkSaveAssignCustomerEmployee = 0;
    switch(res.data.status) {
        case 200:
            SuccessNotify($('#success-update-data-to-server').text());
            await drawTableAssignCustomerEmployee.rows().every(function (index, element) {
                let row = $(this.node());
                if(row.find('td:eq(0)').find('button').attr('data-type') == 0){
                    row.find('td:eq(0)').find('button').attr('data-type', 1)
                }
            });
            await drawTableNotAssignCustomerEmployee.rows().every(function (index, element) {
                let row = $(this.node());
                if(row.find('td:eq(3)').find('button').attr('data-type') == 1){
                    row.find('td:eq(3)').find('button').attr('data-type', 0)
                }
            });
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify($('#error-post-data-to-server').text());
    }
}
