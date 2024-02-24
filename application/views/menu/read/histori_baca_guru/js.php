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
        var email = "<?php echo $this->session->userdata('myusername'); ?>";
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
                "data":  function(d) {
                    d.nmtb = "stpm_generatedetail";
                    d.field = {
                        tanggal: "tanggal",
                        nama: "nama",
                        bab: "bab",
                        note: "note",
                        namasiswa: "namasiswa",
                        selesaibaca: "selesaibaca",
                        status_baca: "status_baca",
                    },
                    d.sort = "kode";
                    d.where = {
                        kode: "kode",
                        namasiswa: "namasiswa",
                    };
                    d.value= "status_baca = true AND emailsiswa = '"+email+"'";
                    d.tglawal = tglawal;
                    d.tglakhir = tglakhir;
                },
            },
            "columnDefs": [{
                "targets": [0,1,2,3,4,5,6],
                "className": "text-center",
            },
            {
                    "targets": 0,
                    "render": $.fn.dataTable.render.moment('YYYY-MM-DD HH:mm:ss', 'D MMM YY')
                },
            {
                "targets": 6,
                "render": function(data, type, row, meta) {
                    return (row[6] == "1") ? "<span class='badge bg-danger'>NOT YET</span>" : "<span class='badge bg-success'>DONE</span>";
                },
            },],
        });
    }
    
    $("#search-btn").on("click", function() {
        dataTable();
    });
</script>