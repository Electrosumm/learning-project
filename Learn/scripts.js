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

function importfromExcel() {
    
    const fileInput = document.getElementById('fileInput');
    const file = fileInput.files[0];
    const reader = new FileReader();
    reader.onload = (e) => {
      const data = e.target.result;
      const workbook = XLSX.read(data, { type: 'binary' });
      const sheetNames = workbook.SheetNames;
      sheetNames.forEach((sheetName) => {
        const sheet = workbook.Sheets[sheetName];
        const sheetData = XLSX.utils.sheet_to_json(sheet);
        
        const mysql = require('mysql');
        const connection = mysql.createConnection({
          host: 'localhost',
          user: 'root',
          password: '',
          database: 'learn'
        });
        connection.connect();
        
        sheetData.forEach((row) => {
          const customerName = row['Customer Name'];
          const customerEmail = row['Customer Email'];
          const customerPhone = row['Customer Phone'];
          const customerAddress = row['Customer Address'];
          const insertSql = 'INSERT INTO customers (customer name, customer email, customer phone, customer address) VALUES (?, ?, ?, ?)';
          const insertValues = [customerName, customerEmail, customerPhone, customerAddress];
          connection.query(insertSql, insertValues, (error, results) => {
            if (error) throw error;
            console.log(`Inserted ${results.affectedRows} row(s)`);
          });
        });
        
        connection.end();
      });
    };
    reader.readAsBinaryString(file);
}


function filterTable() {
    // Get value of input field
    var input, filter;
    input = document.getElementById("filterInput");
    filter = input.value.toUpperCase();

    // Get table body
    var tbody = document.getElementById("customers-table").getElementsByTagName("tbody")[0];

    // Get rows of table body
    var rows = tbody.getElementsByTagName("tr");

    // Loop through rows of table body
    for (var i = 0; i < rows.length; i++) {
      // Get cells of current row
      var cells = rows[i].getElementsByTagName("td");

      // Set found to false by default
      var found = false;

      // Loop through cells of current row
      for (var j = 0; j < cells.length; j++) {
        // If cell value contains filter text, set found to true
        if (cells[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
          found = true;
        }
      }

      // If found is true, show row, else hide row
      if (found) {
        rows[i].style.display = "";
      } else {
        rows[i].style.display = "none";
      }
    }
  }
