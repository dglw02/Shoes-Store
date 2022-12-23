<html>
  <head>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/cart.css" />
  </head>
    <body>
    <!--begin header-->
    <?php include("pages/header.php") ?>;
    <!--end header-->
    <?php include("pages/slider.php") ?>;
    <!--end slider-->
    
    <div class=”Cart-Container”>
        <div class=”Header”>
            <h3 class=”Heading”>Shopping Cart</h3>
            <h5 class=”Action”>Remove all</h5>
        </div>
        <div class=”Cart-Items”>
            <div class=”image-box”>
                <img src=”img/shoes/nike1.png” />
            </div>
            <div class=”about”>
                <h1 class=”title”>Apple Juice</h1>
                <h3 class=”subtitle”>250ml</h3>
            </div>
            <div class=”counter”>
                <div class=”btn”>+</div>
                <div class=”count”>1</div>
                <div class=”btn”>-</div>
            </div>
            <div class=”prices”>
                <div class=”amount”>$2.99</div>
                <div class=”save”><u>Save for later</u></div>
                <div class=”remove”><u>Remove</u></div>
            </div>
        </div>
        <div class=”Cart-Items”>
            <div class=”image-box”>
                <img src=”img/shoes/nike2.png” />
            </div>
            <div class=”about”>
                <h1 class=”title”>Apple Juice</h1>
                <h3 class=”subtitle”>250ml</h3>
            </div>
            <div class=”counter”>
                <div class=”btn”>+</div>
                <div class=”count”>1</div>
                <div class=”btn”>-</div>
            </div>
            <div class=”prices”>
                <div class=”amount”>$2.99</div>
                <div class=”save”><u>Save for later</u></div>
                <div class=”remove”><u>Remove</u></div>
            </div>
        </div>
        <hr> 
        <div class=”checkout”>
            <div class=”total”>
                <div>
                    <div class=”Subtotal”>Sub-Total</div>
                     <div class=”items”>2 items</div>
                </div>
                <div class=”total-amount”>$6.18</div>
            </div>
            <button class=”button”>Checkout</button>
        </div>
    </div>
    <!-- end cart -->
    </body>
  <!--begin footer-->
  <?php include("pages/footer.php") ?>;
  <!--end footer-->
</html>
