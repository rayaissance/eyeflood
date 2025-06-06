<?php 
    session_start();

    include("php/config.php");
    if(!isset($_SESSION['valid'])){
        header("Location: index.php");
    }
    include 'db_connect.php'; 
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>


@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
    *{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: 'Poppins',sans-serif;
    }
  
    body{
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column;
        background-color: #e6e6e6;
        background-image: url('images/bg.gif');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        min-height: 100vh; /* Ensures full height for viewport */
        height: 100%; /* Ensure the html element is 100% height */
        background-attachment: fixed; /* Keeps the background fixed during scroll */
    }
    .container{
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 90vh;
    }

    /* ALL BOX/container IN HOME.php */
    .box{
        background: #E5E7EB;
        display: flex;
        flex-direction: column;
        padding: 25px 25px;
        border-radius: 20px;
        box-shadow: 0 0 128px 0 rgba(0,0,0,0.1),
                    0 32px 64px -48px rgba(0,0,0,0.5);
        margin-left: 10px;
        margin-right: 10px;
    }

/* ALTERNATIVE ROUTE SECTION CSS */
    .box-alter{
        background: #E5E7EB;
        display: flex;
        flex-direction: column;
        padding: 25px 25px;
        border-radius: 20px;
        box-shadow: 0 0 128px 0 rgba(0,0,0,0.1),
        0 32px 64px -48px rgba(0,0,0,0.5);
        margin-left: 10px;
        margin-right: 10px;
    }

    .level-box {
        background: #FBBF24;
        padding: 15px;
        border-radius: 10px;
        color: #1E3A8A; /* Optional: Text color for better contrast */
        font-weight: bold;
    }
    .form-box{
        width: 450px;
        margin: 0px 10px;
    }
    .form-box header{
        font-size: 25px;
        font-weight: 600;
        padding-bottom: 10px;
        border-bottom: 1px solid #e6e6e6;
        margin-bottom: 10px;
    }
    .form-box form .field{
        display: flex;
        margin-bottom: 10px;
        flex-direction: column;
    }
    .form-box form .input input{
        height: 40px;
        width: 100%;
        font-size: 16px;
        padding: 0 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        outline: none;
    }
   /*?*/
    .btn1:hover, .btn:hover{
        opacity: 0.82;
    }
    .submit{
        width: 100%;
    }
    .links{
        margin-bottom: 15px;
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

   
    .message{
        text-align: center;
        background: #f9eded;
        padding: 15px 0px;
        border:1px solid #699053;
        border-radius: 5px;
        margin-bottom: 10px;
        color: red;
    }
            .map-container {
                width: 600px; /* Set your desired width */
                height: 400px; /* Set your desired height */
                position: relative;
            }
            .map-container h2 {
                margin: 0;
                padding: 0 1px;
                text-align: left;
                font-size: 1.5em; /* Adjust as needed */
            }
            .map-container iframe {
                width: 100%;
                height: 100%;
                border: 0;
            }
/* Common styling for all vehicles */
.vehicle {
    border: none;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow */    
    border-radius: 10px;
    padding: 5px;
    margin: 5px 0;
    display: inline-block;
    color: white; /* Default text color */
    text-align: center;
    font-weight: bold;
    transition: background-color 0.3s ease, color 0.3s ease;
}

/* Individual vehicle colors */
.vehicle.jeepney {
    background-color: #FBBF24; /* Dark Blue */
    color: #1F2937; /* Dark Gray for contrast */

}

.vehicle.tricycle {
    background-color: #60A5FA   ;
    color: #1F2937; /* Dark Gray for contrast */

}

.vehicle.motorcycle {
    background-color: #90EE90;
    color: #1F2937; /* Dark Gray for contrast */
}

.vehicle.car {
    background-color: #9BA19D; /* Dark Gray */
    color: #1F2937; /* Dark Gray for contrast */

}

.vehicle.bike {
    background-color: #D3B683; /* Light bROWN */
    color: #1F2937; /* Dark Gray for contrast */

}

/* Hover effect for all vehicles */
.vehicle:hover {
    background-color: white; /* Change background color on hover */
    color: black; /* Change text color on hover */
    cursor: pointer;
}


    /* new added code starts here*/


    .map-container {
        position: relative;
        width: 100%;
        padding-bottom: 45%; /* 16:9 aspect ratio  56.25 */
        height: 0;
        margin-bottom: 180px;
        
    }

    .map-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        margin-top: 150px;
    }

    /* Adjustments for .form-box, .main-box, and other containers */

    .form-box,
    .main-box {
        width: 100%;
        max-width: 450px; /* set a max-width to maintain layout on larger screens */
        margin: 0px 10px;
    }

    .vehicle {
        border: 2px solid black;
        border-radius: 10px;
        padding: 5px;
        margin top: 50px 0;
        display: inline-block;
    }
    .logo-img {
    width: 20px; /* Adjust as needed */
    height: 30px; /* Maintain aspect ratio */
    margin-right: 10px; /* Add some spacing between the logo and text */
}
@media only screen and (max-width:840px){
        .main-box .top{
            flex-direction: column;
            gap: 10px;
        }
        .top .box{
            margin: 10px 0;
        }
        .bottom{
            margin-top: 0;
        }
    }
    /* Media Queries */

        @media only screen and (max-width:840px){
            .main-box .top {
                flex-direction: column;
                gap: 10px;
            }
            .top .box {
                margin: 10px 0;
            }
            .bottom {
                margin-top: 0;
            }

            .map-container iframe {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    margin-top: 170px;
    }
            
        }

      /*  @media only screen and (min-width:600px){
            .nav {
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }
            .nav .logo, .nav .right-links {
                text-align: center;
            }
            .main-box {
                width: 90%;
            }

            
            .map-container iframe {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                margin-top: 150px;
            }
           
        }  */
        

        @media only screen and (max-width:562px){
            .main-box .top {
                flex-direction: column;
                gap: 10px;
            }
            .top .box {
                margin: 10px 0;
            }
            .bottom {
                margin-top: 0;
            }

            .map-container iframe {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    margin-top: 183px;
    }
            
        }
       
        @media only screen and (max-width:544px){
            .main-box .top {
                flex-direction: column;
                gap: 10px;
            }
            .top .box {
                margin: 10px 0;
            }
            .bottom {
                margin-top: 0;
            }

            .map-container iframe {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    margin-top: 189px;
    }
            
        }

        @media only screen and (max-width:539px){
            .main-box .top {
                flex-direction: column;
                gap: 10px;
            }
            .top .box {
                margin: 10px 0;
            }
            .bottom {
                margin-top: 0;
            }

            .map-container iframe {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 75%;
                    margin-top: 250px;
    }

                .map-container {
                    position: relative;
                    width: 100%;
                    padding-bottom: 70%; /* 16:9 aspect ratio  56.25 */
                    height: 0;
                    margin-bottom: 180px;
                    
                }
            
        }


        @media only screen and (max-width: 430px) {
    /* iphone 14 pro  */
            .main-box .top {
                flex-direction: column;
                gap: 10px;
            } 

        .box-alter{
         
           height: 80vh;  /*50% of the viewport height */
        }    
            
            .header {
    display: flex;                /* Flex layout */
    justify-content: flex-start;  /* Align items to the left */
    align-items: center;          /* Vertically center items */
    padding: 0 10px;              /* Adjust padding as needed */
    box-sizing: border-box;       /* Ensure padding doesn’t cause overflow */
    width: 100%;                  /* Full width for the header */
    max-width: 430px;             /* Match iPhone 14 Pro width */
}
                     
            .map-container iframe {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 125%;
                    margin-top: 270px;
                    border-radius: 10px;
            }
  
            .logo {
        display: flex;
        align-items: center;          /* Vertically center the logo and text */
        justify-content: flex-start;  /* Aligns content to the left */
    }

    .logo-img {
        width: 60px;                  /* Adjust logo width */
        height: 60px;                 /* Adjust logo height */
        margin-right: 10px;           /* Spacing between logo and text */
    }

    .logo p {
        font-size: 20px;              /* Adjust text size */
        margin: 0;                    /* Remove default paragraph margin */
        white-space: nowrap;          /* Prevent text from wrapping */
        overflow: hidden;             /* Hide overflow if needed */
        text-overflow: ellipsis;      /* Ellipsis if overflow occurs */
    }

    .header {
        padding-left: 10px;
        padding-right: 10px;
    }

    .right-links {
    display: flex;
    align-items: center;          /* Vertically center items */
    justify-content: flex-start;  /* Align links to the left */
    margin-left: 10px;            /* Add some space between logo and button */
}
    
    .dropdown-content {
        min-width: 10px;
    }


    .dropbtn {
    width: auto;                 /* Let the width adjust based on content */
    height: 49px;                /* Keep the button height */
    text-align: center;          /* Center the text */
    padding: 0 15px;             /* Add padding for spacing */
    font-size: 18px;             /* Set font size */
    white-space: nowrap;         /* Prevent text from wrapping */
    text-overflow: ellipsis;     /* Handle overflow with ellipsis */
    overflow: hidden;            /* Ensure no overflow */
    max-width: 150px;            /* Set a max-width for control */
}

        }

        .footer {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 10px 20px; /* Reduced padding for a thinner look */
            text-align: center;
        }
        .footer a {
            color: #1abc9c;
            text-decoration: none;
            font-size: 8px;
        }
        .footer a:hover {
            text-decoration: underline;
            font-size: 8px;
        }
        .footer .contact-info {
            margin-top: 10px;
            font-size: 8px;
        }
        .footer .social-links a {
            margin: 0 10px;
        }



