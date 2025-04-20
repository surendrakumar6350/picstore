<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PicStore - Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/home.css">
    <link rel="icon" type="image/png" href="../../public/icon.png">
</head>
<body>
    <!-- Navbar -->
   <?php include 'components/nav.php'; ?>

    <div class="container">
        <!-- Main Content Area -->
        <div class="row">
            <!-- Welcome/Upload Section -->
            <div class="col-lg-7">
                <div class="upload-card text-center">
                    <h1>Welcome to PicStore</h1>
                    <p class="subtitle">Upload, organize, and share your images seamlessly</p>

                    <form action="./app/controllers/upload.php" method="POST" enctype="multipart/form-data">
                        <div class="upload-area">
                            <input type="file" name="image" id="image-upload" class="form-control" required multiple>
                            <div class="text-center">
                                <div class="upload-icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <h5>Drag and drop your images here</h5>
                                <p class="text-muted">Or click to browse your files</p>
                                <small class="text-muted">Supports: JPG, PNG, GIF, SVG (Max: 10MB)</small>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-upload me-2"></i> Upload Images
                            </button>
                        </div>
                    </form>

                    <div class="options-row">
                        <button class="option-btn">
                            <i class="fas fa-folder-plus"></i>
                            New Album
                        </button>
                        <button class="option-btn">
                            <i class="fas fa-share-alt"></i>
                            Share
                        </button>
                        <button class="option-btn">
                            <i class="fas fa-magic"></i>
                            Auto Enhance
                        </button>
                    </div>
                </div>
            </div>

            <?php

                // Define the uploads directory
                $uploadsDir = __DIR__ . '/../../public/uploads';

                // Initialize an array to store recent uploads
                $recentUploads = [];

                // Check if the uploads directory exists
                if (is_dir($uploadsDir)) {
                    // Scan the directory for files
                    $files = array_diff(scandir($uploadsDir, SCANDIR_SORT_DESCENDING), ['.', '..']);

                    // Loop through the files and get their details
                    foreach ($files as $file) {
                        $filePath = $uploadsDir . '/' . $file;

                        // Only include files (skip directories)
                        if (is_file($filePath)) {
                            $recentUploads[] = [
                                'name' => $file,
                                'size' => filesize($filePath),
                                'time' => filemtime($filePath),
                                'url'  => '/public/uploads/' . $file,
                            ];
                        }

                        // Limit to the top 5 recent uploads
                        if (count($recentUploads) >= 4) {
                            break;
                        }
                    }
                }

                // Sort the uploads by modification time (most recent first)
                usort($recentUploads, function ($a, $b) {
                    return $b['time'] - $a['time'];
                });
            ?>

            <!-- Recent Uploads Section -->
            <div class="col-lg-5">
                <div class="recent-uploads">
                    <h3><i class="fas fa-history me-2"></i>Recent Uploads</h3>
               <?php if (! empty($recentUploads)): ?>
<?php foreach ($recentUploads as $upload): ?>
                     <div class="recent-item">
                <img src="<?php echo $upload['url']; ?>" alt="<?php echo htmlspecialchars($upload['name']); ?>">
                <div class="recent-item-details">
                    <div class="recent-item-title"><?php echo htmlspecialchars($upload['name']); ?></div>
                    <div class="recent-item-size">
                        <?php echo round($upload['size'] / 1024, 2); ?> KB •
                        <?php echo date('F j, Y, g:i a', $upload['time']); ?>
                      </div>
                      </div>
                   </div>
                   <?php endforeach; ?>
<?php else: ?>
                  <p class="text-muted">No recent uploads found.</p>
           <?php endif; ?>
                    <div class="text-center mt-3">
                        <button class="btn btn-outline">View All Images</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
         <?php include 'components/footer.php'; ?>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('image-upload').addEventListener('change', function(e) {
            const fileCount = this.files.length;
            if (fileCount > 0) {
                const uploadArea = document.querySelector('.upload-area');
                const uploadText = document.querySelector('.upload-area h5');

                if (fileCount === 1) {
                    uploadText.textContent = `Selected: ${this.files[0].name}`;
                } else {
                    uploadText.textContent = `${fileCount} files selected`;
                }

                uploadArea.style.borderColor = 'var(--primary)';
                uploadArea.style.backgroundColor = 'rgba(108, 92, 231, 0.05)';
            }
        });
    </script>
</body>
</html>
