<?php 

include('includes/config.php');
include('includes/config_mysqli.php');
?>
<!DOCTYPE html>
<html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>View Generated PIN</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
        <meta name="author" content="Codrops" />
      <link rel="icon" type="image/png" sizes="16x16" href="../images/logo.jpg">
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
		
		
		
        <style type="text/css">
<!--
.text-center {  text-align: center;
}
.style15 {color: #000000}
.style17 {color: #000000; font-weight: bold; }
.style8 {color: #666666; font-weight: bold; }
-->
        </style>
</head>

<body>

        <div class="container">
            <!-- Codrops top bar -->
            <div class="codrops-top">
                <a href=""></a>
                <span class="right">
                    <a href="#">
                        <strong></strong>                    </a>                </span>
                <div class="clr"></div>
          </div><!--/ Codrops top bar -->
          <header>
                <h1> <span></span></h1>
			<h1><span></span></h1>
				
				
				<h2>&nbsp;</h2>
				<h2>&nbsp;</h2>
				<h2>STOCK IN<span></span></h2>
			<nav class="codrops-demos"></nav>
          </header>
            <section>				
              <div id="container_demo" >
                    <p>
                      <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
                    </p>
                    <p class="style15"><a href="index.php">HOME</a> </p>
                    <p class="style15">&nbsp;</p>
                    <p class="style15">&nbsp;</p>
                    <p class="style15">&nbsp;</p>
                    <table width="851" border="0">
                      <tr>
                        <td width="46"><span class="style17">#</span></td>
                        <td width="163"><span class="style17">PIN</span></td>
                        <td width="182"><span class="style17">Serial No. </span></td>
                        <td width="185"><span class="style17">Status</span></td>
                        <td width="208"><span class="style17">Date &amp; Time Generated </span></td>
                        <td width="41">&nbsp;</td>
                      </tr>
                      <tr>
					  <?php 
                          									  
								$sql="SELECT * from card where status='unused' order by date_time ASC";

											$result = $conn->query($sql);
											$cnt=1;
											 while($row = $result->fetch_assoc()) { 
											 
											
											 ?>
                        <td height="27"><span class="style8 style15"><?php echo $cnt; ?></span></td>
                        <td><span class="style8 style15"><?php echo $row['PIN']; ?></span></td>
                        <td><span class="style8 style15"><?php echo $row['serial_No']; ?></span></td>
                        <td><span class="style8 style15"><?php echo $row['status']; ?></span></td>
                        <td><span class="style8 style15"><?php echo $row['date_time']; ?></span></td>
                        <td>&nbsp;</td>
                      </tr><?php $cnt=$cnt+1; }//} ?>
                    </table>
                    <p class="style15">&nbsp;</p>
                    <p class="style15">&nbsp;</p>
                    <p class="style15">&nbsp;</p>
                    <p class="style15">&nbsp;</p>
                    <p class="style15">&nbsp;</p>
                    <p class="style15">&nbsp;</p>
                    <p class="style15">&nbsp;</p>
                  <p align="center">&nbsp;</p>
                  <table width="0" border="0" align="center">
                    <tr>
                      <td width="134"><a class = "btn btn-success btn-print" href = "" onclick = "window.print()"><i class ="glyphicon glyphicon-print"></i> Print</a></td>
                      <td width="175"><div align="center"><a href="" onclick = "self.close()">Close</a><a href="../logout.php"></a></div></td>
                    </tr>
                  </table>
              </div>  
            </section>
        </div>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
</body>
</html>
