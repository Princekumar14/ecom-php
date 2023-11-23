<?php 
require("connection.inc.php");
require("functions.inc.php");
$name = get_safe_value($conn, $_POST['name']);
$email = get_safe_value($conn, $_POST['email']);
$mobile = get_safe_value($conn, $_POST['mobile']);
$comment = get_safe_value($conn, $_POST['message']);
$added_on = date('Y-m-d h:i:s');
$sql = "INSERT INTO contact_us (name, email, mobile, comment, added_on) VALUES('%s', '%s', '%s', '%s', '%s')";
$sql = sprintf($sql, $name, $email, $mobile, $comment, $added_on);
mysqli_query($conn, $sql);
echo "Thank You";
?> 