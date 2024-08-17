<?php

require 'vendor/autoload.php'; // Load Composer's autoloader if using a library like Dompdf

use Dompdf\Dompdf;

class PdfConverter
{
    public function convertToPdf($filePath)
    {
        $dompdf = new Dompdf();
        $html = file_get_contents($filePath); // Assuming the file is an HTML document or plain text

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $output = $dompdf->output();
        $pdfFilePath = pathinfo($filePath, PATHINFO_FILENAME) . ".pdf";
        file_put_contents("uploads/" . $pdfFilePath, $output);

        return "uploads/" . $pdfFilePath;
    }
}
