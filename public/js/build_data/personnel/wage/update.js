let idUpdateWageData, checkSaveUpdateWageData = 0, thisUpdateWageData,
    checkBasicSalary;

function openUpdateWageData(r) {
    thisUpdateWageData = r;
    idUpdateWageData = r.data('id');
    $('#levelsalary').val(r.data('level'));
    $('#exchangemoney').val(r.data('basic-salary'));
    $('#modal-update-wage-data').modal('show');
    shortcut.remove('F2');
    shortcut.add('ESC', function () {
        closeModalUpdateWageData();
    });
    shortcut.add('F4', function () {
        saveModalUpdateWageData();
    });
    checkBasicSalary = removeformatNumber(r.data('basic-salary'))
}

async function saveModalUpdateWageData() {
    if (checkSaveUpdateWageData === 1) return false;
    if (!checkValidateSave($("#modal-update-wage-data"))) return false;
    let level = $('#levelsalary').val(),
        salary = removeformatNumber($('#exchangemoney').val());
    let title = 'Bậc lương vừa chỉnh sửa sẽ bắt đầu áp dụng từ tháng tiếp theo !',
        content = '',
        icon = 'warning',
        text = '';
    if (checkBasicSalary !== Number(salary)) {
        sweetAlertComponent(title, content, icon).then(async (result) => {
            if (result.value) {
                checkSaveUpdateWageData = 1;
                let method = 'post',
                    url = 'wage-data.update',
                    params = null,
                    data = {
                        id: idUpdateWageData,
                        level: level,
                        basic_salary: salary,
                    };
                let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-update-wage-data')]);
                checkSaveUpdateWageData = 0;
                switch (res.data.status) {
                    case 200:
                        text = $('#success-update-data-to-server').text();
                        SuccessNotify(text)
                        closeModalUpdateWageData();
                        drawDataUpdateWageData(res.data.data);
                        break;
                    case 500:
                        text = $('#error-post-data-to-server').text();
                        if (res.data.message !== null) {
                            text = res.data.message;
                        }
                        WarningNotify(text);
                        break;
                    default:
                        text = $('#error-post-data-to-server').text();
                        if (res.data.message !== null) {
                            text = res.data.message;
                        }
                        WarningNotify(text);
                }
            }
        })
    } else {
        checkSaveUpdateWageData = 1;
        let method = 'post',
            url = 'wage-data.update',
            params = null,
            data = {
                id: idUpdateWageData,
                level: level,
                basic_salary: salary,
            };
        let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-update-wage-data')]);
        checkSaveUpdateWageData = 0;
        switch (res.data.status) {
            case 200:
                text = $('#success-update-data-to-server').text();
                SuccessNotify(text)
                closeModalUpdateWageData();
                shortcut.remove('F4');
                shortcut.remove('ESC');
                shortcut.add('F2', function (){
                    openModalCreateWageData()
                })
                drawDataUpdateWageData(res.data.data);
                break;
            case 500:
                text = $('#error-post-data-to-server').text();
                if (res.data.message !== null) {
                    text = res.data.message;
                }
                WarningNotify(text);
                break;
            default:
                text = $('#error-post-data-to-server').text();
                if (res.data.message !== null) {
                    text = res.data.message;
                }
                WarningNotify(text);
        }
    }
}

function drawDataUpdateWageData(data) {
    thisUpdateWageData.parents('tr').find('td:eq(1)').text(data.level);
    thisUpdateWageData.parents('tr').find('td:eq(2)').text(data.basic_salary);
    thisUpdateWageData.parents('tr').find('td:eq(3)').html(data.action);
    thisUpdateWageData.parents('tr').find('td:eq(3)').text(data.keysearch);
}

function closeModalUpdateWageData() {
    $('#modal-update-wage-data').modal('hide');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function (){
        openModalCreateWageData()
    })
    reloadModalUpdateWageData();
}

function reloadModalUpdateWageData() {
    $('#levelsalary').val(1)
    $('#exchangemoney').val(0)
}

