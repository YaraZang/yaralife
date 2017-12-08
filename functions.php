<?php
/**
 * Displays site name.
 */
function siteName()
{
    echo config('name');
}

/**
 * Displays site version.
 */
function siteVersion()
{
    echo config('version');
}

function siteFor()
{
    echo config('class');
}

/**
 * Website navigation.
 */
function navMenu()
{
    $nav_menu = '';
    $page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : '';
    foreach (config('nav_menu') as $uri => $name) {
        $active = ($page == $uri) ? 'active':'';
        $nav_menu .= '<li class="nav-item '. $active .'">
                        <a class="nav-link" href="'.config('root').'index.php'. ($uri == '' ? '' : '?page=') .$uri.'" style="font-size:20px;">'.$name.'</a>
                      </li>';
    }

    echo trim($nav_menu);
}

/**
 * Displays page title. It takes the data from
 * URL, it replaces the hyphens with spaces and
 * it capitalizes the words.
 */
function pageTitle()
{
    $page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 'Home';

    echo ucwords(str_replace('-', ' ', $page));
}

/**
 * Displays page content. It takes the data from
 * the static pages inside the pages/ directory.
 * When not found, display the 404 error page.
 */
function pageContent()
{
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';

    $path = getcwd().'/'.config('content_path').'/'.$page.'.php';

    if (file_exists(filter_var($path, FILTER_SANITIZE_URL))) {
        include $path;
    } else {
        include config('content_path').'/404.php';
    }
}

function getContacts()
{
    $string = file_get_contents("./data/contacts.json");
    $contacts = json_decode($string, true);
    $contactsArray = $contacts["contacts"];
    foreach ($contactsArray as $contact) {
        echo '<div class="card bg-light mb-3" style="max-width: 20rem;">
                <div class="card-header">'. $contact["position"] . '</div>
                <div class="card-body">
                  <h4 class="card-title">' .$contact["name"] .  '</h4>
                  <p class="card-text"> ID: ' . $contact["id"] . '</p>
                  <p class="card-text"> Email: ' . $contact["email"] . '</p>
                </div>
              </div>';
    }
}


function getProducts()
{
    $string = file_get_contents("./data/products.json");
    $products = json_decode($string, true);
    $products = $products["products"];
    foreach ($products as $name => $detail) {
        echo '<a class="card" href="'.config('root').'index.php?page=detail&product='.$name.'">
                <img class="rounded" src="' .config('root').$detail["src"]. '" alt="'.$detail["alt"].'" style="height: 220px; width: 100%; display: block;"  data-holder-rendered="true">
                <p class="card-text text-center">'.$detail["description"].'</p>
              </a>';
    }
}

function getProductDetail()
{
    $product = isset($_GET['product']) ? $_GET['product'] : '';
    $string = file_get_contents("./data/products.json");
    $products = json_decode($string, true);
    $products = $products["products"];
    $item = $products[$product];

    // set cookie to record user recent visited products
    $info = array();
    if (isset($_COOKIE["recent_visit"])) {
        $info = unserialize($_COOKIE['recent_visit']);
    }
    if (false !== $key = array_search($product, $info)) {
        //find product in the array with position key
        //move the key to the front
        array_unshift($info, $product);
        $info = array_unique($info);
    } else {
        // product didn't find
        while (count($info) >= 5) {
            array_pop($info);
        }
        array_unshift($info, $product);
    }
    setcookie('recent_visit', serialize($info), time()+3600);

    echo '<div class="col-sm-5 offset-sm-1">
            <h1 class="featurette-heading">'.$item["description"].'</h1><br><span class="text-muted"><h4>Your Price&emsp;&emsp;&emsp;'.$item["price"].'</h4></span>
            <p class="lead">'.$item["chef"].'<br>'.$item["feature"].'</p>
            </div>
            <div class="col-sm-5">
              <img class="featurette-image img-fluid mx-auto rounded" data-src="holder.js/500x500/auto" alt="500x500" src="'.config('root').$item["src"].'" data-holder-rendered="true" style="width: 500px; height: 500px;">
            </div>';
}

function getRecent()
{
    if (isset($_COOKIE["recent_visit"])) {
        $string = file_get_contents("./data/products.json");
        $products = json_decode($string, true);
        $products = $products["products"];


        $info = unserialize($_COOKIE['recent_visit']);
        $index = 1;
        foreach ($info as $product) {
            $item = $products[$product];
            echo '<li><a href="'.config('root').'index.php?page=detail&product='.$product.'">'.$index." ".$item['description'].'</a></li>';
            $index++;
        }
    }
}

