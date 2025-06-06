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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alternative Route</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
    *{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: 'Poppins',sans-serif;
    }
body {
    margin: 0;
    padding: 0;
    background-color: #1E3A8A;
}

/* Header Styles */
.nav {

    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
    height: 60px;
 
}

.logo {
    display: flex;
    align-items: center;
    font-size: 25px;
    font-weight: 900;
    color: #1696d5;
}

.logo img {
    width: 60px;
    height: 60px;
    margin-right: 10px;
    
}

.right-links {
    margin-left: 0.5px;
    padding: 0px 10px;
  
    color: white;
    border-radius: 10px;
    text-decoration: none;
    font-size: 14px;
}


.container {
    display: flex;
    justify-content: space-between;
    padding: 20px;
}

.left-panel {
    width: 33%;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    text-align: left; /* Align all content to the left */
}

.right-panel {
    width: 65%;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}
/*ADDED PANEL */
.middle-panel {
    width: 100%;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    text-align: left; /* Align all content to the left */

}

h3 {
    color: #2b7d5b;
}

.vehicle-list, .contact-list {
    list-style-type: none;
    padding: 0;
    margin: 10px 0;
}

.vehicle-list li, .contact-list li {
    margin-bottom: 10px;
    font-size: 16px;
}

.map-container {
    margin-top: 20px;
}

