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

	<!-- Axios CDN. Used for AJAX Requests -->
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

	<!-- Underscore CDN -->
	<!-- According to the Backbone.js documentation, this library is a dependency. -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.13.6/underscore-min.js" integrity="sha512-2V49R8ndaagCOnwmj8QnbT1Gz/rie17UouD9Re5WxbzRVUGoftCu5IuqqtAM9+UC3fwfHCSJR1hkzNQh/2wdtg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<!-- jQuery CDN -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<!-- Backbone.js CDN -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.6.0/backbone-min.js" integrity="sha512-ei5TeAaO5TpzrvI9Y0NP+/gr6cfcF9wmCnuXEXuwLfTsyspAlBjwGSSVkQbZsA8wDC5fEKufEHgMmJ/HPNWlAw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

<body
	id="zone_posts"
	  class="bg-gray-50 dark:bg-gray-900">
<section>
	<div class="flex flex-col items-center px-6 py-8 mx-auto md:h-screen lg:py-0">
		<div class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white pt-24">
			<img class="w-20 w-20 mr-2" src="https://png.pngtree.com/png-clipart/20230816/original/pngtree-radiation-symbol-of-activity-on-white-background-picture-image_7986533.png" alt="logo">
		</div>
		<div class="w-2/4 bg-white rounded-lg shadow dark:border md:mt-0 xl:p-0 dark:bg-gray-800 dark:border-gray-700">
			<div class="p-6 space-y-4 md:space-y-6 sm:p-8">
				<div class="flex justify-center">
					<h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
						Zone Updates
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

				<div class="flex justify-center mt-4">
					<a href="<?php echo base_url('posts/create') ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
						Create a New Post
					</a>
				</div>

				<div class="posts-container">
					<!-- Posts will be displayed here -->
				</div>
			</div>
		</div>
	</div>
</section>
</body>
</html>

<script>

	// Backbone.js Model
	var Post = Backbone.Model.extend({
		defaults: {
			'allPosts': [],
		}
	});

	// Backbone.js View
	var PostIndexView = Backbone.View.extend({
		el: '#zone_posts',

		model: new Post(),

		initialize: function() {
			console.log('Zone Updates page loaded....')

			this.listenTo(this.model, 'change:allPosts', this.render);

			this.getAllPosts();
		},

		getAllPosts: function() {
			axios.post('<?php echo base_url('Post/PostController/getAllPosts') ?>')
				.then(response => {
					console.log('Success from PostController Request getAllPosts function.');

					if(response.data === false) {
						this.model.set('allPosts', []);
						return;
					}

					this.model.set('allPosts', response.data);
				})
				.catch(error => {
					console.log('An error occurred while fetching all posts.');
					console.log(error);
				})
		},

		render: function() {

			this.getAllPosts();

			var allPosts = this.model.get('allPosts');
			var postsContainer = this.$el.find('.posts-container');

			if(allPosts.length === 0) {

				console.log('No posts found about the Zone yet....');

				postsContainer.append('<p class="text-sm font-semibold text-gray-600 dark:text-gray-300">No posts found about the Zone yet....</p>');
				return;
			}

			console.log('Rendering posts....');

			allPosts.forEach(function(post) {
				postsContainer.append(`
					<a href="<?php echo base_url('posts/view/') ?>` + post.post_id + `">
						<div class="bg-gray-700 shadow overflow-hidden sm:rounded-lg my-4 p-4">
							<div>
								<div class="flex items-start space-x-4">
									<div class="flex-1">
										<div class="text-sm text-white">
											<p class="text-white text-sm">S.T.A.L.K.E.R: <span class="text-blue-400">` + post.user_nickname + `</span></p>
										</div>
										<h3 class="mt-2 text-lg leading-6 font-medium text-gray-900">
											<p class="text-[#ffbc00] text-3xl font-bold hover:text-white">` + post.post_title + `</p>
										</h3>
									</div>
								</div>
								<div class="mt-4 flex items-center">
									<div class="flex text-sm">
										<p class="text-red-600"> Faction: <span class="text-white text-sm">` + post.user_faction + `</span></p>
									</div>
								</div>
							</div>
						</div>
					</a>
				`);
			});
		},

	});

	// Initializes the view
	window.onload = function() {
		new PostIndexView();
	};

</script>
