<?php 
include("login-script.php") 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
      <!-- The meta viewport will scale my content to any device width -->
	   <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!--Favicon-->
      <link rel="icon" type="image/x-icon" href="icons/favicon.png">
      <!--Title-->
      <title>Learning</title>
      <link rel="stylesheet" href="css/style.css">
</head>
<body>
      <div id="bg"></div>
         <div class="wrapper">
            <p class="error"><?php echo $error; ?></p>
         <form class="login_form" action="" method="post">
            <div class="form-field">
                <input type="text" name="username" value="<?php echo $username; ?>">
                <p class="error username_err">
		        </p>
            </div>   
            <div class="form-field">
                <input type="password" name="password">
                <p class="error password-error">
		        </p>
            </div>
            <div class="form-field">
                <input type="submit" class="btn" value="Belépés">
                <p class="error login_err">
            </div>
        </form>
    </div>
</body>
</html>