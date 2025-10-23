<!doctype html>
<html lang="en">
<!-- header del login del panel administrativo -->
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?php echo BASE_URL; ?>assets/img/favicon-32x32.png" type="image/png" />
	<link href="<?php echo BASE_URL; ?>assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="<?php echo BASE_URL; ?>assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="<?php echo BASE_URL; ?>assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<link href="<?php echo BASE_URL; ?>assets/css/pace.min.css" rel="stylesheet" />
	<script src="<?php echo BASE_URL; ?>assets/js/pace.min.js"></script>
	<link href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo BASE_URL; ?>assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="<?php echo BASE_URL; ?>assets/css/app.css" rel="stylesheet">
	<link href="<?php echo BASE_URL; ?>assets/css/icons.css" rel="stylesheet">
	<title><?php echo $data['title']; ?></title>
</head>
<body class="bg-login">
	<div class="wrapper">
		<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container-fluid">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
					<div class="col mx-auto">
						<div class="mb-4 text-center">
							<img src="<?php echo BASE_URL; ?>assets/img/logo.png" width="180" alt="" />
						</div>
						<div class="card">
							<div class="card-body">
								<div class="p-4 rounded">
									<div class="text-center">
										<h2 class="">Panel Administrativo</h2>
										<h4>Alitas ALEX</h4>
										<h5>Softcken</h5>
									</div>
								</div>
								<!-- Inicio de sesión del panel administrativo -->
								<div class="form-body">
									<form class="row g-3" id="formularioLogin">
										<div class="col-12">
											<label for="email" class="form-label">Correo electrónico</label>
											<input type="email" class="form-control" id="email" name="email">
										</div>

										<div class="col-12">
											<label for="clave" class="form-label"><i class="fas fa-key"></i> Contraseña</label>
											<div class="input-group">
												<input class="form-control border-end-0" id="clave" name="clave" placeholder="Contraseña">
												<div class="input-group-append">
													<span class="input-group-text eye-icon" onclick="togglePasswordVisibility('clave')">
														<i class="bx bx-show" id="eyeIcon"></i>
													</span>
												</div>
											</div>
										</div>
										<script>
											function togglePasswordVisibility(inputId) {
												var input = document.getElementById(inputId);
												var eyeIcon = document.getElementById('eyeIcon');

												if (input.type === 'password') {
													input.type = 'text';
													eyeIcon.classList.remove('bx bx-show');
													eyeIcon.classList.add('bx bx-hide');
												} else {
													input.type = 'password';
													eyeIcon.classList.remove('bx bx-hide');
													eyeIcon.classList.add('bx bx-show');
												}
											}
										</script>
										<style>
											.eye-icon {
												cursor: pointer;
												background-color: orangered;
												color: white;
												height: 40px;
												border: 15px solid orangered;
												border-radius: 10px;
											}
										</style>


										<div class="col-12">
											<div class="d-grid">
												<button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Entrar</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	<script src="<?php echo BASE_URL; ?>assets/js/bootstrap.bundle.min.js"></script>
	<script src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script>
	<script src="<?php echo BASE_URL; ?>assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="<?php echo BASE_URL; ?>assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="<?php echo BASE_URL; ?>assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script>
		$(document).ready(function() {
			$("#show_hide_password a").on('click', function(event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
	</script>
	<script src="<?php echo BASE_URL; ?>assets/js/app.js"></script>
	<script>
		const base_url = '<?php echo BASE_URL; ?>';
	</script>
	<script src="<?php echo BASE_URL; ?>assets/js/modulos/login.js"></script>
	<script src="<?php echo BASE_URL; ?>assets/js/sweetalert2.all.min.js"></script>
</body>

</html>