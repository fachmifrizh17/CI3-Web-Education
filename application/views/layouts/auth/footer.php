<!-- jQuery JS -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery-3.6.1/jquery.min.js"></script>

<!-- Themify [ SAMPLE ] -->
<script src="<?php echo base_url(); ?>assets/pages/themify-icons.min.js"></script>

<!-- Bootstrap JS [ OPTIONAL ] -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

<!-- Nifty JS [ OPTIONAL ] -->
<script src="<?php echo base_url(); ?>assets/js/nifty.min.js"></script>

<!--DataTables [ OPTIONAL ]-->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/datatables-1.12.1/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/datatables-1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/responsive-2.3.0/js/responsive.bootstrap5.min.js"></script>

<!-- Date Time Picker [ OPTIONAL ] -->
<script src="<?php echo base_url(); ?>assets/pages/date-time-picker.min.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/datepicker/js/mc-calendar.min.js"></script> -->

<!-- Moment JS [ OPTIONAL ] -->
<script src="<?php echo base_url(); ?>assets/plugins/momentjs/moment-with-locales.min.js"></script>

<!-- Sweet Alert 2 -->
<script src="<?php echo base_url(); ?>assets/plugins/sweetalert2-11.4.32/sweetalert2.min.js"></script>

<!-- Jquery Confirm-->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/jqueryconfirm/jquery-confirm.min.js"></script>

<!-- PLUGIN PROCUREMENT -->
<!-- JQUERY SCRIPTS -->
<!-- <script src="<?php echo base_url('assets/jquery/jquery.min.js') ?>"></script> -->

<!-- FULL CALENDAR SCRIPTS -->
<!-- <script src="<?php echo base_url('assets/fullcalender/js/jquery-ui.min.js') ?>"></script> -->
<!-- <script src="<?php echo base_url('assets/fullcalender/js/moment.min.js') ?>"></script> -->
<!-- <script src="<?php echo base_url('assets/fullcalender/js/fullcalendar.min.js') ?>"></script> -->
<!-- <script src="<?php echo base_url('assets/daypilot/daypilot-all.min.js') ?>"></script> -->

<!-- DATEPICKER SCRIPTS -->
<!-- <script src="<?php echo base_url('assets/datepicker/js/bootstrap-datepicker.min.js') ?>"></script> -->
<!-- <script src="<?php echo base_url('assets/datepicker/js/bootstrap-datepicker.js') ?>"></script> -->

<!-- <script src="<?php echo base_url('assets/datepicker/js/bootstrap-datetimepicker.min.js') ?>"></script> -->
<!-- <script src="<?php echo base_url('assets/datepicker/js/bootstrap-datetimepicker.js') ?>"></script> -->
<!-- END PROCUREMENT -->

