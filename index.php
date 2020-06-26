<?php
	require 'core/server.php';
	if(!isset($_SESSION['userId'])){
		header("LOCATION: login.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>UMT - SIT (<?php echo $_SESSION['userFname']." ".$_SESSION['userLname']; ?>)</title>
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
	<div class="set-post-container">
		<h1>Create Post</h1><hr/>
		<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
			<input type="text" name="postDesc" placeholder="What's on your mind, <?php echo $_SESSION['userFname']; ?>?"><br/>
			<input type="file" name="image"><br/>
			<input type="submit" name="createPost" value="Post">
		</form>
	</div>
	<div class="get-post-container">
		<?php
			$query = "select * from users join posts on posts.userId = users.id ORDER by posts.id DESC";
			if($result = mysqli_query($conn, $query)){
				while ($row = $result->fetch_assoc()) {
					$userId = $row["userId"];
					$postId = $row["id"];
		?>
		<div class="get-post">
			<br/>
			<table width="100%" style="text-align: center;">
				<tr width="100%">
					<td width="10%">
						<img src="<?php echo $row["dp"]; ?>" class="dp">
					</td>
					<td width="80%">
							<tr width="100%">
								<td>
									<span class="name"><?php echo $row["fname"].' '.$row["lname"]; ?></span>
								</td>
							</tr>
							<tr width="100%">
								<td>
									<span class="date"><?php echo $row["createdAt"]; ?></span>
								</td>
							</tr>
					</td>
				</tr>
				<tr width="100%">
					<td width="100%">
						<hr class="line" />
					</td>
				</tr>
				<?php if(!empty(trim($row["postDesc"]))){ ?>
				<tr>
					<td>
						<span class="postData"><?php echo $row["postDesc"]; ?></span>
					</td>
				</tr>
				<?php }
					if(!empty(trim($row["postImage"]))){ ?>
					<tr>
						<td>
							<img src="<?php echo $row["postImage"]; ?>" class="postimg"/>
						</td>
					</tr>
				<?php } ?>
				<tr>
					<td>
						<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
							<input type="text" value="<?php echo $postId; ?>" name="postId" hidden>
							<button type="submit" name="addLikeBtn" class="like"><i class="fa fa-thumbs-up" aria-hidden="true"></i> <?php echo $row["likes"]; ?></button>
						</form>
					</td>
				</tr>
			</table>
			<?php if($_SESSION['userId'] == $userId){ ?>
				<form method="POST" action="">
					<input type="text" name="deleteId" value="<?php echo $postId; ?>" hidden>
					<input type="submit" name="deletePost" style="position: absolute; top: 0px; right: 0px; border: 1px solid black; border-radius: 0px 10px; background: #972329; color: #fff; padding: 10px;" value="&times;">
				</form>
			<?php } ?>
		</div>
		<?php 
			}
		}
		?>
	</div>
	<div class="monogram">
		<img src="images/umtLogo.png" width="20%" style="padding: 10px;"><span class="text">A Project of University of Management and Technology</span>
	</div>
</body>
</html>