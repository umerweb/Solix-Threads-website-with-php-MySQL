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
  





  <!-----fetching Threads Accordinng to thier category id ------------------------------>

  <?php

  $id = $_GET['catid'];

  $sql = "SELECT * FROM `categories` WHERE category_id = $id ";

  $results = mysqli_query($conn, $sql);

  while ($rows = mysqli_fetch_assoc($results)) {
    $catid = $rows['category_id'];
    $catName = $rows['category_name'];
    $catdesc = $rows['category_description'];
  }



  ?>

  <!-----  Sending thread post------------------------------>
  <?php

  $method = $_SERVER['REQUEST_METHOD'];

  $alert = false;
  $alertfail = false;
  if ($method === 'POST') {

    $th_title = $_POST['question-title'];
    $th_title = str_replace("<", "&lt;",  $th_title); ///replacing string to prevent from attack
    $th_title = str_replace(">", "&gt;",  $th_title); ///replacing string to prevent from attack

    $th_desc = $_POST['question'];
    $th_desc = str_replace("<", "&lt;",  $th_desc); ///replacing string to prevent from attack
    $th_desc = str_replace(">", "&gt;",  $th_desc); ///replacing string to prevent from attack

    $snoid = $_POST['sno2'];

    $sql = "INSERT INTO `threads` (`thread_title`, `thread_description`, `thread_category_id`, `thread_user_id`, `timestamp`)
   VALUES ( '$th_title', '$th_desc' , '$id', '$snoid', current_timestamp())";

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




<!---------------------------showing category name------------------------->

  <div class="container my-4 mt-4">

    <div class="jumbotron">
      <h1 class="display-4">Welcome to the <?php echo $catName ?> Threads </h1>
      <p class="lead"><?php echo $catdesc ?></p>
      <hr class="my-4">
      <p>Be Respectful: Encourage users to treat each other with respect and avoid personal attacks or offensive language.

        No Hate Speech: Prohibit hate speech, discrimination, or harassment based on race, ethnicity, gender, religion, sexual orientation, disability, etc.

        Stay on Topic: Encourage users to stay on topic within threads and avoid derailing discussions.

        No Spam: Prohibit spamming, including excessive self-promotion, advertising, or irrelevant content.

        No Illegal Activities: Ban discussions or activities that promote illegal behavior, including piracy, hacking, or other criminal activities.

        Respect Privacy: Encourage users to respect others' privacy and avoid sharing personal information without consent.



      </p>

    </div>
  </div>





<!---------------------------Thread post form------------------------->


  <?php

  if (isset($_SESSION['loggedin'])  && $_SESSION['loggedin'] == true) {


    echo '
  <div class="container my-4 mt-2">

     <h1 class="mb-4 ">Post a Thread</h1>
    <form method="post" action="' . $_SERVER["REQUEST_URI"] . '">
      <label for="ques">Add a Question</label>
      <div class="form-group">


        <input type="text" id="ques" name="question-title">
        <input type="hidden" name="sno2"  value="' . $_SESSION["sno"] . '">

      </div>



      <label for="quesd">Add Description</label>
      <div class="form-group">

        <textarea id="quesd" name="question" rows="4" cols="100" required></textarea><br>

      </div>




      <button type="submit" class="btn btn-primary ">Post</button>
    </form>





  </div>';
  } else {
    echo ' <div class="container">
  <div class="alert alert-warning" role="alert">
  You are not logged in You must login to post a thread!
</div>
  </div>';
  }

  ?>



<!---------------------------showing  threads list------------------------->


  <?php

  $sql = "SELECT * FROM `threads`  WHERE thread_category_id = $id ";

  $results = mysqli_query($conn, $sql);
  if (mysqli_num_rows($results) == 0) {
    echo '

  <div class="container mb-4">
  
    <div class="jumbotron">
    <h1 class="display">No threads Found</h1>
    <p class="lead">Be the first to post a thread </p>
    <hr >
    
  
  </div>
  </div>';
  } else {


    while ($rows = mysqli_fetch_assoc($results)) {

      $threadid = $rows['thread_id'];
      $threadtitle = $rows['thread_title'];
      $threaddesc = $rows['thread_description'];
      $threaduserid = $rows['thread_user_id'];

      $sql2 = "SELECT username FROM users WHERE user_id = $threaduserid";

      $results2 = mysqli_query($conn, $sql2);

      $rows2 = mysqli_fetch_assoc($results2);
      $usernamefull = $rows2['username'];



      echo '<div class="container my-4 mt-2">
        <div class="media">
        <img class="align-self-start mr-3" src="images/user.png" alt="Generic placeholder image" width="90px">
        <div class="media-body">
          <a href="thread-post.php?threadid=' . $threadid . '"><h5 class="mt-0">' . $threadtitle . '</h5></a>
         <p>' . substr($threaddesc, 0, 400) . '</p>
         <p> Posted By <strong>' . $usernamefull . '</strong></p>
         <a href="thread-post.php?threadid=' . $threadid . '"><button class="btn btn-primary btn-lg">Learn more</button></a>
        </div>
      </div>
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