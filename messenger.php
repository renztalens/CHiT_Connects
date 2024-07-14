<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $receiver_id = $_POST['receiver_id'];
    $text = isset($_POST['text']) ? $_POST['text'] : '';
    $image_path = '';

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
        $image = $_FILES["image"];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($image["name"]);
        
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $valid_extensions = array("jpg", "jpeg", "png", "gif");
        if (in_array($imageFileType, $valid_extensions)) {
            if (move_uploaded_file($image["tmp_name"], $target_file)) {
                $image_path = $target_file;
            } else {
                echo "Failed to upload image.";
            }
        } else {
            echo "Invalid file type.";
        }
    }

    $stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, text, image_path) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $_SESSION['user_id'], $receiver_id, $text, $image_path);
    $stmt->execute();

    header("Location: messenger.php");
    exit();
}

$users = $conn->query("SELECT id, name FROM users WHERE id != " . $_SESSION['user_id']);
$messages = $conn->query("SELECT m.*, u.name AS sender_name FROM messages m JOIN users u ON m.sender_id = u.id WHERE m.receiver_id = " . $_SESSION['user_id'] . " ORDER BY m.timestamp DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Messenger</title>
    <link rel="stylesheet" href="messenger.css">
    <style>
    </style>
</head>
<body>
    <?php include 'sidebar.php';?>
    <div class="container">
        <h2>Talens' Messaging App</Applet></h2>
        <form method="post" enctype="multipart/form-data" action="messenger.php">
            <select name="receiver_id" required>
                <option value="" disabled selected>Select a contact</option>
                <?php while ($user = $users->fetch_assoc()): ?>
                    <option value="<?php echo htmlspecialchars($user['id']); ?>"><?php echo htmlspecialchars($user['name']); ?></option>
                <?php endwhile; ?>
            </select>
            <textarea name="text" placeholder="Type your message here..." required></textarea>
            <input type="file" name="image">
            <button type="submit">Send</button>
        </form>

        <div class="inbox">
            <h2>Inbox</h2>
            <ul>
                <?php while ($message = $messages->fetch_assoc()): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($message['sender_name']); ?>:</strong>
                        <p><?php echo nl2br(htmlspecialchars($message['text'])); ?></p>
                        <?php if ($message['image_path']): ?>
                            <a href="<?php echo htmlspecialchars($message['image_path']); ?>" target="_blank">
                                <img src="<?php echo htmlspecialchars($message['image_path']); ?>" alt="Image">
                            </a>
                        <?php endif; ?>
                        <span><?php echo htmlspecialchars($message['timestamp']); ?></span>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
    </div>
</body>
</html>
