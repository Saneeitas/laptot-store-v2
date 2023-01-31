<?php
require('connection.php');
 
if(isset($_POST["add_product"])){
    //uploading to upload folder
$target_dir = "uploads/";
$basename = basename($_FILES["image"]["name"]);
$upload_file = $target_dir.$basename;
//move uploaded file
$move = move_uploaded_file($_FILES["image"]["tmp_name"],$upload_file);
if($move){
    $url = $upload_file;
    $product = $_POST["product"];
    $cpu = $_POST["cpu"];
    $ram = $_POST["ram"];
    $storage = $_POST["storage"];
    $screen = $_POST["screen"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    $image = $url;
    //sql
    $sql = "INSERT INTO products(productName,image,cpu,ram,storage,screen,price,description)
    VALUES ('$product','$image','$cpu','$ram','$storage','$screen','$price','$description')";
    $query = mysqli_query($connection,$sql);
    if($query){
       //success message
        $success = "Product added";
    }else{
        $error = "Unable to add product <br>".mysqli_error($connection);
    }  
}else{
    $error = "Unable to upload image";
}
  
}

if(isset($_POST["flutterwave"])){
    $tx_id = $_POST["flutterwave"];
    $curl = curl_init();
 
   curl_setopt_array($curl, array(
   CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/$tx_id/verify",
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_ENCODING => "",
   CURLOPT_MAXREDIRS => 10,
   CURLOPT_SSL_VERIFYHOST => 0,
   CURLOPT_SSL_VERIFYPEER => 0,
   CURLOPT_TIMEOUT => 0,
   CURLOPT_FOLLOWLOCATION => true,
   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
   CURLOPT_CUSTOMREQUEST => "GET",
   CURLOPT_HTTPHEADER => array(
     "Content-Type: application/json",
     "Authorization: Bearer FLWSECK_TEST-962464e907a581d3fd3bacfc351fb39e-X"
   ),
 ));
 
 $response = curl_exec($curl);
 
 curl_close($curl);
 $jsondata = json_decode($response);
 header("Content-Type: application/json");
 //check if the payment is valid
 if($jsondata ->status == "success"){
     //looping through session cart to get product id & quantity
     foreach($_SESSION["cart"] as $pid => $value){
 
         //getting payment data from flutterwave and session
         $order_id = $jsondata->data->tx_ref;
         $amount = $jsondata->data->amount;
         $user_id = $_SESSION["user"]["id"];
         $product_id = $pid ;
         $quantity = $value["quantity"];
         $status = "Processing..";
         $payment_status = "Paid";
         $payment_method = "Flutterwave";
         //insert into DB table
         $sql = "INSERT INTO orders(order_id,amount,user_id,product_id,quantity,
                             status,payment_status,payment_method)
                 VALUES('$order_id','$amount','$user_id','$product_id','$quantity',
                        '$status','$payment_status','$payment_method')";
         $query = mysqli_query($connection,$sql);
     }
         //empty cart
         unset($_SESSION["cart"]);
      //return success message
      $response2 = ["code" => 200];  
      echo json_encode($response2);
 }else{
     $response2 = ["code" => 401];
     echo json_encode($response2);
 }
 
 }


?>