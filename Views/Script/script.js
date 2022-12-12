$(document).ready(function() {
    $("#form-login").fadeIn();

    var numItems = $('#productos-inicio').length;
    console.log(numItems);
});
    function showSignin(){
    $("#primera-parte").fadeOut();
    $("#primera-parte").hide();
    $("#segunda-parte").fadeIn();
}

function returnSignin(){
    $("#segunda-parte").fadeOut();
    $("#segunda-parte").hide();
    $("#primera-parte").fadeIn();
}

function changeForm(){
    $("#form-login").hide();
    $("#form-login").fadeOut();
    $("#form-signin").fadeIn();
}
function changeForm2(){
    $("#form-signin").hide();
    $("#form-signin").fadeOut();
    $("#form-login").fadeIn();
}
function favorites(){
    $("#corazon1").fadeOut();
    $("#corazon1").hide();
    $("#corazon2").fadeIn();
}
function favorites2(){
    $("#corazon2").fadeOut();
    $("#corazon2").hide();
    $("#corazon1").fadeIn();
}
function validarForm(){
    let email = $("#email-registro").val();
    let usuario = $("#usuario-registro").val();
    let password = $("#password-registro").val();
    let nombre = $("#name-segunda").val();
    let fechanacimiento = $("#fecha-segunda").val();
    var regexPassword = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
    if(email=="" | usuario=="" | password=="" | nombre=="" | fechanacimiento==""){
        alert("Todos los campos son necesarios");
    }
    if(!password.match(regexPassword)){
        alert("La contraseña no es correcta, favor de revisarla");
    }


}