iframe {
    width: 100%;
    height: 400px;
    border: none;
    border-radius: 8px;
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

.highlight {
            background-color: #c5e1a5; /* Light green background for highlight */
            font-weight: bold;
            transition: background-color 0.3s ease;
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
        
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: white; /* Ensure the background is white */
    padding: 10px; /* Add some padding for better spacing */
}
.logo {
    /* Additional styles for the logo container, if needed */
}
.account-button {
    margin-left: auto; /* This pushes the button to the far right */
    
}

 /*Customizable Route */
 .wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px;
        }

        .heading {
            margin: 10px 0;
        }

        #map {
            width: 100%;
            height: 70vh;
            margin: 10px 0;
        }

        .input-controls {
        width: 90%;
        display: flex;
        flex-direction: row;
        gap: 10px;
        margin: 10px 0;
    }

    .input-field {
        flex: 1;
        padding: 10px;
        font-size: 1em;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .action-button {
        padding: 10px;
        background-color: #007BFF;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

     /* Base Styles for Buttons */
     .route-selection {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: center;
    }

    /* First Route Button Style */
    #blue-route-btn {
    background-color: transparent; /* Clear background */
    color: #007BFF; /* Border color and text color */
    border: 3px solid #007BFF;
    border-radius: 20px; /* More rounded corners */
    }

    /* Second Route Button Style */
    #red-route-btn {
    background-color: transparent; /* Clear background */
    color: #228B22; /* Border color and text color */
    border: 3px solid #228B22;
    border-radius: 20px; /* More rounded corners */
    }

    /* Hover Effect */
    .route-button {
    border-radius: 20px; /* More rounded corners */
    font-size: 0.8em; /* Smaller font */
    cursor: pointer;
    font-size: 1em;
    transition: all 0.3s ease; /* Smooth transition for hover effect */
    padding: 5px 10px; /* Smaller padding */

    }

    /* Hover Effect */
    .route-button:hover {
    background-color: #0F52BA; /* Fill background on hover */
    color: white;
    border-color: #0F52BA;
    }
    .route-button {
        padding: 10px;
        background-color: #007BFF;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    #red-route-btn:hover {
    background-color: #228B22; /* Fill background on hover */
    color: white;
    border-color: #228B22;
    }
    #blue-route-btn:hover {
    background-color: #0F52BA; /* Fill background on hover */
    color: white;
    border-color: #0F52BA;
    }

    /* Hover effects */
    .action-button:hover, .route-button:hover {
        background-color: #0056b3;
    }

        .directions-container {
            width: 90%;
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f9f9f9;
            max-height: 200px;
            overflow-y: auto;
            display: none; /* Hidden by default */
        }

        .route-selection {
            margin: 10px 0;
        }

        .route-selection .route-button {
            margin-right: 10px;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .route-selection .route-button:hover {
            background-color: #0056b3;
        }

        .directions-container div {
            margin: 10px 0;
        }

        /* Message box styles */
        .message-box {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            padding: 20px;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            text-align: center;
            display: none;
            z-index: 1000;
        }

        .message-box h2 {
            margin: 0 0 10px;
        }

        .message-box button {
            margin-top: 10px;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .message-box button:hover {
            background-color: #0056b3;
        }

        /* Overlay to make the background darker */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
        }

        .info-container {
            background-color: #e6f7ff; /* Light blue background for notification */
            border-left: 5px solid #007bff; /* Blue left border */
            padding: 10px 20px;
            border-radius: 5px;
            margin: 20px 0;
            display: flex;
            align-items: center;
        }

        .info-container .icon {
            margin-right: 10px;
        }

        .info-container .icon::before {
            content: 'ℹ️'; /* Information symbol */
            font-size: 24px;
        }

        .info-container .text {
            font-size: 14px;
            color: #333;
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

 /*END OF PROFILE AND DROPDOWN CSS*/ 

  /* Responsive Design */
  @media (max-width: 768px) {
    .input-controls {
        flex-direction: column;
        align-items: stretch;
    }

    .input-field, .action-button {
        width: 100%;
        margin: 5px 0;
    }

    .route-selection {
        flex-direction: row;
        justify-content: space-between; /* Align buttons in one line */
        gap: 0; /* Remove gap between buttons */
    }

    .route-button {
        flex: 1;
    }
}
    /*End of Customizable Route */

/* Responsive adjustments */
@media only screen and (max-width: 600px) {
    .dropdown-content {
        min-width: 100px;
    }

    .dropbtn {
        width: 100%;
        text-align: center;
    }
}
    
/* New styles for smaller screens */
@media (max-width: 768px) {
    .container {
        flex-direction: column;
        align-items: center; /* Center the contents horizontally */
        text-align: center;  /* Center the text inside the container */
        
    }

    .nav {
        flex-direction: row;  /* Keep the row direction */
        padding: 0 10px;
    }


    .left-panel,
    
    
    .right-panel {
        width: 100%; /* Make the panels take full width */
    }

    .left-panel {
        order: 2; /* Ensure it moves below the other content */
        margin-top: 20px; /* Adjust this value to push the panel down */
    }

    .right-panel {
        order: 1; /* Ensure it stays above the left panel */
    }
    .logo {
        font-size: 20px;  /* Slightly reduce the logo size */
    }

    .account-button {
        padding: 8px 12px; /* Adjust button padding for smaller screens */
    }
    
    .dropdown-content {
        min-width: 100px;
    }

    .dropbtn {
        width: 100%;
        text-align: center;
    }

    @media only screen and (max-width: 430px) {

}
.dropdown-content {
        min-width:100px;
        position: absolute;
        transform: translateX(18%); /* Moves it slightly right */
       
    }

    .dropbtn {
        width: 74%;
        text-align: center;
     
    
     }
}
   


</style>
  </head>
<body>

 
 <!-- Navigation Links -->
 <div class="header">
    <div class="nav">
            <div class="logo">
                <img class="logo-img" src="wave.png" alt="Logo">
                <p><a href="home.php" style="color: #1696d5; text-decoration: none;">Eye Flood</a></p>
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
    
    
        <script>
            function toggleMenu() {
                const navLinks = document.querySelector('.nav-links');
                navLinks.classList.toggle('active');
            }
        </script>
            
    <div class="container">
        <div class="left-panel">
          <h3 style="color: #2b7d5b; text-align: center;">PASSABLE VEHICLES</h3>
            <p><i> Only the vehicles indicated below are passable on the road. <b>Trucks or Large Vehicles are not allowed.</b></i></p>
            <p class="vehicle jeepney" onclick="highlight('jeepneyDetail')">
            <i class="fas fa-bus"></i> Jeepney
            </p>
            <p class="vehicle tricycle" onclick="highlight('tricycleDetail')">
                <i class="fas fa-motorcycle"></i> Tricycle
            </p>
            <p class="vehicle motorcycle" onclick="highlight('motorcycleDetail')">
                <i class="fas fa-motorcycle"></i> Motorcycle
            </p>
            <p class="vehicle car" onclick="highlight('carDetail')">
                <i class="fas fa-car"></i> Car
            </p>
            <p class="vehicle bike" onclick="highlight('bikeDetail')">
                <i class="fas fa-bicycle"></i> Bike
            </p>

        <!--HIGHLIGHTS THE DETAILS-->
        <script>
        function highlight(id) {
        // Clear existing highlights
        const details = document.querySelectorAll('.left-panel p[id]');
        details.forEach(detail => detail.classList.remove('highlight'));

        // Highlight the selected vehicle detail
        document.getElementById(id).classList.add('highlight');
        }
        </script>
        
            <br>
            <p id="jeepneyDetail"><b>Jeepney:</b> <i>Avoid passing if the flood rises to 1.5 feet (0.45 meters)</i></p>
            <p id="tricycleDetail"><b>Tricycle:</b> <i>Avoid passing if the flood rises to 1 foot (0.3 meters)</i></p>
            <p id="motorcycleDetail"><b>Motorcycle:</b> <i>Avoid passing if the flood rises to 0.5 feet (0.15 meters)</i></p>
            <p id="carDetail"><b>Car:</b> <i>Avoid passing if the flood rises to 1.5 feet (0.45 meters)</i></p>
            <p id="bikeDetail"><b>Bicycle:</b> <i>Avoid passing if the flood rises to 1 foot (0.3 meters)</i></p>

<br>
          <p><img src="telephone.png" alt="Caution Logo" style="width: 33px; height: 25px; vertical-align: middle;">
            <b style="text-align: center; color: #e04f5f; font-size: 24px;">‎EMERGENCY CONTACTS</b>
          </p>
            <p><i>Need Emergency? Call these.</i></p>
            <ul class="contact-list">
                <li><strong>Social Welfare & Development Office (CSWD)</strong><br>8352-1000 locals 1103 / 1105 / 1129<br>8352-2000</li>
                <li><strong>Rivers & Waterways Management Office (RWMO)</strong><br>8352-2000 local 2103<br>3432-26-78</li>
                <li><strong>Tubig Patrol</strong><br>8352-2000 local 2106<br>3432-04-74</li>
                <li><strong>Valenzuela Rescue Team</strong><br>8292-1405<br>8352-5000 local 5012<br>0919-009 4045<br>0917-881 1639</li>
            </ul>
        </div>
        <div class="right-panel">
        <h3 style="color: #191970; font-size: 24px;">ALTERNATIVE ROUTE</h3>
        <div class="info-container">
                <div class="icon"></div>
                <div class="text">
                This route provides an alternative path to avoid flood-prone area. 
                It is regularly monitored for traffic updates and safety status.
                </div>
            </div>
            <div class="map-container">
                <iframe 
        src="https://www.google.com/maps/d/embed?mid=1pR75lBNIyvCXAGMfK815g8xhQ5TF_dQ&hl=en&ehbc=2E312F" width="100%" height="450" 
        style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        <br><br>
        <p style="font-size: 20px;"><b>From Malabon | Monumento</b></p>
        <p style="color:gray;"><i>If you are coming from Malabon or Monumento, you can enter through 11 A. Fernando St. To preview the entire location, click the map below.</i></p>
        <iframe src="https://www.google.com/maps/embed?pb=!4v1715843036857!6m8!1m7!1sc1oe7pAoRHxz4rtDxRp88A!2m2!1d14.67142974697613!2d120.9821712016173!3f99.48362084890985!4f-15.216211068653124!5f0.7820865974627469" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <br><br>
        <p style="font-size: 20px;"><b>From Malinta | Karuhatan</b></p>
        <p style="color:gray;"><i>If you are coming from Malinta or Karuhatan, you can enter through 2 Tamaraw Hill Road. To preview the entire location, click the map below.</i></p>
        <iframe src="https://www.google.com/maps/embed?pb=!4v1715843461762!6m8!1m7!1sH9ff6G6wByH1Of2rcW1Vcw!2m2!1d14.67856010132099!2d120.9800160364368!3f80.86086474054682!4f-12.270503186298868!5f0.7820865974627469" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
    
<!--Customizable Route-->
<div class="container">
    <div class="middle-panel">
        <div class="wrapper">
            <h1 style="color: #191970; text-align: center;">ALTERNATIVE ROUTE FINDER</h1>
            <div class="info-container">
                <div class="icon"></div>
                <div class="text">
                    Enter your Start and End Locations, then click 'Find Route.'
                    Choose either First Route or Second Route for an alternative path,
                    and step-by-step directions will display below the map to help you decide.
                </div>
            </div>

            <style>
    /* General styling for the dropdown */
    #vehicle-type {
        padding: 6px;
        font-size: 14px;
        border-radius: 4px;
        width: 100%;
        max-width: 250px;
        margin-top: 10px;
    }

    /* Style options inside the dropdown */
    #vehicle-type option {
        font-size: 14px; /* Smaller font for options */
        padding: 4px 8px; /* Compact padding for options */
    }

    /* Styling specifically for mobile */
    @media (max-width: 600px) {
        #vehicle-type {
            font-size: 14px; /* Adjust font size for mobile */
            padding: 8px;
            max-width: none;
            width: calc(100% - 20px);
            margin: 0 auto;
        }
        #vehicle-type option {
            font-size: 14px; /* Consistent font size for mobile options */
            padding: 6px 10px;
        }
    }

    #traffic-legend {
    position: absolute;
    bottom: 10px; /* or top: 10px; for top position */
    right: 10px;  /* or left: 10px; for left position */
    background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent background */
    padding: 10px;
    border-radius: 5px;
    font-size: 14px;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
    z-index: 5; /* Ensure it appears above the map */
}

