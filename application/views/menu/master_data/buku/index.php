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
                        <button class="btn btn-danger hstack gap-2 align-self-center" id="tambahkategori">
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
                            <th width="10" onclick="Ganti2()" id="bnama" class="text-center">NAMA BUKU</th>
                            <th width="10" onclick="Ganti5()" id="bmurid" class="text-center">PENERBIT</th>
                            <th width="10" class="text-center">BAB BUKU</th>
                            <th width="10" class="text-center">STATUS</th>
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
<div class="modal fade" id="modalkategori" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalkategori-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form id="formkategori">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalkategori-label" onclick="Ganti()" id="bkelas">Form Tambah Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <input type="hidden" id="fungsi" name="fungsi" value="">

                        <div class="col-md-6">
                            <label for="nama" class="form-label" onclick="Ganti()" id="bkelas">Nama Buku</label>
                            <input id="nama" name="nama" type="text" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label for="penerbit" class="form-label">Penerbit Buku</label>
                            <input id="penerbit" name="penerbit" type="text" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label for="bab" class="form-label">Bab Buku</label>
                            <input id="bab" name="bab" type="text" class="form-control" onkeypress="return hanyaAngka(event)">
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