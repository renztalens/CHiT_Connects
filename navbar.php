<?php
session_start();
require 'connection.php';

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}
$user_id = $_SESSION['id'];

$stmt = $conn->prepare("SELECT profile_picture, name, usertype FROM accounts WHERE id = :id");
$stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header("Location: index.php");
    exit();
}

$name = htmlspecialchars($user['name']);
$usertype = htmlspecialchars($user['usertype']);
$profile_picture = htmlspecialchars($user['profile_picture']);

error_log("User: $name, Usertype: $usertype, Profile_picture: $profile_picture");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="navbar1.css">
</head>
<body>
    <div class="sidebar">
        <div class="top">
            <div class="logo">
                <span><h2>Universidad De Manila</h2></span>
            </div>
            <i class="bx bx-menu" id="btn"></i>
        </div>
        <div class="user">
            <img src="<?php echo ($profile_picture ?: 'default-profile.jpg'); ?>" alt="User Profile Image" class="user-img">
            <div>
                <p class="bold"><?php echo $name; ?></p>
                <p><?php echo $usertype; ?></p>
            </div>
        </div>
        <ul>
            <li>
                <a href="dashboard.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="nav-item">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="upload.php">
                    <i class='bx bx-cloud-upload'></i>
                    <span class="nav-item">Upload</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-inbox'></i>
                    <span class="nav-item">Inbox</span>
                </a>
            </li>
            <li>
                <a href="settings.php">
                    <i class='bx bx-cog'></i>
                    <span class="nav-item">Settings</span>
                </a>
            </li>
            <li>
                <a href="logout.php">
                    <i class='bx bx-log-out'></i>
                    <span class="nav-item">Logout</span>
                </a>
            </li>
        </ul>
    </div>
    <script src="navb.js"></script>
</body>
</html>
