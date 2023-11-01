<?php
session_start();
if(!isset($_SESSION["name"])){
    die("Not logged in");
}
if(isset($_SESSION["name"])){

    $name = $_SESSION["name"];

    if($_SERVER["REQUEST_METHOD"]==="POST"){
        require_once("pdo.php");

        if($_POST["add"]){

            if(empty($_POST["mk"]) || empty($_POST["ye"]) || empty($_POST["mi"])){
                $_SESSION["error"]="<p style='color:red;'>fill all please</p>";
                header("Location:add.php");
                return;
            }
            elseif(strpos($_POST["ye"],"@")== false||strpos($_POST["mi"],"@")== false){
                $_SESSION["error"]= "<p style='color:red;'>year and mile should be integer</p>";
                header("Location:add.php");
                return;
            }
            else{
                $stmt=$pdo->prepare("INSERT INTO autos (make,year,mileage) values(:mk,:ye,:mi)");
                $_SESSION["mk"]=$_POST["mk"];
                $_SESSION["ye"]=$_POST["ye"];
                $_SESSION["mi"]=$_POST["mi"];
                $stmt->bindParam("mk", $_SESSION["mk"]);
                $stmt->bindParam("ye", $_SESSION["ye"]);
                $stmt->bindParam("mi", $_SESSION["mi"]);
                if($stmt->execute()){
                 $_SESSION["success"]= "<p style='color:green;'>correct add</p>";
                 header("Location:view.php");
                 return;
                    
                }
            }
        }
        if($_POST["ca"]){
            header("Location:view.php");
            return;
        }
    }
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
    <h1>Tracking Autos for<?php echo $name . "" ?></h1>
    <?php 
    if(isset($_SESSION["error"])){
        echo"".$_SESSION["error"]."";
        unset($_SESSION["error"]);
    }

    ?>
    <form method="post">
        Make<input type="text" name="mk"><br>
        Years<input type="text" name="ye"><br>
        Mile:<input type="text" name="mi"><br><br>
        <div>
            <input type="submit" name="add" value="Add">
            <input type="submit" name="ca" value="Cancel">
        </div>  
    </form>
</body>
</html>