/* Dropdown button */
.dropdown {
    display: none; /* Hidden by default */
    flex-direction: column;
    background-color: #89CFF0;
    position: absolute;
    right: 10px;
    top: 60px;
    width: 180px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    border-radius: 10px;
    overflow: hidden;
    z-index: 1000; /* Make sure dropdown stays above other content */
}


/* Dropdown content (hidden by default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    border-radius: 5px;
    margin-top: 5px;
}

  /* Links inside the dropdown */
  .dropdown a {
        color: #333; /* Text color */
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        border-radius: 5px;
    }

    /* Change color of dropdown links on hover */
    .dropdown a:hover {
        background-color: #f1f1f1;
    }

/* header css*/
.header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white; /* Ensure the background is white */
            padding: 10px; /* Add some padding for better spacing */
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo-img {
            width: 60px; /* Adjust as needed */
            height: 60px; /* Maintain aspect ratio */
            margin-right: 10px; /* Add some spacing between the logo and text */
        }


      
/*PROFILE AND DROPDOWN CSS*/ 
        .profile-icon-circle {
    width: 40px;  /* Set the width and height for the circle */
    height: 40px;
    border-radius: 50%;  /* Makes the container a circle */
    background-color: #f0f0f0;  /* Light background color for the circle */
    display: flex;
    align-items: center;
    justify-content: center;
    }

    .user-icon {
    font-size: 20px;  /* Adjust icon size */
    color: #1696d5;  /* Icon color */
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .nav-links {
            display: none;
            flex-direction: column;
            width: 100%;
        }

        .nav-links.active {
            display: block;
            position: absolute;
            top: 60px;
            left: 0;
            width: 100%;
            background-color: #fff;
            z-index: 100;
        }

        .nav-links a {
            padding: 10px 20px;
            display: block;
            text-decoration: none;
            color: #333;
        }
    }

