<!-- MAIN NAVIGATION -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

<?php
$email = $this->session->userdata('myusername');
$Admin = $this->session->userdata('mygrup');
$masterdata = $this->db->query("SELECT m.*FROM glbm_login u LEFT JOIN stpm_rolemenu r ON r.id = u.roleid LEFT JOIN stpm_rolemenudetail d ON d.roleid = r.id LEFT JOIN stpm_menu m ON m.id = d.idmenu WHERE u.email = '$email' AND m.modul = 'Master Data' AND m.submenu = '' ORDER BY m.pos")->result();
$namauser = $this->db->query("SELECT s.*from glbm_login s WHERE s.email='$email'")->row();
$read = $this->db->query("SELECT m.* FROM glbm_login u LEFT JOIN stpm_rolemenu r ON r.id = u.roleid LEFT JOIN stpm_rolemenudetail d ON d.roleid = r.id LEFT JOIN stpm_menu m ON m.id = d.idmenu WHERE u.email = '$email' AND m.modul = 'Read' AND m.submenu = 'Menu' ORDER BY m.pos")->result();
$laporan = $this->db->query("SELECT m.*FROM glbm_login u LEFT JOIN stpm_rolemenu r ON r.id = u.roleid LEFT JOIN stpm_rolemenudetail d ON d.roleid = r.id LEFT JOIN stpm_menu m ON m.id = d.idmenu WHERE u.email ='$email'AND m.modul ='Laporan'AND m.submenu =''ORDER BY m.pos")->result();
$foto = $this->db->query("SELECT s.*from glbm_login s WHERE s.email='$email'")->row();
?>
<nav id="mainnav-container" class="mainnav">
    <div class="mainnav__inner">

        <!-- Navigation menu -->
        <div class="mainnav__top-content scrollable-content pb-5">

            <!-- Profile Widget -->
            <div class="mainnav__profile mt-3 d-flex3">
                <div class="mt-2 d-mn-max"></div>

                <!-- Profile picture  -->
                <div class="mininav-toggle text-center py-2">
                    <img class="mainnav__avatar img-md rounded-circle border" src="<?php echo base_url(); ?>assets/img/foto/<?= $foto->image ?>" style="width:90px;height:90px;">
                </div>
                <div class="mininav-content collapse d-mn-max">
                    <div class="d-grid">

                        <!-- User name and position -->
                        <span class="d-flex justify-content-center align-items-center">
                            <h6 class="mb-0"><?= $namauser->nama ?></h6>
                        </span>
                        <small class="text-muted"><?php echo ucfirst($this->session->userdata("mykelas")); ?></small>


                    </div>
                </div>
            </div>

            <div class="mainnav__category pt-3">
                <h6 class="mainnav__caption mt-0 px-3 fw-bold">Main</h6>
                <ul class="mainnav__menu nav flex-column">

                    <!-- Link Dashboard -->
                    <li class="nav-item">
                        <a href="<?php echo base_url(); ?>main/dashboard" class="nav-link mininav-toggle <?php echo $menu == 'Dashboard' ? 'active' : ''; ?>"><i class="demo-pli-home fs-5 me-2"></i>
                            <span class="nav-label mininav-content ms-1">Dashboard</span>
                        </a>
                    </li>

                    <?php if (sizeof($masterdata) != 0) { ?>
                        <!-- Link Master Data -->
                        <li class="nav-item has-sub">

                            <a href="#" class="mininav-toggle nav-link collapsed <?php echo $menu == 'Master Data' ? 'active' : ''; ?>"><i class="demo-pli-data-storage fs-5 me-2"></i>
                                <span class="nav-label ms-1">Master Data</span>
                            </a>

                            <ul class="mininav-content nav collapse">
                                <!-- <li class="nav-item">
                                <a href="<?php echo base_url(); ?>main/kelas" class="nav-link <?php echo $title == 'Kelas' ? 'active' : ''; ?>">Kelas</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url(); ?>main/siswa" class="nav-link <?php echo $title == 'Siswa' ? 'active' : ''; ?>">Siswa</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url(); ?>main/buku" class="nav-link <?php echo $title == 'Buku' ? 'active' : ''; ?>">Buku</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url(); ?>main/guru" class="nav-link <?php echo $title == 'Guru' ? 'active' : ''; ?>">Guru</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url(); ?>main/admin" class="nav-link <?php echo $title == 'Admin' ? 'active' : ''; ?>">Admin</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url(); ?>main/mapping_guru" class="nav-link <?php echo $title == 'Mapping Guru' ? 'active' : ''; ?>">Mapping Guru</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url(); ?>main/mapping_siswa" class="nav-link <?php echo $title == 'Mapping Siswa' ? 'active' : ''; ?>">Mapping Siswa</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url(); ?>main/mapping_buku" class="nav-link <?php echo $title == 'Mapping Buku' ? 'active' : ''; ?>">Mapping Buku</a>
                            </li> -->

                                <?php foreach ($masterdata as $value) { ?>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url(); ?><?= $value->menu_url ?>" class="nav-link <?php echo $title == $value->title ? 'active' : ''; ?>"><?= $value->title ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if (sizeof($read) != 0) { ?>
                        <!-- Link Read -->
                        <li class="nav-item has-sub">

                            <a href="#" class="mininav-toggle nav-link collapsed <?php echo $menu == 'Read Siswa' ? 'active' : ''; ?>"><i class="demo-pli-window-2 fs-5 me-2"></i>
                                <span class="nav-label ms-1">Read Siswa</span>
                            </a>

                            <ul class="mininav-content nav collapse">
                                <!-- 
                            <li class="nav-item">
                                <a href="<?php echo base_url(); ?>main/auto_read_siswa" class="nav-link <?php echo $title == 'Generate Baca Siswa' ? 'active' : ''; ?>">Generate Baca Siswa</a>
                            </li>        
                            <li class="nav-item">
                                <a href="<?php echo base_url(); ?>main/read" class="nav-link <?php echo $title == 'Read Siswa' ? 'active' : ''; ?>">Read Siswa</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url(); ?>main/ubah_data" class="nav-link <?php echo $title == 'Ubah Data' ? 'active' : ''; ?>">Ubah Data</a>
                            </li>        
                            <li class="nav-item">
                                <a href="<?php echo base_url(); ?>main/histori_baca_siswa" class="nav-link <?php echo $title == 'Histori Baca Siswa' ? 'active' : ''; ?>">Histori Baca Siswa</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url(); ?>main/histori_baca_guru" class="nav-link <?php echo $title == 'Histori Baca' ? 'active' : ''; ?>">Histori Baca</a>
                            </li>
                            -->

                                <?php foreach ($read as $value) { ?>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url(); ?><?= $value->menu_url ?>" class="nav-link <?php echo $title == $value->title ? 'active' : ''; ?>"><?= $value->title ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>

                    <?php if (sizeof($laporan) != 0) { ?>
                        <!-- Link Cetak Laporan -->
                        <li class="nav-item has-sub">

                            <!-- <a href="#" class="mininav-toggle nav-link collapsed <?php echo $menu == 'Cetak Laporan' ? 'active' : ''; ?>"><i class="demo-pli-bar-chart fs-5 me-2"></i>
                                <span class="nav-label ms-1">Cetak Laporan</span>
                            </a> -->

                            <ul class="mininav-content nav collapse">

                                <!-- <li class="nav-item">
                                <a href="<?php echo base_url(); ?>main/laporan" class="nav-link <?php echo $title == 'Cetak Laporan' ? 'active' : ''; ?>">Cetak Laporan</a>
                            </li> -->


                                <?php foreach ($laporan as $value) { ?>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url(); ?><?= $value->menu_url ?>" class="nav-link <?php echo $title == $value->title ? 'active' : ''; ?>"><?= $value->title ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- Bottom navigation menu -->
    <div class="mainnav__bottom-content border-top pb-2">
        <ul id="mainnav" class="mainnav__menu nav flex-column">
            <!-- Link Logout -->
            <li class="nav-item">
                <a href="javascript:logout()" class="nav-link mininav-toggle collapsed" aria-expanded="false">
                    <i class="demo-pli-unlock fs-5 me-2"></i>
                    <span class="nav-label ms-1">Logout</span>
                </a>
            </li>
        </ul>
    </div>

    </div>
</nav>