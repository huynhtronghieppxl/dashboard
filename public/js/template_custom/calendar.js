// $(function (){
//     $(document).on('dp.change', '.class-date-to-validate', function (){
//         let formatDate = $(this).parents('.class-date-from-to-validate').data('format');
//         console.log(moment($(this).val(), formatDate).format('x'));
//
//         // if($(this).val())
//     });
// })

/**
 * @param before HH:mm
 * @param after HH:MM
 * return total minutes before - after, after - before
 */

function calculateHourMinute(before, after) {
    if (before === '' || after === '') {
        return 0;
    } else {
        let hour_before = before.slice(0, 2),
            minute_before = before.slice(3, 5),
            hour_after = after.slice(0, 2),
            minute_after = after.slice(3, 5);

        let cal_minute = minute_after - minute_before;
        let cal_hour = hour_after - hour_before;
        let time = cal_hour * 60 + cal_minute;
        if (time < 0) {
            time = 0;
        }
        return time;
    }
}

/**
 * date time picker
 */
function dateTimePickerDayTemplate(element) {
    let maxDate = moment().add(1, 'seconds').toDate();
    let date_default = moment().format('MM/DD/YYYY');
    element.datetimepicker({
        defaultDate: date_default,
        format: 'DD',
        locale: 'vi',
        icons: {
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        }
    });
    element.on("dp.change", function (e) {
        if ($(this).val() === '') {
            $(this).val(moment().format('DD'));
        }
    });
}


function dateTimePickerDayMonthTemplate(element) {
    element.datetimepicker({
        format: 'DD/MM',
        locale: 'vi',
        minDate: moment().format('YYYY/01/01/'),
        maxDate: moment().format('YYYY/12/31/'),
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left",
        }
    });
    element.on("dp.change", function (e) {
        if ($(this).val() === '') {
            $(this).val(moment().format('DD/MM'));
        }
    });
}


function dateTimePickerTemplate(element, minDate, maxDate) {
    /**
     * kiểm tra cookie có chưa
     * nếu chưa có, lưu value của element vào cookie
     * tạo 1 event onready, nếu class thay đổi => có đc id của thằng thay đổi => có đc key cookie => update được value cho cookie
     */

    /**
     * nếu cookie đã có rồi
     * element.value = cookie.value
     */
    /**
     * minDate = moment() or new Date()
     * maxDate = moment() or new Date()
     */
    if (minDate === '' || minDate === null) {
        minDate = moment('01/01/1900').format('MM/DD/YYYY')
    }
    let date_default = moment().format('MM/DD/YYYY');
    element.datetimepicker({
        useCurrent: false,
        format: 'DD/MM/YYYY',
        locale: 'vi',
        defaultDate: date_default,
        minDate: minDate,
        maxDate: maxDate,
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left",

        },
    });
    element.on("dp.change", function (e) {
        if ($(this).val() === '') {
            $(this).val(moment().format('DD/MM/YYYY'));
        }
    });


    element.on("dp.hide", function (e){
        if ($(this).val() === '') {
            $(this).val(moment().format('DD/MM/YYYY'));
        }
    })
}

function dateTimePickerWidgetTopTemplate(element) {
    let date_default = moment().format('MM/DD/YYYY');
    element.datetimepicker({
        useCurrent: false,
        format: 'DD/MM/YYYY',
        locale: 'vi',
        defaultDate: date_default,
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left",

        },
        widgetPositioning: {
            horizontal: 'left',
            vertical: 'top'
        }
    });
    element.on("dp.change", function (e) {
        if ($(this).val() === '') {
            $(this).val(moment().format('DD/MM/YYYY'));
        }
    });


    element.on("dp.hide", function (e){
        if ($(this).val() === '') {
            $(this).val(moment().format('DD/MM/YYYY'));
        }
    })
}

