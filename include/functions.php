<?php require_once("Include/DB.php");?>
<?php require_once("Include/Sessions.php");?>
<?php 
function Redirect_to($New_Location){
	header("Location:"."$New_Location"); 
		exit();
}

function Login(){
	if (isset($_SESSION["admin_id"])) {
		return true;
	}
}

function Confirm_Login(){
	if (!Login()) {
		$_SESSION["ErrorMessage"]="Login Required !";
		Redirect_to("Login.php"); 
	}
}

 ?>