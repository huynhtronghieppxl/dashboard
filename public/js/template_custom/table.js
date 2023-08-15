let TimeFormTemplate, TimeToTemplate, TimeOneTemplate;

$(function () {
    $('a[data-toggle="tab"]').not('.remove-draw-table').on('shown.bs.tab', function (e) {
        let table_id = $($(this).attr('href')).find('.dataTables_scrollBody table').attr('id');
        $.fn.dataTable.tables().forEach(function (dt) {
            if (table_id === dt.id) {
                let table = $('#' + table_id).DataTable();
                table.columns.adjust().draw();
            }
        });
        checkEmptyTableTabAndScroll($(this));
    });
    /**
     * Check empty ALL DATATABLE and SCROLL center.
     */

    $(document).on('init.dt', function (e, settings, json) {
        if (settings.aoData.length === 0) {
            let tb = '#' + settings.sTableId + '_wrapper';
            let findDTScroll = $(tb).find('div').hasClass('dataTables_scroll');
            if (findDTScroll === true) {
                widthTb = $(tb + ' .dataTables_scroll .dataTables_scrollBody table')[0].offsetWidth;
                widthWrapper = $(tb + ' .dataTables_scroll .dataTables_scrollBody')[0].offsetWidth;
                $(tb).find('.dataTables_scroll .dataTables_scrollBody').animate({scrollLeft: (widthTb - widthWrapper) / 2}, 500, 'easeOutQuad')
            }

            $(tb + ' .DTFC_RightBodyWrapper').removeClass('border-DTFC-right');
            $(tb + ' .DTFC_RightHeadWrapper').removeClass('border-DTFC-right');
            $(tb + ' .DTFC_LeftBodyWrapper').removeClass('border-DTFC-left');
            $(tb + ' .DTFC_LeftHeadWrapper').removeClass('border-DTFC-left');
        } else {
            let tb2 = '#' + settings.sTableId + '_wrapper';
            $(tb2 + ' .DTFC_RightBodyWrapper').addClass('border-DTFC-right');
            $(tb2 + ' .DTFC_RightHeadWrapper').addClass('border-DTFC-right');
            $(tb2 + ' .DTFC_LeftBodyWrapper').addClass('border-DTFC-left');
            $(tb2 + ' .DTFC_LeftHeadWrapper').addClass('border-DTFC-left');
        }

        $('.DTFC_RightWrapper .DTFC_RightBodyWrapper .DTFC_RightBodyLiner table thead').remove();

        //Custom size filter Datatable.
        let tbs = '#' + settings.sTableId + '_wrapper';
        // $(tbs).find('.dataTables_length').parent().removeClass('col-md-6').addClass('col-md-3');
        // $(tbs).find('.dataTables_filter').parent().removeClass('col-md-6').addClass('col-md-9');
        $(tbs).find('.dataTables_length label select').addClass('data-table-length-custom');

    });

    /**
     * fix tab with multiple Datatable
     *
     */
    $('a[data-toggle="tab"]').on('click', function () {
        $('.tab-pane[id="' + this.hash.substr(1) + '"]').parents('.tab-content').find('.tab-pane').removeClass('active');
        $(this.hash).addClass('active');
    });

    /**
     * fix collapse datatable
     */
    // $(document).on('click', '#mobile-collapse-custom', function () {
    //     datatableDraw();
    // });

    // $('.select2').change(function () {
    //     datatableDraw();
    // });


    /**
     * Check Scrollbar
     */
    $.fn.hasScrollBarHorizontal = function () {
        return this.get(0).scrollWidth > this.width();
    };

    $.fn.hasScrollBarVertical = function () {
        return this.get(0).scrollHeight > this.height();
    };

    /**
     * Keep Datatable Length
     */
    $(document).on('change', '.data-table-length-custom', function () {
        axios({
            method: 'get',
            url: '/branch-dashboard.update-datatable-length',
            params: {length: $(this).val()}
        }).then(res => {
            if ($('.page-body .data-table-length-custom').length > 1) {
                $('.data-table-length-custom').not($(this)).each(function (index, value) {
                    $('#' + $(value).attr('aria-controls')).DataTable().page.len(res.data).draw();
                })
            } else {
                return false;
            }
        });
    });
    /**
     * Focus when hover row
     */
    $(document).on('mouseover', '.DTFC_ScrollWrapper tbody td', function () {
        $('.active-row-focus').removeClass('active-row-focus');
        $(this).parents('tr').addClass('active-row-focus');
        let x = $(this).parents('tr').index();
        let index = $(this).parents('tr').find('td:eq(0)').text();
        if (Number.isInteger(parseInt(index))) {
            $(this).parents('table').find('.DTFC_ScrollWrapper tbody tr').each(function (i, v) {
                if ($(v).find('td:eq(0)').text() == index) {
                    $(this).addClass('active-row-focus');
                }

            })
        }
        // if ($(this).parents('.DTFC_ScrollWrapper').find('.DTFC_LeftBodyWrapper tbody tr:eq(' + x + ')').css('display') === 'none;') {
        //     for (let i = x; i >= 0; i--) {
        //         if ($(this).parents('.DTFC_ScrollWrapper').find('.DTFC_LeftBodyWrapper tbody tr:eq(' + i + ')').css('display') !== 'none;') {
        //             $(this).parents('.DTFC_ScrollWrapper').find('.DTFC_LeftBodyWrapper tbody tr:eq(' + i + ')').addClass('active-row-focus');
        //             break;
        //         }
        //     }
        // } else {
        $(this).parents('.DTFC_ScrollWrapper').find('.DTFC_LeftBodyWrapper tbody tr:eq(' + x + ')').addClass('active-row-focus');
        // }
        // if ($(this).parents('.DTFC_ScrollWrapper').find('.DTFC_RightBodyWrapper tbody tr:eq(' + x + ')').css('display') === 'none;') {
        //     for (let i = x; i >= 0; i--) {
        //         if ($(this).parents('.DTFC_ScrollWrapper').find('.DTFC_RightBodyWrapper tbody tr:eq(' + i + ')').css('display') !== 'none;') {
        //             $(this).parents('.DTFC_ScrollWrapper').find('.DTFC_RightBodyWrapper tbody tr:eq(' + i + ')').addClass('active-row-focus');
        //             break;
        //         }
        //     }
        // } else {
        $(this).parents('.DTFC_ScrollWrapper').find('.DTFC_RightBodyWrapper tbody tr:eq(' + x + ')').addClass('active-row-focus');
        // }
        // if ($(this).parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody tbody tr:eq(' + x + ')').css('display') === 'none;') {
        //     for (let i = x; i >= 0; i--) {
        //         if ($(this).parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody tbody tr:eq(' + i + ')').css('display') !== 'none;') {
        //             $(this).parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody tbody tr:eq(' + i + ')').addClass('active-row-focus');
        //             break;
        //         }
        //     }
        // } else {
        $(this).parents('.DTFC_ScrollWrapper').find('.dataTables_scrollBody tbody tr:eq(' + x + ')').addClass('active-row-focus');
        // }
    });
    $(document).on('mouseout', '.DTFC_ScrollWrapper tbody td', function () {
        $('.active-row-focus').removeClass('active-row-focus');
    });
});

