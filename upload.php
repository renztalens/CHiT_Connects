<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload Form</title>
    <link rel="stylesheet" href="upload1.css">
    <script src="upload1.js" defer></script>
</head>
<body>
    <h2>Upload a File</h2>
    <form action="process.php" method="post" enctype="multipart/form-data" onsubmit="return validateFileType()">
        <label for="description">Description</label>
        <input type="text" id="description" name="description" required>
        <br>
        <label for="department">Department</label>
        <select id="department" name="department" required onchange="updateDocType()">
            <option value="President">President</option>
            <option value="Vice President Admin">Vice President Admin</option>
            <option value="Vice President Finance">Vice President Finance</option>
            <option value="VPAA Academic">VPAA Academic</option>
            <option value="Human Resources">Human Resources</option>
            <option value="Quality Assurance">Quality Assurance</option>
            <option value="Guidance">Guidance</option>
            <option value="Office of Student Affairs">Office of Student Affairs</option>
            <option value="Registrar">Registrar</option>
            <option value="Faculties">Faculties</option>
        </select>
        <br>
        <label for="doctype">Document Type</label>
        <select id="doctype" name="doctype" required>
        </select>
        <br>
        <label for="file">File</label>
        <input type="file" id="file" name="file" required>
        <br>
        <input type="submit" name="submit" value="Upload">
    </form>
</body>
</html>
