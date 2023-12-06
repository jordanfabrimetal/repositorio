var tabla;

//funcion que se ejecuta iniciando
function init(){
    
	listar();

	$('[data-toggle="tooltip"]').tooltip(); 


	$("#idmarca").on("change", function(e){
		$.get("../ajax/modelove.php?op=selectmodelove",{id:$("#idmarca").val()}, function(r){
			$("#idmodelo").html(r);
			$("#idmodelo").selectpicker('refresh');
		});
	});
        

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
			url:'../ajax/vehiculo.php?op=listarVehiculosDocumentacionCompleta',
			type:"get",
			dataType:"json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		"iDisplayLength": 15, //Paginacion 15 items
		"order" : [[1 , "desc"]] //Ordenar en base a la columna 0 descendente
	}).DataTable();
}



init();