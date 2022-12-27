<?php 
    include_once "config/DBconnecter.php";
    $sql_pagination = "SELECT product.prd_id, prd_name, prd_price, prd_image, cat_name FROM product 
     INNER JOIN category ON product.cat_id = category.cat_id WHERE product.cat_id = 3 ORDER BY prd_id DESC";
    $resultPagination = mysqli_query($conn, $sql_pagination);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Foot Shop</title>
  <head>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/product.css" />
    <script src="js/script.js"></script>
  </head>
  <body>
    <!--begin header-->
    <?php include("pages/header.php") ?>;

    <!--end header-->
    <?php include("pages/slider.php") ?>;
    <!--end slider-->
    
    <!--start product-->
    
<div class="product-container">
    <div class="product-card">
        <?php  if(mysqli_num_rows($resultPagination) > 0) {
            while ($row = mysqli_fetch_assoc($resultPagination)) {
        ?>      
        <div class="product-image">
            <a href="pages/product-detail.php?prd_id=<?php echo $row['prd_id']; ?>"><img src="img/shoes/<?php echo $row['prd_image']; ?>" class="product-thumb" alt="">
            <button class="card-btn" onclick="location.href='pages/product-detail.php?prd_id=<?php echo $row['prd_id']; ?>';">See more</button>
        </div>
        <div class="product-info">
            <h2 class="product-brand"><?php echo $row['prd_name']; ?></h2>
            <p class="product-short-des"><?php echo $row['cat_name']; ?></p>
            <span class="price">$<?php echo $row['prd_price']; ?></span>
        </div>
        <?php         
            }
        } 
        ?>
    </div>
</div>

<!--end product--->
    <?php include("pages/blog.php") ?>;
   
  </body>
  <!--begin footer-->
  <?php include("pages/footer.php") ?>;
  <!--end footer-->
</html>


