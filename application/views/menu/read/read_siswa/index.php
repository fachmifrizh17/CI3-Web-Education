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
        <div class="card">
            <div class="card-body">
                <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="10" id="bnama" class="text-center">KODE GENERATE</th>
                            <th width="10" id="bnama" class="text-center">TANGGAL</th>
                            <th width="10" id="bnama" class="text-center">NAMA BUKU</th>
                            <th width="10" id="bnama" class="text-center">BAB BUKU</th>
                            <th width="10" id="bjenkel" class="text-center">NAMA SISWA</th>
                            <th width="10" id="bjenkel" class="text-center">STATUS BACA</th>
                            <th width="10" id="bjenkel" class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalread" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalread-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form id="formread">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalread-label">Membaca Siswa</h5>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <input type="hidden" id="fungsi" name="fungsi" value="">

                        <div class="col-md-6">
                            <!-- <label for="kode" class="form-label">KODE</label> -->
                            <input id="kode" name="kode" type="text" class="form-control" readonly style="display: none;"></input>
                        </div>

                        <div class="col-md-6">
                            <!-- <label for="tanggal" class="form-label">Tanggal</label> -->
                            <input id="tanggal" name="tanggal" type="text" class="form-control" readonly style="display: none;"></input>
                        </div>

                        <div class="col-md-6">
                            <label for="nama" class="form-label">NAMA BUKU</label>
                            <input id="nama" name="nama" type="text" class="form-control" readonly></input>
                        </div>

                        <div class="col-md-6">
                            <label for="bab" class="form-label">BAB</label>
                            <input id="bab" name="bab" type="text" class="form-control" readonly></input>
                        </div>

                        <div class="col-md-6">
                            <label for="note" class="form-label">NOTE</label>
                            <textarea id="note" name="note" type="text" class="form-control"></textarea>
                        </div>

                        <div class="col-md-6">
                            <div class="col-md-6">
                                <label for="note" class="form-label">SELESAI MEMBACA</label>
                            </div>
                            <input type="time" class="form-control datetimepicker-input" name="selesaibaca" id="selesaibaca" data-toggle="datetimepicker" data-target="#selesaibaca" placeholder="Selesai Membaca" value="" />
                        </div>

                        <span style="color: red">** Wajib Memasukan Note</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalbuku" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalbuku-label" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tabel Reading</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="tablebuku" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center">Kode Buku</th>
                                <th class="text-center">Nama Buku</th>
                                <th class="text-center">Materi</th>
                                <th class="text-center">Status Baca</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>