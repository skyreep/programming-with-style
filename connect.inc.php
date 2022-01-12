<?php
/**
 * User: sgreep
 * Date: 9/12/2019
 */

try{
    $connString = "mysql:host=localhost;dbname=***********"; //Hidden for GitHub
    $user = "*********"; //Hidden for GitHub
    $pass = "*********"; //Hidden for Github
    $pdo = new PDO($connString,$user,$pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
    die( $e->getMessage() );
}

?>
