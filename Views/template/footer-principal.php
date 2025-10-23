<!-- modal del carrito de usuario-->
<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white"><i class="fa fa-shopping-bag"></i> Carrito</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle" id="tablaListaCarrito">
                        <thead class="bg-dark text-white">
                            <!-- tabla de productos -->
                            <tr>
                                <th>Producto</th>
                                <th>Nombre</th>
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
            <!-- verificación de inicio de sesión -->
            <div class="d-flex justify-content-around mb-3">
                <h3 id="totalGeneral">$</h3>
                <?php if (!empty($_SESSION['correoCliente'])) { ?>
                    <a class="btn btn-outline-primary" href="<?php echo BASE_URL . 'clientes'; ?>">Procesar pedido</a>
                <?php } else { ?>
                    <a class="btn btn-outline-primary" href="#" onclick="abrirModalLogin();">Acceder</a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- Modal de inicio de sesión -->
<div class="modal fade" tabindex="-1" role="dialog" id="ModalLogin">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="titleLogin"><i class="fas fa-user"></i> Iniciar sesión</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body m-3">
                <form action="" method="get">
                    <div class="text-center">
                        <img src="<?php echo BASE_URL . 'assets/img/logo.png'; ?>" alt="" style="width: 350px; height: 215px;">
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="frmLogin">
                            <!-- formulario de login de usuario -->
                            <div class="form-group mb-3">
                                <label for="correoLogin"><i class="fas fa-envelope"></i> Correo</label>
                                <input id="correoLogin" class="form-control" type="text" name="correoLogin" placeholder="Correo electrónico">
                            </div>

                            <div class="form-group mb-3">
                                <label for="claveLogin"><i class="fas fa-key"></i> Contraseña</label>
                                <div class="input-group">
                                    <input id="claveLogin" class="form-control border-end-0" type="password" name="claveLogin" placeholder="Contraseña">
                                    <div class="input-group-append">
                                        <span class="input-group-text" onclick="togglePasswordVisibility('claveLogin')">
                                            <i id="eyeIconLogin" class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <a href="#" id="btnRegisto">¿Aún no estás registrado?</a>
                            <div class="float-end">
                                <button class="btn btn-primary btn-lg text-white" type="button" id="login">Acceder</button>
                            </div>
                        </div>
                        <div class="col-md-12 d-none" id="frmRegistro">
                            <!-- registro de nuevo usuario -->
                            <div class="form-group mb-3">
                                <label for="nombreRegistro"><i class="fas fa-list"></i> Nombre</label>
                                <input id="nombreRegistro" class="form-control" type="text" name="nombreRegistro" placeholder="Nombre completo">
                            </div>
                            <div class="form-group mb-3">
                                <label for="correoRegistro"><i class="fas fa-envelope"></i> Correo</label>
                                <input id="correoRegistro" class="form-control" type="text" name="correoRegistro" placeholder="Correo electrónico">
                            </div>

                            <div class="form-group mb-3">
                                <label for="claveRegistro"><i class="fas fa-key"></i> Contraseña</label>
                                <div class="input-group">
                                    <input id="claveRegistro" class="form-control" type="password" name="claveRegistro" placeholder="Contraseña">
                                    <div class="input-group-append">
                                        <span class="input-group-text" onclick="togglePasswordVisibility('claveRegistro')">
                                            <i id="eyeIconRegistro" class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="claveConfirmar"><i class="fas fa-key"></i> Confirmar contraseña</label>
                                <div class="input-group">
                                    <input id="claveConfirmar" class="form-control" type="password" name="claveConfirmar" placeholder="Confirmar contraseña">
                                    <div class="input-group-append">
                                        <span class="input-group-text" onclick="togglePasswordVisibility('claveConfirmar')">
                                            <i id="eyeIconConfirmar" class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <script>
                                function togglePasswordVisibility(inputId) {
                                    var input = document.getElementById(inputId);
                                    var eyeIcon = document.getElementById('eyeIcon' + inputId.charAt(0).toUpperCase() + inputId.slice(1));

                                    if (input.type === 'password') {
                                        input.type = 'text';
                                        eyeIcon.classList.replace('fas', 'fa');
                                        eyeIcon.classList.remove('fa-eye');
                                        eyeIcon.classList.add('fa-eye-slash');
                                    } else {
                                        input.type = 'password';
                                        eyeIcon.classList.replace('fa', 'fas');
                                        eyeIcon.classList.remove('fa-eye-slash');
                                        eyeIcon.classList.add('fa-eye');
                                    }
                                }
                            </script>
                            <style>
                                .input-group-text {
                                    cursor: pointer;
                                    background-color: orangered;
                                    color: white;
                                    height: 40px;
                                    border: 15px solid orangered;
                                    border-radius: 10px;
                                }
                            </style>




                            <a href="#" id="btnLogin">¿Ya estás registrado?</a>
                            <div class="float-end">
                                <button class="btn btn-primary btn-lg text-white" type="button" id="registro">Registrar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Footer de la aplicación -->
<div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
    <div class="container py-5">
        <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
            <div class="row g-4">
                <div class="col-lg-3">
                    <a href="#">
                        <h1 class="text-primary mb-0">Alitas Alex</h1>
                        <p class="text-secondary mb-0">Para calmar tu antojo</p>
                    </a>
                </div>
                <div class="col-lg-6">
                    <div class="position-relative mx-auto">

                        <?php if (!empty($_SESSION['correoCliente'])) { ?>
                            <a href="<?php echo BASE_URL . 'principal/Shop' ?>" class="text-white text-decoration-none">
                                <button type="button" class="btn btn-primary border-0 border-secondary py-3 px-4 position-absolute rounded-pill text-white" style="top: 0; right: 0;">Regístrate ahora</button>
                            </a>
                        <?php } else { ?>
                            <button type="submit" class="btn btn-primary border-0 border-secondary py-3 px-4 position-absolute rounded-pill text-white" style="top: 0; right: 0;" data-bs-toggle="modal" data-bs-target="#ModalLogin">Regístrate ahora</button>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="d-flex justify-content-end pt-3">
                        <a class="btn  btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <div class="footer-item">
                    <h4 class="text-light mb-3">¡La mejor elección!</h4>
                    <p class="mb-4">Ven a visitarnos en Ixmiquilpan</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-flex flex-column text-start footer-item">
                    <h4 class="text-light mb-3">Información</h4>
                    <a class="btn-link" href="<?php echo BASE_URL . 'principal/About' ?>">Nosotros</a>
                    <a class="btn-link" href="<?php echo BASE_URL . 'principal/Shop' ?>">Menú</a>
                    <a class="btn-link" href="<?php echo BASE_URL . 'home' ?>">Principal</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-flex flex-column text-start footer-item">
                    <h4 class="text-light mb-3">Alitas Alex</h4>
                    <a class="btn-link" href="">Mi cuenta</a>
                    <a class="btn-link" href="" data-bs-toggle="modal" data-bs-target="#ModalLogin">Registrarse</a>
                    <a class="btn-link" href="" data-bs-toggle="modal" data-bs-target="#ModalLogin">Acceder</a>
                    <a class="btn-link" href="<?php echo BASE_URL . 'principal/Shop' ?>">Ordenar</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-item">
                    <h4 class="text-light mb-3">Contacto</h4>
                    <p>Ixmiquilpan Centro</p>
                    <p>San Miguel, Ixmiquilpan</p>
                    <p>San Nicolás, Ixmiquilpan</p>
                    <p>MÉTODOS DE PAGO</p>
                    <img src="assets/img/payment.png" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- archivos js del sistema -->
<a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/lib/easing/easing.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/lib/waypoints/waypoints.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/lib/lightbox/js/lightbox.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/lib/owlcarousel/owl.carousel.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/app.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/sweetalert2.all.min.js"></script>
<!-- declaración de variable url del sistema -->
<script>
    const base_url = '<?php echo BASE_URL; ?>';
</script>
<script src="<?php echo BASE_URL; ?>assets/js/carrito.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/login.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/main.js"></script>