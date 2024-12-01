<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Αθλητές</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- DataTables CSS (με SearchPanes) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/2.1.0/css/searchPanes.dataTables.min.css">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- DataTables JS (με SearchPanes) -->
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/searchpanes/2.1.0/js/searchPanes.dataTables.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">Αθλητές</h1>
    <h3>Λίστα Αθλητών με τις Σχετικές Πληροφορίες</h3>

    <table id="athletesTable" class="table table-striped mt-3">
        <!-- Η DataTable θα τοποθετήσει αυτόματα τα δεδομένα -->
    </table>
</div>

<script>
$(document).ready(function() {
    // Αρχικοποίηση του DataTable με SearchPanes
    var table = $('#athletesTable').DataTable({
        "processing": true,  
        "rowId": "athlitis_id",
        filter: true,
        deferRender: true,
        "searching": true,
        "columns": [
            { "data": "ID", "title": "ID" },
            { "data": "athlitis_onoma", "title": "Όνομα" },
            { "data": "athlitis_epitheto", "title": "Επίθετο" },
            { "data": "xwra_onoma", "title": "Χώρα" },
            { "data": "xwra_plithismos", "title": "Πληθυσμός Χώρας" },
            { "data": "proponitis_onoma", "title": "Όνομα Προπονητή" },
            { "data": "proponitis_epitheto", "title": "Επίθετο Προπονητή" }
        ],
        order: [
            [1, 'asc'],
            [2, 'asc']
        ],
        searching: true,  // Ενεργοποιούμε την αναζήτηση
        lengthMenu: [[15, 50, 100, -1], [15, 50, 100, "Όλα"]],
        pageLength: 15,
        dom: 'BPRlftip',  // Ρυθμίζουμε το DOM για να περιλαμβάνει το searchPanes
        searchPanes: {
            threshold:1,
            columns: [3,5]
            } 
    });

    // AJAX Request για φόρτωμα δεδομένων
    $.ajax({
        url: "http://lessons.dcie.teiemt.gr/db2/student_2411/API/AthletesTable.php",
        type: "GET",
        success: function(result) {
            console.log("logs", result);
            var tableData = JSON.parse(result);
            table.clear().rows.add(tableData).draw(); // Προσθήκη δεδομένων στο DataTable
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error: ", error);
        }
    });
});
</script>

</body>
</html>