#traffic-legend ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

#traffic-legend li {
    display: flex;
    align-items: center;
    margin-bottom: 5px;
}

#traffic-legend li span {
    display: inline-block;
    width: 12px;
    height: 12px;
    margin-right: 8px;
}

</style>


<!-- Vehicle Type Selection -->
<select id="vehicle-type">
    <option value="motorcycle">Motorcycle</option>
    <option value="tricycle">Tricycle</option>
    <option value="car">Car</option>
    <option value="truck">Truck</option>
</select>


<!-- Instructions and Route Suggestions -->
<div id="instructions" style="display: none; padding: 10px; background-color: #f8f9fa; border-top: 1px solid #ddd;">
    <p id="route-suggestion"></p>
</div>


            <div id="map"></div>

            <div class="input-controls">
                <input id="start" type="text" placeholder="Start location" class="input-field">
                <input id="end" type="text" placeholder="End location" class="input-field">
                <button id="find-route-btn" class="action-button">Find Route</button>
            </div>
            <div class="route-selection">
                <button id="blue-route-btn" class="route-button">Preferred Route</button>
                <button id="red-route-btn" class="route-button">Alternate Route</button>
            </div>

           <!-- Section to display route details -->
            <div id="directions" class="directions-container">
                <div id="blue-route-details" style="display: none;"></div>
                <div id="red-route-details" style="display: none;"></div>
            </div>
        </div>

        <!-- Overlay and Message Box -->
        <div class="overlay" id="overlay"></div>
        <div class="message-box" id="message-box">
            <h2 id="message-title">Missing Information</h2>
            <p id="message-content">Please enter both start and end locations.</p>
            <button onclick="closeMessage()">Close</button>
        </div>
    </div>
