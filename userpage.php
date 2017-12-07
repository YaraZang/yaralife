<?php
include('./content/dbh.php');
$sql = 'SELECT * from users';
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    echo "<table><tr><th>Username</th><th>Name</th><th>Email</th><th>Address</th><th>HomePhone</th><th>CellPhone</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row['uid']."</td><td>".$row['first_name']." ".$row['last_name']."</td><td>".$row['email']."</td><td>".$row['home_address']."</td><td>".$row['home_phone']."</td><td>".$row['cell_phone']."</td></tr>";
    }
    echo "</table>";
}
