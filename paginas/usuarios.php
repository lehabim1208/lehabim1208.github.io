<?php 
include '../config/conexion.php'; 
session_start();

$currentPage = 'usuarios';

// Verificar si la variable de sesión 'idUsuario' está definida
if (!isset($_SESSION['idUsuario']) || $_SESSION['rol'] !== 'administrador') {
    // El usuario no ha iniciado sesión o no tiene el rol de "administrador", redirigir a la página de acceso denegado
    header('Location: error-403.html');
    exit();
}

?>
<body>
<?php include "header.php"; ?>
<!-- Contenido del dashboard -->
<div class="container-fluid pr-4 pl-4 pt-4">
    <div class="row">
        <div class="col-md-12 p-4" id="contenido">
            <h3 class="mb-4">Usuarios y Administradores:</h3>
            <!-- Botón para abrir el modal de agregar usuario -->
            <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#modalAgregarEspacio">
                <i class="fas fa-plus"></i> Agregar
            </button>
            
<div class="table-responsive">
<table class="table table-light table-hover" id="tbl">
                <thead>
                    <tr class="table-info">
                    <th scope="col">IdUsuario</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Celular</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                        // Realiza la consulta a la base de datos
                        $sql = "SELECT idUsuario, nombre, correo, rol, celular FROM usuario";
                        $resultado = $conn->query($sql);

                        if ($resultado->num_rows > 0) {
                            // Itera sobre los resultados
                            while ($fila = $resultado->fetch_assoc()) {
                                $idUsuario = $fila['idUsuario'];
                                $nombre = $fila['nombre'];
                                $correo = $fila['correo'];
                                $rol = $fila['rol'];
                                $celular = $fila['celular'];
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $idUsuario; ?></th>
                                    <td><?php echo $nombre; ?></td>
                                    <td><?php echo $correo; ?></td>
                                    <td><?php echo $rol; ?></td>
                                    <td><?php echo $celular; ?></td>
                                </tr>
                                <?php
                            }
                        } else {
                            // No se encontraron registros
                            echo "No se encontraron usuarios ni administradores";
                        }
                        ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal para agregar usuarios -->
<div class="modal fade" id="modalAgregarEspacio" tabindex="-1" role="dialog" aria-labelledby="modalAgregarEspacioLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarEspacioLabel">Agregar Usuario o Administrador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario para agregar un nuevo espacio -->
                <form action="../actions/registrarDentro.php" method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input name="nombre" type="text" class="form-control" id="nombre" placeholder="Juán Pérez">
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="*********">
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo:</label>
                        <input name="correo" type="email" class="form-control" id="correo" placeholder="ejemplo@correo.com">
                    </div>
                    <div class="form-group">
                        <label for="celular">Celular:</label>
                        <input name="celular" type="number" class="form-control" id="celular" placeholder="A 10 dígitos" maxlength="10">
                    </div>
                    <div class="form-group">
                        <label for="rol">Rol:</label>
                        <select name="rol" class="form-control" id="rol">
                            <option value="usuario">Usuario</option>
                            <option value="administrador">Administrador</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


    <?php include "footer.html"; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../scripts/sweetAlert.js"></script>

    <script>
    function ajustarPosicionFooter() {
    const footer = document.getElementById("myFooter");
    const container = document.getElementById("contenido");
    
    if (container.offsetHeight >= 500) {
        footer.style.position = "relative";
    } else {
        footer.style.position = "absolute";
    }
}

// Ajusta la posición del footer al cargar la página
ajustarPosicionFooter();

// Escucha el evento resize de la ventana para ajustar en caso de cambios en la altura
window.addEventListener("resize", ajustarPosicionFooter);

</script>
</body>
</html>