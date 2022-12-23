<html>
  <head>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <!--begin header-->
    <?php include("pages/header.php") ?>;
    <!--end header-->

    <!-- start slider -->
    <?php include("pages/slider.php") ?>;
    <!--end slider-->

    <!-- start information -->
    <section class="information" id="information">
      <h1 class="heading">General <span>Information</span></h1>
      <div class="infor-content">
        <p>- Specializes in supplying and retailing the latest, best and most prestigious genuine shoes. <br>
           - Our mission is what drives us to do everything possible to expand human potential. We do 
           that by creating groundbreaking sport innovations, by making our products more sustainably, 
           by building a creative and diverse global team and by making a positive impact in communities 
           where we live and work. <br>
           - Email: Footshop@gmail.com <br>
           - Hotline: 1900 1000 - 0354427760
        </p>
      </div>
    </section>  
    <!-- end information -->

    <!-- start blog -->
    <section class="blog" id="blog">
      <h1 class="heading">Team <span>Weblog</span></h1>
      <div class="box-container">
        <div class="box">
          <a href=""><img src="img/team/person1.jpg" alt="" />
          <h3>Nam Dương</h3>
          <p>
            Co-founder
          </p>
          <div class="stars">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa fa-star-half-o"></i>
          </div>
        </div>
        <div class="box">
          <a href=""><img src="img/team/person2.jpg" alt="" />
          <h3>Hải Dương</h3>
          <p>
            Co-founder
          </p>
          <div class="stars">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa fa-star-half-o"></i>
          </div>
        </div>
        <div class="box">
          <a href=""><img src="img/team/person3.jpg" alt="" />
          <h3>Elon Musk</h3>
          <p>
            Main Investor
          </p>
          <div class="stars">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa fa-star"></i>
          </div>
        </div>
      </div>
    </section>
    <!-- end blog -->
    <section class="news" id="news">
            <div class="content">
                <h3>Monthly news letter</h3>
                <p>
                    Get information about our newest products!
                </p>
                <form action="">
                    <input type="email" placeholder="Please enter your email" class="email">
                    <input type="submit" value="save" class="btn">
                </form>
            </div>
        </section>
  </body>
  <!--begin footer-->
  <?php include("pages/footer.php") ?>;
  <!--end footer-->
</html>

<script src="js/script.js"></script>
