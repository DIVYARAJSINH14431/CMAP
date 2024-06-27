<?php

include 'config.php';


if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
       
    $sql = "DELETE FROM ip_addresses WHERE id = $id";
    if(mysqli_query($conn, $sql)) {
        header("Location: edit_db.php");
        exit();
    } else {
        echo "Error deleting IP address: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
