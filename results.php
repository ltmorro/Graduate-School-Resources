<html>
<body>


<?php
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
$sql = "SELECT * FROM grad WHERE School LIKE '{$_POST["schools"]}'";
 
//Prepare the select statement.
$stmt = $dbh->prepare($sql);
 
//Execute the statement.
$stmt->execute();
 
//Retrieve the rows using fetchAll.
$schools = $stmt->fetchAll();
foreach($schools as $school){
     echo $school['School'];
     echo $school['Website'];
     echo $school['Location'];
     echo $school['Student_Body_Size'];
     echo $school['Cost'];
     echo $school['Degree_Options'];             
}
?>

</body>
</html>