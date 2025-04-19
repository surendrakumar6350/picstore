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
    <title>Upload Success</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/success.css">
</head>
<body>
    <div class="page-wrapper">
        <div class="success-header">
            <div class="success-icon">
                <i class="fas fa-check"></i>
            </div>
            <h2>Upload Successful!</h2>
            <p class="mb-0">Your image has been uploaded and is ready to share.</p>
        </div>

        <div class="content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <?php
                            $cleanImageUrl = "/public/uploads/" . basename($imageUrl);
                            $liveImageUrl  = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $cleanImageUrl;
                            $fileName      = basename($cleanImageUrl);
                            $fileSize      = filesize($_SERVER['DOCUMENT_ROOT'] . $cleanImageUrl);
                            $fileSize      = $fileSize < 1024 ? $fileSize . " bytes" : ($fileSize < 1048576 ? round($fileSize / 1024, 2) . " KB" : round($fileSize / 1048576, 2) . " MB");
                            $fileExt       = pathinfo($fileName, PATHINFO_EXTENSION);
                            $timestamp     = date("Y-m-d H:i:s", filemtime($_SERVER['DOCUMENT_ROOT'] . $cleanImageUrl));
                        ?>
                        <div class="preview-section">
                            <div class="preview-container">
                                <img src="<?php echo $cleanImageUrl; ?>" alt="Uploaded Image" class="preview-img" id="previewImg">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="details-section">
                            <div class="detail-row">
                                <span class="detail-label">File name:</span>
                                <span class="detail-value text-truncate"><?php echo $fileName; ?></span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Format:</span>
                                <span class="detail-value"><?php echo strtoupper($fileExt); ?></span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">File size:</span>
                                <span class="detail-value"><?php echo $fileSize; ?></span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Uploaded:</span>
                                <span class="detail-value"><?php echo $timestamp; ?></span>
                            </div>
                        </div>

                        <div class="link-section">
                            <div class="input-group">
                                <input type="text" class="form-control" value="<?php echo $liveImageUrl ?>" id="imageLink" readonly>
                                <button class="btn" type="button" id="copyButton" onclick="copyImageLink()">
                                    <i class="fas fa-copy"></i> Copy
                                </button>
                            </div>
                        </div>

                        <div class="actions-section">
                            <div class="d-grid gap-2">
                                <a href="<?php echo $cleanImageUrl; ?>" class="btn btn-action btn-primary" target="_blank">
                                    <i class="fas fa-eye me-2"></i> View
                                </a>
                                <a href="<?php echo $cleanImageUrl; ?>" class="btn btn-action btn-primary" download="<?php echo $fileName; ?>">
                                    <i class="fas fa-download me-2"></i> Download
                                </a>
                                <a href="/" class="btn btn-action">
                                    <i class="fas fa-home me-2"></i> Home
                                </a>
                            </div>
                        </div>

                        <div class="share-section">
                            <div class="share-title">Share with:</div>
                            <?php $shareUrl = urlencode($liveImageUrl); ?>
                            <div class="social-icons">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $shareUrl; ?>" target="_blank" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://twitter.com/intent/tweet?url=<?php echo $shareUrl; ?>" target="_blank" class="social-icon"><i class="fab fa-twitter"></i></a>
                                <a href="https://pinterest.com/pin/create/button/?url=<?php echo $shareUrl; ?>&media=<?php echo $shareUrl; ?>" target="_blank" class="social-icon"><i class="fab fa-pinterest-p"></i></a>
                                <a href="mailto:?subject=Check out this image&body=<?php echo $shareUrl; ?>" class="social-icon"><i class="fas fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="toast-container">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" id="linkCopiedToast">
            <div class="toast-header bg-transparent text-white border-0">
                <strong class="me-auto"><i class="fas fa-check-circle me-2"></i> Success</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Link copied to clipboard!
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Image zoom functionality
        const previewImg = document.getElementById('previewImg');
        previewImg.addEventListener('click', function() {
            if (this.style.transform === 'scale(1.5)') {
                this.style.transform = 'scale(1)';
            } else {
                this.style.transform = 'scale(1.5)';
            }
        });

        // Copy image link functionality
        function copyImageLink() {
            const copyText = document.getElementById("imageLink");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(copyText.value);

            const toast = new bootstrap.Toast(document.getElementById('linkCopiedToast'));
            toast.show();
        }
    </script>
</body>
</html>