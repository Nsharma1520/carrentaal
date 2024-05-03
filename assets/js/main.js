$(document).ready(function() {
    // Rent Car button click handler
    $('.rent-car').click(function() {
        var carId = $(this).data('car-id');
        var numDays = $(this).closest('tr').find('input[name="num_days"]').val();
        var startDate = $(this).closest('tr').find('input[name="start_date"]').val();

        if (!numDays || !startDate) {
            alert('Please enter the number of days and start date.');
            return;
        }

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
                location.reload(); // Reload the page after successful rental
            },
            error: function(xhr, status, error) {
                alert('Error renting car. Please try again. ' + error);
            }
        });
    });
});