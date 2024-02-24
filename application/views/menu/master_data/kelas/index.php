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

        <h2 class="page-title mb-3 mt-2"><?php echo $title; ?></h2>

    </div>
</div>

<div class="content__boxed">
    <div class="content__wrap">

        <!-- Table with toolbar -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title" onclick="Ganti()" id="bkelas">Tabel Kelas</h5>
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
                            <th width="10" onclick="Ganti2()" id="bnama" class="text-center">NAMA KELAS</th>
                            <th width="10" onclick="Ganti5()" id="bmurid" class="text-center">JUMLAH MURID</th>
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
<div class="modal fade" id="modalkategori" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalkategori-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form id="formkategori">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalkategori-label" onclick="Ganti()" id="bkelas">Form Tambah Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <input type="hidden" id="fungsi" name="fungsi" value="">

                        <div class="col-md-6">
                            <label for="nama" class="form-label" onclick="Ganti()" id="bkelas">Nama Kelas</label>
                            <input id="nama" name="nama" type="text" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label for="murid" class="form-label">Jumlah Murid</label>
                            <input id="murid" name="murid" type="number" class="form-control"  onkeypress="return hanyaAngka(event)">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Simpan</button>
                    <input type = "input" class="btn btn-danger" value = "Batal" onClick = "fun()"/></button>
                </div>
            </form>
        </div>
    </div>
</div>