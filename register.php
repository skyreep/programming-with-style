<?php
/**
 * User: sgreep
 * Date: 10/8/2019
 */

$pagename = "Register";
require_once "header.inc.php";
// SET INITIAL VARIABLES
$showform = 1;
$errmsg = 0;
$errusername = "";
$errpassword = "";
$errpassword2 = "";
$erremail = "";
$errfname = "";
$errlname = "";
$errbirthday = "";
$errgender = "";
$erredlvl = "";


if($_SERVER['REQUEST_METHOD'] == "POST")
{
   /* ***********************************************************************
    * SANITIZE USER DATA
    * Use for ALL fields where the data is typed in - not for select or radio, etc
    * Use strtolower()  for emails, usernames and other case-sensitive info
    * Use trim() for ALL user-typed data -- even those not required EXCEPT pwd
    * CAUTION:  Radio buttons are a bit different.
    *    see https://www.htmlcenter.com/blog/empty-and-isset-in-php/
    * ***********************************************************************
    */
    $username = trim(strtolower($_POST['username']));
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $email = trim(strtolower($_POST['email']));
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $birthday = $_POST['birthday'];
    if(!empty($_POST['gender']))
    {
        $gender = $_POST['gender'];
    }
    $edlvl = $_POST['edlvl'];


    /* ***********************************************************************
     * CHECK EMPTY FIELDS
     * Check for empty data for every REUIRED  field
     * Do not do for things like apartment number, middle initial, etc.
     * CAUTION:  Radio buttons with 0 as a value = use isset() not empty()
     *    see https://www.htmlcenter.com/blog/empty-and-isset-in-php/
     * NOTE:  For any error, we set the $errmsg variable to TRUE to display message.
     * ***********************************************************************
     */
    if (empty($username)) {
        $errusername = "<span class=error>The username is required.</span>";
        $errmsg = 1;
    }

    if (empty($password)) {
        $errpassword = "<span class=error>The password is required.</span>";
        $errmsg = 1;
    }

    if (empty($password2)) {
        $errpassword2 = "<span class=error>The password confirmation is required.</span>";
        $errmsg = 1;
    }

    if (empty($email)) {
        $erremail = "<span class=error>The email is required.</span>";
        $errmsg = 1;
    }

    if (empty($fname)) {
        $errfname = "<span class=error>The first name is required.</span>";
        $errmsg = 1;
    }

    if (empty($lname)) {
        $errlname = "<span class=error>The last name is required.</span>";
        $errmsg = 1;
    }

    if (empty($birthday)) {
        $errbirthday = "<span class=error>The birthday is required.</span>";
        $errmsg = 1;
    }

    if (!isset($_POST['gender'])) {
        $errgender = "<span class=error>The gender field is required.</span>";
        $errmsg = 1;
    }

    if (empty($edlvl)) {
        $erredlvl = "<span class=error>The education level is required.</span>";
        $errmsg = 1;
    }

    /* ***********************************************************************
    * CHECK EMAIL VALIDATION
    * Check to if email is valid
    * ***********************************************************************
    */
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erremail = "<span class=error>The email format is wrong.</span>";
        $errmssg = 1;
    }


    /* ***********************************************************************
     * CHECK MATCHING FIELDS
     * Check to see if important fields match
     * Usually used for passwords and sometimes emails.  We'll do passwords.
     * ***********************************************************************
     */
    if ($password != $password2) {
        $errmsg = 1;
        $errpassword2 = "<span class=error>Your passwords do not match.</span>";
    }


    /* ***********************************************************************
     * CHECK EXISTING DATA
     * Check data to avoid duplicates
     * Usually used with emails and usernames - We'll do usernames
     * ***********************************************************************
    */
    $sql = "SELECT * FROM sgreep_users WHERE username = ?";
    $count = checkDup($pdo, $sql, $username);
    if($count > 0) {
        $errmsg = 1;
        $errusername = "The username is taken";
    }

    if($errmsg == 1){
        echo "<p class='error'>There are errors.  Please make corrections and resubmit.</p>";
    }
    else{
        echo "<p>Great!</p>";
        $showform = 0;
        /* ***********************************************************************
         * HASH SENSITIVE DATA
         * Used for passwords and other sensitive data
         * If checked for matching fields, do NOT hash and insert both to the DB
         * ***********************************************************************
         */
        $hashedpwd = password_hash($password, PASSWORD_BCRYPT);
        /* ***********************************************************************
         * INSERT INTO THE DATABASE
         * NOT ALL data comes from the form - Watch for this!
         *    For example, input dates are not entered from the form
         * ***********************************************************************
         */
        try {
            $sql = "INSERT INTO sgreep_users (username, password, email, fname, lname, birthday, gender, edlvl) 
                    VALUES (:username, :password, :email, :fname, :lname, :birthday, :gender, :edlvl) ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':password', $hashedpwd);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':fname', $fname);
            $stmt->bindValue(':lname', $lname);
            $stmt->bindValue(':birthday', $birthday);
            $stmt->bindValue(':gender', $gender);
            $stmt->bindValue(':edlvl', $edlvl);
            $stmt->execute();
            $showform = 0;
            echo "<p class='success'>Thank you for your entry.</p>";
        }
        catch (PDOException $e) {
            die( $e->getMessage() );
        }//catch

    } // else errormsg
}//submit
//display form if Show Form Flag is true
if($showform == 1){
?>

<form name="register" id="register" action="<?php echo $currentfile;?>" method="post">

    <?php if(isset($errusername)) {echo $errusername;}?>
    <br>
    <label for="username">Username</label>
    <br>
    <input type="text" name="username" id="username" placeholder="Required Username" maxlength="10" size="30"
           value="<?php if(isset($username)) {echo $username;}?>">
    <br>

    <?php if(isset($erremail)) {echo $erremail;}?>
    <br>
    <label for="email">eMail</label>
    <br>
    <input type="email" name="email" id="email" placeholder="Required eMail" maxlength="40" size="30"
           value="<?php if(isset($email)) {echo $email;}?>">
    <br>

    <?php if(isset($errlname)) {echo $errpassword;}?>
    <br>
    <label for="password">Password</label>
    <br>
    <input type="password" name="password" id="password" placeholder="Required Password" maxlength="255" size="30">
    <br><br>

    <?php if(isset($errlname)) {echo $errpassword2;}?>
    <br>
    <label for="password2">Confirmation Password</label>
    <br>
    <input type="password" name="password2" id="password2" placeholder="Required Confirmation Password" size="30">
    <br>

    <?php if(isset($errfname)) {echo $errfname;}?>
    <br>
    <label for="fname">First Name</label>
    <br>
    <input type="text" name="fname" id="fname" maxlength="40" size="30"
           value="<?php if(isset($fname)) {echo $fname;}?>">
    <br>

    <?php if(isset($errlname)) {echo $errlname;}?>
    <br>
    <label for="lname">Last Name</label>
    <br>
    <input type="text" name="lname" id="lname" maxlength="40" size="30"
           value="<?php if(isset($lname)) {echo $lname;}?>">
    <br>

    <?php if(isset($errbirthday)) {echo $errbirthday;}?>
    <br>
    <label for="birthday">Date of Birth</label>
    <br>
    <input type="date" name="birthday" id="birthday"
           value="<?php if(isset($birthday)) {echo $birthday;}?>">
    <br>
    <br>

    <?php if(isset($errgender)) {echo $errgender;}?>
    <p>Gender<p>
    Male <input type="radio" name="gender" id="gender1" value="male" <?php if(isset($gender) && $gender == "male") {echo "checked";}?>>
    <br>
    Female <input type="radio" name="gender" id="gender2" value="female" <?php if(isset($gender) && $gender == "female") {echo "checked";}?>>
    <br>
    Non-Binary <input type="radio" name="gender" id="gender3" value="non-binary" <?php if(isset($gender) && $gender == "non-binary") {echo "checked";}?>>
    <br>
    <br>

    <?php if(isset($erredlvl)) {echo $erredlvl;}?><br>
    <label for="edlvl">Education Level</label><br>
    <input list="edlvloptions" name="edlvl" id="edlvl">
        <datalist id="edlvloptions">
            <option value="High School/GED"></option>
            <option value="Some College"></option>
            <option value="Associates"></option>
            <option value="Bachelors"></option>
            <option value="Masters"></option>
            <option value="Doctorate"></option>
            <option value="Other"></option>
        </datalist>
    <br>
    <br>
    <label for="submit">Submit</label><br>
    <input type="submit" name="submit" id="submit" value="Submit">
    <br>
</form>

<?php
}//end showform
require_once "footer.inc.php";
?>
