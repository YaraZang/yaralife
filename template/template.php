<?php require "loginheader.php";?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?php pageTitle(); ?> | <?php siteName(); ?></title>
    <link href="https://fonts.googleapis.com/css?family=Arimo" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Spectral+SC" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/carousel.css">
    <link rel="stylesheet" href="./css/blog.css">
    <link rel="stylesheet" href="./css/album.css">
    <link rel="stylesheet" href="./css/marketdetail.css">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="https://cdn.snipcart.com/scripts/2.0/snipcart.js" data-api-key="ZTM5NGM4ZjItZWEzNS00MTYzLWI5YmUtYzY2ZWY3NDY3MjE0NjM2NDgyODM0NTU4NDQ1OTI2" id="snipcart"></script>
    <script src="./js/rating.js"></script>
    <link href="https://cdn.snipcart.com/themes/2.0/base/snipcart.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet">

</head>
<body>
<div class="wrap">

  <header>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#" style="font-size:30px;">&nbsp;Chef Z&G&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <?php navMenu(); ?>
          </ul>
          <form class="form-inline my-2 my-lg-0" action="template/logout.php" method="post">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Log Out</button>
          </form>
        </div>
      </nav>
  </header>

  <?php pageContent(); ?>

  <footer class="text-muted">
    <div class="container">
        <p><?php echo date('Y'); ?> <?php siteName(); ?>.<br><?php siteFor(); ?>.<br><?php siteVersion(); ?></p>
    </div>
  </footer>

</div>
</body>
</html>
