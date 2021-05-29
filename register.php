<?php
session_start();
use Aws\DynamoDb\Exception\DynamoDbException;
use Aws\DynamoDb\Marshaler;
require "vendor/autoload.php";

$sdk = new Aws\Sdk([
	'region' => 'us-east-1',
	'version' => 'latest'
]);

if ( isset( $_SESSION["name"] ) ) {
	header("Location: main.php");
}

if ( isset( $_POST["submit"]) ) {
    if ( empty( $_POST["name"] ) || empty( $_POST["password"] ) || empty( $_POST["username"] ) ) {
        echo '<script language="javascript">';
        echo 'alert("The username or name or password cannot be empty.")';
        echo '</script>';
    } else {
        $dynamodb = $sdk->createDynamoDb();
        $marshaler = new Marshaler();

        $tableName = 'users-dev';

        $name = $_POST["name"];
        $password = $_POST["password"];
        $username = $_POST["username"];

		$params = [
			'TableName' => $tableName
		];
		$results = $dynamodb->scan($params);
		foreach( $results['Items'] as $item ) {
			if ($username == $marshaler->unmarshalValue($item['username'])) {
        echo '<script language="javascript">';
        echo 'alert("The username already exists.")';
        echo '</script>';
				$usernameItem = $marshaler->unmarshalValue($item['username']);
				break;
			}
		}
		if ( !isset($usernameItem) ) {
			$params = array(
				"TableName" => $tableName,
				"Item" => $marshaler->marshalJson('
				{
					"name": "' . $name . '",
					"username": "' . $username . '",
					"password": "' . $password . '"
					}')
			);
			$dynamodb->putItem($params);
			header("Location: login.php");
		}
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="generator" content="Hugo 0.83.1">
    <title>Register Page</title>

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
              <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="register.php">Register</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    
<main class="form-signin">
  <form>
    <img class="mb-4" src="assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Register Form</h1>

    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="JohnDoe" name="username">
      <label for="floatingInput">Username</label>
    </div>
    <div class="form-floating">
        <input type="email" class="form-control" id="floatingInput" placeholder="John Doe" name="name">
        <label for="floatingInput">Name</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
      <label for="floatingPassword">Password</label>
    </div>

    <div class="mb-3">
        <label>
            Already registered? <a href="login.php">Login</a>.
        </label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2021–2021</p>
  </form>
</main>


    
  </body>
</html>
