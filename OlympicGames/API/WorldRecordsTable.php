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

// Ερώτημα SQL για την ανάκτηση των δεδομένων των παγκόσμιων ρεκόρ
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


// Εκτέλεση του ερωτήματος SQL
$result = $conn->query($sql);

// Δημιουργούμε έναν πίνακα για να κρατήσουμε τα δεδομένα
$worldRecords = array();

if ($result->num_rows > 0) {
    // Επεξεργαζόμαστε τα αποτελέσματα και τα αποθηκεύουμε στον πίνακα
    while($row = $result->fetch_assoc()) {
        $worldRecords[] = $row;
    }
} else {
    echo "Δεν βρέθηκαν αποτελέσματα";
}

// Κλείνουμε τη σύνδεση
$conn->close();

// Επιστρέφουμε τα δεδομένα σε JSON
echo json_encode($worldRecords);
?>
