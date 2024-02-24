<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
	<meta name="description" content="The server encountered an unexpected condition that prevented it from fulfilling the request.">
	<link rel="icon" href="<?php echo base_url(); ?>assets/img/logo.svg" type="image/x-icon" />

	<!-- Title -->
	<title><?php echo SITE_NAME . " : " . $title; ?></title>

	<!-- Fonts [ OPTIONAL ] -->
	<link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&amp;family=Ubuntu:wght@400;500;700&amp;display=swap" rel="stylesheet">

	<!-- Themify Icons [ OPTIONAL ] -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/pages/themify-icons.css">

	<!-- Bootstrap CSS [ REQUIRED ] -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">

	<!-- Nifty CSS [ REQUIRED ] -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/nifty.min.css">
</head>

<body class="">

	<!-- PAGE CONTAINER -->
	<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
	<div id="root" class="root front-container">

		<!-- CONTENTS -->
		<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
		<section id="content" class="content">
			<div class="content__boxed card rounded-0 w-100 min-vh-100 d-flex flex-column align-items-stretch justify-content-center">
				<div class="content__wrap">

					<div class="text-center">
						<div class="error-code page-title mb-3">500</div>
						<h3 class="mb-4">
							<div class="badge bg-danger">Internal Server Error !</div>
						</h3>
						<p class="lead">Terjadi kesalahan, mohon hubungi tim IT.</p>
					</div>

					<!-- Action buttons -->
					<div class="d-flex justify-content-center gap-3 mt-4">
						<button type="button" onclick="window.history.back()" class="btn btn-light">Kembali</button>
					</div>
					<!-- END : Action buttons -->

				</div>
			</div>

			<!-- FOOTER -->
			<footer class="content__boxed mt-auto">
				<div class="content__wrap py-3 py-md-1 d-flex flex-column flex-md-row align-items-md-center">
					<div class="text-nowrap mb-4 mb-md-0">Copyright &copy; 2022 <a href="#" class="ms-1 btn-link fw-bold">PT. Four Best Synergy</a></div>
					<nav class="nav flex-column gap-1 flex-md-row gap-md-3 ms-md-auto" style="row-gap: 0 !important;">
						<a class="nav-link px-0" href="#">Policy Privacy</a>
						<a class="nav-link px-0" href="#">Terms and conditions</a>
						<a class="nav-link px-0" href="#">Contact Us</a>
					</nav>
				</div>
			</footer>
			<!-- END - FOOTER -->
		</section>
	</div>
	<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
	<!-- END - PAGE CONTAINER -->

	<!-- SCROLL TO TOP BUTTON -->
	<div class="scroll-container">
		<a href="#root" class="scroll-page rounded-circle ratio ratio-1x1" aria-label="Scroll button"></a>
	</div>
	<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
	<!-- END - SCROLL TO TOP BUTTON -->

	<!-- Bootstrap JS [ OPTIONAL ] -->
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

	<!-- Nifty JS [ OPTIONAL ] -->
	<script src="<?php echo base_url(); ?>assets/js/nifty.min.js"></script>

	<script type="text/javascript">
		console.log("<?php echo $heading; ?>")
		console.log("<?php echo $message; ?>")
	</script>
</body>

</html>