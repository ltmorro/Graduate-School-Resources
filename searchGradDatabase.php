<!DOCTYPE>
<html lang="en">
<head>
<script src="https://use.typekit.net/bmf3opz.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>
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
      <h1 class="text-center">Graduate Program Search</h1>
    </div>
  </div>
  <hr>
</div>
<div class="container-fluid">
  <div class="row text-center">
    <h3>Select by Institution:&nbsp;</h3>
    	  <select name="schools" form="selectInstitution">
          <?php foreach($schools as $school): ?>
              <option><?=$school['School']?></option>
          <?php endforeach; ?>
        </select>
        <br>
        <br>
        <form action="/result.php" id="selectInstitution" method="post">
        <input type="submit" name="submit2" id="submit2" value="Search">
        </form>
  </div>
<hr>
  <div class="row text-center">
<div class="col-md-6 col-md-offset-3">
  <h3>Select by Criteria:</h3>
  <h4 class="text-left text-capitalize"><em>Location:</em></h4>
  <p class="text-left">
        <label>
          <input type="checkbox" name="Location[]" form="search" value="farWest" id="Location_0">
          Far West (AK, CA, HI, NV, OR, WA)</label>
        <br>
        <label>
          <input type="checkbox" name="Location[]" form="search" value="greatLakes" id="Location_1">
          Great Lakes (IL, IN, MI, OH, WI)</label>
        <br>
        <label>
          <input type="checkbox" name="Location[]" form="search" value="newEngland" id="Location_2">
          New England (CT, ME, MA, NH, RI, VT)</label>
        <br>
        <label>
          <input type="checkbox" name="Location[]" form="search" value="midEast" id="Location_3">
          Mideast (DE, DC, MD, NJ, NY, PA)</label>
        <br>
        <label>
          <input type="checkbox" name="Location[]" form="search" value="plains" id="Location_4">
          Plains (IA, KS, MN, MO, NE, ND, SD)</label>
        <br> 
        <label>
          <input type="checkbox" name="Location[]" form="search" value="rockyMountains" id="Location_5">
          Rocky Mountains (CO, ID, MT, UT, WY)</label>
        <br>
        <label>
          <input type="checkbox" name="Location[]" form="search" value="southEast" id="Location_6">
          Southeast (AL, AR, FL, GA, KY, LA, MS, NC, SC, TN, VA, WV)</label>
        <br>
        <label>
          <input type="checkbox" name="Location[]" form="search" value="southWest" id="Location_7">
          Southwest (AZ, NM, OK, TX)</label>
        <br>
      </p>
<h4 class="text-left"><em>Student Body Size: </em><br>
</h4>
<p class="text-left">
  <label>
    <input type="checkbox" name="Size[]" form="search" value="small" id="Size_0">
    Small (Less than 5,000 students)</label>
  <br>
  <label>
    <input type="checkbox" name="Size[]" form="search" value="medium" id="Size_1">
    Medium (5,000 - 10,000 students)</label>
  <br>
  <label>
    <input type="checkbox" name="Size[]" form="search" value="large" id="Size_2">
    Large (More than 10,000 students)</label>
  <br>
</p>
<h4 class="text-left"><em>Cost (per credit hour):</em></h4>
<p class="text-left">
  <label>
    <input type="checkbox" name="Cost[]" form="search" value="less1000" id="Cost_0">
    Less than $1,000</label>
  <br>
  <label>
    <input type="checkbox" name="Cost[]" form="search" value="more1000" id="Cost_1">
    More than $1,000</label>
  <br>
</p>
<h4 class="text-left"><em>Degree Options:</em></h4>
<p class="text-left">
  <label>
    <input type="checkbox" name="DegreeOptions[]" form="search" value="ms" id="DegreeOptions_0">
    MS</label>
  <br>
  <label>
    <input type="checkbox" name="DegreeOptions[]" form="search" value="mse" id="DegreeOptions_1">
    MSE</label>
  <br>
  <label>
    <input type="checkbox" name="DegreeOptions[]" form="search" value="phd" id="DegreeOptions_2">
    PHD</label>
  <br>
  <label>
    <input type="checkbox" name="DegreeOptions[]" form="search" value="mcit" id="DegreeOptions_3">
    MCIT</label>
  <br>
</p>
<form action="/search.php" id="search" method="post">
<input type="submit" name="submit" id="submit" value="Search">
</form>
</div>
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
</body>
</html>