/**
 * @param id: $('#id')
 * @param data_table: [data]
 * @param column: []
 * @param scroll_Y: 'xxvh'
 * @param fixed_left: int
 * @param fixed_right: int
 * @param initComplete: default null
 * @param rowsGroup: default null
 * @returns {Promise<void>}
 * @constructor
 */
// <button class="btn-empty btn btnclassNameprimary">Thêm</button>
async function DatatableTemplate(id, data_table, column, scroll_Y, fixed_left, fixed_right, initComplete, rowsGroup) {
    try {
        // let length = parseInt($('#data-table-length').val());
        let length = 100;
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
                processing: 'Đang tải ....'
            },
            serverSide: false,
            ordering: false,
            data: data_table,
            rowsGroup: rowsGroup,
            columns: column,
            scrollY: scroll_Y,
            scrollX: true,
            scrollCollapse: true,
            pageLength: length,
            // deferRender: true,
            lengthMenu: [
                [100, -1],
                [100, 'Tất cả']
            ],
            fixedColumns: {
                leftColumns: fixed_left,
                rightColumns: fixed_right,
            },
            drawCallback: function () {
                id.find('img').Lazy();
            },
            "initComplete": initComplete,
        });

        id.on('draw.dt', function () {
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover',
                container: 'body',
                html: true
            });
        });

        table.on('page.dt', function () {
            $(table.table().node()).parent().scrollTop(0);
        });
        await datatableDraw2(table);
        return table;
    } catch (e) {
        console.log('Error Data Table Template !' + e);
    }
}

