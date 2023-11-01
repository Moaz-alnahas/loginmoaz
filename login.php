<?php 
session_start();

if(isset($_POST["login"])){
    if(empty($_POST["email"]) || empty($_POST["pass"])){
        $_SESSION["error"]= "<p style='color:red;'> Please enter email and password</p>";
        header("Location: login.php");
        return;
    }
    elseif(strpos($_POST["email"],"@")== false) {
        $_SESSION["error"]="<p style='color:red;'> should have @ in email</p>";
        header("Location: login.php");
        return;
    }
    elseif($_POST["pass"] == "php123"){
        
        $_SESSION['name'] = $_POST['email'];
        header("Location: view.php");
        return;
    }
    else{
        $_SESSION["error"]="<p style='color:red;'> Incorrect password</p>";
        header("Location: login.php");
        
        return;
    }
}
if(@$_POST["cancel"]){
    header("Location: index.php");
    return;
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
    
    <h1>Please Log In</h1>
    <?php 
    if(isset($_SESSION["error"])){
        echo "".$_SESSION["error"]."";
        unset($_SESSION["error"]);
    }
    ?>
    <form method="post">
    Email<input type="text" name="email" placeholder="enter email"><br><br>
    PASS:<input type="text" name="pass" placeholder="enter password"><br><br>
        <div>
            <input type="submit" name="login" value="Log in">
            <input type="submit" name="cancel" value="Cancel">
        </form>
</body>
</html>