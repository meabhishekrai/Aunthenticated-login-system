<?php

$login = false;
$showError = false;
if($_SERVER['REQUEST_METHOD'] == 'POST'){  

include 'partials/_dbconnect.php';

$username = $_POST ["username"];

$password = $_POST ["password"];

    //$sql = " Select * From users where username = '$username' AND password = '$password'";
    $sql = " Select * From users where username = '$username'";
    $result = mysqli_query($conn , $sql);
    $num = mysqli_num_rows($result);
    if($num == 1){
      while($row=mysqli_fetch_assoc($result)){
        if(password_verify($password, $row['password'])){
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true ;
        $_SESSION['username'] = $username;
        header("location: welcome.php");
  
      }
      else{

        $showError = "Invalid Credentials";
        
        }
    }
    }
else{

$showError = "Invalid Credentials";

}
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

  <body>
    <?php require 'partials/_navbar.php' ?>

    <?php

    if($login){
echo  '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> You are logged in successfully.
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
<h1 class = "text-center"> Login here</h1>
<form action = "/loginsystem/login.php" method = "post">
<div class="form-group">
  <label for="username" class="form-label">Username</label>
  <input type="text" id="username" class="form-control" name ="username">
</div>
<div class="form-group ">
<label for="inputPassword5" class="form-label">Password</label>
<input type="password" id="password" class="form-control" name="password">
<div id="passwordHelpBlock" class="form-text">
</div>  
     
</div>  
<button type="submit" class="btn btn-primary">Login</button>
</div>
</form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>