function dateTimePickerTemplateNotPassDayCurrent(element, minDate, maxDate) {
    /**
     * kiểm tra cookie có chưa
     * nếu chưa có, lưu value của element vào cookie
     * tạo 1 event onready, nếu class thay đổi => có đc id của thằng thay đổi => có đc key cookie => update được value cho cookie
     */

    /**
     * nếu cookie đã có rồi
     * element.value = cookie.value
     */
    /**
     * minDate = moment() or new Date()
     * maxDate = moment() or new Date()
     */
    if (minDate === '' || minDate === null) {
        minDate = moment().format('MM/DD/YYYY')
    }
    let date_default = moment().format('MM/DD/YYYY');
    element.datetimepicker({
        useCurrent: false,
        format: 'DD/MM/YYYY',
        locale: 'vi',
        defaultDate: date_default,
        minDate: minDate,
        maxDate: maxDate,
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left",

        }
    });
    element.on("dp.change", function (e) {
        if ($(this).val() === '') {
            $(this).val(moment().format('DD/MM/YYYY'));
        }
    });


    element.on("dp.hide", function (e){
        if ($(this).val() === '') {
            $(this).val(moment().format('DD/MM/YYYY'));
        }
    })
}

function dateTimePickerNotWillTemplate(element) {
    let date_default = moment().format('MM/DD/YYYY');
    element.datetimepicker({
        useCurrent: false,
        defaultDate: date_default,
        format: 'DD/MM/Y',
        locale: 'vi',
        // minDate: new Date(),
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left",
        }
    });
    element.on("dp.change", function (e) {
        if ($(this).val() === '') {
            $(this).val(moment().format('DD/MM/YYYY'));
        }
    });
}

function dateTimePickerNotWillMinDateTemplate(element, minDate) {
    // let date_default = moment().format('MM/DD/YYYY');
    element.datetimepicker({
        useCurrent: false,
        defaultDate: new Date(),
        format: 'DD/MM/Y',
        locale: 'vi',
        minDate: new Date(),
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left",

        },
        widgetPositioning: {
            horizontal: 'right',
            vertical: 'top'
        },
    });
    element.on("dp.change", function (e) {
        if ($(this).val() === '') {
            $(this).val(moment().format('DD/MM/YYYY'));
        }
    });
}

function dateTimePickerNormalTemplate(element,element1) {
    let date_default = moment().format('MM/DD/YYYY');
    element.datetimepicker({
        defaultDate: date_default,
        format: 'DD/MM/Y',
        locale: 'vi',
        minDate:element1,
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left",

        }
    });
    element.on("dp.change", function (e) {
        if ($(this).val() === '') {
            $(this).val(moment().format('DD/MM/YYYY'));
        }
    });
}

function dateTimePickerMinDateToDayTemplate(element) {
    let date_default = moment().format('MM/DD/YYYY');
    element.datetimepicker({
        defaultDate: date_default,
        format: 'DD/MM/Y',
        locale: 'vi',
        minDate:date_default,
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left",

        }
    });
    element.on("dp.change", function (e) {
        if ($(this).val() === '') {
            $(this).val(moment().format('DD/MM/YYYY'));
        }
    });
}

function dateTimePickerFomartTemplate(element) {
    let date_default = moment().format('MM/DD/YYYY');
    element.datetimepicker({
        defaultDate: date_default,
        useCurrent: false,
        format: 'DD/MM/YYYY',
        locale: 'vi',
        maxDate: new Date(),
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left",
        }
    });
    element.on("dp.change", function (e) {
        if ($(this).val() === '') {
            $(this).val(moment().format('DD/MM/YYYY'));
        }
    });
}

function dateTimePickerMonthYearTemplate(element) {
    let date_default = moment().format('MM/DD/YYYY');
    element.datetimepicker({
        defaultDate: date_default,
        format: 'MM/Y',
        locale: 'vi',
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left"
        }
    });
    element.on("dp.change", function (e) {
        if ($(this).val() === '') {
            $(this).val(moment().format('MM/YYYY'));
        }
    });
}

function dateTimePickerFromToMonthTemplate(element, element1) {
    let date_default = moment().format('MM/DD/YYYY');
    element.datetimepicker({
        defaultDate: date_default,
        format: 'MM/Y',
        locale: 'vi',
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left"
        }
    });
    element1.datetimepicker({
        defaultDate: date_default,
        format: 'MM/Y',
        locale: 'vi',
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left"
        }
    });
    element.on("dp.change", function (e) {
        if ($(this).val() === '') {
            $(this).val(moment().format('MM/YYYY'));
        }
        element1.data("DateTimePicker").minDate(element.val());

    });
    element1.on("dp.change", function (e) {
        if ($(this).val() === '') {
            $(this).val(moment().format('MM/YYYY'));
        }
        element.data("DateTimePicker").maxDate(element1.val());
    });
}

