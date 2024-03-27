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

  <?php


  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'dbconnect.php';


    $useremail = $_POST['email-login'];
    $password = $_POST['password-login'];




    $sql = "SELECT * FROM  `users` WHERE  `useremail` = '$useremail'";

    $results = mysqli_query($conn, $sql);

    $num = mysqli_num_rows($results);


  if ($num == 1) {

    while ($rows = mysqli_fetch_assoc($results)) {
      if (password_verify($password, $rows['password'])) {
        echo 'good';
        $username = $rows['username'];
        $usersno = $rows['user_id'];
        echo $username;
        session_start();
        $_SESSION['user'] = $username;
        $_SESSION['sno'] = $usersno;
        $_SESSION['loggedin'] = true;

        header("location: ../index.php");
       
      }else{
        $error2 = true;
       
      };
    }
  } else {
    $error = true;
  };
  }



  ?>











  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>