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
                "url": "<?php echo base_url('master_data/admin/data'); ?>",
                "method": "POST",
                "data": {
                    nmtb: "glbm_login",
                    field: {
                        email: "email",
                        nama: "nama",
                        roleid: "roleid",
                        aktif: "aktif",
                    },
                    sort: "tglsimpan",
                    where: {
                        email: "email",
                    },
                    value: ""
                },
            },
            "columnDefs": [{
                "targets": [0, 1, 2, 3, 4],
                "className": "text-center",
            }, {
                "targets": 3,
                "render": function(data, type, row, meta) {
                    return (row[3] == "t") ? "<span class='badge bg-success'>Aktif</span>" : "<span class='badge bg-warning'>Nonaktif</span>";
                },
            }, {
                "targets": 2,
                "render": function(data, type, row, meta) {
                    return (row[2] == '1') ? '<b>Admin</b>' : (row[2] == '2') ? '<b>Siswa</b>' : '<p>Guru</p>';
                },
            }],
        });
    }

    dataTable()

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#gambarpreview').attr('src', e.target.result);
                $('#uploaded').val('uploaded');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    $("#image").change(function(e) {
        var fileName = e.target.files[0].name;
        $(this).next('.custom-file-label').html(fileName);
        if ($(this).val() != "") {
            readURL(this);
            $("#gambarpreview").show();
        } else {
            $("#gambarpreview").hide();
        }
    });

    $("#tambahuser").click(function() {
        $("#formuser")[0].reset()
        $("#fungsi").val("tambah")
        $("#email").prop("readonly", false)

        $("#modaluser").modal("show")
    })

    $("#passwordtoggle").click(function() {
        if ($("#password").prop("type") == "password") {
            $("#password").prop("type", "text")
        } else {
            $("#password").prop("type", "password")
        }
    })

    $("#searchgrup").click(function() {
        datakelas();
        $("#modalgrup").modal("show");
    });

    function datakelas() {
        $('#c').empty();
        var jenis = $('#roleid').val();
        if (jenis == "2") {
            $('#tablegrup').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": true,
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 50],
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('master_data/siswa/search'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_siswa",
                        field: {
                            email: "email",
                            nama: "nama",
                            image: "image",
                            password: "password"
                        },
                        sort: "email",
                        where: {
                            email: "email"
                        },
                    },
                },
                "columnDefs": [{
                    "targets": [0, 1, 2, 3, 4],
                    "className": "text-center",
                }]
            });
        } else if (jenis == "3") {
            $('#tablegrup').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": true,
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 50],
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('master_data/guru/search'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "glbm_guru",
                        field: {
                            email: "email",
                            nama: "nama",
                            image: "image",
                            password: "password"
                        },
                        sort: "email",
                        where: {
                            email: "email"
                        },
                    },
                },
                "columnDefs": [{
                    "targets": [0, 1, 2, 3, 4],
                    "className": "text-center",
                },]
            });
        } else {}
    };

    $("#tablegrup").on("click", ".btn", function() {
        $("#nama").val($("#tablegrup").DataTable().row($(this).parents("tr")).data()[1]);
        $("#email").val($("#tablegrup").DataTable().row($(this).parents("tr")).data()[0]);
        $("#image").val($("#tablegrup").DataTable().row($(this).parents("tr")).data()[2]);
        $("#password").val($("#tablegrup").DataTable().row($(this).parents("tr")).data()[3]);
        $("#modalgrup").modal("hide");
    });

    function edit(email) {
        $.ajax({
            "url": "<?php echo base_url('master_data/admin/get_data'); ?>",
            "method": "POST",
            "dataType": "json",
            "data": {
                "email": email
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
                $("#email").val(data.email)
                $("#roleid").val(data.roleid)
                $("#nama").val(data.nama)
                $("#email").prop("readonly", true)
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

        if ($("#email").val() == "") {
            swal.fire("Gagal!", "Mohon input Nama terlebih dahulu", "info")
        } else if ($("#password").val() == "") {
            swal.fire("Gagal!", "Mohon input Password terlebih dahulu", "info")
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
                "url": "<?php echo base_url('master_data/admin/" + fungsi + "'); ?>",
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

    function status(email) {
        swal.fire({
            title: "Ubah Status?",
            icon: "info",
            showCancelButton: true,
            cancelButtonText: "Batal",
            confirmButtonText: "OK",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    "url": "<?php echo base_url('master_data/admin/status'); ?>",
                    "method": "POST",
                    "dataType": "json",
                    "data": {
                        "email": email
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