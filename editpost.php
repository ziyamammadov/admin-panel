<?php require_once("include/DB.php");?>
<?php require_once("include/sessions.php");?>
<?php require_once("include/functions.php");?>
<?php Confirm_Login();
function noAcces()
{
	if (!isset($_GET['Edit'])) {
		$_SESSION["ErrorMessage"]="No acces!";
		Redirect_to("dashboard.php"); 
	}
}
noAcces();?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css0/addnewpost.css">
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
	</style>
	<title>Update Post</title>
</head>
<body>
	<!-- -------------------------------side-menu-------------------------------------------- -->
	<div class="col-sm-2">
		<ul id="Side_Menu" class="nav nav-pills nav-stacked"> 
			<li><a href="Dashboard.php"> <span class="glyphicon glyphicon-th"></span>&nbsp;Dashboard</a></li>
			<li class="active"><a href="AddNewPost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Add New Post</a></li>
			<li><a href="manageadmin.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admin</a></li>
			<li><a href="index.php"><span class="glyphicon glyphicon-equalizer"></span>&nbsp;Live Blog</a></li>
			<li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
		</ul>
	</div>

	<!-- --------------------------------form-------------------------------------------------------- -->
	<form method="post" enctype="multipart/form-data">
		<?php echo Message(); 
		echo SuccessMessage();
		$searchId=$_GET['Edit'];
		$sql = "SELECT * from posts where post_id=$searchId";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_assoc($result) ;	
		$TitleUpdate=$row['title'];
		$CategoryUpdate=$row['category'];
		$PostUpdate=$row['post'];

		?>

		<h1>Add New Post</h1>
		<h3>Title:</h3><br>
		<input type="text" name="title" placeholder="Title" required="" value="<?php echo $TitleUpdate; ?>">
		<h2>Category:</h2><br>
		<input type="text" name="category" placeholder="Category" required="" value="<?php echo $CategoryUpdate; ?>">
		<h2>Select Image:</h2>
		<input type="file" name="image" id="image" >
		<h1>Post:</h1><br>
		<textarea placeholder="Post" name="post" required=""><?php echo $PostUpdate; ?></textarea><br>
		<input type="submit" name="update" id="update" value="UPDATE">
	</form>


	<!-- ----------------------------------php side--------------------------------------------------- -->
	<?php 
	if (isset($_POST['update'])) {
		$title = $_POST['title'];
		$category = $_POST['category'];
		$text = $_POST['post'];
		$adder = $_SESSION['name'];
		if (getimagesize($_FILES['image']['tmp_name'])!=0) {
			$target_dir = "images/";
			$target_file = $target_dir . basename($_FILES["image"]["name"]);
			$name = addslashes($_FILES['image']['name']);
			$file_ext=strtolower(end(explode('.',$name)));
			$extensions= array("jpeg","jpg","png","gif"); 
			if(in_array($file_ext,$extensions)=== false){
				$_SESSION["ErrorMessage"]="extension not allowed, please choose a JPG, JPEG, GIF or PNG file.";
				Redirect_to("AddNewPost.php");}
				else{
					move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
					$sql = "UPDATE posts SET title='$title',category='$category', post='$text', image_target = '$target_file'  WHERE post_id=$searchId";
					$result = mysqli_query($conn, $sql);
					if($result){
						$_SESSION["SuccessMessage"]="Post updated successfully";
						Redirect_to("AddNewPost.php");
					}else{
						$_SESSION["ErrorMessage"]="Something went wrong.Try Again!";
						Redirect_to("AddNewPost.php");
					}	
				}

			}else{
				move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
				$sql = "UPDATE posts SET title='$title',category='$category',post='$text', image_target = '$target_file' WHERE post_id=$searchId";
				$result = mysqli_query($conn, $sql);
				if($result){
					$_SESSION["SuccessMessage"]="Post updated successfully";
					Redirect_to("AddNewPost.php");
				}else{
					$_SESSION["ErrorMessage"]="Something went wrong.Try Again!";
					Redirect_to("AddNewPost.php");
				}
			}}
			mysqli_close($conn);
			?>
		</body>
		</html>