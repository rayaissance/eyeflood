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
    <title>Route Finder</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
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

        .right-links  {
            margin-left: 0.5px;
            padding: 0px 10px;
         
            color: white;
            border-radius: 10px;
            text-decoration: none;
            font-size: 14px;
        }


        #container {
            display: flex;
            flex-direction: column;
            width: 90%; /* 90% of the viewport width */
            margin: 20px auto;
        }

        #controls {
            width: 100%;
            margin-bottom: 20px;
        }

        #map-container {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        #map {
            height: 70vh; /* 70% of viewport height */
            width: 100%; /* Full width */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .routing-control-container {
            width: 100%;
            padding: 10px;
        }

        .leaflet-routing-container {
            background-color: white;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            width: 100%;
            height: 65vh; /* Adjust height as needed */
            overflow-y: auto; /* Add scroll if content overflows */
        }

        #userLocation, #destination {
            width: 100%; /* 100% of controls width */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box; /* Include padding and border in width calculation */
            display: block; /* Ensure each input element occupies full width */
            margin-bottom: 10px;
        }

        #destination option {
            font-size: 16px;
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

       

        @media only screen and (max-width: 600px) {
            .nav {
                flex-direction: column;
                align-items: flex-start;
                text-align: left;
            }

            .logo {
                margin: 10px 0;
            }

            .back-button {
                margin-bottom: 10px;
            }
        }

        
        @media only screen and (max-width:430px) {
            .nav {
                flex-direction: row;
                align-items: center;
                text-align: center;
              padding-left:8px;
            }

            .logo {
              
                font-size: 20px;  /* Slightly reduce the logo size */
                 margin-right: -10px;
    
            }

            .back-button {
                margin-bottom: 10px;
            }

            .dropdown-content {
            min-width: 100px;
        
        }
            .dropbtn {
                width: 110px; /* Let the width adjust dynamically */
        height: 49px; /* Set a specific height */
        text-align: center;
        margin-left: 10px; /* Adjust margins for better alignment */
        margin-right: 2px;
        padding: 5px 15px; /* Add padding for better spacing */
        font-size: 16px; /* Set a clear font size */
        border-radius: 5px; /* Optional: give it rounded corners */
            
     
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


       







/* Responsive adjustments */
@media only screen and (max-width: 380px) and (max-width: 600px) {
    .dropdown-content {
        min-width: 100px;
    }

    .dropbtn {
        width: 100%;
        text-align: center;
    }
    

    @media only screen (max-width: 438px) {
    .dropdown-content {
        min-width: 100px;
    }

    .dropbtn {
        width: 100%;
        text-align: center;
    }


    
}

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
            /* USER LIST update CSS*/
    .user {
    justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
    margin: auto;
    background-color: #d1eaf0; /* Ensure the background is white */
    border-radius: 10px;
    max-width: 800px;
}

body {
    font-family: Arial, sans-serif;
}

.container {
    align-items: center;
    justify-content: space-between;
    margin-bottom: 30px;
    display: flex; /* Ensure flexbox is used */
    flex-wrap: wrap; /* Allow items to wrap on smaller screens */
}

.admin, .user {
    border: 1px solid #ddd;
    padding: 20px;
    width: 45%;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
}

/* Center headings */
h2 {
    text-align: center;
}

label, select, input {
    display: block;
    margin: 10px 0;
    width: 100%;
}

input[type="number"], input[type="text"] {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.btn {
    background-color: #28a745;
    color: white;
    padding: 10px;
    text-align: center;
    border: none;
    cursor: pointer;
    width: 100%;
    margin-top: 10px;
    border-radius: 5px;
}

.btn:hover {
    background-color: #218838;
}

.output {
    margin-top: 20px;
    padding: 10px;
    background-color: #f8f9fa;
    border: 1px solid #ddd;
}

/* Responsive styles */
@media (max-width: 768px) {
    .admin, .user {
        width: 100%; /* Full width on smaller screens */
        margin-bottom: 20px; /* Space between elements */
    }
}

/* Wider container for iPhone 14 Pro */
@media (max-width: 430px) {
    .container {
        max-width: 100%; /* Allow container to use full width */
        padding: 0 10px; /* Add some horizontal padding */
    }
    
    .admin, .user {
        width: 100%; /* Full width for admin/user sections */
    }
    
    .btn {
        font-size: 16px; /* Increase button text size */
        padding: 12px; /* Increase padding for touch targets */
    }
    
    h2 {
        font-size: 1.5em; /* Adjust heading size */
    }
}


        

        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        #map {
            height: 60%;
            width: 100%;
        }
        #controls {
            padding: 10px;
            background-color: #f4f4f4;
            text-align: center;
        }
        select, input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            margin: 5px 0;
            border-radius: 5px;
        }
        button {
            padding: 10px;
            width: 100%;
            font-size: 16px;
            margin-top: 5px;
            border-radius: 5px;
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        #directions-panel {
            height: 30%;
            overflow-y: auto;
            padding: 10px;
            background-color: #fff;
            border-top: 1px solid #ddd;
        }
        @media (max-width: 768px) {
            #map {
                height: 50%;
            }
            #directions-panel {
                height: 40%;
            }
            select, input, button {
                font-size: 14px;
            }
        }
        /* Accessibility improvements */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            border: 0;
        }
        .error-message {
            color: red;
            font-size: 16px;
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
                  
    
    
                 
    <br>

   <!-- LIST OF EVACUATION AREA-->
   <div class="user">
    <h2 style="color: #D61A3C;">EVACUATION UPDATE</h2>
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

<script>
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


<!-- END OF LIST OF EVACUATION AREA-->



<br>
<!--MAP AREA -->
<!-- White box container for map, controls, and directions panel 
<div class="container-box">
<h1 style="text-align:center; color: #38c0fe;">DIRECTIONS TO EVACUATION SITE</h1>
<div class="info-container">
        <div class="icon"></div>
        <div class="text">
            To locate the nearest evacuation route, please allow access to your phone's location services. Once granted, select a familiar nearby school and initiate the search. The map will then display the route you should take to reach the designated evacuation area.
        </div>
    </div>
    <div id="map" aria-label="Map showing your location and routes"></div>
    <div id="controls">
        <label for="location-select" class="sr-only">Select a destination:</label>
        <select id="location-select" aria-label="Destination Dropdown">
            <option value="">Select a Destination</option>
            <option value="58 R . Valenzuela, Lungsod ng Valenzuela, 1440 Kalakhang Maynila">Valenzuela National Highschool</option>
            <option value="11 Ilang-Ilang, Maynila, Kalakhang Maynila">Constantino Elementary School</option>
            <option value="20 Gen. Luna, Lungsod ng Valenzuela, 1441 Kalakhang Maynila">Caruhatan National Highschool</option>
            <option value="20 T. Serrano, Manila, Metro Manila">Serrano Elementary School</option>
            <option value="Pio Valenzuela St. Marulas, Valenzuela City">Marulas Elementary School</option>
            <option value="22 Consuelo, Lungsod ng Valenzuela, Kalakhang Maynila">Barangay Court</option>
        </select>

        <label for="manual-location" class="sr-only">Enter your location manually:</label>
        <input id="manual-location" type="text" placeholder="If ping wrong, Type your Location here (optional)" aria-label="Manual Location Input" />

        <button onclick="showDirections()">Search Directions</button> 
      
        
        <p id="error-message" class="error-message" aria-live="polite"></p>
    </div>
    <div id="directions-panel" aria-live="polite" style="display: none;"></div>
</div>-->


<!-- MAP AREA -->
<div class="container-box">
    <h1 style="text-align:center; color: #191970;">DIRECTIONS TO EVACUATION SITE</h1>
    <div class="info-container">
        <div class="icon"></div>
        <div class="text">
            To locate the nearest evacuation route, please allow access to your phone's location services. Once granted, select a familiar nearby school and initiate the search. The map will then display the route you should take to reach the designated evacuation area.
        </div>
    </div>
    <div id="map" aria-label="Map showing your location and routes"></div>
    <div id="controls">
        <label for="location-select" class="sr-only">Select a destination:</label>
        <select id="location-select" aria-label="Destination Dropdown">
            <option value="">Select a Destination</option>
        </select>

        <label for="manual-location" class="sr-only">Enter your location manually:</label>
        <input id="manual-location" type="text" placeholder="If ping wrong, Type your Location here (optional)" aria-label="Manual Location Input" />

        <button onclick="showDirections()">Search Directions</button>
        
        <p id="error-message" class="error-message" aria-live="polite"></p>
    </div>
    <div id="directions-panel" aria-live="polite" style="display: none;"></div>
</div>

<style>

    /* Styling for the white container box */
   /* Base Styling for the White Container Box */
.container-box {
    background-color: white;
    padding: 20px;
    margin-top: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    max-width: 3000px; /* Set a max width for larger screens */
    margin-left: auto;
    margin-right: auto;
}

/* Map Styling */
#map {
    width: 100%;
    height: 500px;
    margin-bottom: 20px;
    border-radius: 8px;
}

