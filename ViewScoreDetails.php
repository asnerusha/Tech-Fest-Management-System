<?php
	include("../wamp/www/Tech Fest Management System/COLLEGE/..//connection.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="../wamp/www/Tech Fest Management System/mystyle.css" />
<?php
include("../wamp/www/Tech Fest Management System/COLLEGE/header.php");
?>
</head>

<body>
<div align="center">
<form id="form1" name="form1" method="post">
<div class="CSSTableGenerator">
  <table border="1">
    <tr align="center">
      <td colspan="6">Tech Fest Details</td>
    </tr>
    <tr>
      <td>Tech Fest Name</td>
      <td>Starting Date</td>
      <td>Ending Date</td>
      <td>Registration Starting Date</td>
      <td>Registration Ending Date</td>
      <td>View Score </td>
    </tr>
    <?php
  	$date=date('Y-m-d');
	$sel=mysql_query("select * from tbl_tfreg where tfreg_tfldate<='" .$date."' order by tfreg_tfsdate desc");
	while($data=mysql_fetch_array($sel))
	{
  
  ?>
    <tr>
      <td><?php echo $data['tfreg_name'];?></td>
      <td><?php echo $data['tfreg_tfsdate'];?></td>
      <td><?php echo $data['tfreg_tfldate'];?></td>
      <td><?php echo $data['tfreg_regsdate'];?></td>
      <td><?php echo $data['tfreg_regldate'];?></td>
      <td><a href="../wamp/www/Tech Fest Management System/COLLEGE/ViewScoreDetails1.php?TFId=<?php echo $data['tfreg_id'];?>">View Score</a></td>
    </tr>
    <?php
	}
	?>
  </table>
  </div>
  <p>&nbsp;  </p>
</form>
</div>
</body>
</html>
<?php
include("../wamp/www/Tech Fest Management System/COLLEGE/footer.php");
?>
