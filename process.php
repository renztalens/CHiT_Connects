<?php
session_start(); 
require_once 'connection.php';
require_once 'phpqrcode/qrlib.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $description = $_POST['description'];
    $doctype = $_POST['doctype'];
    $department = $_POST['department'];
    $file = $_FILES['file'];

    $id = $_SESSION['id']; 

    $sql = "SELECT name FROM accounts WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        die("Error: User not found.");
    }

    $from = $user['name'];

    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        die("Error: No file uploaded or there was an upload error.");
    }

    $fileName = basename($file['name']);
    $fileTmpName = $file['tmp_name'];
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $uploadDir = 'fileuploads/';
    $filePath = $uploadDir . $fileName;

    if ($fileType != 'pdf') {
        echo "<script>alert('Error: Only PDF files are allowed.'); window.history.back();</script>";
        exit;
    }

    if (!move_uploaded_file($fileTmpName, $filePath)) {
        echo "Error: There was an error uploading your file.";
        exit;
    }

    $qrtext = bin2hex(random_bytes(16));
    $qrDir = 'qrcodes/';
    $qrFileName = $qrDir . time() . '.png';
    if (!is_dir($qrDir)) {
        mkdir($qrDir, 0777, true);
    }
    QRcode::png($qrtext, $qrFileName, 'H', 4, 4);

    $sql = "INSERT INTO records (description, doctype, department, file_name, file_path, qr_code_path, qrtext, `from_user`) VALUES (:description, :doctype, :department, :file_name, :file_path, :qr_code_path, :qrtext, :from_user)";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':description', $description);
    $stmt->bindValue(':doctype', $doctype);
    $stmt->bindValue(':department', $department);
    $stmt->bindValue(':file_name', $fileName);
    $stmt->bindValue(':file_path', $filePath);
    $stmt->bindValue(':qr_code_path', $qrFileName);
    $stmt->bindValue(':qrtext', $qrtext);
    $stmt->bindValue(':from_user', $from); 

    if ($stmt->execute()) {
        echo "<script>alert('Data saved successfully'); window.location.href = 'dashboard.php';</script>";
        exit;
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
}
$conn->close();
?>
