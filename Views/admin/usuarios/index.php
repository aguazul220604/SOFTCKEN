<?php include_once 'Views/template/header-admin.php'; ?>
<button class="btn btn-primary mb-2 text-white" type="button" id="nuevoRegistro">Nuevo</button>
<div class="card shadow-lg">
    <div class="card-body">
        <!-- datos de usuarios del panel administrativo -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle" style="width: 100%;" id="tablaUsuarios">
                <thead class="bg-dark text-white">
                    <tr>
                        <td>ID</td>
                        <td>Nombre</td>
                        <td>Apellidos</td>
                        <td>Correo</td>
                        <td>Foto</td>
                        <td>Opciones</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="nuevo">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="titleModal"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- formulario de registro de nuevo usuario -->
            <form id="frmRegistro">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group mb-2">
                        <label for="Nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre">
                    </div>
                    <div class="form-group mb-2">
                        <label for="Apellido">Apellidos</label>
                        <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Apellido">
                    </div>
                    <div class="form-group mb-2">
                        <label for="Correo">Correo</label>
                        <input type="email" name="correo" id="correo" class="form-control" placeholder="Correo electrónico">
                    </div>
                    <div class="form-group mb-2">
                        <label for="Clave">Contraseña</label>
                        <input type="password" name="clave" id="clave" class="form-control" placeholder="Contraseña">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit" id="btnAction">Registrar</button>
                    <button class="btn btn-danger" data-bs-dismiss="modal" type="button">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include_once 'Views/template/footer-admin.php'; ?>
<script src="<?php echo BASE_URL; ?>assets/js/modulos/usuarios.js"></script>
</body>

</html>