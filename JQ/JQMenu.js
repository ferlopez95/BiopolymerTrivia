$(document).ready(function() {

        if(sessionStorage.user === undefined)
        {
            $("#saludo").text("");
            alert("Sesión expirada, vuelve a registrarte");
            window.location.replace("index.html");
        }
        else{

            $("#userTag").text(sessionStorage.user);
        }

        sessionStorage.setItem("preg",0);
        sessionStorage.setItem("aciertos",0);

        $("#buttonEstructura").on("click",function(){
            window.location.replace("exEstructura.html");
        });

        $("#buttonUsos").on("click",function(){
            window.location.replace("exUsos.html");
        });

        $("#buttonFormacion").on("click",function(){
            window.location.replace("exFormacion.html");
        });
});