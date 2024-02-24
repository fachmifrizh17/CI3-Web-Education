<!-- Floating label on select -->
<div class="form-floating mb-3">
    <select class="form-select" id="level" name="level" aria-label="Floating label select example">
        <option value="">Pilih Grup</option>
        <?php foreach ($role as $level) { ?>
            <option value="<?php echo $level->kode ?>"><?php echo $level->nama ?></option>
        <?php }; 
        ?>
    </select>
    <label for="kode kelas" class="text-dark">Grup</label>
</div>
<!-- END : Floating label on select -->

<div class="d-grid mt-3">
    <button type="button" class="btn btn-danger btn-large" id="submit">Submit</button>
</div>

<script type="text/javascript">
    swal.close()

    $("#kodedepartemen").prop("disabled", true)

    $("#kodecabang").change(function() {
        if ($("#kodecabang").val() == "") {
            $("#kodedepartemen").prop("disabled", true)
            $("#kodedepartemen").val("")
        } else if ($("#kodecabang").val() != "") {
            $("#kodedepartemen").prop("disabled", false)

            $.ajax({
                "url": "<?php echo base_url('auth/login/get_departemen'); ?>",
                "method": "POST",
                "dataType": "json",
                "data": {
                    "kode": $("#kodecabang").val()
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
                    $("#kodedepartemen option").remove()
                    $("#kodedepartemen").append($('<option>', {
                        "value": "",
                        "text": "Pilih Departemen"
                    }))
                    for (var i = 0; i < data.length; i++) {
                        $("#kodedepartemen").append($('<option>', {
                            "value": data[i].kode,
                            "text": data[i].nama
                        }))
                    }

                    swal.close()
                }
            }, false);
        }
    })

    $('#submit').click(function(event) {
        event.preventDefault()

        if ($('#level').val() == '') {
            swal.fire('Data Kosong', 'Mohon pilih Grup', 'info')
        } else {
            $.ajax({
                "url": "<?php echo base_url('auth/login/cek_cabang'); ?>",
                "method": 'POST',
                "dataType": 'json',
                "async": true,
                "data": {
                    email: email,
                    kodekelas: $('#kodecabang').val(),
                },
                "beforeSend": function() {
                    swal.fire({
                        title: 'Loading...',
                        didOpen: () => {
                            swal.showLoading()
                        }
                    })
                },
                "success": function(response) {
                    console.log(response)
                    if (response.success == true) {
                        window.open("<?= base_url() ?>main/", '_self')
                    } else {
                        swal.fire('Gagal!', response.message, 'info')
                    }
                }
            });
        }
    })
</script>