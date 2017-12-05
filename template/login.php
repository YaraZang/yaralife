<?php
session_start();
if (@$_GET['registered'] == 'true') {
}
/*
if (isset($_SESSION['username'])) {
    header("location:../index.php");
}
*/
?>
<!DOCTYPE html>
<!-- saved from url=(0049)http://getbootstrap.com/docs/4.0/examples/signin/ -->
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Signin</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

  <link rel="stylesheet" href="../css/signin.css">

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet">
</head>

<body>

  <div class="container">

    <form class="form-signin" action="checklogin.php" method="post">
      <h2 class="form-signin-heading">Please Sign In</h2>
      <label for="inputEmail" class="sr-only">User Name</label>
      <input type="text" name="uid" class="form-control" placeholder="Username" required="" autofocus="">
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" name="pwd" class="form-control" placeholder="Password" required="">
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
      <!--
      Not yet a menber? <a href="register.php">Register</a>
    -->
    </form>

  </div>
  <!-- /container -->


</body>

</html>
