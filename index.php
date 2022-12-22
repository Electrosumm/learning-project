<?php
session_start();
// Include login-check file
require_once "login-check.php";
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
      <link rel="stylesheet" href="./css/index-sytle.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
</head>
<body>
<?php
include "sidebar.php";
?>
</body>
</html>
