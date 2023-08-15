// $(document).ready(function (){
//     $('input[type=checkbox]').each(function (){
//         if($(this).parents('.validate-group').length === 0) {
//
//             let tooltip = '';
//             $(this).parents('.form-group').addClass('validate-group');
//             $(this).parents('.form-group').removeClass('row');
//             $(this).prop('required', true);
//             if ($(this).attr('data-tooltip')) {
//                 tooltip = '<div class="tool-tip">     ' +
//                     '<i class="fa fa-exclamation-circle text-inverse pointer" data-toggle="tooltip" data-placement="top" data-original-title="' + $(this).data('original-title') + '"></i>' +
//                     '</div>';
//             }
//             $(this).parents('.form-group').html(`<div class="form-validate-checkbox">
//                                                      <i class="icofont icofont-disc"></i>
//                                                         ${$(this).parents(".checkbox-zoom").parent().html()}
//                                                      <label for=" $(this).attr(id) ">
//                                                         <i  class="icofont  $(this).attr(data-icon) "></i>
//                                                         ${$(this).parents(".form-group").find(".col-form-label").html()}
//                                                      </label>
//                                                      <div class="line"></div>
//                                                         ${tooltip}
//                                                  </div>`)
//         }
//     })
// })
//
