<?php  
session_start(); 
include_once "config/DBconnecter.php";
?>
<html>
  <head>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
  <div class="container px-3 my-5 clearfix">
    <!-- Shopping cart table -->
    <div class="card">
      <div class="card-header">
        <h2>Shopping Cart</h2>
      </div>
      <?php
        if (isset($_SESSION['cart'])) {
          $prdId_list = "";
          foreach ($_SESSION['cart'] as $prd_id => $qty) {
            $prdId_list .= $prd_id.",";
          }
          $clr_id=$_SESSION['color'][$prd_id];
          $siz_id=$_SESSION['size'][$prd_id];
          // $prdId_list = 2,6,
          $prdId_list = rtrim($prdId_list,","); //$prdId_list = 2,6
          $sqlCart = "SELECT product.prd_id, prd_image, prd_name, prd_price, cat_name, clr_name, siz_number FROM product INNER JOIN category ON product.cat_id = category.cat_id 
          INNER JOIN product_detail ON product.prd_id = product_detail.prd_id
          INNER JOIN color ON product_detail.clr_id = color.clr_id 
          INNER JOIN size ON product_detail.siz_id = size.siz_id 
          WHERE product.prd_id IN($prdId_list) AND product_detail.clr_id = $clr_id AND product_detail.siz_id = $siz_id  ";
          $queryCart = mysqli_query($conn, $sqlCart);
          
      ?>
      <form method="post" action="pages/process-cart.php?action=submit">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered m-0">
            <thead>
              <tr>
                <!-- Set columns width -->
                <th class="text-center py-3 px-4" style="min-width: 400px;">Product Name &amp; Details</th>
                <th class="text-right py-3 px-4" style="width: 100px;">Price</th>
                <th class="text-center py-3 px-4" style="width: 120px;">Quantity</th>
                <th class="text-right py-3 px-4" style="width: 100px;">Total</th>
                <th class="text-center align-middle py-3 px-0" style="width: 40px;"><a href="#" class="shop-tooltip float-none text-light" title="" data-original-title="Clear cart"><i class="ino ion-md-trash"></i></a></th>
              </tr>
            </thead>
            <tbody>
              <?php
                  $price_unit = 0;
                  $total_price = 0;
                  while($cart_item = mysqli_fetch_assoc($queryCart)){
                      $price_unit = $_SESSION['cart'][$cart_item['prd_id']] * $cart_item['prd_price'];
                      $total_price += $price_unit;
              ?>
              <tr>
                <td class="p-4">
                  <div class="media align-items-center">
                    <img src="img/shoes/<?php echo $cart_item['prd_image']; ?>" class="d-block ui-w-40 ui-bordered mr-4" alt="">
                    <div class="media-body">
                      <a href="#" class="d-block text-dark"><?php echo $cart_item['prd_name']; ?></a>
                      <small>
                        <span class="text-muted">Color: </span> <?php echo $cart_item['clr_name']; ?>
                        <span class="text-muted">Size: </span> <?php echo $cart_item['siz_number']; ?> &nbsp;
                        <span class="text-muted">Category: </span> <?php echo $cart_item['cat_name']; ?>
                      </small>
                    </div>
                  </div>
                </td>
                <td class="text-right font-weight-semibold align-middle p-4">$<?php echo $cart_item['prd_price']; ?></td>
                <td class="align-middle p-4"><input type="number" id="quantity" class="form-control text-center" value="<?php echo $_SESSION['cart'][$cart_item['prd_id']]; ?>" name="quantity[<?php echo $cart_item['prd_id']; ?>]"></td>
                <td class="text-right font-weight-semibold align-middle p-4">$<?php echo number_format($price_unit,0,',','.'); ?></td>
                <td class="text-center align-middle px-0"><a href="pages/process-cart.php?action=del&prd_id=<?php echo $cart_item['prd_id']; ?>" class="shop-tooltip close float-none text-danger" title="" data-original-title="Remove">×</a></td>
              </tr>
              <?php
                }
              ?>
            </tbody>
          </table>
        </div>
        <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
          <div class="mt-4">
            <button type="submit" id="update-cart" name="update_cart" value="update" class="btn btn-lg btn-primary mt-2">Update cart</button>
          </div>
          <div class="d-flex">
            <div class="text-right mt-4">
              <div id="total_price" class="text-large"><strong>Total price:</strong></div>
              <input type="hidden" name="total_price" id="total_price" value="<?php echo $total_price; ?>">
              <div class="text-large"><strong>$<?php echo number_format($total_price,0,',','.'); ?></strong></div>
            </div>
          </div>
        </div>
      </div>
      </form>
      <?php
      }else{
        echo "<div class='alert alert-danger mt-3'>Có 0 sản phẩm trong giỏ hàng!</div>";
      }
      ?>
      <form method="post" action="pages/process-cart.php?action=submit">
      <div class="row">
          <div id="cus-name" class="col-lg-4 col-md-4 col-sm-12">
            <input placeholder="Họ và tên (bắt buộc)" type="text" name="cus_name" id="cus_name" class="form-control user_name">
            <span id="cus_name_error"></span>
          </div>
          <div id="cus-tel" class="col-lg-4 col-md-4 col-sm-12">
            <input placeholder="Số điện thoại (bắt buộc)" type="text" name="cus_tel" id="cus_tel" class="form-control">
            <span id="cus_tel_error"></span>
          </div>
          <div id="cus-email" class="col-lg-4 col-md-4 col-sm-12">
            <input placeholder="Email (bắt buộc)" type="text" name="cus_email" id="cus_email" class="form-control">
            <span id="cus_email_error"></span>
          </div>  
          <div id="cus-address" class="col-lg-12 col-md-12 col-sm-12">
            <input placeholder="Địa chỉ nhà riêng hoặc cơ quan (bắt buộc)" type="text" name="cus_address" id="cus-address" class="form-control">
          </div>
      </div>
      <p><br>*Note:
      <br>   - Total price does not include shipping fee. Please contact us for more information before ordering.
      <br>- To cancel your order, please contact 19001000 or 0354427760.
      <br>   - The information about your order will be sent to your email. You can not cancel your order after receiving our email.</p>
      <div class="float-right">
        <button type="button" class="btn btn-lg btn-default md-btn-flat mt-2 mr-3" onclick="location.href='main.php';">Back to shopping</button>
        <button type="submit" class="btn btn-lg btn-primary mt-2" name="insert_cart" onclick="return validateForm();" id="btn_insert" value="insert">Checkout</button>
      </div>
      </form>
    </div>
  </div>
  <script>
    function validateForm() {
        const EMPTY_STR = "";
        var check = true;
        var cus_name = document.getElementById('cus_name');
        var cus_tel = document.getElementById('cus_tel');
        var cus_email = document.getElementById('cus_email');
        var cus_name_error = document.getElementById('cus_name_error');
        var cus_phone_error = document.getElementById('cus_tel_error');
        var cus_email_error = document.getElementById('cus_email_error');
        // console.log(user_name.value == "");
        if(cus_name.value == EMPTY_STR) {
            cus_name.style.border = "1px solid red";
            cus_name_error.innerHTML = "Bạn phải nhập họ tên";
            cus_name_error.style.color = "red";
            check = false;
        }
        if(cus_tel.value == EMPTY_STR) {
            cus_tel.style.border = "1px solid red";
            cus_tel_error.innerHTML = "Bạn phải nhập số điện thoại";
            cus_tel_error.style.color = "red";
            check = false;
        }
        if(cus_email.value == EMPTY_STR) {
            cus_email.style.border = "1px solid red";
            cus_email_error.innerHTML = "Bạn phải nhập email";
            cus_email_error.style.color = "red";
            check = false;
        }
        
        return check;
    }
</script>

    <style type="text/css">
      body{
        margin-top:20px;
        background:#eee;
      }
      .ui-w-40 {
        width: 40px !important;
        height: auto;
      }
      .card{
        box-shadow: 0 1px 15px 1px rgba(52,40,104,.08);    
      }
      .ui-product-color {
        display: inline-block;
        overflow: hidden;
        margin: .144em;
        width: .875rem;
        height: .875rem;
        border-radius: 10rem;
        -webkit-box-shadow: 0 0 0 1px rgba(0,0,0,0.15) inset;
        box-shadow: 0 0 0 1px rgba(0,0,0,0.15) inset;
        vertical-align: middle;
      }
    </style>
    <script type="text/javascript"></script>
  </body>
</html>
