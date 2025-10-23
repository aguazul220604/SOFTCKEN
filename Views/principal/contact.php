<?php include_once 'Views/template/header-principal.php'; ?>

<body>
    <!-- modal de búsqueda de productos -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
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
        <h1 class="text-center text-white display-6">Nosotros</h1>
    </div>
    <div class="container-fluid contact py-5">
        <div class="container py-5">
            <div class="p-5 bg-light rounded">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="text-center mx-auto" style="max-width: 700px;">
                            <h1 class="text-primary">Nuestras sucursales</h1>
                            <p class="mb-4">Estamos distribuidos en todo Ixmiquilpan<a href="https://htmlcodex.com/contact-form"></a></p>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="h-100 rounded">
                            <!-- mapa de sucursales del negocio -->
                        <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d142150.7503652807!2d-99.23144053195607!3d20.57011156511047!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sAlitas%20Alex!5e0!3m2!1ses-419!2smx!4v1711133594542!5m2!1ses-419!2smx" class="rounded w-100" style="height: 400px; border:0;"  width="600" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'Views/template/footer-principal.php'; ?>
</body>

</html>