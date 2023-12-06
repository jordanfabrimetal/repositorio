var tabla;


//funcion que se ejecuta iniciando
function init() {
    $('[data-toggle="tooltip"]').tooltip(); 

	$.post("../ajax/asignacionvehiculohist.php?op=selectempleado", function (r) {
    $("#selempleado").html(r);
    $("#selempleado").selectpicker('refresh');
    });

    $.post("../ajax/asignacionvehiculohist.php?op=selectpatente", function (r) {
        $("#selpatente").html(r);
        $("#selpatente").selectpicker('refresh');
        });

  $("#listadoasigvehiculo").hide();
}

function listar2() {

    var empleado = $("#selempleado").val();
    var patente = $("#selpatente").val();

    tabla = $('#tblasigvehiculo').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'print',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ],
        "ajax": {
            url: '../ajax/asignacionvehiculohist.php?op=listar',
            type: "get",
            data: {idempl: empleado, pat: patente},
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10, //Paginacion 10 items
        "order": [[4, "desc"]] //Ordenar en base a la columna 0 descendente
    }).DataTable();

    $("#listadoasigvehiculo").show();
}


init();