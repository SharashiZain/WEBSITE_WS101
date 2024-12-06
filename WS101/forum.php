<?php
require_once 'db.connect.php';  // pangalan ng database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_id = $_POST['post_id'];
    $author_id = $_POST['author_id'];
    $content = $_POST['content'];

    $sql = "INSERT INTO forum_tbl (post_id, author_id, content) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("iis", $post_id, $author_id, $content);
        $stmt->execute();

        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Forum Post</title>
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
            <h2>Post created successfully!</h2>
            <script>
                setTimeout(function() {
                    window.location.href = 'forum.php';
                }, 2000);
            </script>
        </body>
        </html>
        <?php
        exit;
    } else {
        echo "Error preparing statement: " . $conn->error;  
    }
    
    $conn->close();  
}
?>