</style>
    <title>Dashboard</title>
</head>
<body>
    <!-- Navigation Links -->
<div class="header">
<div class="nav">
        <div class="logo">
            <img class="logo-img" src="wave.png" alt="Logo">
            <p>Eye Flood</p>
        </div>
</div>

    <!-- Profile Menu Button -->
    <div class="profile-icon-circle">
    <i class="fas fa-user user-icon"></i>
    <div class="dropdown">
        <?php 
            $id = $_SESSION['id'];
            $query = mysqli_query($con, "SELECT * FROM users WHERE Id=$id");
            while($result = mysqli_fetch_assoc($query)) {
                $res_id = $result['Id'];
            }
            echo "<a href='edit.php?Id=$res_id'>Change Profile</a>";
        ?>
        <a href="safety/index.html">Flood Safety Tips</a>
        <a href="php/logout.php">Log Out</a>
    </div>
</div>
</div>

<script>
    // Toggle dropdown menu visibility on hamburger click
    document.querySelector('.user-icon').addEventListener('click', function(event) {
        const dropdown = document.querySelector('.dropdown');
        dropdown.style.display = dropdown.style.display === "flex" ? "none" : "flex";
        event.stopPropagation();
    });

    // Close dropdown if clicked outside
    window.addEventListener('click', function(event) {
        const dropdown = document.querySelector('.dropdown');
        if (!event.target.closest('.user-icon') && !event.target.closest('.dropdown')) {
            dropdown.style.display = "none";
        }
    });