</div>

<style>
    /* Add CSS for the line and highlight styles */
      .direction-step {
        padding: 8px;
        cursor: pointer;
    }

    .separator {
        border: none;
        border-top: 1px solid #888;
        margin: 8px 0; /* Adjust spacing around the line */
    }

    .direction-step:hover, .direction-step.active {
        background-color: #f0f8ff; /* Highlight color */
    }
</style>

<script>
    let map, directionsService;
    const renderers = [];
    const floodLocations = [
        "119D MacArthur Hwy, Marulas",
        "126 MacArthur Hwy, Marulas",
        "Dalandanan Market",
        "Dalandanan VCEH",
        "135 Paso de Blas Rd"
    ];
    const floodCircles = [];

    function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 14.5995, lng: 120.9842 },
        zoom: 12,
        gestureHandling: "greedy", // Make map gestures touch-friendly on mobile
        zoomControl: false, // Hide zoom control for more screen space
    });

    // Initialize the Traffic Layer
    // Add Traffic Layer
    const trafficLayer = new google.maps.TrafficLayer();
    trafficLayer.setMap(map);

    // Create the legend div
    const legend = document.createElement("div");
    legend.id = "traffic-legend";
    legend.innerHTML = `
        <h4>Traffic Conditions</h4>
        <ul>
            <li><span style="background-color: green;"></span> Free-flowing</li>
            <li><span style="background-color: orange;"></span> Moderate</li>
            <li><span style="background-color: red;"></span> Heavy</li>
            <li><span style="background-color: darkred;"></span> Severe</li>
        </ul>
    `;

    // Add the legend as a custom control on the map
    map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend);
    directionsService = new google.maps.DirectionsService();

    // Additional setup
    document.getElementById("find-route-btn").addEventListener("click", findRoute);
    document.getElementById("blue-route-btn").addEventListener("click", () => toggleRoute(0));
    document.getElementById("red-route-btn").addEventListener("click", () => toggleRoute(1));

    // Autocomplete for inputs
    const autocompleteOptions = { componentRestrictions: { country: "PH" } };
    new google.maps.places.Autocomplete(document.getElementById("start"), autocompleteOptions);
    new google.maps.places.Autocomplete(document.getElementById("end"), autocompleteOptions);

    // Highlight flood-prone areas
    highlightFloodProneAreas();
    setupAutocomplete();
    highlightFloodProneAreas();

    // Event listeners for traffic and other layers
    document.getElementById("overlay").addEventListener("click", closeMessage);


        // Add listener to automatically update route guidance on vehicle type change
        document.getElementById("vehicle-type").addEventListener("change", handleVehicleTypeChange);

        // Event listeners for route and overlay
        document.getElementById("find-route-btn").addEventListener("click", findRoute);
        document.getElementById("overlay").addEventListener("click", closeMessage);
    }
