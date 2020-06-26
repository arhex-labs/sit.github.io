<?php
	require 'core/server.php';
	if(!isset($_SESSION['userId'])){
		header("LOCATION: login.php");
	}
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
<body style="overflow-y: scroll;">
	<div class ="header">
		<table width="100%" style="text-align: center;" valign="middle">
			<tr width="100%" valign="middle">
				<td width="10%" valign="middle">
					<img src="images/umtLogo.png" class="logo" align="left">
				</td>
				<td width="30%" valign="middle">
					<form method="POST" action="search.php">
						<input type="text" name="searchbar" placeholder="&#xF002; Search by ID" style="font-family:Arial, FontAwesome" required>
						<input type="submit" name="search" value="&#xF002;" style="font-family:Arial, FontAwesome">	
					</form>
				</td>
				<td width="30%" valign="middle">

				</td>
				<td width="10%" valign="middle">
					<a href="profile.php" class="profileLink">
					<img src="<?php echo $_SESSION['userDp']; ?>" class="profile">
				</td>
				<td width="10%" valign="middle">
					<span class="profileName"><?php echo $_SESSION['userFname']." ".$_SESSION['userLname']; ?></span></a>
				</td>
				<td width="10%" valign="middle">
					<a href="logout.php" class="logout">Logout</a>
				</td>
			</tr>
		</table>
	</div>
	<div class="profile-container" style="width: 30%; min-height: 100px; left: 35%;">
		<form method="POST" action="">
			<input style="padding: 10px 16px; width: 25vw; background: #E8F0FE; border: 1px #CCD1DA solid; border-radius: 5px; margin-top: 10px;" type="text" name="phone" placeholder="Phone Number"><br/>
			<input style="padding: 10px 16px; width: 25vw; background: #356CB4; border: 1px #356CB4 solid; border-radius: 5px; margin-top: 10px; color: #fff; font-weight: 700;" type="submit" name="changePhone" value="Update Phone Number">
		</form>
		<a href="profile.php"><span style="position: absolute; top: -10px; right: -10px; border: 2px solid black; border-radius: 100%; background: #972329; color: #fff; padding: 2px;"> &times; </span></a>
	</div>
</body>
</html>