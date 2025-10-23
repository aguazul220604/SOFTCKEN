<?php include_once 'Views/template/header-principal.php'; ?>
<body>
    <!-- modal de búsqueda de productos -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
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
    <div class="container-fluid py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-md-12 col-lg-7">
                    <h4 class="mb-3 text-secondary">Ordena ahora</h4>
                    <h1 class="mb-5 display-3 text-primary">¡Para calmar tu antojo!</h1>
                    <div class="position-relative mx-auto">
                        <!-- veriicación de inicio de sesión -->
                        <?php if (!empty($_SESSION['correoCliente'])) { ?>
                            <button type="submit" class="w-55 btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-140" style="top: 0; right: 25%;">
                                <a href="<?php echo BASE_URL . 'principal/Shop' ?>" class="text-white text-decoration-none">Ordena ahora</a>
                            </button>
                        <?php } else { ?>
                            <button type="submit" class="w-55 btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-140" style="top: 0; right: 25%;" data-bs-toggle="modal" data-bs-target="#ModalLogin"> Ordena ahora</button>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-12 col-lg-5">
                    <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active rounded">
                                <img src="<?php echo BASE_URL; ?>assets/img/logo.png" class="img-fluid w-150 h-150 rounded" alt="First slide">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid fruite py-5" id="tabla">
        <div class="container py-5">
            <div class="tab-class text-center">
                <div class="row g-4">
                    <div class="col-lg-4 text-start">
                        <h1>Conoce nuestros productos</h1>
                        <!-- visualización de productos por sección -->
                    </div>
                    <BR></BR>
                    <div class="col-lg-8 text-end">
                        <ul class="nav nav-pills d-inline-flex text-center mb-5">
                            <li class="nav-item">
                                <a class="d-flex py-2 m-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-1">
                                    <span class="text-dark" style="width: 230px;">Todos nuestros productos</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="d-flex py-2 m-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-2">
                                    <span class="text-dark" style="width: 130px;">Alitas</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="d-flex py-2 m-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-3">
                                    <span class="text-dark" style="width: 130px;">Tiritas</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="d-flex py-2 m-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-4">
                                    <span class="text-dark" style="width: 130px;">Hamburguesas</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <BR></BR>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    <!-- Obtención de datos del controlador para visualización -->
                                    <?php foreach ($data['productos'] as $productos) { ?>
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <img src="<?php echo BASE_URL . $productos['img']; ?>" width="300px" height="300px">
                                                </div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4><?php echo nl2br($productos['nombre']); ?></h4>
                                                    <BR>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0">$<?php echo $productos['precio'] . MONEDA; ?></p>
                                                        <BR>
                                                        <a href="<?php echo BASE_URL . 'shop/details/' . $productos['id']; ?>" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Agregar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    <?php
                                    foreach ($data['productos2'] as $producto2) {  ?>
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <img src="<?php echo BASE_URL . $producto2['img']; ?>" width="300px" height="300px">
                                                </div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4><?php echo $producto2['nombre']; ?></h4>
                                                    <BR>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0">$<?php echo $producto2['precio'] . MONEDA; ?></p>
                                                        <BR>
                                                        <a href="<?php echo BASE_URL . 'shop/details/' . $productos['id']; ?>" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Agregar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-3" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    <?php
                                    foreach ($data['productos3'] as $producto3) {  ?>
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <img src="<?php echo BASE_URL . $producto3['img']; ?>" width="300px" height="300px">
                                                </div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4><?php echo $producto3['nombre']; ?></h4>
                                                    <BR>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0">$<?php echo $producto3['precio'] . MONEDA; ?></p>
                                                        <BR>
                                                        <a href="<?php echo BASE_URL . 'shop/details/' . $productos['id']; ?>" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Agregar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-4" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    <?php
                                    foreach ($data['productos1'] as $producto1) {  ?>
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <img src="<?php echo BASE_URL . $producto1['img']; ?>" width="300px" height="300px">
                                                </div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4><?php echo $producto1['nombre']; ?></h4>
                                                    <BR>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0">$<?php echo $producto1['precio'] . MONEDA; ?></p>
                                                        <BR>
                                                        <a href="<?php echo BASE_URL . 'shop/details/' . $productos['id']; ?>" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Agregar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contenedor de datos del negocio -->
    <div class="container-fluid featurs py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fa fa-star fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <p class="mb-0">Atención rápida</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fas fa-user-shield fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <p class="mb-0">Pagos seguros</p>
                        </div>
                    </div>
          
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fa fa-phone-alt fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <p class="mb-0">Llama a sucursal</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fa fa-thumbs-up fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <p class="mb-0">Excelente servicio</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid service py-5">
        <div class="container py-5">
            <h1 class="mb-0">Deliciosamente, los mejores</h1>
            <BR></BR>
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <a href="#tabla">
                        <div class="service-item bg-secondary rounded border border-secondary">
                            <img src="<?php echo BASE_URL; ?>assets/img/tiras.png" class="img-fluid rounded-top w-100" alt="" style="width: 100px; height: 300px;">
                            <div class="px-4 rounded-bottom">
                                <div class="service-content bg-primary text-center p-4 rounded">
                                    <h5 class="text-white">Tiritas</h5>
                                    <h3 class="mb-0">crujientes</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="#tabla">
                        <div class="service-item bg-dark rounded border border-dark">
                            <img src="<?php echo BASE_URL; ?>assets/img/ham.png" class="img-fluid rounded-top w-100" alt="" style="width: 100px; height: 300px;">
                            <div class="px-4 rounded-bottom">
                                <div class="service-content bg-light text-center p-4 rounded">
                                    <h5 class="text-primary">Hamburguesas</h5>
                                    <h3 class="mb-0">deliciosas</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="#tabla">
                        <div class="service-item bg-primary rounded border border-primary">
                            <img src="<?php echo BASE_URL; ?>assets/img/alitas.png" class="img-fluid rounded-top w-100" alt="" style="width: 100px; height: 300px;">
                            <div class="px-4 rounded-bottom">
                                <div class="service-content bg-secondary text-center p-4 rounded">
                                    <h5 class="text-white">Alitas</h5>
                                    <h3 class="mb-0">exquísitas</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid vesitable py-5">
        <div class="container py-5">
            <!-- listado de productos del menú -->
            <h1 class="mb-0">¿Listo para una explosión de sabor? ¡Prueba nuestras alitas!</h1>
            <div class="owl-carousel vegetable-carousel justify-content-center">
                <?php foreach ($data['productos'] as $productos) { ?>
                    <div class="border border-primary rounded position-relative vesitable-item">
                        <div class="vesitable-img">
                            <img src="<?php echo BASE_URL . $productos['img']; ?>" class="img-fluid w-100 rounded-top bg-light" alt="" style="width: 100px; height: 250px;">
                        </div>
                        <div class="p-4 rounded-bottom">
                            <h4><?php echo nl2br($productos['nombre']); ?></h4>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <a href="<?php echo BASE_URL . 'shop/details/' . $productos['id']; ?>" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Agregar</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="container-fluid banner bg-secondary my-5">
        <div class="container py-5">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <div class="py-4">
                        <h1 class="display-3 text-white">Cada bocado es una experiencia</h1>
                        <p class="fw-normal display-3 text-dark mb-4">¡Es un sabor inigualable!</p>
                        <p class="mb-4 text-dark">La mejor selección de alitas y hamburguesas para satisfacer tus antojos</p>
                        <!-- verificación de inicio de sesión-->
                        <?php if (!empty($_SESSION['correoCliente'])) { ?>
                            <a href="<?php echo BASE_URL . 'principal/Shop' ?>" class="banner-btn btn border-2 border-white rounded-pill text-dark py-3 px-5 text-white">ORDENA AHORA</a>
                        <?php } else { ?>
                            <a class="banner-btn btn border-2 border-white rounded-pill text-dark py-3 px-5 text-white" data-bs-toggle="modal" data-bs-target="#ModalLogin">ORDENA AHORA</a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="position-relative">
                        <img src="<?php echo BASE_URL; ?>assets/img/pollo.png" class="img-fluid w-100 rounded" alt="">
                        <div class="d-flex align-items-center justify-content-center bg-white rounded-circle position-absolute" style="width: 140px; height: 140px; top: 0; left: 0;">
                            <h1 style="font-size: 100px;">$75.</h1>
                            <div class="d-flex flex-column">
                                <span class="h2 mb-0">00</span>
                                <span class="h2 mb-0">MXN</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5" style="max-width: 700px;">
                <h1 class="display-4">¡Las mejores alitas de pollo!</h1>
                <p>Consiente tu paladar con el sabor de nuestras exquísitas alitas de pollo</p>
            </div>
            <!-- listado de productos del controlador -->
            <div class="row g-4">
                <?php foreach ($data['productos2'] as $productos2) { ?>
                    <div class="col-lg-6 col-xl-4">
                        <div class="p-4 rounded bg-light">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <img src="<?php echo BASE_URL . $productos2['img']; ?>" class="img-fluid rounded-circle w-100" alt="">
                                </div>
                                <div class="col-6">
                                    <a href="#" class="h5"><?php echo nl2br($productos2['nombre']); ?></a>
                                    <div class="d-flex my-3">
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                    </div>
                                    <h4 class="text-dark fs-5 fw-bold mb-0">$<?php echo $producto1['precio'] . MONEDA; ?></h4>
                                    <a href="<?php echo BASE_URL . 'shop/details/' . $productos['id']; ?>" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Agregar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- datos del negocio -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="bg-light p-5 rounded">
                <div class="row g-4 justify-content-center">
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-check-circle text-secondary"></i>
                            <h4>Productos de calidad</h4>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-users text-secondary"></i>
                            <h4>Clientela satisfecha</h4>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-star text-secondary"></i>
                            <h4>Excelente servicio</h4>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-heart text-secondary"></i>
                            <h4>Atención amable</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'Views/template/footer-principal.php'; ?>
</body>

</html>