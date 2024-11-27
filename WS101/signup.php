<?php
require_once 'db.connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "All fields are required.";
        exit;
    }

    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }

    $check_sql = "SELECT * FROM signup_tbl WHERE Email = ? OR Name = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("ss", $email, $name);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Error: Email or Name already exists.";
        $stmt->close();
        exit;
    }
    $stmt->close();

    $insert_sql = "INSERT INTO signup_tbl (Name, Password, Email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insert_sql);

    if ($stmt) {
        $stmt->bind_param("sss", $name, $password, $email);
        if ($stmt->execute()) {
            echo "Signup successful!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    echo '<br><br><a href="index.html"><button>Return to Form</button></a>';
    // Close the connection
    $conn->close();
}
?>
