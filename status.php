<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Status</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>File Status</h1>
    
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cdatabase";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_GET['token']) && !empty($_GET['token'])) {
        $token = mysqli_real_escape_string($conn, $_GET['token']);

        $sql = "SELECT * FROM records WHERE token = '$token'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>UID</th>
                        <th>Description</th>
                        <th>Document Type</th>
                        <th>Department</th>
                        <th>File Name</th>
                        <th>File Path</th>
                        <th>QR Code</th>
                        <th>Date Uploaded</th>
                    </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['uid'] . "</td>
                        <td>" . $row['description'] . "</td>
                        <td>" . $row['doctype'] . "</td>
                        <td>" . $row['department'] . "</td>
                        <td>" . $row['file_name'] . "</td>
                        <td><a href='" . $row['file_path'] . "' target='_blank'>" . $row['file_path'] . "</a></td>
                        <td><img src='" . $row['qr_filepath'] . "' alt='QR Code' /></td>
                        <td>" . $row['uploaded_at'] . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "No file found with token: " . htmlspecialchars($token);
        }
    } else {
        echo "Invalid or missing token";
    }

    $conn->close();
    ?>
</body>
</html>