async function DatatableLimitAllTemplate(id, data_table, column, scroll_Y, fixed_left, fixed_right) {
    try {
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
                processing: 'Đang tải ....'
            },
            serverSide: false,
            ordering: false,
            data: data_table,
            columns: column,
            scrollY: scroll_Y,
            scrollX: true,
            scrollCollapse: true,
            pageLength: -1,
            lengthMenu: [
                [-1],
                ['Tất cả']
            ],
            fixedColumns: {
                leftColumns: fixed_left,
                rightColumns: fixed_right,
            },
            drawCallback: function () {
                id.find('img').Lazy();
            },
        });

        id.on('draw.dt', function () {
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover',
                container: 'body',
                html: true
            });
        });
        table.on('page.dt', function () {
            $(table.table().node()).parent().scrollTop(0);
        });
        await datatableDraw2(table);
        return table;
    } catch (e) {
        console.log('Error Data Table Template !' + e)
    }
}

async function DatatableTemplateDate(id, data_table, column, scroll_Y, fixed_left, fixed_right, option = {}, initComplete, rowsGroup) {
    try {
        let length = parseInt($('#data-table-length').val());
        $('body').append(loadingBall);
        let table = await id.DataTable({
            destroy: true,
            responsive: true,
            processing: true,
            language: {
                emptyTable: `<div class='empty-datatable-custom' style="background-color: #fff !important;">
                               <img style="width: 200px" src='../../../../images/tms/empty.png'>
                             </div>`,
                processing: 'Đang tải ....'
            },
            serverSide: false,
            ordering: false,
            data: data_table,
            rowsGroup: rowsGroup,
            columns: column,
            scrollY: scroll_Y,
            scrollX: false,
            scrollCollapse: true,
            pageLength: length,
            lengthMenu: [
                [100, -1],
                [100, 'Tất cả']
            ],
            // fixedColumns: {
            //     leftColumns: 0,
            //     rightColumns: 0,
            // },
            drawCallback: function () {
                id.find('img').Lazy();
            },
            "initComplete": initComplete,
            dom: "<'row'<'col-sm-1 col-md-2 col-lg-3'l><'col-sm-11 col-md-10 col-lg-9'f>>" +
                "<'row'<'col-lg-12'tr>>" +
                "<'row'<'col'i><'col'p>>",
        });

        id.on('draw.dt', function () {
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover',
                container: 'body',
                html: true
            });
        });
        await dateTimePickerTemplateDataTable(option);
        await datatableDraw2(table);
        return table;
    } catch (e) {
        console.log('Error Data Table Template !' + e)
    }
}

async function DatatableFullSizeTemplate(id, data_table, column, scroll_Y, fixed_left, fixed_right) {
    try {
        let length = parseInt($('#data-table-length').val());
        $('body').append(loadingBall);
        let table = await id.DataTable({
            responsive: false,
            processing: true,
            destroy: true,
            language: {
                emptyTable: `<div class='empty-datatable-custom' style="background-color: #fff !important;">
                               <img style="width: 200px" src='../../../../images/tms/empty.png'>
                             </div>`,
                processing: 'Đang tải ....'
            },
            serverSide: false,
            ordering: false,
            data: data_table,
            columns: column,
            scrollY: scroll_Y,
            scrollX: true,
            pageLength: length,
            lengthMenu: [
                [100, -1],
                [100, 'Tất cả']
            ],
            drawCallback: function () {
                id.find('img').Lazy();
            },
            fixedColumns: {
                leftColumns: fixed_left,
                rightColumns: fixed_right,
            },
        });

        $('select').change(function () {
            datatableDraw();
        });

        id.on('draw.dt', function () {
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover',
                container: 'body',
                html: true
            });
        });
        // await datatableDraw2(table);
        return table;
    } catch (e) {
        console.log('Error Data Table Template !' + e)
    }
}

