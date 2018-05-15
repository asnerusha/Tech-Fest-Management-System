<?php
	include("../wamp/www/Tech Fest Management System/ADMIN/..//connection.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="../wamp/www/Tech Fest Management System/mystyle.css" />
<?php
include("../wamp/www/Tech Fest Management System/ADMIN/header.php");
?>
</head>

<body>
<div align="center">
<form id="form1" name="form1" method="post">
<div class="CSSTableGenerator2">
  <table width="903" border="1">
    <tr>
      <td colspan="4">Feedback Details</td>
    </tr>
    <tr>
      <th width="206">User</th>
      <th width="81">Date</th>
      <th width="81">Time</th>
      <th width="507">Feedback</th>
    </tr>
    <?php
		$selFeed=mysql_query("SELECT * FROM `tbl_feed`,tbl_guser where tbl_guser.guser_id=tbl_feed.guser_id order by `date` desc");
		while($dataFeed=mysql_fetch_array($selFeed))
		{
			?>
    <tr>
      <td><?php echo $dataFeed['guser_name']; ?></td>
      <td><?php echo $dataFeed['date']; ?></td>
      <td><?php echo $dataFeed['time']; ?></td>
      <td><?php echo $dataFeed['feedback']; ?></td>
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
include("../wamp/www/Tech Fest Management System/ADMIN/footer.php");
?>
