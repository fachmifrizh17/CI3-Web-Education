<!-- HEADER -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<?php
$email = $this->session->userdata('myusername');
$grup = $this->session->userdata('mygrup');
$foto = $this->db->query("SELECT s.*from glbm_login s WHERE s.email='$email'")->row();
$namauser = $this->db->query("SELECT s.*from glbm_login s WHERE s.email='$email'")->row();
?>
<header class="header">
    <div class="header__inner">

        <!-- Brand -->
        <div class="header__brand">
            <div class="brand-wrap">

                <!-- Brand logo -->
                <a href="<?php echo base_url(); ?>main" class="brand-img stretched-link">
                    <img src="<?php echo base_url(); ?>assets/img/book.png" alt="Logo" class="logo" width="40" height="40">
                </a>

                <!-- Brand title -->
                <div class="brand-title" style="font-size: 15px">SELF EDUCATION</div>
            </div>
        </div>

        <div class="header__content">

            <!-- Content Header - Left Side: -->
            <div class="header__content-start">

                <!-- Navigation Toggler -->
                <button type="button" class="nav-toggler header__btn btn btn-icon btn-sm" aria-label="Nav Toggler">
                    <i class="demo-psi-view-list"></i>
                </button>
            </div>

            <!-- Content Header - Right Side: -->
            <div class="header__content-end">

                <!-- Squares Dropdown -->
                <div class="dropdown">
                    <!-- <button class="header__btn btn btn-icon btn-sm" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-label="Megamenu dropdown" aria-expanded="false">
                        <i class="demo-psi-layout-grid"></i>
                    </button> -->
                </div>

                <!-- Notification Dropdown -->
                <div class="dropdown">
                    <span class="align-middle h5 text-white">Hai, <?= $namauser->nama ?></span>
                    <button class="header__btn btn btn-icon btn-sm" type="button" data-bs-toggle="dropdown" aria-label="Notification dropdown" aria-expanded="false">
                        <span class="d-block position-relative">
                            <i class="demo-psi-bell"></i>
                            <span class="badge badge-super rounded bg-danger p-1" id="notification">
                            </span>
                        </span>
                    </button>

                    <div class="dropdown-menu dropdown-menu-end w-md-300px">
                        <div class="border-bottom px-3 py-2 mb-3">
                            <h5>Notifications</h5>
                        </div>

                        <div class="list-group list-group-borderless">

                            <div id="notifread" hidden>
                                <div class="list-group-item list-group-item-action d-flex align-items-start mb-3">
                                    <div class="flex-shrink-0 me-3">
                                        <i class="demo-psi-file-edit text-blue-200 fs-2"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <a href="<?php echo base_url("main/read") ?>" class="h6 mb-0 stretched-link text-decoration-none">Reading</a>
                                            <span class="badge bg-danger rounded ms-auto" id="notifreadbdg"></span>
                                        </div>
                                        <small class="text-muted" id="notifreadtxt"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User dropdown -->
                <div class="dropdown">
                    <button class="header__btn btn btn-icon btn-sm" type="button" data-bs-toggle="dropdown" aria-label="User dropdown" aria-expanded="false">
                        <i class="demo-psi-male"></i>
                    </button>

                    <div class="dropdown-menu dropdown-menu-end w-md-250px">
                        <div class="d-flex align-items-center border-bottom px-3 py-2">
                            <div class="flex-shrink-0">
                                <img class="mainnav__avatar img-md rounded-circle border" src="<?php echo base_url(); ?>assets/img/foto/<?= $foto->image ?>" .>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-0"><?= $namauser->nama ?></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="list-group list-group-borderless h-100 py-3">
                                    <a href="javascript:ubahpassword()" class="list-group-item list-group-item-action mt-auto">
                                        <i class="demo-pli-computer-secure fs-5 me-2"></i> Ubah Password
                                    </a>
                                    <a href="javascript:ubahfoto()" class="list-group-item list-group-item-action mt-auto">
                                        <i class="demo-pli-photo-2 fs-5 me-2"></i> Ubah Foto
                                    </a>
                                    <a href="javascript:logout()" class="list-group-item list-group-item-action">
                                        <i class="demo-pli-unlock fs-5 me-2"></i> Logout
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>