/* Form Elements */
select, input, button {
    display: block;
    width: 100%;
    padding: 10px;
    margin-top: 10px;
}

button {
    background-color: #007bff;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 5px;
}

button:hover {
    background-color: #0056b3;
}

/* Responsive Styling */
@media (max-width: 430px) {
    .container-box {
        padding: 15px;
        margin-top: 10px;
        max-width: 100%;
    }

    #map {
        height: 250px;
    }

    select, input, button {
        padding: 8px;
    }

    button {
        font-size: 0.9em;
    }
}

/* Additional tweaks for larger mobile screens like iPhone 14 Pro */
@media (min-width: 431px) and (max-width: 768px) {
    .container-box {
        padding: 18px;
        margin-top: 15px;
        max-width: 95%;
    }

    #map {
        height: 280px;
    }

    select, input, button {
        padding: 9px;
    }

    button {
        font-size: 1em;
    }
}

    
</style>


<script>
    //MAP SCRIPT
    let map, directionsService, directionsRenderer, geocoder;

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 14.6751, lng: 121.0437 }, // Default center, Metro Manila
        zoom: 12
    });

    directionsService = new google.maps.DirectionsService();
    directionsRenderer = new google.maps.DirectionsRenderer();
    directionsRenderer.setMap(map);
    directionsRenderer.setPanel(document.getElementById('directions-panel'));

    geocoder = new google.maps.Geocoder();

    // Add Autocomplete only for manual location input
    const manualLocationInput = document.getElementById("manual-location");
    const autocompleteOptions = { componentRestrictions: { country: "PH" } }; // Restrict to the Philippines
    new google.maps.places.Autocomplete(manualLocationInput, autocompleteOptions);

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    map.setCenter(userLocation);
                    new google.maps.Marker({
                        position: userLocation,
                        map: map,
                        title: "Your Location"
                    });
                },
                (error) => {
                    handleLocationError(true, map.getCenter(), error.message);
                },
                {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                }
            );
        } else {
            handleLocationError(false, map.getCenter(), "Geolocation is not supported by your browser.");
        }

        // Fetch and populate evacuation centers dynamically
        fetchEvacuationCenters();
    }

    function handleLocationError(browserHasGeolocation, pos, errorMessage) {
        const errorElement = document.getElementById('error-message');
        errorElement.textContent = browserHasGeolocation ? `Error: The Geolocation service failed. ${errorMessage}` : "Error: Your browser doesn't support geolocation.";
        alert(errorElement.textContent);
    }

    function fetchEvacuationCenters() {
        const dropdown = document.getElementById('location-select');

        // Fetch all evacuation centers from the server
        fetch('fetch_evacuations.php')
            .then(response => response.json())
            .then(data => {
                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.address;  // Set the option value as the address
                    option.textContent = item.location;  // Display the location name
                    dropdown.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching evacuation data:', error);
            });
    }

    function showDirections() {
        const destination = document.getElementById('location-select').value;
        const errorElement = document.getElementById('error-message');
        const manualLocation = document.getElementById('manual-location').value;

        if (!destination) {
            errorElement.textContent = "Please select a destination.";
            return;
        } else {
            errorElement.textContent = "";
        }

        if (manualLocation) {
            geocoder.geocode({ address: manualLocation }, (results, status) => {
                if (status === 'OK') {
                    const userLocation = results[0].geometry.location;
                    calculateRoute(userLocation, destination);
                } else {
                    errorElement.textContent = `Manual location input failed due to ${status}`;
                }
            });
        } else if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                const userLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                calculateRoute(userLocation, destination);
            }, (error) => {
                errorElement.textContent = `Geolocation failed: ${error.message}`;
            }, {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            });
        }
    }

    function calculateRoute(origin, destination) {
        const request = {
            origin: origin,
            destination: destination,
            travelMode: 'DRIVING'
        };
        directionsService.route(request, (result, status) => {
            if (status === 'OK') {
                directionsRenderer.setDirections(result);
                document.getElementById('directions-panel').style.display = 'block';
            } else {
                document.getElementById('error-message').textContent = `Directions request failed due to ${status}`;
                document.getElementById('directions-panel').style.display = 'none';
            }
        });
    }
</script>

<!-- Google Maps API key -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMUTo6-3mydfGFj7zdNtnvucFOlOQB3fU&libraries=places&callback=initMap"></script>

</body>
</html>