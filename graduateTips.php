<!DOCTYPE>
<html lang="en">
<head>
<script src="https://use.typekit.net/bmf3opz.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>
<style type="text/css">
  .fouc {display:none;}
</style>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Graduate Program Database Search</title>

<!-- Bootstrap -->
<link href="css/bootstrap.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<?php
 
//Connect to our MySQL database using the PDO extension.
try{
    $dbh = new pdo( 'mysql:host=127.0.0.1;dbname=gradDB',
                    'root',
                    'password',
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(PDOException $ex){
    die(json_encode(array('outcome' => false, 'message' => 'Unable to connect')));
} 
//Our select statement. This will retrieve the data that we want.
$sql = "SELECT School FROM grad";
 
//Prepare the select statement.
$stmt = $dbh->prepare($sql);
 
//Execute the statement.
$stmt->execute();

//Retrieve the rows using fetchAll.
$schools = $stmt->fetchAll();
 
?>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
      <a class="navbar-brand" href="https://www.clemson.edu">Clemson University</a></div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="defaultNavbar1">
      <ul class="nav navbar-nav">
        <li class="active"></li>
<li class="dropdown">
  <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
      </li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group"> </div>
</form>
     <ul class="nav navbar-nav navbar-right">
        <li><a href="searchGradDatabase.php">Search</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="graduateTips.php">Home</a></li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <h1 class="text-center">Graduate School Application Information</h1>
    </div>
  </div>
  <hr>
</div>
<div class="container-fluid">
  <div class="row text-center">
    <p>Here are some tips for applying to grad school</p>
    <br>
        <br>
</div>
<hr>
  <div class="row text-center">
    <p>Here is an example timeline for applying</p>
  </div>
<hr>
  <div class="row panel-footer">
    <div class="text-center col-md-6 col-md-offset-3">
      <h4>CPSC 4910&nbsp;</h4>
      <p>Copyright &copy; 2017 &middot; All Rights Reserved &middot; </p>
    </div>
  </div>
  <hr>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery-1.11.3.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.js"></script>
<script>
$('html').addClass('fouc');
$(document).ready(function() {
    $('html').show();
} );
</script>
</body>
</html>

