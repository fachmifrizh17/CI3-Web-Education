<script type="text/javascript">

    function Ganti4() {
        document.getElementById("bnamakelas").innerHTML = "NAMA SISWA";
    }

    function Ganti3() {
        document.getElementById("bnip").innerHTML = "NAMA GURU";
    }

    function Ganti6() {
        document.getElementById("bnamaguru").innerHTML = "NAMA KELAS";
    }

    // Bagian Kelas
    $("#searchkelas").click(function() {
        datakelas();
        $("#modalkelas").modal("show");
    });

    function datakelas() {
        $("#tablekelas tbody").remove()
        $("#tablekelas").DataTable({
            "destroy": true,
            "searching": true,
            "processing": true,
            "serverSide": true,
            "lengthChange": true,
            "ordering": false,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('master_data/kelas/search'); ?>",
                "method": "POST",
                "data": {
                    nmtb: "cari_kelas",
                    field: {
                        kode: "kode",
                        nama: "nama",
                    },
                    sort: "kode",
                    where: {
                        kode: "kode",
                        nama: "nama"
                    },
                    value: "aktif = true"
                },
            },
            "columnDefs": [{
                "targets": [0, 1, 2],
                "className": "text-center"
            }],
        });
    }

    $("#tablekelas").on("click", ".btn", function() {
        $("#kodekelas").val($("#tablekelas").DataTable().row($(this).parents("tr")).data()[0]);
        $("#namakelas").val($("#tablekelas").DataTable().row($(this).parents("tr")).data()[1]);
        $("#modalkelas").modal("hide");
    });

    // Bagian Siswa
    $("#searchsiswa").click(function() {
        datasiswa();
        $("#modalsiswa").modal("show");
    });

    function datasiswa() {
        $("#tablesiswa tbody").remove()
        $("#tablesiswa").DataTable({
            "destroy": true,
            "searching": true,
            "processing": true,
            "serverSide": true,
            "lengthChange": true,
            "ordering": false,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('master_data/siswa/search'); ?>",
                "method": "POST",
                "data": {
                    nmtb: "cari_siswa",
                    field: {
                        kode: "kode",
                        email: "email",
                        nama: "nama",
                    },
                    sort: "kode",
                    where: {
                        kode: "kode",
                        nama: "nama"
                    },
                    value: "aktif = true"
                },
            },
            "columnDefs": [{
                "targets": [0, 1, 2],
                "className": "text-center"
            }],
        });
    }

    $("#tablesiswa").on("click", ".btn", function() {
        $("#kodesiswa").val($("#tablesiswa").DataTable().row($(this).parents("tr")).data()[0]);
        $("#email").val($("#tablesiswa").DataTable().row($(this).parents("tr")).data()[1]);
        $("#namasiswa").val($("#tablesiswa").DataTable().row($(this).parents("tr")).data()[2]);
        $("#modalsiswa").modal("hide");
    });


    function dataTable() {
        $("#table").DataTable({
            "destroy": true,
            "searching": true,
            "processing": true,
            "serverSide": true,
            "lengthChange": true,
            "ordering": false,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('master_data/mapping_siswa/data'); ?>",
                "method": "POST",
                "data": {
                    nmtb: "glbm_mapping_siswa",
                    field: {
                        // kode: "kode",
                        namasiswa: "namasiswa",
                        namakelas: "namakelas",
                        aktif: "aktif",
                    },
                    sort: "kode",
                    where: {
                        kode: "kode",
                        namasiswa: "namasiswa",
                    },
                    value: ""
                },
            },
            "columnDefs": [{
                "targets": [0, 1, 2, 3],
                "className": "text-center",
            }, {
                "targets": 2,
                "render": function(data, type, row, meta) {
                    return (row[2] == "t") ? "<span class='badge bg-success'>Aktif</span>" : "<span class='badge bg-warning'>Nonaktif</span>";
                },
            }, ],
        });
    }

    dataTable()

    $("#tambahkategori").click(function() {
        $("#formkategori")[0].reset()
        $("#fungsi").val("tambah")
        $("#kode").prop("readonly", true)

        $("#modalkategori").modal("show")
    })


    $("#formkategori").on('submit', function(event) {
        event.preventDefault()

        if ($("#kodekelas").val() == "") {
            swal.fire("Gagal!", "Mohon input Kode terlebih dahulu", "info")
        }else if ($("#kodesiswa").val() == "") {
            swal.fire("Gagal!", "Mohon input Kode terlebih dahulu", "info")
        } else {
            var form = $("#formkategori")[0];
            var data = new FormData(form);
            var fungsi = "";

            if ($("#fungsi").val() == "tambah") {
                fungsi = "tambah"
            } else {
                fungsi = "update"
            }

            $.ajax({
                "type": "POST",
                "url": "<?php echo base_url('master_data/mapping_siswa/" + fungsi + "'); ?>",
                "data": data,
                "processData": false,
                "contentType": false,
                "cache": false,
                "timeout": 800000,
                "async": true,
                "beforeSend": function() {
                    swal.fire({
                        title: 'Loading...',
                        didOpen: () => {
                            swal.showLoading()
                        }
                    })
                },
                "success": function(response) {
                    var data = eval("(" + response + ")")
                    if (data.success == true) {
                        swal.fire("Berhasil", data.msg, "success")
                        dataTable()
                        $("#modalkategori").modal("hide")
                    } else {
                        swal.fire("Gagal!", data.msg, "error");
                    }
                },
                "error": function(e) {
                    dataTable()
                }
            });
        }
    })

    function status(namasiswa) {
        swal.fire({
            title: "Ubah Status?",
            icon: "info",
            showCancelButton: true,
            cancelButtonText: "Batal",
            confirmButtonText: "OK",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    "url": "<?php echo base_url('master_data/mapping_siswa/status'); ?>",
                    "method": "POST",
                    "dataType": "json",
                    "data": {
                        "namasiswa": namasiswa
                    },
                    "async": true,
                    "beforeSend": function() {
                        swal.fire({
                            title: 'Loading...',
                            didOpen: () => {
                                swal.showLoading()
                            }
                        })
                    },
                    "success": function(data) {
                        if (data.success == true) {
                            swal.fire("Berhasil!", data.msg, "success")
                            dataTable()
                        } else {
                            swal.fire("Gagal!", data.msg, "error");
                        }
                    }
                }, false);
            }
        });
    }
</script>