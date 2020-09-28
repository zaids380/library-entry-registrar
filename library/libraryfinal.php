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
 	<link rel="stylesheet" href="Fontawesome\css\all.css">


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
require("pdf2.php");
$connect=mysqli_connect("localhost","id11804649_zaid","123456","id11804649_library_system");
$boolean=false;
$i=0;
// $id=0;
date_default_timezone_set('Asia/Kolkata'); 
$date = date('Y/m/d');
$time=date('H:i:s');
$time2=date('17:00:00');
$iderr="";
$pdf=new pdf();

$id=0;
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
		

	}

	$qr="select * from student1 where stud_id='$id'";
	$rs=mysqli_query($connect,$qr);
	$row=mysqli_fetch_assoc($rs);
		if($row)
		{
		 $modalname=$row['stud_firstname'];

		 	$query="select * from library where stud_id='$id' AND checked_out='0' AND date='$date'";
			$r=$connect->query($query);
			$row=mysqli_fetch_assoc($r); 
					if(!(is_null($row)))
					{
							$updateCheckedOut="update library set checked_out='$time' where stud_id='$id' AND checked_out='0' AND date='$date'";
							$updateResult=mysqli_query($connect,$updateCheckedOut);
				  			 //header("Refresh:0"); 
			 
					}
					else
					{

						echo "<script>
   							 $(document).ready(function(){
							 $('#myModal').modal('show');
							 });</script>"; 	 

		}  

				
	}
	else
	{
						echo "<script>
   							 $(document).ready(function(){
							 $('#errormodal').modal('show');
							 });</script>"; 	 

	}

}	 

 ?>

 	<form method="post" action="libraryfinal.php">
 	
 	<div class="input">
 			<span class="error" style="color: red"><?php echo $iderr;  ?></span>
 	<input id="id" type="text" placeholder="Scanning..." name="scan" maxlength="10" minlength="10" autofocus="true">

 	
 	<button id="submit" name="submit"> 	<i class="fa fa-arrow-left" aria-hidden="true" style="font-size: 23px; margin-right: 5px;"></i></button>
<br>

 				

 	
 	</div>
 </form>	
 	
<div class="container">
  
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog ">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <div class="headercont">

	          	 <p id="x1"><?php echo $modalname ?></p>
            <!-- <button type="button" id="closebtn" class="close" data-dismiss="modal">&times;</button> -->
          </div>
          <p id="x2">Choose where you want to go</p>
        </div>

       
        <div class="modal-body">


     <form method="post" action="insert.php">        
  <p id="p1">General Library</p> 
  <input id="input1" type="radio" name="radio1" value="General" checked="true">
  <br>
  <br>
  
  <p id="p2">Digital Library</p> 
  <input id="input2" type="radio" name="radio1" value="Digital">
  <br>
  <br>

  <p id="p3">Audio Visual Library</p> 
  <input id="input3" type="radio" name="radio1" value="Audio Visual">
  
        </div>
        <div class="modal-footer">
        	<button id="subm" name="modalsubmit" class="btn btn-primary">submit</button>
            <!-- <button type="button"  class="btn btn-default" data-dismiss="modal">Close</button> -->

        </div>
		    
		    <input type="hidden" id="xy" name="id" value=<?php echo($id) ?> >
		    <input type="hidden" name="date" value=<?php echo($date) ?> >
		    <input type="hidden" name="checked_in" value=<?php echo($time) ?> >
		             
         </form>


 
      </div>
     
    </div>
  </div>
  
</div>

<script type="text/javascript">

$('#myModal').on('shown.bs.modal', function(e){
    $('#input1').focus();
});

$('#myModal').on('hidden.bs.modal', function(e){
   $("#id").focus();
});
</script>

<!-- modal 2 -->




<div class="container">

  <div class="modal fade" id="errormodal" role="dialog">
    <div class="modal-dialog ">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title" style="text-align: center;"> <?php echo($id) ?></h3>
        </div>
        <div class="modal-body">
        	<span><i class="fa fa-exclamation-large" aria-hidden="true"></i></span>
        	<h4 style="text-align: center; font-weight: bold;">May be you entered wrong id </h4>
      		<h5 style="text-align: center; font-weight: bold;">OR</h5>
        	<h4 style="text-align: center; font-weight: bold;">You are not registered with the system</h4>
        	<h3 style="text-align: center; font-weight: bold;">Contact Librarian</h3>

        </div>

                <div class="modal-footer">

            <button type="button" id="close"  class="btn btn-default" data-dismiss="modal">Close</button>

        </div>

      </div>
      
    </div>
  </div>
  
</div>
<script type="text/javascript">

	$('#errormodal').on('hidden.bs.modal', function(e){
   	$("#id").focus();
	});

	$('#errormodal').on('shown.bs.modal', function(e){

		$("#close").focus();
	})

</script>





<!-- end modal 2-->














 	<div class="display">
 	<table class="content">
 	<thead>
  		<tr>
  			<th>srno</th>
 			<th>Id</th>
 			<th>Name</th>
 			<!-- <th>Roll No</th> -->
 			<th>Branch</th>
 			<th>Sem</th>
 			<th>Checked in</th>
 			<th>Checked out</th>
 		</tr>
 
 </thead>

 		<?php 
 			$select="select library.stud_id, stud_firstname,branch,semester,checked_in,checked_out from student1,library where checked_out='0' AND student1.stud_id=library.stud_id AND date='$date' ORDER BY checked_in DESC;";
			 $selectRes=mysqli_query($connect,$select);


 			while ($row=mysqli_fetch_assoc($selectRes)) {

 				

 				?>

 		<tr id="a">
 				<form></form>
 			<td ><?php echo ++$i ?></td>
 			<td ><?php echo $row['stud_id'] ?></td>
 			<td><?php echo $row['stud_firstname'] ?></td>
 			<!-- <td><?php echo $row['roll_no'] ?></td> -->
 			<td><?php echo $row['branch'] ?></td>
 			<td><?php echo $row['semester'] ?></td>
 			<td><?php echo $row['checked_in'] ?></td>
 			<td><?php echo $row['checked_out'] ?></td>

 		</tr>



 

<?php }


?>

 	</table>
 	</div>




<style type="text/css">

  

.headercont
{
	position: relative;
}
.headercont #x1{
	position: absolute;
	top: 0%;
	left: 35%;
	font-size: 23px;


}

.headercont #closebtn{
	position: absolute;
	top: 0%;
	left: 98%;


}
#x2{
	position: absolute;
	top:55%;
	left:20%;
	font-size: 15px;
}


.modal-dialog{
  position: absolute;
  left: 36%;
  top: 18%;
  transform: translate(-18%,-36%);

}
  .close
  {
  	font-size: 27px;
  	color: white;
  }
.modal-header{
background-color: #001f3a;
color: #fff;
padding-top: 5px;
position: relative;
height: 70px;

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
	font-size: 22px;
	height: 48px;
	background-color:#001f3a;
	color:white;
	text-align: center;
	padding-top: 10px;
}


td{
	color:#001f3f;
	font-weight: bold;
	height: 35px;
	font-size: 16px;
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

 