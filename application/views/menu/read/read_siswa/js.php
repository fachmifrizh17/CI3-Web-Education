<script type="text/javascript">
    //FORMAT TANGGAL//
    function FormatDate(input) {
        var date = new Date(input);
        var yyyy = date.getFullYear();
        var mm = date.getMonth() + 1;
        var dd = date.getDate();
        var hrs = date.getHours();
        var mnt = date.getMinutes();


        if (dd < 10) {
            dd = '0' + dd;
        }
        if (mm < 10) {
            mm = '0' + mm;
        }
        if (hrs < 10) {
            hrs = '0' + hrs;
        }
        if (mnt < 10) {
            mnt = '0' + mnt;
        }
        return yyyy + '-' + mm + '-' + dd;
    };
    //FORMAT TANGGAL//

    //table data//
    function dataTable() {
        var email = "<?php echo $this->session->userdata('myusername'); ?>";
        var today = new Date().toISOString().slice(0, 10);
        var yesterday = new Date();
        yesterday.setDate(yesterday.getDate() - 1);
        var formattedYesterday = yesterday.toISOString().slice(0, 10);

        $("#table").DataTable({
            "destroy": true,
            "searching": true,
            "processing": true,
            "serverSide": true,
            "lengthChange": true,
            "ordering": false,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('read/auto_read/search'); ?>",
                "method": "POST",
                "data": function(d) {
                    d.nmtb = "stpm_generatedetail";
                    d.field = {
                        kode: "kode",
                        tanggal: "tanggal",
                        nama: "nama",
                        bab: "bab",
                        namasiswa: "namasiswa",
                        status_baca: "status_baca",
                    };
                    d.sort = "tanggal,kode";
                    d.where = {
                        kode: "kode",
                        nama: "nama",
                        namasoswa: "namasiswa",
                    };
                    d.value = "status_baca=false AND emailsiswa = '" + email + "' and tanggal >= '" + formattedYesterday + "' and tanggal <= '" + today + "'";
                }
            },
            "columnDefs": [{
                    "targets": "_all",
                    "className": "text-center align-middle",
                },
                {
                    "targets": 1,
                    "render": $.fn.dataTable.render.moment('YYYY-MM-DD HH:mm:ss', 'D MMM YY')
                },
                {
                    "targets": 5,
                    "render": function(data, type, row, meta) {
                        return (row[5] == "false") ? "<span class='badge bg-success'>Done</span>" : "<span class='badge bg-warning'>Belum Dibaca</span>";
                    },
                }
            ],
        });
    }
    dataTable();
    //end table data//

    $('#table').on('click', 'input[type="checkbox"]', function() {
        $("#formread")[0].reset()
        $("#fungsi").val("tambah")
        $("#modalread").modal("show")
        $("#kode").val($("#table").DataTable().row($(this).parents("tr")).data()[0]);
        $("#tanggal").val(FormatDate($("#table").DataTable().row($(this).parents("tr")).data()[1]));
        $("#nama").val($("#table").DataTable().row($(this).parents("tr")).data()[2]);
        $("#bab").val($("#table").DataTable().row($(this).parents("tr")).data()[3]);
        $("#modalread").modal("hide");
    });

    $("#formread").on('submit', function(event) {
        event.preventDefault()

        if ($("#note").val() == "") {
            swal.fire("Gagal!", "Mohon Masukan Note terlebih dahulu", "info")
        } else if ($("#selesaibaca").val() == "") {
            swal.fire("Gagal!", "Mohon Masukan Jam Selesai Baca terlebih dahulu", "info")
        } else {
            var form = $("#formread")[0];
            var data = new FormData(form);

            $.ajax({
                "type": "POST",
                "url": "<?php echo base_url('read/read/update'); ?>",
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
        $("#modalread").modal("hide")
    })
</script>