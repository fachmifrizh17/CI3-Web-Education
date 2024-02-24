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
                <h5 class="card-title">Tabel User</h5>
                <div class="row">

                    <!-- Left toolbar -->
                    <div class="col-md-6 d-flex gap-1 align-items-center">
                        <button class="btn btn-primary hstack gap-2 align-self-center" id="tambahuser">
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
                            <th class="text-center">Email</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Role</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
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
<div class="modal fade" id="modaluser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modaluser-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form id="formuser">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaluser-label">Form User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <input type="hidden" id="fungsi" name="fungsi" value="">

                        <div class="col-md-6">
                            <label for="usia" class="form-label">Grup</label>
                            <div class="col-sm-12">
                                <select id="roleid" name="roleid" class="form-select">
                                    <option>Pilih Jenis Grup</option>
                                    <option value="1">ADMIN</option>
                                    <option value="2">SISWA</option>
                                    <option value="3">GURU</option>
                                </select>
                            </div>
                        </div>

                            <label for="roleid" class="form-label">Data</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input id="nama" name="nama" type="text" class="form-control" placeholder="Data User" readonly>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-md btn-danger text-light" id="searchgrup"><i class="ti-search"></i></button>
                                    </div>
                                </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input id="email" name="email" type="text" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input id="password" name="password" type="password" class="form-control">
                                    <span class="input-group-text">
                                        <button type="button" class="btn btn-xs" id="passwordtoggle"><i class="ti-eye"></i></button>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!-- <label for="email" class="form-label">E-mail</label> -->
                                <input id="image" name="image" type="hidden" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
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
                                <th class="text-center">Email</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Password</th>
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