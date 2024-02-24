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
                <h5 class="card-title" onclick="Ganti()" id="bguru">Tabel Guru</h5>
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
                            <!-- <th width="10" onclick="Ganti2()" id="bemail" class="text-center">KODE</th> -->
                            <th width="10" onclick="Ganti2()" id="bemail" class="text-center">EMAIL</th>
                            <th width="10" onclick="Ganti()" id="bguru" class="text-center">NAMA GURU</th>
                            <th width="10" onclick="Ganti4()" id="bjenkel" class="text-center">JENIS KELAMIN</th>
                            <th width="10" onclick="Ganti5()" id="busia" class="text-center">USIA GURU</th>
                            <th width="10" onclick="Ganti6()" id="balamat" class="text-center">ALAMAT LENGKAP</th>
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
                    <h5 class="modal-title" id="modalkategori-label" onclick="Ganti()" id="bguru">Form Tambah Guru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <input type="hidden" id="fungsi" name="fungsi" value="">

                        <div class="col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input id="email" name="email" type="email" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label onclick="Ganti()" id="bguru" for="nama" class="form-label">NAMA GURU</label>
                            <input id="nama" name="nama" type="text" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label for="usia" class="form-label">Jenis Kelamin</label>
                            <div class="col-sm-12">
                                <select id="jenkel" name="jenkel" class="form-select">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="1">Laki-Laki</option>
                                    <option value="2">Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="usia" class="form-label">Usia</label>
                            <input id="usia" name="usia" type="text" class="form-control"  onkeypress="return hanyaAngka(event)">
                        </div>

                        <div class="col-md-6">
                            <label for="grup" class="form-label">Grup</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input id="grup" name="grup" type="text" class="form-control" readonly>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-md btn-danger text-light" id="searchgrup"><i class="ti-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="namagrup" class="form-label">Nama Grup</label>
                            <input id="namagrup" name="namagrup" type="text" class="form-control" readonly>
                        </div>

                        <div class="col-md-6">
                            <label for="alamat" class="form-label">alamat</label>
                            <textarea id="alamat" name="alamat" type="text" class="form-control"></textarea>
                        </div>

                        <input type="hidden" name="uploaded" id="uploaded" value="" />

                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label for="usia" class="form-label">Foto Guru</label>
                            </div>
                            <div class="col-sm-12 input-group box">
                                <input type="hidden" name="gambar_lama" id="gambar_lama" value="" />
                                <div class="custom-file">
                                    <div class="custom-file">
                                        <input type="file" accept="image/*" class="custom-file-input" style="border-radius: 3px;" name="image" id="image" />
                                        <label class="custom-file-label" style="border-radius: 3px;" for="gambar" id="gambarlabel">Pilih Foto Guru</label>
                                    </div>
                                </div>
                                <div class="w-100 text-center mt-4" style="height: 152px; border: 1px solid rgba(0, 0, 0, .2); border-radius: 10px;">
                                    <img id="gambarpreview" src="#" style="max-height: 150px; margin: auto;" />
                                </div>
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

<div class="modal fade" id="modalgrup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalgrup-label" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tabel Grup</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="card">
                <div class="card-body">
                    <table id="tablegrup" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center">Kode</th>
                                <th class="text-center">Nama</th>
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