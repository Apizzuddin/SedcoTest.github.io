<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEDCO & SUBSIDIARIES DIRECTORIES</title>
    <link rel="stylesheet" href="/assets/styles.css"> 
</head>
<body>
    <h1>SEDCO MANAGERS AND KEY OFFICERS</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Employee Name</th>
                <th scope="col">Position</th>
                <th scope="col">Email</th>
                <th scope="col">Phone Number</th>
            </tr>
        </thead>
        <tbody>

            <?php
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

            // Fetch data from the database
            $sql = "SELECT * From employee WHERE company_id = '2'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <th scope='row'>" . $row["employee_id"] . "</th>
                            <td>" . $row["employee_name"] . "</td>
                            <td>" . $row["employee_position"] . "</td>
                            <td>" . $row["employee_email"] . "</td>
                            <td>" . $row["employee_phoneNum"] . "</td>
                          </tr>";
                }
            } else {
                echo "0 results";
            }

            $conn->close();
            ?>

        </tbody>
    </table>
</body>
</html>
