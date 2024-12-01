<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Στάδια</title>
    
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
    <h1 class="text-center">Στάδια</h1>
    <h3>Λίστα Σταδίων με τις Σχετικές Πληροφορίες</h3>

    <table id="stadiumsTable" class="table table-striped mt-3">
        <!-- Η DataTable θα τοποθετήσει αυτόματα τα δεδομένα -->
    </table>
</div>

<script>
$(document).ready(function() {
    // Αρχικοποίηση του DataTable με SearchPanes
    var table = $('#stadiumsTable').DataTable({
        "processing": true,  
        "rowId": "stadio_id",
        filter: true,
        deferRender: true,
        "searching": true,
        "columns": [
            { "data": "stadio_id", "title": "ID Σταδίου" },
            { "data": "stadio_onoma", "title": "Όνομα Σταδίου" },
            { "data": "stadio_arithmos_thesewn", "title": "Αριθμός Θέσεων" },
            { "data": "stadio_topothesia", "title": "Τοποθεσία" },
            { "data": "agonisma_onoma", "title": "Αγώνισμα" },
            { "data": "xorigos_onoma", "title": "Χορηγός" },
            { "data": "xorigos_xrimatiki_upostiriksi", "title": "Χρηματική Υποστήριξη (€)" },
            { "data": "total_xrimatiki_upostiriksi", "title": "Συνολική Χρηματική Υποστήριξη (€)" } // Νέα στήλη
        ],
        order: [
            [1, 'asc']
        ],
        searching: true,  // Ενεργοποιούμε την αναζήτηση
        lengthMenu: [[15, 50, 100, -1], [15, 50, 100, "Όλα"]],
        pageLength: 15,
        dom: 'BPRlftip',  // Ρυθμίζουμε το DOM για να περιλαμβάνει το searchPanes
        searchPanes: {
            threshold: 1,
            columns: [4, 5]
        }
    });

    // AJAX Request για φόρτωμα δεδομένων
    $.ajax({
        url: "http://lessons.dcie.teiemt.gr/db2/student_2411/API/StadiumsTable.php", // Διεύθυνση του API
        type: "GET",
        success: function(result) {
            console.log("logs", result);
            try {
                var tableData = JSON.parse(result);  // Προσπαθούμε να αναλύσουμε το JSON
                if (Array.isArray(tableData) && tableData.length > 0) {
                    table.clear().rows.add(tableData).draw();
                    
                    // Αθροίζουμε τα συνολικά ποσά χρηματικής υποστήριξης
                    var totalFunding = 0;
                    tableData.forEach(function(item) {
                        totalFunding += parseFloat(item.total_xrimatiki_upostiriksi);
                    });

                    // Εμφάνιση του συνολικού ποσού χρηματικής υποστήριξης
                    $("#totalFunding").text("Συνολική Χρηματική Υποστήριξη: €" + totalFunding.toFixed(2));
                } else {
                    console.error("Λείπουν δεδομένα ή είναι κενό το αποτέλεσμα.");
                }
            } catch (error) {
                console.error("Σφάλμα ανάλυσης JSON:", error);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error: ", error);
        }
    });
});

</script>

</body>
</html>
