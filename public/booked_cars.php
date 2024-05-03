<!DOCTYPE html>
<html>
<head>
    <title>Booked Cars</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Car Rental System</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="available_cars.php">Available Cars</a>
                </li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <div class="container my-5">
        <h1>Booked Cars</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Car Model</th>
                    <th>Vehicle Number</th>
                    <th>Customer</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Total Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch booked cars for the agency
                $agency_id = $_SESSION['user_id'];
                $query = "SELECT r.id, c.model, c.vehicle_number, u.username, r.start_date, r.end_date, r.total_amount
                          FROM rentals r
                          JOIN cars c ON r.car_id = c.id
                          JOIN users u ON r.customer_id = u.id
                          WHERE c.agency_id = $agency_id";
                $result = mysqli_query($conn, $query);

                while ($booking = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $booking['model'] . "</td>";
                    echo "<td>" . $booking['vehicle_number'] . "</td>";
                    echo "<td>" . $booking['username'] . "</td>";
                    echo "<td>" . $booking['start_date'] . "</td>";
                    echo "<td>" . $booking['end_date'] . "</td>";
                    echo "<td>$" . $booking['total_amount'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>