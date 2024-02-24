<script type="text/javascript">
    function Ganti() {
        document.getElementById("bkode").innerHTML = "KODE BUKU";
    }

    function Ganti2() {
        document.getElementById("bnama").innerHTML = "NAMA BUKU";
    }

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
                "url": "<?php echo base_url('master_data/mapping_buku/data'); ?>",
                "method": "POST",
                "data": {
                    nmtb: "glbm_mapping_buku",
                    field: {
                        kode: "kode",
                        kodekelas: "kodekelas",
                        namakelas: "namakelas",
                        kodebuku: "kodebuku",
                        namabuku: "namabuku",
                        bab: "bab",
                        penerbit: "penerbit",
                        aktif: "aktif",
                    },
                    sort: "kodekelas",
                    where: {
                        kodekelas: "kodekelas",
                        namakelas: "namakelas",
                    },
                    value: ""
                },
            },
            "columnDefs": [{
                "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8],
                "className": "text-center",
            }, {
                "targets": 7,
                "render": function(data, type, row, meta) {
                    return (row[7] == "t") ? "<span class='badge bg-success'>Aktif</span>" : "<span class='badge bg-warning'>Nonaktif</span>";
                },
            }],
        });
    }

    dataTable()

    $("#tambahbuku").click(function() {
        $("#formbuku")[0].reset()
        $("#fungsi").val("tambah")
        $("#kode").prop("readonly", true)

        $("#modalbuku").modal("show")
    })

    function edit(kode) {
        $.ajax({
            "url": "<?php echo base_url('master_data/mapping_buku/get_data'); ?>",
            "method": "POST",
            "dataType": "json",
            "data": {
                "kode": kode
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
                $("#fungsi").val("update")
                $("#kode").val(data.kode)
                $("#kodekelas").val(data.kodekelas)
                $("#namakelas").val(data.namakelas)
                $("#kodebuku").val(data.kodebuku)
                $("#bab").val(data.bab)
                $("#namabuku").val(data.namabuku)
                $("#penerbit").val(data.penerbit)
                $("#kodebuku").prop("readonly", true)

                swal.close()
                $("#modalbuku").modal("show")
            }
        }, false);
    }

    $("#formbuku").on('submit', function(event) {
        event.preventDefault()

        if ($("#kodekelas").val() == "") {
            swal.fire("Gagal!", "Mohon input kode kelas terlebih dahulu", "info")
        }else if ($("#kodebuku").val() == "") {
            swal.fire("Gagal!", "Mohon input kode buku terlebih dahulu", "info")
        } else {
            var form = $("#formbuku")[0];
            var data = new FormData(form);
            var fungsi = "";

            if ($("#fungsi").val() == "tambah") {
                fungsi = "tambah"
            } else {
                fungsi = "update"
            }

            $.ajax({
                "type": "POST",
                "url": "<?php echo base_url('master_data/mapping_buku/" + fungsi + "'); ?>",
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
                        $("#modalbuku").modal("hide")
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

    // Bagian UoM
    $("#searchkelas").click(function() {
        dataUom();
        $("#modalbuku1").modal("show");
    });

    function dataUom() {
        $("#tablebuku tbody").remove()
        $("#tablebuku").DataTable({
            "destroy": true,
            "searching": true,
            "processing": true,
            "serverSide": true,
            "lengthChange": true,
            "ordering": false,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('master_data/buku/search'); ?>",
                "method": "POST",
                "data": {
                    nmtb: "cari_kelas",
                    field: {
                        kode: "kode",
                        nama: "nama"
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
                "targets": [0, 1],
                "className": "text-center"
            }],
        });
    }

    $("#tablebuku").on("click", ".btn", function() {
        $("#kodekelas").val($("#tablebuku").DataTable().row($(this).parents("tr")).data()[0]);
        $("#namakelas").val($("#tablebuku").DataTable().row($(this).parents("tr")).data()[1]);
        $("#modalbuku1").modal("hide");
        // $("#penerbit").modal("hide");
    });

    $("#searchturunan").click(function() {
        dataturunan();
        $("#modalturunan").modal("show");
    });

    function dataturunan() {
        $("#tableturunan tbody").remove()
        $("#tableturunan").DataTable({
            "destroy": true,
            "searching": true,
            "processing": true,
            "serverSide": true,
            "lengthChange": true,
            "ordering": false,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('master_data/buku/search'); ?>",
                "method": "POST",
                "data": {
                    nmtb: "cari_buku",
                    field: {
                        kode: "kode",
                        nama: "nama",
                        bab: "bab",
                        penerbit: "penerbit",
                    },
                    sort: "kode",
                    where: {
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

    $("#tableturunan").on("click", ".btn", function() {
        $("#kodebuku").val($("#tableturunan").DataTable().row($(this).parents("tr")).data()[0]);
        $("#namabuku").val($("#tableturunan").DataTable().row($(this).parents("tr")).data()[1]);
        $("#bab").val($("#tableturunan").DataTable().row($(this).parents("tr")).data()[2]);
        $("#penerbit").val($("#tableturunan").DataTable().row($(this).parents("tr")).data()[3]);
        $("#modalturunan").modal("hide");
        // $("#penerbit").modal("hide");
    });

    function status(kodebuku) {
        swal.fire({
            title: "Ubah Status?",
            icon: "info",
            showCancelButton: true,
            cancelButtonText: "Batal",
            confirmButtonText: "OK",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    "url": "<?php echo base_url('master_data/mapping_buku/status'); ?>",
                    "method": "POST",
                    "dataType": "json",
                    "data": {
                        "kodebuku": kodebuku
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