<!DOCTYPE HTML>
<html>
<head>
	<title>User Reviews</title>
	<link rel="stylesheet" href="/assets/css/normalize.css">
	<link rel="stylesheet" href="/assets/css/skeleton.css">
	<style type="text/css">

		#header {
			text-align: right;
		}

		#user a {
			margin-left: 50px;
			display: block;
		}

	</style>
</head>
<body>
	<div class="container">
		<div class="row" id='header'>
			<a href="">Home</a>
			<a href="">Add Book and review</a>
			<a href="/main/logout">Logout</a>
		</div>
		<div class="row">
			<div class="six columns" id='user'>
				<h5>User Alias: <?= $user['alias'] ?></h5>
				<h6>Name: <?= $user['name'] ?></h6>
				<h6>Email: <?= $user['email'] ?></h6>
				<h6>Total Reviews: <?= $user['review']->count ?></h6>
			<h5>Posted Reviews on the following books:</h5>
<?php 				
					foreach ($review as $review) {
?>
					<a href="/main/show/<?= $review->id ?>"><?= $review->name ?></a>
<?php
					}
?>
			</div>
		</div>
	</div>
</body>
</html>