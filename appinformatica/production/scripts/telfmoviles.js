var tabla;


//funcion que se ejecuta iniciando
function init(){
	mostarform(false);
	listar();

	$('[data-toggle="tooltip"]').tooltip(); 


}

function mostarform(flag){

	$("#listadoasignacion").show();

}


function listar(){
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
			url:'../ajax/asignacion.php?op=listartelf',
			type:"get",
			dataType:"json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		"iDisplayLength": 15, //Paginacion 10 items
		"order" : [[0 , "asc"]] //Ordenar en base a la columna 0 descendente
	}).DataTable();
}

init();