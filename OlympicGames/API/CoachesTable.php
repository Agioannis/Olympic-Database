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

// ������� SQL ��� ��� �������� ��� ��������� ��� ����������
$sql = "
    SELECT
        PROPONITIS.ID,
        PROPONITIS.onoma AS proponitis_onoma,
        PROPONITIS.epitheto AS proponitis_epitheto,
        XWRA.onoma AS xwra_onoma,
        COUNT(ATHLITIS.ID) AS athletes_count
    FROM PROPONITIS
    LEFT JOIN ATHLITIS ON PROPONITIS.ID = ATHLITIS.proponitis_id
    LEFT JOIN XWRA ON ATHLITIS.xwra_id = XWRA.ID
    GROUP BY PROPONITIS.ID, XWRA.onoma
";

$result = $conn->query($sql);

// ������������ ��� ������ ��� �� ���������� �� ��������
$coaches = array();

if ($result->num_rows > 0) {
    // ��������������� �� ������������ ��� �� ������������ ���� ������
    while($row = $result->fetch_assoc()) {
        $coaches[] = $row;
    }
} else {
    echo "��� �������� ������������";
}

// ��������� �� �������
$conn->close();

// ������������ �� �������� �� JSON
echo json_encode($coaches);
?>
