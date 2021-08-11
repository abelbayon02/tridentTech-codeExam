<?php 
include '../core/config.php';
$core = new CoreFunctions();

$action = $_POST['action'];

switch ($action) {
    case 'add':
        $name = $_POST['prodCat'];
        $category = $_POST['catDescription'];

        $sql = $core->SELECT_QUERY("count(*) as c","product_category","category_name = '$name'");

        if($sql['c'] > 0){
            echo 2;
        }else{
            $data = array("category_name" => $name, "category_desc" => $category);

            $insert = $core->INSERT_QUERY('product_category',$data);

            echo $insert;
        }
    break;
    case 'update':
        $name = $_POST['name'];
        $category = $_POST['categ'];
        $category_id = $_POST['category_id'];

        $sql = $core->SELECT_QUERY("count(*) as c","product_category","category_name = '$name'");
        if($sql['c'] > 0){
            echo 2;
        }else{
            $data = array("category_name" => $name, "category_desc" => $category);

            $update = $core->UPDATE_QUERY("product_category",$data, " WHERE category_id = '$category_id'");

            echo $update;
        }
    break;
    case 'delete':
        $category_id = $_POST['category_id'];

        $delete = $core->DELETE_QUERY("product_category", " WHERE category_id = '$category_id'");

        echo $delete;
        
    break;
    default:
       
        break;
}






