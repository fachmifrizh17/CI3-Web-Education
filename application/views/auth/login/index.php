<div class="content__boxed w-100 min-vh-100 d-flex flex-column align-items-center justify-content-center">
	<div class="content__wrap">

		<!-- Login card -->
		<div class="card shadow-lg">
			<div class="card-body" style="min-width: 310px;">

				<div class="text-center">
					<h1 class="h3">Account Login</h1>
					<p>Sign In to your account</p>
				</div>

				<div id="form">

					<form class="mt-4" id="formlogin" autocomplete="off">

						<div class="mb-3">
							<input type="text" class="form-control" id="email" name="email" placeholder="Username" autofocus>
						</div>

						<div class="mb-3">
							<input type="password" class="form-control" id="password" name="password" placeholder="Password">
						</div>
						
						<div class="mb-3">
							<select id="level" name="level" class="form-select" style="display: none;">
                                    <option style="display : none" value="1">ADMIN</option>
                                    <option style="display : none" value="2">GURU</option>
                                </select>
						</div>

						<div class="d-grid mt-3 container-fluid">
							<button class="btn btn-danger btn-lg" type="submit">Log In</button>
						</div>
						
					</form>

				</div>

			</div>
		</div>
	</div>
</div>