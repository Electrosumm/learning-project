<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

  if (isset($_POST['submit'])) {
    // Connect to the MySQL database
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "eperp";

    $conn = mysqli_connect($host, $user, $password, $database);
    if (!$conn) {
      die("Error connecting to the database: " . mysqli_connect_error());
    }

    // Get the uploaded Excel file
    $file = $_FILES['file']['tmp_name'];

    $objPHPExcel = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);

    // Loop through each sheet in the Excel file
    foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
      // Get the worksheet data as an array
      $data = $worksheet->toArray();

      // Loop through the rows of data
      for ($i = 1; $i < count($data); $i++) {
        // Get the column values
        $name = $data[$i][0];
        $email = $data[$i][1];
        $phone = $data[$i][2];
        $address = $data[$i][3];

        // Insert the data into the MySQL database
        $sql = "INSERT INTO customers (customer name, customer email, customer phone, customer address) VALUES ('$name', '$email', '$phone', '$address')";
        mysqli_query($conn, $sql);
      }
    }

    // Close the MySQL connection
    mysqli_close($conn);
  }
?>
