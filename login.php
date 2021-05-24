<?php

  session_start();


  require "vendor/autoload.php";

  use Aws\DynamoDb\Exception\DynamoDbException;
  use Aws\DynamoDb\Marshaler;
  date_default_timezone_set('UTC');
  
  session_start();
  
  if ( isset( $_SESSION["name"] ) ) {
    header("Location: main.php");
  }
  
  $sdk = new Aws\Sdk([
    'region' => 'us-east-1',
    'version' => 'latest'
  ]);
  
  if ( isset( $_POST["submit"] ) ) {
    if ( empty( $_POST["username"] ) || empty( $_POST["password"] ) ) {
      echo '<script language="javascript">';
      echo 'alert("Username or password can\'t be empty.")';
      echo '</script>';
    } else {
      $dynamodb = $sdk->createDynamoDb();
      $marshaler = new Marshaler();
  
      $tableName = 'users-dev';
  
          $username = $_POST["username"];
          $password = $_POST["password"];
  
      $params = [
        'TableName' => $tableName
      ];
  
      $results = $dynamodb->scan($params);
  
      foreach( $results['Items'] as $item ) {
        $usernameItem = $marshaler->unmarshalValue($item['username']);
        $passwordItem = $marshaler->unmarshalValue($item['password']);
        if ( $username == $usernameItem  and $password == $passwordItem) {
          $_SESSION["name"] = $marshaler->unmarshalValue($item['user_name']);
          header("Location: main.php");
        }
      }
      echo '<script language="javascript">';
      echo 'alert("Username or password is invalid.")';
      echo '</script>';
  
    }
  }
  
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="generator" content="Hugo 0.83.1">
    <title>Login Page</title>


    

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
    <link href="css/signin.css" rel="stylesheet">
    <link href="css/navbar-top-fixed.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Event</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item">
              <a class="nav-link" href="main.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="register.php">Register</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    
<main class="form-signin">
  <form action="login.php" method="POST">
    <img class="mb-4" src="assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Login Form</h1>

    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="JohnDoe" name="username">
      <label for="floatingInput">Username</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
      <label for="floatingPassword">Password</label>
    </div>

    <div class="mb-3">
      <label>
        Not registered? <a href="register.php">Register</a>.
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Log In</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2021–2021</p>
  </form>
</main>


    
  </body>
</html>
