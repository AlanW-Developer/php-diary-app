<?php
	
	session_start();

	$_SESSION['email'] = $_POST['email'];
	$_SESSION['password'] = $_POST['password'];


	if ($_POST['submit']){

		//
		// Connecting to a database
		//

		$servername = "localhost";
		$username = "cl56-sec-diary";
		$password = "hRBsW^-tD";

		$conn = mysqli_connect($servername, $username, $password, $username);

		//checking connection
		if (!$conn) die("Connection Failed: ".mysqli_connect_error());
			else echo ""; //can print connection successful to test connection

		//
		// Checking email exists in the database
		//

		$query = "SELECT email FROM users WHERE email LIKE '" .
				  mysqli_real_escape_string($conn, $_POST['email'])."'";

		$result = mysqli_query($conn, $query);

		if (mysqli_num_rows($result)>0) $email = 1;
			elseif (!$_POST['email']) echo "Please enter an email address";
			else echo "<br>Sorry it looks like that email doesn't exist with us.<br>";
						

		// 
		// Validating Password against db
		//
		
		$query = "SELECT password FROM users WHERE password LIKE '".
				  mysqli_real_escape_string($conn, $_POST['password'])."'";

		$result = mysqli_query($conn, $query);

		if (mysqli_num_rows($result)>0) $password = 1;
			else echo "<br>Ooops the password you entered was incorrect please try again.";
		
		if ($email AND $password){

			header('Location: home.php');
			die();
		} 

		



		//checking database for email address if email address exists we cannot use it

			
 	}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Diary</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

</head>

<body>

	<!-- navbar -->
	
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="login.php" class="navbar-brand">Just Another Diary</a>
			</div>
			<div>
				
				<ul class="nav navbar-nav navbar-right">
					<li><a href="sign_up.php"><span class="glyphicon glyphicon-user"></span>Sign Up</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- end navbar -->

	<div class="container">

		<div class="row">

			<div class="col-md-12 main-home" id="title">

				<h1 class="text-align-center">Welcome to Another Diary</h1>
				<p class="lead text-align-center">-- Please log in below --</p>

			</div>

		</div>

	</div>

	<!-- Login Form -->

	<form action="" method="post">
	
		<div class="form-group col-md-4 col-md-offset-4">

			<input class="form-control" type="email" name="email" id="email">

		</div>

		<div class="form-group col-md-4 col-md-offset-4">

			<input class="form-control" type="password" name="password" id="password">

		</div>

		<div class="clearfix"></div>

		<div class="form-group col-md-1 col-md-offset-5">

			<input class="form-control btn btn-primary" id="log-in-button" type="submit" name="submit" value="Log In">

		</div>

	</form>

	<!-- end login form -->

	<!-- Footer Area -->
	<footer>
		<div class="container-fluid footer">
			
				<div class="nav navbar-inverse navbar-bottom">

					<p class="navbar-text pull-left">Site built by Alan</p>

					<p class="navbar-text pull-right">&copy alansprojectcorner</p>

				</div> <!-- end footer area -->
			
		</div><!-- end container -->
	</footer>

</body>
</html>
