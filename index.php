<?php
    session_start();
    require_once "config.php";   
    $error = "";
    if (array_key_exists("id", $_COOKIE) && $_COOKIE ['id']) {
        $_SESSION['id'] = $_COOKIE['id'];
    }
    if(isset($_SESSION['id'])) {
        header("Location: loggedinpage.php");   
    }

/*-----------------------SIGNUP----------------------------------------*/
    if (array_key_exists("submit", $_POST)) {
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
                    $error = "Account with that AADHAR number already exists.";
                } else { 
/*------------------------SIGNUP-Insertion--------------------------------------*/
                   
                    $query = "INSERT INTO `users` (`name`,`AADHAR`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['name'])."','".mysqli_real_escape_string($link, $_POST['AADHAR'])."','".mysqli_real_escape_string($link, $_POST['password'])."')";

                    if (!mysqli_query($link, $query)) {

                        $error = "<p>Could not sign you up - please try again later.</p>";
                        
/*------------------------SIGNUP-update MD5 hashing-------------------------------*/
                
                    } else {
                        $query = "UPDATE `users` SET password = '".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE id = ".mysqli_insert_id($link)." LIMIT 1";
                        mysqli_query($link, $query);
//                        $_SESSION['id'] = mysqli_insert_id($link);
//                        if ($_POST['stayLoggedIn'] == '1') {
//                            setcookie("id", mysqli_insert_id($link), time() + 60*60*24*365);
//                        } 
                        header("Location: index.php");
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
                            setcookie("id", $row['id'], time() + 60*60*24);
                            header("Location: loggedinpage.php");   
                        } else {
                            $error = "That AADHAR/password combination Wrong.";
                        }
                    } else {
                        $error = "That AADHAR/password combination could not be found.";
                    }
                }
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
  <head><title>PoliceDB</title>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="icon" href="favicon.png" type="image/gif">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        footer{
        position:absolute;
        bottom:15px;
        width:98.9%;
        height: 4rem;
        }
        div{
            border:0px green solid;
        }
        .toggleForms {
            font-weight: bold;
          }
        #signUpForm {
            display:none;
          }
        html { 
            height: 100%;
            background: linear-gradient(white,#888888) fixed;
          }
        body {  
            background: none;
          }
        #homePageContainer{
            padding-top: 180px;
            margin-top: 20px;
        }
        #topleft{
            font-size: 2.5em;
            color:#2fb42f;
            text-align:center;
            width:30%;
            height:100%;
            float:left;
        }
        #hometext{
            padding:2% 5% ; 
        }
        @media only screen and (max-width: 768px) {
        .pic {
        display: none;
            }}
        @media only screen and (max-width: 578px) {
        .smal {
        display: none;
            }}
        img{
            height: auto;
            width: inherit;
        }
}
    </style>
    </head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" id="topleft" href="#"><span style="font-weight:bold">PoliceDB</span></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact Us</a>
      </li>
        <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
    </ul>
  </div>
</nav>
    
    
    <div class="container-fluid" id="homePageContainer">
        <div class="row">
            <div class="smal col-sm-3 ">
            <img src="assets/batch.png" style="height:350px;" >
            </div>
            <div class="smal col-sm-1"></div>
            <div class="col-sm-4">
            <center>
                <b>SIGNUP/LOGIN</b><br>
            <div id="error"><?php if ($error!="") {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.$error.'</div>';} ?></div><br>
        
<!--=========================login=========================--> 
        
            <form method="post" id="logInForm">
            <fieldset class="form-group">
                <input type="text" name="AADHAR" placeholder="AADHAR Number" class="form-control" pattern="[0-9]{2-16}"required>
                <small id="emailHelp" class="form-text text-muted">16 digit AADHAR number</small>
                </fieldset>
            <fieldset class="form-group">
                <input type="password" name="password" placeholder="Password" class="form-control" required></fieldset>
            <div class="form-group form-check">
                <label><input type="checkbox" name="stayLoggedIn" value=1> Stay logged in</label>
            </div>
            <fieldset class="form-group">
            <input type="hidden" name="signUp" value="0">
                <input type="submit" class="btn btn-success" name="submit" value="Log In!"></fieldset>
            <p><a class="toggleForms"><span style="font-weight:normal;">New User ? </span>Sign up</a></p>
        </form>
        
<!--=========================signup=========================-->
            <form method="post" id = "signUpForm">
            <fieldset class="form-group">
                <input type="text" name="name" placeholder="Your Name" class="form-control" required></fieldset>
            <fieldset class="form-group">
                <input type="text" name="AADHAR" placeholder="Your AADHAR" class="form-control" required></fieldset>
            <fieldset class="form-group">
                <input type="password" name="password" placeholder="Password" class="form-control" required></fieldset>
           
            <div class="form-group form-check">
                <label><input type="checkbox" name="stayLoggedIn" value=1> Stay logged in</label> 
                </div>
            <fieldset class="form-group">
            <input type="hidden" name="signUp" value="1">
                <input type="submit" class="btn btn-success" name="submit" value="Sign Up!"></fieldset>
            <p><a class="toggleForms"><span style="font-weight:normal;">Already have an account ? </span>Login</a></p>
        </form>
            </center>
            </div>
            <div class="smal col-sm-1"></div>
            <div class="smal col-sm-3">
            <img src="assets/batch.png" style="height:350px;" >
            </div>
        </div>
    </div>
    <?php include("footer.php"); ?>
    
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(".toggleForms").click(function() {
            $("#signUpForm").toggle();
            $("#logInForm").toggle();
        });
    </script>
  </body>
</html>

