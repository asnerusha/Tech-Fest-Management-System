<?php
	include("../wamp/www/Tech Fest Management System/STUDENT/..//connection.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="../wamp/www/Tech Fest Management System/mystyle.css" />
<?php
include("../wamp/www/Tech Fest Management System/STUDENT/header.php");
?>
</head>
<body>
<div align="center">
<form id="form1" name="form1" method="post">
<div class="CSSTableGenerator2">
  <table width="840" border="1">
    <tr>
      <td colspan="4">Notification</td>
    </tr>
    <tr>
      <td>Event Head</td>
      <td>Date</td>
      <td>Time</td>
      <td>Notification</td>
    </tr>
    <?php
		$selNoti=mysql_query("SELECT * FROM `tbl_note`,tbl_ehreg WHERE tbl_note.head_id=tbl_ehreg.head_id");
		while($dataNoti=mysql_fetch_array($selNoti))
		{
	?>
    <tr>
      <td><?php echo $dataNoti['head_name']; ?></td>
      <td><?php echo $dataNoti['date']; ?></td>
      <td><?php echo $dataNoti['time']; ?></td>
      <td><?php echo $dataNoti['notification']; ?></td>
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
include("../wamp/www/Tech Fest Management System/STUDENT/footer.php");
?>