// Array of areas to monitor for traffic conditions
const monitoredAreas = [
    { name: "Barangay Marulas", location: { lat: 14.7011, lng: 120.9622 } },
    { name: "Barangay Karuhatan", location: { lat: 14.7035, lng: 120.9554 } }
];


function showMessage(title, content, isTrafficAlert = false) {
    const messageBox = document.getElementById("message-box");
    const overlay = document.getElementById("overlay");

    document.getElementById("message-title").textContent = title;
    document.getElementById("message-content").textContent = content;
    messageBox.style.display = "block";
    overlay.style.display = "block";

    if (isTrafficAlert) {
        messageBox.style.backgroundColor = "red"; // Change color for traffic alerts
        // Add any other styling here for traffic-specific alerts
    } else {
        messageBox.style.backgroundColor = "#fff"; // Default color for regular messages
    }
}


// Dummy function to simulate traffic data fetching
function getTrafficInfo(location) {
    // Normally, an external API call for live traffic data should replace this function
    // This is a placeholder function returning random traffic density for illustration purposes
    const densities = ["light", "moderate", "heavy"];
    return densities[Math.floor(Math.random() * densities.length)];
}

// Check traffic periodically (e.g., every 5 minutes)
setInterval(checkTrafficConditions, 300000); // 300,000 ms = 5 minutes


    function highlightFloodProneAreas() {
    const geocoder = new google.maps.Geocoder();
    const infoWindow = new google.maps.InfoWindow(); // Create an InfoWindow to display details

    floodLocations.forEach(address => {
        geocoder.geocode({ address }, (results, status) => {
            if (status === google.maps.GeocoderStatus.OK) {
                const location = results[0].geometry.location;

                const floodCircle = new google.maps.Circle({
                    strokeColor: "#FF0000",
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: "#FF0000",
                    fillOpacity: 0.35,
                    map,
                    center: location,
                    radius: 200,
                });

                floodCircles.push(floodCircle);

                const marker = new google.maps.Marker({
                    position: location,
                    map,
                    title: address,
                    icon: {
                        url: "http://maps.google.com/mapfiles/ms/icons/red-dot.png"
                    }
                });

                // Attach click event to the circle to show information
                google.maps.event.addListener(floodCircle, 'click', () => {
                    infoWindow.setContent(`<div><strong>Flood-Prone Area</strong><br>${address}<br>Use caution in this area.</div>`);
                    infoWindow.setPosition(location);
                    infoWindow.open(map);
                });

                google.maps.event.addListener(marker, 'click', () => {
                    infoWindow.setContent(`<div><strong>Flood-Prone Area</strong><br>${address}<br>Use caution in this area.</div>`);
                    infoWindow.open(map, marker);
                });
            } else {
                console.error(`Geocode was not successful for ${address} due to: ${status}`);
            }
        });
    });
}

