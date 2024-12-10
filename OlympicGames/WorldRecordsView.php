<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Παγκόσμια Ρεκόρ</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">Παγκόσμια Ρεκόρ</h1>
    <h3>Λίστα Παγκώνιων Ρεκόρ και Αγωνισμάτων</h3>

    <table id="worldRecordsTable" class="table table-striped mt-3">
        <!-- Η DataTable θα τοποθετήσει αυτόματα τα δεδομένα -->
    </table>
</div>

<script>
$(document).ready(function() {
    // Αρχικοποίηση του DataTable
    var table = $('#worldRecordsTable').DataTable({
        "processing": true,
        "rowId": "ID",
        "columns": [
            { "data": "ID", "title": "ID" },
            { "data": "agonisma_id", "title": "ID Αγωνίσματος" },
            { "data": "hmerominia", "title": "Ημερομηνία Ρεκόρ" },
            { "data": "onoma_athliti", "title": "Όνομα Αθλητή" },
            { "data": "epitheto_athliti", "title": "Επίθετο Αθλητή" },
            { "data": "xwra_id", "title": "ID Χώρας" },
            { "data": "onoma_agonismatos", "title": "Όνομα Αγωνίσματος" },
            { "data": "katigoria_agonismatos", "title": "Κατηγορία Αγωνίσματος" }
        ],
        "order": [[1, 'asc']],
        "lengthMenu": [[15, 50, 100, -1], [15, 50, 100, "Όλα"]],
        "pageLength": 15
    });

    // AJAX Request για φόρτωμα δεδομένων
    $.ajax({
        url: "http://lessons.dcie.teiemt.gr/db2/student_2411/API/WorldRecordsTable.php",  // Αντικατέστησε με τη σωστή διαδρομή
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
