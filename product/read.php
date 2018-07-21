<?php 
//required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//include the files we previously created
include_once '../config/database.php';
include_once '../objects/product.php';

$database = new Database();
$db = $database->getConnection();

//initialise object
$product = new Product($db);

//query products
$stmt = $product->read();
$num =$stmt->rowCount();

if($num > 0){
    //products array
    $products_arr = array();
    $products_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        //creating a map<k,v> for a product
        $product_item = array(
            "id" => $id,
            "name" => $name,
            "description" => html_entity_decode($description),
            "price" =>$price,
            "category_id" => $category_id,
            "category_name" => $category_name
        );

        array_push($products_arr,$product_item);
    }

    echo json_encode($products_arr);
}else{
    echo json_encode(
        array("message" => "No products found.")
    );
}

?>
