<script type="text/javascript">

    document.getElementById("viewreport").addEventListener("click", function(event) {
        event.preventDefault();
        var modul = $('#modul').val();

        if (modul == 'p1') {
            window.open(
                "<?php echo base_url('laporan/laporan/DataSiswa/') ?>"
            );
        } else if (modul == 'p2') {
            window.open(
                "<?= base_url('laporan/laporan/DataGuru/'); ?>"
            )
        } else if (modul == 'p3') {
            window.open(
                "<?= base_url('laporan/laporan/DataBuku/'); ?>"
            )
        } else if (modul == 'p4') {
            window.open(
                "<?= base_url('laporan/laporan/MappingSiswa/'); ?>"
            )
        } else if (modul == 'p5') {
            window.open(
                "<?= base_url('laporan/laporan/MappingGuru/'); ?>"
            )
        } else if (modul == 'p6') {
            window.open(
                "<?= base_url('laporan/laporan/HistoriBaca/'); ?>"
            )
        }
    })
</script>