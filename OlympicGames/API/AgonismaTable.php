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
$conn->set_charset("utf8mb4");

// Ερώτημα SQL για την ανάκτηση των δεδομένων των αγωνισμάτων και των αθλητών
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

// Δημιουργούμε ένα πίνακα για να κρατήσουμε τα δεδομένα
$agonismata = array();

if ($result && $result->num_rows > 0) {
    // Επεξεργαζόμαστε τα αποτελέσματα και τα αποθηκεύουμε στον πίνακα
    while ($row = $result->fetch_assoc()) {
        $agonismata[] = $row;
    }
} else {
    // Εμφάνιση σφάλματος ή κενής απάντησης αν δεν βρεθούν δεδομένα
    echo "Δεν βρέθηκαν αποτελέσματα ή το αποτέλεσμα είναι κενό";
}

// Κλείνουμε τη σύνδεση
$conn->close();

// Επιστρέφουμε τα δεδομένα σε JSON
header('Content-Type: application/json');
echo json_encode($agonismata);
?>
