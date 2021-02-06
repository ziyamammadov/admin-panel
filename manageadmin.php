<?php require_once("include/sessions.php");?>
<?php require_once("include/functions.php");?>
<?php require_once("include/DB.php");?>
<?php Confirm_Login() ?><!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css0/manageadmin.css">
	<link rel="stylesheet" href="css0/bootstrap.min.css">
	<script src="js0/jquery-3.2.1.min.js"></script>
	<script src="js0/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css0/adminstyles.css">
	<style type="text/css">
		.FieldInfo{
			color: #0099ff;
			font-family: Bitter,Georgia;
			font-size: 1.6em;

		}
		.btn{
			width: 100% !important;
		}
		.table{
			background-color: white !important;
		}
	</style>
	<title>Manage Admin</title>
</head>
<body>
	<!-- -------------------------------side-menu-------------------------------------------- -->
	<div class="col-sm-2">
		<ul id="Side_Menu" class="nav nav-pills nav-stacked"> 
			<li><a href="Dashboard.php"> <span class="glyphicon glyphicon-th"></span>&nbsp;Dashboard</a></li>
			<li><a href="AddNewPost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Add New Post</a></li>
			<li class="active"><a href="manageadmin.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admin</a></li>
			<li><a href="index.php"><span class="glyphicon glyphicon-equalizer"></span>&nbsp;Live Blog</a></li>
			<li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
		</ul>
	</div>

	<!-- ----------------------------------form----------------------------------------------- -->

	<form method="post" action="">
		<?php echo Message(); 
		echo SuccessMessage();
		?>		
		<h1>Add New Admin</h1>
		<h2>Name: </h2><br>
		<input type="text" name="name" placeholder="name" required=""><br><br>
		<h2>Surname: </h2><br>
		<input type="text" name="surname" placeholder="surname" required=""><br><br>
		<h2>Username: </h2><br>
		<input type="text" name="username" placeholder="username" required=""><br><br>
		<h2>Password: </h2><br>
		<input type="password" name="password" placeholder="password" required=""><br><br>
		<input type="submit" name="send" value="REGISTER">

		<!-- -------------------------------admindelete--------------------------------- -->


		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
					<th>Sr No</th>
					<th>Name</th>
					<th>Username</th>
					<th>Added By</th>
					<th>Action</th>
				</tr>
				<?php 
				$sql="select * from admins order by admin_id desc";
				$result=mysqli_query($conn, $sql);
				$SrNo=0;
				while ($row=mysqli_fetch_assoc($result)) {
					$admin_id=$row["admin_id"];
					$adder = $row['adder'];
					$name = $row['name'];
					$username=$row["username"];
					$SrNo++;
					?>
					<tr>
						<td><?php echo $SrNo; ?></td>
						<td><?php echo $name; ?></td>
						<td><?php echo $username; ?></td>
						<td><?php echo $adder; ?></td>
						<td><a href="deleteadmin.php?Delete=<?php echo $admin_id; ?>"><span class="btn btn-danger">Delete</span></a></td>
						</tr>
					<?php } ?>
				</table>

			</div>	
		</form>

		<?php 
		if (isset($_POST['send'])) {
			$name = $_POST['name'];
			$surname = $_POST['surname'];
			$username = $_POST['username'];
			$password = $_POST['password'];
			$hash = password_hash($password, PASSWORD_DEFAULT);
			$hash = (string)$hash;
			$adder = $_SESSION['name'];
			$sql = "INSERT into admins(name,surname,username,password,adder) VALUES('$name','$surname','$username','$hash','$adder')";

			$result = mysqli_query($conn, $sql);
			if($result){
				$_SESSION["SuccessMessage"]="Admin added successfully";
				Redirect_to("manageadmin.php");
			}else{
				$_SESSION["ErrorMessage"]="Something went wrong.Try Again!";
				Redirect_to("manageadmin.php");
			}
		}
		mysqli_close($conn);
		?>


	</body>
	</html>