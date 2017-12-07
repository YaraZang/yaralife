<?php
session_start();
$uid = $_SESSION['username'];
include('dbh.php');
if (isset($_POST['commentsubmit'])
    && !empty($_POST['comment'])) {
    $comment = $_POST['comment'];
    //$rate = $_POST['rate'];
    $rate = rand(0, 5);
    $timestamp = time();
    $statement = 'select id from users where uid="'.$uid.'"';
    if ($result = mysqli_query($conn, $statement)) {
        if (mysqli_num_rows($result) > 0) {
            $uid = mysqli_fetch_assoc($result);
            $uid = $uid['id'];
        }
    } else {
        return ;
    }


    $product_id = $_POST['product_id'];

    $sql = "INSERT INTO comment (user_id, product_id, timestamp, rate, comment)   VALUES ('$uid', '$product_id', '$timestamp', '$rate', '$comment')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        // success
        echo 'success';
    } else {
        //fail
        echo 'fail';
    }
    header('Location: ../index.php?market_detail&product='.$product_id) ;
}
