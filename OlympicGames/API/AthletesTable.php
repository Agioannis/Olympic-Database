<?php
// ������������� ��� �������� ��������� ��� debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ��������� ��� �� ������� ��� ���� ���������
$servername = "localhost";
$username = "student_2411"; // � ������� ��� ����� ���������
$password = "pass2411"; // � ������� ���������
$dbname = "student_2411"; // ����� ��� ����� ���������

// ������������ �� �������
$conn = new mysqli($servername, $username, $password, $dbname);

// ��������� �� � ������� ����� ��������
if ($conn->connect_error) {
    die("������ ��������: " . $conn->connect_error);
}

// ������� SQL ��� ��� �������� ��� ��������� ��� �������
$sql = "
    SELECT
        ATHLITIS.ID,
        ATHLITIS.onoma AS athlitis_onoma,
        ATHLITIS.epitheto AS athlitis_epitheto,
        XWRA.onoma AS xwra_onoma,
        XWRA.plithismos AS xwra_plithismos,
        PROPONITIS.onoma AS proponitis_onoma,
        PROPONITIS.epitheto AS proponitis_epitheto
    FROM ATHLITIS
    LEFT JOIN XWRA ON ATHLITIS.xwra_id = XWRA.ID
    LEFT JOIN PROPONITIS ON ATHLITIS.proponitis_id = PROPONITIS.ID
";


$result = $conn->query($sql);

// ������������ ��� ������ ��� �� ���������� �� ��������
$athletes = array();

if ($result->num_rows > 0) {
    // ��������������� �� ������������ ��� �� ������������ ���� ������
    while($row = $result->fetch_assoc()) {
        $athletes[] = $row;
    }
} else {
    echo "��� �������� ������������";
}

// ��������� �� �������
$conn->close();

// ������������ �� �������� �� JSON
//header('Content-Type: application/json');
echo json_encode($athletes);
?>