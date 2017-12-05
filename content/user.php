<?php

if (@$_GET['registered'] == 'true') {
}
?>
<main role="main">
  <div class="row">

    <div class="col-md-1"></div>

    <div class="col-md-5">
    <div class="container col-md-6 col-md-offset-3">

      <form class="form-signin" action="./template/welcome.php" method="post">
      <br>
      <h2 class="form-signin-heading">Please Register</h2>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="validationDefault01">User name</label>
          <input type="text" class="form-control" id="validationDefault01" name="uid" placeholder="User name" required>

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

        </div>
        <div class="col-md-12 mb-3">
          <label for="validationDefault03">Home address</label>
          <input type="text" class="form-control" id="validationDefault03" name="home_address" placeholder="Home address" required>

        </div>
        <div class="col-md-6 mb-3">
          <label for="validationDefault04">Home phone</label>
          <input type="text" class="form-control" id="validationDefault04" name="home_phone" placeholder="Home phone" required>

        </div>
        <div class="col-md-6 mb-3">
          <label for="validationDefault05">Cell phone</label>
          <input type="text" class="form-control" id="validationDefault05" name="cell_phone" placeholder="Cell phone" required>

        </div>
      </div>
      <br>
      <button class="btn btn-primary col-md-4" style="float: right;" type="submit" name="register">Register</button>
    </form>


    </div>
  </div>

  <div class="col-md-1"></div>

  <div class="col-md-4">


    <form class="form-signin" action="content/search.php" method="post">
    <br>
    <h2 class="form-signin-heading">Search</h2>
    <br>
    <a href="./allusers.php"><i>All users?</i></a>
    <br>

      <div class="row">

          <input type="text" class="form-control col-md-9" name="searchvalue" placeholder="names, email or phone" required>
          <button class="btn btn-primary col-md-3" style="float:right;" type="submit" name="search">search</button>

      </div>

    </form>
    <br>

      <div>
        <?php
          getuserlist();
        ?>
      </div>


  </div>
  <div class="col-md-1"></div>
</div>
</main>
  <!-- /container -->
