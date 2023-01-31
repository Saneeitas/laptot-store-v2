<?php
session_start();
require('connection.php');

if (isset($_GET["product_id"]) && !empty($_GET["product_id"])) {
  $id = $_GET["product_id"];
  //sql & query
  $sql = "SELECT * FROM products WHERE id ='$id' ";
  $query = mysqli_query($connection, $sql);
  //result
  $result = mysqli_fetch_assoc($query);
} else {
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

    <title>Make Your Payment /// The Laptop Store!</title>

</head>

<body>
    <div class="container">
        <h1>The Laptop Store!</h1>
        <figure class="laptop">
            <a href="view-product.php?product_id=<?php echo $result["id"]; ?>" class="laptop__back"><span
                    class="emoji-left">👈</span>Back</a>
            <div class="laptop__hero">
                <img src="<?php echo $result["image"]; ?>" alt="" class="laptop__img">
            </div>
            <h2 class="laptop__name"><?php echo $result["productName"]; ?></h2>
            <div class="laptop__description">
                <h3 style="text-align:center;"><span class="emoji-left"></span>
                    <img src="flutterwave.png" id="flutterpay" style="height:100px;" alt="flutterwave.png">
                </h3>
            </div>
            <a href="#" onclick="FlutterwavePayment()" id="flutterpay" class="laptop__link">Pay
                $<?php echo number_format($result["price"]); ?> </a>
        </figure>
    </div>

    <script>
    //Flutterwave payment api
    function makePayment() {
        var p = FlutterwaveCheckout({
            public_key: "FLWPUBK_TEST-9e6996ddee197d8250405bee63bb07c8-X",
            tx_ref: "<?php echo "BHC_" . substr(rand(0, time()), 0, 6); ?>",
            amount: <?php echo $total ?? 0; ?>,
            currency: "NGN",
            country: "NG",
            payment_options: " ",
            customer: {
                email: "<?php echo $_SESSION["user"]["email"] ?>",
                phone_number: " ",
                name: "<?php echo $_SESSION["user"]["name"] ?>",
            },
            callback: function(data) {
                console.log(data);
                p.close();
                //make ajax request
                var tx_id = data.transaction_id;
                $.ajax({
                    type: "POST",
                    url: "ajax.php",
                    data: {
                        "flutterwave": tx_id
                    },
                    beforeSend: function() {
                        $("#message").fadeIn();
                        $("#flutterpay").fadeOut();
                    },
                    success: function(response) {
                        if (response.code == 200) {
                            $("#message").find("strong").html(
                                "Payment Successfully made!<br>Now redirecting to orders page.."
                            );
                            //redirecting to orders page
                            window.location.href = "user.php";
                        }
                    }
                });
            },
            onclose: function() {
                alert("payment cancelled");
            },
            customizations: {
                title: "Product Checkout",
                description: "Payment for item in cart",
                // logo: "https://www.logolynx.com/images/logolynx/22/2239ca38f5505fbfce7e55bbc0604386.jpeg",
            },
        });
    }
    </script>

</body>

</html>