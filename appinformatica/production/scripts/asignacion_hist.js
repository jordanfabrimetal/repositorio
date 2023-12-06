var tabla;


//funcion que se ejecuta iniciando
function init(){
	//mostarform(false);
	//listar();

	$('[data-toggle="tooltip"]').tooltip(); 

	$.post("../ajax/asignacionhist.php?op=selectempleado", function (r) {
    $("#selservicio").html(r);
    $("#selservicio").selectpicker('refresh');
});

  $("#listadoasignacion").hide();

}


// Otras funciones
function limpiar(){

	$("#idasignacion").val("");
	$("#idequipo").val("");
	$("#idequipo").selectpicker('refresh');	
	$("#idempleado").val("");
	$("#idempleado").selectpicker('refresh');
        $("#tasignacion").val("");
	$("#tasignacion").selectpicker('refresh');
	$("#idchip").val("");
	$("#idchip").selectpicker('refresh');	
	$("#fecha").val("");
}

function mostarform(flag){

	limpiar();
	if(flag){
		$("#listadoasignacion").hide();
		$("#formularioasignacion").show();
		$("#op_agregar").hide();
		$("#op_listar").show();
		$("#btnGuardar").prop("disabled", false);

	}else{
		$("#listadoasignacion").show();
		$("#formularioasignacion").hide();
		$("#op_agregar").show();
		$("#op_listar").hide();
	}

}

function cancelarform(){
	limpiar();
	mostarform(false);
}

function listar2(){

  var empleado = $("#selservicio").val();

	tabla=$('#tblasignacion').dataTable({
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
			url:'../ajax/asignacionhist.php?op=listar',
			type:"get",
      data: {idempl: empleado},
			dataType:"json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		"iDisplayLength": 15, //Paginacion 10 items
		"order" : [[5 , "desc"]] //Ordenar en base a la columna 0 descendente
	}).DataTable();

  $("#listadoasignacion").show();
}



init();