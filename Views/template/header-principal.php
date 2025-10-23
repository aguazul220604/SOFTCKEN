<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- titulo de la página -->
    <title><?php echo TITLE . '-' . $data['title']; ?></title> 
    <!-- favicon de la aplicación -->
    <link rel="icon" href="<?php echo BASE_URL; ?>assets/img/favicon-32x32.png" type="image/png" />
    <!-- estilos de fuente -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <!-- cdn de bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>assets/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>assets/DataTables/datatables.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>assets/css/estilos.css" rel="stylesheet">
    <!-- Acceso a recursos de paypal -->
    <script src="https://www.paypal.com/sdk/js?client-id=<?php echo CLIENT_ID; ?>&currency=<?php echo MONEDA; ?>"></script>
</head>
<!-- animación de carga de la aplicación -->
<div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
    <div class="spinner-grow text-primary" role="status"></div>
</div>
<!-- modal de búsqueda de productos -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-content modal-body">
                <div class="input-group mb-2">
                    <input type="text" class="form-control p-3" placeholder="Buscar" aria-describedby="search-icon-1" id="inputSearch">
                    <button id="search-icon-1" class="input-group-text p-3" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
                <div class="row" id="resultadoBusqueda">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid fixed-top">
    <!-- enlaces de encabezado -->
    <div class="container topbar bg-primary d-none d-lg-block">
        <div class="d-flex justify-content-between">
            <div class="top-info ps-2">
                <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white">Ixmiquilpan Centro, Hidalgo, Mexico</a></small>
                <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white">alitasalex@gmail.com</a></small>
            </div>
            <div class="top-link pe-2">
                <a href="#tabla" class="text-white"><small class="text-white mx-2">Alitas</small>/</a>
                <a href="#tabla" class="text-white"><small class="text-white mx-2">Hamburguesas</small>/</a>
                <a href="#tabla" class="text-white"><small class="text-white ms-2">Tiritas</small></a>
            </div>
        </div>
    </div>
    <div class="container px-0">
        <!-- sección de navegación principal -->
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="index.html" class="navbar-brand">
                <h1 class="text-primary display-6">Alitas Alex</h1>
            </a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <!-- Acceso a los controladores para visualización de vistas -->
                    <a href="<?php echo BASE_URL ?>" class="nav-item nav-link active">Principal</a>
                    <a href="<?php echo BASE_URL . 'principal/shop' ?>" class="nav-item nav-link active">Menú</a>
                    <a href="<?php echo BASE_URL . 'principal/about' ?>" class="nav-item nav-link active">Nosotros</a>
                </div>
                <div class="d-flex m-3 me-0">
                    <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button>
                    <a href="<?php echo BASE_URL . 'principal/producto' ?>" class="position-relative me-4 my-auto <?php echo ($data['perfil'] == 'no') ? '' : 'd-none'; ?>">
                        <i class="fa fa-heart fa-2x" style="color: #FD4D22;"></i>
                        <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;" id="btnCantidadProducto">0</span>
                    </a>
                    <!-- Validación de acceso al sistema  -->
                    <a class="position-relative me-4 my-auto <?php echo ($data['perfil'] == 'no') ? '' : 'd-none'; ?>" id="verCarrito">
                        <i class="fa fa-shopping-bag fa-2x" style="color: #FD4D22;"></i>
                        <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;" id="btnCantidadCarrito">0</span>
                    </a>
                    <!-- Visualizacón de elementos de verificación de inicio de sesión -->
                    <?php if (!empty($_SESSION['correoCliente'])) { ?>
                        <a href="<?php echo BASE_URL . 'clientes' ?>" class="position-relative me-4 my-auto">
                            <i class="fas fa-user fa-2x" style="color: #FD4D22;"></i>
                        </a>
                        <BR></BR>
                        <a href="<?php echo BASE_URL . 'clientes/salir'; ?>" class="position-relative me-4 my-auto">
                            <i class="fas fa-sign-out-alt fa-2x" style="color: #FD4D22;"></i>
                        </a>
                    <?php } else { ?>
                        <a class="my-auto" data-bs-toggle="modal" data-bs-target="#ModalLogin">
                            <i class="fas fa-user fa-2x" style="color: #FD4D22;"></i>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </nav>
    </div>
</div>