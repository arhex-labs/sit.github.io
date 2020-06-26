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
			<input type="text" name="fname" placeholder="First Name" value="<?php echo $fname; ?>"><br/>
			<input type="text" name="lname" placeholder="Last Name" value="<?php echo $lname; ?>"><br/>
			<input type="email" name="username" placeholder="Enter UMT ID" value="<?php echo $username; ?>"><br/>
			<input type="password" name="password1" placeholder="Password"><br/>
			<input type="password" name="password2" placeholder="Confirm Password"><br/>
			Gender: <input type="radio" name="gender" value="Male" checked> Male <input type="radio" name="gender" value="Female"> Female<br/>
			<input style="color: white;" type="submit" name="register" value="Sign up"><br/>
		</form>
		<?php if($error != ""){ ?><span class="error"><?php echo $error; ?></span><br/><br/><?php } ?>
		<a href="login.php"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Login</a><br/>
	</div>
</body>
</html>