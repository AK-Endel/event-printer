<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $eventId = $_POST["eventId"]; 

    try {
        require_once "../PHP/dbh.inc.php";

        // Check if the Event ID exists in the database
        $checkEventQuery = "SELECT * FROM events_table WHERE ID = ?";
        $stmt = $pdo->prepare($checkEventQuery);
        $stmt->execute([$eventId]);
        
        if ($stmt->rowCount() == 0) {   
            die("Event does not exist"); // Display error message
        }

        // Check if the email is already registered for the specified event
        $checkRegistrationQuery = "SELECT * FROM registration_info WHERE email = ? AND eventId = ?";
        $stmt = $pdo->prepare($checkRegistrationQuery);
        $stmt->execute([$email, $eventId]);

        if ($stmt->rowCount() > 0) {
            die("Email is already registered for the specified event"); // Display error message
        }

        // If the Event ID exists and the email is not already registered, proceed with user registration
        $insertQuery = "INSERT INTO registration_info (firstname, lastname, email, eventId) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($insertQuery);
        $stmt->execute([$firstname, $lastname, $email, $eventId]);


        // Clean up
        $pdo = null;
        $stmt = null;

        header("Location: ../HTML/success.html");
        die();
    } catch (PDOException $e) {
        die("Failed To Register :(" . $e->getMessage());
    }
} else {
    header("Location: ../HTML/register.html");
}
?>