function setupAutocomplete() {
        const startInput = document.getElementById("start");
        const endInput = document.getElementById("end");
        const options = { componentRestrictions: { country: "PH" } };
        new google.maps.places.Autocomplete(startInput, options);
        new google.maps.places.Autocomplete(endInput, options);
    }

    function handleVehicleTypeChange() {
        // Automatically update route guidance based on the newly selected vehicle type
        if (renderers.length > 0) {
            const selectedIndex = renderers.findIndex(renderer => renderer.getMap() !== null);
            const activeDirections = renderers[selectedIndex].directions;
            displayDirections(activeDirections, selectedIndex);
        }
    }

// Updated findRoute function to optimize mobile experience
function findRoute() {
    const start = document.getElementById("start").value;
    const end = document.getElementById("end").value;

    if (!start || !end) {
        showMessage("Missing Information", "Please enter both start and end locations.");
        return;
    }

    if (start === end) {
        showMessage("Same Location Error", "The start and end locations cannot be the same.");
        return;
    }

    const request = {
        origin: start,
        destination: end,
        travelMode: google.maps.TravelMode.DRIVING,
        provideRouteAlternatives: true,
    };

    directionsService.route(request, (response, status) => {
        if (status === "OK") {
            clearPreviousRoutes();
            renderRoutes(response);
        } else {
            showMessage("Route Error", "Location not found or is too vague. Please refine your input.");
            document.getElementById("directions").style.display = "none";
        }
    });
}

function renderRoutes(response) {
    response.routes.forEach((route, index) => {
        const routeRenderer = new google.maps.DirectionsRenderer({
            map: map,
            directions: response,
            routeIndex: index,
            polylineOptions: {
                strokeColor: index === 0 ? "#191970" : "#051f20",
            },
            draggable: true,
        });

        renderers.push(routeRenderer);

        // Automatically select vehicle type based on road suitability for each route
        const suitableVehicle = determineVehicleType(route);
        document.getElementById("vehicle-type").value = suitableVehicle;

        displayDirections(response, index);
    });
    toggleRoute(0); // Show the first route by default
}

// New function to determine the most suitable vehicle type based on route analysis
function determineVehicleType(route) {
    let isLargeVehicleSuitable = true;
    
    route.legs[0].steps.forEach(step => {
        const roadType = getRoadType(step.instructions); // Checks road type
        if (roadType === "local" || roadType === "residential") {
            isLargeVehicleSuitable = false;
        }
    });

    // Decide vehicle type based on route suitability
    if (isLargeVehicleSuitable) {
        return "car"; // Default to a larger vehicle when suitable
    } else {
        return "motorcycle"; // Default to a smaller vehicle in constrained routes
    }
}

