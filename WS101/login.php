<?php
require_once 'db.connect.php';  // pangalan ng database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // dapat sa signup_tbl yan kasi wala naman saved data sa login e login nga diba 
    $sql = "SELECT Password, Name FROM signup_tbl WHERE Email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();  

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($stored_password, $name);
            $stmt->fetch();

            if ($password === $stored_password) {
                ?>
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Welcome</title>
                    <style>
                        @font-face {
                            font-family: 'Press Start 2P'; 
                            src: url('fonts/PressStart2P-Regular.ttf') format('truetype'); 
                        }
  
                        body {
                            font-family:'Press Start 2P';
                            text-align: center;
                            margin-top: 100px;
                            background-image: url(PICTURES/WSWS.png);
                            background-position: auto;
                            background-size: cover;
                            color: #fff; /* Changed text color to white */
                        }
                    </style>
                </head>
                <body>
                    <h2>Welcome, <?php echo htmlspecialchars($name); ?>!</h2>
                    <script>
                        setTimeout(function() {
                            window.location.href = 'homepage.html';
                        }, 2000);
                    </script>
                </body>
                </html>
                <?php
                exit;
            } else {
                ?>
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Login Attempt</title>
                    <style>
                         @font-face {
                            font-family: 'Press Start 2P'; 
                            src: url('fonts/PressStart2P-Regular.ttf') format('truetype'); 
                        }

                        body {
                            font-family:'Press Start 2P';
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
                    <h2>Incorrect password. Please try again.</h2>
                    <button onclick="window.location.href='login.html'">Back to Login</button>
                </body>
                </html>
                <?php
                exit;
            }
        } else {
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <title>Login Attempt</title>
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
                        background-position: center;
                        background-size: cover;
                    }
                    button {
                        font-family: 'Press Start 2P';
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
                <h2>No account found with this email.</h2>
                <button onclick="window.location.href='login.html'">Back to Login</button>
            </body>
            </html>
            <?php
            exit;
        }
        $stmt->close();  
    } else {
        echo "Error preparing statement: " . $conn->error;  
    }
    
    $conn->close();  
}
?>