function dateTimePickerFromToYearTemplate(element, element1) {
    let date_default = moment().format('MM/DD/YYYY');
    element.datetimepicker({
        defaultDate: date_default,
        format: 'Y',
        locale: 'vi',
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left"
        }
    });
    element1.datetimepicker({
        defaultDate: date_default,
        format: 'Y',
        locale: 'vi',
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left"
        }
    });
    element.on("dp.change", function (e) {
        if ($(this).val() === '') {
            $(this).val(moment().format('YYYY'));
        }
        element1.data("DateTimePicker").minDate(element.val());

    });
    element1.on("dp.change", function (e) {
        if ($(this).val() === '') {
            $(this).val(moment().format('YYYY'));
        }
        element.data("DateTimePicker").maxDate(element1.val());
    });
}

function dateTimePickerYearTemplate(element) {
    let date_default = moment().format('MM/DD/YYYY');
    element.datetimepicker({
        defaultDate: date_default,
        format: 'YYYY',
        locale: 'vi',
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left"
        }
    });
    element.on("dp.change", function (e) {
        if ($(this).val() === '') {
            $(this).val(moment().format('YYYY'));
        }
    });
}

function validateHourTemplate(from, to) {
    if(moment(from.val(), 'HH:mm').isSameOrAfter(moment(to.val(), 'HH:mm'))) {
        WarningNotify('Giờ bắt đầu phải nhỏ hơn giờ kết thúc');
        return 1;
    }
}

function CheckDateFormTo(from, to) {
    let flag = true;
    const startDate = moment(from, 'DD-MM-YYYY'),
        endDate = moment(to, 'DD-MM-YYYY');
    if (startDate.isAfter(endDate)) {
        WarningNotify('Thời gian bắt đầu phải bé hơn kết thúc');
        flag = false;
    }
    return flag;
}

function CheckDateFormToCustom(from, to, type) {
    let flag = true;
    let startDate, endDate;
    switch (type) {
        case 13:
            startDate = moment(from, 'DD-MM-YYYY');
            endDate = moment(to, 'DD-MM-YYYY');
            break;
        case 15:
            startDate = moment(from, 'MM-YYYY');
            endDate = moment(to, 'MM-YYYY');
            break;
        case 16:
            startDate = moment(from, 'YYYY');
            endDate = moment(to, 'YYYY');
            break;
    }
    if (startDate.isAfter(endDate)) {
        WarningNotify('Thời gian bắt đầu phải bé hơn kết thúc');
        flag = false;
    }
    return flag;
}

function dateTimePickerHourMinuteTemplate(element) {

    if (element.val() === '' || element.val() === null) {
        element.val(moment().format('HH:mm'));
    }

    element.datetimepicker({
        format: 'HH:mm',
        locale: 'vi',
        icons: {
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        }
    });
    element.on("dp.change", function (e) {
        if ($(this).val() === '') {
            $(this).val(moment().format('HH:mm'));
        }
    });
}

function dateTimePickerHourTemplate(element) {
    element.datetimepicker({
        format: 'HH',
        locale: 'vi',
        icons: {
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        }
    });
    element.on("dp.change", function (e) {
        if ($(this).val() === '') {
            $(this).val(moment().format('HH'));
        }
    });
}

function dateFullTimePickerTemplate(element) {
    element.datetimepicker({
        format: 'HH:mm',
        locale: 'vi',
        icons: {
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        }
    });
    element.on("dp.change", function (e) {
        if ($(this).val() === '') {
            $(this).val(moment().format('HH:mm'));
        }
    });
}


