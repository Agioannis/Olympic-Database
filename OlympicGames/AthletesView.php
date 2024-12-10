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
    
    <style>
        .sticky-buttons {
            position: sticky;
            top: 0;
            z-index: 1000;
            background-color: #343a40;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .sticky-buttons button {
            margin-right: 10px;
            color: white;
        }
    </style>
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
            threshold: 1,
            columns: [3, 5]
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
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f7f7f7;
            color: #ada6a6;
            background-image: url('https://www.lifo.gr/sites/default/files/styles/max_1920x1920/public/articles/2024-09-12/%CE%91%CE%98%CE%97%CE%9D%CE%91%20%281%29.jpg?itok=0x1s9t8m');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .container {
            background: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 10px;
            margin-top: 30px;
        }

        h1, h3 {
            text-align: center;
            color: #fff;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        h3 {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        .table {
            background-color: #fff;
            border-radius: 10px;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .dataTables_wrapper .dataTables_filter input {
            border-radius: 5px;
            padding: 10px;
            border: 1px solid #ddd;
            font-size: 1rem;
            margin-bottom: 20px;
        }

        .dataTables_wrapper .dataTables_length select {
            border-radius: 5px;
            padding: 10px;
            border: 1px solid #ddd;
            font-size: 1rem;
        }

        .dataTables_wrapper .dataTables_info {
            color: #fff;
            font-size: 1rem;
        }

        .dataTables_wrapper .dataTables_paginate {
            color: #fff;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: #fff;
            background-color: #005eb8;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            margin: 5px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #003f7f;
        }

        .btn {
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 1rem;
            color: #fff;
            text-align: center;
            display: inline-block;
            margin: 10px;
        }

        .btn-blue {
            background-color: #005eb8;
        }

        .btn-blue:hover {
            background-color: #003f7f;
        }

        .btn-yellow {
            background-color: #ffcc00;
            color: #000;
        }

        .btn-yellow:hover {
            background-color: #e6b800;
        }

        .btn-red {
            background-color: #ff0000;
        }

        .btn-red:hover {
            background-color: #cc0000;
        }

        .btn-black {
            background-color: #000;
        }

        .btn-black:hover {
            background-color: #333;
        }

        .btn-green {
            background-color: #28a745;
        }

        .btn-green:hover {
            background-color: #218838;
        }
    </style>

</html>
