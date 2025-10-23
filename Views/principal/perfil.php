<?php include_once "Views/template/header-principal.php"; ?>

<body>
    <!-- modal de visualización de estado del pedido del usuario -->
    <div class="modal fade" id="modalPedido" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">Estado del pedido</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-4 pb-5">
                            <div class="h-100 py-5 services-icon-wap shadow" id="estado1">
                                <div class="h1 text-util text-center"><i class="fas fa-exclamation-circle"></i></div>
                                <h2 class="h5 mt-4 text-center">Pendiente</h2>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 pb-5">
                            <div class="h-100 py-5 services-icon-wap shadow" id="estado2">
                                <div class="h1 text-util text-center"><i class="fas fa-spinner"></i></div>
                                <h2 class="h5 mt-4 text-center">En proceso</h2>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 pb-5">
                            <div class="h-100 py-5 services-icon-wap shadow" id="estado3">
                                <div class="h1 text-util text-center"><i class="fas fa-check-circle"></i></div>
                                <h2 class="h5 mt-4 text-center">Completado</h2>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="tablaPedidos" style="width: 100%;">
                                    <thead class="bg-dark text-white">
                                        <!-- detalles del pedido del usuario -->
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
        </div>
    </div>
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Perfil</h1>
    </div>
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h1 class="mb-4">Tus pedidos</h1>
            <BR></BR>
            <div class="row g-4">
                <div class="row">
                    <?php if ($data['verificar']['verify'] == 1) { ?>
                        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Pago</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pendientes-tab" data-bs-toggle="tab" data-bs-target="#pendientes-tab-pane" type="button" role="tab" aria-controls="profile" aria-selected="false">Pedidos</button>
                            </li>
                        </ul>
                        <!-- tabla de pedidos del usuario -->
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="card shadow-lg">
                                            <div class="card-body text-center">
                                                <div class="table-responsive">
                                                    <div class="col-12">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered table-hover align-middle" id="tablaListaProductos" style="width: 100%;">
                                                                <thead class="bg-dark text-white">
                                                                    <tr>
                                                                        <th>Imágen</th>
                                                                        <th>Producto</th>
                                                                        <th>Precio</th>
                                                                        <th>Cantidad</th>
                                                                        <th>Subtotal</th>
                                                                        <th>Eliminar</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                             
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-end">
                                                <h3 id="totalProducto"></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card shadow-lg">
                                            <div class="card-body text-center">
                                                <img src="<?php echo BASE_URL . 'assets/img/perfil.jpg'; ?>" alt="" class="img-thumbnail rounded-circle" style="width: 120px; height: 120px;">
                                                <hr>
                                                <p> <?php echo $_SESSION['nombreCliente']; ?></p>
                                                <p> <i class="fas fa-envelope"></i> <?php echo $_SESSION['correoCliente']; ?></p>
                                                <div class="accordion" id="accordionExample">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingOne">
                                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                PayPal
                                                            </button>
                                                            <!-- sección del botón de pago paypal -->
                                                        </h2>
                                                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div id="paypal-button-container"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pendientes-tab-pane" role="tabpanel" aria-labelledby="pendientes-tab">
                                <div class="col-md-12">
                                    <div class="card shadow-lg">
                                        <div class="card-body text-center">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover" id="tblPendientes" style="width: 100%;">
                                                    <thead class="bg-dark text-white">
                                                        <!-- pedidos registrados del usuario -->
                                                        <tr>
                                                            <td>Pedido</td>
                                                            <td>Monto</td>
                                                            <td>Fecha</td>
                                                            <td>Ver</td>
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
                        </div>
                    <?php } else { ?>
                        <div class="col-lg-3">
                            <div class="row g-4">
                                <div class="alert alert-danger text-center" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                    </svg>
                                    <div class="h3">
                                        Verifica tu correo electrónico
                                    </div>
                                    <!-- acceso al sistema de verificación de sesión -->
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php include_once "Views/template/footer-principal.php"; ?>
    <!-- archivos js de comunicación con las funciones que gestionan las listas de productos en el localStorage -->
    <script src="<?php echo BASE_URL; ?>assets/DataTables/datatables.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/es-ES.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/clientes.js"></script>
</body>

</html>