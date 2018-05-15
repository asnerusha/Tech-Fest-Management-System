<?php
	include("../wamp/www/Tech Fest Management System/ADMIN/..//connection.php");
	if($_GET['TFId']!=null&&$_GET['PId']!=null)
	{
		$seltfreg=mysql_query("SELECT * FROM `tbl_tfreg` WHERE `tfreg_id`=".$_GET['TFId']);
		if($datatfreg=mysql_fetch_array($seltfreg))
		{
			$tfname=$datatfreg['tfreg_name'];
		}
		$selEvents=mysql_query("SELECT * FROM `tbl_prize`,tbl_tfevent,tbl_eventreg WHERE `prize_id`=".$_GET['PId']." and tfreg_id=".$_GET['TFId']." and tbl_tfevent.event_id=tbl_prize.event_id and tbl_prize.event_id=tbl_eventreg.event_id");
		if($dataEvents=mysql_fetch_array($selEvents))
		{
			$eventname=$dataEvents['name'];
			$prizecat=$dataEvents['prize_cat'];
			$prize=$dataEvents['prize_name'];
		}
	}
	if($_GET['View']!=null)
	{
		$sponserid=$_GET['View'];
		$selSponser=mysql_query("SELECT * FROM `tbl_sponser1` WHERE `sponser_id`=".$sponserid);
		if($dataSponser=mysql_fetch_array($selSponser))
		{
			$edsponser=$dataSponser['sponser_name'];
			$edemail=$dataSponser['sponser_email'];
			$edcompany=$dataSponser['sponser_company'];
			$edcontact=$dataSponser['sponser_contactno'];
		}
	}
	if(isset($_POST['btnSubmit']))
	{
		if($_GET['TFId']!=null&&$_GET['PId']!=null)
		{
			$tfregid=$_GET['TFId'];
			$prizeid=$_GET['PId'];
			$sponser=$_POST['txtSponser'];
			$email=$_POST['txtEmail'];
			$company=$_POST['txtCompany'];
			$contact=$_POST['txtContact'];
			if($_GET['View']!=null)
			{
				mysql_query("update tbl_sponser1 set tfreg_id=".$tfregid.",sponser_name='".$sponser."',sponser_email='".$email."',sponser_company='".$sponser."',sponser_contactno='".$contact."',prize_id=".$prizeid." where sponser_id=".$_GET['View']);				 	
			}
			else
			{	
					
			mysql_query("insert into `tbl_sponser1` (`tfreg_id`,`sponser_name`,`sponser_email`,`sponser_company`,`sponser_contactno`,`prize_id`) values(".$tfregid.",'".$sponser."','".$email."','".$company."','".$contact."',".$prizeid.")");
			}
			header("location:Sponsers.php?TFId=".$tfregid);
		}
	}
	
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
  <table width="724" border="1">
    <tr>
      <td width="195">Tech Fest Name</td>
      <td width="513"><?php echo $tfname; ?></td>
    </tr>
    <tr>
      <td>Event Name</td>
      <td><?php echo $eventname; ?></td>
    </tr>
    <tr>
      <td>Prize Category</td>
      <td><?php echo $prizecat; ?></td>
    </tr>
    <tr>
      <td>Prize</td>
      <td><?php echo $prize; ?></td>
    </tr>
    <tr>
      <td>Sponser Name</td>
      <td><input name="txtSponser" type="text" id="txtSponser" size="50" value="<?php echo $edsponser; ?>" required></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><input name="txtEmail" type="email" id="txtEmail" size="50" value="<?php echo $edemail; ?>" required></td>
    </tr>
    <tr>
      <td>Company</td>
      <td><input name="txtCompany" type="text" id="txtCompany" size="50" value="<?php echo $edcompany; ?>" required></td>
    </tr>
    <tr>
      <td>Contact No</td>
      <td><input name="txtContact" type="tele" pattern="[789][0-9]{9}" id="txtContact" size="50" value="<?php echo $edcontact; ?>" required></td>
    </tr>
    <tr>
      <td colspan="2"><div align="right">
        <input type="submit" name="btnSubmit" id="btnSubmit" value="Submit">
      </div></td>
    </tr>
  </table>
  </div>
  <p>&nbsp;</p>
  <div class="CSSTableGenerator2">
  <table width="731" border="1">
  	<tr><td colspan="4">Prize Details</td></tr>
    <tr>
      <td width="194">Event Name</td>
      <td width="181">Prize Category</td>
      <td width="195">Prize</td>
      <td width="133">Add Sponser</td>
    </tr>
   <?php
   	if($_GET['TFId']!=null)
	{
		
   		$selPrizeEvents=mysql_query("SELECT * FROM `tbl_tfevent`,tbl_prize,tbl_eventreg WHERE `tfreg_id`=".$_GET['TFId']." and tbl_tfevent.event_id=tbl_eventreg.event_id and tbl_prize.event_id=tbl_eventreg.event_id");
		while($dataPrizeEvents=mysql_fetch_array($selPrizeEvents))
		{ 	   
   ?>
    <tr>
      <td><?php echo $dataPrizeEvents['name']; ?></td>
      <td><?php echo $dataPrizeEvents['prize_cat']; ?></td>
      <td><?php echo $dataPrizeEvents['prize_name']; ?></td>
      <td>
      	<?php
			$selSponser=mysql_query("select * from tbl_sponser1 where tfreg_id=".$_GET['TFId']." and prize_id=".$dataPrizeEvents['prize_id']);
			if($dataSponser=mysql_fetch_array($selSponser))
			{
		?>
        <a href="../wamp/www/Tech Fest Management System/ADMIN/Sponsers.php?View=<?php echo $dataSponser['sponser_id'];?>&TFId=<?php echo $dataPrizeEvents['tfreg_id'];?>&PId=<?php echo $dataPrizeEvents['prize_id']; ?>">View Sponser</a>
        <?php
			}
			else
			{
				?>
      <a href="../wamp/www/Tech Fest Management System/ADMIN/Sponsers.php?TFId=<?php echo $dataPrizeEvents['tfreg_id'];?> &PId=<?php echo $dataPrizeEvents['prize_id']; ?>">Add Sponsers</a>
      <?php
			}
			?>
      </td>
    </tr>
    <?php
		}
	}
		?>
   
  </table>
  </div>
  <p>&nbsp;</p>
  <div class="CSSTableGenerator2">
  <table width="950" height="74" border="1">
    <tr align="center">
      <td colspan="6">Tech Fest Details</td>
    </tr>
    <tr>
      <td width="199">Tech Fest Name</td>
      <td width="157">Starting Date</td>
      <td width="118">Ending Date</td>
      <td width="160">Registration Starting Date</td>
      <td width="152">Registration Ending Date</td>
      <td width="82">Sponsers</td>
    </tr>
    <?php
  	$date=date('Y-m-d');
	$sel=mysql_query("select * from tbl_tfreg where tfreg_regsdate<='" .$date."' and tfreg_regldate>='".$date."'");
	while($data=mysql_fetch_array($sel))
	{
  
  ?>
    <tr>
      <td><?php echo $data['tfreg_name'];?></td>
      <td><?php echo $data['tfreg_tfsdate'];?></td>
      <td><?php echo $data['tfreg_tfldate'];?></td>
      <td><?php echo $data['tfreg_regsdate'];?></td>
      <td><?php echo $data['tfreg_regldate'];?></td>
      <td><a href="../wamp/www/Tech Fest Management System/ADMIN/Sponsers.php?TFId=<?php echo $data['tfreg_id'];?>">Add Sponsers</a></td>
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
