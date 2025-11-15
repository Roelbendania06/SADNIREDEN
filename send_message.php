<?php
include "db.php";

if (isset($_POST['name'])) {
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO messages (name, email, message) VALUES (?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        // Success: show alert and go back to homepage
        echo "<script>
                alert('Message Sent!');
                 window.location.href = 'landingpage.php';
              </script>";
    } else {
        // Optional: show error if insertion fails
        echo "<script>
                alert('Failed to send message. Please try again.');
                window.history.back();
              </script>";
    }
}
?>
