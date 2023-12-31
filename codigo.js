$('#formLogin').submit(function(e) {
    e.preventDefault();
    var usuario = $.trim($("#usuario").val());
    var password = $.trim($("#password").val());

    if (usuario.length == "" || password == "") {
        Swal.fire({
            type: 'warning',
            title: 'Debe ingresar un usuario y/o password',
        });
        return false;
    } else {
        $.ajax({
            url: "http://localhost/SeguriKids/pagina_principal.php", // Reemplaza con la URL correcta de tu página principal
            type: "POST",
            datatype: "json",
            data: { usuario: usuario, password: password },
            success: function (data) {
                if (data == "null") {
                    Swal.fire({
                        type: 'error',
                        title: 'Usuario y/o password incorrecta',
                    });
                } else {
                    Swal.fire({
                        type: 'success',
                        title: '¡Conexión exitosa!',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ingresar'
                    }).then((result) => {
                        if (result.value) {
                            // Redirige a la página principal después del inicio de sesión exitoso
                            window.location.href = "pagina_principal.php"; // Reemplaza con la URL de tu página principal
                        }
                    })
                }
            }
        });
    }
});
