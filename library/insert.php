<?php 
$connect=mysqli_connect("localhost","id11804649_zaid","123456","id11804649_library_system");

if (isset($_POST['modalsubmit'])) {

$value=$_POST['radio1'];
$id=$_POST['id'];
$date=$_POST['date'];
$checked_in=$_POST['checked_in'];

$insertStudent="insert into library(stud_id,selectedlibrary,date,checked_in)values('$id','$value','$date','$checked_in')";
						$res=mysqli_query($connect,$insertStudent);
//if (!$res) {
	//echo("inserted");
// 	# code...
 //}
 
header('location:libraryfinal.php');

}




 ?>