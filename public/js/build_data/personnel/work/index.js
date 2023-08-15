let tableNameWorkData, selectRoleWorkData = "", checkSaveWorkData = 0 , dataListWordExcel;
$(function () {
    if(getCookieShared('work-data-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('work-data-user-id-' + idSession));
        selectRoleWorkData = dataCookie.select;
    }
    $('#modal-excel-work').unbind('shown.bs.modal').on('shown.bs.modal', function () {
        tableNameWorkData.columns.adjust().draw();
    });
    $('#select-role-work-data-employee').on('select2:select', function () {
        selectRoleWorkData = $(this).val()
        dataSelectCategoryWorkData();
        dataWorkData();
        updateCookieWorkData()
    });
    loadData();

});

function updateCookieWorkData(){
    saveCookieShared('work-data-user-id-' + idSession, JSON.stringify({
        'select' : selectRoleWorkData,
    }))
}

function eventWorkData() {
    $('#data-work-data .fa-square').unbind('click').on('click', function () {
        $('#button-service-3').removeClass('d-warning');
        $(this).parents('.sortable-moves').removeClass('work-not-active');
        $(this).parents('.sortable-moves').addClass('work-active');
        $(this).removeClass('fa-square');
        $(this).addClass('fa-check-square');
        $(this).attr('data-original-title', 'Đang hoạt động')
        eventWorkData();
    });
    $('#data-work-data .fa-check-square').unbind('click').on('click', function () {
        $('#button-service-3').removeClass('d-warning');
        $(this).parents('.sortable-moves').removeClass('work-active');
        $(this).parents('.sortable-moves').addClass('work-not-active');
        $(this).removeClass('fa-check-square');
        $(this).addClass('fa-square');
        $(this).attr('data-original-title', 'Không hoạt động')
        eventWorkData();
    });
    eventCheckOpenSaveWorkData();
}

function eventCheckOpenSaveWorkData() {
    $('#data-work-data .sortable-moves span i.class-check-open-save').each(function (i, v) {
        if (!$(this).hasClass($(this).data('check'))) {
            $('#button-service-3').removeClass('d-warning');
            return false;
        }
    });
}

async function loadData() {
    if ($('#button-service-3').hasClass('d-warning') === false) {
        let title = 'Cảnh báo ?',
            content = 'Sự thay đổi chưa được lưu lại, làm mới sẽ mất dữ liệu đã thay đổi !',
            icon = 'warning';
        sweetAlertComponent(title, content, icon).then(async (result) => {
            if (result.value) {
                await dataRoleWorkData();
                dataSelectCategoryWorkData();
                dataWorkData();
            }
        });
    } else {
        await dataRoleWorkData();
        dataSelectCategoryWorkData();
        dataWorkData();
    }
}

async function dataRoleWorkData() {
    let method = 'get',
        url = 'work-data.data-role',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#select-role-work-data-employee')]);
    $('#select-role-work-data-employee').html(res.data[0]);
    if(selectRoleWorkData === '') return false;
    $('#select-role-work-data-employee').val(selectRoleWorkData).trigger('change.select2')
}

async function dataSelectCategoryWorkData() {
    let method = 'get',
        url = 'work-data.data-category',
        params = {
            role: $('#select-role-work-data-employee').val(),
            brand: $('.select-brand').val(),
        },

        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#category-create-work-data')
    ]);
    countItemInSelectCategoryWorkData = $('#category-create-work-data option').length;
    $('#category-create-work-data').html(res.data[0]);
    $('#category-update-work-data').html(res.data[0]);
}

