<?php

function pr($arr){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";

}
function prx($arr){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
    die();

}
function get_safe_value($conn, $str){
    return mysqli_real_escape_string($conn,addslashes((htmlentities($str))));

}

?>