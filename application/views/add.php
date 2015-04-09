<!DOCTYPE HTML>
<html>
<head>
	<title>Add book and review</title>
	<link rel="stylesheet" href="/assets/css/normalize.css">
	<link rel="stylesheet" href="/assets/css/skeleton.css">
	<style type="text/css">
		#header {
			text-align: right;
		}

		select {
			display: block;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row" id='header'>
			<a href="">Home</a>
			<a href="">Logout</a>
		</div>
		<div class="row">
			<div class="six columns">
				<form action='/main/new_book' method='post'>
					<h4>Add a new book title and a review</h4>
					<label>Book Title</label>
					<input type='text' name='title'>
					<label>Author</label>
						<select name='author_list'>
<?php
						foreach ($author as $author) {
?>
							<option><?= $author->author?></option>
<?php
						}
?>
						</select>
						<label>Or add a new author</label>
						<input type='text' name='new_author'>
					<label>Review</label>
						<textarea class='review' name='review'></textarea>
					<label>Rating</label>
						<select name='rating'>
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
						</select>
					<input type='submit' value='Add book and Review' name='add'>
					<input type='hidden' value='<?= $this->session->userdata('id') ?>' name='user'>
				</form>
			</div>
		</div>
	</div>
</body>
</html>