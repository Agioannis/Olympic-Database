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
$conn->set_charset("utf8mb4");

// ������� SQL ��� ��� �������� ��� ��������� ��� ����������� ��� ��� �������
$sql = "
SELECT 
    AGONISMA.agonisma_id,
    AGONISMA.onoma AS agonisma_onoma,
    AGONISMA.katigoria AS agonisma_katigoria,
    COUNT(ATHLITIS.ID) AS athlites_count
FROM 
    AGONISMA
INNER JOIN 
    ATHLITIS ON AGONISMA.athlitis_id = ATHLITIS.ID
GROUP BY 
    AGONISMA.agonisma_id";


$result = $conn->query($sql);

// ������������ ��� ������ ��� �� ���������� �� ��������
$agonismata = array();

if ($result && $result->num_rows > 0) {
    // ��������������� �� ������������ ��� �� ������������ ���� ������
    while ($row = $result->fetch_assoc()) {
        $agonismata[] = $row;
    }
} else {
    // �������� ��������� � ����� ��������� �� ��� ������� ��������
    echo "��� �������� ������������ � �� ���������� ����� ����";
}

// ��������� �� �������
$conn->close();

// ������������ �� �������� �� JSON
header('Content-Type: application/json');
echo json_encode($agonismata);
?>
