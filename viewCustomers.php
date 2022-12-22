<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'eperp');
 
/* Attempt to connect to MySQL database */
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($conn === false){
    die("Nem sokerült csatlakozni..." . mysqli_connect_error());
}

$sql = "SELECT * FROM customers";
$result = $conn->query($sql);

if(!$result){
    die("Rossz kérés: ") . $conn->error;
}
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
      <!-- CSS -->
      <link rel="stylesheet" href="./css/index-sytle.css">
      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
      <script type="text/javascript" src="scripts.js"></script>
</head>
<body>
<?php
include "sidebar.php";
?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">

                                <form id="form" action="" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" name="search" class="form-control" placeholder="Keresés" id="filterInput" onkeyup="filterTable()">
                                        <button type="submit" class="btn btn-primary" onclick="exportTableToExcel('customers-table')">Exportálás Excelbe</button>
                                        <input type="file" class="form-control" name="file" id="file" accept=".xlsx"  />
                                        <button type="submit" class="btn btn-primary" name="import" id="import">Importálás Excelből</button>
                                    </div>
                                </form>
                                <form action="import-excel.php" method="post" enctype="multipart/form-data">
  <label for="file">Select Excel file:</label>
  <input type="file" name="file" id="file">
  <input type="submit" value="Import" name="submit">
</form>
                            </div>
                        </div>
                    </div>
<div class="container mt-4">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="customers-table">
                    <thead>
                        <tr>
                            <th>Kód</th>
                            <th>Ügyfélnév</th>
                            <th>Ügyfél Email</th>
                            <th>Ügyfél Telefonszám</th>
                            <th>Ügyfél Cím</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM customers";
                            $result = $conn->query($sql);

                            if (mysqli_num_rows($result) > 0) {
                                foreach ($result as $customers) {
                        ?>
                                    <tr>
                                        <td><?= $customers['id']; ?></td>
                                        <td><?= $customers['customer name']; ?></td>
                                        <td><?= $customers['customer email']; ?></td>
                                        <td><?= $customers['customer phone']; ?></td>
                                        <td><?= $customers['customer address']; ?></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<h5> Nincs semmilyen regisztrált adat! </h5>";
                            }
                        ?>
                        
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
</div>
<script >
function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
</script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.6/xlsx.full.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>