async function DatatableTemplateSelect(id, data_table, column, scroll_Y, fixed_left, fixed_right, initComplete, rowsGroup) {
    try {
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
                processing: 'Đang tải ....'
            },
            select: {
                toggleable: false
            },
            serverSide: false,
            ordering: false,
            data: data_table,
            rowsGroup: rowsGroup,
            columns: column,
            scrollY: scroll_Y,
            scrollX: true,
            scrollCollapse: true,
            pageLength: length,
            lengthMenu: [
                [100, -1],
                [100, 'Tất cả']
            ],
            fixedColumns: {
                leftColumns: fixed_left,
                rightColumns: fixed_right,
            },
            drawCallback: function () {
                id.find('img').Lazy();
            },
            "initComplete": initComplete
        });
        await datatableDraw2();
        return table;
    } catch (e) {
        console.log('Error Data Table Template !' + e)
    }
}

/**
 * @param id: $('#id')
 * @param url: [url]
 * @param column: []
 * @param scroll_Y: 'xxvh'
 * @param fixed_left: int
 * @param fixed_right: int
 * @returns {Promise<void>}
 * @constructor
 */
async function DatatableServerSideTemplate(id, url, column, scroll_Y, fixed_left, fixed_right) {
    try {
        let data;
        let table = await id.DataTable({
            responsive: false,
            processing: true,
            serverSide: true,
            ordering: false,
            scrollCollapse: true,
            lengthMenu: [[100], [100]],
            pageLength: 100,
            scrollY: scroll_Y,
            fixedColumns: {
                leftColumns: fixed_left,
                rightColumns: fixed_right,
            },
            scrollX: true,
            language: {
                emptyTable: `<div class='empty-datatable-custom' style="background-color: #fff !important;">
                               <img style="width: 200px" src='../../../../images/tms/empty.png'>
                             </div>`,
                processing: "<div class='load'><hr><hr><hr><hr></div>"
            },
            ajax: {
                url: url,
            },
            columns: column,
            dom: "<'row'<'col-sm-5'l><'col-sm-7'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "drawCallback": async function (settings) {
                dateTimePickerTemplateDataTable({
                    idTable: '#table-order',
                    idForm: 'from-date',
                    idTo: 'to-date',
                    type: 2,
                    typeDate: 2,
                    idSearch: 'search-btn-bill-liabilities',
                    Format: 'DD/MM/YYYY',
                    timeDefaultForm: '01/01/2021',
                    timeDefaultTo: '21/2/2021'
                });
                table.data = settings.json;
            },
        });
        await datatableDraw2(table);
        id.on('draw.dt', function () {
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover'
            });
        });
        console.log(data);
        return [table, data];
    } catch (e) {
        console.log('Error Data Table Server side Template !' + e)
    }
}

/**
 * Show img null data
 */
function nullDataImg(id) {
    id.html("<div class='empty-datatable-custom center-loading'><img src='../../../../files/assets/images/nodata-datatable2.png'></div>");
}

/**
 * Vẽ lại bảng khi cột bị lệch
 */
function datatableDraw() {
    $.fn.dataTable.tables({visible: true, api: true}).columns.adjust().draw();
    $('.dataTables_scrollHeadInner').css('width', '100%');
}

async function datatableDraw2(table) {
    await table.columns.adjust().fixedColumns().relayout();
    await table.columns.adjust().draw(false);
    setTimeout(function () {
        table.draw(true);
    }, 1000);
}

let widthTb = 0;
let widthWrapper = 0;

