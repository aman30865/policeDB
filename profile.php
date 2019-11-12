<?php
    session_start();
    require_once "config.php";
    $iid=$_SESSION['id'];
    $result = mysqli_query($link,"SELECT * FROM users where id=$iid");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $priv=$row["access"];
    $ad=$row["AADHAR"];
    $na=$row["Name"];
    $ph=$row["phone"];
    $ge=$row["gender"];
    $em=$row["email"];
    $add=$row["address"];
    if (array_key_exists("id", $_COOKIE) && $_COOKIE ['id']) {
        $_SESSION['id'] = $_COOKIE['id'];
        $iid=$_SESSION['id'];
    }
    if (!isset($_SESSION['id'])) {
        header("Location: index.php");  }
    if (array_key_exists("profile", $_POST)){
        $querypro="UPDATE `users` SET `Name`='".$_POST["name"]."',`email`='".$_POST["email"]."',`phone`='".$_POST["phone"]."',`address`='".$_POST["addr"]."',`gender`='".$_POST["gender"]."' WHERE id=".$iid;
        $result = mysqli_query($link, $querypro);
    }
?>


<html>
<head>
    <title>FIR Entry</title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        div{
            border:0px green solid;
        }
         html { 
            height: 100%;
            background: linear-gradient(white,#888888) fixed;
          }
        body {  
            background: none;
          }
        #topleft{
            font-size: 2.5em;
            color:#2fb42f;
            text-align:center;
            width:30%;
            height:100%;
            float:left;
        }
        #navbarSupportedContent{
            margin-left: 25%;
        }
        #wel{
            float: left;
            margin-left:18%;
            font-weight:bold;
            color: white;
        }
        #content{
            text-align: center;
            padding: 2% 2%;
            height: 120%;
        }
        .con{
            display:none;
        }
        <?php
            if($priv<2){echo ".admin{display:none";}
        ?>
    </style>
</head>
    
    
    <body>
        <nav class="navbar navbar-expand-lg fixed-nav-bar navbar-dark bg-dark" id="navbar">
        <a class="navbar-brand" id="topleft" href="#"><span style="font-weight:bold">PoliceDB</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
            <div class="navbar-nav navbar-collapse mr-auto" id="wel"> welcome,<?php
                    $result = mysqli_query($link,"SELECT Name FROM users where id=$iid");
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {echo $row["Name"];}
                ?></div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
                <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
                <li class="nav-item">
                <a class="nav-link" href='logout.php'>Log out</a>
              </li>
            </ul>
          </div>
        </nav>
        <br><br><br><br>
        <div class="container">
            <center>
        <form method="post" action="profile.php">
                    <div class="form-group">
                        <label>AADHAR:</label>
                        <input type="text" class="form-control" value="<?php echo $ad; ?>" name="fir" readonly>
                    </div>
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" class="form-control" value="<?php echo $na; ?>" name="name">
                    </div>
                    <div class="form-group">
                        <label>E-mail:</label>
                        <input type="email" class="form-control" value="<?php echo $em; ?>" name="email">
                    </div>
                    <div class="form-group">
                        <label>Phone Number:</label>
                        <input type="tel" class="form-control" value="<?php echo $ph; ?>" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
                        <small>Format: 123-456-7890</small>
                    </div>
                    <div class="form-group">
                        <label>Address:</label>
                        <textarea type="text" class="form-control" name="addr" value="<?php echo $add; ?>" rows="3"></textarea>
                    </div>
                    <div class="form-check">
                        <label>Gender:</label><br>
                        <label class="radio-inline"><input type="radio" name="gender" value="Male"> Male </label>
                        <label class="radio-inline"><input type="radio"  name="gender" value="Female"> Female </label>
                        <label class="radio-inline"><input type="radio" name="gender" value="other"> Other</label>
                    </div><br>
                    <button type="submit" name="profile" class="btn btn-success">Submit</button> <button class="btn btn-info"><a style="color:white" href="loggedinpage.php">BACK</a></button>
                </form>
                
            </center>
        </div>
        
        
    </body>
</html>
