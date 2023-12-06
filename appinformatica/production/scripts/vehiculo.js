var tabla;

//funcion que se ejecuta iniciando
function init(){
	mostarform(false);
	listar();

	$('[data-toggle="tooltip"]').tooltip(); 

	$("#formulario").on("submit", function(e){
		guardaryeditar(e);
	});

        $("#formPlazoDocumentosVehiculo").on("submit", function (e) {
            guardarFormPlazoDocumentosVehiculo(e);
        });
    
	$.post("../ajax/tvehiculo.php?op=selecttvehiculo", function(r){
		$("#tvehiculo").html(r);
		$("#tvehiculo").selectpicker('refresh');
	});
        
        $.post("../ajax/marcave.php?op=selectmarcave", function(r){
		$("#idmarca").html(r);
		$("#idmarca").selectpicker('refresh');
	});

	$("#idmarca").on("change", function(e){
		$.get("../ajax/modelove.php?op=selectmodelove",{id:$("#idmarca").val()}, function(r){
			$("#idmodelo").html(r);
			$("#idmodelo").selectpicker('refresh');
		});
	});
        
      $('#modalDocumentos').on('show.bs.modal', function (event) { 
          
        var button = $(event.relatedTarget);        
        $("#id_vehiculo").val(button.data('idvehiculo')); 
        
        $.post( "../ajax/vehiculo.php?op=mostar", { idvehiculo: button.data('idvehiculo') }, function( data ) {
            
            if(data.gases==null){
               $('#doc_gases').prop('readonly', false);
            }else
            {
               $('#doc_gases').prop('readonly', true); 
            } 
             if(data.tecnica==null){
               $('#doc_tecnica').prop('readonly', false);
            }else
            {
               $('#doc_tecnica').prop('readonly', true); 
            } 
             if(data.circulacion==null){
               $('#doc_circulacion').prop('readonly', false);
            }else
            {
               $('#doc_circulacion').prop('readonly', true); 
            } 
            
            $("#doc_gases").val(data.gases);
            $("#doc_tecnica").val(data.tecnica);
            $("#doc_circulacion").val(data.circulacion);
          }, "json");
    });

}


// Otras funciones
function limpiar(){

	$("#idvehiculo").val("");
	$("#tvehiculo").val("");
	$("#tvehiculo").selectpicker('refresh');
        $("#idmarca").val("");
	$("#idmarca").selectpicker('refresh');
        $("#idmodelo").val("");
	$("#idmodelo").selectpicker('refresh');
	$("#ano").val("");
	$("#patente").val("");
        $("#serialmotor").val("");
        $("#serialcarroceria").val("");
        $("#estado").val("");
	$("#estado").selectpicker('refresh');
        $("#gases").val("");
        $("#tecnica").val("");
        $("#circulacion").val("");
        $("#observaciones").val("");
}

function mostarform(flag){

	limpiar();
	if(flag){
		$("#listadovehiculos").hide();
		$("#formulariovehiculos").show();
		$("#op_agregar").hide();
		$("#op_listar").show();
		$("#btnGuardar").prop("disabled", false);

	}else{
		$("#listadovehiculos").show();
		$("#formulariovehiculos").hide();
		$("#op_agregar").show();
		$("#op_listar").hide();
	}

}

function cancelarform(){
	limpiar();
	mostarform(false);
}

function listar(){
	tabla=$('#tblvehiculos').dataTable({
		"aProcessing":true,
		"aServerSide": true,
		dom: 'Bfrtip',
		buttons:[
			'copyHtml5',
			'print',
			'excelHtml5',
			'csvHtml5',
			'pdf'
		],
		"ajax":{
			url:'../ajax/vehiculo.php?op=listar',
			type:"get",
			dataType:"json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		"iDisplayLength": 10, //Paginacion 10 items
		"order" : [[1 , "desc"]] //Ordenar en base a la columna 0 descendente
	}).DataTable();
}

function guardaryeditar(e){
	e.preventDefault();
	var formData = new FormData($("#formulario")[0]);
	$.ajax({
		url:'../ajax/vehiculo.php?op=guardaryeditar',
		type:"POST",
		data:formData,
		contentType: false,
		processData:false,

		success: function(datos){
                        $.get('https://api.telegram.org/bot451016925:AAEHLdlYx-Na35mt8ODT5RCsRkLRo_khc3Q/sendMessage?chat_id=431473212&text='+datos+''); 
			bootbox.alert(datos);
			mostarform(false);
			tabla.ajax.reload();                     
		}
	});
	limpiar();
}

function mostar(idvehiculo){
	$.post("../ajax/vehiculo.php?op=mostar",{idvehiculo:idvehiculo}, function(data,status){
            
		data = JSON.parse(data);
		mostarform(true);
                
                $("#idvehiculo").val(data.idvehiculo);
                $("#tvehiculo").val(data.tvehiculo);
                $("#tvehiculo").selectpicker('refresh');
                $("#idmarca").val(data.idmarca);
                $("#idmarca").selectpicker('refresh');
                $.get("../ajax/modelove.php?op=selectmodelove",{id:data.idmarca}, function(r){
			$("#idmodelo").html(r);
                        $("#idmodelo").val(data.idmodelo);
			$("#idmodelo").selectpicker('refresh');
		});
                $("#ano").val(data.ano);
                $("#kilometraje").val(data.kilometraje);
                $("#patente").val(data.patente);
                $("#serialmotor").val(data.serialmotor);
                $("#serialcarroceria").val(data.serialcarroceria);
                $("#gases").val(data.gases);
                $("#tecnica").val(data.tecnica);
                $("#circulacion").val(data.circulacion);
                $("#estado").val(data.estado);
                $("#estado").selectpicker('refresh');
                $("#observaciones").val(data.observaciones);
                
	});
}

function desactivar(idvehiculo){

	bootbox.confirm("Esta seguro que quiere inhabilitar el vehiculo?", function(result){
		if(result){
			$.post("../ajax/vehiculo.php?op=desactivar",{idvehiculo:idvehiculo}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});	
		}
	});
}

function activar(idvehiculo){

	bootbox.confirm("Esta seguro que quiere habilitar el vehiculo?", function(result){
		if(result){
			$.post("../ajax/vehiculo.php?op=activar",{idvehiculo:idvehiculo}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});	
		}
	});
}

function guardarFormPlazoDocumentosVehiculo(e) {

    e.preventDefault();

    $.ajax({
        // En data puedes utilizar un objeto JSON, un array o un query string
        data: $("#formPlazoDocumentosVehiculo").serialize(),
        type: "POST",
        url: "../ajax/vehiculo.php?op=guardarPlazoDocumentosVehiculo",
        beforeSend: function () {
            $("#btnGuardarModal").prop("disabled", true);
            $('.modal-body').css('opacity', '.5');
        }
    })
            .done(function (data, textStatus, jqXHR) {
                if (console && console.log) {
                    console.log("La solicitud se ha completado correctamente.");
                }
                tabla.ajax.reload();
                bootbox.alert(data);
                $("#btnGuardarModal").prop("disabled", false);
                $('.modal-body').css('opacity', '');
                $('#modalDocumentos').modal('toggle');
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                if (console && console.log) {
                    console.log("La solicitud a fallado: " + textStatus);
                }

            });

}


init();