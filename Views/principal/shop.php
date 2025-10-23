<?php include_once "Views/template/header-principal.php"; ?>

<body>
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <BR></BR>
            <BR></BR>
            <h1 class="mb-4">¿Listo para una explosión de sabor?</h1>
            <BR></BR>
            <div class="row g-4">
                <div class="col-lg-14">
                    <div class="col-lg-14" id="tab-0">
                        <div class="row g-4 justify-content-center">
                            <!-- listado completo de productos del menú a partir del controlador-->
                            <?php foreach ($data['productos'] as $productos) { ?>
                                <div class="col-md-6 col-lg-6 col-xl-4">
                                    <a href="<?php echo BASE_URL . 'shop/details/' . $productos['id']; ?>">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="<?php echo BASE_URL . $productos['img']; ?>" class="img-fluid w-100 rounded-top" alt="" style="width: 100px; height: 300px;">
                                            </div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4><?php echo nl2br($productos['nombre']); ?></h4>
                                                <p><?php echo nl2br($productos['descripcion']); ?></p>
                                                <p class="text-dark fs-5 fw-bold mb-0">$<?php echo $productos['precio'] . MONEDA; ?></p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <a class="btn border border-secondary rounded-pill px-3 text-primary btnAdd" prod="<?php echo $productos['id']; ?>"><i class="fa fa-heart me-2 text-primary"></i></a>
                                                    <a class="btn border border-secondary rounded-pill px-3 text-primary btnAddCarrito" prod="<?php echo $productos['id']; ?>"><i class="fa fa-shopping-bag me-2 text-primary"></i>Carrito</a>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                            <?php } ?>
                            <!-- paginación del menú principal -->
                            <div class="col-12">
                                <div class="pagination d-flex justify-content-center mt-5">
                                    <?php
                                    $anterior = $data['pagina'] - 1;
                                    $siguiente = $data['pagina'] + 1;
                                    if ($anterior > 0) {
                                        echo '<a class="rounded" href="' . BASE_URL . 'principal/shop/' . $anterior . '">&laquo; Anterior</a>';
                                    }
                                    if ($data['total'] >= $siguiente) {
                                        echo '<a class="rounded" href="' . BASE_URL . 'principal/shop/' . $siguiente . '">Siguiente &raquo;</a>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'Views/template/footer-principal.php'; ?>
</body>

</html>