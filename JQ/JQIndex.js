$(document).ready(function() {

        $("#buttonEntrar").on("click",function(){
            var user = $("#username").val();
 
        if(user.length >= 3 && user.trim().length >= 3)
            {
            sessionStorage.setItem("user", user);
            window.location.replace("menu.html");
        }
        else{
        	alert("Usuario minimo de 3 caracteres");
        }
    });
});        


