<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Page</title>

 
   <link rel="stylesheet" href="css/style.css">

   
   <style>
      
      .sidebar {
         height: 100%;
         width: 0;
         position: fixed;
         z-index: 1;
         top: 0;
         left: 0;
         background-color: #191970; 
         overflow-x: hidden;
         transition: 0.5s;
         padding-top: 60px;
      }

      
      .sidebar a {
         padding: 10px 15px;
         text-decoration: none;
         font-size: 20px;
         color: black; 
         display: block;
         transition: 0.3s;
      }

     
      .sidebar a:hover {
         color: #f1f1f1;
      }

     
      .sidebar .closebtn {
         position: absolute;
         top: 0;
         right: 25px;
         font-size: 36px;
         margin-left: 50px;
      }

      
      .openbtn {
         font-size: 20px;
         cursor: pointer;
         background-color: #191970; 
         color: white;
         padding: 10px 15px;
         border: none;
         position: fixed;
         top: 10px;
         left: 10px;
         z-index: 2;
      }

      .openbtn:hover {
         background-color: #0056b3; 
      }

      
      .welcome-text {
         font-family: 'Arial Black', Arial, sans-serif;
         font-size: 68px;
         position: absolute;
         top: 50%;
         left: 50%;
         transform: translate(-50%, -50%);
         animation: slideIn 2s ease forwards, changeColor 5s infinite alternate;
      }

      @keyframes slideIn {
         from {
            transform: translate(-50%, -100%);
         }
         to {
            transform: translate(-50%, 0);
         }
      }

      @keyframes changeColor {
         0% {
            color: #007bff;
         }
         50% {
            color: #ff7f0e;
         }
         100% {
            color: #dc3545;
         }
      }

     
      .additional-images {
         position: absolute;
         top: 10px; 
         left: 10px;
         z-index: 3; 
      }

      .additional-images img {
         width: 100px; 
         height: auto; 
         margin-right: 10px; 
      }
   </style>
</head>
<body>
   
<div class="container">

  
   <div id="mySidebar" class="sidebar">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      <a href="#" class="btn" onclick="redirectEditDB()">Edit Database</a> 
      <a href="ppt.php" class="btn">Perform Ping Test</a> 
      <a href="login_form.php" class="btn">Login</a>
      <a href="register_form.php" class="btn">Register</a>
      <a href="logout.php" class="btn">Logout</a>
   </div>

  
   <div id="main" class="content">
      <!-- Button to open the sidebar -->
      <button class="openbtn" onclick="openNav()">&#9776; Menu</button>
      <!-- Big, good-looking text -->
      <div class="welcome-text">Welcome to Cmap</div>
      <div class="image-container">
         <img src="img/Header-logo-CSMCRI-New.png" />
         <img src="img/g20-logo.png" />
         </div>
      <!-- Additional images -->
      
         
      </div>
   </div>

</div>

<!-- JavaScript for sidebar functionality -->
<script>
function openNav() {
   document.getElementById("mySidebar").style.width = "250px";
   document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
   document.getElementById("mySidebar").style.width = "0";
   document.getElementById("main").style.marginLeft = "0";
}

// Function to redirect to edit_db.php
function redirectEditDB() {
   window.location.href = 'edit_db.php';
}
</script>

</body>
</html>
