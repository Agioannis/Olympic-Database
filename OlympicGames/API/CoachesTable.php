<?php
// Ενεργοποιούμε την εμφάνιση σφαλμάτων για debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ρυθμίσεις για τη σύνδεση στη βάση δεδομένων
$servername = "localhost";
$username = "student_2411"; // Ο χρήστης της βάσης δεδομένων
$password = "pass2411"; // Ο κωδικός πρόσβασης
$dbname = "student_2411"; // Όνομα της βάσης δεδομένων

// Δημιουργούμε τη σύνδεση
$conn = new mysqli($servername, $username, $password, $dbname);

// Ελέγχουμε αν η σύνδεση είναι επιτυχής
if ($conn->connect_error) {
    die("Σφάλμα σύνδεσης: " . $conn->connect_error);
}

// Ερώτημα SQL για την ανάκτηση των δεδομένων των προπονητών
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

// Δημιουργούμε ένα πίνακα για να κρατήσουμε τα δεδομένα
$coaches = array();

if ($result->num_rows > 0) {
    // Επεξεργαζόμαστε τα αποτελέσματα και τα αποθηκεύουμε στον πίνακα
    while($row = $result->fetch_assoc()) {
        $coaches[] = $row;
    }
} else {
    echo "Δεν βρέθηκαν αποτελέσματα";
}

// Κλείνουμε τη σύνδεση
$conn->close();

// Επιστρέφουμε τα δεδομένα σε JSON
echo json_encode($coaches);
?>
