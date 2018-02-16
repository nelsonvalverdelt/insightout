$(document).ready(function(){

    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
      }    

    $("#send").on("click", function(){
        var email = $("#email-notify").val();
        if($.trim(email).length > 0)
        {
            if(validateEmail(email))
            {
                $.ajax({
                    url: "app/repository/NotifyRepository.php",
                    type: "POST",
                    data: {email: email},
                    success: function(resp){
            
                            if(resp){
                                Clear();
                                $("#snackbar").text("¡Muchas gracias por tu interés!");
                                var x = document.getElementById("snackbar");
                                x.className = "show";
            
                                setTimeout(function(){
                                    x.className = x.className.replace("show", ""); 
                                    }, 3000);
                            }else{
                                alert("Error en el servidor");
                            }
                    },
                    error: function(error){
                        alert("Error en el servicio :(");
                    }
                    
                    });
            }
            
        }else{
            $("#snackbar-error").text("¡Completar los campos vacios, por favor!");
            var x = document.getElementById("snackbar-error");
            x.className = "show";

            setTimeout(function(){
                x.className = x.className.replace("show", ""); 
                }, 3000);
        }

    });

    function Clear()
    {
        $("#email-notify").val('');
    }
});