// /**
//  * Key: data-validate=""
//  * Value:
//  * - empty: k được rỗng
//  * - max-100: số tối đa là 100, tự động currency
//  * - min-10: số tối thiểu là 100 tự động currency
//  * -
//  */

// // add tag span notify error input
// // function addErrorInput(el, text) {
// //     // el.parent().parent().prepend('<span class="notify-valid text-center" id="error-input">' + text + '</span>');
// //     el.parent().removeClass('validate-error');
// //     el.parent().removeClass('focus-validate');
// //     el.parent().addClass('validate-error');
// //     el.parent().find('.error').remove();
// //     el.parent().prepend('<div class="error">' +
// //         '                        <span class="text-danger">'+ text +'</span>' +
// //         '                    </div>');
// // }



// // add tag span notify error input
// function addErrorTexeArea(el, text) {
//     // el.parent().parent().prepend('<span class="notify-valid text-center" id="error-input">' + text + '</span>');
//     el.parent().removeClass('validate-error');
//     el.parent().removeClass('focus-validate');
//     el.parent().addClass('validate-error');
//     el.parent().parent().prepend('<div class="error">' +
//         '                        <span class="text-danger">'+ text +'</span>' +
//         '                    </div>');
// }



// //
// function addWarningInput(el, text) {
//     // el.parent().parent().prepend('<span class="notify-valid text-center" id="error-input">' + text + '</span>');
//     el.parent().find('.error').remove();
//     el.parent().removeClass('warning-error mb-5');
//     el.parent().removeClass('focus-validate');
//     el.parent().removeClass('validate-error');
//     el.parent().addClass('warning-error mb-5');
//     el.parent().prepend('<div class="error">' +
//         '                        <span class="text-danger">'+ text +'</span>' +
//         '                    </div>');
//     warningTimeOut(el);
// }


// //add tag span notify error input on left
// // function addErrorInputLeft(el, text) {
// //     el.parent().parent().prepend('<span class="notify-valid-left text-center" id="error-input">' + text + '</span>');
// // }
// //
// // // add tag span notify error input in table1
// // function addErrorInputTable(el, text) {
// //     el.parent().prepend('<span class="notify-valid-bottom text-center" id="error-input-table">' + text + '</span>');
// // }

// // add tag span notify error select
// function addSpanSelect(el, text) {
//     el.parent().prepend('<span class="notify-valid text-center" id="error-select">' + text + '</span>');
// }

// // add tag span when hover button
// function addTooltip(el, text) {
//     el.parent().prepend('<span class="custom-tooltip text-center" id="custom-tooltip">' + text + '</span>');
// }

// // Add class position relative to tag span not go out from the table
// function addPosition(el) {
//     el.parent().addClass('positionRelative');
// }

// // Remove tag span notify input
// function removeErrorInput(el) {
//     // el.closest('div').parent().children('span').remove();
//     // el.parent().removeClass('validate-focus');
//     el.parent().removeClass('validate-error');
//     // el.parent().find('.error').remove();
// }

// // Remove tag span notify the table
// function removeErrorInputTable(el) {
//     el.parent().find("#error-input-table").remove();
// }

// // Remove tag span notify select
// function removeSpanSelect(el) {
//     el.parent().find("#error-select").remove();
// }

// // Remove tag span hover button
// function removeTooltip(el) {
//     el.parent().find("#custom-tooltip").remove();
// }

// // Remove class position relative
// function removePosition(el) {
//     el.parent().removeClass('positionRelative');
// }
// $(document).ready(function (){

//     // Sinh ra textarea


//     $('input[data-date]').each(function (i, v) {
//         $(this).parent().html('' +
//             '<div class="input-group border-group">' + $(this).parents().html() + '</div>');
//         $('input[data-date]').parent().find('span').addClass('custom-find');
//         $('input[data-date]').addClass('custom-form-search');
//         $('input[data-date]').parent().find('button').addClass('custom-button-search');
//     })

// })

// // Remove all
// function removeAllValidate() {
//     $('select').prop('selectIndex', 0);
//     $('select').parent().removeClass('validate-error');
//     $('input').parent().removeClass('validate-error');
//     removeErrorInput($('input'));
//     removeErrorInput($('textarea'));
//     removeErrorInputTable($('input'));
//     removeSpanSelect($('select'));
//     $('input').parent().find('.error').remove();
//     $('textarea').parent().find('.error').remove();
// }

$(function (){
    $('#upload-file-KDB').on('change', async function (){
        let data = await uploadMediaTemplate($(this).prop('files')[0], 4);
        $('#link1').attr('href', data.data[2] + data.data[0]);
        $(this).replaceWith($(this).val('').clone(true));
    })

    $('#upload-file-DB').on('change', async function (){
        let data = await uploadAsyncMediaTemplate($(this).prop('files')[0], 4);
        $('#link2').attr('href', data.data[2] + data.data[0]);
        $(this).replaceWith($(this).val('').clone(true));
    })
})




