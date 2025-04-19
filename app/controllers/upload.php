<?php
define('APP_RUNNING', true);


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if a file is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Get the uploaded file details
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        // Define allowed file extensions
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        // Validate file extension
        if (in_array(strtolower($fileExtension), $allowedExtensions)) {
            // Define the upload directory
            $uploadDir = __DIR__ . '/../../public/uploads/';
            
            // Create the directory if it doesn't exist
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Generate a unique file name to avoid overwriting
            $newFileName = uniqid() . '.' . $fileExtension;

            // Move the uploaded file to the public/uploads directory
            $destination = $uploadDir . $newFileName;
            if (move_uploaded_file($fileTmpPath, $destination)) {
                // Include the success view
                $imageUrl = "/public/uploads/$newFileName";
                include '../views/upload_success.php';
            } else {
                // Include the error view for file move failure
                $errorMessage = "Error moving the uploaded file.";
                include '../views/upload_error.php';
            }
        } else {
            // Include the error view for invalid file type
            $errorMessage = "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
            include '../views/upload_error.php';
        }
    } else {
        // Include the error view for no file uploaded
        $errorMessage = "No file uploaded or there was an error during the upload.";
        include '../views/upload_error.php';
    }
} else {
    // Include the error view for invalid request method
    $errorMessage = "Invalid request method.";
    include '../views/upload_error.php';
}
?>