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
 



  <!-----showing Mian post---->
  <?php

  $id = $_GET['threadid'];

  $sql = "SELECT * FROM `threads` WHERE thread_id = $id ";

  $results = mysqli_query($conn, $sql);

  while ($rows = mysqli_fetch_assoc($results)) {

    $threadid = $rows['thread_id'];
    $threadtitle = $rows['thread_title'];
    $threaddesc = $rows['thread_description'];
    $threadtime = $rows['timestamp'];
    $threadUserid = $rows['thread_user_id'];


    $sql3 = "SELECT username FROM users WHERE user_id = $threadUserid";

    $results3 = mysqli_query($conn, $sql3);

    $rows3 = mysqli_fetch_assoc($results3);
    $usernamefull3 = $rows3['username'];



    echo ' <div class="container mt-4 my-4">


    <div class="jumbotron">
  <h1 class="display-4">' . $threadtitle . '</h1>
  <p class="lead">Posted by <strong><em>' . $usernamefull3 . '</em></strong></p>
  <p class="lead">' . $threadtime . '</p>
  <hr class="my-4">
  <p>' . $threaddesc . '</p>
  
</div>   
    </div>';
  }


  ?>


  <!------sending comment form-------->
  <?php

  $method = $_SERVER['REQUEST_METHOD'];

  $alert = false;
  $alertfail = false;
  if ($method === 'POST') {

    $com_con = $_POST['commentcontent'];
    $com_con  = str_replace("<", "&lt;",   $com_con); ///replacing string to prevent from attack
    $com_con  = str_replace(">", "&gt;",   $com_con); ///replacing string to prevent from attack

    $snoid = $_POST['sno'];


    $sql = "INSERT INTO `comments` (`com_user_id`, `com_thread_id`, `com_description`, `com_timestamp`) VALUES ('$snoid', '$id', '$com_con', current_timestamp())";

    $results = mysqli_query($conn, $sql);
    $alert = true;


    if ($alert) {


      echo '
  <div class="alert alert-success" role="alert">
    Your Form is Submitted!
  </div>';
    }
  }
  if ($alertfail) {

    echo '
  <div class="alert alert-danger" role="alert">
  Your Form was Not Submitted!
</div>';
  };





  ?>


  <!-----showing comment form---->


  <?php

  if (isset($_SESSION['loggedin'])  && $_SESSION['loggedin'] == true) {
    echo '
  
  <div class="container mt-2 mb-4 ">

    <h1>Post a Comment</h1>
    <form class="mt-2 mb-4 " method="post" action="' . $_SERVER["REQUEST_URI"] . '">
      <label for="commentcontent">Enter Your Comment</label>
      <div class="form-group">

        <textarea name="commentcontent" id="commentcontent" cols="90" rows="6" ></textarea>
        <input type="hidden" name="sno"  value="' . $_SESSION["sno"] . '">
      </div>



      <button type="submit" class="btn btn-primary">Post</button>
    </form>


    <h2 class="mt-4">Start a discussion</h2>


  </div>';
  } else {
    echo ' <div class="container">
    <div class="alert alert-warning" role="alert">
    You are not logged in You must login to post a comment!
  </div>
    </div>';
  }

  ?>




  <!------fectching comments data----->

  <div class="container px-0 ">
    <?php

    $id = $_GET['threadid'];

    $sql = "SELECT * FROM `comments` WHERE com_thread_id = $id ";

    $results = mysqli_query($conn, $sql);

    if (mysqli_num_rows($results) == 0) {
      echo '
  
    <div class="jumbotron">
    <h2 class="display">No comments Found</h2>
    <p class="lead">Be the first to start a Discussion </p>
    <hr >
    
  
  </div>
 ';
    } else {

      while ($rows = mysqli_fetch_assoc($results)) {
        $commentId = $rows['com_id'];
        $commentContent = $rows['com_description'];
        $commentTime = $rows['com_timestamp'];
        $comuserid = $rows['com_user_id'];


        $sql2 = "SELECT username FROM users WHERE user_id = $comuserid";

        $results2 = mysqli_query($conn, $sql2);

        $rows2 = mysqli_fetch_assoc($results2);
        $usernamefull = $rows2['username'];




        echo '<div class="media mt-4 mb-4  bg-light">
    <img class="mr-3" src="images/user.png" width="90px" alt="Generic placeholder image">
    <div class="media-body">
      <h5 class="mt-0">' . $usernamefull . '</h5>
      <p>' . $commentTime . '</p>
      ' . $commentContent . '
    </div>
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