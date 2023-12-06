function init(){
	CargarDatos();
}

function CargarDatos(){
    
	var  vehiculos=0, vehi_libres=0, vehi_asig=0, vehi_nodisp=0, vehi_mant=0, vehi_rep=0, vehi_sin=0, vehi_rob=0; 

        $.post("../ajax/estado.php?op=ContarVehiculos", function(data,status){
	
                data = JSON.parse(data);

                for (var i=0; i<data.aaData.length; i++){
                    
                    if(data.aaData[i][1]==0){
                        vehi_asig=data.aaData[i][0];
                    }
                                        
                    if(data.aaData[i][1]==1){
                        vehi_libres=data.aaData[i][0];
                    }

                    if(data.aaData[i][1]==2){
                        vehi_nodisp=data.aaData[i][0];
                    }

                    vehiculos=parseInt(vehi_libres)+parseInt(vehi_asig)+parseInt(vehi_nodisp);
                }

                //Actualizamos valores
                $("#vehiculos").html(vehiculos);
                $("#vehi_asig").html(vehi_asig);
                $("#vehi_libres").html(vehi_libres);
        }); 
        
        $.post("../ajax/estado.php?op=contarVehiculoGestion", function(data,status){
	
                data = JSON.parse(data);

                for (var i=0; i<data.aaData.length; i++){
                    
                    if(data.aaData[i]['gestion']==1){   //vehiculo en mantencion
                        vehi_mant=data.aaData[i]['cant_vehiculos'];
                    }
                                        
                    if(data.aaData[i]['gestion']==2){   //vehiculo en reparacion
                        vehi_rep=data.aaData[i]['cant_vehiculos'];
                    }

                    if(data.aaData[i]['gestion']==3){   //vehiculo con siniestro
                        vehi_sin=data.aaData[i]['cant_vehiculos'];
                    }
                    
                    if(data.aaData[i]['gestion']==4){   //vehiculo robado
                        vehi_rob=data.aaData[i]['cant_vehiculos'];
                    }
                }

                //Actualizamos valores
                $("#vehi_mant").html(vehi_mant);
                $("#vehi_rep").html(vehi_rep);
                $("#vehi_sin").html(vehi_sin);
                $("#vehi_rob").html(vehi_rob);
        }); 
}


init();