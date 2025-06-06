<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Register</title>
    <style>
    body {
    margin: 0;
    padding: 0;
    background-image: url('images/flood3.gif');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    min-height: 100vh; /* Ensure full viewport coverage */
    font-family: Arial, sans-serif;
    position: relative; /* Required for ::after overlay positioning */
    }

    body::after {
        content: "";
        background-image: url('images/flood3.gif'); /* Ensure it’s the correct image path */
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        opacity: 0.1;
        position: fixed; /* Cover the entire viewport */
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        z-index: -1;

            }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 60%;
            max-width: 600px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .link-like {
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }
        .terms-container {
            display: flex;
            align-items: center;
        }
        .terms-container input[type="checkbox"] {
            width: auto;
            margin-right: 10px;
        }
        .modal-content h2, .modal-content p {
            text-align: left;
        }
        .field.input {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 70%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
        }
        .message1{
    background-color: lightgreen;
    text-align: center;
    background: #ffd1df;
    padding: 15px 0px;
    border:1px solid red;
    border-radius: 5px;
    margin-bottom: 10px;
}

.success-message1 {
    color: red;
}

.message {
    background-color: lightgreen;
    text-align: center;
    background: #abf7b1;
    padding: 15px 0px;
    border:1px solid #699053;
    border-radius: 5px;
    margin-bottom: 10px;
}

.success-message {
    color: #008631;
}.message {
    background-color: lightgreen;
    text-align: center;
    background: #abf7b1;
    padding: 15px 0px;
    border:1px solid #699053;
    border-radius: 5px;
    margin-bottom: 10px;
}

.success-message {
    color: #008631;
}

        
    </style>