<!-- Logout Script -->
<script type="text/javascript">
    function logout() {
        swal.fire({
            text: "Anda yakin akan keluar?",
            title: "Logout",
            type: "info",
            showCancelButton: true,
            cancelButtonText: "Batal"
        }).then((confirmed) => {
            if (confirmed.value == true) {
                swal.fire({
                    title: 'Loading...',
                    didOpen: () => {
                        Swal.showLoading();
                    }
                })
                window.location.href = "<?php echo base_url("auth/logout") ?>";
            }
        });
    }

    function ubahpassword() {
        $("#modalubahpassword").modal("show");
        $("#checkingpasswordlama").hide();
        $("#validpasswordlama").hide();
        $("#invalidpasswordlama").hide();
        $("#validkonfirmasi").hide();
        $("#invalidkonfirmasi").hide();
    }

    $("#passwordlama").change(function() {
        if ($("#passwordlama").val() == "") {
            $("#checkingpasswordlama").hide();
            $("#validpasswordlama").hide();
            $("#invalidpasswordlama").hide();
        } else {
            $.ajax({
                "type": "POST",
                "url": "<?php echo base_url('master_data/user/cek_password_lama'); ?>",
                "data": {
                    "passwordlama": $("#passwordlama").val()
                },
                "async": true,
                "beforeSend": function() {
                    $("#checkingpasswordlama").show();
                    $("#validpasswordlama").hide();
                    $("#invalidpasswordlama").hide();
                },
                "success": function(response) {
                    let data = JSON.parse(response);
                    if (data.success == true) {
                        $("#validpasswordlama").show();
                        $("#checkingpasswordlama").hide();
                        $("#invalidpasswordlama").hide();
                    } else {
                        $("#invalidpasswordlama").show();
                        $("#checkingpasswordlama").hide();
                        $("#validpasswordlama").hide();
                    }
                },
                "error": function(e) {
                    swal.fire("Gagal!", "Terjadi kesalahan", "error");
                }
            });
        }
    });

    $("#konfirmasi").keyup(function() {
        if ($("#konfirmasi").val() == "") {
            $("#validkonfirmasi").hide();
            $("#invalidkonfirmasi").hide();
        } else {
            if ($("#konfirmasi").val() != $("#passwordbaru").val()) {
                $("#invalidkonfirmasi").show();
                $("#validkonfirmasi").hide();
            } else {
                $("#validkonfirmasi").show();
                $("#invalidkonfirmasi").hide();
            }
        }
    });

    $("#passwordlamatoggle").click(function() {
        if ($("#passwordlama").prop("type") == "password") {
            $("#passwordlama").prop("type", "text");
        } else {
            $("#passwordlama").prop("type", "password");
        }
    });

    $("#passwordbarutoggle").click(function() {
        if ($("#passwordbaru").prop("type") == "password") {
            $("#passwordbaru").prop("type", "text");
        } else {
            $("#passwordbaru").prop("type", "password");
        }
    });

    $("#konfirmasitoggle").click(function() {
        if ($("#konfirmasi").prop("type") == "password") {
            $("#konfirmasi").prop("type", "text");
        } else {
            $("#konfirmasi").prop("type", "password");
        }
    });

    $("#formubahpassword").on("submit", function(event) {
        event.preventDefault();

        if ($("#passwordlama").val() == "") {
            swal.fire("Gagal!", "Mohon input Password Lama terlebih dahulu", "info")
        } else if ($("#passwordbaru").val() == "") {
            swal.fire("Gagal!", "Mohon input Password Baru terlebih dahulu", "info")
        } else if ($("#konfirmasi").val() == "") {
            swal.fire("Gagal!", "Mohon pilih Cabang terlebih dahulu", "info")
        } else if ($("#konfirmasi").val() != $("#passwordbaru").val()) {
            swal.fire("Gagal!", "Konfirmasi dan Password Baru tidak cocok.", "info")
        } else {
            let form = $("#formubahpassword")[0];
            let data = new FormData(form);

            $.ajax({
                "type": "POST",
                "url": "<?php echo base_url('master_data/user/ubah_password'); ?>",
                "data": data,
                "processData": false,
                "contentType": false,
                "async": true,
                "beforeSend": function() {
                    swal.fire({
                        title: 'Loading...',
                        didOpen: () => {
                            swal.showLoading();
                        }
                    })
                },
                "success": function(response) {
                    let data = JSON.parse(response);
                    if (data.success == true) {
                        $("#modalubahpassword").modal("hide");
                        $("#formubahpassword")[0].reset();
                        swal.fire("Berhasil", data.msg, "success");
                    } else {
                        swal.fire("Gagal!", data.msg, "error");
                    }
                },
                "error": function(e) {
                    swal.fire("Gagal!", "Terjadi kesalahan", "error");
                }
            });
        }
    });
</script>

<!-- Notofication Script -->
<script type="text/javascript">
    let mynrp = '<?php echo $this->session->userdata("mynrp"); ?>';

    $("#notification").attr("hidden", true);

    function notification() {
        $.ajax({
            "type": "POST",
            "url": "<?php echo base_url('notification/index'); ?>",
            "data": mynrp,
            "processData": false,
            "contentType": false,
            "async": true,
            "success": function(response) {
                let data = JSON.parse(response);
                if (data.totalnotif > 0) {
                    $("#notification").attr("hidden", false);
                    $("#notification").text(data.totalnotif);
                    new Audio('<?php echo base_url(); ?>' + 'assets/audio/mixkit-bell-notification-933.wav').play();
                } else {
                    $("#notification").attr("hidden", true);
                    $("#notification").text(data.approvemanager);
                }

                if (data.approvemanager > 0) {
                    $("#notifapproveprmng").attr("hidden", false);
                    $("#notifapproveprmngbdg").text(data.approvemanager);
                    $("#notifapprovetxt").text(data.approvemanager + " PR menunggu approval.");
                } else {
                    $("#notifapproveprmng").attr("hidden", true);
                    $("#notifapproveprmngbdg").text(data.approvemanager);
                }

                if (data.approvefunctional > 0) {
                    $("#notifapproveprfunc").attr("hidden", false);
                    $("#notifapproveprfuncbdg").text(data.approvefunctional);
                    $("#notifapprovetxt").text(data.approvefunctional + " PR menunggu approval.");
                } else {
                    $("#notifapproveprfunc").attr("hidden", true);
                    $("#notifapproveprfuncbdg").text(data.approvefunctional);
                }
            },
            "error": function(error) {
            }
        });
    }

    notification();

    setInterval(function() {
        notification();
    }, 5000);
</script>

<!-- Custom Script JS -->
<?php !empty($script) ? $this->load->view($script) : null; ?>