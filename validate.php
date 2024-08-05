<?php
require 'connection.php';

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = strtolower($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);

    $stmt = $conn->prepare("SELECT id, usertype, password FROM accounts WHERE username = :username");
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $password == $user['password']) { 
        session_start();
        $_SESSION['id'] = $user['id'];
        $_SESSION['usertype'] = $user['usertype'];
        header("Location: dashboard.php");
        exit();
    } else {
        header("Location: acc.php");
        exit();
    }
}
?>
