<?php include_once("header.php") ?>
	<!-- Content -->
	<section class="main-container">
		<div class="container">
			<h2>Home</h2>
			<?php 
				if (isset($_SESSION['u_id'])) {
					echo "You are logged in!";
				}
			 ?>
		</div>
	</section>

<?php include_once("footer.php") ?>