// Other existing code (functions like displayDirections, getRoadType, etc.) remains as is


    function checkFloodProneAreas(response) {
        let routeHasFlood = false;

        response.routes.forEach(route => {
            route.legs[0].steps.forEach(step => {
                const path = step.path;
                path.forEach(latLng => {
                    floodCircles.forEach(circle => {
                        if (google.maps.geometry.spherical.computeDistanceBetween(latLng, circle.getCenter()) <= circle.getRadius()) {
                            routeHasFlood = true;
                        }
                    });
                });
            });
        });

        if (routeHasFlood) {
            showMessage("Flood Prone Area Alert", "The selected route passes through a flood-prone area. Try rerouting or proceed with caution.");
        }
    }
    function displayDirections(directions, routeIndex) {
    const route = directions.routes[routeIndex].legs[0];
    const isRouteFloodProne = route.steps.some(step => isStepInFloodProneArea(step));
    const isUnsuitableForLargeVehicles = checkRoadSuitability(route);

    // Generate flood warning and road suitability warning
    const floodWarning = isRouteFloodProne
        ? `<p style="color: red; font-weight: bold;">Warning: This route may pass through a flood-prone area.</p>`
        : "";
    const roadSuitabilityWarning = isUnsuitableForLargeVehicles && (document.getElementById("vehicle-type").value === "truck" || document.getElementById("vehicle-type").value === "car")
        ? `<p style="color: orange; font-weight: bold;">Warning: This route includes smaller roads that may be unsuitable for large vehicles.</p>`
        : "";

    // Create an array to store markers for each step
    const stepMarkers = [];

    // Display each step with a dashed line separator and scroll functionality
    const steps = route.steps.map((step, i) => {
        return `<div class="direction-step" onclick="panToStepAndScroll(${routeIndex}, ${i})" style="cursor: pointer;">
                    ${i + 1}. ${step.instructions} (${step.distance.text})
                </div>
                <hr class="separator">`;
    }).join("");

    const directionsHtml = floodWarning + roadSuitabilityWarning + steps;

    document.getElementById("directions").style.display = "block";
    if (routeIndex === 0) {
        document.getElementById("blue-route-details").innerHTML = directionsHtml;
    } else {
        document.getElementById("red-route-details").innerHTML = directionsHtml;
    }

    // Create markers for each step and save them in stepMarkers
    route.steps.forEach((step, i) => {
        const marker = new google.maps.Marker({
            position: step.start_location,
            map: map,
            label: `${i + 1}`,
            visible: false, // Initially hidden
            icon: {
                url: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png" // Customize marker color if needed
            }
        });
        stepMarkers.push(marker);
    });

    // Store step markers in global variable to access them later
    window.stepMarkers = stepMarkers;
    provideVehicleGuidance(isRouteFloodProne, isUnsuitableForLargeVehicles);

    // Add click event listener to highlight the step when clicked
    const stepElements = document.querySelectorAll(".direction-step");
    stepElements.forEach((stepElement, i) => {
        stepElement.addEventListener("click", () => highlightStep(stepElements, i));
    });
}

// Function to pan to the step's location and scroll to map
function panToStepAndScroll(routeIndex, stepIndex) {
    panToStep(routeIndex, stepIndex);
    document.getElementById("map").scrollIntoView({ behavior: "smooth", block: "start" });
}

// Function to highlight the selected step
function highlightStep(stepElements, selectedIndex) {
    stepElements.forEach((el, i) => {
        el.classList.toggle("active", i === selectedIndex);
    });
}


// Function to pan the map to the step's location and show the marker
function panToStep(routeIndex, stepIndex) {
    // Retrieve the marker and position for the selected step
    const marker = window.stepMarkers[stepIndex];
    const stepLocation = marker.getPosition();

    // Set all markers to hidden and only show the selected one
    window.stepMarkers.forEach(m => m.setVisible(false));
    marker.setVisible(true);

    // Pan and zoom the map to the selected step location
    map.panTo(stepLocation);
    map.setZoom(16); // Adjust zoom level for a closer view
}

// Remove scrollable direction details by making the container expand fully
document.getElementById("directions").style.overflow = "visible";
document.getElementById("directions").style.maxHeight = "none";


// Check if any route step is within flood-prone areas
function isStepInFloodProneArea(step) {
    return step.path.some(latLng => {
        return floodCircles.some(circle => {
            return google.maps.geometry.spherical.computeDistanceBetween(latLng, circle.getCenter()) <= circle.getRadius();
        });
    });
}

