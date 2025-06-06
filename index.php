<?php 
session_start();

include("php/config.php");

// Set the default timezone to Philippine timezone
date_default_timezone_set('Asia/Manila');

if(isset($_POST['submit'])) {
    $ConNumber = mysqli_real_escape_string($con,$_POST['ConNumber']);
    
    // Fetch the user data from the database, case-sensitive for ConNumber
    $query = mysqli_query($con, "SELECT * FROM users WHERE BINARY ConNumber='$ConNumber'") or die("Select Error");
    $row = mysqli_fetch_assoc($query);

     // Admin credentials (case-sensitive for both)
     if($ConNumber === '0991' && $_POST['password'] === 'admin!0514') {
        // Redirect to admin page
        header("Location: admin-page.php");
        exit();
    }
    
    if($row && password_verify($_POST['password'], $row['UserPassword'])) {
        // Password verified for regular user
        $_SESSION['valid'] = $row['ConNumber'];
        $_SESSION['username'] = $row['Username'];
        $_SESSION['DateOfBirth'] = $row['DateOfBirth'];
        $_SESSION['id'] = $row['Id'];

        // Update the login time in the database normal time
        $currentTime = date('Y-m-d h:i:s');
        mysqli_query($con, "UPDATE users SET dateTimeUser='$currentTime' WHERE ConNumber='$ConNumber'");
        
        // Redirect to regular user page
        header("Location: home.php");
        exit();
    } else {
        // Wrong Contact Number or Password
        $errorMessage = "<div class='message'>
            <p>Wrong Contact Number or Password</p>
        </div> <br>";
        $goBackButton = "<a href='index.php'><button class='btn'>Go Back</button></a>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('images/flood5.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            color: #333;
        }
        
        .container {
            padding: 10px 20px;
            border-radius: 10px;
            max-width: 500px;
            max-height: 1px; /* Shorter max height */
            width: 100%;
        }

        .error-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .error-message {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
        }

        .field.input {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 5%;
            top: 66%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
        }

        .toggle-password img {
            width: 20px;
            height: 20px;
        }
        
        .btn {
            background-color: #1D4ED8;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        
        .login-image img {
            max-width: 150px;
            height: auto;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container">
    <div class="box form-box">
           <!-- New image div -->
        <div class="login-image">
        <img src="images/flood5.gif" alt="Login Image" onerror="this.style.display='none'; alert('GIF image failed to load.');" />
        </div>
            <header>Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="ConNumber">Contact Number</label>
                    <input type="text" name="ConNumber" id="ConNumber" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                    <button type="button" class="toggle-password" onclick="togglePassword()">
                        <img src="images/eye.png" alt="Show" id="toggleIcon">
                    </button>
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
                <div class="links">
                    Don't have an account? <a href="register.php">Sign Up Now</a>
                </div>
            </form>
        </div>
    </div>

    <?php if(isset($errorMessage) || isset($goBackButton)): ?>
    <div class="error-container">
        <div class="error-message">
            <?php if(isset($errorMessage)) echo $errorMessage; ?>
            <?php if(isset($goBackButton)) echo $goBackButton; ?>
        </div>
    </div>
    <?php endif; ?>

    <script>
    function togglePassword() {
        var passwordField = document.getElementById('password');
        var toggleIcon = document.getElementById('toggleIcon');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            toggleIcon.src = 'images/hidden.png'; // Use your hide icon image
            toggleIcon.alt = 'Hide';
        } else {
            passwordField.type = 'password';
            toggleIcon.src = 'images/eye.png'; // Use your show icon image
            toggleIcon.alt = 'Show';
        }
    }
    </script>
</body>
</html>