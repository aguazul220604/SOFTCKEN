<?php include_once 'Views/template/header-admin.php'; ?>
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#listaProducto" type="button" role="tab" aria-controls="listaProducto" aria-selected="true">Productos</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#nuevoProducto" type="button" role="tab" aria-controls="nuevoProducto" aria-selected="false">Nuevo</button>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="listaProducto" role="tabpanel" aria-labelledby="home-tab">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle" style="width: 100%;" id="tablaProductos">
                        <thead class="bg-dark text-white">
                            <tr>
                                <!-- datos de los productos del sistema -->
                                <td>ID</td>
                                <td>Producto</td>
                                <td>Precio</td>
                                <td>Cantidad</td>
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
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="nuevoProducto" role="tabpanel" aria-labelledby="profile-tab">
        <div class="card">
            <div class="card-body p-5">
                <form id="frmRegistro">
                    <!-- formulario de registro de nuevos productos -->
                    <div class="row">
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="img_actual" id="img_actual">
                        <div class="col-md-5">
                            <div class="form-group mb-2">
                                <label for="nombre">Producto</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Producto">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label for="precio">Precio</label>
                                <input type="text" name="precio" id="precio" class="form-control" placeholder="Precio">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label for="cantidad">Cantidad</label>
                                <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="Cantidad">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="categoria">Categoría</label>
                                <select name="categoria" id="categoria" class="form-control">
                                    <option value="">Seleccionar</option>
                                    <?php foreach ($data['categorias'] as $categoria) { ?>
                                        <option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['categoria']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea name="descripcion" id="descripcion" rows="3" class="form-control" placeholder="Descripción"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="imagen">Imágen</label>
                                <input type="file" class="form-control" id="imagen" name="imagen">
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button class="btn btn-primary" type="submit" id="btnAction">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once 'Views/template/footer-admin.php'; ?>
<script src="<?php echo BASE_URL; ?>assets/js/modulos/productos.js"></script>
</body>

</html>