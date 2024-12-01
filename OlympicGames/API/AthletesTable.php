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

// Ερώτημα SQL για την ανάκτηση των δεδομένων των αθλητών
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

// Δημιουργούμε ένα πίνακα για να κρατήσουμε τα δεδομένα
$athletes = array();

if ($result->num_rows > 0) {
    // Επεξεργαζόμαστε τα αποτελέσματα και τα αποθηκεύουμε στον πίνακα
    while($row = $result->fetch_assoc()) {
        $athletes[] = $row;
    }
} else {
    echo "Δεν βρέθηκαν αποτελέσματα";
}

// Κλείνουμε τη σύνδεση
$conn->close();

// Επιστρέφουμε τα δεδομένα σε JSON
//header('Content-Type: application/json');
echo json_encode($athletes);
?>