</script>
<!--End Of Profile Menu-->

<br>
    <!--flood level-->
    <main>
        <div class="main-box top">
            <div class="on-top">
                <div class="box level-box">
                    <p>Level: <span id="sensor-data">Waiting for data...</span></p>
                </div>  
            </div>
        </div>
        <br>

        <script>
    document.addEventListener('DOMContentLoaded', function() {
        const sensorDataElement = document.getElementById('sensor-data');
        const apiUrl = 'http://192.168.184.241/data'; // Replace with your ESP32 IP address

        async function fetchSensorData() {
            try {
                const response = await fetch(apiUrl);
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                const data = await response.text();
                sensorDataElement.textContent = data;
            } catch (error) {
                console.error('Error fetching sensor data:', error);
                sensorDataElement.textContent = 'Error fetching data';
            }
        }

        // Fetch data immediately, then set interval to fetch periodically
        fetchSensorData();
        setInterval(fetchSensorData, 5000); // Fetch every 5 seconds
    });

</script>

    </main>
       <!-- ANNOUNCEMENT AREA-->
<?php
// Check if the session is already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'db_connect.php'; // Ensure database connection is established

// Fetch the latest published announcement
$query = "SELECT * FROM announcements WHERE status='published' ORDER BY timestamp DESC LIMIT 1";
$result = mysqli_query($conn, $query);

$announcementData = null;

if ($row = mysqli_fetch_assoc($result)) {
    $latestAnnouncementTime = strtotime($row['timestamp']); // Get the timestamp of the latest announcement

    // Check if the announcement is new or session has expired
    if (!isset($_SESSION['last_announcement_time']) || $_SESSION['last_announcement_time'] != $latestAnnouncementTime) {
        // New announcement or first time showing it
        $_SESSION['last_announcement_time'] = $latestAnnouncementTime;
        $_SESSION['announcement_display_time'] = time();
        $showAnnouncement = true;
        // Prepare announcement data for the notification
        $announcementData = [
            'title' => $row['title'],
            'message' => $row['message'],
            'timestamp' => $row['timestamp']
        ];
    } else {
        // Check if 60 seconds (for testing) or 24 hours (86400 seconds) has passed
        if (time() - $_SESSION['announcement_display_time'] > 86400) { // Change 60 to 86400 for production
            $showAnnouncement = false; // Hide the announcement
        } else {
            $showAnnouncement = true; // Keep showing the announcement
        }
    }

    if ($showAnnouncement) {
        echo "<div class='announcement' id='announcement'>
                <h2>" . $row['title'] . "</h2>
                <p>" . $row['message'] . "</p>
                <small>Published on " . $row['timestamp'] . "</small>
              </div>";
    }
} else {
    echo "<p>No announcements available at this time.</p>";
}
?>

<div class="user-announcement"></div>

<style>
/* User Announcement Section */
.announcement {
    max-width: 800px;
    margin: 15px auto; /* Centers the box horizontally and adds top/bottom margin */
    padding: 25px 25px; /* Adds padding on the left and right */
    background-color: #d1eaf0;
    border-radius: 6px;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.5);
}

.announcement h2 {
    margin: 0;
    font-size: 24px;
}

.announcement p {
    font-size: 16px;
    color: #856404;
    margin-top: 10px;
}

.announcement small {
    font-size: 12px;
}

/* Media query for smaller screens */
@media (max-width: 600px) {
    .announcement {
        padding: 15px 15px; /* Reduces padding on smaller screens */
        margin: 15px 10px;  /* Adds a 10px margin on the left and right to prevent it from touching the edges */
    }

    .announcement h2 {
        font-size: 20px;
    }

    .announcement p {
        font-size: 14px;
    }

    .announcement small {
        font-size: 10px;
    }
}

