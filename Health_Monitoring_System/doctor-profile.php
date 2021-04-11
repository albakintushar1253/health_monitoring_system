<?php
session_start();
include_once('include/conn.php');
include_once('sql.php');


$_SESSION['email'];

$eamil=$_SESSION['email'];
 
$result = mysqli_query($conn,"SELECT * FROM doctor_registration Where email='$eamil'");


if (mysqli_num_rows($result) > 0) {

	$i=0;
$row = mysqli_fetch_array($result);

	
	}

	else{
	echo "No result found";
	}



if(strlen($_SESSION['email'])==0)
{
header('location:login.php');
}
else{
$message="";
if(isset($dbh)){
//connection check
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users ";
    $statement = $dbh->prepare($sql);
    $statement->bindParam(':id', $id);
    $statement->execute();
    $profile = $statement->fetch(PDO::FETCH_ASSOC);
    extract($profile);
}



include_once('include/header.php');
include_once('include/Doctor-sidebar.php');

?>
<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-user-md"></i> Doctor Profile</h1>
			
		</div>
		<ul class="app-breadcrumb breadcrumb">
			<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
			<li class="breadcrumb-item">Dashbord</li>
			
		</ul>
	</div>
	<div class="row">
		
		<div class="col-md-5 m-auto">
			<div class="tile">
				<h3 class="tile-title">Doctor Profile</h3>
				<div class="tile-body">
					<form action="action/update-profile.php" method="post" class="form-horizontal" enctype="multipart/form-data">

						<input type="hidden" name="id" value="<?php echo $id ?>">

						
						<div class="form-group row">
							<label class="control-label col-md-3" for="name">Name <span class="text-danger">*</span></label>
							<div class="col-md-9">
							<?php echo $row["name"]; ?>
							</div>
						</div>
						<hr>
						<div class="form-group row">
							<label class="control-label col-md-3" for="name">Doctor id <span class="text-danger">*</span></label>
							<div class="col-md-9">
							<?php echo $row["id"]; ?>
							</div>
						</div>
<hr>
						<div class="form-group row">
							<label class="control-label col-md-3" for="email">Email <span class="text-danger">*</span></label>
							<div class="col-md-9">
							<?php echo $row["email"]; ?>

								
							</div>
						</div>
<hr>
						<div class="form-group row">
							<label class="control-label col-md-3" for="mobile">Mobile <span class="text-danger">*</span></label>
							<div class="col-md-9">

							<?php echo $row["mobile"]; ?>
							</div>
						</div>
<hr>


						<div class="form-group row">
							<label class="control-label col-md-3" for="image"> Image <span class="text-danger">*</span></label>
							<div class="col-md-9">
								
							<img src="<?php echo $row["image"]; ?>"  alt="User Image" style="height: 70px; width: 70px;">
								
							</div>
						</div>
						
					</div>
					
				</form>
			</div>
		</div>


		<div class="col-md-5 m-auto">
			<div class="tile">
				<h3 class="tile-title">Prescription upload</h3>
				<div class="tile-body">
					<form action="action/update-profile.php" method="post" class="form-horizontal" enctype="multipart/form-data">

						<input type="hidden" name="id" value="<?php echo $id ?>">
						

						<div class="form-group row">
							<label class="control-label col-md-3" for="date">Date <span class="text-danger">*</span></label>
							<div class="col-md-9">

								<input type="date" class="form-control"   id="date" name="date" >
							</div>
						</div>

						<div class="form-group row">
							<label class="control-label col-md-3" for="mobile">Time <span class="text-danger">*</span></label>
							<div class="col-md-9">

								<input type="time" class="form-control"  id="time" name="time" >
							</div>
						</div>

						<div class="form-group row">
							<label class="control-label col-md-3" for="pataeintid">Patient id <span class="text-danger">*</span></label>
							<div class="col-md-9">

								  <input type="number" name="pataeintid" id="" class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-md-3" for="image">File upload <span class="text-danger">*</span></label>
							<div class="col-md-9">

								  <input type="file" name="image" id="" class="form-control">
							</div>
						</div>
						
					
						
					</div>
					<div class="tile-footer text-center">
						
						<button class="btn btn-primary" type="subnmit" name="sent"><i class="fa fa-fw fa-lg fa-check-circle"></i>Sent </button>
						
					</div>
				</form>
			</div>
		</div>
		
	</div>
</main>
<?php
include_once('include/footer.php');
include_once('include/Hfooter.php');
}
}
?>