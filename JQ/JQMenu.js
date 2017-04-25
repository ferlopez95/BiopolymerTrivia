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
            sessionStorage.setItem("tipoExamen","estructuras");
        });

        $("#buttonUsos").on("click",function(){
            window.location.replace("exUsos.html");
            sessionStorage.setItem("tipoExamen","usos");
        });

        $("#buttonFormacion").on("click",function(){
            window.location.replace("exFormacion.html");
            sessionStorage.setItem("tipoExamen","formacion");
        });

        /********************** Cronometro para el tiempo *********************/
        var timer = new Timer();
        timer.start({countdown: true, startValues: {seconds: 30}});
        $('#countdownExample .values').html(timer.getTimeValues().toString());
        console.log("Aqui va");
        timer.addEventListener('secondsUpdated', function (e) {
            $('#countdownExample .values').html(timer.getTimeValues().toString());
        });
        timer.addEventListener('targetAchieved', function (e) {
            $('#countdownExample .values').html('KABOOM!!');
        });

});
