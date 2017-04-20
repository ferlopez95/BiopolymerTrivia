$(document).ready(function() {
    if(sessionStorage.user === undefined)
        {

            alert("Sesión expirada, vuelve a registrarte");
            window.location.replace("index.html");
        }

/**************************Carga de Preguntas y Respuestas en el examen de USOS***********/
        var jsonToSend = {
            "action" : "LOADQAUSOS"
        };

        $.ajax ({
            url : "Data/applicationLayer.php",
            type : "POST",
            data : jsonToSend,
            dataType : "json",
            contentType : "application/x-www-form-urlencoded",
            success : function(jsonResp){

                var n = Number(sessionStorage.preg); // Guarda la pregunta en la que se está.

                // Si por alguna razon pasa el limite de preguntas disponibles, se regresa al index.
                if (n>4){

                    window.location.replace("index.html");
                }
                var resCorrecta = sessionStorage.setItem("resCorrecta",jsonResp[n].correcta); // Guarda la respuesta de la n pregunta, para no checar la base de datos otra vez

                var arr = [jsonResp[n].correcta,jsonResp[n].d1,jsonResp[n].d2,jsonResp[n].d3]; // Arreglo con respuestas de la pregunta

                shuffle(arr); // Cambia al azar el contenido de las casillas, en este caso las respuestas de la pregunta

                /* Asignacion de pregunta y repuestas en el examen de Usos (4 respuestas) */
            	$("#pregunta").text(jsonResp[n].pregunta);
                $("#r1").val(arr[0]);
                $("#r2").val(arr[1]);
                $("#r3").val(arr[2]);
                $("#r4").val(arr[3]);

            },
            error: function(errorMsg){
            }
        });


/************************** Aqui Revisa Respuesta Seleccionada*****************/
        $(".respuesta").click(function (event) {
 
            var respSel = event.target.value; //Respuesta seleccionada por el usuario
            if(respSel === sessionStorage.resCorrecta){
                var aciertos = Number(sessionStorage.getItem("aciertos")) + 1;
                sessionStorage.setItem("aciertos",aciertos);             
                alert("MUY BIEN");
            }
            else{
                alert("MAL");
            }

            var num = Number(sessionStorage.preg) + 1; // Siguiente pregunta
            sessionStorage.setItem("preg",num); // Actualiza la pregunta en la que se está

        // Si aun no son 5 preguntas, hace refresh al sitio para seguir con la otra
            if(num <= 4){
            window.location.replace("exUsos.html");
                }
    //////////////////////SE GUARDA EN LA BASE DE DATOS LA PUNTUACION DEL USUARIO
        else{
            
        // Cuando termina el quiz se envía el nombre y la puntuación del usuario

        var punt = Number(sessionStorage.aciertos) * 250;

        var jsonToSend = {
            "action" : "UPLOADUSERUSOS",
            "user" : sessionStorage.user,
            "punt" : punt
        };         
        $.ajax({

            url : "Data/applicationLayer.php",
            type : "POST",
            data : jsonToSend,
            dataType : "json",
            contentType : "application/x-www-form-urlencoded",
            success : function(jsonResp){

            },
            error: function(errorMsg){
                window.location.replace("puntuaciones.html");
            }

        });
    }
            
});







////FUNCIONES
/********************** Funcion AZAR ARREGLO *********************/
        function shuffle (array) {
            var i = 0
            , j = 0
            , temp = null

            for (i = array.length - 1; i > 0; i -= 1) {
                    j = Math.floor(Math.random() * (i + 1))
                    temp = array[i]
                    array[i] = array[j]
                    array[j] = temp
            }
        }




    });