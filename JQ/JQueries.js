$(document).ready(function() {

        $("#buttonEntrar").on("click",function(){
            var user = $("#username").val();
            window.localStorage.setItem("user", user);
            window.location.replace("menu.html");
        });

        $("#buttonEstructura").on("click",function(){
            window.location.replace("exEstructura.html");
        });

        $("#buttonUsos").on("click",function(){
            window.location.replace("exUsos.html");
        });

        $("#buttonFormacion").on("click",function(){
            window.location.replace("exFormacion.html");
        });

        $("#userTag").text(window.localStorage.getItem("user"));

});
