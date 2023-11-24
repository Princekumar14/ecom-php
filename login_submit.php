<?php 
require("connection.inc.php");
require("functions.inc.php");

$email = get_safe_value($conn, $_POST['email']);
$password = get_safe_value($conn, $_POST['password']);

$arr=array();
$arr["message"]="";
$arr["error"]=false;
$arr["data"]="";
$arr["errormessage"]="";

$check_user_sql = "SELECT * FROM users WHERE email='%s' AND password='%s'";
$check_user_sql = sprintf($check_user_sql, $email, $password);
// echo $check_user_sql;
// die;
$res = mysqli_query($conn, $check_user_sql);
$check_user = mysqli_num_rows($res);

if($check_user > 0){
    $row = mysqli_fetch_assoc($res);
    $_SESSION['USER_LOGIN']='yes';
    $_SESSION['USER_ID']=$row['id'];
    $_SESSION['USER_NAME']=$row['name'];
    $arr["message"] ="valid";
    
}else{
    // $sql = "INSERT INTO users (name, email, mobile, password, added_on) VALUES('%s', '%s', '%s', '%s', '%s')";
    // $sql = sprintf($sql, $name, $email, $mobile, $password, $added_on);
    // mysqli_query($conn, $sql);
    // echo "Registered successfully.";
    // echo "wrong"; 
    $arr["message"] ="wrong";

}
echo json_encode($arr);
?> 