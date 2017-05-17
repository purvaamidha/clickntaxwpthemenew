(function($){

   $(document).ready( function() {

      var support_ticketResponse = $("#support_ticketResponse");

      $(".support_ticket_form_button").click( function(e) {
         var _this = $(this);
             _this.addClass("blinking");
         support_ticketResponse.addClass('hidden');
         e.preventDefault();
         action = $("#support_ticket").attr('action');
         email  = $("#email").val();
         system_info  = $("#system_info").val();
         nonce  = $("#nonce").val();

         if ( email === '' || !email.match(/^\S+@\S+\.\S{2,}$/) ){
           _this.removeClass("blinking");
           support_ticketResponse
                .text( support_ticket_form_strings.invalid_email )
                .removeClass("hidden")
                .addClass("btn-danger");
           $("#support_ticket #email").blur();
            console.log('Error: Invalid Email Address');
            return false;
         }

         $.ajax({
            type     : "post",
            dataType : "json",
            url      : myTicketAjax.ajaxurl,
            data     : { action: "support_ticket_form", email : email, system_info : system_info, nonce: nonce },
            success  : function(response) {

              _this.removeClass("blinking");

               if(response.type == "success") {
                  if (response.status !== "error") {
                       support_ticketResponse
                            .text(support_ticket_form_strings.success)
                            .removeClass("hidden")
                            .removeClass("btn-danger")
                            .addClass("btn-success");

                       console.log("[ response.status=success ]");
                       console.log(response.debug);

                       $("#support_ticket #email").val("").blur();
                  } else {
                       support_ticketResponse
                            .text(support_ticket_form_strings.server_error)
                            .removeClass("hidden")
                            .addClass("btn-danger");

                       console.log("[ response.status=error ]");
                       console.log(response.debug);

                       $("#support_ticket #email").blur();
                  }
               } else {
                  support_ticketResponse
                            .text(response.message)
                            .removeClass("hidden")
                            .addClass("btn-danger");

                       console.log("[ response.type=error ]");
                       console.log(response.debug);

                       $("#support_ticket #email").blur();
               }
            }
         });

      });

   });

}(jQuery));


