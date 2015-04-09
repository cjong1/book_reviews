<!DOCTYPE HTML>
<html>
<head>
	<title>Welcome</title>
	<link rel="stylesheet" href="/assets/css/normalize.css">
	<link rel="stylesheet" href="/assets/css/skeleton.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<h3>Welcome</h3>
		</div>
		<div class="row">
			<div class="six columns">
				<form action='/main/register' method='post'>
<?php
	if($this->session->flashdata('error'))
	{
		echo "<p>". $this->session->flashdata('error'). "</p>";
	}
?>	
					<h4>Register</h4>
					<label>Name</label>
						<input type='text' name='name'>
					<label>Alias</label>
						<input type='text' name='alias'>
					<label>Email</label>
						<input type='email' name='email'>
					<label>Password</label>
						<input type='password' name='password'>
						<p>* Password must be at least 8 characters</p>
					<label>Confirm PW</label>
						<input type='password' name='confirm'>
						<input type='submit' value='Register' name='register'>
				</form>
			</div>
			<div class="six columns">
				<form action='/main/login' method='post'>
<?php
	if($this->session->flashdata('login_error'))
	{
		echo "<p>". $this->session->flashdata('login_error'). "</p>";
	}
?>
					<h4>Login</h4>
					<label>Email</label>
						<input type='text' name='login_email'>
					<label>Password</label>
						<input type='password' name='login_password'>
						<input type='submit' value='Login' name='login'>
				</form>
			</div>
		</div>
	</div>
</body>
</html>