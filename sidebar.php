<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="navbar.css">
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
            <img src="profilepics/jervin.jpg" alt="jervin" class="user-img">
            <div>
                <p class="bold">Jervin E.</p>
                <p>President</p>
            </div>
            </div>
            <ul>
                <li>
                    <a href="#">
                        <i class='bx bxs-dashboard'></i>
                        <span class="nav-item">Dashboard</span>
                    </a>
                    <span class="tooltip">Dashboard</span>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bx-cloud-upload'></i>
                        <span class="nav-item">Upload</span>
                    </a>
                    <span class="tooltip">Upload</span>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bxs-inbox'></i>
                        <span class="nav-item">Inbox</span>
                    </a>
                    <span class="tooltip">Inbox</span>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bx-cog'></i>
                        <span class="nav-item">Settings</span>
                    </a>
                    <span class="tooltip">Settings</span>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bx-log-out'></i>
                        <span class="nav-item">Logout</span>
                    </a>
                    <span class="tooltip">Logout</span>
                </li>
            </ul>
        </div>
    </div>
    <script src="sidebar.js"></script>
</body>
</html>
