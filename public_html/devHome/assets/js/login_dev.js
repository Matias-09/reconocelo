var server = "http://www.opisa.com/sandvik/";

function valLogin() {
    var user = $('#usuario');
    var pass = $('#password');

    if (!(fieldOK(user) && fieldOK(pass))) {
        $.notify("Campos obligatorios", "error");
        return;
    }

    //if(/[^a-zA-Z0-9]/.test($("#usuario").val()) || /[^a-zA-Z0-9]/.test($("#password").val())){
    //    $.notify("Ha ingresado caracteres no v\u00e1lidos", "error");
    //}else{
    $.ajax({
        url: 'login_controller_dev/login',
        type: 'POST',
        dataType: 'json',
        async: 'true',
        data: { "usuario": $("#usuario").val(), "password": $("#password").val() },
        success: function(result) {
            console.log(result);
            if (result) {
                //console.log(result);
                window.location.reload();
            } else {
                //console.log("Error login");
                $.notify("Los datos ingresados son incorrectos", "error");
            }

        },
        error: function(xhr, ajaxOptions, thrownError) {
            $.notify("Ha ocurrido un error de conexión", "error");
        }
    });
    //}
}


function valLoginRecuperarPassword() {

}



function fieldOK(field) {
    field.removeClass("error");
    if (field.val() == '') {
        field.addClass("error");
        return false;
    }
    return true;
}