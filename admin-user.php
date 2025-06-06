<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <title>Admin User</title>
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
        vertical-align: left;
        text-align: center;
        border-bottom: 1px solid #f17b7b;
        height: 50px;
        
        
    }

    .table thead th {
        background-color: #f17b7b;
        color: #fff;
        
    }

    .table tbody tr {
        border-bottom: 5px solid #f17b7b;
        
    }
   
    .table tbody tr {
        background-color: #fff;
       
        
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
    

    </style>
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
                <div class="card mt-3">
                    <div class="card-body">
                        <h2 h2 style="color: #e04f5f;">REGISTERED USERS</h2>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="RegDate" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Contact Number</th>
                                        <th>Birthday</th>
                                        <th>Time Logged In</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        // Establish database connection
                                        $con = mysqli_connect("localhost", "root", "", "flood-monitor");

                                        // Check connection
                                        if (mysqli_connect_errno()) {
                                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                            exit();
                                        }

                                        // Fetch data from the database
                                        $query = "SELECT * FROM users";
                                        $query_run = mysqli_query($con, $query);

                                        // Check if any records found
                                        if(mysqli_num_rows($query_run) > 0) {
                                            while($row = mysqli_fetch_assoc($query_run)) {
                                                ?>
                                                <tr>
                                                    <td><?= $row['Id']; ?></td>
                                                    <td><?= $row['Username']; ?></td>
                                                    <td><?= $row['ConNumber']; ?></td>
                                                    <td><?= $row['DateOfBirth']; ?></td>
                                                    <td><?= $row['dateTimeUser']; ?></td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="5">No Record Found</td>
                                            </tr>
                                            <?php
                                        }

                                        // Close database connection
                                        mysqli_close($con);
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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
