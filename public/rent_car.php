<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'customer') {
    echo "You need to be logged in as a customer to rent a car.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $car_id = $_POST['car_id'];
    $num_days = $_POST['num_days'];
    $start_date = $_POST['start_date'];
    $customer_id = $_SESSION['user_id'];

    $query = "SELECT rent_per_day FROM cars WHERE id = $car_id";
    $result = mysqli_query($conn, $query);
    $car = mysqli_fetch_assoc($result);

    if ($car) {
        $rent_per_day = $car['rent_per_day'];
        $total_amount = $rent_per_day * $num_days;
        $end_date = date('Y-m-d', strtotime($start_date . ' + ' . ($num_days - 1) . ' days'));

        $query = "INSERT INTO rentals (car_id, customer_id, start_date, end_date, total_amount)
                  VALUES ($car_id, $customer_id, '$start_date', '$end_date', $total_amount)";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "Car rented successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error: Invalid car ID.";
    }
}