<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>�������� - ����� ������� ��� �����</title>
    
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
    <h1 class="text-center">��������</h1>
    <h3>����� ������� ��� ��������� �����</h3>

    <table id="agonismataTable" class="table table-striped mt-3">
        <!-- � DataTable �� ����������� �������� �� �������� -->
    </table>
</div>

    <script>
        $(document).ready(function() {
            // ������������ ��� DataTable �� SearchPanes
            var table = $('#agonismataTable').DataTable({
                "processing": true,  
                "rowId": "agonisma_id",
                "searching": true,
                "columns": [
                { "data": "agonisma_id", "title": "ID �����������" },
                { "data": "agonisma_onoma", "title": "����� �����������" },
                { "data": "athlites_count", "title": "������� �������" },
            ],
                order: [
                    [1, 'asc']
                ],
                lengthMenu: [[15, 50, 100, -1], [15, 50, 100, "���"]],
                pageLength: 15,
                dom: 'BPRlftip',  // ���������� �� DOM ��� �� ������������ �� searchPanes
                searchPanes: {
                    threshold: 1,
                    columns: [1, 2]
                } 
            });

            // AJAX Request ��� ������� ���������
            $.ajax({
                url: "http://lessons.dcie.teiemt.gr/db2/student_2411/API/AgonismaTable.php", // ��������� ��� API
                type: "GET",
                success: function(result) {
                    console.log("logs", result);
                    if (Array.isArray(result) && result.length > 0) {
                        result.forEach(function(item) {
                            // �������� ��� ������� ��� ������� ��� ��� ���������� ����� ��� ���� ��������
                            item.rekordos_names = item.wr_onoma_athliti + ' ' + item.wr_epitheto_athliti;
                            if (item.rekordos_names === ' ') {
                                item.rekordos_names = ''; // �� ��� ������� ��������� �����
                            }
                        });

                        table.clear().rows.add(result).draw();
                    } else {
                        console.error("������� �������� � ����� ���� �� ����������.");
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
