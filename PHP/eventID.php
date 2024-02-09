<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $eventId = $_POST["eventId"];
    session_start();
    $_SESSION["eventId"] = $eventId;
    try {
        require_once "../PHP/dbh.inc.php";

        // Check if the Event ID exists in reg_usr table
        $checkEventQuery = "SELECT * FROM events_table WHERE ID = ?";
        $stmt = $pdo->prepare($checkEventQuery);
        $stmt->execute([$eventId]);

        if ($stmt->rowCount() > 0) {
            // ID exists in reg_usr, redirect to user.html with eventId as a parameter
            header("Location: ../HTML/user.html?eventId=$eventId");
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
