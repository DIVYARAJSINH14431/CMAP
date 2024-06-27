<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $host = $_POST["ip_address"];

    
    function scanPorts($host, $start_port, $end_port) {
        
        for ($port = $start_port; $port <= $end_port; $port++) {
           
            $connection = @fsockopen($host, $port, $errno, $errstr, 1);
            
           
            if ($connection) {
                echo "Port $port open\n";
                fclose($connection);
            } else {
                echo "Port $port closed\n";
            }
        }
    }

   
    function ping($ip) {
        exec("ping " . $ip, $output, $result);
        
       
        $html = "<style>
            .ping-data {
                list-style-type: none;
                padding: 0;
            }

            .ping-data li {
                margin-bottom: 5px;
            }

            .ping-data .reply {
                color: green;
            }

            .ping-data .statistics {
                color: blue;
            }
        </style>
        <ul class='ping-data'>";
        foreach ($output as $item) {
            if (empty($item)) {
                $html .= "<li>&nbsp;</li>";
            } elseif (strpos($item, 'Reply') === 0) {
                $html .= "<li class='reply'>$item</li>";
            } elseif (strpos($item, 'Ping statistics') === 0) {
                $html .= "<li class='statistics'>$item</li>";
            } else {
                $html .= "<li>$item</li>";
            }
        }
        $html .= "</ul>";

       
        return $html;
    }

    
    $start_port = 80; 
    $end_port = 80; 
    scanPorts($host, $start_port, $end_port);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Panel</title>
    <style>
    
    .sidebar {
        height: 100%;
        width: 250px;
        position: fixed;
        top: 0;
        left: 0;
        background: linear-gradient(to bottom, #007bff, #0056b3); 
        padding-top: 20px;
        color: white;
        overflow-y: auto; 
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.5); 
    }

    .sidebar h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .sidebar ul {
        list-style-type: none;
        padding: 0;
    }

    .sidebar li {
        padding: 10px;
        font-size: 16px;
        border-bottom: 1px solid #333; 
    }

    .sidebar li:last-child {
        border-bottom: none; 
    }

    .sidebar a {
        text-decoration: none;
        color: white;
        transition: background-color 0.3s; 
        display: block; 
    }

    .sidebar a:hover {
        background-color: #444; 
    }

    
    .content {
        margin-left: 250px;
        padding: 20px;
    }
</style>

    <style>
    .container {
        max-width: 400px;
        margin: 50px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
       
        box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.75);
        
    }
    
    .container h2 {
        text-align: center;
        margin-bottom: 20px;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        font-weight: bold;
    }
    
    .form-group input[type="text"] {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    
    .form-group button[type="submit"] {
        display: block;
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: none;
        border-radius: 4px;
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
    }
    
    .form-group button[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>

    <style>
    body {
        font-family: Arial, sans-serif;
    }
    
    .container {
        max-width: 400px;
        margin: 50px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
    
    .container h2 {
        text-align: center;
        margin-bottom: 20px;
    }
    
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        font-weight: bold;
    }
    
    .form-group input[type="text"] {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    
    .form-group button[type="submit"] {
        display: block;
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: none;
        border-radius: 4px;
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
    }
    
    .form-group button[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>

<div class="sidebar">
    <h2>IP Addresses</h2>
    <ul>
        <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "user_db";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Fetch IP addresses from the database
            $stmt = $conn->prepare("SELECT ip_address FROM ip_addresses");
            $stmt->execute();

            // Display IP addresses in the sidebar panel
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<li><a href='#'>" . $row['ip_address'] . "</a></li>";
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
    </ul>
</div>

<div class="content">
    <div class="container">
        <h2>Cmap</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="input-text">Enter IpAddress:</label>
                <input type="text" id="input-text" name="ip_address" placeholder="">
            </div>
            <div class="form-group">
                <button type="submit">Submit</button>
            </div>
        </form>
        <?php 
        // Output the ping results here
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo ping($host);
        }
        ?>
    </div>
</div>

</body>
</html>
