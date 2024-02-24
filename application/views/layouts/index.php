<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("layouts/head"); ?>
</head>

<body class="jumping">

	<!-- PAGE CONTAINER -->
	<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
	<div id="root" class="root mn--max hd--expanded">

		<!-- CONTENTS -->
		<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
		<section id="content" class="content">
			<?php if ($this->session->userdata("myroleid") != '1') {
				$email = $this->session->userdata("myusername");
				$cek_siswa = $this->db->query("SELECT count(kode) as hasil FROM glbm_siswa where email='$email' and aktif='TRUE'")->row()->hasil;

				$cek_guru = $this->db->query("SELECT count(kode) as hasil FROM glbm_guru where email='$email' and aktif='TRUE'")->row()->hasil;

				if ($this->session->userdata("myroleid") == '3' and $cek_siswa != 1) { ?>
					<div class="modal fade show" id="modalubahpassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalubahpassword-label" style="display: block; padding-left: 0px;" aria-modal="true" role="dialog">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<form action="<?php echo base_url('main/ganti'); ?>" method="POST">

									<input name="level" type="hidden" value="<?= $this->session->userdata("myroleid") ?>">
									<input name="email" type="hidden" value="<?= $email ?>">
									<div class="modal-header">
										<h5 class="modal-title" id="modalubahpassword-label">Form Ubah Password</h5>
										<!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
									</div>
									<div class="modal-body">
										<div class="row g-3 mb-3">
											<label for="passwordbaru" class="col-sm-3 col-form-label">Password Baru</label>
											<div class="col-sm-9">
												<div class="input-group">
													<input id="passwordbaru" name="passwordbaru" type="password" class="form-control" required>
													<span class="input-group-text">
														<button type="button" class="btn btn-xs" id="passwordbarutoggle">
															<i class="ti-eye"></i>
														</button>
													</span>
												</div>
											</div>
										</div>
										<div class="row g-3">
											<label for="konfirmasi" class="col-sm-3 col-form-label">Konfirmasi</label>
											<div class="col-sm-9">
												<div class="input-group">
													<input id="konfirmasi" name="konfirmasi" type="password" class="form-control" required>
													<span class="input-group-text">
														<button type="button" class="btn btn-xs" id="konfirmasitoggle">
															<i class="ti-eye"></i>
														</button>
													</span>
												</div>

											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-danger">Simpan</button>
									</div>
								</form>
							</div>
						</div>
					</div>


				<?php } ?>

				<?php if ($this->session->userdata("myroleid") == '2' and $cek_guru != 1) { ?>

					<div class="modal fade show" id="modalubahpassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalubahpassword-label" style="display: block; padding-left: 0px;" aria-modal="true" role="dialog">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<form action="<?php echo base_url('main/ganti'); ?>" method="POST">

									<input name="level" type="hidden" value="<?= $this->session->userdata("myroleid") ?>">
									<input name="email" type="hidden" value="<?= $email ?>">
									<div class="modal-header">
										<h5 class="modal-title" id="modalubahpassword-label">Form Ubah Password</h5>
										<!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
									</div>
									<div class="modal-body">
										<div class="row g-3 mb-3">
											<label for="passwordbaru" class="col-sm-3 col-form-label">Password Baru</label>
											<div class="col-sm-9">
												<div class="input-group">
													<input id="passwordbaru" name="passwordbaru" type="password" class="form-control" required>
													<span class="input-group-text">
														<button type="button" class="btn btn-xs" id="passwordbarutoggle">
															<i class="ti-eye"></i>
														</button>
													</span>
												</div>
											</div>
										</div>
										<div class="row g-3">
											<label for="konfirmasi" class="col-sm-3 col-form-label">Konfirmasi</label>
											<div class="col-sm-9">
												<div class="input-group">
													<input id="konfirmasi" name="konfirmasi" type="password" class="form-control" required>
													<span class="input-group-text">
														<button type="button" class="btn btn-xs" id="konfirmasitoggle">
															<i class="ti-eye"></i>
														</button>
													</span>
												</div>

											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-danger">Simpan</button>
									</div>
								</form>
							</div>
						</div>
					</div>

				<?php } ?>



			<?php } ?>
			<?php $this->load->view($content); ?>

			<!-- MODALS -->
			<div class="modal fade" id="modalubahpassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalubahpassword-label" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">

						<form id="formubahpassword">
							<div class="modal-header">
								<h5 class="modal-title" id="modalubahpassword-label">Form Ubah Password</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>

							<div class="modal-body">
								<div class="row g-3 mb-3">
									<label for="passwordlama" class="col-sm-3 col-form-label">Password Lama</label>
									<div class="col-sm-9">
										<div class="input-group">
											<input id="passwordlama" name="passwordlama" type="password" class="form-control">
											<span class="input-group-text">
												<button type="button" class="btn btn-xs" id="passwordlamatoggle"><i class="ti-eye"></i></button>
											</span>
										</div>
										<div id="checkingpasswordlama" class="valid-feedback">
											Checking ...
										</div>
										<div id="validpasswordlama" class="valid-feedback">
											Password lama benar.
										</div>
										<div id="invalidpasswordlama" class="invalid-feedback">
											Password lama salah.
										</div>
									</div>
								</div>

								<div class="row g-3 mb-3">
									<label for="passwordbaru" class="col-sm-3 col-form-label">Password Baru</label>
									<div class="col-sm-9">
										<div class="input-group">
											<input id="passwordbaru" name="passwordbaru" type="password" class="form-control">
											<span class="input-group-text">
												<button type="button" class="btn btn-xs" id="passwordbarutoggle"><i class="ti-eye"></i></button>
											</span>
										</div>
									</div>
								</div>

								<div class="row g-3">
									<label for="konfirmasi" class="col-sm-3 col-form-label">Konfirmasi</label>
									<div class="col-sm-9">
										<div class="input-group">
											<input id="konfirmasi" name="konfirmasi" type="password" class="form-control">
											<span class="input-group-text">
												<button type="button" class="btn btn-xs" id="konfirmasitoggle"><i class="ti-eye"></i></button>
											</span>
										</div>
										<div id="validkonfirmasi" class="valid-feedback">
											Konfirmasi dan password baru cocok.
										</div>
										<div id="invalidkonfirmasi" class="invalid-feedback">
											Konfirmasi dan password baru tidak cocok.
										</div>
									</div>
								</div>
							</div>

							<div class="modal-footer">
								<button type="submit" class="btn btn-danger">Simpan</button>
							</div>
						</form>

					</div>
				</div>
			</div>


			<?php $email = $this->session->userdata("myusername");
			$foto = $this->db->query("SELECT s.*from glbm_login s WHERE s.email='$email'")->row(); ?>
			<div class="modal fade" id="modalubahfoto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalubahfoto-label" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<form id="formubahfoto">
							<div class="modal-header">
								<h5 class="modal-title" id="modalubahfoto-label">Ubah Foto</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<div class="row g-3">
									<input name="email" type="hidden" value="<?= $email ?>">
									<input type="hidden" name="uploaded" id="uploaded" value="">
									<div class="row mb-2">
										<div class="col-sm-12 input-group box">
											<input type="hidden" name="gambar_lama" id="gambar_lama" value="">
											<div class="custom-file">
												<input type="file" accept="image/*" class="custom-file-input" style="border-radius: 3px;" name="image" id="image">
												<label class="custom-file-label" style="border-radius: 3px;" for="gambar" id="gambarlabel"></label>
											</div>
											<div class="w-100 text-center mt-4" id="imageContainer" style="border: 1px solid rgba(0, 0, 0, .2); border-radius: 10px; display: flex; justify-content: center; align-items: center;">
												<img id="gambarpreview" src="<?php echo base_url(); ?>assets/img/foto/<?= $foto->image ?>" style="max-height: 500px;">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-danger">Simpan</button>
							</div>
						</form>

					</div>
				</div>
			</div>

			<!-- FOOTER -->
			<footer class="content__boxed mt-auto">
				<div class="content__wrap py-3 py-md-1 d-flex flex-column flex-md-row align-items-md-center">
					<!-- <div class="text-nowrap mb-4 mb-md-0">Copyright &copy; 2023 <a href="#" class="ms-1 btn-link fw-bold">PT. Four Best Synergy</a></div> -->
					<nav class="nav flex-column gap-1 flex-md-row gap-md-3 ms-md-auto" style="row-gap: 0 !important;">
						<!-- <a class="nav-link px-0" href="#">Policy Privacy</a> -->
						<!-- <a class="nav-link px-0" href="#">Terms and conditions</a> -->
						<!-- <a class="nav-link px-0" href="#">Contact Us</a> -->
					</nav>
				</div>
			</footer>
			<!-- END - FOOTER -->

		</section>

		<!-- NAVBAR -->
		<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
		<?php $this->load->view("layouts/navbar"); ?>
		<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
		<!-- END - NAVBAR -->

		<!-- SIDEBAR -->
		<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
		<?php $this->load->view("layouts/sidebar"); ?>
		<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
		<!-- END - SIDEBAR -->

	</div>
	<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
	<!-- END - PAGE CONTAINER -->

	<!-- SCROLL TO TOP BUTTON -->
	<div class="scroll-container">
		<a href="#root" class="scroll-page rounded-circle ratio ratio-1x1" aria-label="Scroll button"></a>
	</div>
	<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
	<!-- END - SCROLL TO TOP BUTTON -->

	<?php $this->load->view("layouts/footer"); ?>

</body>

</html>