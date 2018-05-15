<?php
include("../wamp/www/Tech Fest Management System/ADMIN/..//connection.php");
if($_GET['tf']!=null)
{
	$tf_id=$_GET['tf'];
	$sel=mysql_query("select * from tbl_tfreg where tfreg_id=".$tf_id);
	if($eddata=mysql_fetch_array($sel))
	{
		$edtfname=$eddata['tfreg_name'];
		$edtfsdate=$eddata['tfreg_tfsdate'];
		
		$edtfldate=$eddata['tfreg_tfldate'];
		
	$edtfrsdate=$eddata['tfreg_regsdate'];
	$edtfrldate=$eddata['tfreg_regldate'];
	}
}
if($_GET['Del']!=null)
{
	$tfeventid=$_GET['Del'];
	mysql_query("delete from tbl_tfevent where tfevent_id=".$_GET['Del']);
	header("location:tfnewpage.php?tf=".$_GET['tf']);
}

if(isset($_POST['submit']))
{
	$tfid=$_GET['tf'];
	$event=$_POST['selevent'];
	mysql_query("insert into tbl_tfevent(`tfreg_id`,`event_id`) values(".$tfid.",".$event.")");
	header("location:tfnewpage.php?tf=$tfid");
	
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
<div class="CSSTableGenerator">
  <table width="483" border="1">
    <tr>
      <td width="195">Tech Fest Name</td>
      <td width="272"><?php echo $edtfname; ?></td>
    </tr>
    <tr>
      <td>Tech Fest Starting Date</td>
      <td><?php echo $edtfsdate;?></td>
    </tr>
    <tr>
      <td>Tech Fest Ending Date</td>
      <td><?php echo $edtfldate;?></td>
    </tr>
    <tr>
      <td>Registration Starting Date</td>
      <td><?php echo $edtfrsdate;?></td>
    </tr>
    <tr>
      <td>Registration Ending Date</td>
      <td><?php echo $edtfrldate;?></td>
    </tr>
    <tr>
      <td>Events</td>
      <td><select name="selevent" id="selevent">
      
      <option value="">---Select---</option>
      <?php
	  $sel=mysql_query("select * from tbl_eventreg order  by name");
	  while($data=mysql_fetch_array($sel))
	  {
		  ?>
          <option value="<?php echo $data ['event_id']; ?>" <?php if($edtf_id==$data['event_id']){ ?> selected="selected" <?php } ?>> 
          <?php echo $data["name"];?></option>
          
          <?php
		   } 
		  ?>
      </select>
      </td>
    </tr>
    <tr align="center">
      <td colspan="2"><input type="submit" name="submit" id="submit" value="Submit"></td>
    </tr>
  </table>
  </div>
  <p>&nbsp;  </p>
  <div class="CSSTableGenerator2">
  <table border="1">
    <tr>
      <td width="87">Event Name</td>
	  <td width="108">Description</td>
      <td width="108">No Of Students</td>
      <td width="127">Delete</td>
       <td width="127">Venue</td>
    </tr>
	<?php
		$selevent=mysql_query("select * from tbl_tfevent,tbl_eventreg where tbl_tfevent.event_id=tbl_eventreg.event_id and tbl_tfevent.tfreg_id=".$_GET['tf']);
		while($dataevent=mysql_fetch_array($selevent))
		{
	?>
    <tr>
      <td><?php echo $dataevent['name']; ?></td>
	  <td><?php echo $dataevent['des']; ?></td>
      <td><?php echo $dataevent['nostudent']; ?></td>      
      <td><a href="../wamp/www/Tech Fest Management System/ADMIN/tfnewpage.php?Del=<?php echo $dataevent['tfevent_id']; ?>&tf=<?php echo $_GET['tf']; ?>">Delete</a></td>
      
       <td>
       <?php
	   	$selVenue=mysql_query("SELECT * FROM `tbl_venue` WHERE `tfevent_id`=".$dataevent['tfevent_id']);
		if($dataVenue=mysql_fetch_array($selVenue))
		{	
			echo $dataVenue['venue'];
		}
		else
		{
			?>
       <a href="../wamp/www/Tech Fest Management System/ADMIN/venuereg.php?tf=<?php echo $tf_id;?>&tfeid=<?php echo $dataevent['tfevent_id'];?>">Venue</a>
       <?php
		}
		?>
       </td>
    </tr>
	<?php
	}
	?>
  </table>
  </div>
  <p>&nbsp;</p>
  
  
</form>
</div>
</body>
</html>
<?php
include("../wamp/www/Tech Fest Management System/ADMIN/footer.php");
?>