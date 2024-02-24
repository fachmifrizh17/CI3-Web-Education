<script type="text/javascript">
	$(document).ready(function() {

		function Clear() {
			$("#nama").val('');
			$("#username").val('');
			$("#password").val('');
			$("#kodecabang").val('');
		}

		const Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 3000,
			timerProgressBar: true,
			didOpen: (toast) => {
				toast.addEventListener('mouseenter', Swal.stopTimer)
				toast.addEventListener('mouseleave', Swal.resumeTimer)
			}
		})

		function ValidasiSave() {
			if ($('#username').val() == '') {
				Swal.fire(
					'Data Kosong',
					'Username tidak boleh kosong!',
					'warning'
				)
				var result = false;
			} else if ($('#nama').val() == '') {
				Swal.fire(
					'Data Kosong',
					'Nama tidak boleh kosong!',
					'warning'
				)
				var result = false;
			} else if ($('#password').val() == '') {
				Swal.fire(
					'Data Kosong',
					'Password tidak boleh kosong!',
					'warning'
				)
				var result = false;
			} else if ($('#kodecabang').val() == '') {
				Swal.fire(
					'Data Kosong',
					'Kode Cabang tidak boleh kosong!',
					'warning'
				)
				var result = false;
			} else {
				var result = true;
			}
			return result;
		};

		$('#username').change(function() {
			var username = $("#username").val();
			if (username != "") {
				$.ajax({
					type: "POST",
					url: "<?= base_url(); ?>auth/Register/Username_exists",
					data: {
						username: username
					},
					success: function(data) {
						Swal.fire(
							'Data Tersedia',
							'Username sudah dipakai, Coba Username yang lain!',
							'error'
						)
					}
				});
			}
		})

		document.getElementById("register").addEventListener("click", function(event) {
			event.preventDefault();

			var nama = $("#nama").val();
			var username = $("#username").val();
			var password = $("#password").val();
			var kodecabang = $("#kodecabang").val();

			if (ValidasiSave() == true) {
				$.ajax({
					url: "<?= base_url('auth/Register/Save'); ?>",
					method: "POST",
					dataType: "json",
					async: true,
					data: {
						nama: nama,
						username: username,
						password: password,
						kodecabang: kodecabang,
					},
					success: function(data) {
						Toast.fire({
							icon: 'success',
							title: 'Register Berhasil!'
						})
						window.open("<?= base_url() ?>main/login", "_self");
						Clear()
					}
				}, false);
			}
		});
	});
</script>
