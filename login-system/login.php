<?php
session_start();

// initializing variables
$username = "";
$password = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('127.0.0.1', 'root', '', 'login-system', 3307);

// LOGIN USER
if (isset($_POST['login_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  // form validation: ensure that the form is correctly filled ...
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }

  // if there are no errors, try to login the user
  if (count($errors) == 0) {
    $password = md5($password); // encrypt the password before checking in the database
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
    $result = mysqli_query($db, $query);
    
    if (mysqli_num_rows($result) == 1) { // user found
      $_SESSION['username'] = $username;
      $_SESSION['success'] = "You are now logged in";
      header('location: index.php');
    } else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
    /* Ensure the page takes up the full height */
    html, body {
      height: 100%;
      margin: 0;
      display: flex;
      justify-content: flex-start; /* Aligns content towards the top */
      align-items: flex-start;
      padding-top: 20px; /* Adds some space at the top */
    }

    /* Background video */
    .video-background {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1; /* Make sure the video stays behind the content */
    }

    video {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    /* Center login form slightly above */
    .login-container {
      text-align: center;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
      color: white;
      max-width: 400px;
      width: 100%;
      background-color: rgba(255, 255, 255, 0.7); /* Light background for readability */
    }

    h2 {
      margin-bottom: 20px;
    }

    .input-group {
      margin: 10px 0;
    }

    label {
      font-size: 14px;
    }

    input[type="text"], input[type="password"] {
      width: 100%;
      padding: 10px;
      margin: 5px 0;
      border: none;
      border-radius: 5px;
      font-size: 16px;
    }

    .btn {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      width: 100%;
    }

    .btn:hover {
      background-color: #45a049;
    }

    p {
      color: white;
    }

    a {
      color: #4CAF50;
      text-decoration: none;
    }

    /* Media Queries for Mobile */
    @media (max-width: 768px) {
      html, body {
        justify-content: center;
        align-items: center;
        padding-top: 0; /* Remove top padding on mobile */
      }

      .login-container {
        padding: 20px;
        width: 80%; /* Makes the form wider on smaller screens */
      }
    }
  </style>
</head>
<body>
  <!-- Background Video -->
  <div class="video-background">
    <video autoplay muted loop id="background-video">
      <source src="assets/video.mp4" type="video/mp4">
      Your browser does not support the video tag.
    </video>
  </div>

  <!-- Login Form -->
  <div class="login-container">
    <div class="header">
      <h2>Login</h2>
    </div>
    
    <form method="post" action="login.php">
      <?php include('errors.php'); ?>
      <div class="input-group">
        <label>Username</label>
        <input type="text" name="username" value="<?php echo $username; ?>">
      </div>
      <div class="input-group">
        <label>Password</label>
        <input type="password" name="password">
      </div>
      <div class="input-group">
        <button type="submit" class="btn" name="login_user">Login</button>
      </div>
      <p>
  <span style="color: black;">Not yet a member? </span><a href="register.php">Sign up</a>
</p>

    </form>
  </div>
</body>
</html>
