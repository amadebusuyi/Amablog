(function($) {
    'use strict'

    // Set Waves
    // Waves.attach('.menu .list a', ['waves-block']);
    // Waves.attach('ul li', ['waves-block']);
    Waves.attach('.btn', ['waves-inline']);
    // Waves.attach('a', ['waves-block']);
    Waves.init();

    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });


    var path = $("#path-route").text();


    $(".show-password").click(function(){
        let input = $(this).parent(".form").find("input");
        if($(input).attr("type") == "password"){
            input.attr("type", "text");
            $(this).find("i").removeClass("fa-eye").addClass("fa-eye-slash");
        }
        else{
            input.attr("type", "password");
            $(this).find("i").removeClass("fa-eye-slash").addClass("fa-eye");
        }
    })

    $("input").change(function(){
        $(".error-logger").hide();
    })

    $("#email").keyup(function(){
        if(validateEmail($(this).val()) ===  true){
            $(this).parent(".form").find(".email-ok").attr("data-original-title", "Email accepted");
            $(this).parent(".form").find(".email-ok").find("i").removeClass("fa-exclamation-circle animate__tada").addClass("fa-check animate__swing");
            // $(this).parent(".form").find(".email-ok").find("i").removeClass("fa-check animate__swing").addClass("fa-exclamation-circle animate__tada");
         }
        else if($(this).val().length < 1){
            $(".email-ok").find("i").removeClass("fa-exclamation-circle animate__tada fa-check animate__swing");
        }
        else{
            $(".email-ok").attr("data-original-title", "Invalid email entered");
            $(".email-ok").find("i").removeClass("fa-check animate__swing").addClass("fa-exclamation-circle animate__tada");
        }
    })

}(jQuery))