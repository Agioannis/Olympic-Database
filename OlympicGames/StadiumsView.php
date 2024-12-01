<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>������</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- DataTables CSS (�� SearchPanes) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/2.1.0/css/searchPanes.dataTables.min.css">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- DataTables JS (�� SearchPanes) -->
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/searchpanes/2.1.0/js/searchPanes.dataTables.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">������</h1>
    <h3>����� ������� �� ��� �������� �����������</h3>

    <table id="stadiumsTable" class="table table-striped mt-3">
        <!-- � DataTable �� ����������� �������� �� �������� -->
    </table>
</div>

<script>
$(document).ready(function() {
    // ������������ ��� DataTable �� SearchPanes
    var table = $('#stadiumsTable').DataTable({
        "processing": true,  
        "rowId": "stadio_id",
        filter: true,
        deferRender: true,
        "searching": true,
        "columns": [
            { "data": "stadio_id", "title": "ID �������" },
            { "data": "stadio_onoma", "title": "����� �������" },
            { "data": "stadio_arithmos_thesewn", "title": "������� ������" },
            { "data": "stadio_topothesia", "title": "���������" },
            { "data": "agonisma_onoma", "title": "��������" },
            { "data": "xorigos_onoma", "title": "�������" },
            { "data": "xorigos_xrimatiki_upostiriksi", "title": "��������� ���������� (�)" },
            { "data": "total_xrimatiki_upostiriksi", "title": "�������� ��������� ���������� (�)" } // ��� �����
        ],
        order: [
            [1, 'asc']
        ],
        searching: true,  // ������������� ��� ���������
        lengthMenu: [[15, 50, 100, -1], [15, 50, 100, "���"]],
        pageLength: 15,
        dom: 'BPRlftip',  // ���������� �� DOM ��� �� ������������ �� searchPanes
        searchPanes: {
            threshold: 1,
            columns: [4, 5]
        }
    });

    // AJAX Request ��� ������� ���������
    $.ajax({
        url: "http://lessons.dcie.teiemt.gr/db2/student_2411/API/StadiumsTable.php", // ��������� ��� API
        type: "GET",
        success: function(result) {
            console.log("logs", result);
            try {
                var tableData = JSON.parse(result);  // ����������� �� ���������� �� JSON
                if (Array.isArray(tableData) && tableData.length > 0) {
                    table.clear().rows.add(tableData).draw();
                    
                    // ���������� �� �������� ���� ���������� �����������
                    var totalFunding = 0;
                    tableData.forEach(function(item) {
                        totalFunding += parseFloat(item.total_xrimatiki_upostiriksi);
                    });

                    // �������� ��� ��������� ����� ���������� �����������
                    $("#totalFunding").text("�������� ��������� ����������: �" + totalFunding.toFixed(2));
                } else {
                    console.error("������� �������� � ����� ���� �� ����������.");
                }
            } catch (error) {
                console.error("������ �������� JSON:", error);
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
