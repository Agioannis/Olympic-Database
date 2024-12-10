<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>��������� �����</title>

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
    <h1 class="text-center">��������� �����</h1>
    <h3>����� ��������� ����� ��� �����������</h3>

    <table id="worldRecordsTable" class="table table-striped mt-3">
        <!-- � DataTable �� ����������� �������� �� �������� -->
    </table>
</div>

<script>
$(document).ready(function() {
    // ������������ ��� DataTable
    var table = $('#worldRecordsTable').DataTable({
        "processing": true,
        "rowId": "ID",
        "columns": [
            { "data": "ID", "title": "ID" },
            { "data": "agonisma_id", "title": "ID �����������" },
            { "data": "hmerominia", "title": "���������� �����" },
            { "data": "onoma_athliti", "title": "����� ������" },
            { "data": "epitheto_athliti", "title": "������� ������" },
            { "data": "xwra_id", "title": "ID �����" },
            { "data": "onoma_agonismatos", "title": "����� �����������" },
            { "data": "katigoria_agonismatos", "title": "��������� �����������" }
        ],
        "order": [[1, 'asc']],
        "lengthMenu": [[15, 50, 100, -1], [15, 50, 100, "���"]],
        "pageLength": 15
    });

    // AJAX Request ��� ������� ���������
    $.ajax({
        url: "http://lessons.dcie.teiemt.gr/db2/student_2411/API/WorldRecordsTable.php",  // ������������� �� �� ����� ��������
        type: "GET",
        success: function(result) {
            console.log("logs", result);
            var tableData = JSON.parse(result);
            table.clear().rows.add(tableData).draw(); // �������� ��������� ��� DataTable
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error: ", error);
        }
    });
});
</script>

</body>
</html>
