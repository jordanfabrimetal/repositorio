console.log("Cargo");
$("#frmAcceso").on('submit', function(e){
	e.preventDefault();
	username = $("#username").val();
	password = $("#password").val();
	console.log(username);
	$.post("../ajax/usuario.php?op=verificar",{"username_form": username, "password_form": password}, function(data){
		if(data!="null"){
			$(location).attr("href", "inicio.php");
		}else{
			bootbox.alert("Usuario o Password Incorrectos")
		}

	})

})