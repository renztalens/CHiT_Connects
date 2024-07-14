<?php

$user_id = $_SESSION['user_id'];

include 'db.php';
$stmt = $conn->prepare("SELECT name, username FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($name, $username);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sidebar</title>
    <link rel="stylesheet" href="sidebar.css">
</head>
<body>
    <div class="sidebar">
        <div class="user-info">
            <h3>User Info</h3>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></p>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
        </div>
        <a href="login.php" class="logout">Logout</a>
    </div>
</body>
</html>
