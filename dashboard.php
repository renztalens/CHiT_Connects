<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="dashboard1.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Dashboard</title>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="main-content">
    <div class="ctainer">
        <?php include 'tb.html'; ?>
        <div class="progress-box">
            <div class="search">
                <input type="text" placeholder="Search document..."> 
                <button class="searchbtn" onclick="searchDocuments()">Search</button>
            </div>
            <?php
            $search = isset($_GET['search']) ? trim($_GET['search']) : '';
            $sql = "SELECT * FROM records";
            if (!empty($search)) {
                $sql .= " WHERE uid LIKE :search OR
                          description LIKE :search OR
                          doctype LIKE :search OR
                          department LIKE :search OR
                          file_name LIKE :search";
            }

            $stmt = $conn->prepare($sql);
            if (!empty($search)) {
                $searchTerm = "%$search%";
                $stmt->bindValue(':search', $searchTerm, PDO::PARAM_STR);
            }
            $stmt->execute();
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo "<div class='container'><table>
                    <tr>
                        <th>UID</th>
                        <th>Description</th>
                        <th>Document Type</th>
                        <th>From</th>
                        <th>To</th>
                        <th>File</th>
                        <th>Date & Time Uploaded</th>
                        <th>File Status</th>
                    </tr>";

            if ($records) {
                foreach ($records as $row) {
                    $file_status_link = "filestatus.php?id=" . htmlspecialchars($row['uid']);

                    echo "<tr>
                            <td>2024-" . htmlspecialchars($row['uid']) . "</td>
                            <td>" . htmlspecialchars($row['description']) . "</td>
                            <td>" . htmlspecialchars($row['doctype']) . "</td>
                            <td>" . htmlspecialchars($row['from_user']) . "</td>
                            <td>" . htmlspecialchars($row['department']) . "</td>
                            <td><a href='" . htmlspecialchars($row['file_path']) . "' target='_blank'>" . htmlspecialchars($row['file_name']) . "</a></td>
                            <td>" . htmlspecialchars($row['uploaded_at']) . "</td>
                            <td><a href='" . htmlspecialchars($file_status_link) . "' target='_blank'>Check Status</a></td>
                          </tr>";
                }
                echo "</table></div>";
            } else {
                echo "<div class='none'>No documents found.</div>";
            }
            ?>
        </div>
    </div>
</div>

<script>
    function searchDocuments() {
        var searchValue = document.querySelector('.search input').value.trim();
        window.location.href = 'dashboard.php?search=' + encodeURIComponent(searchValue);
    }
</script>

</body>
</html>
