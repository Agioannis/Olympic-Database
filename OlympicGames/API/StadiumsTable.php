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


// Ερώτημα SQL για την ανάκτηση των δεδομένων των σταδίων
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

// Δημιουργούμε ένα πίνακα για να κρατήσουμε τα δεδομένα
$stadiums = array();

if ($result && $result->num_rows > 0) {
    // Επεξεργαζόμαστε τα αποτελέσματα και τα αποθηκεύουμε στον πίνακα
    while ($row = $result->fetch_assoc()) {
        $stadiums[] = $row;  // Πρέπει να χρησιμοποιήσεις τη σωστή μεταβλητή
    }
} else {
    // Εμφάνιση σφάλματος ή κενής απάντησης αν δεν βρεθούν δεδομένα
    echo "Δεν βρέθηκαν αποτελέσματα ή το αποτέλεσμα είναι κενό";
}




// Κλείνουμε τη σύνδεση
$conn->close();

// Επιστρέφουμε τα δεδομένα σε JSON
echo json_encode($stadiums);
?>
