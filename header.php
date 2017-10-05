<?php 
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Login System</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<header>
		<nav>
			<div class="container">
				<ul>
					<li><a href="index.php">Home</a></li>	
				</ul>
				<div class="nav-login">
					<?php 
						if (isset($_SESSION['u_id'])) {
							echo '<form action="includes/logout.inc.php" method="POST">
					 				<button type="submit" name="submit">Logout</button> 
					 		</form>';

						} else {
							echo '<form action="includes/login.inc.php" method="POST">
								<input type="text" name="username" placeholder="Username/email">
								<input type="password" name="password" placeholder="Password">
								<button name="submit" type="submit">Login</button>
									</form>
								<a href="signup.php">Sign up</a>';
						}
					 ?>
					 	
				</div>
			</div>
		</nav>
	</header>