<?php

session_start();
if(!isset($_SESSION['username']) || !isset($_SESSION['logged_in'])){
    header('Location: index.php');
    exit;
}
$db=mysqli_connect('localhost','root','','reg_user');
// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//variables

   

if(isset($_POST['reg_user'])){
  
  
     $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);


    
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
 $target_dir = "uploads/";
    $uploadOk = 1;
    $imagename = $target_dir . uniqid() . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($imagename,PATHINFO_EXTENSION));
// Check if file already exists
if (file_exists($imagename)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
}

elseif (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $imagename)) {
    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
}
//upload documents
$file_dir = "documents/";
$cvfile = $file_dir . uniqid() . basename($_FILES["cvupload"]["name"]);
$uploadOk = 1;
$docFileType = strtolower(pathinfo($cvfile,PATHINFO_EXTENSION));
$filecheck = filesize($_FILES["cvupload"]["tmp_name"]);


// Check if file already exists
if (file_exists($cvfile)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}


// Allow certain file formats
if($docFileType != "doc" && $docFileType != "docx" && $docFileType != "jpeg "
    && $docFileType != "pdf" && $docFileType != "ODT" && $docFileType != "ODS" && $docFileType != "jpg" && $docFileType != "png") {
    echo "Sorry, only document files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
}else {
    if (move_uploaded_file($_FILES["cvupload"]["tmp_name"], $cvfile)) {
        echo "The file " . basename($_FILES["cvupload"]["name"]) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

    // $query = "SELECT * FROM user_reg WHERE username='$username' OR email='$email' LIMIT 1";
    // $result = mysqli_query($db, $query);
      
    // $user = mysqli_fetch_assoc($result);
    // if ($user) { 
    //     if ($user['username'] === $username) {
    //       array_push($errors, "Username already exists");
    //       header('location:registration.php');
    //     }
     
    //     if ($user['email'] === $email) {
    //       array_push($errors, "email is already exists");
    //       header('location:registration.php');
    //     }

    // }


    $sql="INSERT INTO user_reg 
    (username, email,b_radio, marital, children, id_no, no_children,imagename, con_email, town, county, country, p_add, full_names, occupation, k_email, k_relation, p_number, i_name, c_name, Q_A, w_name, t_period, p_held, cvfile)
    VALUES ('".$_POST["username"]."','".$_POST["email"]."','".$_POST["b_radio"]."','".$_POST["marital"]."','".$_POST["children"]."','".$_POST["id_no"]."','".$_POST["no_children"]."','".$imagename."','".$_POST["con_email"]."','".$_POST["town"]."','".$_POST["county"]."','".$_POST["country"]."','".$_POST["p_add"]."','".$_POST["full_names"]."','".$_POST["occupation"]."','".$_POST["k_email"]."','".$_POST["k_relation"]."','".$_POST["p_number"]."','".$_POST["i_name"]."','".$_POST["c_name"]."','".$_POST["Q_A"]."','".$_POST["w_name"]."','".$_POST["t_period"]."','".$_POST["p_held"]."', '".$cvfile."')";
   $result = mysqli_query($db, $sql);
   if ($result) {
     print_r($result);
   }
   

    if (!$result)
    {
        die('Error: ' . mysqli_error($db));
    }
    else{
        header('location:success.php');
    }


}


mysqli_close($db);
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
</style>
<link rel="stylesheet" type="text/css" href="css/style.css">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">   
    
<body style="background-color:#4d4d4d;">

<div class="container" style="max-width:3200px; ">
  <div class="row ">
  <div class="col-md-12">
    <ul id="progressbar">
   <li class="active" >REGISTER ACCOUNT</li>
    <li >SELECT COURSE</li>
     <li>MARITAL STATUS</li>
    <li>CONTACTS</li>
    <li>FAMILY INFO</li>
     <li>ACADEMIC QUALIFICATION</li>
    <li>PERSONNAL EXPERIENCE</li>
    <li>SUPPORTING DOCUMENTS</li>
     <li>COMPLETE REGISTRATION</li>
    
  </ul>
  <form id="msform" action="registration.php" method="post" id="myforms" enctype="multipart/form-data">
  <!-- Grid -->
  
  <!-- progressbar -->
  
  <div class="row  mt-0">
  <div class="col-11 col-sm-9 col-md-7 col-lg-6 p-0 mt-3 mb-2">
  <div class=" ">
  
  <!-- fieldsets -->
  <fieldset id="register">
    <div class="card-body">
  	<table class="table table-bordered table-responsive table-striped text-center" style="background-color:white;border-radius:7px;">
      <tr><td colspan="2">
      <div class="jumbotron" style="padding-top: 18px;padding-bottom: 18px;">
	    <h3 class="fs-title text-success">
        <?php
        if($_SESSION["username"]) {
        ?>
         REGISTRATION SUCCESSFUL: <?php echo $_SESSION["username"]; ?>.<a href="logout.php" style="float:right;">Logout</a>.
        <?php
        }else echo "<h1>Please login first .</h1>";
        ?>							    							

	    </h3>
  	</div>
  </td>
  </tr>
	    <tr><td colspan="2"><h4 class="fs-subtitle">Please Proceed Login with your new <u>Username</u> and <u>Password</u> to continue with your online application process</h4></td></tr>
	   
      <?php
      require 'dbcontroller.php';
      $stmt = $dbh->prepare('SELECT * FROM user WHERE username=:username');
      $stmt->bindParam(':username', $_SESSION['username']);
      $stmt->execute();
      //$results is now an associative array with the result
      while($rows = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>
	    <tr class="t"><td id="tdc">username</td><td><input class="form-control" style="width:100%;position:relative; display:inline-block; text-align:center;" type="text" name="username"value ="<?php echo $rows['username']; ?>"readonly></td></tr>
	    <tr class="t"><td>Email</td><td><input class="form-control" style="width:100%;position:relative; display:inline-block; text-align:center;" type="email" name="email" value="<?php echo $rows['email']; ?>"readonly></td></tr>
	    <tr><td id="tdc">Surname</td><td><?php echo $rows['s_name'];?></td></tr>
	    <tr><td>Other Names</td><td><?php echo $rows['names']; ?></td></tr>
	    <tr><td id="tdc">Gender</td><td><?php echo $rows['gender']; ?></td></tr>
	    <tr><td>Date of Birth</td><td><?php echo $rows['dateofbirth']; ?></td></tr>
	    <tr><td id="tdc">Nationality</td><td><?php echo $rows['nationality']; ?></td></tr>
   <?php } ?>
    </table>
  </div>
    <input type="button" name="next" class="next action-button text-center  " value="Next" style="margin-right: 15px; float: right;" />

  </fieldset>
  <fieldset id="course" >
    <div class="form-card">
      <div class="jumbotron" style="padding-top: 18px;padding-bottom: 18px;">
  		<h2 class=" text-success fs-title">Course selection<a href="logout.php" class="text-danger" style="padding:50px;">signout</a></h2></div>
      
        <h2 >IMPORTANT</h2>
        <div>
        <ul>
          <li>Every part MUST be completed.It will only be considered when all conditions are filled</li>
          <li>Applicants are advised to read carefully all course requirements before filling the form.</li>
          <li>Select any course listed below and then click on the save selection before proceeding to the next slection</li>
        </ul>
</div>
      
      <hr><h3>Select Course</h3><hr>
     
     <label>Select the course you want to undertake</label><br>
      <input type="radio"  id="radio" name="b_radio"  value="Diploma in culinary Arts(Chefs Course)" required>
      <label for="defaultUnchecked">Diploma in culinary Arts(Chefs Course)</label><br>
    
      <input type="radio"  id="" name="b_radio" value="Diploma in Pastry & Bakery">
      <label for="defaultUnchecked">Diploma in Pastry & Bakery</label>
    
	    
	 </div>
	    		
	    
    <input type="button" name="previous" class="previous action-button " value="Previous" style="margin-right: 10px; float:center;" />
    <input type="button" name="next" class="next action-button" value="Next" style="margin-right: 10px; float: right;"  />
  </fieldset>
  <fieldset id="marital">
     <div class="form-card">
      <div class="jumbotron" style="padding-top: 18px;padding-bottom: 18px;">
  		  <h2 class="fs-title text-success" >Personal Data for:<?php echo $_SESSION["username"]; ?><a href="logout.php" class="text-danger" style="float:right; padding-right:30px;" >signout</a></h2></div>
        <p><h3>importants</h3><br>
          <ul>
            <li>Every part MUST be completed.It will only be considered when all conditions are filled</li>
          <li>Applicants are advised to read carefully all course requirements before filling the form.</li>
          <li>Please Note: Image limit size is <u>5MB MAX</u> any file larger than this will be rejected</li>
          </ul></p>
          <hr>
          <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label>Select Marital Status</label>
                            <select class="form-control input-sm" name="marital" required>
                              <option>Marital Satus</option>
                              <option value="married">Married</option>
                              <option value="single">Single</option>
                              <option value="divorced">Divorced</option>
                            </select>
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label>Do you have children?</label>
                      <select class="form-control input-sm" name="children" required>
                        <option></option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label>ID/Passport Number</label>
                            <input type="text" name="id_no" id="id_p" class="form-control input-sm" placeholder="ID/Passport" required>
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label>Number of Children?</label>
                      <input type="number" name="no_children" class="form-control input-sm" id="children" placeholder="IF Yes enter number e.g 1.2" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label>Select Passport Picture</label>
                            <input type="file"  name="fileToUpload" id="fileUploader" class="form-control input-sm" placeholder="choose a File" required>
                            
                             <span id="spnmsg" style="color:red;"></span>
                                    
                    </div>
                  </div>
                  </div>    
    </div>
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="button" name="next" class="next action-button" value="Next" style="margin-right: 10px; float: right;"/>
  </fieldset>
  <fieldset id="contact">
     <div class="form-card">
  		 <div class="jumbotron" style="padding-top: 18px;padding-bottom: 18px;"><h2 class="fs-title text-success" >Personal Data for:<?php echo $_SESSION["username"]; ?><a href="logout.php" class="text-danger" style="float:right; padding-right:30px;" >signout</a></h2></div>
        <p><h3>importants</h3><br>
          <ul>
            <li>Every part MUST be completed.It will only be considered when all conditions are filled</li>
          <li>Applicants are advised to read carefully all course requirements before filling the form.</li>
          
          </ul></p>
          <hr>
          <h3>contact Details</h3><hr>
          <div class="row">
                  <div class="col-xs-12 col-md-12">
                <div class="form-group">
                  <label>Mailing Address</label>
                  <input type="email" name="con_email"  id="email" class="form-control" placeholder="Mailing Address" required>
                </div>
              </div>
              </div>
          <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label>Postal Code</label>
                            <input type="number" id="p_c" name="p_code" class="form-control" placeholder="Postal Code" required>
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label>Town</label>
                      <input type="text" name="town" id="town" class="form-control" placeholder="Town" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-md-12">
                <div class="form-group">
                  <label>County</label>
                  <input type="text" name="county" id="county" class="form-control" placeholder="Enter County"required>
                </div>
              </div>
              </div>
              <div class="row">
                  <div class="col-xs-6 col-md-6">
                <div class="form-group">
                  <label>Country</label>
                  <select class="form-control input-sm" name="country" required>
                        <option>Select Country</option>
                        <option value="kenya">Kenya</option>
                        <option value="Foreigner">Foreigner</option>
                      </select>
                </div>
              </div>
              </div>
              <div class="row">
                  <div class="col-xs-12 col-md-12">
                <div class="form-group">
                  <label class="align-right">Physical Address</label>
                  <input type="text" name="p_add" id="p_add" class="form-control" placeholder="Physical Parmanent Address" height="100" >
                </div>
              </div>
              </div>
            </div>
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="button" name="next" class="next action-button" value="Next" style="margin-right: 10px; float: right;"/>
  </fieldset>
  <fieldset id="contact">
     <div class="form-card">
      <div class="jumbotron" style="padding-top: 18px;padding-bottom: 18px;">
  		   <h2 class="fs-title text-success" >Personal Data for:<?php echo $_SESSION["username"]; ?><a href="logout.php" class="text-danger" style="float:right;padding-right:30px;">signout</a></h2></div>
        <p><h3>importants</h3><br>
          <ul>
            <li>Every part MUST be completed.It will only be considered when all conditions are filled</li>
          <li>Applicants are advised to read carefully all course requirements before filling the form.</li>
          
          </ul></p>
          <hr>
          <h3>Kin and Relatives Details</h3><hr>
                  <div class="row">
              <div class="col-xs-12 col-md-12">
                <div class="form-group">
                  <label>Full Names</label>
                  <input type="text" name="full_names" id="names" class="form-control" placeholder="Full Names"required >
                </div>
              </div>
              </div>
                <div class="row">
                  <div class="col-xs-12 col-md-12">
                <div class="form-group">
                  <label>Occupation</label>
                  <input type="text" name="occupation" id="occupation" class="form-control" placeholder="Occupation" required>
                </div>
              </div>
              </div>
              <div class="row">
              <div class="col-xs-12 col-md-12">
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="k_email" id="email" class="form-control" placeholder="Email" required>
                </div>
              </div>
              </div>
              <div class="row">
                <div class="col-xs-6 col-md-6">
                <div class="form-group">
                  <label>Relationship</label>
                  <select class="form-control input-sm" name="k_relation" required>
                        <option>Relationship</option>
                        <option value="Parent">Parent</option>
                        <option value="sponsor">Sponsor</option>
                        <option value="relative">Relative</option>
                      </select>
                </div>
              </div>
              <div class="col-xs-6 col-md-6">
                <div class="form-group">
                  <label>Mobile No</label><br>
                  <input type="number" id="phone_no" class="form-control" name="p_number" placeholder="Mobile" required>
                </div>
              </div>
              </div>
		</div>	    		
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="button" name="next" class="next action-button" value="Next" style="margin-right: 10px; float: right;"/>
  </fieldset>
   <fieldset id="school">
     <div class="form-card"><div class="jumbotron" style="padding-top: 18px;padding-bottom: 18px;">
  		  <h2 class="fs-title text-success" >Academics for:<?php echo $_SESSION["username"]; ?><a href="logout.php" class="text-danger" style="float:right; padding-right:30px;">signout</a></h2></div>
        <p><h3>importants</h3><br>
          <ul>
            <li>Every part MUST be completed.It will only be considered when all conditions are filled</li>
          <li>Applicants are advised to read carefully all course requirements before filling the form.</li>
          
          </ul></p>
          <hr>
          <h3>Academic Qaulifications</h3>
          <hr>
                  <div class="row">
              <div class="col-xs-12 col-md-12">
                <div class="form-group">
                  <label>Institution</label>
                  <input type="text" name="i_name" id="names" class="form-control" placeholder="School/Institution" required>
                </div>
              </div>
              </div>
                <div class="row">
                  <div class="col-xs-12 col-md-12">
                <div class="form-group">
                  <label>Course</label>
                  <input type="text" name="c_name"id="course" class="form-control" placeholder="Course Pursued" required>
                </div>
              </div>
              </div>
              <div class="row">
              <div class="col-xs-12 col-md-12">
                <div class="form-group">
                  <label>Qualification Attained</label>
                  <input type="text" name="Q_A" class="form-control" placeholder="Qualification Attained" required>
                </div>
              </div>
      </div>
			</div>    		
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="button" name="next" class="next action-button" value="Next" style="margin-right: 10px; float: right;" />
  </fieldset>
  <fieldset id="Professional">
     <div class="form-card">
      <div class="jumbotron" style="padding-top: 18px;padding-bottom: 18px;">
  		  <h2 class="fs-title text-success" >Job Experience For:<?php echo $_SESSION["username"]; ?><a href="logout.php" class="text-danger" style="float:right; padding-right:30px;">signout</a></h2></div>
        <p><h3>importants</h3><br>
          <ul>
            <li>Every part MUST be completed.It will only be considered when all conditions are filled</li>
          <li>Applicants are advised to read carefully all course requirements before filling the form.</li>
          
          </ul></p>
          <hr>
          
                  <div class="row">
              <div class="col-xs-12 col-md-12">
                <div class="form-group">
                  <label>Workplace</label>
                  <input type="text" name="w_name" id="names" class="form-control" placeholder="Company/Institution" required>
                </div>
              </div>
              </div>
                <div class="row">
                  <div class="col-xs-12 col-md-12">
                <div class="form-group">
                  <label>Period</label>
                  <input type="number" name="t_period" id="period" class="form-control" placeholder="Period(e.g 2000-2014)"required >
                </div>
              </div>
              </div>
              <div class="row">
              <div class="col-xs-12 col-md-12">
                <div class="form-group">
                  <label>Position Held</label>
                  <input type="text" id="p_held" name="p_held"class="form-control" placeholder="Position held" required>
                </div>
              </div>
              </div>
		</div>	    		
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="button" name="next" class="next action-button" value="Next" style="margin-right: 10px; float: right;" />
  </fieldset>
  <fieldset id="Professional">
     <div class="form-card">
      <div class="jumbotron" style="padding-top: 18px;padding-bottom: 18px;">
  		  <h2 class="fs-title text-success" >Personal Data For:<?php echo $_SESSION["username"]; ?><a href="" class="text-danger" style="float:right; padding-right:30px;">signout</a></h2></div>
  		  <p><h3>importants</h3><br>
  		  	<ul  class="w3-li">
  		  		<li>Every part MUST be completed.It will only be considered when all conditions are filled</li>
	    		<li>Applicants are advised to read carefully all course requirements before filling the form.</li>
	    		<li>After filling in the Fields pleaase click on the <u>Upload Documents</u> before proceeding to ensure your data has been saved</li>
	    		<li>ONLY "jpeg","png", "docx", "odf","pdf" File types allowed</li>
  		  	</ul></p>
  		  	<hr>
  		  	
  		  	        <div class="row">
			    		<div class="col-xs-12 col-md-12">
			    			<div class="form-group">
			    				<label>Upload cv</label>
			    				<input type="file" id="fileUploader" name="cvupload" class="form-control" placeholder="CV" required>
                  <span id="spnmsg" style="color:red;"></span>
			    			</div>
			    		</div>
			    	</div>
		</div>	    		
    <input type="button" name="previous" class="previous action-button" value="Previous" >
   
  
    <input type="submit" name="reg_user" id="btnsubmit" class="action-button" value="Submit " style="margin-right: 10px; float: right;">
  </fieldset>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
<script src="js/script.js"></script>
<script src="js/validation.js"></script>
  <script type="text/javascript">
        $(function () {
            $("#fileUploader").change(function () {
                // Get uploaded file extension
                var extension = $(this).val().split('.').pop().toLowerCase();
 
                // Create array with the files extensions that we wish to upload
                var validFileExtensions = ['jpeg', 'jpg', 'png', 'gif', 'doc','docx ','odt','rtf' ,'txt' ,'wpd ','pdf'];
 
                //Check file extension in the array.if -1 that means the file extension is not in the list.
                if ($.inArray(extension, validFileExtensions) == -1) {
                    $('#spnmsg').text("Failed!! Please upload jpg, jpeg, png, gif, bmp file only.").show();
 
                    // Clear fileuload control selected file
                    $(this).replaceWith($(this).val('').clone(true));
 
                    //Disable Submit Button
                    $('#btnSubmit').prop('disabled', true);
                }
                else {
                    // Check and restrict the file size to 32 KB.
                    if ($(this).get(0).files[0].size > (727680)) {
                        $('#spnmsg').text("Failed!! Max allowed file size is 7.2 mb").show();
 
                        // Clear fileuload control selected file
                        $(this).replaceWith($(this).val('').clone(true));
 
                        //Disable Submit Button
                        $('#btnSubmit').prop('disabled', true);
                    }
                    else {
                        //Clear and Hide message span
                        $('#spnmsg').text('').hide();
 
                        //Enable Submit Button
                        $('#btnSubmit').prop('disabled', false);
                    }
                }
            });
        });
    </script>
</body>
</html>
















 
