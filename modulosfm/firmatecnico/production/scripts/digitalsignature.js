var canvas;
var context = document.currentScript.getAttribute('context');
// alert(context);
var updateBD = false;

if (context == 'firmatecnico') {
    $("#btnGuardar").text('Actualizar');
    updateBD = true;
}
else {
    $("#btnGuardar").text('Firmar');
    $("#blqInfo").hide();
    $("#blqNombre").hide();
    $("#blqApellido").hide();
}

//funcion que se ejecuta iniciando
function init() {
    $("#formulariofirmadigital").on("submit", function(e) {
        // guardaryeditar(e);
        e.preventDefault();
        setFirma();
    })
    canvas = document.getElementById('firmafi');
    canvas.height = canvas.offsetHeight;
    canvas.width = canvas.offsetWidth;
    signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgb(255, 255, 255)',
        penColor: 'rgb(0, 0, 0)'
    });
    var el = document.getElementById("t");
    canvas.addEventListener("click", firmamodificada, false);
    canvas.addEventListener("touchstart", firmamodificada, false);
    canvas.addEventListener("touchend", firmamodificada, false);
    firmaSave = '';
    if (updateBD) {
        $.post("../ajax/usuario.php?op=getFirma", function(data) {
            data = JSON.parse(data);
            firmaSave = $.trim(data.firma) + '';
            $("#fmaNombre").html(data.nombre);
            $("#fmaApellido").html(data.apellido);
            if (firmaSave != null && firmaSave != '') {
                console.log('CARGOOOO');
                signaturePad.fromDataURL(firmaSave, {
                    width: canvas.offsetWidth,
                    height: canvas.offsetHeight
                });
                // alert($(document).find("#fmaNombre").html());
                // var xyz = document.querySelector("#fmaNombre");
                // var xyz = $(document).find("#fmaNombre");
                /*alert(document.getElementById('fmaNombre').innerText);
                var xyz = document.getElementById('fmaNombre');
                xyz.val('dsdsdsd');
                $("#fmaNombre").val(data.nombre);*/
                $("#firma").val(firmaSave);
                $("#fmaStatus").html("Firma cargada");
                $("#btnGuardar").hide();
                $("#firmavali").addClass(' border border-success');
            }
            else {
            	$("#fmaStatus").html('<span style="color:red">Sin firma</span>');
            }
            $("#btnGuardar").hide();
        });
    }
}

function firmamodificada() {
    console.log('mouse');
    fijarfirma();
}

function cancelarform() {}

function fijarfirma() {
    if (!signaturePad.isEmpty()) {
        const padfirma = signaturePad.toDataURL();
        if (padfirma) {
            console.log('firma fijada');
            $("#fmaStatus").html("Firma modificada");
            $("#btnGuardar").show();
            // $("#firmavali").val("Firma validada");
            // $("#fmaStatus").addClass(' border border-success');
            $("#firma").val(padfirma);
        } else {
            $("#fmaStatus").html("Error al validar");
            // $("#fmaStatus").addClass(' border border-danger');
        }
    }
}

function borrarfirma() {
    signaturePad.clear();
    $("#firma").val('');
    $("#firmapad").show();
    $("#fmaStatus").html('');
    $("#btnGuardar").hide();
    // $("#btnFirmar").hide();
}

function resetearfirma() {
    fijarfirma();
    signaturePad.clear();
    signaturePad.fromDataURL(firmaSave, {
        width: canvas.offsetWidth,
        height: canvas.offsetHeight
    });
    $("#firma").val(firmaSave);
    $("#firmapad").show();
    if (firmaSave != null && firmaSave != '')
    	$("#fmaStatus").html('Firma cargada');
    else
    	$("#fmaStatus").html('<span style="color:red">Sin firma</span>');
    $("#btnGuardar").hide();
    // $("#btnFirmar").hide();
}

function setFirma() {
    if (updateBD) {
        var formData = new FormData($("#formulariofirmadigital")[0]);
        $.ajax({
            url: '../ajax/usuario.php?op=setFirma',
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(datos) {
            	let tipo, mensaje;
            	if (datos == 1) {
                	mensaje = 'Firma actualizada correctamente';
                	tipo = 'info';
            	}
            	else {
            		mensaje = 'No se pudo actualizar correctamente su firma.';
                	tipo = 'error';
            	}
            	showAlert({
    		        type: tipo,
    		        message: mensaje,
    		    });

    		    firmaSave = $.trim($("#firma").val()) + '';
            }
        });
    }
    else {
        
    }
}
init();