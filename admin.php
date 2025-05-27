<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Management</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <h2>Payments</h2>
    <table>
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Card Number</th>
            <th>Expiry Month</th>
            <th>Expiry Year</th>
            <th>CVV</th>
        </tr>

        <div class = "exitdata">
            <a href = "index.html">
                <button style = "margin: 10px; padding: 8px 16px; font-size: 16px;">X</button>
            </a>
        </div>

        <form method="POST" onsubmit="return confirm('Are you sure you want to delete ALL payments?');">
            <button type="submit" name="delete_all" style="margin: 10px; padding: 8px 16px; font-size: 16px; background-color: red; color: white;">
            Delete All Payments
            </button>
        </form>
      <?php
    // Connect to the database
    $servername = "localhost";
    $username = "root"; // Change to your MySQL username
    $password = ""; // Change to your MySQL password
    $dbname = "sneakerstore";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //Delete data
    if (isset($_POST['delete_all'])) {
    $deleteSql = "DELETE FROM payments";
    if ($conn->query($deleteSql) === TRUE) {
        echo "<p style='color: red; margin: 10px;'>All payment records deleted successfully.</p>";
    } else {
        echo "<p style='color: red; margin: 10px;'>Error deleting records: " . $conn->error . "</p>";
    }
    }
    // Query payments table
    $sql = "SELECT name, phone, address, card_number, expiry_month, expiry_year, cvv FROM payments";
    $result = $conn->query($sql);

    // Check for errors
    if (!$result) {
        die("Query failed: " . $conn->error);
    }
    // Counter for serial numbers
    $serialNumber = 1;

    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$serialNumber."</td>";
            echo "<td>".$row["name"]."</td>";
            echo "<td>".$row["phone"]."</td>";
            echo "<td>".$row["address"]."</td>";
            echo "<td>".$row["card_number"]."</td>";
            echo "<td>".$row["expiry_month"]."</td>";
            echo "<td>".$row["expiry_year"]."</td>";
            echo "<td>".$row["cvv"]."</td>";
            echo "</tr>";
            $serialNumber++; // Increment serial number for next row
        }
    } else {
        echo "<tr><td colspan='8'>No payments found</td></tr>";
    }
    $conn->close();
?>
    </table>
    
</body>
</html>  