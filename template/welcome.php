<!DOCTYPE html>
<html>
<head>
<title>Welcome</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
</head>
<body>
  <?php
  include('../content/users_dbh.php');
  if (isset($_POST['register'])
      && !empty($_POST['uid'])
      && !empty($_POST['first_name'])
      && !empty($_POST['last_name'])
      && !empty($_POST['email'])
      && !empty($_POST['home_address'])
      && !empty($_POST['home_phone'])
      && !empty($_POST['cell_phone'])
      && !empty($_POST['user_password'])) {
      $uid = $_POST['uid'];
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $email = $_POST['email'];
      $home_address = $_POST['home_address'];
      $home_phone = $_POST['home_phone'];
      $cell_phone = $_POST['cell_phone'];
      $user_password = $_POST['user_password'];
      $sql = 'SELECT * from users where uid="' . $uid .'"' ;
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);
      if ($resultCheck > 0) {
          echo '<div class="container col-md-6 col-md-offset-3 alert alert-danger" role="alert">
          This username already exists, please re-enter!
          </div>';
          //header("refresh:3; url=register.php?registered=true");
          header("refresh:3; url=../index.php?page=user&registered=true");
          return;
      }

      $sql = "INSERT INTO users (uid, first_name, last_name, email, home_address, home_phone, cell_phone, user_password)   VALUES ('$uid', '$first_name', '$last_name', '$email', '$home_address', '$home_phone', '$cell_phone', '$user_password')";

      $result = mysqli_query($conn, $sql);

      if ($result) {
          session_start();
          $_SESSION['username'] = $uid;
          echo "Register successfully! Redirecting page, please wait...";
          header("refresh:2; url=login.php?registered=true");
          #header("Location: ../index.php");
      } else {
          //echo 'fail';
          header("Location: register.php");
      }
  }
  ?>

</body>
</html>
