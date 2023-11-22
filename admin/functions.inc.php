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
    if($str != ''){
        $str = trim($str);
        return mysqli_real_escape_string($conn,addslashes((htmlentities($str))));

    }

}


// function upload_image($image_name,$file_name_attribute_value, $file_path, $security = false){
function upload_image($file_name_attribute_value, $file_path, $security = true){

    if($security == false){
        $file_name = $_FILES["$file_name_attribute_value"]['name'];
        $file_tmp = $_FILES["$file_name_attribute_value"]['tmp_name'];
        $finalName=time()."_".$file_name;
        // $image_name = $image_name;
        // $image_name = $finalName;
         move_uploaded_file($file_tmp, "$file_path".$finalName); 
         return $finalName;
    }else{
 
        $errors = array();
        
        $file_name = $_FILES["$file_name_attribute_value"]['name'];
        $file_size = $_FILES["$file_name_attribute_value"]['size'];
        $file_tmp = $_FILES["$file_name_attribute_value"]['tmp_name'];
        $file_type = $_FILES["$file_name_attribute_value"]['type'];
        $fileName = explode('.', $file_name);
        $file_ext = strtolower(end($fileName));
        $extensions = array("jpeg", "jpg", "png");
        $finalName=time()."_".$file_name;
        if(in_array($file_ext, $extensions) === false){
        $errors[] = "This extension file is not alllowed, Please choose a JPG or PNG file.";
        }
        if($file_size > 2097152){
            $errors[] = "File size must be 2mb or lower.";
        }
        if(empty($errors) == true){
            move_uploaded_file($file_tmp, "$file_path".$finalName); 
        }else{
            print_r($errors);
            die();
        }
        return $finalName;
    }
    
}

?>