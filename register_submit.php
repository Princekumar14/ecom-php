<?php 
require("connection.inc.php");
require("functions.inc.php");
$name = get_safe_value($conn, $_POST['name']);
$email = get_safe_value($conn, $_POST['email']);
$mobile = get_safe_value($conn, $_POST['mobile']);
$password = get_safe_value($conn, $_POST['password']);
$added_on = date('Y-m-d h:i:s');
$arr=array();
$arr["message"]="";
$arr["error"]=false;
$arr["data"]="";
$arr["errormessage"]="";
$check_user_sql = "SELECT * FROM users WHERE email='%s'";
$check_user_sql = sprintf($check_user_sql, $email);
// echo $check_user_sql;
// die;
$row = mysqli_query($conn, $check_user_sql);
$check_user = mysqli_num_rows($row);


// while($res = mysqli_fetch_assoc($row)){
//     $data[] = $res;
// }
// $arr["data"]=$data;


if($check_user > 0){
    $arr["message"] ="email_present";

}else{
    $sql = "INSERT INTO users (name, email, mobile, password, added_on) VALUES('%s', '%s', '%s', '%s', '%s')";
    $sql = sprintf($sql, $name, $email, $mobile, $password, $added_on);
    if(mysqli_query($conn, $sql))
    {
      $arr["message"] = "insert";   
    }
    else
    {
        $arr["error"]=true;
        $arr["errormessage"] ="Something Went Wrong";
    }
    // echo "Registered successfully.";
    

}
echo json_encode($arr);
?>    