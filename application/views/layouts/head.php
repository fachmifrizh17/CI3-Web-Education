<meta name="generator" content="Hugo 0.87.0" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
<meta name="description" content="Nifty is a responsive admin dashboard template based on Bootstrap 5 framework. There are a lot of useful components.">
<link rel="icon" href="<?php echo base_url(); ?>assets/img/book.png" type="image/x-icon" />

<!-- Title -->
<title><?php echo SITE_NAME . " : " . $title; ?></title>

<!-- Fonts [ OPTIONAL ] -->
<link rel="preconnect" href="https://fonts.googleapis.com/">
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&amp;family=Ubuntu:wght@400;500;700&amp;display=swap" rel="stylesheet">

<!-- Themify Icons [ OPTIONAL ] -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/pages/themify-icons.css">

<!-- Datetime & moment.js -->
<script src="<?php echo base_url(); ?>assets/js/datetime.js"></script>
<script src="<?php echo base_url(); ?>assets/js/moment-with-locales.min.js"></script>


<!-- Bootstrap CSS [ REQUIRED ] -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">

<!-- Nifty CSS [ REQUIRED ] -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/nifty.min.css">

<!--DataTables [ OPTIONAL ]-->
<link href="<?php echo base_url(); ?>assets/plugins/datatables/datatables.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/plugins/datatables/datatables-1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/plugins/datatables/responsive-2.3.0/css/responsive.bootstrap5.min.css" rel="stylesheet">

<!-- Date Time Picker [ OPTIONAL ] -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/pages/date-time-picker.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/mc-calendar.min.css">
<link rel="stylesheet" href="/dist/mc-calendar.min.css" />
<script src="/dist/mc-calendar.min.js"></script>

<!-- Sweet Alert 2 -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/sweetalert2-11.4.32/sweetalert2.min.css">

<!-- Jquery Confirm -->
<link href="<?php echo base_url(); ?>assets/jqueryconfirm/jquery-confirm.min.css" rel="stylesheet" />

<!-- Custom Style CSS -->
<?php !isset($css) ? null : $this->load->view($css); ?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/sweetalert/sweetalert.css'); ?>">

<script type="text/javascript" src="<?php echo base_url('assets/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/sweetalert/sweetalert.min.js'); ?>"></script>