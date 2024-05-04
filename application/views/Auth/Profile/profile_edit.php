<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Profile</title>

	<!-- Imports Tailwind CSS by its Official CDN -->
	<script src="https://cdn.tailwindcss.com"></script>
</head>

<nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
	<div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
		<div class="flex items-center space-x-3 rtl:space-x-reverse">
			<img src="https://png.pngtree.com/png-clipart/20230816/original/pngtree-radiation-symbol-of-activity-on-white-background-picture-image_7986533.png" class="h-8" alt="Logo">
			<span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">PDA NETWORK</span>
		</div>
		<div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
			<ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
				<li class="p-5">
					<a href="<?php echo base_url('home') ?>" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
						Home
					</a>
				</li>
				<li class="p-5">
					<a href="<?php echo base_url('profile') ?>" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
						Profile
					</a>
				</li>
				<li class="p-5">
					<a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
						Zone Updates
					</a>
				</li>
				<li class="p-5">
					<a href="<?php echo base_url('guide') ?>" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
						Guide
					</a>
				</li>
			</ul>
		</div>
	</div>
</nav>

<!-- background image -->
<style>
	section {
		background-image: url('http://localhost/cw2/images/bg.jpg');
		background-size: cover;
		background-position: center;
	}
</style>

<body>
<section class="bg-gray-50 dark:bg-gray-900">
	<div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:min-h-screen lg:py-0">
		<div class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
			<img class="w-20 w-20 mr-2" src="https://png.pngtree.com/png-clipart/20230816/original/pngtree-radiation-symbol-of-activity-on-white-background-picture-image_7986533.png" alt="logo">
		</div>
		<div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
			<div class="p-6 space-y-4 md:space-y-6 sm:p-8">
				<div class="flex justify-center">
					<h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
						Edit S.T.A.L.K.E.R. Profile
					</h1>
				</div>

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

				<?php if($userDetails && $userDetails != false): ?>

					<form class="space-y-6 md:space-y-6"
						  action="<?php echo base_url('Auth/ProfileController/update') ?>" method="post">
						<div>
							<label for="nickname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nickname</label>
							<input type="text"
								   value="<?php echo $userDetails->nickname; ?>"
								   name="nickname" id="nickname" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
							>
							<small class="text-red-400"><?php echo form_error('nickname'); ?></small>
						</div>
						<div>
							<label for="faction" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Faction</label>
							<input type="text"
								   value="<?php echo $userDetails->faction; ?>"
								   name="faction" id="faction" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
							>
							<small class="text-red-400"><?php echo form_error('faction'); ?></small>
						</div>
						<div>
							<label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
							<input type="password"
								   name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
							<small class="text-red-400"><?php echo form_error('password'); ?></small>
						</div>
						<div>
							<label for="confirmPass" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm New Password</label>
							<input type="password"
								   name="confirmPass" id="confirmPass" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
							<small class="text-red-400"><?php echo form_error('confirmPass'); ?></small>
						</div>
						<div>
							<label for="stalkers_killed" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stalkers Killed</label>
							<input type="text"
								   value="<?php echo $userDetails->stalkers_killed; ?>"
								   name="stalkers_killed" id="stalkers_killed" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
							<small class="text-red-400"><?php echo form_error('stalkers_killed'); ?></small>
						</div>
						<div>
							<label for="mutants_killed" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mutants Killed</label>
							<input type="text"
								   value="<?php echo $userDetails->mutants_killed; ?>"
								   name="mutants_killed" id="mutants_killed" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
							<small class="text-red-400"><?php echo form_error('mutants_killed'); ?></small>
						</div>
						<div>
							<label for="zones_visited" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Zones Visited</label>
							<input type="text"
								   value="<?php echo $userDetails->zones_visited; ?>"
								   name="zones_visited" id="zones_visited" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
							<small class="text-red-400"><?php echo form_error('zones_visited'); ?></small>
						</div>

						<button type="submit"
								class="w-full text-white bg-blue-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
							Update
						</button>
					</form>

				<?php else: ?>
					<div class="flex justify-center">
						<p class="text-lg text-[#ffbc00]">No Profile Found to Edit</p>
					</div>
				<?php endif; ?>

			</div>
		</div>
	</div>
</section>
</body>
</html>
