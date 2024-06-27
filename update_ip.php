<?php
// Include database connection file
include 'config.php';

// Check if ID and IP address are provided
if (isset($_POST['id']) && isset($_POST['ip_address'])) {
    // Sanitize input to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $ip_address = mysqli_real_escape_string($conn, $_POST['ip_address']);

    // Update IP address in the database
    $sql = "UPDATE ip_addresses SET ip_address='$ip_address' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "IP address updated successfully.";
    } else {
        echo "Error updating IP address: " . mysqli_error($conn);
    }
} else {
    echo "ID and IP address are required.";
}
?>
