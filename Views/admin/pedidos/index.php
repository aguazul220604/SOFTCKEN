<?php include_once 'Views/template/header-admin.php'; ?>
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#listaPedidos" type="button" role="tab" aria-controls="listaPedidos" aria-selected="true">Pedidos</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="proceso-tab" data-bs-toggle="tab" data-bs-target="#listaProceso" type="button" role="tab" aria-controls="listaProceso" aria-selected="false">Pedidos en proceso</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#pedidosFinalizados" type="button" role="tab" aria-controls="pedidosFinalizados" aria-selected="false">Pedidos finalizados</button>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="listaPedidos" role="tabpanel" aria-labelledby="home-tab">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle" style="width: 100%;" id="tablaPendientes">
                    <!-- tabla de listado de pedidos pendientes -->
                        <thead class="bg-dark text-white">
                            <tr>
                                <td>Transacción</td>
                                <td>Monto</td>
                                <td>Estado</td>
                                <td>Fecha</td>
                                <td>Correo</td>
                                <td>Nombre</td>
                                <td>Apellido</td>
                                <td>Dirección</td>
                                <td>Acción</td>
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
    <div class="tab-pane fade" id="listaProceso" role="tabpanel" aria-labelledby="proceso-tab">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle" style="width: 100%;" id="tablaProceso">
                    <!-- tabla de listado de pedidos en proceso -->
                        <thead class="bg-dark text-white">
                            <tr>
                                <td>Transacción</td>
                                <td>Monto</td>
                                <td>Estado</td>
                                <td>Fecha</td>
                                <td>Correo</td>
                                <td>Nombre</td>
                                <td>Apellido</td>
                                <td>Dirección</td>
                                <td>Acción</td>
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
    <div class="tab-pane fade" id="pedidosFinalizados" role="tabpanel" aria-labelledby="profile-tab">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle" style="width: 100%;" id="tablaFinalizados">
                    <!-- tabla de listado de pedidos finalizados -->
                        <thead class="bg-dark text-white">
                            <tr>
                                <td>Transacción</td>
                                <td>Monto</td>
                                <td>Estado</td>
                                <td>Fecha</td>
                                <td>Correo</td>
                                <td>Nombre</td>
                                <td>Apellido</td>
                                <td>Dirección</td>
                                <td>Acción</td>
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
</div>
<!-- visulización de detlle de pedidos -->
<div id="modalPedidos" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Productos</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="tablaPedidos" style="width: 100%;">
                        <thead class="bg-dark text-white">
                            <tr>
                                <td>Producto</td>
                                <td>Precio</td>
                                <td>Cantidad</td>
                                <td>Subtotal</td>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once 'Views/template/footer-admin.php'; ?>
<script src="<?php echo BASE_URL; ?>assets/js/modulos/pedidos.js"></script>
</body>

</html>