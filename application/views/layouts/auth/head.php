<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
<meta name="description" content="The login page allows a user to gain access to an application by entering their username and password or by authenticating using a social media login.">
<link rel="icon" href="<?php echo base_url(); ?>assets/img/book.png" type="image/x-icon" />

<!-- Title -->
<title><?php echo SITE_NAME . " : " . $title ?></title>

<!-- Fonts [ OPTIONAL ] -->
<link rel="preconnect" href="https://fonts.googleapis.com/">
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&amp;family=Ubuntu:wght@400;500;700&amp;display=swap" rel="stylesheet">

<!-- Bootstrap CSS [ REQUIRED ] -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">

<!-- Nifty CSS [ REQUIRED ] -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/nifty.min.css">

<!-- Sweet Alert 2 -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/sweetalert2-11.4.32/sweetalert2.min.css">

<!-- Custom CSS -->
<?php !isset($css) ? null : $this->load->view($css); ?>