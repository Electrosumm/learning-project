<?php include("login-script.php") ?>
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
      <?php
	 	if($username_err != null){
	 		?> <style>.username_err{display:block}</style> <?php
	 	}
	 	if($password_err != null){
	 		?> <style>.password_err{display:block}</style> <?php
	 	}
	 	if($login_err != null){
	 		?> <style>.login_err{display:block}</style> <?php
	 	}
	 ?> 
</head>
<body>
      <div id="bg"></div>
         <div class="wrapper">
         <form action="" method="post">
            <div class="form-field">
                <input type="text" name="username" value="<?php echo $username; ?>">
                <p class="error username_err">
			    <?php echo $username_err; ?>
		        </p>
            </div>    
            <div class="form-field">
                <input type="password" name="password">
                <p class="error password-error">
			    <?php echo $password_err; ?>
		        </p>
            </div>
            <div class="form-field">
                <input type="submit" class="btn" value="Belépés">
                <p class="error login_err">
			    <?php echo $login_err; ?>
		        </p>
            </div>
        </form>
    </div>
</body>
</html>