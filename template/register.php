
<?php
session_start();
if (isset($_SESSION['username'])) {
    header("location:../index.php");
}
if (@$_GET['registered'] == 'true') {
}
?>

<!DOCTYPE html>
<!-- saved from url=(0049)http://getbootstrap.com/docs/4.0/examples/signin/ -->
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Register</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet">
</head>

<body>

  <div class="container col-md-6 col-md-offset-3">

    <form class="form-signin" action="welcome.php" method="post">
      <br>
      <h2 class="form-signin-heading">Please Register</h2>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="validationDefault01">User name</label>
          <input type="text" class="form-control" id="validationDefault01" name="uid" placeholder="User name" required>
          <div class="invalid-feedback">
            Username already exists, plese re-enter.
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <label for="validationDefault02">Password</label>
          <input type="password" class="form-control" id="validationDefault02" name="user_password" placeholder="Password" required>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="validationDefault01">First name</label>
          <input type="text" class="form-control" id="validationDefault01" name="first_name" placeholder="First name" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="validationDefault02">Last name</label>
          <input type="text" class="form-control" id="validationDefault02" name="last_name" placeholder="Last name" required>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 mb-3">
          <label for="validationDefault03">Email</label>
          <input type="text" class="form-control" id="validationDefault03" name="email" placeholder="Email" required>
          <div class="invalid-feedback">
            Please provide a valid email.
          </div>
        </div>
        <div class="col-md-12 mb-3">
          <label for="validationDefault03">Home address</label>
          <input type="text" class="form-control" id="validationDefault03" name="home_address" placeholder="Home address" required>
          <div class="invalid-feedback">
            Please provide a valid home address.
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <label for="validationDefault04">Home phone</label>
          <input type="text" class="form-control" id="validationDefault04" name="home_phone" placeholder="Home phone" required>
          <div class="invalid-feedback">
            Please provide a valid home phone number.
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <label for="validationDefault05">Cell phone</label>
          <input type="text" class="form-control" id="validationDefault05" name="cell_phone" placeholder="Cell phone" required>
          <div class="invalid-feedback">
            Please provide a valid cell phone number.
          </div>
        </div>
      </div>
      <br>
      <button class="btn btn-primary col-md-4" style="float: right;" type="submit" name="register">Register</button>
    </form>

  </div>
  <!-- /container -->
</body>

</html>
