<?php include_once 'Views/template/header-admin.php'; ?>
<!-- informe de productos y estdo de pedidos -->
<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
	<div class="col">
		<div class="card radius-10 border-primary border-start border-0 border-4">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div>
						<p class="mb-0">Pedidos pendientes</p>
						<h4 class="my-1 text-primary"><?php echo $data['pendientes']['total']; ?></h4>
					</div>
					<div class="text-primary ms-auto font-35"><i class="fas fa-exclamation-circle"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col">
		<div class="card radius-10 border-primary border-start border-0 border-4">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div>
						<p class="mb-0">Pedidos en proceso</p>
						<h4 class="my-1 text-primary"><?php echo $data['proceso']['total']; ?></h4>
					</div>
					<div class="text-primary ms-auto font-35"><i class="fas fa-spinner"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col">
		<div class="card radius-10  border-primary border-start border-0 border-4">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div>
						<p class="mb-0">Pedidos finalizados</p>
						<h4 class="text-primary my-1"><?php echo $data['finalizados']['total']; ?></h4>
					</div>
					<div class="text-primary ms-auto font-35"><i class="fas fa-check-circle"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col">
		<div class="card radius-10 border-primary border-start border-0 border-4">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div>
						<p class="mb-0">Productos totales</p>
						<h4 class="my-1 text-primary"><?php echo $data['productos']['total']; ?></h4>
					</div>
					<div class="text-primary ms-auto font-35"><i class="fas fa-hamburger"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Graficación principal del panel administrativo --> 
<div class="row">
	<div class="col-12 col-lg-12">
		<div class="card radius-10">
			<div class="card-header">
				<div class="d-flex align-items-center">
					<div>
						<h6 class="mb-0">Gestión de pedidos</h6>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="chart-container-0">
					<canvas id="reportePedidos"></canvas>
				</div>
			</div>
		</div>
	</div>
	<div class="col-12 col-lg-12">
		<div class="card radius-10">
			<div class="card-header">
				<div class="d-flex align-items-center">
					<div>
						<h6 class="mb-0">Gestión de productos</h6>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="chart-container1">
					<canvas id="productosMinimos"></canvas>
				</div>
			</div>
		</div>
	</div>
	<div class="col-12 col-lg-12">
		<div class="card radius-10">
			<div class="card-header">
				<div class="d-flex align-items-center">
					<div>
						<h6 class="mb-0">Productos con mayor demanda</h6>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="chart-container1">
					<canvas id="productosTop"></canvas>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="card radius-10 w-100">
	<div class="card-header">
		<div class="d-flex align-items-center">
			<div>
				<h6 class="mb-0">Sucursales</h6>
			</div>
		</div>
	</div>
	<!-- Mapa de Sucursales del negocio -->
	<div class="card-body">
		<div class="chart-container1">
		<iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d142150.7503652807!2d-99.23144053195607!3d20.57011156511047!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sAlitas%20Alex!5e0!3m2!1ses-419!2smx!4v1711133594542!5m2!1ses-419!2smx" class="rounded w-100" style="height: 400px; border:0;"  width="600" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div>
	</div>
</div>
<?php include_once 'Views/template/footer-admin.php'; ?>
<script>
	var ctx = document.getElementById("reportePedidos").getContext("2d");
	var myChart = new Chart(ctx, {
		type: "doughnut",
		data: {
			labels: ["Pendientes", "Proceso", "Finalizados"],
			datasets: [{
				backgroundColor: ["#FF4520", "#FF6019", "#FF8218"],
				hoverBackgroundColor: ["#FF4520", "#FF6019", "#FF8218"],
				data: [<?php echo $data['pendientes']['total']; ?>, <?php echo $data['proceso']['total']; ?>, <?php echo $data['finalizados']['total']; ?>],
				borderWidth: [1, 1, 1],
			}, ],
		},
		options: {
			maintainAspectRatio: false,
			cutoutPercentage: 75,
			legend: {
				position: "bottom",
				display: true,
				labels: {
					boxWidth: 20,
				},
			},
			tooltips: {
				displayColors: false,
			},
		},
	});
</script>
<script src="<?php echo BASE_URL; ?>assets/js/index.js"></script>
</body>

</html>