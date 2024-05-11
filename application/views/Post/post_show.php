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
	id="zone_show"
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
							<button
								id="upvoteButton"
								class="p-2 bg-gray-200 rounded-full dark:bg-gray-700">
								<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
								</svg>
							</button>
							<span
								id="votes_text"
								class="text-gray-700 dark:text-gray-300">
							</span>
							<button
								id="downvoteButton"
								class="p-2 bg-gray-200 rounded-full dark:bg-gray-700">
								<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
								</svg>
							</button>
						</div>

						<!-- Delete post button that is only visible to the post owner -->
						<?php if($this->session->userdata('auth_user')['user_id'] == $post['user_id']): ?>
							<div class="mt-4 mr-3">
								<a href="<?php echo base_url('posts/delete/' . $post['post_id']) ?>" class="inline-block px-4 py-2 text-white bg-red-600 dark:bg-red-400 rounded hover:bg-red-700 dark:hover:bg-red-500 transition-colors duration-200"
								   onclick="return confirm('Are you sure you want to delete this post?')">
									Delete Post
								</a>
							</div>
						<?php endif; ?>

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

		<!-- Comments Section -->
		<div class="w-2/4 bg-white rounded-lg shadow dark:border md:mt-0 xl:p-0 dark:bg-gray-800 dark:border-gray-700">
			<div class="p-6 space-y-4 md:space-y-6 sm:p-8">
				<div class="flex justify-center">
					<h1 class="text-xl font-bold leading-tight tracking-tight text-[#ffbc00] md:text-2xl">
						Comments
					</h1>
				</div>
				<div class="flex justify-center">
					<textarea
						id="comment_content"
						name="comment_content" class="w-full p-2 mt-2 border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-700 dark:text-gray-300"
							  placeholder="Write a comment..."></textarea>
				</div>
				<button
					id="createComment"
					type="button" class="w-full p-2 mt-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
					Submit Comment
				</button>


				<div class="comments-container">
					<!-- This is where the comments will be displayed -->
				</div>
			</div>
		</div>
	</div>
</section>
</body>
</html>

