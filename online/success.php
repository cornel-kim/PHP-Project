<?php

session_start();
if(!isset($_SESSION['username']) || !isset($_SESSION['logged_in'])){
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<title>Registration progress bar</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/angularjs/1.0.7/angular.min.js"></script>    
<style>
h1,h2,h3,h4,h5,h6 {font-family: "Oswald"}
body {font-family: "Open Sans"}
a{
  text-align: center;
  color: black;
}
</style>

 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">   
    
<body>

<div class="containerfluid" style="font-size: 15px; text-align: justify; padding-left: 20px; padding-top: 100px;">
  <div class="row">
  <div class="col-md-12 mx-0">
   
  <div class="row justify-content-center mt-0">
  <div class="col-11 col-sm-9 col-md-7 col-lg-6 p-0 mt-3 mb-2">
  <div class=" card px-0 pt-4 pb-0 mt-3 mb-3">
  <div class="card-body form-card">
 
  

   
     <h2 class="fs-title text-success card-title" >
     <div class="jumbotron">
    <?php
      if($_SESSION["username"]) {
        ?>
         REGISTRATION SUCCESSFUL: <?php echo $_SESSION["username"]; ?>.<a href="logout.php" style="color:red; padding-left: 30px; ">Logout</a>.
        <?php
        }else echo "<h1>Please login first .</h1>";
        ?>    </h2></div>
        <div class="row" style="padding-bottom:50px;">
        <div class="col-md-2"></div>
        <div class="card-body col-md-8" style="background-color: #f2f2f2; ">
  		  <p class="card-text"><b>Application Process Completed Successfully</b></p>
  		  <p class="card-text"><b>Thank You For Showing Interest in Our Institution</b></p>
  		  <p class="card-text"><b>We have received your application an email has been sent to you</b> </p>
  		  </div>	
        <div class="col-md-2"></div>
        </div>		    		
    <div class="btn-group" role="group">
    <button type="button" class="btn btn-success btn-lg"><a href="viewreg.php" style="color:black; font-size:20px;">View application details</a></button>
 
   <button type="button" class="btn btn-danger btn-lg"><a href="logout.php" style="color:black; font-size: 30px;" >Logout</a></button>
 </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
<script src="js/script.js"></script>
</body>
</html>
















 
