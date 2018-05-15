<?php
include("../wamp/www/Tech Fest Management System/ADMIN/..//connection.php");
if($_GET['Delete']!=null){
	$del_id=$_GET['Delete'];
	mysql_query("delete from tbl_prize where prize_id=".$del_id);
	header("location:prize.php");
}
if($_GET['Edit']!=null)
{
	$ed_id=$_GET['Edit'];
	$sel=mysql_query("select * from tbl_prize where prize_id=" .$ed_id);
	if($eddata=mysql_fetch_array($sel))
	{
		$edevent=$eddata['event_id'];
		$edpc=$eddata['prize_cat'];
		$edpname=$eddata['prize_name'];
	}
}
if(isset($_POST['submit']))
{
	$eventname=$_POST['selename'];
	$pc=$_POST['txtpc'];
	$prize=$_POST['txtprize'];
	if($_GET['Edit']!=null)
	{
		mysql_query("update tbl_prize set event_id=".$eventname.",prize_cat='" .$pc. "',prize_name='" .$prize. "' where prize_id=" .$_GET['Edit']);
	}
	else
	{
	mysql_query("insert into tbl_prize(event_id,prize_cat,prize_name)values(".$eventname. ",'" .$pc. "','" .$prize. "')");
	
}
header("location:prize.php");
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<?php
include("../wamp/www/Tech Fest Management System/ADMIN/header.php");
?>
<link rel="stylesheet" type="text/css" href="../wamp/www/Tech Fest Management System/mystyle.css" />

</head>

<body>
<div align="center">
<form id="form1" name="form1" method="post">
<div class="CSSTableGenerator">
  <table width="490" border="1">
    <tr align="center">
      <td colspan="2">Prize Details</td>
    </tr>
    <tr>
      <td width="136">Event Name</td>
      <td width="338"><label for="select"></label>
        <select name="selename" id="selename">
        <option value="">---Select---</option>
        <?php
		$sel=mysql_query("select * from tbl_eventreg order by name");
		while($data=mysql_fetch_array($sel))
		{
			?>
            <option value="<?php echo $data['event_id'];?>"<?php if($edevent==$data['event_id']) { ?> selected="selected" <?php } ?>>
            <?php echo $data['name'];?></option>
            <?php } ?>
      </select></td>
    </tr>
    <tr>
      <td>Prize Category</td>
      <td><input type="text" name="txtpc" id="txtpc" value="<?php echo $edpc; ?>" required></td>
    </tr>
    <tr>
      <td>Prize</td>
      <td><input type="text" name="txtprize" id="txtprize" value="<?php echo $edprize; ?>" required></td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" name="submit" id="submit" value="Submit"></td>
    </tr>
   
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