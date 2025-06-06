<!--edit.php-->
<?php 
   session_start();
   include("php/config.php");
   if(!isset($_SESSION['valid'])){
      header("Location: index.php");
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Change Profile</title>
    <style>
        .field.input {
            position: relative;
        }
       .btn{
        background-color: #1D4ED8;
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
            display: block;
        }

        .toggle-password1 {
            position: absolute;
            right: 5%;
            top: 66%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
        }
        .toggle-password1 img {
            width: 20px;
            height: 20px;
            display: block;
        }

        .message1 {
            background-color: lightgreen;
            text-align: center;
            background: #ffd1df;
            padding: 15px 0px;
            border: 1px solid red;
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
            border: 1px solid #699053;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .success-message {
            color: #008631;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            text-align: center;
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

        .modal-button {
            background-color: red;
            color: white;
            border: none;
            padding: 10px 20px;
            margin: 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        .modal-button.cancel {
            background-color: grey;
        }

         /********* Home *****************/
         .logo{
            display: flex;
            align-items: center;
            font-size: 25px;
            font-weight: 900;
            color: #1696d5;
            background: #fff;
        
    }
    
    .logo img {
            width: 60px; /* Adjust as needed */
            height: 60px; /* Maintain aspect ratio */
            margin-right: 10px; /* Add some spacing between the logo and text */
}

    .logo a{
        text-decoration: none;
        color: #000;
      
    }
    .right-links {
        padding: 0 10px;
        text-decoration: none; /* Remove default underline */
        border: 2px solid transparent; /* Border */
        border-radius: 60px; /* Adjust border radius for the shape you want */
      
    }
    .right-links , .right-links button {
    margin-left: 50px; /* Space between buttons */
    text-decoration: none; /* Remove default underline */
    border: 2px solid transparent; /* Border */
    border-radius: 5px; /* Adjust border radius for the shape you want */
}
    /*
.right-links {
    display: flex;
    align-items: center;
}*/
    main{
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 30px;
    }
    .main-box {
        display: flex;
        flex-direction: column;
        width: 70%;
    }
    .main-box .on-top{
        width: 100%;
        margin-top: -20px; /*space between eyeflood and level*/
    }
    .main-box .top{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        gap: 2  0px;
    }
    .bottom{
        width: 100%;
        margin-top: 20px;
    }
    body {
            /*background picture*/ 
            margin: 0;
            padding: 0;
            background-image: url('images/edit.png');
            background-size: cover;
            background-color: rgba(255, 255, 255, 0);
            background-repeat: no-repeat;
            background-position: center;
            font-family: Arial, sans-serif;
        }
        .home-btn {
            background-color: #1D4ED8; /* Same color as the Update button */
            color: #fff;
            padding: 1px 30px;
            text-decoration: none;
            border-radius: 5px;
          
            transition: background-color 0.3s ease;
        }
        .home-btn:hover {
            background-color: #5a52e6; /* Darker shade on hover */
        }
        .right-links {
        padding: 0 10px;
        text-decoration: none; /* Remove default underline */
        border: 2px solid transparent; /* Border */
        border-radius: 10px; /* Adjust border radius for the shape you want */
        display: flex;
        align-items: center;
      
        }
        .footer {
    background-color: #2c3e50; /* Dark blue-gray background */
    color: #ecf0f1; /* Light gray text */
    padding: 10px 20px; /* Adjust padding for a thinner appearance */
    text-align: center;
    font-family: Arial, sans-serif;
}

.footer a {
    color: #1abc9c; /* Teal color for links */
    text-decoration: none;
    font-size: 8px; /* Small font size as specified */
}

.footer a:hover {
    text-decoration: underline;
}

.footer .contact-info,
.footer .links {
    margin-top: 10px;
    font-size: 8px; /* Consistent small font size */
}

.footer .links a {
    margin: 0 5px; /* Spacing between links */
}

/* Responsive design for smaller screens */
@media (max-width: 480px) {
    .footer {
        padding: 5px 10px; /* Reduce padding on mobile */
    }
    
    .footer a, .footer .contact-info, .footer .links {
        font-size: 6px; /* Smaller font size for very small screens */
    }
}

        .edit-image img {
                max-width: 100px; /* Adjust the width as needed */
                height: auto; /* Keep aspect ratio */
                display: block; /* Ensures centered if parent has text-align: center */
                margin: 0 auto; /* Center image */
            }

    </style>
</head>
<body>
<div class="nav">
        <div class="logo">
            <img class="logo-img" src="wave.png" alt="Logo">
            <p><a href="home.php" style="color: #1696d5; text-decoration: none; font-size: 24px;">Eye Flood</a></p>
            </div>
       

        <div class="right-links">
        <a href="home.php" class="home-btn">Home</a>
        </div>
    </div>
    <div class="container">
        <div class="box form-box">
            <?php 
               if(isset($_POST['submit'])){
                  $username = $_POST['username'];
                  $old_password = $_POST['old_password'];
                  $new_password = $_POST['password'];

                  // Check if both old and new passwords are provided
                  if(empty($old_password) || empty($new_password)) {
                      echo "<div class='message'>
                          <p>Please fill out both old and new password fields!</p>
                      </div> <br>";
                      echo "<a href='edit.php'><button class='btn'>Back</button>";
                      exit(); // Stop further execution
                  }

                  // Additional validation for new password
                  elseif (!preg_match("/^(?=.*[a-zA-Z])(?=.*\d).{8,}$/", $new_password)) {
                      echo "<div class='message1'><p class='success-message1'>Password should be alphanumeric and at least 8 characters long. Try Again</p></div><br>";
                      echo "<a href='edit.php'><button class='btn'>Back</button></a>";
                      exit(); // Stop further execution
                  }

                  $id = $_SESSION['id'];

                  // Check if old password matches the one stored in the database
                  $query = mysqli_query($con, "SELECT UserPassword FROM users WHERE Id=$id");
                  $result = mysqli_fetch_assoc($query);
                  $stored_password = $result['UserPassword'];
                  if (password_verify($old_password, $stored_password)) {
                      // Hash the new password
                      $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
                      $edit_query = mysqli_query($con,"UPDATE users SET Username='$username', UserPassword='$hashedPassword' WHERE Id=$id ") or die("error occurred");

                      if($edit_query){
                          echo "<div class='message'>
                              <p class='success-message'>Profile Updated!</p>
                          </div> <br>";
                          echo "<a href='home.php'><button class='btn'>Go Home</button>";
                      }
                  } else {
                      echo "<div class='message'>
                          <p>Incorrect old password!</p>
                      </div> <br>";
                      echo "<a href='edit.php'><button class='btn'>Back</button>";
                  }
               } else if(isset($_POST['delete'])){
                  // Delete user account
                  $id = $_SESSION['id'];
                  $delete_query = mysqli_query($con, "DELETE FROM users WHERE Id=$id");
                  
                  if($delete_query){
                      // Log out the user and destroy session
                      session_destroy();
                      echo "<div class='message'>
                          <p class='success-message'>Account Deleted Successfully!</p>
                      </div> <br>";
                      echo "<a href='index.php'><button class='btn'>Go to Homepage</button>";
                  } else {
                      echo "<div class='message'>
                          <p>Error deleting account!</p>
                      </div> <br>";
                      echo "<a href='edit.php'><button class='btn'>Back</button>";
                  }
               } else {
                  $id = $_SESSION['id'];
                  $query = mysqli_query($con,"SELECT * FROM users WHERE Id=$id ");

                  while($result = mysqli_fetch_assoc($query)){
                      $res_Uname = $result['Username'];
                  }
            ?>
        <!-- New image div -->
        <div class="edit-image">
        <img src="images/edit-prof.png" alt="Edit Image" />
        </div>
            <header>Change Profile</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo $res_Uname; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="old_password">Old Password</label>
                    <input type="password" name="old_password" id="old_password" autocomplete="off" required>
                    <button type="button" class="toggle-password" onclick="toggleOldPassword()">
                        <img src="images/eye.png" alt="Show" id="toggleIconOld">
                    </button>
                </div>

                <div class="field input">
                    <label for="password">New Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                    <button type="button" class="toggle-password1" onclick="toggleNewPassword()">
                        <img src="images/eye.png" alt="Show" id="toggleIconNew">
                    </button>
                </div>
                
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Update">
                </div>
            </form>

            <div class="field">
                <button class="btn" style="background-color: red;" onclick="showModal()">Delete Account</button>
            </div>
        </div>
        <?php } ?>
        
    </div>

    <!-- The Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p>Are you sure you want to delete your account? This action cannot be undone.</p>
            <form action="" method="post">
                <input type="submit" class="modal-button" name="delete" value="Delete Account">
                <button type="button"
                class="modal-button cancel" onclick="closeModal()">Cancel</button>
            </form>
        </div>
    </div>

    <script>
    function toggleOldPassword() {
        var oldPasswordField = document.getElementById('old_password');
        var toggleIcon = document.getElementById('toggleIconOld');
        if (oldPasswordField.type === 'password') {
            oldPasswordField.type = 'text';
            toggleIcon.src = 'images/hidden.png'; // Use your hide icon image
            toggleIcon.alt = 'Hide';
        } else {
            oldPasswordField.type = 'password';
            toggleIcon.src = 'images/eye.png'; // Use your show icon image
            toggleIcon.alt = 'Show';
        }
    }
    function toggleNewPassword() {
        var newPasswordField = document.getElementById('password');
        var toggleIcon = document.getElementById('toggleIconNew');
        if (newPasswordField.type === 'password') {
            newPasswordField.type = 'text';
            toggleIcon.src = 'images/hidden.png'; // Use your hide icon image
            toggleIcon.alt = 'Hide';
        } else {
            newPasswordField.type = 'password';
            toggleIcon.src = 'images/eye.png'; // Use your show icon image
            toggleIcon.alt = 'Show';
        }
    }

    function showModal() {
        var modal = document.getElementById('deleteModal');
        modal.style.display = 'block';
    }

    function closeModal() {
        var modal = document.getElementById('deleteModal');
        modal.style.display = 'none';
    }
    </script>


    

    <script>
        // Example JavaScript functionality
        document.addEventListener('DOMContentLoaded', () => {
            console.log('Footer loaded and ready');
            // Add any additional interactive JavaScript here
        });
    </script>
</body>
</html>