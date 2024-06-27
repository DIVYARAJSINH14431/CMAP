<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Database</title>

   <style>
      body {
         font-family: Arial, sans-serif;
         background-color: #f8f9fa;
         margin: 0;
         padding: 20px;
      }

      h2 {
         margin-top: 0;
         color: #007bff;
      }

      table {
         width: 100%;
         border-collapse: collapse;
         margin-bottom: 20px;
      }

      th, td {
         border: 1px solid #ddd;
         padding: 8px;
         text-align: left;
      }

      th {
         background-color: #f2f2f2;
      }

      input[type="text"] {
         padding: 8px;
         border: 1px solid #ddd;
         border-radius: 4px;
         width: 100%;
         box-sizing: border-box;
      }

      .add-form {
         max-width: 400px;
         margin-top: 20px;
      }

      .add-form label {
         display: block;
         margin-bottom: 5px;
         font-weight: bold;
         color: #007bff;
      }

      .add-form input[type="text"] {
         margin-bottom: 10px;
      }
   </style>
</head>
<body>
   
   <h2>Edit Database</h2>

   <?php
   
   include 'config.php';

   
   $sql = "SELECT * FROM ip_addresses";
   $result = mysqli_query($conn, $sql);

   if (mysqli_num_rows($result) > 0) {
       ?>
       <table id="ip_table">
           <tr>
               <th>ID</th>
               <th>IP Address</th>
               <th>Action</th>
           </tr>
           <?php
           while ($row = mysqli_fetch_assoc($result)) {
               ?>
               <tr>
                   <td><?php echo $row['id']; ?></td>
                   <td><input type="text" class="ip_address" data-id="<?php echo $row['id']; ?>" value="<?php echo $row['ip_address']; ?>"></td>
                   <td><a href="delete_ip.php?id=<?php echo $row['id']; ?>" style="color: #dc3545;">Delete</a></td>
               </tr>
               <?php
           }
           ?>
       </table>
       <?php
   } else {
       echo "No IP addresses found in the database.";
   }
   ?>

   
   <div class="add-form">
      <h2>Add New IP Address</h2>
      <form id="add_ip_form" action="add_ip.php" method="POST">
         <label for="new_ip">New IP Address:</label>
         <input type="text" id="new_ip" name="new_ip" placeholder="Enter new IP address">
         <button type="submit">Add IP Address</button>
      </form>
   </div>

   <script>
       
       document.querySelectorAll('.ip_address').forEach(input => {
           input.addEventListener('input', function() {
               const id = this.getAttribute('data-id');
               const newValue = this.value;
               updateIpAddress(id, newValue);
           });
       });

       
       function updateIpAddress(id, newValue) {
           const xhr = new XMLHttpRequest();
           xhr.open('POST', 'update_ip.php', true);
           xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
           xhr.onreadystatechange = function() {
               if (xhr.readyState === 4 && xhr.status === 200) {
                   console.log(xhr.responseText);
               }
           }
           xhr.send('id=' + id + '&ip_address=' + newValue);
       }
   </script>

</body>
</html>
