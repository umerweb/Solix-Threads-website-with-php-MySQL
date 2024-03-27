<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="style.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <title>SoLiX</title>
</head>

<body>
<?php include "partials/dbconnect.php" ?>
  <?php include "partials/header.php" ?>
 


  <!--Slider-->
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images/c1 (1).jpg" class="d-block w-100" width="100%" height="500px" alt="...">
      </div>
      <div class="carousel-item">
        <img src="images/c1 (2).jpg" class="d-block w-100" width="100%" height="500px" alt="...">
      </div>
      <div class="carousel-item">
        <img src="images/c1 (3).jpg" class="d-block w-100" width="100%" height="500px" alt="...">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>


  <!--Category cards-->
  <div class="container mt-4">

  <h2>Top Categories</h2>

    <div class="row">
      <?php

      $sql = "SELECT * FROM `categories`";

      $results = mysqli_query($conn, $sql);

      while ($rows = mysqli_fetch_assoc($results)) {
        $catid = $rows['category_id'];
        $catName = $rows['category_name'];
        $catdesc = $rows['category_description'];


        echo '
    

     
      
      <div class="card  mt-4 mb-4" style="width: 18rem;">
      <img class="card-img-top" src="images/card.jpg" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title"><a href="threads.php?catid='.$catid.'">' . $catName . '</h5></a>
        <p class="card-text">' . substr($catdesc, 0, 150) . " ..." . '</p>
        <a href="threads.php?catid='.$catid.'" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>';
      };


      ?>
    </div>
  </div>






  <?php include "partials/footer.php" ?>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>