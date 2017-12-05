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
                        <a class="nav-link" href="'.config('root').'index.php'. ($uri == '' ? '' : '?page=') .$uri.'" >'.$name."&nbsp".'</a>
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
                <img src="' .config('root').$detail["src"]. '" alt="'.$detail["alt"].'" style="height: 220px; width: 100%; display: block;"  data-holder-rendered="true">
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
    echo '  <div class="col-md-6 order-md-2">
            <h1 class="featurette-heading">'.$item["description"].'</h1><br><span class="text-muted"><h4>Your Price&emsp;&emsp;&emsp;'.$item["price"].'</h4></span>
            <p class="lead">'.$item["chef"].'<br>'.$item["feature"].'</p>
            </div>
            <div class="col-md-6 order-md-1">
              <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="500x500" src="'.config('root').$item["src"].'" data-holder-rendered="true" style="width: 500px; height: 500px;">
            </div>';

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
    include('./content/users_dbh.php');
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

/**
 * Starts everything and displays the template.
 */
function run()
{
    include config('template_path').'/template.php';
}