async function dataWorkData() {
    let method = 'get',
        url = 'work-data.data',
        brand = $('.select-brand').val(),
        role = $('#select-role-work-data-employee').val(),
        params = {brand: brand, role: role},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#data-work-data')]);
    $('#button-service-3').addClass('d-warning')
    await $('#data-work-data').html(res.data[0]);
    dataListWordExcel = res.data[2];
    eventWorkData();
    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover'
    });
    res.data[1].forEach(function (i) {
        Sortable.create(document.getElementById(i), {
            group: i,
            animation: 150
        });
        $("#" + i).sortable({
            update: function () {
                $('#' + i + ' .sortable-moves').each(function (i2, v2) {
                    $(v2).find('button').text(i2 + 1);
                });
                $('#button-service-3').removeClass('d-warning');
            }
        });
    })
    if ($('#data-work-data').text() === '') {
        $('#data-work-data').append(`<div class="empty-datatable-custom row col-12 w-100 justify-content-center" style="width: 200px ; text-align: center;"><img style="width: 200px" src="../../../../images/tms/empty.png"></div>`);
    }

}


async function saveSortWorkData() {
    if(checkSaveWorkData === 1) return false;
    let sort = [];
    $('.sortable-moves').each(function (i, v) {
        let status = 0;
        if ($(v).find('.fa-check-square').length === 1) status = 1;
        sort.push({
            'id': $(v).find('.fa-pencil-square').data('id'),
            'sort': i,
            'status': status,
        });
    });
    checkSaveWorkData = 1;
    let method = 'post',
        url = 'work-data.sort',
        params = null,
        data = {sort: sort};
    let res = await axiosTemplate(method, url, params, data, [$('#data-work-data')]);
    checkSaveWorkData = 0;
    if (res.data.status === 200) {
        let text = $('#success-upload-data-to-server').text();
        SuccessNotify(text);
        $('#button-service-3').addClass('d-warning');
        loadData();
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
    }
}

function changeActive() {
    let flag = 0;
    $('.ui-sortable-handle i:not(:first-child)').each(function () {
        if ($(this).hasClass($(this).data('check'))) {
            flag = 0
        } else {
            flag = 1
        }
    })

    if (flag == 1) {
        //hien
        $('#button-service-3').removeClass('d-warning');
        $(this).removeClass('fa-square');
        $(this).addClass('fa-check-square');
    } else {
        //an
        $('#button-service-3').addClass('d-warning');
        $(this).addClass('fa-square');
        $(this).removeClass('fa-check-square');
    }
}

async function ExportExcelWord(){
    $('#table_export_work tbody').html('');
        if (dataListWordExcel.length === 0) {
        WarningNotify('Dữ liệu rỗng !!!');
        return false;
    }
    for await(const [i, v] of dataListWordExcel.entries()) {
        $('#table_export_work tbody').append(`<tr>
                <td class="border-td-excel" style="width:100px;text-align: left; align-content:center; vertical-align:middle;  ">${v.employee_job_category_name}</td>
                <td class="border-td-excel" style="width:50px;text-align: center; align-content:center; vertical-align:middle ;  ">${i + 1}</td>
                <td class="border-td-excel" style="width:350px;text-align: left ; align-content:center; vertical-align:middle ;  ">${v.content}</td>
                <td class="border-td-excel" style="text-align: left ; align-content:center; vertical-align:middle ;  ">${v.description}</td>
                <td class="border-td-excel" style="text-align: center ; align-content:center; vertical-align:middle ; ">${formatNumber(v.base_point)}</td>`)
    }
    MergeCommonRows($('#table_export_work'), [1])
    exportExcelTableTemplate($('#table_export_work'), 'DANH SÁCH CÔNG VIỆC')
}

function MergeCommonRows(table, rowGroup) {
    let firstColumnBrakes = rowGroup;
    for(let i=1 ; i<=table.find('th').length; i++){
        let previous = null, cellToExtend = null, rowspan = 1;
        table.find("tbody td:nth-child(" + i + ")").each(function(index, e){
            let jthis = $(this), content = jthis.text();
            if (previous == content && content !== "" && jQuery.inArray(i, firstColumnBrakes) !== -1) {
                jthis.addClass('hidden');
                cellToExtend.attr("rowspan", (rowspan = rowspan+1));
            }else{
                // store row breaks only for the first column:
                if(i === 1) firstColumnBrakes.push(index);
                rowspan = 1;
                previous = content;
                cellToExtend = jthis;
            }
        });
    }
    $('td.hidden').remove();
}



