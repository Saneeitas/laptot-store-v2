<?php
session_start();
require('connection.php');

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
        <?php
        //displaying the products from database
        $sql = "SELECT * FROM products ORDER BY id DESC";
        $query = mysqli_query($connection, $sql);
        while ($result = mysqli_fetch_assoc($query)) {
            //Looping through the col for multiples product
        ?>
        <div style="display:flex">
            <div class=" cards-container">
                <?php
                    $id = $result["id"];
                    $sql2 = "SELECT * FROM products WHERE id = '$id'";
                    $query2 = mysqli_query($connection, $sql2);
                    $result2 = mysqli_fetch_assoc($query2)
                    ?>
                <figure class="card" style="width: 300px;">
                    <div class="card__hero">
                        <img src="<?php echo $result["image"]; ?>" alt="" class="card__img">
                    </div>
                    <h2 class="card__name"><?php echo $result["productName"]; ?></h2>
                    <p class="card__detail"><span class="emoji-left">🖥</span><?php echo $result["screen"]; ?></p>
                    <p class="card__detail"><span class="emoji-left">🧮</span> <?php echo $result["cpu"]; ?></p>
                    <div class="card__footer">
                        <p class="card__price">$<?php echo number_format($result["price"]); ?></p>
                        <a href="view-product.php?product_id=<?php echo $result["id"]; ?>" class="card__link">Check it
                            out
                            <span class="emoji-right">👉</span></a>
                    </div>
                </figure>
                <?php
            }
                ?>
            </div>
        </div>
    </div>
</body>

</html>