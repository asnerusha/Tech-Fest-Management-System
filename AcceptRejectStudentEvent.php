<?php
	include("../wamp/www/Tech Fest Management System/COLLEGE/..//connection.php");
	session_start();
	$userid=$_SESSION['userid'];
	if($_GET['Accept']!=null)
	{
		mysql_query("update tbl_serequest set status='A' where sereq_id=".$_GET['Accept']);
		header("location:AcceptRejectStudentEvent.php?tfid=".$_GET['tfid']);
	}
	if($_GET['Reject']!=null)
	{
		mysql_query("update tbl_serequest set status='A' where sereq_id=".$_GET['Reject']);
		header("location:AcceptRejectStudentEvent.php?tfid=".$_GET['tfid']);
	}
	
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
<div class="CSSTableGenerator2">
  <table border="1">
    <tr>
      <td colspan="7">Tech Fest Details </td>
    </tr>
    <tr>
      <td height="47">Name</td>
      <td>Title</td>
      <td>Reg From </td>
      <td>Reg To </td>
      <td>TechFest From </td>
      <td>TechFest To </td>
      <td>Send Request </td>
    </tr>
    <?php
		$date=date("Y-m-d");
		$seltech=mysql_query("Select * from tbl_tfreg where tfreg_regsdate<='".$date."' and tfreg_regldate>='".$date."' order by tfreg_regsdate desc");
		while($datatech=mysql_fetch_array($seltech))
		{
	?>
    <tr>
      <td><?php echo $datatech['tfreg_name']; ?></td>
      <td><?php echo $datatech['tfreg_title']; ?></td>
      <td><?php echo $datatech['tfreg_regsdate']; ?></td>
      <td><?php echo $datatech['tfreg_regldate']; ?></td>
      <td><?php echo $datatech['tfreg_tfsdate']; ?></td>
      <td><?php echo $datatech['tfreg_tfldate']; ?></td>
      <td>
        <a href="../wamp/www/Tech Fest Management System/COLLEGE/AcceptRejectStudentEvent.php?tfid=<?php echo $datatech['tfreg_id']; ?>">View Student Request</a>
      </td>
    </tr>
    <?php
	}
	?>
  </table>
  </div>
  <p>&nbsp;</p>
  <?php
  if($_GET['tfid']!=null)
  {
	  ?>
      <div class="CSSTableGenerator2">
  <table width="941" border="1">
    <tr>
      <td colspan="6">PENDING EVENT REQUESTS</td>
    </tr>
    <tr>
      <td>Name</td>
      <td>Address</td>
      <td>Course</td>
      <td>Event Name</td>
      <td>Accept</td>
      <td>Reject</td>
    </tr>
    <?php
		$selStud=mysql_query("SELECT * FROM `tbl_studreg`,tbl_serequest,tbl_eventreg WHERE `college_id`=".$userid." and tbl_studreg.student_id=tbl_serequest.student_id and tfreg_id=".$_GET['tfid']." and tbl_serequest.event_id=tbl_eventreg.event_id and tbl_serequest.status='P'");
		while($dataStud=mysql_fetch_array($selStud))
		{
	?>
    
    <tr>
      <td><?php echo $dataStud['studet_name']; ?></td>
      <td><?php echo $dataStud['student_address']; ?></td>
      <td><?php echo $dataStud['student_course']; ?></td>
      <td><?php echo $dataStud['name']; ?></td>
      <td><a href="../wamp/www/Tech Fest Management System/COLLEGE/AcceptRejectStudentEvent.php?Accept=<?php echo $dataStud['sereq_id']; ?>">Accept</a></td>
      <td><a href="../wamp/www/Tech Fest Management System/COLLEGE/AcceptRejectStudentEvent.php?Reject=<?php echo $dataStud['sereq_id']; ?>">Reject</a></td>
    </tr>
    <?php
		}
		?>
  </table>
  </div>
  <p>&nbsp;  </p>
  <div class="CSSTableGenerator2">
  <table width="941" border="1">
    <tr>
      <td colspan="6">ACCEPTED EVENT REQUESTS</td>
    </tr>
    <tr>
      <td>Name</td>
      <td>Address</td>
      <td>Course</td>
      <td>Event Name</td>
      <td>Accept</td>
      <td>Reject</td>
    </tr>
    <?php
		$selStud=mysql_query("SELECT * FROM `tbl_studreg`,tbl_serequest,tbl_eventreg WHERE `college_id`=".$userid." and tbl_studreg.student_id=tbl_serequest.student_id and tfreg_id=".$_GET['tfid']." and tbl_serequest.event_id=tbl_eventreg.event_id and tbl_serequest.status='A'");
		while($dataStud=mysql_fetch_array($selStud))
		{
	?>
    
    <tr>
      <td><?php echo $dataStud['studet_name']; ?></td>
      <td><?php echo $dataStud['student_address']; ?></td>
      <td><?php echo $dataStud['student_course']; ?></td>
      <td><?php echo $dataStud['name']; ?></td>
      <td><a href="../wamp/www/Tech Fest Management System/COLLEGE/AcceptRejectStudentEvent.php?Accept=<?php echo $dataStud['sereq_id']; ?>">Accept</a></td>
      <td><a href="../wamp/www/Tech Fest Management System/COLLEGE/AcceptRejectStudentEvent.php?Reject=<?php echo $dataStud['sereq_id']; ?>">Reject</a></td>
    </tr>
    <?php
		}
		?>
  </table>
  </div>
  <p>&nbsp;  </p>
  <div class="CSSTableGenerator2">
  <table width="941" border="1">
    <tr>
      <td colspan="6">REJECTED EVENT REQUESTS</td>
    </tr>
    <tr>
      <td>Name</td>
      <td>Address</td>
      <td>Course</td>
      <td>Event Name</td>
      <td>Accept</td>
      <td>Reject</td>
    </tr>
    <?php
		$selStud=mysql_query("SELECT * FROM `tbl_studreg`,tbl_serequest,tbl_eventreg WHERE `college_id`=".$userid." and tbl_studreg.student_id=tbl_serequest.student_id and tfreg_id=".$_GET['tfid']." and tbl_serequest.event_id=tbl_eventreg.event_id and tbl_serequest.status='R'");
		while($dataStud=mysql_fetch_array($selStud))
		{
	?>
    
    <tr>
      <td><?php echo $dataStud['studet_name']; ?></td>
      <td><?php echo $dataStud['student_address']; ?></td>
      <td><?php echo $dataStud['student_course']; ?></td>
      <td><?php echo $dataStud['name']; ?></td>
      <td><a href="../wamp/www/Tech Fest Management System/COLLEGE/AcceptRejectStudentEvent.php?Accept=<?php echo $dataStud['sereq_id']; ?>">Accept</a></td>
      <td><a href="../wamp/www/Tech Fest Management System/COLLEGE/AcceptRejectStudentEvent.php?Reject=<?php echo $dataStud['sereq_id']; ?>">Reject</a></td>
    </tr>
    <?php
		}
		?>
  </table>
  
 
  <?php
  }
  ?>
  </div>
</form>
<p>&nbsp;  </p>
</div>
</body>
</html>
<?php
include("../wamp/www/Tech Fest Management System/COLLEGE/footer.php");
?>
