<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Zone Posts</title>

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
					<a href="<?php echo base_url('posts') ?>" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
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

<body x-data="zone_show"
	  class="bg-gray-50 dark:bg-gray-900">
<section>
	<div class="flex flex-col items-center px-6 py-8 mx-auto md:h-screen lg:py-0">
		<div class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white pt-24">
			<img class="w-20 w-20 mr-2" src="https://png.pngtree.com/png-clipart/20230816/original/pngtree-radiation-symbol-of-activity-on-white-background-picture-image_7986533.png" alt="logo">
		</div>
		<div class="w-2/4 bg-white rounded-lg shadow dark:border md:mt-0 xl:p-0 dark:bg-gray-800 dark:border-gray-700">
			<div class="p-6 space-y-4 md:space-y-6 sm:p-8">
				<div class="flex justify-between items-center">
					<div>
						<h2 class="text-lg font-bold leading-tight tracking-tight text-gray-900 dark:text-white">
							S.T.A.L.K.E.R Nickname : <span class="text-blue-600"><?php echo $post['user_nickname'] ?></span>
						</h2>
						<p class="text-sm text-gray-600 dark:text-gray-300">
							Faction: <span class="text-red-400"><?php echo $post['user_faction'] ?></span>
						</p>
					</div>
					<div>
						<div class="flex items-center space-x-2">
							<button class="p-2 bg-gray-200 rounded-full dark:bg-gray-700"
									@click="upvote()">
								<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
								</svg>
							</button>
							<span x-text="votes"
								  class="text-gray-700 dark:text-gray-300">
							</span>
							<button class="p-2 bg-gray-200 rounded-full dark:bg-gray-700"
									@click="downvote()">
								<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
								</svg>
							</button>
						</div>
					</div>
				</div>
				<div class="flex justify-center">
					<h1 class="text-xl font-bold leading-tight tracking-tight text-[#ffbc00] md:text-2xl">
						<?php echo $post['post_title'] ?>
					</h1>
				</div>
				<div class="flex justify-center">
					<p class="text-gray-700 dark:text-gray-300">
						<?php echo $post['post_content'] ?>
					</p>
				</div>
			</div>
		</div>
	</div>
</section>
</body>
</html>

<script>
	document.addEventListener('alpine:init', () => {
		Alpine.data('zone_show', () => ({

			post_id: <?php echo $post['post_id'] ?>,
			user_id: <?php echo $post['user_id'] ?>,
			votes: <?php echo $post['votes'] ?>,

			// triggered when the page is loaded
			init() {
				console.log('Zone show page loaded.');
			},

			// REST API call to upvote a post
			upvote() {
				axios.post('<?php echo base_url('Post/PostController/upvote') ?>', {
					post_id: this.post_id
				},{
					headers: {
						'Content-Type': 'application/x-www-form-urlencoded'
					}
				})
				.then(response => {
					console.log('Post Upvoted.')

					// Update the votes count from the API's response
					this.votes = response.data.votes;
				})
				.catch(error => {
					console.log('Error Upvoting Post.');
					console.log(error);
				});
			},

			// REST API call to downvote a post
			downvote() {
				axios.post('<?php echo base_url('Post/PostController/downvote') ?>', {
					post_id: this.post_id
				},{
					headers: {
						'Content-Type': 'application/x-www-form-urlencoded'
					}
				})
				.then(response => {
					console.log('Post Downvoted.')

					// Update the votes count from the API's response
					this.votes = response.data.votes;
				})
				.catch(error => {
					console.log('Error Downvoting Post.');
					console.log(error);
				});
			},

		}))
	})
</script>
