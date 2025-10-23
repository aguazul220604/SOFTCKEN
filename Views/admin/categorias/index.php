<?php include_once 'Views/template/header-admin.php'; ?>
<button class="btn btn-primary mb-2 text-white" type="button" id="nuevoRegistro">Nuevo</button>
<div class="col-md-12">
    <div class="card shadow-lg">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle" style="width: 100%;" id="tablaCategorias">
                    <thead class="bg-dark text-white">
                        <!-- tabla de listado de características de categorías de prodctos -->
                        <tr>
                            <td>ID</td>
                            <td>Categoría</td>
                            <td>Imágen</td>
                            <td>Opciones</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
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
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="nuevo">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="titleModal"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="frmRegistro">
                <!-- formulario de reistro de categorias -->
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="img_actual" id="img_actual">

                    <div class="form-group mb-2">
                        <label for="categoria">Nombre</label>
                        <input type="text" name="categoria" id="categoria" class="form-control" placeholder="Categoría">
                    </div>
                    <div class="form-group">
                        <label for="imagen"></label>
                        <input type="file" class="form-control-file" id="imagen" name="imagen">
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
<script src="<?php echo BASE_URL; ?>assets/js/modulos/categorias.js"></script>
</body>

</html>