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
<!--alter table threads add FULLTEXT(`thread_title`,`thread_description`);-->



  <?php

$query = $_GET['search'];
?>

<div class="container mt-4 mb-4">

<h1>Search results for <em> "<?php echo $query; ?>"</em></h1>

<?php
$sql = "SELECT * FROM `threads` WHERE MATCH (thread_title, thread_description) AGAINST ('$query');";


$result = mysqli_query($conn,$sql);


if (mysqli_num_rows($result) === 0){
  echo'
  <div class="container mt-4 mb-4">
  <div class="jumbotron">
  <h1 class="display-4">'.$query.'</h1>
  <p class="lead">Plaese Search something else</p>
  <hr class="my-4">
  <li>Make Sure that all words are spelled correctly</li>
  <li>Try different keywords</li>
  <li>Try more general keywords</li>
  
</div>
  
  </div>
  
  
  
  ';

}else{
  while( $rows = mysqli_fetch_assoc($result)){

    $querytitle = $rows['thread_title'];
    $querydesc = $rows['thread_description'];
    $queryid = $rows['thread_id'];
   
  
    echo '
    <ul class=" list-unstyled mt-4 mb-4 bg-light">
    <li class="media">
   
      <div class="media-body">
        <a href="thread-post.php?threadid='.$queryid.'"><h5 class="mt-0 mb-1">'.$querytitle.'</h5></a>
         '.substr($querydesc, 0 , 400).'
      </div>
    </li>
  </ul>
  </div>';
    }
}






?>
</div>


  <?php include "partials/footer.php" ?>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>