<script type="text/javascript">

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

    function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;
        return true;
    }

	function selectIMG() {
		$("#gambar").trigger("click");
	}

	function clearIMG() {
		$("#gambar").val(null).trigger("change");
	}

	$("#gambar").change(function(e) {
		var fileName = e.target.files[0].name;
		$(this).next('.custom-file-label').html(fileName);
		if ($(this).val() != "") {
			readURL(this);
			$("#gambarpreview").show();
		} else {
			$("#gambarpreview").hide();
		}
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
                "url": "<?php echo base_url('master_data/siswa/data'); ?>",
                "method": "POST",
                "data": {
                    nmtb: "cari_siswa",
                    field: {
                        // kode: "kode",
                        email: "email",
                        nama: "nama",
                        jenkel: "jenkel",
                        usia: "usia",
                        aktif: "aktif",
                    },
                    sort: "email",
                    where: {
                        email: "email",
                        nama: "nama",
                    },
                    value: ""
                },
            },
            "columnDefs": [{
                "targets": [0,1,2,3,4,5],
                "className": "text-center",
            }, {
                "targets": 4,
                "render": function(data, type, row, meta) {
                    return (row[4] == "t") ? "<span class='badge bg-success'>Aktif</span>" : "<span class='badge bg-warning'>Nonaktif</span>";
                },
            }, {
                "targets": 2,
                "render": function(data, type, row, meta) {
                    return (row[2] == "1") ? "Laki-Laki" : "Perempuan";
                },
            }],
        });
    }

    dataTable()

    $("#tambahkategori").click(function() {
        $("#formkategori")[0].reset()
        $("#fungsi").val("tambah")
        $("#kode").prop("readonly", true)
        $('#gambarpreview').hide()

        $("#modalkategori").modal("show")
    })

    function edit(email) {
        $.ajax({
            "url": "<?php echo base_url('master_data/siswa/get_data'); ?>",
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
                $("#kode").val(data.kode)
                $('#gambar_lama').val(data.image);
                $("#kode").prop("readonly", true)
                $("#email").val(data.email)
                $("#nama").val(data.nama)
                $('#gambarpreview').attr('src', "<?php echo base_url('assets/img/foto/') ?>" + data.image);
			    $('#gambarpreview').show();
                $("#jenkel").val(data.jenkel)
                $("#usia").val(data.usia)

                swal.close()
                $("#modalkategori").modal("show")
            }
        }, false);
    }

    $("#formkategori").on('submit', function(event) {
        event.preventDefault()

        if ($("#email").val() == "") {
            swal.fire("Gagal!", "Mohon input email terlebih dahulu", "info")
        } else if ($("#nama").val() == "") {
            swal.fire("Gagal!", "Mohon input Nama Lengkap terlebih dahulu", "info")
        } else if ($("#jenkel").val() == "") {
            swal.fire("Gagal!", "Mohon input Jenis Kelamin terlebih dahulu", "info")
        } else if ($("#usia").val() == "") {
            swal.fire("Gagal!", "Mohon input Usia terlebih dahulu", "info")
        } else if ($("#image").val() == '' && $("#kode").val() == 0) {
			swal.fire("Gagal!", "Mohon input Image terlebih dahulu", "info")
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
                "url": "<?php echo base_url('master_data/siswa/" + fungsi + "'); ?>",
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
                    "url": "<?php echo base_url('master_data/siswa/status'); ?>",
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