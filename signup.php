<?php

$showAlert = false;
$showError = false;
if($_SERVER['REQUEST_METHOD'] == 'POST'){  

include 'partials/_dbconnect.php';

$username = $_POST["username"];
$password = $_POST ["password"];
$cpassword = $_POST ["cpassword"];

//$exists = false;
$existSql = "SELECT * FROM `users` WHERE username = '$username'";
$result = mysqli_query($conn, $existSql);
$numExistRows = mysqli_num_rows($result);

if($numExistRows > 0){

   // $exists = true;
   $showError = "username already exist";
}
else{

   // $exists = false;

if(($password == $cpassword)){
  $hash = password_hash($password,PASSWORD_DEFAULT);
     
    $sql = "INSERT INTO `users` (`username`, `password`, `dt`) VALUES ('$username', '$hash' , current_timestamp())";
    $result = mysqli_query($conn , $sql);
    if($result){

      $showAlert = true;

    }
}

else{

$showError = "Password do not match";

}
} 
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SignUp</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

  <body>
    <?php require 'partials/_navbar.php' ?>

    <?php

    if($showAlert){
echo  '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your Account Has Been Created Successfully.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';


}


if($showError){
    echo  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error!</strong> '.$showError.'
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>

    <div class="container my-4">
<h1 class = "text-center"> SignUp to our Website</h1>
<form action = "/loginsystem/signup.php" method = "post">
<div class="form-group">
  <label for="username" class="form-label">Username</label>
  <input type="text"maxlength = "11" id="username" class="form-control" name = "username">
</div>
<div class="form-group ">
<label for="inputPassword5" class="form-label">Password</label>
<input type="password" maxlength = "23" id="password" class="form-control" name="password">
<div id="passwordHelpBlock" class="form-text">
</div>  
<div class="form-group">
<label for="Password" class="form-label">Confirm Password</label>
<input type="password" id="cpassword" class="form-control" name ="cpassword">
<div id="passwordHelpBlock" class="form-text">
<small id="emailHelp" class="form-text text-muted">Make sure to type the same password</small>
</div>      
</div>  
<button type="submit" class="btn btn-primary">SignUp</button>
</div>
</form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>