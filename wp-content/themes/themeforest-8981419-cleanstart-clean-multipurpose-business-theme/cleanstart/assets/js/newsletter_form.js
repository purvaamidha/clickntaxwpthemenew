/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M               (c) 2014-2015

File Description: MailChimp Form - Front End

*/
(function($){

  "use strict";

   $(document).ready( function() {

      var newsletterResponse = $("#newsletterResponse");

      $(".newsletter_form_button").click( function(e) {
         var _this = $(this);
             _this.addClass("blinking");
         newsletterResponse.addClass('hidden');
         e.preventDefault();
         var action    = $("#newsletter").attr('action');
         var email     = $("#email").val();
         var firstname = $("#first_name").val();
         var surname   = $("#last_name").val();
         var nonce     = $("#nonce").val();

         if ( email === '' || !email.match(/^\S+@\S+\.\S{2,}$/) ){
           _this.removeClass("blinking");
           newsletterResponse
                .text( newsletter_form_strings.invalid_email )
                .removeClass("hidden")
                .addClass("btn-danger");
           $("#newsletter #email").blur();
            console.log('Error: Invalid Email Address');
            return false;
         }

         $.ajax({
            type     : "post",
            dataType : "json",
            url      : myAjax.ajaxurl,
            data     : { action: "newsletter_form", email : email, firstname: firstname, surname: surname, nonce: nonce },
            success  : function(response) {

              _this.removeClass("blinking");

               if(response.type == "success") {
                  if (response.status !== "error") {
                       newsletterResponse
                            .text(newsletter_form_strings.success)
                            .removeClass("hidden")
                            .removeClass("btn-danger")
                            .addClass("btn-success");

                       console.log("[ response.status=success ]");
                       console.log(response.debug);

                       $("#newsletter #email").val("").blur();
                  } else {
                       newsletterResponse
                            .text(newsletter_form_strings.server_error)
                            .removeClass("hidden")
                            .addClass("btn-danger");

                       console.log("[ response.status=error ]");
                       console.log(response.debug);

                       $("#newsletter #email").blur();
                  }
               } else {
                  newsletterResponse
                            .text(response.message)
                            .removeClass("hidden")
                            .addClass("btn-danger");

                       console.log("[ response.type=error ]");
                       console.log(response.debug);

                       $("#newsletter #email").blur();
               }
            }
         });

      });

   });

}(jQuery));