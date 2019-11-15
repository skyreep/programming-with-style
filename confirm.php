<?php
/**
 * Created by PhpStorm.
 * User: sgreep
 * Date: 10/12/2019
 * Time: 2:36 PM
 */

$pagename = "Confirmation";
require_once "header.inc.php";

$state = $_GET['state'];

if ($state == 1) {
    echo "<p>You have been successfully logged out.</p><br><a href='http://ccuresearch.coastal.edu/sgreep/csci303fa19/forms/login.php'>Log In</a>";

} elseif ($state != 1) {
    echo "<p>Welcome " . $_SESSION['username'] . "!</p>";
} else {
    echo "<p>Choose an option from the menu.</p>";
}

require_once "footer.inc.php";