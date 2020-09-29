<?php
session_start();
require 'dbcontroller.php';
 $password="";
 $username="";
 $email="";


if(isset($_POST['login_user'])){
    
    $login = $_POST['login'];
    $password = ($_POST['password']);
	$sql= "SELECT * from user WHERE username= :username OR email=:email" ;
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':username', $login);
	$stmt->bindValue(':email', $login);
    $res= $stmt->execute();
    $user=$stmt->fetch(PDO::FETCH_ASSOC);
    // $hash=$user['password'];
    if ($user!==FALSE) {
    	//User account found. Check to see if the given password matches the
        //password hash that we stored in our users table.
        
        //Compare the passwords.
        $validPassword = password_verify($password, $user['password']);
                
        //If $validPassword is TRUE, the login has been successful.
        if($validPassword){
            
            //Provide the user with a login session.
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['logged_in'] = time();
            
            //Redirect to our protected page, which we called home.php
            header('Location: registration.php');
            exit;
            
        }
        else{
            //$validPassword was FALSE. Passwords do not match.
            // die('Incorrect username / password ');
            $found="Incorrect username / password";
        }
    }
    
    else{
    	// die('Incorrect username / password');
    	$found="Incorrect username / password";
         
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
			    			<?php
								  if(isset($found))
								  {
								  	echo '<p class="text-center text-danger">Invalid user id or password.Please try again</p>';
								  }
								  ?>
			    			<div class="message text-danger"></div>
			    			<div class="row">
			    				<div class="col-xs-12 col-md-12">
			    			<div class="form-group">
			    				<label>Username/Email</label>
			    				<input type="text" name="login" class="form-control" placeholder="Username/email">
			    			</div>
			    		</div>
			    		</div>
			    		<div class="row">
			    			<div class="col-xs-12 col-md-12">
			    			<div class="form-group">
			    				<label>Password</label>
			    				<input type="password" name="password" class="form-control" placeholder="Password">
			    			</div>
			    		</div>
			    		</div>
			    			<div class="col-xs-12 col-md-12">
			    			<div class="form-group">
			    			<center><input type="submit" name="login_user" value="Login" class="btn btn-info " ></center>
			    		</div></div>
			    		<div class="col-xs-12 col-md-12">
			    			<div class="form-group">
			    			<center><a href="password.php"><span>Forgot password? Click here to enter new password</span></a></center>
			    		</div></div>
			    		
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
