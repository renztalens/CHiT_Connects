<?php
	session_start();
	if(!isset($_SESSION['login'])){
		$_SESSION['login'] = array();
	}
	unset($_SESSION['qty_array']);
?>
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>
<body>
    <div class = "cover"></div>
    <div class="udmcontainer">
        <img src="img/udm1.png" class="udm1">
        <h1 class="udmtext">UNIVERSIDAD DE MANILA</h1>
        <h3 class="udmtext1">Former City College of Manila</h3>
    </div>
    <form class="form" action="validate.php" method="post" name="form" onsubmit="return validated()">
        <div class="regbox">
            <img src="img/udm1.png" class="boxlogo">
            <br>
            <br>
            <br>
            <br>
            <i class="fa fa-user" aria-hidden="true"></i>
                <input autocomplete="off" type="text" class="font" placeholder="Username"
                         name="username" value="">
            <div id="user_error">Invalid user input</div>
            <br>
            <i class="fa fa-lock" aria-hidden="true"></i>
                <input type="password" class="font" placeholder="Password"
                         name="password" value="">
            <div id="pass_error">Invalid password input</div>
            <br>
            <?php
		    if(isset($_SESSION['message'])){
			?>
			<div class="row">
				<div class="msg">
					<div class="alert alert-info text-align: left">
						<?php echo $_SESSION['message']; ?>
					</div>
				</div>
			</div>
			<?php
			unset($_SESSION['message']);
		    }
            ?>
            <br>
            <input class="button" type="submit" name="login" value="Log In">
            <hr class="line">
        </div>
        <div style="position: relative"><p style="position: fixed; bottom: 0; width:100%; text-align: center; color:rgba(139, 139, 139, 0.542)">Copyright © 2023. Unibersidad de Manila 659-A Cecilia Muñoz St, Ermita, Manila, 1000 Metro Manila</p></div>
    </form>
    <script src="valid.js"></script>
</body>
</html>