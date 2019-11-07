<?php
    session_start();
    require_once "config.php";
    $iid=$_SESSION['id'];
    $result = mysqli_query($link,"SELECT * FROM users where id=$iid");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $priv=$row["access"];
    $ad=$row["AADHAR"];
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
    <title>Login</title>
    
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
        
        
        <div id="content" class="container-fluid">
            <input type="button" class="btn btn-primary" id="Fir" value="ADD FIR" style="margin:10px">
            <input type="button" class="btn btn-primary admin" id="Police" value="ADD POLICE" style="margin:10px">
            <input type="button" class="btn btn-primary" id="shFir" value="SHOW FIR" style="margin:10px">
            <input type="button" class="btn btn-primary admin" id="shPolice" value="SHOW POLICE" style="margin:10px">
            <div id="firtable">
                <table class="table table-striped">
                    <thead>
                        <th>FIR_id</th>
                        <th>FIR_Type</th>
                        <th>Reporter</th>
                        <th>Station_id</th>
                        <th>Status</th>
                    </thead>
                    <?php
                    if($priv<1){
                        $result = mysqli_query($link,"SELECT * FROM fir where Reporter = $ad ");}
                    else{
                        $result = mysqli_query($link,"SELECT * FROM fir");
                    }
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {
                        echo "<tr>
                        <td>".$row["FIR_ID"]."</td>
                        <td>".$row["FIR_TYPE"]."</td>
                        <td>".$row["reporter"]."</td>
                        <td>".$row["station_id"]."</td>
                        <td>".$row["status"]."</td>
                    </tr>";
                    }
                    ?>
                    
                </table>
            </div>
            <div class="con" id="policetable">
                <table class="table table-striped">
                    <thead>
                        <th>aadharid</th>
                        <th>batchid</th>
                        <th>stationid</th>
                        <th>name</th>
                    </thead>
                    <?php
                    $result = mysqli_query($link,"SELECT * FROM policemen");
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {
                        echo "<tr>
                        <td>".$row["AADHAR"]."</td>
                        <td>".$row["batch_id"]."</td>
                        <td>".$row["station_id"]."</td>
                        <td>".$row["name"]."</td>
                    </tr>";
                    }
                    ?>
                </table>
            </div>
            <div class="con" id="formfir">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">FIR_TYPE</label>
                        <input type="email" class="form-control" id="exampleInputEmail1"  placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Station_id</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">detail</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
            <div class="con" id="formpolice">
                <form method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">aadhar</label>
                        <input type="email" class="form-control" id="exampleInputEmail1"  placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">batch</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">station</label>
                        <input type="email" class="form-control" id="exampleInputEmail1"  placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">name</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        
    <?php include("footer.php"); ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./jquery-ui-1.11.4/jquery-ui.js"></script>
    <script>
        $('#Fir').click(function(){
            $('#firtable').hide('blind');
            $('#formfir').show('blind');
            $('#formpolice').hide('blind');
            $('#policetable').hide('blind');
        });
        $('#Police').click(function(){
            $('#firtable').hide('blind');
            $('#formfir').hide('blind');
            $('#formpolice').show('blind');
            $('#policetable').hide('blind');
        });
        $('#shFir').click(function(){
            $('#firtable').show('blind');
            $('#formfir').hide('blind');
            $('#formpolice').hide('blind');
            $('#policetable').hide('blind');
        });
        $('#shPolice').click(function(){
            $('#firtable').hide('blind');
            $('#formfir').hide('blind');
            $('#formpolice').hide('blind');
            $('#policetable').show('blind');
        });
    </script>
    
    </body>
</html>