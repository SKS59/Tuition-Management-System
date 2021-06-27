
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="studpdf.css">
    <link rel="stylesheet" type="text/css" href="bg.css">
    <title>Search Student</title>

    
</head>
<body>
   <center>
       <h1>Get Receipt of Student by using  ID</h1>
       <form action="" method="POST">
           <input type="number" name="Student_id" placeholder="Enter ID to search"><br>
           <input type="submit" name="search" value="Search data">
              <br>
              <br><br>
	<center><a href="home.html"  style="text-decoration:none;background:whitesmoke" class="btn btn-primary"><strong>BACK</strong></a></center> 
    <br><br><br><br><br><br><br><br>  
    </form>
    </center>
    <?php
      

    ob_start();
    $Student_name = $Phone_no = $Address = $Enroll_date =$Level_iname=$Subjects_name=$Payment_amt="";
    $Payment_date="";
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=tm2", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        if(isset($_POST['search']))
        {
            $id=$_POST['Student_id'];

            $sql= "SELECT a.Student_id,a.Student_name,c.Level_iname,c.Subjects_name,d.Payment_id,d.Payment_amt,d.Payment_date,d.Fees_Remaining,b.image
                FROM Students a
                        INNER JOIN Enroll b
                            ON b.Student_id=a.Student_id
                        INNER JOIN Subjects c
                            ON c.Subject_id=b.Subject_id
                        INNER JOIN Payment d
                            ON d.Payment_id = b.Payment_id

                            Where a.Student_id='$id'";
            $obj=$conn->prepare($sql);
            $obj->execute();
            $r=$obj->rowCount();  
            if($r>0)
            {
                
                while($rows=$obj->fetch(PDO::FETCH_ASSOC))
                {
                   
//nav pay id st id py amt level sub pay date



                    $Student_name=$rows['Student_name'];
                    $Payment_id=$rows['Payment_id'];
                    $Student_id=$rows['Student_id'];
                    $Subjects_name=$rows['Subjects_name'];
                    $Level_iname=$rows['Level_iname'];
                    $Payment_amt=$rows['Payment_amt'];
                    $Payment_date=$rows['Payment_date'];
                    $Fees_Remaining=$rows['Fees_Remaining'];
                    $imgpath='images/'.$rows['image'];
                    ob_start();
                    require("fpdf/fpdf.php");
                    $pdf=new FPDF();
                    header('Content-type: application/pdf');
                    $pdf->AddPage();
                    
                    $pdf->SetFont("Arial","B",18);
                    $pdf->Cell(0,15,"WISDOM ACADEMY",1,1,"C");

                    $pdf->SetFont("Arial","B",12);
                    
                    $pdf->Cell(0,15,"FEE RECEIPT",0,1,"C");

                    //$pdf->Image($imgpath,160,35,30,30);

                    $pdf->SetFont("Arial","",12);
                    $pdf->Cell(40,10,"Student Name : ",0,0,"");
                    $pdf->Cell(20,10,$Student_name,0,1,"");

                    $pdf->Cell(40,10,"Payment ID : ",0,0,"");
                    $pdf->Cell(20,10,$Payment_id,0,1,"");
                    
                    $pdf->Cell(40,10,"Student ID : ",0,0,"");
                    $pdf->Cell(40,10,$Student_id,0,1,"");  

                    $pdf->Cell(40,10,"Subject Name : ",0,0,"");
                    $pdf->Cell(20,10,$Subjects_name,0,1,"");

                    $pdf->Cell(40,10,"Level : ",0,0,"");
                    $pdf->Cell(20,10,$Level_iname,0,1,"");

                    $pdf->Cell(40,10,"Payment amount : ",0,0,"");
                    $pdf->Cell(20,10,$Payment_amt,0,1,"");

                    $pdf->Cell(40,10,"Payment remaining : ",0,0,"");
                    $pdf->Cell(20,10,$Fees_Remaining,0,1,"");

                    $pdf->Cell(40,10,"Payment Date : ",0,0,"");
                    $pdf->Cell(20,10,$Payment_date,0,1,"");
                    ob_get_clean();
                    $pdf->output();

                    ob_end_flush();   
                }
            }
            else{
                ?>
                <script>alert("NO ENTRY FOUND!!!")</script>;
                <?php
            }
        }

            
    } 
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>

</body>
</html>


