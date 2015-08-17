<?php 

	session_start();

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
	// Retrieving data from database to be populated into dropdown so that user
	// can choose a previous diary entry by the 'title' of entry
	
	
	
	

	// 
	// Updating diary entry
	//
	
	
	if ($_POST['submit']){

		if (!$_POST['title']) $error .= "Hey you forgot the title</br>";

		if (!$_POST['date']) $error .= "Ooops it seems you forgot to enter a date<br>";

		if (!$_POST['entry']) $error .= "Woopsie you haven't entered anything about your day yet<br>";

		if ($error) $error = "<div class='alert alert-danger col-md-8 col-md-offset-2'>".$error."</div>";

			else{

				$query = "INSERT INTO diary (email_for_diary, title, the_date, entry)
						  VALUES ('".$_SESSION['email']."', '".$_POST['title']."', '".$_POST['date']."', '".$_POST['entry']."')";

				if(mysqli_query($conn, $query)) $successResult = "<div class='alert alert-success col-md-8 col-md-offset-2'>Success your diary has been updated</div>";
					else $failResult = "<div class='alert alert-danger'>There was an error trying to update your diary</div>";
			}

		

	} // end $_POST['submit']

	
	
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

    <style>

		



    </style>
 </head>
 <body>
	
	<div class="wrapper">


		<!-- navbar -->


		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a href="home.php" class="navbar-brand">Just Another Diary</a>
				</div>
				<div>
					<ul class="nav navbar-nav">
						<li><a href="home.php">Home</a></li>
						<li class="active"><a href="#">New Entry</a></li>
						<li><a href="find_entry.php">Find an Entry</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
					</ul>
				</div>
			</div>
		</nav>



		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
			 		<h1 class="center">New Entry Page</h1>
			 		<p class="lead center">-- Please tell me how your day went --</p>
			 	</div>
	 		
			
			<!-- php code echoes the result after user fills in the form -->

	 		<?php echo $successResult ?>
			
			<?php echo $failResult ?>

			<?php echo $error ?>

	
	 			
			 	<form action="" method="post" role="form">

					<div class="row form-group">
						<div class="col-md-6 form-group col-md-offset-2">
							<input type="text" name="title" class="form-control" placeholder="Give me a title">
						</div>
					

					
						<div class="col-md-2 form-group">
							<input type="date" name="date" class="form-control" placeholder="Please select a date">
						</div>
					</div>
					
					<div class="row">
						
						<div class="col-md-8 form-group col-md-offset-2">

							<textarea type="text" name="entry" class="form-control" rows="16" cols="3" placeholder="Describe how your day went here for me!"></textarea>

						</div>

					</div>

					<div class="row">

						<div class="col-md-3 col-md-offset-2">

							<input class="btn btn-success" id="update-diary-button" type="submit" name="submit" value="Update Diary">

						</div>
						
					</div>

				</form>
				
			</div>

			
		
		</div> <!-- end container -->
		<div class="push-new-entry"></div>
		

		<!-- footer -->

		<footer>
			<div class="container-fluid no-padding">
				
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

