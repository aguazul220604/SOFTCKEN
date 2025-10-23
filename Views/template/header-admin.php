<!doctype html>
<html lang="en" class="semi-dark">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- favicon de la aplicación  -->
	<link rel="icon" href="<?php echo BASE_URL; ?>assets/img/favicon-32x32.png" type="image/png" />
	<link href="<?php echo BASE_URL; ?>assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
	<!-- estilos de diseño -->
	<link href="<?php echo BASE_URL; ?>assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="<?php echo BASE_URL; ?>assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="<?php echo BASE_URL; ?>assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<link href="<?php echo BASE_URL; ?>assets/css/pace.min.css" rel="stylesheet" />
	<script src="<?php echo BASE_URL; ?>assets/js/pace.min.js"></script>
	<link href="<?php echo BASE_URL; ?>assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="<?php echo BASE_URL; ?>assets/css/app.css" rel="stylesheet">
	<link href="<?php echo BASE_URL; ?>assets/css/icons.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/semi-dark.css" />
	<!-- estilos de fuentes -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
	<link href="<?php echo BASE_URL; ?>assets/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
	<link href="<?php echo BASE_URL; ?>assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
	<!-- estilos de bootstrap -->
	<link href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<!-- plugin de DataTables -->
	<link href="<?php echo BASE_URL; ?>assets/DataTables/datatables.min.css" rel="stylesheet">
	<!-- Hoja de estilos principal -->
	<link href="<?php echo BASE_URL; ?>assets/css/style.css" rel="stylesheet">
	<title><?php echo TITLE . '-' . $data['title']; ?></title>
</head>

<body>
	<div class="wrapper">
		<!-- contenedor del menú principal del panel administrativo -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="<?php echo BASE_URL; ?>assets/img/logo.png" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text">Softcken</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<ul class="metismenu" id="menu">
				<!-- secciones del menú principal -->
				<li>
					<a href="<?php echo BASE_URL . 'admin/home'; ?>">
						<div class="parent-icon"><i class='bx bx-home-circle'></i></div>
						<div class="menu-title"> Panel principal</div>
					</a>
				</li>
				<li>
					<a href="<?php echo BASE_URL . 'usuarios'; ?>">
						<div class="parent-icon"><i class='fas fa-users'></i></div>
						<div class="menu-title"> Usuarios</div>
					</a>
				</li>
				<li>
					<a href="<?php echo BASE_URL . 'categorias'; ?>">
						<div class="parent-icon"><i class='fa fa-bars'></i></div>
						<div class="menu-title"> Categorías</div>
					</a>
				</li>
				<li>
					<a href="<?php echo BASE_URL . 'productos'; ?>">
						<div class="parent-icon"><i class='fa fa-check-circle'></i></div>
						<div class="menu-title"> Productos</div>
					</a>
				</li>
				<li>
					<a href="<?php echo BASE_URL . 'pedidos'; ?>">
						<div class="parent-icon"><i class="fa fa-cubes"></i></div>
						<div class="menu-title"> Pedidos</div>
					</a>
				</li>
			</ul>
		</div>
		<header>
			<div class="topbar d-flex align-items-center">
				<!-- encabezado principal del panel administrativo -->
				<nav class="navbar navbar-expand">
					<div class="user-box dropdown">
						<!-- datos de inicio de sesión -->
						<a class="d-flex align-items-center nav-link " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<i class="fas fa-user fa-2x" style="color: #FFFFFF;"></i>
							<div class="user-info ps-3">
								<p class="user-name mb-0 text-white"><?php echo $_SESSION['nombre_usuario']; ?></p>
								<p class="designattion mb-0 text-white"><?php echo $_SESSION['email']; ?></p>
							</div>
						</a>
					</div>
					<div class="top-menu ms-auto">
						<!-- cerrar sesión de usuario -->
						<ul class="navbar-nav align-items-center">
							<li class="nav-item dropdown dropdown-large">
								<a class="dropdown-item" href="<?php echo BASE_URL . 'admin/salir'; ?>">
									<i class='bx bx-log-out-circle'></i>
									<span>Cerrar sesión</span>
								</a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</header>
		<div class="page-wrapper">
			<div class="page-content">