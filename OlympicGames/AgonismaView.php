<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Αγώνισμα - Λίστα Αθλητών και Ρεκόρ</title>
    
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
    <h1 class="text-center">Αγώνισμα</h1>
    <h3>Λίστα Αθλητών και Παγκόσμια Ρεκόρ</h3>

    <table id="agonismataTable" class="table table-striped mt-3">
        <!-- Η DataTable θα τοποθετήσει αυτόματα τα δεδομένα -->
    </table>
</div>

    <script>
        $(document).ready(function() {
            // Αρχικοποίηση του DataTable με SearchPanes
            var table = $('#agonismataTable').DataTable({
                "processing": true,  
                "rowId": "agonisma_id",
                "searching": true,
                "columns": [
                { "data": "agonisma_id", "title": "ID Αγωνίσματος" },
                { "data": "agonisma_onoma", "title": "Όνομα Αγωνίσματος" },
                { "data": "athlites_count", "title": "Αριθμός Αθλητών" },
            ],
                order: [
                    [1, 'asc']
                ],
                lengthMenu: [[15, 50, 100, -1], [15, 50, 100, "Όλα"]],
                pageLength: 15,
                dom: 'BPRlftip',  // Ρυθμίζουμε το DOM για να περιλαμβάνει το searchPanes
                searchPanes: {
                    threshold: 1,
                    columns: [1, 2]
                } 
            });

            // AJAX Request για φόρτωμα δεδομένων
            $.ajax({
                url: "http://lessons.dcie.teiemt.gr/db2/student_2411/API/AgonismaTable.php", // Διεύθυνση του API
                type: "GET",
                success: function(result) {
                    console.log("logs", result);
                    if (Array.isArray(result) && result.length > 0) {
                        result.forEach(function(item) {
                            // Εμφάνιση του αριθμού των αθλητών και του παγκόσμιου ρεκόρ για κάθε αγώνισμα
                            item.rekordos_names = item.wr_onoma_athliti + ' ' + item.wr_epitheto_athliti;
                            if (item.rekordos_names === ' ') {
                                item.rekordos_names = ''; // Αν δεν υπάρχει παγκόσμιο ρεκόρ
                            }
                        });

                        table.clear().rows.add(result).draw();
                    } else {
                        console.error("Λείπουν δεδομένα ή είναι κενό το αποτέλεσμα.");
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
