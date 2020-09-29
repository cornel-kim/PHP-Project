 
<?php 

session_start();
 
 

require 'dbcontroller.php';
 $username = "";
$email    = "";
$s_name ="";
$names ="";
$nationality="";
$gender="";
$dateofbirth="";
 
if(isset($_POST['register'])){
    
    //Retrieve the field values from our registration form.
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    $s_name = !empty($_POST['s_name']) ? trim($_POST['s_name']) : null;
    $names = !empty($_POST['names']) ? trim($_POST['names']) : null;
    $nationality= !empty($_POST['nationality']) ? trim($_POST['nationality']) : null;
    $gender= !empty($_POST['gender']) ? trim($_POST['gender']) : null;
    $dateofbirth = !empty($_POST['dateofbirth']) ? trim($_POST['dateofbirth']) : null;
    $password = !empty($_POST['password']) ? trim($_POST['password']) : null;
    
   
    $sql = "SELECT COUNT(*) AS num FROM user WHERE username = :username OR email=:email";
    $stmt = $dbh->prepare($sql);
    
    
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':email', $email);
    
    //Execute.
    $stmt->execute();
    
    //Fetch the row.
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($row['num'] > 0){
        // die('That username/email already exists!');
        $found="Incorrect username / password";
    }
    
    
    $passwordHash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));
    
    
    $sql = "INSERT INTO user (username, email, s_name, names, nationality, gender, dateofbirth, password) VALUES (:username,:email, :s_name, :names, :nationality, :gender, :dateofbirth, :password)";
   
    $stmt = $dbh->prepare($sql);
    
    //Bind our variables.
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':s_name', $s_name);
    $stmt->bindValue(':names', $names);
    $stmt->bindValue(':nationality', $nationality);
    $stmt->bindValue(':gender', $gender);
    $stmt->bindValue(':dateofbirth', $dateofbirth);
    $stmt->bindValue(':password', $passwordHash);
    $result = $stmt->execute();
    if($result){
        //What you do here is up to you!
        echo 'You have registered successfully.';
        header('location:index.php');
    }
    
}
 
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>



<div class="container">
        <div class="row centered-form">
        <div class="col-10 offset-1 col-lg-8 offset-lg-2 div-wrapper d-flex justify-content-center align-items-center">
        	<div class="panel panel-default">
        		<header class="row">
					       <nav class="navbar navbar-expand-lg navbar-light" id="nav">
					          <div class="collapse navbar-collapse" id="navbarSupportedContent">
					            <ul class="navbar-nav mr-auto">
					              <li class="nav-item">
					                <a class="nav-link" href="index.php" style="float:right; padding-left:25px;"><h3>Login</h3></a>
					              </li>
					               <li class="nav-item active">
					                  <a class="nav-link text" href="register.php" style="float:right; padding-left:240px;"><h3>Register</h3></a>
					              </li>

					            </ul>
					            
					          </div>
					        </nav> 
					    </header>
			 			<hr>
			 			<div class="panel-body">
			    		<form role="form" method="post" id="myforms" action="register.php" enctype="multipart/form-data">
			    			<?php
								  if(isset($found))
								  {
								  	echo '<p class="text-center text-danger">The username/email already exists. Use other username</p>';
								  }
								  ?>
			    			<div class="">

			    			<div class="form-group">
			    				<label>Username</label>
			    				<input type="text" name="username" id="username"class="form-control input-sm" placeholder="Username"  value="<?php echo $username; ?>" required>
			    			</div>
			    			
			    			<div class="form-group">
			    				<label>Email</label>
			    				<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address"  value="<?php echo $email; ?>" required>
			    			</div>
			    		
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    					    <label>Surname</label>
						               
						                <input type="text" id="s_name" name="s_name" class="form-control input-sm" placeholder="Surname"  value="<?php echo $s_name; ?>"required>
						                
						    		</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    					    <label>Other Names</label>
			    						<input type="text" id="names" name="names" class="form-control input-sm" placeholder="Other_Names" value="<?php echo $names; ?>" required>
			    					</div>
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    					    <label>Nationality</label>
						                <select class="form-control input-sm" name="nationality" value="<?php echo $nationality; ?>">
						                	<option >Select Nationality</option>
						                	<option value="Kenyan">Kenyan</option>
						                	<option value="Others">Others</option>
						                	
						                </select>
						    		</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    					    <label>Gender</label>
			    						<select class="form-control input-sm" name="gender" value="<?php echo $gender; ?>" >
						                	<option>Select Gender</option>
						                	<option value="Male">Male</option>
						                	<option value="Female">Female</option>
						                	<option value="Others">Others</option>
						                </select>
			    					</div>
			    				</div>
			    			</div>


			    			<div class="">
			    			<div class="form-group">
			    				<label>Date of Birth</label>
			    				<input type="date" name="dateofbirth" class="form-control input-sm"   value="<?php echo $date; ?>">
			    			</div>
			    		</div>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" id="password" name="password" class="form-control input-sm" placeholder="Password"   required>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="password_confirm" class="form-control input-sm" placeholder="Confirm Password"   required>
			    					</div>
			    				</div>
			    			</div>
			    			
			    			<center><input type="submit" value="submit" name="register" class="btn btn-info" ></center>
			    		
			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="js/validationjs"></script>
</body>
</html>