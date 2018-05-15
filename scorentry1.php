<?php
	include("../wamp/www/Tech Fest Management System/EVENTHEAD/..//connection.php");
	if($_GET['SERId']!=null)
	{
		$selSER=mysql_query("SELECT * FROM `tbl_serequest`,tbl_studreg,tbl_eventreg,tbl_tfreg,tbl_creg WHERE `sereq_id`=".$_GET['SERId']." and tbl_serequest.tfreg_id=tbl_tfreg.tfreg_id and tbl_serequest.event_id=tbl_eventreg.event_id and tbl_serequest.student_id=tbl_studreg.student_id and tbl_studreg.college_id=tbl_creg.college_id");
		if($dataSER=mysql_fetch_array($selSER))
		{
			$eventname=$dataSER['name'];
			$studname=$dataSER['studet_name'];
			$address=$dataSER['student_address'];
			$course=$dataSER['student_course'];
			$contact=$dataSER['student_contactno'];
			$college=$dataSER['c_name'];
			
		}
	}
	if(isset($_POST['btnSubmit']))
	{
		$serid=$_GET['SERId'];
		$score=$_POST['txtScore'];
		mysql_query("insert into `tbl_score` (`sereq_id`,`score`)values(".$serid.",".$score.")");
		header("location:scorentry1.php?TFId=".$_GET['TFId']."&EId=".$_GET['EId']);
		
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="../wamp/www/Tech Fest Management System/mystyle.css" />
<?php
include("../wamp/www/Tech Fest Management System/EVENTHEAD/header.php");
?>
</head>

<body>
<div align="center">
<form id="form1" name="form1" method="post">

   <div class="CSSTableGenerator2">
    <table width="595" border="1">
      <tr>
        <td width="125">Event Name</td>
        <td width="454"><?php echo $eventname; ?></td>
      </tr>
      <tr>
        <td>Student Name</td>
        <td><?php echo $studname; ?></td>
      </tr>
      <tr>
        <td>Address</td>
        <td><?php echo $address; ?></td>
      </tr>
      <tr>
        <td>Course</td>
        <td><?php echo $course; ?></td>
      </tr>
      <tr>
        <td>Contact No</td>
        <td><?php echo $contact; ?></td>
      </tr>
      <tr>
        <td>College</td>
        <td><?php echo $college; ?></td>
      </tr>
      <tr>
        <td>Score</td>
        <td><input type="text" name="txtScore" id="txtScore" required></td>
      </tr>
      <tr>
        <td colspan="2"><div align="right">
          <input type="submit" name="btnSubmit" id="btnSubmit" value="Submit">
        </div></td>
      </tr>
    </table>
    </div>
    <p>&nbsp;</p>
 
      <?php
	if($_GET['EId']!=null&&$_GET['TFId']!=null)
	{
?>
      
 <div class="CSSTableGenerator2"> 
  <table width="943" border="1">
    <tr>
      <td colspan="6">Students Details</td>
    </tr>
    <tr>
      <td width="160">Name</td>
      <td width="159">Address</td>
      <td width="161">Course</td>
      <td width="129">Contact No</td>
      <td width="204">College</td>
      <td width="90">Score Entry</td>
    </tr>
    <?php
	
		$selSE=mysql_query("SELECT * FROM `tbl_serequest`,tbl_creg,tbl_studreg WHERE `tfreg_id`=".$_GET['TFId']." and `event_id`=".$_GET['EId']." and tbl_serequest.student_id=tbl_studreg.student_id and  tbl_studreg.college_id=tbl_creg.college_id");
		while($dataSE=mysql_fetch_array($selSE))
		{
	?>
    <tr>
      <td><?php echo $dataSE['studet_name']; ?></td>
      <td><?php echo $dataSE['student_address']; ?></td>
      <td><?php echo $dataSE['student_course']; ?></td>
      <td><?php echo $dataSE['student_contactno']; ?></td>
      <td><?php echo $dataSE['c_name']; ?></td>
      <td>
      <?php
	  	$selScore=mysql_query("select * from tbl_score where sereq_id=".$dataSE['sereq_id']);
		if($dataScore=mysql_fetch_array($selScore))
		{
			echo $dataScore['score'];
		}
		else
		{
	  ?>	
      <a href="../wamp/www/Tech Fest Management System/EVENTHEAD/scorentry1.php?SERId=<?php echo $dataSE['sereq_id']; ?>&EId=<?php echo $_GET['EId']; ?>&TFId=<?php echo $_GET['TFId']; ?>">Score Entry</a>
	  <?php
		}
		?></td>
    </tr>
    <?php
		}
		?>
  </table>
  <?php
	}
	?>
    </div>
  <p>&nbsp;</p>
  <div class="CSSTableGenerator2">
  <table border="1">
  <tr>
  <td colspan="4">Event Details</td>
  </tr>
    <tr>
      <td width="121">Event Name</td>
      <td width="120">Description</td>
      <td width="115">No Of Students</td>
      <td width="66">View Students</td>
    </tr>
    <?php
		if($_GET['TFId']!=null)
		{
			
		$selevent=mysql_query("select * from tbl_tfevent,tbl_eventreg where tbl_tfevent.event_id=tbl_eventreg.event_id and tbl_tfevent.tfreg_id=".$_GET['TFId']);
		while($dataevent=mysql_fetch_array($selevent))
		{
	?>
    <tr>
      <td><?php echo $dataevent['name']; ?></td>
      <td><?php echo $dataevent['des']; ?></td>
      <td><?php echo $dataevent['nostudent']; ?></td>
      <td><a href="../wamp/www/Tech Fest Management System/EVENTHEAD/scorentry1.php?EId=<?php echo $dataevent['event_id']; ?>&TFId=<?php echo $dataevent['tfreg_id']; ?>">View Students</a></td>
    </tr>
    <?php
	}
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
include("../wamp/www/Tech Fest Management System/EVENTHEAD/footer.php");
?>
