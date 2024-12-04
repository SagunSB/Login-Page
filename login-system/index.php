<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['username'])) {
  header('location: login.php');
  exit();
}

// Retrieve the username from the session
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Homepage</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
    /* Ensure the page takes up the full height */
    html, body {
      height: 100%;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
    }

    /* Center content in a container */
    .content-container {
      text-align: center;
      background-color: white;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      max-width: 600px;
      width: 100%;
    }

    h1 {
      margin-bottom: 20px;
      color: #333;
    }

    p {
      color: #666;
      font-size: 16px;
    }

    /* Button styling */
    .btn {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      text-decoration: none;
      font-size: 16px;
    }

    .btn:hover {
      background-color: #45a049;
    }

    /* Media Queries for Mobile */
    @media (max-width: 768px) {
      html, body {
        justify-content: center;
        align-items: center;
      }

      .content-container {
        padding: 20px;
        width: 80%; /* Makes the form wider on smaller screens */
      }


	  
    }
  </style>
</head>
<body>
  <div class="content-container">
    <h1>Welcome, <?php echo $username; ?>!</h1>
    <h1>This is your homepage. You are now successfully logged in.</h1>
	
    <a href="login.php" class="btn">Logout</a>
  </div>
</body>
</html>
