<!DOCTYPE>

<head>
<body>
"Hello World!"

<?php
try{
    $dbh = new pdo( 'mysql:host=127.0.0.1;dbname=gradDB',
                    'root',
                    '',
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    die(json_encode(array('outcome' => true)));
}
catch(PDOException $ex){
    die(json_encode(array('outcome' => false, 'message' => 'Unable to connect')));
}

//Connect to our MySQL database using the PDO extension.
$pdo = new PDO('mysql:host=localhost;dbname=gradDB', 'root', 'password');
echo "Test";
//Our select statement. This will retrieve the data that we want.
$sql = "SELECT School FROM grad";
 
//Prepare the select statement.
$stmt = $pdo->prepare($sql);
 
//Execute the statement.
$stmt->execute();
 
//Retrieve the rows using fetchAll.
$schools = $stmt->fetchAll();
 
?>

<?php foreach($schools as $school): ?>
    echo $school['School']?>
<?php endforeach; ?>
</body>
</head>