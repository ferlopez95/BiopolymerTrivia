$(document).ready(function() {
/*****************CARGA DE PUNTUACIONES***********/
	        var jsonToSend = {
            "action" : "LOADSCORES",
            "tipoExamen" : sessionStorage.tipoExamen
        };

        $.ajax({

            url : "Data/applicationLayer.php",
            type : "POST",
            data : jsonToSend,
            dataType : "json",
            contentType : "application/x-www-form-urlencoded",

            success : function(jsonResp){

            	console.log(jsonResp[0].usuario);
            	var table = document.getElementById("rounded-corner");
            	for(i = 0; i <= jsonResp.length-1; i++)
            	{
            		var row = table.insertRow(i+1);
   	 				var cell1 = row.insertCell(0);
    				var cell2 = row.insertCell(1);
    				cell1.innerHTML = jsonResp[i].usuario;
    				cell2.innerHTML = jsonResp[i].puntos;
            	}
            },
            error: function(errorMsg){

            }

        });
});        


