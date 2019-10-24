<?php
    $mysqlServer = "localhost";
    $mysqlDb = "police";
    $mysqlUser = "root";
    $mysqlPass = "pwdpwd";

    session_start();
    $error = ""; 
    $link = mysqli_connect($mysqlServer, $mysqlUser, $mysqlPass) or die("failed to connect to db");

/*----------------------LOGOUT-----------------------------------------*/
    if (array_key_exists("logout", $_GET)) {
            unset($_SESSION);
            setcookie("id", "", time() - 60*60);
            $_COOKIE["id"] = "";      
        } 
    else if ((array_key_exists("id", $_SESSION) AND $_SESSION['id']) OR
             (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])) {
              header("Location: loggedinpage.php");
        }
/*-----------------------SIGNUP----------------------------------------*/
    if (array_key_exists("submit", $_POST)) {
        if (!$_POST['name']) {
            $error .= "An name address is required<br>";
        } 
        if (!$_POST['AADHAR']) {
            $error .= "A AADHAR is required<br>";
        } 
        if (!$_POST['password']) {
            $error .= "A password is required<br>";
        } 
        if ($error != "") {
            $error = "<p>There were error(s) in your form:</p>".$error;
        } else  {
            
/*-----------------SIGNUP-duplicate check--------------------------------------*/
            
            if ($_POST['signUp'] == '1') {
                $query = "SELECT id FROM `users` WHERE AADHAR = '".mysqli_real_escape_string($link, $_POST['AADHAR'])."' LIMIT 1";
                $result = mysqli_query($link, $query);
                if (mysqli_num_rows($result) > 0) {
                    $error = "That AADHAR number is already taken.";
                } else {
                    
/*------------------------SIGNUP-Insertion--------------------------------------*/
                   
                    $query = "INSERT INTO `users` (`name`,'AADHAR', `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['name'])."',,".mysqli_real_escape_string($link, $_POST['AADHAR'])." '".mysqli_real_escape_string($link, $_POST['password'])."')";

                    if (!mysqli_query($link, $query)) {

                        $error = "<p>Could not sign you up - please try again later.</p>";
                        
/*------------------------SIGNUP-update MD5 hashing-------------------------------*/
                
                    } else {
                        $query = "UPDATE `users` SET password = '".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE id = ".mysqli_insert_id($link)." LIMIT 1";
                        mysqli_query($link, $query);
                        $_SESSION['id'] = mysqli_insert_id($link);
                        if ($_POST['stayLoggedIn'] == '1') {
                            setcookie("id", mysqli_insert_id($link), time() + 60*60*24*365);
                        } 
                        header("Location: loggedinpage.php");
                    }
                }
                
/*===========================LOGIN==============================================*/
                
            } else {
                $query = "SELECT * FROM `users` WHERE AADHAR = '".mysqli_real_escape_string($link, $_POST['AADHAR'])."'";
                    $result = mysqli_query($link, $query);
                    $row = mysqli_fetch_array($result);
                
                    if (isset($row)) {
                        $hashedPassword = md5(md5($row['id']).$_POST['password']);
                        if ($hashedPassword == $row['password']) {
                            $_SESSION['id'] = $row['id'];
                            if ($_POST['stayLoggedIn'] == '1') {
                                setcookie("id", $row['id'], time() + 60*60*24*365);
                            }
                            header("Location: loggedinpage.php");   
                        } else {
                            $error = "That AADHAR/password combination could not be found.";
                        }
                    } else {
                        $error = "That AADHAR/password combination could not be found.";
                    }
                }
        }
    }

?>

<div id="error"><?php echo $error; ?></div>

<form method="post">
    <input type="text" name="name" placeholder="Your Name">
    <input type="text" name="AADHAR" placeholder="Your AADHAR">
    <input type="password" name="password" placeholder="Password">
    <input type="checkbox" name="stayLoggedIn" value=1>
    <input type="hidden" name="signUp" value="1">
    <input type="submit" name="submit" value="Sign Up!">
</form>

<form method="post">
    <input type="text" name="name" placeholder="Your name">
    <input type="text" name="AADHAR" placeholder="AADHAR Number">
    <input type="password" name="password" placeholder="Password">
    <input type="checkbox" name="stayLoggedIn" value=1>
    <input type="hidden" name="signUp" value="0">
    <input type="submit" name="submit" value="Log In!">
</form>


