<?php
session_start();
if(!isset($_SESSION['username']) || !isset($_SESSION['logged_in'])){
    header('Location: index.php');
    exit;
}
require_once("dbcontroller.php");
require('fpdf/fpdf.php');
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetLeftMargin(20);
$pdf->SetFont('Arial','',11);
$conn = new mysqli('localhost', 'root', '', 'reg_user');
//Check for connection error
if($conn->connect_error){
  die("Error in DB connection: ".$conn->connect_errno." : ".$conn->connect_error);    
}
// Select data from MySQL database
$select = "SELECT * FROM user where username='".$_SESSION['username'] ."'";
$result = $conn->query($select);

while($row = $result->fetch_object()){
  $s_name = $row->s_name;
  $names = $row->names;
  $email = $row->email;
  $nationality = $row->nationality;
  $dateofbirth= $row->dateofbirth;
  $pdf->Cell(180, 10, 'Your Registration Details for the Course',0, 0, 'C', FALSE);
  $pdf->Ln();
  $pdf->Ln();
  $pdf->Cell(110, 6, 'Personnal Details', 1, 0, 'C', FALSE);
  $pdf->Ln();

  $pdf->cell(50, 10, 'Surname:', 1, 0, 'R', false);
  $pdf->Cell(60,10,$s_name,1);
  $pdf->Ln();
  $pdf->cell(50, 10, 'Othernames:', 1, 0, 'R', false);
  $pdf->Cell(60,10,$names,1);
  $pdf->Ln();
  $pdf->cell(50, 10, 'Personnal email:', 1, 0, 'R', false);
  $pdf->Cell(60,10,$email,1);
  $pdf->Ln();
  $pdf->cell(50, 10, 'Nationality:', 1, 0, 'R', false);
  $pdf->Cell(60,10,$nationality,1);
  $pdf->Ln();
  $pdf->cell(50, 10, 'Date of Birth:', 1, 0, 'R', false);
  $pdf->Cell(60,10,$dateofbirth,1);
  $pdf->Ln();
  $pdf->Ln();
}

$sql = "SELECT * FROM user_reg where username='".$_SESSION['username'] ."'";
$result = $conn->query($sql);

while($row = $result->fetch_object()){
  $b_radio = $row->b_radio;
  $marital = $row->marital;
  $children = $row->children;
  $con_email = $row->con_email;
  $town= $row->town;
  $county= $row->county;
  $country= $row->country;
  $p_add= $row->p_add;
  $full_names= $row->full_names;
  $occupation= $row->occupation;
  $k_email= $row->k_email;
  $k_relation= $row->k_relation;
  $p_number= $row->p_number;
  $i_name= $row->i_name;
  $c_name= $row->c_name;
  $Q_A= $row->Q_A;
  $w_name= $row->w_name;
  $t_period= $row->t_period;
  $p_held= $row->p_held;
  $pdf->Cell(180, 6, 'Personnal Details', 1, 0, 'C', FALSE);
  $pdf->Ln();
 
 $pdf->cell(85, 10, 'Your course selection:', 1, 0, 'C', false);
 $pdf->Cell(95, 10, $b_radio, 1, '', true);
  $x = $pdf->GetX();
  $y = $pdf->GetY();
  $pdf->SetXY($x + 120, $y);  
  
  $pdf->Ln();
  $pdf->Ln();
  $pdf->Cell(180, 6, 'Personnal Details', 1, 0, 'C', FALSE);
  $pdf->Ln();
  $pdf->Cell(45,10, 'Marital_status',1,'C', );
  $pdf->Cell(45,10, 'Children',1);
  $pdf->Cell(45,10, 'Contact Email',1);
  $pdf->Cell(45,10, 'Town of Residence',1);
  
  $pdf->Ln();
  $pdf->Cell(45,10, $marital,1);
  $pdf->Cell(45,10,$children,1);
  
  $pdf->Cell(45,10,$con_email,1);
  
  $pdf->Cell(45,10,$town,1);
  $pdf->Ln();
  $pdf->Cell(60,10, 'County',1);
  $pdf->Cell(60,10, 'Country',1);
  $pdf->Cell(60,10, 'Physical_address',1);
  $pdf->Ln();
  $pdf->Cell(60,10,$county,1);
  
  $pdf->Cell(60,10,$country,1);
  
  $pdf->Cell(60,10,$p_add,1);
  $pdf->Ln();
  $pdf->Ln();
  $pdf->Cell(180, 6, 'Next of Kin Information', 1, 0, 'C', FALSE);
  $pdf->Ln();
  $pdf->Cell(36,10, 'Full Names',1);
  $pdf->Cell(36,10, 'occupation',1);
  $pdf->Cell(36,10, 'Contact Email',1);
  $pdf->Cell(36,10, 'Your Relationship',1);
  $pdf->Cell(36,10, 'Contact',1);
  
  $pdf->Ln();
  $pdf->Cell(36,10,$full_names,1);
  
  $pdf->Cell(36,10,$occupation,1);
  
  $pdf->Cell(36,10,$k_email,1);
  
  $pdf->Cell(36,10,$k_relation,1);
  
  $pdf->Cell(36,10,$p_number,1);
  $pdf->Ln();
  $pdf->Ln();
  $pdf->Cell(180, 6, 'Academic Qualification', 1, 0, 'C', FALSE);
  $pdf->Ln();
  $pdf->Cell(60,10, 'Institution Name',1);
  $pdf->Cell(60,10, 'Course Name',1);
  
  $pdf->Cell(60,10, 'Qualification Attained',1);
 
  $pdf->Ln();
  $pdf->Cell(60,10,$i_name,1);
  
  $pdf->Cell(60,10,$c_name,1);
 
  $pdf->Cell(60,10,$Q_A,1);
  $pdf->Ln();
  $pdf->Ln();
  $pdf->Cell(180, 6, 'Work Experience', 1, 0, 'C', FALSE);
  $pdf->Ln();
  $pdf->Cell(60,10, 'Work PLace Name',1);
  $pdf->Cell(60,10, 'Period',1);
  $pdf->Cell(60,10, 'Position Held',1);
  
  $pdf->Ln();
  $pdf->Cell(60,10,$w_name,1);
  
  $pdf->Cell(60,10,$t_period,1);
  
  $pdf->Cell(60,10,$p_held,1);
 
  
}


$pdf->Output();

?>

