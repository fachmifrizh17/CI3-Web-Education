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
                <div class="card">
                    <form id="form">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6 d-flex gap-1 align-items-center">
                                    <h5 class="card-title">Laporan</h5>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <input type="hidden" id="fungsi" name="fungsi" value="tambah">

                                    <div class="row g-3 mb-3">
                                        <label for="modul" class="col-sm-2 col-form-label">Dokumen Laporan</label>
                                        <div class="col-sm-10">
                                            <select id="modul" name="modul" class="form-select">
                                                <option value="">Pilih salah satu</option>
                                                <optgroup label="Master Data">
                                                    <option value="p1">Laporan Data Siswa</option>
                                                    <option value="p2">Laporan Data Guru</option>
                                                    <option value="p3">Laporan Data Buku</option>
                                                    <option value="p4">Laporan Mapping Siswa</option>
                                                    <option value="p5">Laporan Mapping Guru</option>
                                                </optgroup>
                                                <optgroup label="History Reading">
                                                    <option value="p6">Laporan Histori Baca</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <!--  -->
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="col-12 d-flex flex-row-reverse">
                                <button type="submit" class="btn btn-danger" id="viewreport">View Report</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>