function checkEmptyTableTabAndScroll(i) {
    let idTable = $(i).attr('href');
    widthTb = $(idTable).find('.dataTables_scroll .dataTables_scrollBody table').width();
    widthWrapper = $(idTable).find('.dataTables_scroll .dataTables_scrollBody').width();
    if ($(idTable).find('.dataTables_scroll .dataTables_scrollBody table tbody tr td').eq(0).hasClass('dataTables_empty')) {
        $(idTable).find('.dataTables_scroll .dataTables_scrollBody').animate({scrollLeft: (widthTb - widthWrapper) / 2}, 500, 'easeOutQuad')
    }
}


/**
 * Type = 2
 *
 option = {
        idTable : '#table-order',
        idForm : 'from-date',
        idTo : 'to-date',
        type : 2,
        typeDate : 2,  id = 2 Form to date
        idSearch: 'search-btn-bill-manage',
        Format : 'DD/MM/YYYY', // MM/YYYY - YYYY
        timeDefaultForm : '04/06/2021',
        timeDefaultTo : '05/06/2021'
    }


 option = {
        idTable : '#table-order',
        idForm : 'from-date',
        idTo : 'to-date',
        type : 2,
        typeDate : 2,  id = 2 Form to date
        idSearch: 'search-btn-bill-manage',
        Format : 'DD/MM/YYYY', // MM/YYYY - YYYY
        timeDefaultForm : '04/06/2021',
        timeDefaultTo : '05/06/2021'
    }
 * Type 1

 option = {
        idTable : '#table-order',
        idBtn : 'btn-test'
        type : 1,
        text : 'Thêm mới',
    }
 * @param {*} option
 * @returns
 */
async function dateTimePickerTemplateDataTable(option) {
    if (!(option.type)) {
        return false;
    } else {
        if (option.type === 2) {
            if (!(option.typeDate)) {
                return false;
            } else {
                if (option.typeDate === 1) {
                    if (option.idForm === '' || !(option.idForm)) {
                        console.log('id không được để trống hoặc id không hợp lệ');
                        return false;
                    }
                    if (option.idTable === '' || !(option.idTable)) {
                        console.log('id table không được để trống hoặc id table không hợp lệ');
                        return false;
                    }
                    if (option.timeDefaultForm === '' || option.timeDefaultForm === undefined) {
                        option.timeDefaultForm = moment().format(option.Format);
                    }
                    $('.page-body').remove('#' + option.idForm);
                    $('.page-body').remove('#' + option.idTo);
                    // Form Ngày tháng năm
                    let formDate = `<div class="m-auto" style="display:inline-block; width: max-content">
            <label class="input-group m-auto"><div class="input-group border-group " style="padding:0;width: max-content">
                <input type="text" id="${option.idForm}" data-validate="search" class="input-sm form-control text-center input-datetimepicker custom-form-search" name="start" value="">
            </div></label>
            </div>`;
                    formDateTableOneForm(option.idTable, formDate);
                    DatePickerTemplateCustomChange(option.idForm, option.Format);
                    timeOneForm(option.idForm, option.Format, option.timeDefautForm);

                    // id = 2 Form to date
                } else if (option.typeDate === 2) {
                    if (option.timeDefaultForm === '' || option.timeDefaultForm === undefined) {
                        option.timeDefaultForm = moment().format(option.Format);
                    }
                    if (option.timeDefaultTo === '' || option.timeDefaultTo === undefined) {
                        option.timeDefaultTo = moment().format(option.Format);
                    }
                    if ($('#' + option.idSearch).length === 0) {
                        // Form Ngày tháng năm between to
                        $('.page-body').remove('#' + option.idForm);
                        $('.page-body').remove('#' + option.idTo);
                        let formDateBetween = `<div class="m-auto class-date-from-to-validate " style="display:inline-block; width: max-content" data-format="${option.Format}">
                                            <label class="input-group m-auto justify-content-end"><div class="input-group border-group col-8" style="padding:0; width: max-content">
                                                <input type="text" id="${option.idForm}" data-validate="search" class="col-4 input-sm form-control text-center input-datetimepicker p-1 custom-form-search class-date-from-validate" name="start" value="">
                                                <span class="input-group-addon custom-find">Đến</span>
                                                <input type="text" id="${option.idTo}" data-validate="search" class="col-4 input-sm form-control text-center input-datetimepicker custom-form-search class-date-to-validate" name="end" value="">
                                                <button id="${option.idSearch}" class="input-group-addon cursor-pointer custom-button-search" style="outline:none;"><i class="fa fa-search p-r-0px"></i></button>
                                            </div></label>
                                        </div>`;
                        formDateTable(option.idTable, formDateBetween, option.idSearch);
                        DatePickerTemplateCustomSearch(option.idForm, option.idTo, option.Format);
                        timeTemplate('#' + option.idForm, '#' + option.idTo + '', option.timeDefautForm, option.timeDefautTo, option.Format);
                    }
                }
            }
        } else if (option.type === 1) {
            let formBtn = option.formBtn;
            formDateTableOneForm(option.idTable, formBtn);
        }
    }
}