function getuserlist()
{
    if (!isset($_GET['keyword'])) {
        return;
    }
    $keyword = $_GET['keyword'];
    // according to key word , query db
    include('./content/dbh.php');
    //$repl = '<span style="font-weight: bold; color: red">' . $keyword . '</span>';

    $sql = 'SELECT * from users where uid like "%' . $keyword .'%" or first_name like "%'.$keyword.'%" or last_name like "%'.$keyword.'%" or email like "%'.$keyword.'%" or home_phone like "%'.$keyword.'%" or cell_phone like "%'.$keyword.'%"';
    $result = mysqli_query($conn, $sql);
    echo '<p class="form-signin-heading">Result:</p>';
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td><p style='color: LightGray'>--------------------</p></td></tr>".
            "<tr><th>Username:</th><td>".preg_replace("/$keyword/i", "<i style='color: red'>\$0</i>", $row['uid'])."</td></tr>".
            "<tr><th>Name:</th><td>".preg_replace("/$keyword/i", "<i style='color: red'>\$0</i>", $row['first_name'])." ".preg_replace("/$keyword/i", "<i style='color: red'>\$0</i>", $row['last_name'])."</td></tr>".
            "<tr><th>Email:</th><td>".preg_replace("/$keyword/i", "<i style='color: red'>\$0</i>", $row['email'])."</td></tr>".
            "<tr><th>Address:</th><td>".$row['home_address']."</td></tr>".
            "<tr><th>HomePhone:</th><td>".preg_replace("/$keyword/i", "<i style='color: red'>\$0</i>", $row['home_phone'])."</td></tr>".
            "<tr><th>CellPhone:</th><td>".preg_replace("/$keyword/i", "<i style='color: red'>\$0</i>", $row['cell_phone'])."</td></tr>";
        }
        echo "</table>";
    } else {
        echo '<p style="color:red">No such user!</p>';
    }
}

function getMarket()
{
    $topNum = isset($_GET['top']) ? (int)$_GET['top'] : 0;
    $companies = getCompanies();
    foreach ($companies as $company) {
        /*
          echo $company['company_id'];
          echo $company['name'];
          echo $company['description'];
          echo $company['owner'];
          echo $company['site'];
        */
        echo '<div class="container" style="font-size:30px;">Company: <a herf="#">'.$company['name'].'</a></div>';

        $products = $topNum ? getMostRatedEachCompany($topNum, $company['company_id']):getProductsByCompanyID($company['company_id']);
        if (!$products) {
            return;
        }
        echo '<div class="row">';
        foreach ($products as $product) {
            /*
              echo $product['name'];
              echo $product['src'];
              echo $product['alt'];
              echo $product['price'];
              echo $product['rate'];
            */
            $rate = number_format($product['rate'], 1);
            echo '<div class="card" style="width: 16rem;">
                <a href="'.config('root').'index.php?page=market_detail&product='.$product['product_id'].'">
                <img style="height: 220px; width: 100%; display: block;" class="card-img-top rounded" src='.'img/'.$product['company_id'].'/'.$product['src'].' alt='.$product['alt'].'>
                </a>
                <div class="card-body">
                <h6 class="card-title" style="height: 30px;">'.$product['name'].'</h6>

                <p class="card-text">Rating:'."$rate".'</p>
                <div class="rating">
                ';
            for ($i = 0; $i < 5; $i++) {
                if ($i < floor($product['rate'])) {
                    echo '<span class="glyphicon glyphicon-star"></span>';
                } else {
                    echo '<span class="glyphicon glyphicon-star-empty"></span>';
                }
            }

            echo '
                </div>
                <h5 style="color:red;">$ '.$product['price'].'</h5>
                ';
            getAddToCartBtn($product);
            echo '
              </div>
            </div>
            ';
            //etc
        }
        echo '</div>';
    }
}

function getAddToCartBtn($product)
{
    echo '
  <button
      class="snipcart-add-item btn btn-primary"
      data-item-id="'.$product['product_id'].'"
      data-item-name="'.$product['name'].'"
      data-item-price="'.$product['price'].'"
      data-item-weight="20"
      data-item-url="http://'.config('url').config('root').'index.php?page=market_detail&product='.$product['product_id'].'"
      data-item-description="'.$product['description'].'">
      Add to Cart
  </button>
  ';
}

function getTopRated()
{
    $products = getMostRatedInMarket(5);
    foreach ($products as $product) {
        /*
          echo $product['name'];
          echo $product['src'];
          echo $product['alt'];
          echo $product['price'];
          echo $product['rate'];
        */
        $rate = number_format($product['rate'], 1);
        echo '<div class="card" style="width: 16rem;">
          <a href="'.config('root').'index.php?page=market_detail&product='.$product['product_id'].'">
          <img style="height: 220px; width: 100%; display: block;" class="card-img-top" src='.'img/'.$product['company_id'].'/'.$product['src'].' alt='.$product['alt'].'>
          </a>
          <div class="card-body">
          <h5 class="card-title" style="height: 30px;">'.$product['name'].'</h5>

          <p class="card-text">Rating:'. "$rate" .'</p>
          <div class="rating">
          ';
        for ($i = 0; $i < 5; $i++) {
            if ($i < floor($product['rate'])) {
                echo '<span class="glyphicon glyphicon-star"></span>';
            } else {
                echo '<span class="glyphicon glyphicon-star-empty"></span>';
            }
        }

        echo '
          </div>
          <h5 style="color:red;">$ '.$product['price'].'</h5>
          <a href="#" class="btn btn-primary">Add to Cart</a>
        </div>
      </div></a>';
        //etc
    }
}







