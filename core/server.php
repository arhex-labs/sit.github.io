<?php
	require 'config.php';
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if(!$conn){
    	die("ERROR: Could not connect. " . mysqli_connect_error());
	}
	$username = $password = $password1 = $password2 = $gender = $error = $fname = $lname = "";
	if(isset($_POST['register'])){
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$password1 = mysqli_real_escape_string($conn, $_POST['password1']);
		$password2 = mysqli_real_escape_string($conn, $_POST['password2']);
		$fname = mysqli_real_escape_string($conn, $_POST['fname']);
		$lname = mysqli_real_escape_string($conn, $_POST['lname']);
		$gender = mysqli_real_escape_string($conn, $_POST['gender']);
		if(empty(trim($username))){
			$error = "Please Enter Username.";
		}
		if(empty(trim($fname))){
			$error = "Please Enter First Name.";
		}
		if(empty(trim($lname))){
			$error = "Please Enter Last Name.";
		}
		if(empty(trim($password1))){
			$error = "Please Enter Password.";
		}
		if($password1 != $password2){
			$error = "Password not match. Please Try Again.";
		}
		$query = "select * from users where email = '$username'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 1){
			$error = "Email already registered.";
		}
		if(empty(trim($error))){
			$password = md5($password1);
			$query = "INSERT INTO `users` (`id`, `email`, `password`, `fname`, `lname`, `gender`, `phone`, `dob`, `createdAt`, `dp`) VALUES (NULL, '$username', '$password', '$fname', '$lname', '$gender', 'Not Set', 'Not Set', current_timestamp(), 'images/user.png')";
			if(mysqli_query($conn, $query)){
				echo "<script>alert('Account Created. Login to use SIT.')</script>";
				header("LOCATION: login.php");
			} else {
				$error = "Something went wrong. Please Try again Later.";
			}
		}
	}

	//Login Process
	if(isset($_POST['login'])){
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$email = mysqli_real_escape_string($conn, $_POST['username']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		if(empty(trim($username))){
			$error = "Please Enter Username.";
		}
		if(empty(trim($password))){
			$error = "Please Enter Password.";
		}
		if(empty(trim($error))){
			$password = md5($password);
			$query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
			$result = mysqli_query($conn, $query);
			if(mysqli_num_rows($result) == 1){
				while ($row = $result->fetch_assoc()) {
					$userId = $row["id"];
					$userPassword = $row["password"];
					$userFname = $row["fname"];
					$userLname = $row["lname"];
					$userGender = $row["gender"];
					$userDob = $row["dob"];
					$userPhone = $row["phone"];
					$userDp = $row["dp"];
	            }
				$_SESSION['userId'] = $userId;
				$_SESSION['userPassword'] = $userPassword;
				$_SESSION['userFname'] = $userFname;
				$_SESSION['userLname'] = $userLname;
				$_SESSION['userGender'] = $userGender;
				$_SESSION['userDob'] = $userDob;
				$_SESSION['userPhone'] = $userPhone;
				$_SESSION['userDp'] = $userDp;
				header("LOCATION: index.php");
			} else {
				$error = "Username/Password incorrect.";
			}
		}
	}

	if(isset($_POST['createPost'])){
		$postDesc = mysqli_real_escape_string($conn, $_POST['postDesc']);
		$name = $_SESSION['userFname'].' '.$_SESSION['userLname'];
		$userId = $_SESSION['userId'];
		$userDp = $_SESSION['userDp'];
		$postImage = "";
		if(isset($_FILES['image'])){
		    $error = "";
		    $file_name = $_FILES['image']['name'];
		    $file_size =$_FILES['image']['size'];
		    $file_tmp =$_FILES['image']['tmp_name'];
		    $file_type=$_FILES['image']['type'];
		    $file_ext=explode('.',$_FILES['image']['name']);
		    $file_ext=end($file_ext);
		    $file_ext=strtolower($file_ext);
		      
		    $extensions= array("jpeg","jpg","png");
		      
		    if(in_array($file_ext,$extensions)=== false){
		        $error = "extension not allowed, please choose a JPEG or PNG file.";
		    }
		      
		    if($file_size > 2097152){
		       $error = 'File size must be excately 2 MB';
		    }
		    
		    if(empty($errors)==true){
		       move_uploaded_file($file_tmp,"uploads/".$file_name);
		    }
		    $postImage = "uploads/".$file_name;
		}
		if(trim($postImage) == "uploads/"){
			$postImage = "";
		}
		if(!empty(trim($postImage)) || !empty(trim($postDesc))){
			$query = "INSERT INTO `posts` (`id`, `userId`, `postDesc`, `postImage`, `likes`, `createdAt`) VALUES (NULL, '$userId', '$postDesc', '$postImage', '0', current_timestamp())";
			mysqli_query($conn, $query);
		}
	}

	if(isset($_POST['addLikeBtn'])){
		$id = $_POST['postId'];
		$likeQuery = "update posts set likes = likes + 1 where id = '$id'";
		mysqli_query($conn, $likeQuery);
	}

	if(isset($_POST['search'])){
		$email = $_POST['searchbar'];
		$query = "SELECT * FROM users where email = '$email'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 1){
			while ($row = $result->fetch_assoc()) {
				$searchFname = $row["fname"];
				$searchLname = $row["lname"];
				$searchGender = $row["gender"];
				$searchDob = $row["dob"];
				$searchPhone = $row["phone"];
				$searchDp = $row["dp"];
	        }
			$_SESSION['searchFname'] = $searchFname;
			$_SESSION['searchLname'] = $searchLname;
			$_SESSION['searchGender'] = $searchGender;
			$_SESSION['searchDob'] = $searchDob;
			$_SESSION['searchPhone'] = $searchPhone;
			$_SESSION['searchDp'] = $searchDp;
		}
		else {
			header("LOCATION: notFound.php");
		}
	}

	if(isset($_POST['editName'])){
		header("LOCATION: editName.php");
	}

	if(isset($_POST['editPhone'])){
		header("LOCATION: editPhone.php");
	}

	if(isset($_POST['editDob'])){
		header("LOCATION: editDob.php");
	}

	if(isset($_POST['editGender'])){
		header("LOCATION: editGender.php");
	}

	if(isset($_POST['editPassword'])){
		header("LOCATION: editPassword.php");
	}

	if(isset($_POST['editPicture'])){
		header("LOCATION: editPicture.php");
	}

	if(isset($_POST['changeName'])){
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$id = $_SESSION['userId'];
		$_SESSION['userFname'] = $fname;
		$_SESSION['userLname'] = $lname;
		$query = "update users set fname = '$fname', lname = '$lname' where id = '$id'";
		mysqli_query($conn, $query);
		header("LOCATION: profile.php");
	}

	if(isset($_POST['changePhone'])){
		$phone = $_POST['phone'];
		$id = $_SESSION['userId'];
		$_SESSION['userPhone'] = $phone;
		$query = "update users set phone = '$phone' where id = '$id'";
		mysqli_query($conn, $query);
		header("LOCATION: profile.php");
	}

	if(isset($_POST['changeDob'])){
		$dob = $_POST['dob'];
		$id = $_SESSION['userId'];
		$_SESSION['userDob'] = $dob;
		$query = "update users set dob = '$dob' where id = '$id'";
		mysqli_query($conn, $query);
		header("LOCATION: profile.php");
	}

	if(isset($_POST['changeGender'])){
		$gender = $_POST['gender'];
		$id = $_SESSION['userId'];
		$_SESSION['userGender'] = $gender;
		$query = "update users set gender = '$gender' where id = '$id'";
		mysqli_query($conn, $query);
		header("LOCATION: profile.php");
	}

	if(isset($_POST['changePassword'])){
		$password = $_POST['password'];
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];
		$id = $_SESSION['userId'];
		$password = md5($password);
		$query = "select * from users where password = '$password' AND id = '$id'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) != 1){
			$error = "Old Password not match.";
		}
		if($password1 != $password2){
			$error = "New Password and Confirm Password not match.";
		}
		if(empty(trim($error))){
			$_SESSION['userPassword'] = $password;
			$password1 = md5($password1);
			$query = "UPDATE `users` SET `password` = '$password1' WHERE `users`.`id` = '$id';";
			mysqli_query($conn, $query);
			header("LOCATION: profile.php");
		}
	}

	if(isset($_POST['changePicture'])){
		$id = $_SESSION['userId'];
		if(isset($_FILES['image'])){
		    $errors= array();
		    $file_name = $_FILES['image']['name'];
		    $file_size =$_FILES['image']['size'];
		    $file_tmp =$_FILES['image']['tmp_name'];
		    $file_type=$_FILES['image']['type'];
		    $file_ext=explode('.',$_FILES['image']['name']);
		    $file_ext=end($file_ext);
		    $file_ext=strtolower($file_ext);
		      
		    $extensions= array("jpeg","jpg","png");
		      
		    if(in_array($file_ext,$extensions)=== false){
		        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
		    }
		      
		    if($file_size > 2097152){
		       $errors[]='File size must be excately 2 MB';
		    }
		    
		    if(empty($errors)==true){
		       move_uploaded_file($file_tmp,"uploads/".$file_name);
		    }else{
		       print_r($errors);
		    }
		    $postImage = "uploads/".$file_name;
		}
		$_SESSION['userDp'] = $postImage;
		$query = "UPDATE `users` SET `dp` = '$postImage' WHERE `users`.`id` = '$id'";
		mysqli_query($conn, $query);
		header("LOCATION: profile.php");

	}

	if(isset($_POST['deletePost'])){
		$id = $_POST['deleteId'];
		$query = "DELETE FROM `posts` WHERE `posts`.`id` = '$id'";
		mysqli_query($conn, $query);
	}

?>