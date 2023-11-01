<?php
session_start();
require_once("pdo.php");
$email="";
if(!isset($_SESSION["name"])){
    die("Not logged in");
}
if(isset($_SESSION["name"])){
    $email=$_SESSION["name"] ;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moaz Alnahas</title>
</head>
<body>
    <h1>Tracking Autos for <?php echo $email ." "?></h1>
    <?php 
        if(isset($_SESSION["success"])){
            echo "".$_SESSION["success"]."";
            unset($_SESSION["success"]);
        }
    ?>
    <h2>Automobiles</h2>
    <ul>
        <?php
        $sql="SELECT * FROM autos ORDER BY make";
        $st=$pdo->query($sql);
        while($row=$st->fetch(PDO::FETCH_ASSOC)){
            echo "<li>".$row["make"].' \ '.$row["year"]. ' \ '.$row["mileage"] ."</li>";
        }
        
        ?>
    </ul>
    <p><a href="add.php">Add New</a> | <a href="logout.php">Log out</a></p>
</body>
</html>