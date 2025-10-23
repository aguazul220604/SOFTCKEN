<?php include_once "Views/template/header-principal.php"; ?>

<body>
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
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
        <h1 class="text-center text-white display-6">Detalle de producto</h1>
    </div> 

    <div class="container-fluid py-5 mt-10">
        <!-- contenedor de datos del producto seleccionado -->
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-9 col-xl-10">
                    <div class="row g-3">
                        <div class="col-lg-5">
                            <!-- recolección de datos del producto -->
                            <div>
                                <a href="#">
                                    <img src="<?php echo BASE_URL . $data['producto']['img']; ?>" class="img-fluid rounded" alt="Image" style="width: 300px; height:300px" >
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <h4 class="fw-bold mb-3"><?php echo $data['producto']['nombre']; ?></h4>
                            <p class="mb-3">Categoría: <?php echo $data['producto']['categoria']; ?></p>
                            <h5 class="text-dark fs-10 fw-bold mb-4">$<?php echo $data['producto']['precio'] . MONEDA; ?></h5>
                            <div class="d-flex mb-6">
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <p class="mb-4"><?php echo $data['producto']['descripcion']; ?></p>
                            <div class="input-group quantity mb-5" style="width: 100px;">
                            <!-- identificador id del producto -->
                                <input type="hidden" id="idProducto" value="<?php echo $data['producto']['id']; ?>" readonly>
                                
                                <div class="input-group quantity mb-5" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <!-- input de modificación de cantidad que se envía a la función de carrito (detail.js) para añadir productos mediante el identificaro del elemento html input  -->
                                    <input type="text" class="form-control form-control-sm text-center border-0 cantidadProd" value="1" id="cantidad" readonly>
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <a class="btn border border-secondary rounded-pill px-3 text-primary btnAddCarrito1" prod1="<?php echo $data['producto']['id']; ?>"><i class="fa fa-shopping-bag me-2 text-primary"></i>Carrito</a>
                                <!-- enlace de comunicación con la función para agregar productos al carrito -->    
                            </div>
                        </div>
                        <!-- enlace de retorno al menú principal -->
                        <a href="<?php echo BASE_URL . 'principal/Shop' ?>" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fas fa-bars me-2 text-primary"></i>Menú</a>    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'Views/template/footer-principal.php'; ?>
    <script src="<?php echo BASE_URL; ?>assets/js/modulos/detail.js"></script>
</body>

</html>