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
    				if(sessionStorage.user === jsonResp[i].usuario)
    				{
    					cell1.innerHTML = "<strong style='font-size:20px'>" + (i+1) + ". " + jsonResp[i].usuario + "</strong>";
    					cell2.innerHTML = "<strong style='font-size:20px'>" + jsonResp[i].puntos + "</strong>";
    					$isTop = true;
    				}
    				else{
       					cell1.innerHTML = (i+1) + ". " + jsonResp[i].usuario;
    					cell2.innerHTML = jsonResp[i].puntos; 					
    				}
            	}
            },
            error: function(errorMsg){

            }

        });
});        


