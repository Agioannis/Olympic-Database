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

// ������� SQL ��� ��� �������� ��� ��������� ��� ���������� �����
$sql = "SELECT
    WR.ID,
    WR.agonisma_id,
    WR.hmerominia,
    WR.onoma_athliti,
    WR.epitheto_athliti,
    WR.xwra_id,
    AG.onoma AS onoma_agonismatos,
    AG.katigoria AS katigoria_agonismatos
FROM WorldRecords WR
LEFT JOIN Agonisma AG ON WR.agonisma_id = AG.ID";


// �������� ��� ���������� SQL
$result = $conn->query($sql);

// ������������ ���� ������ ��� �� ���������� �� ��������
$worldRecords = array();

if ($result->num_rows > 0) {
    // ��������������� �� ������������ ��� �� ������������ ���� ������
    while($row = $result->fetch_assoc()) {
        $worldRecords[] = $row;
    }
} else {
    echo "��� �������� ������������";
}

// ��������� �� �������
$conn->close();

// ������������ �� �������� �� JSON
echo json_encode($worldRecords);
?>
