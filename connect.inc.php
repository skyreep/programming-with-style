<?php
/**
 * User: sgreep
 * Date: 9/12/2019
 */

try{
    $connString = "mysql:host=localhost;dbname=csci303fa19";
    $user = "*********";
    $pass = "*********";
    $pdo = new PDO($connString,$user,$pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
    die( $e->getMessage() );
}

?>
