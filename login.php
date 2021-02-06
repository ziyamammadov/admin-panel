<?php require_once("include/DB.php");?>
<?php require_once("include/sessions.php");?>
<?php require_once("include/functions.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Web2	 project</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css0/login.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

	<?php echo Message(); 
	echo SuccessMessage();
	?>
	
	<div class="login-form">    
		<form method="post">
			<div class="avatar"><i class="material-icons">&#xE7FF;</i></div>
			<h4 class="modal-title">Login to Admin Page</h4>
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Username" required="required" name="username">
			</div>
			<div class="form-group">
				<input type="password" class="form-control" placeholder="Password" required="required" name="password">
			</div>       
			<input type="submit" class="btn btn-primary btn-block btn-lg" value="Login" name="send">   

	<!-- -----------------------------php-side------------------------------------ -->
			<?php 

			if (isset($_POST['send'])) {
				$username = $_POST['username'];
				$password = $_POST['password'];
				$sql = "SELECT * from admins where username='$username' LIMIT 1";
				$result = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result)>0) {
					$row = mysqli_fetch_assoc($result);
					$hash = $row['password']; 
					if (password_verify($password, $hash)) {
						$_SESSION['username'] = $row['username'];
						$_SESSION['name'] = $row['name'];
						$_SESSION["admin_id"]=$row['admin_id'];
						$_SESSION["SuccessMessage"]="Welcome  {$_SESSION["username"]}";
						Redirect_to("dashboard.php");
					}		
					else{
						$_SESSION["ErrorMessage"]="Incorrect passord!";
						Redirect_to("login.php");

					}
				}else{
					$_SESSION["ErrorMessage"]="Not found such registered user";
					Redirect_to("login.php");;
				}
			}
			mysqli_close($conn);
			?>           
		</form>			

	</div>

</body>
</html>                                		                            