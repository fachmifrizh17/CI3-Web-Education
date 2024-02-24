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
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="row">
                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="namakelas" class="form-label">NAMA KELAS</label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input id="namakelas" name="namakelas" type="text" class="form-control" readonly>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <button type="button" class="btn btn-md btn-danger text-light" id="searchsiswa"><i class="ti-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="kodekelas" class="form-label">KODE KELAS</label>
                                                <input id="kodekelas" name="kodekelas" type="text" class="form-control" readonly>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="email" class="form-label">EMAIL GURU</label>
                                                <input id="email" name="email" type="email" class="form-control" readonly>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="namaguru" class="form-label">NAMA GURU</label>
                                                <input id="namaguru" name="namaguru" type="text" class="form-control" readonly>
                                            </div>

                                            <div class="col-md-6">
                                                <input style="display: none;" id="kodesiswa" name="kodesiswa" type="text" class="form-control" readonly>
                                            </div>

                                            <div class="col-md-6">
                                                <input style="display: none;" id="namasiswa" name="namasiswa" type="text" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <table id="tablemenu" class="table table-bordered text-center" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Action</th>
                                            <th class="text-center">KODE</th>
                                            <th class="text-center">NAMA BUKU</th>
                                            <th class="text-center">BAB BUKU</th>
                                            <th class="text-center">PENERBIT</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table><br>

                                <div id="terpakai">
                                    <div class="col-md-12">
                                        <span style="color: red">** Uncheck bila ingin menghapus</span>
                                        <table id="tablemenuterpilih" class="table table-bordered text-center" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Action</th>
                                                    <th class="text-center">KODE</th>
                                                    <th class="text-center">NAMA BUKU</th>
                                                    <th class="text-center">PENERBIT</th>
                                                    <th class="text-center">BACA HARIAN</th>
                                                    <th class="text-center">TANGGAL MULAI BACA</th>
                                                    <th class="text-center">EMAIL SISWA</th>
                                                    <th class="text-center">NAMA SISWA</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tablemenuterpilihdetail"></tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" id="save">SIMPAN</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalsiswa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalsiswa-label" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tabel Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="card">
                <div class="card-body">
                    <table id="tablesiswa" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center">KODE KELAS</th>
                                <th class="text-center">NAMA KELAS</th>
                                <th class="text-center">KODE GURU</th>
                                <th class="text-center">NAMA GURU</th>
                                <th class="text-center">EMAIL SISWA</th>
                                <th class="text-center">NAMA SISWA</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalbaca" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalbaca-label" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <table id="tablebab" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <div class="card">
                    <div class="card-body">
                        <input type="hidden" id="fungsi" name="fungsi" value="">
                        <div class="col-md-6">
                            <label for="kodebuku" class="form-label">KODE BUKU</label>
                            <input id="kodebuku" name="kodebuku" type="text" class="form-control" readonly>
                        </div>

                        <div class="col-md-6">
                            <label for="namabuku" class="form-label">NAMA BUKU</label>
                            <input id="namabuku" name="namabuku" type="text" class="form-control" readonly>
                        </div>

                        <div class="col-md-6">
                            <label for="jumlahbab" class="form-label">JUMLAH BAB</label>
                            <input id="jumlahbab" name="jumlahbab" type="text" class="form-control" readonly>
                        </div>

                        <div class="col-md-6">
                            <label for="babbaca" class="form-label">BACA BAB HARI INI</label>
                            <input id="babbaca" name="babbaca" type="text" class="form-control" onkeypress="return hanyaAngka(event)">
                        </div>

                        <div class="col-md-6">
                            <label for="tanggal" class="form-label">TANGGAL</label>
                            <input class="form-control" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d'); ?>" padding="5px" type="date" maxlength="50" required />
                        </div>
                    </div>
                    <button class="btn btn-sm btn-dark form-control" id="showdata">Tampilkan Data</button>
                </div>
            </table>
        </div>
    </div>
</div>