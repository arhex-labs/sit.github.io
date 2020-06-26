<?php
	require 'core/server.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>UMT - Stay in Touch</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="icon" href="images/umtLogo.png" type="image/icon type">
</head>
<body>
	<div class ="login-container">
		<img class = "logo" src="images/umtLogo.png">
		<br/>
		<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<input type="email" name="username" placeholder="Username" value="<?php echo $username; ?>"><br/>
			<input type="password" name="password" placeholder="Password"><br/>
			<input type="checkbox" name="rememberme" /> Remember Username<br/>
			<input style="color: white;" type="submit" name="login" value="Log in"><br/>
		</form>
		<?php if($error != ""){ ?><span class="error"><?php echo $error; ?></span><br/><br/><?php } ?>
		<a href="forgot.php"><i class="fa fa-lock" aria-hidden="true"></i> Forgot Username or Password?</a><br/><br/>
		<a href="signup.php"><i class="fa fa-sign-in" aria-hidden="true"></i> New There? Sign up now.</a></br>
	</div>
</body>
</html>