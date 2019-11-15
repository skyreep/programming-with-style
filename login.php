<?php
/**
 * Created by PhpStorm.
 * User: sgreep
 * Date: 10/31/2019
 * Time: 5:27 AM
 */

$pagename = "Login";  //pagename var is used in the header
require_once "header.inc.php";
//set initial variables
$showform = 1;  // show form is true
$errormsg = 0;
$errusername = "";
$errpassword = "";

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    //create variables to store data from form - we never use POST directly w/ user input
    // CHANGED USERNAME TO LOWERCASE
    $username = trim(strtolower($_POST['username']));
    $password = $_POST['password'];

    //check for empty fields
    if (empty($username)) {
        $errusername = "The username is required.";
        $errormsg = 1;
    }
    if (empty($password)) {
        $errpassword = "The password is required.";
        $errormsg = 1;
    }

    if($errormsg == 1)
    {
        echo "<p class='error'>There are errors.  Please make corrections and resubmit.</p>";
    }
    else{
        /* VERIFY THE PASSWORD */
        $sql = "SELECT * FROM sgreep_users WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        $row = $stmt->fetch();
        if (password_verify($password, $row['password'])) {
            $_SESSION['ID'] = $row['ID'];
            $_SESSION['username'] = $row['username'];
            $showform = 0;
            header("Location: confirm.php?state=2");
        } else {
            echo "<p class='error'>The username and password combination you entered is not correct.  Please try again.</p>";
        }
    } // else errormsg
}//submit
if($showform == 1){
    ?>
<form name="login" id="login" method="POST" action="<?php echo $currentfile;?>" >

    <table>
        <tr><th><label for="username">Username:</label><span class="error">*</span></th>
            <td><input name="username" id="username" type="text" placeholder="Required Username"
                       value="<?php if(isset($username))
                       {echo $username;
                       }?>" /><span class="error"><?php if(isset($errusername)){echo $errusername;}?></span></td>
        </tr>
        <tr><th><label for="password">Password:</label><span class="error">*</span></th>
            <td><input name="password" id="password" type="password" placeholder="Required Password"/>
                <span class="error"><?php if(isset($errpassword)){echo $errpassword;}?></span></td>
        </tr>
        <tr><th><label for="submit">Submit: </label></th>
            <td><input type="submit" name="submit" id="submit" value="submit"/></td>
        </tr>
    </table>
</form>

    <?php
}//end showform
require_once "footer.inc.php";
?>