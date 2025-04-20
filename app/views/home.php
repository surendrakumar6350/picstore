<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PicStore - Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/home.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="upload-card text-center">
                    <h1>Welcome to PicStore What</h1>
                    <p>Upload your images and manage them easily.</p>
                    <form action="./app/controllers/upload.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <input type="file" name="image" class="form-control" required>
                        </div>
                        <button type="submit" class="upload-btn">Upload Image</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
