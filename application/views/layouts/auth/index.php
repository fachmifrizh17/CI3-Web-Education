<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("layouts/auth/head") ?>
</head>

<body class="" style="background-image: url('<?php echo base_url(); ?>assets/img/background/logbg.jpg');">

	<!-- PAGE CONTAINER -->
	<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
	<div id="root" class="root front-container">

		<!-- CONTENTS -->
		<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
		<section id="content" class="content">
			<?php $this->load->view($content); ?>
		</section>

		<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
		<!-- END - CONTENTS -->
		
	</div>
	<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
	<!-- END - PAGE CONTAINER -->

	<!-- JAVASCRIPTS -->
	<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

	<?php $this->load->view("layouts/auth/footer") ?>

	<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
	<!-- END - JAVASCRIPTS -->

</body>

</html>