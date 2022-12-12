

$("#form-login").submit( function (e) {
    e.preventDefault();
    var username =  document.getElementById("usuario-inicio").value;
    var password = document.getElementById("pass-inicio").value;
    var dataString = 'usuario-inicio='+username+'&pass-inicio='+password;

    if(password == "" || username ==" "){
        alert("Favor de llenar todos los campos");
    }

    $.ajax({
        type: "POST",
        url: "../Controller/UserController.php",
        data: dataString,
        cache: false,
        success: function(data){
            if(data)
            {
            window.location.href = "../Views/inicio.php";
            }
        },
        error: function (x, y, z) {
            alert("Credenciales Erroneas");
        }
    });


});

$("#form-signin").submit (function (e){
    e.preventDefault();
    var formData = {
        emailregistro: $("#email-registro").val(),
        userregistro: $("#usuario-registro").val(),
        passwordregistro: $("#password-registro").val(),
        rolregistro: $("#rol-seleccionar").val(),
        nameregistro: $("#name-segunda").val(),
        apellidopaternoregistro: $("#apellidopaterno-segunda").val(),
        apellidomaternoregistro: $("#apellidomaterno-segunda").val(),
        fecharegistro: $("#fecha-segunda").val(),
        sexoregistro: $("#sexo-seleccionar").val(),
        fotoregistro: $("#foto-perfil").val(),
      };

      var formData = new FormData(document.getElementById("form-signin"));

        $.ajax({
            type: "POST",
            url: "../Controller/UserController.php",
            data: formData,
            type: "POST",
            dataType: "HTML",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if(data){
                    alert("Registro Hecho");
                    window.location.href = "../Views/sesion.php";
                }
            },
            error: function (data) {
                
                if(data){
                    alert(data.responseText);
                }
            }
        });

});

$("#form-cambiarusuario").submit (function (e){
    e.preventDefault();
      var formData = new FormData(document.getElementById("form-cambiarusuario"));
      console.log(formData)

        $.ajax({
            type: "POST",
            url: "../Controller/UserController.php",
            data: formData,
            type: "POST",
            dataType: "HTML",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if(data){
                    alert("Se ha editado tu informacion.");
                    window.location.href = "../Views/perfil_usuario.php";
                }
            },
            error: function (data) {
                
                if(data){
                    alert(data.responseText);
                }
            }
        });

});
