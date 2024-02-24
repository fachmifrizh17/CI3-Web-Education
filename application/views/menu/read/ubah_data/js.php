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
                "url": "<?php echo base_url('read/ubah_data/data'); ?>",
                "method": "POST",
                "data": {
                    nmtb: "stpm_generate",
                    field: {
                        kode: "kode",
                        kodekelas: "kodekelas",
                        namakelas: "namakelas",
                        aktif: "aktif",
                    },
                    sort: "kode",
                    where: {
                        kode: "kode",
                        kodekelas: "kodekelas",
                    },
                    value: "aktif = true",
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
            }],
        });
    }
    dataTable()

    function dataTables() {
        $("#t_detail").DataTable({
            "destroy": true,
            "searching": true,
            "processing": true,
            "serverSide": true,
            "lengthChange": true,
            "ordering": false,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('read/ubah_data/datas'); ?>",
                "method": "POST",
                "data": {
                    nmtb: "stpm_generatedetail",
                    field: {
                        kode: "kode",
                        tanggal: "tanggal",
                        nama: "nama",
                        bab: "bab",
                        status_baca: "status_baca",
                    },
                    sort: "kode",
                    where: {
                        nama: "nama",
                        kodebuku: "kodebuku",
                    },
                    value: "aktif = true"
                },
            },
            "columnDefs": [{
                "targets": [0, 1, 2, 3, 4],
                "className": "text-center",
            }, {
                "targets": 1,
                "render": $.fn.dataTable.render.moment('YYYY-MM-DD HH:mm:ss', 'D MMM YY')
            },  ],
        });
    }
    dataTables()

    function status(kode) {
        swal.fire({
            title: "Ubah Status?",
            icon: "info",
            showCancelButton: true,
            cancelButtonText: "Batal",
            confirmButtonText: "Ok",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    "url": "<?php echo base_url('read/ubah_data/status'); ?>",
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
                        if (data.success == true) {
                            swal.fire("Berhasil!", data.msg, "success")
                            $("#modaldetail").modal("hide")
                            dataTable()
                        } else {
                            swal.fire("Gagal!", data.msg, "error");
                        }
                    }
                }, false);
            }
        });
    }

    function edit(kode) {
        $.ajax({
            "url": "<?php echo base_url('read/ubah_data/get_data'); ?>",
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
                swal.close();

                for (var i = 0; i < data.length; i++) {
                    var row = '<tr>' +
                        '<td class="text-center">' + data[i].kode + '</td>' +
                        '<td class="text-center">' + data[i].tanggal + '</td>' +
                        '<td class="text-center">' + data[i].nama + '</td>' +
                        '<td class="text-center">' + data[i].bab + '</td>' +
                        '<td class="text-center">' + data[i].namasiswa + '</td>' +
                        '</tr>';
                    $('#t_detail').append(row);
                }

                dataTables(kode);

                $("#modaldetail").modal("show");
            }
        }, false);
    }
</script>