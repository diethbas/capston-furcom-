<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Response\QrCodeResponse;
use Endroid\QrCode\Writer\PngWriter;
use \Endroid\QrCode\ErrorCorrectionLevel;

class QRCodeController extends Controller
{
    public function generate(Request $request)
    {
        $data = $request->input('data', 'Default Text');
        $logoPath = public_path('img/favicon.png'); // Path to your logo image

        // Create the QR code
        $qrCode = new QrCode($data);
        $qrCode->setSize(300);
        $qrCode->setMargin(10);
        $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::High); // Q level error correction

        // Create a PNG writer
        $writer = new PngWriter();
        $qrCodeImage = $writer->write($qrCode)->getString();

        // Create an image resource from the QR code
        $qrImage = imagecreatefromstring($qrCodeImage);

        // Load the logo
        $logo = imagecreatefrompng($logoPath);

        // Get dimensions for logo and QR code
        $qrWidth = imagesx($qrImage);
        $qrHeight = imagesy($qrImage);
        $logoWidth = imagesx($logo);
        $logoHeight = imagesy($logo);

        // Calculate logo size (reduce size for better scannability)
        $logoSize = min($qrWidth / 5, $qrHeight / 5); // Adjust this ratio if necessary
        $logoResized = imagecreatetruecolor($logoSize, $logoSize);
        imagealphablending($logoResized, false);
        imagesavealpha($logoResized, true);
        imagefilledrectangle($logoResized, 0, 0, $logoSize, $logoSize, 0x7FFFFFFF);
        imagecopyresampled($logoResized, $logo, 0, 0, 0, 0, $logoSize, $logoSize, $logoWidth, $logoHeight);

        // Position the logo in the center of the QR code
        $logoX = ($qrWidth - $logoSize) / 2;
        $logoY = ($qrHeight - $logoSize) / 2;

        // Merge logo with QR code
        imagecopy($qrImage, $logoResized, $logoX, $logoY, 0, 0, $logoSize, $logoSize);

        // Output the final image
        ob_start();
        imagepng($qrImage);
        $finalImage = ob_get_clean();

        // Free up memory
        imagedestroy($qrImage);
        imagedestroy($logo);
        imagedestroy($logoResized);

        return response($finalImage)
            ->header('Content-Type', 'image/png');
    }
}
