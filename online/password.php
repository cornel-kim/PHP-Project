<?php
session_start();
error_reporting(0);
include('dbcontroller.php');


if(isset($_POST['change_pass'])){
$username = $_SESSION['username'];  
$password = $_POST['password'];
$conpassword = $_POST['con_password']; 

$sql = "SELECT COUNT(*) AS num FROM user WHERE username = :username OR email=:email";
    $stmt = $dbh->prepare($sql);
    
    
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':email', $email);
    
    //Execute.
    $stmt->execute();
    
    //Fetch the row.
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {

		if(strlen($password) >= 5){
		    if($password == $con_password){

		        $password = password_hash($con_password, PASSWORD_DEFAULT);

		        $stmt = $conn->prepare("UPDATE user SET password = :password WHERE username=:username");
		        $stmt->execute([
		            ':password' => $password,
		            ':username' => $username
		        ]);

		        $_SESSION['success'] = 'password was changed successfully';
		        header('Location: index.php');
		        exit(0);
		    }
		} else {
		    $_SESSION['failed'] = 'Error, please check the password and retry again';
		    header('Location:password.php');
		    exit(0);
		}  
	} 
else{
	echo "failed to change pass";
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<!-- <link rel="stylesheet" type="text/css" href="css/css.css"> -->
	
</head>
<body>



<div class="container" id="log" style="max-width:800px;">
        <div class="row centered-form">
        <div class="col-10 offset-1 col-lg-8 offset-lg-2 div-wrapper align-items-center">

        	<div class="panel panel-default">
			 			<header class="row">
					       <nav class="navbar navbar-expand-lg navbar-light">
					          <div class="collapse navbar-collapse" id="navbarSupportedConten">
					            <ul class="navbar-nav mr-auto">
					              <li class="nav-item active">
					                <a class="nav-link" href="index.php" id="reg" style=" padding-left:25px;"><h3>Login</h3></a>

					              </li>
					               <li class="nav-item">
					                  <a class="nav-link text" href="register.php" style="float:right; padding-left:250px;"><h3>Register</h3></a>
					              </li>

					            </ul>
					            
					          </div>
					        </nav> 

					    </header>
			 			<hr>
			 			<div class="panel-body">
			    		<form role="form" action="index.php" method="post"enctype="multipart/form-data">
			    			<div class="message text-danger"></div>
			    			<div class="row">
			    			<div class="col-xs-12 col-md-12">
			    			<div class="form-group">
			    				<label>Username/email</label>
			    				<input type="text" name="username" class="form-control" placeholder="Username">
			    			</div>
			    		</div>
			    		</div>
			    			<div class="row">
			    			<div class="col-xs-12 col-md-12">
			    			<div class="form-group">
			    				<label>New Password</label>
			    				<input type="text" name="password" class="form-control" placeholder="New Password">
			    			</div>
			    		</div>
			    		</div>
			    		<div class="row">
			    			<div class="col-xs-12 col-md-12">
			    			<div class="form-group">
			    				<label>Confirm Password</label>
			    				<input type="password" name="con_password" class="form-control" placeholder="Password">
			    			</div>
			    		</div>
			    		</div>
			    			
			    			<center><input type="submit" name="change_pass" value="Confirm Changes" class="btn btn-info " ></center>
			    		
			    		</form>
			    			
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