<script>

	// Backbone.js Model for Post Show
	var Post = Backbone.Model.extend({
		defaults: {
			'post_id': '',
			'user_id': '',
			'votes': '',

			'comments': [],
			'comment_content': ''
		}
	});

	// Backbone.js View for Post Show
	var PostShowView = Backbone.View.extend({

		el: '#zone_show',

		model: new Post(),

		events: {
			'click #upvoteButton': 'upvote',
			'click #downvoteButton': 'downvote',

			'input #comment_content': 'updateCommentContent',
			'click #createComment': 'createComment',
			'click #deleteComment': 'deleteComment',
		},

		initialize: function() {
			console.log('Zone Show page loaded....');

			this.model.set('post_id', <?php echo $post['post_id'] ?>);
			this.model.set('user_id', <?php echo $post['user_id'] ?>);
			this.model.set('votes', <?php echo $post['votes'] ?>);

			// sets the number of votes to the text element
			var votesText = this.$el.find('#votes_text');
			votesText.text(this.model.get('votes'));

			this.getComments();
		},

		upvote: function() {
			axios.post('<?php echo base_url('Post/PostController/upvote') ?>', {
				post_id: this.model.get('post_id')
			},{
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				}
			})
			.then(response => {
				console.log('Post Upvoted.');

				this.model.set('votes', response.data.votes);

				var votesText = this.$el.find('#votes_text');
				votesText.text(this.model.get('votes'));
			})
			.catch(error => {
				console.log('Error Upvoting Post.');
				console.log(error);
			});
		},

		downvote: function() {
			axios.post('<?php echo base_url('Post/PostController/downvote') ?>', {
				post_id: this.model.get('post_id')
			},{
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				}
			})
			.then(response => {
				console.log('Post Downvoted.');

				this.model.set('votes', response.data.votes);

				var votesText = this.$el.find('#votes_text');
				votesText.text(this.model.get('votes'));
			})
			.catch(error => {
				console.log('Error Downvoting Post.');
				console.log(error);
			});
		},

		getComments: function() {
			axios.get('<?php echo base_url('comments/getComments/') ?>' + this.model.get('post_id'))
				.then(response => {
					console.log('Comments for post retrieved.');
					this.model.set('comments', response.data);

					this.renderComments();
				})
				.catch(error => {
					console.log('Error retrieving comments.');
					console.log(error);
				});
		},

		updateCommentContent: function(e) {
			this.model.set('comment_content', e.target.value);
		},

		createComment: function() {

			if(this.model.get('comment_content') === '') {
				alert('Please enter a comment for it to be submitted.');
				return;
			}

			axios.post('<?php echo base_url('Post/PostController/createComment') ?>', {
				post_id: this.model.get('post_id'),
				comment_content: this.model.get('comment_content')
			},{
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				}
			})
			.then(response => {

				var commentsContainer = this.$el.find('.comments-container');

				commentsContainer.append(`
						<div
							data-comment-block-id="${response.data.comment_id}"
							class="flex justify-between my-4">
							<div>
								<h2 class="text-lg font-bold leading-tight tracking-tight text-gray-900 dark:text-white">
									Comment by: <span class="text-blue-600">${response.data.user_nickname}</span>
									<br>
									<span class="text-sm">Faction:</span> <span class="text-sm text-red-400">${response.data.user_faction}</span>
								</h2>
								<p class="text-sm text-gray-600 dark:text-gray-300">
									${response.data.comment_content}
								</p>

								<!-- Delete comment button that is only visible to the comment owner -->
								${response.data.user_id == <?php echo $this->session->userdata('auth_user')['user_id']; ?> ? `
									<div
										class="mt-4 mr-3">
										<button
												id="deleteComment"
												data-comment-id="${response.data.comment_id}"
												class="inline-block px-4 py-2 text-white bg-red-600 dark:bg-red-400 rounded hover:bg-red-700 dark:hover:bg-red-500 transition-colors duration-200">
											Delete Comment
										</button>
									</div>
								` : ''}
							</div>
						</div>
					`);

				console.log('A new comment added.');
			})
			.catch(error => {
				console.log('Error creating comment.');
				console.log(error);
			});
		},

		deleteComment: function(e) {

			if(!confirm('Are you sure you want to delete this comment?')) {
				return;
			}

			// finds the comment id from the button's data attribute
			var comment_id = e.target.getAttribute('data-comment-id');

			axios.post('<?php echo base_url('Post/PostController/removeComment') ?>', {
				comment_id: comment_id
			},{
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				}
			})
			.then(response => {

				// Checks the serve response
				if(response.data === true) {

					// finds the comment in the comments container
					var commentsContainer = this.$el.find('.comments-container');

					// removes it from the DOM
					commentsContainer.find(`[data-comment-block-id="${comment_id}"]`).remove();

					console.log('Comment deleted.');
				}

			})
			.catch(error => {
				console.log('Error deleting comment.');
				console.log(error);
			});
		},

		renderComments: function() {

			var comments = this.model.get('comments');
			var commentsContainer = this.$el.find('.comments-container');

			if(comments.length > 0) {

				console.log('Rendering comments....');

				comments.forEach(function(comment) {

					commentsContainer.append(`
						<div
							data-comment-block-id="${comment.comment_id}"
							class="flex justify-between my-8">
							<div>
								<h2 class="text-lg font-bold leading-tight tracking-tight text-gray-900 dark:text-white">
									Comment by: <span class="text-blue-600">${comment.user_nickname}</span>
									<br>
									<span class="text-sm">Faction:</span> <span class="text-sm text-red-400">${comment.user_faction}</span>
								</h2>
								<p class="text-sm text-gray-600 dark:text-gray-300">
									${comment.comment_content}
								</p>

								<!-- Delete comment button that is only visible to the comment owner -->
								${comment.user_id == <?php echo $this->session->userdata('auth_user')['user_id']; ?> ? `
									<div
										class="mt-4 mr-3">
										<button
												id="deleteComment"
												data-comment-id="${comment.comment_id}"
												class="inline-block px-4 py-2 text-white bg-red-600 dark:bg-red-400 rounded hover:bg-red-700 dark:hover:bg-red-500 transition-colors duration-200">
											Delete Comment
										</button>
									</div>
								` : ''}
							</div>
						</div>
					`);

				});

			} else {
				console.log('No comments found for this post yet....');
			}

		},

	});

	// On page load, creates a new instance of the PostShowView
	window.onload = function() {
		new PostShowView();
	};

</script>
