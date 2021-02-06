<?php require_once("Include/DB.php");?>
<?php require_once("Include/Sessions.php");?>
<?php require_once("Include/Functions.php");?>
<?php require_once("include/DB.php");?>
<?php Confirm_Login();
function noAcces()
{
	if (!isset($_GET['Delete'])) {
		$_SESSION["ErrorMessage"]="No acces!";
		Redirect_to("dashboard.php"); 
	}
}
noAcces();
 ?>
 <?php
$sql="select * from admins order by admin_id desc";
$result=mysqli_query($conn, $sql);
$rowcount = mysqli_num_rows($result);
if ($_GET["Delete"]>=0 and $rowcount>1) {
		$DeleteId=$_GET["Delete"];
		$sql="delete from admins where admin_id=$DeleteId";
		$sql = mysqli_query($conn, $sql);
		if($sql){
			$_SESSION["SuccessMessage"]="Post deleted successfully";
			Redirect_to("manageadmin.php");
		}else{
			$_SESSION["ErrorMessage"]="Something went wrong.Try Again!";
			Redirect_to("manageadmin.php");
		}
}else{
	$_SESSION["ErrorMessage"]="Only one admin left!";
	Redirect_to("manageadmin.php");
}
  ?>
}
