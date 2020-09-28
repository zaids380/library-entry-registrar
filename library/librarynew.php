
 <!DOCTYPE html>
 <html>
 <head>
 	<!-- Bootstrap section -->
 	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bstrp\bootstrap.min.css">
  <script src="bstrp\jquery.min.js"></script>
  <script type="text/javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>
  <script src="bstrp\bootstrap.min.js"></script>




 	<link type="text/css" rel="stylesheet" href="style.css">
 	<link rel="stylesheet" href="fontawesome-free-5.10.2-web/css/all.css">


 	<title>Library system</title>
 		<div class="header">
 			<img src="DBIT_logo.png">
 			<h1>Library Entry Register</h1>
			<form method="post" action="ShowPdf.php"> 			
				<button id="print" name="print">                                                

					<!-- <a href="pdf.php" onClick="window.print(); return false">Print</a>
 -->

					<i class="fa fa-print" aria-hidden="true"></i></button>
			</form>

		</div>

 </head>
 <body>





<?php 
require("pdf.php");
$connect=mysqli_connect("localhost","root","","library_system");
$boolean=false;
$i=0;

date_default_timezone_set('Asia/Kolkata'); 
$date = date('Y/m/d');
$time=date('H:i:s');
$time2=date('17:00:00');

$iderr=$id="";

$pdf=new pdf();

if (isset($_POST['print'])) {
$pdf=new pdf();
}

if(isset($_POST['submit']))
{
	if(empty($_POST['scan']))
	{
		$iderr="required";
	}
	else
	{
		$id=$_POST['scan'];

		$qr="select * from student where stud_id='$id'";
		$rs=mysqli_query($connect,$qr);
		$row=mysqli_fetch_assoc($rs);
			if($row)
			{

			 echo $row['stud_name'];
			 
 				echo "<script>
				$(document).ready(function(){
				$('#myModal').modal('show');
				});</script>"; 
	 
			 

		$query="select * from library where stud_id='$id' AND checked_out='0' AND date='$date'";
		$r=$connect->query($query);
		$row=mysqli_fetch_assoc($r); 
		if(!(is_null($row)))
		{
		$updateCheckedOut="update library set checked_out='$time' where stud_id='$id' AND checked_out='0' AND date='$date'";
		$updateResult=mysqli_query($connect,$updateCheckedOut);
		  // header("Refresh:0"); 
		 
		}
		else
		{
		$insertStudent="insert into library(stud_id,date,checked_in)values('$id','$date','$time')";
		 $res=mysqli_query($connect,$insertStudent);
		  // header("Refresh:0");

 				echo "<script>
				$(document).ready(function(){
				$('#myModal').modal('show');
				});</script>"; 
	 
			 
		}

	}

}	
}


?>


















 	<form method="post" action="Librarynew.php">
 	
 	<div class="input">
<!-- 
 		<script type="text/javascript">
 			// $('[autofocus="yes"], [autofocus="autofocus"], [autofocus="true"]').focus();
 			$( "#Id" ).focus();

 		</script>
 -->
 			<span class="error" style="color: red"><?php echo $iderr;  ?></span>
 	<input id="id" type="text" placeholder="Scanning..." name="scan" maxlength="10" minlength="10" autofocus="true">

 	
 	<button id="submit" name="submit"> 	<i class="fa fa-arrow-left" aria-hidden="true" style="font-size: 23px; margin-right: 5px;"></i></button>
<br>

 				

 	
 	</div>
 </form>	
 	<div class="display">
 	<table class="content">
 	<thead>
  		<tr>
  			<th>srno</th>
 			<th>Id</th>
 			<th>Name</th>
 			<th>Roll No</th>
 			<th>Branch</th>
 			<th>Sem</th>
 			<th>Checked in</th>
 			<th>Checked out</th>
 		</tr>
 
 </thead>

 		<?php 
 			$select="select library.stud_id, stud_name,roll_no,branch,sem,checked_in,checked_out from student,library where checked_out='0' AND student.stud_id=library.stud_id AND date='$date' ORDER BY checked_in DESC;";
			 $selectRes=mysqli_query($connect,$select);


 			while ($row=mysqli_fetch_assoc($selectRes)) {

 				

 				?>

 		<tr id="a">
 				<form></form>
 			<td ><?php echo ++$i ?></td>
 			<td ><?php echo $row['stud_id'] ?></td>
 			<td><?php echo $row['stud_name'] ?></td>
 			<td><?php echo $row['roll_no'] ?></td>
 			<td><?php echo $row['branch'] ?></td>
 			<td><?php echo $row['sem'] ?></td>
 			<td><?php echo $row['checked_in'] ?></td>
 			<td><?php echo $row['checked_out'] ?></td>

 		</tr>



 

<?php }


