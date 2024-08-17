<?php

class FileHandler
{
    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function upload()
    {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($this->file["name"]);

        if (move_uploaded_file($this->file["tmp_name"], $targetFile)) {
            return $targetFile;
        } else {
            throw new Exception("Error uploading the file.");
        }
    }

    public function isPdf($filePath)
    {
        $fileType = mime_content_type($filePath);
        return $fileType === 'application/pdf';
    }
}
