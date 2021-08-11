<?php 
include '../core/config.php';
$core = new CoreFunctions();

$action = $_POST['action'];

switch ($action) {
    case 'add':
        $prodName = $_POST['prodName'];
        $productCat = $_POST['productCat'];
        $price = $_POST['price'];
        $curdate = $core->GETCURRENTDATE();

        $sql = $core->SELECT_QUERY("count(*) as c","products","product_name = '$prodName'");

        if($sql['c'] > 0){
            echo 2;
        }else{
            $data = array("product_name" => $prodName, "product_category" => $productCat, "price" => $price, "date_added" => $curdate);

            $insert = $core->INSERT_QUERY('products',$data);

            echo $insert;
        }
    break;
    case 'update':
        $name = $_POST['prodName'];
        $category = $_POST['categID'];
        $prodPrice = $_POST['prodPrice'];
        $product_id = $_POST['product_id'];

        $data = array("product_name" => $name, "product_category" => $category, "price" => $prodPrice);

        $update = $core->UPDATE_QUERY("products",$data, " WHERE product_id = '$product_id'");

        echo $update;
        
    break;
    case 'delete':
        $product_id = $_POST['product_id'];

        $delete = $core->DELETE_QUERY("products", " WHERE product_id = '$product_id'");

        echo $delete;
        
    break;
    default:
       
        break;
}