function DatePickerTemplateCustomSearch(element, element1, Format) {
    $('#' + element).datetimepicker({
        defaultDate: new Date(),
        format: Format,
        locale: 'vi',
        useCurrent: false,
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left",
        },
    });

    $('#' + element1).datetimepicker({
        defaultDate: new Date(),
        format: Format,
        locale: 'vi',
        useCurrent: false,
        minDate: $('#' + element).data("DateTimePicker").date(),
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left",
        },
    });


    $('#' + element).on("dp.change", function (e) {
        if ($(this).val() === '') {
            $('#' + element).data("DateTimePicker").date(new Date());
            // $('#' + element1).data("DateTimePicker").date(new Date());
            $('#' + element1).data("DateTimePicker").minDate(new Date());

        } else {
            let value = $(this).val();
            $('#' + element1).data("DateTimePicker").minDate(e.date);
            // saveCookieShared(document.URL + '#' + $(this).attr('id'), value);
            TimeFormTemplate = value;
        }
    });


    $('#' + element1).on("dp.change", function (e) {
        if ($(this).val() === '') {
            $(this).data("DateTimePicker").date(new Date());
        }

        $('#' + element).data("DateTimePicker").maxDate(e.date);
        let value = $(this).val();
        // saveCookieShared(document.URL + '#' + $(this).attr('id'), value);
        TimeToTemplate = value;
    });


}

// DatePicker on change
function DatePickerTemplateCustomChange(element, Format) {
    $('#' + element).datetimepicker({
        format: Format,
        locale: 'vi',
        maxDate: new Date(),
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left",
        },
    }).on('dp.change', function () {
        $(`#${element}`).on('dp.change', function () {
            let value = $('#' + element).val();
            // saveCookieShared(document.URL + '#' + element, value);
            TimeOneTemplate = value;
            loadData();
        });
    });


}

// Template thêm form Date from to Datatable
function formDateTable(idTable, form, idSearch) {
    $(idTable + '_wrapper .dataTables_filter').prepend(form);
    $(idTable + '_wrapper .dataTables_filter').addClass('mb-1');
    $(idTable + '_wrapper .dataTables_filter').attr('style', 'padding-right:12px')

    // Event Button  // $('#' + idSearch).on('click', function () {
    //     //     loadData();
    //     // });
}

function timeTemplate(idForm, idTo, timeDefautForm, timeDefautTo, format) {
    $(idForm).val(TimeFormTemplate !== undefined ? TimeFormTemplate : moment(new Date()).format(format));
    $(idTo).val(TimeToTemplate !== undefined ? TimeToTemplate : moment(new Date()).format(format));
}

function formDateTableOneForm(idTable, form) {
    $(idTable + '_wrapper .dataTables_filter').prepend(form);
    $(idTable + '_wrapper .dataTables_filter').addClass('mb-1');
    $(idTable + '_wrapper .dataTables_filter').attr('style', 'padding-right:12px')
}

function timeOneForm(id, Format, time_defaut) {
    // if (getCookieShared(document.URL + '#' + id) === undefined) {
    if (TimeOneTemplate === undefined) {
        $('#' + id).val(moment(new Date()).format(Format));
    } else {
        // $('#' + id).val(getCookieShared(document.URL + '#' + id));
        $('#' + id).val(TimeOneTemplate);
    }
}

