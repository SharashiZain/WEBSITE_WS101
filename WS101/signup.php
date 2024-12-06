<?php
require_once 'db.connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmpassword'];

    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "All fields are required.";
        exit;
    }

    if ($password !== $confirm_password) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Signup Attempt</title>
            <style>
                @font-face {
                            font-family: 'Press Start 2P'; 
                            src: url('fonts/PressStart2P-Regular.ttf') format('truetype'); 
                        }
                body {
                    font-family: 'Press Start 2P';
                    text-align: center;
                    margin-top: 100px;
                    background-image: url(PICTURES/WSWS.png);
                    background-position: auto;
                    background-size: cover;
                    color: #fff; /* Changed text color to white */
                }
                button {
                    font-family: 'Press Start 2P';
                    padding: 10px 20px;
                    font-size: 16px;
                    color: #fff;
                    background-color: #D2B48C; /* Changed button color to a brown shade */
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                }
            </style>
        </head>
        <body>
            <h2>Passwords do not match. Please try again.</h2>
            <button onclick="window.location.href='signup.html'">Back to Signup</button>
        </body>
        </html>
        <?php
        exit;
    }

    $check_sql = "SELECT * FROM signup_tbl WHERE Email = ? OR Name = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("ss", $email, $name);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Signup Attempt</title>
            <style>
                @font-face {
                            font-family: 'Press Start 2P'; 
                            src: url('fonts/PressStart2P-Regular.ttf') format('truetype'); 
                        }
                body {
                    font-family: 'Press Start 2P';
                    text-align: center;
                    margin-top: 100px;
                    background-image: url(PICTURES/WSWS.png);
                    background-position: auto;
                    background-size: cover;
                    color: #fff; /* Changed text color to white */
                }
                button {
                    font-family: 'Press Start 2P';
                    padding: 10px 20px;
                    font-size: 16px;
                    color: #fff;
                    background-color: #D2B48C; /* Changed button color to a brown shade */
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                }
            </style>
        </head>
        <body>
            <h2>Email or username already exists. Please try again.</h2>
            <button onclick="window.location.href='signup.html'">Back to Signup</button>
        </body>
        </html>
        <?php
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
    // Close the connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup Successful</title>
    <style>
         @font-face {
                            font-family: 'Press Start 2P'; 
                            src: url('fonts/PressStart2P-Regular.ttf') format('truetype'); 
                        }
        body {
            font-family: 'Press Start 2P';
            text-align: center;
            margin-top: 100px;
            background-image: url(PICTURES/WSWS.png);
            background-position: auto;
            background-size: cover;
            color: #fff; /* Changed text color to white */
        }
        button {
            font-family:'Press Start 2P';
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>Signup successful! You will be redirected to the homepage shortly.</h2>
    <script>
        setTimeout(function() {
            window.location.href = "homepage.html";
        }, 3000);
    </script>
</body>
</html>
