<script type="text/javascript">
	let email = ""

	$('#formlogin').submit(function(event) {
		event.preventDefault()

		if ($('#email').val() == '') {
			swal.fire('Username Kosong', 'Mohon isi kolom email', 'info')
		} else {
			$.ajax({
				"url": "<?php echo base_url('auth/login/cek_login'); ?>",
				"method": 'POST',
				"dataType": 'json',
				"async": true,
				"data": {
					email: $('#email').val(),
					password: $('#password').val(),
					level: $('#level').val(),
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
					if (response.success == true) {
						if (response.redirect == true) {
							window.open("<?= base_url() ?>main/", '_self')
						} else {
							email = $('#email').val()
							$('#form').load('../auth/login/view_cabang')
						}
					} else {
						swal.fire('Gagal!', response.message, 'info')
					}
				}
			});
		}
	})
</script>