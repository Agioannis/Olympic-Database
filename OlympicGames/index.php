<?php
// Ξεκινάμε τη συνεδρία για να διαχειριστούμε την είσοδο του χρήστη (αν χρειάζεται)
session_start();
?>

<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Κεντρικό Μενού - Ολυμπιακοί Αγώνες</title>
    <!-- Σύνδεση με το Bootstrap για styling -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Κεντρικό Μενού</h1>

        <!-- Κουμπί για μετάβαση στην προβολή αθλητών -->
        <form action="AthletesView.php" method="get">
            <button type="submit" class="btn btn-primary btn-lg">Δείτε τους Αθλητές</button>
        </form>

        <!-- Κουμπί για μετάβαση στην προβολή προπονητών -->
        <form action="CoachesView.php" method="get">
            <button type="submit" class="btn btn-secondary btn-lg btn-block">Δείτε τους Προπονητές</button>
        </form>

                <!-- Κουμπί για μετάβαση στην προβολή Σταδίων -->
        <form action="StadiumsView.php" method="get">
            <button type="submit" class="btn btn-secondary btn-lg mt-3">Δείτε τα Στάδια</button>
       </form>

               <!-- Κουμπί για μετάβαση στην προβολή Αγωνισμάτων -->
        <form action="AgonismaView.php" method="get">
            <button type="submit" class="btn btn-info btn-lg mt-3">Δείτε τα Αγωνίσματα</button>
        </form>
                <!-- Κουμπί για μετάβαση στην προβολή ενός ρεκόρ -->
        <form action="WorldRecordsView.php" method="get">
            <!-- Αντικατέστησε το 1 με το ID του συγκεκριμένου ρεκόρ -->
            <button type="submit" class="btn btn-warning btn-lg mt-3" name="id" value="1">Δείτε το Ρεκόρ</button>
        </form>

    </div>






    </div>

    <!-- Σύνδεση με τα αρχεία JS για το Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
