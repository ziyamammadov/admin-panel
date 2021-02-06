<?php require_once("include/DB.php");?>
<?php require_once("include/sessions.php");?>
<?php require_once("include/functions.php");?>
<?php Confirm_Login() ?>
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
	<title>Add New Post</title>
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
		?>	
		<h1>Add New Post</h1>
		<h3>Title:</h3><br>
		<input type="text" name="title" placeholder="Title" required="" >
		<h2>Category:</h2><br>
		<input type="text" name="category" placeholder="Category" required="">
		<h2>Select Image:</h2>
		<input type="file" name="fileToUpload" id="image">
		<h1>Post:</h1><br>
		<textarea placeholder="Post" name="post" required=""></textarea><br>
		<input type="submit" name="insert" id="insert" value="INSERT">
	</form>


	<!-- ----------------------------------php side--------------------------------------------------- -->
		<?php 	if (isset($_POST['insert'])) {
				$title = $_POST['title'];
				$category = $_POST['category'];
				$text = $_POST['post'];
				$adder = $_SESSION['name'];
				$target_dir = "images/";
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$uploadOk = 1;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
				if(isset($_POST["submit"])) {
					$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
					if($check !== false) {
						echo "File is an image - " . $check["mime"] . ".";
						$uploadOk = 1;
					} else {
						$_SESSION["ErrorMessage"]="File is not an image.";
						$uploadOk = 0;
					}
				}
// Check if file already exists
				if (file_exists($target_file)) {
					$_SESSION["ErrorMessage"]="Sorry, file already exists.";
					$uploadOk = 0;
				}
// Check file size
				if ($_FILES["fileToUpload"]["size"] > 1500000) {
					$_SESSION["ErrorMessage"] = "Sorry, your file is too large.";
					$uploadOk = 0;
				}
// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					&& $imageFileType != "gif" ) {
					$_SESSION["ErrorMessage"]="Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
				}
				
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					$sql = "INSERT into posts(title,category,post,adder,image_target) VALUES('$title','$category','$text','$adder','$target_file')";
					$result = mysqli_query($conn, $sql);
					if($result){
						$_SESSION["SuccessMessage"]="Post added successfully";
						Redirect_to("AddNewPost.php");
					}else{
						$_SESSION["ErrorMessage"]="Something went wrong.Try Again!";
						Redirect_to("AddNewPost.php");
					}	
					$_SESSION["SuccessMessage"]="Post added successfully";
					Redirect_to("AddNewPost.php");
				} else {
					$_SESSION["ErrorMessage"]="Sorry, there was an error uploading your file.";
					Redirect_to("AddNewPost.php");
				}} 
				mysqli_close($conn);?>

			</body>
			</html>