</style>

<script>
// Check if the browser supports notifications
if ("Notification" in window) {
    // Request permission to show notifications if not already granted
    if (Notification.permission === "default") {
        Notification.requestPermission().then(function(permission) {
            if (permission === "granted") {
                sendAnnouncementNotification();
            }
        });
    } else if (Notification.permission === "granted") {
        sendAnnouncementNotification();
    }
}

// Function to send the notification
function sendAnnouncementNotification() {
    var announcementData = <?php echo json_encode($announcementData); ?>;

    if (announcementData) {
        var options = {
            body: announcementData.message,
            icon: 'notif.png', // Optionally provide a custom icon for the notification
            tag: 'new-announcement' // Prevent multiple notifications stacking up
        };

        var notification = new Notification(announcementData.title, options);

        // You can add an onclick behavior (e.g., focus on the window)
        notification.onclick = function() {
            window.focus();
            this.close();
        };
    }
}

// Hide the announcement after 1 minute (for testing)
setTimeout(function() {
    var announcement = document.getElementById('announcement');
    if (announcement) {
        announcement.style.display = 'none';
    }
}, 60000); // Change this to 86400000 (24 hours) when in production
</script>
   <!-- END OF ANNOUNCEMENT AREA -->
                <br>
                 
            <div class="box-alter">
            <div class="map-container">
            <a href="alternative.php" style="text-decoration: none;">
            <h2 style="color: #FF4d00;">ALTERNATIVE ROUTE</h2>
            </a>      
        <p>&#9888; Passable Vehicles:<i> Only the vehicles indicated below are passable on the road. <b>Trucks or Large Vehicles are not allowed.</b></i></p>
        <p class="vehicle jeepney"><i class="fas fa-bus"></i> Jeepney</p>
        <p class="vehicle tricycle"><i class="fas fa-motorcycle"></i> Tricycle</p>
        <p class="vehicle motorcycle"><i class="fas fa-motorcycle"></i> Motorcycle</p>
        <p class="vehicle car"><i class="fas fa-car"></i> Car</p>
        <p class="vehicle bike"><i class="fas fa-bicycle"></i> Bike</p>
        
        <p><a href="alternative.php" style="text-decoration: underline; color: inherit;">View Full Location Here</a></p>
        <iframe src="https://www.google.com/maps/d/embed?mid=1pR75lBNIyvCXAGMfK815g8xhQ5TF_dQ&hl=en&ehbc=2E312F"></iframe>
    </div>
    </div>

    <br>
    <br>
    <div class="box">
    <p style="font-size: 18px;"> <img src="location.png" alt="location Logo" style="width: 20px; height: 20px; vertical-align: middle;"> <b>FIND YOUR NEAREST EVACUATION CENTER</b></p>
    <input type="text" id="userLocation" placeholder="Your Location" readonly>
    <select id="destination">
    <option value="Fernando St. Marulas, Valenzuela City">Fernando St. Marulas</option>
    <option value="10 Ilang ilang St. Marulas, Valenzuela City">10 Ilang ilang St. Marulas</option>
    <option value="Rd.5 Cor.Rd.3, San Miguel Heights Marulas, Valenzuela City">Rd.5 Cor.Rd.3</option>
    <option value="Serrano Avenue Marulas, Valenzuela City">Serrano Avenue Marulas</option>
    <option value="Pio Valenzuela St. Marulas, Valenzuela City">Pio Valenzuela St. Marulas</option>
    <option value="Papu Simon St. Dona Ata Subdivision">Papu Simon St. Dona Ata Subdivision</option>
    </select>
    <a href="evacuate.php" style="display: inline-block; margin-top: 10px; padding: 5px 15px; background-color: #10B981; color: white; text-align: center; text-decoration: none; border-radius: 5px;">Search</a>


                <div id="map"></div>
                <br>
        <p><b>Marulas Official Evacuation Centers </b></p>
                    Valenzuela National High School<br>
                    <p style="font-size: 10px;">A. Fernando St. Marulas, Valenzuela City</p>
                    <br>
                    Constantino Elementary School<br>
                    <p style="font-size: 10px;">10 Ilang ilang St. Marulas, Valenzuela City</p>
                    <br>
                    San Miguel Heights Elementary School<br>
                    <p style="font-size: 10px;">Rd.5 Cor.Rd.3, San Miguel Heights Marulas, Valenzuela City</p>
                    <br>
                    Serrano Elementary School<br>
                    <p style="font-size: 10px;">Serrano Avenue Marulas, Valenzuela City</p>
                    <br>
                    Marulas Elementary School<br>
                    <p style="font-size: 10px;">Pio Valenzuela St. Marulas, Valenzuela City</p>
                    <br>
                    Barangay Court
                    <p style="font-size: 10px;">Papu Simon St. Dona Ata Subdivision</p>
                    <br>
                    </p>

    

        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <script>
            var map = L.map('map').setView([14.6937, 121.0863], 13);
            var marker;

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);

            function findRoute(destination) {
                if (marker) {
                    map.removeLayer(marker);
                }

                // Here you can use any geocoding service to get the coordinates of the destination
                // For simplicity, I'm just using a hardcoded set of coordinates
                var destinationCoordinates = [14.6794, 120.9810]; // Example coordinates

                marker = L.marker(destinationCoordinates).addTo(map);
                map.setView(destinationCoordinates, 13);
            }

            document.getElementById('destination').addEventListener('change', function() {
                var selectedDestination = this.value;
                findRoute(selectedDestination);
            });

            // Try to get user's location
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var userCoords = [position.coords.latitude, position.coords.longitude];
                    map.setView(userCoords, 13);
                    document.getElementById('userLocation').value = 'Latitude: ' + position.coords.latitude + ', Longitude: ' + position.coords.longitude;

                    // You can use a geocoding service to reverse geocode the user's location
                    // For simplicity, I'm just setting a marker at the user's coordinates
                    L.marker(userCoords).addTo(map);
                }, function() {
                    console.log('Location access denied or unavailable.');
                });
            } else {
                console.log('Geolocation is not supported by this browser.');
            }
        </script>

                </div>
                </div>
                <br>
                <div class="box">
                <p>
                <img src="emergency.png" alt="Caution Logo" style="width: 30px; height: 30px; vertical-align: middle;">
                <b style="color: #e04f5f; font-size: 24px;">    EMERGENCY CONTACTS</b>
                <br>
                <b>Social Welfare & Development Office (CSWD)</b>
                <br>8352-1000 locals 1103 / 1105 / 1129
                <br>8352-2000
                    
                <b><br>Rivers & Waterways Management Office (RWMO)</b>
                <br>8352-2000 local 2103
                <br>3432-26-78
                    <br>
                <b>Tubig Patrol</b>
                <br>8352-2000 local 2106
                <br>3432-04-74
                    <br>
                <b>Valenzuela Rescue Team</b>
                <br>8292-1405
                <br>8352-5000 local 5012
                <br>0919-009 4045
                <br>0917-881 1639
            </div>
            </div>
            </div>
        </div>

     
    <script>
        // Example JavaScript functionality
        document.addEventListener('DOMContentLoaded', () => {
            console.log('Footer loaded and ready');
            // Add any additional interactive JavaScript here
        });
    </script>
        

    </main>
       <!-- Footer Section -->
        <br>
    <footer class="footer">
        <p>© 2024 Eye Flood | Your Reliable Source for Flood Monitoring</p>
        <div class="contact-info">
            <p>Email: <a href="barangaymalanday@gmail.com">barangaymalanday@gmail.com</a></p>
            <p>Phone: +63 949 7123 110</p>
            <p>Address: 1444, 380 Marcelo H. Del Pilar St, Valenzuela, 1444 Metro Manila</p>
        </div>
        <div class="footer-links">
            <a href="#privacy-policy">Privacy Policy</a> | 
            <a href="#terms-of-service">Terms of Service</a> | 
            <a href="#accessibility">Accessibility</a>
            <p class="footer-note" style="font-size: 12px; font-style: italic; margin-top: 10px;">
            Stay informed, stay safe.
            </p>

        </div>
    </footer>

    </body>
    </html>