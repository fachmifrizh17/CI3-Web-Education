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

<!-- <div class="content__boxed">
    <div class="content__wrap">
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <form id="form">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6 d-flex gap-1 align-items-center">
                                    <h5 class="card-title">Form Otorisasi Menu</h5>
                                </div>

                                <div class="col-md-6 d-flex gap-1 align-items-center justify-content-md-end">
                                    <button type="button" class="btn btn-secondary" id="clear">
                                        <i class="ti-reload"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <input type="hidden" id="fungsi" name="fungsi" value="tambah">

                                    <div class="row mb-3">
                                        <label for="kodegrup" class="col-sm-2 col-form-label">Divisi</label>
                                        <div class="col-sm-10">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <input id="kodegrup" name="kodegrup" type="text" class="form-control" placeholder="Divisi" readonly>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input id="namagrup" name="namagrup" type="text" class="form-control" placeholder="Nama Divisi" readonly>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button type="button" class="btn btn-md btn-danger text-light" id="searchgrup"><i class="ti-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="modul" class="col-sm-2 col-form-label">Menu</label>
                                        <div class="col-sm-10">
                                            <div class="row mb-3">
                                                <div class="col-sm-4">
                                                    <input id="modul" name="modul" type="text" class="form-control" placeholder="Modul">
                                                </div>
                                                <div class="col-sm-8">
                                                    <input id="namamenu" name="namamenu" type="text" class="form-control" placeholder="Nama Menu">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input id="urlmenu" name="urlmenu" type="text" class="form-control" placeholder="URL Menu">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    
                                </div>
                            </div>

                            <table id="tableconsumable" class="table table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Kode</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                        <div class="card-footer">
                            <div class="col-12 d-flex flex-row-reverse">
                                <button type="submit" class="btn btn-danger">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div> -->

<div class="content__boxed">
    <div class="content__wrap">

        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card h-100">

                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="row">
                                <div class="col-md-6 d-flex gap-1 align-items-center">
                                    <button class="btn btn-danger hstack gap-2 align-self-center" id="tambah">
                                        <i class="demo-psi-add fs-5"></i> <span class="vr"></span> Add New
                                    </button>
                                </div>
                                <div class="card-body">

                                    <table id="tablekaryawan" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="text-center">Nama Role</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tambahotorisasimenu" tabindex="-1" aria-labelledby="modal-label" aria-hidden="true" width="100%">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-label">Form Otorisasi Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="card-body">
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <div class="row mb-3">
                                        <label for="role" class="col-sm-2 col-form-label">Role</label>
                                        <div class="col-sm-10">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <input id="roleid" name="roleid" type="text" class="form-control" placeholder="Role ID" readonly>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input id="nama" name="nama" type="text" class="form-control" placeholder="Nama Role">
                                                    <input id="filter" type="hidden">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    
                                </div>
                            </div>

                            <table id="tablemenu" class="table table-bordered text-center" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Action</th>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Modul</th>
                                        <th class="text-center">Nama Menu</th>
                                        <th class="text-center">Urutan</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table><br>

                            <div id="terpakai">
                                <div class="col-md-12">
                                    <span style="color: red">** Uncheck bila ingin menghapus otorisasi menu</span>
                                    <table id="tablemenuterpilih" class="table table-bordered text-center" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Action</th>
                                                <th class="text-center">ID</th>
                                                <th class="text-center">Modul</th>
                                                <th class="text-center">Nama Menu</th>
                                                <th class="text-center">Urutan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablemenuterpilihdetail"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-danger" id="save">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- <div class="modal fade" id="tambahotorisasimenu" tabindex="-1" aria-labelledby="modal-label" aria-hidden="true" width="100%">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-label">Form Otorisasi Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="card-body">
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <div class="row mb-3">
                                        <label for="user" class="col-sm-2 col-form-label">User</label>
                                        <div class="col-sm-10">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <input id="username" name="username" type="text" class="form-control" placeholder="Username" readonly>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input id="nama" name="nama" type="text" class="form-control" placeholder="Nama" readonly>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button type="button" class="btn btn-md btn-danger text-light" id="searchuser"><i class="ti-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    
                                </div>
                            </div>

                            <table id="tablemenu" class="table table-bordered text-center" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Action</th>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Modul</th>
                                        <th class="text-center">Nama Menu</th>
                                        <th class="text-center">Urutan</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table><br>

                            <div id="terpakai">
                                <div class="col-md-12">
                                    <span style="color: red">** Uncheck bila ingin menghapus otorisasi menu</span>
                                    <table id="tablemenuterpilih" class="table table-bordered text-center" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Action</th>
                                                <th class="text-center">ID</th>
                                                <th class="text-center">Modul</th>
                                                <th class="text-center">Nama Menu</th>
                                                <th class="text-center">Urutan</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-danger" id="save">Simpan</button>
            </div>
        </div>
    </div>
</div> -->

<!-- <div class="content__boxed">
    <div class="content__wrap">
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <form id="form">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6 d-flex gap-1 align-items-center">
                                    <h5 class="card-title">Form Otorisasi Menu</h5>
                                </div>

                                <div class="col-md-6 d-flex gap-1 align-items-center justify-content-md-end">
                                    <button type="button" class="btn btn-secondary" id="clear">
                                        <i class="ti-reload"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <div class="row mb-3">
                                        <label for="user" class="col-sm-2 col-form-label">User</label>
                                        <div class="col-sm-10">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <input id="username" name="username" type="text" class="form-control" placeholder="Username" readonly>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input id="nama" name="nama" type="text" class="form-control" placeholder="Nama" readonly>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button type="button" class="btn btn-md btn-danger text-light" id="searchuser"><i class="ti-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    
                                </div>
                            </div>

                            <table id="tablemenu" class="table table-bordered text-center" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Action</th>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Modul</th>
                                        <th class="text-center">Nama Menu</th>
                                        <th class="text-center">Urutan</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                        <div class="card-footer">
                            <div class="col-12 d-flex flex-row-reverse">
                                <button type="submit" class="btn btn-danger" id="save">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->

<!-- Modal Karyawan -->
<!-- <div class="modal fade" id="modalkaryawan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalkaryawan-label" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tabel Cabang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="card">
                <div class="card-body">
                    <table id="tablekaryawan" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center">Username</th>
                                <th class="text-center">Grup</th>
                                <th class="text-center">Cabang</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> -->