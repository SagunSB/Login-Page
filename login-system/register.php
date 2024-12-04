<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('127.0.0.1', 'root', '', 'login-system', 3307);

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
    array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure user does not already exist
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }
    if ($user['email'] === $email) {
      array_push($errors, "Email already exists");
    }
  }

  // Finally, register user if no errors
  if (count($errors) == 0) {
    $password = md5($password_1); // encrypt the password before saving in the database
    $query = "INSERT INTO users (username, email, password) VALUES('$username', '$email', '$password')";
    mysqli_query($db, $query);
    $_SESSION['username'] = $username;
    $_SESSION['success'] = "You are now logged in";
    header('location: index.php');
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Sign Up</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
    /* Basic reset for margins and paddings */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html, body {
      height: 100%;
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #f4f4f4;
      padding: 20px;
    }

    /* Sign-up Form container */
    .signup-container {
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px; /* Center the form */
      padding: 20px;
      text-align: center;
    }

    /* Header style */
    .header {
      margin-bottom: 20px;
    }

    .header h2 {
      font-size: 24px;
      color: #333;
    }

    /* Input groups */
    .input-group {
      margin-bottom: 15px;
    }

    .input-group label {
      font-size: 16px;
      color: #333;
    }

    .input-group input {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 16px;
    }

    /* Submit button */
    .btn {
      width: 100%;
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }

    .btn:hover {
      background-color: #45a049;
    }

    /* Link style */
    p a {
      color: #4CAF50;
      text-decoration: none;
    }

    /* Error message styling */
    .error {
      color: red;
      margin-bottom: 15px;
    }

    /* Media Queries for Mobile */
    @media (max-width: 768px) {
      html, body {
        padding: 10px;
      }

      .signup-container {
        width: 90%;
      }
    }
  </style>
</head>
<body>

  <!-- Sign-up Form -->
  <div class="signup-container">
    <div class="header">
      <h2>Register</h2>
    </div>
    
    <form method="post" action="register.php">
      <?php 
        // Display errors
        if (count($errors) > 0) {
          echo '<div class="error">';
          foreach ($errors as $error) {
            echo "<p>$error</p>";
          }
          echo '</div>';
        }
      ?>

      <div class="input-group">
        <label>Username</label>
        <input type="text" name="username" value="<?php echo $username; ?>" required>
      </div>

      <div class="input-group">
        <label>Email</label>
        <input type="email" name="email" value="<?php echo $email; ?>" required>
      </div>

      <div class="input-group">
        <label>Password</label>
        <input type="password" name="password_1" required>
      </div>

      <div class="input-group">
        <label>Confirm Password</label>
        <input type="password" name="password_2" required>
      </div>

      <div class="input-group">
        <button type="submit" class="btn" name="reg_user">Register</button>
      </div>

      <p>
        Already a member? <a href="login.php">Sign in</a>
      </p>
    </form>
  </div>

</body>
</html>
