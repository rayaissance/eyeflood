<?php
$host = 'localhost';
$dbname = 'flood-monitor';
$user = 'root';
$pass = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

// Handle new evacuation center from modal
if (isset($_POST['evacuationName']) && isset($_POST['evacuationAddress'])) {
    $evacuationName = trim($_POST['evacuationName']);
    $evacuationAddress = trim($_POST['evacuationAddress']);

    if ($evacuationName && $evacuationAddress) {
        try {
            // Insert new evacuation center into the database
            $stmt = $conn->prepare("INSERT INTO evacuation_centers (location, address) VALUES (:location, :address)");
            $stmt->execute([':location' => $evacuationName, ':address' => $evacuationAddress]);
            echo "Success";
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }
    exit;
}

// Initialize a message variable and history data array
$message = "";
$history_data = [];

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['location'], $_POST['evacuees'], $_POST['availability'])) {
    $location = trim($_POST['location']);
    $evacuees = (int)$_POST['evacuees'];
    $availability = trim($_POST['availability']);

    if ($location && $evacuees >= 0 && $availability) {
        try {
            // Begin transaction
            $conn->beginTransaction();
            
            // Update the evacuation center's evacuee count and availability
            $stmt = $conn->prepare("UPDATE evacuation_centers SET evacuees = :evacuees, availability = :availability WHERE location = :location");
            $stmt->execute([':evacuees' => $evacuees, ':availability' => $availability, ':location' => $location]);

            // Check if a similar record already exists in `evac_his`
            $history_check = $conn->prepare("SELECT * FROM evac_his WHERE location = :location ORDER BY timestamp DESC LIMIT 1");
            $history_check->execute([':location' => $location]);
            $last_entry = $history_check->fetch(PDO::FETCH_ASSOC);

            // Only insert if the last entry is different from the current update
            if (!$last_entry || $last_entry['evacuees'] != $evacuees || $last_entry['availability'] != $availability) {
                // Log the update in evac_his with timestamp in Beijing time
                $history_stmt = $conn->prepare("INSERT INTO evac_his (location, evacuees, availability, timestamp) 
                                                VALUES (:location, :evacuees, :availability, CONVERT_TZ(NOW(), @@session.time_zone, '+08:00'))");
                $history_stmt->execute([':location' => $location, ':evacuees' => $evacuees, ':availability' => $availability]);
            }

            // Commit the transaction
            $conn->commit();
            
            // Redirect to avoid resubmission on page refresh
            header("Location: admin-evacuate.php");
            exit;
        } catch (PDOException $e) {
            $conn->rollBack();
            $message = "Database error: " . $e->getMessage();
        }
    } else {
        $message = "All fields are required, and total evacuees cannot be negative.";
    }
}

// Fetch history data from evac_his table
try {
    $history_stmt = $conn->query("SELECT * FROM evac_his ORDER BY timestamp DESC");
    $history_data = $history_stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $message = "Failed to retrieve history: " . $e->getMessage();
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

        
        @media only screen and (max-width:438px) {
            .nav {
                flex-direction: row;
                align-items: center;
                text-align: justify;
            }

            .logo {
                margin: 10px 0;
                font-size: 20px;  /* Slightly reduce the logo size */
                margin-right: 15px;
    
            }

            .back-button {
                margin-bottom: 10px;
            }
            .dropdown-content {
            min-width: 100px;
        
        }

            .dropbtn {
            width: 80%;
            text-align: center;
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
              /* Dropdown container */



/* Admin LIST update CSS*/
        .admin {
        
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            margin: auto;
            background-color: #ffffff;
            border-radius:10px;
        }
      

       
        .container {
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;

            
        }

        .admin, .user {
            border: 1px solid #ddd;
            padding: 20px;
            width: 45%;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }
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
            background-color: #3ec95d;
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
     /* Responsive adjustments */
@media only screen and (max-width: 380px) and (max-width: 600px) {
    .dropdown-content {
        min-width: 100px;
    }

    .dropbtn {
        width: 100%;
        text-align: center;
    }
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

/* HISTORY CONTAINER PART */
.containerHIS {
    align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
}

/* History Table Styling */
.history-table {
    width: 100%; /* Full width of the container */
    max-width: 9500px; /* Matches the container’s width */
    border-collapse: collapse;
    margin: 20px auto;
    font-size: 16px;
    text-align: left;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
}







/* Header styling */
.history-table thead tr {
    background-color: #f17b7b; /* Pink background for the header */
    color: #ffffff; /* White font color for the header */
    text-align: left;
    font-weight: bold;
}

.history-table th,
.history-table td {
    padding: 12px 15px; /* Adjust padding for cells */
}

/* Row styling */
.history-table tbody tr {
    background-color: #ffffff; /* White background for rows */
    color: #000000; /* Black font color for rows */
    border-bottom: 2px solid #f17b7b; /* Pink bottom border for each row */
}

/* Hover effect */
.history-table tbody tr:hover {
    background-color: #f5f5f5; /* Light gray background on hover */
}

/* Responsive adjustments for the table */
@media (max-width: 768px) {
    .history-table thead {
        display: none;
    }

    .history-table, .history-table tbody, .history-table tr, .history-table td {
        display: block;
        width: 100%;
    }

    .history-table tr {
        margin-bottom: 15px;
    }

    .history-table td {
        text-align: right;
        padding-left: 50%;
        position: relative;
    }

    .history-table td::before {
        content: attr(data-label);
        position: absolute;
        left: 0;
        width: 50%;
        padding-left: 15px;
        font-weight: bold;
        text-align: left;
    }
}
 
    </style>
</head>
<body>


    <!-- Navigation Links -->
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
    
    
    
        <!-- Dropdown Button -->
    
    
        <script>
            function toggleMenu() {
                const navLinks = document.querySelector('.nav-links');
                navLinks.classList.toggle('active');
            }
        </script>
                  
    
  <br>
  <br>
  <div class="container">
    <div class="admin">
        <!-- Centered List of Evacuation heading with button aligned to the right -->
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
            
            <!-- Empty div to balance the flex layout -->
            <div style="flex: 1;"></div>
            
            <!-- Centered heading -->
            <h2 style="color: #e04f5f; margin: 0; font-weight: bold; text-align: left; flex: 1;">List of Evacuation</h2>
            
            <!-- Button aligned to the right -->
            <button
                type="button"
                onclick="openEvacuationModal()"
                class="btn"
                style="background-color: #e04f5f; color: white; padding: 6px 12px; font-size: 12px; border-radius: 5px; width: auto; height: 35px; line-height: 1;"
            >
           + Add Evacuation Site
            </button>  
        </div>

        <!-- Form section -->
        <form method="POST" action="admin-evacuate.php">
            <label for="location" style="color: #000000;">Location</label>
            <select name="location" id="location" required>
                <!-- Default evacuation centers -->
                <option value="Valenzuela National Highschool">Valenzuela National Highschool</option>
                <option value="Constantino Elementary School">Constantino Elementary School</option>
                <option value="Caruhatan National Highschool">Caruhatan National Highschool</option>
                <option value="Serrano Elementary School">Serrano Elementary School</option>
                <option value="Marulas Elementary School">Marulas Elementary School</option>
                <option value="Barangay Court">Barangay Court</option>

                <!-- Additional evacuation centers from the database -->
                <?php
                $stmt = $conn->query("SELECT location FROM evacuation_centers WHERE location NOT IN (
                    'Valenzuela National Highschool',
                    'Constantino Elementary School',
                    'Caruhatan National Highschool',
                    'Serrano Elementary School',
                    'Marulas Elementary School',
                    'Barangay Court'
                )");
                $centers = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($centers as $center) {
                    echo "<option value=\"" . htmlspecialchars($center['location']) . "\">" . htmlspecialchars($center['location']) . "</option>";
                }
                ?>
            </select>

            <label for="evacuees" style="color: #000000;">Total Evacuees</label>
            <input type="number" name="evacuees" id="evacuees" placeholder="Enter total evacuees" min="0" required>

            <label for="availability" style="color: #000000;">Availability</label>
            <input type="text" name="availability" id="availability" placeholder="Enter availability (e.g. Full, Available)" required>

            <button type="submit" class="btn" style="background-color: #4CAF50; color: white; padding: 10px 20px; border-radius: 5px;">Update</button> 
        </form>
    </div>
</div>


    <!-- ADD EVACUATION -->

    <!-- Evacuation Modal -->
<div class="container1">
    <div class="admin1">
        <div id="evacuationModal" class="modal" style="display: none;">
            <div class="modal-content">
                <h2>Add Evacuation Center</h2>
                <label for="evacuationName">Name of Evacuation Center:</label>
                <input type="text" id="evacuationName" placeholder="Enter name of evacuation center" required>

                <label for="evacuationAddress">Address of Evacuation Center:</label>
                <input type="text" id="evacuationAddress" placeholder="Enter address" required>

                <button onclick="confirmEvacuation()" class="btn btn-add">Add Evacuation Site</button>
                <button onclick="closeEvacuationModal()" class="btn btn-cancel">Cancel</button>

            </div>
        </div>
    </div>
</div>

<style>
/* Adjust the container for the modal */
.container1, .admin1 {
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Ensure the modal itself takes up the full viewport and centers content */
#evacuationModal {
    display: flex;
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.5); /* Dark semi-transparent background */
    justify-content: center;
    align-items: center;
    z-index: 1000; /* Ensure the modal is above other content */
    overflow: hidden; /* Prevents any scrollbars from appearing */
}

/* Styling for the modal content */
.modal-content {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    width: 600px; /* Increase width to make the modal larger */
    max-width: 90%; /* Optional: Limit the width to 90% of the viewport for smaller screens */
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    text-align: left;
    position: relative;
}

/* Ensure no extra padding/margin for input fields and buttons */
input, button {
    margin: 0;
    padding: 10px;
    box-sizing: border-box;
    width: 100%;
}
/* Base button styles */
.btn {
    color: #fff; /* Text color */
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

/* Style for the "Add Evacuation Center" button */
.btn-add {
    background-color: #28a745; /* Green color */
}

/* Style for the "Cancel" button */
.btn-cancel {
    background-color: #dc3545; /* Red color */
}
</style>

<script>
    let autocomplete;

    // Open and initialize the evacuation modal
    function openEvacuationModal() {
        const modal = document.getElementById("evacuationModal");
        modal.style.display = "flex";
        initializeAutocomplete(); // Initialize autocomplete for address input
    }

    // Close the evacuation modal
    function closeEvacuationModal() {
        document.getElementById("evacuationModal").style.display = "none";
    }

    // Initialize Google Maps Autocomplete with Metro Manila restriction
    function initializeAutocomplete() {
        const input = document.getElementById("evacuationAddress");
        autocomplete = new google.maps.places.Autocomplete(input, {
            componentRestrictions: { country: "PH" },
            bounds: new google.maps.LatLngBounds(
                new google.maps.LatLng(14.3922, 120.8569),
                new google.maps.LatLng(14.8565, 121.1364)
            )
        });
    }

    // Show the confirmation modal
    function openConfirmationModal() {
        document.getElementById("confirmationModal").style.display = "flex";
    }

    // Hide the confirmation modal
    function closeConfirmationModal() {
        document.getElementById("confirmationModal").style.display = "none";
    }

    // Confirm addition and proceed with evacuation center submission
    function confirmAddition() {
        closeConfirmationModal();
        confirmEvacuation(); // Proceed with the addition
    }

    // Confirmation and Data Submission
    function confirmEvacuation() {
        const evacuationName = document.getElementById("evacuationName").value;
        const evacuationAddress = document.getElementById("evacuationAddress").value;

        if (!evacuationName || !evacuationAddress) {
            alert("Please fill in all fields.");
            return;
        }

        // Prepare data for submission
        const formData = new FormData();
        formData.append("evacuationName", evacuationName);
        formData.append("evacuationAddress", evacuationAddress);

        // Send data to PHP
        fetch("admin-evacuate.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(() => {
            alert("Evacuation center added successfully!");
            location.reload(); // Refresh the page to show the updated list

            // Clear inputs and close modal
            closeEvacuationModal();
            document.getElementById("evacuationName").value = "";
            document.getElementById("evacuationAddress").value = "";
        })
        .catch(error => console.error("Error:", error));
    }
</script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMUTo6-3mydfGFj7zdNtnvucFOlOQB3fU&libraries=places"></script>

<!--END OF ADDED LOCATION-->

        </form>
    </div>
</div>

<script>
    function updateInfo() {
        const location = document.getElementById('location').value;
        const evacuees = document.getElementById('evacuees').value || 0;
        const availability = document.getElementById('availability').value || "Unknown";

        // Send data to the server via AJAX
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "update_evacuation.php", true);  // Assuming you have a PHP backend
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        const params = `location=${encodeURIComponent(location)}&evacuees=${encodeURIComponent(evacuees)}&availability=${encodeURIComponent(availability)}`;
        
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert("Data updated successfully!");
            }
        };

        xhr.send(params);
    }
</script>

 
<div class="containerHIS">
<div class="admin">
    <h2>Evacuation History</h2>

    <?php if (!empty($history_data)) : ?>
        <table class="history-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Location</th>
                    <th>Evacuees</th>
                    <th>Availability</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($history_data as $row) : ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']); ?></td>
                        <td><?= htmlspecialchars($row['location']); ?></td>
                        <td><?= htmlspecialchars($row['evacuees']); ?></td>
                        <td><?= htmlspecialchars($row['availability']); ?></td>
                        <td><?= htmlspecialchars($row['timestamp']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No history data available.</p>
    <?php endif; ?>
</div>
    </div>

    <!-- Footer Section -->
    <footer class="footer">
        <p>© 2024 Eye Flood | Your Reliable Source for Flood Monitoring</p>
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