function FormDateTempOneInput(Format, idForm) {
    let formDate = `<input type="text" id="${idForm}" data-validate="search" class="d-none input-sm form-control text-center input-datetimepicker p-1 custom-form-search" name="start" value=""></input>`;
    $('.page-body').append(formDate);
    if (TimeOneTemplate !== undefined) {
        $('#' + idForm).val(TimeOneTemplate);
    } else {
        TimeOneTemplate = moment(new Date()).format(Format);
        $('#' + idForm).val(moment(new Date()).format(Format));
    }
}

function FormDateTempFormTo(Format, idForm, idTo) {
    let formDateBetween = `<input type="text" id="${idForm}" data-validate="search" class="d-none input-sm form-control text-center input-datetimepicker p-1 custom-form-search" name="start" value="">
                            <input type="text" id="${idTo}" data-validate="search" class="d-none input-sm form-control text-center input-datetimepicker custom-form-search" name="end" value="">`;
    $('.page-body').append(formDateBetween);
    if (TimeFormTemplate !== undefined) {
        $('#' + idForm).val(TimeFormTemplate);
    } else {
        TimeFormTemplate = moment(Date()).subtract(1, 'days').format(Format);
        $('#' + idForm).val(moment(Date()).subtract(1, 'days').format(Format));
    }
    // if (getCookieShared(document.URL + '#' + idTo) !== undefined) {
    if (TimeToTemplate !== undefined) {
        $('#' + idTo).val(getCookieShared(document.URL + '#' + idTo));
        $('#' + idTo).val(TimeToTemplate);
    } else {
        // saveCookieShared(document.URL + '#' + idTo, );
        TimeToTemplate = moment(new Date()).format(Format);
        $('#' + idTo).val(moment(new Date()).format(Format));
    }
}

/**
 * Auth: Huynh Trong Hiep PxL
 * Title: add new row when create item with datatable
 * @param dt = DatatableTemplate
 * @param data = all column in row, except column DT_RowIndex
 */
function addRowDatatableTemplate(dt, data) {
    data.DT_RowIndex = dt.data().count() + 1;
    dt.row.add(data).draw(false);
    dt.page('last').draw(false);
    $(dt.table().node()).parent().scrollTop($(dt.table().node()).parent().get(0).scrollHeight);
    // drawDataValidate($(dt.table().node()));
}

/**
 * Auth:
 * Title: add new row when create item with datatable
 * @param dt = DatatableTemplate
 * @param row = Số dòng record muốn update
 * @param data = all column in row, except column DT_RowIndex
 */
function updateRowDatatableTemplate(dt, row ,data) {
    dt.row(row.parents('tr')).data(data);
}

/**
 * Auth: Huynh Trong Hiep PxL
 * Title: remove item of datatable
 * @param dt = DatatableTemplate
 * @param current = all column in row, except column DT_RowIndex
 * @param index true = draw index, false = not draw index
 */
async function removeRowDatatableTemplate(dt, current, index) {
    dt.row(current.parents('tr')).remove().draw(false);
    if (index) {
        await dt.rows().every(function (i, v) {
            let row = $(this.node());
            row.find('td:eq(0)').text(i + 1);
        });
        dt.draw(false);
    }
}

/**
 * Auth: Nguyễn Huy Dũng
 * Title: add all row dataTable
 * @param dtForm = DatatableTemplate
 * @param dtTo = DatatableTemplate
 * @param itemDrawTemplate = DatatableTemplate
 */
async function addAllRowDatatableTemplate(dtForm, dtTo, itemDrawTemplate) {
    $('#pre-loading-template').removeClass('d-none');
    let itemRow = [];
    await dtForm.rows({'search': 'applied'}).every(function () {
        let row = $(this.node());
        let item = itemDrawTemplate(row);
        item.DT_RowIndex = dtTo.data().count() + 1;
        itemRow.push(item);
    });
    dtTo.rows.add(itemRow).draw(false);
    await dtForm.rows({'search': 'applied'}).remove().draw(false);
    $('#pre-loading-template').addClass('d-none');
}


// Check link image dataTable
function checkLinkImg() {
    $("img").bind("error", function () {
        $(this).attr('src', '../images/techres_logo.jpg');
    });
}
