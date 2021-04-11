

<?php
session_start();
//connect to DB
require_once('include/conn.php');
include_once('include/registration-header.php');

//Flash Message
$message="";
if(isset($dbh)){
//connection check
if(isset($_POST['submit'])){



$stmt = $dbh->prepare("INSERT INTO `users`(`name`,`email`,`mobile`,`password`,`image`) VALUES (:name, :email, :mobile, :password, :image)");

$stmt1 = $dbh->prepare("INSERT INTO `login`(`email`,`password`,`user`) VALUES (:email, :password,:user)");

//bindParam FOR LOGIN TABLE
$stmt1->bindParam(':email', $email);
$stmt1->bindParam(':password', $password);
$stmt1->bindParam(':user', $user);

//bindParam
$stmt->bindParam(':name', $name);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':mobile', $mobile);
$stmt->bindParam(':password', $password);
$stmt->bindParam(':image', $image);




//insert File
$target_dir = "assets/img/user/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
//Fatch data user form
if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$passwordtest = $_POST['password'];
$image = $target_file;
$confirmpassword = $_POST['confirmpassword'];
//This variable data has been assigned by us
$user="user";
//check name 

//check name 

//checkpassword weather passwrod is same or not....
if($passwordtest == $confirmpassword){
  $password = ($passwordtest);
}
else{
  $message="confirm password Not match!";
  header("Location:doctor-registration.php");
}
}
else{
  $message="You file is not an image!";
  header("Location:doctor-registration.php");
}


//confiramation of first value inseration ....


if($stmt->execute()){
  $message="Insert Row Scuccess";
 header("Location:login.php");
}
else{
 $message="Insert Row Fail";

}

//STMT1 FOR LOGIN TABLE
if($stmt1->execute()){
  $message="Insert Row Scuccess";
 header("Location:dashboard.php");
}
else{
 $message="Insert Row Fail";
} 
//end of the second condition

}
}
?>





<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="assets/css/custom.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/docreg.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login -  Admin</title>
  
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        
      </div>
      <div class="docreg">
        <!-- <form action="" method="post" enctype="multipart/form-data"> -->
          
       
        <form action="doctor-registration.php" method="post" class="login-form" enctype="multipart/form-data">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user-md"></i>Doctor Register</h3>
           <div class="message text-danger"><?php if($message!="") { echo $message; } ?></div> 

          <div class="form-group">
            <label class="control-label text-dark" >TITLE: <span class="text-danger">*</span></label>

  
			  <select id="d-title" name="d-title" class="form-control">
			    <option value="dr">Dr.</option>
			    <option value="Prof">Prof. Dr.</option>
			    <option value="Assoc">Assoc. Prof. Dr.</option>
			    <option value="Asst">Asst. Prof. Dr.</option>
			    
			  </select>
		  </div>

		  <div class="form-group">
            <label class="control-label text-dark" > SPECIALIST: <span class="text-danger">*</span></label>

  
			  <select id="specialists" name="specialists" class="form-control">
			    <option value="Allergists">Allergists/Immunologists</option>
			    <option value="Anesthesiologists">Anesthesiologists</option>
			    <option value="Cardiologists">Cardiologists</option>
			    <option value="Medicine ">Medicine Specialists</option>
			    <option value="Dermatologists ">Dermatologists </option>
			    <option value="Hematologists ">Hematologists </option>
			    <option value="Neurologists ">Neurologists </option>
			    <option value="Sleep Medicine Specialists ">Sleep Medicine Specialists </option>
			    
			  </select>
		  </div>


          <div class="form-group">
            <label class="control-label text-dark">BIRTH DATE :<span class="text-danger">*</span></label>
            <input type="date" name="date" id="" class="form-control"  autocomplete="off">
          </div>

          <div class="form-group">
            <label class="control-label text-dark" > GENDER: <span class="text-danger">*</span></label>

  
			  <select id="gender" name="gender" class="form-control">
			    <option value="Male">Male</option>
			    <option value="Female">Female</option>
			    <option value="Other">Other</option>
		
			    
			  </select>
		  </div>


          <div class="form-group">
            <label class="nid text-dark">NID/PASSPORT NO: <span class="text-danger">*</span></label>
            <input type="text" name="nid" id="" class="form-control" placeholder="NID/PASSPORT NO" autocomplete="off">
          </div>
          <div class="form-group">
            <label class="reg-no text-dark">REGISTRATION NO(BMDC) <span class="text-danger">*</span></label>
            <input type="text" name="reg-no" id="" class="form-control" placeholder="REGISTRATION NO(BMDC)" autocomplete="off">
          </div>
          <div class="form-group">
            <label class="mobile text-dark">MOBILE NO: <span class="text-danger">*</span></label>
            <input type="tel" name="mobile" id="" class="form-control" placeholder="MOBILE NO" autocomplete="off">
          </div>
          <div class="form-group">
            <label class="email text-dark">EMAIL: <span class="text-danger">*</span></label>
            <input type="email" name="email" id="" class="form-control" placeholder="Doctor email" autocomplete="off">
          </div>
          <div class="form-group">
            <label class="control-label text-dark">PASSWORD <span class="text-danger">*</span></label>
            <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off" id="password">
          </div>
          <div class="form-group">
            <label class="control-label text-dark">RE-TYPE PASSWORD <span class="text-danger">*</span></label>
            <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="RE-type Password" autocomplete="off">
            <span id='message'></span>
          </div>
          <div class="form-group">
            <label class="control-label text-dark">Image <span class="text-danger">*</span></label>
            <input type="file" name="image" id="" class="form-control">
          </div>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block" type="submit" name="submit" value="submit"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN UP</button>
            <br> 
          </div>

          	     <center> <a href="login.php" >already have an account?</a></center>
        </form>

        
      </div>
      
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="assets/js/plugins/pace.min.js"></script>
    <script>
      $(document).ready(function(){
        $('#password, #confirmpassword').on('keyup', function () {
          if ($('#password').val() == $('#confirmpassword').val()) {
            $('#message').html('Matching').css('color', 'green');
          } else 
            $('#message').html('Not Matching').css('color', 'red');
        });
      });
    </script>
  </body>
</html>