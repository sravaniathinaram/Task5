<?php
include 'config.php';

if(isset($_POST['register'])){

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if(empty($username) || empty($password)){
        die("Please fill all fields");
    }

    $hashedPassword = password_hash(
        $password,
        PASSWORD_DEFAULT
    );

    $role = "editor";

    $stmt = $conn->prepare(
        "INSERT INTO users(username,password,role)
         VALUES(?,?,?)"
    );

    $stmt->bind_param(
        "sss",
        $username,
        $hashedPassword,
        $role
    );

    $stmt->execute();

    echo "Registration Successful!";
}
?>