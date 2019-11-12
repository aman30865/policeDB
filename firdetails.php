<?php
    session_start();
    require_once "config.php";
    $iid=$_SESSION['id'];
    $result = mysqli_query($link,"SELECT * FROM users where id=$iid");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $priv=$row["access"];
    $ad=$row["AADHAR"];
    if (array_key_exists("firid", $_GET)){
    $firid=$_GET["firid"];
    $queryfir= mysqli_query($link,"SELECT `fir_id`, `detail`, `location` FROM `fir_detail` WHERE `fir_id`=$firid");
    $firs = mysqli_fetch_array($queryfir, MYSQLI_ASSOC);
    }else{
        header("Location: http://localhost/dashboard/policeDB/loggedinpage.php");
    }
    if (array_key_exists("id", $_COOKIE) && $_COOKIE ['id']) {
        $_SESSION['id'] = $_COOKIE['id'];
        $iid=$_SESSION['id'];
    }
    if (!isset($_SESSION['id'])) {
        header("Location: index.php");
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
                        <label>FIR ID:</label>
                        <input type="text" class="form-control" value="<?php echo $firs["fir_id"] ?>" name="firid" readonly>
                    </div>
                    <div class="form-group">
                        <label>Location:</label>
                        <input type="text" class="form-control" value="<?php echo $firs["location"] ?>" name="location" readonly>
                    </div>
                    <div class="form-group">
                        <label>Details:</label>
                        <input type="text" class="form-control" value="<?php echo $firs["detail"] ?>" name="detail" readonly>
                    </div>
                    <button class="btn btn-info"><a style="color:white" href="./loggedinpage.php">BACK</a></button>
                </form>
                
            </center>
        </div>
        
        
    </body>
</html>
