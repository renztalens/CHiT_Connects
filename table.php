<?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "cdatabase";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $search = mysqli_real_escape_string($conn, $_GET['search']);
            $sql = "SELECT * FROM records WHERE 
                    uid LIKE '%$search%' OR
                    description LIKE '%$search%' OR
                    doctype LIKE '%$search%' OR
                    department LIKE '%$search%' OR
                    file LIKE '%$search%'";
        }
        else {
            $sql = "SELECT * FROM records";
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $uid = mysqli_real_escape_string($conn, $_POST['uid']);
            $description = mysqli_real_escape_string($conn, $_POST['description']);
            $doctype = mysqli_real_escape_string($conn, $_POST['doctype']);
            $department = mysqli_real_escape_string($conn, $_POST['department']);
            $file_name = mysqli_real_escape_string($conn, $_POST['file_name']);

            if (!empty($id)) {
                $updateSql = "UPDATE records SET description='$description', doctype='$doctype', department='$department', file_name='$file_name', WHERE uid='$uid'";
                $conn->query($updateSql);    
            }
            else {
                $insertSql = "INSERT INTO records (description, doctype, department, file) VALUES ('$description', '$doctype', '$department', '$file_name')";
                $conn->query($insertSql);
            }
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit();
        }

        $sql = "SELECT * FROM records";
        $result = $conn->query($sql);

        echo "<div class='container'><table>
        <tr>
            <th>UID</th>
            <th>Description</th>
            <th>Doc Type</th>
            <th>Department</th>
            <th>File</th>
            <th>QR Code</th>
            <th>Time Uploaded</th>
        </tr>";

        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            
            echo "<tr>
                        <td data-id='" . $row['uid'] . "' data-field='uid'>" . $row['uid'] . "</td>
                        <td data-id='" . $row['uid'] . "' data-field='description'>" . $row['description'] . "</td>
                        <td data-id='" . $row['uid'] . "' data-field='doctype'>" . $row['doctype'] . "</td>
                        <td data-id='" . $row['uid'] . "' data-field='department'>" . $row['department'] . "</td>
                        <td data-id='" . $row['uid'] . "' data-field='file_name'>" . $row['file_name'] . "</td>
                        <td data-id='" . $row['uid'] . "' data-field='uploaded_at'>" . $row['uploaded_at'] . "</td>
                    </tr>";
            }
            echo "</div></table>";
        }
        else  {
            echo "<div class='none'>No documents found.</div>";
        }

        $conn->close();
?>  