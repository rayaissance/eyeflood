<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <title>Admin Page</title>
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

    /*alternative route */
    
    .box{
        background: #ffff;
        display: flex;
        flex-direction: column;
        padding: 25px 25px;
        border-radius: 20px;
        box-shadow: 0 0 128px 0 rgba(0,0,0,0.1),
                    0 32px 64px -48px rgba(0,0,0,0.5);
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
  
    .submit{
        width: 100%;
    }
    .links{
        margin-bottom: 15px;
    }

    /********* Home *****************/
    

    main{
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 60px;
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
        }

        @media only screen and (max-width:600px){
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
            /* Adjusted size for the logo */
        }  
         
        /*CSS FOR HISTORY TABLE AND PRINTING */
 /* Additional styling to ensure the chart container is fixed size */
 #chartContainer {
            position: relative;
            width: 100%;
            height: 400px; /* Lock the height to 400px */
            max-height: 400px;
        }

        #waterLevelChart {
            width: 100% !important;
            height: 100% !important;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        
        /* Ensure a fixed size for the canvas */
        #waterLevelChart {
            max-width: 100%;
            height: 400px !important; /* Force the height to 400px */
        }
        .table-container {
        display: flex;
        justify-content: center; /* Centers the table horizontally */
        align-items: center; /* Centers the table vertically */
        width: 100%; /* Full width of the container */
        margin: 20px 0; /* Adds some space around the container */
        }

        table {
            width: 100%; /* Adjust the width of the table */
            max-width: 1800px; /* Max width of the table */
            border-collapse: collapse; /* Ensures borders do not collapse */
        }

        th, td {
            padding: 8px;
            text-align: center; /* Center-aligns text */
        }

        th {
            background-color: #f2f2f2;
        }

        table, th, td {
            border: 1px solid black; /* Adds a border to the table */
        }
        #alertLevelHeader:hover {
        color: #f0c14b; /* Change the color on hover */
        }
        label {
            margin-right: 10px;
        }

        select {
            padding: 5px;
            margin-right: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Filter container styles */
        .filter-container {
            margin-top: 15px;
        }

        input[type="date"] {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Button styles */
        button {
            padding: 6px 12px;
            background-color: #007bff; /* Blue color */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center; /* Align icon and text vertically */
        }
        button:hover {
        background-color: #0056b3; /* Darker blue on hover */
        }
        button i {
        margin-right: 5px; /* Add space between icon and text */
        
        }
        .form-section{
        display: flex;
        justify-content: flex-end;
        align-items: center;
        margin-top: 15px;
        }
        .form-section label, .form-section select, .form-section input, .form-section button {
        margin-left: 10px; /* Add some spacing between elements */
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
                    content: 'ℹ️'; /*Information symbol */
                    font-size: 24px;
                }

                .info-container .text {
                    font-size: 14px;
                    color: #333;
                }

    </style>
   
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    

</head>
<body>
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

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-3 flood-card">
                    <div class="card-body">
                        <p>Level: <span id="sensor-data">Waiting for data...</span></p>
                    </div>
                </div>
    


  <!-- ANNOUNCEMENT AND EVACUATION AREA-->

  <!-- Announcement Area -->
    <div class="announcement-container">
    <a href="admin_announcement.php" style="text-decoration: none;">
    <h2 style="color: #e04f5f; margin-top: 20px;">ANNOUNCEMENT</h2>
            
        <?php
        // Check if the session is already started
        if (session_status() === PHP_SESSION_NONE) {
          
        }

        include 'db_connect.php'; // Ensure database connection is established

        // Fetch the latest published announcement
        $query = "SELECT * FROM announcements WHERE status='published' ORDER BY timestamp DESC LIMIT 1";
        $result = mysqli_query($conn, $query);

        $announcementData = null;

        if ($row = mysqli_fetch_assoc($result)) {
            $latestAnnouncementTime = strtotime($row['timestamp']); // Get the timestamp of the latest announcement

            if (!isset($_SESSION['last_announcement_time']) || $_SESSION['last_announcement_time'] != $latestAnnouncementTime) {
                $_SESSION['last_announcement_time'] = $latestAnnouncementTime;
                $_SESSION['announcement_display_time'] = time();
                $showAnnouncement = true;
                $announcementData = [
                    'title' => $row['title'],
                    'message' => $row['message'],
                    'timestamp' => $row['timestamp']
                ];
            } else {
                if (time() - $_SESSION['announcement_display_time'] > 60) { // Change 60 to 86400 for production
                    $showAnnouncement = false;
                } else {
                    $showAnnouncement = true;
                }
            }

            if ($showAnnouncement) {
                echo "<div class='announcement'>
                        <h2>" . $row['title'] . "</h2>
                        <p>" . $row['message'] . "</p>
                        <small>Published on " . $row['timestamp'] . "</small>
                      </div>";
            }
        } else {
            echo "<p>No announcements available at this time.</p>";
        }
        ?>
        </a>
    </div>

    <!-- Evacuation List Area -->
    <div class="evacuation-container">
    <a href="admin-evacuate.php" style="text-decoration: none;">
    <div class="evacuation">
    <h2 style="color: #e04f5f;">EVACUATION CENTER INFORMATION</h2>
    </a>
    
        <label for="userLocation">Location</label>
        <select id="userLocation" onchange="showInfo()">
           <option value="" disabled selected>Select Evacuation Center</option>
        <!-- Locations will be dynamically populated here -->
        </select>

        <div class="output">
        <p><strong>Total Evacuees: </strong><span id="userEvacuees">0</span></p>
        <p><strong>Availability: </strong><span id="userAvailability">Unknown</span></p>
        <p id="addressContainer" style="display: none;"><strong>Address: </strong><span id="userAddress">N/A</span></p>
    </div>
</div>
   
</div>
 

<script>
// Existing JavaScript code for fetching evacuation data


    let evacuationData = {};

    // Fetch evacuation data from the server
    fetch('fetch_evacuations.php')
        .then(response => response.json())
        .then(data => {
            evacuationData = data.reduce((obj, item) => {
                obj[item.location] = {
                    evacuees: item.evacuees,
                    availability: item.availability,
                    address: item.address
                };
                return obj;
            }, {});

            // Populate dropdown with all centers dynamically
            const locationSelect = document.getElementById("userLocation");
            data.forEach(center => {
                const option = document.createElement("option");
                option.value = center.location;
                option.textContent = center.location;
                locationSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching evacuation data:', error));

    function showInfo() {
        const location = document.getElementById('userLocation').value;

        if (location && evacuationData[location]) {
            document.getElementById('userEvacuees').innerText = evacuationData[location].evacuees;
            document.getElementById('userAvailability').innerText = evacuationData[location].availability;
            document.getElementById('userAddress').innerText = evacuationData[location].address;
            document.getElementById('addressContainer').style.display = 'block';
        } else {
            // Reset fields if no valid location is chosen
            document.getElementById('userEvacuees').innerText = "0";
            document.getElementById('userAvailability').innerText = "Unknown";
            document.getElementById('userAddress').innerText = "N/A";
            document.getElementById('addressContainer').style.display = 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('userLocation').value = "";
        document.getElementById('userEvacuees').innerText = "0";
        document.getElementById('userAvailability').innerText = "Unknown";
        document.getElementById('addressContainer').style.display = 'none';
    });
</script>


<div class="Econtact">
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


<style>


.announcement-container,
.evacuation-container,
.Econtact {
    flex: 1;
    min-width: 300px;
    background-color: #f9f9f9;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.Econtact {
    display: inline-block;
    vertical-align: top;
    height: 350px;
    background-color: white;
    font-size: 13px;
    padding: 20px;
    width: 30%;
    text-align: center;
    margin-left: 10px;
    box-sizing: border-box;
    border-radius: 10px;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
}

/* Announcement and Evacuation containers */
.announcement-container, .evacuation-container {
    display: inline-block;
    vertical-align: top;
    width: 30%;
    padding: 20px;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    height: 350px;
    text-align: center;
    box-sizing: border-box;
    margin-left: 10px;
}

.announcement-container {
    background-color: white;
    margin-left: 85px;
    overflow: hidden;
    max-height: 350px;
    overflow-y: auto; /* Enable vertical scroll if content overflows */
 

}

.announcement {
    color: #856404;
}

.announcement h2 {
    font-size: 35px;
    color: #e04f5f;
    margin-top: 10px;
}

.announcement p {
    font-size: clamp(10px, 1vw, 16px); /* Dynamic font size based on container space */
    color: black;
    margin-bottom: 10px;
    overflow-wrap: break-word;
    white-space: normal;
}

.announcement small {
    font-size: clamp(6px, 0.5vw, 10px); /* Dynamic font size based on container space */
    color: black;
}

.evacuation-container h2 {
    font-size: 24px;
    color: #e04f5f;
    margin-bottom: 10px;
    margin-top: 20px;
}

label, select, input {
    display: block;
    margin: 10px 0;
    width: 80%;
    margin-left: auto;
    margin-right: auto;
}

.output {
    padding: 20px;
    background-color: #d1eaf0;
    border: 1px solid #ddd;
    margin-top: 20px;
    width: 80%;
    margin-left: auto;
    margin-right: auto;
    border-radius: 10px;
}


/* Responsive styles for smaller screens */
@media (max-width: 768px) {
    .announcement-container, .evacuation-container {
        width: 100%; /* Full width for smaller screens */
        margin-right: 0; /* Remove right margin on smaller screens */
    }
}

</style>

  <!-- END OF ANNOUNCEMENT AND EVACUATION AREA-->

                                   
   <br>
   
   <div class="top">
            <div class="box">
            <div class="map-container">
            <h2 style="color: #191970;">ALTERNATIVE ROUTE</h2>
            
        
        <p>&#9888; Passable Vehicles:<i> Only the vehicles indicated below are passable on the road. <b>Trucks or Large Vehicles are not allowed.</b></i></p>
        <p class="vehicle jeepney"><i class="fas fa-bus"></i> Jeepney</p>
        <p class="vehicle tricycle"><i class="fas fa-motorcycle"></i> Tricycle</p>
        <p class="vehicle motorcycle"><i class="fas fa-motorcycle"></i> Motorcycle</p>
        <p class="vehicle car"><i class="fas fa-car"></i> Car</p>
        <p class="vehicle bike"><i class="fas fa-bicycle"></i> Bike</p>
        
        <!-- <p><a href="alternative.php" style="text-decoration: underline; color: inherit;">View Full Location Here</a></p>-->
        <iframe src="https://www.google.com/maps/d/embed?mid=1pR75lBNIyvCXAGMfK815g8xhQ5TF_dQ&hl=en&ehbc=2E312F"></iframe>
    </div>
    </div>
    <br>
    
<br>
      <script>
        // Example JavaScript functionality
        document.addEventListener('DOMContentLoaded', () => {
            console.log('Footer loaded and ready');
            // Add any additional interactive JavaScript here
        });
    </script>
        <br>
        
        <!-- FLOOD HISTORY AND PRINTING -->
    <!-- Line graph canvas -->
   
      
    <div class="top">
    <div class="box">
    <h2 style="color: #191970;">FLOOD LEVEL HISTORY</h2>
    <div class="info-container">
                <div class="text">
                This section provides comprehensive records of past flood levels, 
                giving residents and local authorities valuable insights into water level height 
                and flood risk patterns. Kindly sort the data below based on your preferred 
                data to explore flood level history in detail.
                </div>
            </div>
    <canvas id="floodChart" width="400" height="200"></canvas>

<div class="container-sort" style="display: flex; justify-content: flex-end; align-items: center; margin-right: 30px;">

    
    <!-- Sorting section -->
    <div class="form-section">
        <label for="alertLevelSort">Sort Alert Level:</label>
        <select id="alertLevelSort">
            <option value="asc">Ascending</option>
            <option value="desc">Descending</option>
        </select>

        <label for="timestampSort">Sort Timestamp:</label>
        <select id="timestampSort">
            <option value="asc">Ascending</option>
            <option value="desc">Descending</option>
        </select>

        <!-- Filter section -->
        <label for="filterDate">Select Date:</label>
        <input type="date" id="filterDate" />
        <button onclick="printByDay()">Print<img src="printer.png" style="width: 15px; height: 15px; margin-left: 8px;";></button>
    </div>

</div>


<div class="table-container">
<table id="floodTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Alert Level</th>
            <th>Flood Level</th>
            <th>Timestamp</th> <!-- Add an ID and cursor pointer -->
            <th>Rate of Flood (inches/time)</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>
</div>
<script>
    async function fetchFloodData() {
        try {
            const response = await fetch('php/db_connect.php'); // Adjust path as needed
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            const data = await response.json();
            console.log(data);

            // Prepare data for the chart
            const labels = data.map(row => {
                const date = new Date(row.time_stamp);
                return date.toLocaleString('en-US', { dateStyle: 'short', timeStyle: 'short', hour12: true });
            });
            const floodLevels = data.map(row => row.flood_level);
            const rateOfFlood = data.map(row => {
                return row.rate_of_flood !== 'N/A' ? parseFloat(row.rate_of_flood.match(/(\d+\.\d+)/)[0]) : null;
            });

            // Update table
            const tableBody = document.getElementById('floodTable').querySelector('tbody');
            tableBody.innerHTML = '';

            data.forEach((row) => {
            const tr = document.createElement('tr');

            const idCell = document.createElement('td');
            idCell.textContent = row.id;
            tr.appendChild(idCell);

            const alertLevelCell = document.createElement('td');
            alertLevelCell.textContent = "Alert Level " + row.alert_level;
            tr.appendChild(alertLevelCell);

            const floodLevelCell = document.createElement('td');
            floodLevelCell.textContent = row.flood_level + " INCHES";
            tr.appendChild(floodLevelCell);

            const timeStampCell = document.createElement('td');
            const date = new Date(row.time_stamp);
            timeStampCell.textContent = date.toLocaleString('en-US', { dateStyle: 'short', timeStyle: 'short', hour12: true });
            tr.appendChild(timeStampCell);

            const rateOfFloodCell = document.createElement('td');
            rateOfFloodCell.textContent = row.rate_of_flood;
            tr.appendChild(rateOfFloodCell);

            // Apply color based on alert level
            if (parseInt(row.alert_level) === 1) {
                tr.style.backgroundColor = 'rgba(78, 237, 102)'; // Low alert
                tr.style.color = 'black'; // Text color for contrast
            } else if (parseInt(row.alert_level) === 2) {
                tr.style.backgroundColor = 'rgba(237, 240, 72)'; // Medium alert
                tr.style.color = 'black'; // Ensure text is readable on yellow background
            } else if (parseInt(row.alert_level) === 3) {
                tr.style.backgroundColor = 'rgba(240, 72, 72)'; // High alert
                tr.style.color = 'white'; // Text color for contrast
            }

                tableBody.appendChild(tr);
            });


            // Create the line graph
            const ctx = document.getElementById('floodChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Flood Level (inches)',
                            data: floodLevels,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            fill: true,
                            tension: 0.1
                        },
                        {
                            label: 'Rate of Flood (inches/min)',
                            data: rateOfFlood,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            fill: false,
                            tension: 0.1,
                            yAxisID: 'yRate'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Time'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Flood Level (inches)'
                            }
                        },
                        yRate: {
                            position: 'right',
                            title: {
                                display: true,
                                text: 'Rate of Flood (inches/min)'
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        }
                    }
                }
            });

        } catch (error) {
            console.error('Error fetching flood data:', error);
        }
    }

    // Fetch data initially and set interval
    window.onload = fetchFloodData;
    setInterval(fetchFloodData, 5000);
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sensorDataElement = document.getElementById('sensor-data');
        const apiUrl = 'http://192.168.0.100/data'; // Replace with your ESP32 IP address

        async function fetchSensorData() {
            try {
                const response = await fetch(apiUrl);
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                const data = await response.json(); // Parse JSON response
                // Format the output
                sensorDataElement.textContent = `Height inches: ${data.height_inches} Alert level: ${data.alert_level}`;
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


</script>

<script>
    async function fetchFloodData() {
        // Fetch and populate table data as before...
    }

    function sortTable(columnIndex, isAscending) {
        const tableBody = document.getElementById('floodTable').querySelector('tbody');
        const rows = Array.from(tableBody.querySelectorAll('tr'));

        rows.sort((rowA, rowB) => {
            const cellA = rowA.cells[columnIndex].textContent.trim();
            const cellB = rowB.cells[columnIndex].textContent.trim();

            if (columnIndex === 1) { // Sorting Alert Level
                const alertLevelA = parseInt(cellA.match(/\d+/)[0]);
                const alertLevelB = parseInt(cellB.match(/\d+/)[0]);
                return isAscending ? alertLevelA - alertLevelB : alertLevelB - alertLevelA;
            } else if (columnIndex === 3) { // Sorting Timestamp
                const dateA = new Date(cellA);
                const dateB = new Date(cellB);
                return isAscending ? dateA - dateB : dateB - dateA;
            }
        });

        rows.forEach(row => tableBody.appendChild(row));
    }

    document.getElementById('alertLevelSort').addEventListener('change', function () {
        const isAscending = this.value === 'asc';
        sortTable(1, isAscending);
    });

    document.getElementById('timestampSort').addEventListener('change', function () {
        const isAscending = this.value === 'asc';
        sortTable(3, isAscending);
    });

    window.onload = fetchFloodData;
</script>

<script>
    // Existing JavaScript code remains unchanged

    // Function to print the history table filtered by the selected day, including the graph
    async function printByDay() {
        const filterDate = document.getElementById('filterDate').value;
        if (!filterDate) {
            alert('Please select a date.');
            return;
        }

        // Convert the selected date to the desired format (MM/DD/YYYY)
        const selectedDate = new Date(filterDate).toLocaleDateString('en-US');

        // Clone the table and filter rows by the selected date
        const originalTable = document.getElementById('floodTable');
        const clonedTable = originalTable.cloneNode(true);
        const tableBody = clonedTable.querySelector('tbody');
        const rows = Array.from(tableBody.querySelectorAll('tr'));

        // Filter rows that match the selected date
        rows.forEach(row => {
            const rowDate = new Date(row.cells[3].textContent).toLocaleDateString('en-US');
            if (rowDate !== selectedDate) {
                row.remove(); // Remove non-matching rows
            }
        });

        // Get the flood chart as an image
        const floodChart = document.getElementById('floodChart');
        const chartImage = floodChart.toDataURL('image/png');

        // Open a new window for printing
        const printWindow = window.open('', '_blank');
        printWindow.document.write('<html><head><title>Print Flood History</title>');
        printWindow.document.write('<style>');
        printWindow.document.write('table { width: 100%; border-collapse: collapse; }');
        printWindow.document.write('th, td { padding: 8px; text-align: center; border: 1px solid black; }');
        printWindow.document.write('th { background-color: #f2f2f2; }');
        printWindow.document.write('img { display: block; margin: 20px auto; max-width: 100%; height: auto; }');
        printWindow.document.write('</style></head><body>');
        printWindow.document.write('<h3>Flood History for ' + selectedDate + '</h3>');
        // Add the chart image to the print content
        printWindow.document.write('<img src="' + chartImage + '" alt="Flood Chart" />');
        // Add the filtered table to the print content
        printWindow.document.write(clonedTable.outerHTML);
        printWindow.document.write('</body></html>');

        // Close the document to trigger the rendering
        printWindow.document.close();
        // Focus on the new window and trigger the print dialog
        printWindow.focus();
        printWindow.print();
        // Optionally close the window after printing
        printWindow.onafterprint = function() {
            printWindow.close();
        };
    }
</script>
</div>
</div>

    <!-- Footer Section -->
    <footer class="footer">
        <p>© 2024 Eye Flood | Your Reliable Source for Flood Monitoring</p>
        <p class="footer-note" style="font-size: 12px; font-style: italic; margin-top: 10px;">
            Stay informed, stay safe.
        </p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
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

        fetchSensorData();
        setInterval(fetchSensorData, 5000); // Fetch every 5 seconds
    });
    </script>
</body>
</html>
