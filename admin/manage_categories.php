<?php
require("top.inc.php");
$categories="";
$msg ="";
if(isset($_GET['id']) && $_GET['id'] != ''){
    $id = get_safe_value($conn, $_GET['id']);
    $get_edit_category_sql = "SELECT * FROM categories WHERE id='%s'";
    $get_edit_category_sql = sprintf($get_edit_category_sql,  $id);
    $res = mysqli_query($conn, $get_edit_category_sql);
    $check = mysqli_num_rows($res);
    if($check > 0){
        $row = mysqli_fetch_assoc($res);
        $categories = $row['categories'];

    }else{
        header('location:categories.php');
        die();
    }
    
}
if(isset($_POST['submit'])){
    $categories = get_safe_value($conn, $_POST['categories']);

    $get_existed_category_sql = "SELECT * FROM categories WHERE categories='%s'";
    $get_existed_category_sql = sprintf($get_existed_category_sql,  $categories);
    $res = mysqli_query($conn, $get_existed_category_sql);
    $check = mysqli_num_rows($res);
    if($check > 0){
        if(isset($_GET['id']) && $_GET['id'] != ''){
            $getData = mysqli_fetch_assoc($res);
            if($id == $getData['id']){

            }else{
                $msg = "Category already exist.";
            }
        }
        else{
            $msg = "Category already exist.";

        }
        
    }
    if($msg == ''){
        if(isset($_GET['id']) && $_GET['id'] != ''){
            $edit_category_sql = "UPDATE categories SET categories='%s' WHERE id='%s';";
            $edit_category_sql = sprintf($edit_category_sql,  $categories, $id);
            mysqli_query($conn, $edit_category_sql);
            
        }else{
            $add_category_sql = "INSERT INTO categories(categories, status) VALUES('%s', '1');";
            $add_category_sql = sprintf($add_category_sql,  $categories);
            mysqli_query($conn, $add_category_sql);
            
        }
        header('location:categories.php');
        die();
    }
}

              
?>

<div class="content pb-0">
    <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Categories</strong><small> Form</small></div>
                        <form method="post">
                            <div class="card-body card-block">
                                <div class="form-group"><label for="categories" class=" form-control-label">Categories</label><input type="text" name="categories" placeholder="Enter your categories name" class="form-control" required value="<?php echo $categories; ?>"></div>
                                <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Submit</span>
                                </button>
                                <div class="field_error"><?php echo $msg; ?></div>
                            </div>
                        </form>
                     </div>
                  </div>
               </div>
    </div>
</div>

<?php
require("footer.inc.php");
?>