function provideVehicleGuidance(isRouteFloodProne, isUnsuitableForLargeVehicles) {
    const vehicleType = document.getElementById("vehicle-type").value;
    const suggestion = document.getElementById("route-suggestion");

    let advice;
    if (isRouteFloodProne || isUnsuitableForLargeVehicles) {
        if (vehicleType === "motorcycle" || vehicleType === "tricycle") {
            advice = "This route is manageable for smaller vehicles, but exercise caution in flood-prone areas.";
        } else if (vehicleType === "car" || vehicleType === "van") {
            advice = isRouteFloodProne ? 
                "Consider taking the first route to avoid potential risks in flood-prone areas." :
                "Be cautious of narrower roads that may be challenging for larger vehicles.";
        } else if (vehicleType === "truck") {
            advice = isUnsuitableForLargeVehicles ? 
                "This route includes narrow roads that are unsuitable for trucks. Consider an alternate route." :
                "Due to flood-prone areas, it may be safer to avoid this route if possible.";
        }
    } else {
        advice = "This route is suitable based on current conditions.";
    }

    suggestion.innerHTML = `<strong>Guidance for ${vehicleType.charAt(0).toUpperCase() + vehicleType.slice(1)}:</strong> ${advice}`;
    document.getElementById("instructions").style.display = "block";
}


function checkRoadSuitability(route) {
    let isUnsuitableForLargeVehicles = false;

    route.steps.forEach(step => {
        const roadType = getRoadType(step.instructions); // Check the road type in each step
        if (roadType === "local" || roadType === "residential") {
            isUnsuitableForLargeVehicles = true;
        }
    });

    return isUnsuitableForLargeVehicles;
}

// This function simulates determining road type based on step instruction keywords
function getRoadType(instruction) {
    // Assume road type based on keywords in the instructions (this is a heuristic)
    if (instruction.includes("Street") || instruction.includes("Drive") || instruction.includes("Road")) {
        return "local";
    } else if (instruction.includes("Highway") || instruction.includes("Freeway") || instruction.includes("Expressway")) {
        return "highway";
    } else if (instruction.includes("Avenue") || instruction.includes("Boulevard")) {
        return "main";
    } else {
        return "unknown";
    }
}

    function clearPreviousRoutes() {
        renderers.forEach(renderer => renderer.setMap(null));
        renderers.length = 0;
        hideAllDetails();
    }

    function toggleRoute(index) {
        renderers.forEach((renderer, i) => {
            renderer.setMap(i === index ? map : null);
        });

        if (index === 0) {
            document.getElementById("blue-route-details").style.display = "block";
            document.getElementById("red-route-details").style.display = "none";
        } else if (index === 1) {
            document.getElementById("blue-route-details").style.display = "none";
            document.getElementById("red-route-details").style.display = "block";
        }

        const directions = renderers[index].directions;
        displayDirections(directions, index);
    }

    function hideAllDetails() {
        document.getElementById("blue-route-details").style.display = "none";
        document.getElementById("red-route-details").style.display = "none";
    }

    // Update the showMessage function to show overlay and improve readability
    function showMessage(title, content) {
    document.getElementById("message-title").textContent = title;
    document.getElementById("message-content").textContent = content;
    document.getElementById("message-box").style.display = "block";
    document.getElementById("overlay").style.display = "block";
    }

    function closeMessage() {
    document.getElementById("message-box").style.display = "none";
    document.getElementById("overlay").style.display = "none";
    }

// Adjust toggleRoute to add smoother transition for directions display on mobile
    function toggleRoute(index) {
    renderers.forEach((renderer, i) => {
        renderer.setMap(i === index ? map : null);
    });

    const directionsElement = document.getElementById("directions");
    if (index === 0) {
        directionsElement.style.display = "block";
        document.getElementById("blue-route-details").style.display = "block";
        document.getElementById("red-route-details").style.display = "none";
    } else {
        directionsElement.style.display = "block";
        document.getElementById("blue-route-details").style.display = "none";
        document.getElementById("red-route-details").style.display = "block";
    }

    // Fetch and display the directions immediately for the active route
    const directions = renderers[index].directions;
    displayDirections(directions, index);
}
</script>
    

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMUTo6-3mydfGFj7zdNtnvucFOlOQB3fU&libraries=places,geometry&callback=initMap"></script>

<br>
     <!-- Footer Section -->
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

  <script>
      // Example JavaScript functionality
      document.addEventListener('DOMContentLoaded', () => {
          console.log('Footer loaded and ready');
          // Add any additional interactive JavaScript here
      });
  </script>
      

</body>
</html>