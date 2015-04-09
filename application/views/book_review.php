<!DOCTYPE HTML>
<html>
<head>
	<title>Add a book and review</title>
	<link rel="stylesheet" href="/assets/css/normalize.css">
	<link rel="stylesheet" href="/assets/css/skeleton.css">
	<style type="text/css">

		#header {
			text-align: right;
		}

		h3 {
			width: 600px;
			display: inline-block;
		}

		p {
			margin: 5px 5px;
		}

		select	{
			display: block;
		}

		input {
			display: block;
		}

	</style>
</head>
<body>
	<div class="container">
		<div class="row" id='header'>
			<a href="/">Home</a>
			<a href="/main/logout">Logout</a>
		</div>
		<div class="row">
			<div class="six columns">
				<h4><?= $reviews[0]['name'] ?></h4>
				<h5>Author: <?= $reviews[0]['author'] ?></h5>
				<h4>Reviews:</h4>
<?php
			foreach ($reviews as $review) {
?>
				<div class="row">
					<p>Rating: <?= $review['rating'] ?></p>
					<p class=''><a href="/main/users/<?= $review['id'] ?>"><?= $review['alias'] ?></a> says: <?= $review['review'] ?><p>
					<h6>Posted on <?= $review['created_at'] ?></h6>
				</div>
<?php
			}
?>
			</div>
			<div class="six columns">
				<h4>Add a review</h4>
				<form action='/main/new_review' method='post'>
					<textarea class='review' name='review'></textarea>
					<select name='rating'>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
					</select>
					<input type='submit' value='Submit Review' name='add_review'>
					<input type='hidden' value='<?= $reviews[0]["book_id"] ?>' name='book'>
					<input type='hidden' value='<?= $this->session->userdata('id') ?>' name='user'>
				</form>
			</div>
		</div>
	</div>
</body>
</html>