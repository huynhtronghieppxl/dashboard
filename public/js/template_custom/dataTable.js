$(function () {
    $(document).on('click', '.btn-filter-data-table', function () {
        $(this).parent().find('.list-filter-column-select').toggleClass('d-none');
    })

    $(document).on('click', '.filter-column-select-item', function (e) {
        e.preventDefault();
        let column = table.column($(this).attr('data-cv-idx'));
        column.visible(!column.visible());
        $(this).find('input').prop('checked', !$(this).find('input').is(':checked'));
    });

    $(document).on('mouseover', '.new-table-row-group tbody td', function () {
        $('.active-row-focus').removeClass('active-row-focus');
        let x = $(this).parents('tr').index();
        for (let i = x; i >= 0; i--) {
            if ($(this).parents('tbody tr:eq(' + i + ')').find('td').hasClass('d-none')) {
                $(this).parents('tr').addClass('active-row-focus');
                break;
            }
        }
    });
})

function searchUpdateIndexDataTable(datatable) {
    let index = 1;
    datatable.rows({'search': 'applied'}).every(function () {
        let row = $(this.node())
        row.find('td:eq(0)').text(index)
        index++;
    })
}

async function renderOptionFilterDatatable(id, table) {
    let option = '';
    await id.find('thead tr:first th').each(function (e, i) {
        let check = (table.columns(e).visible()) ? 'checked' : '';
        if ($(this).text() != '') {
            option += `<li class="filter-column-select-item" data-cv-idx="${e}">
                            <div class="checkbox-zoom zoom-primary p-1 m-0 ">
                                <label>
                                    <input type="checkbox" value="" ${check} name="check-visible">
                                    <span class="cr">
                                        <i class="cr-icon fa fa-check txt-primary"></i>
                                    </span>
                                    <span>${$(this).text()}</span>
                                </label>
                            </div>
                        </li>`;
        }
    })
    return option;
}

async function renderToolBarDatatable(data) {
    let toolbar = '';
    for await(const v of data) {
        toolbar += `<label class="mb-1 mr-1 d-flex align-items-center ${v.class}"><button type="submit" onclick="${v.function}()" ${v.attr} class="btn-tool-data-table "><i class='${v.icon}'></i></button><span class="mr-1">${v.title}</span></label>`;
    }
    return toolbar;
}

async function DatatableTemplateNew(id, data_table, column, scroll_Y, fixed_left, fixed_right, option = [], modal = '', fullSize = true) {
    // try {
    let length = parseInt($('#data-table-length').val());
    $('body').append(loadingBall);
    let table = await id.DataTable({
        destroy: true,
        responsive: false,
        autoWidth: true,
        processing: true,
        language: {
            emptyTable: `<div class='empty-datatable-custom' style="background-color: #fff !important;">
                                   <img style="width: 200px" src='../../../../images/tms/empty.png'>
                                 </div>`,
            search: "<i class='fi-rr-search'></i> _INPUT_",
            searchPlaceholder: "Tìm kiếm",
            lengthMenu: " _MENU_ ",
            paginate: {
                "first": '<em class="fa fa-angle-double-right"></em>',
                "last": '<em class="fa fa-angle-double-left"></em>',
                "next": '<em class="fa fa-angle-right"></em>',
                "previous": '<em class="fa fa-angle-left"></em>'
            },
            info: " trong tổng số _TOTAL_",
            infoEmpty: " trong tổng số _TOTAL_",
            zeroRecords: `<div class='empty-datatable-custom' style="background-color: #fff !important;">
                                    <img style="width: 200px" src='../../../../images/tms/empty.png'>
                                 </div>`,
            infoFiltered: "",

        },
        serverSide: false,
        ordering: false,
        data: data_table,
        columns: column,
        scrollY: scroll_Y,
        scrollX: true,
        scrollCollapse: fullSize,
        pageLength: 100,
        lengthMenu: [
            [50, 100],
            [50, 100]
        ],
        buttons: [],
        fixedColumns: {
            leftColumns: fixed_left,
            rightColumns: fixed_right,
        },
        dom: "<'row'<'col-sm-1 col-md-2 col-lg-3 d-flex justify-content-start'f<'p-0 m-0'B>><'col-sm-11 col-md-10 col-lg-9 d-flex justify-content-end'<'toolbar-button-datatable'>>>" +
            "<'row'<'col-12 tool-box-filter select-filter-dataTable'>>" +
            "<'row'<'col-12'tr>>" +
            "<'row'<'row-left-datatable p-0 d-flex col-3 'l<'p-0'>i><'col-9'p>>",
        drawCallback: async function () {
            $("#" + id.attr('id') + "_wrapper .toolbar-button-datatable").html(await renderToolBarDatatable(option));
            id.find('img').Lazy();
            let api = this.api();
            api.columns.adjust();
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover',
                container: 'body',
                html: true
            });
            if (modal !== '') {
                $('#' + modal + ' .js-example-basic-single:last').select2({
                    dropdownParent: $('#' + 'modal-create-supplier-order'),
                });
            }
            $('#' + id.attr('id') + '_wrapper').parent().children('.select-filter-dataTable:first').attr('style', 'display:flex !important ; right: ' + ($('#' + id.attr('id') + '_wrapper .toolbar-button-datatable').width() + 24) + 'px !important');
            if( $('#' + id.attr('id') + '_wrapper').parent().children('.select-filter-dataTable').length>1){
                let height=30 * parseInt($('#' + id.attr('id') + '_wrapper').parent().children('.select-filter-dataTable').length)
                $('#' + id.attr('id') + '_wrapper').parent().children('.select-filter-dataTable:eq(1)').attr('style', 'display:flex !important ; right: '  + 24 + 'px !important; top :'+height +'px !important');
                let heightRow=height + 20
                $('#' + id.attr('id') + '_wrapper').find('.row:first').attr('style' , 'height:'+ heightRow+'px !important')
                $('#' + id.attr('id') + '_wrapper').find('.toolbar-button-datatable').addClass('align-items-start')
            }

        },
        "initComplete": async function render() {
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover',
                container: 'body',
                html: true
            });

        },
    });
    id.on('draw.dt', function () {
        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'hover',
            container: 'body',
            html: true
        });
        $('#' + id.attr('id') + '_wrapper').parent().find('.select-filter-dataTable').attr('style', 'display:flex !important ; right: ' + ($('#' + id.attr('id') + '_wrapper .toolbar-button-datatable').width() + 24) + 'px !important');
        if (id.parents('.modal').attr('id') !== undefined) {
            id.find('.js-example-basic-single').select2({
                dropdownParent: $('#' + id.parents('.modal').attr('id')),
            });
        } else {
            id.find('.js-example-basic-single').select2();
        }
    });

    table.on('page.dt', function () {
        $(table.table().node()).parent().scrollTop(0);
        table.draw(false);
    });
    return table;
}

