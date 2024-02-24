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
                <h5 class="card-title">Tabel Mapping</h5>
                <div class="row">

                    <!-- Left toolbar -->
                    <div class="col-md-6 d-flex gap-1 align-items-center">
                        <button class="btn btn-danger hstack gap-2 align-self-center" id="tambahmappingguru">
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
                            <!-- <th width="100" onclick="Ganti3()" id="bnamakelas" class="text-center">KODE MAPPING</th> -->
                            <th width="100" onclick="Ganti3()" id="bnamakelas" class="text-center">NAMA KELAS</th>
                            <th width="100" onclick="Ganti6()" id="bnamaguru" class="text-center">NAMA GURU</th>
                            <th width="100" class="text-center">Status</th>
                            <th width="100" class="text-center">Aksi</th>
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
<div class="modal fade" id="modalmappingguru" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalmappingguru-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form id="formmappingguru">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalmappingguru-label">Form Mapping Guru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <input type="hidden" id="fungsi" name="fungsi" value="">
                        <div class="col-md-6">
                            <label for="kodekelas" class="form-label">Kode Kelas</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input id="kodekelas" name="kodekelas" type="text" class="form-control" readonly>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-md btn-danger text-light" id="searchkelas"><i class="ti-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="namakelas" class="form-label">Nama Kelas</label>
                            <input id="namakelas" name="namakelas" type="text" class="form-control" readonly>
                        </div>

                        <div class="col-md-6">
                            <label for="kodeguru" class="form-label">Kode Guru</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input id="kodeguru" name="kodeguru" type="text" class="form-control" readonly>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-md btn-danger text-light" id="searchguru"><i class="ti-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input id="email" name="email" type="text" class="form-control" readonly>
                        </div>

                        <div class="col-md-6">
                            <label for="namaguru" class="form-label">Nama Guru</label>
                            <input id="namaguru" name="namaguru" type="text" class="form-control" readonly>
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

<div class="modal fade" id="modalkelas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalkelas-label" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tabel Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="card">
                <div class="card-body">
                    <table id="tablekelas" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center">Kode</th>
                                <th class="text-center">Nama Kelas</th>
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

<div class="modal fade" id="modalguru" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalguru-label" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tabel Guru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="card">
                <div class="card-body">
                    <table id="tableguru" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center">Kode</th>
                                <th class="text-center">Nama Guru</th>
                                <th class="text-center">Email Guru</th>
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