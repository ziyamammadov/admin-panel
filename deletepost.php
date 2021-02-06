<?php require_once("Include/DB.php");?>
<?php require_once("Include/Sessions.php");?>
<?php require_once("Include/Functions.php");?>
<?php Confirm_Login() ;
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
if ($_GET["Delete"]>=0) {
		$DeleteId=$_GET["Delete"];
		$sql="delete from posts where post_id=$DeleteId";
		$sql = mysqli_query($conn, $sql);
		if($sql){
			$_SESSION["SuccessMessage"]="Post deleted successfully";
			Redirect_to("dashboard.php");
		}else{
			$_SESSION["ErrorMessage"]="Something went wrong.Try Again!";
			Redirect_to("Dashboard.php");
		}
	



}
  ?>

