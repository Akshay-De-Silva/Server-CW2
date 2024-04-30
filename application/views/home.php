<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Landing Page</title>

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
						<div class="flex justify-end">
							<a href="<?php echo base_url('logout') ?>" class="text-red-500 hover:text-red-700">Logout</a>
						</div>

						<div class="flex justify-center">
							<h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
								S.T.A.L.K.E.R. PDA
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

						<section class="text-center">
							<h2 class="text-2xl text-[#ffbc00] font-bold">Welcome, <?php echo $this->session->userdata('auth_user')['nickname']; ?></h2>
							<p class="text-lg text-[#ffbc00]">Faction: <?php echo $this->session->userdata('auth_user')['faction']; ?></p>
						</section>
					</div>
					<div class="p-6 space-y-4 md:space-y-6 sm:p-8">
						<div class="flex justify-around">
							<button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
								Profile
							</button>
							<button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
								Zone Updates
							</button>
							<button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
								Guide
							</button>
						</div>
					</div>
				</div>
			</div>
		</section>
	</body>
</html>
