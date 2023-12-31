<?php require_once "vistas/parte_superior.php"; ?>

<!-- INICIO del contenido principal -->
<div class="container">
    <h1>Gestión de Recursos</h1>

    <!-- Botón para abrir el formulario de nuevo recurso -->
    <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>

    <br>

    <!-- Tabla para mostrar los recursos -->
    <div class="table-responsive">
        <table id="tablaRecursos" class="table table-striped table-bordered table-condensed" style="width:100%">
            <thead class="text-center">
                <tr>
                    <th>Id</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí puedes mostrar la lista de recursos -->
            </tbody>
        </table>
    </div>

    <!-- Modal para CRUD de recursos -->
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Recurso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formRecursos">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="titulo" class="col-form-label">Título:</label>
                            <input type="text" class="form-control" id="titulo" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion" class="col-form-label">Descripción:</label>
                            <textarea class="form-control" id="descripcion" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- FIN del contenido principal -->

<!-- Agregado para cargar jQuery y Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- Código JavaScript adicional -->
<script>
    $(document).ready(function () {
        // Al enviar el formulario
        $('#formRecursos').submit(function (e) {
            e.preventDefault();

            // Obtén los valores del formulario
            var titulo = $('#titulo').val();
            var descripcion = $('#descripcion').val();

            // Petición Ajax para enviar datos al servidor
            $.ajax({
                type: "POST",
                url: "dashboard/bd/crud.php", // Ajusta la ruta según tu estructura de archivos
                data: { titulo: titulo, descripcion: descripcion },
                dataType: "json", // Esperamos datos en formato JSON
                success: function (response) {
                    // Manejar la respuesta del servidor
                    console.log(response);

                    if (response.success) {
                        // Si la operación fue exitosa, actualiza la tabla de recursos
                        cargarTablaRecursos();
                        // Cierra el modal
                        $('#modalCRUD').modal('hide');
                    } else {
                        // Si hay un error, muestra un mensaje de error (ajusta según tus necesidades)
                        alert("Error: " + response.message);
                    }
                }
            });
        });

        // Función para cargar la tabla de recursos
        function cargarTablaRecursos() {
            // Petición Ajax para obtener la lista actualizada de recursos
            $.ajax({
                type: "GET",
                url: "dashboard/bd/crud.php", // Ajusta la ruta según tu estructura de archivos
                dataType: "json", // Esperamos datos en formato JSON
                success: function (data) {


                    
                    // Actualizar la tabla con los nuevos datos
                    actualizarTablaRecursos(data);
                }
            });
        }

        // Función para actualizar la tabla de recursos
        function actualizarTablaRecursos(datos) {
            // Limpiar la tabla
            $('#tablaRecursos tbody').empty();

            // Recorrer los datos y agregar filas a la tabla
            $.each(datos, function (index, recurso) {
                var fila = "<tr>" +
                    "<td>" + recurso.id + "</td>" +
                    "<td>" + recurso.nombre + "</td>" +
                    "<td>" + recurso.descripcion + "</td>" +
                    "<td>Acciones</td>" + // Puedes personalizar esta parte según tus necesidades
                    "</tr>";

                $('#tablaRecursos tbody').append(fila);
            });
        }

        // Aquí puedes cargar la tabla de recursos al cargar la página
        cargarTablaRecursos();
    });
</script>
<?php require_once "vistas/parte_inferior.php"; ?>
