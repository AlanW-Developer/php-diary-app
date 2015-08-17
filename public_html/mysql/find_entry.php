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
	// Selecting a previous diary entry from a Drop down which can be echoed onto the screen 
	//

	if ($_POST['find_entry']){

		if ($_POST['month']){

			//set date variable used to search for all diary entries in that given year and month
			$date_for_query = "2015-".$_POST['month']."-%";

		} else $findEntryError .= "An error has occured whilst trying to select the list";

		if (!$findEntryError){

			//make arrays to store data
			$title = $entry = $date = $assoc = array(); 


			//query to search db
			$query = "SELECT * FROM diary
					  WHERE email_for_diary LIKE '".$_SESSION['email']."'
					  AND the_date LIKE '{$date_for_query}'";

			//search db against sql query
			$result = mysqli_query($conn, $query);


			//pulling data from db and inserting into arrays
			while($row = mysqli_fetch_assoc($result)){

				$title[] = $row['title'];
				$date[] = $row['the_date'];
				$entry[] = $row['entry'];

			}

			
		} else $pick_month .= "<p class='alert alert-danger'>Please pick a month</p>";
		
	} // end $_POST['find_entry']
	
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
		
		<nav class="navbar navbar-inverse">
			<div class="container-fluid ">
				<div class="navbar-header">
					<a href="home.php" class="navbar-brand">Just Another Diary</a>
				</div>
				<div>
					<ul class="nav navbar-nav">
						<li><a href="home.php">Home</a></li>
						<li><a href="new_entry.php">New Entry</a></li>
						<li class="active"><a href="#">Find an Entry</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Log Out</a></li>
					</ul>
				</div>
			</div>
		</nav>



		<div class="container">

			<div class="row">
				<div class="col-md-8 col-md-offset-2">
			 		<h1 class="center text-align-center">Find an Entry</h1>
			 		<p class="lead text-align-center">-- Select a Month from the Dropdown Menu --</p>
			 		<?php echo $pick_month ?>
			 	</div>
	 		
				<form action="" method="post" role="form">
					
					<div class="col-md-8 col-md-offset-2 form-group">

						<select class="form-control" name="month" id="">
						
							<option value="" default>Pick a Month</option>
							<option value="01">January</option>
							<option value="02">February</option>
							<option value="03">March</option>
							<option value="04">April</option>
							<option value="05">May</option>
							<option value="06">June</option>
							<option value="07">July</option>
							<option value="08">August</option>
							<option value="09">September</option>
							<option value="10">October</option>
							<option value="11">November</option>
							<option value="12">December</option>

						<!--
							<option value="">Pick a page from your diary</option>

							<?php for($x=0; $x<$arrlength; $x++){
							echo "<option value='".$title[$x]."'>".$title[$x]."<br></option>";} ?>
						-->
						</select>

					</div>

					<div class="col-md-3 col-md-offset-5 form-group">

						<input class="btn btn-primary" type="submit" value="View Entries" name="find_entry" id="view-entries">

					</div>
					
				</form>
				<div class="row"></div>
				<hr>
				<div class="col-md-8 col-md-offset-2"> <!-- div required to keep data ordered and not find empty space in other unfilled columns -->
				<?php 

					echo "<h2 class='text-align-center'>Diary Entries</h2>
						  <p class='lead text-align-center'>-- should be shown below --</p>";

					echo "<table class='table'>";

					for($x=0; $x < count($entry); $x++){

						echo "
								<tr>
								  		<th class='active'>".$title[$x]."</th>

										<th class='text-align-left active'>".$date[$x]."</th>

								</tr>

								<tr>	
										<td colspan='2'>".$entry[$x]."</td>

								</tr>";

					}

					echo "</table>" 
				?>
				</div>
				

			</div> <!-- end row-->

		</div> <!-- end container -->
		<div class="push-find-entry"></div>

		<!-- Footer Area -->
		<footer>
			<div class="container-fluid no-padding">
				
					<div class="nav navbar-inverse navbar-bottom">

						<p class="navbar-text pull-left">Site built by Alan</p>
						<p class="navbar-text pull-right">&copy alansprojectcorner</p>

					</div> <!-- end footer area -->
				
			</div><!-- end container -->
		</footer>

	</div> <!-- end wrapper -->
	

 </body>
 </html>