<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Register</title>

		<!-- Imports Tailwind CSS by its Official CDN -->
		<script src="https://cdn.tailwindcss.com"></script>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-12 mt-4">
					<div class="card">
						<div class="card_header">
							Register User
						</div>
						<div class="card_body">

							<?php
								if($this->session->flashdata('success')) {
									echo '<p class="alert alert-success">'.$this->session->flashdata('success').'</p>';
								}

								if($this->session->flashdata('error')) {
									echo '<p class="alert alert-error">'.$this->session->flashdata('error').'</p>';
								}
							?>

							<form action="<?php echo base_url('Auth/AccountController/signup') ?>" method="post">
								<div class="form-group">
									<label for="">Nickname</label>
									<input type="text" name="nickname" class="form-control">
									<small class="text-danger"><?php echo form_error('nickname'); ?></small>
								</div>

								<div class="form-group">
									<label for="">Faction</label>
									<input type="text" name="faction" class="form-control">
									<small class="text-danger"><?php echo form_error('faction'); ?></small>
								</div>

								<div class="form-group">
									<label for="">Password</label>
									<input type="password" name="password" class="form-control">
									<small class="text-danger"><?php echo form_error('password'); ?></small>
								</div>

								<div class="form-group">
									<label for="">Confirm Password</label>
									<input type="password" name="confirmPass" class="form-control">
									<small class="text-danger"><?php echo form_error('confirmPass'); ?></small>
								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-primary">Register</button>
								</div>
							</form>

							<div>
								<a href="<?php echo base_url('login') ?>">
									Already Registered?
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