function addRowDatatableTemplateNew(table, el, data) {
    if(Array.isArray(data)) {
        if(el.find('tbody tr').length === 1 && el.find('tbody tr').find('td:eq(0)').hasClass('dataTables_empty')) {

        }else{
            data.forEach(elm => elm.DT_RowIndex += el.find('tbody tr').length)
        }
        table.rows.add(data).draw(false);
    }else {
        data.DT_RowIndex = el.find('tbody tr').length + 1;
        table.row.add(data).draw(false);
    }
    table.page('last').draw(false);
    el.parents('.dataTables_scrollBody').scrollTop(el.parents('.dataTables_scrollBody')[0].scrollHeight);
}

async function DatatableTemplateRowGroupNew(id, data_table, column, scroll_Y, fixed_left, fixed_right, option = [], groupColumn = []) {
    // try {
    let length = parseInt($('#data-table-length').val());
    $('body').append(loadingBall);
    let table = await id.DataTable({
        destroy: true,
        responsive: false,
        processing: true,
        language: {
            emptyTable: `<div class='empty-datatable-custom' style="background-color: #fff !important;">
                               <img style="width: 200px" src='../../../../images/tms/empty.png'>
                             </div>`,
            search: "<i class='fi-rr-search'></i> _INPUT_",
            searchPlaceholder: "Tìm kiếm",
            lengthMenu: " _MENU_ ",
            paginate: {
                "first": '<em class="fa fa-angle-double-right"></em>',
                "last": '<em class="fa fa-angle-double-left"></em>',
                "next": '<em class="fa fa-angle-right"></em>',
                "previous": '<em class="fa fa-angle-left"></em>'
            },
            info: " trong tổng số _TOTAL_",
            infoEmpty: " trong tổng số _TOTAL_",
            zeroRecords: `<div class='empty-datatable-custom' style="background-color: #fff !important;">
                                <img style="width: 200px" src='../../../../images/tms/empty.png'>
                             </div>`,
            infoFiltered: "",

        },
        serverSide: false,
        ordering: false,
        data: data_table,
        rowsGroup: groupColumn,
        columns: column,
        scrollY: scroll_Y,
        scrollX: true,
        scrollCollapse: true,
        pageLength: 100,
        lengthMenu: [
            [50, 100],
            [50, 100],
        ],
        fixedColumns: {
            leftColumns: fixed_left,
            rightColumns: fixed_right,
        },
        dom: "<'row'<'col-sm-1 col-md-2 col-lg-3 d-flex justify-content-start'f<'p-0 m-0'B>><'col-sm-11 col-md-10 col-lg-9 d-flex justify-content-end'<'toolbar-button-datatable'>>>" +
            "<'row'<'col-12'tr>>" +
            "<'row'<'mt-2 p-0 d-flex col-3'l<'p-0'>i><'col-9'p>>",
        drawCallback: async function () {
            $("#" + id.attr('id') + "_wrapper .toolbar-button-datatable").html(await renderToolBarDatatable(option));
            id.find('img').Lazy();
            $('#' + id.attr('id') + '_wrapper').parent().find('.select-filter-dataTable').attr('style', 'display:flex !important ; right: ' + ($('#' + id.attr('id') + '_wrapper .toolbar-button-datatable').width() + 24) + 'px !important');
            let api = this.api();
            api.columns.adjust();
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover',
                container: 'body',
                html: true
            });
        },
        "initComplete": async function render() {

            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover',
                container: 'body',
                html: true
            })

        },
    });
    id.on('draw.dt', function () {

        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'hover',
            container: 'body',
            html: true
        });
        $('#' + id.attr('id') + '_wrapper').parent().find('.select-filter-dataTable').attr('style', 'display:flex !important ; right: ' + ($('#' + id.attr('id') + '_wrapper .toolbar-button-datatable').width() + 24) + 'px !important');
        if (id.parents('.modal').attr('id') !== undefined) {
            id.find('.js-example-basic-single').select2({
                dropdownParent: $('#' + id.parents('.modal').attr('id')),
            });
        } else {
            id.find('.js-example-basic-single').select2();
        }
    });

    table.on('page.dt', function () {
        $(table.table().node()).parent().scrollTop(0);
    });
    return table;
}

