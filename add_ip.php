<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['new_ip']) && !empty($_POST['new_ip'])) {
        $new_ip = $_POST['new_ip'];

       
        $sql = "INSERT INTO ip_addresses (ip_address) VALUES (?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $new_ip);
        $success = mysqli_stmt_execute($stmt);

        if ($success) {
            echo "New IP address added successfully.";
        } else {
            echo "Error adding new IP address: " . mysqli_error($conn);
        }
    } else {
        echo "Please provide a valid IP address.";
    }
}

mysqli_close($conn);
?>
