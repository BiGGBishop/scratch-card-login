<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/config_mysqli.php');



if(isset($_POST['btngenerate']))
{
function str_rand(){
$largura=$_POST['txtlength'];
								
        $chars = str_shuffle('01234567890123456789012345678901234567890123456789012345678909');
        // separar a string acima com uma virgula após cada letra ou número;
        $chars = preg_replace("/([0-9])/i", "$1,", $chars);
        $chars = explode(',', $chars);

 
        $string_generate = array();
		
        for($i = 0; $i < $largura; $i++){
            // $chars[random_int(0, 61) = largura da array $chars
				
            array_push($string_generate, $chars[random_int(0, 61)]);
        }
        $string_ready = str_shuffle(implode($string_generate));
      
        for($i = 0; $i < random_int(256,512); $i++){
            $random_string = str_shuffle($string_ready);
        }
        // se a largura for um número par o numero de caracteres da string for maior ou igual a 4
        if($largura % 2 === 0 && strlen($random_string) >= 4){
            $random_string_start = str_shuffle(substr($random_string, 0, $largura / 2));
            $random_string_end = str_shuffle(substr($random_string, $largura / 2, $largura));
            $new_random_string = str_shuffle($random_string_start . $random_string_end);
            return str_shuffle($new_random_string);
        }
        else {
            return str_shuffle($random_string);
        }
    }

}
?>


<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Generate PIN here</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- partial:index.partial.html -->
<div class="wrapper">
	<div class="container">
		<h2>ONLINE RESULT CHECKER | ADMIN</h2>
		<?php //} 
 if($error){?>
                                        
                                            <?php //echo htmlentities($error); ?>
										<?php	echo '<div class="am-flash-content-error"><font color=red>'.$error.'</font></div>';?>
                                       
                                        <?php } ?>
		<form class="form" method="post">
			<input type="text" name="txtlength" value="15" placeholder="Length of PIN">
			<input type="text" name="txtnumber" value="<?php if(isset($_POST['txtnumber']))echo $_POST['txtnumber']; ?>" placeholder="NO. of PIN">
			
			<button type="submit" name="btngenerate" id="">Generate</button>
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
<!-- partial -->
  <script src='jsx/jquery.min.js'></script>
<script  src="jsx/script.js"></script>

</body>
</html>
 <?php     
								

$n=$_POST['txtnumber'] ;
$string_generate = [];
$string_generate2 = []; 
for($ii = 1;$ii < $n +1; $ii++) { 
$string_generate=	str_rand();
$string_generate2=	str_rand();
//echo $string_generate . "-PIN,";
//echo $string_generate2 . "-S NO,";
								
								
//$batch=rand();
$date=date('Y-m-d H:i:s');
$pin[$ii]=$string_generate;
$str[$ii]=$string_generate2;

$status="unused";
$sql="INSERT INTO card(PIN,serial_No,status,date_time) VALUES(:pin,:serial,:status,:date)";
$query = $dbh->prepare($sql);
$query->bindParam(':pin',$pin[$ii],PDO::PARAM_STR);
$query->bindParam(':serial',$str[$ii],PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':date',$date,PDO::PARAM_STR);

$query->execute();
$lastInsertId = $dbh->lastInsertId();	
if($lastInsertId !== false)
{

?>
<script>
alert("PIN generated Successfully");
window.location = "view-pin.php";
</script>
<?php
}
}			
												
?>
                 