function dateTimePickerFromToDate(element, element1) {
    // if(element.data("datepicker") != null){
    //     console.log(1);
    //     element.datetimepicker('destroy');
    // }
    // if(element.data("datepicker") != null){
    //     console.log(2);
    //     element1.datetimepicker('destroy');
    // }
    element.datetimepicker({
        format: 'DD/MM/YYYY',
        locale: 'vi',
        useCurrent: true,
        maxDate: element1,
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left",
        }
    });

    element1.datetimepicker({
        format: 'DD/MM/YYYY',
        locale: 'vi',
        useCurrent: false,
        minDate: element.data("DateTimePicker").date(),
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left",
        }
    });

    element.on("dp.change", function (e) {
        if ($(this).val() === '') {
            $(this).val(moment(new Date).format('DD/MM/YYYY'));
        } else {
            element1.data("DateTimePicker").minDate(e.date);
            $(this).val($(this).val())
        }
    });


    element1.on("dp.change", function (e) {
        console.log($(this).val());
        if ($(this).val() === '') {
            $(this).data("DateTimePicker").date(new Date());
        }
        element.data("DateTimePicker").maxDate(e.date);
    });

}

function validateDateTemplate2(from, to, text, type) {
    switch (parseInt(type)){
        case 1:
            if (moment(from.val(), 'DD/MM/YYYY').clone().format('x') > moment(to.val(), 'DD/MM/YYYY').clone().format('x')) {
                WarningNotify(text);
                return 1;
            }
            break;
        case 2:
            if (moment(from.val(), 'HH:mm').clone().format('x') >= moment(to.val(), 'HH:mm').clone().format('x')) {
                WarningNotify(text);
                return 1;
            }
            break;
        default:
            console.log('Error validate date');
            return 1;
    }
}

function dateTimePickerNotWillFromToDate(element, element1) {
    element.datetimepicker({
        format: 'DD/MM/YYYY',
        locale: 'vi',
        useCurrent: true,
        minDate: $(this).val(moment(new Date).format('DD/MM/YYYY')),
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left",
        }
    });

    element1.datetimepicker({
        format: 'DD/MM/YYYY',
        locale: 'vi',
        // useCurrent: false,
        minDate: element.data("DateTimePicker").date(),
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left",
        }
    });

    element.on("dp.change", function (e) {
        if ($(this).val() === '') {
            $(this).val(moment(new Date).format('DD/MM/YYYY'));
        } else {
            element1.data("DateTimePicker").minDate(e.date);
            $(this).val($(this).val())
        }
    });

    element1.on("dp.change", function (e) {
        if ($(this).val() === '') {
            // $(this).val(moment(new Date).format('DD/MM/YYYY'));
            $(this).data("DateTimePicker").date(new Date());

        }
        element.data("DateTimePicker").maxDate(e.date);
    });
    element1.on("dp.hide", function (e) {
        if ($(this).val() === '') {
            $(this).data("DateTimePicker").date(new Date());
        }
    });
}

function dateTimeMinMaxFromToDate(element, element1, minDate, maxDate) {
    element.datetimepicker({
        format: 'DD/MM/YYYY',
        locale: 'vi',
        useCurrent: false,
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left",
        }
    });

    element1.datetimepicker({
        useCurrent: false,
        format: 'DD/MM/YYYY',
        locale: 'vi',
        minDate: minDate,
        maxDate: maxDate,
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left",

        }
    });


    element.on("dp.change", function (e) {
        if ($(this).val() === '') {
            $(this).data("DateTimePicker").date(new Date());
        } else {
            element1.data("DateTimePicker").minDate(e.date);
        }
    });


    element1.on("dp.change", function (e) {
        if ($(this).val() === '') {
            $(this).val(moment(new Date).format('DD/MM/YYYY'));
        }
    });

}


function dateTimePickerFromToMinMaxDate(element, element1) {
    element.datetimepicker({
        format: 'DD/MM/YYYY',
        locale: 'vi',
        useCurrent: false,
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left",
        }
    });

    element1.datetimepicker({
        format: 'DD/MM/YYYY',
        locale: 'vi',
        useCurrent: false,
        minDate: element.data("DateTimePicker").date(),
        maxDate:  new Date(),
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left",
        }
    });

    element.on("dp.change", function (e) {
        if ($(this).val() === '') {
            $(this).val(moment(new Date).format('DD/MM/YYYY'));
        } else {
            element1.data("DateTimePicker").minDate(e.date);
        }
    });


    element1.on("dp.change", function (e) {
        if ($(this).val() === '') {
            $(this).data("DateTimePicker").date(new Date());
        }
        element.data("DateTimePicker").maxDate(e.date);
    });

}

