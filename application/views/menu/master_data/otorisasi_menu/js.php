<script type="text/javascript">

    var arr = [];
    var array = [];

    // Form reset
    function reset() {
        $("#form")[0].reset()
        $("#fungsi").val("tambah")
        $("#kode").prop("readonly", false)
    }

    $("#clear").click(function() {
        reset()
    });

    // Bagian Cabang
    function drawTableUser() {
        $("#tablekaryawan tbody").remove()
        $("#tablekaryawan").DataTable({
            "destroy": true,
            "searching": true,
            "processing": true,
            "serverSide": true,
            "lengthChange": true,
            "ordering": false,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('master_data/otorisasimenu/cariuser'); ?>",
                "method": "POST",
                "data": {
                    nmtb: "stpm_rolemenu",
                    field: {
                        id: "id",
                        namarole: "namarole",
                    },
                    sort: "id",
                    where: {
                        namarole: "namarole",
                    },
                },
            },
            "columnDefs": [{
                "targets": "_all",
                "className": "text-center",
            }],
        });
    }

    drawTableUser();

    $("#searchuser").click(function() {
        $("#modalkaryawan").modal("show");
    });

    $("#tambah").click(function() {
        $("#roleid").val("");
        $("#nama").val("");
        $("#nama").prop("disabled", false);
        $('#tablemenuterpilihdetail').empty();
        $("#tambahotorisasimenu").modal("show");
        drawMenu("");
    })

    $(document).on('click', ".cabangok", function() {
        let index = $("#tablekaryawan").DataTable().row($(this).parents('tr')).index();
        $("#roleid").val($("#tablekaryawan").DataTable().rows().data()[index][0]);
        $("#nama").val($("#tablekaryawan").DataTable().rows().data()[index][1]);
        $('#tablemenuterpilihdetail').empty();

        DataMenu($("#roleid").val());
        $("#nama").prop("disabled", true);
        $('#terpakai').css("display", "flex");
        $("#tambahotorisasimenu").modal("show");
    });

    function DataMenu(roleid) {
        array = []; arry = [];
        var ind = "";
        var ins = "";
        var value = "";
        $.ajax({
            url: "<?php echo base_url('master_data/otorisasimenu/getmenu'); ?>",
            method: "POST",
            dataType: "json",
            async: true,
            data: {roleid: roleid},
            success: function(data) {
                for (var i = 0; i < data.length; i++) {
                    InsertMenuTerpilih(data[i].id, data[i].modul, data[i].title, data[i].pos);
                    array.push(data[i].id);
                }

                for (var j = 0; j < array.length; j++) {
                    ins = "," + array[j];
                    ind = (ind != "") ? ind + ins : array[j];
                }

                value = " id NOT IN ("+ ind +")";
                drawMenu(value);
            }
        });
    };

    $('#tablemenu').on('click', 'input[type="checkbox"]', function() {
        var table = document.getElementById('tablemenu');
        var checkBoxes = table.getElementsByTagName("INPUT");
        var ind = "";
        var ins = "";

        for (var i = 0; i < checkBoxes.length; i++) {
            if (checkBoxes[i].checked) {
                var row = checkBoxes[i].parentNode.parentNode;
                InsertMenuTerpilih(row.cells[1].innerHTML, row.cells[2].innerHTML, row.cells[3].innerHTML, row.cells[4].innerHTML);
                array.push(row.cells[1].innerHTML);
            }
        }

        for (var j = 0; j < array.length; j++) {
            ins = "," + array[j];
            ind = (ind != "") ? ind + ins : array[j];
        }

        var value = " id NOT IN ("+ ind +")";
        drawMenu(value);
    });

    function InsertMenuTerpilih(id, modul, nama, urutan) {
        var row = "";
        row =
            '<tr data-index="' + id + '">' +
            '<td style="text-align: center;"><input type="checkbox" id="' + id + '" checked></td>' +
            '<td>' + id + '</td>' +
            '<td>' + modul + '</td>' +
            '<td>' + nama + '</td>' +
            '<td>' + urutan + '</td>' +
            '</tr>';
        $('#tablemenuterpilih').append(row);
    };

    $('#tablemenuterpilih').on('click', 'input[type="checkbox"]', function() {
        var index = $(this).closest("tr").attr("data-index");
        var findRow = $("#tablemenuterpilih tr[data-index='" + index + "']");
        arr = remove(array, index);
        findRow.remove();
        array = arr;

        var value = "";
        if (array.length != 0) {
            value = " id NOT IN ("+ array +")";
        } else {
            value = "";
        }
        drawMenu(value);
    });

    function remove(arrOriginal, elementToRemove){
        return arrOriginal.filter(function(el){return el !== elementToRemove});
    }

    function drawMenu(where) {
        $("#tablemenu tbody").remove()
        $("#tablemenu").DataTable({
            "destroy": true,
            "searching": true,
            "processing": true,
            "serverSide": true,
            "lengthChange": true,
            "ordering": false,
            "pageLength" : 5,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('master_data/otorisasimenu/carimenu'); ?>",
                "method": "POST",
                "data": {
                    nmtb: "stpm_menu",
                    field: {
                        id: "id",
                        modul: "modul",
                        title: "title",
                        pos: "pos",
                    },
                    sort: "",
                    where: {
                        modul: "modul",
                        title: "title",
                    },
                    value: where
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

    drawMenu("");

    function ambildatadetail() {
        var table = document.getElementById('tablemenuterpilih');
        console.log(table.rows[0].cells.length);
        var arr2 = [];
        // var i = 0;
        // $('input[type=checkbox]').each(function() {
        //     var sThisVal = (this.checked ? $(this).val() : "");
        //     i = i + 1;
        //     if (sThisVal == 'on') {
        //         var string = "";
        //         for (var c = 0, m = table.rows[i].cells.length; c < m - 0; c++) {

        //             if (c == 0) {
        //                 string = "{" + table.rows[0].cells[c].innerHTML.toLowerCase().replace(" ", "").replace(".", "").replace(" ", "").replace(".", "") + " : '" + sThisVal + "'";
        //             } else {
        //                 string = string + ", " + table.rows[0].cells[c].innerHTML.toLowerCase().replace(" ", "").replace(".", "").replace(" ", "").replace(".", "") + " : '" + table.rows[i].cells[c].innerHTML + "'";
        //             }
        //         }
        //         string = string + "}";
        //         var obj = JSON.stringify(eval('(' + string + ')'));
        //         var arr = $.parseJSON(obj);
        //         arr2.push(arr);
        //     }
        // });
        for (var r = 1, n = table.rows.length; r < n; r++) {
            var string = "";

            for (var c = 0, m = table.rows[r].cells.length; c < m - 1; c++) {
                if (c == 0) {
                    string = "{" + table.rows[0].cells[c].innerHTML.toLowerCase().replace(" ", "").replace(".", "").replace(" ", "").replace(".", "") + " : '" + table.rows[r].cells[c].innerHTML.toLowerCase().replace(" ", "").replace(".", "").replace(" ", "").replace(".", "") + "'";
                } else {
                    string = string + ", " + table.rows[0].cells[c].innerHTML.toLowerCase().replace(" ", "").replace(".", "").replace(" ", "").replace(".", "") + " : '" + table.rows[r].cells[c].innerHTML.toLowerCase().replace(" ", "").replace(".", "").replace(" ", "").replace(".", "") + "'";
                }
            }
            string = string + "}";
            var obj = JSON.stringify(eval('(' + string + ')'));
            var arr = $.parseJSON(obj);
            arr2.push(arr);
        }
        return arr2;
    }

    $("#tambahasset").click(function() {
        drawAsset()
        $("#modalasset").modal("show");
    })

    function CekValidasi() {
        if ($('#nama').val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'INFO',
                text: 'Isi Nama Role Terlebih dahulu!',
                buttons: {
                    formSubmit: {
                        text: "OK",
                        btnClass: "btn-red"
                    }
                }
            });
            $('#nama').focus();
            var result = false;
        } else {
            var result = true;
        }
        return result;
    };

    document.getElementById("save").addEventListener("click", function(event) {
        event.preventDefault();
        var datadetail = ambildatadetail();
        var nama = $('#nama').val();
        var result = false;
        if (CekValidasi() == true) {
            $.ajax({
                url: "<?php echo base_url('master_data/otorisasimenu/save'); ?>",
                method: "POST",
                dataType: "json",
                async: true,
                data: {
                    nama: nama,
                    detailmenu: datadetail
                },
                success: function(data) {
                    if (data.nomor != "") {
                        Swal.fire({
                            title: 'INFO...',
                            icon: 'success',
                            text: data.message,
                            confirmButtonColor: '#3085d6'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload(true);
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'INFO...',
                            icon: 'error',
                            text: data.message,
                            buttons: {
                                formSubmit: {
                                    text: 'OK',
                                    btnClass: 'btn-red'
                                }
                            }
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        title: 'INFO...',
                        icon: 'error',
                        text: 'Data Gagal Di Simpan',
                        buttons: {
                            formSubmit: {
                                text: 'OK',
                                btnClass: 'btn-red'
                            }
                        }
                    })
                }
            }, false);
        }
    });
</script>