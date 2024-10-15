<?php

// Incluir helpers
require_once realpath(__DIR__ . "/../core/ViewHelpers.php");

startSection('title'); ?>
    Home
<?php endSection(); ?>

<?php startSection('content'); ?>
	<section class="banner" style="background-image: url('/images/principal.jpg');">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12 col-xl-7">
					<div class="block">
						<div class="divider mb-3"></div>
						<span class="text-uppercase text-sm letter-spacing text-white">Ponte en forma</span>
						<h1 class="mb-3 mt-3 shadow-white">Lorem ipsum dolor sit amet.</h1>
						
						<p class="mb-4 pr-5 text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis provident placeat, at ratione ullam cumque.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="features">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="feature-block d-lg-flex">
						<div class="feature-item mb-5 mb-lg-0">
							<div class="feature-icon mb-4">
								<i class="icofont-surgeon-alt"></i>
							</div>
							<span>24 Horas de servicio</span>
							<h4 class="mb-3">Dirección</h4>
							<p class="mb-4">Av. numero 123</p>
						</div>
					
						<div class="feature-item mb-5 mb-lg-0">
							<div class="feature-icon mb-4">
								<i class="icofont-ui-clock"></i>
							</div>
							<h4 class="mb-3">Horario</h4>
							<ul class="w-hours list-unstyled">
								<li class="d-flex justify-content-between">Sun - Wed : <span>8:00 - 17:00</span></li>
								<li class="d-flex justify-content-between">Thu - Fri : <span>9:00 - 17:00</span></li>
								<li class="d-flex justify-content-between">Sat - sun : <span>10:00 - 17:00</span></li>
							</ul>
						</div>
					
						<div class="feature-item mb-5 mb-lg-0">
							<div class="feature-icon mb-4">
								<i class="icofont-support"></i>
							</div>
							<span>Telefono</span>
							<h4 class="mb-3">1-800-700-6200</h4>
							<p>Para reservas .</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="cta-section ">
		<div class="container">
			<div class="cta position-relative">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6">
						<div class="counter-stat">
							<i class="icofont-doctor"></i>
							<span class="h3 counter" id="customer-counter" data-count="">0</span>
							<p>Clientes</p>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6">
						<div class="counter-stat">
							<i class="icofont-flag"></i>
							<span class="h3 counter" id="coach-counter" data-count="">0</span>
							<p>Entrenadores</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="section testimonial-2 gray-bg">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-7">
					<div class="section-title text-center">
						<h2>Nuestros planes</h2>
						<div class="divider mx-auto my-4"></div>
						<p>Lets know moreel necessitatibus dolor asperiores illum possimus sint voluptates incidunt molestias nostrum laudantium. Maiores porro cumque quaerat.</p>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-12 testimonial-wrap-2" id="plans"></div>
			</div>
		</div>
	</section>
<?php endSection(); ?>
<?php startSection('scripts'); ?>
	<script>
		const api_admin_url = "<?php echo $_ENV['API_ADMIN_URL']; ?>";
		const id = document.getElementById("id").value;

		$.ajax({
            type: "get",
            url: `${api_admin_url}/home/logo/${id}`,
            dataType: "json",
            success: function (response) {
                if (response.logo_path != null) {
                    $('.img-logo').attr("src", response.logo_path);
                } else {
                    $('.img-logo').attr("src", '/novena/images/logo.png');
                }
            }
        });

		$.ajax({
			type: 'get',
			url: `${api_admin_url}/home`,
			dataType: "json",
			success: function(response) {
				$('#customer-counter').attr('data-count', response.customers);
				$('#coach-counter').attr('data-count', response.coaches);
				var html = '';
				response.plans.forEach(e => {
					html += `<div class="testimonial-block style-2 gray-bg">
						<i class="icofont-quote-right"></i>
						<div class="testimonial-thumb">
							<img src="${e.image}" alt="" class="img-fluid">
						</div>
						<div class="client-info">
							<h4>${e.name}</h4>
							<span>${e.price}</span>
							<p>${e.description} - ${e.condition}</p>
						</div>
					</div>`;
				});
				$('#plans').html(html);
			}
		});
	</script>
<?php endSection(); ?>
<?php

// Incluir el layout
include realpath(__DIR__ . "/layouts/app.php");