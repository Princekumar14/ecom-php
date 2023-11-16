<?php
require("top.inc.php");
$categories_id="";
$name="";
$mrp="";
$price="";
$qty="";
$image="";
$short_desc="";
$description="";
$meta_title="";
$meta_desc="";
$meta_keyword="";
// $status="";
$msg ="";
if(isset($_GET['id']) && $_GET['id'] != ''){
    $id = get_safe_value($conn, $_GET['id']);
    $get_edit_category_sql = "SELECT * FROM product WHERE id='%s'";
    $get_edit_category_sql = sprintf($get_edit_category_sql,  $id);
    $res = mysqli_query($conn, $get_edit_category_sql);
    $check = mysqli_num_rows($res);
    if($check > 0){
        $row = mysqli_fetch_assoc($res);
        $categories_id = $row['categories_id'];
        $name = $row['name'];
        $mrp = $row['mrp'];
        $price = $row['price'];
        $qty = $row['qty'];
        $image = $row['image'];
        $short_desc = $row['short_desc'];
        $description = $row['description'];
        $meta_title = $row['meta_title'];
        $meta_desc = $row['meta_desc'];
        $meta_keyword = $row['meta_keyword'];

    }else{
        header('location:product.php');
        die();
    }
    
}
if(isset($_POST['submit'])){
    $categories_id = get_safe_value($conn, $_POST['categories_id']);
    $name = get_safe_value($conn, $_POST['name']);
    $mrp = get_safe_value($conn, $_POST['mrp']);
    $price = get_safe_value($conn, $_POST['price']);
    $qty = get_safe_value($conn, $_POST['qty']);
    // $image = get_safe_value($conn, $_POST['image']);
    $short_desc = get_safe_value($conn, $_POST['short_desc']);
    $description = get_safe_value($conn, $_POST['description']);
    $meta_title = get_safe_value($conn, $_POST['meta_title']);
    $meta_desc = get_safe_value($conn, $_POST['meta_desc']);
    $meta_keyword = get_safe_value($conn, $_POST['meta_keyword']);

    $get_existed_category_sql = "SELECT * FROM product WHERE name='%s'";
    $get_existed_category_sql = sprintf($get_existed_category_sql,  $categories);
    $res = mysqli_query($conn, $get_existed_category_sql);
    $check = mysqli_num_rows($res);
    if($check > 0){
        if(isset($_GET['id']) && $_GET['id'] != ''){
            $getData = mysqli_fetch_assoc($res);
            if($id == $getData['id']){

            }else{
                $msg = "Product already exist.";
            }
        }
        else{
            $msg = "Product already exist.";

        }
        
    }
    if($msg == ''){
        if(isset($_GET['id']) && $_GET['id'] != ''){
            $edit_product_sql = "UPDATE categories SET categories_id='%s', name='%s', mrp='%s', price='%s', qty='%s', short_desc='%s', description='%s', meta_title='%s', meta_desc='%s',  meta_keyword='%s', WHERE id='%s';";
            $edit_product_sql = sprintf($edit_product_sql,  $categories_id, $name, $mrp, $price, $qty, $short_desc, $description, $meta_title, $meta_desc, $meta_keyword, $id);
            mysqli_query($conn, $edit_product_sql);
            
        }else{
            $add_product_sql = "INSERT INTO product(categories_id,name,mrp,price,qty,short_desc,description, meta_title, meta_desc, meta_keyword, status) VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '1' );";
            $add_product_sql = sprintf($add_product_sql,  $categories_id, $name, $mrp, $price, $qty, $short_desc, $description, $meta_title, $meta_desc, $meta_keyword );
            mysqli_query($conn, $add_product_sql);
            
        }
        header('location:product.php');
        die();
    }
}

              
?>

<div class="content pb-0">
    <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Product</strong><small> Form</small></div>
                        <form method="post" enctype="multipart/form-data" autocomplete="off">
                            <div class="card-body card-block">
                                <div class="form-group">
                                    <label for="categories" class=" form-control-label">Categories</label>
                                    <select class="form-control" name="categories_id" id="">
                                        <option value="">Select Categories</option>
                                        <?php 
                                        $sql = "SELECT id, categories FROM categories ORDER BY categories";
                                        $sql = sprintf($sql,  $categories);
                                        $res = mysqli_query($conn, $sql);
                                        
                                        if(mysqli_num_rows($res) > 0){
                                            while($row = mysqli_fetch_assoc($res)){
                                                if($row['id'] == $categories_id){
                                                    $selected = "selected";
                                                }else{
                                                    $selected = "";
    
                                                }
                                                echo "<option {$selected} value=".$row['id'].">".$row['categories']."</option>";
                                            }
                                        }    
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group"><label for="categories" class=" form-control-label">Product Name</label><input type="text" name="name" placeholder="Enter product name" class="form-control" required value="<?php echo $name; ?>"></div>
                                <div class="form-group"><label for="categories" class=" form-control-label">MRP</label><input type="text" name="mrp" placeholder="Enter product mrp" class="form-control" required value="<?php echo $mrp; ?>"></div>
                                <div class="form-group"><label for="categories" class=" form-control-label">Price</label><input type="text" name="price" placeholder="Enter product price" class="form-control" required value="<?php echo $price; ?>"></div>
                                <div class="form-group"><label for="categories" class=" form-control-label">QTY</label><input type="text" name="qty" placeholder="Enter product qty" class="form-control" required value="<?php echo $qty; ?>"></div>
                                <div class="form-group"><label for="categories" class=" form-control-label">Image</label><input type="file" name="image" placeholder="Enter product image" class="form-control" required value="<?php echo $image; ?>"></div>
                                <div class="form-group"><label for="categories" class=" form-control-label">Short Description</label><textarea name="short_desc" placeholder="Enter product short description" class="form-control" required ><?php echo $short_desc; ?></textarea></div>
                                <div class="form-group"><label for="categories" class=" form-control-label">Description</label><textarea name="description" placeholder="Enter product description" class="form-control" required ><?php echo $description; ?></textarea></div>
                                <div class="form-group"><label for="categories" class=" form-control-label">Meta Title</label><textarea name="meta_title" placeholder="Enter product meta title" class="form-control" required ><?php echo $meta_title; ?></textarea></div>
                                <div class="form-group"><label for="categories" class=" form-control-label">Meta Description</label><textarea name="meta_desc" placeholder="Enter product meta description" class="form-control" required ><?php echo $meta_desc; ?></textarea></div>
                                <div class="form-group"><label for="categories" class=" form-control-label">Meta Keyword</label><textarea name="meta_keyword" placeholder="Enter product meta keyword" class="form-control" required ><?php echo $meta_keyword; ?></textarea></div>


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