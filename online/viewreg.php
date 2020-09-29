<?php
include("dbcontroller.php");
session_start();
if(!isset($_SESSION['username']) || !isset($_SESSION['logged_in'])){
    header('Location: index.php');
    exit;
}
?>
<html>
<head>
<title>User details</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/angularjs/1.0.7/angular.min.js"></script>    
<style>
h1,h2,h3,h4,h5,h6 {font-family: "Oswald"}
body {font-family: "Open Sans"}
th{
	text-align: center;
}
</style>
<link rel="stylesheet" type="text/css" href="css/style.css">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">   
</head>
<body>
<div class="container">
<div class="jumbotron"><h3>View your registration details:<?php echo $_SESSION["username"]; ?><a href="logout.php" class="text-danger" style="float:right;">signout</h3></div>
<form>
	
<table class="table table-striped table-bordered">
 <thead class="thead-dark">
 	<tr>	<td colspan="2" class="text-center">
 		<?php
    $conn = mysqli_connect("localhost", "root", "", "reg_user");
	$sql = "select * from user_reg where username='".$_SESSION['username'] ."'";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);
    // print_r($row);
    while ($row) {
    	// echo"<h2>{$row['name']}</h2><br>";
    	echo "<img src='{$row['imagename']}' width='10%' ";
    	break;
    }
	

	?>
</td>
 	</tr>


</thead>
<tbody>

<?php 
$sql = "SELECT * from  user where username='".$_SESSION['username'] ."'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row) 
	{ ?>
		<tr><th colspan="2" class="text-center">Personnal Details</th></tr>
<tr>
<th scope="col">Surname</th><td><?php echo htmlentities($row->s_name);?></td></tr>
<tr><th scope="col">Other Names</th><td><?php echo htmlentities($row->names);?></td></tr>
<tr><th scope="col">Email</th><td><?php echo htmlentities($row->email);?></td>
</tr>
<tr><th scope="col">Nationality</th><td><?php echo htmlentities($row->nationality);?></td></tr>
<tr><th scope="col">Gender</th><td><?php echo htmlentities($row->gender);?></td></tr>
<tr><th scope="col">Date of Birth</th><td><?php echo htmlentities($row->dateofbirth);?></td>

</tr>

<?php } }
?>
</tbody>
</table>
<table class="table table-striped table-bordered">

<?php 
$sql = "SELECT * from  user_reg where username='".$_SESSION['username'] ."'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row) 
	{ ?>
 <table class="table table-striped table-bordered">
 <tr><th colspan="3" class="text-center">course selected<th></tr>	
 <tr><th>Course selected</th><td><?php echo htmlentities($row->b_radio);?></td></tr>
</table>
<table class="table table-striped table-bordered">
 <tr><th colspan="5" class="text-center"><h3>Familiy information</h3></th></tr>
<tr>
<th scope="col">user Email</th>
<th scope="col">Marital status</th>
<th scope="col">Children(yes/no)</th>
<th scope="col">NUmber of children if (yes)</th>
<th scope="col">Course selection</th>

</tr>

<tr>
<td><?php echo htmlentities($row->email);?></td>
<td><?php echo htmlentities($row->marital);?></td>
<td><?php echo htmlentities($row->children);?></td>
<td><?php echo htmlentities($row->no_children);?></td>
<td><?php echo htmlentities($row->b_radio);?></td>

</tr>
</table>
<table class="table table-striped table-bordered">
<tr><th colspan="5" class="text-center">Contact Details</th><tr>
<tr>
<th scope="col">Contact Email</th>
<th scope="col">Residential Town</th>
<th scope="col">County</th>
<th scope="col">Country</th>
<th scope="col">Physical address</th>
</tr>

<tr>

<td><?php echo htmlentities($row->con_email);?></td>
<td><?php echo htmlentities($row->town);?></td>
<td><?php echo htmlentities($row->county);?></td>
<td><?php echo htmlentities($row->country);?></td>
<td><?php echo htmlentities($row->p_add);?></td>

</tr>
</table>
<table class="table table-striped table-bordered">
	<tr><th colspan="5" class="text-center">Next of kin Details</th></tr>
<tr>
<th scope="col">Next of Kin:<br>Full Names</th>
<th scope="col">Next of Kin:<br>Occupation</th>
<th scope="col">Next of Kin:<br>Email Address</th>
<th scope="col">Next of Kin:<br>Relationship</th>
<th scope="col">Next of Kin:<br>Contacts</th>
</tr>

<tr>

<td><?php echo htmlentities($row->full_names);?></td>
<td><?php echo htmlentities($row->occupation);?></td>
<td><?php echo htmlentities($row->k_email);?></td>
<td><?php echo htmlentities($row->k_relation);?></td>
<td><?php echo htmlentities($row->p_number);?></td>

</tr>
</table>
<table class="table table-striped table-bordered">
	<tr><th colspan="3" class="text-center">Academic qualification</th></tr>
<tr>
<th scope="col">Institute Attended</th>
<th scope="col">Course Name</th>
<th scope="col">Qualification Attained</th>

</tr>

<tr>

<td><?php echo htmlentities($row->i_name);?></td>
<td><?php echo htmlentities($row->c_name);?></td>
<td><?php echo htmlentities($row->Q_A);?></td>


</tr>
</table>
<table class="table table-striped table-bordered">
<tr><th colspan="3" class="text-center">Personnal Experience</th></tr>
<tr>
<th scope="col">Work Place</th>
<th scope="col">Time spend</th>
<th scope="col">Position Held</th>

</tr>

<tr>

<td><?php echo htmlentities($row->w_name);?></td>
<td><?php echo htmlentities($row->t_period);?></td>
<td><?php echo htmlentities($row->p_held);?></td>


</tr>
</table>
<table class="table table-striped ">
<tr><td colspan="2"><button class="submit action-button"><a href="createpdf.php" target="_blank">download pdf</a></button></td></tr>
</table>
<?php } }
?>
</tbody>
</table>
</form>
</div>
</body>
</html>


