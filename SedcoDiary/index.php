<?php
// Function to retrieve ID from QR code using JSON mapping
function getIDFromQRCode($qrCodeImagePath) {
    // Read JSON mapping file
    $jsonFile = 'qr_mapping.json';
    $jsonContent = file_get_contents($jsonFile);

    // Decode JSON content
    $mappingData = json_decode($jsonContent, true);

    // Search for the QR code path in the mapping data
    foreach ($mappingData['qr_codes'] as $entry) {
        if ($entry['path'] === $qrCodeImagePath) {
            return $entry['id'];
        }
    }

    return null; // ID not found
}

// Example usage
$qrCodeImagePath = '/assets/qr/qrsedco.png';
$associatedID = getIDFromQRCode($qrCodeImagePath);

// Assuming you have a MySQL database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "companydetails";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database based on the associated ID
if ($associatedID !== null) {
    $sql = "SELECT * FROM employee WHERE company_id = '$associatedID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        echo "<h2>Employee Details for QR Code ID: $associatedID</h2>";
        echo "<table class='table'>
                <thead>
                    <tr>
                        <th scope='col'>Employee Name</th>
                        <th scope='col'>Position</th>
                        <th scope='col'>Email</th>
                        <th scope='col'>Phone Number</th>
                    </tr>
                </thead>
                <tbody>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <th scope='row'>" . $row["employee_id"] . "</th>
                    <td>" . $row["employee_name"] . "</td>
                    <td>" . $row["employee_position"] . "</td>
                    <td>" . $row["employee_email"] . "</td>
                    <td>" . $row["employee_phoneNum"] . "</td>
                  </tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "No results for QR Code ID: $associatedID";
    }
} else {
    echo "Failed to retrieve ID from the QR code.";
}

$conn->close();
?>
