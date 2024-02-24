<script type="text/javascript">
    var arr = [];
    var array = [];

    //input angka//
    function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;
        return true;
    }
    //angka//

    $('#tgl').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true
    });

    //VALIDASI//
    function CekValidasi() {
        if ($('#namakelas').val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'INFO',
                text: 'Pilih Data Kelas Terlebih Dahulu!',
                buttons: {
                    formSubmit: {
                        text: "OK",
                        btnClass: "btn-red"
                    }
                }
            });
            $('#namakelas').focus();
            var result = false;
        } else if ($('#kodekelas').val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'INFO',
                text: 'Pilih Data Kelas Terlebih Dahulu!',
                buttons: {
                    formSubmit: {
                        text: "OK",
                        btnClass: "btn-red"
                    }
                }
            });
            $('#kodekelas').focus();
            var result = false;
        } else if ($('#email').val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'INFO',
                text: 'Pilih Data Kelas Terlebih Dahulu!',
                buttons: {
                    formSubmit: {
                        text: "OK",
                        btnClass: "btn-red"
                    }
                }
            });
            $('#email').focus();
            var result = false;
        } else if ($('#namaguru').val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'INFO',
                text: 'Pilih Data Kelas Terlebih Dahulu!',
                buttons: {
                    formSubmit: {
                        text: "OK",
                        btnClass: "btn-red"
                    }
                }
            });
            $('#namaguru').focus();
            var result = false;
        } else if ($('#babbaca').val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'INFO',
                text: 'Masukan Jumlah Bab Yang Harus Dibaca Terlebih Dahulu!',
                buttons: {
                    formSubmit: {
                        text: "OK",
                        btnClass: "btn-red"
                    }
                }
            });
            $('#babbaca').focus();
            var result = false;
        } else if ($('#tanggal').val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'INFO',
                text: 'Pilih Tanggal Terlebih Dahulu!',
                buttons: {
                    formSubmit: {
                        text: "OK",
                        btnClass: "btn-red"
                    }
                }
            });
            $('#tanggal').focus();
            var result = false;
        } else {
            var result = true;
        }
        return result;
    };
    //VALIDASI

    //SHOWDATA//
    $(document).on('click', "#showdata", function() {

        var babbaca = $("#babbaca").val();
        var kodesiswa = $("#kodesiswa").val();
        var namasiswa = $("#namasiswa").val();
        var table = document.getElementById('tablemenu');
        var checkBoxes = table.getElementsByTagName("INPUT");
        var tanggal = $("#tanggal").val();
        var ind = "";
        var ins = "";
        var halamanbaca = "sd";
        var loopinganke = 0;
        var mulaibaca = 1;
        var sampaibaca = 0;

        for (var i = 0; i < checkBoxes.length; i++) {

            if (checkBoxes[i].checked) {
                var row = checkBoxes[i].parentNode.parentNode;
                beginning: while (true) {
                    loopinganke++;
                    sampaibaca += parseInt(babbaca);
                    if (sampaibaca > parseInt(row.cells[3].innerHTML)) {
                        sampaibaca = parseInt(row.cells[3].innerHTML);
                    }
                    halamanbaca = parseInt(mulaibaca) + " s/d " + parseInt(sampaibaca);
                    InsertMenuTerpilih(row.cells[1].innerHTML, row.cells[2].innerHTML, row.cells[3].innerHTML, row.cells[4].innerHTML, halamanbaca, loopinganke, tanggal, kodesiswa, namasiswa);
                    mulaibaca += parseInt(babbaca)
                    if (sampaibaca < parseInt(row.cells[3].innerHTML)) continue beginning;
                    break;
                }
            }
        }
        // var value = " kode NOT IN (" + ind + ")";
        // drawMenu(value);
        $("#modalbaca").modal("hide")
        row.remove();
    });

    function databuku() {
        $("#tablemenu tbody").remove()
        $("#modalbaca").modal("show");
        $("#tablemenu").DataTable({
            "destroy": true,
            "searching": true,
            "processing": true,
            "serverSide": true,
            "lengthChange": true,
            "ordering": false,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('master_data/mapping_siswa/search'); ?>",
                "method": "POST",
                "data": {
                    nmtb: "view_mapping_buku",
                    field: {
                        kodebuku: "kodebuku",
                        namabuku: "namabuku",
                        bab: "bab"
                    },
                    sort: "",
                    where: {
                        namabuku: "namabuku",
                    },
                },
            },
            "columnDefs": [{
                "targets": [0, 1, 2],
                "className": "text-center"
            }],
        });
    }

    $('#tablemenu').on('click', 'input[type="checkbox"]', function() {
        $("#modalbaca").modal("show");
        $("#kodebuku").val($("#tablemenu").DataTable().row($(this).parents("tr")).data()[1]);
        $("#namabuku").val($("#tablemenu").DataTable().row($(this).parents("tr")).data()[2]);
        $("#jumlahbab").val($("#tablemenu").DataTable().row($(this).parents("tr")).data()[3]);
    });
    //SHOW DATA//

    //DATA KE DETAIL//
    function InsertMenuTerpilih(kode, nama, bab, penerbit, halamanbaca, loopinganke, tanggal, kodesiswa, namasiswa) {
        var row = "";
        var currentDate = new Date(tanggal);
        console.log(currentDate = new Date(tanggal));
        var nextDate = new Date(currentDate);
        nextDate.setDate(currentDate.getDate() + parseInt(loopinganke));
        var year = nextDate.getFullYear();
        var month = (nextDate.getMonth() + 1 < 10 ? '0' : '') + (nextDate.getMonth() + 1);
        var day = (nextDate.getDate() < 10 ? '0' : '') + nextDate.getDate();
        var formattedDate = year + '-' + month + '-' + day;

        row =
            '<tr data-index="' + kode + '">' +
            '<td style="text-align: center;"><input name="id_buku[]" type="checkbox" value="' + kode + '" checked></td>' +
            '<td>' + kode + '</td>' +
            '<td>' + nama + '</td>' +
            '<td>' + penerbit + '</td>' +
            '<td>' + halamanbaca + '</td>' +
            '<td>' + formattedDate + '</td>' +
            '<td>' + kodesiswa + '</td>' +
            '<td style="display: none;">' + namasiswa + '</td>' +
            '<td>' + namasiswa + '</td>' +
            '</tr>';

        $('#tablemenuterpilihdetail').append(row);
    };

    $('#tablemenuterpilih').on('click', 'input[type="checkbox"]', function() {
        var index = $(this).closest("tr").attr("data-index");
        var findRow = $("#tablemenuterpilih tr[data-index='" + index + "']");
        arr = remove(array, index);
        findRow.remove();
        array = arr;

        var value = "";
        if (array.length != 0) {
            value = " kode NOT IN ('" + array + "')";
        } else {
            value = "";
        }
        drawMenu(value);
    });
    //DATA KE DETAIL//

    //HAPUS DETAIL//
    function remove(arrOriginal, elementToRemove) {
        return arrOriginal.filter(function(el) {
            return el !== elementToRemove
        });
    }
    //HAPUS DETAIL//

    //TAMPIL DATA TABEL//
    function drawMenu(kodekelas) {
        var kodekelas = $("#kodekelas").val();
        console.log(kodekelas = $("#kodekelas").val());
        $("#tablemenu tbody").remove();
        $("#tablemenu").DataTable({
            "destroy": true,
            "searching": true,
            "processing": true,
            "serverSide": true,
            "lengthChange": true,
            "ordering": false,
            "pageLength": 5,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('read/auto_read/carimenu'); ?>",
                "method": "POST",
                "data": {
                    nmtb: "view_mapping_buku",
                    field: {
                        kodebuku: "kodebuku",
                        namabuku: "namabuku",
                        bab: "bab",
                        penerbit: "penerbit",
                    },
                    sort: "",
                    where: {
                        namabuku: "namabuku",
                    },
                },
            },
            "columnDefs": [{
                "targets": "_all",
                "className": "align-middle",
            }, {
                "targets": "_all",
                "className": "text-center",
            }],
        });
    }

    $("#tablesiswa").on("click", ".btn", function() {
        $("#namakelas").val($("#tablesiswa").DataTable().row($(this).parents("tr")).data()[1]);
        $("#kodekelas").val(kodekelas);
        $("#email").val($("#tablesiswa").DataTable().row($(this).parents("tr")).data()[2]);
        $("#namaguru").val($("#tablesiswa").DataTable().row($(this).parents("tr")).data()[3]);
        $("#modalsiswa").modal("hide");
        drawMenu(kodekelas);
    });
    //TAMPIL DATA DETAIL//

    //AMBIL DATA UNTUK SAVE//
    function ambildatadetail() {
        var table = document.getElementById('tablemenuterpilih');
        var arr2 = [];
        for (var r = 1, n = table.rows.length; r < n; r++) {
            var obj = {};
            for (var c = 0, m = table.rows[r].cells.length; c < m - 1; c++) {
                var columnName = table.rows[0].cells[c].innerHTML.toLowerCase().replace(/ /g, "").replace(".", "");
                var cellValue = table.rows[r].cells[c].innerHTML.trim();

                obj[columnName] = cellValue;
            }
            arr2.push(obj);
        }
        return arr2;
    }
    //AMBIL DATA UNTUK SAVE//

    //SAVE//
    document.getElementById("save").addEventListener("click", function(event) {
        event.preventDefault();
        if ($("#namakelas").val() == "") {
            swal.fire("Gagal!", "Mohon Pilih Data Kelas terlebih dahulu", "info")
        } else if ($("#kodekelas").val() == "") {
            swal.fire("Gagal!", "Mohon Pilih Data Kelas terlebih dahulu", "info")
        } else if ($("#email").val() == "") {
            swal.fire("Gagal!", "Mohon Pilih Data Kelas terlebih dahulu", "info")
        } else if ($("#namaguru").val() == "") {
            swal.fire("Gagal!", "Mohon Pilih Data Kelas terlebih dahulu", "info")
        } else if ($("#babbaca").val() == "") {
            swal.fire("Gagal!", "Mohon Masukan Jumlah BAB Buku Yang Harus Dibaca terlebih dahulu", "info")
        } else if ($("#tanggal").val() == "") {
            swal.fire("Gagal!", "Mohon Pilih Tanggal Mulai Baca terlebih dahulu", "info")
        } else {
            var datadetail = ambildatadetail();
            var kodekelas = $("#kodekelas").val();
            var namakelas = $("#namakelas").val();
            var result = false;

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('read/auto_read/tambah'); ?>",
                data: {
                    kodekelas: kodekelas,
                    namakelas: namakelas,
                    datadetail: datadetail
                },
                dataType: 'json',
                beforeSend: function() {
                    swal.fire({
                        title: 'Loading...',
                        didOpen: () => {
                            swal.showLoading()
                        }
                    })
                },
                success: function(response) {
                    if (response.success == true) {
                        swal.fire("Berhasil", response.msg, "success")
                            .then(() => {
                                location.reload();
                            });
                    } else {
                        swal.fire("Gagal!", response.msg, "error");
                    }
                },
                error: function(e) {}
            });
        }
    });
    //SAVE//

    //CARI MAPPING KELAS
    $("#searchsiswa").click(function() {
        dataSiswa();
        $("#modalsiswa").modal("show");
    });

    function dataSiswa() {
        $("#tablesiswa tbody").remove()
        $("#tablesiswa").DataTable({
            "destroy": true,
            "searching": true,
            "processing": true,
            "serverSide": true,
            "lengthChange": true,
            "ordering": false,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('master_data/mapping_siswa/search'); ?>",
                "method": "POST",
                "data": {
                    nmtb: "cari_datamapping",
                    field: {
                        // kode: "kode",
                        kodekelas: "kodekelas",
                        namakelas: "namakelas",
                        kodeguru: "kodeguru",
                        namaguru: "namaguru",
                        emailsiswa: "emailsiswa",
                        namasiswa: "namasiswa",
                    },
                    sort: "kodekelas",
                    where: {
                        kodekelas: "kodekelas",
                        namaguru: "namaguru"
                    },
                },
            },
            "columnDefs": [{
                "targets": [0, 1, 2, 3, 4, 5],
                "className": "text-center"
            }],
        });
    }

    $("#tablesiswa").on("click", ".btn", function() {
        $("#namakelas").val($("#tablesiswa").DataTable().row($(this).parents("tr")).data()[1]);
        $("#kodekelas").val($("#tablesiswa").DataTable().row($(this).parents("tr")).data()[0]);
        $("#email").val($("#tablesiswa").DataTable().row($(this).parents("tr")).data()[2]);
        $("#namaguru").val($("#tablesiswa").DataTable().row($(this).parents("tr")).data()[3]);
        $("#kodesiswa").val($("#tablesiswa").DataTable().row($(this).parents("tr")).data()[4]);
        $("#namasiswa").val($("#tablesiswa").DataTable().row($(this).parents("tr")).data()[5]);
        $("#modalsiswa").modal("hide");
    });
    //CARI MAPPING KELAS
</script>