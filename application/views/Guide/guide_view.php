<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Guide</title>

	<!-- Imports Tailwind CSS by its Official CDN -->
	<script src="https://cdn.tailwindcss.com"></script>

	<!-- Alpine JS Javascript framework CDN -->
	<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

	<!-- Axios CDN -->
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body x-data="guide">
<section class="bg-gray-50 dark:bg-gray-900">
	<div class="flex flex-col items-center px-6 py-8 mx-auto md:h-screen lg:py-0">
		<div class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
			<img class="w-20 w-20 mr-2" src="https://png.pngtree.com/png-clipart/20230816/original/pngtree-radiation-symbol-of-activity-on-white-background-picture-image_7986533.png" alt="logo">
		</div>
		<div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
			<div class="p-6 space-y-4 md:space-y-6 sm:p-8">
				<div class="flex justify-center">
					<h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
						PDA Guides
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

				<div class="flex flex-col space-y-1">
					<label for="search" class="text-sm font-semibold text-gray-600 dark:text-gray-300">Search</label>
					<input
						x-model="searchText"
						type="text" name="search" id="search" class="block w-full p-3 text-sm dark:bg-gray-800 dark:text-gray-300 border border-gray-200 rounded focus:outline-none focus:border-blue-400" placeholder="Search for a guide...">
				</div>
				<button
					@click="search()"
					type="button" class="w-full p-3 mt-4 text-sm font-semibold text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Search</button>

				<div class="flex flex-col space-y-4">
					<template x-if="guideResults.length > 0">
						<template x-for="guide in guideResults">
							<div class="flex flex-col space-y-2" :key="guide.entry_id">
								<div class="flex items center justify-between">
									<h2 class="text-lg font-semibold text-gray-900 dark:text-white" x-text="guide.entry_name"></h2>
									<p class="text-sm font-semibold text-gray-600 dark:text-gray-300" x-text="guide.entry_category"></p>
									<p class="text-sm font-semibold text-gray-600 dark:text-gray-300" x-text="guide.entry_description"></p>
								</div>
							</div>
						</template>
					</template>
					<template x-if="guideResults.length <= 0">
						<p class="text-sm font-semibold text-gray-600 dark:text-gray-300">No results found.</p>
					</template>
				</div>
			</div>
		</div>
	</div>
</section>
</body>
</html>

<script>
	document.addEventListener('alpine:init', () => {
		Alpine.data('guide', () => ({
			open: false,
			searchText : '',

			guideResults: [],

			init() {
				console.log('Guide page loaded.');
			},

			search() {

				// send an AJAX request to the server to search for the guide
				axios.post('<?php echo base_url('Guide/GuideController/search') ?>', {
					search: this.searchText
				})
				.then(response => {
					console.log('success');
					console.log(response.data);
					//set this.guideResults as an array since the response in a json
					this.guideResults = response.data;
				})
				.catch(error => {
					console.log('error');
					console.log(error);
				})
			}

		}))
	})
</script>
