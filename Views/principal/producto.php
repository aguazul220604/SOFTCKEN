<?php include_once "Views/template/header-principal.php"; ?>

<body>
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search byssh keyword</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Favoritos</h1>
    </div>
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h1 class="mb-4">Tus productos</h1>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-6"></div>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4 justify-content-center">
                                <div class="col-12">
                                    <div class="card shadow-lg">
                                        <div class="card-body text-center">
                                            <div class="table-responsive">
                                                <table class="table table-borderer table-hover align-middle" id="tablaProductos" style="width: 100%;">
                                                    <thead class="bg-dark text-white">
                                                        <!-- tabla de productos favoritos del liente -->
                                                        <tr>
                                                            <th></th>
                                                            <th>Producto</th>
                                                            <th>Precio</th>
                                                            <th>Opciones</th>
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
                </div>
            </div>
        </div>
    </div>
    <?php include_once "Views/template/footer-principal.php"; ?>
    <script src="<?php echo BASE_URL; ?>assets/js/modulos/listaProductos.js"></script>
    <!-- comunicación con las funciones de visualización y manejo de los productos al carrito -->
</body>

</html>