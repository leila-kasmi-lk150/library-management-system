<?php 
session_start(); 
include "../conn.php";

if (isset($_POST['email']) && isset($_POST['passWord'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$email = validate($_POST['email']);
	$passWord = validate($_POST['passWord']);


	// $email = stripcslashes($_POST['email']);
	// $passWord = stripcslashes($_POST['passWord']);

	$email= mysqli_real_escape_string($conn, $email);
	$passWord= mysqli_real_escape_string($conn, $passWord);

	if (empty($email)) {
		header("Location: index.php?error=Email is required");
	    exit();
	}else if(empty($passWord)){
        header("Location: index.php?error=Password is required");
	    exit();
	}else{
		// hashing the password
       // $passWord = md5($passWord);

        
		$sql = "SELECT * FROM users WHERE email='$email' AND passWord='$passWord'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['email'] === $email && $row['passWord'] === $passWord) {
            	$_SESSION['email'] = $row['email'];
            	$_SESSION['idUser'] = $row['idUser'];
				$_SESSION['userType'] = $row['userType'];
					if($row['userType']=="admin"){
						header("Location: ../../public/admin/dashboard/index.php");
						exit();
						}
            		else{
						header("Location: ../../public/home");
						exit();
					}
		        
            }else{
				header("Location: index.php?error=Incorect email or password");
		        exit();
			}
		}else{
			header("Location: index.php?error=Incorect email or password");
	        exit();
		}
	}
	
}else{
	header("Location: index.php");
	exit();
}