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
	<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<div class="profile-container">
		<table width="100%">
			<tr width="100%">
				<td width="30%" rowspan="5">
					<img width= "100%" style="border: 2px #CCD1DA solid;" src="<?php echo $_SESSION['userDp']; ?>">
				</td>
				<td width="20%" valign="top">
						<span class="heading">Name: </span>
				</td>
				<td width="30%" valign="top">
						<span class="info"><?php echo $_SESSION['userFname']." ".$_SESSION['userLname']; ?></span>
				</td>
				<td width="20%" valign="top">
						<button type="submit" name="editName"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
				</td>
			</tr>
			<tr width="100%">
				<td width="20%" valign="top">
						<span class="heading">Phone: </span>
				</td>
				<td width="30%" valign="top">
						<span class="info"><?php echo $_SESSION['userPhone']; ?></span>
				</td>
				<td width="20%" valign="top">
						<button type="submit" name="editPhone"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
				</td>
			</tr>
			<tr width="100%">
				<td width="20%" valign="top">
						<span class="heading">Date of Birth: </span>
				</td>
				<td width="30%" valign="top">
						<span class="info"><?php echo $_SESSION['userDob']; ?></span>
				</td>
				<td width="20%" valign="top">
						<button type="submit" name="editDob"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
				</td>
			</tr>
			<tr width="100%">
				<td width="20%" valign="top">
						<span class="heading">Gender: </span>
				</td>
				<td width="30%" valign="top">
						<span class="info"><?php echo $_SESSION['userGender']; ?></span>
				</td>
				<td width="20%" valign="top">
						<button type="submit" name="editGender"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
				</td>
			</tr>
			<tr width="100%">
				<td width="20%" valign="top">
						<span class="heading">Password</span>
				</td>
				<td width="30%" valign="top">
						<span class="info">******** </span>
				</td>
				<td width="20%" valign="top">
						<button type="submit" name="editPassword"><i class="fa fa-pencil" aria-hidden="true"></i> Change Password</button>
				</td>
			</tr>
			<tr width="100%">
				<td style="text-align: center;">
					<button style="float: none;" type="submit" name="editPicture"><i class="fa fa-pencil" aria-hidden="true"></i> Change Profile Picture</button>
				</td>
			</tr>
			<tr width="100%">
				<td colspan="4" style="text-align: center;">
					<a href="index.php"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Home</a><br/>
				</td>
			</tr>
		</table>
	</div>
	</form>
</body>
</html>