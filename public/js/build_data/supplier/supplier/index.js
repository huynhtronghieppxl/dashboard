let dataTableSupplierNotUse = [],
    dataTableSupplierUse = [],
    dataTableSupplierDisEnable = [],
    reasonIdSupplier = "",
    tabCurrentListSupplier = 0;

$(function () {
    addLoading('list-supplier-data.data');
    if(getCookieShared('list-supplier-data-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('list-supplier-data-user-id-' + idSession));
        tabCurrentListSupplier = dataCookie.tab;
        reasonIdSupplier = dataCookie.typeSupplier;
    }
    $('#nav-tab-list-supplier .nav-link').on('click', function (){
        tabCurrentListSupplier = $(this).data('type');
        cookieListSupplier();
    })

    $('.select-reason-supplier').on('select2:select', function () {
        reasonIdSupplier = $(this).val();
        cookieListSupplier();
        loadData();
    });
    $('#nav-tab-list-supplier .nav-link[data-type="' + tabCurrentListSupplier + '"]').click()
    $(document).on('input paste','#table-enable-supplier-data_filter input', function (){
        let index = 1;
        dataTableSupplierUse.rows({'search':'applied'}).every(function (){
            let row = $(this.node())
            row.find('td:eq(0)').text(index)
            index++;
        })
        $('#total-record-enable').text(dataTableSupplierUse.rows({'search':'applied'}).count());
    })
    $(document).on('input paste','#table-supplier-not-active-data_filter input', function (){
        let index = 1;
        dataTableSupplierNotUse.rows({'search':'applied'}).every(function (){
            let row = $(this.node())
            row.find('td:eq(0)').text(index)
            index++;
        })
        $('#total-record-not-use-supplier').text(dataTableSupplierNotUse.rows({'search':'applied'}).count());
    })
    $(document).on('input paste','#table-disable-supplier-data_filter input', function (){
        let index = 1;
        dataTableSupplierDisEnable.rows({'search':'applied'}).every(function (){
            let row = $(this.node())
            row.find('td:eq(0)').text(index)
            index++;
        })
        $('#total-record-disable').text(dataTableSupplierDisEnable.rows({'search':'applied'}).count());
    })
    loadData();
});

function cookieListSupplier(){
    saveCookieShared('list-supplier-data-user-id-' + idSession, JSON.stringify({
        'tab' : tabCurrentListSupplier,
        'typeSupplier' : reasonIdSupplier,
    }))
}

async function loadData() {
    $('.select-reason-supplier').val(reasonIdSupplier).trigger('change.select2');
    let method = 'get',
        url = 'list-supplier-data.data',
        params = { reason_id: reasonIdSupplier },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#content-body-techres')]);
    dataTableSupplierData(res);
    dataTotalSupplierData(res.data[3]);
}

async function dataTableSupplierData(data) {
    let table_enable = $('#table-enable-supplier-data'),
        table_supplier = $('#table-supplier-not-active-data'),
        table_disable = $('#table-disable-supplier-data'),
        fixed_left = 2,
        fixed_right = 1,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-left', width: '30%'},
            {data: 'phone', name: 'phone', className: 'text-left', width: '30%'},
            {data: 'action', name: 'action', className: 'text-right'},
            {data:'keysearch',name:'keysearch',className:'d-none'}
        ],
        option = [{
            'title': 'Thêm mới',
            'icon': 'fa fa-plus text-primary',
            'class': 'text-primary',
            'function': 'openModalCreateSupplierData',
        },{
            'title': 'Thêm nguyên liệu',
            'icon': 'fa fa-plus',
            'class': '',
            'function': 'openModalUpdateSupplierMaterialData',
        }];
    dataTableSupplierUse = await DatatableTemplateNew(table_enable, data.data[0].original.data, columns, vh_of_table, fixed_left, fixed_right, option);
    dataTableSupplierNotUse = await DatatableTemplateNew(table_supplier, data.data[1].original.data, columns, vh_of_table, fixed_left, fixed_right, option);
    dataTableSupplierDisEnable = await DatatableTemplateNew(table_disable, data.data[2].original.data, columns, vh_of_table, fixed_left, fixed_right, option);
}

function drawDataTableSupplier(data) {
    $('#total-record-enable').text(Number($('#total-record-enable').text()) + 1);
    addRowDatatableTemplate(dataTableSupplierUse, {
        'name': data.name,
        'phone': data.phone,
        'address': data.address,
        'action': data.action,
        'keysearch': data.keysearch,
    });
}

function dataTotalSupplierData(data) {
    $('#total-record-enable').text(data.total_record_enable);
    $('#total-record-not-use-supplier').text(data.total_record_not_use_supplier);
    $('#total-record-disable').text(data.total_record_disable);
}
