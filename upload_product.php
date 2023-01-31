<?php
require('connection.php');
include('process.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPTOP STORE</title>

   <link rel="stylesheet" type="text/css" href="http://localhost/Frameworks/fontawesome-free-5.15.4-web/css/all.css">
   <link rel="stylesheet" type="text/css" href="http://localhost/Frameworks/fontawesome-free-5.15.4-web/css/fontawesome.css">
   <link rel="stylesheet" type="text/css" href="http://localhost/Frameworks/fontawesome-free-5.15.4-web/css/regular.css">
   <link rel="stylesheet" type="text/css" href="http://localhost/Frameworks/fontawesome-free-5.15.4-web/css/solid.css">
   <link rel="stylesheet" type="text/css" href="http://localhost/Frameworks/Bootstrap/css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="style.css">


</head>


<div class="container">
    <div class="row">
        <h1>ADD PRODUCTS</h1>
        <div class="col-6">
        <?php 
     if(isset($error)) {
     ?>
     <div class="alert alert-danger">
         <strong><?php echo $error ?></strong>
     </div>
     <?php
          }elseif (isset($success)) {
     ?>
     <div class="alert alert-success">
     <strong><?php echo $success ?></strong>
     </div>
     <?php
    }
  ?>

<form action="" method="post" enctype="multipart/form-data">
     <div class="form-group">
         <label for="">Product </label>
         <input type="text" name="product" placeholder="Enter product name"
          class="form-control" id="" required>
     </div> 
     <div class="form-group">
         <label for="">Select image</label>
         <input type="file" name="image" id="" class="form-control" required>
     </div>
     <div class="row">
         <div class="col-6">
             <div class="form-group">
                 <label for="">CPU</label>
                 <input type="text" name="cpu" placeholder="Enter cpu name"
                  class="form-control" id="" required>
             </div>
         </div>
        <div class="col-6">
                <div class="form-group">
                    <label for="">RAM</label>
                    <input type="text" name="ram" placeholder="Enter ram name"
                    class="form-control" id="" required>
                </div>
            </div> 
     </div>
    <div class="form-group">
    <label for="">Storage </label>
    <input type="text" name="storage" placeholder="Enter storage name"
     class="form-control" id="" required>
</div> 
<div class="form-group">
    <label for="">Screen </label>
    <input type="text" name="screen" placeholder="Enter screen name"
     class="form-control" id="" required>
</div> 
     <div class="form-group">
         <label for="">Price</label>
         <input type="number" name="price" class="form-control"
          placeholder="Enter product price" id="">
     </div>
     <div class="form-group">
         <label for="">Description</label>
         <textarea name="description" id="" placeholder="Enter system description" 
           cols="30" rows="10" class="form-control" required></textarea>
           </div>   
           <div class="form-group">
         <button type="submit" name="add_product" 
          class="btn btn-sm text-light my-2" style="background-color:#FF6347;">
          Add <i class="fas fa-plus"></i></button>
     </div>
  </div>
</form>

        </div>
    </div>


</div>

<body>