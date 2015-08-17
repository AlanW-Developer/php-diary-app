
<?php

	// 
	// Set session variables
	//

	session_start();

	$_SESSION['email'] = $_POST['email'];
	$_SESSION['password'] = $_POST['password'];

	


	// 
	// Main Sign Up Form
	//

	if ($_POST['submit']){

		// 
		// Validating email and password
		//
		
		

		if (!$_POST['email']) $error.="Please enter your email address</br>";

 			else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $error.="Please enter a valid email address</br>";

 		if (!$_POST['password']) $error.="Please choose a password</br>";
 			
 			else {

 				if (strlen($_POST['password'])<8) $error.="Your password needs a minimum of at least 8 characters</br>";
 				if (!preg_match('`[A-Z]`', $_POST['password'])) $error.="Please include at least One capital letter</br>";
 			}

 		if ($error) $result = "<div class='alert alert-danger col-md-4 col-md-offset-4' id='result'>{$error}</div>";

 			// 
 			// Connecting to db
 			//
 			
 			
 			else{

 				$servername = "localhost";
 				$username = "cl56-sec-diary";
 				$password = "hRBsW^-tD";

 				//create connection
 				$conn = mysqli_connect($servername, $username, $password, $username);

 				//checking connection
 				if (!$conn) die("Connection Failed: ".mysqli_connect_error());
					else echo ""; //can print connection successful to test connection
			}

		if ($conn){


			// 
			// Checking to see if email exists in db
			//
			
			
			$query = "SELECT email FROM users WHERE email LIKE '" .mysqli_real_escape_string($conn, $_POST['email'])."'";
			 		  

			$result = mysqli_query($conn, $query);

			if (mysqli_num_rows($result) > 0){

				$result = "<div class='alert alert-danger col-md-4 col-md-offset-4 text-align-center' id='result'>That email is already in use. Please register using another email</div>";
				
			} else {

				// 
				// Inserting new email into db
				//

				$query = "INSERT INTO users (email, password) 
						  VALUES('".mysqli_real_escape_string($conn, $_POST['email'])."', '".
						  mysqli_real_escape_string($conn, $_POST['password'])."')";

				$register_user = mysqli_query($conn, $query);

				$result = "<div class='alert alert-success col-md-4 col-md-offset-4 text-align-center' id='result'>Your account has been successfully created</div>";
				
			}

		}

 	}

 ?>
<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Diary</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

    <style>
		
		


    </style>
 </head>

<body>
<div class="wrapper">
	<!-- navbar -->

	
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="login.php" class="navbar-brand">Just Another Diary</a>
			</div>
			<div>
				
				<ul class="nav navbar-nav navbar-right">
					<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Log In</a></li>
				</ul>
			</div>
		</div>
	</nav>
	
	<!-- Main Section -->

	<div class="container">

		<div class="row">

			<div class="col-md-12 main-home" id="title">

				<h1 class="text-align-center">Sign Up Page</h1>

			</div>

		</div>

	</div>

	<div class="container">

		<div class="row">

			<form action="" method="post">
				
				<div class="form-group col-md-4 col-md-offset-4">

					<input type="email" name="email" class="form-control" id="email">

				</div>

				<div class="form-group col-md-4 col-md-offset-4">

					<input type="password" name="password" class="form-control" id="password">

				</div>

				<div class="form-group col-md-2 col-md-offset-5">

					<input type="submit" name="submit" class="form-control btn btn-primary" value="Sign Up">
				
				</div>

			</form>

			<div class="clearfix"></div>

			<?php echo $result ?>

		</div> <!-- end row -->

	</div> <!-- end container -->

	<!-- end Main -->

	<!-- footer -->

	<footer>

		<div class="container-fluid footer">
			
				<div class="nav navbar-inverse navbar-bottom">

					<p class="navbar-text pull-left">Site built by Alan</p>

					<p class="navbar-text pull-right">&copy alansprojectcorner</p>

				</div> <!-- end footer area -->
			
		</div><!-- end container -->

	</footer>
	<!-- end footer -->
</div> <!-- end wrapper -->
</body>
</html>
