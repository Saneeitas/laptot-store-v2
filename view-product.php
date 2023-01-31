<?php
 session_start();
require('connection.php');

if(isset($_GET["product_id"]) && !empty($_GET["product_id"])){
    $id = $_GET["product_id"];
    //sql & query
    $sql = "SELECT * FROM products WHERE id ='$id' ";
    $query = mysqli_query($connection,$sql);
    //result
    $result = mysqli_fetch_assoc($query);
}else{
    header("location: index.php");
}
//session to store url
$_SESSION["url"] = $_GET["product_id"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Bungee+Inline|Nunito+Sans" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <title>The Laptop Store!</title>

</head>

<body>
<div class="container">
    <h1>The Laptop Store!</h1>
    <figure class="laptop">
        <p class="laptop__price">$<?php echo number_format($result["price"]); ?></p>
        <a href="index.php" class="laptop__back"><span class="emoji-left">👈</span>Back</a>
        <div class="laptop__hero">
            <img src="<?php echo $result["image"]; ?>" alt="" class="laptop__img">
        </div>
        <h2 class="laptop__name"><?php echo $result["productName"]; ?></h2>
        <div class="laptop__details">
            <p><span class="emoji-left">🖥</span><?php echo $result["screen"]; ?></p>
            <p><span class="emoji-left">🧮</span> <?php echo $result["cpu"]; ?></p>
            <p><span class="emoji-left">💾</span> <?php echo $result["storage"]; ?></p>
            <p><span class="emoji-left">📦</span><?php echo $result["ram"]; ?></p>
        </div>
        <p class="laptop__description"><?php echo $result["description"]; ?></p>
        <p class="laptop__source">Source: <a href="https://www.techradar.com/news/mobile-computing/laptops/best-laptops-1304361"
                target="_blank">https://www.techradar.com/news/mobile-computing/laptops/best-laptops-1304361</a></p>
        <a href="make-payment.php?product_id=<?php echo $result["id"]; ?>" class="laptop__link">Buy now for $<?php echo number_format($result["price"]); ?> <span class="emoji-right">🥳 😍</span></a>
    </figure>
</div>
</body>

</html>

