<?php
// Include the database connection file
include 'db_connect.php';

// Set PHP timezone to Philippine time (UTC +8)
date_default_timezone_set('Asia/Manila');

if (isset($_POST['announce'])) {
    $title = $_POST['title'];
    $message = nl2br($_POST['message']); // This will add <br> tags for each new line.

    // Set MySQL timezone to UTC +8 (Philippine Time)
    mysqli_query($conn, "SET time_zone = '+08:00'");

    // Insert the new announcement into the database without timestamp
    $query = "INSERT INTO announcements (title, message, status) VALUES ('$title', '$message', 'published')";
    mysqli_query($conn, $query);

    // Redirect to avoid form resubmission on page reload
    header("Location: Admin_announcement.php?success=true");
    exit(); // Always call exit after a header redirect to stop further script execution
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Admin Announcement</title>
    <style>
         @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
        *{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: 'Poppins',sans-serif;
    }
    
    html, body {
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column;
        background-color: #e6e6e6;
        background-image: url('images/bgadmin.gif');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        min-height: 100vh; /* Ensures full height for viewport */
        height: 100%; /* Ensure the html element is 100% height */
        background-attachment: fixed; /* Keeps the background fixed during scroll */
    }

    .container-fluid {
        flex: 1; /* This allows the content area to expand and push the footer down */
    }

    .main-header {
        background-color: #a81c22;
        color: white;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 20px;
    }

    .logo-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .logo {
        max-height: 50px;
        margin-bottom: 10px;
    }
    .main-nav ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
    }

    .main-nav ul li {
        margin-right: 20px;
    }

    .main-nav ul li a {
        color: white;
        text-decoration: none;
        font-weight: bold;
        transition: color 0.3s;
    }

    .main-nav ul li a:hover {
        color: #f0c14b;
    }

    .table th, .table td {
        vertical-align: middle;
    }

    .table thead th {
        background-color: #4CAF50;
        color: #fff;
    }

    .table tbody tr {
        background-color: #c9fcc0;
    }

    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin: 20px;
        border-radius: 10px;
        background-color: #ffff;
    }

    .card-body {
        padding: 15px;
    }

    .flood-card {
        margin-top: 10px;
    }

    .card.mb-3.flood-card {
        background-color: #f8d7da;
    }

    .card.mb-3.flood-card .card-body {
        background-color: #FFD700;
        color: #000;
        border-radius: 10px;
    }

    .footer {
        background-color: #2c3e50;
        color: #ecf0f1;
        padding: 10px;
        text-align: center;
        margin-top: auto; /* Pushes the footer to the bottom */
    }

    .footer a {
        color: #1abc9c;
        text-decoration: none;
        font-size: 8px;
    }
       /* Admin Announcement Form */
       .AN{  /* this is the text make an announcement */
        text-align: center;
        margin-bottom: 35px;
      }
      
        form {
            max-width: 800px;
            margin: 20px auto;
            padding: 80px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
          
        }

        form input[type="text"], form textarea {
            width: 100%;
            padding: 20px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        form button {
            padding: 15px 22px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        form button:hover {
            background-color: #218838;
        }

        /* Media query for smaller screens */
        @media (max-width: 600px) {
            form {
                padding: 10px;
            }

            form input[type="text"], form textarea {
                font-size: 14px;
            }

            form button {
                font-size: 14px;
                padding: 8px 16px;
            }
        }

        /* Announcement History Styling */
        .announcement-history {
            max-width: 800px;
            margin: 20px auto;
            padding: 15px;
            background-color: #f1f1f1;
            border-radius: 8px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            max-height: 500px; /* Set a maximum height */
            overflow-y: auto; /* Enable vertical scrolling */
        }

        .announcement-history h3 {
            font-size: 22px;
            margin-bottom: 10px;
        }

        .announcement-history div {
            background-color: #a81c22;
            margin: 10px 0;
            padding: 15px;
            border-left: 5px solid #FFD700;
            border-radius: 4px;
        }

        .announcement-history div h4 {
            margin: 0;
            font-size: 18px;
            color: #fff;
        }

        .announcement-history div p {
            font-size: 14px;
            margin-top: 5px;
        }

        .announcement-history div small {
            font-size: 12px;
            color: #fbfcfc;
        }
    </style>
    <header class="main-header">
        <div class="logo-container">
            <img src="1.png" alt="Logo" style="max-width: 300px; max-height: 300px;">
        </div>
        <nav class="main-nav">
            <ul>
                <li><a href="admin-page.php">HOME</a></li>
                <li><a href="admin-user.php">USER</a></li>
                <li><a href="admin_announcement.php">ANNOUNCEMENT</a></li>
                <li><a href="admin-evacuate.php">EVACUATION</a></li>
                <li><a href="index.php">LOG OUT</a></li>
            </ul>
        </nav>
    </header>
<br>
    <!--dont remove it will ruin the lower content -->
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
             
                    </div>
                </div>
</head>
<body>
    <br>
    <div class="admin-announcement">
        <form action="Admin_announcement.php" method="POST">
       <div class="AN"> <h2 style="color: #e04f5f;">CREATE ANNOUNCEMENT</h2></div>
            <input type="text" name="title" placeholder="Alert Title" required>
            <p style="color: gray;"><i>You can stretch the box to see the full view</i></p>
            <textarea name="message" placeholder="Announcement Details" required></textarea>
            <button type="submit" name="announce">Publish Announcement</button>
        </form>
        <script>
    const messageBox = document.querySelector('textarea[name="message"]');
    messageBox.addEventListener('input', function(event) {
        this.value = this.value.replace(/\n/g, '\n'); // For real-time display in other parts of your app
    });
</script>

    </div>
  

    <div class="announcement-history">
    <h2 style="color: #e04f5f;">&nbsp;&nbsp;&nbsp;ANNOUNCEMENT HISTORY</h2>
    <?php
    // Fetch published announcements only
    $query = "SELECT * FROM announcements WHERE status = 'published' ORDER BY timestamp DESC";
    $result = mysqli_query($conn, $query);

    // Check if any announcements exist
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Use regex to remove all <br> tags for the history display
            $message_no_br = preg_replace('/<br\s*\/?>/i', '', $row['message']);
            
            echo "<div>
                    <h4>" . htmlspecialchars($row['title']) . "</h4>
                    <p style='color: #f1f5f7;'>" . htmlspecialchars($message_no_br) . "</p>
                    <small>Published on " . $row['timestamp'] . "</small>
                  </div>";
        }
    } else {
        echo "<p>No announcements found.</p>";
    }
    ?>
</div>

    
    <!-- Footer Section -->
    <footer class="footer">
        <p>© 2024 Eye Flood | Your Reliable Source for Flood Monitoring</p>
        <p class="footer-note" style="font-size: 12px; font-style: italic; margin-top: 10px;">
            Stay informed, stay safe.
        </p>
    </footer>
</body>
</html>
