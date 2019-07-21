<?php
    require_once("../includes/initialize.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Вход</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/signin.css" rel="stylesheet">
    </head>
    <body>
        <?php
            if (admin_logged_in()) {
		?>
        <script type="text/javascript">
            redirect('progressbar.php');
        </script>
        <?php
            }
            if (isset($_POST['btnlogin'])){           
                $uname = trim($_POST['email']);
                $upass = trim($_POST['pass']);
                $h_upass = sha1($upass);
                
                if ($uname == '' OR $upass == '') {
		?>  
			<script type="text/javascript">
				alert("Невалиден потребител или парола");
			</script>
        <?php
				} else {
					$user = new User();
					$res = $user::AuthenticateUser($uname, $h_upass);
				
					if($res == true){
		?>   
			<script type="text/javascript">
				window.location = "index.php";
			</script>
        <?php
					} else {
		?>    
			<script type="text/javascript">
				alert("Нерегистриран потребител");
				window.location = "index.php";
			</script>
        <?php
					}
				}
			} else {
				$email = "";
				$upass = "";
            }
            
		?>
        <div class="container">
            <form class="form-signin" method="POST" action="login.php">
                <h2 class="form-signin-heading">Влез</h2>
                <input type="text" class="form-control" placeholder="Email address" name="email" autofocus>
                <input type="password" class="form-control" placeholder="Password" name="pass">
                <label class="checkbox">
					<input type="checkbox" value="remember-me">Запомни ме</input>
                </label>
                <button class="btn btn-lg btn-primary btn-block" type="submit" name="btnlogin">Влез</button>
            </form>
        </div>
    </body>
</html>