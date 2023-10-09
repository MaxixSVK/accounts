<?php 
require 'config.php';
if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $duplicate = mysqli_query($conn, "SELECT * FROM accounts WHERE username = '$username' OR email = '$email'");
    if(mysqli_num_rows($duplicate) > 0){
        echo
        "<script> alert('Usename or Email has been alredy taken'); </script>";
    } 
    else{
        if($password == $confirmpassword){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO accounts VALUES('','$name','$username','$email','$hash')";
            mysqli_query($conn,$query);
            echo
            "<script> alert('Registration successful'); </script>";
            $result = mysqli_query($conn, "SELECT * FROM accounts WHERE username = '$username' OR email = '$email'");
            $row = mysqli_fetch_assoc($result);
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            header("Location: index.php");
        }
        else {
            echo
            "<script> alert('Password does not match'); </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <h1>Registration</h1>
    <form class="" action="" method="post" , autocomplete="off">
        <label for="name">Name : </label>
        <input type="text" name="name" id="name" required value=""> <br>
        <label for="username">Username: </label>
        <input type="text" name="username" id="username" required value=""> <br> <label for="emai">Email : </label>
        <input type="email" name="email" id="email" required value=""> <br>
        <label for="password">Password: </label>
        <input type="password" name="password" id="password" required value=""> <br>
        <label for="confirmpassword">Confirm Password : </label>
        <input type="password" name="confirmpassword" id="confirmpassword" required value=""> <br> <button type="submit" name="submit">Register</button>
    </form>
    <br>
    <a href="login.php">Login</a>
</body>

</html>