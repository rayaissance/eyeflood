<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flood Monitor</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .container-fluid {
            flex: 1;
            overflow-y: auto; /* Allow content to scroll if necessary */
        }

        .main-header {
            background-color: #a81c22; /* Background color of the header */
            color: white; /* Text color */
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
            max-height: 50px; /* Adjust logo size */
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
            color: #f0c14b; /* Hover color */
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .table th, .table td {
            text-align: center; /* Center-aligns text in table cells */
        }

        .table thead th {
            background-color: #D3D3D3;
            color: #000000;
        }

        .table tbody tr {
            background-color: #c9fcc0;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add shadow to the content */
            margin: 20px;
            border-radius: 10px;
            background-color: #ffff;
        }

        .card-body {
            padding: 15px;
        }

        .flood-card {
            margin-top: 10px; /* Adjust this value to move the card higher or lower */
        }

        .card.mb-3.flood-card {
            background-color: #f8d7da; /* Background color of the entire card */
        }

        .card.mb-3.flood-card .card-body {
            background-color: #FFD700; /* Background color of the card body */
            color: #000; /* Text color inside the card body */
            border-radius: 10px;
        }

        .footer {
        background-color: #2c3e50;
        color: #ecf0f1;
        padding: 10px;
        text-align: center;
        width: 100%;
        position: static; /* Remove any sticky or fixed positioning */
        bottom: 0;
        margin-top: auto; /* Pushes footer to the bottom of the page */
        }


        .footer a {
            color: #1abc9c;
            text-decoration: none;
            font-size: 8px;
        }




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
                <li><a href= admin-page.php>HOME</a></li>
                <li><a href="admin-user.php">USER</a></li>
                <li><a href="admin_announcement.php">ANNOUNCEMENT</a></li>
                <li><a href= admin-history.php>HISTORY</a></li>
                <li><a href="index.php">LOG OUT</a></li>
            </ul>
        </nav>
    </header>

    <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <!-- Insert the flood level card here -->
                    <div class="card mb-3 flood-card">
                        <div class="card-body">
                        <p>Level: <span id="sensor-data">Waiting for data...</span></p>
                        </div>
                    </div>


    <!-- Line graph canvas -->
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


    <!-- Footer Section moved outside of the main content -->
    <footer class="footer">
    <p>© 2024 Eye Flood | Your Reliable Source for Flood Monitoring</p>
    <p class="footer-note" style="font-size: 12px; font-style: italic; margin-top: 10px;">
        Stay informed, stay safe.
    </p>
</footer>

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

</body>
</html>
