<div class="content__header content__boxed overlapping">
    <div class="content__wrap">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><?php echo ucfirst($this->uri->segment(1)); ?></li>
                <li class="breadcrumb-item"><?php echo $menu; ?></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
            </ol>
        </nav>
        <!-- END : Breadcrumb -->
        <h1 class="page-title mb-3 mt-2"><?php echo $title; ?></h1>
    </div>
</div>
<div class="content__boxed">
    <div class="content__wrap">
        <!-- Table with toolbar -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Tabel Reading</h5>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <label for="tglawal" class="mr-2">TANGGAL AWAL:</label>
                            <input type="date" id="tglawal" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <label for="tglakhir" class="mr-2">TANGGAL AKHIR:</label>
                            <input type="date" id="tglakhir" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                            <button id="search-btn" class="btn btn-danger ml-2">CARI</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="table" class="table table-striped table-bordered" cellspacing="0">
                    <thead>
                        <tr>
                            <th id="bnip" class="text-center">KODE</th>
                            <th id="bjenkel" class="text-center">NAMA SISWA</th>
                            <th id="bjenkel" class="text-center">NAMA BUKU</th>
                            <th id="bjenkel" class="text-center">BAB BUKU</th>
                            <th width="30%" id="bjenkel" class="text-center">NOTE</th>
                            <th id="bjenkel" class="text-center">TANGGAL BACA</th>
                            <th id="bnip" class="text-center">JAM SELESAI</th>
                            <th id="bjenkel" class="text-center">STATUS</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>