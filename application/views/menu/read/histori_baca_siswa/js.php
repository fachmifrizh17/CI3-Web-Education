<script type="text/javascript">
    function Ganti2() {
        document.getElementById("bnama").innerHTML = "NAMA KELAS";
    }

    function Ganti4() {
        document.getElementById("bwali").innerHTML = "NAMA WALI KELAS";
    }

    function Ganti5() {
        document.getElementById("bmurid").innerHTML = "JUMLAH MURID";
    }

    function dataTable() {
        var tglawal = $("#tglawal").val();
        var tglakhir = $("#tglakhir").val();
        $("#table").DataTable({
            "destroy": true,
            "searching": true,
            "processing": true,
            "serverSide": true,
            "lengthChange": true,
            "ordering": false,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('read/histori_baca/data'); ?>",
                "method": "POST",
                "data": function(d) {
                    d.nmtb = "stpm_generatedetail";
                    d.field = {
                        kode: "kode",
                        namasiswa: "namasiswa",
                        nama: "nama",
                        bab: "bab",
                        note: "note",
                        tanggal: "tanggal",
                        selesaibaca: "selesaibaca",
                        status_baca: "status_baca",
                    };
                    d.sort = "kode";
                    d.where = {
                        kode: "kode",
                        namasiswa: "namasiswa",
                    };
                    d.value = "status_baca = true";
                    // console.log(d.value = "status_baca = true and tanggal = '"+tglawal+"' and tanggal = '"+tglakhir+"'");
                    d.tglawal = tglawal;
                    d.tglakhir = tglakhir;
                },
            },
            "columnDefs": [{
                    "targets": [0, 1, 2, 3, 4, 5, 6, 7],
                    "className": "text-center",
                },
                {
                    "targets": 5,
                    "render": $.fn.dataTable.render.moment('YYYY-MM-DD HH:mm:ss', 'D MMM YY')
                },
                {
                    "targets": 7,
                    "render": function(data, type, row, meta) {
                        return (row[7] == "0") ? "<span class='badge bg-danger'>NOT YET</span>" : "<span class='badge bg-success'>DONE</span>";
                    },
                },
            ],
        });
    }

    $("#search-btn").on("click", function() {
        dataTable();
    });
</script>