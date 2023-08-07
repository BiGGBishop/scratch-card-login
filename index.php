<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/config_mysqli.php');



if(isset($_POST['btnlogin']))
{
$PIN=$_POST['txtpin'];
$serial_No=($_POST['txtserialno']);
$admission_no=($_POST['txtadmission_no']);

//Get First Date and time card was used
$stmt = $dbh->prepare('SELECT * FROM validate WHERE PIN = ? ORDER BY date_time LIMIT 1');
$stmt->execute(array($PIN));
$row = $stmt->fetch();
$_SESSION['date']=$row['date_time'];

date_default_timezone_set(Africa/lagos);
$date = date('Y-m-d H:i:s');

$startdate = $_SESSION['date'];
$expire = strtotime($startdate. ' + 365 days');
$today = strtotime($date);

if($today > $expire){
   ?>
<script>
alert("Scratch card Has Expired");
window.location = "index.php";
</script>
<?php
} else {
   

//validate the Card
$sql ="SELECT * FROM card WHERE PIN=:PIN and serial_No=:serial_No";
$query= $dbh -> prepare($sql);
$query-> bindParam(':PIN', $PIN, PDO::PARAM_STR);
$query-> bindParam(':serial_No', $serial_No, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{

//update Card status
$q1="UPDATE `card` SET `status`='used' WHERE `PIN`= '$PIN'";
$conn->query($q1);
//insert to validate Next time


$sql="INSERT INTO validate(PIN,serial_No,admin_no,date_time) VALUES(:PIN,:serial_No,:admin_no,:date_time)";
$query = $dbh->prepare($sql);
$query->bindParam(':PIN',$PIN,PDO::PARAM_STR);
$query->bindParam(':serial_No',$serial_No,PDO::PARAM_STR);
$query->bindParam(':admin_no',$admission_no,PDO::PARAM_STR);
$query->bindParam(':date_time',$date,PDO::PARAM_STR);
$query->execute();

$_SESSION['PIN']=$_POST['txtpin'];
echo "<script type='text/javascript'> document.location = 'printout.php'; </script>";
} else{
    
  
$error="Incorrect PIN or Serial No.";
}
}
}
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>SCRATCH CARD LOGIN SYSTEM</title>
  <link rel="stylesheet" href="css/style.css">
  <style type="text/css">
<!--
.style1 {color: #000000}
.style3 {font-size: 36px}
.style4 {color: #000000; font-size: 36px; }
-->
  </style>
</head>
<body>
<p class="style1">
  <!-- partial:index.partial.html -->

</p>
<div class="wrapper style1">
	<div class="container">
		<h2>ONLINE RESULT CHECKER | ADMIN</h2>
		<?php //} 
 if($error){?>
                                        
                                            <?php //echo htmlentities($error); ?>
										<?php	echo '<div class="am-flash-content-error"><font color=red>'.$error.'</font></div>';?>
                                       
                                        <?php } ?>
		<form class="form" method="post">
			<input type="text" name="txtpin" placeholder="PIN">
			<input type="text" name="txtserialno" placeholder="Serial NO">
				<input type="text" name="txtadmission_no" placeholder="ADMISSION NO">
			<button type="submit" name="btnlogin" id="">Check</button>
		</form>
	</div>
	
	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>
<div align="center"><span class="style1">
  <!-- partial -->
  <script src='jsx/jquery.min.js'></script>
  <span class="style3"><strong><a href="generatepin.php">GENERATE PIN</a></strong> 
  <a href="generatepin.php">
  <script  src="jsx/script.js"></script>
  </a></span></span><span class="style4">| <a href="view-pin.php">View PIN </a></span></div>
</body>
</html>