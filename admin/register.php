<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Registration</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/register.css">
</head>

<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-02.jpg" alt="IMG">
				</div>

				<form class="login100-form validate-form" method="POST" action="../saveuser.php">
				<div class="text-center p-t-12">
						Admin Registration
					</div>

					<span class="login100-form-title">
						University of Hawli
					</span>

					<div class="wrap-input100 validate-input" data-validate="Username is required">
						<input class="input100" type="text" name="user" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Sign Up
						</button>
					</div>

					<div class="text-center p-t-12">
						<?php if (isset($_SESSION['alert_message'])) {
							echo '<p style="color: #57b846;">' . $_SESSION['alert_message'] . '</p>';
							unset($_SESSION['alert_message']);
						}
						?>
					</div>

					<div class="text-center p-t-136">
						<p style="font-size:14px;">Already have an account?
						<a class="txt10" href="login.php">
							Login
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
							</p>
						</a>

					</div>
				</form>

			</div>
		</div>
	</div>

	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script>
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<script src="js/main.js"></script>

</body>

</html>