<?php
/**
 * Created by PhpStorm.
 * User: sgreep
 * Date: 10/31/2019
 * Time: 11:33 AM
 */

function checkDup ($pdo, $sql, $userentry){
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $userentry);
        $stmt->execute();
        return $stmt->rowCount();
    }
    catch (PDOException $e){
        echo "<p class='error'>Error checking duplicate entries!" . $e->getMessage() . "</p>";
        exit();
    }
}
