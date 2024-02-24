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
                <h5 class="card-title" onclick="Ganti()" id="bkelas">Tabel Buku</h5>
                <div class="row">

                    <!-- Left toolbar -->
                    <div class="col-md-6 d-flex gap-1 align-items-center">
                        <button class="btn btn-danger hstack gap-2 align-self-center" id="tambahbuku">
                            <i class="demo-psi-add fs-5"></i>
                            <span class="vr"></span>
                            Add New
                        </button>
                    </div>
                    <!-- END : Left toolbar -->

                </div>
            </div>
            <div class="card-body">

                <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="10" onclick="Ganti()" id="bkode" class="text-center">KODE</th>
                            <th width="10" onclick="Ganti()" id="bkode" class="text-center">KODE KELAS</th>
                            <th width="10" onclick="Ganti1()" id="bnama" class="text-center">NAMA KELAS</th>
                            <th width="10" onclick="Ganti1()" id="bnama" class="text-center">KODE BUKU</th>
                            <th width="10" onclick="Ganti1()" id="bnama" class="text-center">NAMA BUKU</th>
                            <th width="10" onclick="Ganti1()" id="bnama" class="text-center">BAB</th>
                            <th width="10" onclick="Ganti1()" id="bnama" class="text-center">PENERBIT</th>
                            <th width="10" class="text-center">Status</th>
                            <th width="10" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>

            </div>
        </div>

    </div>
    <!-- END : Table with toolbar -->

</div>

<!-- Modal -->
<div class="modal fade" id="modalbuku" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalbuku-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form id="formbuku">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalbuku-label" onclick="Ganti()" id="bkelas">Form Tambah Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <input type="hidden" id="fungsi" name="fungsi" value="">

                        <div class="row g-3 mb-3">
                            <label for="kodekelas" class="form-label">Kode Kelas</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <input id="kodekelas" name="kodekelas" type="text" class="form-control" placeholder="Kode Kelas" readonly>
                                    </div>
                                    <div class="col-sm-6">
                                        <input id="namakelas" name="namakelas" type="text" class="form-control" placeholder="Nama Kelas" readonly>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-md btn-danger text-light" id="searchkelas"><i class="ti-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <label for="kodebuku" class="form-label">Buku</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input id="kodebuku" name="kodebuku" type="text" class="form-control" placeholder="Turunan Buku" readonly>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-md btn-danger text-light" id="searchturunan"><i class="ti-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <input id="namabuku" name="namabuku" type="text" class="form-control" placeholder="Nama Buku" readonly>
                            </div>
                            <div class="col-sm-6">
                                <input id="penerbit" name="penerbit" type="text" class="form-control" placeholder="Penerbit" readonly>
                            </div>
                            <div class="col-sm-6">
                                <input id="bab" name="bab" type="text" class="form-control" placeholder="Bab Buku" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Kelas -->
<div class="modal fade" id="modalbuku1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalbuku1-label" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tabel Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="tablebuku" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center">KODE KELAS</th>
                                <th class="text-center">NAMA KELAS</th>
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

<div class="modal fade" id="modalturunan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalturunan-label" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tabel Turunan Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="tableturunan" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center">KODE BUKU</th>
                                <th class="text-center">NAMA BUKU</th>
                                <th class="text-center">BAB</th>
                                <th class="text-center">PENERBIT</th>
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