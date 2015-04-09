<!DOCTYPE HTML>
<html>
<head>
	<title>Books Home</title>
	<link rel="stylesheet" href="/assets/css/normalize.css">
	<link rel="stylesheet" href="/assets/css/skeleton.css">
	<style type="text/css">

		h3 {
			width: 600px;
			display: inline-block;
		}

		.other a {
			display: block;
		}

		p {
			margin: 5px 5px;
		}

	</style>
</head>
<body>
	<div class="container">
		<div class="row" id='header'>
			<h3>Welcome, <?= $this->session->userdata('alias') ?></h3>
			<a href="/main/add">Add Book and Review</a>
			<a href="/main/logout">Logout</a>
		</div>
		<div class="row">
			<div class="six columns">
			<h4>Recent Book Reviews</h4>
<?php
			foreach ($review as $book) {
?>
				<div class="row">
					<a href="/main/show/<?= $book->book_id ?>"><?= $book->name ?></a>
					<p>Rating: <?= $book->rating ?></p>
					<p><a href="/main/users/<?= $book->id ?>"><?= $book->alias ?></a> says: <?= $book->review ?><p>
					<h6>Posted on <?= $book->created_at ?></h6>
				</div>
<?php
			}
?>
			</div>
			<div class="six columns">
				<h4>Other Books with Reviews</h4>
				<div class='other'>
					<a href="">Harry Potter: The Sorcerer's Stone</a>
					<a href="">The Life of Pi</a>
					<a href="">Another Book</a>
					<a href="">Another book</a>
					<a href="">another book</a>
					<a href="">another book</a>
					<a href="">another book</a>
					<a href="">another book</a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>