function exportTableToCSV(tableID, filename = '') {
    var csv = [];
    var rows = document.querySelectorAll("#" + tableID + " tr");

    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("td, th");

        /*         
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText.replace(/,/g, '')); // remove commas to avoid conflicts
                
        csv.push(row.join(","));    
        */

        for (var j = 0; j < cols.length; j++)
            row.push(cols[j].innerText);

        csv.push(row.join(";"));
    }

    // Download CSV
    var csvContent = csv.join("\n");
    var blob = new Blob([csvContent], { type: "text/csv;charset=utf-8;" });
    var link = document.createElement("a");
    var url = URL.createObjectURL(blob);
    link.setAttribute("href", url);
    link.setAttribute("download", filename ? filename + ".csv" : "table_data.csv");
    link.style.visibility = "hidden";
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function exportTableToExcel(tableID, filename = '') {
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

    // Specify file name
    filename = filename ? filename + '.xls' : 'excel_data.xls';

    // Create download link element
    downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);

    if (navigator.msSaveOrOpenBlob) {
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob(blob, filename);
    } else {
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

        // Setting the file name
        downloadLink.download = filename;

        //triggering the function
        downloadLink.click();
    }
}

document.addEventListener('DOMContentLoaded', function () {
    $('#report-datatable').dataTable({
        retrieve: true,
        paging: false,
        searching: false,
        info: false
    });

    // Exporta una tabla HTML a Excel
    document.getElementById('export-to-excel').addEventListener('click', function () {
        console.log('export-to-csv');
        exportTableToCSV('report-datatable', 'Balance General');
    });
});