function dateTimePickerFromMaxToDate(element, element1) {
    if(element.data("datepicker") != null){
        element.datetimepicker('destroy');
    }

    if(element.data("datepicker") != null){
        element1.datetimepicker('destroy');
    }

    element.datetimepicker({
        format: 'DD/MM/YYYY',
        locale: 'vi',
        useCurrent: false,
        // maxDate: element1,
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left",
        }
    });

    element1.datetimepicker({
        format: 'DD/MM/YYYY',
        locale: 'vi',
        useCurrent: false,
        // minDate: element.data("DateTimePicker").date(),
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left",
        }
    });

    element.on("dp.change", function (e) {
        if ($(this).val() === '') {
            $(this).data("DateTimePicker").date(new Date());
        }
    });

    element1.on("dp.change", function (e) {
        if ($(this).val() === '') {
            $(this).data("DateTimePicker").date(new Date());
        }
    });

    element.on("dp.hide", function (e) {
        if ($(this).val() === '') {
            $(this).data("DateTimePicker").date(new Date());
        }
    });

    element1.on("dp.hide", function (e) {
        if ($(this).val() === '') {
            $(this).data("DateTimePicker").date(new Date());
        }
    });
}

function dateTimePickerFromToDateTemplate2(element, element1) {
    element.datetimepicker({
        format: 'DD/MM/YYYY',
        useCurrent: true,
        locale: 'vi',
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left"
        }
    });
    element1.datetimepicker({
        format: 'DD/MM/YYYY',
        useCurrent: true,
        locale: 'vi',
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left"
        }
    });

    element.data("DateTimePicker").maxDate(moment(element1.val(), "DD/MM/YYYY"));
    element1.data("DateTimePicker").minDate(moment(element.val(), "DD/MM/YYYY"));

    element.on("dp.change", function (e) {
        if (!$(this).val()) {
            $(this).val(moment().format('DD/MM/YYYY'));
        }
        element1.data("DateTimePicker").minDate(moment(element.val(), "DD/MM/YYYY"));

    });

    element1.on("dp.change", function (e) {
        if (!$(this).val()) {
            $(this).val(moment().format('DD/MM/YYYY'));
        }
        element.data("DateTimePicker").maxDate(moment(element1.val(), "DD/MM/YYYY"));
    });
}

function dateTimePickerFromToMonthTemplate2(element, element1) {
    element.datetimepicker({
        format: 'MM/Y',
        useCurrent: true,
        locale: 'vi',
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left"
        }
    });
    element1.datetimepicker({
        format: 'MM/Y',
        useCurrent: true,
        locale: 'vi',
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left"
        }
    });

    element.data("DateTimePicker").maxDate(moment(element1.val(), "MM-YYYY"));
    element1.data("DateTimePicker").minDate(moment(element.val(), "MM-YYYY"));

    element.on("dp.change", function (e) {
        if (!$(this).val()) {
            $(this).val(moment().format('MM/YYYY'));
        }
        element1.data("DateTimePicker").minDate(moment(element.val(), "MM/YYYY"));

    });

    element1.on("dp.change", function (e) {
        if (!$(this).val()) {
            $(this).val(moment().format('MM/YYYY'));
        }
        element.data("DateTimePicker").maxDate(moment(element1.val(), "MM/YYYY"));
    });
}

function dateTimePickerFromToYearTemplate2(element, element1) {
    element.datetimepicker({
        format: 'Y',
        useCurrent: true,
        locale: 'vi',
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left"
        }
    });
    element1.datetimepicker({
        format: 'Y',
        useCurrent: true,
        locale: 'vi',
        icons: {
            next: "icofont icofont-rounded-right",
            previous: "icofont icofont-rounded-left"
        }
    });

    element.data("DateTimePicker").maxDate(moment(element1.val(), "YYYY"));
    element1.data("DateTimePicker").minDate(moment(element.val(), "YYYY"));

    element.on("dp.change", function (e) {
        if (!$(this).val()) {
            $(this).val(moment().format('YYYY'));
        }
        element1.data("DateTimePicker").minDate(moment(element.val(), "YYYY"));

    });

    element1.on("dp.change", function (e) {
        if (!$(this).val()) {
            $(this).val(moment().format('YYYY'));
        }
        element.data("DateTimePicker").maxDate(moment(element1.val(), "YYYY"));
    });
}
