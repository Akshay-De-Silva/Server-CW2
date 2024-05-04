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

<body x-data="guide"
	  class="bg-gray-50 dark:bg-gray-900">
<section>
	<div class="flex flex-col items-center px-6 py-8 mx-auto md:h-screen lg:py-0">
		<div class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white pt-24">
			<img class="w-20 w-20 mr-2" src="https://png.pngtree.com/png-clipart/20230816/original/pngtree-radiation-symbol-of-activity-on-white-background-picture-image_7986533.png" alt="logo">
		</div>
		<div class="w-3/4 bg-white rounded-lg shadow dark:border md:mt-0 xl:p-0 dark:bg-gray-800 dark:border-gray-700">
			<div class="p-6 space-y-4 md:space-y-6 sm:p-8">
				<div class="flex justify-center">
					<h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
						PDA Guides
					</h1>
				</div>

				<div class="flex flex-col space-y-1">
					<input
						x-model="searchText"
						type="text" name="search" id="search" class="block w-full p-3 text-sm dark:bg-gray-800 dark:text-gray-300 border border-gray-200 rounded focus:outline-none focus:border-blue-400" placeholder="Search for a guide...">
				</div>
				<button
					@click="await $nextTick(); search()"
					type="button" class="w-full p-3 mt-4 text-sm font-semibold text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
					Search for Guide(s)
				</button>

				<button
					@click="await $nextTick(); showAll()"
					type="button" class="w-full p-3 mt-4 text-sm font-semibold text-white bg-green-500 rounded-md hover:bg-green-600 focus:outline-none focus:bg-green-600">
					Display all Guides
				</button>

				<template x-if="guideResults.length > 0">

					<button
						@click="await $nextTick(); guideResults = []"
						type="button" class="w-full p-3 mt-4 text-sm font-semibold text-white bg-red-400 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600">
						Clear Result(s)
					</button>
				</template>

				<div class="flex justify-center mt-4">
					<p class="text-sm font-semibold text-gray-600 dark:text-gray-300">Results found: <span x-text="guideResults.length"></span></p>
				</div>

				<div class="flex flex-col space-y-4">
					<template x-if="guideResults.length > 0">

						<div class="dark:bg-gray-800">
							<div class="mx-auto max-w-7xl px-6 lg:px-8">
								<div class="mx-auto max-w-2xl lg:max-w-4xl">
									<div class="mt-16 space-y-20 lg:mt-20 lg:space-y-20">

										<template x-for="guide in guideResults" :key="guide.entry_id">

											<article class="relative isolate flex flex-col gap-8 lg:flex-row">
												<div class="relative aspect-[16/9] sm:aspect-[2/1] lg:aspect-square lg:w-64 lg:shrink-0">
													<img
														:src="guide.entry_image_path"
														alt="" class="absolute inset-0 h-full w-full rounded-2xl bg-gray-50 object-cover">
													<div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
												</div>
												<div>
													<div class="group relative max-w-xl">
														<h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
															<div class="text-[#ffbc00]">
																<span class="absolute inset-0"></span>
																<div x-text="guide.entry_name"></div>
															</div>
														</h3>
														<p class="mt-5 text-sm leading-6 text-white" x-text="guide.entry_description"></p>
													</div>
													<div class="mt-6 flex border-t border-gray-900/5 pt-6">
														<div class="relative flex items-center gap-x-4">
															<div class="text-sm leading-6">
																<p class="font-semibold text-gray-900">
																	<div class="text-white">
																		<span class="absolute inset-0"></span>
																		Category: <p x-text="guide.entry_category"></p>
																	</div>
																</p>
															</div>
														</div>
													</div>
												</div>
											</article>
										</template>
										<template x-if="guideResults.length <= 0">
											<p class="text-sm font-semibold text-gray-600 dark:text-gray-300">No results found.</p>
										</template>

									</div>
								</div>
							</div>
						</div>

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
				axios.post('<?php echo base_url('Guide/GuideController/search') ?>', {
					search: this.searchText
				},{
					headers: {
						'Content-Type': 'application/x-www-form-urlencoded'
					}
				})
				.then(response => {
					console.log('success from controller request');

					if(response.data === false) {
						this.guideResults = [];
						return;
					}

					this.guideResults = response.data;
				})
				.catch(error => {
					console.log('error');
					console.log(error);
				})
			},

			showAll() {
				this.searchText = '';
				this.search();
			},

		}))
	})
</script>