function getMarketProductDetail()
{
    if (!isset($_GET['product'])) {
        return;
    }
    $productID = (int)$_GET['product'];
    $product = getProductInfo($productID);
    if ($product) {
        $item = $product[0];
        $rate = number_format($item['rate'], 1);
        echo '
              <div class="row">
                <div class="col-sm-5 offset-sm-2">
                  <img class="img-thumbnail rounded featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="500x500" src="'.config('root').'img/'.$item['company_id'].'/'.$item["src"].'" data-holder-rendered="true" style="width: 450px; height: 450px; margin:0px auto; display:block;">
                </div>
                <div class="col-sm-5" style="margin:20px auto;">
                <div class="col-sm-6" style="text-align: center;">
                <p class="lead" style="color:black; font-size:30px; font-family:Roboto, sans-serif;">'.$item["name"].'</p>
                <p style="font-size:20px; font-family:Spectral SC, sans-serif;">Company: '.$item["company_id"].'</p>

                <span class="text-muted" style="font-size:30px;">Your Price:&nbsp;<span style="color:red;">$
                '.$item["price"].'</span></span>
                <span>Rating: '."$rate".'</span>
                <div class="rating">
                ';
        for ($i = 0; $i < 5; $i++) {
            if ($i < floor($item['rate'])) {
                echo '<span class="glyphicon glyphicon-star"></span>';
            } else {
                echo '<span class="glyphicon glyphicon-star-empty"></span>';
            }
        }

        echo '
                </div>
                <br>
                ';

        getAddToCartBtn($item);
        echo '
                </div>

                </div>
                </div>';
    }

    function getHiddenInfo()
    {
        if (!isset($_GET['product'])) {
            return;
        }
        $productID = $_GET['product'];
        echo '
        <input type="hidden" name="product_id" value="'.$productID.'" />

      ';
    }


    $comments = getCommentListByProductID($productID);
    if ($comments) {
        echo '<section id="product_content" style="margin:100px 0px 0px 0px">
        <div class="container" style="margin:0px auto; max-width:800px"><h3 class="text-success">Reviews</h3>';
        foreach ($comments as $comment) {
            /*
              echo $comment['first_name'];
              echo $comment['last_name'];
              echo $comment['timestamp'];
              echo $comment['rate'];
              echo $comment['comment'];
            */
            $seconds_ago = (time() - $comment['timestamp']);
            if ($seconds_ago >= 31536000) {
                $caltime = intval($seconds_ago / 31536000) . " years ago";
            } elseif ($seconds_ago >= 2419200) {
                $caltime = intval($seconds_ago / 2419200) . " months ago";
            } elseif ($seconds_ago >= 86400) {
                $caltime = intval($seconds_ago / 86400) . " days ago";
            } elseif ($seconds_ago >= 3600) {
                $caltime = intval($seconds_ago / 3600) . " hours ago";
            } elseif ($seconds_ago >= 60) {
                $caltime = intval($seconds_ago / 60) . " minutes ago";
            } else {
                $caltime = "Less than 1 minute";
            }

            echo '
          <div class="review-block">
  					<div class="row">
  						<div class="col-sm-3">
  							<img src="https://image.flaticon.com/icons/svg/163/163841.svg" style="width: 100px; height: 100px; margin:0px auto; display:block;" class="img-rounded">
  							<div class="review-block-name"><p style="font-size:15px; font-family:Arimo, sans-serif; text-align: center;">'.$comment['first_name'].'&nbsp;'.$comment['last_name'].'</p></div>
  							<div class="review-block-date" style="text-align: center;">'.$caltime.'</div>
  						</div>
  						<div class="col-sm-9">
              <div class="rating">
              ';
            for ($i = 0; $i < 5; $i++) {
                if ($i < floor($comment['rate'])) {
                    echo '<span class="glyphicon glyphicon-star"></span>';
                } else {
                    echo '<span class="glyphicon glyphicon-star-empty"></span>';
                }
            }

            echo '
              </div>
                <br>
  							<div class="review-block-title">'.$comment['comment'].'</div>
  						</div>
  					</div>
          </div>';
        }
        echo '</section>';
    }
}

/*
<div class="rating">
                            <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star">
                            </span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star">
                            </span><span class="glyphicon glyphicon-star-empty"></span>
                        </div>
*/
/**
 * Starts everything and displays the template.
 */
function run()
{
    include config('template_path').'/template.php';
}
