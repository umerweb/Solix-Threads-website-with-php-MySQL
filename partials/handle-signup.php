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


        $username = $_POST['name-signup'];
        $useremail = $_POST['email-signup'];
        $password = $_POST['password-signup'];
        $cpassword = $_POST['cpassword-signup'];



        // Check if username already exists
        $getname = "SELECT * FROM `users` WHERE `username`='$username'";
        $getNameResult = mysqli_query($conn, $getname);
        $getemail = "SELECT * FROM `users` WHERE `useremail`='$useremail'";
        $getemailResult = mysqli_query($conn, $getemail);


        if (mysqli_num_rows($getNameResult) > 0) {
            $showError2 = "Username already exists.";
            echo $showError2;
        } elseif (mysqli_num_rows($getemailResult) > 0) {
           
        

            $showError3 = "email already exists.";
            echo $showError3 ;

        }else {
            // Check if passwords match
            if ($password === $cpassword){


                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users` (`username`, `useremail`, `password`, `tstamp`) VALUES ('$username', '$useremail', '$hash', current_timestamp())";



            $results = mysqli_query($conn, $sql);
          
            
           
          
    
            header("location: ../index.php");
            }else{
                echo 'passwords do not match';
            }
        }
    };
    ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>