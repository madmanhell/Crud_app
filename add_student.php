<?php
// Include the database connection
include('dbcon.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $first_name = mysqli_real_escape_string($connection, trim($_POST['f_name']));
    $last_name = mysqli_real_escape_string($connection, trim($_POST['l_name']));
    $age = mysqli_real_escape_string($connection, trim($_POST['age']));

    // Validation
    $errors = [];

    if (empty($first_name)) {
        $errors[] = 'First name is required.';
    }
    if (empty($last_name)) {
        $errors[] = 'Last name is required.';
    }
    if (empty($age) || !is_numeric($age) || $age <= 0) {
        $errors[] = 'Valid age is required.';
    }

    // If no validation errors, proceed to insert data
    if (empty($errors)) {
        $query = "INSERT INTO students (first_name, last_name, age) VALUES ('$first_name', '$last_name', '$age')";

        if (mysqli_query($connection, $query)) {
            // Redirect to the main page or show a success message
            header("Location: index.php?success=1");
            exit();
        } else {
            // If there is an error inserting data
            echo "Error: " . mysqli_error($connection);
        }
    } else {
        // Print errors
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    }
} else {
    // If form is not submitted correctly, redirect to main page
    header("Location: index.php");
    exit();
}

// Close the database connection
mysqli_close($connection);
?>
