  'use strict';
  $(document).ready(function() {

      // $('#date,#datejoin').bootstrapMaterialDatePicker({
      //        time: false,
      //        clearButton: true
      //    });
      //  $("#example-date-inputS").bootstrapMaterialDatePicker({
      //                time: false,
      //                clearButton: true
      //            });

      $("#basic-forms").steps({
          headerTag: "h3",
          bodyTag: "fieldset",
          transitionEffect: "slideLeft",
          autoFocus: true
      });
      $("#verticle-wizard").steps({
          headerTag: "h3",
          bodyTag: "fieldset",
          transitionEffect: "slide",
          stepsOrientation: "vertical",
          autoFocus: true
      });

      $("#design-wizard").steps({
          headerTag: "h3",
          // bodyTag: "fieldset",
          bodyTag: "fieldset",
          transitionEffect: "slideLeft",
          autoFocus: true
      });





      var form = $("#example-advanced-form").show();

      form.steps({
          headerTag: "h3",
          bodyTag: "fieldset",
          transitionEffect: "slideLeft",
          stepsOrientation: "vertical",
          autoFocus: true,
          onStepChanging: function(event, currentIndex, newIndex) {

              // Allways allow previous action even if the current form is not valid!
              if (currentIndex > newIndex) {
                  return true;
              }
              // Forbid next action on "Warning" step if the user is to young
              if (newIndex === 3 /*&& Number($("#age-2").val()) < 18*/) {
                  return false;
              }
              // Needed in some cases if the user went back (clean up)
              if (currentIndex < newIndex) {
                  // To remove error styles
                  form.find(".body:eq(" + newIndex + ") label.error").remove();
                  form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
              }
              form.validate().settings.ignore = ":disabled,:hidden";
              return form.valid();
          },
          onStepChanged: function(event, currentIndex, priorIndex) {

              // Used to skip the "Warning" step if the user is old enough.
              if (currentIndex === 2/* && Number($("#age-2").val()) >= 18*/) {
                  form.steps("next");
              }
              // Used to skip the "Warning" step if the user is old enough and wants to the previous step.
              if (currentIndex === 2 && priorIndex === 3) {
                  form.steps("previous");
              }
          },
          onFinishing: function(event, currentIndex) {

              form.validate().settings.ignore = ":disabled";
              return form.valid();
          },
          onFinished: function(event, currentIndex) {
              alert("Submitted!");
              $('#wizard2').remove();
              
              $('#facebook').append('<div id="fb-root"></div> '+
          '<div class="fb-login-button" data-size="large" data-button-type="continue_with" data-layout="rounded"'+
          'data-auto-logout-link="false" data-use-continue-as="false" data-width="" onlogin="checkLoginState();"></div>');

          }
      })/*.validate({
          errorPlacement: function errorPlacement(error, element) {

              element.before(error);
          },
          rules: {
              confirm: {
                  equalTo: "#password-2"
              }
          }
      })*/;
  });
