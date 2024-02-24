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
                <h5 class="card-title">Tabel Generate</h5>
                <div class="row">
                </div>
            </div>
            <div class="card-body">

                <table id="table" class="table table-striped table-bordered" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">KODE</th>
                            <th class="text-center">KODE KELAS</th>
                            <th class="text-center">NAMA KELAS</th>
                            <th class="text-center">STATUS</th>
                            <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modaldetail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modaldetail-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form id="formkategori">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaldetail-label">DETAIL GENERATE</h5>
                </div>
                <div class="modal-body table-responsive">
                    <div class="row g-3">
                        <table id="t_detail" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center">KODE</th>
                                    <th class="text-center">TANGGAL BACA</th>
                                    <th class="text-center">NAMA BUKU</th>
                                    <th class="text-center">BAB</th>
                                    <th class="text-center">STATUS</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php
                    $query = $this->db->select('kode')->from('stpm_generate')->get();
                    if ($query->num_rows() > 0) {
                        $row = $query->row();
                        $nomor = $row->kode;
                    } 
                    ?>
                    <a href="javascript:status('<?php echo $nomor; ?>')" class="btn btn-danger" title="Ubah Status">UBAH</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">BATAL</button>
                </div>
            </form>
        </div>
    </div>
</div>