<script type="text/javascript">
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
                "url": "<?php echo base_url('master_data/user/data'); ?>",
                "method": "POST",
                "data": {
                    nmtb: "asst_view_user",
                    field: {
                        username: "username",
                        namacabang: "namacabang",
                        namacompany: "namacompany",
                        aktif: "aktif",
                    },
                    sort: "tglsimpan",
                    where: {
                        username: "username",
                    },
                    value: ""
                },
            },
            "columnDefs": [{
                "targets": [3, 4],
                "className": "text-center",
            }, {
                "targets": 3,
                "render": function(data, type, row, meta) {
                    return (row[3] == "t") ? "<span class='badge bg-success'>Aktif</span>" : "<span class='badge bg-warning'>Nonaktif</span>";
                },
            }],
        });
    }

    dataTable()

    $("#tambahuser").click(function() {
        $("#formuser")[0].reset()
        $("#fungsi").val("tambah")
        $("#username").prop("readonly", false)

        $("#modaluser").modal("show")
    })

    $("#passwordtoggle").click(function() {
        if ($("#password").prop("type") == "password") {
            $("#password").prop("type", "text")
        } else {
            $("#password").prop("type", "password")
        }
    })

    function edit(username) {
        $.ajax({
            "url": "<?php echo base_url('master_data/user/get_data'); ?>",
            "method": "POST",
            "dataType": "json",
            "data": {
                "username": username
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
                $("#username").val(data.username)
                $("#username").prop("readonly", true)
                $("#password").val(data.password)
                $("#kodecabang").val(data.kodecabang)
                $("#kodecompany").val(data.kodecompany)

                swal.close()
                $("#modaluser").modal("show")
            }
        }, false);
    }

    $("#formuser").on('submit', function(event) {
        event.preventDefault()

        if ($("#username").val() == "") {
            swal.fire("Gagal!", "Mohon input Nama terlebih dahulu", "info")
        } else if ($("#password").val() == "") {
            swal.fire("Gagal!", "Mohon input Password terlebih dahulu", "info")
        } else if ($("#kodecabang").val() == "") {
            swal.fire("Gagal!", "Mohon pilih Cabang terlebih dahulu", "info")
        } else if ($("#kodecompany").val() == "") {
            swal.fire("Gagal!", "Mohon pilih Company terlebih dahulu", "info")
        } else {
            var form = $("#formuser")[0];
            var data = new FormData(form);
            var fungsi = "";

            if ($("#fungsi").val() == "tambah") {
                fungsi = "tambah"
            } else {
                fungsi = "update"
            }

            $.ajax({
                "type": "POST",
                "url": "<?php echo base_url('master_data/user/" + fungsi + "'); ?>",
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
                        $("#modaluser").modal("hide")
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

    function status(username) {
        swal.fire({
            title: "Ubah Status?",
            icon: "info",
            showCancelButton: true,
            cancelButtonText: "Batal",
            confirmButtonText: "OK",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    "url": "<?php echo base_url('master_data/user/status'); ?>",
                    "method": "POST",
                    "dataType": "json",
                    "data": {
                        "username": username
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