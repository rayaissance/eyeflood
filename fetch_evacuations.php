<?php
$host = 'localhost';
$dbname = 'flood-monitor';
$user = 'root';
$pass = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch all evacuation centers
    $stmt = $conn->query("SELECT location, address, evacuees, availability FROM evacuation_centers");
    $evacuation_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Format the data as needed
    $formatted_data = array_map(function($center) {
        return [
            'location' => $center['location'],
            'address' => $center['address'], // Use address directly from the database
            'evacuees' => $center['evacuees'],
            'availability' => $center['availability']
        ];
    }, $evacuation_data);

    header('Content-Type: application/json');
    echo json_encode($formatted_data);

} catch (PDOException $e) {
    echo json_encode(['error' => "Database error: " . $e->getMessage()]);
}
?>