async function DatatableServerSideTemplateNew(id, url, column, scroll_Y, fixed_left, fixed_right, option, callbackDatatableServerSide) {
    let length = parseInt($('#data-table-length').val());
    let table = await id.DataTable({
        destroy: true,
        responsive: false,
        autoWidth: true,
        processing: true,
        language: {
            emptyTable: `<div class='empty-datatable-custom' style="background-color: #fff !important;">
                               <img style="width: 200px" src='../../../../images/tms/empty.png'>
                             </div>`,
            processing: themeLoading(id.height(), ''),
            search: "<i class='fi-rr-search'></i> _INPUT_",
            searchPlaceholder: "Tìm kiếm",
            lengthMenu: " _MENU_ ",
            paginate: {
                "first": '<em class="fa fa-angle-double-right"></em>',
                "last": '<em class="fa fa-angle-double-left"></em>',
                "next": '<em class="fa fa-angle-right"></em>',
                "previous": '<em class="fa fa-angle-left"></em>'
            },
            info: " trong tổng số _TOTAL_",
            infoEmpty: " trong tổng số _TOTAL_",
            zeroRecords: `<div class='empty-datatable-custom' style="background-color: #fff !important;">
                               <img style="width: 200px" src='../../../../images/tms/empty.png'>
                             </div>`,
            infoFiltered: "",
        },
        serverSide: true,
        ordering: false,
        ajax: url,
        columns: column,
        scrollY: scroll_Y,
        scrollX: true,
        scrollCollapse: true,
        pageLength: 100,
        lengthMenu: [
            [100],
            [100],
        ],
        fixedColumns: {
            leftColumns: fixed_left,
            rightColumns: fixed_right,
        },
        buttons: [],
        dom: "<'row'<'col-sm-1 col-md-2 col-lg-3 d-flex justify-content-start pt-1'f<'p-0 m-0'B>><'col-sm-11 col-md-10 col-lg-9 d-flex justify-content-end'<'toolbar-button-datatable'>>>" +
            "<'row'<'col-12'tr>>" +
            "<'row'<'mt-2 p-0 d-flex col-3'l<'p-0'>i><'col-9 mt-2'p>>",
        drawCallback: async function (response) {
            $("#" + id.attr('id') + "_wrapper .toolbar-button-datatable").html(await renderToolBarDatatable(option));
            id.find('img').Lazy();
            callbackDatatableServerSide(response.json);
            $('#' + id.attr('id') + '_wrapper').parent().find('.select-filter-dataTable').attr('style', 'display:flex !important ; right: ' + ($('#' + id.attr('id') + '_wrapper .toolbar-button-datatable').width() + 24) + 'px !important');
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover',
                container: 'body',
                html: true
            });
            let api = this.api();
            api.columns.adjust();
        },
        "initComplete": async function render() {
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover',
                container: 'body',
                html: true
            });

            $(document).on('click', '#' + id.attr('id') + '_filter .filter-column-select-item', function (e) {
                e.preventDefault();
                let column = table.column($(this).attr('data-cv-idx'));
                column.visible(!column.visible());
                $(this).find('input').prop('checked', !$(this).find('input').is(':checked'));
            });
        },
    });
    id.on('draw.dt', function () {
        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'hover',
            container: 'body',
            html: true
        });
        $('#' + id.attr('id') + '_wrapper').parent().find('.select-filter-dataTable').attr('style', 'display:flex !important ; right: ' + ($('#' + id.attr('id') + '_wrapper .toolbar-button-datatable').width() + 24) + 'px !important');
    });
    table.on('page.dt', function () {
        $(table.table().node()).parent().scrollTop(0);
    });
    return table;
}
