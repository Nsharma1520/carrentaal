<!DOCTYPE html>
<html>
<head>
    <title>Available Cars</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Car Rental System</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
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
        <h1>Available Cars</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Model</th>
                    <th>Vehicle Number</th>
                    <th>Seating Capacity</th>
                    <th>Rent Per Day</th>
                    <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'customer'): ?>
                        <th>No. of Days</th>
                        <th>Start Date</th>
                        <th>Action</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch available cars from the database
                $query = "SELECT * FROM cars";
                $result = mysqli_query($conn, $query);

                while ($car = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $car['model'] . "</td>";
                    echo "<td>" . $car['vehicle_number'] . "</td>";
                    echo "<td>" . $car['seating_capacity'] . "</td>";
                    echo "<td>$" . $car['rent_per_day'] . "</td>";

                    if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'customer') {
                        echo "<td><input type='number' min='1' class='form-control' name='num_days' required></td>";
                        echo "<td><input type='date' class='form-control' name='start_date' required></td>";
                        echo "<td><button class='btn btn-primary rent-car' data-car-id='" . $car['id'] . "'>Rent Car</button></td>";
                    }

                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.rent-car').click(function() {
                var carId = $(this).data('car-id');
                var numDays = $(this).closest('tr').find('input[name="num_days"]').val();
                var startDate = $(this).closest('tr').find('input[name="start_date"]').val();

                // Perform AJAX request to rent the car
                $.ajax({
                    url: 'rent_car.php',
                    type: 'POST',
                    data: {
                        car_id: carId,
                        num_days: numDays,
                        start_date: startDate
                    },
                    success: function(response) {
                        alert(response);
                    },
                    error: function() {
                        alert('Error renting car. Please try again.');
                    }
                });
            });
        });
    </script>
</body>
</html>