?>







 	</table>
 	</div>

<div class="container">
  <!-- <h2>Modal Example</h2> -->
  <!-- Trigger the modal with a button -->
<!--   <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
 -->
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog ">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Choose where you want to go </h4>
        </div>
        <div class="modal-body">
          <form>  
  <p id="p1">General Library</p> 
  <input id="input1" type="radio" name="radio1" checked="true">
  <br>
  <br>
  
  <p id="p2">Digital Library</p> 
  <input id="input2" type="radio" name="radio1">
  <br>
  <br>

  <p id="p3">Audio Visual Library</p> 
  <input id="input3" type="radio" name="radio1">
  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>




<!-- 
<script type="text/javascript">
function mod()
{
$(document).ready(function(){
    $('.modal').modal('show');
});
}
</script>
 -->



<style type="text/css">

  


.modal-dialog{
  position: absolute;
  left: 36%;
  top: 18%;
  transform: translate(-18%,-36%);
}
  .close
  {
    width: 30px;
    height: 30px;
    color: #FFF;
  }
.modal-header{
background-color: #001f3a;
color: #fff;
}

.modal-footer
{
background-color: #c0c0c0;
}
.modal-dialog
{
  width: 400px;
  height: 300px;
}

.modal-body{
  padding-left: 30px;
}

.modal-body p
{
  display: inline;
font-size: 20px;
}
.modal-body input[type=radio]{
  width: 16px;
  height: 16px;


}

#input1{
  margin-left: 50px;

}


#input2{
  margin-left: 66px;
}

#input3{
  margin-left: 12px;
}






img{
	position: absolute;
	left: 10%;
	width: 120px;
	height: 120px;
	/*margin-left: 30px;*/
}
#print{
	position: absolute;
	margin-left: 93%;
	margin-top: -2%;
	width: 90px;
	height: 35px;
	background-color:#001f3a;
	border-color: #001f3a;
	color: white;
	border-radius: 20px; 

	font-size: 21px;	
}
h1{
	position: relative;	
	margin-top: 10px;
	margin-right: 60px;
	text-align: center;
	font-size: 40px;
	color: #001f3f ;
	font-weight: bolder;
	font-family: arial black;
	font-style: initial;
}


.input{
padding-left: 35%;
margin-left: 50px;
margin-top: 30px;
position: relative;
}

#id{
width: 240px;
height: 48px;
border-radius: 25px;
font-size: 25px;
padding-left: 30px;
border-top-color: white;
color: #001f3f ;
font-weight: bold;
border-width: 3px;
}
#submit{
	background-color: #001f3f ;
	height: 40px;
	color: white;
	width: 60px;
	border-radius: 20px;
	margin-left: 3px;
	/*border-width: 3px;*/
	margin-top: 2px;
	position: absolute;
	border-color: #001f3f;

}


.display{
	margin-top:20px;
    position: relative;
    left: 10%;
    width: 100%;
	}	

table{

width: 80%;
text-align: center;
border-collapse: collapse;
}

th{
	font-size: 20px;
	height: 48px;
	background-color:#001f3a;
	color:white;
	text-align: center;
}


td{
	color:#001f3f;
	font-weight: bold;
	height: 35px;
	font-size: 18px;
	/*border-bottom: 2px solid #001f3f;*/

	background-color: #f5f3f0;
}


tr:nth-child(even) td {
    background-color: #BFC0C2;
}
tr:last-child{
	border-bottom: 8px solid #001f3a;
}

 </style>



 </body>
 </html>

 