<?php require_once("include/sessions.php");?>
<?php require_once("include/functions.php");?>
<?php require_once("include/DB.php");?>
<?php Confirm_Login() ?>
<!DOCTYPE html>
<html>
<head>
	<title><DATA></DATA>ashboard</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css0/bootstrap.min.css">
	<script src="js0/jquery-3.2.1.min.js"></script>
	<script src="js0/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css0/adminstyles.css">

</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2">
				<ul id="Side_Menu" class="nav nav-pills nav-stacked"> 
					<li class="active"><a href="Dashboard.php"> <span class="glyphicon glyphicon-th "></span>	&nbsp;Dashboard</a></li>
					<li><a href="AddNewPost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Add New Post</a></li>
					<li><a href="manageadmin.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admin</a></li>
					<li><a href="index.php"><span class="glyphicon glyphicon-equalizer"></span>&nbsp;Live Blog</a></li>
					<li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
				</ul>
			</div><!--ending side area  -->
			<div class="col-sm-10"> <!--Main area  -->
				<div><?php echo Message(); 
				echo SuccessMessage();?>
			</div>
			<h1>Admin Dashboard</h1>
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<tr>
						<th>No</th>
						<th>Post Title</th>
						<th>Author</th>
						<th>Category</th>
						<th>Banner</th>
						<th>Action</th>
						<th>Details</th>
					</tr>
					<?php 

					$sql="select *from posts order by post_id desc;";
					$result = mysqli_query($conn, $sql);
					$SrNo=0;
					while ($rows=mysqli_fetch_assoc($result)) {
						$Id=$rows["post_id"];
						$Title=$rows["title"];
						$Category=$rows["category"];
						$Admin=$rows["adder"];
						$Post=$rows["post"];
						$image_target = $rows['image_target'];
						$SrNo++;
						?>
						<tr>
							<td><?php echo $SrNo; ?></td>
							<td style="color: #006666;" ><?php
							if(strlen($Title)>20){$Title=substr($Title, 0,20).'..';}
							echo $Title; 
							?></td>
							<td><?php 
							if(strlen($Admin)>20){$Admin=substr($Admin, 0,20).'..';}

							echo $Admin; 

							?></td>
							<td><?php 
							if(strlen($Category)>20){$Category=substr($Category, 0,20).'..';}
							echo $Category; 

							?></td>	
							<td> <img  width="50" height="50" src="<?php echo $image_target;?>"></td>
							<td>
								<a href="editpost.php?Edit=<?php echo $Id; ?>">
									<span class="btn btn-warning">Edit</span>
								</a>
								<a name="delete" href="deletepost.php?Delete=<?php echo $Id; ?>">
									<span class="btn btn-danger">Delete</span>
								</a>
							</td>
							<td><a href="singlepost.php?id=<?php echo $Id; ?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
						</tr>
					<?php } ?>
				</table>
			</div>
		</div><!--ending main area  -->
	</div><!--ending row  -->
</div><!--ending containing fluid  -->

<!-- data:image;base64,'.$Image.' -->


</body>
</html>