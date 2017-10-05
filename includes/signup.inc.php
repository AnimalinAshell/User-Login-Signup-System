<?php 

if (isset($_POST['submit'])) {

	include_once 'dbh.inc.php';

	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$first = mysqli_real_escape_string($conn, $_POST['first']);
	$last = mysqli_real_escape_string($conn, $_POST['last']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);

	//Error handlers
	// check for empty fields (NOTE! check errors before success)
	if(empty($first) || empty($last) || empty($username) || empty($password) || empty($email)){
		header("Location: ../signup.php?signup=empty");
		exit();
	} else {
		// check if inputs are valid
		if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last) ) {
			header("Location: ../signup.php?signup=invalid");
			exit();
		} 
		else {
			// check if email is valid
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				header("Location: ../signup.php?signup=invalidemail");
				exit();
			} else {
				// check if username already exists in db
				$sql = "SELECT * FROM users WHERE user_uid='$username'";
				$result = mysqli_query ($conn, $sql);
				$resultCheck = mysqli_num_rows($result);

				if ($resultCheck > 0) {
					header("Location: ../signup.php?signup=usertaken");
					exit();
				} else {
					// hashing password
					$hashedPass = password_hash($password, PASSWORD_DEFAULT);
					// insert the user into the db
					$sql = "INSERT INTO users (user_first, user_last, user_pwd, user_email, user_uid) VALUES ('$first', '$last', '$hashedPass', '$email', '$username');";
					mysqli_query($conn, $sql);
					header("Location: ../signup.php?signup=success");
					exit();
				}
			}
		}
	}

} 
else {
	header("Location: ../signup.php");
	exit(); // closes off script 
}

