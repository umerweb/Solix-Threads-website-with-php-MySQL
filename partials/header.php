<?php


session_start();
$login = false;

if (isset($_SESSION['loggedin'])  && $_SESSION['loggedin'] == true) {
  $login = true;
}
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="#">SoLiX</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
      <a class="nav-link" href="../forums/index.php">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="../forums/about.php">About</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Category
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">';

$slq = "SELECT category_id, category_name FROM `categories` LIMIT 6";
$resalt = mysqli_query($conn, $slq);

while ($rws = mysqli_fetch_assoc($resalt)) {

  $catid = $rws['category_id'];
  $catName =  $rws['category_name'];

  echo '
               <a class="dropdown-item" href="threads.php?catid=' . $catid . '">' . $catName . '</a>';
}

echo '
        </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="../forums/contact.php" tabindex="-1" >Contact</a>
    </li>
  </ul>

  <div class="row mx-2">
  <form class="form-inline my- my-lg-0" method="get" action="search.php" >
    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-success my-2 my-sm-0 mx-2" type="submit">Search</button>
  </form>';

if (!$login) {
  echo '
  
  <button class="btn btn-outline-success m1-2" data-target="#loginModal" data-toggle="modal" >Login</button>
  <button class="btn btn-outline-success mx-2" data-toggle="modal" data-target="#signupModal">Signup</button>
  </div>
  
</div>
</nav>';
};

if ($login) {
  echo '  <p class="text-light my-0 mx-2 "> Welcome, ' . $_SESSION['user'] . '</p>
    <a href="partials/logout.php" ><button class="btn btn-outline-success mx-2"  >Logout</button></a>
    </div>
    
  </div>
  </nav>';
}



include "partials/signup.php";
include "partials/login.php";
