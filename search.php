<!DOCTYPE>
<html>
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
<?php
//ini_set('display_errors', 'On');
//error_reporting(E_ALL);
try{
    $dbh = new pdo( 'mysql:host=127.0.0.1;dbname=gradDB',
                    'root',
                    'password',
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(PDOException $ex){
    die(json_encode(array('outcome' => false, 'message' => 'Unable to connect')));
}
//processing which checkboxes were marked

//Our select statement. This will retrieve the data that we want.
$sql = "SELECT * FROM grad WHERE ";
$count=0;

//processing for location
$locationChecks = $_POST['Location'];
$locationSQL= '';
if(!empty($locationChecks))
{
  foreach($locationChecks as $check){
     //echo $check;
     if($check == "farWest")
        $locationSQL.="'AK', 'CA', 'HI', 'NV', 'OR', 'WA',";
     if($check == "greatLakes")
        $locationSQL.="'IL','IN','MI','OH','WI',";
     if($check == "newEngland")
        $locationSQL.="'CT','ME','MA','NH','RI','VT',";
     if($check == "midEast")
        $locationSQL.="'DE','DC','MD','NJ','NY','PA',";
     if($check == "plains")
        $locationSQL.="'IA','KS','MN','MO','NE','ND','SD',";
     if($check == "rockyMountains")
        $locationSQL.="'CO','ID','MT','UT','WY',";
     if($check == "southEast")
        $locationSQL.="'AL','AR','FL','GA','KY','LA','MS','NC','SC','TN','VA','WV',";
     if($check == "southWest")
        $locationSQL.="'AZ','NM','OK','TX',";
      $locationSQL= rtrim($locationSQL,',');
  }
  $sql.='Location IN ('.$locationSQL.')';
  
  $count+=1;
}

//processing for student body size
$studentChecks= $_POST['Size'];
$studentSQL= '';
$small=false;
$medium=false;
$large=false;
if(!empty($studentChecks))
{
  foreach($studentChecks as $check){
      //echo $check;
      if($check == "small")
        $small=true;
      if($check == "medium")
        $medium=true;
      if($check == "large")
        $large=true;
      if($small && $medium && $large)
        $studentSQL= "> 0";
      else if($small && $medium)
        $studentSQL= "< 10000";
      else if ($small && $large)
        $studentSQL ="< 5000 OR Student_Body_Size > 10000";
      else if ($small)
        $studentSQL ="< 5000";
      else if ($medium and $large)
        $studentSQL="> 5000";
      else if ($medium)
        $studentSQL="BETWEEN 5000 and 10000";
      else if ($large)
        $studentSQL="> 10000"; 
  }
  if($count == 0)
    $sql.='Student_Body_Size '.$studentSQL.'';
  else
    $sql.=' AND Student_Body_Size '.$studentSQL.'';
  
  $count+=1;
}

//processing for student body size
$costChecks= $_POST['Cost'];
$costSQL= '';
if(!empty($costChecks))
{
  foreach($costChecks as $check){
      //echo $check;
      if($check == "less1000")
        $costSQL= "< 1000";
      if($check == "more1000")
        $costSQL= "> 1000";
  }
  if($count == 0)
    $sql.='Cost '.$costSQL.'';
  else
    $sql.=' AND Cost '.$costSQL.'';
  
  $count+=1;
}
 
//processing for degree options
$degreeChecks= $_POST['DegreeOptions'];
$degreeSQL= '';
if(!empty($degreeChecks))
{
  foreach($degreeChecks as $check){
      //echo $check;
      if($check == "ms")
        $degreeSQL= "'M.S, Ph.D.','M.S, MFA, Ph.D.','M.S, MSEC, Ph.D.','M.S.','M.S, MSE, Ph.D.','M.S, D.Sc.','M.S','PH.D., M.S., MCIT','MS/MCS, PH.D.','MCS/MS',";
      if($check == "mse")
        $degreeSQL= "'M.S, MSEC, Ph.D.','M.S, MSE, Ph.D.',";
      if($check == "phd")
        $degreeSQL = "'M.S, Ph.D.','Ph.D.','M.S, MFA, Ph.D.','M.S, MSEC, Ph.D.','M.S, MSE, Ph.D.','PH.D., M.S., MCIT','JD/MS, PH. D.','MS/MCS, PH.D.',";
      if($check == "mcit")
        $degreeSQL = "'PH.D., M.S., MCIT',";
      $degreeSQL= rtrim($degreeSQL,',');
  }
  if($count == 0)
    $sql.='Degree_Options IN ('.$degreeSQL.')';
  else
    $sql.=' AND Degree_Options IN ('.$degreeSQL.')';
  
  $count+=1;
}

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
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1"><span class="sr-only">Toggle navigation</span></button>
      <a class="navbar-brand" href="http://www.clemson.edu">Clemson University</a></div>
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
      <h1 class="text-center">Graduate Program Search</h1>
    </div>
  </div>
  <hr>
</div>
<div class="container-fluid">
  <div class="row text-center">
		<h3>Institutional Search Results</h3>
    <table class="table">
          <tbody>
            <tr>
              <th scope="col">Institution</th>
              <th scope="col">Location</th>
              <th scope="col">Student Body Size</th>
              <th scope="col">Cost (per credit hour)</th>
              <th scope="col">Degree Options</th>
            </tr>
            <?php 
            foreach($schools as $school){
				 echo "
				 <tr>
				  <td>
          <a href=".$school['Website'].">
          ".$school['School']."
          </td>
				  <td>".$school['Location']."</td>
				  <td>".$school['Student_Body_Size']."</td>
				  <td>$".$school['Cost']."</td>
				  <td>".$school['Degree_Options']."</td>
				</tr>";
	          
			}
			 
			?>
          </tbody>
    </table>
  </div>
<hr>
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

