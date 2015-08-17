
<?php


	// 
	// Set session variables
	//

	session_start();

	$_SESSION['email'] = $_POST['email'];
	$_SESSION['password'] = $_POST['password'];
	print_r($_SESSION);
	


	// 
	// Main Sign Up Form
	//

	if ($_POST['submit']){

		// 
		// Validating email and password
		//
		
		

		if (!$_POST['email']) $error.="</br>Please enter your email";

 			else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $error.="</br>Please enter a valid email address";

 		if (!$_POST['password']) $error.="</br>Please enter your password";
 			
 			else {

 				if (strlen($_POST['password'])<8) $error.="</br>Please enter a password with at least 8 characters";
 				if (!preg_match('`[A-Z]`', $_POST['password'])) $error.="</br>Please include at least one capital letter";
 			}

 		if ($error) echo $error;

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

				echo "Sorry that email is already registered. Please try another email.";

				$user = mysqli_fetch_array($result);

				print_r($row);
				
			} else {

				// 
				// Inserting new email into db
				//

				$query = "INSERT INTO users (email, password) 
						  VALUES('".mysqli_real_escape_string($conn, $_POST['email'])."', '".
						  mysqli_real_escape_string($conn, $_POST['password'])."')";

				$register_user = mysqli_query($conn, $query);

				echo "Email registered successfully";
				

			}

		}

 	}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<title>Secret Diary</title>

</head>

<body>
	


	<form action="" method="post">

	<input type="email" name="email" id="email">

	<input type="password" name="password" id="password">

	<input type="submit" name="submit" value="Sign Up">
</form>
</body>
</html>
