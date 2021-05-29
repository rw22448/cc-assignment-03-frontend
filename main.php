<?php

session_start();

require "vendor/autoload.php";

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="generator" content="Hugo 0.83.1">
    <title>Main Page</title>

    

    <!-- Bootstrap core CSS -->
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="css/navbar-top-fixed.css" rel="stylesheet">
  </head>
  <body>
    

  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Event</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="main.php">Home</a>
        </li>

<?php 

if ( !isset( $_SESSION["name"] ) ) {
  echo '
    <li class="nav-item">
      <a class="nav-link" href="login.php">Login</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="register.php">Register</a>
    </li>
  ';
} else {
  echo '
    <li class="nav-item">
      <a class="nav-link" href="user.php">' . $_SESSION["name"] . '</a>
    </li>
  ';
}
?>
      </ul>
    </div>
  </div>
</nav>

<main class="container">
  <div class="bg-light p-5 rounded">
    <h1>Navbar example</h1>
    <p class="lead">This example is a quick exercise to illustrate how fixed to top navbar works. As you scroll, it will remain fixed to the top of your browser’s viewport.</p>
    <a class="btn btn-lg btn-primary" href="components/navbar/" role="button">View navbar docs &raquo;</a>
  </div>
</main>


    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>

      
  </body>
</html>