</head>
<body>
<div class="container">
    <div class="box form-box">

    <?php
    include("php/config.php");
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $ConNumber = $_POST['ConNumber'];
        $DateOfBirth = date('Y-m-d', strtotime($_POST['DateOfBirth']));
        $password = $_POST['password']; 

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Validation checks
        if (!preg_match("/^[a-zA-Z\s]*$/", $username)) {
            echo "<div class='message1'><p class='success-message1'> Name should only contain letters. Try Again</p></div><br>";
            echo "<form action='register.php' method='post'>
            <input type='hidden' name='username' value='" . htmlspecialchars($_POST['username']) . "'>
            <input type='hidden' name='ConNumber' value='" . htmlspecialchars($_POST['ConNumber']) . "'>
            <input type='hidden' name='DateOfBirth' value='" . htmlspecialchars($_POST['DateOfBirth']) . "'>
            <button class='btn' type='submit'>Return to Register</button>
          </form>";
        } elseif (!preg_match("/^\d{11}$/", $ConNumber)) {
            echo "<div class='message1'><p class='success-message1'>Contact Number should have exactly 11 numbers. Try Again</p></div><br>";
            echo "<form action='register.php' method='post'>
                    <input type='hidden' name='username' value='" . htmlspecialchars($_POST['username']) . "'>
                    <input type='hidden' name='ConNumber' value='" . htmlspecialchars($_POST['ConNumber']) . "'>
                    <input type='hidden' name='DateOfBirth' value='" . htmlspecialchars($_POST['DateOfBirth']) . "'>
                    <button class='btn' type='submit'>Return to Register</button>
                  </form>";
        } elseif (!preg_match("/^(?=.*[a-zA-Z])(?=.*\d).{8,}$/", $password)) {
            echo "<div class='message1'><p class='success-message1'>Password should be alphanumeric and at least 8 characters long. Try Again</p></div><br>";
            echo "<form action='register.php' method='post'>
            <input type='hidden' name='username' value='" . htmlspecialchars($_POST['username']) . "'>
            <input type='hidden' name='ConNumber' value='" . htmlspecialchars($_POST['ConNumber']) . "'>
            <input type='hidden' name='DateOfBirth' value='" . htmlspecialchars($_POST['DateOfBirth']) . "'>
            <button class='btn' type='submit'>Return to Register</button>
          </form>";
        } else {
            // Verify unique contact number
            $verify_query = mysqli_query($con,"SELECT ConNumber FROM users WHERE ConNumber='$ConNumber'");
            if(mysqli_num_rows($verify_query) != 0 ){
                echo "<div class='message1'><p class='success-message1'>This Contact Number is used, Try another One Please!</p></div> <br>";
                echo "<form action='register.php' method='post'>
                <input type='hidden' name='username' value='" . htmlspecialchars($_POST['username']) . "'>
                <input type='hidden' name='ConNumber' value='" . htmlspecialchars($_POST['ConNumber']) . "'>
                <input type='hidden' name='DateOfBirth' value='" . htmlspecialchars($_POST['DateOfBirth']) . "'>
                <button class='btn' type='submit'>Return to Register</button>
              </form>";
            } else {
                // Insert user into database with hashed password
                mysqli_query($con,"INSERT INTO users(Username,ConNumber,DateOfBirth,UserPassword) VALUES('$username','$ConNumber','$DateOfBirth','$hashedPassword')") or die("Error Occurred");
                echo "<div class='message'><p class='success-message'>Registration successfully!</p></div> <br>";
                echo "<a href='index.php'><button class='btn'>Login Now</button></a>";
            }
        }
    } else {
    ?> 

        <header>Sign Up</header>
        <form action="register.php" method="post">
    <div class="field input">
        <label for="username">Name</label>
        <input type="text" name="username" id="username" autocomplete="on" required 
               value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
    </div>
    
    <div class="field input">
        <label for="ConNumber">Contact Number</label>
        <input type="text" name="ConNumber" id="ConNumber" autocomplete="on" required 
               value="<?php echo isset($_POST['ConNumber']) ? htmlspecialchars($_POST['ConNumber']) : ''; ?>">
    </div>
    
    <div class="field input">
        <label for="DateOfBirth">Birthday</label>
        <input type="date" name="DateOfBirth" id="DateOfBirth" autocomplete="off" required 
               value="<?php echo isset($_POST['DateOfBirth']) ? htmlspecialchars($_POST['DateOfBirth']) : ''; ?>">
    </div>
    
    <div class="field input">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" autocomplete="off" required
               placeholder="<?php echo isset($_POST['password']) ? 'Re-enter password' : ''; ?>">
        <button type="button" class="toggle-password" onclick="togglePassword()">
            <img src="images/eye.png" alt="Show" id="toggleIcon" style="width: 20px; height: 20px;">
        </button>
    </div>


    <div class="terms-container">
        <input type="checkbox" id="agree_terms" name="agree_terms" 
               <?php echo isset($_POST['agree_terms']) ? 'checked' : ''; ?> required>
        <label for="agree_terms">By continuing, you accept and have read the <span class="link-like" id="showTerms">terms and conditions</span>.</label>
    </div>

    <div style="text-align: left; margin-top: 15px;">
            <span>Already have an account? <a href="index.php" style="color: #1D4ED8;">Log In</a></span>
        </div>

    <div class="field">
        <button style="background-color: #1D4ED8; color: white;" type="submit" class="btn" name="submit" value="Register">Register</button>
    </div>

</form>


    </div>
    <?php } ?>
</div>

<div id="signupModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="document.getElementById('signupModal').style.display='none'">&times;</span>
        <h2>Data Privacy Notice</h2>
        <p>Republic Act No. 10173 or known as the Data Privacy Act of 2012 and other relevant 
            Philippine laws that apply to the collection and processing of your personal data. 
            By subscribing to Eye Flood site, you allow the collection, use, and processing of your personal data.</p>
        <p>By signing up, you agree to follow our terms, privacy policy, and guidelines. You must be 15+, provide accurate info, 
            and secure your account. Illegal or abusive behavior, as well as unauthorized content use, are prohibited. 
            We respect your privacy and reserve the right to terminate accounts for violations. Updated terms apply, and your 
            continued use signals acceptance. Additionally, please note that the data provided will be stored for one year 
            from the date of account creation, after which it will be deleted.</p>
    </div>
</div>

<script>
    document.getElementById('showTerms').addEventListener('click', function() {
        document.getElementById('signupModal').style.display = 'block';
    });

    document.querySelector('form').addEventListener('submit', function(event) {
    var agreeCheckbox = document.getElementById('agree_terms');
    if (!agreeCheckbox.checked) {
        event.preventDefault(); 
        alert("You must agree to the terms to sign up.");
        return;
    }

    var dateOfBirth = document.getElementById('DateOfBirth').value;
    var birthYear = new Date(dateOfBirth).getFullYear();
    if (birthYear < 1908) {
        event.preventDefault();
        alert("Year of birth cannot be earlier than 1908.");
    }
});
    

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