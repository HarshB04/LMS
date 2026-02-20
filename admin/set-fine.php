<?php
session_start();
error_reporting(E_ALL); ini_set('display_errors', 1);
include('includes/config.php');
if(empty(<?php
session_start();
error_reporting(E_ALL); ini_set('display_errors', 1);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['update']))
{
$fine=$_POST['finetf'];

$sql ="SELECT fine from tblfine ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$listedbooks=$query->rowCount();
if($listedbooks==0)
{
$sql="insert into tblfine values(:fine)";
$query = $dbh->prepare($sql);
$query->bindParam(':fine',$fine,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
}
else
{	
$sql="update tblfine set fine=:fine where 1";
$query = $dbh->prepare($sql);
$query->bindParam(':fine',$fine,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
}

if($lastInsertId)
{
$_SESSION['msg']="Fine Updated successfully";
header('location:set-fine.php');
}
else 
{
$_SESSION['error']="Something went wrong. Please try again";
header('location:set-fine.php');
}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Add Author</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet" />

</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wra
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Set Fine</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
<div class="panel panel-info">
<div class="panel-heading">
Fine Update Section
</div>
<div class="panel-body">
<form role="form" method="post">
<div class="form-group">
<label>Fine Per Day</label>
<input class="form-control" type="text" name="finetf" autocomplete="off"  required />
</div>

<button type="submit" name="update" class="btn btn-info">Update </button>

                                    </form>
                            </div>
                        </div>
                            </div>

        </div>
   
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
SESSION['alogin']))
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['update']))
{
$fine=$_POST['finetf'];

$sql ="SELECT fine from tblfine ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$listedbooks=$query->rowCount();
if($listedbooks==0)
{
$sql="insert into tblfine values(:fine)";
$query = $dbh->prepare($sql);
$query->bindParam(':fine',$fine,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
}
else
{	
$sql="update tblfine set fine=:fine where 1";
$query = $dbh->prepare($sql);
$query->bindParam(':fine',$fine,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
}

if($lastInsertId)
{
$_SESSION['msg']="Fine Updated successfully";
header('location:set-fine.php');
}
else 
{
$_SESSION['error']="Something went wrong. Please try again";
header('location:set-fine.php');
}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Add Author</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet" />

</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wra
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Set Fine</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
<div class="panel panel-info">
<div class="panel-heading">
Fine Update Section
</div>
<div class="panel-body">
<form role="form" method="post">
<div class="form-group">
<label>Fine Per Day</label>
<input class="form-control" type="text" name="finetf" autocomplete="off"  required />
</div>

<button type="submit" name="update" class="btn btn-info">Update </button>

                                    </form>
                            </div>
                        </div>
                            </div>

        </div>
   
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>

