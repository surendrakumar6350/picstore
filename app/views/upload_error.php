<?php
    if (! defined('APP_RUNNING')) {
        http_response_code(403);
        die('Access denied');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Error</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="../../public/icon.png">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-danger text-center">
            <h1>Image Upload Failed</h1>
            <p><?php echo $errorMessage; ?></p>
            <a href="/" class="btn btn-primary">Go Back to Home</a>
        </div>
    </div>
</body>
</html>