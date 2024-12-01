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


// ������� SQL ��� ��� �������� ��� ��������� ��� �������
$sql = "
    SELECT
        STADIA.ID AS stadio_id,
        STADIA.onoma AS stadio_onoma,
        STADIA.arithmos_thesewn AS stadio_arithmos_thesewn,
        STADIA.topothesia AS stadio_topothesia,
        AGONISMA.onoma AS agonisma_onoma,
        XORIGOS.onoma AS xorigos_onoma,
        XORIGOS.xrimatiki_upostiriksi AS xorigos_xrimatiki_upostiriksi,
        SUM(XORIGOS.xrimatiki_upostiriksi) AS total_xrimatiki_upostiriksi
    FROM STADIA
    LEFT JOIN AGONISMA ON STADIA.agonisma_id = AGONISMA.ID
    LEFT JOIN XORIGOS ON STADIA.ID = XORIGOS.stadio_id
    GROUP BY STADIA.ID
";


$result = $conn->query($sql);

// ������������ ��� ������ ��� �� ���������� �� ��������
$stadiums = array();

if ($result && $result->num_rows > 0) {
    // ��������������� �� ������������ ��� �� ������������ ���� ������
    while ($row = $result->fetch_assoc()) {
        $stadiums[] = $row;  // ������ �� ��������������� �� ����� ���������
    }
} else {
    // �������� ��������� � ����� ��������� �� ��� ������� ��������
    echo "��� �������� ������������ � �� ���������� ����� ����";
}




// ��������� �� �������
$conn->close();

// ������������ �� �������� �� JSON
echo json_encode($stadiums);
?>
