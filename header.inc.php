<?php
/**
 * Created by PhpStorm.
 * User: sgreep
 * Date: 9/12/2019
 * Time: 11:33 AM
 */

session_start();

$currentfile = basename($_SERVER['PHP_SELF']);
$rightnow = time(); //set current time

//turn on error reporting for debugging - Page 699
error_reporting(E_ALL);
ini_set('display_errors','1'); //change this after testing is complete

//set the time zone
ini_set( 'date.timezone', 'America/New_York');
date_default_timezone_set('America/New_York');

//required files
require_once "connect.inc.php";
require_once "functions.inc.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/master.css">

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/8ab41e15a6.js"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,600%7CRoboto:400,700i,900&display=swap" rel="stylesheet">

    <title>Programming With Style</title>
</head>

<body>
<header>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">
            <i class="fas fa-laptop-code"></i>
            PWS
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php if($pagename == "Index") {echo "active";} ?>">
                    <a class="nav-link" href="http://ccuresearch.coastal.edu/sgreep/csci303fa19/forms/index.php">
                        Home <?php if($pagename == "Index") {echo "<span class='sr-only'>(current)</span>";} ?>
                    </a>
                </li>
                <li class="nav-item <?php if($pagename == "Register") {echo "active";} ?>">
                    <a class="nav-link" href="http://ccuresearch.coastal.edu/sgreep/csci303fa19/forms/register.php">
                        Register <?php if($pagename == "Register") {echo "<span class='sr-only'>(current)</span>";} ?>
                    </a>
                </li>
                <li class="nav-item <?php if($pagename == "Login") {echo "active";} ?>">
                    <a class="nav-link" href="http://ccuresearch.coastal.edu/sgreep/csci303fa19/forms/login.php">
                        Login <?php if($pagename == "Login") {echo "<span class='sr-only'>(current)</span>";} ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">UI</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">UX</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Color Theory</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Typography</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tools
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">HTML</a>
                        <a class="dropdown-item" href="#">CSS</a>
                        <a class="dropdown-item" href="#">JavaScript</a>
                        <a class="dropdown-item" href="#">Bootstrap</a>
                        <a class="dropdown-item" href="#">Design Software</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Blog</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
