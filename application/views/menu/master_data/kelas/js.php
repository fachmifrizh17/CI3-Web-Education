<script type="text/javascript">
    function Ganti() {
        document.getElementById("bkelas").innerHTML = "KELAS";
    }

    function Ganti2() {
        document.getElementById("bnama").innerHTML = "NAMA KELAS";
    }

    function Ganti5() {
        document.getElementById("bmurid").innerHTML = "JUMLAH MURID";
    }

    function fun() {
        document.getElementById("formkategori").reset();
    }

    function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;
        return true;
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
                "url": "<?php echo base_url('master_data/kelas/data'); ?>",
                "method": "POST",
                "data": {
                    nmtb: "cari_kelas",
                    field: {
                        // kode: "kode",
                        nama: "nama",
                        murid: "murid",
                        aktif: "aktif",
                    },
                    sort: "nama",
                    where: {
                        nama: "nama",
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
            }],
        });
    }

    dataTable()

    $("#tambahkategori").click(function() {
        $("#formkategori")[0].reset()
        $("#fungsi").val("tambah")
        $("#kode").prop("readonly", true)

        $("#modalkategori").modal("show")
    })

    function edit(nama) {
        $.ajax({
            "url": "<?php echo base_url('master_data/kelas/get_data'); ?>",
            "method": "POST",
            "dataType": "json",
            "data": {
                "nama": nama
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
                $("#kode").prop("readonly", true)
                $("#nama").val(data.nama)
                $("#murid").val(data.murid)

                swal.close()
                $("#modalkategori").modal("show")
            }
        }, false);
    }

    $("#formkategori").on('submit', function(event) {
        event.preventDefault()

        if ($("#nama").val() == "") {
            swal.fire("Gagal!", "Mohon input Nama terlebih dahulu", "info")
        } else if ($("#murid").val() == "") {
            swal.fire("Gagal!", "Mohon input Jumlah Murid Lengkap terlebih dahulu", "info")
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
                "url": "<?php echo base_url('master_data/kelas/" + fungsi + "'); ?>",
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

    function status(nama) {
        swal.fire({
            title: "Ubah Status?",
            icon: "info",
            showCancelButton: true,
            cancelButtonText: "Batal",
            confirmButtonText: "Ok",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    "url": "<?php echo base_url('master_data/kelas/status'); ?>",
                    "method": "POST",
                    "dataType": "json",
                    "data": {
                        "nama": nama
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