<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Welcome to Login</title>

		<!-- Imports Tailwind CSS by its Official CDN -->
		<script src="https://cdn.tailwindcss.com"></script>
	</head>
	<body>
		<section class="bg-gray-50 dark:bg-gray-900">
			<div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
				<div class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
					<img class="w-20 w-20 mr-2" src="https://png.pngtree.com/png-clipart/20230816/original/pngtree-radiation-symbol-of-activity-on-white-background-picture-image_7986533.png" alt="logo">
				</div>
				<div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
					<div class="p-6 space-y-4 md:space-y-6 sm:p-8">
						<div class="flex justify-center">
							<h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
								S.T.A.L.K.E.R. PDA Network Login
							</h1>
						</div>
<<<<<<< HEAD

						<?php if($this->session->flashdata('success')): ?>
							<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
								<p class="font-bold">Success</p>
								<p><?php echo $this->session->flashdata('success'); ?></p>
							</div>
						<?php endif; ?>

						<?php if($this->session->flashdata('error')): ?>
							<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
								<p class="font-bold">Error</p>
								<p><?php echo $this->session->flashdata('error'); ?></p>
							</div>
						<?php endif; ?>

=======

						<?php
							if($this->session->flashdata('success')) {
								echo '<p class="alert alert-success">'.$this->session->flashdata('success').'</p>';
							}

							if($this->session->flashdata('error')) {
								echo '<p class="alert alert-error">'.$this->session->flashdata('error').'</p>';
							}
						?>
>>>>>>> 99814d07e412676f00e36881bb81013a6a3c02cb
						<form class="space-y-4 md:space-y-6"
							action="<?php echo base_url('Auth/AccountController/login') ?>" method="post">
							<div>
								<label for="nickname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nickname</label>
								<input type="text" name="nickname" id="nickname" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
									   required="">
								<small class="text-danger"><?php echo form_error('nickname'); ?></small>
							</div>
							<div>
								<label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
								<input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
								<small class="text-danger"><?php echo form_error('password'); ?></small>
							</div>
							<button type="submit" class="w-full text-white bg-blue-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
								Login
							</button>
							<p class="text-sm font-light text-gray-500 dark:text-gray-400">
								Don’t have an account yet?
								<a href="<?php echo base_url('register') ?>" class="font-medium text-primary-600 hover:underline dark:text-primary-500">
									Register
								</a>
							</p>
						</form>
					</div>
				</div>
			</div>
		</section>
	</body>
</html>
