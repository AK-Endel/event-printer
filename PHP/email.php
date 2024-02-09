<?php

session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST["email"];
    $eventId = isset($_SESSION['eventId']) ? $_SESSION['eventId'] : null;
    try {
        require_once "../PHP/dbh.inc.php";
    
         $checkEventQuery = "SELECT * FROM registration_info WHERE email = ? AND eventId = ?";
         $stmt = $pdo->prepare($checkEventQuery);
         $stmt->execute([$email, $eventId]);
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Extract values from the result set

            $name = $row['firstname'] .' '. $row['lastname'];
            // ID exists in reg_usr, redirect to user.html with eventId as a parameter
            header("Location: printing.php");

            
            // HERE SHOULD BE THE PRINTING TO PRINTER FUNCTION TRIGGER
            //exec('"C:\\Users\\ener.tahe\\AppData\\Local\\Programs\\Thonny\\python.exe" printer.py');


            die();
        } else {
            // ID does not exist in reg_usr, display an error or redirect back to the first page
            die("Invalid Event ID");
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    header("Location: ../HTML/user.html");
}
?>

