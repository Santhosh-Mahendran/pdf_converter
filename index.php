<?php
require 'classes/FileHandler.php';
require 'classes/PdfConverter.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $fileHandler = new FileHandler($_FILES["file"]);
        $uploadedFilePath = $fileHandler->upload();

        if ($fileHandler->isPdf($uploadedFilePath)) {
            header("Location: download.php?file=" . urlencode($uploadedFilePath));
        } else {
            $pdfConverter = new PdfConverter();
            $pdfFilePath = $pdfConverter->convertToPdf($uploadedFilePath);
            header("Location: download.php?file=" . urlencode($pdfFilePath));
        }
    } catch (Exception $e) {
        $message = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload and PDF Handling</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Upload Your File</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="file" required>
            <button type="submit">Upload</button>
        </form>
        <?php if ($message): ?>
            <p class="error"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
