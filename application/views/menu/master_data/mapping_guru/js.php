<script type="text/javascript">
    function Ganti3() {
        document.getElementById("bnamakelas").innerHTML = "NAMA KELAS";
    }

    function Ganti5() {
        document.getElementById("bemail").innerHTML = "email";
    }

    function Ganti6() {
        document.getElementById("bnamaguru").innerHTML = "NAMA GURU";
    }

    function Ganti7() {
        document.getElementById("balamat").innerHTML = "ALAMAT GURU";
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

    // Bagian guru
    $("#searchguru").click(function() {
        dataguru();
        $("#modalguru").modal("show");
    });

    function dataguru() {
        $("#tableguru tbody").remove()
        $("#tableguru").DataTable({
            "destroy": true,
            "searching": true,
            "processing": true,
            "serverSide": true,
            "lengthChange": true,
            "ordering": false,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('master_data/guru/search'); ?>",
                "method": "POST",
                "data": {
                    nmtb: "cari_guru",
                    field: {
                        kode: "kode",
                        nama: "nama",
                        email: "email",
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
                "targets": [0, 1, 2, 3],
                "className": "text-center"
            }],
        });
    }

    $("#tableguru").on("click", ".btn", function() {
        $("#kodeguru").val($("#tableguru").DataTable().row($(this).parents("tr")).data()[0]);
        $("#namaguru").val($("#tableguru").DataTable().row($(this).parents("tr")).data()[1]);
        $("#email").val($("#tableguru").DataTable().row($(this).parents("tr")).data()[2]);
        $("#modalguru").modal("hide");
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
                "url": "<?php echo base_url('master_data/mapping_guru/data'); ?>",
                "method": "POST",
                "data": {
                    nmtb: "glbm_mapping_guru",
                    field: {
                        // kode: "kode",
                        namakelas: "namakelas",
                        namaguru: "namaguru",
                        aktif: "aktif",
                    },
                    sort: "kode",
                    where: {
                        kode: "kode",
                        namakelas: "namakelas",
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

    $("#tambahmappingguru").click(function() {
        $("#formmappingguru")[0].reset()
        $("#fungsi").val("tambah")
        $("#kode").prop("readonly", true)

        $("#modalmappingguru").modal("show")
    })

    $("#formmappingguru").on('submit', function(event) {
        event.preventDefault()

        if ($("#kode").val() == "") {
            swal.fire("Gagal!", "Mohon pilih kode kelas terlebih dahulu", "info")
        }else if ($("#kodeguru").val() == "") {
            swal.fire("Gagal!", "Mohon pilih kode guru terlebih dahulu", "info")
        } else {
            var form = $("#formmappingguru")[0];
            var data = new FormData(form);
            var fungsi = "";

            if ($("#fungsi").val() == "tambah") {
                fungsi = "tambah"
            } else {
                fungsi = "update"
            }

            $.ajax({
                "type": "POST",
                "url": "<?php echo base_url('master_data/mapping_guru/" + fungsi + "'); ?>",
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
                        $("#modalmappingguru").modal("hide")
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

    function status(namakelas) {
        swal.fire({
            title: "Ubah Status?",
            icon: "info",
            showCancelButton: true,
            cancelButtonText: "Batal",
            confirmButtonText: "OK",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    "url": "<?php echo base_url('master_data/mapping_guru/status'); ?>",
                    "method": "POST",
                    "dataType": "json",
                    "data": {
                        "namakelas": namakelas
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