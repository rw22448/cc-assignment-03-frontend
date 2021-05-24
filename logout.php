<?php

    session_start();
    unset($_SESSION["name"]);
    header("Location: main.php");

?>