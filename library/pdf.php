<?php 
require('fpdf.php');


	date_default_timezone_set("Asia/Kolkata");
		

class pdf extends fpdf
{	

	function Header()
	{
	
		$date=date("Y-m-d");
		$this->image("DBIT_logo.png",10,5,25);
	    $this->setfont("arial",'B',20);
	    $this->SetTextColor(1, 27, 69);
	    $this->cell(180,25,"Students details",0,0,'C');
	    $this->setfont("arial",'B',10);
	    $this->cell(1,10,$date,0,0,'C');
	    $this->Ln(20);
	    $this->setfont("arial",'B',15);
		$this->setfillcolor(1, 27, 69);
		$this->setdrawcolor(255,255,255);
		$this->SetTextColor(255,255,255);

		$this->setfont("arial",'B','15');
		$this->cell(25,7,"Id",1,0,'C',true);
		// $this->cell(13,7,"roll",1,0,'C',true);
	    $this->cell(70,7,"Name",1,0,'C',true);
	    $this->cell(25,7,"Branch",1,0,'C',true);
		$this->cell(25,7,"Semester",1,0,'C',true);
		$this->cell(20,7,"in",1,0,'C',true);
		$this->cell(20,7,"out",1,1,'C',true);


		$conn=mysqli_connect("localhost","root","","library_system");
		$date=date("Y-m-d");
		$s="select library.stud_id, stud_firstname,branch,semester,checked_in,checked_out from student1,library where  student1.stud_id=library.stud_id AND date='$date order by checked_in'";
		$r=mysqli_query($conn,$s);

		while ($row=mysqli_fetch_assoc($r)) {

		$this->setdrawcolor(0,0,0);
		$this->SetTextColor(0,0,0);
		$this->setfillcolor(255,255,255);
		$this->setfont("arial",'','8');
		
		$this->cell(25,5,$row['stud_id'],1,0,'C',true);
		// $this->cell(13,5,$row['roll_no'],1,0,'C',true);
	    $this->cell(70,5,$row['stud_firstname'],1,0,'C',true);
	    $this->cell(25,5,$row['branch'],1,0,'C',true);
		$this->cell(25,5,$row['semester'],1,0,'C',true);
		$this->cell(20,5,$row['checked_in'],1,0,'C',true);
		$this->cell(20,5,$row['checked_out'],1,1,'C',true);
	}

	}
	function Footer()
	{
		$this->sety(-15);
		$this->setfont("arial",'I','8');
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}


}
$pdf=new pdf();
$pdf->AddPage();
$pdf->AliasNbPages();
$date=date("d-m-Y");
$filename='C:\Users\Zaid\Desktop\pdfs\\'.$date.'.pdf';
 $pdf->output('F',$filename,true);
// $pdf->output(/*'F',$filename,true*/);

 ?>
