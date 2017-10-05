<?php // no need for closing tags when whole page is php

session_start();

if (isset($_POST['submit'])) {

	 include 'dbh.inc.php';

	 $username = $_POST['username'];
	 $password = $_POST['password'];

	 // Error handlers
	 // check if inputs are empty
	 if (empty($username) || empty($password)) {
	 	header("Location: ../index.php?login=empty");
	 		exit();
	 }
	 else {
	 	// checking to see if user exits in db
	 	$sql = "SELECT * FROM users WHERE user_uid='$username' OR user_email='$username'";
	 	$result = mysqli_query($conn, $sql);
	 	$resultCheck = mysqli_num_rows($result);

	 	if ($resultCheck < 1) {
	 		header("Location: ../index.php?login=error");
	 		exit();
	 	} 
	 	else {
	 		if ($row = mysqli_fetch_assoc($result)) {
	 			// de-hashing password
	 			$hashedPwdCheck = password_verify($password, $row['user_pwd']);
	 			if ($hashedPwdCheck == false) {
	 				header("Location: ../index.php?login=error");
	 				exit();
	 			}
	 			elseif ($hashedPwdCheck == true) {
	 				// login the user HERE
	 				$_SESSION['u_id'] = $row['user_id'];
	 				$_SESSION['u_first'] = $row['user_first'];
	 				$_SESSION['u_last'] = $row['user_last'];
	 				$_SESSION['u_email'] = $row['user_email'];
	 				$_SESSION['u_uid'] = $row['user_uid'];
	 				header("Location: ../index.php?login=success");
	 				exit();
	 			}
	 		}
	 	}
	 }
}
else {
	 	header("Location: ../index.php?login=error");
	 	exit();
	 }

