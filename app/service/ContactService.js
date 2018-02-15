$(document).ready(function(){

    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
      }    


$("#send").on("click", function(){
    var name = $("#name").val();
    var email = $("#email").val();
    var message = $("#message").val();

    if($.trim(name).length > 0 && $.trim(email).length > 0)
    {
        if(validateEmail(email))
        {
            $.ajax({
                url: "app/repository/ContactRepository.php",
                type: "POST",
                data: { name: name, email: email, message: message},
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



$("#send2").on("click",function(event){
    var email = $("#email-notify").val();

    if($.trim(email).length > 0)
    {
        if(validateEmail(email))
        {
            $.ajax({
                url: "service.php",
                type: "POST",
                data: {email: email},
                success: function(resp){
        
                        if(resp){
                            //alert("Su reserva fue realizada correctamente");
                            $("#snackbar").text("¡Muchas gracias por tu interés!");
                            Clear2();
                            var x = document.getElementById("snackbar");
                            x.className = "show";
        
                            setTimeout(function(){
                                 x.className = x.className.replace("show", ""); 
                                 //window.location.href = "../";                          
                                }, 3000);
                                
                            event.preventDefault();
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
    $("#name").val('');
    $("#email").val('');
    $("#message").val('');
}
function Clear2()
{
    $("#email").val('');
}

});